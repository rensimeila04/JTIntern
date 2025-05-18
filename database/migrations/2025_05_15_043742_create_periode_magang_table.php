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
        Schema::create('periode_magang', function (Blueprint $table) {
            $table->id('id_periode_magang');
            $table->string('nama_periode');
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periode_magang');
    }
};
