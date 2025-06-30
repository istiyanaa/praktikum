<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Surat as SuratModel;
use Illuminate\Support\Facades\Storage;

class Surat extends Component
{
    use WithPagination, WithFileUploads;

    public string $search = '';
    public string $jenis_surat = '';
    public string $no_surat = '';
    public string $tanggal = '';
    public string $tujuan = '';
    public string $keterangan = '';
    public $file;

    public ?int $suratId = null;
    public bool $isEdit = false;

    protected $paginationTheme = 'bootstrap';

    protected function rules()
    {
        return [
            'jenis_surat'  => 'required',
            'no_surat'     => 'required|max:5',
            'tanggal'      => 'required|date',
            'tujuan'       => 'required|max:50',
            'keterangan'   => 'required|max:255',
            'file'         => 'nullable|file|max:2048',
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function searchSurat()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = SuratModel::query();

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('jenis_surat', 'like', '%' . $this->search . '%')
                    ->orWhere('tujuan', 'like', '%' . $this->search . '%')
                    ->orWhere('keterangan', 'like', '%' . $this->search . '%')
                    ->orWhere('tanggal', 'like', '%' . $this->search . '%');
            });
        }

        return view('livewire.surat', [
            'surats' => $query->latest()->paginate(5),
        ])->layout('layouts.app');
    }

    public function store()
    {
        $this->validate();

        $path = $this->file ? $this->file->store('surat-file', 'public') : null;

        SuratModel::create([
            'jenis_surat' => $this->jenis_surat,
            'no_surat'    => $this->no_surat,
            'tanggal'     => $this->tanggal,
            'tujuan'      => $this->tujuan,
            'keterangan'  => $this->keterangan,
            'file'        => $path,
        ]);

        $this->resetInput();
    }

    public function edit(int $id)
    {
        $surat = SuratModel::findOrFail($id);

        $this->suratId     = $surat->id;
        $this->jenis_surat = $surat->jenis_surat;
        $this->no_surat    = $surat->no_surat;
        $this->tanggal     = $surat->tanggal;
        $this->tujuan      = $surat->tujuan;
        $this->keterangan  = $surat->keterangan;
        $this->isEdit      = true;
    }

    public function update()
    {
        $this->validate();

        $surat = SuratModel::findOrFail($this->suratId);

        if ($this->file && $surat->file && Storage::disk('public')->exists($surat->file)) {
            Storage::disk('public')->delete($surat->file);
        }

        $path = $this->file ? $this->file->store('surat-file', 'public') : $surat->file;

        $surat->update([
            'jenis_surat' => $this->jenis_surat,
            'no_surat'    => $this->no_surat,
            'tanggal'     => $this->tanggal,
            'tujuan'      => $this->tujuan,
            'keterangan'  => $this->keterangan,
            'file'        => $path,
        ]);

        $this->resetInput();
    }

    public function delete(int $id)
    {
        $surat = SuratModel::findOrFail($id);

        if ($surat->file && Storage::disk('public')->exists($surat->file)) {
            Storage::disk('public')->delete($surat->file);
        }

        $surat->delete();

        session()->flash('message', 'Data berhasil dihapus.');
    }

    public function resetInput()
    {
        $this->jenis_surat = '';
        $this->no_surat    = '';
        $this->tanggal     = '';
        $this->tujuan      = '';
        $this->keterangan  = '';
        $this->file        = null;
        $this->suratId     = null;
        $this->isEdit      = false;
    }
}
