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
        'user_id',
        'nip',
        'gender',
        'subject',
        'address',
        'phone',
    ];

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}
