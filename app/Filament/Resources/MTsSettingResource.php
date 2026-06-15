<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MTsSettingResource\Pages;
use App\Filament\Resources\MTsSettingResource\RelationManagers;
use App\Models\MTsSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Helpers\MediaHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MTsSettingResource extends Resource
{
    protected static ?string $model = MTsSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Program Pendidikan';
    protected static ?string $navigationLabel = 'Pengaturan Halaman MTs';
    protected static ?string $modelLabel = 'Pengaturan MTs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Logo & Identitas
                Forms\Components\Section::make('Logo & Identitas')
                    ->description('Kelola logo sekolah')
                    ->schema([
                        MediaHelper::imageUpload('logo', 'Logo MTs', 'website', 'logo'),
                    ])
                    ->columns(1),

                // Sambutan / Ahlan Wa Sahlan
                Forms\Components\Section::make('Sambutan (Ahlan Wa Sahlan)')
                    ->description('Kelola judul, deskripsi, kutipan, dan media (foto/video) untuk bagian Sambutan')
                    ->schema([
                        Forms\Components\TextInput::make('sambutan_title')
                            ->label('Judul Sambutan')
                            ->placeholder('Contoh: Madrasah Tsanawiyah Al-Ittihaad')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('sambutan_desc')
                            ->label('Deskripsi Sambutan')
                            ->rows(4)
                            ->placeholder('Selamat datang di halaman resmi...'),
                        Forms\Components\Textarea::make('sambutan_quote')
                            ->label('Kutipan / Quote Sambutan')
                            ->rows(2)
                            ->placeholder('Membimbing santri melewati masa transisi...'),
                        Forms\Components\Select::make('sambutan_media_type')
                            ->label('Tipe Media Samping')
                            ->options([
                                'image' => 'Gambar/Foto',
                                'video' => 'Video (YouTube/Sosial Media)',
                            ])
                            ->default('image')
                            ->reactive()
                            ->required(),
                        MediaHelper::imageUpload('hero_banner', 'Foto Sambutan', 'website', 'banner')
                            ->visible(fn (Forms\Get $get) => $get('sambutan_media_type') !== 'video'),
                        Forms\Components\TextInput::make('sambutan_video_url')
                            ->label('Link Video Sambutan (YouTube/Instagram/Facebook/dll)')
                            ->placeholder('Masukkan link video YouTube atau URL lainnya')
                            ->visible(fn (Forms\Get $get) => $get('sambutan_media_type') === 'video'),
                    ])
                    ->columns(1),

                // Warna Tema Halaman
                Forms\Components\Section::make('Warna Tema Halaman')
                    ->description('Atur warna tema utama dan aksen untuk seluruh halaman ini')
                    ->schema([
                        Forms\Components\ColorPicker::make('primary_color')
                            ->label('Warna Tema Utama')
                            ->helperText('Contoh default: #D96B43 (Terracotta MTs)'),
                        Forms\Components\ColorPicker::make('accent_color')
                            ->label('Warna Aksen / Sekunder')
                            ->helperText('Contoh default: #FFE8D6 (Cream MTs)'),
                    ])
                    ->columns(2),

                // Foto Background Slide
                Forms\Components\Section::make('Foto Background Slide')
                    ->description('Upload foto-foto background slide satu per satu (Maksimal 3 foto)')
                    ->schema([
                        MediaHelper::imageUpload('hero_image_1', 'Foto Background 1', 'website', 'banner')
                            ->required(),
                        MediaHelper::imageUpload('hero_image_2', 'Foto Background 2 (Opsional)', 'website', 'banner'),
                        MediaHelper::imageUpload('hero_image_3', 'Foto Background 3 (Opsional)', 'website', 'banner'),
                    ])
                    ->columns(3),

                // Statistik Hero Section
                Forms\Components\Section::make('Statistik Hero Section')
                    ->description('Kelola 4 kartu statistik di bagian bawah slide hero')
                    ->schema([
                        Forms\Components\Repeater::make('hero_stats')
                            ->label('Kartu Statistik')
                            ->schema([
                                Forms\Components\TextInput::make('value')
                                    ->label('Angka/Nilai')
                                    ->required()
                                    ->placeholder('Contoh: 34+ atau A'),
                                Forms\Components\TextInput::make('label')
                                    ->label('Keterangan/Label')
                                    ->required()
                                    ->placeholder('Contoh: Tahun Pengalaman'),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['label'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->maxItems(4)
                            ->default([
                                ['value' => '34+', 'label' => 'Tahun Pengalaman'],
                                ['value' => '1.000+', 'label' => 'Alumni MTs'],
                                ['value' => '2', 'label' => 'Program Unggulan'],
                                ['value' => 'A', 'label' => 'Akreditasi'],
                            ]),
                    ]),

                // Pengaturan Teks & Layout Slide
                Forms\Components\Section::make('Pengaturan Teks & Layout Slide')
                    ->description('Kelola tulisan, ukuran judul, posisi teks, warna, dan kegelapan overlay background')
                    ->schema([
                        Forms\Components\TextInput::make('hero_small_text')
                            ->label('Tulisan Kecil (Slogan Atas)')
                            ->required(),
                        Forms\Components\Select::make('hero_small_font_size')
                            ->label('Ukuran Slogan Atas')
                            ->options([
                                'text-[10px] md:text-xs' => 'Kecil (10px/xs) - Default',
                                'text-xs md:text-sm' => 'Sedang (xs/sm)',
                                'text-sm md:text-base' => 'Besar (sm/base)',
                            ])
                            ->required(),
                        Forms\Components\ColorPicker::make('hero_small_text_color')
                            ->label('Warna Slogan Atas'),
                        
                        Forms\Components\TextInput::make('hero_heading')
                            ->label('Judul Besar')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('hero_font_size')
                            ->label('Ukuran Judul Besar')
                            ->options([
                                'text-3xl md:text-5xl' => 'Kecil (3xl/5xl)',
                                'text-4xl md:text-6xl' => 'Sedang (4xl/6xl) - Default',
                                'text-5xl md:text-7xl' => 'Besar (5xl/7xl)',
                                'text-6xl md:text-8xl' => 'Sangat Besar (6xl/8xl)',
                            ])
                            ->required(),
                        Forms\Components\ColorPicker::make('hero_heading_color')
                            ->label('Warna Judul Besar'),
                            
                        Forms\Components\Textarea::make('hero_subheading')
                            ->label('Sedikit Keterangan / Deskripsi')
                            ->rows(3)
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('hero_subheading_font_size')
                            ->label('Ukuran Deskripsi')
                            ->options([
                                'text-lg md:text-xl' => 'Kecil (lg/xl)',
                                'text-xl md:text-2xl' => 'Sedang (xl/2xl) - Default',
                                'text-2xl md:text-3xl' => 'Besar (2xl/3xl)',
                            ])
                            ->required(),
                        Forms\Components\ColorPicker::make('hero_subheading_color')
                            ->label('Warna Deskripsi'),

                        Forms\Components\TextInput::make('hero_button_text')
                            ->label('Teks Tombol CTA')
                            ->required(),
                        Forms\Components\TextInput::make('hero_button_link')
                            ->label('Link Tombol CTA')
                            ->required(),
                        Forms\Components\Select::make('hero_overlay_opacity')
                            ->label('Overlay Background')
                            ->options([
                                'bg-black/30' => 'Terang (30%)',
                                'bg-black/45' => 'Sedang (45%)',
                                'bg-black/60' => 'Gelap (60%) - Default',
                                'bg-black/75' => 'Sangat Gelap (75%)',
                                'bg-black/90' => 'Hampir Hitam (90%)',
                            ])
                            ->required(),
                        
                        Forms\Components\Select::make('hero_text_position')
                            ->label('Posisi & Penyelarasan Teks')
                            ->options([
                                'items-center text-center' => 'Tengah (Center) - Default',
                                'items-start text-left' => 'Kiri (Left)',
                                'items-end text-right' => 'Kanan (Right)',
                            ])
                            ->required(),
                        Forms\Components\Select::make('hero_stats_font_size')
                            ->label('Ukuran Nilai Statistik')
                            ->options([
                                'text-2xl md:text-3xl' => 'Kecil (2xl/3xl)',
                                'text-3xl md:text-4xl' => 'Sedang (3xl/4xl)',
                                'text-4xl md:text-5xl' => 'Besar (4xl/5xl) - Default',
                                'text-5xl md:text-6xl' => 'Sangat Besar (5xl/6xl)',
                            ])
                            ->required(),
                        Forms\Components\ColorPicker::make('hero_stats_color')
                            ->label('Warna Angka/Keterangan Statistik'),
                    ])
                    ->columns(3),
                
                // Video Profil
                Forms\Components\Section::make('Video Profil Utama')
                    ->schema(MediaHelper::youtubeFields('youtube_link')),
                
                // Video Kegiatan
                Forms\Components\Section::make('Video Kegiatan / Galeri')
                    ->description('Kelola media video utama untuk bagian Keseharian & Galeri Kegiatan')
                    ->schema([
                        Forms\Components\Select::make('kegiatan_media_type')
                            ->label('Tipe Media Video')
                            ->options([
                                'youtube' => 'Link Video YouTube (Otomatis)',
                                'embed' => 'Kode Embed Kustom (Iframe HTML dari Instagram/TikTok/Facebook)',
                                'local' => 'Unggah File Video Lokal (MP4)',
                            ])
                            ->default('youtube')
                            ->reactive()
                            ->required(),
                        
                        // For YouTube Option
                        Forms\Components\TextInput::make('youtube_kegiatan_link')
                            ->label('Link Video YouTube')
                            ->placeholder('https://www.youtube.com/watch?v=...')
                            ->url()
                            ->visible(fn (Forms\Get $get) => $get('kegiatan_media_type') === 'youtube'),
                        
                        // For Custom Embed HTML Option
                        Forms\Components\Textarea::make('kegiatan_embed_code')
                            ->label('Kode Embed Kustom (HTML Iframe)')
                            ->helperText('Salin kode embed/sematkan (biasanya diawali dengan <iframe...) dari Instagram, Facebook, atau TikTok.')
                            ->rows(4)
                            ->visible(fn (Forms\Get $get) => $get('kegiatan_media_type') === 'embed'),

                        // For Local Video File Option
                        Forms\Components\FileUpload::make('kegiatan_video_file')
                            ->label('Unggah File Video (MP4)')
                            ->disk('public')
                            ->directory('videos')
                            ->visibility('public')
                            ->acceptedFileTypes(['video/mp4'])
                            ->maxSize(20480) // 20MB limit
                            ->helperText('Format: MP4. Maksimal ukuran: 20MB.')
                            ->visible(fn (Forms\Get $get) => $get('kegiatan_media_type') === 'local'),
                    ]),
                
                // Program Unggulan
                Forms\Components\Section::make('Program Unggulan')
                    ->schema([
                        Forms\Components\Repeater::make('program_unggulan')
                            ->label('Daftar Program Unggulan')
                            ->schema([
                                Forms\Components\TextInput::make('nama')
                                    ->label('Nama Program')
                                    ->required(),
                                Forms\Components\Textarea::make('deskripsi')
                                    ->label('Deskripsi')
                                    ->rows(3),
                                Forms\Components\TextInput::make('ikon')
                                    ->label('Ikon (Emoji)'),
                            ])
                            ->columns(3)
                            ->collapsible()
                            ->defaultItems(3),
                    ]),
                
                // Sejarah MTs
                Forms\Components\Section::make('Sejarah MTs')
                    ->schema([
                        Forms\Components\RichEditor::make('sejarah_mts')
                            ->label('Narasi Sejarah MTs')
                            ->required()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'link',
                            ]),
                    ]),

                // Ekstrakurikuler MTs
                Forms\Components\Section::make('Ekstrakurikuler MTs')
                    ->description('Kelola ekstrakurikuler khusus MTs (terpisah dari eskul pesantren)')
                    ->schema([
                        Forms\Components\Repeater::make('ekstrakurikuler')
                            ->label('Daftar Ekstrakurikuler')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Ekstrakurikuler')
                                    ->required()
                                    ->maxLength(255),
                                MediaHelper::imageUpload('icon', 'Foto Ekstrakurikuler', 'extracurricular', 'icon'),
                                Forms\Components\Select::make('color_classes')
                                    ->label('Tema Warna Kartu')
                                    ->options([
                                        'bg-orange-50 text-orange-700 border-orange-100' => 'Terracotta / Orange',
                                        'bg-blue-50 text-blue-700 border-blue-100' => 'Biru',
                                        'bg-purple-50 text-purple-700 border-purple-100' => 'Ungu',
                                        'bg-amber-50 text-amber-700 border-amber-100' => 'Kuning / Amber',
                                        'bg-emerald-50 text-emerald-700 border-emerald-100' => 'Hijau',
                                    ])
                                    ->default('bg-orange-50 text-orange-700 border-orange-100')
                                    ->required(),
                                Forms\Components\TextInput::make('stages')
                                    ->label('Keterangan Tingkat (misal: MTs, MTs-MA)')
                                    ->default('MTs')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->defaultItems(4),
                    ]),
                
                // CTA Pendaftaran
                Forms\Components\Section::make('CTA Pendaftaran')
                    ->schema([
                        Forms\Components\TextInput::make('cta_text')
                            ->label('Teks Tombol CTA')
                            ->default('Daftar Sekarang'),
                        Forms\Components\TextInput::make('cta_link')
                            ->label('Link Tujuan CTA')
                            ->url()
                            ->default('/pendaftaran'),
                    ])
                    ->columns(2),
                
                // Media Sosial
                Forms\Components\Section::make('Media Sosial')
                    ->schema([
                        Forms\Components\TextInput::make('instagram_link')
                            ->label('Instagram')
                            ->url(),
                        Forms\Components\TextInput::make('facebook_link')
                            ->label('Facebook')
                            ->url(),
                        Forms\Components\TextInput::make('youtube_channel_link')
                            ->label('YouTube Channel')
                            ->url(),
                        Forms\Components\TextInput::make('tiktok_link')
                            ->label('TikTok')
                            ->url(),
                        Forms\Components\TextInput::make('whatsapp_link')
                            ->label('WhatsApp')
                            ->url(),
                        Forms\Components\TextInput::make('whatsapp_admin')
                            ->label('Nomor WhatsApp Admin MTs')
                            ->tel()
                            ->placeholder('628xxxxxxxxxx')
                            ->helperText('Nomor WA untuk tombol floating button khusus MTs'),
                    ])
                    ->columns(3),

                // Kenapa Harus Kami (Value Proposition)
                Forms\Components\Section::make('Kenapa Harus Kami?')
                    ->description('Keunggulan utama yang ditawarkan MTs Al-Ittihaad')
                    ->schema([
                        Forms\Components\Repeater::make('keunggulan')
                            ->label('Daftar Keunggulan')
                            ->schema([
                                Forms\Components\TextInput::make('ikon')
                                    ->label('Ikon/Emoji')
                                    ->placeholder('🎓')
                                    ->maxLength(10),
                                Forms\Components\TextInput::make('judul')
                                    ->label('Judul Keunggulan')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('deskripsi')
                                    ->label('Deskripsi')
                                    ->required()
                                    ->rows(2),
                            ])
                            ->columns(3)
                            ->itemLabel(fn (array $state): ?string => $state['judul'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->defaultItems(4),
                    ]),

                // Kurikulum & Program Unggulan Detail
                Forms\Components\Section::make('Kurikulum & Program Unggulan')
                    ->description('Detail kurikulum Tahfidz, Dasar Bahasa Arab, dan program unggulan lainnya')
                    ->schema([
                        Forms\Components\RichEditor::make('kurikulum_detail')
                            ->label('Detail Kurikulum')
                            ->required()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'bulletList',
                                'orderedList',
                                'link',
                            ]),
                    ]),

                // Galeri Kegiatan
                Forms\Components\Section::make('Galeri Kegiatan')
                    ->description('Upload foto-foto kegiatan santri MTs')
                    ->schema([
                        Forms\Components\Repeater::make('galeri')
                            ->label('Daftar Foto Galeri')
                            ->schema([
                                MediaHelper::imageUpload('image', 'Foto Galeri', 'gallery', 'content'),
                                Forms\Components\TextInput::make('caption')->label('Caption Foto (Opsional)'),
                            ])
                            ->grid(2)
                            ->columns(1)
                            ->reorderableWithButtons()
                            ->columnSpanFull(),
                    ]),

                // Alur Pendaftaran
                Forms\Components\Section::make('Alur Pendaftaran')
                    ->description('Langkah-langkah pendaftaran santri baru')
                    ->schema([
                        Forms\Components\Repeater::make('alur_pendaftaran')
                            ->label('Langkah Pendaftaran')
                            ->schema([
                                Forms\Components\TextInput::make('langkah')
                                    ->label('Nomor Langkah')
                                    ->required()
                                    ->maxLength(10)
                                    ->default('1'),
                                Forms\Components\TextInput::make('judul')
                                    ->label('Judul Langkah')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('deskripsi')
                                    ->label('Deskripsi Langkah')
                                    ->required()
                                    ->rows(2),
                            ])
                            ->columns(3)
                            ->itemLabel(fn (array $state): ?string => $state['judul'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->defaultItems(4),
                    ]),

                // FAQ
                Forms\Components\Section::make('FAQ (Pertanyaan Umum)')
                    ->description('Pertanyaan yang sering ditanyakan oleh calon santri/wali')
                    ->schema([
                        Forms\Components\Repeater::make('faq')
                            ->label('Daftar Pertanyaan')
                            ->schema([
                                Forms\Components\TextInput::make('pertanyaan')
                                    ->label('Pertanyaan')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('jawaban')
                                    ->label('Jawaban')
                                    ->required()
                                    ->rows(3),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['pertanyaan'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->defaultItems(5),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_heading')
                    ->label('Judul Hero')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultPaginationPageOption(1)
            ->paginated([1])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMTsSetting::route('/'),
        ];
    }
}
