<?php

namespace App\Filament\Resources\SaranaSettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\SaranaSettingResource;
use App\Models\SaranaSetting;
use Filament\Resources\Pages\EditRecord;

class ManageSaranaSetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = SaranaSettingResource::class;
    protected static ?string $title = 'Halaman Sarana & Prasarana';

    public function mount(int | string $record = null): void
    {
        $record = SaranaSetting::firstOrCreate([], [
            'hero_title'   => 'Sarana & Prasarana Al-Ittihad',
            'hero_subtitle' => 'Fasilitas lengkap untuk mendukung pendidikan berkualitas.',
            'intro_title'  => 'Fasilitas Pesantren Kami',
            'is_publish'   => true,
        ]);
        parent::mount($record->getKey());
    }
}
