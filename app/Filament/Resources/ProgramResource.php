<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Helpers\MediaHelper;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $modelLabel = 'Program & Jenjang';
    protected static ?string $pluralModelLabel = 'Program & Jenjang';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Program / Jenjang')
                    ->required(),
                Select::make('type')
                    ->label('Tipe')
                    ->options([
                        'Jenjang' => 'Jenjang Pendidikan',
                        'Pesantren' => 'Program Pesantren',
                    ])
                    ->required()
                    ->live(),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->columnSpanFull(),
                MediaHelper::imageUpload('image', 'Gambar (Untuk Jenjang Pendidikan)', 'programs', 'content')
                    ->visible(fn (callable $get) => $get('type') === 'Jenjang')
                    ->columnSpanFull(),
                TextInput::make('icon')
                    ->label('Icon / Emoji (Untuk Program Pesantren)')
                    ->placeholder('🕌')
                    ->visible(fn (callable $get) => $get('type') === 'Pesantren'),
                TextInput::make('color_gradient')
                    ->label('Warna Gradasi Tailwind (Untuk Program Pesantren)')
                    ->placeholder('from-emerald-500 to-emerald-700')
                    ->visible(fn (callable $get) => $get('type') === 'Pesantren'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable(),
                TextColumn::make('type')->label('Tipe')->badge()->color(fn (string $state): string => match ($state) {
                    'Jenjang' => 'info',
                    'Pesantren' => 'success',
                }),
                TextColumn::make('icon')->label('Icon'),
                ImageColumn::make('image')->label('Gambar'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'Jenjang' => 'Jenjang Pendidikan',
                        'Pesantren' => 'Program Pesantren',
                    ]),
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
