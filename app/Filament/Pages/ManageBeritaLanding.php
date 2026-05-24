<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;

class ManageBeritaLanding extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Berita Landing';
    protected static ?string $title = 'Pengaturan Berita Landing';
    protected static ?int $navigationSort = 80;

    protected function getSettingKeys(): array
    {
        return [
            'landing_news_title' => 'Berita Terbaru',
            'landing_news_desc' => 'Ikuti terus perkembangan, prestasi, dan dokumentasi kegiatan terbaru dari Pesantren Persatuan Islam 104 Al-Ittihad Cikajang.',
            'landing_news_count' => '4',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Berita Section')
                    ->description('Kelola teks header seksi berita di halaman utama')
                    ->schema([
                        TextInput::make('landing_news_title')
                            ->label('Judul Section')
                            ->required(),
                        Textarea::make('landing_news_desc')
                            ->label('Deskripsi Section')
                            ->rows(3)
                            ->required(),
                        TextInput::make('landing_news_count')
                            ->label('Jumlah Berita Tampil')
                            ->numeric()
                            ->required()
                            ->default(4)
                            ->helperText('Berapa banyak berita terbaru yang ingin ditampilkan di landing page (default: 4).'),
                    ])
            ])
            ->statePath('data');
    }
}
