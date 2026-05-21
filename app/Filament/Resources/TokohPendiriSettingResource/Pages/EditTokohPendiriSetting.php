<?php

namespace App\Filament\Resources\TokohPendiriSettingResource\Pages;

use App\Filament\Resources\TokohPendiriSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTokohPendiriSetting extends EditRecord
{
    protected static string $resource = TokohPendiriSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
