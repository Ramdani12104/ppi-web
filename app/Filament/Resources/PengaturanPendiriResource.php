<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanPendiriResource\Pages;
use App\Models\PengaturanPendiri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class PengaturanPendiriResource extends Resource
{
    protected static ?string $model = PengaturanPendiri::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationGroup = 'Profil Pesantren';
    protected static ?string $navigationLabel = 'Pengaturan Pendiri';
    protected static ?string $modelLabel = 'Halaman Pendiri';
    protected static ?string $pluralModelLabel = 'Pengaturan Halaman Pendiri';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Header')
                    ->schema([
                        TextInput::make('judul')
                            ->label('Judul Halaman')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('subjudul')
                            ->label('Subjudul')
                            ->maxLength(255),
                        FileUpload::make('banner')
                            ->label('Banner / Gambar Header')
                            ->image()
                            ->directory('pendiri-banners')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Konten Profil')
                    ->schema([
                        RichEditor::make('sejarah_pendiri')
                            ->label('Sejarah Para Pendiri')
                            ->columnSpanFull(),
                        RichEditor::make('perjalanan_pesantren')
                            ->label('Awal Mula Perjalanan Pesantren')
                            ->columnSpanFull(),
                        RichEditor::make('perjuangan_pendiri')
                            ->label('Perjuangan Para Pendiri')
                            ->columnSpanFull(),
                        RichEditor::make('nilai_warisan')
                            ->label('Nilai dan Warisan')
                            ->columnSpanFull(),
                    ]),

                Section::make('Elemen Tambahan')
                    ->schema([
                        RichEditor::make('kutipan')
                            ->label('Kutipan Islami')
                            ->columnSpanFull(),
                        RichEditor::make('penutup')
                            ->label('Penutup Inspiratif')
                            ->columnSpanFull(),
                        Toggle::make('is_publish')
                            ->label('Status Publish')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('banner')
                    ->label('Banner'),
                TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable(),
                IconColumn::make('is_publish')
                    ->label('Publish')
                    ->boolean(),
                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime()
                    ->sortable(),
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
            'index' => Pages\ListPengaturanPendiris::route('/'),
            'create' => Pages\CreatePengaturanPendiri::route('/create'),
            'edit' => Pages\EditPengaturanPendiri::route('/{record}/edit'),
        ];
    }
}
