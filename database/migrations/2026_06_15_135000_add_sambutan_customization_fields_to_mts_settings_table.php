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
            $table->string('sambutan_title')->nullable();
            $table->text('sambutan_desc')->nullable();
            $table->text('sambutan_quote')->nullable();
            $table->string('sambutan_media_type')->default('image'); // 'image' or 'video'
            $table->string('sambutan_video_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mts_settings', function (Blueprint $table) {
            $table->dropColumn([
                'sambutan_title',
                'sambutan_desc',
                'sambutan_quote',
                'sambutan_media_type',
                'sambutan_video_url'
            ]);
        });
    }
};
