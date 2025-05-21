<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanMitraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('perusahaan_mitra')->insert([
            [
                'nama_perusahaan_mitra' => 'Telkom Indonesia',
                'bidang_industri' => 'Telekomunikasi dan IT',
                'id_jenis_perusahaan' => 1,
                'alamat' => 'Bandung, Jawa Barat',
                'email' => 'info@telkom.co.id',
                'telepon' => '021-12345678',
                'tentang' => 'Perusahaan BUMN di bidang telekomunikasi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan_mitra' => 'Bank Rakyat Indonesia (BRI)',
                'bidang_industri' => 'Perbankan dan Keuangan',
                'id_jenis_perusahaan' => 1,
                'alamat' => 'Jakarta Pusat, DKI Jakarta',
                'email' => 'info@bri.co.id',
                'telepon' => '021-87654321',
                'tentang' => 'Perusahaan BUMN di bidang perbankan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan_mitra' => 'Gojek',
                'bidang_industri' => 'Teknologi & Transportasi',
                'id_jenis_perusahaan' => 2,
                'alamat' => 'Jakarta Selatan, DKI Jakarta',
                'email' => 'info@gojek.com',
                'telepon' => '021-11223344',
                'tentang' => 'Startup teknologi transportasi dan layanan digital.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan_mitra' => 'PT. Gamatechno Indonesia',
                'bidang_industri' => 'TI & Smart City',
                'id_jenis_perusahaan' => 3,
                'alamat' => 'Sleman, Yogyakarta',
                'email' => 'info@gamatechno.com',
                'telepon' => '0274-123456',
                'tentang' => 'Software house dan solusi smart city.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan_mitra' => 'Sekawan Media',
                'bidang_industri' => 'Software & Konsultan IT',
                'id_jenis_perusahaan' => 3,
                'alamat' => 'Kota Malang, Jawa Timur',
                'email' => 'info@sekawanmedia.co.id',
                'telepon' => '0341-654321',
                'tentang' => 'Software house dan konsultan IT.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan_mitra' => 'Illiyin Studio',
                'bidang_industri' => 'UI/UX, Branding, Web/App',
                'id_jenis_perusahaan' => 4,
                'alamat' => 'Kota Malang, Jawa Timur',
                'email' => 'info@illiyin.co.id',
                'telepon' => '0341-987654',
                'tentang' => 'Studio desain dan pengembangan aplikasi.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan_mitra' => 'Codespace Indonesia',
                'bidang_industri' => 'Aplikasi & Digital Solusi',
                'id_jenis_perusahaan' => 3,
                'alamat' => 'Kota Malang, Jawa Timur',
                'email' => 'info@codespace.co.id',
                'telepon' => '0341-123987',
                'tentang' => 'Software house dan solusi digital.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan_mitra' => 'Elux Space',
                'bidang_industri' => 'UI/UX, No-Code Dev',
                'id_jenis_perusahaan' => 4,
                'alamat' => 'Kota Malang, Jawa Timur',
                'email' => 'info@eluxspace.com',
                'telepon' => '0341-456789',
                'tentang' => 'Studio desain dan pengembangan no-code.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan_mitra' => 'Codepan Studio',
                'bidang_industri' => 'Pengembangan Software',
                'id_jenis_perusahaan' => 3,
                'alamat' => 'Surabaya, Jawa Timur',
                'email' => 'info@codepanstudio.com',
                'telepon' => '031-123456',
                'tentang' => 'Software house di Surabaya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_perusahaan_mitra' => 'Createch',
                'bidang_industri' => 'Pengembangan Software',
                'id_jenis_perusahaan' => 3,
                'alamat' => 'Surabaya, Jawa Timur',
                'email' => 'info@createch.com',
                'telepon' => '031-654321',
                'tentang' => 'Software house di Surabaya.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
