<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get facility IDs
        $workstationId = DB::table('fasilitas')->where('nama_fasilitas', 'Workstation/Laptop')->value('id_fasilitas');
        $internetId = DB::table('fasilitas')->where('nama_fasilitas', 'Internet/Wifi')->value('id_fasilitas');
        $ruangKerjaId = DB::table('fasilitas')->where('nama_fasilitas', 'Ruang Kerja')->value('id_fasilitas');
        $tunjanganMakanId = DB::table('fasilitas')->where('nama_fasilitas', 'Tunjangan Makan')->value('id_fasilitas');
        $tunjanganTransportId = DB::table('fasilitas')->where('nama_fasilitas', 'Tunjangan Transport')->value('id_fasilitas');
        $ruangMeetingId = DB::table('fasilitas')->where('nama_fasilitas', 'Ruang Meeting')->value('id_fasilitas');
        $mentoringId = DB::table('fasilitas')->where('nama_fasilitas', 'Mentoring')->value('id_fasilitas');
        $sertifikatId = DB::table('fasilitas')->where('nama_fasilitas', 'Sertifikat Magang')->value('id_fasilitas');
        $trainingId = DB::table('fasilitas')->where('nama_fasilitas', 'Training/Workshop')->value('id_fasilitas');
        $pantryId = DB::table('fasilitas')->where('nama_fasilitas', 'Pantry/Coffee Corner')->value('id_fasilitas');

        // Get company IDs
        $telkomId = DB::table('perusahaan_mitra')->where('nama_perusahaan_mitra', 'Telkom Indonesia')->value('id_perusahaan_mitra');
        $briId = DB::table('perusahaan_mitra')->where('nama_perusahaan_mitra', 'Bank Rakyat Indonesia (BRI)')->value('id_perusahaan_mitra');
        $gojekId = DB::table('perusahaan_mitra')->where('nama_perusahaan_mitra', 'Gojek')->value('id_perusahaan_mitra');
        $gamatechnoId = DB::table('perusahaan_mitra')->where('nama_perusahaan_mitra', 'PT. Gamatechno Indonesia')->value('id_perusahaan_mitra');
        $sekawanId = DB::table('perusahaan_mitra')->where('nama_perusahaan_mitra', 'Sekawan Media')->value('id_perusahaan_mitra');

        $fasilitasPerusahaan = [
            // Telkom Indonesia
            [
                'id_perusahaan_mitra' => $telkomId,
                'id_fasilitas' => $workstationId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_perusahaan_mitra' => $telkomId,
                'id_fasilitas' => $internetId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_perusahaan_mitra' => $telkomId,
                'id_fasilitas' => $tunjanganMakanId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // BRI
            [
                'id_perusahaan_mitra' => $briId,
                'id_fasilitas' => $workstationId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_perusahaan_mitra' => $briId,
                'id_fasilitas' => $tunjanganMakanId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_perusahaan_mitra' => $briId,
                'id_fasilitas' => $tunjanganTransportId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Gojek
            [
                'id_perusahaan_mitra' => $gojekId,
                'id_fasilitas' => $workstationId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_perusahaan_mitra' => $gojekId,
                'id_fasilitas' => $internetId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_perusahaan_mitra' => $gojekId,
                'id_fasilitas' => $mentoringId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Gamatechno
            [
                'id_perusahaan_mitra' => $gamatechnoId,
                'id_fasilitas' => $workstationId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_perusahaan_mitra' => $gamatechnoId,
                'id_fasilitas' => $trainingId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Sekawan Media
            [
                'id_perusahaan_mitra' => $sekawanId,
                'id_fasilitas' => $workstationId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_perusahaan_mitra' => $sekawanId,
                'id_fasilitas' => $mentoringId,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('fasilitas_perusahaan')->insert($fasilitasPerusahaan);
    }
}
