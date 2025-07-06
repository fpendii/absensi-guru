<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMengajarModel extends Model
{
    use HasFactory;

    // Nama tabel sesuai database
    protected $table = 'jadwal_mengajar';

    protected $fillable = [
        'id_guru',
        'id_mapel',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan_kelas',
    ];

    public function guru()
    {
        return $this->belongsTo(GuruModel::class, 'id_guru'); // Sesuaikan foreign key
    }

    public function mapel()
    {
        return $this->belongsTo(MataPelajaranModel::class, 'id_mapel'); // Sesuaikan foreign key
    }
}
