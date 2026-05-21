<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Extracurricular;

$data = [
    [ 'name' => 'Pramuka', 'stages' => 'SDIT, MTS, MA', 'icon' => '🏕️', 'color_classes' => 'bg-orange-50 text-orange-700 border-orange-100' ],
    [ 'name' => 'Olahraga', 'stages' => 'Semua Jenjang', 'icon' => '⚽', 'color_classes' => 'bg-blue-50 text-blue-700 border-blue-100' ],
    [ 'name' => 'Seni & Kaligrafi', 'stages' => 'MDT, MTS, MA', 'icon' => '🎨', 'color_classes' => 'bg-purple-50 text-purple-700 border-purple-100' ],
    [ 'name' => 'Hadroh', 'stages' => 'MTS, MA', 'icon' => '🥁', 'color_classes' => 'bg-emerald-50 text-emerald-700 border-emerald-100' ],
    [ 'name' => 'Pencak Silat', 'stages' => 'SDIT, MTS, MA', 'icon' => '🥋', 'color_classes' => 'bg-red-50 text-red-700 border-red-100' ],
    [ 'name' => 'Marching Band', 'stages' => 'MTS, MA', 'icon' => '🎺', 'color_classes' => 'bg-indigo-50 text-indigo-700 border-indigo-100' ],
    [ 'name' => 'PMI / UKS', 'stages' => 'MTS, MA', 'icon' => '🏥', 'color_classes' => 'bg-rose-50 text-rose-700 border-rose-100' ],
    [ 'name' => 'Tahfidz Camp', 'stages' => 'Semua Jenjang', 'icon' => '📖', 'color_classes' => 'bg-teal-50 text-teal-700 border-teal-100' ]
];

Extracurricular::truncate();
foreach($data as $d) { Extracurricular::create($d); }
echo "Done\n";
