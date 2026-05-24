<?php

namespace App\Filament\Resources\WakafSettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\WakafSettingResource;
use App\Models\WakafSetting;
use Filament\Resources\Pages\EditRecord;

class ManageWakafSetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = WakafSettingResource::class;
    protected static ?string $title = 'Halaman Wakaf Pendidikan';

    public function mount(int | string $record = null): void
    {
        $record = WakafSetting::firstOrCreate([], [
            'hero_title'     => 'Gerakan Wakaf Pendidikan',
            'hero_subtitle'  => 'Bersama membangun generasi Qurani melalui wakaf.',
            'history_title'  => 'Perjalanan Sebuah Amanah',
            'closing_title'  => 'Menjaga Nyala Harapan Generasi',
            'is_publish'     => true,
        ]);
        parent::mount($record->getKey());
    }
}
