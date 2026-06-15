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
            $table->string('hero_image_1')->nullable();
            $table->string('hero_image_2')->nullable();
            $table->string('hero_image_3')->nullable();
            $table->string('hero_small_text')->nullable();
            $table->string('hero_button_text')->nullable();
            $table->string('hero_button_link')->nullable();
            $table->string('hero_font_size')->nullable();
            $table->string('hero_text_position')->nullable();
            $table->string('hero_overlay_opacity')->nullable();
        });

        Schema::table('mts_settings', function (Blueprint $table) {
            $table->string('hero_image_1')->nullable();
            $table->string('hero_image_2')->nullable();
            $table->string('hero_image_3')->nullable();
            $table->string('hero_small_text')->nullable();
            $table->string('hero_button_text')->nullable();
            $table->string('hero_button_link')->nullable();
            $table->string('hero_font_size')->nullable();
            $table->string('hero_text_position')->nullable();
            $table->string('hero_overlay_opacity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ma_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image_1',
                'hero_image_2',
                'hero_image_3',
                'hero_small_text',
                'hero_button_text',
                'hero_button_link',
                'hero_font_size',
                'hero_text_position',
                'hero_overlay_opacity'
            ]);
        });

        Schema::table('mts_settings', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image_1',
                'hero_image_2',
                'hero_image_3',
                'hero_small_text',
                'hero_button_text',
                'hero_button_link',
                'hero_font_size',
                'hero_text_position',
                'hero_overlay_opacity'
            ]);
        });
    }
};
