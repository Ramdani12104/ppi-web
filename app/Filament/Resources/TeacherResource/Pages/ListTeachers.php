<?php

namespace App\Filament\Resources\TeacherResource\Pages;

use App\Filament\Resources\TeacherResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTeachers extends ListRecords
{
    protected static string $resource = TeacherResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => \Filament\Resources\Components\Tab::make('Semua Jenjang'),
            'kober' => \Filament\Resources\Components\Tab::make('KOBER')
                ->modifyQueryUsing(fn ($query) => $query->where('stage', 'kober')),
            'ra' => \Filament\Resources\Components\Tab::make('RA')
                ->modifyQueryUsing(fn ($query) => $query->where('stage', 'ra')),
            'sdit' => \Filament\Resources\Components\Tab::make('SDIT')
                ->modifyQueryUsing(fn ($query) => $query->where('stage', 'sdit')),
            'mdt' => \Filament\Resources\Components\Tab::make('MDT')
                ->modifyQueryUsing(fn ($query) => $query->where('stage', 'mdt')),
            'mts' => \Filament\Resources\Components\Tab::make('MTs')
                ->modifyQueryUsing(fn ($query) => $query->where('stage', 'mts')),
            'ma' => \Filament\Resources\Components\Tab::make('MA')
                ->modifyQueryUsing(fn ($query) => $query->where('stage', 'ma')),
            'musrif_musyrifah' => \Filament\Resources\Components\Tab::make('Musrif & Musyrifah')
                ->modifyQueryUsing(fn ($query) => $query->where('stage', 'musrif_musyrifah')),
            'timqu' => \Filament\Resources\Components\Tab::make('Tim Qur\'an')
                ->modifyQueryUsing(fn ($query) => $query->where('stage', 'timqu')),
            'tendik' => \Filament\Resources\Components\Tab::make('Staf / Tendik')
                ->modifyQueryUsing(fn ($query) => $query->where('stage', 'tendik')),
            'rh' => \Filament\Resources\Components\Tab::make('RH (Raudhatul Huffadz)')
                ->modifyQueryUsing(fn ($query) => $query->where('stage', 'rh')),
        ];
    }
}
