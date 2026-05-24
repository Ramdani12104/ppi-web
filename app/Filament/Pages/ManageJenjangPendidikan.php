<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use App\Helpers\MediaHelper;

class ManageJenjangPendidikan extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Jenjang Pendidikan';
    protected static ?string $title = 'Pengaturan Jenjang Pendidikan';
    protected static ?int $navigationSort = 60;

    protected function getSettingKeys(): array
    {
        return [
            'landing_levels_title' => 'Jenjang Pendidikan',
            'landing_levels_desc' => 'Di Pesantren Persatuan Islam 104 Al-Ittihad Cikajang, kami menyelenggarakan sistem pendidikan berjenjang yang memadukan kurikulum nasional dengan kurikulum kepesantrenan yang khas. Fokus kami adalah mencetak generasi yang tidak hanya cerdas secara intelektual, tetapi juga memiliki kedalaman adab dan keteguhan iman sesuai Al-Qur\'an dan As-Sunnah.',
            'landing_levels_cards' => [
                [
                    'image' => '',
                    'title' => 'KOBER',
                    'desc' => 'Kelompok Bermain untuk anak usia dini dengan pendekatan bermain sambil belajar nilai-nilai dasar Islam.',
                    'link' => '/program/kober'
                ],
                [
                    'image' => '',
                    'title' => 'RA (Raudhatul Athfal)',
                    'desc' => 'Tingkat taman kanak-kanak yang menitikberatkan pada pembiasaan ibadah harian dan pengenalan huruf hijaiyah.',
                    'link' => '/program/ra'
                ],
                [
                    'image' => '',
                    'title' => 'SDIT',
                    'desc' => 'Sekolah Dasar Islam Terpadu dengan integrasi ilmu umum dan penguatan hafalan Al-Qur\'an sejak dini.',
                    'link' => '/program/sdit'
                ],
                [
                    'image' => '',
                    'title' => 'Madrasah Diniyah',
                    'desc' => 'Program Takmiliyah untuk pendalaman ilmu alat, fiqih, dan aqidah yang dilaksanakan pada siang/sore hari.',
                    'link' => '/program/mdt'
                ],
                [
                    'image' => '',
                    'title' => 'Madrasah Tsanawiyah',
                    'desc' => 'Jenjang menengah pertama dengan lingkungan asrama yang mendukung kemandirian dan penguasaan bahasa Arab.',
                    'link' => '/program/mts'
                ],
                [
                    'image' => '',
                    'title' => 'Madrasah Aliyah',
                    'desc' => 'Pendidikan menengah atas sebagai persiapan studi lanjut dan kaderisasi kepemimpinan umat.',
                    'link' => '/program/ma'
                ]
            ],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Jenjang Pendidikan')
                    ->description('Kelola deskripsi dan jenjang pendidikan formal/non-formal di pesantren')
                    ->schema([
                        TextInput::make('landing_levels_title')
                            ->label('Judul Section')
                            ->required(),
                        Textarea::make('landing_levels_desc')
                            ->label('Deskripsi Section')
                            ->rows(3)
                            ->required(),
                        
                        Repeater::make('landing_levels_cards')
                            ->label('Daftar Jenjang Pendidikan')
                            ->schema([
                                MediaHelper::imageUpload('image', 'Gambar/Background Jenjang', 'website', 'banner'),
                                TextInput::make('title')
                                    ->label('Nama Jenjang')
                                    ->required(),
                                Textarea::make('desc')
                                    ->label('Deskripsi Singkat')
                                    ->rows(2)
                                    ->required(),
                                TextInput::make('link')
                                    ->label('Link Detail Halaman')
                                    ->required(),
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
