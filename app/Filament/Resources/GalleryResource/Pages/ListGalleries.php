<?php

namespace App\Filament\Resources\GalleryResource\Pages;

use App\Filament\Resources\GalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGalleries extends ListRecords
{
    protected static string $resource = GalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('bulkUpload')
                ->label('Unggah Massal')
                ->icon('heroicon-o-arrow-up-tray')
                ->color('success')
                ->form([
                    \Filament\Forms\Components\FileUpload::make('images')
                        ->label('Pilih Foto-Foto')
                        ->multiple()
                        ->image()
                        ->directory('gallery')
                        ->required(),
                    \Filament\Forms\Components\Select::make('jenjang')
                        ->label('Jenjang Sekolah / Kategori')
                        ->options([
                            'Sejarah' => 'Masa Lalu / Sejarah',
                            'Umum' => 'Umum / Pesantren',
                            'MA' => 'Madrasah Aliyah (MA)',
                            'MTs' => 'Madrasah Tsanawiyah (MTs)',
                            'SDIT' => 'SDIT Al-Ittihad',
                            'RA' => 'RA Al-Ittihad',
                            'KOBER' => 'KOBER Al-Ittihad',
                            'MDT' => 'MDT Al-Ittihad'
                        ])
                        ->default('Sejarah')
                        ->required(),
                ])
                ->action(function (array $data) {
                    foreach ($data['images'] as $imagePath) {
                        \App\Models\Gallery::create([
                            'title' => 'Foto ' . ($data['jenjang'] === 'Sejarah' ? 'Masa Lalu' : ucfirst($data['jenjang'])) . ' - ' . date('d M Y'),
                            'image' => $imagePath,
                            'jenjang' => $data['jenjang'],
                            'desc' => 'Arsip foto pesantren.'
                        ]);
                    }
                    
                    \Filament\Notifications\Notification::make()
                        ->title('✅ ' . count($data['images']) . ' foto berhasil diunggah secara massal!')
                        ->success()
                        ->send();
                }),
        ];
    }
}
