<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('level')->insert([
            [
                'kode_level' => 'ADM',
                'nama_level' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_level' => 'DSP',
                'nama_level' => 'Dosen Pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_level' => 'MHS',
                'nama_level' => 'Mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}