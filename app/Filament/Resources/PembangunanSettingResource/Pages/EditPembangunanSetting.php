<?php

namespace App\Filament\Resources\PembangunanSettingResource\Pages;

use App\Filament\Resources\PembangunanSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPembangunanSetting extends EditRecord
{
    protected static string $resource = PembangunanSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
