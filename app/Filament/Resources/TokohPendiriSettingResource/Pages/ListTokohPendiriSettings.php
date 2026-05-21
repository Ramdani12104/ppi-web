<?php

namespace App\Filament\Resources\TokohPendiriSettingResource\Pages;

use App\Filament\Resources\TokohPendiriSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTokohPendiriSettings extends ListRecords
{
    protected static string $resource = TokohPendiriSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
