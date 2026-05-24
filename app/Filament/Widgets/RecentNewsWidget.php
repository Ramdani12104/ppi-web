<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\NewsPost;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;

class RecentNewsWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = '📰 Berita Terbaru';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                NewsPost::query()->latest('published_at')->limit(6)
            )
            ->columns([
                ImageColumn::make('thumbnail')
                    ->label('Gambar')
                    ->width(60)
                    ->height(40)
                    ->defaultImageUrl(fn () => 'https://ui-avatars.com/api/?name=PPI&background=10b981&color=fff&size=60'),

                TextColumn::make('title')
                    ->label('Judul Berita')
                    ->limit(55)
                    ->searchable()
                    ->weight('medium'),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('primary'),

                IconColumn::make('is_published')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                IconColumn::make('is_featured')
                    ->label('Headline')
                    ->boolean()
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-minus')
                    ->trueColor('warning')
                    ->falseColor('gray'),

                TextColumn::make('published_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->icon('heroicon-o-pencil')
                    ->url(fn (NewsPost $record): string => route('filament.admin.resources.news-posts.edit', $record))
                    ->openUrlInNewTab(),
            ])
            ->paginated([5, 10])
            ->defaultSort('published_at', 'desc');
    }
}
