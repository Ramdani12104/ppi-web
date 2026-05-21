<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('icon')->nullable(); // Emoji or class
            $table->string('color_gradient')->nullable(); // e.g. from-emerald-500 to-emerald-700
            $table->string('type')->default('Jenjang'); // Jenjang or Pesantren
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('programs'); }
};