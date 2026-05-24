<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SaranaSettingResource\Pages;
use App\Models\SaranaSetting;
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
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class SaranaSettingResource extends Resource
{
    protected static ?string $model = SaranaSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Profil Pesantren';
    protected static ?string $modelLabel = 'Sarana & Prasarana';
    protected static ?string $pluralModelLabel = 'Sarana & Prasarana';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero')
                    ->description('Atur gambar background dan judul di atas halaman Sarana')
                    ->schema([
                        Toggle::make('is_active_hero')->label('Aktifkan Section Hero')->default(true)->columnSpanFull(),
                        TextInput::make('hero_title')->label('Judul Hero')->required(),
                        TextInput::make('hero_subtitle')->label('Subjudul Hero'),
                        MediaHelper::imageUpload('hero_banner', 'Banner Hero', 'jenjang', 'banner'),
                    ]),

                Section::make('Pengantar')
                    ->description('Teks pengantar informasi sarana & prasarana')
                    ->schema([
                        Toggle::make('is_active_intro')->label('Aktifkan Section Pengantar')->default(true),
                        TextInput::make('intro_title')->label('Judul Pengantar')->columnSpanFull(),
                        RichEditor::make('intro_content')->label('Konten Pengantar')->columnSpanFull(),
                    ]),

                Section::make('Daftar Fasilitas')
                    ->description('Daftar item sarana prasarana yang dimiliki pesantren')
                    ->schema([
                        Toggle::make('is_active_facilities')->label('Aktifkan Section Fasilitas')->default(true),
                        Repeater::make('facilities')
                            ->relationship()
                            ->schema([
                                TextInput::make('title')->label('Nama Fasilitas')->required(),
                                TextInput::make('icon')->label('Icon/Emoji'),
                                Textarea::make('description')->label('Deskripsi Fasilitas'),
                                MediaHelper::imageUpload('image', 'Foto Fasilitas', 'gallery', 'content'),
                            ])->columns(2)->columnSpanFull(),
                    ]),

                Section::make('Galeri Sarana')
                    ->description('Koleksi foto lingkungan dan sarana fisik')
                    ->schema([
                        Toggle::make('is_active_gallery')->label('Aktifkan Section Galeri')->default(true),
                        Repeater::make('galleries')
                            ->relationship()
                            ->schema([
                                MediaHelper::imageUpload('image', 'Foto Galeri', 'gallery', 'content'),
                                TextInput::make('caption')->label('Caption Gambar'),
                                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                            ])
                            ->orderColumn('sort_order')
                            ->grid(3)->columnSpanFull(),
                    ]),

                Section::make('Lingkungan')
                    ->description('Informasi deskripsi suasana lingkungan dan keasrian pesantren')
                    ->schema([
                        Toggle::make('is_active_env')->label('Aktifkan Section Lingkungan')->default(true),
                        TextInput::make('env_title')->label('Judul Lingkungan')->columnSpanFull(),
                        RichEditor::make('env_content')->label('Deskripsi Suasana Lingkungan')->columnSpanFull(),
                    ]),

                Section::make('Penutup & Publish')
                    ->description('CTA bagian bawah halaman dan status publikasi')
                    ->schema([
                        Toggle::make('is_active_cta')->label('Aktifkan Section CTA')->default(true)->columnSpanFull(),
                        TextInput::make('cta_title')->label('Judul CTA'),
                        TextInput::make('cta_desc')->label('Deskripsi CTA'),
                        TextInput::make('cta_btn')->label('Teks Tombol CTA'),
                        MediaHelper::imageUpload('cta_bg', 'Background CTA', 'jenjang', 'banner'),
                        
                        Section::make('Publish')
                            ->schema([
                                Toggle::make('is_publish')->label('Publish Halaman')->default(true),
                            ]),
                    ])->columns(2),
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
            'index' => Pages\ManageSaranaSetting::route('/'),
        ];
    }
}
