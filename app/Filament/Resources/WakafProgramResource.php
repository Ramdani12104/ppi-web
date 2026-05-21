<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WakafProgramResource\Pages;
use App\Filament\Resources\WakafProgramResource\RelationManagers;
use App\Models\WakafProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WakafProgramResource extends Resource
{
    protected static ?string $model = WakafProgram::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $modelLabel = 'Program Dukungan';
    protected static ?string $pluralModelLabel = 'Program Dukungan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('wakaf_setting_id')
                    ->relationship('setting', 'hero_title')
                    ->required()
                    ->default(1),
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TextInput::make('icon')->placeholder('emoji (cth: 🏗️)'),
                Forms\Components\TextInput::make('color')->placeholder('cth: emerald'),
                Forms\Components\TextInput::make('link')->url(),
                Forms\Components\TextInput::make('order')->numeric()->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('icon'),
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
            'index' => Pages\ListWakafPrograms::route('/'),
            'create' => Pages\CreateWakafProgram::route('/create'),
            'edit' => Pages\EditWakafProgram::route('/{record}/edit'),
        ];
    }
}
