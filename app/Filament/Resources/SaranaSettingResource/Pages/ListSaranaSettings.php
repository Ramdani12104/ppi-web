<?php

namespace App\Filament\Resources\SaranaSettingResource\Pages;

use App\Filament\Resources\SaranaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSaranaSettings extends ListRecords
{
    protected static string $resource = SaranaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
