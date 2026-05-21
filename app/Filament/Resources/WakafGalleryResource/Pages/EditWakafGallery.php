<?php

namespace App\Filament\Resources\WakafGalleryResource\Pages;

use App\Filament\Resources\WakafGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWakafGallery extends EditRecord
{
    protected static string $resource = WakafGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
