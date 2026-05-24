<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add youtube_link to settings tables that don't have it
        if (Schema::hasTable('kober_settings') && !Schema::hasColumn('kober_settings', 'youtube_link')) {
            Schema::table('kober_settings', function (Blueprint $table) {
                $table->string('youtube_link')->nullable()->after('about_image');
            });
        }
        if (Schema::hasTable('ra_settings') && !Schema::hasColumn('ra_settings', 'youtube_link')) {
            Schema::table('ra_settings', function (Blueprint $table) {
                $table->string('youtube_link')->nullable()->after('about_image');
            });
        }
        if (Schema::hasTable('sdit_settings') && !Schema::hasColumn('sdit_settings', 'youtube_link')) {
            Schema::table('sdit_settings', function (Blueprint $table) {
                $table->string('youtube_link')->nullable()->after('about_image');
            });
        }
        if (Schema::hasTable('mdt_settings') && !Schema::hasColumn('mdt_settings', 'youtube_link')) {
            Schema::table('mdt_settings', function (Blueprint $table) {
                $table->string('youtube_link')->nullable()->after('about_image');
            });
        }

        // Add caption and sort_order to galleries
        if (Schema::hasTable('kober_galleries')) {
            Schema::table('kober_galleries', function (Blueprint $table) {
                if (!Schema::hasColumn('kober_galleries', 'caption')) {
                    $table->string('caption')->nullable()->after('image');
                }
                if (!Schema::hasColumn('kober_galleries', 'sort_order')) {
                    $table->integer('sort_order')->default(0)->after('caption');
                }
            });
        }
        if (Schema::hasTable('ra_galleries')) {
            Schema::table('ra_galleries', function (Blueprint $table) {
                if (!Schema::hasColumn('ra_galleries', 'caption')) {
                    $table->string('caption')->nullable()->after('image');
                }
                if (!Schema::hasColumn('ra_galleries', 'sort_order')) {
                    $table->integer('sort_order')->default(0)->after('caption');
                }
            });
        }
        if (Schema::hasTable('sdit_galleries')) {
            Schema::table('sdit_galleries', function (Blueprint $table) {
                if (!Schema::hasColumn('sdit_galleries', 'caption')) {
                    $table->string('caption')->nullable()->after('image');
                }
                if (!Schema::hasColumn('sdit_galleries', 'sort_order')) {
                    $table->integer('sort_order')->default(0)->after('caption');
                }
            });
        }
        if (Schema::hasTable('mdt_galleries')) {
            Schema::table('mdt_galleries', function (Blueprint $table) {
                if (!Schema::hasColumn('mdt_galleries', 'caption')) {
                    $table->string('caption')->nullable()->after('image');
                }
                if (!Schema::hasColumn('mdt_galleries', 'sort_order')) {
                    $table->integer('sort_order')->default(0)->after('caption');
                }
            });
        }

        // Add sort_order to other galleries
        if (Schema::hasTable('tokoh_pendiri_galleries') && !Schema::hasColumn('tokoh_pendiri_galleries', 'sort_order')) {
            Schema::table('tokoh_pendiri_galleries', function (Blueprint $table) {
                $table->integer('sort_order')->default(0)->after('caption');
            });
        }
        if (Schema::hasTable('sarana_galleries') && !Schema::hasColumn('sarana_galleries', 'sort_order')) {
            Schema::table('sarana_galleries', function (Blueprint $table) {
                $table->integer('sort_order')->default(0)->after('caption');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('kober_settings')) {
            Schema::table('kober_settings', function (Blueprint $table) {
                $table->dropColumn('youtube_link');
            });
        }
        if (Schema::hasTable('ra_settings')) {
            Schema::table('ra_settings', function (Blueprint $table) {
                $table->dropColumn('youtube_link');
            });
        }
        if (Schema::hasTable('sdit_settings')) {
            Schema::table('sdit_settings', function (Blueprint $table) {
                $table->dropColumn('youtube_link');
            });
        }
        if (Schema::hasTable('mdt_settings')) {
            Schema::table('mdt_settings', function (Blueprint $table) {
                $table->dropColumn('youtube_link');
            });
        }

        if (Schema::hasTable('kober_galleries')) {
            Schema::table('kober_galleries', function (Blueprint $table) {
                $table->dropColumn(['caption', 'sort_order']);
            });
        }
        if (Schema::hasTable('ra_galleries')) {
            Schema::table('ra_galleries', function (Blueprint $table) {
                $table->dropColumn(['caption', 'sort_order']);
            });
        }
        if (Schema::hasTable('sdit_galleries')) {
            Schema::table('sdit_galleries', function (Blueprint $table) {
                $table->dropColumn(['caption', 'sort_order']);
            });
        }
        if (Schema::hasTable('mdt_galleries')) {
            Schema::table('mdt_galleries', function (Blueprint $table) {
                $table->dropColumn(['caption', 'sort_order']);
            });
        }

        if (Schema::hasTable('tokoh_pendiri_galleries')) {
            Schema::table('tokoh_pendiri_galleries', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
        if (Schema::hasTable('sarana_galleries')) {
            Schema::table('sarana_galleries', function (Blueprint $table) {
                $table->dropColumn('sort_order');
            });
        }
    }
};
