@extends('layouts.main')

@section('title', $sdit->hero_title ?? 'SDIT Al Ittihaad - Sekolah Dasar Islam Terpadu')

@section('content')
<style>
    :root {
        --sdit-primary: {{ $sdit->color_primary ?? '#ffffff' }};
        --sdit-button: {{ $sdit->color_button ?? '#059669' }};
        --sdit-card: {{ $sdit->color_card ?? '#fef3c7' }};
        --sdit-blue: #eff6ff;
        --sdit-gold: #fde68a;
    }
    .bg-sdit-primary { background-color: var(--sdit-primary); }
    .bg-sdit-button { background-color: var(--sdit-button); }
    .bg-sdit-card { background-color: var(--sdit-card); }
    .text-sdit-button { color: var(--sdit-button); }
    .border-sdit-button { border-color: var(--sdit-button); }
    
    .geometric-pattern {
        background-image: radial-gradient(var(--sdit-button) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.1;
    }
</style>

<div class="font-sans text-gray-800 bg-slate-50 overflow-x-hidden">

    <!-- 1. HERO SECTION -->
    @if($sdit->is_active_hero ?? true)
    <section class="relative min-h-[90vh] flex items-center bg-sdit-primary overflow-hidden border-b border-slate-100 pt-20">
        <div class="absolute inset-0 geometric-pattern"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-sdit-button/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 -left-20 w-72 h-72 bg-[var(--sdit-gold)]/20 rounded-full blur-2xl"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full grid md:grid-cols-2 gap-16 items-center py-20">
            <div class="text-left space-y-8">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-[var(--sdit-blue)] rounded-full text-blue-700 font-bold text-xs tracking-widest uppercase shadow-sm border border-blue-100">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    Sekolah Dasar Islam Terpadu
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-[1.1] tracking-tight">
                    {{ $sdit->hero_title ?? 'Membangun Karakter, Mengukir Prestasi' }}
                </h1>
                <p class="text-lg md:text-xl text-slate-600 leading-relaxed max-w-lg font-medium">
                    {{ $sdit->hero_subtitle ?? 'SDIT Al Ittihaad menggabungkan keunggulan akademik dan kedalaman ilmu agama dalam lingkungan belajar yang modern, disiplin, dan menyenangkan.' }}
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#daftar" class="bg-sdit-button text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 hover:bg-emerald-700">
                        {{ $sdit->hero_btn_register ?? 'Informasi PPDB' }}
                    </a>
                    <a href="#program" class="bg-white text-slate-700 px-8 py-4 rounded-xl font-bold text-lg shadow-sm hover:shadow-md transition-all border border-slate-200 hover:border-sdit-button hover:text-sdit-button">
                        {{ $sdit->hero_btn_activity ?? 'Jelajahi Program' }}
                    </a>
                </div>
            </div>
            
            <div class="relative">
                <div class="absolute inset-0 bg-sdit-button rounded-2xl transform translate-x-4 translate-y-4 opacity-10"></div>
                @if(isset($sdit->hero_banner) && $sdit->hero_banner)
                    <img src="{{ asset('storage/' . $sdit->hero_banner) }}" alt="Hero SDIT" class="relative z-10 w-full h-[500px] object-cover rounded-2xl shadow-2xl border border-slate-100">
                @else
                    <div class="relative z-10 w-full h-[500px] bg-[var(--sdit-blue)] rounded-2xl flex flex-col items-center justify-center shadow-2xl border border-blue-100 text-center p-8">
                        <span class="text-7xl mb-4">🏫🎒</span>
                        <span class="text-blue-800 font-bold text-xl">Ilustrasi Kegiatan SDIT</span>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- 2. TENTANG SDIT -->
    @if($sdit->is_active_about ?? true)
    <section class="py-24 px-6 relative bg-white">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">
            <div class="relative group order-2 md:order-1">
                <div class="absolute inset-0 bg-[var(--sdit-gold)] rounded-2xl transform -rotate-2 transition-transform group-hover:-rotate-3"></div>
                @if(isset($sdit->about_image) && $sdit->about_image)
                    <img src="{{ asset('storage/' . $sdit->about_image) }}" alt="Tentang SDIT" class="relative rounded-2xl shadow-lg w-full h-[450px] object-cover transform transition-transform group-hover:-translate-y-2">
                @else
                    <div class="relative rounded-2xl shadow-lg w-full h-[450px] bg-slate-100 flex items-center justify-center text-7xl transform transition-transform group-hover:-translate-y-2 border-4 border-white">📚👨‍🏫</div>
                @endif
            </div>
            
            <div class="order-1 md:order-2">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-1 bg-sdit-button"></div>
                    <h2 class="text-sm font-bold text-sdit-button uppercase tracking-widest">Tentang Kami</h2>
                </div>
                <h3 class="text-4xl font-black text-slate-900 mb-8 leading-tight">{{ $sdit->about_title ?? 'Pondasi Intelektual Berbasis Spiritual' }}</h3>
                <div class="prose prose-lg text-slate-600 text-justify leading-relaxed">
                    @if(isset($sdit->about_content) && $sdit->about_content)
                        {!! $sdit->about_content !!}
                    @else
                        <p>Sekolah Dasar Islam Terpadu (SDIT) Al Ittihaad hadir sebagai jawaban atas kebutuhan pendidikan dasar yang komprehensif. Kami mengintegrasikan kurikulum pendidikan nasional (Diknas) dengan kurikulum kepesantrenan (Diniyah) untuk menyeimbangkan pencapaian akademik dan pembentukan karakter Islami.</p>
                        <p>Pada jenjang ini, anak-anak dididik untuk mulai berpikir kritis, logis, dan analitis. Kami menanamkan kedisiplinan yang dilandasi oleh kesadaran beribadah, mengajarkan kepemimpinan dasar, serta mengembangkan bakat dan minat mereka melalui fasilitas yang mendukung dan guru-guru yang berkompeten.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 3. PROGRAM UNGGULAN -->
    @if($sdit->is_active_programs ?? true)
    <section id="program" class="py-24 px-6 bg-slate-50 relative border-t border-slate-200">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 mb-6 tracking-tight">Program Unggulan</h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">Kurikulum terpadu yang didesain khusus untuk mencetak lulusan yang cerdas, terampil, dan berakhlak mulia.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($sdit->programs ?? [] as $program)
                <div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 group relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-sdit-button/5 rounded-bl-[100px] -z-0 group-hover:bg-sdit-button/10 transition-colors"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-[var(--sdit-blue)] text-blue-700 rounded-xl flex items-center justify-center text-3xl mb-6 shadow-inner group-hover:-translate-y-1 transition-transform">
                            {{ $program->icon ?? '📘' }}
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">{{ $program->title }}</h3>
                        <p class="text-slate-600 leading-relaxed text-sm">{{ $program->description }}</p>
                    </div>
                </div>
                @empty
                <div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 group relative overflow-hidden">
                    <div class="w-16 h-16 bg-[var(--sdit-blue)] text-blue-700 rounded-xl flex items-center justify-center text-3xl mb-6 shadow-inner group-hover:-translate-y-1 transition-transform">📖</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Tahfidz Qur'an</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Target hafalan juz 30 dan surat-surat pilihan dengan tahsin yang bersanad, dibimbing langsung oleh tim tahfidz.</p>
                </div>
                <div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 group relative overflow-hidden">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-3xl mb-6 shadow-inner group-hover:-translate-y-1 transition-transform">🕌</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Pembiasaan Islami</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Shalat Dhuha, shalat Dzuhur berjamaah, tilawah pagi, dan penerapan adab harian sesuai sunnah Rasulullah.</p>
                </div>
                <div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 group relative overflow-hidden">
                    <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-3xl mb-6 shadow-inner group-hover:-translate-y-1 transition-transform">🗣️</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Bilingual Habit</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Pengenalan kosa kata Bahasa Arab dan Bahasa Inggris aplikatif dalam interaksi keseharian di sekolah.</p>
                </div>
                <div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 group relative overflow-hidden">
                    <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center text-3xl mb-6 shadow-inner group-hover:-translate-y-1 transition-transform">🔬</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Sains & Eksplorasi</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Pembelajaran berbasis proyek (Project Based Learning) untuk mengasah nalar kritis dan pemecahan masalah.</p>
                </div>
                <div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 group relative overflow-hidden">
                    <div class="w-16 h-16 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-3xl mb-6 shadow-inner group-hover:-translate-y-1 transition-transform">🎨</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Pengembangan Bakat</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Berbagai ekstrakurikuler pilihan mulai dari Pramuka, olahraga, seni Islami, hingga literasi dan jurnalistik dasar.</p>
                </div>
                <div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 group relative overflow-hidden">
                    <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-3xl mb-6 shadow-inner group-hover:-translate-y-1 transition-transform">⭐</div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Leadership Dasar</h3>
                    <p class="text-slate-600 leading-relaxed text-sm">Membangun kemandirian, tanggung jawab, dan jiwa kepemimpinan melalui organisasi kelas dan kegiatan pandu.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- 4. KEUNGGULAN & PRESTASI -->
    <section class="py-24 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-16">
                
                <!-- Keunggulan -->
                @if($sdit->is_active_advantages ?? true)
                <div>
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-12 h-1 bg-sdit-button"></div>
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Kenapa SDIT Kami?</h2>
                    </div>
                    <div class="space-y-6">
                        @forelse($sdit->advantages ?? [] as $advantage)
                        <div class="flex gap-4 p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-sdit-button/30 transition-colors">
                            <div class="text-3xl shrink-0">{{ $advantage->icon ?? '✅' }}</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-lg mb-1">{{ $advantage->title }}</h4>
                                <p class="text-slate-600 text-sm leading-relaxed">{{ $advantage->description }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="flex gap-4 p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-sdit-button/30 transition-colors">
                            <div class="text-3xl shrink-0">👨‍🏫</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-lg mb-1">Tenaga Pendidik Profesional</h4>
                                <p class="text-slate-600 text-sm leading-relaxed">Guru bersertifikasi dengan kualifikasi akademik S1/S2 dan memiliki hafalan Al-Qur'an.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-sdit-button/30 transition-colors">
                            <div class="text-3xl shrink-0">🏫</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-lg mb-1">Fasilitas Modern & Terpadu</h4>
                                <p class="text-slate-600 text-sm leading-relaxed">Ruang kelas multimedia, perpustakaan nyaman, lab komputer dasar, dan lingkungan asri.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 p-6 bg-slate-50 rounded-2xl border border-slate-100 hover:border-sdit-button/30 transition-colors">
                            <div class="text-3xl shrink-0">🤝</div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-lg mb-1">Sinergi Orang Tua</h4>
                                <p class="text-slate-600 text-sm leading-relaxed">Program parenting rutin dan laporan perkembangan anak secara berkala & transparan.</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
                @endif

                <!-- Prestasi -->
                @if($sdit->is_active_achievements ?? true)
                <div>
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-12 h-1 bg-[var(--sdit-gold)]"></div>
                        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Prestasi Gemilang</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @forelse($sdit->achievements ?? [] as $achievement)
                        <div class="group rounded-2xl overflow-hidden shadow-md border border-slate-100 bg-white hover:shadow-xl transition-all">
                            <div class="h-40 bg-slate-200 overflow-hidden relative">
                                @if($achievement->image)
                                <img src="{{ asset('storage/' . $achievement->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform" alt="Prestasi">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-4xl bg-[var(--sdit-blue)]">🏆</div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            </div>
                            <div class="p-5">
                                <h4 class="font-bold text-slate-900 text-sm mb-2 line-clamp-2">{{ $achievement->title }}</h4>
                                <p class="text-xs text-sdit-button font-bold uppercase">{{ $achievement->description }}</p>
                            </div>
                        </div>
                        @empty
                        <!-- Fallback Prestasi -->
                        <div class="group rounded-2xl overflow-hidden shadow-md border border-slate-100 bg-white hover:shadow-xl transition-all">
                            <div class="h-40 bg-slate-200 overflow-hidden relative">
                                <div class="w-full h-full flex items-center justify-center text-4xl bg-amber-50">🥇</div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            </div>
                            <div class="p-5">
                                <h4 class="font-bold text-slate-900 text-sm mb-2 line-clamp-2">Juara 1 MHQ Tingkat Kabupaten</h4>
                                <p class="text-xs text-sdit-button font-bold uppercase">Tahun 2025</p>
                            </div>
                        </div>
                        <div class="group rounded-2xl overflow-hidden shadow-md border border-slate-100 bg-white hover:shadow-xl transition-all">
                            <div class="h-40 bg-slate-200 overflow-hidden relative">
                                <div class="w-full h-full flex items-center justify-center text-4xl bg-blue-50">🥈</div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            </div>
                            <div class="p-5">
                                <h4 class="font-bold text-slate-900 text-sm mb-2 line-clamp-2">Olimpiade Sains Nasional (OSN)</h4>
                                <p class="text-xs text-sdit-button font-bold uppercase">Tingkat Provinsi</p>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
                @endif
                
            </div>
        </div>
    </section>

    <!-- 5. GALERI -->
    @if($sdit->is_active_gallery ?? true)
    <section class="py-24 px-6 bg-slate-900 text-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black mb-4">Galeri Kampus SDIT</h2>
                <p class="text-slate-400">Rekam jejak aktivitas, keceriaan, dan kedisiplinan di lingkungan sekolah.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @if(isset($sdit->galleries) && $sdit->galleries->count() > 0)
                    @foreach($sdit->galleries as $gallery)
                    <div class="overflow-hidden rounded-xl bg-slate-800 aspect-video group cursor-pointer">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Galeri SDIT" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-80 group-hover:opacity-100">
                    </div>
                    @endforeach
                @else
                    @for($i=1; $i<=8; $i++)
                    <div class="overflow-hidden rounded-xl bg-slate-800 aspect-video flex items-center justify-center text-3xl group cursor-pointer border border-slate-700">
                        <span class="opacity-50 group-hover:scale-125 group-hover:opacity-100 transition-all duration-500">📸</span>
                    </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- 6. INFORMASI -->
    @if($sdit->is_active_info ?? true)
    <section class="py-16 px-6 bg-slate-50">
        <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-xl p-10 md:p-16 border-t-[6px] border-sdit-button">
            <h2 class="text-3xl font-black text-slate-900 mb-12 text-center">Informasi Akademik</h2>
            <div class="grid md:grid-cols-2 gap-10">
                <div class="flex items-start gap-6 border-b border-slate-100 pb-6 md:border-none md:pb-0">
                    <div class="w-14 h-14 bg-[var(--sdit-blue)] text-blue-700 rounded-xl flex items-center justify-center text-2xl shrink-0">⏰</div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-lg mb-1">Jadwal Belajar</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $sdit->info_schedule ?? 'Full Day School (Senin - Jumat) | 07:00 - 15:00 WIB' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-6 border-b border-slate-100 pb-6 md:border-none md:pb-0">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-700 rounded-xl flex items-center justify-center text-2xl shrink-0">🏫</div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-lg mb-1">Fasilitas Tersedia</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $sdit->info_facilities ?? 'Masjid Luas, Kelas Ber-AC, Laboratorium Komputer, Lapangan Olahraga, Kantin Sehat, Jemputan Sekolah.' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-6 border-b border-slate-100 pb-6 md:border-none md:pb-0">
                    <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-2xl shrink-0">📞</div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-lg mb-1">Kontak Admin SDIT</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $sdit->info_contact ?? '0812-3456-7890 (WA Only) | sdit@alittihad104.sch.id' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-6">
                    <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-2xl shrink-0">📍</div>
                    <div>
                        <h4 class="font-bold text-slate-900 text-lg mb-1">Alamat Kampus</h4>
                        <p class="text-slate-600 text-sm leading-relaxed">{{ $sdit->info_address ?? 'Komplek Pendidikan PPI 104 Cikajang, Gedung SDIT Lantai 1-3.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 7. CTA PENUTUP -->
    @if($sdit->is_active_cta ?? true)
    <section id="daftar" class="py-24 px-6 relative overflow-hidden bg-slate-50">
        <div class="max-w-5xl mx-auto bg-sdit-button rounded-3xl p-16 text-center text-white relative shadow-2xl overflow-hidden border border-emerald-500">
            @if(isset($sdit->cta_bg) && $sdit->cta_bg)
                <div class="absolute inset-0 bg-emerald-900/80 mix-blend-multiply z-10"></div>
                <img src="{{ asset('storage/' . $sdit->cta_bg) }}" class="absolute inset-0 w-full h-full object-cover z-0">
            @else
                <div class="absolute inset-0 geometric-pattern opacity-20"></div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-2xl transform translate-x-1/2 -translate-y-1/2"></div>
            @endif
            
            <div class="relative z-20">
                <h2 class="text-3xl md:text-5xl font-black mb-6 tracking-tight">{{ $sdit->cta_title ?? 'Bergabunglah Bersama Kami' }}</h2>
                <p class="text-lg text-emerald-50 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">{{ $sdit->cta_desc ?? 'Siapkan masa depan ananda dengan fondasi iman yang kuat dan kecerdasan intelektual yang unggul. Pendaftaran Peserta Didik Baru (PPDB) SDIT Al Ittihaad telah dibuka!' }}</p>
                <button class="bg-[var(--sdit-gold)] text-slate-900 px-10 py-4 rounded-xl font-black text-lg hover:shadow-xl hover:bg-yellow-400 transform hover:-translate-y-1 transition-all">
                    {{ $sdit->cta_btn ?? 'Daftar PPDB Online' }}
                </button>
            </div>
        </div>
    </section>
    @endif

</div>
@endsection
