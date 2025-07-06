<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatLogin extends Model
{
    use HasFactory;

    protected $table = 'riwayat_login'; // Nama tabel sesuai database

    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'waktu_login',
    ];

    // Kolom ini akan otomatis diisi oleh database, jadi tidak perlu di fillable
    protected $guarded = ['waktu_login'];

    // Jika kolom 'waktu_login' di database Anda bertipe DATETIME atau TIMESTAMP
    // dan Anda ingin mengaturnya secara otomatis saat membuat record
    public $timestamps = true; // Karena sudah ada created_at, updated_at
    const CREATED_AT = 'waktu_login'; // Gunakan waktu_login sebagai created_at
    const UPDATED_AT = null; // Jika Anda tidak butuh updated_at

    // Relasi ke model User (atau model Admin Anda)
    public function user()
    {
        return $this->belongsTo(UserModel::class); // Asumsi model User
        // Jika model admin Anda berbeda, contoh: return $this->belongsTo(AdminUser::class);
    }
}
