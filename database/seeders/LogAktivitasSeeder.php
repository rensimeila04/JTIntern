<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LogAktivitasModel;
use App\Models\MagangModel;
use Carbon\Carbon;

class LogAktivitasSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Ambil beberapa ID magang yang ada
        $magangIds = MagangModel::pluck('id_magang')->take(3);

        $kegiatanSample = [
            'Menganalisis kebutuhan sistem informasi perusahaan',
            'Membuat dokumentasi teknis aplikasi web',
            'Melakukan testing pada modul user management',
            'Mengimplementasikan fitur login dan registrasi',
            'Mempelajari framework Laravel dan Vue.js',
            'Membuat database design untuk sistem inventory',
            'Melakukan code review dengan mentor',
            'Presentasi progress mingguan kepada tim',
        ];

        $feedbackSample = [
            'Kerja bagus, tingkatkan lagi dokumentasi kode',
            'Implementasi sudah sesuai dengan requirement',
            'Perlu lebih detail dalam analisis sistem',
            'Testing scenario perlu diperluas lagi',
            null, // belum ada feedback
            'Presentasi cukup baik, tingkatkan confidence',
        ];

        foreach ($magangIds as $magangId) {
            // Buat log aktivitas untuk 2 minggu terakhir
            for ($i = 14; $i >= 1; $i--) {
                $tanggal = Carbon::now()->subDays($i);
                
                // Skip weekend
                if ($tanggal->isWeekend()) {
                    continue;
                }

                $feedback = $feedbackSample[array_rand($feedbackSample)];
                
                LogAktivitasModel::create([
                    'id_magang' => $magangId,
                    'tanggal' => $tanggal->format('Y-m-d'),
                    'jam_masuk' => '08:' . rand(0, 3) . '0:00',
                    'jam_pulang' => '17:' . rand(0, 3) . '0:00',
                    'kegiatan' => $kegiatanSample[array_rand($kegiatanSample)],
                    'feedback_dospem' => $feedback,
                    'status_feedback' => $feedback ? 'sudah_ada' : 'belum_ada',
                ]);
            }
        }
    }
}
