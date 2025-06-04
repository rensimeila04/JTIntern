<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MagangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get mahasiswa IDs
        $mahasiswa1 = DB::table('mahasiswa')->where('nim', '2341720001')->first();
        $mahasiswa2 = DB::table('mahasiswa')->where('nim', '2341720002')->first();
        $mahasiswa3 = DB::table('mahasiswa')->where('nim', '2341720003')->first();
        
        // Get lowongan IDs
        $webDevLowongan = DB::table('lowongan')
            ->where('judul_lowongan', 'Web Developer Intern')
            ->first();
        $mobileDevLowongan = DB::table('lowongan')
            ->where('judul_lowongan', 'Mobile App Developer Intern')
            ->first();
        
        // Get dosen pembimbing IDs
        $dosenWeb = DB::table('dosen_pembimbing')
            ->where('bidang_minat', 'like', '%Web Development%')
            ->first();
        $dosenMobile = DB::table('dosen_pembimbing')
            ->where('bidang_minat', 'like', '%Mobile Development%')
            ->first();

        $magang = [
            [
                'id_mahasiswa' => $mahasiswa1->id_mahasiswa,
                'id_lowongan' => $webDevLowongan->id_lowongan,
                'id_dosen_pembimbing' => $dosenWeb->id_dosen_pembimbing,
                'status_magang' => 'magang',
                'path_sertifikat' => null,
                'path_file_test' => 'test_files/test-magang-2341720001.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => $mahasiswa2->id_mahasiswa,
                'id_lowongan' => $mobileDevLowongan->id_lowongan,
                'id_dosen_pembimbing' => $dosenMobile->id_dosen_pembimbing,
                'status_magang' => 'selesai',
                'path_sertifikat' => 'sertifikat/sertifikat-magang-2341720002.pdf',
                'path_file_test' => 'test_files/test-magang-2341720002.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_mahasiswa' => $mahasiswa3->id_mahasiswa,
                'id_lowongan' => $webDevLowongan->id_lowongan,
                'id_dosen_pembimbing' => $dosenWeb->id_dosen_pembimbing,
                'status_magang' => 'menunggu',
                'path_sertifikat' => null,
                'path_file_test' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('magang')->insert($magang);
    }
}
