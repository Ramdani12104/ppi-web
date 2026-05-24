<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KoberSettingResource\Pages;
use App\Models\KoberSetting;
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

class KoberSettingResource extends Resource
{
    protected static ?string $model = KoberSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-face-smile';
    protected static ?string $navigationGroup = 'Program Pendidikan';
    protected static ?string $modelLabel = 'Halaman Kober';
    protected static ?string $pluralModelLabel = 'Pengaturan Halaman Kober';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero')
                    ->description('Atur tampilan bagian teratas (Hero) halaman Kober')
                    ->schema([
                        Toggle::make('is_active_hero')->label('Aktifkan Section Hero')->default(true)->columnSpanFull(),
                        TextInput::make('hero_title')->label('Judul Hero')->required(),
                        TextInput::make('hero_subtitle')->label('Subjudul Hero'),
                        MediaHelper::imageUpload('hero_banner', 'Banner Hero', 'jenjang', 'banner'),
                        TextInput::make('hero_btn_register')->label('Teks Tombol Daftar'),
                        TextInput::make('hero_btn_activity')->label('Teks Tombol Kegiatan'),
                    ])->columns(2),

                Section::make('Tentang Kober')
                    ->description('Informasi deskripsi umum mengenai Kober')
                    ->schema([
                        Toggle::make('is_active_about')->label('Aktifkan Section Tentang Kober')->default(true),
                        TextInput::make('about_title')->label('Judul Tentang Kober')->columnSpanFull(),
                        RichEditor::make('about_content')->label('Konten Tentang Kober')->columnSpanFull(),
                        MediaHelper::imageUpload('about_image', 'Gambar Utama Kober', 'jenjang', 'content')->columnSpanFull(),
                    ]),

                Section::make('Video Profil Kober')
                    ->description('Masukkan link video YouTube untuk mengenalkan Kober secara visual')
                    ->schema(MediaHelper::youtubeFields('youtube_link')),

                Section::make('Program Pembelajaran (Program Anak)')
                    ->description('Kelola program pembelajaran anak di Kober')
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

                Section::make('Keunggulan')
                    ->description('Mengapa memilih Kober kami')
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

                Section::make('Galeri')
                    ->description('Galeri foto keceriaan anak Kober')
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

                Section::make('Informasi Pendaftaran')
                    ->description('Detail ringkas target usia, jadwal, dan kontak')
                    ->schema([
                        Toggle::make('is_active_info')->label('Aktifkan Section Informasi')->default(true)->columnSpanFull(),
                        TextInput::make('info_age')->label('Target Usia Anak'),
                        TextInput::make('info_schedule')->label('Jadwal Belajar'),
                        TextInput::make('info_facilities')->label('Ringkasan Fasilitas'),
                        TextInput::make('info_contact')->label('Nomor Kontak Khusus'),
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
                    ->description('Atur warna tema dan status publikasi halaman Kober')
                    ->schema([
                        Section::make('Pengaturan Warna')
                            ->schema([
                                ColorPicker::make('color_primary')->label('Warna Utama (Background soft)')->default('#fef3c7'),
                                ColorPicker::make('color_button')->label('Warna Tombol')->default('#f59e0b'),
                                ColorPicker::make('color_card')->label('Warna Card')->default('#ffffff'),
                            ])->columns(3),
                        
                        Section::make('Publish')
                            ->schema([
                                Toggle::make('is_publish')->label('Publish Halaman Kober')->default(true),
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
            'index' => Pages\ManageKoberSetting::route('/'),
        ];
    }
}
