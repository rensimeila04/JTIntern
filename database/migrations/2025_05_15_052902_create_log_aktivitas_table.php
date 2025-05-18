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
            $table->text('deskripsi');
            $table->text('feedback')->nullable();
            $table->text('laporan')->nullable();
            $table->text('sikap_penyampaian')->nullable();
            $table->integer('q1')->nullable();
            $table->integer('q2')->nullable();
            $table->integer('q3')->nullable();
            $table->integer('q4')->nullable();
            $table->integer('q5')->nullable();
            $table->integer('q6')->nullable();
            $table->integer('q7')->nullable();
            $table->integer('q8')->nullable();
            $table->date('tanggal')->default(now()->toDateString());
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
