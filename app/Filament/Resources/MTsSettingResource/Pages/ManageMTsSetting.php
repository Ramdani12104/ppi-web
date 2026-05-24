<?php

namespace App\Filament\Resources\MTsSettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\MTsSettingResource;
use App\Models\MTsSetting;
use Filament\Resources\Pages\EditRecord;

class ManageMTsSetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = MTsSettingResource::class;
    protected static ?string $title = 'Halaman MTs (Madrasah Tsanawiyah)';

    public function mount(int | string $record = null): void
    {
        $record = MTsSetting::firstOrCreate([], [
            'hero_heading' => 'Madrasah Tsanawiyah Al-Ittihad',
            'hero_subheading' => 'Pendidikan Menengah Berbasis Adab',
        ]);
        parent::mount($record->getKey());
    }
}
