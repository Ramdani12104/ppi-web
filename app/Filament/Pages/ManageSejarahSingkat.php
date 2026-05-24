<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;

class ManageSejarahSingkat extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Sejarah Singkat';
    protected static ?string $title = 'Pengaturan Sejarah Singkat';
    protected static ?int $navigationSort = 100;

    protected function getSettingKeys(): array
    {
        return [
            'landing_history_title' => 'Sejarah Singkat Pesantren',
            'landing_history_subtitle' => 'Menelusuri jejak perjuangan dakwah dan tarbiyah',
            'landing_history_p1' => 'Pesantren Persatuan Islam 104 Al-Ittihad Cikajang berawal dari sebuah pengajian halaqah kecil yang dirintis oleh para asatidz setempat. Berbekal keikhlasan dan semangat menyebarkan kemurnian ajaran Islam, pengajian ini lambat laun menarik minat masyarakat sekitar untuk menitipkan putra-putrinya mendalami ilmu agama.',
            'landing_history_p2' => 'Seiring bertambahnya jumlah jamaah dan santri, pengajian ini berkembang menjadi Madrasah Diniyah Takmiliyah (MDT). Lembaga ini menjadi wadah formal pertama untuk sistem belajar mengajar yang lebih teratur, mengajarkan tauhid, fiqih, akhlak, dan bahasa Arab sebagai fondasi awal bagi santri.',
            'landing_history_p3' => 'Tuntutan pendidikan formal tingkat menengah melahirkan gagasan penyelenggaraan Madrasah Tsanawiyah (MTs) kelas filial (menumpang). Melalui perjuangan panjang dan dedikasi penuh dari para pengurus dan masyarakat, madrasah ini terus berkembang mandiri hingga kini menyelenggarakan jenjang pendidikan lengkap yang terakreditasi.',
            'landing_history_timeline' => [
                [
                    'year' => 'Fase Awal',
                    'description' => 'Perintisan halaqah pengajian kecil oleh para sesepuh dan asatidz.'
                ],
                [
                    'year' => 'MDT',
                    'description' => 'Pendirian Madrasah Diniyah Takmiliyah secara formal untuk penataan belajar.'
                ],
                [
                    'year' => 'Filial MTs',
                    'description' => 'Pembukaan kelas menumpang/filial MTs untuk mengakomodasi pendidikan formal.'
                ],
                [
                    'year' => 'Kini',
                    'description' => 'Berkembang mandiri dengan jenjang pendidikan lengkap dan akreditasi prima.'
                ]
            ],
            'landing_history_cta_text' => 'Lihat Sejarah Lengkap',
            'landing_history_cta_link' => '/profil/sejarah',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Header Sejarah')
                    ->schema([
                        TextInput::make('landing_history_title')
                            ->label('Judul Section')
                            ->required(),
                        TextInput::make('landing_history_subtitle')
                            ->label('Subjudul Section')
                            ->required(),
                    ])->columns(2),

                Section::make('Narasi Sejarah (Maksimal 2-3 Paragraf)')
                    ->description('Tuliskan kisah perjuangan pendirian pesantren secara ringkas')
                    ->schema([
                        Textarea::make('landing_history_p1')
                            ->label('Paragraf 1: Awal Mula Pengajian')
                            ->rows(3)
                            ->required(),
                        Textarea::make('landing_history_p2')
                            ->label('Paragraf 2: Perkembangan MDT')
                            ->rows(3)
                            ->required(),
                        Textarea::make('landing_history_p3')
                            ->label('Paragraf 3: Kelas Filial s.d. Sekarang')
                            ->rows(3)
                            ->required(),
                    ]),

                Section::make('Timeline Ringan & Tombol Aksi')
                    ->description('Kelola fase milestones sejarah dan tombol tautan sejarah lengkap')
                    ->schema([
                        Repeater::make('landing_history_timeline')
                            ->label('Milestone Sejarah')
                            ->schema([
                                TextInput::make('year')
                                    ->label('Tahun / Fase')
                                    ->placeholder('e.g., 1995 atau MDT')
                                    ->required(),
                                TextInput::make('description')
                                    ->label('Peristiwa Singkat')
                                    ->placeholder('e.g., Perintisan halaqah...')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => ($state['year'] ?? '') . ' - ' . ($state['description'] ?? ''))
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull(),

                        TextInput::make('landing_history_cta_text')
                            ->label('Teks Tombol CTA')
                            ->required(),
                        TextInput::make('landing_history_cta_link')
                            ->label('Link Tombol CTA')
                            ->required(),
                    ])->columns(2)
            ])
            ->statePath('data');
    }
}
