<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\News;
use Illuminate\Support\Str;

$news = [
    [
        'title' => 'Update Kegiatan Ramadan Camp PPI 104 Al-Ittihad 2026',
        'image' => 'https://picsum.photos/1000/600?nature',
        'content' => 'Membentuk karakter santri yang beradab dan berprestasi di bulan suci melalui berbagai kegiatan positif dan ibadah intensif.',
        'published_at' => '2026-04-20',
    ],
    [
        'title' => 'Kunjungan Edukasi Santri ke Perpustakaan Nasional',
        'image' => 'https://picsum.photos/200/200?random=1',
        'content' => 'Para santri melakukan studi literasi ke perpustakaan nasional untuk menambah wawasan.',
        'published_at' => '2026-04-20',
    ],
    [
        'title' => 'Pelatihan Jurnalistik untuk Santri MA',
        'image' => 'https://picsum.photos/200/200?random=2',
        'content' => 'Meningkatkan kemampuan menulis dan literasi digital santri tingkat Madrasah Aliyah.',
        'published_at' => '2026-04-21',
    ],
    [
        'title' => 'Prestasi Santri di Ajang MTQ Tingkat Kabupaten',
        'image' => 'https://picsum.photos/200/200?random=3',
        'content' => 'Alhamdulillah, perwakilan PPI 104 meraih juara 1 dalam musabaqah hifdzil quran.',
        'published_at' => '2026-04-22',
    ]
];

News::truncate();
foreach($news as $n) {
    $n['slug'] = Str::slug($n['title']);
    News::create($n);
}
echo "Done\n";
