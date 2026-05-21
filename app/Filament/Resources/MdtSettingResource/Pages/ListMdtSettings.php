<?php

namespace App\Filament\Resources\MdtSettingResource\Pages;

use App\Filament\Resources\MdtSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMdtSettings extends ListRecords
{
    protected static string $resource = MdtSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
