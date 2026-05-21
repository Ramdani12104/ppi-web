<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visi = 'Mewujudkan generasi yang berakhlak mulia (Adab sebelum Ilmu) dan unggul dalam prestasi akademik di seluruh jenjang (Kober hingga MA).';
        
        $misi = [
            [
                'title' => 'Pendidikan Karakter & Adab',
                'description' => 'Menanamkan nilai-nilai adab dan akhlak mulia sejak usia dini melalui pembiasaan ibadah harian dan perilaku terpuji.',
                'icon' => '🌱'
            ],
            [
                'title' => 'Penguasaan Ilmu Pengetahuan',
                'description' => 'Menyelenggarakan pendidikan berkualitas yang mengintegrasikan kurikulum nasional dengan nilai-nilai Islam untuk mencetak generasi yang cerdas dan berwawasan luas.',
                'icon' => '📚'
            ],
            [
                'title' => 'Pengembangan Tahfidz Al-Qur\'an',
                'description' => 'Membangun unit Raudhatul Hufadz untuk mencetak penghafal Al-Qur\'an dengan metode mutqin dan pendampingan intensif.',
                'icon' => '🕌'
            ],
            [
                'title' => 'Pembinaan Bahasa Arab',
                'description' => 'Meningkatkan kemampuan santri dalam bahasa Arab sebagai kunci pemahaman sumber-sumber ilmu Islam (Al-Qur\'an dan As-Sunnah).',
                'icon' => '📖'
            ],
            [
                'title' => 'Pengembangan Potensi & Kreativitas',
                'description' => 'Menyelenggarakan program ekstrakurikuler dan kegiatan pesantren untuk mengasah bakat, kreativitas, dan kemandirian santri.',
                'icon' => '⭐'
            ],
            [
                'title' => 'Kaderisasi Kepemimpinan Umat',
                'description' => 'Mempersiapkan santri sebagai kader pemimpin umat yang siap mengabdi dan berkontribusi bagi kemajuan bangsa dan agama.',
                'icon' => '🎯'
            ]
        ];

        return view('visi-misi', compact('visi', 'misi'));
    }
}
