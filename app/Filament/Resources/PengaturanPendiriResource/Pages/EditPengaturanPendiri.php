<?php

namespace App\Filament\Resources\PengaturanPendiriResource\Pages;

use App\Filament\Resources\PengaturanPendiriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPengaturanPendiri extends EditRecord
{
    protected static string $resource = PengaturanPendiriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
