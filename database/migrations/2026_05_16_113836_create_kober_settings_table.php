<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kober_settings', function (Blueprint $table) {
            $table->id();
            
            // Hero
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->string('hero_banner')->nullable();
            $table->string('hero_btn_register')->nullable();
            $table->string('hero_btn_activity')->nullable();
            
            // About
            $table->string('about_title')->nullable();
            $table->longText('about_content')->nullable();
            $table->string('about_image')->nullable();
            
            // Info
            $table->string('info_age')->nullable();
            $table->string('info_schedule')->nullable();
            $table->string('info_facilities')->nullable();
            $table->string('info_contact')->nullable();
            
            // CTA
            $table->string('cta_title')->nullable();
            $table->text('cta_desc')->nullable();
            $table->string('cta_btn')->nullable();
            $table->string('cta_bg')->nullable();
            
            // Appearance Settings
            $table->string('color_primary')->default('#fef3c7'); // Soft amber/yellow
            $table->string('color_button')->default('#f59e0b'); // Amber 500
            $table->string('color_card')->default('#ffffff'); // White
            
            // Toggles
            $table->boolean('is_active_hero')->default(true);
            $table->boolean('is_active_about')->default(true);
            $table->boolean('is_active_programs')->default(true);
            $table->boolean('is_active_gallery')->default(true);
            $table->boolean('is_active_advantages')->default(true);
            $table->boolean('is_active_info')->default(true);
            $table->boolean('is_active_cta')->default(true);
            
            $table->boolean('is_publish')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kober_settings');
    }
};
