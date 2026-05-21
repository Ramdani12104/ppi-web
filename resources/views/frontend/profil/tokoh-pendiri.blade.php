@extends('layouts.main')

@section('title', $pendiri->hero_title ?? 'Tokoh Pendiri - Jejak Perjuangan Sesepuh PPI 104 Al Ittihaad')

@section('content')
<style>
    :root {
        --pendiri-primary: {{ $pendiri->color_primary ?? '#fefaf4' }}; /* Cream hangat */
        --pendiri-accent: {{ $pendiri->color_accent ?? '#2a5f4c' }}; /* Hijau islami lembut */
        --pendiri-card: {{ $pendiri->color_card ?? '#d6c7b0' }}; /* Coklat kitab */
    }
    
    .bg-pendiri-primary { background-color: var(--pendiri-primary); }
    .bg-pendiri-accent { background-color: var(--pendiri-accent); }
    .bg-pendiri-card { background-color: var(--pendiri-card); }
    .text-pendiri-accent { color: var(--pendiri-accent); }
    .text-pendiri-card { color: var(--pendiri-card); }
    
    /* Islamic Geometric Pattern */
    .islamic-geo-pattern {
        background-color: var(--pendiri-primary);
        background-image: 
            radial-gradient(var(--pendiri-card) 1px, transparent 1px),
            radial-gradient(var(--pendiri-card) 1px, transparent 1px);
        background-size: 40px 40px;
        background-position: 0 0, 20px 20px;
        opacity: 0.2;
    }
</style>

