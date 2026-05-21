<?php

namespace App\Filament\Resources\PengaturanPendiriResource\Pages;

use App\Filament\Resources\PengaturanPendiriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanPendiris extends ListRecords
{
    protected static string $resource = PengaturanPendiriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
