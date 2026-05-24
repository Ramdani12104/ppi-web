<?php

namespace App\Filament\Resources\ContactSettingResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\ContactSettingResource;
use App\Models\ContactSetting;
use Filament\Resources\Pages\EditRecord;

class ManageContactSetting extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = ContactSettingResource::class;

    protected static ?string $title = 'Halaman Kontak';

    public function mount(int | string $record = null): void
    {
        $record = ContactSetting::firstOrCreate([], [
            'hero_title' => 'Hubungi Kami',
            'hero_subtitle' => 'Pintu komunikasi selalu terbuka bagi Anda. Silakan hubungi kami untuk informasi lebih lanjut mengenai pendaftaran, program pendidikan, atau informasi lainnya.',
            'is_publish' => true,
        ]);

        parent::mount($record->getKey());
    }
}
