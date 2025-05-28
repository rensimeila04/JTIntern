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
        'logo',
        'latitude',
        'longitude',
    ];

    // Add accessor for logo URL
    public function getLogoUrlAttribute()
    {
        if (str_starts_with($this->logo, 'images/')) {
            // Placeholder image - use asset helper
            return asset($this->logo);
        } else {
            // Uploaded image - use storage helper
            return asset('storage/' . $this->logo);
        }
    }

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
