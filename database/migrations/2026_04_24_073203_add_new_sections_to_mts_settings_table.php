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
        Schema::table('mts_settings', function (Blueprint $table) {
            // Kenapa Harus Kami (Value Proposition)
            $table->json('keunggulan')->nullable();
            
            // Kurikulum & Program Unggulan Detail
            $table->text('kurikulum_detail')->nullable();
            
            // Galeri Kegiatan
            $table->json('galeri')->nullable();
            
            // Alur Pendaftaran
            $table->json('alur_pendaftaran')->nullable();
            
            // FAQ
            $table->json('faq')->nullable();
            
            // WhatsApp Admin
            $table->string('whatsapp_admin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mts_settings', function (Blueprint $table) {
            $table->dropColumn(['keunggulan', 'kurikulum_detail', 'galeri', 'alur_pendaftaran', 'faq', 'whatsapp_admin']);
        });
    }
};
