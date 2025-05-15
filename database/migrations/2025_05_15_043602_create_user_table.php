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
        Schema::create('user', function (Blueprint $table) {
            $table->id('id_user');
            $table->unsignedBigInteger('id_level')->index();
            $table->string('email_user')->unique();
            $table->string('password_user');
            $table->string('nama_user', 100);
            $table->timestamps();

            $table->foreign('id_level')->references('id_level')->on('level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
