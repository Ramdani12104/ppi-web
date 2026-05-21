<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsPostResource\Pages;
use App\Models\NewsPost;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;

class NewsPostResource extends Resource
{
    protected static ?string $model = NewsPost::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Berita & Informasi';
    protected static ?string $modelLabel = 'Berita';
    protected static ?string $pluralModelLabel = 'Semua Berita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Section::make('Konten Berita')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Berita')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                
                                TextInput::make('slug')
                                    ->label('Slug URL')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                    
                                Textarea::make('excerpt')
                                    ->label('Cuplikan Singkat (Excerpt)')
                                    ->rows(3)
                                    ->helperText('Jika dikosongkan, akan otomatis diambil dari konten.'),
                                    
                                RichEditor::make('content')
                                    ->label('Isi Berita')
                                    ->required()
                                    ->columnSpanFull(),
                            ])->columnSpan(2),
                            
                        Section::make('Pengaturan & Media')
                            ->schema([
                                Select::make('news_category_id')
                                    ->relationship('category', 'name')
                                    ->label('Kategori')
                                    ->required()
                                    ->searchable()
                                    ->preload(),
                                    
                                FileUpload::make('thumbnail')
                                    ->label('Thumbnail Utama')
                                    ->image()
                                    ->directory('news')
                                    ->required(),
                                    
                                DateTimePicker::make('published_at')
                                    ->label('Tanggal Publikasi')
                                    ->default(now()),
                                    
                                Toggle::make('is_published')
                                    ->label('Publish Berita')
                                    ->default(true),
                                    
                                Toggle::make('is_featured')
                                    ->label('Jadikan Headline (Berita Utama)')
                                    ->default(false),
                                    
                                Toggle::make('is_popular')
                                    ->label('Berita Populer')
                                    ->default(false),
                            ])->columnSpan(1),
                            
                        Section::make('Galeri Tambahan')
                            ->schema([
                                Repeater::make('galleries')
                                    ->relationship()
                                    ->schema([
                                        FileUpload::make('image')->image()->directory('news')->required(),
                                        TextInput::make('caption')->label('Keterangan Gambar'),
                                    ])
                                    ->grid(3)
                            ])->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('thumbnail')->label('Gambar'),
                TextColumn::make('title')->label('Judul')->searchable()->limit(50),
                TextColumn::make('category.name')->label('Kategori')->searchable(),
                IconColumn::make('is_published')->label('Published')->boolean(),
                IconColumn::make('is_featured')->label('Headline')->boolean(),
                TextColumn::make('published_at')->label('Tanggal')->dateTime('d M Y H:i')->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('news_category_id')
                    ->relationship('category', 'name')
                    ->label('Kategori'),
                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Status Publish'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsPosts::route('/'),
            'create' => Pages\CreateNewsPost::route('/create'),
            'edit' => Pages\EditNewsPost::route('/{record}/edit'),
        ];
    }
}
