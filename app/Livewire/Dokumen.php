<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pegawai;
use App\Models\KategoriArsip;
use App\Models\Dokumen as DokumenModel;
use App\Models\kategori_arsips;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Dokumen extends Component
{
    use WithPagination, WithFileUploads;

    public $jenis_arsip = null;
    public $tanggal, $namapemilik, $file, $dokumenId, $isEdit = false, $search = '';
     public $existingFile = null;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'jenis_arsip'   => 'required|string|max:30',
        'tanggal'       => 'required|date',
        'namapemilik'   => 'required|string|max:50',
        'file'          => 'nullable|file|max:2048'
    ];

    public function render()
    {
        $dokumens = DokumenModel::where('jenis_arsip', 'like', "%{$this->search}%")
            ->orWhere('namapemilik', 'like', "%{$this->search}%")
            ->latest()
            ->paginate(10);

        $arsipOptions = kategori_arsips::pluck('jenis');
        $pegawaiOptions = Pegawai::pluck('nama');

        return view('livewire.dokumen', compact('dokumens', 'arsipOptions', 'pegawaiOptions'))
            ->layout('layouts.app');
    }

    public function store()
    {
        $this->validate();

        $filePath = $this->file ? $this->file->store('dokumen', 'public') : null;

        DokumenModel::create([
            'jenis_arsip'   => $this->jenis_arsip,
            'tanggal'       => $this->tanggal,
            'namapemilik'   => $this->namapemilik,
            'file'          => $filePath,
        ]);

        $this->resetInput();
    }

    public function edit($id)
    {
        $d = DokumenModel::findOrFail($id);
        $this->dokumenId   = $d->id;
        $this->jenis_arsip = $d->jenis_arsip;
        $this->tanggal     = $d->tanggal;
        $this->namapemilik = $d->namapemilik;
        $this->file        = null;
         $this->existingFile = $d->file;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $d = DokumenModel::findOrFail($this->dokumenId);
        $filePath = $this->file ? $this->file->store('dokumen', 'public') : $d->file;

        $d->update([
            'jenis_arsip'   => $this->jenis_arsip,
            'tanggal'       => $this->tanggal,
            'namapemilik'   => $this->namapemilik,
            'file'          => $filePath,
        ]);

        session()->flash('message', 'Dokumen berhasil diperbarui.');
        $this->resetInput();
    }

    public function delete($id)
    {
        $dokumen = DokumenModel::findOrFail($id);
        if ($dokumen->file && Storage::disk('public')->exists($dokumen->file)) {
            Storage::disk('public')->delete($dokumen->file);
        }
        $dokumen->delete();

        session()->flash('message', 'Dokumen berhasil dihapus.');
    }

    public function resetInput()
    {
        $this->reset(['dokumenId', 'jenis_arsip', 'tanggal', 'namapemilik', 'file', 'existingFile', 'isEdit']);
    }
}