<div class="font-sans text-gray-800 bg-pendiri-primary overflow-x-hidden">

    <!-- 1. HERO SECTION -->
    <section class="relative min-h-[85vh] flex items-center overflow-hidden pt-20">
        <div class="absolute inset-0 bg-pendiri-accent"></div>
        @if(isset($pendiri->hero_banner) && $pendiri->hero_banner)
            <img src="{{ asset('storage/' . $pendiri->hero_banner) }}" class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-multiply">
        @else
            <div class="absolute inset-0 bg-black/20 mix-blend-multiply"></div>
            <div class="absolute inset-0 islamic-geo-pattern opacity-10 filter invert"></div>
        @endif
        
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center py-20">
            <span class="inline-block px-4 py-1.5 bg-white/10 text-white backdrop-blur-sm rounded-full font-bold text-xs tracking-[0.3em] uppercase mb-6 border border-white/20">Sejarah & Perjuangan</span>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-[1.1] tracking-tight font-serif mb-8">
                {{ $pendiri->hero_title ?? 'Jejak Perjuangan Para Pendiri' }}
            </h1>
            <div class="w-24 h-1 bg-pendiri-card mx-auto rounded-full mb-8"></div>
            <p class="text-lg md:text-xl text-white/90 leading-relaxed font-medium">
                {{ $pendiri->hero_subtitle ?? 'Mengenang keikhlasan, pengorbanan, dan dedikasi para sesepuh serta keluarga besar dalam merintis madrasah demi tegaknya syiar Islam di Cikajang.' }}
            </p>
        </div>
        
        <!-- Curved Bottom -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-full h-[50px] md:h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,119.28,197.93,109.52Z" fill="var(--pendiri-primary)"></path>
            </svg>
        </div>
    </section>

    <!-- 2. AWAL MULA PESANTREN -->
    <section class="py-24 px-6 relative">
        <div class="absolute inset-0 islamic-geo-pattern"></div>
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center relative z-10">
            <div class="order-2 md:order-1 relative group">
                <div class="absolute inset-0 bg-pendiri-card rounded-bl-[4rem] rounded-tr-[4rem] transform -rotate-3 transition-transform group-hover:-rotate-1"></div>
                @if(isset($pendiri->history_image) && $pendiri->history_image)
                    <img src="{{ asset('storage/' . $pendiri->history_image) }}" alt="Sejarah PPI 104" class="relative rounded-bl-[4rem] rounded-tr-[4rem] shadow-xl w-full h-[500px] object-cover border-4 border-white transform transition-transform group-hover:translate-y-2">
                @else
                    <div class="relative rounded-bl-[4rem] rounded-tr-[4rem] shadow-xl w-full h-[500px] bg-[#ebe3d5] flex flex-col items-center justify-center text-center p-8 border-4 border-white transform transition-transform group-hover:translate-y-2">
                        <span class="text-7xl mb-4 opacity-50">🕌</span>
                        <span class="text-[#2c3e38] font-bold text-lg font-serif">Awal Mula Pengajian</span>
                    </div>
                @endif
            </div>
            
            <div class="order-1 md:order-2 space-y-6">
                <h2 class="text-3xl md:text-4xl font-black text-[#2c3e38] font-serif leading-tight">
                    {{ $pendiri->history_title ?? 'Dari Surau Sederhana Menuju Pusat Pendidikan' }}
                </h2>
                <div class="prose prose-lg text-[#5a6b65] text-justify leading-relaxed prose-p:mb-4">
                    @if(isset($pendiri->history_content) && $pendiri->history_content)
                        {!! $pendiri->history_content !!}
                    @else
                        <p>Pesantren Persatuan Islam 104 Al Ittihaad tidak lahir dalam semalam. Ia dirintis dari keringat, keikhlasan, dan doa malam para pendahulu kita. Bermula dari sebuah pengajian sederhana di surau kecil, beberapa orang santri yang haus akan ilmu agama berkumpul di bawah bimbingan para ajengan.</p>
                        <p>Dengan fasilitas yang sangat minim, tanpa bangku atau papan tulis yang layak, semangat belajar tak pernah padam. Dari surau tersebut, dakwah terus meluas. Masyarakat mulai menitipkan putra-putrinya. Atas kehendak Allah dan dukungan gotong royong warga, pengajian ini kemudian bertransformasi menjadi Madrasah Diniyah Takmiliyah (MDT).</p>
                        <p>Perjalanan belum berhenti. Melihat kebutuhan umat akan pendidikan formal yang berkarakter Islami, para pendiri berinisiatif membuka MTs filial yang akhirnya mandiri, dan terus berkembang hingga berdirinya jenjang KOBER, RA, SDIT, dan MA seperti yang kita lihat hari ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- 3. KELUARGA BESAR PENDIRI -->
    <section class="py-24 px-6 bg-[#f4ebd8] border-y border-[#e2d5bd]">
        <div class="max-w-7xl mx-auto text-center">
            <span class="text-pendiri-accent font-bold tracking-widest text-sm uppercase mb-2 block">Pilar-Pilar Pesantren</span>
            <h2 class="text-4xl md:text-5xl font-black text-[#2c3e38] font-serif mb-16">Keluarga Besar Pendiri</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($pendiri->families ?? [] as $family)
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-[#e2d5bd] group text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-pendiri-card/20 rounded-bl-[100px] -z-0 group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative z-10">
                        @if($family->image)
                            <img src="{{ asset('storage/' . $family->image) }}" class="w-24 h-24 mx-auto rounded-full object-cover mb-6 border-4 border-pendiri-card/30 shadow-md">
                        @else
                            <div class="w-24 h-24 mx-auto rounded-full bg-[#ebe3d5] text-pendiri-accent flex items-center justify-center text-4xl mb-6 border-4 border-pendiri-card/30 shadow-md group-hover:-translate-y-2 transition-transform">👨‍👩‍👧‍👦</div>
                        @endif
                        <h3 class="text-2xl font-bold text-[#2c3e38] font-serif mb-3">{{ $family->name }}</h3>
                        <p class="text-[#5a6b65] leading-relaxed text-sm">{{ $family->description }}</p>
                    </div>
                </div>
                @empty
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-[#e2d5bd] group text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-pendiri-card/20 rounded-bl-[100px] -z-0 group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="w-24 h-24 mx-auto rounded-full bg-[#ebe3d5] text-pendiri-accent flex items-center justify-center text-4xl mb-6 border-4 border-pendiri-card/30 shadow-md">👨‍👩‍👦</div>
                    <h3 class="text-2xl font-bold text-[#2c3e38] font-serif mb-3">Bani Mahfudz</h3>
                    <p class="text-[#5a6b65] leading-relaxed text-sm">Berperan penting dalam merintis lahan dan bangunan awal, serta menetapkan dasar-dasar pendidikan aqidah di masa perintisan pesantren.</p>
                </div>
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-[#e2d5bd] group text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-pendiri-card/20 rounded-bl-[100px] -z-0 group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="w-24 h-24 mx-auto rounded-full bg-[#ebe3d5] text-pendiri-accent flex items-center justify-center text-4xl mb-6 border-4 border-pendiri-card/30 shadow-md">👨‍👩‍👧</div>
                    <h3 class="text-2xl font-bold text-[#2c3e38] font-serif mb-3">Bani Saidi</h3>
                    <p class="text-[#5a6b65] leading-relaxed text-sm">Menyokong perjuangan melalui pemikiran pendidikan modern dan perluasan dakwah pesantren ke berbagai desa di sekitar Cikajang.</p>
                </div>
                <div class="bg-white p-10 rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-[#e2d5bd] group text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-pendiri-card/20 rounded-bl-[100px] -z-0 group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="w-24 h-24 mx-auto rounded-full bg-[#ebe3d5] text-pendiri-accent flex items-center justify-center text-4xl mb-6 border-4 border-pendiri-card/30 shadow-md">👨‍👩‍👧‍👦</div>
                    <h3 class="text-2xl font-bold text-[#2c3e38] font-serif mb-3">Bani Wirya</h3>
                    <p class="text-[#5a6b65] leading-relaxed text-sm">Aktif dalam memperkuat struktur kelembagaan, administrasi pesantren, dan mengembangkan unit-unit ekonomi mandiri.</p>
                </div>
                @endforelse
            </div>
            
            <p class="text-[#5a6b65] mt-12 max-w-3xl mx-auto italic font-medium leading-relaxed">
                "Pesantren ini bukan milik satu orang, melainkan wakaf perjuangan dari berbagai keluarga, tokoh masyarakat, dan dermawan yang bersatu hati demi tegaknya kalimat Allah."
            </p>
        </div>
    </section>

    <!-- 4. TIMELINE PERJUANGAN -->
    <section class="py-24 px-6 bg-white">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-black text-[#2c3e38] font-serif mb-16 text-center">Garis Waktu Perjuangan</h2>
            
            <div class="relative border-l-4 border-pendiri-card/50 ml-6 md:ml-12 space-y-12">
                @forelse($pendiri->timelines ?? [] as $timeline)
                <div class="relative pl-8 md:pl-12 group">
                    <div class="absolute -left-4 top-1 w-7 h-7 rounded-full bg-pendiri-accent border-4 border-white shadow-md group-hover:scale-125 transition-transform"></div>
                    <span class="text-pendiri-accent font-black text-xl tracking-widest">{{ $timeline->year }}</span>
                    <h4 class="text-2xl font-bold text-[#2c3e38] font-serif mt-1 mb-2">{{ $timeline->title }}</h4>
                    <p class="text-[#5a6b65] leading-relaxed">{{ $timeline->description }}</p>
                </div>
                @empty
                <!-- Fallback Timeline -->
                <div class="relative pl-8 md:pl-12 group">
                    <div class="absolute -left-4 top-1 w-7 h-7 rounded-full bg-pendiri-accent border-4 border-white shadow-md group-hover:scale-125 transition-transform"></div>
                    <span class="text-pendiri-accent font-black text-xl tracking-widest">1980</span>
                    <h4 class="text-2xl font-bold text-[#2c3e38] font-serif mt-1 mb-2">Awal Perintisan</h4>
                    <p class="text-[#5a6b65] leading-relaxed">Pengajian sederhana dimulai oleh para kasepuhan di sebuah tajug (surau) kecil dengan jumlah santri yang masih sangat terbatas.</p>
                </div>
                <div class="relative pl-8 md:pl-12 group">
                    <div class="absolute -left-4 top-1 w-7 h-7 rounded-full bg-pendiri-accent border-4 border-white shadow-md group-hover:scale-125 transition-transform"></div>
                    <span class="text-pendiri-accent font-black text-xl tracking-widest">1992</span>
                    <h4 class="text-2xl font-bold text-[#2c3e38] font-serif mt-1 mb-2">Berdirinya MDT</h4>
                    <p class="text-[#5a6b65] leading-relaxed">Seiring bertambahnya santri, sistem pendidikan mulai diorganisir menjadi Madrasah Diniyah Takmiliyah untuk pendidikan sore hari.</p>
                </div>
                <div class="relative pl-8 md:pl-12 group">
                    <div class="absolute -left-4 top-1 w-7 h-7 rounded-full bg-pendiri-accent border-4 border-white shadow-md group-hover:scale-125 transition-transform"></div>
                    <span class="text-pendiri-accent font-black text-xl tracking-widest">2005</span>
                    <h4 class="text-2xl font-bold text-[#2c3e38] font-serif mt-1 mb-2">Membuka MTs Filial</h4>
                    <p class="text-[#5a6b65] leading-relaxed">Keluarga besar pendiri sepakat untuk membuka jenjang menengah (MTs) agar santri bisa mendapatkan pendidikan formal berijazah negara.</p>
                </div>
                <div class="relative pl-8 md:pl-12 group">
                    <div class="absolute -left-4 top-1 w-7 h-7 rounded-full bg-pendiri-accent border-4 border-white shadow-md group-hover:scale-125 transition-transform"></div>
                    <span class="text-pendiri-accent font-black text-xl tracking-widest">Sekarang</span>
                    <h4 class="text-2xl font-bold text-[#2c3e38] font-serif mt-1 mb-2">Pusat Pendidikan Terpadu</h4>
                    <p class="text-[#5a6b65] leading-relaxed">Kini PPI 104 berkembang menjadi pesantren modern yang mengelola jenjang KOBER, RA, SDIT, MDT, MTs, dan MA dalam satu kompleks pendidikan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. KUTIPAN & NILAI WARISAN -->
    <section class="py-24 px-6 bg-pendiri-accent text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] border-[50px] border-white/5 rounded-full transform translate-x-1/2 -translate-y-1/2"></div>
        <div class="max-w-5xl mx-auto text-center relative z-10">
            <span class="text-7xl opacity-20 block mb-6 font-serif">"</span>
            <p class="text-2xl md:text-4xl font-serif leading-relaxed mb-8 italic">
                {{ $pendiri->quote_text ?? 'Didiklah anak-anakmu dengan ilmu dan adab, karena kelak merekalah yang akan mendoakanmu saat engkau telah tiada dan meneruskan perjuangan agama ini.' }}
            </p>
            <p class="text-pendiri-card font-bold uppercase tracking-widest">
                — {{ $pendiri->quote_author ?? 'Kasepuhan Pendiri PPI 104' }}
            </p>
            
            <div class="mt-20 text-left bg-white/5 backdrop-blur-md p-10 md:p-14 rounded-[3rem] border border-white/10">
                <h3 class="text-3xl font-black mb-6 font-serif">{{ $pendiri->values_title ?? 'Nilai & Warisan Perjuangan' }}</h3>
                <div class="prose prose-lg prose-invert text-white/80 leading-relaxed">
                    @if(isset($pendiri->values_content) && $pendiri->values_content)
                        {!! $pendiri->values_content !!}
                    @else
                        <p>Yang diwariskan oleh para pendiri bukanlah semata-mata bangunan fisik, melainkan <strong>nilai-nilai keikhlasan, ruhul jihad, dan kecintaan pada ilmu</strong>. Setiap batu bata yang diletakkan dalam pembangunan pesantren ini dilandasi oleh niat murni li i'lai kalimatillah.</p>
                        <p>Kini, tongkat estafet perjuangan itu berada di tangan kita. Kewajiban generasi penerus adalah menjaga api semangat tersebut tetap menyala, merawat ukhuwah antar keluarga besar, dan terus berinovasi dalam memajukan kualitas pendidikan tanpa kehilangan jati diri sebagai pesantren salaf yang berakhlak mulia.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- 6. GALERI SEJARAH -->
    @if(isset($pendiri->galleries) && $pendiri->galleries->count() > 0)
    <section class="py-24 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black text-[#2c3e38] font-serif">Rekam Jejak Kenangan</h2>
                <p class="text-[#5a6b65] mt-2">Dokumentasi momen-momen bersejarah dalam perjalanan pesantren.</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach($pendiri->galleries as $gallery)
                <div class="group relative rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all cursor-pointer">
                    <img src="{{ asset('storage/' . $gallery->image) }}" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-700">
                    @if($gallery->caption)
                    <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-6 pt-12">
                        <p class="text-white font-medium">{{ $gallery->caption }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 7. CTA PENUTUP -->
    <section class="py-24 px-6 bg-pendiri-primary border-t border-[#e2d5bd]">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-5xl font-black text-[#2c3e38] font-serif mb-6">{{ $pendiri->cta_title ?? 'Lanjutkan Perjuangan Ini Bersama Kami' }}</h2>
            <p class="text-[#5a6b65] text-lg leading-relaxed mb-10 max-w-2xl mx-auto">
                {{ $pendiri->cta_desc ?? 'Pesantren Persatuan Islam 104 Al Ittihaad membuka pintu seluas-luasnya bagi Anda yang ingin menitipkan putra-putrinya untuk dibina menjadi generasi rabbani penerus perjuangan umat.' }}
            </p>
            <a href="/" class="inline-block bg-pendiri-accent text-white px-10 py-4 rounded-xl font-black text-lg shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 hover:bg-[#204a3a]">
                Kembali ke Beranda
            </a>
        </div>
    </section>

</div>
@endsection
