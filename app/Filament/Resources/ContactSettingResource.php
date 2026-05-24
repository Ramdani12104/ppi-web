<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactSettingResource\Pages;
use App\Models\ContactSetting;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use App\Helpers\MediaHelper;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class ContactSettingResource extends Resource
{
    protected static ?string $model = ContactSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationGroup = 'Profil Pesantren';
    protected static ?string $modelLabel = 'Kontak';
    protected static ?string $pluralModelLabel = 'Kontak';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Hero')
                    ->description('Atur gambar background dan judul di atas halaman Kontak')
                    ->schema([
                        TextInput::make('hero_title')->label('Judul Hero')->required(),
                        Textarea::make('hero_subtitle')->label('Subjudul Hero')->rows(3),
                        MediaHelper::imageUpload('hero_image', 'Ilustrasi / Foto', 'website', 'banner'),
                    ]),
                    
                Section::make('Daftar Kontak (WhatsApp)')
                    ->description('Daftar nomor kontak WhatsApp admin / humas pesantren')
                    ->schema([
                        Repeater::make('contacts')
                            ->relationship()
                            ->schema([
                                TextInput::make('name')->label('Nama Admin/Humas')->required(),
                                TextInput::make('position')->label('Jabatan / Posisi (misal: Admin SDIT)')->required(),
                                TextInput::make('category')->label('Kategori (Humas/Admin Kober/Admin MA)'),
                                TextInput::make('whatsapp_number')
                                    ->label('Nomor WhatsApp (Gunakan awalan 62)')
                                    ->numeric()
                                    ->required()
                                    ->placeholder('628123456789'),
                                Textarea::make('description')->label('Deskripsi Singkat'),
                                MediaHelper::imageUpload('photo', 'Foto / Icon (Opsional)', 'website', 'avatar'),
                                TextInput::make('sort_order')->label('Urutan')->numeric()->default(0),
                            ])
                            ->orderColumn('sort_order')
                            ->columns(2)
                            ->columnSpanFull(),
                    ]),

                Section::make('Informasi Pesantren')
                    ->description('Detail alamat lengkap, email, telepon, jam operasional, dan peta')
                    ->schema([
                        Textarea::make('address')->label('Alamat Lengkap')->columnSpanFull(),
                        TextInput::make('email')->label('Email Utama')->email(),
                        TextInput::make('phone')->label('Telepon Utama'),
                        TextInput::make('operational_hours')->label('Jam Operasional')->placeholder('Senin - Sabtu: 07.30 - 15.00'),
                        Textarea::make('map_embed')->label('Kode Embed Google Maps (Iframe)')->columnSpanFull()->rows(4),
                    ])->columns(2),

                Section::make('CTA & Publish')
                    ->description('CTA bagian bawah halaman kontak dan status publish')
                    ->schema([
                        TextInput::make('cta_title')->label('Judul CTA'),
                        Textarea::make('cta_description')->label('Deskripsi CTA'),
                        Toggle::make('is_publish')->label('Publish Halaman Kontak')->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hero_title')->label('Judul Halaman'),
                IconColumn::make('is_publish')->label('Published')->boolean(),
                TextColumn::make('updated_at')->label('Terakhir Diupdate')->dateTime(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageContactSetting::route('/'),
        ];
    }
}
