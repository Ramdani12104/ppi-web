<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TokohPendiriSettingResource\Pages;
use App\Models\TokohPendiriSetting;
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

class TokohPendiriSettingResource extends Resource
{
    protected static ?string $model = TokohPendiriSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Profil Pesantren';
    protected static ?string $modelLabel = 'Tokoh Pendiri';
    protected static ?string $pluralModelLabel = 'Tokoh Pendiri';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero')
                    ->description('Atur gambar background dan judul di atas halaman Tokoh Pendiri')
                    ->schema([
                        TextInput::make('hero_title')->label('Judul Hero')->required(),
                        TextInput::make('hero_subtitle')->label('Subjudul Hero'),
                        MediaHelper::imageUpload('hero_banner', 'Banner Hero', 'jenjang', 'banner'),
                    ]),

                Section::make('Sejarah')
                    ->description('Teks sejarah pendirian awal mula pesantren')
                    ->schema([
                        TextInput::make('history_title')->label('Judul Sejarah Awal Mula')->columnSpanFull(),
                        RichEditor::make('history_content')->label('Konten Sejarah')->columnSpanFull(),
                        MediaHelper::imageUpload('history_image', 'Gambar Sejarah', 'gallery', 'content')->columnSpanFull(),
                    ]),

                Section::make('Keluarga Pendiri')
                    ->description('Informasi keluarga atau tokoh penerus perjuangan pesantren')
                    ->schema([
                        Repeater::make('families')
                            ->relationship()
                            ->schema([
                                TextInput::make('name')->label('Nama Keluarga (Contoh: Bani Mahfudz)')->required(),
                                Textarea::make('description')->label('Deskripsi Singkat'),
                                MediaHelper::imageUpload('image', 'Foto/Ilustrasi', 'gallery', 'avatar'),
                            ])->columns(3)->columnSpanFull(),
                    ]),

                Section::make('Timeline Perjuangan')
                    ->description('Kronologis peristiwa-peristiwa penting pesantren')
                    ->schema([
                        Repeater::make('timelines')
                            ->relationship()
                            ->schema([
                                TextInput::make('year')->label('Tahun (Contoh: 1980)')->required(),
                                TextInput::make('title')->label('Judul Momen')->required(),
                                Textarea::make('description')->label('Deskripsi Peristiwa'),
                            ])->columns(3)->columnSpanFull(),
                    ]),

                Section::make('Nilai & Warisan')
                    ->description('Nilai-nilai kepesantrenan dan amanah kutipan pendiri')
                    ->schema([
                        TextInput::make('values_title')->label('Judul Nilai Perjuangan')->columnSpanFull(),
                        RichEditor::make('values_content')->label('Konten Nilai Perjuangan')->columnSpanFull(),
                        TextInput::make('quote_text')->label('Teks Kutipan Islami')->columnSpanFull(),
                        TextInput::make('quote_author')->label('Sumber Kutipan'),
                    ]),

                Section::make('Galeri')
                    ->description('Galeri foto dokumentasi sejarah dan tokoh pendiri')
                    ->schema([
                        Repeater::make('galleries')
                            ->relationship()
                            ->schema([
                                MediaHelper::imageUpload('image', 'Foto Dokumentasi', 'gallery', 'content'),
                                TextInput::make('caption')->label('Caption Gambar'),
                                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                            ])
                            ->orderColumn('sort_order')
                            ->grid(3)->columnSpanFull(),
                    ]),

                Section::make('Penutup')
                    ->description('Teks ajakan akhir, warna tema, dan status publikasi halaman')
                    ->schema([
                        TextInput::make('cta_title')->label('Judul Penutup'),
                        Textarea::make('cta_desc')->label('Deskripsi Penutup'),
                        
                        Section::make('Warna Tema')
                            ->schema([
                                ColorPicker::make('color_primary')->label('Warna Latar (Cream)')->default('#fefaf4'),
                                ColorPicker::make('color_accent')->label('Warna Aksen (Hijau)')->default('#2a5f4c'),
                                ColorPicker::make('color_card')->label('Warna Card (Coklat)')->default('#d6c7b0'),
                            ])->columns(3),
                        
                        Toggle::make('is_publish')->label('Publish Halaman')->default(true),
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
            'index' => Pages\ManageTokohPendiriSetting::route('/'),
        ];
    }
}
