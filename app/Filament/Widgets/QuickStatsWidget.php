<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\NewsPost;
use App\Models\Extracurricular;
use App\Models\Facility;
use App\Models\Testimonial;
use App\Models\Program;

class QuickStatsWidget extends Widget
{
    protected static ?int $sort = 2;
    protected static string $view = 'filament.widgets.quick-stats';
    protected int | string | array $columnSpan = 1;

    public function getStats(): array
    {
        return [
            [
                'label'    => 'Total Berita Publish',
                'value'    => NewsPost::where('is_published', true)->count(),
                'icon'     => '📰',
                'color'    => 'from-blue-500 to-indigo-600',
                'change'   => '+' . NewsPost::whereDate('created_at', '>=', now()->subDays(7))->count() . ' minggu ini',
                'trend'    => 'up',
            ],
            [
                'label'    => 'Berita Headline',
                'value'    => NewsPost::where('is_featured', true)->count(),
                'icon'     => '⭐',
                'color'    => 'from-yellow-500 to-orange-500',
                'change'   => 'Berita unggulan aktif',
                'trend'    => 'neutral',
            ],
            [
                'label'    => 'Ekstrakurikuler',
                'value'    => Extracurricular::count(),
                'icon'     => '🎓',
                'color'    => 'from-emerald-500 to-teal-600',
                'change'   => 'Program aktif',
                'trend'    => 'up',
            ],
            [
                'label'    => 'Fasilitas Pesantren',
                'value'    => Facility::count(),
                'icon'     => '🏫',
                'color'    => 'from-purple-500 to-violet-600',
                'change'   => 'Sarana tersedia',
                'trend'    => 'neutral',
            ],
            [
                'label'    => 'Testimoni Wali',
                'value'    => Testimonial::count(),
                'icon'     => '💬',
                'color'    => 'from-pink-500 to-rose-600',
                'change'   => 'Ulasan masuk',
                'trend'    => 'up',
            ],
            [
                'label'    => 'Draft Berita',
                'value'    => NewsPost::where('is_published', false)->count(),
                'icon'     => '📝',
                'color'    => 'from-slate-500 to-gray-600',
                'change'   => 'Menunggu publish',
                'trend'    => 'neutral',
            ],
        ];
    }
}
