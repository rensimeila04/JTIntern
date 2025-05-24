<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitas = [
            [
                'nama_fasilitas' => 'Workstation/Laptop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Internet/Wifi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Ruang Kerja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Tunjangan Makan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Tunjangan Transport',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Ruang Meeting',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Mentoring',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Sertifikat Magang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Training/Workshop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_fasilitas' => 'Pantry/Coffee Corner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('fasilitas')->insert($fasilitas);
    }
}
