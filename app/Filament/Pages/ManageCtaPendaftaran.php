<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use App\Helpers\MediaHelper;

class ManageCtaPendaftaran extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string $navigationLabel = 'CTA Pendaftaran';
    protected static ?string $title = 'Pengaturan CTA Pendaftaran';
    protected static ?int $navigationSort = 110;

    protected function getSettingKeys(): array
    {
        return [
            'landing_cta_title' => 'Penerimaan Santri Baru (PSB) Tahun Ajaran 2026/2027',
            'landing_cta_desc' => 'Mari bergabung bersama kami, membentuk generasi yang bertafaqquh fiddin dan berakhlak mulia. Pendaftaran online telah dibuka.',
            'landing_cta_btn_text' => 'Daftar Online Sekarang',
            'landing_cta_btn_link' => '/',
            'landing_cta_bg' => '',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Call to Action (CTA) Pendaftaran')
                    ->description('Kelola banner ajakan pendaftaran santri baru')
                    ->schema([
                        TextInput::make('landing_cta_title')
                            ->label('Judul CTA')
                            ->required(),
                        Textarea::make('landing_cta_desc')
                            ->label('Deskripsi CTA')
                            ->rows(3)
                            ->required(),
                        TextInput::make('landing_cta_btn_text')
                            ->label('Teks Tombol CTA')
                            ->required(),
                        TextInput::make('landing_cta_btn_link')
                            ->label('Link Tombol CTA')
                            ->required(),
                        MediaHelper::imageUpload('landing_cta_bg', 'Gambar Background Banner', 'website', 'banner')
                            ->columnSpanFull(),
                    ])->columns(2)
            ])
            ->statePath('data');
    }
}
