<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Filament\Resources\GalleryResource\RelationManagers;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-camera';
    protected static ?string $navigationGroup = 'Profil Pesantren';
    protected static ?string $navigationLabel = 'Galeri Dokumentasi';
    protected static ?string $modelLabel = 'Galeri';
    protected static ?string $pluralModelLabel = 'Galeri Dokumentasi';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Foto/Kegiatan')
                    ->required(),
                Forms\Components\Select::make('jenjang')
                    ->label('Jenjang Sekolah / Kategori')
                    ->options([
                        'Sejarah' => 'Masa Lalu / Sejarah',
                        'Umum' => 'Umum / Pesantren',
                        'MA' => 'Madrasah Aliyah (MA)',
                        'MTs' => 'Madrasah Tsanawiyah (MTs)',
                        'SDIT' => 'SDIT Al-Ittihad',
                        'RA' => 'RA Al-Ittihad',
                        'KOBER' => 'KOBER Al-Ittihad',
                        'MDT' => 'MDT Al-Ittihad'
                    ])
                    ->default('Sejarah')
                    ->required(),
                Forms\Components\FileUpload::make('image')
                    ->label('Foto Dokumentasi')
                    ->image()
                    ->directory('gallery')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('desc')
                    ->label('Keterangan / Caption')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenjang')
                    ->label('Jenjang/Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'MA' => 'danger',
                        'MTs' => 'warning',
                        'SDIT' => 'success',
                        'Umum' => 'info',
                        'Sejarah' => 'primary',
                        default => 'gray',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Diunggah Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenjang')
                    ->label('Saring Jenjang')
                    ->options([
                        'Sejarah' => 'Masa Lalu / Sejarah',
                        'Umum' => 'Umum / Pesantren',
                        'MA' => 'Madrasah Aliyah (MA)',
                        'MTs' => 'Madrasah Tsanawiyah (MTs)',
                        'SDIT' => 'SDIT Al-Ittihad',
                        'RA' => 'RA Al-Ittihad',
                        'KOBER' => 'KOBER Al-Ittihad',
                        'MDT' => 'MDT Al-Ittihad'
                    ])
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
            'index' => Pages\ListGalleries::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
            'edit' => Pages\EditGallery::route('/{record}/edit'),
        ];
    }
}
