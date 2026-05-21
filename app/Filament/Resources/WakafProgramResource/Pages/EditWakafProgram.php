<?php

namespace App\Filament\Resources\WakafProgramResource\Pages;

use App\Filament\Resources\WakafProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWakafProgram extends EditRecord
{
    protected static string $resource = WakafProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
