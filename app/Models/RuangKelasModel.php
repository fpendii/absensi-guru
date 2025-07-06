<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuangKelasModel extends Model
{
    use HasFactory;

    protected $table = 'ruang_kelas'; // Nama tabel sesuai database

    protected $fillable = [
        'nama_kelas', // Hanya atribut ini
    ];

    // Relasi lain jika ada di masa depan (opsional)
}
