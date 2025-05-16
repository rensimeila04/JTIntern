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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id('id_feedback');
            $table->unsignedBigInteger('id_magang')->index();
            $table->unsignedBigInteger('id_mahasiswa')->index();
            $table->text('komentar')->nullable();
            $table->unsignedTinyInteger('rating'); 
            $table->enum('kepuasan_rekomendasi', ['Sangat Puas', 'Puas', 'Netral', 'Tidak Puas', 'Sangat Tidak Puas']);
            $table->enum('kesesuaian_rekomendasi', ['Sangat Sesuai', 'Sesuai', 'Cukup Sesuai', 'Kurang Sesuai', 'Tidak Sesuai']);
            $table->timestamps();

            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
            $table->foreign('id_magang')->references('id_magang')->on('magang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
