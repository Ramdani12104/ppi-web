<?php

namespace App\Filament\Resources\MASettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\MASettingResource;
use App\Models\MASetting;
use Filament\Resources\Pages\EditRecord;

class ManageMASetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = MASettingResource::class;
    protected static ?string $title = 'Halaman MA (Madrasah Aliyah)';

    public function mount(int | string $record = null): void
    {
        $record = MASetting::firstOrCreate([], [
            'hero_heading' => 'Madrasah Aliyah Al-Ittihad',
            'hero_title'   => 'Selamat Datang di MA Al-Ittihad',
            'youtube_link' => 'https://www.youtube.com/embed/',
            'sejarah_ma'   => 'Madrasah Aliyah Al-Ittihad berdiri dengan visi mencetak generasi Qurani.',
            'kurikulum_detail' => 'Kurikulum terintegrasi antara Diknas dan Pesantren.',
        ]);
        parent::mount($record->getKey());
    }
}
