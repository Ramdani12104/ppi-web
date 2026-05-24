<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use App\Helpers\MediaHelper;

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
            'landing_gallery_items' => [
                [
                    'image' => '',
                    'title' => 'KBM Kelas Tafsir',
                    'desc' => 'Kegiatan belajar mengajar pendalaman kitab tafsir di masjid utama.'
                ],
                [
                    'image' => '',
                    'title' => 'Latihan Brigade Santri',
                    'desc' => 'Latihan kedisiplinan dan kepanduan rutin mingguan santri.'
                ],
                [
                    'image' => '',
                    'title' => 'Pembiasaan Dzikir Pagi',
                    'desc' => 'Dzikir pagi bersama di selasar asrama sebelum masuk kelas.'
                ]
            ],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Galeri Landing')
                    ->description('Kelola album foto kegiatan santri di landing page')
                    ->schema([
                        TextInput::make('landing_gallery_title')
                            ->label('Judul Section')
                            ->required(),
                        Textarea::make('landing_gallery_desc')
                            ->label('Deskripsi Section')
                            ->rows(3)
                            ->required(),
                        
                        Repeater::make('landing_gallery_items')
                            ->label('Foto-Foto Galeri')
                            ->schema([
                                MediaHelper::imageUpload('image', 'Foto Kegiatan', 'gallery', 'content'),
                                TextInput::make('title')
                                    ->label('Judul Foto')
                                    ->required(),
                                Textarea::make('desc')
                                    ->label('Keterangan / Caption')
                                    ->rows(2),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull()
                    ])
            ])
            ->statePath('data');
    }
}
