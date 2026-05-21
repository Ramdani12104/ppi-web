<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembangunanSettingResource\Pages;
use App\Models\PembangunanSetting;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class PembangunanSettingResource extends Resource
{
    protected static ?string $model = PembangunanSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Profil Pesantren';
    protected static ?string $modelLabel = 'Pembangunan Sarana';
    protected static ?string $pluralModelLabel = 'Pengaturan Pembangunan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Pengaturan Pembangunan')
                    ->tabs([
                        Tabs\Tab::make('Hero & Cerita')
                            ->schema([
                                TextInput::make('hero_title')->label('Judul Hero')->required(),
                                Textarea::make('hero_subtitle')->label('Subjudul Hero')->rows(3),
                                FileUpload::make('hero_image')->label('Background Hero')->image()->directory('pembangunan'),
                                
                                TextInput::make('story_title')->label('Judul Cerita Perjuangan'),
                                RichEditor::make('story_content')->label('Isi Cerita Perjuangan (Gotong Royong & Sejarah)'),
                            ]),
                            
                        Tabs\Tab::make('Progres Terbaru')
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
                                        FileUpload::make('image')->label('Foto Progres')->image()->directory('pembangunan'),
                                        TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                                    ])
                                    ->orderColumn('sort_order')
                                    ->columns(2),
                            ]),

                        Tabs\Tab::make('Riwayat Lama (Timeline)')
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
                                        FileUpload::make('image')->label('Foto (Opsional)')->image()->directory('pembangunan/histori'),
                                        TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                                    ])
                                    ->orderColumn('sort_order')
                                    ->columns(2),
                            ]),
                            
                        Tabs\Tab::make('Galeri Dokumentasi')
                            ->schema([
                                Repeater::make('galleries')
                                    ->relationship()
                                    ->label('Foto Gotong Royong / Dokumentasi')
                                    ->schema([
                                        FileUpload::make('image')->label('Foto')->image()->directory('pembangunan/galeri')->required(),
                                        TextInput::make('caption')->label('Keterangan Singkat'),
                                        TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                                    ])
                                    ->orderColumn('sort_order')
                                    ->columns(2),
                            ]),

                        Tabs\Tab::make('Donasi & CTA')
                            ->schema([
                                Repeater::make('bank_accounts')
                                    ->label('Daftar Rekening Dukungan')
                                    ->schema([
                                        TextInput::make('bank')->label('Nama Bank (misal: BSI)')->required(),
                                        TextInput::make('number')->label('Nomor Rekening')->required(),
                                        TextInput::make('name')->label('Atas Nama')->required(),
                                    ])
                                    ->columns(3),
                                FileUpload::make('qris_image')->label('QRIS Image')->image()->directory('pembangunan/qris'),
                                
                                TextInput::make('cta_title')->label('Judul CTA (Ajakan Halus)')->default('Mari Ikut Membersamai Perjuangan'),
                                Textarea::make('cta_description')->label('Deskripsi CTA'),
                                Toggle::make('is_publish')->label('Publish Halaman')->default(true),
                            ]),
                    ])->columnSpanFull()
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
            'index' => Pages\ListPembangunanSettings::route('/'),
            'create' => Pages\CreatePembangunanSetting::route('/create'),
            'edit' => Pages\EditPembangunanSetting::route('/{record}/edit'),
        ];
    }
}
