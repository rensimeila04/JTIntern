<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KompetensiModel extends Model
{
    use HasFactory;

    protected $table = 'kompetensi';

    protected $primaryKey = 'id_kompetensi';

    protected $fillable = [
        'nama_kompetensi'
    ];

    public function mahasiswa(){
        return $this->hasMany(MahasiswaModel::class, 'id_kompetensi', 'id_kompetensi');
    }

    public function lowongan() {
        return $this->hasMany(LowonganModel::class, 'id_kompetensi', 'id_kompetensi');
    }
}
