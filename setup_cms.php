<?php
$dir = __DIR__;

// News Migration
file_put_contents("$dir/database/migrations/2026_04_21_090509_create_news_table.php", "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('news', function (Blueprint \$table) {
            \$table->id();
            \$table->string('title');
            \$table->string('slug')->unique();
            \$table->string('image')->nullable();
            \$table->text('content');
            \$table->date('published_at')->nullable();
            \$table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('news'); }
};");

// Testimonials Migration
file_put_contents("$dir/database/migrations/2026_04_21_090510_create_testimonials_table.php", "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('testimonials', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->string('status'); // e.g. Wali Santri MA
            \$table->text('quote');
            \$table->string('type')->default('Orang Tua'); // Orang Tua / Alumni
            \$table->string('avatar')->nullable();
            \$table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('testimonials'); }
};");

// Programs Migration
file_put_contents("$dir/database/migrations/2026_04_21_090510_create_programs_table.php", "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('programs', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->text('description');
            \$table->string('image')->nullable();
            \$table->string('icon')->nullable(); // Emoji or class
            \$table->string('color_gradient')->nullable(); // e.g. from-emerald-500 to-emerald-700
            \$table->string('type')->default('Jenjang'); // Jenjang or Pesantren
            \$table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('programs'); }
};");

// Extracurriculars Migration
file_put_contents("$dir/database/migrations/2026_04_21_090511_create_extracurriculars_table.php", "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('extracurriculars', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name');
            \$table->string('stages'); // e.g. SDIT, MTS, MA
            \$table->string('icon')->nullable();
            \$table->string('color_classes')->nullable();
            \$table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('extracurriculars'); }
};");

// Settings Migration
file_put_contents("$dir/database/migrations/2026_04_21_090511_create_settings_table.php", "<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('settings', function (Blueprint \$table) {
            \$table->id();
            \$table->string('key')->unique();
            \$table->text('value')->nullable();
            \$table->string('type')->default('text'); // text, image, textarea
            \$table->string('group')->default('general'); // header, footer, general
            \$table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('settings'); }
};");

echo 'Done';
?>
