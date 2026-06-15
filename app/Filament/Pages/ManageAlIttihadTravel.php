<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use App\Helpers\MediaHelper;

class ManageAlIttihadTravel extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $navigationLabel = 'Al-Ittihad Travel';
    protected static ?string $title = 'Pengaturan Al-Ittihad Travel';
    protected static ?int $navigationSort = 46;

    protected function getSettingKeys(): array
    {
        return [
            'travel_hero_title' => 'Al-Ittihad Travel & Transportasi',
            'travel_hero_subtitle' => 'Layanan sewa armada Isuzu Elf Minibus Non-AC dan transportasi terpercaya untuk ziarah, study tour, dan antar-jemput santri.',
            'travel_hero_image' => '',
            'travel_items' => [
                [
                    'name' => 'Isuzu Elf Minibus Non-AC',
                    'image' => '',
                    'features' => 'Kapasitas 19 Kursi, Reclining Seats, Charger Port, Audio Player.',
                    'description' => 'Armada minibus Isuzu Elf Non-AC yang prima, tangguh, dan sangat hemat biaya. Ideal untuk ziarah wali, studi banding, study tour, maupun antar-jemput santri.',
                    'price' => 'Hubungi PIC untuk Tarif Terbaik',
                    'pic_phone' => '083822099034'
                ]
            ],
            'travel_cta_text' => 'Tanya Tarif Sewa Armada',
            'travel_cta_phone' => '083822099034'
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero Banner')
                    ->description('Bagian atas halaman Al-Ittihad Travel')
                    ->schema([
                        TextInput::make('travel_hero_title')
                            ->label('Judul Hero')
                            ->required(),
                        Textarea::make('travel_hero_subtitle')
                            ->label('Subjudul Hero')
                            ->rows(3)
                            ->required(),
                        MediaHelper::imageUpload('travel_hero_image', 'Foto Background Hero', 'website', 'banner'),
                    ])->columns(2),

                Section::make('Daftar Armada & Layanan')
                    ->description('Kelola daftar mobil/armada dan paket layanan transportasi travel')
                    ->schema([
                        Repeater::make('travel_items')
                            ->label('Pilihan Armada/Layanan')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Armada/Layanan')
                                    ->required(),
                                TextInput::make('features')
                                    ->label('Fasilitas & Kapasitas')
                                    ->placeholder('Contoh: Kapasitas 19 Kursi, Audio, Non-AC')
                                    ->required(),
                                MediaHelper::imageUpload('image', 'Foto Armada', 'website', 'content'),
                                Textarea::make('description')
                                    ->label('Deskripsi Lengkap')
                                    ->rows(3)
                                    ->required(),
                                TextInput::make('price')
                                    ->label('Tarif Sewa')
                                    ->placeholder('Contoh: Rp 800.000 / Hari atau Hubungi Kami')
                                    ->required(),
                                TextInput::make('pic_phone')
                                    ->label('Nomor WhatsApp Pemesanan')
                                    ->placeholder('Contoh: 083822099034')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Section::make('Tombol Tanya Umum (CTA)')
                    ->description('Konfigurasi tombol konsultasi/tanya jawab sewa armada umum')
                    ->schema([
                        TextInput::make('travel_cta_text')
                            ->label('Teks Tombol')
                            ->required(),
                        TextInput::make('travel_cta_phone')
                            ->label('Nomor WhatsApp')
                            ->placeholder('Contoh: 083822099034')
                            ->required(),
                    ])->columns(2),
            ])
            ->statePath('data');
    }
}
