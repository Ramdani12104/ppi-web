<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_pendiris', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('subjudul')->nullable();
            $table->string('banner')->nullable();
            $table->longText('sejarah_pendiri')->nullable();
            $table->longText('perjalanan_pesantren')->nullable();
            $table->longText('perjuangan_pendiri')->nullable();
            $table->longText('nilai_warisan')->nullable();
            $table->longText('kutipan')->nullable();
            $table->longText('penutup')->nullable();
            $table->boolean('is_publish')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_pendiris');
    }
};
