<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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
            'slider_image_1' => '',
            'slider_image_2' => '',
            'slider_image_3' => '',
            'slider_small_text' => 'Pesantren Persatuan Islam 104 Al-Ittihad',
            'slider_title' => 'Membentuk Generasi Robbani, Beradab, dan Berprestasi',
            'slider_description' => 'Pendidikan terpadu berlandaskan Al-Qur\'an dan As-Sunnah untuk melahirkan kader ulama.',
            'slider_button_text' => 'Pelajari Selengkapnya',
            'slider_button_link' => '/profil/sejarah',
            'title_font_size' => 'text-4xl md:text-6xl',
            'text_position' => 'items-center text-center',
            'overlay_opacity' => 'bg-black/60',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Foto Background Slide')
                    ->description('Upload foto-foto background slide satu per satu (Maksimal 3 foto)')
                    ->schema([
                        MediaHelper::imageUpload('slider_image_1', 'Foto Background 1', 'website', 'banner')
                            ->required(),
                        MediaHelper::imageUpload('slider_image_2', 'Foto Background 2 (Opsional)', 'website', 'banner'),
                        MediaHelper::imageUpload('slider_image_3', 'Foto Background 3 (Opsional)', 'website', 'banner'),
                    ])->columns(3),

                Section::make('Pengaturan Teks & Layout Slide')
                    ->description('Kelola tulisan, ukuran judul, posisi teks, dan kegelapan overlay background')
                    ->schema([
                        TextInput::make('slider_small_text')
                            ->label('Tulisan Kecil (Slogan Atas)')
                            ->required(),
                        TextInput::make('slider_title')
                            ->label('Judul Besar')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('slider_description')
                            ->label('Sedikit Keterangan / Deskripsi')
                            ->rows(3)
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('slider_button_text')
                            ->label('Teks Tombol CTA')
                            ->required(),
                        TextInput::make('slider_button_link')
                            ->label('Link Tombol CTA')
                            ->required(),
                        Select::make('title_font_size')
                            ->label('Ukuran Judul Besar')
                            ->options([
                                'text-3xl md:text-5xl' => 'Kecil (3xl/5xl)',
                                'text-4xl md:text-6xl' => 'Sedang (4xl/6xl) - Default',
                                'text-5xl md:text-7xl' => 'Besar (5xl/7xl)',
                                'text-6xl md:text-8xl' => 'Sangat Besar (6xl/8xl)',
                            ])
                            ->required(),
                        Select::make('text_position')
                            ->label('Posisi & Penyelarasan Teks')
                            ->options([
                                'items-center text-center' => 'Tengah (Center) - Default',
                                'items-start text-left' => 'Kiri (Left)',
                                'items-end text-right' => 'Kanan (Right)',
                            ])
                            ->required(),
                        Select::make('overlay_opacity')
                            ->label('Kegelapan Overlay Background (Supaya tulisan terbaca)')
                            ->options([
                                'bg-black/30' => 'Terang (30%)',
                                'bg-black/45' => 'Sedang (45%)',
                                'bg-black/60' => 'Gelap (60%) - Default',
                                'bg-black/75' => 'Sangat Gelap (75%)',
                                'bg-black/90' => 'Hampir Hitam (90%)',
                            ])
                            ->required(),
                    ])->columns(2)
            ])
            ->statePath('data');
    }
}
