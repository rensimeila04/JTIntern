<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LevelSeeder::class,
            UserSeeder::class,
            ProgramStudiSeeder::class,
            JenisPerusahaanSeeder::class,
            JenisDokumenSeeder::class,
            FasilitasSeeder::class,
            PerusahaanMitraSeeder::class,
            KompetensiSeeder::class,
            AdminSeeder::class,
            MahasiswaSeeder::class,
            DosenPembimbingSeeder::class,
            FasilitasPerusahaanSeeder::class,
            DokumenSeeder::class,
            PeriodeMagangSeeder::class,
            LowonganSeeder::class,
            MagangSeeder::class,
            LogAktivitasSeeder::class,
            FeedbackSeeder::class,
            NotifikasiSeeder::class,
        ]);
    }
}
