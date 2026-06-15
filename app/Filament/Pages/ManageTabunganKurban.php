<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use App\Helpers\MediaHelper;

class ManageTabunganKurban extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $navigationLabel = 'Tabungan Kurban';
    protected static ?string $title = 'Pengaturan Halaman Tabungan Kurban';
    protected static ?int $navigationSort = 35;

    protected function getSettingKeys(): array
    {
        return [
            'kurban_hero_title' => 'Program Tabungan Kurban PPI 104',
            'kurban_hero_subtitle' => 'Persiapkan ibadah kurban terbaik Anda secara terencana, mudah, dan barokah bersama pesantren.',
            'kurban_hero_image' => '',
            'kurban_about_title' => 'Mengenal Tabungan Kurban Al-Ittihad',
            'kurban_about_content' => '<p>Program Tabungan Kurban adalah sarana perencanaan keuangan syariah bagi keluarga besar pesantren, santri, dan jamaah untuk mempersiapkan pembelian hewan kurban terbaik (sapi/domba) secara bertahap dan teratur demi kelancaran ibadah kurban Anda.</p>',
            'kurban_packages' => [
                [
                    'name' => 'Tabungan Kurban Domba',
                    'amount' => 'Rp 300.000 / bulan',
                    'target_period' => 'Skema 10 Bulan',
                    'features' => 'Setoran bulanan untuk target 1 ekor domba premium/sehat, laporan berkala, tanpa biaya administrasi.'
                ],
                [
                    'name' => 'Tabungan Kurban Patungan Sapi',
                    'amount' => 'Rp 450.000 / bulan',
                    'target_period' => 'Skema 10 Bulan',
                    'features' => 'Patungan 1/7 sapi dengan jamaah lain, dikelola amanah, penyaluran tepat sasaran.'
                ],
                [
                    'name' => 'Tabungan Kurban Fleksibel',
                    'amount' => 'Mulai Rp 50.000',
                    'target_period' => 'Skema Mandiri',
                    'features' => 'Setoran dengan nominal bebas kapan saja, sangat cocok untuk melatih kebiasaan berkurban santri.'
                ]
            ],
            'kurban_steps' => [
                [
                    'step_number' => '1',
                    'title' => 'Pendaftaran & Komitmen',
                    'description' => 'Hubungi Panitia Kurban PPI 104, tentukan jenis hewan kurban (domba/sapi) dan paket tabungan.'
                ],
                [
                    'step_number' => '2',
                    'title' => 'Menabung Secara Rutin',
                    'description' => 'Lakukan setoran berkala melalui bendahara pesantren atau transfer bank sesuai jadwal.'
                ],
                [
                    'step_number' => '3',
                    'title' => 'Pembelian & Pemotongan',
                    'description' => 'Menjelang Idul Adha, dana dicairkan untuk dibelikan hewan kurban yang kemudian disembelih atas nama Anda.'
                ]
            ],
            'kurban_cta_text' => 'Tanya Jawab Program Kurban',
            'kurban_cta_whatsapp' => '083822099034',
            'kurban_partner_title' => 'Penyelenggara Kurban Resmi',
            'kurban_partner_name' => 'Panitia Kurban PPI 104 Al-Ittihad',
            'kurban_partner_description' => 'Ibadah kurban Anda akan dikelola secara penuh oleh Panitia Kurban Pesantren Al-Ittihad Cikajang. Mulai dari pemilihan hewan yang sehat dan sesuai syariat, pemeliharaan, hingga proses penyembelihan dan pendistribusian daging kurban kepada yang berhak di sekitar lingkungan pesantren.',
            'kurban_partner_logo' => '',
            'kurban_testimonials' => [
                [
                    'name' => 'Ibu Kokom Komariah',
                    'status' => 'Wali Santri Kelas VIII',
                    'quote' => 'Biasanya setiap tahun bingung menyisihkan uang untuk kurban. Dengan tabungan kurban bulanan ini, alhamdulillah sekarang bisa rutin berkurban setiap Idul Adha atas nama anak.',
                    'avatar' => ''
                ],
                [
                    'name' => 'Bapak Yudi Wahyudi',
                    'status' => 'Jamaah Mesjid Al-Ittihad',
                    'quote' => 'Pengelolaan hewan kurbannya sangat amanah. Hewan dipastikan sehat dan pembagian dagingnya sangat tertib sampai ke tangan warga yang benar-benar membutuhkan.',
                    'avatar' => ''
                ]
            ]
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero Banner')
                    ->description('Bagian atas halaman Tabungan Kurban')
                    ->schema([
                        TextInput::make('kurban_hero_title')
                            ->label('Judul Hero')
                            ->required(),
                        Textarea::make('kurban_hero_subtitle')
                            ->label('Subjudul Hero')
                            ->rows(3)
                            ->required(),
                        MediaHelper::imageUpload('kurban_hero_image', 'Foto Background Hero', 'website', 'banner'),
                    ])->columns(2),

                Section::make('Tentang Program')
                    ->description('Penjelasan rinci program Tabungan Kurban')
                    ->schema([
                        TextInput::make('kurban_about_title')
                            ->label('Judul Tentang')
                            ->required(),
                        RichEditor::make('kurban_about_content')
                            ->label('Detail Konten Penjelasan')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Penyelenggara / Kemitraan')
                    ->description('Kelola detail panitia pelaksana atau mitra kurban')
                    ->schema([
                        TextInput::make('kurban_partner_title')
                            ->label('Judul Kemitraan')
                            ->required(),
                        TextInput::make('kurban_partner_name')
                            ->label('Nama Penyelenggara / Mitra')
                            ->required(),
                        Textarea::make('kurban_partner_description')
                            ->label('Keterangan Pengelolaan')
                            ->rows(3)
                            ->required(),
                        MediaHelper::imageUpload('kurban_partner_logo', 'Logo Penyelenggara / Mitra', 'website', 'logo'),
                    ])->columns(2),

                Section::make('Skema / Paket Tabungan')
                    ->description('Daftar skema setoran tabungan kurban')
                    ->schema([
                        Repeater::make('kurban_packages')
                            ->label('Pilihan Skema Setoran')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Skema')
                                    ->required(),
                                TextInput::make('amount')
                                    ->label('Besar Setoran')
                                    ->required(),
                                TextInput::make('target_period')
                                    ->label('Target Waktu')
                                    ->required(),
                                Textarea::make('features')
                                    ->label('Keterangan / Kelebihan')
                                    ->rows(2)
                                    ->required(),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Section::make('Alur & Cara Mendaftar')
                    ->description('Langkah-langkah berpartisipasi')
                    ->schema([
                        Repeater::make('kurban_steps')
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

                Section::make('Testimoni Program')
                    ->description('Daftar testimoni khusus peserta Tabungan Kurban')
                    ->schema([
                        Repeater::make('kurban_testimonials')
                            ->label('Testimoni Peserta')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Pemberi Testimoni')
                                    ->required(),
                                TextInput::make('status')
                                    ->label('Status / Pekerjaan')
                                    ->placeholder('Contoh: Wali Santri Kelas VIII / Jamaah Mesjid')
                                    ->required(),
                                Textarea::make('quote')
                                    ->label('Komentar / Pengalaman')
                                    ->rows(3)
                                    ->required(),
                                MediaHelper::imageUpload('avatar', 'Foto Profil', 'website', 'avatar')
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Section::make('Tombol Hubungi Admin (CTA)')
                    ->description('Konfigurasi tombol konsultasi WhatsApp')
                    ->schema([
                        TextInput::make('kurban_cta_text')
                            ->label('Teks Tombol')
                            ->required(),
                        TextInput::make('kurban_cta_whatsapp')
                            ->label('Nomor WhatsApp Admin')
                            ->placeholder('Contoh: 083822099034')
                            ->required(),
                    ])->columns(2),
            ])
            ->statePath('data');
    }
}
