<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beasiswa_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            
            $table->string('story_title')->nullable();
            $table->longText('story_content')->nullable();
            
            $table->json('bank_accounts')->nullable();
            $table->string('qris_image')->nullable();
            
            $table->string('cta_title')->nullable();
            $table->text('cta_description')->nullable();
            
            $table->boolean('is_publish')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beasiswa_settings');
    }
};
