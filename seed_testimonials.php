<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Testimonial;

$testimonials = [
    [
        'name' => 'H. Ahmad Fauzi',
        'status' => 'Wali Santri MA',
        'quote' => 'Perubahan adab anak saya sangat terasa. Sekarang jauh lebih mandiri dan ibadahnya lebih terjaga. Terima kasih PPI 104.',
        'type' => 'Orang Tua'
    ],
    [
        'name' => 'Ibu Siti Rohmah',
        'status' => 'Wali Santri MTs',
        'quote' => 'Sangat bersyukur menyekolahkan anak di sini. Lingkungannya sangat kekeluargaan dan gurunya sangat peduli pada tiap santri.',
        'type' => 'Orang Tua'
    ],
    [
        'name' => 'Ustadz Lukman Hakim',
        'status' => 'Alumni 2018 - Mahasiswa Al-Azhar Mesir',
        'quote' => "Bekal bahasa Arab dan hafalan Qur'an dari PPI 104 menjadi kunci utama saya bisa melanjutkan studi ke Timur Tengah dengan lancar.",
        'type' => 'Alumni'
    ],
    [
        'name' => 'Dr. Wildan Fauzi',
        'status' => 'Alumni 2012 - Praktisi Kesehatan',
        'quote' => 'Pelajaran tentang kedisiplinan dan amanah di pesantren sangat membantu saya dalam menjalani profesi saya sekarang sebagai dokter.',
        'type' => 'Alumni'
    ]
];

Testimonial::truncate();
foreach($testimonials as $t) {
    Testimonial::create($t);
}
echo "Testimonials seeded successfully\n";
