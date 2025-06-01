<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kriteria')->insert([
            [
                'nama_kriteria' => 'Jenis Perusahaan',
                'jenis' => 'benefit',
                'bobot' => 0.416,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kriteria' => 'Kompetensi',
                'jenis' => 'benefit',
                'bobot' => 0.262,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kriteria' => 'Fasilitas',
                'jenis' => 'benefit',
                'bobot' => 0.161,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kriteria' => 'Jenis Magang',
                'jenis' => 'benefit',
                'bobot' => 0.099,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kriteria' => 'Lokasi',
                'jenis' => 'cost',
                'bobot' => 0.062,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}