<?php

namespace App\Filament\Resources\MdtSettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\MdtSettingResource;
use App\Models\MdtSetting;
use Filament\Resources\Pages\EditRecord;

class ManageMdtSetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = MdtSettingResource::class;
    protected static ?string $title = 'Halaman MDT (Madrasah Diniyah Takmiliyah)';

    public function mount(int | string $record = null): void
    {
        $record = MdtSetting::firstOrCreate([], [
            'hero_title'  => 'MDT Al-Ittihad',
            'hero_subtitle' => 'Madrasah Diniyah Takmiliyah',
            'is_publish'  => true,
        ]);
        parent::mount($record->getKey());
    }
}
