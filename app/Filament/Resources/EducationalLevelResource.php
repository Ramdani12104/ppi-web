<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EducationalLevelResource\Pages;
use App\Models\EducationalLevel;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class EducationalLevelResource extends Resource
{
    protected static ?string $model = EducationalLevel::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Jenjang Pendidikan';
    protected static ?string $modelLabel = 'Jenjang';
    protected static ?string $pluralModelLabel = 'Semua Jenjang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Identitas')
                            ->schema([
                                TextInput::make('name')->required(),
                                TextInput::make('slug')->required()->unique(ignoreRecord: true),
                                FileUpload::make('logo')->image(),
                                FileUpload::make('banner')->image(),
                                TextInput::make('short_description')->columnSpanFull(),
                                Toggle::make('is_active')->default(true),
                            ])->columns(2),
                        
                        Tabs\Tab::make('Profil Singkat')
                            ->schema([
                                RichEditor::make('profile_content.sejarah')->label('Sejarah Singkat'),
                                RichEditor::make('profile_content.visi_misi')->label('Visi & Misi'),
                                RichEditor::make('profile_content.sambutan')->label('Sambutan Kepala'),
                            ]),
                            
                        Tabs\Tab::make('Program Unggulan')
                            ->schema([
                                Repeater::make('programs')
                                    ->schema([
                                        TextInput::make('name')->required(),
                                        TextInput::make('description'),
                                        TextInput::make('icon')->label('Emoji/Icon'),
                                    ])->columns(3),
                            ]),

                        Tabs\Tab::make('Fasilitas & Galeri')
                            ->schema([
                                Repeater::make('facilities')
                                    ->schema([
                                        TextInput::make('name')->required(),
                                        FileUpload::make('image')->image(),
                                    ])->columns(2),
                                FileUpload::make('gallery')->image()->multiple()->panelLayout('grid'),
                            ]),
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('logo'),
            TextColumn::make('name')->searchable(),
            TextColumn::make('slug'),
        ])->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEducationalLevels::route('/'),
            'create' => Pages\CreateEducationalLevel::route('/create'),
            'edit' => Pages\EditEducationalLevel::route('/{record}/edit'),
        ];
    }
}
