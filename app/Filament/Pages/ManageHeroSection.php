<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use App\Helpers\MediaHelper;

class ManageHeroSection extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Hero Section';
    protected static ?string $title = 'Pengaturan Hero Section';
    protected static ?int $navigationSort = 10;

    protected function getSettingKeys(): array
    {
        return [
            'landing_hero_small' => 'Pesantren Persatuan Islam 104 Al-Ittihad Cikajang',
            'landing_hero_title' => 'Membentuk Generasi Robbani, Beradab, dan Berprestasi',
            'landing_hero_subtitle' => 'Pendidikan terpadu berlandaskan Al-Qur\'an dan As-Sunnah untuk melahirkan kader ulama yang mutafaqqih fiddin.',
            'landing_hero_cta_text' => 'Daftar Online',
            'landing_hero_cta_link' => '/',
            'landing_hero_image' => '',
            'landing_hero_image_mobile' => '',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero Content')
                    ->description('Atur teks dan tombol yang muncul di Hero Section')
                    ->schema([
                        TextInput::make('landing_hero_small')
                            ->label('Hero Kecil (Nama Pesantren/Lembaga)')
                            ->required(),
                        TextInput::make('landing_hero_title')
                            ->label('Hero Utama (Judul Besar)')
                            ->required(),
                        Textarea::make('landing_hero_subtitle')
                            ->label('Sub Hero (Narasi Pendukung)')
                            ->rows(3)
                            ->required(),
                        TextInput::make('landing_hero_cta_text')
                            ->label('Teks Tombol CTA')
                            ->required(),
                        TextInput::make('landing_hero_cta_link')
                            ->label('Link Tombol CTA')
                            ->required(),
                    ]),
                Section::make('Hero Backgrounds')
                    ->description('Upload background untuk tampilan desktop dan mobile')
                    ->schema([
                        MediaHelper::imageUpload('landing_hero_image', 'Background Hero (Desktop)', 'website', 'banner'),
                        MediaHelper::imageUpload('landing_hero_image_mobile', 'Background Hero (Mobile)', 'website', 'banner'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }
}
