<?php

namespace App\Filament\Resources\SaranaSettingResource\Pages;

use App\Filament\Resources\SaranaSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSaranaSetting extends EditRecord
{
    protected static string $resource = SaranaSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
