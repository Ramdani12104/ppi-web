<?php

namespace App\Filament\Resources\MTsSettingResource\Pages;

use App\Filament\Resources\MTsSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMTsSetting extends EditRecord
{
    protected static string $resource = MTsSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
