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
        Schema::create('ma_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_banner')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('youtube_link')->nullable();
            $table->json('jurusan')->nullable();
            $table->text('sejarah_ma')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube_channel_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ma_settings');
    }
};
