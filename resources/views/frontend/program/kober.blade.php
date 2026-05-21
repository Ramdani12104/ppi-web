@extends('layouts.main')

@section('title', $kober->hero_title ?? 'Kober Al-Ittihaad - Pendidikan Usia Dini Islami')

@section('content')
<style>
    :root {
        --kober-primary: {{ $kober->color_primary ?? '#fef3c7' }};
        --kober-button: {{ $kober->color_button ?? '#f59e0b' }};
        --kober-card: {{ $kober->color_card ?? '#ffffff' }};
    }
    .bg-kober-primary { background-color: var(--kober-primary); }
    .bg-kober-button { background-color: var(--kober-button); }
    .bg-kober-card { background-color: var(--kober-card); }
    .text-kober-button { color: var(--kober-button); }
    .border-kober-button { border-color: var(--kober-button); }
    
    .blob-shape {
        border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
        animation: morph 8s ease-in-out infinite;
    }
    @keyframes morph {
        0%, 100% { border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%; }
        34% { border-radius: 70% 30% 50% 50% / 30% 30% 70% 70%; }
        67% { border-radius: 100% 60% 60% 100% / 100% 100% 60% 60%; }
    }
</style>

<div class="font-sans text-gray-800 bg-[#fefaf0]"> <!-- Soft cream base -->

    <!-- 1. HERO SECTION -->
    @if($kober->is_active_hero ?? true)
    <section class="relative min-h-[90vh] flex items-center overflow-hidden bg-kober-primary">
        <div class="absolute top-10 left-10 w-64 h-64 bg-yellow-200/50 blob-shape blur-xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-orange-200/40 blob-shape blur-2xl"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full grid md:grid-cols-2 gap-12 items-center py-20">
            <div class="text-left space-y-8">
                <div class="inline-block px-5 py-2 bg-white/80 backdrop-blur rounded-full text-kober-button font-bold text-sm tracking-widest uppercase shadow-sm border border-orange-100">
                    Pendidikan Usia Dini Islami
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                    {{ $kober->hero_title ?? 'Melangkah Ceria, Tumbuh Bahagia dalam Dekapan Cinta Islami' }}
                </h1>
                <p class="text-xl text-gray-700 leading-relaxed max-w-lg">
                    {{ $kober->hero_subtitle ?? 'Selamat datang di Kober Al-Ittihaad, rumah kedua yang hangat dan penuh kasih sayang. Kami hadir untuk membersamai langkah kecil ananda di masa keemasan mereka.' }}
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#daftar" class="bg-kober-button text-white px-8 py-4 rounded-full font-bold text-lg hover:shadow-lg hover:opacity-90 transition-all transform hover:-translate-y-1">
                        {{ $kober->hero_btn_register ?? 'Mari Bergabung dalam Keceriaan' }}
                    </a>
                    <a href="#kegiatan" class="bg-white text-gray-800 px-8 py-4 rounded-full font-bold text-lg hover:shadow-md transition-all border-2 border-transparent hover:border-gray-200">
                        {{ $kober->hero_btn_activity ?? 'Kenali Program Kami' }}
                    </a>
                </div>
            </div>
            
            <div class="relative">
                <div class="absolute inset-0 bg-kober-button/20 blob-shape transform scale-105"></div>
                @if(isset($kober->hero_banner) && $kober->hero_banner)
                    <img src="{{ asset('storage/' . $kober->hero_banner) }}" alt="Hero Kober" class="relative z-10 w-full h-[500px] object-cover blob-shape border-8 border-white shadow-2xl">
                @else
                    <div class="relative z-10 w-full h-[500px] bg-yellow-100 flex items-center justify-center blob-shape border-8 border-white shadow-2xl text-6xl">🎈🧒👧</div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- 2. TENTANG KOBER -->
    @if($kober->is_active_about ?? true)
    <section class="py-24 px-6 relative">
        <div class="max-w-7xl mx-auto">
            <div class="bg-kober-card rounded-[3rem] shadow-xl p-10 md:p-20 relative overflow-hidden border border-yellow-50">
                <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-100 rounded-bl-[100px] -z-0"></div>
                <div class="relative z-10 grid md:grid-cols-2 gap-16 items-center">
                    <div class="relative group">
                        <div class="absolute inset-0 bg-kober-button rounded-3xl transform rotate-3 transition-transform group-hover:rotate-6"></div>
                        @if(isset($kober->about_image) && $kober->about_image)
                            <img src="{{ asset('storage/' . $kober->about_image) }}" alt="Tentang" class="relative rounded-3xl shadow-lg w-full h-[400px] object-cover transform transition-transform group-hover:-translate-y-2">
                        @else
                            <div class="relative rounded-3xl shadow-lg w-full h-[400px] bg-orange-100 flex items-center justify-center text-6xl transform transition-transform group-hover:-translate-y-2">🎨</div>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-4xl font-extrabold text-gray-900 mb-8">{{ $kober->about_title ?? 'Menyemai Adab dan Ilmu di Masa Keemasan' }}</h2>
                        <div class="prose prose-lg text-gray-600 text-justify leading-relaxed">
                            @if(isset($kober->about_content) && $kober->about_content)
                                {!! $kober->about_content !!}
                            @else
                                <p>Setiap anak adalah anugerah terindah dan amanah terbesar. Di usia dini, mereka ibarat kertas putih yang suci, siap menerima setiap goresan warna kebaikan. Masa golden age ini adalah waktu paling berharga, di mana setiap rangsangan positif akan membekas erat dan membentuk fondasi kepribadian mereka.</p>
                                <p>Kami percaya bahwa dunia anak adalah dunia bermain. Pendekatan belajar yang kami terapkan sepenuhnya berbasis pada konsep <strong>belajar sambil bermain</strong>. Melalui aktivitas yang menyenangkan, anak-anak diajak mengeksplorasi lingkungan, mengenali kebesaran ciptaan Allah, dan merangsang rasa ingin tahu alami tanpa paksaan.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 3. PROGRAM PEMBELAJARAN -->
    @if($kober->is_active_programs ?? true)
    <section id="kegiatan" class="py-24 px-6 bg-yellow-50/50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold text-gray-900 mb-4">Program Pembelajaran</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Metode belajar sambil bermain yang menyenangkan dan berpusat pada nilai-nilai Islami.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($kober->programs ?? [] as $program)
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 text-center group">
                    <div class="w-20 h-20 mx-auto bg-yellow-100 text-kober-button rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        {{ $program->icon ?? '✨' }}
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $program->title }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $program->description }}</p>
                </div>
                @empty
                <!-- Fallback Programs -->
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 text-center group">
                    <div class="w-20 h-20 mx-auto bg-yellow-100 text-kober-button rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🕋</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Belajar Islami</h3>
                    <p class="text-gray-600 leading-relaxed">Mengenalkan kebesaran Allah melalui pendekatan alam dan cinta kasih, menanamkan akidah lurus sejak dini.</p>
                </div>
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 text-center group">
                    <div class="w-20 h-20 mx-auto bg-yellow-100 text-kober-button rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🧩</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Bermain Edukatif</h3>
                    <p class="text-gray-600 leading-relaxed">Merangsang panca indera melalui permainan interaktif, mengasah kognitif dan problem solving dalam suasana riang gembira.</p>
                </div>
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 text-center group">
                    <div class="w-20 h-20 mx-auto bg-yellow-100 text-kober-button rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">📖</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tahfidz Anak</h3>
                    <p class="text-gray-600 leading-relaxed">Memperkenalkan alunan ayat suci Al-Qur'an dengan metode talqin berulang melalui nada riang tanpa membebani anak.</p>
                </div>
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 text-center group">
                    <div class="w-20 h-20 mx-auto bg-yellow-100 text-kober-button rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🎨</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Motorik & Kreativitas</h3>
                    <p class="text-gray-600 leading-relaxed">Aktivitas melukis, bermain balok, dan berlari di taman rumput untuk merangsang kreativitas bebas imajinasi.</p>
                </div>
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 text-center group">
                    <div class="w-20 h-20 mx-auto bg-yellow-100 text-kober-button rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🤝</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Interaksi Sosial</h3>
                    <p class="text-gray-600 leading-relaxed">Belajar mengelola emosi, berbagi mainan, mengantre sabar, serta mengucapkan tolong, maaf, dan terima kasih.</p>
                </div>
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 text-center group">
                    <div class="w-20 h-20 mx-auto bg-yellow-100 text-kober-button rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🤲</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Pembiasaan Adab</h3>
                    <p class="text-gray-600 leading-relaxed">Membangun kebiasaan baik dari wudhu, shalat, adab makan minum, hingga doa harian sebagai fondasi karakter.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- 4. GALERI -->
    @if($kober->is_active_gallery ?? true)
    <section class="py-24 px-6">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-16">Galeri Keceriaan</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @if(isset($kober->galleries) && $kober->galleries->count() > 0)
                    @foreach($kober->galleries as $gallery)
                    <div class="overflow-hidden rounded-3xl shadow-sm hover:shadow-xl transition-all group">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Galeri" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    @endforeach
                @else
                    @for($i=1; $i<=4; $i++)
                    <div class="overflow-hidden rounded-3xl shadow-sm hover:shadow-xl transition-all bg-yellow-100 h-64 flex items-center justify-center text-4xl group">
                        <span class="group-hover:scale-125 transition-transform duration-500">📸</span>
                    </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- 5. KEUNGGULAN -->
    @if($kober->is_active_advantages ?? true)
    <section class="py-24 px-6 bg-kober-primary/50 relative overflow-hidden">
        <div class="absolute -left-20 top-20 w-64 h-64 bg-white/40 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-16 text-center">Mengapa Memilih Kober Al-Ittihaad?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse($kober->advantages ?? [] as $advantage)
                <div class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow relative">
                    <div class="absolute -top-6 -right-6 w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center text-2xl border-4 border-white shadow-sm">
                        {{ $advantage->icon ?? '🌟' }}
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 pt-4">{{ $advantage->title }}</h3>
                    <p class="text-gray-600">{{ $advantage->description }}</p>
                </div>
                @empty
                <div class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow relative">
                    <div class="absolute -top-6 -right-6 w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center text-2xl border-4 border-white shadow-sm">👩‍🏫</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 pt-4">Guru Penyayang</h3>
                    <p class="text-gray-600">Pendidik yang hadir sebagai sahabat bermain sekaligus ibu kedua bagi ananda tercinta.</p>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow relative">
                    <div class="absolute -top-6 -right-6 w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center text-2xl border-4 border-white shadow-sm">🕌</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 pt-4">Lingkungan Islami</h3>
                    <p class="text-gray-600">Atmosfer keislaman yang indah, membuat anak mencintai syariat agamanya tanpa merasa dipaksa.</p>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow relative">
                    <div class="absolute -top-6 -right-6 w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center text-2xl border-4 border-white shadow-sm">🏃‍♂️</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 pt-4">Belajar Aktif</h3>
                    <p class="text-gray-600">Media pembelajaran interaktif yang melibatkan seluruh panca indera dalam setiap sesinya.</p>
                </div>
                <div class="bg-white p-8 rounded-[2rem] shadow-sm hover:shadow-md transition-shadow relative">
                    <div class="absolute -top-6 -right-6 w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center text-2xl border-4 border-white shadow-sm">❤️</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 pt-4">Bina Karakter</h3>
                    <p class="text-gray-600">Fokus mencetak anak yang jujur, santun, pemberani, penyayang, dan berbakti kepada orang tua.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- 6. INFORMASI -->
    @if($kober->is_active_info ?? true)
    <section class="py-24 px-6">
        <div class="max-w-5xl mx-auto bg-white rounded-[3rem] shadow-xl p-10 md:p-16 border-t-8 border-kober-button relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-yellow-50 rounded-full -mr-20 -mt-20"></div>
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12 relative z-10">Informasi Pendaftaran</h2>
            <div class="grid md:grid-cols-2 gap-10 relative z-10">
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 bg-yellow-50 text-kober-button rounded-2xl flex items-center justify-center text-2xl shrink-0">👶</div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">Usia Anak</h4>
                        <p class="text-gray-600 mt-2">{{ $kober->info_age ?? 'Mulai dari 3 hingga 5 Tahun' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 bg-yellow-50 text-kober-button rounded-2xl flex items-center justify-center text-2xl shrink-0">⏰</div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">Jadwal Belajar</h4>
                        <p class="text-gray-600 mt-2">{{ $kober->info_schedule ?? 'Senin - Jumat | 07:30 - 11:00 WIB' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 bg-yellow-50 text-kober-button rounded-2xl flex items-center justify-center text-2xl shrink-0">🎪</div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">Fasilitas Nyaman</h4>
                        <p class="text-gray-600 mt-2">{{ $kober->info_facilities ?? 'Ruang Ber-AC, Area Bermain Indoor & Outdoor Aman, Alat Peraga Edukatif.' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 bg-yellow-50 text-kober-button rounded-2xl flex items-center justify-center text-2xl shrink-0">📞</div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">Kontak Pendaftaran</h4>
                        <p class="text-gray-600 mt-2">{{ $kober->info_contact ?? '0812-3456-7890 (Ustz. Admin)' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 7. CTA PENUTUP -->
    @if($kober->is_active_cta ?? true)
    <section id="daftar" class="py-24 px-6 relative overflow-hidden">
        <div class="max-w-5xl mx-auto bg-kober-button rounded-[3rem] p-16 text-center text-white relative shadow-2xl overflow-hidden">
            @if(isset($kober->cta_bg) && $kober->cta_bg)
                <div class="absolute inset-0 bg-black/40 mix-blend-multiply z-10"></div>
                <img src="{{ asset('storage/' . $kober->cta_bg) }}" class="absolute inset-0 w-full h-full object-cover z-0">
            @else
                <div class="absolute inset-0 bg-white/10 blob-shape scale-150 -translate-y-20 z-0"></div>
            @endif
            
            <div class="relative z-20">
                <h2 class="text-4xl font-extrabold mb-6">{{ $kober->cta_title ?? 'Mari Mengukir Kenangan Indah Bersama Kami' }}</h2>
                <p class="text-xl opacity-90 max-w-2xl mx-auto mb-10 leading-relaxed">{{ $kober->cta_desc ?? 'Masa kecil ananda tidak akan pernah terulang kembali. Berikan mereka hadiah terbaik berupa memori bahagia dan pondasi iman yang kokoh bersama keluarga besar Kober Al-Ittihaad.' }}</p>
                <button class="bg-white text-kober-button px-10 py-5 rounded-full font-bold text-xl hover:shadow-xl transform hover:-translate-y-1 transition-all">
                    {{ $kober->cta_btn ?? 'Jadwalkan Kunjungan Sekarang' }}
                </button>
            </div>
        </div>
    </section>
    @endif

</div>
@endsection
