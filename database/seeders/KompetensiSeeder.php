<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kompetensi = [
            [
                'nama_kompetensi' => 'Web Development',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kompetensi' => 'Mobile Development',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kompetensi' => 'UI/UX Design',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kompetensi' => 'Database Management',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kompetensi' => 'Backend Development',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kompetensi' => 'Frontend Development',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kompetensi' => 'DevOps',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kompetensi' => 'Machine Learning',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kompetensi' => 'Data Analysis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('kompetensi')->insert($kompetensi);
    }
}
