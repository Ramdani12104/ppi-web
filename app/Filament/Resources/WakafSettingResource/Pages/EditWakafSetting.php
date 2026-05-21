<?php

namespace App\Filament\Resources\WakafSettingResource\Pages;

use App\Filament\Resources\WakafSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWakafSetting extends EditRecord
{
    protected static string $resource = WakafSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
