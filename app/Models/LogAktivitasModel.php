<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAktivitasModel extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';

    protected $primaryKey = 'id_log_aktivitas';

    protected $fillable = [
        'id_magang',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'kegiatan',
        'feedback_dospem',
        'status_feedback',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_masuk' => 'datetime:H:i',
        'jam_pulang' => 'datetime:H:i',
    ];

    public function magang()
    {
        return $this->belongsTo(MagangModel::class, 'id_magang', 'id_magang');
    }

    // Accessor untuk format tanggal dengan hari
    public function getTanggalFormatAttribute()
    {
        return $this->tanggal->isoFormat('dddd, DD MMMM YYYY');
    }
}
