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
        Schema::create('wakaf_settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_title')->default('Gerakan Wakaf Pendidikan');
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('history_title')->default('Perjalanan Sebuah Amanah');
            $table->text('history_content')->nullable();
            $table->text('history_quote')->nullable();
            $table->string('popup_history_title')->default('Langkah Awal Perjuangan');
            $table->text('popup_history_content')->nullable();
            $table->string('popup_history_image')->nullable();
            $table->string('transparency_title')->default('Amanah yang Terjaga');
            $table->text('transparency_content')->nullable();
            $table->string('bank_name')->default('Bank Syariah Indonesia (BSI)');
            $table->string('bank_account')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('qris_image')->nullable();
            $table->string('closing_title')->default('Menjaga Nyala Harapan Generasi');
            $table->text('closing_content')->nullable();
            $table->string('wa_contact')->nullable();
            $table->boolean('is_publish')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wakaf_settings');
    }
};
