<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagangModel extends Model
{
    use HasFactory;

    protected $table = 'magang';

    protected $primaryKey = 'id_magang';

    protected $fillable = [
        'id_mahasiswa',
        'id_lowongan',
        'id_dosen_pembimbing',
        'status_magang',
        'path_sertifikat',
        'path_file_test'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function lowongan()
    {
        return $this->belongsTo(LowonganModel::class, 'id_lowongan', 'id_lowongan');
    }

    public function dosenPembimbing()
    {
        return $this->belongsTo(DosenPembimbingModel::class, 'id_dosen_pembimbing', 'id_dosen_pembimbing');
    }

    public function feedback()
    {
        return $this->hasMany(FeedbackModel::class, 'id_magang', 'id_magang');
    }

    public function logaktivitas()
    {
        return $this->hasMany(LogAktivitasModel::class, 'id_magang', 'id_magang');
    }
}
