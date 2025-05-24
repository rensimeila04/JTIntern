<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LogAktivitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get magang ID for active intern
        $magangAktif = DB::table('magang')
            ->where('status_magang', 'magang')
            ->first();

        $logAktivitas = [
            [
                'id_magang' => $magangAktif->id_magang,
                'deskripsi' => 'Mengikuti onboarding dan pengenalan tim development',
                'laporan' => 'Hari pertama magang diisi dengan onboarding. Saya diperkenalkan dengan tim development dan environment development yang akan digunakan selama magang.',
                'tanggal' => '2025-07-01',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_magang' => $magangAktif->id_magang,
                'deskripsi' => 'Setup environment dan pembelajaran codebase',
                'laporan' => 'Melakukan setup development environment local dan mempelajari struktur project yang sedang berjalan.',
                'tanggal' => '2025-07-02',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_magang' => $magangAktif->id_magang,
                'deskripsi' => 'Implementasi fitur autentikasi',
                'laporan' => 'Mengerjakan fitur login dan register menggunakan Laravel Breeze. Implementasi mencakup validasi form dan error handling.',
                'tanggal' => '2025-07-03',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_magang' => $magangAktif->id_magang,
                'deskripsi' => 'Testing dan dokumentasi',
                'laporan' => 'Membuat unit test untuk fitur autentikasi dan menulis dokumentasi API menggunakan Swagger.',
                'tanggal' => '2025-07-04',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_magang' => $magangAktif->id_magang,
                'deskripsi' => 'Code review dan perbaikan',
                'laporan' => 'Melakukan perbaikan code berdasarkan feedback dari code review. Perbaikan meliputi optimasi query dan penerapan best practices.',
                'tanggal' => '2025-07-05',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('log_aktivitas')->insert($logAktivitas);
    }
}
