<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbsensiGuruModel extends Model
{
    use HasFactory;

    protected $table = 'absensi_guru';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_guru',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'status',
        'keterangan',
        'created_at',
        'updated_at',
    ];


    public function guru()
    {
        return $this->belongsTo(GuruModel::class, 'id_guru', 'id');
    }
}
