<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Menu;
use App\Models\MenuItem;

// Truncate menus and menu items
MenuItem::truncate();
Menu::truncate();

// Profil Menu
$profil = Menu::create([
    'name' => 'Profil',
    'location' => 'profil',
    'is_active' => true,
]);

$profilItems = [
    ['title' => 'Sejarah', 'url' => '/profil/sejarah', 'order' => 1],
    ['title' => 'Tokoh Pendiri', 'url' => '/profil/tokoh-pendiri', 'order' => 2],
    ['title' => 'Visi & Misi', 'url' => '/profil/visi-misi', 'order' => 3],
    ['title' => 'Struktur Organisasi', 'url' => '/profil/struktur', 'order' => 4],
    ['title' => 'Tendik Pesantren', 'url' => '/profil/asatidz', 'order' => 5],
    ['title' => 'Sarana & Prasarana', 'url' => '/profil/sarana', 'order' => 6],
];

foreach ($profilItems as $item) {
    $profil->items()->create($item + ['is_active' => true]);
}

// Program Menu
$program = Menu::create([
    'name' => 'Program',
    'location' => 'program',
    'is_active' => true,
]);

$programItems = [
    ['title' => 'KOBER', 'url' => '/program/kober', 'order' => 1],
    ['title' => 'RA', 'url' => '/program/ra', 'order' => 2],
    ['title' => 'SDIT', 'url' => '/program/sdit', 'order' => 3],
    ['title' => 'MDT', 'url' => '/program/mdt', 'order' => 4],
    ['title' => 'MTS', 'url' => '/program/mts', 'order' => 5],
    ['title' => 'MA', 'url' => '/program/ma', 'order' => 6],
];

foreach ($programItems as $item) {
    $program->items()->create($item + ['is_active' => true]);
}

// Program Pesantren Menu
$programPesantren = Menu::create([
    'name' => 'Program Pesantren',
    'location' => 'program_pesantren',
    'is_active' => true,
]);

$programPesantrenItems = [
    ['title' => 'Wakaf Pendidikan', 'url' => '/dukungan', 'order' => 1],
    ['title' => 'Pembangunan Sarana', 'url' => '/dukungan/pembangunan', 'order' => 2],
    ['title' => 'Beasiswa Santri', 'url' => '/dukungan/beasiswa', 'order' => 3],
    ['title' => 'Tabungan Umroh', 'url' => '/program/tabungan-umroh', 'order' => 4],
    ['title' => 'Tabungan Kurban', 'url' => '/program/tabungan-kurban', 'order' => 5],
    ['title' => 'Kopontren', 'url' => '/program/kopontren', 'order' => 6],
];

foreach ($programPesantrenItems as $item) {
    $programPesantren->items()->create($item + ['is_active' => true]);
}

echo "Menus and Menu Items seeded successfully!\n";
