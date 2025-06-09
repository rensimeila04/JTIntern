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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('id_mahasiswa');
            $table->unsignedBigInteger('id_user')->index();
            $table->string('nim')->unique()->nullable();
            $table->enum('jenis_magang', ['wfo', 'remote', 'hybrid'])->nullable();
            $table->unsignedBigInteger('id_kompetensi')->index();
            $table->unsignedBigInteger('id_program_studi')->index();
            $table->string('preferensi_lokasi');
            $table->decimal('latitude_preferensi', 10, 8)->nullable();
            $table->decimal('longitude_preferensi', 11, 8)->nullable();
            $table->unsignedBigInteger('id_jenis_perusahaan')->index();
            $table->unsignedBigInteger('id_kompetensi')->index()->nullable();
            $table->unsignedBigInteger('id_program_studi')->index()->nullable();
            $table->string('preferensi_lokasi')->nullable();
            $table->unsignedBigInteger('id_jenis_perusahaan')->index()->nullable();
            $table->timestamps();


            $table->foreign('id_user')->references('id_user')->on('user');
            $table->foreign('id_kompetensi')->references('id_kompetensi')->on('kompetensi');
            $table->foreign('id_jenis_perusahaan')->references('id_jenis_perusahaan')->on('jenis_perusahaan');
            $table->foreign('id_program_studi')->references('id_program_studi')->on('program_studi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
