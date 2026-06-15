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
            $table->text('hero_stats')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('accent_color')->nullable();
            $table->string('hero_small_text_color')->nullable();
            $table->string('hero_heading_color')->nullable();
            $table->string('hero_subheading_color')->nullable();
            $table->string('hero_stats_color')->nullable();
            $table->string('hero_small_font_size')->nullable();
            $table->string('hero_subheading_font_size')->nullable();
            $table->string('hero_stats_font_size')->nullable();
        });

        Schema::table('mts_settings', function (Blueprint $table) {
            $table->text('hero_stats')->nullable();
            $table->string('primary_color')->nullable();
            $table->string('accent_color')->nullable();
            $table->string('hero_small_text_color')->nullable();
            $table->string('hero_heading_color')->nullable();
            $table->string('hero_subheading_color')->nullable();
            $table->string('hero_stats_color')->nullable();
            $table->string('hero_small_font_size')->nullable();
            $table->string('hero_subheading_font_size')->nullable();
            $table->string('hero_stats_font_size')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ma_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_stats',
                'primary_color',
                'accent_color',
                'hero_small_text_color',
                'hero_heading_color',
                'hero_subheading_color',
                'hero_stats_color',
                'hero_small_font_size',
                'hero_subheading_font_size',
                'hero_stats_font_size',
            ]);
        });

        Schema::table('mts_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_stats',
                'primary_color',
                'accent_color',
                'hero_small_text_color',
                'hero_heading_color',
                'hero_subheading_color',
                'hero_stats_color',
                'hero_small_font_size',
                'hero_subheading_font_size',
                'hero_stats_font_size',
            ]);
        });
    }
};
