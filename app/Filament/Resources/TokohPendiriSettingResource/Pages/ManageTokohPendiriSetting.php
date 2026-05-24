<?php

namespace App\Filament\Resources\TokohPendiriSettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\TokohPendiriSettingResource;
use App\Models\TokohPendiriSetting;
use Filament\Resources\Pages\EditRecord;

class ManageTokohPendiriSetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = TokohPendiriSettingResource::class;

    protected static ?string $title = 'Halaman Tokoh Pendiri';

    public function mount(int | string $record = null): void
    {
        $record = TokohPendiriSetting::firstOrCreate([], [
            'hero_title' => 'Jejak Perjuangan Para Pendiri',
            'hero_subtitle' => 'Mengenang keikhlasan, pengorbanan, dan dedikasi para sesepuh serta keluarga besar dalam merintis madrasah.',
            'is_publish' => true,
        ]);

        parent::mount($record->getKey());
    }
}
