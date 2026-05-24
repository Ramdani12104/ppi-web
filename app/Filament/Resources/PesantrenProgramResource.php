<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesantrenProgramResource\Pages;
use App\Models\PesantrenProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PesantrenProgramResource extends Resource
{
    protected static ?string $model = PesantrenProgram::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    
    protected static ?string $navigationLabel = 'Program Pesantren';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $modelLabel = 'Program Pesantren';
    protected static ?string $pluralModelLabel = 'Program Pesantren';
    protected static ?string $slug = 'program-pesantren';
    
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Program')
                    ->placeholder('Misal: Raudhatul Hufadz')
                    ->required(),
                Forms\Components\TextInput::make('icon')
                    ->label('Emoji/Icon')
                    ->placeholder('Misal: 🕌'),
                Forms\Components\TextInput::make('color_gradient')
                    ->label('Warna Gradasi (Tailwind)')
                    ->placeholder('Misal: from-emerald-500 to-emerald-700'),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Program')
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon')
                    ->label('Icon'),
                Tables\Columns\TextColumn::make('color_gradient')
                    ->label('Gradasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesantrenPrograms::route('/'),
            'create' => Pages\CreatePesantrenProgram::route('/create'),
            'edit' => Pages\EditPesantrenProgram::route('/{record}/edit'),
        ];
    }
}
