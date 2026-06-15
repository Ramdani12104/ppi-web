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
        Schema::table('mts_settings', function (Blueprint $table) {
            $table->string('youtube_kegiatan_link')->nullable()->after('youtube_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mts_settings', function (Blueprint $table) {
            $table->dropColumn('youtube_kegiatan_link');
        });
    }
};
