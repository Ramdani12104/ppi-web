<?php

namespace App\Filament\Resources\EducationalLevelResource\Pages;

use App\Filament\Resources\EducationalLevelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEducationalLevels extends ListRecords
{
    protected static string $resource = EducationalLevelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
