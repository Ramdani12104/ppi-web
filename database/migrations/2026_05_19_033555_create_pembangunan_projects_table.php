<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembangunan_projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pembangunan_setting_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->bigInteger('target_fund')->default(0);
            $table->bigInteger('collected_fund')->default(0);
            $table->integer('progress_percent')->default(0);
            $table->string('status')->default('Berjalan');
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembangunan_projects');
    }
};
