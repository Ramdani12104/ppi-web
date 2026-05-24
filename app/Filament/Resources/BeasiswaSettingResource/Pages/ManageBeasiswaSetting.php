<?php

namespace App\Filament\Resources\BeasiswaSettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\BeasiswaSettingResource;
use App\Models\BeasiswaSetting;
use Filament\Resources\Pages\EditRecord;

class ManageBeasiswaSetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = BeasiswaSettingResource::class;
    protected static ?string $title = 'Halaman Beasiswa Santri';

    public function mount(int | string $record = null): void
    {
        $record = BeasiswaSetting::firstOrCreate([], [
            'hero_title'   => 'Program Beasiswa Santri',
            'hero_subtitle' => 'Tidak ada anak yang berhenti belajar karena keterbatasan biaya.',
            'story_title'  => 'Tentang Program Beasiswa',
            'cta_title'    => 'Mari Ikut Membersamai Perjalanan Pendidikan',
            'is_publish'   => true,
        ]);
        parent::mount($record->getKey());
    }
}
