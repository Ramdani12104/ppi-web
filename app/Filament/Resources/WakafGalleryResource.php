<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WakafGalleryResource\Pages;
use App\Filament\Resources\WakafGalleryResource\RelationManagers;
use App\Models\WakafGallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WakafGalleryResource extends Resource
{
    protected static ?string $model = WakafGallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $modelLabel = 'Galeri Dokumentasi';
    protected static ?string $pluralModelLabel = 'Galeri Dokumentasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('wakaf_setting_id')
                    ->relationship('setting', 'hero_title')
                    ->required()
                    ->default(1),
                Forms\Components\FileUpload::make('image')->image()->directory('wakaf')->required(),
                Forms\Components\TextInput::make('caption'),
                Forms\Components\TextInput::make('order')->numeric()->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('caption')->searchable(),
                Tables\Columns\TextColumn::make('order')->sortable(),
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
            'index' => Pages\ListWakafGalleries::route('/'),
            'create' => Pages\CreateWakafGallery::route('/create'),
            'edit' => Pages\EditWakafGallery::route('/{record}/edit'),
        ];
    }
}
