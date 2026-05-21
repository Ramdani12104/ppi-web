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
        Schema::table('ma_settings', function (Blueprint $table) {
            $table->string('logo')->nullable()->after('id');
            $table->string('hero_heading')->nullable()->after('hero_banner');
            $table->text('hero_subheading')->nullable()->after('hero_heading');
            $table->string('tiktok_link')->nullable()->after('youtube_channel_link');
            $table->string('whatsapp_link')->nullable()->after('tiktok_link');
            $table->string('sejarah_button_text')->nullable()->after('sejarah_ma');
            $table->json('fasilitas')->nullable()->after('sejarah_button_text');
            $table->json('eskul')->nullable()->after('fasilitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ma_settings', function (Blueprint $table) {
            $table->dropColumn(['logo', 'hero_heading', 'hero_subheading', 'tiktok_link', 'whatsapp_link', 'sejarah_button_text', 'fasilitas', 'eskul']);
        });
    }
};
