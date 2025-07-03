<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiModel extends Model
{
    use HasFactory;


    protected $table = 'lokasi';


    protected $fillable = [
        'sekolahLat',
        'sekolahLong',
        'radius',
        'nama_alamat',
    ];


    protected $casts = [
        // 'sekolahLat' => 'decimal:7',
        // 'sekolahLong' => 'decimal:7',
        'radius' => 'integer', // Cast ke integer
        'nama_alamat' => 'string', // Cast ke string
    ];
}
