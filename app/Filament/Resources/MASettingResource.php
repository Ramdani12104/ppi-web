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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MASettingResource extends Resource
{
    protected static ?string $model = MASetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationLabel = 'Pengaturan Halaman MA';
    protected static ?string $modelLabel = 'Pengaturan MA';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Identitas & Branding
                Forms\Components\Section::make('Identitas & Branding')
                    ->description('Upload logo dan atur tampilan hero section halaman MA')
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->label('Logo MA')
                            ->image()
                            ->directory('ma')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg']),
                        Forms\Components\TextInput::make('hero_heading')
                            ->label('Judul Besar Hero Section')
                            ->placeholder('Contoh: Madrasah Aliyah Al-Ittihaad')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('hero_subheading')
                            ->label('Sub-judul Hero Section')
                            ->placeholder('Contoh: Jenjang pendidikan tingkat atas yang berkomitmen...')
                            ->rows(2),
                        Forms\Components\FileUpload::make('hero_banner')
                            ->label('Gambar Background Hero')
                            ->image()
                            ->directory('ma')
                            ->required(),
                        Forms\Components\TextInput::make('hero_title')
                            ->label('Judul Sambutan')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                // Video Profile
                Forms\Components\Section::make('Video Profil')
                    ->description('Link YouTube untuk video profil kegiatan MA')
                    ->schema([
                        Forms\Components\TextInput::make('youtube_link')
                            ->label('Link YouTube Video Profil MA')
                            ->url()
                            ->placeholder('https://www.youtube.com/embed/...')
                            ->required(),
                    ]),

                // Program Jurusan (Dynamic Content)
                Forms\Components\Section::make('Program Peminatan (Jurusan)')
                    ->description('Kelola 3 jurusan (IIK, IPA, IPS) dengan detail lengkap')
                    ->schema([
                        Forms\Components\Repeater::make('jurusan')
                            ->schema([
                                Forms\Components\FileUpload::make('icon')
                                    ->label('Icon/Gambar Jurusan')
                                    ->image()
                                    ->directory('ma/jurusan')
                                    ->maxFiles(1),
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
                                Forms\Components\FileUpload::make('foto')
                                    ->label('Foto Fasilitas')
                                    ->image()
                                    ->directory('ma/fasilitas')
                                    ->required(),
                                Forms\Components\TextInput::make('nama')
                                    ->label('Nama Fasilitas')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->columns(2)
                            ->itemLabel(fn (array $state): ?string => $state['nama'] ?? null)
                            ->reorderableWithButtons()
                            ->collapsible(),
                        Forms\Components\TagsInput::make('eskul')
                            ->label('Daftar Ekstrakurikuler')
                            ->placeholder('Contoh: Pramuka, PMR, Paskibra, Rohis, Futsal, Basket')
                            ->separator(','),
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
                        Forms\Components\FileUpload::make('galeri')
                            ->label('Foto Galeri')
                            ->image()
                            ->directory('ma/galeri')
                            ->multiple()
                            ->reorderable()
                            ->maxFiles(20)
                            ->helperText('Upload hingga 20 foto kegiatan santri'),
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
            'index' => Pages\ListMASettings::route('/'),
            'create' => Pages\CreateMASetting::route('/create'),
            'edit' => Pages\EditMASetting::route('/{record}/edit'),
        ];
    }
}
