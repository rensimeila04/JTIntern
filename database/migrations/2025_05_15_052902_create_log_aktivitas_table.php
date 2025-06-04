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
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->time('jam_pulang');
            $table->text('kegiatan');
            $table->text('feedback_dospem')->nullable();
            $table->enum('status_feedback', ['belum_ada', 'sudah_ada'])->default('belum_ada');
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
