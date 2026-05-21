<?php

namespace App\Filament\Resources\WakafTimelineResource\Pages;

use App\Filament\Resources\WakafTimelineResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWakafTimelines extends ListRecords
{
    protected static string $resource = WakafTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
