<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RaSettingResource\Pages;
use App\Models\RaSetting;
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

class RaSettingResource extends Resource
{
    protected static ?string $model = RaSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';
    protected static ?string $navigationGroup = 'Program Pendidikan';
    protected static ?string $modelLabel = 'Halaman RA';
    protected static ?string $pluralModelLabel = 'Pengaturan Halaman RA';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('RA Settings')
                    ->tabs([
                        Tabs\Tab::make('Hero')
                            ->schema([
                                Toggle::make('is_active_hero')->label('Aktifkan Section Hero')->default(true),
                                TextInput::make('hero_title')->label('Judul Hero')->required(),
                                TextInput::make('hero_subtitle')->label('Subjudul Hero'),
                                FileUpload::make('hero_banner')->label('Banner Hero')->image()->directory('ra'),
                                TextInput::make('hero_btn_register')->label('Teks Tombol Daftar'),
                                TextInput::make('hero_btn_activity')->label('Teks Tombol Kegiatan'),
                            ])->columns(2),

                        Tabs\Tab::make('Tentang RA')
                            ->schema([
                                Toggle::make('is_active_about')->label('Aktifkan Section Tentang RA')->default(true),
                                TextInput::make('about_title')->label('Judul Tentang RA')->columnSpanFull(),
                                RichEditor::make('about_content')->label('Konten Tentang RA')->columnSpanFull(),
                                FileUpload::make('about_image')->label('Gambar Utama RA')->image()->directory('ra')->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Program Pembelajaran')
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
                                        FileUpload::make('image')->image()->directory('ra')->required(),
                                    ])->grid(3)->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Informasi')
                            ->schema([
                                Toggle::make('is_active_info')->label('Aktifkan Section Informasi')->default(true)->columnSpanFull(),
                                TextInput::make('info_age')->label('Target Usia Anak'),
                                TextInput::make('info_schedule')->label('Jadwal Belajar'),
                                TextInput::make('info_facilities')->label('Ringkasan Fasilitas'),
                                TextInput::make('info_contact')->label('Nomor Kontak Khusus'),
                            ])->columns(2),

                        Tabs\Tab::make('CTA Penutup')
                            ->schema([
                                Toggle::make('is_active_cta')->label('Aktifkan Section CTA')->default(true)->columnSpanFull(),
                                TextInput::make('cta_title')->label('Judul CTA'),
                                TextInput::make('cta_desc')->label('Deskripsi CTA'),
                                TextInput::make('cta_btn')->label('Teks Tombol CTA'),
                                FileUpload::make('cta_bg')->label('Background CTA')->image()->directory('ra'),
                            ])->columns(2),

                        Tabs\Tab::make('Tampilan & Publish')
                            ->schema([
                                Section::make('Pengaturan Warna')
                                    ->schema([
                                        ColorPicker::make('color_primary')->label('Warna Latar (Cream hangat)')->default('#F7F1E3'),
                                        ColorPicker::make('color_button')->label('Warna Tombol (Hijau sage)')->default('#7BAE7F'),
                                        ColorPicker::make('color_card')->label('Warna Card (Putih tulang)')->default('#FFFDF8'),
                                    ])->columns(3),
                                
                                Section::make('Publish')
                                    ->schema([
                                        Toggle::make('is_publish')->label('Publish Halaman RA')->default(true),
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
            'index' => Pages\ListRaSettings::route('/'),
            'create' => Pages\CreateRaSetting::route('/create'),
            'edit' => Pages\EditRaSetting::route('/{record}/edit'),
        ];
    }
}
