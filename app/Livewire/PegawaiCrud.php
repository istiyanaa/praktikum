<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pegawai;

class PegawaiCrud extends Component
{
    use WithPagination;

    public $pegawaiId, $NIK_NIP, $NIDN, $NUPTK, $nama, $status_pegawai, $status_nikah,
           $tanggal_lahir, $sex, $telp, $email, $alamat, $unit_kerja, $NPWP;

    public $isEdit = false;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'nama' => 'required|string|max:100',
        'status_pegawai' => 'required|string|max:30',
        'status_nikah' => 'required|string|max:20',
        'tanggal_lahir' => 'required|date',
        'sex' => 'required|string|max:20',
        'telp' => 'required|string|max:15',
        'alamat' => 'required|string',
        'unit_kerja' => 'required|string|max:50',
    ];

    public function render()
    {
        $pegawais = Pegawai::where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('unit_kerja', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('livewire.pegawai-crud', compact('pegawais'))
            ->layout('layouts.app');
    }

    public function resetInput()
    {
        $this->reset([
            'pegawaiId',
            'NIK_NIP',
            'NIDN',
            'NUPTK',
            'nama',
            'status_pegawai',
            'status_nikah',
            'tanggal_lahir',
            'sex',
            'telp',
            'email',
            'alamat',
            'unit_kerja',
            'NPWP',
            'isEdit',
        ]);
    }

    public function store()
    {
        $this->validate();

        Pegawai::create($this->only([
            'NIK_NIP', 'NIDN', 'NUPTK', 'nama', 'status_pegawai', 'status_nikah',
            'tanggal_lahir', 'sex', 'telp', 'email', 'alamat', 'unit_kerja', 'NPWP'
        ]));

        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $this->fill($pegawai->toArray());
        $this->pegawaiId = $id;
        $this->isEdit = true;
        $this->dispatch('open-modal');
    }

    public function update()
    {
        $this->validate();

        Pegawai::find($this->pegawaiId)->update($this->only([
            'NIK_NIP', 'NIDN', 'NUPTK', 'nama', 'status_pegawai', 'status_nikah',
            'tanggal_lahir', 'sex', 'telp', 'email', 'alamat', 'unit_kerja', 'NPWP'
        ]));

        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function delete($id)
    {
        Pegawai::destroy($id);
    }
}
