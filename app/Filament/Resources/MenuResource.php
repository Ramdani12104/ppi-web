<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Models\Menu;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;
    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $modelLabel = 'Menu';
    protected static ?string $pluralModelLabel = 'Navigasi Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Menu')
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('location')->required()->unique(ignoreRecord: true),
                        Toggle::make('is_active')->default(true),
                    ])->columns(3),
                
                Section::make('Menu Items')
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                TextInput::make('title')->required(),
                                TextInput::make('url'),
                                Toggle::make('is_active')->default(true),
                            ])
                            ->orderColumn('order')
                            ->columns(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name'),
            TextColumn::make('location'),
        ])->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
