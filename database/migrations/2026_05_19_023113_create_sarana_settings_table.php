<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sarana_settings', function (Blueprint $table) {
            $table->id();
            
            // Hero
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->string('hero_banner')->nullable();
            
            // Pengantar
            $table->string('intro_title')->nullable();
            $table->longText('intro_content')->nullable();
            
            // Lingkungan
            $table->string('env_title')->nullable();
            $table->longText('env_content')->nullable();
            
            // CTA
            $table->string('cta_title')->nullable();
            $table->text('cta_desc')->nullable();
            $table->string('cta_btn')->nullable();
            $table->string('cta_bg')->nullable();
            
            // Toggles
            $table->boolean('is_active_hero')->default(true);
            $table->boolean('is_active_intro')->default(true);
            $table->boolean('is_active_facilities')->default(true);
            $table->boolean('is_active_gallery')->default(true);
            $table->boolean('is_active_env')->default(true);
            $table->boolean('is_active_cta')->default(true);
            
            $table->boolean('is_publish')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sarana_settings');
    }
};
