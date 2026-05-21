<?php

namespace App\Filament\Resources\PembangunanSettingResource\Pages;

use App\Filament\Resources\PembangunanSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPembangunanSettings extends ListRecords
{
    protected static string $resource = PembangunanSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
