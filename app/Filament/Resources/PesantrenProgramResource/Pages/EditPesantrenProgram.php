<?php

namespace App\Filament\Resources\PesantrenProgramResource\Pages;

use App\Filament\Resources\PesantrenProgramResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPesantrenProgram extends EditRecord
{
    protected static string $resource = PesantrenProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
