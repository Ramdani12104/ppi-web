<?php

namespace App\Filament\Pages;

use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;

class ManageKontakLanding extends BaseLandingPage
{
    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationLabel = 'Kontak Landing';
    protected static ?string $title = 'Pengaturan Kontak Landing';
    protected static ?int $navigationSort = 120;

    protected function getSettingKeys(): array
    {
        return [
            'landing_contact_title' => 'PPI 104 Cikajang',
            'landing_contact_desc' => 'Punya pertanyaan mengenai program pendidikan, pendaftaran santri, atau kerjasama? Silakan hubungi kami atau kunjungi pesantren kami.',
            'landing_contact_address' => 'Pesantren Persatuan Islam 104 Cikajang, Kp. Rancapandan, Ds. Mekarjaya, Kec. Cikajang, Kabupaten Garut, Jawa Barat 44171.',
            'landing_contact_phone' => '+6283822099034',
            'landing_contact_email' => 'info@alittihad104.sch.id',
            'landing_contact_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.128711311545!2d107.75626247395026!3d-7.45097457342898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e669da7cfc90421%3A0x68c60abeabbaca8c!2sPesantren%20Persatuan%20Islam%20104%20Cikajang!5e0!3m2!1sid!2sid!4v1713686000000!5m2!1sid!2sid',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Kontak & Peta')
                    ->description('Kelola detail kontak dan lokasi peta pesantren')
                    ->schema([
                        TextInput::make('landing_contact_title')
                            ->label('Judul / Nama Lembaga')
                            ->required(),
                        Textarea::make('landing_contact_desc')
                            ->label('Deskripsi Singkat')
                            ->rows(2)
                            ->required(),
                        Textarea::make('landing_contact_address')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->required(),
                        TextInput::make('landing_contact_phone')
                            ->label('Telepon / WA')
                            ->required(),
                        TextInput::make('landing_contact_email')
                            ->label('Email Pesantren')
                            ->email()
                            ->required(),
                        Textarea::make('landing_contact_maps')
                            ->label('Google Maps Embed URL')
                            ->placeholder('https://www.google.com/maps/embed?pb=...')
                            ->helperText('Hanya masukkan atribut src dari iframe Google Maps.')
                            ->rows(3)
                            ->required(),
                    ])
            ])
            ->statePath('data');
    }
}
