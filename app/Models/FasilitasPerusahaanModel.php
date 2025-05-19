<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasPerusahaanModel extends Model
{
    use HasFactory;

    protected $table = 'fasilitas_perusahaan';

    protected $primaryKey = 'id_fasilitas_perusahaan';

    protected $fillable = [
        'id_fasilitas',
        'id_perusahaan_mitra',
    ];

    public function fasilitas(){
        return $this->belongsTo(FasilitasModel::class, 'id_fasilitas', 'id_fasilitas');
    }

    public function perusahaanMitra(){
        return $this->belongsTo(PerusahaanMitraModel::class, 'id_perusahaan_mitra', 'id_perusahaan_mitra');
    }
}
