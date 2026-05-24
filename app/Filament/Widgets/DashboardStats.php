<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\NewsPost;
use App\Models\Extracurricular;
use App\Models\Facility;
use App\Models\Testimonial;

class DashboardStats extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalBerita = NewsPost::count();
        $beritaPublished = NewsPost::where('is_published', true)->count();
        $totalEskul = Extracurricular::count();
        $totalFasilitas = Facility::count();
        $totalTestimoni = Testimonial::count();

        // Weekly berita count for chart
        $weeklyBerita = collect(range(6, 0))->map(function ($day) {
            return NewsPost::whereDate('created_at', now()->subDays($day))->count();
        })->toArray();

        return [
            Stat::make('Total Berita', $totalBerita)
                ->description($beritaPublished . ' Berita Dipublikasikan')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('primary')
                ->chart($weeklyBerita),

            Stat::make('Ekstrakurikuler', $totalEskul)
                ->description('Program aktif pesantren')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('success')
                ->chart([2, 3, 3, 4, 5, 5, $totalEskul]),

            Stat::make('Fasilitas', $totalFasilitas)
                ->description('Sarana & prasarana tersedia')
                ->descriptionIcon('heroicon-m-building-office-2')
                ->color('warning')
                ->chart([3, 4, 5, 5, 6, 7, $totalFasilitas]),

            Stat::make('Testimoni', $totalTestimoni)
                ->description('Ulasan wali santri')
                ->descriptionIcon('heroicon-m-star')
                ->color('danger')
                ->chart([1, 2, 3, 4, 5, 6, $totalTestimoni]),
        ];
    }
}
