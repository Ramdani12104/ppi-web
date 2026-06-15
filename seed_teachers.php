<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Teacher;

$teachers = [
    // PIMPINAN UMUM & MANAJEMEN
    [
        'name' => 'KH. Ahmad Al-Ittihaad, M.Pd.',
        'role' => 'Pimpinan Umum (Mudir Am)',
        'stage' => 'tendik',
        'tasks' => 'Memimpin pondok pesantren secara umum, menetapkan kebijakan strategis kepesantrenan, dan membina kerohanian seluruh santri.',
        'sort_order' => 1
    ],
    [
        'name' => 'H. Muhammad Yusuf, S.E.',
        'role' => 'Bendahara Umum Pesantren',
        'stage' => 'tendik',
        'tasks' => 'Mengelola administrasi keuangan pesantren, menyusun anggaran operasional tahunan, dan mengawasi sirkulasi keuangan unit usaha.',
        'sort_order' => 2
    ],
    [
        'name' => 'Ust. H. Cecep Syarifuddin, M.A.',
        'role' => 'Waka Kurikulum & Pendidikan',
        'stage' => 'tendik',
        'tasks' => 'Mengembangkan kurikulum kepesantrenan dan akademik, menjadwalkan kajian rutin kitab kuning, dan memantau perkembangan belajar santri.',
        'sort_order' => 3
    ],
    [
        'name' => 'Ustadzah Siti Fatimah, S.Pd.',
        'role' => 'Waka Kesiswaan & Kedisiplinan',
        'stage' => 'tendik',
        'tasks' => 'Membimbing aktivitas organisasi santri, menegakkan disiplin tata tertib, serta mengoordinasikan pembinaan mental karakter santri.',
        'sort_order' => 4
    ],

    // KOBER
    [
        'name' => 'Nenden Marlina',
        'role' => 'Mudir KOBER',
        'stage' => 'kober',
        'tasks' => 'Memimpin satuan pendidikan KOBER, merencanakan kurikulum tumbuh kembang anak usia dini, dan mengoordinasikan kegiatan bermain terpadu.',
        'sort_order' => 1
    ],
    [
        'name' => 'Yulianti, S.Pd.',
        'role' => 'Guru Sentra Bermain',
        'stage' => 'kober',
        'tasks' => 'Mengampu pembelajaran sentra kreativitas, mendampingi aktivitas motorik halus, dan memantau perkembangan afektif anak.',
        'sort_order' => 2
    ],

    // RA
    [
        'name' => 'Lisnawati',
        'role' => 'Mudir RA',
        'stage' => 'ra',
        'tasks' => 'Mengelola operasional Raudhatul Athfal (RA), mengembangkan program pembiasaan akhlak mulia dan tahfidz juz amma sejak dini.',
        'sort_order' => 1
    ],
    [
        'name' => 'Siti Aminah, S.Pd.I.',
        'role' => 'Guru Sentra Aqidah & Ibadah',
        'stage' => 'ra',
        'tasks' => 'Mengajarkan tata cara ibadah praktis, pengenalan huruf hijaiyah, kisah-kisah teladan nabi, serta hafalan doa harian.',
        'sort_order' => 2
    ],

    // SDIT
    [
        'name' => 'Miftah Rahman, S.Pd.',
        'role' => 'Mudir SDIT',
        'stage' => 'sdit',
        'tasks' => 'Memimpin pengelolaan sekolah dasar Islam terpadu, mengintegrasikan kurikulum diknas dengan kurikulum kepesantrenan.',
        'sort_order' => 1
    ],
    [
        'name' => 'Agus Setiawan, S.Pd.',
        'role' => 'Guru Kelas & Pengajar Tematik',
        'stage' => 'sdit',
        'tasks' => 'Mengampu pembelajaran tematik kelas, menanamkan konsep dasar sains dan matematika berbasis nilai-nilai keislaman.',
        'sort_order' => 2
    ],
    [
        'name' => 'Rina Herlina, S.Hum.',
        'role' => 'Pengajar Bahasa Inggris & Arab',
        'stage' => 'sdit',
        'tasks' => 'Mengembangkan keterampilan percakapan dasar (conversation & muhadatsah) bagi anak-anak tingkat dasar.',
        'sort_order' => 3
    ],

    // MDT
    [
        'name' => 'Lia',
        'role' => 'Mudir MDT',
        'stage' => 'mdt',
        'tasks' => 'Memimpin Madrasah Diniyah Takmiliyah (MDT), menyusun jadwal kajian sore, dan mengevaluasi pencapaian tilawah Al-Quran santri.',
        'sort_order' => 1
    ],
    [
        'name' => 'Ahmad Fauzi, S.Ag.',
        'role' => 'Pengajar Tajwid & Tahsin',
        'stage' => 'mdt',
        'tasks' => 'Membimbing ketepatan makharijul huruf, kaidah hukum tajwid praktis, dan menyimak hafalan quran harian.',
        'sort_order' => 2
    ],

    // MTs
    [
        'name' => 'Dede Nasrulloh, S.Pd.I.',
        'role' => 'Mudir MTs',
        'stage' => 'mts',
        'tasks' => 'Mengarahkan kebijakan akademik tingkat Tsanawiyah, pembinaan kedisiplinan santri, dan pengawasan kegiatan ekstra kurikuler kepesantrenan.',
        'sort_order' => 1
    ],
    [
        'name' => 'Asep Saepudin, Lc.',
        'role' => 'Pengajar Fiqih & Ushul Fiqih',
        'stage' => 'mts',
        'tasks' => 'Mengajarkan kitab-kitab fiqih ibadah dasar, membekali santri pemahaman kaidah hukum fiqih, serta membimbing amaliah ibadah.',
        'sort_order' => 2
    ],
    [
        'name' => 'Imas Masitoh, S.Pd.',
        'role' => 'Pengajar Sejarah Kebudayaan Islam (SKI)',
        'stage' => 'mts',
        'tasks' => 'Mengampu pelajaran SKI, menanamkan kecintaan sejarah perjuangan Rasulullah, khulafaur rasyidin, dan dinasti-dinasti Islam.',
        'sort_order' => 3
    ],

    // MA
    [
        'name' => 'Lutfi Abdurahman, M.Ag.',
        'role' => 'Mudir MA',
        'stage' => 'ma',
        'tasks' => 'Mengoordinasikan kurikulum tinggi madrasah aliyah, pembinaan mental kepemimpinan santri senior, serta persiapan alumni ke jenjang kuliah.',
        'sort_order' => 1
    ],
    [
        'name' => 'Cecep Hilman, S.Th.I.',
        'role' => 'Pengajar Nahwu & Shorof (Al-Miftah)',
        'stage' => 'ma',
        'tasks' => 'Membimbing gramatika bahasa Arab tingkat lanjut (nahwu shorof) untuk membaca dan menganalisis kitab kuning secara mandiri.',
        'sort_order' => 2
    ],
    [
        'name' => 'Hani Nurhasanah, Lc.',
        'role' => 'Pengajar Tafsir & Hadits',
        'stage' => 'ma',
        'tasks' => 'Mengkaji ayat-ayat ahkam dan hadits pilihan, memberikan pemahaman metode syarah hadits, dan analisis tematik hukum kontemporer.',
        'sort_order' => 3
    ],

    // MUSRIF & MUSYRIFAH
    [
        'name' => 'Ust. H. Ahmad Salim, S.Ag.',
        'role' => 'Koordinator Kepengasuhan & Asrama',
        'stage' => 'musrif_musyrifah',
        'tasks' => 'Membina adab dan akhlak santri di lingkungan asrama, mengoordinasikan seluruh pembina kamar (musrif/ah), serta mengevaluasi program kepengasuhan.',
        'sort_order' => 1
    ],
    [
        'name' => 'Kamaludin, S.Pd.I.',
        'role' => 'Ketua Musrif Asrama Putra',
        'stage' => 'musrif_musyrifah',
        'tasks' => 'Mengoordinasikan kedisiplinan dan ibadah harian santri putra di lingkungan asrama, membimbing kajian malam, serta menjaga ketertiban asrama.',
        'sort_order' => 2
    ],
    [
        'name' => 'Khadijah, S.Pd.',
        'role' => 'Ketua Musyrifah Asrama Putri',
        'stage' => 'musrif_musyrifah',
        'tasks' => 'Mengoordinasikan pembinaan keputrian, membimbing akhlak santri putri di asrama, mengawasi kebersihan dan ketertiban asrama putri.',
        'sort_order' => 3
    ],

    // TIM QUR'AN
    [
        'name' => 'Ust. Abdul Aziz, Al-Hafidz',
        'role' => 'Koordinator Utama Tahfidz & Quran',
        'stage' => 'timqu',
        'tasks' => 'Mengoordinasikan kurikulum pembelajaran tahfidz dan tahsin Al-Qur\'an, menyusun program karantina tahfidz, dan menguji kelayakan tasmi\' kubra.',
        'sort_order' => 1
    ],
    [
        'name' => 'Ust. M. Abdurrahman, Al-Hafidz',
        'role' => 'Koordinator Tahfidz Putra',
        'stage' => 'timqu',
        'tasks' => 'Mengoordinasikan setoran hafalan quran santri putra, menyusun target hafalan bulanan, dan melakukan pengujian berkala (tasmi\').',
        'sort_order' => 2
    ],
    [
        'name' => 'Ustadzah Syifa Aulia, Al-Hafidzah',
        'role' => 'Koordinator Tahfidz Putri',
        'stage' => 'timqu',
        'tasks' => 'Mengoordinasikan setoran hafalan quran santri putri, melakukan bimbingan tahsin khusus, dan menguji hafalan juziyah santri.',
        'sort_order' => 3
    ],

    // TENDIK / STAF PENDUKUNG
    [
        'name' => 'H. Jajang Sukandar',
        'role' => 'Koordinator Sarana & Staf Pendukung (Tendik)',
        'stage' => 'tendik',
        'tasks' => 'Mengoordinasikan pemeliharaan sarana prasarana pesantren, mengatur jadwal tugas keamanan dan kebersihan kampus, serta mengelola logistik operasional.',
        'sort_order' => 1
    ],
    [
        'name' => 'Budi Santoso',
        'role' => 'Staf Keamanan (Satpam)',
        'stage' => 'tendik',
        'tasks' => 'Menjaga keamanan dan ketertiban pos penjagaan utama pesantren, memantau tamu yang keluar masuk, serta berpatroli keliling area kampus.',
        'sort_order' => 2
    ],
    [
        'name' => 'Slamet Riyadi',
        'role' => 'Petugas Kebersihan & Sarana',
        'stage' => 'tendik',
        'tasks' => 'Memelihara kebersihan ruang kelas, asrama, masjid, serta merawat tanaman dan fasilitas umum di lingkungan pesantren.',
        'sort_order' => 3
    ],

    // RAUDHATUL HUFFADZ (RH)
    [
        'name' => 'KH. M. Yusuf, Al-Hafidz',
        'role' => 'Mudir Raudhatul Huffadz',
        'stage' => 'rh',
        'tasks' => 'Memimpin program khusus tahfidz Raudhatul Huffadz (RH), menyusun kurikulum mutqin 30 juz, serta membina akhlak qur\'ani para huffadz.',
        'sort_order' => 1
    ],
    [
        'name' => 'Ust. Hilman Fauzi, Al-Hafidz',
        'role' => 'Pengajar Tahfidz & Quran',
        'stage' => 'rh',
        'tasks' => 'Membimbing setoran hafalan harian santri RH, mengevaluasi tajwid & fashohah, serta menyimak hafalan berkala.',
        'sort_order' => 2
    ],
    [
        'name' => 'Ustadzah Aisyah, Al-Hafidzah',
        'role' => 'Pengajar Tahfidz & Quran',
        'stage' => 'rh',
        'tasks' => 'Membimbing hafalan santriwati RH, melatih kelancaran talaqqi quran, serta menyimak setoran juz-an santriwati.',
        'sort_order' => 3
    ],
];

Teacher::truncate();
foreach($teachers as $t) {
    Teacher::create($t);
}
echo "Teachers seeded successfully!\n";
