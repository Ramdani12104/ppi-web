<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;

class ManageProgramUnggulan extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-fire';
    protected static ?string $navigationLabel = 'Program Unggulan';
    protected static ?string $title = 'Pengaturan Program Unggulan';
    protected static ?int $navigationSort = 70;

    protected function getSettingKeys(): array
    {
        return [
            'landing_programs_title' => 'Program Pesantren',
            'landing_programs_desc' => 'Selain pendidikan formal, kami membekali santri dengan berbagai program unggulan untuk mengasah spiritual, kemandirian, dan kreativitas guna mencetak kader umat yang mutafaqqih fidding.',
            'landing_programs_cards' => [
                [
                    'icon' => '🕌',
                    'title' => 'Raudhatul Hufadz (RH)',
                    'desc' => 'Unit khusus pencetak penghafal Al-Qur\'an dengan pendampingan intensif dan metode mutqin.',
                    'color_gradient' => 'from-emerald-500 to-emerald-700',
                    'link' => '#'
                ],
                [
                    'icon' => '📖',
                    'title' => 'Revitalisasi Al-Qur\'an',
                    'desc' => 'Program peningkatan kualitas bacaan dan pemahaman Al-Qur\'an bagi seluruh santri secara sistematis.',
                    'color_gradient' => 'from-blue-500 to-blue-700',
                    'link' => '#'
                ],
                [
                    'icon' => '🛡️',
                    'title' => 'Brigade Santri',
                    'desc' => 'Wadah kedisiplinan dan kepanduan untuk membentuk mental yang kuat, tangkas, dan berjiwa kepemimpinan.',
                    'color_gradient' => 'from-slate-700 to-slate-900',
                    'link' => '#'
                ],
                [
                    'icon' => '🏥',
                    'title' => 'Poskestren',
                    'desc' => 'Pos Kesehatan Pesantren yang melayani kesehatan santri sekaligus edukasi pola hidup bersih dan sehat.',
                    'color_gradient' => 'from-red-500 to-red-700',
                    'link' => '#'
                ],
                [
                    'icon' => '✍️',
                    'title' => 'Jurnalistik',
                    'desc' => 'Pelatihan literasi, kepenulisan, dan media untuk mengasah kemampuan dakwah santri di era digital.',
                    'color_gradient' => 'from-orange-500 to-orange-700',
                    'link' => '#'
                ],
                [
                    'icon' => '✨',
                    'title' => 'Program Lainnya',
                    'desc' => 'Berbagai kegiatan ekstrakurikuler dan pengembangan bakat yang akan terus bertambah sesuai kebutuhan santri.',
                    'color_gradient' => 'from-purple-500 to-purple-700',
                    'link' => '#'
                ]
            ],
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Program Pesantren / Unggulan')
                    ->description('Kelola program-program kepesantrenan unggulan')
                    ->schema([
                        TextInput::make('landing_programs_title')
                            ->label('Judul Section')
                            ->required(),
                        Textarea::make('landing_programs_desc')
                            ->label('Deskripsi Section')
                            ->rows(3)
                            ->required(),
                        
                        Repeater::make('landing_programs_cards')
                            ->label('Daftar Program')
                            ->schema([
                                TextInput::make('icon')
                                    ->label('Emoji / Icon')
                                    ->required(),
                                TextInput::make('title')
                                    ->label('Nama Program')
                                    ->required(),
                                Textarea::make('desc')
                                    ->label('Deskripsi Program')
                                    ->rows(2)
                                    ->required(),
                                TextInput::make('color_gradient')
                                    ->label('Color Gradient (CSS classes)')
                                    ->placeholder('e.g., from-emerald-500 to-emerald-700')
                                    ->required(),
                                TextInput::make('link')
                                    ->label('Link Detail (opsional)')
                                    ->default('#'),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => ($state['icon'] ?? '') . ' ' . ($state['title'] ?? ''))
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull()
                    ])
            ])
            ->statePath('data');
    }
}
