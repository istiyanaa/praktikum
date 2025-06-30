<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\KategoriArsip;
use App\Livewire\Surat;
use App\Livewire\Dokumen;
use App\Livewire\PegawaiCrud;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', Dashboard::class);
Route::get('/kategori-arsip', KategoriArsip::class)->name('kategori-arsip');
Route::get('/surat', Surat::class)->name('surat');
Route::get('/dokumen', Dokumen::class)->name('dokumen');
Route::get('/pegawai', PegawaiCrud::class)->name('pegawai');
Route::get('/skmengajar', \App\Livewire\SkmengajarCrud::class)->name('skmengajar');

