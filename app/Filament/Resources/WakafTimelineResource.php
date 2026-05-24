<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WakafTimelineResource\Pages;
use App\Filament\Resources\WakafTimelineResource\RelationManagers;
use App\Models\WakafTimeline;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WakafTimelineResource extends Resource
{
    protected static ?string $model = WakafTimeline::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $modelLabel = 'Timeline Perjalanan';
    protected static ?string $pluralModelLabel = 'Timeline Perjalanan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('wakaf_setting_id')
                    ->relationship('setting', 'hero_title')
                    ->required()
                    ->default(1),
                Forms\Components\TextInput::make('year')->required()->placeholder('cth: 1985'),
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TextInput::make('color')->placeholder('cth: emerald'),
                Forms\Components\TextInput::make('order')->numeric()->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('year')->sortable(),
                Tables\Columns\TextColumn::make('title')->searchable(),
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
            'index' => Pages\ListWakafTimelines::route('/'),
            'create' => Pages\CreateWakafTimeline::route('/create'),
            'edit' => Pages\EditWakafTimeline::route('/{record}/edit'),
        ];
    }
}
