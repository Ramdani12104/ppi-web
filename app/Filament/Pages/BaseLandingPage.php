<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;

abstract class BaseLandingPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationGroup = 'Landing Page';
    protected static string $view = 'filament.pages.manage-landing-page';

    public ?array $data = [];

    /**
     * Get the settings keys and their default values.
     */
    abstract protected function getSettingKeys(): array;

    /**
     * Check if a setting key holds JSON data (e.g. repeaters).
     */
    protected function isJsonKey(string $key): bool
    {
        return str_ends_with($key, '_cards') || str_ends_with($key, '_items');
    }

    public function mount(): void
    {
        $keys = $this->getSettingKeys();
        $settings = [];

        foreach ($keys as $key => $default) {
            $setting = Setting::firstOrCreate(
                ['key' => $key],
                [
                    'value' => is_array($default) ? json_encode($default) : $default,
                    'type' => 'text',
                    'group' => 'landing'
                ]
            );

            if (is_array($default) || $this->isJsonKey($key)) {
                $settings[$key] = json_decode($setting->value, true) ?: [];
            } else {
                $settings[$key] = $setting->value;
            }
        }

        $this->form->fill($settings);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => is_array($value) ? json_encode($value) : $value,
                    'type' => 'text',
                    'group' => 'landing'
                ]
            );
        }

        Notification::make()
            ->title('✅ Perubahan berhasil disimpan!')
            ->success()
            ->send();
    }
}
