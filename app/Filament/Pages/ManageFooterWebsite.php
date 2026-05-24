<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use App\Helpers\MediaHelper;

class ManageFooterWebsite extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-bars-3-bottom-left';
    protected static ?string $navigationGroup = 'Pengaturan Website';
    protected static ?string $navigationLabel = 'Footer Website';
    protected static ?string $title = 'Pengaturan Footer Website';
    protected static ?int $navigationSort = 20;

    protected function getSettingKeys(): array
    {
        return [
            'footer_logo' => '',
            'footer_desc' => 'Membangun generasi Tafaqquh Fiddin yang unggul, beradab, dan berwawasan luas sesuai Al-Qur\'an dan Sunnah.',
            'footer_address' => 'Pesantren Persatuan Islam 104 Cikajang, Kp. Rancapandan, Ds. Mekarjaya, Kec. Cikajang, Kabupaten Garut, Jawa Barat 44171.',
            'footer_phone' => '+6283822099034',
            'footer_email' => 'info@alittihad104.sch.id',
            'footer_copyright' => '© 2026 PPI 104 Al-Ittihad Cikajang. All rights reserved.',
            'footer_socials' => [
                ['platform' => 'Facebook', 'url' => '#'],
                ['platform' => 'Instagram', 'url' => '#'],
                ['platform' => 'YouTube', 'url' => '#'],
            ],
            'footer_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.128711311545!2d107.75626247395026!3d-7.45097457342898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e669da7cfc90421%3A0x68c60abeabbaca8c!2sPesantren%20Persatuan%20Islam%20104%20Cikajang!5e0!3m2!1sid!2sid!4v1713686000000!5m2!1sid!2sid',
            'footer_menu' => [
                ['label' => 'Beranda', 'url' => '/'],
                ['label' => 'Program Pendidikan', 'url' => '/program/kober'],
                ['label' => 'Pendaftaran (PSB)', 'url' => '/kontak'],
                ['label' => 'Profil Pesantren', 'url' => '/profil/sejarah'],
            ]
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Logo & Deskripsi')
                    ->description('Kelola identitas utama footer')
                    ->schema([
                        MediaHelper::imageUpload('footer_logo', 'Logo Footer (Format SVG/PNG/JPG/WEBP)', 'website', 'logo'),
                        Textarea::make('footer_desc')
                            ->label('Deskripsi Pendek Footer')
                            ->rows(3)
                            ->required(),
                    ])->columns(2),

                Section::make('Informasi Kontak & Peta')
                    ->description('Kelola detail kontak dan alamat pesantren di kaki halaman')
                    ->schema([
                        Textarea::make('footer_address')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->required(),
                        TextInput::make('footer_phone')
                            ->label('Nomor WhatsApp')
                            ->required(),
                        TextInput::make('footer_email')
                            ->label('Email Resmi')
                            ->email()
                            ->required(),
                        Textarea::make('footer_maps')
                            ->label('Google Maps Embed URL')
                            ->placeholder('https://www.google.com/maps/embed?pb=...')
                            ->helperText('Hanya masukkan atribut src dari iframe Google Maps.')
                            ->rows(3)
                            ->required(),
                    ])->columns(2),

                Section::make('Sosial Media & Teks Hak Cipta')
                    ->description('Kelola ikon tautan sosial media dan copyright')
                    ->schema([
                        Repeater::make('footer_socials')
                            ->label('Media Sosial Platform')
                            ->schema([
                                TextInput::make('platform')
                                    ->label('Nama Platform (e.g. Facebook, Instagram)')
                                    ->required(),
                                TextInput::make('url')
                                    ->label('Tautan / URL')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['platform'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull(),

                        TextInput::make('footer_copyright')
                            ->label('Teks Copyright Footer')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Menu Tautan Kaki (Footer Links)')
                    ->description('Atur daftar tautan cepat di bagian bawah website')
                    ->schema([
                        Repeater::make('footer_menu')
                            ->label('Item Menu Footer')
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
                    ])
            ])
            ->statePath('data');
    }
}
