<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\NewsPost;

class ActivityTimelineWidget extends Widget
{
    protected static ?int $sort = 2;
    protected static string $view = 'filament.widgets.activity-timeline';
    protected int | string | array $columnSpan = 1;

    public function getActivities(): array
    {
        $recentNews = NewsPost::latest()->take(5)->get();

        $activities = [];

        foreach ($recentNews as $news) {
            $activities[] = [
                'type'    => 'news',
                'icon'    => '📰',
                'color'   => 'blue',
                'title'   => $news->title,
                'subtitle' => 'Berita ' . ($news->is_published ? 'dipublikasikan' : 'disimpan sebagai draft'),
                'time'    => $news->published_at?->diffForHumans() ?? $news->created_at->diffForHumans(),
                'badge'   => $news->is_published ? 'Publish' : 'Draft',
                'badge_color' => $news->is_published ? 'green' : 'yellow',
            ];
        }

        // Add static system activities
        $activities[] = [
            'type'    => 'system',
            'icon'    => '🔧',
            'color'   => 'purple',
            'title'   => 'Sistem diperbarui',
            'subtitle' => 'Update konfigurasi pesantren berhasil',
            'time'    => '3 hari lalu',
            'badge'   => 'Sistem',
            'badge_color' => 'purple',
        ];

        $activities[] = [
            'type'    => 'user',
            'icon'    => '👤',
            'color'   => 'green',
            'title'   => 'Admin login',
            'subtitle' => 'Sesi admin berhasil dimulai',
            'time'    => 'Hari ini',
            'badge'   => 'Auth',
            'badge_color' => 'green',
        ];

        return array_slice($activities, 0, 6);
    }
}
