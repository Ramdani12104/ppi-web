<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\History::create([
            'title' => 'Sejarah Pesantren Persatuan Islam 104 Al Ittihaad Cikajang',
            'image' => null,
            'content' => 'Pesantren Persatuan Islam 104 Al Ittihaad Cikajang berdiri sejak tahun 1994 dan bergerak di bidang pendidikan mulai dari Kober, RA, SDIT, MDT, MTs, hingga MA. Pesantren ini berkomitmen untuk mencetak generasi yang berilmu, berakhlak mulia, dan siap menghadapi tantangan zaman dengan tetap memegang teguh nilai-nilai Islam.',
            'established_year' => 1994,
        ]);
    }
}
