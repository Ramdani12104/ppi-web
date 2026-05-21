<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Get;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Landing Page';
    protected static ?string $modelLabel = 'Halaman CMS';
    protected static ?string $pluralModelLabel = 'Semua Halaman (Pages)';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Halaman')
                    ->schema([
                        TextInput::make('title')->required()->live(onBlur: true),
                        TextInput::make('slug')->required()->unique(ignoreRecord: true),
                        Select::make('type')->options([
                            'standard' => 'Standard Page',
                            'landing' => 'Landing Page Builder',
                        ])->default('standard')->required(),
                        Toggle::make('is_published')->default(true),
                    ])->columns(2),

                Section::make('SEO Settings')
                    ->schema([
                        TextInput::make('meta_title'),
                        TextInput::make('meta_description'),
                    ])->columns(2)->collapsed(),

                Section::make('Page Sections (Builder Block)')
                    ->schema([
                        Repeater::make('sections')
                            ->relationship()
                            ->schema([
                                Select::make('type')
                                    ->options([
                                        'hero' => 'Hero Banner',
                                        'text' => 'Teks / Artikel',
                                        'gallery' => 'Galeri Gambar',
                                        'faq' => 'FAQ',
                                        'stats' => 'Statistik',
                                        'features' => 'Fitur / Program',
                                    ])->required()->live(),
                                
                                // Conditional fields based on type
                                TextInput::make('content.heading')
                                    ->visible(fn (Get $get) => in_array($get('type'), ['hero', 'text', 'gallery', 'faq', 'features'])),
                                TextInput::make('content.subheading')
                                    ->visible(fn (Get $get) => in_array($get('type'), ['hero', 'text', 'features'])),
                                FileUpload::make('content.image')
                                    ->image()
                                    ->visible(fn (Get $get) => in_array($get('type'), ['hero', 'text'])),
                                FileUpload::make('content.images')
                                    ->image()->multiple()
                                    ->visible(fn (Get $get) => $get('type') === 'gallery'),
                                RichEditor::make('content.body')
                                    ->visible(fn (Get $get) => $get('type') === 'text'),
                                
                                Repeater::make('content.items')
                                    ->label('Items (FAQ / Stats / Features)')
                                    ->schema([
                                        TextInput::make('title_or_question')->label('Judul / Pertanyaan'),
                                        TextInput::make('value_or_answer')->label('Nilai / Jawaban / Deskripsi'),
                                        TextInput::make('icon')->label('Icon (Opsional)'),
                                    ])->visible(fn (Get $get) => in_array($get('type'), ['faq', 'stats', 'features'])),
                                
                                Toggle::make('is_active')->default(true),
                            ])
                            ->orderColumn('order')
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['type'] ?? 'New Block'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('title')->searchable(),
            TextColumn::make('slug'),
            TextColumn::make('type')->badge(),
            IconColumn::make('is_published')->boolean(),
        ])
        ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
