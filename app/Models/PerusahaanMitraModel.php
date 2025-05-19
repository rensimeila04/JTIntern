<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerusahaanMitraModel extends Model
{
    use HasFactory;

    protected $table = 'perusahaan_mitra';

    protected $primaryKey = 'id_perusahaan_mitra';

    protected $fillable = [
        'nama_perusahaan_mitra',
        'bidang_industri',
        'id_jenis_perusahaan',
        'alamat',
        'email',
        'telepon',
        'tentang',
    ];

    public function jenisPerusahaan(){
        return $this->belongsTo(JenisPerusahaanModel::class, 'id_jenis_perusahaan', 'id_jenis_perusahaan');
    }

    public function lowongan(){
        return $this->hasMany(LowonganModel::class, 'id_perusahaan_mitra', 'id_perusahaan_mitra');
    }

    public function fasilitasPerusahaan(){
        return $this->hasMany(FasilitasPerusahaanModel::class, 'id_perusahaan_mitra', 'id_perusahaan_mitra');
    }
}
