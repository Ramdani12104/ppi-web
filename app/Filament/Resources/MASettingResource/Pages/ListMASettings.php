<?php

namespace App\Filament\Resources\MASettingResource\Pages;

use App\Filament\Resources\MASettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMASettings extends ListRecords
{
    protected static string $resource = MASettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
