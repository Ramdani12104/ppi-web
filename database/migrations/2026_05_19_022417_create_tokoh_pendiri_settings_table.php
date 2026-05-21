<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tokoh_pendiri_settings', function (Blueprint $table) {
            $table->id();
            
            // Hero
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->string('hero_banner')->nullable();
            
            // Sejarah
            $table->string('history_title')->nullable();
            $table->longText('history_content')->nullable();
            $table->string('history_image')->nullable();
            
            // Nilai & Warisan
            $table->string('values_title')->nullable();
            $table->longText('values_content')->nullable();
            
            // Kutipan
            $table->string('quote_text')->nullable();
            $table->string('quote_author')->nullable();
            
            // CTA
            $table->string('cta_title')->nullable();
            $table->text('cta_desc')->nullable();
            
            // Appearance
            $table->string('color_primary')->default('#fefaf4'); // cream hangat
            $table->string('color_accent')->default('#2a5f4c'); // hijau islami
            $table->string('color_card')->default('#d6c7b0'); // coklat kitab
            
            $table->boolean('is_publish')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tokoh_pendiri_settings');
    }
};
