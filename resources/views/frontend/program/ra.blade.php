@extends('layouts.main')

@section('title', $ra->hero_title ?? 'RA Persis 104 - Raudhatul Athfal')

@section('content')
<style>
    :root {
        --ra-primary: {{ $ra->color_primary ?? '#F7F1E3' }};
        --ra-button: {{ $ra->color_button ?? '#7BAE7F' }};
        --ra-card: {{ $ra->color_card ?? '#FFFDF8' }};
        --ra-accent-green: #A8D5BA;
        --ra-accent-gold: #E6C68B;
    }
    .bg-ra-primary { background-color: var(--ra-primary); }
    .bg-ra-button { background-color: var(--ra-button); }
    .bg-ra-card { background-color: var(--ra-card); }
    .text-ra-button { color: var(--ra-button); }
    .border-ra-button { border-color: var(--ra-button); }
    
    .blob-shape-ra {
        border-radius: 50% 50% 30% 70% / 50% 30% 70% 50%;
        animation: morph-ra 10s ease-in-out infinite;
    }
    @keyframes morph-ra {
        0%, 100% { border-radius: 50% 50% 30% 70% / 50% 30% 70% 50%; }
        50% { border-radius: 30% 70% 50% 50% / 70% 50% 50% 30%; }
    }
</style>

