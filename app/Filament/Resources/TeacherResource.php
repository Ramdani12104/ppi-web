<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Helpers\MediaHelper;
use Filament\Forms\Components\Select;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Profil Pesantren';
    protected static ?string $navigationLabel = 'Asatidz / Guru';
    protected static ?string $modelLabel = 'Asatidz';
    protected static ?string $pluralModelLabel = 'Asatidz';
    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                Select::make('stage')
                    ->label('Jenjang')
                    ->options([
                        'kober' => 'KOBER',
                        'ra' => 'RA',
                        'sdit' => 'SDIT',
                        'mdt' => 'MDT',
                        'mts' => 'MTs',
                        'ma' => 'MA',
                        'musrif_musyrifah' => 'Musrif & Musyrifah',
                        'timqu' => 'Tim Qur\'an',
                        'tendik' => 'Staf / Tendik',
                        'rh' => 'RH (Raudhatul Huffadz)',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('role')
                    ->label('Jabatan / Mengajar')
                    ->placeholder('Contoh: Wali Kelas / Guru Fiqih')
                    ->required()
                    ->maxLength(255),
                MediaHelper::imageUpload('photo', 'Foto Asatidz', 'teacher', 'avatar')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('tasks')
                    ->label('Tugas / Deskripsi Kerja')
                    ->placeholder('Deskripsikan tugas atau wewenang asatidz ini...')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Urutan')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stage')
                    ->label('Jenjang')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'musrif_musyrifah' => 'Musrif & Musyrifah',
                        'timqu' => 'Tim Qur\'an',
                        'tendik' => 'Staf / Tendik',
                        'rh' => 'RH (Raudhatul Huffadz)',
                        default => strtoupper($state),
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('role')
                    ->label('Jabatan / Mengajar')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
