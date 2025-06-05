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
        // Nonaktifkan foreign key checks sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Hapus data lama jika ada
        DB::table('jenis_dokumen')->truncate();
        
        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $jenisDokumen = [
            [
                'nama' => 'curriculum vitae',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'portofolio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'sertifikat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'surat pengantar',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'transkip nilai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('jenis_dokumen')->insert($jenisDokumen);
    }
}
