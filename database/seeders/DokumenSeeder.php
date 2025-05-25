<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get document type IDs
        $cvId = DB::table('jenis_dokumen')
            ->where('nama', 'Curriculum Vitae (CV)')
            ->value('id_jenis_dokumen');

        $portfolioId = DB::table('jenis_dokumen')
            ->where('nama', 'Portofolio')
            ->value('id_jenis_dokumen');

        $sertifikatId = DB::table('jenis_dokumen')
            ->where('nama', 'Sertifikat')
            ->value('id_jenis_dokumen');

        $suratPengantarId = DB::table('jenis_dokumen')
            ->where('nama', 'Surat Pengantar Magang')
            ->value('id_jenis_dokumen');

        $transkripId = DB::table('jenis_dokumen')
            ->where('nama', 'Transkrip Nilai')
            ->value('id_jenis_dokumen');

        // Get mahasiswa data
        $mahasiswa1 = DB::table('mahasiswa')->where('nim', '2341720001')->first();
        $mahasiswa2 = DB::table('mahasiswa')->where('nim', '2341720002')->first();

        $dokumen = [
            // Dokumen mahasiswa 1 (status: magang)
            [
                'nama_dokumen' => 'CV_2341720001',
                'id_jenis_dokumen' => $cvId,
                'id_mahasiswa' => $mahasiswa1->id_mahasiswa,
                'path_dokumen' => 'dokumen/2341720001/cv.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_dokumen' => 'Portfolio_2341720001',
                'id_jenis_dokumen' => $portfolioId,
                'id_mahasiswa' => $mahasiswa1->id_mahasiswa,
                'path_dokumen' => 'dokumen/2341720001/portfolio.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_dokumen' => 'Surat_Pengantar_2341720001',
                'id_jenis_dokumen' => $suratPengantarId,
                'id_mahasiswa' => $mahasiswa1->id_mahasiswa,
                'path_dokumen' => 'dokumen/2341720001/surat_pengantar.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_dokumen' => 'Transkrip_2341720001',
                'id_jenis_dokumen' => $transkripId,
                'id_mahasiswa' => $mahasiswa1->id_mahasiswa,
                'path_dokumen' => 'dokumen/2341720001/transkrip.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Dokumen mahasiswa 2 (status: selesai)
            [
                'nama_dokumen' => 'CV_2341720002',
                'id_jenis_dokumen' => $cvId,
                'id_mahasiswa' => $mahasiswa2->id_mahasiswa,
                'path_dokumen' => 'dokumen/2341720002/cv.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_dokumen' => 'Portfolio_2341720002',
                'id_jenis_dokumen' => $portfolioId,
                'id_mahasiswa' => $mahasiswa2->id_mahasiswa,
                'path_dokumen' => 'dokumen/2341720002/portfolio.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_dokumen' => 'Sertifikat_2341720002',
                'id_jenis_dokumen' => $sertifikatId,
                'id_mahasiswa' => $mahasiswa2->id_mahasiswa,
                'path_dokumen' => 'dokumen/2341720002/sertifikat.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_dokumen' => 'Transkrip_2341720002',
                'id_jenis_dokumen' => $transkripId,
                'id_mahasiswa' => $mahasiswa2->id_mahasiswa,
                'path_dokumen' => 'dokumen/2341720002/transkrip.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('dokumen')->insert($dokumen);
    }
}
