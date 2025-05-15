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
        Schema::create('fasilitas_perusahaan', function (Blueprint $table) {
            $table->id('id_fasilitas_perusahaan');
            $table->unsignedBigInteger('id_fasilitas')->index();
            $table->unsignedBigInteger('id_perusahaan_mitra')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasilitas_perusahaan');
    }
};
