<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WakafSettingResource\Pages;
use App\Filament\Resources\WakafSettingResource\RelationManagers;
use App\Models\WakafSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Helpers\MediaHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WakafSettingResource extends Resource
{
    protected static ?string $model = WakafSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $modelLabel = 'Wakaf Pendidikan';
    protected static ?string $pluralModelLabel = 'Wakaf Pendidikan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Hero Section')
                    ->description('Atur judul dan background bagian teratas halaman Wakaf')
                    ->schema([
                        Forms\Components\TextInput::make('hero_title')->required()->default('Gerakan Wakaf Pendidikan'),
                        Forms\Components\Textarea::make('hero_subtitle'),
                        MediaHelper::imageUpload('hero_image', 'Hero Image', 'website', 'banner'),
                    ]),

                Forms\Components\Section::make('Sejarah & Cerita')
                    ->description('Kisah latar belakang perjuangan wakaf pesantren')
                    ->schema([
                        Forms\Components\TextInput::make('history_title')->required()->default('Perjalanan Sebuah Amanah'),
                        Forms\Components\RichEditor::make('history_content'),
                        Forms\Components\Textarea::make('history_quote'),
                        
                        Forms\Components\Section::make('Popup Sejarah Lengkap')
                            ->schema([
                                Forms\Components\TextInput::make('popup_history_title')->default('Langkah Awal Perjuangan'),
                                Forms\Components\RichEditor::make('popup_history_content'),
                                MediaHelper::imageUpload('popup_history_image', 'Gambar Sejarah (Popup)', 'website', 'content'),
                            ])->collapsible(),
                    ]),

                Forms\Components\Section::make('Program Wakaf')
                    ->description('Daftar program wakaf/bantuan yang dibuka')
                    ->schema([
                        Forms\Components\Repeater::make('programs')
                            ->relationship('programs')
                            ->schema([
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\Textarea::make('description'),
                                Forms\Components\TextInput::make('icon')->placeholder('emoji (cth: 🏗️)'),
                                Forms\Components\TextInput::make('color')->placeholder('cth: emerald'),
                                Forms\Components\TextInput::make('link')->url(),
                                Forms\Components\TextInput::make('order')->numeric()->default(0),
                            ])
                            ->orderColumn('order')
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Progress Pembangunan')
                    ->description('Presentasi kemajuan proyek fisik pesantren')
                    ->schema([
                        Forms\Components\Repeater::make('progresses')
                            ->relationship('progresses')
                            ->schema([
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\TextInput::make('percentage')->numeric()->default(0)->required()->minValue(0)->maxValue(100),
                                Forms\Components\TextInput::make('status_text')->placeholder('cth: Tahap Pengecoran'),
                                Forms\Components\Toggle::make('is_completed')->label('Selesai?')->default(false),
                                Forms\Components\TextInput::make('order')->numeric()->default(0),
                            ])
                            ->orderColumn('order')
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Timeline Perjalanan')
                    ->description('Catatan tonggak pencapaian wakaf sepanjang tahun')
                    ->schema([
                        Forms\Components\Repeater::make('timelines')
                            ->relationship('timelines')
                            ->schema([
                                Forms\Components\TextInput::make('year')->required()->placeholder('cth: 1985'),
                                Forms\Components\TextInput::make('title')->required(),
                                Forms\Components\Textarea::make('description'),
                                Forms\Components\TextInput::make('color')->placeholder('cth: emerald'),
                                Forms\Components\TextInput::make('order')->numeric()->default(0),
                            ])
                            ->orderColumn('order')
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Galeri Dokumentasi')
                    ->description('Kumpulan foto kegiatan dan penyaluran wakaf')
                    ->schema([
                        Forms\Components\Repeater::make('galleries')
                            ->relationship('galleries')
                            ->schema([
                                MediaHelper::imageUpload('image', 'Foto Dokumentasi', 'gallery', 'content'),
                                Forms\Components\TextInput::make('caption'),
                                Forms\Components\TextInput::make('order')->numeric()->default(0),
                            ])
                            ->orderColumn('order')
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Transparansi & Pembayaran')
                    ->description('Informasi pertanggungjawaban serta rekening bank / QRIS')
                    ->schema([
                        Forms\Components\TextInput::make('transparency_title')->default('Amanah yang Terjaga'),
                        Forms\Components\RichEditor::make('transparency_content'),
                        
                        Forms\Components\Section::make('Rekening & QRIS')
                            ->schema([
                                Forms\Components\TextInput::make('bank_name')->default('Bank Syariah Indonesia (BSI)'),
                                Forms\Components\TextInput::make('bank_account'),
                                Forms\Components\TextInput::make('bank_account_name'),
                                MediaHelper::imageUpload('qris_image', 'Gambar QRIS', 'website', 'avatar'),
                            ])->columns(2),
                    ]),

                Forms\Components\Section::make('Penutup')
                    ->description('Ajakan terakhir dan status publikasi halaman Wakaf')
                    ->schema([
                        Forms\Components\TextInput::make('closing_title')->default('Menjaga Nyala Harapan Generasi'),
                        Forms\Components\RichEditor::make('closing_content'),
                        Forms\Components\TextInput::make('wa_contact')->label('Nomor WA (Format: 628...)'),
                        Forms\Components\Toggle::make('is_publish')->label('Publikasikan Halaman Wakaf')->default(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title')->label('Judul Hero'),
                Tables\Columns\IconColumn::make('is_publish')->boolean()->label('Status Publish'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageWakafSetting::route('/'),
        ];
    }
}
