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
        Schema::create('mts_settings', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_heading')->nullable();
            $table->string('hero_subheading')->nullable();
            $table->string('hero_banner')->nullable();
            $table->string('logo')->nullable();
            
            // Video Profile
            $table->string('youtube_link')->nullable();
            
            // Program Unggulan (Repeater)
            $table->json('program_unggulan')->nullable();
            
            // Sejarah MTs
            $table->text('sejarah_mts')->nullable();
            
            // CTA Pendaftaran
            $table->string('cta_text')->nullable();
            $table->string('cta_link')->nullable();
            
            // Media Sosial
            $table->string('instagram_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube_channel_link')->nullable();
            $table->string('tiktok_link')->nullable();
            $table->string('whatsapp_link')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mts_settings');
    }
};
