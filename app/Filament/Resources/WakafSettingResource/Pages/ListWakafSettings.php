<?php

namespace App\Filament\Resources\WakafSettingResource\Pages;

use App\Filament\Resources\WakafSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWakafSettings extends ListRecords
{
    protected static string $resource = WakafSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
