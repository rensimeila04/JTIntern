<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPerusahaanModel extends Model
{
    use HasFactory;

    protected $table = 'jenis_perusahaan';

    protected $primaryKey = 'id_jenis_perusahaan';

    protected $fillable = [
        'nama_jenis_perusahaan',
    ];

    public function mahasiswa() {
        return $this->hasMany(MahasiswaModel::class, 'id_jenis_perusahaan', 'id_jenis_perusahaan');
    }

    public function perusahaanMitra() {
        return $this->hasMany(PerusahaanMitraModel::class, 'id_jenis_perusahaan', 'id_jenis_perusahaan');
    }
}
