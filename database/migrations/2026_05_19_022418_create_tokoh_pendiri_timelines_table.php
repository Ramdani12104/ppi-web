<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tokoh_pendiri_timelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tokoh_pendiri_setting_id')->constrained()->cascadeOnDelete();
            $table->string('year');
            $table->string('title');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tokoh_pendiri_timelines');
    }
};
