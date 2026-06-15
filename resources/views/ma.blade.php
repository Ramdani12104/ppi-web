@extends('layouts.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madrasah Aliyah Al-Ittihaad Cikajang</title>
    <style>
        /* Custom colors for MA page */
        :root {
            --deep-forest-green: {{ $maSettings->primary_color ?? '#1a4d2e' }};
            --champagne-gold: {{ $maSettings->accent_color ?? '#d4af37' }};
            --muted-gold: {{ $maSettings->accent_color ?? '#c5a028' }};
            --off-white: #faf9f6;
        }
        
        .ma-hero-gradient {
            background: linear-gradient(135deg, var(--deep-forest-green) 0%, #0d2b1a 100%);
        }
        
        .ma-gold-gradient {
            background: linear-gradient(135deg, var(--champagne-gold) 0%, var(--muted-gold) 100%);
        }
        
        .ma-card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(26, 77, 46, 0.25);
        }
        
        .ma-gold-border {
            border-color: var(--champagne-gold);
        }
        
        .ma-gold-text {
            color: var(--champagne-gold);
        }
        
        .ma-forest-bg {
            background-color: var(--deep-forest-green);
        }
        
        .ma-off-white-bg {
            background-color: var(--off-white);
        }
    </style>
</head>
<body class="font-sans antialiased">

    <!-- HERO SECTION -->
    @php
        $positionClass = $maSettings->hero_text_position ?? 'items-center text-center';
        $isLeft = str_contains($positionClass, 'text-left');
        $isRight = str_contains($positionClass, 'text-right');
        $fontSizeClass = $maSettings->hero_font_size ?? 'text-5xl md:text-7xl';
        
        $contentContainerClass = "max-w-7xl mx-auto px-6 py-20 relative z-10 w-full flex flex-col justify-center ";
        if ($isLeft) {
            $contentContainerClass .= "items-start text-left md:pl-16 lg:pl-28";
        } elseif ($isRight) {
            $contentContainerClass .= "items-end text-right md:pr-16 lg:pr-28";
        } else {
            $contentContainerClass .= "items-center text-center";
        }

        $slides = [];
        if ($maSettings) {
            if ($maSettings->hero_image_1) $slides[] = $maSettings->hero_image_1;
            if ($maSettings->hero_image_2) $slides[] = $maSettings->hero_image_2;
            if ($maSettings->hero_image_3) $slides[] = $maSettings->hero_image_3;
            
            // Fallback to old hero_banner if no slides are uploaded
            if (empty($slides) && $maSettings->hero_banner) {
                $slides[] = $maSettings->hero_banner;
            }
        }
    @endphp

    <section class="ma-hero-gradient min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-champagne-gold/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl"></div>
        
        <!-- Background Banner Slideshow -->
        <div class="absolute inset-0 overflow-hidden z-0">
            @if(empty($slides))
                <div class="absolute inset-0 bg-[#0d2b1a] opacity-20"></div>
            @else
                @foreach($slides as $index => $slide)
                    <div class="ma-hero-slide absolute inset-0 transition-opacity duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-index="{{ $index }}">
                        <img src="{{ asset('storage/' . $slide) }}" alt="Banner MA {{ $index + 1 }}" class="w-full h-full object-cover">
                    </div>
                @endforeach
            @endif
            <!-- Overlay with dynamic opacity -->
            <div class="absolute inset-0 {{ $maSettings->hero_overlay_opacity ?? 'bg-black/60' }} transition-colors duration-500"></div>
        </div>
        
        <div class="{{ $contentContainerClass }}">
            <!-- Logo -->
            @if($maSettings && $maSettings->logo)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $maSettings->logo) }}" alt="Logo MA" class="h-24 md:h-32 {{ $isLeft ? 'mr-auto' : ($isRight ? 'ml-auto' : 'mx-auto') }}">
                </div>
            @endif
            
            <!-- Badge / Slogan Atas -->
            @php
                $sloganSizeClass = $maSettings->hero_small_font_size ?? 'text-sm';
                $sloganStyle = $maSettings->hero_small_text_color ? 'style="color: ' . $maSettings->hero_small_text_color . ';"' : '';
                $sloganColorDefaultClass = $maSettings->hero_small_text_color ? '' : 'text-champagne-gold';
            @endphp
            <div class="inline-block mb-6">
                <span class="bg-champagne-gold/20 px-6 py-2 rounded-full {!! $sloganSizeClass !!} font-bold uppercase tracking-widest border border-champagne-gold/30 {{ $sloganColorDefaultClass }}" {!! $sloganStyle !!}>
                    {{ $maSettings->hero_small_text ?? 'Jenjang Pendidikan Tertinggi' }}
                </span>
            </div>
            
            <!-- Main Title -->
            @php
                $titleStyle = $maSettings->hero_heading_color ? 'style="color: ' . $maSettings->hero_heading_color . ';"' : '';
            @endphp
            <h1 class="{{ $fontSizeClass }} font-black text-white mb-6 tracking-tight uppercase leading-tight max-w-4xl" {!! $titleStyle !!}>
                @if($maSettings && $maSettings->hero_heading)
                    {!! nl2br(e($maSettings->hero_heading)) !!}
                @else
                    Madrasah Aliyah <span class="block text-champagne-gold">Al-Ittihaad</span>
                @endif
            </h1>
            
            <!-- Subheading / Description -->
            @php
                $descSizeClass = $maSettings->hero_subheading_font_size ?? 'text-xl md:text-2xl';
                $descStyle = $maSettings->hero_subheading_color ? 'style="color: ' . $maSettings->hero_subheading_color . ';"' : '';
                $descColorDefaultClass = $maSettings->hero_subheading_color ? '' : 'text-emerald-100/90';
            @endphp
            @if($maSettings && $maSettings->hero_subheading)
                <p class="{{ $descSizeClass }} {{ $descColorDefaultClass }} max-w-4xl mb-8 font-medium leading-relaxed" {!! $descStyle !!}>
                    {{ $maSettings->hero_subheading }}
                </p>
            @else
                <p class="{{ $descSizeClass }} {{ $descColorDefaultClass }} max-w-4xl mb-8 font-medium leading-relaxed" {!! $descStyle !!}>
                    Membentuk generasi pemimpin umat yang berwawasan luas, berakhlak mulia, dan siap menghadapi tantangan zaman dengan landasan Al-Qur'an dan As-Sunnah.
                </p>
            @endif
            
            <!-- Stats -->
            @php
                $stats = [];
                if ($maSettings && is_array($maSettings->hero_stats)) {
                    $stats = $maSettings->hero_stats;
                } else {
                    $stats = [
                        ['value' => '32+', 'label' => 'Tahun Pengalaman'],
                        ['value' => '500+', 'label' => 'Alumni'],
                        ['value' => '3', 'label' => 'Program Peminatan'],
                        ['value' => 'A', 'label' => 'Akreditasi'],
                    ];
                }
                $statsNumSizeClass = $maSettings->hero_stats_font_size ?? 'text-4xl';
                $statsStyle = $maSettings->hero_stats_color ? 'style="color: ' . $maSettings->hero_stats_color . ';"' : '';
                $statsNumColorDefaultClass = $maSettings->hero_stats_color ? '' : 'text-champagne-gold';
            @endphp
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl w-full {{ $isLeft ? 'mr-auto' : ($isRight ? 'ml-auto' : 'mx-auto') }} mb-12">
                @foreach($stats as $stat)
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                        <div class="{{ $statsNumSizeClass }} font-black {{ $statsNumColorDefaultClass }} mb-2" {!! $statsStyle !!}>{{ $stat['value'] }}</div>
                        <div class="text-sm text-emerald-100/80 uppercase tracking-wider">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 w-full {{ $isLeft ? 'justify-start' : ($isRight ? 'justify-end' : 'justify-center') }}">
                <a href="{{ $maSettings->hero_button_link ?? '#daftar' }}" class="ma-gold-gradient text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-2xl transition-all hover:scale-105 active:scale-95 border-b-4 border-yellow-700 text-center">
                    {{ $maSettings->hero_button_text ?? 'Daftar Sekarang' }}
                </a>
                <a href="#mengenal" class="bg-white/10 backdrop-blur-sm text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] border-2 border-white/30 hover:bg-white/20 transition-all text-center">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce z-10">
            <svg class="w-8 h-8 text-champagne-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>

    @if(count($slides) > 1)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slides = document.querySelectorAll('.ma-hero-slide');
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

    <!-- SECTION: DAFTAR SEKARANG (CTA) -->
    <section id="daftar" class="ma-off-white-bg py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="ma-forest-bg rounded-3xl p-12 md:p-16 relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-champagne-gold/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-emerald-400/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 text-center">
                    <div class="inline-block mb-6">
                        <span class="bg-champagne-gold/20 text-champagne-gold px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest border border-champagne-gold/30">
                            Penerimaan Santri Baru
                        </span>
                    </div>
                    
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight uppercase">
                        Bergabunglah Bersama
                        <span class="block text-champagne-gold">Kader Ulama Masa Depan</span>
                    </h2>
                    
                    <p class="text-lg text-emerald-100/90 max-w-3xl mx-auto mb-10 leading-relaxed">
                        Pendaftaran Madrasah Aliyah Al-Ittihaad Cikajang Tahun Ajaran 2026/2027 telah dibuka. 
                        Segera daftarkan putra-putri Anda untuk menjadi bagian dari generasi yang beraqidah lurus dan berwawasan luas.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <button class="ma-gold-gradient text-white px-12 py-5 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-2xl transition-all hover:scale-105 active:scale-95 border-b-4 border-yellow-700">
                            Daftar PSB Online
                        </button>
                        <button class="bg-white/10 backdrop-blur-sm text-white px-12 py-5 rounded-2xl font-black text-sm uppercase tracking-[0.2em] border-2 border-white/30 hover:bg-white/20 transition-all">
                            Hubungi Kami
                        </button>
                    </div>
                    
                    <!-- Info Box -->
                    <div class="mt-10 bg-white/10 backdrop-blur-sm rounded-2xl p-6 max-w-2xl mx-auto border border-white/20">
                        <div class="flex items-center justify-center gap-8 text-white">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-champagne-gold">Gelombang 1</div>
                                <div class="text-sm text-emerald-100/80">Jan - Mar 2026</div>
                            </div>
                            <div class="w-px h-12 bg-white/30"></div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-champagne-gold">Gelombang 2</div>
                                <div class="text-sm text-emerald-100/80">Apr - Jun 2026</div>
                            </div>
                            <div class="w-px h-12 bg-white/30"></div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-champagne-gold">Gelombang 3</div>
                                <div class="text-sm text-emerald-100/80">Jul - Agu 2026</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: MENGENAL MA (VIDEO PROFIL) -->
    <section id="mengenal" class="py-24 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left: Video -->
                <div class="rounded-3xl overflow-hidden shadow-2xl aspect-video bg-slate-100">
                    <iframe 
                        class="w-full h-full" 
                        src="{{ \App\Helpers\MediaHelper::getAnyEmbedUrl($maSettings->youtube_link) ?? 'https://www.youtube.com/embed/6fRorJATZbk?si=s_ea4XFLs-BtbFMK' }}" 
                        title="Profil MA Al-Ittihaad" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowFullScreen
                        frameBorder="0"
                    ></iframe>
                </div>

                <!-- Right: Text -->
                <div class="flex flex-col items-start text-left space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-[#1a4d2e] w-2 h-10 rounded-full"></div>
                        <h2 class="text-3xl md:text-4xl font-black text-[#1a4d2e] uppercase tracking-tight">Mengenal MA Al-Ittihaad</h2>
                    </div>
                    
                    <p class="text-slate-600 leading-relaxed font-medium max-w-xl text-lg">
                        Madrasah Aliyah Al-Ittihaad Cikajang hadir sebagai jenjang pendidikan tingkat atas yang berkomitmen mencetak generasi yang tidak hanya unggul secara akademik, tetapi juga memiliki kedalaman ilmu agama dan akhlak mulia.
                    </p>
                    
                    <p class="text-slate-600 leading-relaxed font-medium max-w-xl">
                        Dengan kurikulum terpadu yang memadukan pendidikan nasional dan kepesantrenan, kami mempersiapkan santri untuk menjadi pemimpin masa depan yang siap menghadapi tantangan global tanpa kehilangan jati diri Islam.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-[#1a4d2e]/10 flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#1a4d2e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-[#1a4d2e]">Kurikulum Terpadu</div>
                                <div class="text-sm text-slate-500">Nasional & Pesantren</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-full bg-[#d4af37]/10 flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-[#1a4d2e]">Akreditasi A</div>
                                <div class="text-sm text-slate-500">Terakreditasi Unggul</div>
                            </div>
                        </div>
                    </div>
                    
                    <button class="mt-4 bg-[#1a4d2e] text-white px-8 py-4 rounded-xl font-bold text-sm hover:bg-[#0d2b1a] transition-all">
                        Selengkapnya Tentang Kami
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: PROGRAM PEMINATAN (JURUSAN) -->
    <section class="py-24 ma-off-white-bg">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a4d2e] uppercase tracking-tight">Program Peminatan</h2>
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-slate-600 max-w-3xl leading-relaxed font-medium text-base md:text-lg mt-4">
                    Pilih program peminatan yang sesuai dengan minat dan bakat santri untuk mengembangkan potensi secara maksimal.
                </p>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if($maSettings && $maSettings->jurusan && count($maSettings->jurusan) > 0)
                    @foreach($maSettings->jurusan as $index => $jurusan)
                        <div class="bg-white rounded-3xl overflow-hidden shadow-xl ma-card-hover transition-all duration-300 border-t-4 {{ $index === 1 ? 'border-[#d4af37]' : 'border-[#1a4d2e]' }}">
                            <div class="p-8">
                                <div class="w-20 h-20 rounded-2xl {{ $index === 1 ? 'bg-[#d4af37]/10' : 'bg-[#1a4d2e]/10' }} flex items-center justify-center mb-6">
                                    @if(isset($jurusan['icon']) && $jurusan['icon'])
                                        <img src="{{ asset('storage/' . $jurusan['icon']) }}" alt="{{ $jurusan['nama'] }}" class="w-12 h-12 object-contain">
                                    @elseif(isset($jurusan['emoji']) && $jurusan['emoji'])
                                        <span class="text-4xl">{{ $jurusan['emoji'] }}</span>
                                    @else
                                        <svg class="w-10 h-10 {{ $index === 1 ? 'text-[#d4af37]' : 'text-[#1a4d2e]' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="text-2xl font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">{{ $jurusan['nama'] }}</h3>
                                @if(isset($jurusan['subjudul']) && $jurusan['subjudul'])
                                    <p class="text-sm text-slate-500 font-bold uppercase tracking-wider mb-4">{{ $jurusan['subjudul'] }}</p>
                                @else
                                    <p class="text-sm text-slate-500 font-bold uppercase tracking-wider mb-4">Program Peminatan</p>
                                @endif
                                <p class="text-slate-600 leading-relaxed mb-6">
                                    {{ $jurusan['deskripsi'] }}
                                </p>
                                @if(isset($jurusan['tags']) && is_array($jurusan['tags']) && count($jurusan['tags']) > 0)
                                    <div class="flex flex-wrap gap-2 mb-6">
                                        @foreach($jurusan['tags'] as $tag)
                                            <span class="{{ $index === 1 ? 'bg-[#d4af37]/10 text-[#d4af37]' : 'bg-[#1a4d2e]/10 text-[#1a4d2e]' }} px-3 py-1 rounded-full text-xs font-bold uppercase">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                <button class="w-full {{ $index === 1 ? 'ma-gold-gradient border-b-4 border-yellow-700' : 'bg-[#1a4d2e] hover:bg-[#0d2b1a]' }} text-white py-3 rounded-xl font-bold text-sm uppercase tracking-wider transition-all">
                                    Pelajari Program
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Default cards if no data -->
                    <!-- IIK Card -->
                    <div class="bg-white rounded-3xl overflow-hidden shadow-xl ma-card-hover transition-all duration-300 border-t-4 border-[#1a4d2e]">
                        <div class="p-8">
                            <div class="w-20 h-20 rounded-2xl bg-[#1a4d2e]/10 flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-[#1a4d2e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">IIK</h3>
                            <p class="text-sm text-slate-500 font-bold uppercase tracking-wider mb-4">Ilmu-Ilmu Keagamaan</p>
                            <p class="text-slate-600 leading-relaxed mb-6">
                                Fokus pendalaman Kitab Kuning, Fiqih, Tafsir, Hadits, dan kaderisasi ulama untuk melanjutkan tradisi keilmuan Islam.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-[#1a4d2e]/10 text-[#1a4d2e] px-3 py-1 rounded-full text-xs font-bold uppercase">Kitab Kuning</span>
                                <span class="bg-[#1a4d2e]/10 text-[#1a4d2e] px-3 py-1 rounded-full text-xs font-bold uppercase">Bahasa Arab</span>
                                <span class="bg-[#1a4d2e]/10 text-[#1a4d2e] px-3 py-1 rounded-full text-xs font-bold uppercase">Kader Ulama</span>
                            </div>
                            <button class="w-full bg-[#1a4d2e] text-white py-3 rounded-xl font-bold text-sm uppercase tracking-wider hover:bg-[#0d2b1a] transition-all">
                                Pelajari Program
                            </button>
                        </div>
                    </div>

                    <!-- IPA Card -->
                    <div class="bg-white rounded-3xl overflow-hidden shadow-xl ma-card-hover transition-all duration-300 border-t-4 border-[#d4af37]">
                        <div class="p-8">
                            <div class="w-20 h-20 rounded-2xl bg-[#d4af37]/10 flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-[#d4af37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">IPA</h3>
                            <p class="text-sm text-slate-500 font-bold uppercase tracking-wider mb-4">Ilmu Pengetahuan Alam</p>
                            <p class="text-slate-600 leading-relaxed mb-6">
                                Fokus Sains dan Teknologi berlandaskan Islam untuk mencetak saintis Muslim yang inovatif dan berwawasan global.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-[#d4af37]/10 text-[#d4af37] px-3 py-1 rounded-full text-xs font-bold uppercase">Fisika</span>
                                <span class="bg-[#d4af37]/10 text-[#d4af37] px-3 py-1 rounded-full text-xs font-bold uppercase">Biologi</span>
                                <span class="bg-[#d4af37]/10 text-[#d4af37] px-3 py-1 rounded-full text-xs font-bold uppercase">Teknologi</span>
                            </div>
                            <button class="w-full ma-gold-gradient text-white py-3 rounded-xl font-bold text-sm uppercase tracking-wider hover:opacity-90 transition-all border-b-4 border-yellow-700">
                                Pelajari Program
                            </button>
                        </div>
                    </div>

                    <!-- IPS Card -->
                    <div class="bg-white rounded-3xl overflow-hidden shadow-xl ma-card-hover transition-all duration-300 border-t-4 border-[#1a4d2e]">
                        <div class="p-8">
                            <div class="w-20 h-20 rounded-2xl bg-[#1a4d2e]/10 flex items-center justify-center mb-6">
                                <svg class="w-10 h-10 text-[#1a4d2e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">IPS</h3>
                            <p class="text-sm text-slate-500 font-bold uppercase tracking-wider mb-4">Ilmu Pengetahuan Sosial</p>
                            <p class="text-slate-600 leading-relaxed mb-6">
                                Fokus pengembangan intelektual, studi sosial, dan sejarah Muslim untuk mencetak pemikir dan pemimpin sosial.
                            </p>
                            <div class="flex flex-wrap gap-2 mb-6">
                                <span class="bg-[#1a4d2e]/10 text-[#1a4d2e] px-3 py-1 rounded-full text-xs font-bold uppercase">Sosiologi</span>
                                <span class="bg-[#1a4d2e]/10 text-[#1a4d2e] px-3 py-1 rounded-full text-xs font-bold uppercase">Sejarah</span>
                                <span class="bg-[#1a4d2e]/10 text-[#1a4d2e] px-3 py-1 rounded-full text-xs font-bold uppercase">Ekonomi</span>
                            </div>
                            <button class="w-full bg-[#1a4d2e] text-white py-3 rounded-xl font-bold text-sm uppercase tracking-wider hover:bg-[#0d2b1a] transition-all">
                                Pelajari Program
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: KENAPA HARUS KAMI? -->
    <section class="py-24 ma-off-white-bg">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a4d2e] uppercase tracking-tight">Kenapa Harus Kami?</h2>
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-slate-600 max-w-3xl leading-relaxed font-medium mt-4">
                    Keunggulan utama yang menjadikan MA Al-Ittihaad pilihan terbaik untuk pendidikan putra-putri Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @if($maSettings && $maSettings->keunggulan && count($maSettings->keunggulan) > 0)
                    @foreach($maSettings->keunggulan as $keunggulan)
                        <div class="bg-white rounded-3xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 border-t-4 border-[#d4af37]">
                            <div class="w-20 h-20 rounded-full bg-[#d4af37]/10 flex items-center justify-center mx-auto mb-6 text-4xl">
                                {{ $keunggulan['ikon'] ?? '✨' }}
                            </div>
                            <h3 class="text-xl font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">{{ $keunggulan['judul'] }}</h3>
                            <p class="text-slate-600 leading-relaxed">{{ $keunggulan['deskripsi'] }}</p>
                        </div>
                    @endforeach
                @else
                    <!-- Default keunggulan -->
                    <div class="bg-white rounded-3xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 border-t-4 border-[#d4af37]">
                        <div class="w-20 h-20 rounded-full bg-[#d4af37]/10 flex items-center justify-center mx-auto mb-6 text-4xl">🎓</div>
                        <h3 class="text-xl font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">Kurikulum Terpadu</h3>
                        <p class="text-slate-600 leading-relaxed">Integrasi ilmu agama dan umum yang seimbang dan komprehensif</p>
                    </div>
                    <div class="bg-white rounded-3xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 border-t-4 border-[#d4af37]">
                        <div class="w-20 h-20 rounded-full bg-[#d4af37]/10 flex items-center justify-center mx-auto mb-6 text-4xl">🌳</div>
                        <h3 class="text-xl font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">Lingkungan Asri</h3>
                        <p class="text-slate-600 leading-relaxed">Suasana belajar yang tenang dan kondusif di tengah alam</p>
                    </div>
                    <div class="bg-white rounded-3xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 border-t-4 border-[#d4af37]">
                        <div class="w-20 h-20 rounded-full bg-[#d4af37]/10 flex items-center justify-center mx-auto mb-6 text-4xl">👨‍🏫</div>
                        <h3 class="text-xl font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">Tenaga Pengajar Kompeten</h3>
                        <p class="text-slate-600 leading-relaxed">Guru berpengalaman dan berdedikasi tinggi</p>
                    </div>
                    <div class="bg-white rounded-3xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 border-t-4 border-[#d4af37]">
                        <div class="w-20 h-20 rounded-full bg-[#d4af37]/10 flex items-center justify-center mx-auto mb-6 text-4xl">🏢</div>
                        <h3 class="text-xl font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">Fasilitas Lengkap</h3>
                        <p class="text-slate-600 leading-relaxed">Sarana pendidikan modern dan memadai</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: KURIKULUM & PROGRAM UNGGULAN DETAIL -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a4d2e] uppercase tracking-tight">Kurikulum & Program Unggulan</h2>
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto">
                @if($maSettings && $maSettings->kurikulum_detail)
                    <div class="prose prose-lg max-w-none text-slate-600 leading-relaxed">
                        {!! $maSettings->kurikulum_detail !!}
                    </div>
                @else
                    <div class="prose prose-lg max-w-none text-slate-600 leading-relaxed">
                        <p>MA Al-Ittihaad menerapkan kurikulum terpadu yang menggabungkan kurikulum nasional dengan kurikulum kepesantrenan. Program unggulan kami meliputi:</p>
                        <ul>
                            <li><strong>KTI (Kajian Kitab Informatika)</strong> - Pendalaman kitab kuning dengan metode modern</li>
                            <li><strong>P2M (Pengembangan Potensi Minat)</strong> - Program untuk mengembangkan bakat santri</li>
                            <li><strong>Bahasa Arab Intensif</strong> - Pembelajaran bahasa Arab untuk pemahaman kitab</li>
                            <li><strong>Tahfidz Al-Qur'an</strong> - Program menghafal Al-Qur'an dengan target tertentu</li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: ASATIDZ & ASATIDZAH MA -->
    <section class="py-24 bg-slate-50 border-t border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a4d2e] uppercase tracking-tight">Asatidz & Asatidzah</h2>
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-slate-500 font-medium max-w-2xl">
                    Tenaga pendidik profesional tingkat Madrasah Aliyah yang berdedikasi membimbing keilmuan dan kepribadian santri.
                </p>
            </div>

            @if($teachers->isEmpty())
                <div class="text-center py-12 bg-white rounded-3xl shadow-sm border border-slate-100 max-w-lg mx-auto">
                    <span class="text-5xl block mb-4">👥</span>
                    <h3 class="text-lg font-bold text-slate-700 mb-2">Data Belum Tersedia</h3>
                    <p class="text-slate-500 text-sm">Data tenaga pendidik tingkat MA sedang disiapkan.</p>
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
                                    <div class="absolute inset-0 bg-gradient-to-br from-[#1a4d2e] to-emerald-800"></div>
                                    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
                                    <!-- Circular Initial Fallback in center when no photo -->
                                    <div class="relative z-10 w-20 h-20 rounded-full border-4 border-white bg-white shadow-md overflow-hidden flex items-center justify-center text-[#1a4d2e] font-bold text-3xl">
                                        {{ substr($teacher->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="p-6 flex-1 flex flex-col text-center">
                                <h3 class="text-xl font-bold text-slate-800 mb-1 tracking-tight">
                                    {{ $teacher->name }}
                                </h3>
                                <span class="inline-block px-3 py-1 bg-emerald-50 text-[#1a4d2e] text-[10px] font-black uppercase tracking-wider rounded-full border border-emerald-100 mb-4 mx-auto">
                                    {{ $teacher->role }}
                                </span>

                                <div class="text-left flex-1 flex flex-col">
                                    <h4 class="text-[10px] font-black uppercase tracking-wider text-amber-600 mb-1.5 border-b border-slate-50 pb-1 flex items-center gap-1">
                                        <span>📝</span> Mengajar / Tugas
                                    </h4>
                                    <p class="text-slate-650 leading-relaxed text-xs flex-1">
                                        {{ $teacher->tasks ?? 'Membimbing mata pelajaran kepesantrenan dan akademis tingkat Madrasah Aliyah.' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- SECTION: GALERI KEGIATAN -->
    <section class="py-24 ma-off-white-bg">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a4d2e] uppercase tracking-tight">Galeri Kegiatan</h2>
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-slate-600 max-w-3xl leading-relaxed font-medium mt-4">
                    Dokumentasi aktivitas santri MA dalam belajar, beribadah, dan berkegiatan.
                </p>
            </div>

            @if($maSettings && $maSettings->galeri && count($maSettings->galeri) > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($maSettings->galeri as $foto)
                        @php
                            $imagePath = is_array($foto) ? ($foto['image'] ?? '') : $foto;
                            $caption = is_array($foto) ? ($foto['caption'] ?? '') : '';
                        @endphp
                        @if($imagePath)
                        <div class="relative group overflow-hidden rounded-2xl shadow-lg cursor-pointer" onclick="openLightbox('{{ asset('storage/' . $imagePath) }}')">
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="{{ $caption ?: 'Galeri Kegiatan' }}" class="w-full h-48 md:h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center p-4 text-center">
                                <svg class="w-12 h-12 text-white mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                                @if($caption)
                                    <span class="text-white text-xs font-semibold leading-tight line-clamp-2">{{ $caption }}</span>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="bg-[#1a4d2e]/10 rounded-2xl h-48 md:h-64 flex items-center justify-center">
                        <span class="text-4xl">📸</span>
                    </div>
                    <div class="bg-[#1a4d2e]/10 rounded-2xl h-48 md:h-64 flex items-center justify-center">
                        <span class="text-4xl">📸</span>
                    </div>
                    <div class="bg-[#1a4d2e]/10 rounded-2xl h-48 md:h-64 flex items-center justify-center">
                        <span class="text-4xl">📸</span>
                    </div>
                    <div class="bg-[#1a4d2e]/10 rounded-2xl h-48 md:h-64 flex items-center justify-center">
                        <span class="text-4xl">📸</span>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- SECTION: ALUR PENDAFTARAN -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a4d2e] uppercase tracking-tight">Alur Pendaftaran</h2>
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-slate-600 max-w-3xl leading-relaxed font-medium mt-4">
                    Langkah mudah mendaftar santri baru MA Al-Ittihaad.
                </p>
            </div>

            <div class="max-w-5xl mx-auto">
                @if($maSettings && $maSettings->alur_pendaftaran && count($maSettings->alur_pendaftaran) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($maSettings->alur_pendaftaran as $index => $langkah)
                            <div class="relative">
                                <div class="bg-white rounded-3xl p-8 shadow-lg border-t-4 border-[#d4af37] text-center relative z-10">
                                    <div class="w-16 h-16 rounded-full bg-[#d4af37] text-white flex items-center justify-center mx-auto mb-6 text-2xl font-black">
                                        {{ $langkah['langkah'] ?? ($index + 1) }}
                                    </div>
                                    <h3 class="text-lg font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">{{ $langkah['judul'] }}</h3>
                                    <p class="text-slate-600 leading-relaxed text-sm">{{ $langkah['deskripsi'] }}</p>
                                </div>
                                @if($index < count($maSettings->alur_pendaftaran) - 1)
                                    <div class="hidden lg:block absolute top-1/2 -right-3 w-6 h-0.5 bg-[#d4af37]"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="relative">
                            <div class="bg-white rounded-3xl p-8 shadow-lg border-t-4 border-[#d4af37] text-center relative z-10">
                                <div class="w-16 h-16 rounded-full bg-[#d4af37] text-white flex items-center justify-center mx-auto mb-6 text-2xl font-black">1</div>
                                <h3 class="text-lg font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">Daftar Online</h3>
                                <p class="text-slate-600 leading-relaxed text-sm">Isi formulir pendaftaran melalui website</p>
                            </div>
                            <div class="hidden lg:block absolute top-1/2 -right-3 w-6 h-0.5 bg-[#d4af37]"></div>
                        </div>
                        <div class="relative">
                            <div class="bg-white rounded-3xl p-8 shadow-lg border-t-4 border-[#d4af37] text-center relative z-10">
                                <div class="w-16 h-16 rounded-full bg-[#d4af37] text-white flex items-center justify-center mx-auto mb-6 text-2xl font-black">2</div>
                                <h3 class="text-lg font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">Tes Seleksi</h3>
                                <p class="text-slate-600 leading-relaxed text-sm">Ikuti tes akademik dan wawancara</p>
                            </div>
                            <div class="hidden lg:block absolute top-1/2 -right-3 w-6 h-0.5 bg-[#d4af37]"></div>
                        </div>
                        <div class="relative">
                            <div class="bg-white rounded-3xl p-8 shadow-lg border-t-4 border-[#d4af37] text-center relative z-10">
                                <div class="w-16 h-16 rounded-full bg-[#d4af37] text-white flex items-center justify-center mx-auto mb-6 text-2xl font-black">3</div>
                                <h3 class="text-lg font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">Pengumuman</h3>
                                <p class="text-slate-600 leading-relaxed text-sm">Tunggu hasil seleksi via email/SMS</p>
                            </div>
                            <div class="hidden lg:block absolute top-1/2 -right-3 w-6 h-0.5 bg-[#d4af37]"></div>
                        </div>
                        <div class="relative">
                            <div class="bg-white rounded-3xl p-8 shadow-lg border-t-4 border-[#d4af37] text-center relative z-10">
                                <div class="w-16 h-16 rounded-full bg-[#d4af37] text-white flex items-center justify-center mx-auto mb-6 text-2xl font-black">4</div>
                                <h3 class="text-lg font-black text-[#1a4d2e] mb-4 uppercase tracking-tight">Daftar Ulang</h3>
                                <p class="text-slate-600 leading-relaxed text-sm">Lengkapi administrasi dan pembayaran</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: FAQ -->
    <section class="py-24 ma-off-white-bg">
        <div class="max-w-4xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a4d2e] uppercase tracking-tight">FAQ</h2>
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-slate-600 max-w-3xl leading-relaxed font-medium mt-4">
                    Pertanyaan yang sering ditanyakan tentang MA Al-Ittihaad.
                </p>
            </div>

            @if($maSettings && $maSettings->faq && count($maSettings->faq) > 0)
                <div class="space-y-4">
                    @foreach($maSettings->faq as $index => $item)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                            <button onclick="toggleFaq({{ $index }})" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-[#faf9f6] transition-colors">
                                <span class="font-bold text-[#1a4d2e]">{{ $item['pertanyaan'] }}</span>
                                <svg id="faq-icon-{{ $index }}" class="w-5 h-5 text-[#1a4d2e] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            <div id="faq-content-{{ $index }}" class="hidden px-6 pb-4 text-slate-600 leading-relaxed">
                                {{ $item['jawaban'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="space-y-4">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <button onclick="toggleFaq(0)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-[#faf9f6] transition-colors">
                            <span class="font-bold text-[#1a4d2e]">Berapa biaya masuk MA Al-Ittihaad?</span>
                            <svg id="faq-icon-0" class="w-5 h-5 text-[#1a4d2e] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="faq-content-0" class="hidden px-6 pb-4 text-slate-600 leading-relaxed">
                            Biaya pendaftaran dapat ditanyakan langsung ke admin kami melalui WhatsApp.
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <button onclick="toggleFaq(1)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-[#faf9f6] transition-colors">
                            <span class="font-bold text-[#1a4d2e]">Apa saja syarat pendaftaran?</span>
                            <svg id="faq-icon-1" class="w-5 h-5 text-[#1a4d2e] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="faq-content-1" class="hidden px-6 pb-4 text-slate-600 leading-relaxed">
                            Syarat pendaftaran meliputi: ijazah SMP/MTs, kartu keluarga, akta kelahiran, dan pas foto.
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <button onclick="toggleFaq(2)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-[#faf9f6] transition-colors">
                            <span class="font-bold text-[#1a4d2e]">Apakah wajib asrama?</span>
                            <svg id="faq-icon-2" class="w-5 h-5 text-[#1a4d2e] transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="faq-content-2" class="hidden px-6 pb-4 text-slate-600 leading-relaxed">
                            Asrama tersedia namun tidak wajib. Santri dapat memilih untuk tinggal di asrama atau pulang pergi.
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- SECTION: EKSTRAKURIKULER -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a4d2e] uppercase tracking-tight">Ekstrakurikuler MA</h2>
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-slate-600 max-w-3xl leading-relaxed font-medium mt-4">
                    Kegiatan ekstrakurikuler untuk mengembangkan bakat dan minat santri MA secara optimal.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @if($maSettings && $maSettings->eskul && is_array($maSettings->eskul) && count($maSettings->eskul) > 0)
                    @foreach($maSettings->eskul as $eskul)
                        @php
                            $colorClass = $eskul['color_classes'] ?? 'bg-[#1a4d2e] text-emerald-100 border-[#1a4d2e]/20';
                            $bgClass = 'bg-[#1a4d2e]';
                            if (str_contains($colorClass, 'orange')) {
                                $bgClass = 'bg-[#ea580c]';
                            } elseif (str_contains($colorClass, 'blue')) {
                                $bgClass = 'bg-[#1d4ed8]';
                            } elseif (str_contains($colorClass, 'purple')) {
                                $bgClass = 'bg-[#6d28d9]';
                            } elseif (str_contains($colorClass, 'amber')) {
                                $bgClass = 'bg-[#d97706]';
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
                                <div class="absolute inset-0 {{ $bgClass }} z-0 opacity-95"></div>
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
                                    {{ $eskul['stages'] ?? 'MA' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback items if none configured -->
                    <div class="relative overflow-hidden aspect-[4/5] rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group flex flex-col justify-end p-6 text-center cursor-pointer shadow-md border border-slate-100">
                        <div class="absolute inset-0 bg-[#1a4d2e] z-0 opacity-95"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                        <div class="relative z-20 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-4 border border-white/20 text-3xl group-hover:scale-110 transition-transform">⚽</div>
                            <h4 class="text-lg md:text-xl font-black uppercase tracking-tight text-white mb-1.5 leading-snug">Sepak Bola</h4>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#FFE8D6] opacity-90">MA</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden aspect-[4/5] rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group flex flex-col justify-end p-6 text-center cursor-pointer shadow-md border border-slate-100">
                        <div class="absolute inset-0 bg-[#d97706] z-0 opacity-95"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                        <div class="relative z-20 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-4 border border-white/20 text-3xl group-hover:scale-110 transition-transform">🎤</div>
                            <h4 class="text-lg md:text-xl font-black uppercase tracking-tight text-white mb-1.5 leading-snug">Hadroh</h4>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#FFE8D6] opacity-90">MTS, MA</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden aspect-[4/5] rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group flex flex-col justify-end p-6 text-center cursor-pointer shadow-md border border-slate-100">
                        <div class="absolute inset-0 bg-[#1d4ed8] z-0 opacity-95"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                        <div class="relative z-20 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-4 border border-white/20 text-3xl group-hover:scale-110 transition-transform">🖥️</div>
                            <h4 class="text-lg md:text-xl font-black uppercase tracking-tight text-white mb-1.5 leading-snug">Komputer</h4>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#FFE8D6] opacity-90">MA</p>
                        </div>
                    </div>
                    <div class="relative overflow-hidden aspect-[4/5] rounded-[2rem] transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 group flex flex-col justify-end p-6 text-center cursor-pointer shadow-md border border-slate-100">
                        <div class="absolute inset-0 bg-[#6d28d9] z-0 opacity-95"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent z-10"></div>
                        <div class="relative z-20 flex flex-col items-center">
                            <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center mb-4 border border-white/20 text-3xl group-hover:scale-110 transition-transform">📚</div>
                            <h4 class="text-lg md:text-xl font-black uppercase tracking-tight text-white mb-1.5 leading-snug">Jurnalistik</h4>
                            <p class="text-[10px] font-black uppercase tracking-widest text-[#FFE8D6] opacity-90">MA</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: FASILITAS -->
    <section class="py-24 ma-off-white-bg">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a4d2e] uppercase tracking-tight">Fasilitas MA</h2>
                    <div class="bg-[#1a4d2e] w-12 h-1.5 rounded-full"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @if($maSettings && $maSettings->fasilitas && is_array($maSettings->fasilitas) && count($maSettings->fasilitas) > 0)
                    @foreach($maSettings->fasilitas as $fasilitas)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                            @if(isset($fasilitas['foto']) && $fasilitas['foto'])
                                <div class="h-48">
                                    <img src="{{ asset('storage/' . $fasilitas['foto']) }}" alt="{{ $fasilitas['nama'] }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-[#1a4d2e] to-[#0d2b1a]"></div>
                            @endif
                            <div class="p-6">
                                <h3 class="font-bold text-[#1a4d2e] mb-2">{{ $fasilitas['nama'] }}</h3>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                        <div class="h-48 bg-gradient-to-br from-[#1a4d2e] to-[#0d2b1a]"></div>
                        <div class="p-6">
                            <h3 class="font-bold text-[#1a4d2e] mb-2">Asrama Santri</h3>
                            <p class="text-sm text-slate-600">Asrama nyaman dengan fasilitas lengkap untuk santri MA</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                        <div class="h-48 bg-gradient-to-br from-[#d4af37] to-[#c5a028]"></div>
                        <div class="p-6">
                            <h3 class="font-bold text-[#1a4d2e] mb-2">Laboratorium</h3>
                            <p class="text-sm text-slate-600">Lab IPA, Lab Komputer, dan Lab Bahasa modern</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg">
                        <div class="h-48 bg-gradient-to-br from-[#1a4d2e] to-[#0d2b1a]"></div>
                        <div class="p-6">
                            <h3 class="font-bold text-[#1a4d2e] mb-2">Perpustakaan</h3>
                            <p class="text-sm text-slate-600">Perpustakaan lengkap dengan ribuan koleksi buku</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: TESTIMONI -->
    <section class="py-24 bg-slate-50 relative overflow-hidden border-t border-slate-100">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#1a4d2e]/5 blur-[100px] rounded-full -mr-64 -mt-64"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-[#1a4d2e]/5 blur-[100px] rounded-full -ml-64 -mb-64"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col items-center text-center mb-16">
                <span class="text-[#1a4d2e] font-black tracking-[0.3em] uppercase text-[10px] mb-4">Bukti Nyata</span>
                <h2 class="text-3xl md:text-5xl font-black text-slate-800 uppercase tracking-tight">Apa Kata Mereka?</h2>
                <div class="w-20 h-1.5 bg-[#d4af37] mt-6 rounded-full"></div>
                <p class="text-slate-600 mt-6 max-w-2xl mx-auto font-medium leading-relaxed text-sm md:text-base">
                    Dari orang tua yang mempercayakan amanahnya, hingga alumni yang kini berkiprah di tengah umat.
                </p>
            </div>

            @if(isset($testimonials) && $testimonials->count() > 0)
                @php
                    $firstTestimonial = $testimonials->first();
                    $firstAvatar = $firstTestimonial->avatar 
                        ? asset('storage/' . $firstTestimonial->avatar) 
                        : 'https://ui-avatars.com/api/?name=' . urlencode($firstTestimonial->name) . '&background=1a4d2e&color=fff&size=150&bold=true';
                    $firstType = $firstTestimonial->type === 'Orang Tua' ? 'WALI SANTRI' : 'ALUMNI';
                @endphp

                <!-- ACTIVE TESTIMONIAL DISPLAY (2-PANEL GRID) -->
                <div class="grid lg:grid-cols-12 gap-8 items-stretch mb-20">
                    <!-- Left Column: Graphic Card (4 cols) -->
                    <div class="lg:col-span-4 flex justify-center items-center">
                        <div id="active-testimonial-card" class="w-full max-w-[320px] min-h-[420px] bg-gradient-to-br from-[#1a4d2e] to-[#0d2b1a] text-white rounded-3xl p-8 shadow-2xl relative overflow-hidden flex flex-col items-center justify-between text-center border-4 border-white transition-all duration-300">
                            <!-- Badge -->
                            <div id="active-badge" class="bg-white text-[#1a4d2e] px-4.5 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest shadow-md">
                                TESTIMONI {{ $firstType }}
                            </div>
                            <span class="text-[10px] text-emerald-300 font-bold tracking-[0.2em] uppercase mt-2">MA AL-ITTIHAAD</span>

                            <!-- Profile Image Frame -->
                            <div class="w-32 h-32 rounded-full border-4 border-white overflow-hidden shadow-2xl my-6 bg-white shrink-0">
                                <img id="active-img" src="{{ $firstAvatar }}" alt="{{ $firstTestimonial->name }}" class="w-full h-full object-cover">
                            </div>

                            <!-- Info -->
                            <div class="mt-2 w-full">
                                <h3 id="active-name" class="text-white font-black text-base leading-tight uppercase tracking-tight truncate">{{ $firstTestimonial->name }}</h3>
                                <div class="w-8 h-1 bg-[#d4af37] mx-auto my-3 rounded-full"></div>
                                <p id="active-status" class="text-emerald-200 text-[10px] font-bold uppercase tracking-wider leading-relaxed truncate">{{ $firstTestimonial->status }}</p>
                            </div>
                            
                            <div class="mt-4 bg-white/10 w-8 h-8 rounded-full flex items-center justify-center text-xs">
                                ✨
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Quote Text (8 cols) -->
                    <div class="lg:col-span-8 flex">
                        <div class="w-full bg-white p-8 md:p-12 rounded-3xl shadow-xl border border-slate-100 relative flex flex-col justify-center min-h-[300px] md:min-h-full">
                            <div class="absolute top-6 left-6 text-[#1a4d2e]/10 text-9xl font-serif select-none pointer-events-none">“</div>
                            
                            <p id="active-quote" class="text-slate-700 text-lg md:text-xl font-medium italic leading-relaxed relative z-10 pl-6 border-l-4 border-[#1a4d2e]">
                                "{{ $firstTestimonial->quote }}"
                            </p>
                            
                            <div class="mt-8 border-t border-slate-100 pt-6 flex items-center gap-4 relative z-10">
                                <div class="w-12 h-12 rounded-full border-2 border-[#1a4d2e] overflow-hidden bg-white shrink-0">
                                    <img id="active-avatar-small" src="{{ $firstAvatar }}" alt="{{ $firstTestimonial->name }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 id="active-name-small" class="text-slate-900 font-bold text-base leading-snug">{{ $firstTestimonial->name }}</h4>
                                    <p id="active-status-small" class="text-[#1a4d2e] text-[10px] font-black uppercase tracking-wider mt-0.5">{{ $firstTestimonial->status }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SLIDER/CAROUSEL HEADER & NAVIGATION -->
                <div class="flex justify-between items-center mb-8 border-b border-slate-200 pb-4">
                    <h3 class="text-xs md:text-sm font-black text-slate-800 uppercase tracking-wider">
                        Jejak Perjalanan Alumni & Wali Santri
                    </h3>
                    <div class="flex gap-2">
                        <button 
                            onclick="scrollTestimonials(-300)"
                            class="bg-white hover:bg-emerald-50 text-slate-700 hover:text-[#1a4d2e] p-2.5 rounded-full border border-slate-200 hover:border-emerald-300 transition-all shadow-md focus:outline-none cursor-pointer"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button 
                            onclick="scrollTestimonials(300)"
                            class="bg-white hover:bg-emerald-50 text-slate-700 hover:text-[#1a4d2e] p-2.5 rounded-full border border-slate-200 hover:border-emerald-300 transition-all shadow-md focus:outline-none cursor-pointer"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- SLIDER CARDS CONTAINER -->
                <div 
                    id="testimonials-slider"
                    class="flex gap-6 overflow-x-auto pb-8 snap-x snap-mandatory scrollbar-none"
                    style="scrollbar-width: none; -ms-overflow-style: none;"
                >
                    @foreach($testimonials as $idx => $t)
                        @php
                            $tAvatar = $t->avatar 
                                ? asset('storage/' . $t->avatar) 
                                : 'https://ui-avatars.com/api/?name=' . urlencode($t->name) . '&background=1a4d2e&color=fff&size=100&bold=true';
                            $tType = $t->type === 'Orang Tua' ? 'WALI SANTRI' : 'ALUMNI';
                            $isActive = $idx === 0;
                        @endphp
                        <div 
                            onclick="selectTestimonial({{ $t->id }})"
                            data-id="{{ $t->id }}"
                            class="testimonial-card w-72 shrink-0 snap-center rounded-3xl p-6 bg-gradient-to-br from-[#1a4d2e] to-[#0d2b1a] text-white shadow-lg border-2 transition-all duration-300 cursor-pointer flex flex-col justify-between items-center text-center relative overflow-hidden {{ $isActive ? 'scale-105 border-white ring-4 ring-[#d4af37]/45' : 'border-white/10 opacity-70 hover:opacity-100 hover:scale-[1.02]' }}"
                        >
                            <div class="bg-white text-[#1a4d2e] px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-wider mb-2">
                                {{ $tType }}
                            </div>
                            
                            <!-- Photo inside circle -->
                            <div class="w-20 h-20 rounded-full border-2 border-white overflow-hidden my-4 bg-white shadow-md shrink-0">
                                <img src="{{ $tAvatar }}" alt="{{ $t->name }}" class="w-full h-full object-cover">
                            </div>
                            
                            <div>
                                <h4 class="font-bold text-sm text-white truncate w-56">{{ $t->name }}</h4>
                                <p class="text-emerald-300 text-[9px] uppercase tracking-wider truncate w-56 mt-1">{{ $t->status }}</p>
                            </div>

                            <!-- Checkmark indicator on active -->
                            <div class="active-check absolute bottom-2 right-2 bg-white/20 w-6 h-6 rounded-full flex items-center justify-center text-[10px] {{ $isActive ? '' : 'hidden' }}">
                                ✓
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Button Lihat Alumni -->
                <div class="mt-12 flex justify-center">
                    <a 
                        href="/program/alumni"
                        class="bg-[#1a4d2e] hover:bg-[#0d2b1a] text-white px-8 py-3.5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl transition-all hover:scale-105 active:scale-95 inline-flex items-center gap-2 border-b-4 border-[#0d2b1a]"
                    >
                        <span>Lihat Alumni Selengkapnya</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>

                <script>
                    // Store testimonials data
                    const testimonialsData = @json($testimonials);
                    
                    function selectTestimonial(id) {
                        // Find testimonial in data
                        const testimonial = testimonialsData.find(t => t.id == id);
                        if (!testimonial) return;
                        
                        // Construct avatar url
                        const avatarUrl = testimonial.avatar 
                            ? `/storage/${testimonial.avatar}` 
                            : `https://ui-avatars.com/api/?name=${encodeURIComponent(testimonial.name)}&background=1a4d2e&color=fff&size=150&bold=true`;
                        
                        const typeText = testimonial.type === 'Orang Tua' ? 'WALI SANTRI' : 'ALUMNI';
                        
                        // Update active display elements
                        document.getElementById('active-badge').innerText = `TESTIMONI ${typeText}`;
                        document.getElementById('active-img').src = avatarUrl;
                        document.getElementById('active-img').alt = testimonial.name;
                        document.getElementById('active-name').innerText = testimonial.name;
                        document.getElementById('active-status').innerText = testimonial.status;
                        document.getElementById('active-quote').innerText = `"${testimonial.quote}"`;
                        document.getElementById('active-avatar-small').src = avatarUrl;
                        document.getElementById('active-avatar-small').alt = testimonial.name;
                        document.getElementById('active-name-small').innerText = testimonial.name;
                        document.getElementById('active-status-small').innerText = testimonial.status;
                        
                        // Update active state class on slider cards
                        document.querySelectorAll('.testimonial-card').forEach(card => {
                            const cardId = card.getAttribute('data-id');
                            const checkmark = card.querySelector('.active-check');
                            if (cardId == id) {
                                card.classList.remove('border-white/10', 'opacity-70');
                                card.classList.add('scale-105', 'border-white', 'ring-4', 'ring-[#d4af37]/45');
                                if (checkmark) checkmark.classList.remove('hidden');
                            } else {
                                card.classList.add('border-white/10', 'opacity-70');
                                card.classList.remove('scale-105', 'border-white', 'ring-4', 'ring-[#d4af37]/45');
                                if (checkmark) checkmark.classList.add('hidden');
                            }
                        });
                    }
                    
                    function scrollTestimonials(offset) {
                        const slider = document.getElementById('testimonials-slider');
                        if (slider) {
                            slider.scrollBy({ left: offset, behavior: 'smooth' });
                        }
                    }
                </script>
            @else
                <div class="bg-white p-12 rounded-3xl text-center border border-slate-150 max-w-xl mx-auto">
                    <span class="text-5xl mb-4 block opacity-50">👥</span>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Belum ada testimoni</h3>
                    <p class="text-xs text-slate-500">Silakan kembali beberapa saat lagi untuk melihat testimoni terbaru.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- SECTION: BERITA MA -->
    <section class="py-24 bg-white flex justify-center w-full px-6 border-t border-slate-150">
        <div class="max-w-7xl w-full">
            <div class="mb-12 text-left">
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight mb-4 uppercase">
                    Berita & Kabar MA
                </h2>
                <div class="w-16 h-1.5 bg-[#1a4d2e] rounded-full mb-6"></div>
                <p class="text-slate-500 font-medium text-sm md:text-base">
                    Kumpulan kabar, agenda, dan artikel informatif seputar kegiatan Madrasah Aliyah.
                </p>
            </div>
            
            @if(isset($news) && $news->count() > 0)
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                    <!-- Berita Utama (Featured News) -->
                    @php
                        $featuredNews = $news->first();
                        $featuredThumb = $featuredNews->thumbnail 
                            ? asset('storage/' . $featuredNews->thumbnail) 
                            : 'https://picsum.photos/1000/600?nature';
                    @endphp
                    <a href="{{ route('berita.show', $featuredNews->slug) }}" class="lg:col-span-2 text-left space-y-6 group cursor-pointer block">
                        <div class="rounded-[2rem] overflow-hidden aspect-video bg-slate-100 shadow-md">
                            <img 
                                src="{{ $featuredThumb }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-all duration-500" 
                                alt="Berita Utama" 
                            >
                        </div>
                        <div class="space-y-3">
                            @if($featuredNews->category)
                                <span class="bg-[#1a4d2e] text-white px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm">
                                    {{ $featuredNews->category->name }}
                                </span>
                            @endif
                            <p class="text-xs text-[#1a4d2e] font-bold uppercase mt-2">
                                📅 {{ $featuredNews->published_at ? $featuredNews->published_at->format('d M Y') : $featuredNews->created_at->format('d M Y') }}
                            </p>
                            <h3 class="text-2xl md:text-3xl font-black text-slate-900 group-hover:text-[#1a4d2e] transition-colors leading-tight">{{ $featuredNews->title }}</h3>
                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-3">
                                {{ $featuredNews->excerpt ?? Str::limit(strip_tags($featuredNews->content), 150) }}
                            </p>
                        </div>
                    </a>

                    <!-- Berita Kecil (Sidebar List) -->
                    <div class="flex flex-col gap-8">
                        @foreach($news->slice(1) as $idx => $b)
                            @php
                                $bThumb = $b->thumbnail 
                                    ? asset('storage/' . $b->thumbnail) 
                                    : 'https://picsum.photos/200/200?random=' . $idx;
                            @endphp
                            <a href="{{ route('berita.show', $b->slug) }}" class="flex gap-4 items-start group cursor-pointer text-left block">
                                <div class="w-24 h-24 bg-slate-100 rounded-2xl overflow-hidden shrink-0 shadow-sm">
                                    <img 
                                        src="{{ $bThumb }}" 
                                        class="w-full h-full object-cover group-hover:scale-110 transition-all duration-500" 
                                        alt="Thumbnail" 
                                    >
                                </div>
                                <div class="space-y-1.5 flex-1">
                                    @if($b->category)
                                        <span class="text-[#1a4d2e] text-[9px] font-black uppercase tracking-wider block">
                                            {{ $b->category->name }}
                                        </span>
                                    @endif
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">
                                        📅 {{ $b->published_at ? $b->published_at->format('d M Y') : $b->created_at->format('d M Y') }}
                                    </p>
                                    <h4 class="text-sm font-bold text-slate-800 group-hover:text-[#1a4d2e] transition-colors leading-snug line-clamp-2">
                                        {{ $b->title }}
                                    </h4>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-center mt-16">
                    <a href="/berita" class="bg-[#1a4d2e] hover:bg-[#0d2b1a] text-white px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-widest shadow-md transition-all hover:scale-105 active:scale-95 inline-flex items-center gap-2 border-b-4 border-[#0d2b1a]">
                        <span>Lihat Semua Berita</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            @else
                <div class="bg-white p-12 rounded-3xl text-center border border-slate-150 max-w-xl mx-auto">
                    <span class="text-5xl mb-4 block opacity-50">📰</span>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Belum ada berita</h3>
                    <p class="text-xs text-slate-500">Silakan kembali beberapa saat lagi untuk mendapatkan berita terbaru.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- SECTION: SEJARAH & KONEKSI PUSAT -->
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6">
            <div class="ma-forest-bg rounded-3xl p-12 md:p-16 relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-[#d4af37]/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-emerald-400/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 text-center">
                    <div class="inline-block mb-6">
                        <span class="bg-[#d4af37]/20 text-[#d4af37] px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest border border-[#d4af37]/30">
                            Akar Sejarah
                        </span>
                    </div>
                    
                    <h2 class="text-3xl md:text-4xl font-black text-white mb-6 tracking-tight uppercase">
                        Bagian dari Perjalanan 32 Tahun
                        <span class="block text-[#d4af37]">Pesantren Persatuan Islam 104</span>
                    </h2>
                    
                    <div class="text-lg text-emerald-100/90 max-w-4xl mx-auto mb-10 leading-relaxed prose prose-invert prose-p:text-emerald-100/90">
                        {!! $maSettings->sejarah_ma ?? 'Sejak didirikan pada tahun 1994, Pesantren Persatuan Islam 104 Al-Ittihaad Cikajang telah melahirkan ribuan alumni yang berkiprah di berbagai bidang. Madrasah Aliyah merupakan bagian integral dari perjalanan panjang ini, melanjutkan tradisi keilmuan dan kaderisasi ulama yang telah tertanam sejak awal.' !!}
                    </div>
                    
                    <a href="/profil/sejarah" class="inline-block bg-[#d4af37] text-white px-10 py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-2xl transition-all hover:scale-105 active:scale-95 border-b-4 border-yellow-700">
                        {{ $maSettings->sejarah_button_text ?? 'Pelajari Sejarah Lengkap Pesantren' }}
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: MEDIA SOSIAL -->
    <section class="py-16 ma-off-white-bg">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-2xl font-black text-[#1a4d2e] mb-8 uppercase tracking-tight">Ikuti Kami di Media Sosial</h3>
            <div class="flex justify-center gap-6 flex-wrap">
                @if($maSettings && $maSettings->instagram_link)
                    <a href="{{ $maSettings->instagram_link }}" target="_blank" class="w-14 h-14 rounded-full bg-[#1a4d2e] text-white flex items-center justify-center hover:bg-[#0d2b1a] transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                @endif
                @if($maSettings && $maSettings->facebook_link)
                    <a href="{{ $maSettings->facebook_link }}" target="_blank" class="w-14 h-14 rounded-full bg-[#d4af37] text-white flex items-center justify-center hover:bg-[#c5a028] transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                @endif
                @if($maSettings && $maSettings->youtube_channel_link)
                    <a href="{{ $maSettings->youtube_channel_link }}" target="_blank" class="w-14 h-14 rounded-full bg-[#1a4d2e] text-white flex items-center justify-center hover:bg-[#0d2b1a] transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                @endif
                @if($maSettings && $maSettings->tiktok_link)
                    <a href="{{ $maSettings->tiktok_link }}" target="_blank" class="w-14 h-14 rounded-full bg-black text-white flex items-center justify-center hover:bg-gray-800 transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                    </a>
                @endif
                @if($maSettings && $maSettings->whatsapp_link)
                    <a href="{{ $maSettings->whatsapp_link }}" target="_blank" class="w-14 h-14 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:bg-[#128C7E] transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- FLOATING WHATSAPP BUTTON -->
    @if($maSettings && $maSettings->whatsapp_admin)
        <a href="https://wa.me/{{ $maSettings->whatsapp_admin }}" target="_blank" class="fixed bottom-6 right-6 z-50 bg-[#25D366] text-white w-16 h-16 rounded-full shadow-2xl flex items-center justify-center hover:bg-[#128C7E] transition-all hover:scale-110">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
        </a>
    @endif

    <!-- JAVASCRIPT FOR FAQ & LIGHTBOX -->
    <script>
        function toggleFaq(index) {
            const content = document.getElementById('faq-content-' + index);
            const icon = document.getElementById('faq-icon-' + index);
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        function openLightbox(imageUrl) {
            const lightbox = document.createElement('div');
            lightbox.className = 'fixed inset-0 bg-black/90 z-[1000] flex items-center justify-center p-4';
            lightbox.onclick = function() {
                document.body.removeChild(lightbox);
            };
            
            const img = document.createElement('img');
            img.src = imageUrl;
            img.className = 'max-w-full max-h-full object-contain rounded-2xl';
            
            lightbox.appendChild(img);
            document.body.appendChild(lightbox);
        }
    </script>

@endsection
