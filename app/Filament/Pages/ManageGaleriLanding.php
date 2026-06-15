<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;

class ManageGaleriLanding extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $navigationLabel = 'Galeri Landing';
    protected static ?string $title = 'Pengaturan Galeri Landing';
    protected static ?int $navigationSort = 90;

    protected function getSettingKeys(): array
    {
        return [
            'landing_gallery_title' => 'Galeri Dokumentasi',
            'landing_gallery_desc' => 'Dokumentasi visual kegiatan belajar mengajar, sarana prasarana, dan dinamika kehidupan santri di Pesantren Persatuan Islam 104 Al-Ittihad Cikajang.',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Galeri Landing')
                    ->description('Kelola judul dan deskripsi section galeri di landing page')
                    ->schema([
                        TextInput::make('landing_gallery_title')
                            ->label('Judul Section')
                            ->required(),
                        Textarea::make('landing_gallery_desc')
                            ->label('Deskripsi Section')
                            ->rows(3)
                            ->required(),
                    ])
            ])
            ->statePath('data');
    }
}
