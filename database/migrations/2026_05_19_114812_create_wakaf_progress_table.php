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
        Schema::create('wakaf_progresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wakaf_setting_id')->constrained('wakaf_settings')->cascadeOnDelete();
            $table->string('title');
            $table->integer('percentage')->default(0);
            $table->string('status_text')->nullable();
            $table->boolean('is_completed')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wakaf_progresses');
    }
};
