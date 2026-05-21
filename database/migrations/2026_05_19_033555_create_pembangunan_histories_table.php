<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembangunan_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembangunan_setting_id')->constrained()->cascadeOnDelete();
            $table->string('year')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('Selesai');
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembangunan_histories');
    }
};
