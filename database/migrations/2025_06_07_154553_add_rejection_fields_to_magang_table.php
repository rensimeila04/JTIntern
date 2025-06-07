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
        Schema::table('magang', function (Blueprint $table) {
            $table->text('alasan_penolakan')->nullable()->after('status_magang');
            $table->timestamp('tanggal_diterima')->nullable()->after('alasan_penolakan');
            $table->timestamp('tanggal_ditolak')->nullable()->after('tanggal_diterima');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('magang', function (Blueprint $table) {
            $table->dropColumn(['alasan_penolakan', 'tanggal_diterima', 'tanggal_ditolak']);
        });
    }
};