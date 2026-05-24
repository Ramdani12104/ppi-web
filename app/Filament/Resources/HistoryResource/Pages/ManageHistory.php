<?php

namespace App\Filament\Resources\HistoryResource\Pages;

use App\Filament\Concerns\HasSingleRecordPage;
use App\Filament\Resources\HistoryResource;
use App\Models\History;
use Filament\Resources\Pages\EditRecord;

class ManageHistory extends EditRecord
{
    use HasSingleRecordPage;

    protected static string $resource = HistoryResource::class;

    protected static ?string $title = 'Halaman Sejarah Pesantren';

    public function mount(int | string $record = null): void
    {
        $record = History::firstOrCreate([], [
            'title' => 'Sejarah Pesantren Persatuan Islam 104 Al Ittihaad Cikajang',
            'established_year' => 1994,
            'content' => 'Pesantren Persatuan Islam 104 Al Ittihaad Cikajang berdiri sejak tahun 1994...',
        ]);

        parent::mount($record->getKey());
    }
}
