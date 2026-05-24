<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryResource\Pages;
use App\Models\History;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use App\Helpers\MediaHelper;

class HistoryResource extends Resource
{
    protected static ?string $model = History::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Profil Pesantren';
    protected static ?string $modelLabel = 'Sejarah Pesantren';
    protected static ?string $pluralModelLabel = 'Sejarah Pesantren';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul Halaman')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('established_year')
                    ->label('Tahun Berdiri')
                    ->numeric()
                    ->required(),
                MediaHelper::imageUpload('image', 'Gambar Utama / Banner Sejarah', 'history', 'content')
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->label('Isi Sejarah')
                    ->rows(10)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageHistory::route('/'),
        ];
    }
}
