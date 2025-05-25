<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get period ID
        $periodeId = DB::table('periode_magang')
            ->where('nama_periode', 'Ganjil 2025/2026')
            ->value('id_periode_magang');

        // Get competency IDs
        $webDevId = DB::table('kompetensi')
            ->where('nama_kompetensi', 'Web Development')
            ->value('id_kompetensi');

        $mobileDevId = DB::table('kompetensi')
            ->where('nama_kompetensi', 'Mobile Development')
            ->value('id_kompetensi');

        $uiuxId = DB::table('kompetensi')
            ->where('nama_kompetensi', 'UI/UX Design')
            ->value('id_kompetensi');

        // Get company IDs
        $telkomId = DB::table('perusahaan_mitra')
            ->where('nama_perusahaan_mitra', 'Telkom Indonesia')
            ->value('id_perusahaan_mitra');

        $gojekId = DB::table('perusahaan_mitra')
            ->where('nama_perusahaan_mitra', 'Gojek')
            ->value('id_perusahaan_mitra');

        $illiyinId = DB::table('perusahaan_mitra')
            ->where('nama_perusahaan_mitra', 'Illiyin Studio')
            ->value('id_perusahaan_mitra');

        $lowongan = [
            [
                'id_perusahaan_mitra' => $telkomId,
                'id_periode_magang' => $periodeId,
                'judul_lowongan' => 'Web Developer Intern',
                'deskripsi' => 'Pengembangan dan pemeliharaan aplikasi web perusahaan menggunakan teknologi terkini.',
                'persyaratan' => "- Mahasiswa aktif semester 6-7\n- Menguasai HTML, CSS, JavaScript\n- Familiar dengan framework Laravel/React\n- IPK minimal 3.00",
                'id_kompetensi' => $webDevId,
                'jenis_magang' => 'wfo',
                'status_pendaftaran' => true,
                'deadline_pendaftaran' => '2025-06-30',
                'test' => true,
                'informasi_test' => 'Technical test dan interview akan dilakukan secara online',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_perusahaan_mitra' => $gojekId,
                'id_periode_magang' => $periodeId,
                'judul_lowongan' => 'Mobile App Developer Intern',
                'deskripsi' => 'Develop dan maintain fitur aplikasi mobile Gojek menggunakan Flutter/React Native.',
                'persyaratan' => "- Mahasiswa aktif semester 6-7\n- Menguasai Flutter/React Native\n- Memahami konsep REST API\n- IPK minimal 3.25",
                'id_kompetensi' => $mobileDevId,
                'jenis_magang' => 'hybrid',
                'status_pendaftaran' => true,
                'deadline_pendaftaran' => '2025-06-25',
                'test' => true,
                'informasi_test' => 'Coding test, system design discussion, dan culture fit interview',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_perusahaan_mitra' => $illiyinId,
                'id_periode_magang' => $periodeId,
                'judul_lowongan' => 'UI/UX Designer Intern',
                'deskripsi' => 'Merancang dan mengembangkan user interface dan experience untuk aplikasi klien.',
                'persyaratan' => "- Mahasiswa aktif semester 6-7\n- Menguasai Figma/Adobe XD\n- Memiliki portfolio desain\n- IPK minimal 3.00",
                'id_kompetensi' => $uiuxId,
                'jenis_magang' => 'remote',
                'status_pendaftaran' => true,
                'deadline_pendaftaran' => '2025-06-20',
                'test' => false,
                'informasi_test' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('lowongan')->insert($lowongan);
    }
}
