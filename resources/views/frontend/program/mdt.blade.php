@extends('layouts.main')

@section('title', $mdt->hero_title ?? 'MDT Al Ittihaad - Madrasah Diniyah Takmiliyah')

@section('content')
<style>
    :root {
        --mdt-primary: {{ $mdt->color_primary ?? '#fefaf4' }}; /* Putih tulang / Cream hangat */
        --mdt-button: {{ $mdt->color_button ?? '#2a5f4c' }}; /* Hijau pesantren lembut */
        --mdt-card: {{ $mdt->color_card ?? '#d6c7b0' }}; /* Coklat kitab / Gold islami lembut */
    }
    
    .bg-mdt-primary { background-color: var(--mdt-primary); }
    .bg-mdt-button { background-color: var(--mdt-button); }
    .bg-mdt-card { background-color: var(--mdt-card); }
    .text-mdt-button { color: var(--mdt-button); }
    .text-mdt-card { color: var(--mdt-card); }
    .border-mdt-button { border-color: var(--mdt-button); }
    
    /* Islamic Pattern Background */
    .islamic-pattern {
        background-color: var(--mdt-primary);
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232a5f4c' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
</style>

<div class="font-sans text-gray-800 bg-mdt-primary overflow-x-hidden">

    <!-- 1. HERO SECTION -->
    @if($mdt->is_active_hero ?? true)
    <section class="relative min-h-[90vh] flex items-center islamic-pattern overflow-hidden pt-20">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent to-mdt-primary"></div>
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-mdt-card/30 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10 w-full grid md:grid-cols-2 gap-16 items-center py-20">
            <div class="text-left space-y-8">
                <div class="inline-flex items-center gap-3 px-5 py-2 bg-mdt-button/10 rounded-full text-mdt-button font-bold text-xs tracking-widest uppercase border border-mdt-button/20">
                    <span class="text-sm">🕌</span>
                    Madrasah Diniyah Takmiliyah
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-[#2c3e38] leading-[1.1] tracking-tight font-serif">
                    {{ $mdt->hero_title ?? 'Membentuk Generasi Beradab & Cinta Al-Qur\'an' }}
                </h1>
                <p class="text-lg md:text-xl text-[#5a6b65] leading-relaxed max-w-lg font-medium">
                    {{ $mdt->hero_subtitle ?? 'Ngaji sore khas pesantren yang hangat dan religius, menanamkan nilai-nilai salafus shalih untuk bekal akhirat ananda.' }}
                </p>
                <div class="flex flex-wrap gap-4 pt-4">
                    <a href="#daftar" class="bg-mdt-button text-white px-8 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all hover:-translate-y-1">
                        {{ $mdt->hero_btn_register ?? 'Daftar MDT' }}
                    </a>
                    <a href="#program" class="bg-white text-mdt-button px-8 py-4 rounded-xl font-bold text-lg shadow-sm hover:shadow-md transition-all border border-mdt-button/20 hover:border-mdt-button">
                        {{ $mdt->hero_btn_activity ?? 'Jelajahi Program' }}
                    </a>
                </div>
            </div>
            
            <div class="relative flex justify-center">
                <div class="absolute inset-0 bg-mdt-card rounded-[3rem] transform -rotate-3 scale-105 opacity-40"></div>
                @if(isset($mdt->hero_banner) && $mdt->hero_banner)
                    <img src="{{ asset('storage/' . $mdt->hero_banner) }}" alt="Hero MDT" class="relative z-10 w-full max-w-md h-[550px] object-cover rounded-[3rem] shadow-2xl border-4 border-white">
                @else
                    <div class="relative z-10 w-full max-w-md h-[550px] bg-[#e8f1ec] rounded-[3rem] flex flex-col items-center justify-center shadow-2xl border-4 border-white text-center p-8">
                        <span class="text-8xl mb-4">📖👳‍♂️</span>
                        <span class="text-mdt-button font-bold text-xl font-serif">Suasana Ngaji Sore</span>
                    </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- 2. TENTANG MDT -->
    @if($mdt->is_active_about ?? true)
    <section class="py-24 px-6 relative bg-white">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">
            <div class="relative group order-2 md:order-1 flex justify-center">
                <div class="absolute inset-0 bg-mdt-card/50 rounded-t-full transform rotate-3 transition-transform group-hover:rotate-6"></div>
                @if(isset($mdt->about_image) && $mdt->about_image)
                    <img src="{{ asset('storage/' . $mdt->about_image) }}" alt="Tentang MDT" class="relative rounded-t-full shadow-lg w-full max-w-sm h-[500px] object-cover transform transition-transform group-hover:-translate-y-2 border-8 border-white">
                @else
                    <div class="relative rounded-t-full shadow-lg w-full max-w-sm h-[500px] bg-slate-100 flex items-center justify-center text-8xl transform transition-transform group-hover:-translate-y-2 border-8 border-white">🕌</div>
                @endif
            </div>
            
            <div class="order-1 md:order-2 space-y-6">
                <div class="flex items-center gap-4 mb-2">
                    <span class="text-2xl">✨</span>
                    <h2 class="text-sm font-bold text-mdt-card uppercase tracking-[0.2em]">Tentang Madrasah Diniyah</h2>
                </div>
                <h3 class="text-4xl font-black text-[#2c3e38] leading-tight font-serif">{{ $mdt->about_title ?? 'Menghidupkan Tradisi Ilmu & Amal' }}</h3>
                <div class="prose prose-lg text-[#5a6b65] text-justify leading-relaxed">
                    @if(isset($mdt->about_content) && $mdt->about_content)
                        {!! $mdt->about_content !!}
                    @else
                        <p>Madrasah Diniyah Takmiliyah (MDT) Al Ittihaad adalah program pendidikan non-formal keagamaan Islam yang dirancang khusus untuk melengkapi pendidikan agama anak-anak usia sekolah dasar. Kami menghadirkan suasana khas pesantren yang hangat, tenang, dan penuh keberkahan di setiap sore hari.</p>
                        <p>Fokus utama kami adalah pada pembentukan <strong>akhlakul karimah</strong>, kemampuan membaca dan menghafal Al-Qur'an dengan tartil, serta pemahaman dasar-dasar ilmu agama seperti Fiqih, Aqidah, dan Tarikh. Di sini, anak-anak tidak hanya diajarkan ilmu, tetapi juga dibiasakan untuk mengamalkannya dalam kehidupan sehari-hari.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 3. PROGRAM PEMBELAJARAN -->
    @if($mdt->is_active_programs ?? true)
    <section id="program" class="py-24 px-6 islamic-pattern relative border-y border-mdt-card/20">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <span class="text-mdt-card font-bold uppercase tracking-widest text-sm mb-2 block">Materi Pembelajaran</span>
                <h2 class="text-4xl md:text-5xl font-black text-[#2c3e38] mb-6 font-serif tracking-tight">Ilmu Syar'i Dasar</h2>
                <div class="w-24 h-1 bg-mdt-button mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($mdt->programs ?? [] as $program)
                <div class="bg-white/80 backdrop-blur-sm p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-mdt-card/30 group">
                    <div class="w-16 h-16 bg-mdt-card/20 text-mdt-button rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:-translate-y-2 transition-transform duration-300">
                        {{ $program->icon ?? '📖' }}
                    </div>
                    <h3 class="text-xl font-bold text-[#2c3e38] mb-3 font-serif">{{ $program->title }}</h3>
                    <p class="text-[#5a6b65] leading-relaxed text-sm">{{ $program->description }}</p>
                </div>
                @empty
                <!-- Fallback Program MDT -->
                <div class="bg-white/80 backdrop-blur-sm p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-mdt-card/30 group">
                    <div class="w-16 h-16 bg-mdt-card/20 text-mdt-button rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:-translate-y-2 transition-transform duration-300">📖</div>
                    <h3 class="text-xl font-bold text-[#2c3e38] mb-3 font-serif">Tahsin & Tahfidz</h3>
                    <p class="text-[#5a6b65] leading-relaxed text-sm">Perbaikan bacaan Al-Qur'an sesuai tajwid dan makharijul huruf, serta hafalan juz 'amma.</p>
                </div>
                <div class="bg-white/80 backdrop-blur-sm p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-mdt-card/30 group">
                    <div class="w-16 h-16 bg-mdt-card/20 text-mdt-button rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:-translate-y-2 transition-transform duration-300">🤲</div>
                    <h3 class="text-xl font-bold text-[#2c3e38] mb-3 font-serif">Fiqih Ibadah</h3>
                    <p class="text-[#5a6b65] leading-relaxed text-sm">Praktek wudhu, shalat fardhu, shalat sunnah, dan pemahaman tata cara ibadah sehari-hari.</p>
                </div>
                <div class="bg-white/80 backdrop-blur-sm p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-mdt-card/30 group">
                    <div class="w-16 h-16 bg-mdt-card/20 text-mdt-button rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:-translate-y-2 transition-transform duration-300">❤️</div>
                    <h3 class="text-xl font-bold text-[#2c3e38] mb-3 font-serif">Aqidah & Akhlak</h3>
                    <p class="text-[#5a6b65] leading-relaxed text-sm">Pengenalan rukun iman, sifat-sifat Allah, serta penanaman adab kepada orang tua dan guru.</p>
                </div>
                <div class="bg-white/80 backdrop-blur-sm p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-mdt-card/30 group">
                    <div class="w-16 h-16 bg-mdt-card/20 text-mdt-button rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:-translate-y-2 transition-transform duration-300">🕌</div>
                    <h3 class="text-xl font-bold text-[#2c3e38] mb-3 font-serif">Tarikh (Sejarah)</h3>
                    <p class="text-[#5a6b65] leading-relaxed text-sm">Kisah Nabi Muhammad SAW, Khulafaur Rasyidin, dan tokoh-tokoh Islam inspiratif.</p>
                </div>
                <div class="bg-white/80 backdrop-blur-sm p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-mdt-card/30 group">
                    <div class="w-16 h-16 bg-mdt-card/20 text-mdt-button rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:-translate-y-2 transition-transform duration-300">✍️</div>
                    <h3 class="text-xl font-bold text-[#2c3e38] mb-3 font-serif">Bahasa Arab & Pegon</h3>
                    <p class="text-[#5a6b65] leading-relaxed text-sm">Pengenalan kosa kata dasar bahasa Arab dan melatih kemampuan menulis huruf Pegon/Jawi.</p>
                </div>
                <div class="bg-white/80 backdrop-blur-sm p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-mdt-card/30 group">
                    <div class="w-16 h-16 bg-mdt-card/20 text-mdt-button rounded-2xl flex items-center justify-center text-3xl mb-6 group-hover:-translate-y-2 transition-transform duration-300">📿</div>
                    <h3 class="text-xl font-bold text-[#2c3e38] mb-3 font-serif">Pembiasaan Ibadah</h3>
                    <p class="text-[#5a6b65] leading-relaxed text-sm">Dzikir petang bersama, doa sehari-hari, dan shalat Ashar/Maghrib berjamaah di masjid.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- 4. KEUNGGULAN -->
    @if($mdt->is_active_advantages ?? true)
    <section class="py-24 px-6 bg-[#f7f3ec]">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-black text-[#2c3e38] mb-16 font-serif">Keunggulan MDT Al Ittihaad</h2>
            <div class="grid md:grid-cols-3 gap-10">
                @forelse($mdt->advantages ?? [] as $adv)
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-full border border-mdt-card/50 flex items-center justify-center text-4xl mb-6 bg-white shadow-sm">
                        {{ $adv->icon ?? '🌟' }}
                    </div>
                    <h4 class="font-bold text-[#2c3e38] text-xl mb-3">{{ $adv->title }}</h4>
                    <p class="text-[#5a6b65] text-sm leading-relaxed">{{ $adv->description }}</p>
                </div>
                @empty
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-full border border-mdt-card/50 flex items-center justify-center text-4xl mb-6 bg-white shadow-sm">👳‍♂️</div>
                    <h4 class="font-bold text-[#2c3e38] text-xl mb-3">Asatidz Berpengalaman</h4>
                    <p class="text-[#5a6b65] text-sm leading-relaxed">Diasuh langsung oleh ustadz dan ustadzah lulusan pesantren yang ikhlas dan telaten membimbing anak-anak.</p>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-full border border-mdt-card/50 flex items-center justify-center text-4xl mb-6 bg-white shadow-sm">📚</div>
                    <h4 class="font-bold text-[#2c3e38] text-xl mb-3">Kurikulum Khas Persis</h4>
                    <p class="text-[#5a6b65] text-sm leading-relaxed">Menggunakan kitab-kitab dasar rujukan salafus shalih dan kurikulum resmi kepesantrenan Persatuan Islam.</p>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div class="w-20 h-20 rounded-full border border-mdt-card/50 flex items-center justify-center text-4xl mb-6 bg-white shadow-sm">🌿</div>
                    <h4 class="font-bold text-[#2c3e38] text-xl mb-3">Lingkungan Religius</h4>
                    <p class="text-[#5a6b65] text-sm leading-relaxed">Berada di dalam komplek pesantren yang terhindar dari pergaulan bebas, menciptakan suasana kondusif untuk ibadah.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- 5. GALERI -->
    @if($mdt->is_active_gallery ?? true)
    <section class="py-24 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl font-black text-[#2c3e38] font-serif">Keseharian Santri</h2>
                    <p class="text-[#5a6b65] mt-2">Potret kehangatan dan kekhusyukan belajar di sore hari.</p>
                </div>
                <div class="hidden md:block w-1/3 h-[1px] bg-mdt-card/40"></div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @if(isset($mdt->galleries) && $mdt->galleries->count() > 0)
                    @foreach($mdt->galleries as $gallery)
                    <div class="overflow-hidden rounded-2xl bg-slate-100 aspect-square group cursor-pointer">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Galeri MDT" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    </div>
                    @endforeach
                @else
                    @for($i=1; $i<=4; $i++)
                    <div class="overflow-hidden rounded-2xl bg-[#e8f1ec] aspect-square flex items-center justify-center text-4xl group cursor-pointer border border-mdt-card/30">
                        <span class="opacity-40 group-hover:scale-125 group-hover:opacity-100 transition-all duration-500">📷</span>
                    </div>
                    @endfor
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- 6. JADWAL & INFORMASI -->
    @if($mdt->is_active_info ?? true)
    <section class="py-16 px-6 bg-mdt-primary">
        <div class="max-w-5xl mx-auto bg-white rounded-[2rem] shadow-lg p-10 md:p-16 border border-mdt-card/30 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-mdt-card/20 rounded-bl-full"></div>
            
            <h2 class="text-3xl font-black text-[#2c3e38] mb-10 text-center font-serif">Informasi Madrasah</h2>
            <div class="grid md:grid-cols-2 gap-y-10 gap-x-16">
                <div class="flex items-start gap-5">
                    <div class="text-3xl shrink-0 text-mdt-card">⏳</div>
                    <div>
                        <h4 class="font-bold text-[#2c3e38] text-lg mb-1">Jadwal Belajar</h4>
                        <p class="text-[#5a6b65] text-sm leading-relaxed">{{ $mdt->info_schedule ?? 'Senin - Jumat | 14:00 - 17:00 WIB (Setelah Ashar)' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-5">
                    <div class="text-3xl shrink-0 text-mdt-card">👦👧</div>
                    <div>
                        <h4 class="font-bold text-[#2c3e38] text-lg mb-1">Usia Santri</h4>
                        <p class="text-[#5a6b65] text-sm leading-relaxed">{{ $mdt->info_age ?? 'Diperuntukkan bagi anak usia SD/MI sederajat (7-12 Tahun).' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-5">
                    <div class="text-3xl shrink-0 text-mdt-card">🕌</div>
                    <div>
                        <h4 class="font-bold text-[#2c3e38] text-lg mb-1">Fasilitas</h4>
                        <p class="text-[#5a6b65] text-sm leading-relaxed">{{ $mdt->info_facilities ?? 'Masjid yang luas, kelas yang nyaman, perpustakaan mini islami, dan lingkungan pesantren yang aman.' }}</p>
                    </div>
                </div>
                <div class="flex items-start gap-5">
                    <div class="text-3xl shrink-0 text-mdt-card">📱</div>
                    <div>
                        <h4 class="font-bold text-[#2c3e38] text-lg mb-1">Kontak Admin</h4>
                        <p class="text-[#5a6b65] text-sm leading-relaxed">{{ $mdt->info_contact ?? '0852-1111-2222 (Ust. Ahmad) | mdt@alittihad104.sch.id' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 7. CTA PENUTUP -->
    @if($mdt->is_active_cta ?? true)
    <section id="daftar" class="py-24 px-6 bg-white relative">
        <div class="max-w-4xl mx-auto bg-mdt-button rounded-[3rem] p-16 text-center text-white relative shadow-2xl overflow-hidden border-8 border-mdt-card/20">
            @if(isset($mdt->cta_bg) && $mdt->cta_bg)
                <div class="absolute inset-0 bg-[#2a5f4c]/90 mix-blend-multiply z-10"></div>
                <img src="{{ asset('storage/' . $mdt->cta_bg) }}" class="absolute inset-0 w-full h-full object-cover z-0">
            @else
                <div class="absolute inset-0 islamic-pattern opacity-10"></div>
            @endif
            
            <div class="relative z-20">
                <span class="text-mdt-card font-bold uppercase tracking-widest text-sm mb-4 block">Pendaftaran Santri Baru</span>
                <h2 class="text-3xl md:text-5xl font-black mb-6 tracking-tight font-serif">{{ $mdt->cta_title ?? 'Mari Makmurkan Waktu Sore Ananda' }}</h2>
                <p class="text-lg text-white/80 max-w-2xl mx-auto mb-10 leading-relaxed font-medium">{{ $mdt->cta_desc ?? 'Jangan biarkan waktu sore ananda berlalu tanpa makna. Daftarkan segera ke Madrasah Diniyah Takmiliyah Al Ittihaad untuk membekalinya dengan ilmu agama yang kokoh.' }}</p>
                <button class="bg-mdt-card text-[#2c3e38] px-10 py-4 rounded-xl font-black text-lg hover:shadow-xl hover:bg-[#c9b79c] transform hover:-translate-y-1 transition-all border-b-4 border-[#b5a388]">
                    {{ $mdt->cta_btn ?? 'Daftar Sekarang' }}
                </button>
            </div>
        </div>
    </section>
    @endif

</div>
@endsection