<div class="font-sans text-gray-800 bg-ra-primary overflow-x-hidden">

    <!-- 1. HERO SECTION -->
    @if($ra->is_active_hero ?? true)
    <section class="relative min-h-[95vh] flex items-center overflow-hidden">
        <!-- Playful Background Patterns -->
        <div class="absolute top-20 right-10 w-72 h-72 bg-[var(--ra-accent-green)]/30 blob-shape-ra blur-xl"></div>
        <div class="absolute bottom-10 left-10 w-96 h-96 bg-[var(--ra-accent-gold)]/30 blob-shape-ra blur-2xl"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full grid md:grid-cols-2 gap-12 items-center py-20">
            <div class="text-left space-y-8">
                <div class="inline-block px-5 py-2 bg-white/80 backdrop-blur rounded-full text-ra-button font-bold text-sm tracking-widest uppercase shadow-sm border border-[var(--ra-accent-green)]/50">
                    Taman Kanak-Kanak Islami Terpadu
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-tight">
                    {{ $ra->hero_title ?? 'RA Persis 104' }}
                </h1>
                <p class="text-xl text-gray-700 leading-relaxed max-w-lg font-medium">
                    {{ $ra->hero_subtitle ?? 'Tempat merajut asa, membangun karakter Qur\'ani, dan melebarkan sayap kreativitas di usia dini.' }}
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#daftar" class="bg-ra-button text-white px-8 py-4 rounded-3xl font-bold text-lg shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                        {{ $ra->hero_btn_register ?? 'Daftar Sekarang' }}
                    </a>
                    <a href="#kegiatan" class="bg-white text-gray-800 px-8 py-4 rounded-3xl font-bold text-lg shadow-md hover:shadow-lg transition-all border border-gray-100 hover:border-[var(--ra-accent-green)] transform hover:-translate-y-1">
                        {{ $ra->hero_btn_activity ?? 'Jelajahi RA' }}
                    </a>
                </div>
            </div>
            
            <div class="relative">
                <div class="absolute inset-0 bg-ra-button/20 blob-shape-ra transform scale-110 -rotate-6"></div>
                @if(isset($ra->hero_banner) && $ra->hero_banner)
                    <img src="{{ asset('storage/' . $ra->hero_banner) }}" alt="Hero RA" class="relative z-10 w-full h-[550px] object-cover blob-shape-ra border-8 border-white shadow-2xl">
                @else
                    <div class="relative z-10 w-full h-[550px] bg-[var(--ra-accent-green)]/40 flex items-center justify-center blob-shape-ra border-8 border-white shadow-2xl text-6xl">🎨📚🧒</div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- 2. TENTANG RA -->
    @if($ra->is_active_about ?? true)
    <section class="py-24 px-6 relative z-20">
        <div class="max-w-7xl mx-auto">
            <div class="bg-ra-card rounded-[3rem] shadow-xl p-10 md:p-20 relative overflow-hidden border border-[var(--ra-accent-gold)]/20">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-[var(--ra-accent-green)]/20 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 grid md:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-4xl font-extrabold text-gray-900 mb-8">{{ $ra->about_title ?? 'Menyiapkan Generasi Qur\'ani yang Tangguh & Kreatif' }}</h2>
                        <div class="prose prose-lg text-gray-600 text-justify leading-relaxed">
                            @if(isset($ra->about_content) && $ra->about_content)
                                {!! $ra->about_content !!}
                            @else
                                <p>Raudhatul Athfal (RA) Persis 104 adalah kelanjutan pendidikan dari tingkat Kober, di mana anak-anak mulai diajak untuk lebih aktif, disiplin, dan terstruktur tanpa meninggalkan fitrah mereka untuk bermain. Pada jenjang ini, kami mematangkan kemandirian dan rasa tanggung jawab.</p>
                                <p>Fokus utama kami adalah <strong>pembiasaan ibadah praktis, penanaman akhlakul karimah, serta eksplorasi kreativitas</strong>. Kami menciptakan lingkungan sekolah yang ramah anak, hijau, dan menstimulasi kecerdasan majemuk (multiple intelligences) sehingga anak siap melangkah ke Sekolah Dasar dengan penuh percaya diri.</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="relative group">
                        <div class="absolute inset-0 bg-[var(--ra-accent-gold)] rounded-[3rem] transform -rotate-3 transition-transform group-hover:-rotate-6"></div>
                        @if(isset($ra->about_image) && $ra->about_image)
                            <img src="{{ asset('storage/' . $ra->about_image) }}" alt="Tentang RA" class="relative rounded-[3rem] shadow-lg w-full h-[450px] object-cover transform transition-transform group-hover:-translate-y-2">
                        @else
                            <div class="relative rounded-[3rem] shadow-lg w-full h-[450px] bg-white border-4 border-[var(--ra-accent-green)]/50 flex items-center justify-center text-7xl transform transition-transform group-hover:-translate-y-2">🕌👧👦</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 3. PROGRAM PEMBELAJARAN -->
    @if($ra->is_active_programs ?? true)
    <section id="kegiatan" class="py-24 px-6 bg-white/50 relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <span class="text-ra-button font-bold tracking-widest uppercase text-sm mb-2 block">Kurikulum Terpadu</span>
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">Program Edukatif RA</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Dirancang khusus untuk merangsang kognitif, motorik, sosial, dan spiritual anak secara seimbang.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($ra->programs ?? [] as $program)
                <div class="bg-ra-card p-10 rounded-tl-[3rem] rounded-br-[3rem] rounded-tr-xl rounded-bl-xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-20 h-20 bg-[var(--ra-accent-green)]/20 text-ra-button rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">
                        {{ $program->icon ?? '🌟' }}
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $program->title }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $program->description }}</p>
                </div>
                @empty
                <div class="bg-ra-card p-10 rounded-tl-[3rem] rounded-br-[3rem] rounded-tr-xl rounded-bl-xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-20 h-20 bg-[var(--ra-accent-green)]/20 text-ra-button rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">📖</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tahfidz & Iqra</h3>
                    <p class="text-gray-600 leading-relaxed">Pengenalan huruf hijaiyah secara interaktif, hafalan surah pendek, dan doa harian dengan metode yang menyenangkan.</p>
                </div>
                <div class="bg-ra-card p-10 rounded-tl-[3rem] rounded-br-[3rem] rounded-tr-xl rounded-bl-xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-20 h-20 bg-[var(--ra-accent-gold)]/20 text-yellow-600 rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🎨</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Kreativitas Seni</h3>
                    <p class="text-gray-600 leading-relaxed">Mengekspresikan diri melalui menggambar, mewarnai, melipat kertas (origami), dan membuat karya kerajinan tangan.</p>
                </div>
                <div class="bg-ra-card p-10 rounded-tl-[3rem] rounded-br-[3rem] rounded-tr-xl rounded-bl-xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-20 h-20 bg-[var(--ra-accent-green)]/20 text-ra-button rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🔢</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Calistung Dasar</h3>
                    <p class="text-gray-600 leading-relaxed">Bermain dengan angka dan huruf, mengenalkan konsep dasar berhitung dan membaca tanpa membebani anak.</p>
                </div>
                <div class="bg-ra-card p-10 rounded-tl-[3rem] rounded-br-[3rem] rounded-tr-xl rounded-bl-xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-20 h-20 bg-[var(--ra-accent-gold)]/20 text-yellow-600 rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🌿</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Eksplorasi Alam</h3>
                    <p class="text-gray-600 leading-relaxed">Kegiatan luar ruang untuk mengenali lingkungan, merawat tanaman, dan menumbuhkan rasa syukur atas ciptaan Allah.</p>
                </div>
                <div class="bg-ra-card p-10 rounded-tl-[3rem] rounded-br-[3rem] rounded-tr-xl rounded-bl-xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-20 h-20 bg-[var(--ra-accent-green)]/20 text-ra-button rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🤝</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Sosial & Karakter</h3>
                    <p class="text-gray-600 leading-relaxed">Kegiatan kelompok yang melatih empati, rasa percaya diri, kepemimpinan dasar, dan kemandirian berpakaian.</p>
                </div>
                <div class="bg-ra-card p-10 rounded-tl-[3rem] rounded-br-[3rem] rounded-tr-xl rounded-bl-xl shadow-sm hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 group">
                    <div class="w-20 h-20 bg-[var(--ra-accent-gold)]/20 text-yellow-600 rounded-full flex items-center justify-center text-3xl mb-6 group-hover:scale-110 transition-transform">🕌</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Praktik Ibadah</h3>
                    <p class="text-gray-600 leading-relaxed">Simulasi shalat berjamaah, tata cara wudhu, dan peringatan hari besar Islam dengan sangat ceria.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- 4. GALERI -->
    @if($ra->is_active_gallery ?? true)
    <section class="py-24 px-6 bg-[var(--ra-accent-green)]/5">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-16">Potret Ceria Ananda</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
                @if(isset($ra->galleries) && $ra->galleries->count() > 0)
                    @foreach($ra->galleries as $gallery)
                    <div class="overflow-hidden rounded-3xl shadow-sm hover:shadow-xl transition-all group aspect-square">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Galeri RA" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    @endforeach
                @else
                    @for($i=1; $i<=4; $i++)
                    <div class="overflow-hidden rounded-3xl shadow-sm hover:shadow-xl transition-all bg-[var(--ra-accent-gold)]/20 aspect-square flex items-center justify-center text-4xl group">
                        <span class="group-hover:scale-125 transition-transform duration-500">📸</span>
                    </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- 5. KEUNGGULAN -->
    @if($ra->is_active_advantages ?? true)
    <section class="py-24 px-6 relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-4xl font-extrabold text-gray-900 mb-16 text-center">Mengapa RA Persis 104?</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($ra->advantages ?? [] as $advantage)
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-md transition-shadow relative border-l-8 border-ra-button">
                    <div class="text-4xl mb-4">{{ $advantage->icon ?? '⭐' }}</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $advantage->title }}</h3>
                    <p class="text-gray-600">{{ $advantage->description }}</p>
                </div>
                @empty
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-md transition-shadow relative border-l-8 border-ra-button">
                    <div class="text-4xl mb-4">👩‍🏫</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Guru Profesional & Ramah</h3>
                    <p class="text-gray-600">Pendidik berpengalaman yang memahami psikologi perkembangan anak usia dini.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-md transition-shadow relative border-l-8 border-[var(--ra-accent-gold)]">
                    <div class="text-4xl mb-4">🏫</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Fasilitas Lengkap</h3>
                    <p class="text-gray-600">Lingkungan belajar aman dengan alat peraga edukatif modern dan area bermain yang luas.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-md transition-shadow relative border-l-8 border-[var(--ra-accent-green)]">
                    <div class="text-4xl mb-4">🏆</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Berprestasi</h3>
                    <p class="text-gray-600">Aktif mengikuti berbagai perlombaan untuk memupuk rasa keberanian dan sportivitas anak.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- 6. INFORMASI -->
    @if($ra->is_active_info ?? true)
    <section class="py-12 px-6">
        <div class="max-w-5xl mx-auto bg-ra-card rounded-[3rem] shadow-xl p-10 md:p-16 relative overflow-hidden border border-[var(--ra-accent-gold)]/30">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Informasi Pembelajaran</h2>
            <div class="grid md:grid-cols-2 gap-10">
                <div class="flex items-center gap-6 p-4 rounded-2xl hover:bg-white transition-colors">
                    <div class="w-16 h-16 bg-[var(--ra-accent-green)]/20 text-ra-button rounded-full flex items-center justify-center text-3xl shrink-0 shadow-inner">👧</div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">Usia Pendaftaran</h4>
                        <p class="text-gray-600 mt-1">{{ $ra->info_age ?? 'Kelompok A (4-5 th), Kelompok B (5-6 th)' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-6 p-4 rounded-2xl hover:bg-white transition-colors">
                    <div class="w-16 h-16 bg-[var(--ra-accent-gold)]/20 text-yellow-600 rounded-full flex items-center justify-center text-3xl shrink-0 shadow-inner">⏰</div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">Waktu Belajar</h4>
                        <p class="text-gray-600 mt-1">{{ $ra->info_schedule ?? 'Senin - Jumat | 07:30 - 11:30 WIB' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-6 p-4 rounded-2xl hover:bg-white transition-colors">
                    <div class="w-16 h-16 bg-[var(--ra-accent-gold)]/20 text-yellow-600 rounded-full flex items-center justify-center text-3xl shrink-0 shadow-inner">🧸</div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">Fasilitas</h4>
                        <p class="text-gray-600 mt-1">{{ $ra->info_facilities ?? 'Area bermain luas, ruang kelas AC, perpustakaan mini.' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-6 p-4 rounded-2xl hover:bg-white transition-colors">
                    <div class="w-16 h-16 bg-[var(--ra-accent-green)]/20 text-ra-button rounded-full flex items-center justify-center text-3xl shrink-0 shadow-inner">📱</div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg">Hubungi Kami</h4>
                        <p class="text-gray-600 mt-1">{{ $ra->info_contact ?? '0812-9876-5432 (Admin RA)' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- SECTION: ASATIDZ & ASATIDZAH RA -->
    <section class="py-24 px-6 bg-white border-t border-b border-slate-100">
        <div class="max-w-7xl mx-auto">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-4 mb-4 justify-center">
                    <div class="w-12 h-1 bg-emerald-600"></div>
                    <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 uppercase tracking-tight">Asatidz & Asatidzah RA</h2>
                    <div class="w-12 h-1 bg-emerald-600"></div>
                </div>
                <p class="text-slate-500 font-medium max-w-2xl">
                    Tenaga pendidik profesional tingkat Raudhatul Athfal yang berdedikasi membimbing afektif, psikomotorik, dan akhlak santri sejak dini.
                </p>
            </div>

            @if($teachers->isEmpty())
                <div class="text-center py-12 bg-slate-50 rounded-3xl shadow-sm border border-slate-100 max-w-lg mx-auto">
                    <span class="text-5xl block mb-4">👥</span>
                    <h3 class="text-lg font-bold text-slate-700 mb-2">Data Belum Tersedia</h3>
                    <p class="text-slate-500 text-sm">Data tenaga pendidik tingkat RA sedang disiapkan.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($teachers as $teacher)
                        <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-slate-100 flex flex-col h-full transform hover:-translate-y-2">
                            <!-- Top Accent and Photo container -->
                            <div class="h-40 relative overflow-hidden flex items-center justify-center">
                                @if($teacher->photo)
                                    <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-emerald-600 to-teal-700"></div>
                                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
                                    <!-- Circular Initial Fallback in center when no photo -->
                                    <div class="relative z-10 w-20 h-20 rounded-full border-4 border-white bg-white shadow-md overflow-hidden flex items-center justify-center text-emerald-800 font-bold text-3xl">
                                        {{ substr($teacher->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="p-6 flex-1 flex flex-col text-center">
                                <h3 class="text-xl font-bold text-slate-800 mb-1 tracking-tight">
                                    {{ $teacher->name }}
                                </h3>
                                <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-800 text-[10px] font-black uppercase tracking-wider rounded-full border border-emerald-100 mb-4 mx-auto">
                                    {{ $teacher->role }}
                                </span>

                                <div class="text-left flex-1 flex flex-col">
                                    <h4 class="text-[10px] font-black uppercase tracking-wider text-amber-600 mb-1.5 border-b border-slate-50 pb-1 flex items-center gap-1">
                                        <span>📝</span> Mengajar / Tugas
                                    </h4>
                                    <p class="text-slate-650 leading-relaxed text-xs flex-1">
                                        {{ $teacher->tasks ?? 'Membimbing aktivitas motorik halus, pengenalan doa harian, dan pembiasaan islami tingkat RA.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- 7. CTA PENUTUP -->
    @if($ra->is_active_cta ?? true)
    <section id="daftar" class="py-24 px-6 relative">
        <div class="max-w-5xl mx-auto bg-ra-button rounded-[3rem] p-16 text-center text-white relative shadow-2xl overflow-hidden">
            @if(isset($ra->cta_bg) && $ra->cta_bg)
                <div class="absolute inset-0 bg-black/30 mix-blend-multiply z-10"></div>
                <img src="{{ asset('storage/' . $ra->cta_bg) }}" class="absolute inset-0 w-full h-full object-cover z-0">
            @else
                <div class="absolute inset-0 bg-white/10 blob-shape-ra scale-150 -translate-y-20 z-0"></div>
            @endif
            
            <div class="relative z-20">
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6">{{ $ra->cta_title ?? 'Wujudkan Masa Depan Gemilang Ananda' }}</h2>
                <p class="text-xl opacity-90 max-w-2xl mx-auto mb-10 leading-relaxed">{{ $ra->cta_desc ?? 'Berikan pengalaman belajar usia dini terbaik yang menggabungkan nilai spiritual Islam, kecerdasan akademis, dan kreativitas tiada batas. Mari bergabung menjadi keluarga besar RA Persis 104.' }}</p>
                <button class="bg-ra-card text-ra-button px-10 py-5 rounded-full font-bold text-xl hover:shadow-xl transform hover:-translate-y-1 transition-all">
                    {{ $ra->cta_btn ?? 'Daftarkan Ananda Sekarang' }}
                </button>
            </div>
        </div>
    </section>
    @endif

</div>
@endsection
