<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get user IDs
        $adminId = DB::table('user')
            ->where('email', 'admin@polinema.ac.id')
            ->value('id_user');

        $dosenId = DB::table('user')
            ->where('email', 'ayu@lecturer.polinema.ac.id')
            ->value('id_user');

        $mahasiswaId = DB::table('user')
            ->where('email', '2341720001@student.polinema.ac.id')
            ->value('id_user');

        $notifikasi = [
            // Notifikasi untuk Admin
            [
                'id_user' => $adminId,
                'judul_notifikasi' => 'Pendaftaran Magang Baru',
                'pesan' => 'Ada pendaftaran magang baru yang perlu diverifikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => $adminId,
                'judul_notifikasi' => 'Dokumen Baru Diunggah',
                'pesan' => 'Mahasiswa telah mengunggah dokumen baru yang memerlukan verifikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Notifikasi untuk Dosen
            [
                'id_user' => $dosenId,
                'judul_notifikasi' => 'Log Aktivitas Baru',
                'pesan' => 'Mahasiswa bimbingan Anda telah mengirimkan log aktivitas harian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => $dosenId,
                'judul_notifikasi' => 'Pengajuan Bimbingan',
                'pesan' => 'Anda mendapat permintaan bimbingan dari mahasiswa magang',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Notifikasi untuk Mahasiswa
            [
                'id_user' => $mahasiswaId,
                'judul_notifikasi' => 'Status Pendaftaran',
                'pesan' => 'Pendaftaran magang Anda telah disetujui',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => $mahasiswaId,
                'judul_notifikasi' => 'Feedback Dosen',
                'pesan' => 'Dosen pembimbing telah memberikan feedback pada log aktivitas Anda',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('notifikasi')->insert($notifikasi);
    }
}
