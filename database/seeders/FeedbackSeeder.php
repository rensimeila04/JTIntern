<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get completed internship data
        $magangSelesai = DB::table('magang')
            ->where('status_magang', 'selesai')
            ->first();

        $feedback = [
            [
                'id_magang' => $magangSelesai->id_magang,
                'id_mahasiswa' => $magangSelesai->id_mahasiswa,
                'komentar' => 'Program magang sangat membantu dalam mengembangkan skill mobile development. Mentor sangat supportif dan banyak memberikan knowledge sharing. Pengalaman menggunakan teknologi terbaru sangat berharga.',
                'rating' => 5,
                'kepuasan_rekomendasi' => 'Sangat Puas',
                'kesesuaian_rekomendasi' => 'Sangat Sesuai',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('feedback')->insert($feedback);
    }
}
