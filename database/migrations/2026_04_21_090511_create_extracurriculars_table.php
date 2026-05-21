<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('extracurriculars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('stages'); // e.g. SDIT, MTS, MA
            $table->string('icon')->nullable();
            $table->string('color_classes')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('extracurriculars'); }
};