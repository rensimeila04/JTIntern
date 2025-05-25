<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get admin user ID from users table
        $adminUserId = DB::table('user')
            ->where('email', 'admin@polinema.ac.id')
            ->value('id_user');

        $admin = [
            [
                'id_user' => $adminUserId,
                'nip' => '199901012024031001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('admin')->insert($admin);
    }
}
