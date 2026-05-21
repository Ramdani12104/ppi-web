<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TokohPendiriSettingResource\Pages;
use App\Models\TokohPendiriSetting;
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

class TokohPendiriSettingResource extends Resource
{
    protected static ?string $model = TokohPendiriSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Profil Pesantren';
    protected static ?string $modelLabel = 'Halaman Tokoh Pendiri';
    protected static ?string $pluralModelLabel = 'Pengaturan Tokoh Pendiri';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Pendiri Settings')
                    ->tabs([
                        Tabs\Tab::make('Hero')
                            ->schema([
                                TextInput::make('hero_title')->label('Judul Hero')->required(),
                                TextInput::make('hero_subtitle')->label('Subjudul Hero'),
                                FileUpload::make('hero_banner')->label('Banner Hero')->image()->directory('pendiri'),
                            ]),

                        Tabs\Tab::make('Sejarah')
                            ->schema([
                                TextInput::make('history_title')->label('Judul Sejarah Awal Mula')->columnSpanFull(),
                                RichEditor::make('history_content')->label('Konten Sejarah')->columnSpanFull(),
                                FileUpload::make('history_image')->label('Gambar Sejarah')->image()->directory('pendiri')->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Keluarga Pendiri')
                            ->schema([
                                Repeater::make('families')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('name')->label('Nama Keluarga (Contoh: Bani Mahfudz)')->required(),
                                        Textarea::make('description')->label('Deskripsi Singkat'),
                                        FileUpload::make('image')->label('Foto/Ilustrasi')->image()->directory('pendiri'),
                                    ])->columns(3)->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Timeline Perjuangan')
                            ->schema([
                                Repeater::make('timelines')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('year')->label('Tahun (Contoh: 1980)')->required(),
                                        TextInput::make('title')->label('Judul Momen')->required(),
                                        Textarea::make('description')->label('Deskripsi Peristiwa'),
                                    ])->columns(3)->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Nilai & Warisan')
                            ->schema([
                                TextInput::make('values_title')->label('Judul Nilai Perjuangan')->columnSpanFull(),
                                RichEditor::make('values_content')->label('Konten Nilai Perjuangan')->columnSpanFull(),
                                TextInput::make('quote_text')->label('Teks Kutipan Islami')->columnSpanFull(),
                                TextInput::make('quote_author')->label('Sumber Kutipan'),
                            ]),

                        Tabs\Tab::make('Galeri')
                            ->schema([
                                Repeater::make('galleries')
                                    ->relationship()
                                    ->schema([
                                        FileUpload::make('image')->image()->directory('pendiri')->required(),
                                        TextInput::make('caption')->label('Caption Gambar'),
                                    ])->grid(3)->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Penutup')
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
            'index' => Pages\ListTokohPendiriSettings::route('/'),
            'create' => Pages\CreateTokohPendiriSetting::route('/create'),
            'edit' => Pages\EditTokohPendiriSetting::route('/{record}/edit'),
        ];
    }
}
