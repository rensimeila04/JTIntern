<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->boolean('is_read')->default(false)->after('pesan');
        });
    }

    public function down()
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->dropColumn('is_read');
        });
    }
};
