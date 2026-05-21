<?php

namespace App\Filament\Resources\EducationalLevelResource\Pages;

use App\Filament\Resources\EducationalLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEducationalLevel extends EditRecord
{
    protected static string $resource = EducationalLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
