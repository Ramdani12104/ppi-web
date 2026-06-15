<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use App\Helpers\MediaHelper;

class ManageKatalogSeragam extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $navigationLabel = 'Katalog Seragam';
    protected static ?string $title = 'Pengaturan Katalog Seragam & Atribut';
    protected static ?int $navigationSort = 45;

    protected function getSettingKeys(): array
    {
        return [
            'seragam_hero_title' => 'Katalog Seragam & Atribut Resmi',
            'seragam_hero_subtitle' => 'Daftar perlengkapan pakaian, seragam batik, jas almamater, dan atribut kepanduan resmi santri PPI 104 Al-Ittihad.',
            'seragam_hero_image' => '',
            'seragam_items' => [
                [
                    'name' => 'Seragam Batik Resmi PPI 104',
                    'category' => 'Batik Pesantren',
                    'image' => '',
                    'description' => 'Bahan katun prima halus yang adem dan menyerap keringat. Dilengkapi dengan motif batik khas dan logo resmi bordir Pesantren Persatuan Islam 104.',
                    'price' => 'Rp 120.000',
                    'pic_phone' => '083822099034',
                    'levels' => ['MA', 'MTs', 'SDIT', 'MDT']
                ],
                [
                    'name' => 'Jas Almamater Pesantren',
                    'category' => 'Seragam Utama',
                    'image' => '',
                    'description' => 'Jas almamater resmi santri dengan bahan premium drill, kancing kuningan berlogo Persis, dan furing bagian dalam yang rapi dan nyaman.',
                    'price' => 'Rp 195.000',
                    'pic_phone' => '083822099034',
                    'levels' => ['MA', 'MTs']
                ],
                [
                    'name' => 'Setelan Olahraga Santri',
                    'category' => 'Olahraga',
                    'image' => '',
                    'description' => 'Satu stel kaos olahraga lengan panjang berbahan dry-fit pori mikro dengan celana training lotto super yang elastis untuk menunjang aktivitas fisik.',
                    'price' => 'Rp 110.000',
                    'pic_phone' => '083822099034',
                    'levels' => ['MA', 'MTs', 'SDIT']
                ],
                [
                    'name' => 'Peci & Atribut Lengkap',
                    'category' => 'Atribut & Aksesoris',
                    'image' => '',
                    'description' => 'Peci beludru hitam berlogo emas PPI 104, ikat pinggang nilon resmi, kaos kaki logo bordir, serta pin kelengkapan brigade santri.',
                    'price' => 'Rp 65.000',
                    'pic_phone' => '083822099034',
                    'levels' => ['MA', 'MTs', 'SDIT']
                ]
            ],
            'seragam_cta_text' => 'Tanya Bagian Perlengkapan',
            'seragam_cta_phone' => '083822099034'
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero Banner')
                    ->description('Bagian atas halaman Katalog Seragam')
                    ->schema([
                        TextInput::make('seragam_hero_title')
                            ->label('Judul Hero')
                            ->required(),
                        Textarea::make('seragam_hero_subtitle')
                            ->label('Subjudul Hero')
                            ->rows(3)
                            ->required(),
                        MediaHelper::imageUpload('seragam_hero_image', 'Foto Background Hero', 'website', 'banner'),
                    ])->columns(2),

                Section::make('Daftar Item Katalog')
                    ->description('Kelola barang-barang kelengkapan seragam dan atribut santri')
                    ->schema([
                        Repeater::make('seragam_items')
                            ->label('Item Seragam/Atribut')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Item/Pakaian')
                                    ->required(),
                                Select::make('category')
                                    ->label('Kategori')
                                    ->options([
                                        'Seragam Utama' => 'Seragam Utama',
                                        'Batik Pesantren' => 'Batik Pesantren',
                                        'Olahraga' => 'Olahraga',
                                        'Atribut & Aksesoris' => 'Atribut & Aksesoris'
                                    ])
                                    ->required(),
                                Select::make('levels')
                                    ->label('Jenjang Sekolah')
                                    ->multiple()
                                    ->options([
                                        'MA' => 'MA',
                                        'MTs' => 'MTs',
                                        'SDIT' => 'SDIT',
                                        'MDT' => 'MDT / MDU',
                                        'TK' => 'TK / RA',
                                        'PAUD' => 'PAUD / Kober'
                                    ])
                                    ->placeholder('Pilih jenjang sekolah (opsional)'),
                                MediaHelper::imageUpload('image', 'Foto Produk', 'website', 'content'),
                                Textarea::make('description')
                                    ->label('Deskripsi/Spesifikasi Bahan')
                                    ->rows(3)
                                    ->required(),
                                TextInput::make('price')
                                    ->label('Harga Jual')
                                    ->placeholder('Contoh: Rp 120.000')
                                    ->required(),
                                TextInput::make('pic_phone')
                                    ->label('Nomor WhatsApp Pemesanan')
                                    ->placeholder('Contoh: 083822099034')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => ($state['name'] ?? '') . ' - ' . ($state['category'] ?? ''))
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Section::make('Tombol Tanya Umum (CTA)')
                    ->description('Konfigurasi tombol konsultasi/tanya jawab umum bagian seragam')
                    ->schema([
                        TextInput::make('seragam_cta_text')
                            ->label('Teks Tombol')
                            ->required(),
                        TextInput::make('seragam_cta_phone')
                            ->label('Nomor WhatsApp')
                            ->placeholder('Contoh: 083822099034')
                            ->required(),
                    ])->columns(2),
            ])
            ->statePath('data');
    }
}
