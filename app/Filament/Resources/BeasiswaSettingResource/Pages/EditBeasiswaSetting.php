<?php

namespace App\Filament\Resources\BeasiswaSettingResource\Pages;

use App\Filament\Resources\BeasiswaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeasiswaSetting extends EditRecord
{
    protected static string $resource = BeasiswaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
