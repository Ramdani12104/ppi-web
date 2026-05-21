<?php

namespace App\Filament\Resources\MTsSettingResource\Pages;

use App\Filament\Resources\MTsSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMTsSettings extends ListRecords
{
    protected static string $resource = MTsSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
