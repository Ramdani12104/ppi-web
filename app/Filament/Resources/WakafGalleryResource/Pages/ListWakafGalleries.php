<?php

namespace App\Filament\Resources\WakafGalleryResource\Pages;

use App\Filament\Resources\WakafGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWakafGalleries extends ListRecords
{
    protected static string $resource = WakafGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
