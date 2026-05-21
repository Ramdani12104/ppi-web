<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SditSettingResource\Pages;
use App\Models\SditSetting;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class SditSettingResource extends Resource
{
    protected static ?string $model = SditSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Program Pendidikan';
    protected static ?string $modelLabel = 'Halaman SDIT';
    protected static ?string $pluralModelLabel = 'Pengaturan Halaman SDIT';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('SDIT Settings')
                    ->tabs([
                        Tabs\Tab::make('Hero')
                            ->schema([
                                Toggle::make('is_active_hero')->label('Aktifkan Section Hero')->default(true),
                                TextInput::make('hero_title')->label('Judul Hero')->required(),
                                TextInput::make('hero_subtitle')->label('Subjudul Hero'),
                                FileUpload::make('hero_banner')->label('Banner Hero')->image()->directory('sdit'),
                                TextInput::make('hero_btn_register')->label('Teks Tombol Daftar'),
                                TextInput::make('hero_btn_activity')->label('Teks Tombol Kegiatan'),
                            ])->columns(2),

                        Tabs\Tab::make('Tentang SDIT')
                            ->schema([
                                Toggle::make('is_active_about')->label('Aktifkan Section Tentang SDIT')->default(true),
                                TextInput::make('about_title')->label('Judul Tentang SDIT')->columnSpanFull(),
                                RichEditor::make('about_content')->label('Konten Tentang SDIT')->columnSpanFull(),
                                FileUpload::make('about_image')->label('Gambar Utama SDIT')->image()->directory('sdit')->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Program Unggulan')
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

                        Tabs\Tab::make('Keunggulan')
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

                        Tabs\Tab::make('Galeri')
                            ->schema([
                                Toggle::make('is_active_gallery')->label('Aktifkan Section Galeri')->default(true),
                                Repeater::make('galleries')
                                    ->relationship()
                                    ->schema([
                                        FileUpload::make('image')->image()->directory('sdit')->required(),
                                    ])->grid(3)->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Prestasi')
                            ->schema([
                                Toggle::make('is_active_achievements')->label('Aktifkan Section Prestasi')->default(true),
                                Repeater::make('achievements')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('title')->label('Nama Prestasi')->required(),
                                        Textarea::make('description')->label('Deskripsi Prestasi (Tahun/Juara)'),
                                        FileUpload::make('image')->label('Foto Prestasi')->image()->directory('sdit'),
                                    ])->columns(3)->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Informasi')
                            ->schema([
                                Toggle::make('is_active_info')->label('Aktifkan Section Informasi')->default(true)->columnSpanFull(),
                                TextInput::make('info_schedule')->label('Jadwal Belajar'),
                                TextInput::make('info_facilities')->label('Ringkasan Fasilitas'),
                                TextInput::make('info_contact')->label('Nomor Kontak Khusus'),
                                Textarea::make('info_address')->label('Alamat SDIT')->columnSpanFull(),
                            ])->columns(2),

                        Tabs\Tab::make('CTA Penutup')
                            ->schema([
                                Toggle::make('is_active_cta')->label('Aktifkan Section CTA')->default(true)->columnSpanFull(),
                                TextInput::make('cta_title')->label('Judul CTA'),
                                TextInput::make('cta_desc')->label('Deskripsi CTA'),
                                TextInput::make('cta_btn')->label('Teks Tombol CTA'),
                                FileUpload::make('cta_bg')->label('Background CTA')->image()->directory('sdit'),
                            ])->columns(2),

                        Tabs\Tab::make('Tampilan & Publish')
                            ->schema([
                                Section::make('Pengaturan Warna')
                                    ->schema([
                                        ColorPicker::make('color_primary')->label('Warna Latar (Putih Bersih)')->default('#ffffff'),
                                        ColorPicker::make('color_button')->label('Warna Tombol (Hijau Islami)')->default('#059669'),
                                        ColorPicker::make('color_card')->label('Warna Card (Cream Lembut)')->default('#fef3c7'),
                                    ])->columns(3),
                                
                                Section::make('Publish')
                                    ->schema([
                                        Toggle::make('is_publish')->label('Publish Halaman SDIT')->default(true),
                                    ]),
                            ]),
                    ])->columnSpanFull()
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
            'index' => Pages\ListSditSettings::route('/'),
            'create' => Pages\CreateSditSetting::route('/create'),
            'edit' => Pages\EditSditSetting::route('/{record}/edit'),
        ];
    }
}
