<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiModel extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $primaryKey = 'id_notifikasi';

    protected $fillable = [
        'id_user',
        'judul_notifikasi',
        'pesan',
    ];

    public function user(){
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }
}
