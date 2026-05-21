<?php

namespace App\Filament\Resources\RaSettingResource\Pages;

use App\Filament\Resources\RaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRaSetting extends EditRecord
{
    protected static string $resource = RaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
