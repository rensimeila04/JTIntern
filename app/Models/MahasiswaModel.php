<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'mahasiswa';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_mahasiswa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'nim',
        'jenis_magang',
        'id_kompetensi',
        'id_program_studi',
        'preferensi_lokasi',
        'latitude_preferensi',
        'longitude_preferensi',
        'id_jenis_perusahaan',
    ];

    /**
     * Get the user that owns the mahasiswa.
     */
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_user', 'id_user');
    }

    /**
     * Get the kompetensi associated with the mahasiswa.
     */
    public function kompetensi()
    {
        return $this->belongsTo(KompetensiModel::class, 'id_kompetensi', 'id_kompetensi');
    }

    /**
     * Get the program studi associated with the mahasiswa.
     */
    public function programStudi()
    {
        return $this->belongsTo(ProgramStudiModel::class, 'id_program_studi', 'id_program_studi');
    }

    /**
     * Get the jenis perusahaan associated with the mahasiswa.
     */
    public function jenisPerusahaan()
    {
        return $this->belongsTo(JenisPerusahaanModel::class, 'id_jenis_perusahaan', 'id_jenis_perusahaan');
    }

    public function magang() {
        return $this->hasMany(MagangModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function JenisDokumen() {
        return $this->hasMany(JenisDokumenModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function feedback() {
        return $this->hasMany(FeedbackModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }

    public function dokumen() {
        return $this->hasMany(DokumenModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}