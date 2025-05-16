<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id('id_log_aktivitas');
            $table->unsignedBigInteger('id_magang')->index();
            $table->text('deskripsi');
            $table->text('feedback_dospem')->nullable();
            $table->string('nim');
            $table->string('nama_mahasiswa');
            $table->string('prodi');
            $table->string('skema');
            $table->string('tempat_industri');
            $table->text('laporan')->nullable();
            $table->text('sikap_penyampaian')->nullable();
            $table->integer('nilai_komunikasi')->nullable();
            $table->integer('nilai_pengembangan')->nullable();
            $table->integer('nilai_kerja_sama')->nullable();
            $table->integer('nilai_integritas')->nullable();
            $table->integer('nilai_identifikasi_permasalahan')->nullable();
            $table->integer('nilai_analisa_solusi_tik')->nullable();
            $table->integer('nilai_pengembangan_implementasi_tik')->nullable();
            $table->integer('nilai_pengujian_dokumentasi_tik')->nullable();
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('id_magang')->references('id_magang')->on('magang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};
