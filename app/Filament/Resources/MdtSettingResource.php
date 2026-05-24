<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MdtSettingResource\Pages;
use App\Models\MdtSetting;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use App\Helpers\MediaHelper;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class MdtSettingResource extends Resource
{
    protected static ?string $model = MdtSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Program Pendidikan';
    protected static ?string $modelLabel = 'Halaman MDT';
    protected static ?string $pluralModelLabel = 'Pengaturan Halaman MDT';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero')
                    ->description('Atur tampilan bagian teratas (Hero) halaman MDT')
                    ->schema([
                        Toggle::make('is_active_hero')->label('Aktifkan Section Hero')->default(true)->columnSpanFull(),
                        TextInput::make('hero_title')->label('Judul Hero')->required(),
                        TextInput::make('hero_subtitle')->label('Subjudul Hero'),
                        MediaHelper::imageUpload('hero_banner', 'Banner Hero', 'jenjang', 'banner'),
                        TextInput::make('hero_btn_register')->label('Teks Tombol Daftar'),
                        TextInput::make('hero_btn_activity')->label('Teks Tombol Kegiatan'),
                    ])->columns(2),

                Section::make('Tentang MDT')
                    ->description('Informasi deskripsi umum mengenai MDT')
                    ->schema([
                        Toggle::make('is_active_about')->label('Aktifkan Section Tentang MDT')->default(true),
                        TextInput::make('about_title')->label('Judul Tentang MDT')->columnSpanFull(),
                        RichEditor::make('about_content')->label('Konten Tentang MDT')->columnSpanFull(),
                        MediaHelper::imageUpload('about_image', 'Gambar Utama MDT', 'jenjang', 'content')->columnSpanFull(),
                    ]),

                Section::make('Video Profil MDT')
                    ->description('Masukkan link video YouTube untuk mengenalkan MDT secara visual')
                    ->schema(MediaHelper::youtubeFields('youtube_link')),

                Section::make('Program Pembelajaran')
                    ->description('Kelola program pembelajaran di MDT')
                    ->schema([
                        Toggle::make('is_active_programs')->label('Aktifkan Section Program')->default(true),
                        Repeater::make('programs')
                            ->relationship()
                            ->schema([
                                TextInput::make('icon')->label('Icon/Emoji (Opsional)'),
                                TextInput::make('title')->label('Judul Program')->required(),
                                Textarea::make('description')->label('Deskripsi Program'),
                            ])->columns(3)->columnSpanFull(),
                    ]),

                Section::make('Keunggulan MDT')
                    ->description('Mengapa memilih MDT kami')
                    ->schema([
                        Toggle::make('is_active_advantages')->label('Aktifkan Section Keunggulan')->default(true),
                        Repeater::make('advantages')
                            ->relationship()
                            ->schema([
                                TextInput::make('icon')->label('Icon/Emoji (Opsional)'),
                                TextInput::make('title')->label('Judul Keunggulan')->required(),
                                Textarea::make('description')->label('Deskripsi Keunggulan'),
                            ])->columns(3)->columnSpanFull(),
                    ]),

                Section::make('Galeri Kegiatan')
                    ->description('Galeri foto kegiatan santri MDT')
                    ->schema([
                        Toggle::make('is_active_gallery')->label('Aktifkan Section Galeri')->default(true),
                        Repeater::make('galleries')
                            ->relationship()
                            ->schema([
                                MediaHelper::imageUpload('image', 'Foto Galeri', 'gallery', 'content'),
                                TextInput::make('caption')->label('Caption Foto (Opsional)'),
                            ])
                            ->grid(2)
                            ->columns(1)
                            ->reorderableWithButtons()
                            ->orderColumn('sort_order')
                            ->columnSpanFull(),
                    ]),

                Section::make('Jadwal & Informasi')
                    ->description('Detail ringkas jadwal, target usia, fasilitas, dan kontak admin')
                    ->schema([
                        Toggle::make('is_active_info')->label('Aktifkan Section Informasi')->default(true)->columnSpanFull(),
                        TextInput::make('info_schedule')->label('Jadwal Belajar Sore'),
                        TextInput::make('info_age')->label('Usia Santri'),
                        TextInput::make('info_facilities')->label('Fasilitas MDT'),
                        TextInput::make('info_contact')->label('Kontak Admin MDT'),
                    ])->columns(2),

                Section::make('CTA Penutup')
                    ->description('Ajakan bertindak / pendaftaran di bagian bawah halaman')
                    ->schema([
                        Toggle::make('is_active_cta')->label('Aktifkan Section CTA')->default(true)->columnSpanFull(),
                        TextInput::make('cta_title')->label('Judul CTA'),
                        TextInput::make('cta_desc')->label('Deskripsi CTA'),
                        TextInput::make('cta_btn')->label('Teks Tombol CTA'),
                        MediaHelper::imageUpload('cta_bg', 'Background CTA', 'jenjang', 'banner'),
                    ])->columns(2),

                Section::make('Tampilan & Publish')
                    ->description('Atur warna tema dan status publikasi halaman MDT')
                    ->schema([
                        Section::make('Pengaturan Warna')
                            ->schema([
                                ColorPicker::make('color_primary')->label('Warna Latar (Putih Tulang / Cream Hangat)')->default('#fefaf4'),
                                ColorPicker::make('color_button')->label('Warna Tombol (Hijau Pesantren Lembut)')->default('#2a5f4c'),
                                ColorPicker::make('color_card')->label('Warna Card (Coklat Kitab / Gold Lembut)')->default('#d6c7b0'),
                            ])->columns(3),
                        
                        Section::make('Publish')
                            ->schema([
                                Toggle::make('is_publish')->label('Publish Halaman MDT')->default(true),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hero_title')->label('Judul Hero')->searchable(),
                IconColumn::make('is_publish')->label('Published')->boolean(),
                TextColumn::make('updated_at')->label('Terakhir Diupdate')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMdtSetting::route('/'),
        ];
    }
}
