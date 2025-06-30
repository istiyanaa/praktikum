<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori_arsips extends Model
{
    use HasFactory;

    protected $table='kategori_arsips';
    protected $fillable=['jenis'];
}
