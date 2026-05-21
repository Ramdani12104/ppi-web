<?php

namespace App\Filament\Resources\WakafProgressResource\Pages;

use App\Filament\Resources\WakafProgressResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWakafProgress extends EditRecord
{
    protected static string $resource = WakafProgressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
