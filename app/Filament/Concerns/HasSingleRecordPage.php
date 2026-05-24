<?php

namespace App\Filament\Concerns;

use Filament\Actions\Action;

/**
 * HasSingleRecordPage
 *
 * Trait untuk Filament EditRecord pages yang digunakan sebagai
 * "Single Settings Page" (WordPress-like).
 *
 * Cara pakai:
 * 1. Buat class ManageXxxSetting extends EditRecord
 * 2. use HasSingleRecordPage;
 * 3. Tambahkan property: protected static string $resource = XxxSettingResource::class;
 * 4. Override mount() untuk auto-create record jika kosong
 */
trait HasSingleRecordPage
{
    /**
     * Hilangkan tombol Delete dari header halaman.
     * Settings page tidak perlu tombol hapus.
     */
    protected function getHeaderActions(): array
    {
        return [];
    }

    /**
     * Ganti label tombol Save menjadi "Simpan Perubahan"
     * dan hilangkan tombol Cancel.
     */
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('💾 Simpan Perubahan')
                ->icon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }

    /**
     * Setelah save, tetap di halaman yang sama (tidak redirect ke list).
     */
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    /**
     * Notifikasi sukses custom.
     */
    protected function getSavedNotificationTitle(): ?string
    {
        return '✅ Perubahan berhasil disimpan!';
    }
}
