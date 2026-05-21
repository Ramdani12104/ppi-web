<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WakafSettingResource\Pages;
use App\Filament\Resources\WakafSettingResource\RelationManagers;
use App\Models\WakafSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WakafSettingResource extends Resource
{
    protected static ?string $model = WakafSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Dukungan Pendidikan';
    protected static ?string $modelLabel = 'Pengaturan Halaman';
    protected static ?string $pluralModelLabel = 'Pengaturan Halaman Wakaf';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Pengaturan Wakaf Pendidikan')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Hero Section')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\TextInput::make('hero_title')->required()->default('Gerakan Wakaf Pendidikan'),
                                Forms\Components\Textarea::make('hero_subtitle'),
                                Forms\Components\FileUpload::make('hero_image')->image()->directory('wakaf'),
                            ]),
                        Forms\Components\Tabs\Tab::make('Sejarah & Cerita')
                            ->icon('heroicon-o-book-open')
                            ->schema([
                                Forms\Components\TextInput::make('history_title')->required()->default('Perjalanan Sebuah Amanah'),
                                Forms\Components\RichEditor::make('history_content'),
                                Forms\Components\Textarea::make('history_quote'),
                                Forms\Components\Section::make('Popup Sejarah Lengkap')->schema([
                                    Forms\Components\TextInput::make('popup_history_title')->default('Langkah Awal Perjuangan'),
                                    Forms\Components\RichEditor::make('popup_history_content'),
                                    Forms\Components\FileUpload::make('popup_history_image')->image()->directory('wakaf'),
                                ])->collapsible(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Transparansi & Pembayaran')
                            ->icon('heroicon-o-currency-dollar')
                            ->schema([
                                Forms\Components\TextInput::make('transparency_title')->default('Amanah yang Terjaga'),
                                Forms\Components\RichEditor::make('transparency_content'),
                                Forms\Components\Section::make('Rekening & QRIS')->schema([
                                    Forms\Components\TextInput::make('bank_name')->default('Bank Syariah Indonesia (BSI)'),
                                    Forms\Components\TextInput::make('bank_account'),
                                    Forms\Components\TextInput::make('bank_account_name'),
                                    Forms\Components\FileUpload::make('qris_image')->image()->directory('wakaf'),
                                ])->columns(2),
                            ]),
                        Forms\Components\Tabs\Tab::make('Penutup')
                            ->icon('heroicon-o-hand-raised')
                            ->schema([
                                Forms\Components\TextInput::make('closing_title')->default('Menjaga Nyala Harapan Generasi'),
                                Forms\Components\RichEditor::make('closing_content'),
                                Forms\Components\TextInput::make('wa_contact')->label('Nomor WA (Format: 628...)'),
                                Forms\Components\Toggle::make('is_publish')->label('Publikasikan Halaman Wakaf')->default(false),
                            ]),
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hero_title')->label('Judul Hero'),
                Tables\Columns\IconColumn::make('is_publish')->boolean()->label('Status Publish'),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWakafSettings::route('/'),
            'create' => Pages\CreateWakafSetting::route('/create'),
            'edit' => Pages\EditWakafSetting::route('/{record}/edit'),
        ];
    }
}
