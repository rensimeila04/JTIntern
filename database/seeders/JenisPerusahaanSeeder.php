<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class JenisPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisPerusahaan = [
            [
                'nama_jenis_perusahaan' => 'BUMN',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_perusahaan' => 'Startup',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_perusahaan' => 'Software House',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_perusahaan' => 'Studio Desain',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('jenis_perusahaan')->insert($jenisPerusahaan);
    }
}
