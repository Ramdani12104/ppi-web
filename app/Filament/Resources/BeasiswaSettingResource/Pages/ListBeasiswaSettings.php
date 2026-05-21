<?php

namespace App\Filament\Resources\BeasiswaSettingResource\Pages;

use App\Filament\Resources\BeasiswaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBeasiswaSettings extends ListRecords
{
    protected static string $resource = BeasiswaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
