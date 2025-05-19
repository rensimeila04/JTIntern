<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudiModel extends Model
{
    use HasFactory;

    protected $table = 'program_studi';

    protected $primaryKey = 'id_program_studi';

    protected $fillable = [
        'kode_prodi',
        'nama_prodi',
    ];

    public function mahasiswa() {
        return $this->hasMany(MahasiswaModel::class, 'id_program_studi', 'id_program_studi');
    }
}
