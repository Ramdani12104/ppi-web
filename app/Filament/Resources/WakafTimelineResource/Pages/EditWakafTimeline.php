<?php

namespace App\Filament\Resources\WakafTimelineResource\Pages;

use App\Filament\Resources\WakafTimelineResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWakafTimeline extends EditRecord
{
    protected static string $resource = WakafTimelineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
