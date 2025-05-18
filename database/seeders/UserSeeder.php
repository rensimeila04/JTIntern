<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dapatkan ID untuk setiap level
        $adminLevelId = DB::table('level')->where('kode_level', 'ADM')->value('id_level');
        $dosenLevelId = DB::table('level')->where('kode_level', 'DSP')->value('id_level');
        $mahasiswaLevelId = DB::table('level')->where('kode_level', 'MHS')->value('id_level');

        DB::table('user')->insert([
            [
                'id_level' => $adminLevelId,
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
                'name' => 'Administrator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => $dosenLevelId,
                'email' => 'dosen@example.com',
                'password' => Hash::make('dosen123'),
                'name' => 'Dosen Pembimbing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => $mahasiswaLevelId,
                'email' => 'mahasiswa@example.com',
                'password' => Hash::make('mahasiswa123'),
                'name' => 'Mahasiswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}