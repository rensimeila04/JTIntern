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

        $users = [
            // Admin
            [
                'id_level' => $adminLevelId,
                'email' => 'admin@polinema.ac.id',
                'password' => Hash::make('admin123'),
                'name' => 'Rizky Wahyu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Dosen
            [
                'id_level' => $dosenLevelId,
                'email' => 'ayu@lecturer.polinema.ac.id',
                'password' => Hash::make('dosen123'),
                'name' => 'Ayu Maharani',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => $dosenLevelId,
                'email' => 'bagas@lecturer.polinema.ac.id',
                'password' => Hash::make('dosen123'),
                'name' => 'Bagas Nugroho',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => $dosenLevelId,
                'email' => 'cintya@lecturer.polinema.ac.id',
                'password' => Hash::make('dosen123'),
                'name' => 'Cintya Hanna',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => $dosenLevelId,
                'email' => 'dimas@lecturer.polinema.ac.id',
                'password' => Hash::make('dosen123'),
                'name' => 'Dimas Aji',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => $dosenLevelId,
                'email' => 'erlang@lecturer.polinema.ac.id',
                'password' => Hash::make('dosen123'),
                'name' => 'Erlangga Setiawan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Mahasiswa
            [
                'id_level' => $mahasiswaLevelId,
                'email' => '2341720001@student.polinema.ac.id',
                'password' => Hash::make('mahasiswa123'),
                'name' => 'Atthalaric Nero. M',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => $mahasiswaLevelId,
                'email' => '2341720002@student.polinema.ac.id',
                'password' => Hash::make('mahasiswa123'),
                'name' => 'Chiko Abilla Basya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => $mahasiswaLevelId,
                'email' => '2341720003@student.polinema.ac.id',
                'password' => Hash::make('mahasiswa123'),
                'name' => 'Leon Shan Yoedha Adjie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => $mahasiswaLevelId,
                'email' => '2341720004@student.polinema.ac.id',
                'password' => Hash::make('mahasiswa123'),
                'name' => 'Rafa Fadil Aras',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_level' => $mahasiswaLevelId,
                'email' => '2341720005@student.polinema.ac.id',
                'password' => Hash::make('mahasiswa123'),
                'name' => 'Rensi Meila Yulvinata',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('user')->insert($users);
    }
}