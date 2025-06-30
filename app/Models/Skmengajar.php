<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skmengajar extends Model
{
    use HasFactory;

    protected $table = 'skmengajar';

    protected $fillable = [
        'prodi',
        'semester',
        'tanggal',
        'file',
    ];
}
