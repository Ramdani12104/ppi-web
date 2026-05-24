<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeasiswaSettingResource\Pages;
use App\Models\BeasiswaSetting;
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

class BeasiswaSettingResource extends Resource
{
    protected static ?string $model = BeasiswaSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $modelLabel = 'Beasiswa Santri';
    protected static ?string $pluralModelLabel = 'Beasiswa Santri';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero & Cerita')
                    ->description('Latar belakang program beasiswa santri')
                    ->schema([
                        TextInput::make('hero_title')->label('Judul Hero')->required(),
                        Textarea::make('hero_subtitle')->label('Subjudul Hero')->rows(3),
                        MediaHelper::imageUpload('hero_image', 'Background Hero', 'website', 'banner'),
                        
                        TextInput::make('story_title')->label('Judul Tentang Program'),
                        RichEditor::make('story_content')->label('Isi Cerita Perjuangan / Penjelasan Program'),
                    ]),
                    
                Section::make('Jenis Program')
                    ->description('Daftar opsi program beasiswa yang tersedia')
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

                Section::make('Program Berjalan (Progress)')
                    ->description('Laporan dana terhimpun dan jumlah penerima manfaat')
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
                                MediaHelper::imageUpload('image', 'Foto Program/Penerima', 'gallery', 'content'),
                                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                            ])
                            ->orderColumn('sort_order')
                            ->columns(2),
                    ]),
                    
                Section::make('Kisah & Galeri')
                    ->description('Cerita sukses dan dokumentasi santri penerima beasiswa')
                    ->schema([
                        Repeater::make('galleries')
                            ->relationship()
                            ->label('Foto Kisah Santri / Dokumentasi Beasiswa')
                            ->schema([
                                MediaHelper::imageUpload('image', 'Foto', 'gallery', 'content'),
                                TextInput::make('title')->label('Nama Santri / Judul Kisah'),
                                Textarea::make('caption')->label('Kisah Singkat / Kutipan Santri'),
                                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                            ])
                            ->orderColumn('sort_order')
                            ->columns(2),
                    ]),

                Section::make('Donasi & CTA')
                    ->description('Rekening dukungan donatur, QRIS, dan status publish')
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
                        
                        TextInput::make('cta_title')->label('Judul CTA (Ajakan Halus)')->default('Mari Ikut Membersamai Perjalanan Pendidikan'),
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
            'index' => Pages\ManageBeasiswaSetting::route('/'),
        ];
    }
}
