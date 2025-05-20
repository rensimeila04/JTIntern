<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programStudi = [
            [
                'kode_prodi' => 'TI',
                'nama_prodi' => 'D-IV Teknik Informatika',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_prodi' => 'SIB',
                'nama_prodi' => 'D-IV Sistem Informasi Bisnis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('program_studi')->insert($programStudi);
    }
}
