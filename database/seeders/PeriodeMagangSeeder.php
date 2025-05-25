<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeMagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $periodeMagang = [
            [
                'nama_periode' => 'Ganjil 2025/2026',
                'tanggal_mulai' => '2025-07-01 00:00:00',
                'tanggal_selesai' => '2025-12-31 23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_periode' => 'Genap 2025/2026',
                'tanggal_mulai' => '2026-02-01 00:00:00',
                'tanggal_selesai' => '2026-07-31 23:59:59',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('periode_magang')->insert($periodeMagang);
    }
}
