<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\kategori_arsips;

class KategoriArsip extends Component
{
   public $kategoriId, $jenis, $isEdit = false;
   
   protected $rules = [
    'jenis' => 'required|string|max:100',
];

public function render()
{
    return view('livewire.kategori-arsip', [
        'kategoris' => kategori_arsips::all()
    ])->layout('layouts.app'); // <- ini penting!
}

public function resetInput()
{
    $this->kategoriId = null;
    $this->jenis = '';
    $this->isEdit = false;
}

public function store()
{
    $this->validate();
    kategori_arsips::create(['jenis' => $this->jenis]);
    $this->resetInput();
}

public function edit($id)
{
    $kategori = kategori_arsips::findOrFail($id);
    $this->kategoriId = $kategori->id;
    $this->jenis = $kategori->jenis;
    $this->isEdit = true;
}

public function update()
{
    $this->validate();
    kategori_arsips::where('id', $this->kategoriId)->update(['jenis' => $this->jenis]);
}

public function delete($id)
{
    kategori_arsips::destroy($id);
}


}
