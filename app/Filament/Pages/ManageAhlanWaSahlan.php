<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use App\Helpers\MediaHelper;

class ManageAhlanWaSahlan extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationLabel = 'Ahlan Wa Sahlan';
    protected static ?string $title = 'Pengaturan Ahlan Wa Sahlan (Sambutan)';
    protected static ?int $navigationSort = 30;

    protected function getSettingKeys(): array
    {
        return [
            'landing_welcome_title' => 'Ahlan Wa Sahlan',
            'landing_welcome_subtitle' => 'Sambutan Mudirul \'Am Pesantren',
            'landing_welcome_video' => 'https://www.youtube.com/watch?v=6fRorJATZbk',
            'landing_welcome_narrative' => 'Pesantren Persatuan Islam 104 Al-Ittihad Cikajang didirikan dengan tekad yang kuat untuk melahirkan kader ulama dan intelektual muslim. Melalui sinergi pendidikan kepesantrenan dan kurikulum formal, kami berkomitmen menempa akhlak, memperluas wawasan keilmuan, dan meneguhkan aqidah lurus sesuai tuntunan Al-Qur\'an dan As-Sunnah.',
            'landing_welcome_quote' => 'Mendidik dengan hati, mengajar dengan keteladanan, demi mencetak generasi Robbani pembawa obor peradaban Islam.',
            'landing_welcome_cta_text' => 'Tentang Kami',
            'landing_welcome_cta_link' => '/profil/sejarah',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Video Sambutan')
                    ->description('Tautkan video YouTube sambutan hangat Mudirul \'Am')
                    ->schema(MediaHelper::youtubeFields('landing_welcome_video')),
                
                Section::make('Konten Sambutan & Narasi')
                    ->description('Kelola judul, narasi singkat, dan kutipan sambutan')
                    ->schema([
                        TextInput::make('landing_welcome_title')
                            ->label('Judul Section')
                            ->required(),
                        TextInput::make('landing_welcome_subtitle')
                            ->label('Subjudul Section')
                            ->required(),
                        RichEditor::make('landing_welcome_narrative')
                            ->label('Narasi Mengenal Pesantren')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('landing_welcome_quote')
                            ->label('Kutipan Singkat Mudirul \'Am')
                            ->rows(3)
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('landing_welcome_cta_text')
                            ->label('Teks Tombol CTA')
                            ->required(),
                        TextInput::make('landing_welcome_cta_link')
                            ->label('Link Tombol CTA')
                            ->required(),
                    ])->columns(2)
            ])
            ->statePath('data');
    }
}
