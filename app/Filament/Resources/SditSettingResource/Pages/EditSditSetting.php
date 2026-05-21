<?php

namespace App\Filament\Resources\SditSettingResource\Pages;

use App\Filament\Resources\SditSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSditSetting extends EditRecord
{
    protected static string $resource = SditSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
