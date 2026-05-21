<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Program;

$programs = [
    // TYPE: Jenjang
    [ 'name' => 'KOBER', 'description' => 'Kelompok Bermain untuk anak usia dini dengan pendekatan bermain sambil belajar nilai-nilai dasar Islam.', 'image' => 'hero1', 'type' => 'Jenjang', 'icon' => null, 'color_gradient' => null ],
    [ 'name' => 'RA (Raudhatul Athfal)', 'description' => 'Tingkat taman kanak-kanak yang menitikberatkan pada pembiasaan ibadah harian dan pengenalan huruf hijaiyah.', 'image' => 'hero2', 'type' => 'Jenjang', 'icon' => null, 'color_gradient' => null ],
    [ 'name' => 'SDIT', 'description' => 'Sekolah Dasar Islam Terpadu dengan integrasi ilmu umum dan penguatan hafalan Al-Qur\'an sejak dini.', 'image' => 'hero3', 'type' => 'Jenjang', 'icon' => null, 'color_gradient' => null ],
    [ 'name' => 'Madrasah Diniyah', 'description' => 'Program Takmiliyah untuk pendalaman ilmu alat, fiqih, dan aqidah yang dilaksanakan pada siang/sore hari.', 'image' => 'hero1', 'type' => 'Jenjang', 'icon' => null, 'color_gradient' => null ],
    [ 'name' => 'Madrasah Tsanawiyah', 'description' => 'Jenjang menengah pertama dengan lingkungan asrama yang mendukung kemandirian dan penguasaan bahasa Arab.', 'image' => 'hero2', 'type' => 'Jenjang', 'icon' => null, 'color_gradient' => null ],
    [ 'name' => 'Madrasah Aliyah', 'description' => 'Pendidikan menengah atas sebagai persiapan studi lanjut dan kaderisasi kepemimpinan umat.', 'image' => 'hero3', 'type' => 'Jenjang', 'icon' => null, 'color_gradient' => null ],
    
    // TYPE: Pesantren
    [ 'name' => 'Raudhatul Hufadz (RH)', 'description' => 'Unit khusus pencetak penghafal Al-Qur\'an dengan pendampingan intensif dan metode mutqin.', 'icon' => '🕌', 'color_gradient' => 'from-emerald-500 to-emerald-700', 'type' => 'Pesantren', 'image' => null ],
    [ 'name' => 'Revitalisasi Al-Qur\'an', 'description' => 'Program peningkatan kualitas bacaan dan pemahaman Al-Qur\'an bagi seluruh santri secara sistematis.', 'icon' => '📖', 'color_gradient' => 'from-blue-500 to-blue-700', 'type' => 'Pesantren', 'image' => null ],
    [ 'name' => 'Brigade Santri', 'description' => 'Wadah kedisiplinan dan kepanduan untuk membentuk mental yang kuat, tangkas, dan berjiwa kepemimpinan.', 'icon' => '🛡️', 'color_gradient' => 'from-slate-700 to-slate-900', 'type' => 'Pesantren', 'image' => null ],
    [ 'name' => 'Poskestren', 'description' => 'Pos Kesehatan Pesantren yang melayani kesehatan santri sekaligus edukasi pola hidup bersih dan sehat.', 'icon' => '🏥', 'color_gradient' => 'from-red-500 to-red-700', 'type' => 'Pesantren', 'image' => null ],
    [ 'name' => 'Jurnalistik', 'description' => 'Pelatihan literasi, kepenulisan, dan media untuk mengasah kemampuan dakwah santri di era digital.', 'icon' => '✍️', 'color_gradient' => 'from-orange-500 to-orange-700', 'type' => 'Pesantren', 'image' => null ],
    [ 'name' => 'Program Lainnya', 'description' => 'Berbagai kegiatan ekstrakurikuler dan pengembangan bakat yang akan terus bertambah sesuai kebutuhan santri.', 'icon' => '✨', 'color_gradient' => 'from-purple-500 to-purple-700', 'type' => 'Pesantren', 'image' => null ],
];

Program::truncate();
foreach($programs as $p) {
    Program::create($p);
}
echo "Programs seeded successfully\n";
