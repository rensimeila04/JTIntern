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
        'deskripsi',
        'feedback',
        'laporan',
        'sikap_penyampaian',
        'q1',
        'q2',
        'q3',
        'q4',
        'q5',
        'q6',
        'q7',
        'q8',
        'tanggal',
    ];

    public function magang(){
        return $this->belongsTo(MagangModel::class, 'id_magang', 'id_magang');
    }
}
