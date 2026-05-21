<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaranaSettingResource\Pages;
use App\Models\SaranaSetting;
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
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class SaranaSettingResource extends Resource
{
    protected static ?string $model = SaranaSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Profil Pesantren';
    protected static ?string $modelLabel = 'Halaman Sarana';
    protected static ?string $pluralModelLabel = 'Pengaturan Sarana & Prasarana';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Sarana Settings')
                    ->tabs([
                        Tabs\Tab::make('Hero')
                            ->schema([
                                Toggle::make('is_active_hero')->label('Aktifkan Section Hero')->default(true),
                                TextInput::make('hero_title')->label('Judul Hero')->required(),
                                TextInput::make('hero_subtitle')->label('Subjudul Hero'),
                                FileUpload::make('hero_banner')->label('Banner Hero')->image()->directory('sarana'),
                            ]),

                        Tabs\Tab::make('Pengantar')
                            ->schema([
                                Toggle::make('is_active_intro')->label('Aktifkan Section Pengantar')->default(true),
                                TextInput::make('intro_title')->label('Judul Pengantar')->columnSpanFull(),
                                RichEditor::make('intro_content')->label('Konten Pengantar')->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Daftar Fasilitas')
                            ->schema([
                                Toggle::make('is_active_facilities')->label('Aktifkan Section Fasilitas')->default(true),
                                Repeater::make('facilities')
                                    ->relationship()
                                    ->schema([
                                        TextInput::make('title')->label('Nama Fasilitas')->required(),
                                        TextInput::make('icon')->label('Icon/Emoji'),
                                        Textarea::make('description')->label('Deskripsi Fasilitas'),
                                        FileUpload::make('image')->label('Foto Fasilitas')->image()->directory('sarana'),
                                    ])->columns(2)->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Galeri Sarana')
                            ->schema([
                                Toggle::make('is_active_gallery')->label('Aktifkan Section Galeri')->default(true),
                                Repeater::make('galleries')
                                    ->relationship()
                                    ->schema([
                                        FileUpload::make('image')->image()->directory('sarana')->required(),
                                        TextInput::make('caption')->label('Caption Gambar'),
                                    ])->grid(3)->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Lingkungan')
                            ->schema([
                                Toggle::make('is_active_env')->label('Aktifkan Section Lingkungan')->default(true),
                                TextInput::make('env_title')->label('Judul Lingkungan')->columnSpanFull(),
                                RichEditor::make('env_content')->label('Deskripsi Suasana Lingkungan')->columnSpanFull(),
                            ]),

                        Tabs\Tab::make('Penutup & Publish')
                            ->schema([
                                Toggle::make('is_active_cta')->label('Aktifkan Section CTA')->default(true)->columnSpanFull(),
                                TextInput::make('cta_title')->label('Judul CTA'),
                                TextInput::make('cta_desc')->label('Deskripsi CTA'),
                                TextInput::make('cta_btn')->label('Teks Tombol CTA'),
                                FileUpload::make('cta_bg')->label('Background CTA')->image()->directory('sarana'),
                                
                                Section::make('Publish')
                                    ->schema([
                                        Toggle::make('is_publish')->label('Publish Halaman')->default(true),
                                    ]),
                            ])->columns(2),
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
            'index' => Pages\ListSaranaSettings::route('/'),
            'create' => Pages\CreateSaranaSetting::route('/create'),
            'edit' => Pages\EditSaranaSetting::route('/{record}/edit'),
        ];
    }
}
