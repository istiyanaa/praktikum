<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surats';

    protected $fillable = [
        'jenis_surat',
        'no_surat',
        'tanggal',
        'tujuan',
        'keterangan',
        'file',
    ];
}
