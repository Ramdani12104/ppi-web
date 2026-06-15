<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\ColorPicker;
use App\Helpers\MediaHelper;

class ManageHeaderWebsite extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Pengaturan Website';
    protected static ?string $navigationLabel = 'Header Website';
    protected static ?string $title = 'Pengaturan Header Website';
    protected static ?int $navigationSort = 10;

    protected function getSettingKeys(): array
    {
        return [
            'header_title' => 'Pesantren Persatuan Islam 104',
            'header_subtitle' => 'Al-Ittihad Cikajang',
            'header_tagline' => 'Melayani Masyarakat Menuju Ridho Allah',
            'logo_website' => '',
            'logo_mobile' => '',
            'favicon' => '',
            'logo_height' => '80',
            'header_cta_text' => 'PSB 26/27',
            'header_cta_link' => '/kontak',
            'header_menu' => [
                ['label' => 'Beranda', 'url' => '/'],
                ['label' => 'Profil', 'url' => '/profil/sejarah'],
                ['label' => 'Program', 'url' => '/program/kober'],
                ['label' => 'Dukungan', 'url' => '/dukungan'],
                ['label' => 'Berita', 'url' => '/berita'],
                ['label' => 'Kontak', 'url' => '/kontak'],
            ],
            'header_sticky' => true,
            'header_bg_color' => '#ffffff',
            'header_transparent' => false,
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Identitas & Slogan')
                    ->description('Kelola nama lembaga, subjudul, dan semboyan utama website')
                    ->schema([
                        TextInput::make('header_title')
                            ->label('Nama Website / Organisasi')
                            ->required(),
                        TextInput::make('header_subtitle')
                            ->label('Subjudul Website')
                            ->required(),
                        TextInput::make('header_tagline')
                            ->label('Tagline / Slogan')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Logo & Favicon (Format SVG/PNG/JPG/WEBP)')
                    ->description('Prioritaskan format SVG untuk kualitas ketajaman terbaik dan performa ringan')
                    ->schema([
                        MediaHelper::imageUpload('logo_website', 'Logo Desktop', 'website', 'logo'),
                        MediaHelper::imageUpload('logo_mobile', 'Logo Mobile (Opsional)', 'website', 'logo'),
                        MediaHelper::imageUpload('favicon', 'Favicon Website', 'website', 'logo'),
                        TextInput::make('logo_height')
                            ->label('Tinggi Logo (Pixel)')
                            ->numeric()
                            ->default(80)
                            ->suffix('px')
                            ->helperText('Mengatur tinggi logo. Tinggi logo mobile otomatis menyesuaikan (80% dari ukuran desktop).')
                            ->required(),
                    ])->columns(3),

                Section::make('Call to Action (CTA) Header')
                    ->description('Kelola tombol aksi cepat di bagian kanan header')
                    ->schema([
                        TextInput::make('header_cta_text')
                            ->label('Teks Tombol CTA')
                            ->required(),
                        TextInput::make('header_cta_link')
                            ->label('Link Tombol CTA')
                            ->required(),
                    ])->columns(2),

                Section::make('Navigasi Menu Header')
                    ->description('Atur tautan menu utama navigasi website')
                    ->schema([
                        Repeater::make('header_menu')
                            ->label('Item Menu Navigasi')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Nama Menu')
                                    ->required(),
                                TextInput::make('url')
                                    ->label('Tautan / URL')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Section::make('Tampilan & Perilaku Header')
                    ->description('Kelola sticky header, warna latar belakang, dan mode transparan')
                    ->schema([
                        Toggle::make('header_sticky')
                            ->label('Sticky Header (Tetap di atas saat scroll)')
                            ->default(true),
                        Toggle::make('header_transparent')
                            ->label('Transparan saat di posisi paling atas')
                            ->default(false),
                        ColorPicker::make('header_bg_color')
                            ->label('Warna Latar Header')
                            ->default('#ffffff'),
                    ])->columns(3),
            ])
            ->statePath('data');
    }
}
