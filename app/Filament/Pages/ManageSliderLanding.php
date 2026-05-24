<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use App\Helpers\MediaHelper;

class ManageSliderLanding extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';
    protected static ?string $navigationLabel = 'Slider Landing';
    protected static ?string $title = 'Pengaturan Slider Landing';
    protected static ?int $navigationSort = 20;

    protected function getSettingKeys(): array
    {
        return [
            'landing_slider_items' => [
                [
                    'title' => 'Selamat Datang di Al-Ittihad',
                    'description' => 'Mewujudkan generasi berakhlak mulia dan berwawasan luas.',
                    'image' => '',
                    'button_text' => 'Pelajari Selengkapnya',
                    'button_link' => '/profil/sejarah',
                ],
                [
                    'title' => 'Penerimaan Santri Baru',
                    'description' => 'Tahun Ajaran 2026/2027 telah dibuka. Segera daftarkan putra-putri Anda.',
                    'image' => '',
                    'button_text' => 'Daftar Sekarang',
                    'button_link' => '/kontak',
                ]
            ],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Slider Items')
                    ->description('Kelola slide gambar yang tampil pada halaman utama website')
                    ->schema([
                        Repeater::make('landing_slider_items')
                            ->label('Daftar Slide')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Slide')
                                    ->required(),
                                Textarea::make('description')
                                    ->label('Deskripsi Slide')
                                    ->rows(2),
                                MediaHelper::imageUpload('image', 'Foto Slide', 'website', 'banner'),
                                TextInput::make('button_text')
                                    ->label('Teks Tombol CTA')
                                    ->default('Pelajari Selengkapnya'),
                                TextInput::make('button_link')
                                    ->label('Link Tombol CTA')
                                    ->default('/'),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->minItems(1)
                            ->columnSpanFull(),
                    ])
            ])
            ->statePath('data');
    }
}
