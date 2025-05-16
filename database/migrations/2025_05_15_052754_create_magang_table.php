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
        Schema::create('magang', function (Blueprint $table) {
            $table->id('id_magang');
            $table->unsignedBigInteger('id_mahasiswa')->index();
            $table->unsignedBigInteger('id_lowongan')->index();
            $table->unsignedBigInteger('id_dosen_pembimbing')->index();
            $table->enum('status_magang', ['menunggu', 'diterima', 'ditolak', 'magang', 'selesai'])->default('menunggu');
            $table->string('path_sertifikat')->nullable();
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_lowongan')->references('id_lowongan')->on('lowongan');
            $table->foreign('id_dosen_pembimbing')->references('id_dosen_pembimbing')->on('dosen_pembimbing');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magang');
    }
};
