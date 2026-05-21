<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Employees', '12600')
                ->description('+2% from last quarter')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Job Application', '1186')
                ->description('+15% from last quarter')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([4, 10, 5, 12, 8, 14, 20]),
            Stat::make('New Employees', '22')
                ->description('+2% from last quarter')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([2, 5, 2, 8, 5, 12, 10]),
            Stat::make('Satisfaction Rate', '89.9%')
                ->description('+5% from last quarter')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([5, 8, 7, 10, 12, 15, 15]),
        ];
    }
}
