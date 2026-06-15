<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use App\Helpers\MediaHelper;

class ManageKopontren extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $navigationLabel = 'Kopontren';
    protected static ?string $title = 'Pengaturan Halaman Kopontren';
    protected static ?int $navigationSort = 40;

    protected function getSettingKeys(): array
    {
        return [
            'kopontren_hero_title' => 'Koperasi Pondok Pesantren (Kopontren)',
            'kopontren_hero_subtitle' => 'Mewujudkan kemandirian ekonomi pesantren dan pelayanan kebutuhan santri secara syariah dan barokah.',
            'kopontren_hero_image' => '',
            'kopontren_about_title' => 'Mengenal Kopontren Al-Ittihad',
            'kopontren_about_content' => '<p>Koperasi Pondok Pesantren (Kopontren) PPI 104 Al-Ittihad didirikan sebagai wujud komitmen pesantren dalam membangun ekosistem ekonomi yang mandiri. Melalui unit-unit usaha yang dikelola, kami berupaya melayani kebutuhan seluruh santri, wali santri, dan asatidz dengan pelayanan prima yang berlandaskan prinsip tolong-menolong (ta\'awun) dan bebas dari riba.</p>',
            'kopontren_packages' => [
                [
                    'name' => 'Kantin Pesantren',
                    'image' => '',
                    'description' => 'Menyediakan makanan sehat, minuman segar, alat tulis, serta kebutuhan harian santri selama berada di lingkungan pesantren.',
                    'pic_name' => 'Ustadzah Fatimah',
                    'pic_phone' => '083822099034',
                    'cta_text' => 'Hubungi Kantin',
                    'cta_link' => ''
                ],
                [
                    'name' => 'Panda Water',
                    'image' => '',
                    'description' => 'Unit penyediaan air minum isi ulang berkualitas tinggi menggunakan teknologi Reverse Osmosis (RO) yang higienis, sehat, dan segar.',
                    'pic_name' => 'Pak Mulyana',
                    'pic_phone' => '083822099034',
                    'cta_text' => 'Pesan Air RO',
                    'cta_link' => ''
                ],
                [
                    'name' => 'Seragam & Atribut Resmi',
                    'image' => '',
                    'description' => 'Menyediakan seragam batik khas pesantren, jas almamater, atribut pramuka, kaos olahraga, hingga perlengkapan pakaian resmi santri.',
                    'pic_name' => 'Ibu Harni',
                    'pic_phone' => '083822099034',
                    'cta_text' => 'Hubungi Bagian Seragam',
                    'cta_link' => '/program/katalog-seragam'
                ],
                [
                    'name' => 'Al-Ittihad Travel',
                    'image' => '',
                    'description' => 'Unit penyediaan layanan transportasi Isuzu Elf Minibus Non-AC yang andal untuk kegiatan ziarah wali, studi banding, study tour, maupun antar-jemput santri dengan aman.',
                    'pic_name' => 'Kang Deni',
                    'pic_phone' => '083822099034',
                    'cta_text' => 'Hubungi Travel',
                    'cta_link' => '/program/al-ittihad-travel'
                ]
            ],
            'kopontren_steps' => [
                [
                    'step_number' => '1',
                    'title' => 'Pendaftaran Anggota',
                    'description' => 'Wali santri, asatidz, atau alumni mengajukan permohonan keanggotaan ke pengurus Kopontren.'
                ],
                [
                    'step_number' => '2',
                    'title' => 'Pembayaran Simpanan',
                    'description' => 'Menyetorkan simpanan pokok (awal pendaftaran) dan simpanan wajib bulanan sesuai kesepakatan Rapat Anggota.'
                ],
                [
                    'step_number' => '3',
                    'title' => 'Belanja & SHU',
                    'description' => 'Berbelanja produk koperasi, mendukung program ekonomi, dan memperoleh pembagian Sisa Hasil Usaha (SHU) tahunan secara transparan.'
                ]
            ],
            'kopontren_cta_text' => 'Hubungi Pengelola Kopontren',
            'kopontren_cta_whatsapp' => '083822099034',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero Banner')
                    ->description('Bagian atas halaman Kopontren')
                    ->schema([
                        TextInput::make('kopontren_hero_title')
                            ->label('Judul Hero')
                            ->required(),
                        Textarea::make('kopontren_hero_subtitle')
                            ->label('Subjudul Hero')
                            ->rows(3)
                            ->required(),
                        MediaHelper::imageUpload('kopontren_hero_image', 'Foto Background Hero', 'website', 'banner'),
                    ])->columns(2),

                Section::make('Tentang Program')
                    ->description('Penjelasan rinci tentang Kopontren')
                    ->schema([
                        TextInput::make('kopontren_about_title')
                            ->label('Judul Tentang')
                            ->required(),
                        RichEditor::make('kopontren_about_content')
                            ->label('Detail Konten Penjelasan')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Unit & Layanan Usaha')
                    ->description('Daftar unit atau jasa usaha koperasi yang dikelola penanggung jawab masing-masing')
                    ->schema([
                        Repeater::make('kopontren_packages')
                            ->label('Pilihan Unit Usaha')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Unit Usaha')
                                    ->required(),
                                MediaHelper::imageUpload('image', 'Foto Unit Usaha', 'website', 'content'),
                                Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->rows(3)
                                    ->required(),
                                TextInput::make('pic_name')
                                    ->label('Nama Penanggung Jawab')
                                    ->required(),
                                TextInput::make('pic_phone')
                                    ->label('Nomor WhatsApp Penanggung Jawab')
                                    ->placeholder('Contoh: 083822099034')
                                    ->required(),
                                TextInput::make('cta_text')
                                    ->label('Teks Tombol CTA Utama (WhatsApp)')
                                    ->placeholder('Contoh: Hubungi Kantin')
                                    ->required(),
                                TextInput::make('cta_link')
                                    ->label('Link CTA Tambahan / Katalog / Detail (Opsional)')
                                    ->placeholder('Contoh: /program/katalog-seragam atau https://katalog-seragam.com'),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Section::make('Alur Keanggotaan')
                    ->description('Langkah berpartisipasi menjadi anggota koperasi')
                    ->schema([
                        Repeater::make('kopontren_steps')
                            ->label('Langkah Pendaftaran')
                            ->schema([
                                TextInput::make('step_number')
                                    ->label('Langkah Ke-')
                                    ->required(),
                                TextInput::make('title')
                                    ->label('Judul Langkah')
                                    ->required(),
                                Textarea::make('description')
                                    ->label('Deskripsi Langkah')
                                    ->rows(2)
                                    ->required(),
                            ])
                            ->columns(3)
                            ->itemLabel(fn (array $state): ?string => ($state['step_number'] ?? '') . '. ' . ($state['title'] ?? ''))
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Section::make('Tombol Hubungi Pengelola (CTA Halaman)')
                    ->description('Konfigurasi tombol konsultasi WhatsApp umum')
                    ->schema([
                        TextInput::make('kopontren_cta_text')
                            ->label('Teks Tombol')
                            ->required(),
                        TextInput::make('kopontren_cta_whatsapp')
                            ->label('Nomor WhatsApp Admin')
                            ->placeholder('Contoh: 083822099034')
                            ->required(),
                    ])->columns(2),
            ])
            ->statePath('data');
    }
}
