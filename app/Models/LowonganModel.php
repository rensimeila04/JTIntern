<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LowonganModel extends Model
{
    use HasFactory;

    protected $table = 'lowongan';

    protected $primaryKey = 'id_lowongan';

    protected $fillable = [
        'id_perusahaan_mitra',
        'id_periode_magang',
        'judul_lowongan',
        'deskripsi',
        'persyaratan',
        'id_kompetensi',
        'jenis_magang',
        'status_pendaftaran',
        'deadline_pendaftaran',
        'test',
        'informasi_test',
    ];

    public function perusahaanMitra() {
        return $this->belongsTo(PerusahaanMitraModel::class, 'id_perusahaan_mitra', 'id_perusahaan_mitra');
    }

    public function periodeMagang() {
        return $this->belongsTo(PeriodeMagangModel::class, 'id_periode_magang', 'id_periode_magang');
    }

    public function kompetensi() {
        return $this->belongsTo(KompetensiModel::class, 'id_kompetensi', 'id_kompetensi');
    }

    public function magang() {
        return $this->hasMany(MagangModel::class, 'id_lowongan', 'id_lowongan');
    }
}
