<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beasiswa_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beasiswa_setting_id')->constrained()->cascadeOnDelete();
            $table->string('program_name');
            $table->bigInteger('target_fund')->default(0);
            $table->bigInteger('collected_fund')->default(0);
            $table->integer('receiver_count')->default(0);
            $table->integer('progress_percent')->default(0);
            $table->string('status')->default('Berjalan');
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beasiswa_histories');
    }
};
