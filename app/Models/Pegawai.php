<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
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
    ];
}
