<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruModel extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'nip',
        'nuptk',
        'telepon',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'foto', // simpan path gambar
        'mata_pelajaran',
        'pendidikan_terakhir', // contoh: S1, S2
        'status_pegawai', // contoh: PNS, Honorer
        'tanggal_masuk',
        'user_id', // foreign key ke tabel users
        'created_at',
        'updated_at',
    ];


    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}
