<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackModel extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $primaryKey = 'id_feedback';

    protected $fillable = [
        'id_magang',
        'id_mahasiswa',
        'komentar',
        'rating',
        'kepuasan_rekomendasi',
        'kesesuaian_rekomendasi',
    ];

    public function magang(){
        return $this->belongsTo(MagangModel::class, 'id_magang', 'id_magang');
    }

    public function mahasiswa(){
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
