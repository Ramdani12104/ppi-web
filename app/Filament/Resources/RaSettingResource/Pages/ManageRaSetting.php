<?php

namespace App\Filament\Resources\RaSettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\RaSettingResource;
use App\Models\RaSetting;
use Filament\Resources\Pages\EditRecord;

class ManageRaSetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = RaSettingResource::class;

    protected static ?string $title = 'Halaman RA (Raudhatul Athfal)';

    public function mount(int | string $record = null): void
    {
        $record = RaSetting::firstOrCreate([], [
            'hero_title'  => 'RA Al-Ittihad',
            'hero_subtitle' => 'Raudhatul Athfal Islami',
            'is_publish'  => true,
        ]);
        parent::mount($record->getKey());
    }
}
