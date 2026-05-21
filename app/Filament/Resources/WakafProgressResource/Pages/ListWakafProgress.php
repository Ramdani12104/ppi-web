<?php

namespace App\Filament\Resources\WakafProgressResource\Pages;

use App\Filament\Resources\WakafProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWakafProgress extends ListRecords
{
    protected static string $resource = WakafProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
