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
            $table->string('kegiatan_media_type')->default('youtube'); // 'youtube', 'embed', 'local'
            $table->text('kegiatan_embed_code')->nullable();
            $table->string('kegiatan_video_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mts_settings', function (Blueprint $table) {
            $table->dropColumn([
                'kegiatan_media_type',
                'kegiatan_embed_code',
                'kegiatan_video_file'
            ]);
        });
    }
};
