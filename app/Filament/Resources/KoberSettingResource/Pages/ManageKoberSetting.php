<?php

namespace App\Filament\Resources\KoberSettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\KoberSettingResource;
use App\Models\KoberSetting;
use Filament\Resources\Pages\EditRecord;

class ManageKoberSetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = KoberSettingResource::class;

    protected static ?string $title = 'Halaman KOBER (Kelompok Bermain)';

    public function mount(int | string $record = null): void
    {
        $record = KoberSetting::firstOrCreate([], [
            'hero_title'   => 'KOBER Al-Ittihad',
            'hero_subtitle' => 'Kelompok Bermain Islami',
            'is_publish'   => true,
        ]);

        parent::mount($record->getKey());
    }
}
