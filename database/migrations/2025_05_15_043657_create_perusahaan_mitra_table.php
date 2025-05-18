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
        Schema::create('perusahaan_mitra', function (Blueprint $table) {
            $table->id('id_perusahaan_mitra');
            $table->string('nama_perusahaan_mitra');
            $table->string('bidang_industri');
            $table->unsignedBigInteger('id_jenis_perusahaan')->index();
            $table->string('alamat');
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->text('tentang')->nullable();
            $table->timestamps();

            $table->foreign('id_jenis_perusahaan')->references('id_jenis_perusahaan')->on('jenis_perusahaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaan_mitra');
    }
};
