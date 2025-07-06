<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaranModel extends Model
{
    use HasFactory;

    // Nama tabel sesuai database
    protected $table = 'mata_pelajaran';

    protected $fillable = ['nama_mapel'];

    public function jadwalMengajar()
    {
        return $this->hasMany(JadwalMengajarModel::class, 'id_mapel');
    }
}
