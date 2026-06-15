<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use App\Helpers\MediaHelper;

class ManageTabunganUmroh extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $navigationLabel = 'Tabungan Umroh';
    protected static ?string $title = 'Pengaturan Halaman Tabungan Umroh';
    protected static ?int $navigationSort = 30;

    protected function getSettingKeys(): array
    {
        return [
            'umroh_hero_title' => 'Program Tabungan Umroh PPI 104',
            'umroh_hero_subtitle' => 'Wujudkan impian ibadah umroh ke tanah suci bersama keluarga besar pesantren secara terencana dan barokah.',
            'umroh_hero_image' => '',
            'umroh_about_title' => 'Mengenal Tabungan Umroh Al-Ittihad',
            'umroh_about_content' => '<p>Program Tabungan Umroh adalah ikhtiar pesantren untuk memberikan kemudahan bagi santri, wali santri, asatidz, dan jamaah dalam merencanakan perjalanan ibadah Umroh ke Baitullah secara bertahap dan teratur dengan skema syariah tanpa bunga dan biaya administrasi tambahan.</p>',
            'umroh_packages' => [
                [
                    'name' => 'Tabungan Umroh Harian',
                    'amount' => 'Rp 20.000 / hari',
                    'target_period' => 'Skema 4-5 Tahun',
                    'features' => 'Setoran harian mudah melalui poskestren/kantor, tanpa denda, bebas admin bulanan.'
                ],
                [
                    'name' => 'Tabungan Umroh Bulanan',
                    'amount' => 'Rp 500.000 / bulan',
                    'target_period' => 'Skema 3-4 Tahun',
                    'features' => 'Autodebet atau transfer rekening resmi, laporan bulanan via WA, prioritas keberangkatan.'
                ],
                [
                    'name' => 'Tabungan Umroh Berjangka',
                    'amount' => 'Setoran Awal Rp 5.000.000',
                    'target_period' => 'Skema Fleksibel',
                    'features' => 'Sesuai kemampuan, setoran tambahan bebas kapan saja, bebas ganti paket keberangkatan.'
                ]
            ],
            'umroh_steps' => [
                [
                    'step_number' => '1',
                    'title' => 'Niat & Pendaftaran',
                    'description' => 'Hubungi admin umroh pesantren, isi formulir kesepakatan dan pilih paket tabungan.'
                ],
                [
                    'step_number' => '2',
                    'title' => 'Setoran Rutin',
                    'description' => 'Mulai lakukan setoran sesuai paket pilihan secara disiplin ke rekening resmi pesantren.'
                ],
                [
                    'step_number' => '3',
                    'title' => 'Pelunasan & Keberangkatan',
                    'description' => 'Setelah akumulasi dana mencukupi biaya paket umroh pilihan, proses paspor dan keberangkatan dimulai.'
                ]
            ],
            'umroh_cta_text' => 'Konsultasi Program Umroh',
            'umroh_cta_whatsapp' => '083822099034',
            'umroh_partner_title' => 'Mitra Perjalanan Resmi',
            'umroh_partner_name' => 'KBIHU PT. Karya Imtaq',
            'umroh_partner_description' => 'Untuk menjamin keamanan, kenyamanan, dan bimbingan ibadah yang sesuai sunnah, Program Tabungan Umroh ini bekerja sama secara resmi dengan KBIHU PT. Karya Imtaq, biro perjalanan Haji & Umroh resmi milik jam\'iyyah Persatuan Islam (Persis).',
            'umroh_partner_logo' => '',
            'umroh_testimonials' => [
                [
                    'name' => 'Hj. Nina Herlina',
                    'status' => 'Jamaah Umroh & Wali Santri',
                    'quote' => 'Alhamdulillah, melalui tabungan harian di pesantren, impian kami sekeluarga untuk beribadah umroh bisa terwujud tanpa terasa berat. Pembimbingannya sangat intensif sesuai sunnah.',
                    'avatar' => ''
                ],
                [
                    'name' => 'Ustadz Cecep Saepudin',
                    'status' => 'Asatidz PPI 104',
                    'quote' => 'Sangat terbantu dengan skema autodebet bulanan. Tabungan terencana ini memudahkan kami para pengajar untuk fokus mempersiapkan fisik dan mental tanpa terbebani biaya pelunasan sekaligus.',
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
                    ->description('Bagian atas halaman Tabungan Umroh')
                    ->schema([
                        TextInput::make('umroh_hero_title')
                            ->label('Judul Hero')
                            ->required(),
                        Textarea::make('umroh_hero_subtitle')
                            ->label('Subjudul Hero')
                            ->rows(3)
                            ->required(),
                        MediaHelper::imageUpload('umroh_hero_image', 'Foto Background Hero', 'website', 'banner'),
                    ])->columns(2),

                Section::make('Tentang Program')
                    ->description('Penjelasan rinci program Tabungan Umroh')
                    ->schema([
                        TextInput::make('umroh_about_title')
                            ->label('Judul Tentang')
                            ->required(),
                        RichEditor::make('umroh_about_content')
                            ->label('Detail Konten Penjelasan')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Kemitraan Perjalanan')
                    ->description('Kelola detail agen perjalanan Haji & Umroh mitra resmi pesantren')
                    ->schema([
                        TextInput::make('umroh_partner_title')
                            ->label('Judul Kemitraan')
                            ->required(),
                        TextInput::make('umroh_partner_name')
                            ->label('Nama Agen / Kemitraan')
                            ->required(),
                        Textarea::make('umroh_partner_description')
                            ->label('Keterangan Kemitraan')
                            ->rows(3)
                            ->required(),
                        MediaHelper::imageUpload('umroh_partner_logo', 'Logo Agen / Kemitraan', 'website', 'logo'),
                    ])->columns(2),

                Section::make('Skema / Paket Tabungan')
                    ->description('Daftar skema setoran tabungan umroh')
                    ->schema([
                        Repeater::make('umroh_packages')
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
                        Repeater::make('umroh_steps')
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
                    ->description('Daftar testimoni khusus peserta Tabungan Umroh')
                    ->schema([
                        Repeater::make('umroh_testimonials')
                            ->label('Testimoni Peserta')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Pemberi Testimoni')
                                    ->required(),
                                TextInput::make('status')
                                    ->label('Status / Pekerjaan')
                                    ->placeholder('Contoh: Wali Santri Kelas X / Jamaah Mesjid')
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
                        TextInput::make('umroh_cta_text')
                            ->label('Teks Tombol')
                            ->required(),
                        TextInput::make('umroh_cta_whatsapp')
                            ->label('Nomor WhatsApp Admin')
                            ->placeholder('Contoh: 083822099034')
                            ->required(),
                    ])->columns(2),
            ])
            ->statePath('data');
    }
}
