<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;

class ManageDukunganPendidikan extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';
    protected static ?string $navigationLabel = 'Dukungan Pendidikan';
    protected static ?string $title = 'Pengaturan Dukungan Pendidikan';
    protected static ?int $navigationSort = 50;

    protected function getSettingKeys(): array
    {
        return [
            'landing_support_title' => 'Menjadi Bagian dari Perjuangan Pendidikan Islam',
            'landing_support_desc' => 'Pesantren ini tumbuh dari semangat dakwah, keikhlasan, dan gotong royong. Mari bersama merajut amal jariyah demi melahirkan generasi peradaban yang berakhlak mulia.',
            'landing_support_cards' => [
                [
                    'icon' => '🏗️',
                    'title' => 'Pembangunan Sarana',
                    'desc' => 'Bantu hadirkan ruang kelas, asrama, dan fasilitas belajar yang lebih nyaman agar santri bisa beribadah dan menuntut ilmu dengan optimal.',
                    'link' => '/dukungan/pembangunan'
                ],
                [
                    'icon' => '🎓',
                    'title' => 'Beasiswa Santri',
                    'desc' => 'Jadilah jalan kemudahan bagi santri berprestasi dan dhuafa. Dukungan Anda menjaga semangat mereka untuk terus menghafal dan belajar.',
                    'link' => '/dukungan/beasiswa'
                ],
                [
                    'icon' => '📖',
                    'title' => 'Wakaf Pendidikan',
                    'desc' => 'Salurkan wakaf tunai maupun aset untuk mendukung operasional dakwah pesantren. Amal yang pahalanya terus mengalir abadi.',
                    'link' => '/dukungan'
                ]
            ],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Dukungan Pendidikan')
                    ->description('Kelola ajakan dan opsi kontribusi dukungan pendidikan')
                    ->schema([
                        TextInput::make('landing_support_title')
                            ->label('Judul Section')
                            ->required(),
                        Textarea::make('landing_support_desc')
                            ->label('Deskripsi Section')
                            ->rows(3)
                            ->required(),
                        
                        Repeater::make('landing_support_cards')
                            ->label('Daftar Opsi Dukungan')
                            ->schema([
                                TextInput::make('icon')
                                    ->label('Emoji / Icon')
                                    ->required(),
                                TextInput::make('title')
                                    ->label('Judul Card')
                                    ->required(),
                                Textarea::make('desc')
                                    ->label('Deskripsi Singkat')
                                    ->rows(2)
                                    ->required(),
                                TextInput::make('link')
                                    ->label('Link Aksi')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => ($state['icon'] ?? '') . ' ' . ($state['title'] ?? ''))
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull()
                    ])
            ])
            ->statePath('data');
    }
}
