<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenPembimbingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosenPembimbing = [
            [
                'id_user' => DB::table('user')->where('email', 'ayu@lecturer.polinema.ac.id')->value('id_user'),
                'nip' => '199001012015042001',
                'bidang_minat' => 'Web Development, Database Management',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => DB::table('user')->where('email', 'bagas@lecturer.polinema.ac.id')->value('id_user'),
                'nip' => '199101012015042002',
                'bidang_minat' => 'Mobile Development, UI/UX Design',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => DB::table('user')->where('email', 'cintya@lecturer.polinema.ac.id')->value('id_user'),
                'nip' => '199201012015042003',
                'bidang_minat' => 'Frontend Development, Web Design',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => DB::table('user')->where('email', 'dimas@lecturer.polinema.ac.id')->value('id_user'),
                'nip' => '199301012015042004',
                'bidang_minat' => 'Backend Development, DevOps',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => DB::table('user')->where('email', 'erlang@lecturer.polinema.ac.id')->value('id_user'),
                'nip' => '199401012015042005',
                'bidang_minat' => 'Data Analysis, Machine Learning',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('dosen_pembimbing')->insert($dosenPembimbing);
    }
}
