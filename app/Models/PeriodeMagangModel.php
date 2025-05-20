<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeMagangModel extends Model
{
    use HasFactory;

    protected $table = 'periode_magang';

    protected $primaryKey = 'id_periode_magang';

    protected $fillable = [
        'nama_periode',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public function lowongan() {
        return $this->hasMany(LowonganModel::class, 'id_periode_magang', 'id_periode_magang');
    }
}
