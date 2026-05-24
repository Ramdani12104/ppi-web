<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\DashboardStats;
use App\Filament\Widgets\ActivityTimelineWidget;
use App\Filament\Widgets\QuickStatsWidget;
use App\Filament\Widgets\RecentNewsWidget;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Dashboard Admin';
    protected static ?int $navigationSort = -2;

    public function getWidgets(): array
    {
        return [
            DashboardStats::class,
            ActivityTimelineWidget::class,
            QuickStatsWidget::class,
            RecentNewsWidget::class,
        ];
    }

    public function getColumns(): int | string | array
    {
        return 2;
    }

    public function getHeaderWidgets(): array
    {
        return [];
    }

    public function getFooterWidgets(): array
    {
        return [];
    }
}
