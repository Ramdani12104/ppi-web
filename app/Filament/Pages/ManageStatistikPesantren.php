<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;

class ManageStatistikPesantren extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Statistik Pesantren';
    protected static ?string $title = 'Pengaturan Statistik Pesantren';
    protected static ?int $navigationSort = 40;

    protected function getSettingKeys(): array
    {
        return [
            'landing_stats_title' => 'Statistik Pesantren',
            'landing_stats_desc' => 'Perkembangan jumlah santri, pengajar, dan sarana prasarana Pesantren Persatuan Islam 104 Al-Ittihad Cikajang.',
            'landing_stats_cards' => [
                [
                    'icon' => '👥',
                    'number' => '1200',
                    'label' => 'Total Santri Aktif'
                ],
                [
                    'icon' => '👨‍🏫',
                    'number' => '65',
                    'label' => 'Asatidz & Asatidzah'
                ],
                [
                    'icon' => '🏫',
                    'number' => '6',
                    'label' => 'Jenjang Pendidikan'
                ],
                [
                    'icon' => '🎓',
                    'number' => '3500',
                    'label' => 'Alumni Tersebar'
                ]
            ],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Statistik')
                    ->description('Atur pencapaian angka statistik Pesantren')
                    ->schema([
                        TextInput::make('landing_stats_title')
                            ->label('Judul Section')
                            ->required(),
                        Textarea::make('landing_stats_desc')
                            ->label('Deskripsi Section')
                            ->rows(2)
                            ->required(),
                        
                        Repeater::make('landing_stats_cards')
                            ->label('Daftar Angka Statistik')
                            ->schema([
                                TextInput::make('icon')
                                    ->label('Emoji / Icon')
                                    ->placeholder('e.g., 👥')
                                    ->required(),
                                TextInput::make('number')
                                    ->label('Angka Statistik')
                                    ->placeholder('e.g., 1200')
                                    ->required(),
                                TextInput::make('label')
                                    ->label('Label/Keterangan')
                                    ->placeholder('e.g., Santri Aktif')
                                    ->required(),
                            ])
                            ->columns(3)
                            ->itemLabel(fn (array $state): ?string => ($state['icon'] ?? '') . ' ' . ($state['number'] ?? '') . ' ' . ($state['label'] ?? ''))
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull()
                    ])
            ])
            ->statePath('data');
    }
}
