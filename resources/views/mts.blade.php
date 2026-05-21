@extends('layouts.main')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Madrasah Tsanawiyah Al-Ittihaad Cikajang</title>
    <style>
        /* Earth Tone Color Scheme for MTs */
        :root {
            --deep-chocolate: #4B3621;
            --warm-ivory: #FFFDD0;
            --terracotta: #E2725B;
            --light-cream: #FAF8F5;
            --soft-brown: #8B7355;
        }
        
        .mts-hero-gradient {
            background: linear-gradient(135deg, var(--deep-chocolate) 0%, #3D2A18 100%);
        }
        
        .mts-terracotta-gradient {
            background: linear-gradient(135deg, var(--terracotta) 0%, #D95E4A 100%);
        }
        
        .mts-card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(75, 54, 33, 0.25);
        }
        
        .mts-terracotta-border {
            border-color: var(--terracotta);
        }
        
        .mts-terracotta-text {
            color: var(--terracotta);
        }
        
        .mts-chocolate-bg {
            background-color: var(--deep-chocolate);
        }
        
        .mts-ivory-bg {
            background-color: var(--warm-ivory);
        }
        
        .mts-cream-bg {
            background-color: var(--light-cream);
        }
    </style>
</head>
<body class="font-sans antialiased">

    <!-- HERO SECTION -->
    <section class="mts-hero-gradient min-h-screen flex items-center justify-center relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-terracotta/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-warm-ivory/10 rounded-full blur-3xl"></div>
        
        @if($mtsSettings && $mtsSettings->hero_banner)
            <div class="absolute inset-0 opacity-20">
                <img src="{{ asset('storage/' . $mtsSettings->hero_banner) }}" alt="Banner MTs" class="w-full h-full object-cover">
            </div>
        @endif
        
        <div class="max-w-7xl mx-auto px-6 py-20 text-center relative z-10">
            <!-- Logo -->
            @if($mtsSettings && $mtsSettings->logo)
                <div class="mb-8">
                    <img src="{{ asset('storage/' . $mtsSettings->logo) }}" alt="Logo MTs" class="h-24 md:h-32 mx-auto">
                </div>
            @endif
            
            <!-- Badge -->
            <div class="inline-block mb-6">
                <span class="bg-terracotta/20 text-terracotta px-6 py-2 rounded-full text-sm font-bold uppercase tracking-widest border border-terracotta/30">
                    Pendidikan Menengah
                </span>
            </div>
            
            <!-- Main Title -->
            <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tight uppercase leading-tight">
                {{ $mtsSettings->hero_heading ?? 'Madrasah Tsanawiyah' }}
                <span class="block text-terracotta">Al-Ittihaad</span>
            </h1>
            
            @if($mtsSettings && $mtsSettings->hero_subheading)
                <p class="text-xl md:text-2xl text-warm-ivory/90 max-w-4xl mx-auto mb-8 font-medium leading-relaxed">
                    {{ $mtsSettings->hero_subheading }}
                </p>
            @endif
            
            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto mb-12">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="text-4xl font-black text-terracotta mb-2">28+</div>
                    <div class="text-sm text-warm-ivory/80 uppercase tracking-wider">Tahun Pengalaman</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="text-4xl font-black text-terracotta mb-2">400+</div>
                    <div class="text-sm text-warm-ivory/80 uppercase tracking-wider">Alumni</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="text-4xl font-black text-terracotta mb-2">3</div>
                    <div class="text-sm text-warm-ivory/80 uppercase tracking-wider">Program Unggulan</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                    <div class="text-4xl font-black text-terracotta mb-2">A</div>
                    <div class="text-sm text-warm-ivory/80 uppercase tracking-wider">Akreditasi</div>
                </div>
            </div>
            
            <!-- CTA Button -->
            @if($mtsSettings && $mtsSettings->cta_link)
                <a href="{{ $mtsSettings->cta_link }}" class="inline-block mts-terracotta-gradient text-white px-12 py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-2xl transition-all hover:scale-105 active:scale-95 border-b-4 border-red-700">
                    {{ $mtsSettings->cta_text ?? 'Daftar Sekarang' }}
                </a>
            @endif
        </div>
    </section>

    <!-- SECTION: PROGRAM UNGGULAN -->
    <section class="py-24 mts-ivory-bg">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-deep-chocolate uppercase tracking-tight">Program Unggulan</h2>
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-soft-brown max-w-3xl leading-relaxed font-medium mt-4">
                    Program khusus untuk mencetak generasi remaja yang beradab dan berkarakter islami.
                </p>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @if($mtsSettings && $mtsSettings->program_unggulan && count($mtsSettings->program_unggulan) > 0)
                    @foreach($mtsSettings->program_unggulan as $index => $program)
                        <div class="bg-white rounded-3xl overflow-hidden shadow-xl mts-card-hover transition-all duration-300 border-t-4 {{ $index === 1 ? 'border-terracotta' : 'border-deep-chocolate' }}">
                            <div class="p-8">
                                <div class="w-20 h-20 rounded-2xl {{ $index === 1 ? 'bg-terracotta/10' : 'bg-deep-chocolate/10' }} flex items-center justify-center mb-6">
                                    @if(isset($program['ikon']) && $program['ikon'])
                                        <span class="text-4xl">{{ $program['ikon'] }}</span>
                                    @else
                                        <svg class="w-10 h-10 {{ $index === 1 ? 'text-terracotta' : 'text-deep-chocolate' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                    @endif
                                </div>
                                <h3 class="text-2xl font-black text-deep-chocolate mb-4 uppercase tracking-tight">{{ $program['nama'] }}</h3>
                                <p class="text-slate-600 leading-relaxed mb-6">
                                    {{ $program['deskripsi'] }}
                                </p>
                                <button class="w-full {{ $index === 1 ? 'mts-terracotta-gradient border-b-4 border-red-700' : 'bg-deep-chocolate hover:bg-[#3D2A18]' }} text-white py-3 rounded-xl font-bold text-sm uppercase tracking-wider transition-all">
                                    Pelajari Program
                                </button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Default cards if no data -->
                    <!-- Pembiasaan Ibadah Card -->
                    <div class="bg-white rounded-3xl overflow-hidden shadow-xl mts-card-hover transition-all duration-300 border-t-4 border-deep-chocolate">
                        <div class="p-8">
                            <div class="w-20 h-20 rounded-2xl bg-deep-chocolate/10 flex items-center justify-center mb-6">
                                <span class="text-4xl">🕌</span>
                            </div>
                            <h3 class="text-2xl font-black text-deep-chocolate mb-4 uppercase tracking-tight">Pembiasaan Ibadah</h3>
                            <p class="text-slate-600 leading-relaxed mb-6">
                                Shalat berjama'ah, puasa sunnah, dan amalan harian untuk membentuk karakter religius.
                            </p>
                            <button class="w-full bg-deep-chocolate text-white py-3 rounded-xl font-bold text-sm uppercase tracking-wider hover:bg-[#3D2A18] transition-all">
                                Pelajari Program
                            </button>
                        </div>
                    </div>

                    <!-- Tahfidz Juz 30 Card -->
                    <div class="bg-white rounded-3xl overflow-hidden shadow-xl mts-card-hover transition-all duration-300 border-t-4 border-terracotta">
                        <div class="p-8">
                            <div class="w-20 h-20 rounded-2xl bg-terracotta/10 flex items-center justify-center mb-6">
                                <span class="text-4xl">📖</span>
                            </div>
                            <h3 class="text-2xl font-black text-deep-chocolate mb-4 uppercase tracking-tight">Tahfidz Juz 30</h3>
                            <p class="text-slate-600 leading-relaxed mb-6">
                                Program menghafal Juz 30 (Juz Amma) dengan metode yang sistematis dan terstruktur.
                            </p>
                            <button class="w-full mts-terracotta-gradient text-white py-3 rounded-xl font-bold text-sm uppercase tracking-wider hover:opacity-90 transition-all border-b-4 border-red-700">
                                Pelajari Program
                            </button>
                        </div>
                    </div>

                    <!-- Dasar Bahasa Arab Card -->
                    <div class="bg-white rounded-3xl overflow-hidden shadow-xl mts-card-hover transition-all duration-300 border-t-4 border-deep-chocolate">
                        <div class="p-8">
                            <div class="w-20 h-20 rounded-2xl bg-deep-chocolate/10 flex items-center justify-center mb-6">
                                <span class="text-4xl">🔤</span>
                            </div>
                            <h3 class="text-2xl font-black text-deep-chocolate mb-4 uppercase tracking-tight">Dasar Bahasa Arab</h3>
                            <p class="text-slate-600 leading-relaxed mb-6">
                                Pembelajaran bahasa Arab dasar untuk memahami Al-Qur'an dan kitab kuning.
                            </p>
                            <button class="w-full bg-deep-chocolate text-white py-3 rounded-xl font-bold text-sm uppercase tracking-wider hover:bg-[#3D2A18] transition-all">
                                Pelajari Program
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: VIDEO PROFIL -->
    <section class="py-24 mts-cream-bg">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-deep-chocolate uppercase tracking-tight">Video Profil</h2>
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto">
                @if($mtsSettings && $mtsSettings->youtube_link)
                    <div class="aspect-video rounded-3xl overflow-hidden shadow-2xl">
                        <iframe 
                            src="{{ $mtsSettings->youtube_link }}" 
                            class="w-full h-full"
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <div class="aspect-video rounded-3xl bg-gradient-to-br from-deep-chocolate to-terracotta flex items-center justify-center">
                        <div class="text-center text-white">
                            <svg class="w-24 h-24 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                            <p class="text-xl font-bold">Video Profil Akan Segera Hadir</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: KENAPA HARUS KAMI? -->
    <section class="py-24 mts-ivory-bg">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-deep-chocolate uppercase tracking-tight">Kenapa Harus Kami?</h2>
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-soft-brown max-w-3xl leading-relaxed font-medium mt-4">
                    Keunggulan utama yang menjadikan MTs Al-Ittihaad pilihan terbaik untuk pendidikan putra-putri Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @if($mtsSettings && $mtsSettings->keunggulan && count($mtsSettings->keunggulan) > 0)
                    @foreach($mtsSettings->keunggulan as $keunggulan)
                        <div class="bg-white rounded-3xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 border-t-4 border-terracotta">
                            <div class="w-20 h-20 rounded-full bg-terracotta/10 flex items-center justify-center mx-auto mb-6 text-4xl">
                                {{ $keunggulan['ikon'] ?? '✨' }}
                            </div>
                            <h3 class="text-xl font-black text-deep-chocolate mb-4 uppercase tracking-tight">{{ $keunggulan['judul'] }}</h3>
                            <p class="text-slate-600 leading-relaxed">{{ $keunggulan['deskripsi'] }}</p>
                        </div>
                    @endforeach
                @else
                    <!-- Default keunggulan -->
                    <div class="bg-white rounded-3xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 border-t-4 border-terracotta">
                        <div class="w-20 h-20 rounded-full bg-terracotta/10 flex items-center justify-center mx-auto mb-6 text-4xl">🎓</div>
                        <h3 class="text-xl font-black text-deep-chocolate mb-4 uppercase tracking-tight">Kurikulum Terpadu</h3>
                        <p class="text-slate-600 leading-relaxed">Integrasi ilmu agama dan umum yang seimbang</p>
                    </div>
                    <div class="bg-white rounded-3xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 border-t-4 border-terracotta">
                        <div class="w-20 h-20 rounded-full bg-terracotta/10 flex items-center justify-center mx-auto mb-6 text-4xl">🌳</div>
                        <h3 class="text-xl font-black text-deep-chocolate mb-4 uppercase tracking-tight">Lingkungan Asri</h3>
                        <p class="text-slate-600 leading-relaxed">Suasana belajar yang tenang dan kondusif</p>
                    </div>
                    <div class="bg-white rounded-3xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 border-t-4 border-terracotta">
                        <div class="w-20 h-20 rounded-full bg-terracotta/10 flex items-center justify-center mx-auto mb-6 text-4xl">👨‍🏫</div>
                        <h3 class="text-xl font-black text-deep-chocolate mb-4 uppercase tracking-tight">Tenaga Pengajar Kompeten</h3>
                        <p class="text-slate-600 leading-relaxed">Guru berpengalaman dan berdedikasi tinggi</p>
                    </div>
                    <div class="bg-white rounded-3xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-300 border-t-4 border-terracotta">
                        <div class="w-20 h-20 rounded-full bg-terracotta/10 flex items-center justify-center mx-auto mb-6 text-4xl">🏢</div>
                        <h3 class="text-xl font-black text-deep-chocolate mb-4 uppercase tracking-tight">Fasilitas Lengkap</h3>
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
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-deep-chocolate uppercase tracking-tight">Kurikulum & Program Unggulan</h2>
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto">
                @if($mtsSettings && $mtsSettings->kurikulum_detail)
                    <div class="prose prose-lg max-w-none text-slate-600 leading-relaxed">
                        {!! $mtsSettings->kurikulum_detail !!}
                    </div>
                @else
                    <div class="prose prose-lg max-w-none text-slate-600 leading-relaxed">
                        <p>MTs Al-Ittihaad menerapkan kurikulum terpadu yang menggabungkan kurikulum nasional dengan kurikulum kepesantrenan. Program unggulan kami meliputi:</p>
                        <ul>
                            <li><strong>Tahfidz Juz 30</strong> - Program menghafal Juz Amma dengan target hafalan sempurna</li>
                            <li><strong>Dasar Bahasa Arab</strong> - Pembelajaran bahasa Arab dasar untuk pemahaman kitab</li>
                            <li><strong>Pembiasaan Ibadah</strong> - Kegiatan ibadah harian yang terjadwal dan terawasi</li>
                            <li><strong>Kitab Kuning Dasar</strong> - Pengenalan kitab kuning tingkat dasar</li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: GALERI KEGIATAN -->
    <section class="py-24 mts-ivory-bg">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-deep-chocolate uppercase tracking-tight">Galeri Kegiatan</h2>
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-soft-brown max-w-3xl leading-relaxed font-medium mt-4">
                    Dokumentasi aktivitas santri MTs dalam belajar, beribadah, dan berkegiatan.
                </p>
            </div>

            @if($mtsSettings && $mtsSettings->galeri && count($mtsSettings->galeri) > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($mtsSettings->galeri as $foto)
                        <div class="relative group overflow-hidden rounded-2xl shadow-lg cursor-pointer" onclick="openLightbox('{{ asset('storage/' . $foto) }}')">
                            <img src="{{ asset('storage/' . $foto) }}" alt="Galeri Kegiatan" class="w-full h-48 md:h-64 object-cover transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div class="bg-deep-chocolate/10 rounded-2xl h-48 md:h-64 flex items-center justify-center">
                        <span class="text-4xl">📸</span>
                    </div>
                    <div class="bg-deep-chocolate/10 rounded-2xl h-48 md:h-64 flex items-center justify-center">
                        <span class="text-4xl">📸</span>
                    </div>
                    <div class="bg-deep-chocolate/10 rounded-2xl h-48 md:h-64 flex items-center justify-center">
                        <span class="text-4xl">📸</span>
                    </div>
                    <div class="bg-deep-chocolate/10 rounded-2xl h-48 md:h-64 flex items-center justify-center">
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
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-deep-chocolate uppercase tracking-tight">Alur Pendaftaran</h2>
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-soft-brown max-w-3xl leading-relaxed font-medium mt-4">
                    Langkah mudah mendaftar santri baru MTs Al-Ittihaad.
                </p>
            </div>

            <div class="max-w-5xl mx-auto">
                @if($mtsSettings && $mtsSettings->alur_pendaftaran && count($mtsSettings->alur_pendaftaran) > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($mtsSettings->alur_pendaftaran as $index => $langkah)
                            <div class="relative">
                                <div class="bg-white rounded-3xl p-8 shadow-lg border-t-4 border-terracotta text-center relative z-10">
                                    <div class="w-16 h-16 rounded-full bg-terracotta text-white flex items-center justify-center mx-auto mb-6 text-2xl font-black">
                                        {{ $langkah['langkah'] ?? ($index + 1) }}
                                    </div>
                                    <h3 class="text-lg font-black text-deep-chocolate mb-4 uppercase tracking-tight">{{ $langkah['judul'] }}</h3>
                                    <p class="text-slate-600 leading-relaxed text-sm">{{ $langkah['deskripsi'] }}</p>
                                </div>
                                @if($index < count($mtsSettings->alur_pendaftaran) - 1)
                                    <div class="hidden lg:block absolute top-1/2 -right-3 w-6 h-0.5 bg-terracotta"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="relative">
                            <div class="bg-white rounded-3xl p-8 shadow-lg border-t-4 border-terracotta text-center relative z-10">
                                <div class="w-16 h-16 rounded-full bg-terracotta text-white flex items-center justify-center mx-auto mb-6 text-2xl font-black">1</div>
                                <h3 class="text-lg font-black text-deep-chocolate mb-4 uppercase tracking-tight">Daftar Online</h3>
                                <p class="text-slate-600 leading-relaxed text-sm">Isi formulir pendaftaran melalui website</p>
                            </div>
                            <div class="hidden lg:block absolute top-1/2 -right-3 w-6 h-0.5 bg-terracotta"></div>
                        </div>
                        <div class="relative">
                            <div class="bg-white rounded-3xl p-8 shadow-lg border-t-4 border-terracotta text-center relative z-10">
                                <div class="w-16 h-16 rounded-full bg-terracotta text-white flex items-center justify-center mx-auto mb-6 text-2xl font-black">2</div>
                                <h3 class="text-lg font-black text-deep-chocolate mb-4 uppercase tracking-tight">Tes Seleksi</h3>
                                <p class="text-slate-600 leading-relaxed text-sm">Ikuti tes akademik dan wawancara</p>
                            </div>
                            <div class="hidden lg:block absolute top-1/2 -right-3 w-6 h-0.5 bg-terracotta"></div>
                        </div>
                        <div class="relative">
                            <div class="bg-white rounded-3xl p-8 shadow-lg border-t-4 border-terracotta text-center relative z-10">
                                <div class="w-16 h-16 rounded-full bg-terracotta text-white flex items-center justify-center mx-auto mb-6 text-2xl font-black">3</div>
                                <h3 class="text-lg font-black text-deep-chocolate mb-4 uppercase tracking-tight">Pengumuman</h3>
                                <p class="text-slate-600 leading-relaxed text-sm">Tunggu hasil seleksi via email/SMS</p>
                            </div>
                            <div class="hidden lg:block absolute top-1/2 -right-3 w-6 h-0.5 bg-terracotta"></div>
                        </div>
                        <div class="relative">
                            <div class="bg-white rounded-3xl p-8 shadow-lg border-t-4 border-terracotta text-center relative z-10">
                                <div class="w-16 h-16 rounded-full bg-terracotta text-white flex items-center justify-center mx-auto mb-6 text-2xl font-black">4</div>
                                <h3 class="text-lg font-black text-deep-chocolate mb-4 uppercase tracking-tight">Daftar Ulang</h3>
                                <p class="text-slate-600 leading-relaxed text-sm">Lengkapi administrasi dan pembayaran</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: FAQ -->
    <section class="py-24 mts-ivory-bg">
        <div class="max-w-4xl mx-auto px-6">
            <div class="mb-16 text-center flex flex-col items-center">
                <div class="flex items-center gap-3 mb-4 justify-center">
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                    <h2 class="text-3xl md:text-4xl font-black text-deep-chocolate uppercase tracking-tight">FAQ</h2>
                    <div class="bg-deep-chocolate w-12 h-1.5 rounded-full"></div>
                </div>
                <p class="text-soft-brown max-w-3xl leading-relaxed font-medium mt-4">
                    Pertanyaan yang sering ditanyakan tentang MTs Al-Ittihaad.
                </p>
            </div>

            @if($mtsSettings && $mtsSettings->faq && count($mtsSettings->faq) > 0)
                <div class="space-y-4">
                    @foreach($mtsSettings->faq as $index => $item)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                            <button onclick="toggleFaq({{ $index }})" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-warm-ivory transition-colors">
                                <span class="font-bold text-deep-chocolate">{{ $item['pertanyaan'] }}</span>
                                <svg id="faq-icon-{{ $index }}" class="w-5 h-5 text-deep-chocolate transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        <button onclick="toggleFaq(0)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-warm-ivory transition-colors">
                            <span class="font-bold text-deep-chocolate">Berapa biaya masuk MTs Al-Ittihaad?</span>
                            <svg id="faq-icon-0" class="w-5 h-5 text-deep-chocolate transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="faq-content-0" class="hidden px-6 pb-4 text-slate-600 leading-relaxed">
                            Biaya pendaftaran dapat ditanyakan langsung ke admin kami melalui WhatsApp.
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <button onclick="toggleFaq(1)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-warm-ivory transition-colors">
                            <span class="font-bold text-deep-chocolate">Apa saja syarat pendaftaran?</span>
                            <svg id="faq-icon-1" class="w-5 h-5 text-deep-chocolate transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div id="faq-content-1" class="hidden px-6 pb-4 text-slate-600 leading-relaxed">
                            Syarat pendaftaran meliputi: ijazah SD/MI, kartu keluarga, akta kelahiran, dan pas foto.
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                        <button onclick="toggleFaq(2)" class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-warm-ivory transition-colors">
                            <span class="font-bold text-deep-chocolate">Apakah wajib asrama?</span>
                            <svg id="faq-icon-2" class="w-5 h-5 text-deep-chocolate transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

    <!-- SECTION: SEJARAH MTs -->
    <section class="py-24 mts-hero-gradient">
        <div class="max-w-6xl mx-auto px-6">
            <div class="mts-chocolate-bg rounded-3xl p-12 md:p-16 relative overflow-hidden">
                <!-- Decorative elements -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-terracotta/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-warm-ivory/10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 text-center">
                    <div class="inline-block mb-6">
                        <span class="bg-terracotta/20 text-terracotta px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest border border-terracotta/30">
                            Perjalanan Kami
                        </span>
                    </div>
                    
                    <h2 class="text-3xl md:text-4xl font-black text-white mb-6 tracking-tight uppercase">
                        Mencetak Generasi Tangguh
                        <span class="block text-terracotta">Menuju Jenjang Aliyah</span>
                    </h2>
                    
                    <div class="text-lg text-warm-ivory/90 max-w-4xl mx-auto mb-10 leading-relaxed prose prose-invert prose-p:text-warm-ivory/90">
                        {!! $mtsSettings->sejarah_mts ?? 'Madrasah Tsanawiyah Al-Ittihaad Cikajang hadir sebagai jenjang pendidikan menengah yang berfokus pada pembentukan karakter dan adab santri. Sebagai jembatan menuju jenjang Aliyah, kami berkomitmen mencetak generasi yang tangguh, berilmu, dan berakhlak mulia dengan landasan Al-Qur\'an dan As-Sunnah.' !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: CTA PENDAFTARAN -->
    <section class="py-24 mts-ivory-bg">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <div class="bg-white rounded-3xl p-12 md:p-16 shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 mts-terracotta-gradient"></div>
                
                <h2 class="text-3xl md:text-4xl font-black text-deep-chocolate mb-6 uppercase tracking-tight">
                    Siap Bergabung Bersama Kami?
                </h2>
                <p class="text-lg text-soft-brown max-w-3xl mx-auto mb-10 leading-relaxed">
                    Daftarkan putra-putri Anda untuk menjadi bagian dari keluarga besar MTs Al-Ittihaad Cikajang.
                </p>
                
                @if($mtsSettings && $mtsSettings->cta_link)
                    <a href="{{ $mtsSettings->cta_link }}" class="inline-block mts-terracotta-gradient text-white px-12 py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-2xl transition-all hover:scale-105 active:scale-95 border-b-4 border-red-700">
                        {{ $mtsSettings->cta_text ?? 'Daftar Sekarang' }}
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- SECTION: MEDIA SOSIAL -->
    <section class="py-16 mts-cream-bg">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h3 class="text-2xl font-black text-deep-chocolate mb-8 uppercase tracking-tight">Ikuti Kami di Media Sosial</h3>
            <div class="flex justify-center gap-6 flex-wrap">
                @if($mtsSettings && $mtsSettings->instagram_link)
                    <a href="{{ $mtsSettings->instagram_link }}" target="_blank" class="w-14 h-14 rounded-full bg-deep-chocolate text-white flex items-center justify-center hover:bg-[#3D2A18] transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                @endif
                @if($mtsSettings && $mtsSettings->facebook_link)
                    <a href="{{ $mtsSettings->facebook_link }}" target="_blank" class="w-14 h-14 rounded-full bg-terracotta text-white flex items-center justify-center hover:bg-[#D95E4A] transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                @endif
                @if($mtsSettings && $mtsSettings->youtube_channel_link)
                    <a href="{{ $mtsSettings->youtube_channel_link }}" target="_blank" class="w-14 h-14 rounded-full bg-deep-chocolate text-white flex items-center justify-center hover:bg-[#3D2A18] transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                @endif
                @if($mtsSettings && $mtsSettings->tiktok_link)
                    <a href="{{ $mtsSettings->tiktok_link }}" target="_blank" class="w-14 h-14 rounded-full bg-black text-white flex items-center justify-center hover:bg-gray-800 transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                    </a>
                @endif
                @if($mtsSettings && $mtsSettings->whatsapp_link)
                    <a href="{{ $mtsSettings->whatsapp_link }}" target="_blank" class="w-14 h-14 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:bg-[#128C7E] transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- FLOATING WHATSAPP BUTTON -->
    @if($mtsSettings && $mtsSettings->whatsapp_admin)
        <a href="https://wa.me/{{ $mtsSettings->whatsapp_admin }}" target="_blank" class="fixed bottom-6 right-6 z-50 bg-[#25D366] text-white w-16 h-16 rounded-full shadow-2xl flex items-center justify-center hover:bg-[#128C7E] transition-all hover:scale-110">
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
