<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Facility;

$facilities = [
    [ 'name' => 'Masjid Putra & Putri', 'icon' => '🕌', 'description' => 'Sarana ibadah luas dan terpisah.' ],
    [ 'name' => 'Asrama Nyaman', 'icon' => '🏠', 'description' => 'Hunian bersih dengan pengawasan asatidz.' ],
    [ 'name' => 'Ruang Kelas', 'icon' => '🏫', 'description' => 'Ruang belajar representatif & modern.' ],
    [ 'name' => 'Kantin Sehat', 'icon' => '🍱', 'description' => 'Makanan bergizi untuk harian santri.' ],
    [ 'name' => 'Kopontren', 'icon' => '🛒', 'description' => 'Koperasi penyedia kebutuhan santri.' ],
    [ 'name' => 'Lapangan Olahraga', 'icon' => '🏀', 'description' => 'Fasilitas olahraga terbuka luas.' ]
];

Facility::truncate();
foreach($facilities as $f) {
    Facility::create($f);
}
echo "Facilities seeded successfully\n";
