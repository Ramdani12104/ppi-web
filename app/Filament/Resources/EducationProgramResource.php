<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationProgramResource\Pages;
use App\Models\EducationProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EducationProgramResource extends Resource
{
    protected static ?string $model = EducationProgram::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    
    protected static ?string $navigationLabel = 'Program Pendidikan';
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $modelLabel = 'Program Pendidikan (Jenjang)';
    protected static ?string $pluralModelLabel = 'Program Pendidikan';
    protected static ?string $slug = 'program-pendidikan';
    
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Jenjang')
                    ->placeholder('Misal: KOBER, RA, SDIT, dst.')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi Singkat')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->label('Gambar Utama')
                    ->image()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Jenjang')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar'),
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
            'index' => Pages\ListEducationPrograms::route('/'),
            'create' => Pages\CreateEducationProgram::route('/create'),
            'edit' => Pages\EditEducationProgram::route('/{record}/edit'),
        ];
    }
}
