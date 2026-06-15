@extends('layouts.main')

@section('title', ($mtsSettings->hero_heading ?? 'Madrasah Tsanawiyah') . ' - PPI 104 Al Ittihaad')

@section('content')
<style>
    :root {
        /* Theme overrides for header & footer layout */
        --theme-primary: {{ $mtsSettings->primary_color ?? '#D96B43' }}; /* Terracotta Khas MTs */
        --theme-primary-hover: {{ $mtsSettings->primary_color ?? '#C25630' }};
        --theme-primary-light: #FFF9F6;
        --theme-primary-light-hover: #FEECE3;
        --theme-primary-text: {{ $mtsSettings->primary_color ?? '#C25630' }};
        
        --theme-footer-bg: #22140C; /* Deep Chocolate */
        --theme-footer-border: #331E12;
        --theme-footer-text: #E5D5CD;
        --theme-footer-heading: {{ $mtsSettings->accent_color ?? '#FFE8D6' }};
    }
    
    .mts-hero-gradient {
        background: linear-gradient(135deg, #22140C 0%, #110a06 100%);
    }
    
    .mts-primary-gradient {
        background: linear-gradient(135deg, var(--theme-primary) 0%, #C25630 100%);
    }
</style>

<div class="font-sans text-slate-700 bg-[#FDFDFD] min-h-screen">

    <!-- 1. HERO SECTION -->
    @php
        $positionClass = $mtsSettings->hero_text_position ?? 'items-center text-center';
        $isLeft = str_contains($positionClass, 'text-left');
        $isRight = str_contains($positionClass, 'text-right');
        $fontSizeClass = $mtsSettings->hero_font_size ?? 'text-5xl md:text-7xl';
        
        $contentContainerClass = "max-w-7xl mx-auto px-6 py-20 relative z-10 w-full flex flex-col justify-center ";
        if ($isLeft) {
            $contentContainerClass .= "items-start text-left md:pl-16 lg:pl-28";
        } elseif ($isRight) {
            $contentContainerClass .= "items-end text-right md:pr-16 lg:pr-28";
        } else {
            $contentContainerClass .= "items-center text-center";
        }

        $slides = [];
        if ($mtsSettings) {
            if ($mtsSettings->hero_image_1) $slides[] = $mtsSettings->hero_image_1;
            if ($mtsSettings->hero_image_2) $slides[] = $mtsSettings->hero_image_2;
            if ($mtsSettings->hero_image_3) $slides[] = $mtsSettings->hero_image_3;
            
            // Fallback to old hero_banner if no slides are uploaded
            if (empty($slides) && $mtsSettings->hero_banner) {
                $slides[] = $mtsSettings->hero_banner;
            }
        }
    @endphp

    <section class="mts-hero-gradient min-h-screen flex items-center justify-center relative overflow-hidden text-white">
        <!-- Decorative elements -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-[#D96B43]/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-[#FFE8D6]/10 rounded-full blur-3xl"></div>
        
        <!-- Background Banner Slideshow -->
        <div class="absolute inset-0 overflow-hidden z-0">
            @if(empty($slides))
                <div class="absolute inset-0 bg-[#22140C] opacity-25"></div>
            @else
                @foreach($slides as $index => $slide)
                    <div class="mts-hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-index="{{ $index }}">
                        <img src="{{ asset('storage/' . $slide) }}" alt="Banner MTs {{ $index + 1 }}" class="w-full h-full object-cover">
                    </div>
                @endforeach
            @endif
            <!-- Overlay with dynamic opacity -->
            <div class="absolute inset-0 {{ $mtsSettings->hero_overlay_opacity ?? 'bg-black/60' }} transition-colors duration-500"></div>
        </div>
        
        <div class="{{ $contentContainerClass }}">
            <!-- Logo -->
            @if($mtsSettings && $mtsSettings->logo)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $mtsSettings->logo) }}" alt="Logo MTs" class="h-24 md:h-32 {{ $isLeft ? 'mr-auto' : ($isRight ? 'ml-auto' : 'mx-auto') }} drop-shadow-2xl animate-fade-in-up">
                </div>
            @endif
            
            <!-- Badge / Slogan Atas -->
            @php
                $sloganSizeClass = $mtsSettings->hero_small_font_size ?? 'text-sm';
                $sloganStyle = $mtsSettings->hero_small_text_color ? 'style="color: ' . $mtsSettings->hero_small_text_color . ';"' : '';
                $sloganColorDefaultClass = $mtsSettings->hero_small_text_color ? '' : 'text-[#FFE8D6]';
            @endphp
            <div class="inline-block mb-6">
                <span class="bg-[#D96B43]/20 px-6 py-2 rounded-full {!! $sloganSizeClass !!} font-bold uppercase tracking-widest border border-[#D96B43]/30 {{ $sloganColorDefaultClass }}" {!! $sloganStyle !!}>
                    {{ $mtsSettings->hero_small_text ?? 'Jenjang Pendidikan Menengah (MTs)' }}
                </span>
            </div>
            
            <!-- Main Title -->
            @php
                $titleStyle = $mtsSettings->hero_heading_color ? 'style="color: ' . $mtsSettings->hero_heading_color . ';"' : '';
            @endphp
            <h1 class="{{ $fontSizeClass }} font-black text-white mb-6 tracking-tight uppercase leading-tight max-w-4xl" {!! $titleStyle !!}>
                @if($mtsSettings && $mtsSettings->hero_heading)
                    {!! nl2br(e($mtsSettings->hero_heading)) !!}
                @else
                    Madrasah Tsanawiyah <span class="block text-[#D96B43]">Al-Ittihaad</span>
                @endif
            </h1>
            
            <!-- Subheading / Description -->
            @php
                $descSizeClass = $mtsSettings->hero_subheading_font_size ?? 'text-xl md:text-2xl';
                $descStyle = $mtsSettings->hero_subheading_color ? 'style="color: ' . $mtsSettings->hero_subheading_color . ';"' : '';
                $descColorDefaultClass = $mtsSettings->hero_subheading_color ? '' : 'text-slate-200';
            @endphp
            @if($mtsSettings && $mtsSettings->hero_subheading)
                <p class="{{ $descSizeClass }} {{ $descColorDefaultClass }} max-w-4xl mb-8 font-medium leading-relaxed" {!! $descStyle !!}>
                    {{ $mtsSettings->hero_subheading }}
                </p>
            @else
                <p class="{{ $descSizeClass }} {{ $descColorDefaultClass }} max-w-4xl mb-12 font-medium leading-relaxed" {!! $descStyle !!}>
                    Membentuk generasi Qur'ani yang berakhlak mulia, berprestasi, dan siap menyongsong masa depan cerah berlandaskan iman dan ilmu.
                </p>
            @endif
            
            <!-- Stats -->
            @php
                $stats = [];
                if ($mtsSettings && is_array($mtsSettings->hero_stats)) {
                    $stats = $mtsSettings->hero_stats;
                } else {
                    $stats = [
                        ['value' => '34+', 'label' => 'Tahun Pengalaman'],
                        ['value' => '1.000+', 'label' => 'Alumni MTs'],
                        ['value' => '2', 'label' => 'Program Unggulan'],
                        ['value' => 'A', 'label' => 'Akreditasi'],
                    ];
                }
                $statsNumSizeClass = $mtsSettings->hero_stats_font_size ?? 'text-4xl';
                $statsStyle = $mtsSettings->hero_stats_color ? 'style="color: ' . $mtsSettings->hero_stats_color . ';"' : '';
                $statsNumColorDefaultClass = $mtsSettings->hero_stats_color ? '' : 'text-[#D96B43]';
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl w-full {{ $isLeft ? 'mr-auto' : ($isRight ? 'ml-auto' : 'mx-auto') }} mb-12">
                @foreach($stats as $stat)
                    <div class="bg-white/5 backdrop-blur-md rounded-2xl p-6 border border-white/10">
                        <div class="{{ $statsNumSizeClass }} font-black {{ $statsNumColorDefaultClass }} mb-2" {!! $statsStyle !!}>{{ $stat['value'] }}</div>
                        <div class="text-xs text-slate-300 uppercase tracking-wider font-bold">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 w-full {{ $isLeft ? 'justify-start' : ($isRight ? 'justify-end' : 'justify-center') }}">
                <a href="{{ $mtsSettings->hero_button_link ?? ($mtsSettings->cta_link ?? '#alur-pendaftaran') }}" class="mts-primary-gradient text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-2xl transition-all hover:scale-105 active:scale-95 border-b-4 border-[#973918] text-center">
                    {{ $mtsSettings->hero_button_text ?? ($mtsSettings->cta_text ?? 'Daftar Sekarang') }}
                </a>
                <a href="#sambutan-mts" class="bg-white/10 backdrop-blur-sm text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] border-2 border-white/20 hover:bg-white/20 transition-all text-center">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce z-10">
            <svg class="w-8 h-8 text-[#D96B43]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    @if(count($slides) > 1)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slides = document.querySelectorAll('.mts-hero-slide');
                if (slides.length > 1) {
                    let currentSlide = 0;
                    setInterval(() => {
                        slides[currentSlide].classList.remove('opacity-100');
                        slides[currentSlide].classList.add('opacity-0');
                        currentSlide = (currentSlide + 1) % slides.length;
                        slides[currentSlide].classList.remove('opacity-0');
                        slides[currentSlide].classList.add('opacity-100');
                    }, 5000);
                }
            });
        </script>
    @endif

    <!-- 2. SAMBUTAN / AHLAN WA SAHLAN SECTION -->
    <section id="sambutan-mts" class="py-24 bg-white flex justify-center w-full px-6">
        <div class="max-w-7xl w-full grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Left Image/Video Box -->
            <div class="relative rounded-[2rem] overflow-hidden shadow-xl aspect-[4/3] bg-slate-50 border border-slate-150">
                @if($mtsSettings && ($mtsSettings->sambutan_media_type ?? 'image') === 'video' && $mtsSettings->sambutan_video_url)
                    @php
                        $embedUrl = \App\Helpers\MediaHelper::getAnyEmbedUrl($mtsSettings->sambutan_video_url);
                    @endphp
                    @if($embedUrl)
                        <iframe 
                            src="{{ $embedUrl }}" 
                            class="w-full h-full animate-fade-in"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    @else
                        <div class="w-full h-full bg-black flex items-center justify-center">
                            <span class="text-red-500 font-medium">Video tidak dapat dimuat</span>
                        </div>
                    @endif
                @elseif($mtsSettings && $mtsSettings->hero_banner)
                    <img src="{{ asset('storage/' . $mtsSettings->hero_banner) }}" alt="MTs Dokumentasi" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-gradient-to-tr from-slate-100 to-slate-200 flex items-center justify-center">
                        <span class="text-5xl">🏫</span>
                    </div>
                @endif
            </div>

            <!-- Right Content Box -->
            <div class="space-y-6 text-left">
                <span class="text-[#D96B43] font-bold text-xs uppercase tracking-widest">AHLAN WA SAHLAN</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-950 uppercase tracking-tight">
                    {{ ($mtsSettings && $mtsSettings->sambutan_title) ? $mtsSettings->sambutan_title : 'Madrasah Tsanawiyah Al-Ittihaad' }}
                </h2>
                <div class="w-12 h-1 bg-[#D96B43] rounded-full"></div>
                <p class="text-slate-600 leading-relaxed font-medium">
                    {{ ($mtsSettings && $mtsSettings->sambutan_desc) ? $mtsSettings->sambutan_desc : 'Selamat datang di halaman resmi Madrasah Tsanawiyah (MTs) Al-Ittihaad Cikajang. Sebagai lembaga pendidikan tingkat menengah pertama di bawah naungan pondok pesantren, kami berkomitmen menyelenggarakan pendidikan terpadu yang menyatukan kurikulum nasional Kemenag dengan nilai-nilai kepesantrenan untuk melahirkan generasi yang bertauhid lurus, berakhlak mulia, dan unggul secara akademis.' }}
                </p>
                @if($mtsSettings && $mtsSettings->sambutan_quote)
                    <blockquote class="border-l-4 border-[#D96B43] pl-4 italic text-slate-700 font-medium leading-relaxed">
                        {!! nl2br(e($mtsSettings->sambutan_quote)) !!}
                    </blockquote>
                @elseif(!$mtsSettings || !isset($mtsSettings->sambutan_quote))
                    <blockquote class="border-l-4 border-[#D96B43] pl-4 italic text-slate-700 font-medium leading-relaxed">
                        "Membimbing santri melewati masa transisi remaja dengan fondasi adab dan kepemimpinan islami."
                    </blockquote>
                @endif
            </div>
        </div>
    </section>

    <!-- 3. STATISTIK BANNER (Symmetric Stats) -->
    <section class="py-16 bg-[#22140C] text-white flex justify-center w-full px-6">
        <div class="max-w-7xl w-full grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="space-y-1">
                <div class="text-4xl md:text-5xl font-black text-[#D96B43]">28+</div>
                <div class="text-[10px] uppercase tracking-widest text-slate-300 font-bold">Tahun Pengalaman</div>
            </div>
            <div class="space-y-1">
                <div class="text-4xl md:text-5xl font-black text-[#D96B43]">450+</div>
                <div class="text-[10px] uppercase tracking-widest text-slate-300 font-bold">Alumni Sukses</div>
            </div>
            <div class="space-y-1">
                <div class="text-4xl md:text-5xl font-black text-[#D96B43]">3+</div>
                <div class="text-[10px] uppercase tracking-widest text-slate-300 font-bold">Program Unggulan</div>
            </div>
            <div class="space-y-1">
                <div class="text-4xl md:text-5xl font-black text-[#D96B43]">A</div>
                <div class="text-[10px] uppercase tracking-widest text-slate-300 font-bold">Akreditasi BAN-S/M</div>
            </div>
        </div>
    </section>

    <!-- 3.5 VIDEO PROFIL UTAMA SECTION -->
    @if($mtsSettings && $mtsSettings->youtube_link)
    <section class="py-24 bg-white flex justify-center w-full px-6 border-b border-slate-100">
        <div class="max-w-7xl w-full grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Left: Video Embed -->
            @php
                $rawUrlTop = $mtsSettings->youtube_link ?? '';
                $embedUrlTop = '';
                if ($rawUrlTop) {
                    $regExp = '/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\/shorts\/)([^#\&\?]*).*/';
                    preg_match($regExp, $rawUrlTop, $matchesTop);
                    if (isset($matchesTop[2]) && strlen($matchesTop[2]) === 11) {
                        $embedUrlTop = 'https://www.youtube.com/embed/' . $matchesTop[2];
                    } else {
                        $embedUrlTop = $rawUrlTop;
                    }
                }
            @endphp
            <div class="w-full bg-white p-3 rounded-[2rem] shadow-xl border border-slate-150">
                @if($embedUrlTop)
                    <div class="aspect-video w-full rounded-[1.75rem] overflow-hidden bg-black shadow-inner">
                        <iframe 
                            src="{{ $embedUrlTop }}" 
                            class="w-full h-full"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <div class="aspect-video w-full rounded-[1.75rem] bg-gradient-to-tr from-[#22140C] to-[#D96B43]/80 flex flex-col items-center justify-center text-white p-6 text-center">
                        <span class="text-5xl mb-4">🎥</span>
                        <h3 class="text-lg font-bold uppercase tracking-wider text-[#D96B43]">Video Profil Utama</h3>
                        <p class="text-xs text-slate-200 mt-1">Video profil sedang disiapkan.</p>
                    </div>
                @endif
            </div>

            <!-- Right: Text & Details -->
            <div class="space-y-6 text-left">
                <span class="text-[#D96B43] font-bold text-xs uppercase tracking-widest">VIDEO PROFIL</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-950 uppercase tracking-tight">Mengenal Lebih Dekat MTs Al-Ittihaad</h2>
                <div class="w-12 h-1 bg-[#D96B43] rounded-full"></div>
                <p class="text-slate-600 leading-relaxed font-medium">
                    Saksikan video profil resmi kami untuk melihat gambaran umum lingkungan madrasah, fasilitas pembelajaran, serta aktivitas santri sehari-hari dalam menuntut ilmu dan membina akhlak di Madrasah Tsanawiyah Al-Ittihaad Cikajang.
                </p>
                <div class="pt-2">
                    <a href="#alur-pendaftaran" class="inline-flex items-center gap-2 bg-[#D96B43] hover:bg-[#C25630] text-white px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest shadow-md transition-all hover:scale-105 active:scale-95 border-b-4 border-[#973918]">
                        <span>Informasi Pendaftaran</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 4. PROGRAM UNGGULAN SECTION (3 Cards Grid) -->
    <section class="py-24 bg-slate-50 flex justify-center w-full px-6">
        <div class="max-w-7xl w-full text-center">
            <div class="mb-16 space-y-4">
                <span class="text-[#D96B43] font-bold text-xs uppercase tracking-widest">PROGRAM UNGGULAN</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 uppercase tracking-tight">Program Pilihan & Unggulan</h2>
                <p class="text-slate-500 max-w-xl mx-auto text-sm leading-relaxed">
                    Fokus pembinaan terarah khusus untuk menunjang tumbuh kembang santri di tingkat menengah pertama.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if($mtsSettings && $mtsSettings->program_unggulan && count($mtsSettings->program_unggulan) > 0)
                    @foreach($mtsSettings->program_unggulan as $program)
                        <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md border border-slate-150 transition-all flex flex-col items-center text-center">
                            <div class="w-16 h-16 rounded-xl bg-[#D96B43]/10 text-[#D96B43] flex items-center justify-center mb-6 font-black text-3xl">
                                {{ $program['ikon'] ?? '📖' }}
                            </div>
                            <h3 class="text-lg font-black text-slate-950 mb-3 uppercase tracking-tight">{{ $program['nama'] }}</h3>
                            <p class="text-slate-500 text-sm leading-relaxed">{{ $program['deskripsi'] }}</p>
                        </div>
                    @endforeach
                @else
                    <!-- Fallbacks -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md border border-slate-150 transition-all flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-xl bg-[#D96B43]/10 text-[#D96B43] flex items-center justify-center mb-6 font-black text-3xl">🕌</div>
                        <h3 class="text-lg font-black text-slate-950 mb-3 uppercase tracking-tight">Karakter & Adab</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Pembiasaan ibadah wajib berjamaah dan penanaman akhlak mulia dalam pergaulan sehari-hari.</p>
                    </div>
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md border border-slate-150 transition-all flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-xl bg-[#D96B43]/10 text-[#D96B43] flex items-center justify-center mb-6 font-black text-3xl">📖</div>
                        <h3 class="text-lg font-black text-slate-950 mb-3 uppercase tracking-tight">Tahfidz Juz 30</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Target hafalan Al-Qur'an Juz 30 & 29 secara lancar (mutqin) dengan bimbingan khusus.</p>
                    </div>
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md border border-slate-150 transition-all flex flex-col items-center text-center">
                        <div class="w-16 h-16 rounded-xl bg-[#D96B43]/10 text-[#D96B43] flex items-center justify-center mb-6 font-black text-3xl">🔤</div>
                        <h3 class="text-lg font-black text-slate-950 mb-3 uppercase tracking-tight">Percakapan Bahasa</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">Pengenalan kosa kata harian Bahasa Arab dan Bahasa Inggris dasar untuk melatih keberanian berkomunikasi.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- 5. KURIKULUM & DESKRIPSI PEMBELAJARAN (Spacious text) -->
    <section class="py-24 bg-white flex justify-center w-full px-6">
        <div class="max-w-4xl w-full text-center">
            <div class="mb-16 space-y-4">
                <span class="text-[#D96B43] font-bold text-xs uppercase tracking-widest">KURIKULUM TERPADU</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-950 uppercase tracking-tight">Deskripsi & Struktur Kurikulum</h2>
                <div class="w-12 h-1 bg-[#D96B43] rounded-full mx-auto"></div>
            </div>

            <div class="prose prose-lg max-w-none text-slate-600 leading-relaxed text-left">
                @if($mtsSettings && $mtsSettings->kurikulum_detail)
                    {!! $mtsSettings->kurikulum_detail !!}
                @else
                    <p>MTs Al-Ittihaad Cikajang menggabungkan kurikulum Kementerian Agama RI (Kemenag) dan program kepesantrenan dalam satu sistem terintegrasi. Hal ini memastikan santri mendapatkan bekal ilmu umum yang memadai sekaligus pembentukan karakter akhlak yang berakar kuat pada nilai-nilai keislaman.</p>
                    <p>Program kurikulum utama mencakup pembelajaran mata pelajaran wajib nasional (Matematika, IPA, IPS, Bahasa Inggris, dll.), ditambah pendalaman materi kepesantrenan seperti:</p>
                    <ul>
                        <li>Tahfidz & Tahsin Al-Qur'an (Juz 30 & 29)</li>
                        <li>Dasar-Dasar Aqidah & Akhlak</li>
                        <li>Dasar Nahwu & Shorof (Bahasa Arab)</li>
                        <li>Kajian Fiqih Ibadah Dasar (Kitab Safinah)</li>
                    </ul>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: ASATIDZ & ASATIDZAH MTS -->
    <section class="py-24 bg-slate-50 border-t border-b border-slate-100 flex justify-center w-full px-6">
        <div class="max-w-7xl w-full">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-[#D96B43] w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 uppercase tracking-tight">Asatidz & Asatidzah MTs</h2>
                    <div class="bg-[#D96B43] w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-slate-500 font-medium max-w-2xl text-center">
                    Tenaga pendidik profesional tingkat Madrasah Tsanawiyah yang berdedikasi membimbing keilmuan dan kepribadian santri.
                </p>
            </div>

            @if($teachers->isEmpty())
                <div class="text-center py-12 bg-white rounded-3xl shadow-sm border border-slate-100 max-w-lg mx-auto">
                    <span class="text-5xl block mb-4">👥</span>
                    <h3 class="text-lg font-bold text-slate-700 mb-2">Data Belum Tersedia</h3>
                    <p class="text-slate-500 text-sm">Data tenaga pendidik tingkat MTs sedang disiapkan.</p>
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
                                    <div class="absolute inset-0 bg-gradient-to-br from-[#D96B43] to-amber-700"></div>
                                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
                                    <!-- Circular Initial Fallback in center when no photo -->
                                    <div class="relative z-10 w-20 h-20 rounded-full border-4 border-white bg-white shadow-md overflow-hidden flex items-center justify-center text-[#D96B43] font-bold text-3xl">
                                        {{ substr($teacher->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="p-6 flex-1 flex flex-col text-center">
                                <h3 class="text-xl font-bold text-slate-800 mb-1 tracking-tight">
                                    {{ $teacher->name }}
                                </h3>
                                <span class="inline-block px-3 py-1 bg-orange-50 text-[#D96B43] text-[10px] font-black uppercase tracking-wider rounded-full border border-orange-100 mb-4 mx-auto">
                                    {{ $teacher->role }}
                                </span>

                                <div class="text-left flex-1 flex flex-col">
                                    <h4 class="text-[10px] font-black uppercase tracking-wider text-amber-600 mb-1.5 border-b border-slate-50 pb-1 flex items-center gap-1">
                                        <span>📝</span> Mengajar / Tugas
                                    </h4>
                                    <p class="text-slate-600 leading-relaxed text-xs flex-1">
                                        {{ $teacher->tasks ?? 'Membimbing mata pelajaran kepesantrenan dan akademis tingkat Madrasah Tsanawiyah.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- 5.5 EKSTRAKURIKULER SECTION -->
    <section class="py-24 bg-white flex justify-center w-full px-6">
        <div class="max-w-7xl w-full text-center">
            <div class="mb-16 space-y-4">
                <span class="text-[#D96B43] font-bold text-xs uppercase tracking-widest">AKTIVITAS SANTRI</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 uppercase tracking-tight">Ekstrakurikuler MTs</h2>
                <div class="w-12 h-1 bg-[#D96B43] rounded-full mx-auto"></div>
                <p class="text-slate-500 max-w-2xl mx-auto text-sm leading-relaxed">
                    Kegiatan pengembangan minat, bakat, kepemimpinan, dan potensi diri bagi santri Madrasah Tsanawiyah Al-Ittihaad.
                </p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @php
                    $mtsEskuls = $mtsSettings->ekstrakurikuler ?? [];
                @endphp
                @forelse($mtsEskuls as $eskul)
                    @php
                        $colorClass = $eskul['color_classes'] ?? 'bg-[#22140C]';
                        $bgClass = 'bg-[#22140C]';
                        if (str_contains($colorClass, 'orange')) {
                            $bgClass = 'bg-[#D96B43]';
                        } elseif (str_contains($colorClass, 'blue')) {
                            $bgClass = 'bg-[#1D4ED8]';
                        } elseif (str_contains($colorClass, 'purple')) {
                            $bgClass = 'bg-[#6D28D9]';
                        } elseif (str_contains($colorClass, 'amber')) {
                            $bgClass = 'bg-[#D97706]';
                        } elseif (str_contains($colorClass, 'emerald')) {
                            $bgClass = 'bg-[#047857]';
                        }
                        
                        $isImage = isset($eskul['icon']) && (str_contains($eskul['icon'], '/') || str_contains($eskul['icon'], '.'));
                    @endphp
                    
                    <div class="relative overflow-hidden aspect-[4/5] rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group flex flex-col justify-end p-6 text-center cursor-pointer shadow-md border border-slate-100">
                        @if($isImage)
                            <img src="{{ asset('storage/' . $eskul['icon']) }}" alt="{{ $eskul['name'] ?? 'Eskul' }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 z-0">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/45 to-transparent z-10"></div>
                        @else
                            <div class="absolute inset-0 {{ $bgClass }} z-0 opacity-90"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                        @endif

                        <div class="relative z-20 flex flex-col items-center">
                            @if(!$isImage)
                                <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-4 border border-white/20 text-3xl group-hover:scale-110 transition-transform">
                                    {{ $eskul['icon'] ?? '🏆' }}
                                </div>
                            @endif
                            <h4 class="text-lg md:text-xl font-black uppercase tracking-tight text-white mb-1.5 leading-snug drop-shadow-md">
                                {{ $eskul['name'] ?? '' }}
                            </h4>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#FFE8D6] drop-shadow-sm opacity-90">
                                {{ $eskul['stages'] ?? 'MTs' }}
                            </p>
                        </div>
                    </div>
                @empty
                    <!-- Fallback items if none found in database -->
                    <div class="relative overflow-hidden aspect-[4/5] rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group flex flex-col justify-end p-6 text-center cursor-pointer shadow-md border border-slate-100">
                        <div class="absolute inset-0 bg-[#D96B43] z-0 opacity-90"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                        <div class="relative z-20 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-4 border border-white/20 text-3xl group-hover:scale-110 transition-transform">🏕️</div>
                            <h4 class="text-lg md:text-xl font-black uppercase tracking-tight text-white mb-1.5 leading-snug">Pramuka</h4>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#FFE8D6] opacity-90">MTS, MA</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden aspect-[4/5] rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group flex flex-col justify-end p-6 text-center cursor-pointer shadow-md border border-slate-100">
                        <div class="absolute inset-0 bg-[#1D4ED8] z-0 opacity-90"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                        <div class="relative z-20 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-4 border border-white/20 text-3xl group-hover:scale-110 transition-transform">⚽</div>
                            <h4 class="text-lg md:text-xl font-black uppercase tracking-tight text-white mb-1.5 leading-snug">Olahraga</h4>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#FFE8D6] opacity-90">Semua Jenjang</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden aspect-[4/5] rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group flex flex-col justify-end p-6 text-center cursor-pointer shadow-md border border-slate-100">
                        <div class="absolute inset-0 bg-[#6D28D9] z-0 opacity-90"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                        <div class="relative z-20 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-4 border border-white/20 text-3xl group-hover:scale-110 transition-transform">🎨</div>
                            <h4 class="text-lg md:text-xl font-black uppercase tracking-tight text-white mb-1.5 leading-snug">Seni & Kaligrafi</h4>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#FFE8D6] opacity-90">MDT, MTS, MA</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden aspect-[4/5] rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group flex flex-col justify-end p-6 text-center cursor-pointer shadow-md border border-slate-100">
                        <div class="absolute inset-0 bg-[#22140C] z-0 opacity-90"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                        <div class="relative z-20 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-4 border border-white/20 text-3xl group-hover:scale-110 transition-transform">🥁</div>
                            <h4 class="text-lg md:text-xl font-black uppercase tracking-tight text-white mb-1.5 leading-snug">Hadroh</h4>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#FFE8D6] opacity-90">MTS, MA</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 6. VALUE PROPOSITION (KENAPA HARUS KAMI?) -->
    <section class="py-24 bg-slate-50 flex justify-center w-full px-6">
        <div class="max-w-7xl w-full text-center">
            <div class="mb-16 space-y-4">
                <span class="text-[#D96B43] font-bold text-xs uppercase tracking-widest">KEUNGGULAN</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 uppercase tracking-tight">Kenapa Memilih Kami?</h2>
                <div class="w-12 h-1 bg-[#D96B43] rounded-full mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @if($mtsSettings && $mtsSettings->keunggulan && count($mtsSettings->keunggulan) > 0)
                    @foreach($mtsSettings->keunggulan as $item)
                        <div class="bg-white rounded-2xl p-8 border border-slate-150 shadow-sm transition-all hover:shadow-md">
                            <div class="w-14 h-14 rounded-full bg-[#D96B43]/10 text-[#D96B43] flex items-center justify-center mx-auto mb-6 text-2xl shadow-inner">
                                {{ $item['ikon'] ?? '⭐' }}
                            </div>
                            <h3 class="text-md font-bold text-slate-950 mb-3 uppercase tracking-tight">{{ $item['judul'] }}</h3>
                            <p class="text-slate-500 text-xs leading-relaxed">{{ $item['deskripsi'] }}</p>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback advantages -->
                    <div class="bg-white rounded-2xl p-8 border border-slate-150 shadow-sm transition-all hover:shadow-md">
                        <div class="w-14 h-14 rounded-full bg-[#D96B43]/10 text-[#D96B43] flex items-center justify-center mx-auto mb-6 text-2xl shadow-inner">🎓</div>
                        <h3 class="text-md font-bold text-slate-950 mb-3 uppercase tracking-tight">Kurikulum Terpadu</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">Penggabungan sistem pengajaran dinas Kemenag dan kurikulum kepesantrenan.</p>
                    </div>
                    <div class="bg-white rounded-2xl p-8 border border-slate-150 shadow-sm transition-all hover:shadow-md">
                        <div class="w-14 h-14 rounded-full bg-[#D96B43]/10 text-[#D96B43] flex items-center justify-center mx-auto mb-6 text-2xl shadow-inner">🌳</div>
                        <h3 class="text-md font-bold text-slate-950 mb-3 uppercase tracking-tight">Udara Sejuk</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">Kondisi geografis Cikajang yang asri dan tenang mendukung konsentrasi belajar.</p>
                    </div>
                    <div class="bg-white rounded-2xl p-8 border border-slate-150 shadow-sm transition-all hover:shadow-md">
                        <div class="w-14 h-14 rounded-full bg-[#D96B43]/10 text-[#D96B43] flex items-center justify-center mx-auto mb-6 text-2xl shadow-inner">👨‍🏫</div>
                        <h3 class="text-md font-bold text-slate-950 mb-3 uppercase tracking-tight">Guru Dedikatif</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">Asatidzah lulusan perguruan tinggi terakreditasi dan alumni pondok modern.</p>
                    </div>
                    <div class="bg-white rounded-2xl p-8 border border-slate-150 shadow-sm transition-all hover:shadow-md">
                        <div class="w-14 h-14 rounded-full bg-[#D96B43]/10 text-[#D96B43] flex items-center justify-center mx-auto mb-6 text-2xl shadow-inner">🏢</div>
                        <h3 class="text-md font-bold text-slate-950 mb-3 uppercase tracking-tight">Fasilitas Mandiri</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">Ruang kelas nyaman, laboratorium komputer terpadu, & asrama khusus.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- 7. VIDEO & DOKUMENTASI SECTION (Combined Layout) -->
    <section class="py-24 bg-white flex justify-center w-full px-6">
        <div class="max-w-7xl w-full text-center">
            <div class="mb-16 space-y-4">
                <span class="text-[#D96B43] font-bold text-xs uppercase tracking-widest">VIDEO & DOKUMENTASI</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 uppercase tracking-tight">Keseharian & Galeri Kegiatan</h2>
                <div class="w-12 h-1 bg-[#D96B43] rounded-full mx-auto"></div>
            </div>

            <!-- Two Column Layout: Left (Photos) & Right (Large Video) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch text-left">
                
                <!-- Samping Kiri: Foto Kegiatan Berjajar (col-span-5) -->
                <div class="lg:col-span-5 flex flex-col justify-between">
                    <div class="grid grid-cols-2 gap-4 h-full">
                        @php
                            $limitedPhotos = array_slice($mtsSettings->galeri ?? [], 0, 4);
                        @endphp
                        @forelse($limitedPhotos as $foto)
                            @php
                                $imagePath = is_array($foto) ? ($foto['image'] ?? '') : $foto;
                                $caption = is_array($foto) ? ($foto['caption'] ?? '') : '';
                            @endphp
                            @if($imagePath)
                                <div 
                                    onclick="openLocalLightbox('{{ asset('storage/' . $imagePath) }}', '{{ $caption ?: 'Galeri MTs' }}')"
                                    class="group relative aspect-square rounded-2xl overflow-hidden shadow-md border border-slate-100 bg-white cursor-pointer"
                                >
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $caption }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-4 text-left">
                                        <h4 class="text-white font-bold text-xs leading-snug">{{ $caption ?: 'Kegiatan MTs' }}</h4>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="bg-slate-100 rounded-2xl aspect-square flex items-center justify-center text-3xl text-slate-350 border border-slate-200">📸</div>
                            <div class="bg-slate-100 rounded-2xl aspect-square flex items-center justify-center text-3xl text-slate-350 border border-slate-200">📸</div>
                            <div class="bg-slate-100 rounded-2xl aspect-square flex items-center justify-center text-3xl text-slate-350 border border-slate-200">📸</div>
                            <div class="bg-slate-100 rounded-2xl aspect-square flex items-center justify-center text-3xl text-slate-350 border border-slate-200">📸</div>
                        @endforelse
                    </div>
                </div>

                <!-- Samping Kanan Besar: Video Profil (col-span-7) -->
                <div class="lg:col-span-7 flex">
                    <div class="w-full bg-white p-3 rounded-2xl shadow-lg border border-slate-150 flex flex-col justify-center h-full">
                        @php
                            $mediaType = $mtsSettings->kegiatan_media_type ?? 'youtube';
                            $hasVideo = false;
                            $embedUrl = '';
                            $embedCode = '';
                            $videoFile = '';
                            
                            if ($mtsSettings) {
                                if ($mediaType === 'youtube' && $mtsSettings->youtube_kegiatan_link) {
                                    $embedUrl = \App\Helpers\MediaHelper::getAnyEmbedUrl($mtsSettings->youtube_kegiatan_link);
                                    if ($embedUrl) {
                                        $hasVideo = true;
                                    }
                                } elseif ($mediaType === 'embed' && $mtsSettings->kegiatan_embed_code) {
                                    $embedCode = $mtsSettings->kegiatan_embed_code;
                                    $hasVideo = true;
                                } elseif ($mediaType === 'local' && $mtsSettings->kegiatan_video_file) {
                                    $videoFile = $mtsSettings->kegiatan_video_file;
                                    $hasVideo = true;
                                }
                            }
                            
                            // Fallback if no configuration is set yet
                            if (!$mtsSettings || (!$mtsSettings->youtube_kegiatan_link && !$mtsSettings->kegiatan_embed_code && !$mtsSettings->kegiatan_video_file)) {
                                // Default fallback YouTube video
                                $embedUrl = 'https://www.youtube.com/embed/6fRorJATZbk';
                                $hasVideo = true;
                                $mediaType = 'youtube';
                            }
                        @endphp
                        @if($hasVideo)
                            @if($mediaType === 'youtube')
                                <div class="aspect-video w-full rounded-xl overflow-hidden bg-black shadow-inner">
                                    <iframe 
                                        src="{{ $embedUrl }}" 
                                        class="w-full h-full animate-fade-in"
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            @elseif($mediaType === 'embed')
                                <div class="w-full min-h-[350px] flex items-center justify-center rounded-xl bg-slate-50 overflow-hidden shadow-inner p-2 border border-slate-100 relative">
                                    <div class="w-full flex justify-center text-center animate-fade-in">
                                        {!! $embedCode !!}
                                    </div>
                                </div>
                            @elseif($mediaType === 'local')
                                <div class="aspect-video w-full rounded-xl overflow-hidden bg-black shadow-inner">
                                    <video controls class="w-full h-full object-contain animate-fade-in">
                                        <source src="{{ asset('storage/' . $videoFile) }}" type="video/mp4">
                                        Browser Anda tidak mendukung pemutaran video.
                                    </video>
                                </div>
                            @endif
                        @else
                            <div class="aspect-video w-full rounded-xl bg-gradient-to-tr from-[#22140C] to-[#D96B43]/80 flex flex-col items-center justify-center text-white p-6 text-center animate-fade-in">
                                <span class="text-5xl mb-4">🎥</span>
                                <h3 class="text-lg font-bold uppercase tracking-wider text-[#D96B43]">Video Kegiatan</h3>
                                <p class="text-xs text-slate-200 mt-1">Video dokumentasi kegiatan sedang disiapkan.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Button Lihat Selengkapnya -->
            <div class="mt-12 flex justify-center">
                <a 
                    href="/galeri"
                    class="bg-[#D96B43] hover:bg-[#C25630] text-white px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest shadow-md transition-all hover:scale-105 active:scale-95 inline-flex items-center gap-2 border-b-4 border-[#973918]"
                >
                    <span>Lihat Selengkapnya</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- 9. ALUR PENDAFTARAN & FINAL CTA -->
    <section id="alur-pendaftaran" class="py-24 bg-white flex justify-center w-full px-6">
        <div class="max-w-7xl w-full text-center">
            <div class="mb-16 space-y-4">
                <span class="text-[#D96B43] font-bold text-xs uppercase tracking-widest">ALUR PENDAFTARAN</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 uppercase tracking-tight">Prosedur Penerimaan Santri Baru</h2>
                <div class="w-12 h-1 bg-[#D96B43] rounded-full mx-auto"></div>
            </div>

            <!-- Stepper Timeline -->
            <div class="max-w-5xl mx-auto mb-20">
                @if($mtsSettings && $mtsSettings->alur_pendaftaran && count($mtsSettings->alur_pendaftaran) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        @foreach($mtsSettings->alur_pendaftaran as $index => $langkah)
                            <div class="bg-slate-50 rounded-2xl p-6 shadow-sm border border-slate-150 relative flex flex-col items-center">
                                <div class="w-12 h-12 rounded-full bg-[#D96B43] text-white flex items-center justify-center text-lg font-black shadow-md">
                                    {{ $langkah['langkah'] ?? ($index + 1) }}
                                </div>
                                <h3 class="text-md font-bold text-slate-950 mt-4 mb-2 uppercase tracking-tight">{{ $langkah['judul'] }}</h3>
                                <p class="text-slate-500 text-xs leading-relaxed">{{ $langkah['deskripsi'] }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="bg-slate-50 rounded-2xl p-6 shadow-sm border border-slate-150 relative flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full bg-[#D96B43] text-white flex items-center justify-center text-lg font-black shadow-md">1</div>
                            <h3 class="text-md font-bold text-slate-950 mt-4 mb-2 uppercase tracking-tight">Formulir Online</h3>
                            <p class="text-slate-500 text-xs leading-relaxed">Mengisi berkas formulir online di menu pendaftaran PSB website.</p>
                        </div>
                        <div class="bg-slate-50 rounded-2xl p-6 shadow-sm border border-slate-150 relative flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full bg-[#D96B43] text-white flex items-center justify-center text-lg font-black shadow-md">2</div>
                            <h3 class="text-md font-bold text-slate-950 mt-4 mb-2 uppercase tracking-tight">Ujian Masuk</h3>
                            <p class="text-slate-500 text-xs leading-relaxed">Mengikuti tes akademik dasar, wawancara adab, & membaca Al-Qur'an.</p>
                        </div>
                        <div class="bg-slate-50 rounded-2xl p-6 shadow-sm border border-slate-150 relative flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full bg-[#D96B43] text-white flex items-center justify-center text-lg font-black shadow-md">3</div>
                            <h3 class="text-md font-bold text-slate-950 mt-4 mb-2 uppercase tracking-tight">Pengumuman</h3>
                            <p class="text-slate-500 text-xs leading-relaxed">Pengumuman kelulusan disampaikan via SMS atau WhatsApp Panitia.</p>
                        </div>
                        <div class="bg-slate-50 rounded-2xl p-6 shadow-sm border border-slate-150 relative flex flex-col items-center">
                            <div class="w-12 h-12 rounded-full bg-[#D96B43] text-white flex items-center justify-center text-lg font-black shadow-md">4</div>
                            <h3 class="text-md font-bold text-slate-950 mt-4 mb-2 uppercase tracking-tight">Daftar Ulang</h3>
                            <p class="text-slate-500 text-xs leading-relaxed">Penyelesaian administrasi keuangan dan penyerahan berkas fisik asli.</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Final CTA Card -->
            <div class="bg-slate-50 rounded-3xl p-12 shadow-md border border-slate-150 max-w-4xl mx-auto">
                <h3 class="text-2xl font-black text-slate-900 mb-4 uppercase tracking-tight">Siap Bergabung Bersama MTs Al-Ittihaad?</h3>
                <p class="text-slate-500 text-sm max-w-xl mx-auto mb-8 leading-relaxed font-medium">
                    Daftarkan putra-putri Anda sekarang untuk mendapatkan pembinaan akademis Kemenag dan bekal kepesantrenan terpadu.
                </p>
                <div class="flex justify-center gap-4 flex-wrap">
                    @if($mtsSettings && $mtsSettings->cta_link)
                        <a href="{{ $mtsSettings->cta_link }}" class="bg-[#D96B43] hover:bg-[#C25630] text-white px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest shadow-xl transition-all hover:scale-105 active:scale-95 border-b-4 border-[#973918]">
                            {{ $mtsSettings->cta_text ?? 'Daftar Sekarang' }}
                        </a>
                    @endif
                    @if($mtsSettings && $mtsSettings->whatsapp_admin)
                        <a href="https://wa.me/{{ $mtsSettings->whatsapp_admin }}" target="_blank" class="bg-emerald-600 hover:bg-emerald-500 text-white px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest shadow-xl transition-all hover:scale-105 active:scale-95 inline-flex items-center gap-2 border-b-4 border-emerald-800">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z"/>
                            </svg>
                            <span>Tanya Admin</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- 10. FAQ ACCORDION SECTION -->
    <section class="py-24 bg-slate-50 flex justify-center w-full px-6 border-t border-slate-150">
        <div class="max-w-3xl w-full text-center">
            <div class="mb-16 space-y-4">
                <span class="text-[#D96B43] font-bold text-xs uppercase tracking-widest">FAQ</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 uppercase tracking-tight">Pertanyaan Umum</h2>
                <div class="w-12 h-1 bg-[#D96B43] rounded-full mx-auto"></div>
            </div>

            @if($mtsSettings && $mtsSettings->faq && count($mtsSettings->faq) > 0)
                <div class="space-y-4 text-left">
                    @foreach($mtsSettings->faq as $index => $item)
                        <div class="bg-white rounded-xl shadow-sm border border-slate-150 overflow-hidden">
                            <button onclick="toggleMtsFaq({{ $index }})" class="w-full px-6 py-4.5 text-left flex justify-between items-center hover:bg-slate-50 transition-colors focus:outline-none">
                                <span class="font-bold text-slate-950 text-sm uppercase tracking-tight leading-snug">{{ $item['pertanyaan'] }}</span>
                                <svg id="mts-faq-icon-{{ $index }}" class="w-4 h-4 text-[#D96B43] transition-transform duration-300 shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div id="mts-faq-content-{{ $index }}" class="hidden px-6 pb-6 text-sm text-slate-500 leading-relaxed font-medium">
                                {{ $item['jawaban'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="space-y-4 text-left">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-150 overflow-hidden">
                        <button onclick="toggleMtsFaq(0)" class="w-full px-6 py-4.5 text-left flex justify-between items-center hover:bg-slate-50 transition-colors focus:outline-none">
                            <span class="font-bold text-slate-950 text-sm uppercase tracking-tight leading-snug">Apakah wajib tinggal di asrama?</span>
                            <svg id="mts-faq-icon-0" class="w-4 h-4 text-[#D96B43] transition-transform duration-300 shrink-0 ml-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="mts-faq-content-0" class="hidden px-6 pb-6 text-sm text-slate-500 leading-relaxed font-medium">
                            Asrama terpisah putra dan putri disediakan oleh pihak pesantren, namun bagi santri yang tempat tinggalnya dekat dipersilakan jika ingin pulang-pergi (non-asrama).
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- 11. BERITA TERBARU SECTION -->
    <section class="py-24 bg-white flex justify-center w-full px-6 border-t border-slate-150">
        <div class="max-w-7xl w-full text-center">
            <div class="mb-16 space-y-4">
                <span class="text-[#D96B43] font-bold text-xs uppercase tracking-widest">KABAR TERKINI</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 uppercase tracking-tight">Berita & Informasi Terbaru</h2>
                <div class="w-12 h-1 bg-[#D96B43] rounded-full mx-auto"></div>
            </div>

            @if(isset($news) && $news->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left mb-12">
                    @foreach($news as $post)
                        <article class="bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-slate-150 group flex flex-col transform hover:-translate-y-1">
                            <a href="{{ route('berita.show', $post->slug) }}" class="block relative h-52 overflow-hidden bg-slate-100">
                                @if($post->thumbnail)
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full bg-slate-200 flex items-center justify-center text-4xl text-slate-400">📰</div>
                                @endif
                                @if($post->category)
                                    <div class="absolute top-4 left-4">
                                        <span class="bg-[#D96B43] text-white px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">
                                            {{ $post->category->name }}
                                        </span>
                                    </div>
                                @endif
                            </a>
                            <div class="p-6 flex flex-col flex-1">
                                <div class="text-[11px] text-slate-400 mb-2 flex items-center gap-2 font-bold uppercase tracking-wider">
                                    <span>📅 {{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</span>
                                </div>
                                <h4 class="text-lg font-bold text-slate-900 mb-3 leading-snug group-hover:text-[#D96B43] transition-colors line-clamp-2">
                                    <a href="{{ route('berita.show', $post->slug) }}">{{ $post->title }}</a>
                                </h4>
                                <p class="text-slate-500 text-xs leading-relaxed line-clamp-3 mb-6 flex-1">
                                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}
                                </p>
                                <a href="{{ route('berita.show', $post->slug) }}" class="text-[#D96B43] font-bold text-xs uppercase tracking-wider inline-flex items-center gap-1 group-hover:gap-2 transition-all mt-auto">
                                    <span>Baca Selengkapnya</span>
                                    <span class="text-sm">→</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="flex justify-center">
                    <a href="/berita" class="bg-[#D96B43] hover:bg-[#C25630] text-white px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest shadow-md transition-all hover:scale-105 active:scale-95 inline-flex items-center gap-2 border-b-4 border-[#973918]">
                        <span>Lihat Semua Berita</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            @else
                <div class="bg-slate-50 p-12 rounded-3xl text-center border border-slate-150 max-w-xl mx-auto">
                    <span class="text-5xl mb-4 block opacity-50">📰</span>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Belum ada berita</h3>
                    <p class="text-xs text-slate-500">Silakan kembali beberapa saat lagi untuk mendapatkan berita terbaru.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- 12. SEJARAH SINGKAT SECTION -->
    <section class="py-24 bg-slate-50 flex justify-center w-full px-6 border-t border-slate-150">
        <div class="max-w-6xl w-full">
            <div class="bg-[#22140C] text-white rounded-[2rem] p-12 md:p-16 relative overflow-hidden shadow-xl">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#D96B43]/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-[#D96B43]/5 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 text-center space-y-6">
                    <div class="inline-block">
                        <span class="bg-[#D96B43]/20 text-[#FFE8D6] border border-[#D96B43]/30 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">
                            AKAR SEJARAH
                        </span>
                    </div>
                    
                    <h2 class="text-3xl md:text-4xl font-black uppercase tracking-tight leading-tight max-w-3xl mx-auto">
                        Bagian Integral Perjalanan Panjang
                        <span class="block text-[#D96B43]">Pesantren Persatuan Islam 104</span>
                    </h2>
                    
                    <div class="w-12 h-1 bg-[#D96B43] rounded-full mx-auto"></div>
                    
                    <div class="text-sm md:text-base text-slate-300 max-w-4xl mx-auto leading-relaxed font-medium">
                        @if($mtsSettings && $mtsSettings->sejarah_mts)
                            {!! $mtsSettings->sejarah_mts !!}
                        @else
                            <p class="mb-4">
                                Madrasah Tsanawiyah (MTs) Al-Ittihaad Cikajang didirikan sebagai kelanjutan dan bagian integral dari cita-cita luhur Pesantren Persatuan Islam 104 Al-Ittihaad. Sejak awal berdirinya, MTs berkomitmen menyelenggarakan jenjang pendidikan menengah pertama terpadu yang memadukan nilai-nilai kepesantrenan dengan kurikulum kementerian agama nasional.
                            </p>
                            <p>
                                Melalui perjalanan puluhan tahun, MTs Al-Ittihaad terus berupaya membimbing santri melewati masa transisi remaja dengan fondasi tauhid yang lurus, adab yang mulia, dan kemampuan akademis yang tangguh untuk bersiap melangkah ke jenjang yang lebih tinggi.
                            </p>
                        @endif
                    </div>
                    
                    <div class="pt-6">
                        <a href="/profil/sejarah" class="inline-flex items-center gap-2 bg-[#D96B43] hover:bg-[#C25630] text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-2xl transition-all hover:scale-105 active:scale-95 border-b-4 border-[#973918]">
                            <span>Pelajari Sejarah Lengkap Pesantren</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- LOCAL LIGHTBOX FOR MTS GALLERY -->
<div id="local-lightbox" class="fixed inset-0 bg-black/90 z-[9999] hidden flex flex-col items-center justify-center p-4">
    <button onclick="closeLocalLightbox()" class="absolute top-6 right-6 text-white hover:text-[#D96B43] text-4xl font-extralight focus:outline-none z-50 transition-colors">&times;</button>
    <div class="max-w-4xl w-full flex flex-col items-center">
        <div class="relative overflow-hidden rounded-2xl shadow-2xl border-4 border-white/10 bg-slate-900 max-h-[70vh] flex items-center justify-center">
            <img id="local-lightbox-img" src="" class="max-h-[70vh] max-w-full object-contain" alt="">
        </div>
        <div class="text-center mt-6 text-white max-w-2xl px-4">
            <h3 id="local-lightbox-title" class="text-lg font-black tracking-tight text-[#D96B43] uppercase"></h3>
        </div>
    </div>
</div>

<script>
    // FAQ Toggle
    function toggleMtsFaq(index) {
        const content = document.getElementById('mts-faq-content-' + index);
        const icon = document.getElementById('mts-faq-icon-' + index);
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        } else {
            content.classList.add('hidden');
            icon.style.transform = 'rotate(0deg)';
        }
    }

    // Lightbox
    function openLocalLightbox(url, title) {
        document.getElementById('local-lightbox-img').src = url;
        document.getElementById('local-lightbox-title').innerText = title;
        document.getElementById('local-lightbox').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeLocalLightbox() {
        document.getElementById('local-lightbox').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
</script>
@endsection
