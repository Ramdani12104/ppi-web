<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeasiswaSettingResource\Pages;
use App\Models\BeasiswaSetting;
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

class BeasiswaSettingResource extends Resource
{
    protected static ?string $model = BeasiswaSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Profil Pesantren';
    protected static ?string $modelLabel = 'Beasiswa Santri';
    protected static ?string $pluralModelLabel = 'Pengaturan Beasiswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Pengaturan Beasiswa')
                    ->tabs([
                        Tabs\Tab::make('Hero & Cerita')
                            ->schema([
                                TextInput::make('hero_title')->label('Judul Hero')->required(),
                                Textarea::make('hero_subtitle')->label('Subjudul Hero')->rows(3),
                                FileUpload::make('hero_image')->label('Background Hero')->image()->directory('beasiswa'),
                                
                                TextInput::make('story_title')->label('Judul Tentang Program'),
                                RichEditor::make('story_content')->label('Isi Cerita Perjuangan / Penjelasan Program'),
                            ]),
                            
                        Tabs\Tab::make('Jenis Program')
                            ->schema([
                                Repeater::make('programs')
                                    ->relationship()
                                    ->label('Daftar Jenis Program Beasiswa')
                                    ->schema([
                                        TextInput::make('title')->label('Nama Program (contoh: Beasiswa Yatim)')->required(),
                                        TextInput::make('icon')->label('Icon (Emoji)')->placeholder('🎓'),
                                        Textarea::make('description')->label('Deskripsi Singkat'),
                                        TextInput::make('target_program')->label('Target Program (contoh: 100 Santri/Tahun)'),
                                        TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                                    ])
                                    ->orderColumn('sort_order')
                                    ->columns(2),
                            ]),

                        Tabs\Tab::make('Program Berjalan (Progress)')
                            ->schema([
                                Repeater::make('histories')
                                    ->relationship()
                                    ->label('Program Yang Sedang Berjalan Saat Ini')
                                    ->schema([
                                        TextInput::make('program_name')->label('Nama Aktivitas/Program')->required(),
                                        TextInput::make('target_fund')->label('Target Bantuan (Rp)')->numeric()->default(0),
                                        TextInput::make('collected_fund')->label('Dana Terkumpul (Rp)')->numeric()->default(0),
                                        TextInput::make('receiver_count')->label('Jumlah Penerima (Santri)')->numeric()->default(0),
                                        TextInput::make('progress_percent')->label('Persentase Terkumpul (%)')->numeric()->default(0)->maxValue(100),
                                        Select::make('status')->label('Status')->options([
                                            'Berjalan' => 'Berjalan',
                                            'Selesai' => 'Selesai'
                                        ])->default('Berjalan'),
                                        FileUpload::make('image')->label('Foto Program/Penerima')->image()->directory('beasiswa/histori'),
                                        TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                                    ])
                                    ->orderColumn('sort_order')
                                    ->columns(2),
                            ]),
                            
                        Tabs\Tab::make('Kisah & Galeri')
                            ->schema([
                                Repeater::make('galleries')
                                    ->relationship()
                                    ->label('Foto Kisah Santri / Dokumentasi Beasiswa')
                                    ->schema([
                                        FileUpload::make('image')->label('Foto')->image()->directory('beasiswa/galeri')->required(),
                                        TextInput::make('title')->label('Nama Santri / Judul Kisah'),
                                        Textarea::make('caption')->label('Kisah Singkat / Kutipan Santri'),
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
                                FileUpload::make('qris_image')->label('QRIS Image')->image()->directory('beasiswa/qris'),
                                
                                TextInput::make('cta_title')->label('Judul CTA (Ajakan Halus)')->default('Mari Ikut Membersamai Perjalanan Pendidikan'),
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
            'index' => Pages\ListBeasiswaSettings::route('/'),
            'create' => Pages\CreateBeasiswaSetting::route('/create'),
            'edit' => Pages\EditBeasiswaSetting::route('/{record}/edit'),
        ];
    }
}
