<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get program studi ID
        $tiProdiId = DB::table('program_studi')
            ->where('kode_prodi', 'TI')
            ->value('id_program_studi');

        // Get random kompetensi IDs
        $webDevId = DB::table('kompetensi')
            ->where('nama_kompetensi', 'Web Development')
            ->value('id_kompetensi');

        $mobileDevId = DB::table('kompetensi')
            ->where('nama_kompetensi', 'Mobile Development')
            ->value('id_kompetensi');

        // Get jenis perusahaan IDs
        $startupId = DB::table('jenis_perusahaan')
            ->where('nama_jenis_perusahaan', 'Startup')
            ->value('id_jenis_perusahaan');

        $softwareHouseId = DB::table('jenis_perusahaan')
            ->where('nama_jenis_perusahaan', 'Software House')
            ->value('id_jenis_perusahaan');

        $mahasiswa = [
            [
                'id_user' => DB::table('user')->where('email', '2341720001@student.polinema.ac.id')->value('id_user'),
                'nim' => '2341720001',
                'jenis_magang' => 'wfo',
                'id_kompetensi' => $webDevId,
                'id_program_studi' => $tiProdiId,
                'preferensi_lokasi' => 'Malang',
                'id_jenis_perusahaan' => $softwareHouseId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => DB::table('user')->where('email', '2341720002@student.polinema.ac.id')->value('id_user'),
                'nim' => '2341720002',
                'jenis_magang' => 'hybrid',
                'id_kompetensi' => $mobileDevId,
                'id_program_studi' => $tiProdiId,
                'preferensi_lokasi' => 'Surabaya',
                'id_jenis_perusahaan' => $startupId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => DB::table('user')->where('email', '2341720003@student.polinema.ac.id')->value('id_user'),
                'nim' => '2341720003',
                'jenis_magang' => 'remote',
                'id_kompetensi' => $webDevId,
                'id_program_studi' => $tiProdiId,
                'preferensi_lokasi' => 'Jakarta',
                'id_jenis_perusahaan' => $startupId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => DB::table('user')->where('email', '2341720004@student.polinema.ac.id')->value('id_user'),
                'nim' => '2341720004',
                'jenis_magang' => 'wfo',
                'id_kompetensi' => $mobileDevId,
                'id_program_studi' => $tiProdiId,
                'preferensi_lokasi' => 'Yogyakarta',
                'id_jenis_perusahaan' => $softwareHouseId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => DB::table('user')->where('email', '2341720005@student.polinema.ac.id')->value('id_user'),
                'nim' => '2341720005',
                'jenis_magang' => 'hybrid',
                'id_kompetensi' => $webDevId,
                'id_program_studi' => $tiProdiId,
                'preferensi_lokasi' => 'Bandung',
                'id_jenis_perusahaan' => $softwareHouseId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('mahasiswa')->insert($mahasiswa);
    }
}
