<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenModel extends Model
{
    use HasFactory;

    protected $table = 'dokumen';

    protected $primaryKey = 'id_dokumen';

    protected $fillable = [
        'nama_dokumen',
        'id_jenis_dokumen',
        'id_mahasiswa',
        'path_dokumen',
    ];

    public function jenisDokumen(){
        return $this->belongsTo(JenisDokumenModel::class, 'id_jenis_dokumen', 'id_jenis_dokumen');
    }

    public function mahasiswa(){
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa', 'id_mahasiswa');
    }
}
