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
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id('id_lowongan');
            $table->unsignedBigInteger('id_perusahaan_mitra')->index();
            $table->unsignedBigInteger('id_periode_magang')->index();
            $table->string('judul_lowongan');
            $table->text('deskripsi');
            $table->text('persyaratan');
            $table->unsignedBigInteger('id_kompetensi')->index();
            $table->enum('jenis_magang', ['wfo', 'remote', 'hybrid']);
            $table->boolean('status_pendaftaran')->default(true);
            $table->date('deadline_pendaftaran')->nullable();
            $table->boolean('test')->default(false);
            $table->text('informasi_test')->nullable();
            $table->timestamps();

            $table->foreign('id_kompetensi')->references('id_kompetensi')->on('kompetensi');
            $table->foreign('id_perusahaan_mitra')->references('id_perusahaan_mitra')->on('perusahaan_mitra');
            $table->foreign('id_periode_magang')->references('id_periode_magang')->on('periode_magang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
