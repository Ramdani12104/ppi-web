<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MASettingResource\Pages;
use App\Filament\Resources\MASettingResource\RelationManagers;
use App\Models\MASetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Helpers\MediaHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MASettingResource extends Resource
{
    protected static ?string $model = MASetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Program Pendidikan';
    protected static ?string $navigationLabel = 'Pengaturan Halaman MA';
    protected static ?string $modelLabel = 'Pengaturan MA';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Logo & Identitas
                Forms\Components\Section::make('Logo & Identitas')
                    ->description('Kelola logo sekolah dan teks sambutan')
                    ->schema([
                        MediaHelper::imageUpload('logo', 'Logo MA', 'website', 'logo'),
                        Forms\Components\TextInput::make('hero_title')
                            ->label('Judul Sambutan')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                // Warna Tema Halaman
                Forms\Components\Section::make('Warna Tema Halaman')
                    ->description('Atur warna tema utama dan aksen untuk seluruh halaman ini')
                    ->schema([
                        Forms\Components\ColorPicker::make('primary_color')
                            ->label('Warna Tema Utama')
                            ->helperText('Contoh default: #1a4d2e (Hijau Hutan MA)'),
                        Forms\Components\ColorPicker::make('accent_color')
                            ->label('Warna Aksen / Sekunder')
                            ->helperText('Contoh default: #d4af37 (Gold MA)'),
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
                                    ->placeholder('Contoh: 32+ atau A'),
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
                                ['value' => '32+', 'label' => 'Tahun Pengalaman'],
                                ['value' => '500+', 'label' => 'Alumni'],
                                ['value' => '3', 'label' => 'Program Peminatan'],
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

                // Video Profile
                Forms\Components\Section::make('Video Profil')
                    ->description('Link YouTube untuk video profil kegiatan MA')
                    ->schema(MediaHelper::youtubeFields('youtube_link')),

                // Program Jurusan (Dynamic Content)
                Forms\Components\Section::make('Program Peminatan (Jurusan)')
                    ->description('Kelola 3 jurusan (IIK, IPA, IPS) dengan detail lengkap')
                    ->schema([
                        Forms\Components\Repeater::make('jurusan')
                            ->schema([
                                MediaHelper::imageUpload('icon', 'Icon/Gambar Jurusan', 'jenjang', 'avatar'),
                                Forms\Components\TextInput::make('emoji')
                                    ->label('Emoji (opsional, jika tidak ada gambar)')
                                    ->placeholder('📚')
                                    ->maxLength(10),
                                Forms\Components\TextInput::make('nama')
                                    ->label('Nama Jurusan')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('subjudul')
                                    ->label('Sub-judul Jurusan')
                                    ->placeholder('Contoh: Ilmu-Ilmu Keagamaan')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('deskripsi')
                                    ->label('Deskripsi Jurusan')
                                    ->required()
                                    ->rows(3),
                                Forms\Components\TagsInput::make('tags')
                                    ->label('Tags/Keunggulan')
                                    ->placeholder('Contoh: Kitab Kuning, Bahasa Arab'),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['nama'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->minItems(3)
                            ->default([
                                ['nama' => 'IIK', 'subjudul' => 'Ilmu-Ilmu Keagamaan', 'deskripsi' => 'Fokus pendalaman Kitab Kuning, Fiqih, Tafsir, Hadits, dan kaderisasi ulama untuk melanjutkan tradisi keilmuan Islam.', 'emoji' => '📚'],
                                ['nama' => 'IPA', 'subjudul' => 'Ilmu Pengetahuan Alam', 'deskripsi' => 'Fokus Sains dan Teknologi berlandaskan Islam untuk mencetak saintis Muslim yang inovatif dan berwawasan global.', 'emoji' => '🔬'],
                                ['nama' => 'IPS', 'subjudul' => 'Ilmu Pengetahuan Sosial', 'deskripsi' => 'Fokus pengembangan intelektual, studi sosial, dan sejarah Muslim untuk mencetak pemikir dan pemimpin sosial.', 'emoji' => '🌍'],
                            ]),
                    ]),

                // Sejarah & Narasi
                Forms\Components\Section::make('Sejarah & Narasi')
                    ->description('Kelola konten sejarah dan tombol navigasi')
                    ->schema([
                        Forms\Components\RichEditor::make('sejarah_ma')
                            ->label('Narasi Sejarah MA')
                            ->required()
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'bulletList',
                                'orderedList',
                                'link',
                                'undo',
                                'redo',
                            ]),
                        Forms\Components\TextInput::make('sejarah_button_text')
                            ->label('Teks Tombol Sejarah Pusat')
                            ->placeholder('Contoh: Pelajari Sejarah Lengkap Pesantren')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                // Fasilitas & Eskul
                Forms\Components\Section::make('Fasilitas & Ekstrakurikuler')
                    ->description('Upload foto fasilitas dan daftar eskul MA')
                    ->schema([
                        Forms\Components\Repeater::make('fasilitas')
                            ->label('Foto Fasilitas')
                            ->schema([
                                MediaHelper::imageUpload('foto', 'Foto Fasilitas', 'gallery', 'content'),
                                Forms\Components\TextInput::make('nama')
                                    ->label('Nama Fasilitas')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['nama'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible(),
                        Forms\Components\Repeater::make('eskul')
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
                                        'bg-[#1a4d2e] text-emerald-100 border-[#1a4d2e]/20' => 'Hijau MA (Primary)',
                                        'bg-emerald-50 text-emerald-700 border-emerald-100' => 'Hijau Terang',
                                    ])
                                    ->default('bg-[#1a4d2e] text-emerald-100 border-[#1a4d2e]/20')
                                    ->required(),
                                Forms\Components\TextInput::make('stages')
                                    ->label('Keterangan Tingkat (misal: MA, MTs-MA)')
                                    ->default('MA')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible(),
                    ]),

                // Media Sosial & Kontak
                Forms\Components\Section::make('Media Sosial & Kontak Khusus MA')
                    ->description('Link media sosial dan kontak admin MA')
                    ->schema([
                        Forms\Components\TextInput::make('instagram_link')
                            ->label('Link Instagram')
                            ->url()
                            ->placeholder('https://instagram.com/...'),
                        Forms\Components\TextInput::make('facebook_link')
                            ->label('Link Facebook')
                            ->url()
                            ->placeholder('https://facebook.com/...'),
                        Forms\Components\TextInput::make('youtube_channel_link')
                            ->label('Link YouTube Channel')
                            ->url()
                            ->placeholder('https://youtube.com/@...'),
                        Forms\Components\TextInput::make('tiktok_link')
                            ->label('Link TikTok')
                            ->url()
                            ->placeholder('https://tiktok.com/@...'),
                        Forms\Components\TextInput::make('whatsapp_link')
                            ->label('Link WhatsApp')
                            ->url()
                            ->placeholder('https://wa.me/628xxxxxxxxxx'),
                        Forms\Components\TextInput::make('whatsapp_admin')
                            ->label('Nomor WhatsApp Admin MA')
                            ->tel()
                            ->placeholder('628xxxxxxxxxx')
                            ->helperText('Nomor WA untuk tombol floating button khusus MA'),
                    ])
                    ->columns(3),

                // Kenapa Harus Kami (Value Proposition)
                Forms\Components\Section::make('Kenapa Harus Kami?')
                    ->description('Keunggulan utama yang ditawarkan MA Al-Ittihaad')
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
                    ->description('Detail kurikulum KTI, P2M, dan program unggulan lainnya')
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
                    ->description('Upload foto-foto kegiatan santri MA')
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
                    ->searchable()
                    ->limit(50),
                Tables\Columns\ImageColumn::make('hero_banner')
                    ->label('Banner'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
            ])
            ->defaultPaginationPageOption(1)
            ->paginated([1]);
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
            'index' => Pages\ManageMASetting::route('/'),
        ];
    }
}
