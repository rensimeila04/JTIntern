<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perusahaan_mitra', function (Blueprint $table) {
            $table->string('logo')->default('images/placeholder_perusahaan.png')->after('tentang');
            $table->decimal('latitude', 10, 8)->nullable()->after('logo');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
        });
    }

    public function down(): void
    {
        Schema::table('perusahaan_mitra', function (Blueprint $table) {
            $table->dropColumn(['logo', 'latitude', 'longitude']);
        });
    }
};