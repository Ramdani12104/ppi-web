<?php

namespace App\Filament\Resources\PembangunanSettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\PembangunanSettingResource;
use App\Models\PembangunanSetting;
use Filament\Resources\Pages\EditRecord;

class ManagePembangunanSetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = PembangunanSettingResource::class;
    protected static ?string $title = 'Halaman Pembangunan Sarana';

    public function mount(int | string $record = null): void
    {
        $record = PembangunanSetting::firstOrCreate([], [
            'hero_title'   => 'Bersama Membangun Pesantren',
            'hero_subtitle' => 'Setiap kontribusi menjadi amal jariyah yang mengalir.',
            'story_title'  => 'Kisah Perjuangan & Gotong Royong',
            'cta_title'    => 'Mari Ikut Membersamai Perjuangan',
            'is_publish'   => true,
        ]);
        parent::mount($record->getKey());
    }
}
