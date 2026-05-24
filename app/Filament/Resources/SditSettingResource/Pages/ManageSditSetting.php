<?php

namespace App\Filament\Resources\SditSettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\SditSettingResource;
use App\Models\SditSetting;
use Filament\Resources\Pages\EditRecord;

class ManageSditSetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = SditSettingResource::class;
    protected static ?string $title = 'Halaman SDIT (Sekolah Dasar Islam Terpadu)';

    public function mount(int | string $record = null): void
    {
        $record = SditSetting::firstOrCreate([], [
            'hero_title'  => 'SDIT Al-Ittihad',
            'hero_subtitle' => 'Sekolah Dasar Islam Terpadu',
            'is_publish'  => true,
        ]);
        parent::mount($record->getKey());
    }
}
