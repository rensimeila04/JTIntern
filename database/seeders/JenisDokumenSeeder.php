<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisDokumen = [
            [
                'nama' => 'Curriculum Vitae (CV)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Portofolio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sertifikat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Surat Pengantar Magang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Transkrip Nilai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('jenis_dokumen')->insert($jenisDokumen);
    }
}
