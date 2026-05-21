<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WakafProgressResource\Pages;
use App\Filament\Resources\WakafProgressResource\RelationManagers;
use App\Models\WakafProgress;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WakafProgressResource extends Resource
{
    protected static ?string $model = WakafProgress::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $modelLabel = 'Progress Pembangunan';
    protected static ?string $pluralModelLabel = 'Progress Pembangunan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('wakaf_setting_id')
                    ->relationship('setting', 'hero_title')
                    ->required()
                    ->default(1),
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\TextInput::make('percentage')->numeric()->default(0)->required()->minValue(0)->maxValue(100),
                Forms\Components\TextInput::make('status_text')->placeholder('cth: Tahap Pengecoran'),
                Forms\Components\Toggle::make('is_completed')->label('Selesai?')->default(false),
                Forms\Components\TextInput::make('order')->numeric()->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('percentage')->label('Progres (%)'),
                Tables\Columns\IconColumn::make('is_completed')->boolean()->label('Selesai'),
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
            'index' => Pages\ListWakafProgress::route('/'),
            'create' => Pages\CreateWakafProgress::route('/create'),
            'edit' => Pages\EditWakafProgress::route('/{record}/edit'),
        ];
    }
}
