<?php

namespace App\Filament\Resources\PesantrenProgramResource\Pages;

use App\Filament\Resources\PesantrenProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPesantrenPrograms extends ListRecords
{
    protected static string $resource = PesantrenProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
