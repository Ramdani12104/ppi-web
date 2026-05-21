<?php

namespace App\Filament\Resources\MdtSettingResource\Pages;

use App\Filament\Resources\MdtSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMdtSetting extends EditRecord
{
    protected static string $resource = MdtSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
