<?php

namespace App\Filament\Resources\KoberSettingResource\Pages;

use App\Filament\Resources\KoberSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKoberSettings extends ListRecords
{
    protected static string $resource = KoberSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
