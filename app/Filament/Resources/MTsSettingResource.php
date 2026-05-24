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
                // Hero Section
                Forms\Components\Section::make('Hero Section')
                    ->schema([
                        MediaHelper::imageUpload('logo', 'Logo MTs', 'website', 'logo'),
                        MediaHelper::imageUpload('hero_banner', 'Gambar Background Hero', 'jenjang', 'banner'),
                        Forms\Components\TextInput::make('hero_heading')
                            ->label('Judul Utama Hero')
                            ->required()
                            ->default('Madrasah Tsanawiyah'),
                        Forms\Components\TextInput::make('hero_subheading')
                            ->label('Sub-judul Hero')
                            ->default('Pendidikan Menengah Berbasis Adab'),
                    ])
                    ->columns(2),
                
                // Video Profil
                Forms\Components\Section::make('Video Profil')
                    ->schema(MediaHelper::youtubeFields('youtube_link')),
                
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
