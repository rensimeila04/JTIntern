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
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kompetensi')->nullable()->change();
            $table->string('preferensi_lokasi')->nullable()->change();
            $table->unsignedBigInteger('id_jenis_perusahaan')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kompetensi')->nullable(false)->change();
            $table->string('preferensi_lokasi')->nullable(false)->change();
            $table->unsignedBigInteger('id_jenis_perusahaan')->nullable(false)->change();
        });
    }
};