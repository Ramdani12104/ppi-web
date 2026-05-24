<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembangunanSettingResource\Pages;
use App\Models\PembangunanSetting;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use App\Helpers\MediaHelper;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Section;

class PembangunanSettingResource extends Resource
{
    protected static ?string $model = PembangunanSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $modelLabel = 'Pembangunan Sarana';
    protected static ?string $pluralModelLabel = 'Pembangunan Sarana';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero & Cerita')
                    ->description('Latar belakang program pembangunan sarana')
                    ->schema([
                        TextInput::make('hero_title')->label('Judul Hero')->required(),
                        Textarea::make('hero_subtitle')->label('Subjudul Hero')->rows(3),
                        MediaHelper::imageUpload('hero_image', 'Background Hero', 'website', 'banner'),
                        
                        TextInput::make('story_title')->label('Judul Cerita Perjuangan'),
                        RichEditor::make('story_content')->label('Isi Cerita Perjuangan (Gotong Royong & Sejarah)'),
                    ]),
                    
                Section::make('Progres Terbaru')
                    ->description('Daftar proyek pembangunan yang sedang berjalan')
                    ->schema([
                        Repeater::make('projects')
                            ->relationship()
                            ->label('Daftar Proyek Berjalan')
                            ->schema([
                                TextInput::make('title')->label('Nama Pembangunan')->required(),
                                Select::make('status')->label('Status')->options([
                                    'Berjalan' => 'Berjalan',
                                    'Perencanaan' => 'Perencanaan',
                                    'Selesai' => 'Selesai'
                                ])->default('Berjalan'),
                                Textarea::make('description')->label('Deskripsi Singkat'),
                                TextInput::make('target_fund')->label('Target Dana (Rp)')->numeric()->default(0),
                                TextInput::make('collected_fund')->label('Dana Terkumpul (Rp)')->numeric()->default(0),
                                TextInput::make('progress_percent')->label('Persentase Fisik (%)')->numeric()->default(0)->maxValue(100),
                                MediaHelper::imageUpload('image', 'Foto Progres', 'gallery', 'content'),
                                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                            ])
                            ->orderColumn('sort_order')
                            ->columns(2),
                    ]),

                Section::make('Riwayat Lama (Timeline)')
                    ->description('Pencapaian pembangunan yang telah selesai')
                    ->schema([
                        Repeater::make('histories')
                            ->relationship()
                            ->label('Riwayat Pembangunan Selesai')
                            ->schema([
                                TextInput::make('year')->label('Tahun (misal: 2023)')->required(),
                                TextInput::make('title')->label('Nama Pembangunan')->required(),
                                Textarea::make('description')->label('Keterangan Singkat'),
                                Select::make('status')->label('Status')->options([
                                    'Selesai' => 'Selesai',
                                    'Berjalan' => 'Berjalan'
                                ])->default('Selesai'),
                                MediaHelper::imageUpload('image', 'Foto (Opsional)', 'gallery', 'content'),
                                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                            ])
                            ->orderColumn('sort_order')
                            ->columns(2),
                    ]),
                    
                Section::make('Galeri Dokumentasi')
                    ->description('Kumpulan foto gotong royong dan pembangunan fisik')
                    ->schema([
                        Repeater::make('galleries')
                            ->relationship()
                            ->label('Foto Gotong Royong / Dokumentasi')
                            ->schema([
                                MediaHelper::imageUpload('image', 'Foto', 'gallery', 'content'),
                                TextInput::make('caption')->label('Keterangan Singkat'),
                                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                            ])
                            ->orderColumn('sort_order')
                            ->columns(2),
                    ]),

                Section::make('Donasi & CTA')
                    ->description('Rekening bank, QRIS, dan status publish')
                    ->schema([
                        Repeater::make('bank_accounts')
                            ->label('Daftar Rekening Dukungan')
                            ->schema([
                                TextInput::make('bank')->label('Nama Bank (misal: BSI)')->required(),
                                TextInput::make('number')->label('Nomor Rekening')->required(),
                                TextInput::make('name')->label('Atas Nama')->required(),
                            ])
                            ->columns(3),
                        MediaHelper::imageUpload('qris_image', 'QRIS Image', 'website', 'avatar'),
                        
                        TextInput::make('cta_title')->label('Judul CTA (Ajakan Halus)')->default('Mari Ikut Membersamai Perjuangan'),
                        Textarea::make('cta_description')->label('Deskripsi CTA'),
                        Toggle::make('is_publish')->label('Publish Halaman')->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hero_title')->label('Judul Halaman'),
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
            'index' => Pages\ManagePembangunanSetting::route('/'),
        ];
    }
}
