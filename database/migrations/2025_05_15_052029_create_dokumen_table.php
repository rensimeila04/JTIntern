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
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->string('nama_dokumen');
            $table->unsignedBigInteger('id_jenis_dokumen')->index();
            $table->unsignedBigInteger('id_mahasiswa')->index();
            $table->string('path_dokumen');

            $table->timestamps();

            $table->foreign('id_jenis_dokumen')->references('id_jenis_dokumen')->on('jenis_dokumen');
            $table->foreign('id_mahasiswa')->references('id_mahasiswa')->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
