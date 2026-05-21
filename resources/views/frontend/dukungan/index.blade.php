@extends('layouts.main')

@section('title', 'Gerakan Wakaf Pendidikan')

@section('content')
<!-- Wrapper with Alpine for Modals and Lightbox -->
<div x-data="{ 
    isHistoryModalOpen: false,
    activeLightboxImage: null,
    images: [
        @if($wakaf && $wakaf->galleries->count() > 0)
            @foreach($wakaf->galleries as $gallery)
                '{{ asset('storage/' . $gallery->image) }}',
            @endforeach
        @else
        'https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1584553421349-355847fa0d46?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1604085572504-a392ddf0d86a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1589828131754-07106093410e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
        @endif
    ]
}" class="bg-amber-50/30 font-sans selection:bg-emerald-200 selection:text-emerald-900">

    <!-- 1. Hero Section -->
    <section class="relative bg-emerald-900 text-white overflow-hidden min-h-[80vh] flex items-center">
        <!-- Background Pattern/Overlay -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-emerald-900/90 via-emerald-900/80 to-emerald-950/90 z-10"></div>
            <img src="{{ $wakaf && $wakaf->hero_image ? asset('storage/' . $wakaf->hero_image) : 'https://images.unsplash.com/photo-1519817650390-64d9f100868f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80' }}" alt="Suasana Pesantren" class="w-full h-full object-cover object-center mix-blend-overlay opacity-40">
            <div class="absolute inset-0 z-20 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-10 mix-blend-color-burn"></div>
        </div>
        
        <div class="relative z-30 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-20 pb-16">
            <div class="inline-flex items-center justify-center space-x-2 bg-emerald-800/50 backdrop-blur-md border border-emerald-500/30 rounded-full px-4 py-1.5 mb-8 transform transition hover:scale-105 duration-300">
                <span class="flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-emerald-300 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                </span>
                <span class="text-sm font-medium text-emerald-100 tracking-wide">Merajut Amal Jariyah</span>
            </div>
            
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-white drop-shadow-xl leading-tight mb-6 font-serif">
                {!! $wakaf && $wakaf->hero_title ? str_replace('Pendidikan', '<span class="text-amber-300 italic font-light">Pendidikan</span>', $wakaf->hero_title) : 'Gerakan Wakaf <br/><span class="text-amber-300 italic font-light">Pendidikan</span>' !!}
            </h1>
            
            <p class="max-w-2xl mx-auto text-lg md:text-2xl text-emerald-50 font-light leading-relaxed mb-10 text-shadow-sm">
                {{ $wakaf->hero_subtitle ?? 'Menjaga nyala perjuangan pendidikan Islam, merawat ilmu, dan membersamai langkah perkembangan pesantren tercinta.' }}
            </p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="#program" class="px-8 py-4 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-amber-950 rounded-full font-bold text-lg shadow-lg shadow-amber-500/30 transform transition duration-300 hover:-translate-y-1 hover:shadow-xl w-full sm:w-auto">
                    Mulai Membersamai
                </a>
                <button @click="isHistoryModalOpen = true" class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur-md border border-white/20 text-white rounded-full font-medium text-lg transition duration-300 w-full sm:w-auto flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Kisah Perjuangan
                </button>
            </div>
        </div>

        <!-- Wave Separator bottom -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-20 rotate-180">
            <svg class="relative block w-full h-[50px] md:h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="fill-amber-50/30"></path>
            </svg>
        </div>
    </section>

    <!-- 2. Cerita Perjuangan Pendidikan -->
    <section class="py-20 px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-emerald-600 font-bold tracking-wider uppercase text-sm">Awal Mula yang Sederhana</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-800 mt-2 font-serif">{{ $wakaf->history_title ?? 'Perjalanan Sebuah Amanah' }}</h2>
                <div class="w-24 h-1 bg-amber-400 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="prose prose-lg prose-emerald mx-auto text-slate-600 text-center leading-loose">
                @if($wakaf && $wakaf->history_content)
                    {!! $wakaf->history_content !!}
                @else
                    <p>
                        Semuanya bermula dari sebuah majelis ilmu yang bersahaja. Di teras-teras rumah dan bilik sederhana, para sesepuh dan muwakif menanamkan benih cinta pada Al-Qur'an dan sunnah. Tanpa dinding megah, hanya ada keikhlasan yang menguatkan setiap ejaan huruf hijaiyah yang terucap dari lisan santri-santrinya.
                    </p>
                    <p>
                        Seiring berjalannya waktu, amanah ini perlahan tumbuh. Berkat gotong royong masyarakat, dukungan para wali santri, dan perjuangan tiada henti dari keluarga besar pesantren, gubuk-gubuk mengaji itu bertransformasi menjadi ruang kelas. Setiap keping bata yang tersusun, setiap atap yang menaungi, adalah saksi bisu dari doa dan pengorbanan hamba-hamba Allah yang merindukan amal jariyah.
                    </p>
                @endif

                @if($wakaf && $wakaf->history_quote)
                <p class="font-medium text-emerald-800 text-xl italic mt-8 border-y border-emerald-100 py-6">
                    "{!! $wakaf->history_quote !!}"
                </p>
                @else
                <p class="font-medium text-emerald-800 text-xl italic mt-8 border-y border-emerald-100 py-6">
                    "Kini, pesantren ini bukan sekadar bangunan, melainkan sebuah denyut nadi dakwah, tempat generasi penerus dididik untuk menjadi pewaris para nabi."
                </p>
                @endif
            </div>
            
            <!-- 3. Tombol Popup Sejarah Pesantren -->
            <div class="mt-12 text-center">
                <button @click="isHistoryModalOpen = true" class="group inline-flex items-center gap-3 px-6 py-3 bg-white border border-emerald-100 text-emerald-700 hover:bg-emerald-50 rounded-xl font-semibold shadow-sm hover:shadow-md transition-all duration-300">
                    <svg class="w-6 h-6 text-emerald-500 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Lihat Sejarah Lengkap
                </button>
            </div>
        </div>
    </section>

    <!-- 4. Program Dukungan Pendidikan -->
    <section id="program" class="py-24 bg-white relative">
        <!-- Pattern background -->
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cream-pixels.png')] opacity-40"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <span class="text-emerald-600 font-bold tracking-wider uppercase text-sm">Pintu Kebaikan</span>
                <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 mt-2 font-serif">Program Wakaf & Dukungan</h2>
                <p class="mt-4 max-w-2xl mx-auto text-slate-500 text-lg">Mari pilih jalan kebaikan untuk menitipkan amal jariyah, mendukung keberlangsungan pendidikan dan kemaslahatan santri.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @if($wakaf && $wakaf->programs->count() > 0)
                    @foreach($wakaf->programs as $idx => $program)
                    @php
                        // Hardcode some colors to avoid tailwind purge issues
                        $colorClass = 'emerald';
                        if ($program->color == 'amber') $colorClass = 'amber';
                        if ($program->color == 'blue') $colorClass = 'blue';
                        $mtClass = $idx % 2 != 0 ? 'mt-0 lg:mt-8' : '';
                    @endphp
                    <!-- Card Dynamic -->
                    <div class="group bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:border-emerald-200 shadow-soft hover:shadow-xl transition-all duration-500 relative overflow-hidden {{ $mtClass }}">
                        <div class="absolute top-0 right-0 -mr-6 -mt-6 w-24 h-24 bg-{{ $colorClass }}-100 rounded-full blur-xl group-hover:bg-amber-100 transition-colors duration-500"></div>
                        <div class="relative z-10">
                            <div class="w-16 h-16 bg-{{ $colorClass == 'amber' ? 'amber-500' : 'emerald-600' }} rounded-2xl flex items-center justify-center text-white mb-6 transform group-hover:-translate-y-2 group-hover:shadow-lg shadow-{{ $colorClass }}-500/30 transition-all duration-300 text-3xl">
                                {{ $program->icon ?? '✨' }}
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-{{ $colorClass }}-700 transition-colors">{{ $program->title }}</h3>
                            <p class="text-slate-500 mb-8 leading-relaxed">{{ $program->description }}</p>
                            @if($program->link)
                            <a href="{{ url($program->link) }}" class="inline-flex items-center font-semibold text-{{ $colorClass }}-600 hover:text-{{ $colorClass }}-800">
                                Detail Program <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                <!-- Card 1 -->
                <div class="group bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:border-emerald-200 shadow-soft hover:shadow-xl transition-all duration-500 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-6 -mt-6 w-24 h-24 bg-emerald-100 rounded-full blur-xl group-hover:bg-amber-100 transition-colors duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-emerald-600 rounded-2xl flex items-center justify-center text-white mb-6 transform group-hover:-translate-y-2 group-hover:shadow-lg shadow-emerald-500/30 transition-all duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-emerald-700 transition-colors">Pembangunan Sarana</h3>
                        <p class="text-slate-500 mb-8 leading-relaxed">Mendukung perluasan kelas, asrama, dan fasilitas ibadah demi kenyamanan santri menuntut ilmu.</p>
                        <a href="{{ route('dukungan.pembangunan') }}" class="inline-flex items-center font-semibold text-emerald-600 hover:text-emerald-800">
                            Detail Program <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="group bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:border-emerald-200 shadow-soft hover:shadow-xl transition-all duration-500 relative overflow-hidden mt-0 lg:mt-8">
                    <div class="absolute top-0 right-0 -mr-6 -mt-6 w-24 h-24 bg-emerald-100 rounded-full blur-xl group-hover:bg-amber-100 transition-colors duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-amber-500 rounded-2xl flex items-center justify-center text-white mb-6 transform group-hover:-translate-y-2 group-hover:shadow-lg shadow-amber-500/30 transition-all duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14v6"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-amber-600 transition-colors">Beasiswa Santri</h3>
                        <p class="text-slate-500 mb-8 leading-relaxed">Membantu pendidikan santri yatim dan dhuafa agar tetap bisa menggapai cita-cita mulianya.</p>
                        <a href="{{ route('dukungan.beasiswa') }}" class="inline-flex items-center font-semibold text-amber-600 hover:text-amber-800">
                            Detail Program <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="group bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:border-emerald-200 shadow-soft hover:shadow-xl transition-all duration-500 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-6 -mt-6 w-24 h-24 bg-emerald-100 rounded-full blur-xl group-hover:bg-amber-100 transition-colors duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-emerald-600 rounded-2xl flex items-center justify-center text-white mb-6 transform group-hover:-translate-y-2 group-hover:shadow-lg shadow-emerald-500/30 transition-all duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-emerald-700 transition-colors">Wakaf Al-Qur'an</h3>
                        <p class="text-slate-500 mb-8 leading-relaxed">Setiap huruf yang dibaca mengalirkan pahala abadi. Distribusi Al-Qur'an dan kitab untuk para santri.</p>
                        <a href="#" class="inline-flex items-center font-semibold text-emerald-600 hover:text-emerald-800">
                            Detail Program <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="group bg-slate-50 rounded-3xl p-8 border border-slate-100 hover:border-emerald-200 shadow-soft hover:shadow-xl transition-all duration-500 relative overflow-hidden mt-0 lg:mt-8">
                    <div class="absolute top-0 right-0 -mr-6 -mt-6 w-24 h-24 bg-emerald-100 rounded-full blur-xl group-hover:bg-amber-100 transition-colors duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-emerald-600 rounded-2xl flex items-center justify-center text-white mb-6 transform group-hover:-translate-y-2 group-hover:shadow-lg shadow-emerald-500/30 transition-all duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-emerald-700 transition-colors">Kegiatan Santri</h3>
                        <p class="text-slate-500 mb-8 leading-relaxed">Dukungan operasional untuk kegiatan ekstrakurikuler, kajian, dan perlombaan prestasi santri.</p>
                        <a href="#" class="inline-flex items-center font-semibold text-emerald-600 hover:text-emerald-800">
                            Detail Program <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- 5 & 6. Progress Perjalanan & Timeline -->
    <section class="py-24 bg-emerald-900 text-white relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <!-- Progress Bars -->
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold font-serif mb-4">Progress Pembangunan</h2>
                    <p class="text-emerald-200 mb-10 text-lg">Amanah yang dititipkan terus bergerak menjadi wujud nyata yang menopang kegiatan belajar santri sehari-hari.</p>
                    
                    <div class="space-y-8">
                        @if($wakaf && $wakaf->progresses->count() > 0)
                            @foreach($wakaf->progresses as $progress)
                            <div>
                                <div class="flex justify-between items-end mb-2">
                                    <span class="font-semibold text-lg text-emerald-50">{{ $progress->title }}</span>
                                    @if($progress->is_completed)
                                    <span class="font-bold text-emerald-300 bg-emerald-800 px-3 py-1 rounded-full text-xs">Selesai</span>
                                    @else
                                    <span class="font-bold text-emerald-300">{{ $progress->status_text ?: $progress->percentage . '%' }}</span>
                                    @endif
                                </div>
                                <div class="w-full bg-emerald-950/50 rounded-full h-4 backdrop-blur-sm border border-emerald-700/50 overflow-hidden shadow-inner">
                                    <div class="bg-{{ $progress->is_completed ? 'emerald-500' : 'gradient-to-r from-amber-500 to-yellow-400' }} h-4 rounded-full relative" style="width: {{ $progress->percentage }}%">
                                        @if(!$progress->is_completed)
                                        <div class="absolute top-0 left-0 w-full h-full bg-white/20 animate-[pulse_2s_ease-in-out_infinite]"></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @else
                        <!-- Item 1 -->
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <span class="font-semibold text-lg text-emerald-50">Renovasi Asrama Putra</span>
                                <span class="font-bold text-emerald-300">70%</span>
                            </div>
                            <div class="w-full bg-emerald-950/50 rounded-full h-4 backdrop-blur-sm border border-emerald-700/50 overflow-hidden shadow-inner">
                                <div class="bg-gradient-to-r from-amber-500 to-yellow-400 h-4 rounded-full relative" style="width: 70%">
                                    <!-- animated shine -->
                                    <div class="absolute top-0 left-0 w-full h-full bg-white/20 animate-[pulse_2s_ease-in-out_infinite]"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Item 2 -->
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <span class="font-semibold text-lg text-emerald-50">Pengadaan Meja Belajar MDT</span>
                                <span class="font-bold text-emerald-300 bg-emerald-800 px-3 py-1 rounded-full text-xs">Selesai</span>
                            </div>
                            <div class="w-full bg-emerald-950/50 rounded-full h-4 backdrop-blur-sm border border-emerald-700/50 overflow-hidden shadow-inner">
                                <div class="bg-emerald-500 h-4 rounded-full relative" style="width: 100%"></div>
                            </div>
                        </div>

                        <!-- Item 3 -->
                        <div>
                            <div class="flex justify-between items-end mb-2">
                                <span class="font-semibold text-lg text-emerald-50">Pembangunan Aula Utama</span>
                                <span class="font-bold text-emerald-300">Dalam Proses (30%)</span>
                            </div>
                            <div class="w-full bg-emerald-950/50 rounded-full h-4 backdrop-blur-sm border border-emerald-700/50 overflow-hidden shadow-inner">
                                <div class="bg-gradient-to-r from-amber-500 to-yellow-400 h-4 rounded-full relative" style="width: 30%">
                                    <div class="absolute top-0 left-0 w-full h-full bg-white/20 animate-[pulse_2s_ease-in-out_infinite]"></div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Timeline -->
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold font-serif mb-10">Jejak Langkah</h2>
                    
                    <div class="relative border-l-2 border-emerald-700/50 ml-4 space-y-12">
                        @if($wakaf && $wakaf->timelines->count() > 0)
                            @foreach($wakaf->timelines as $timeline)
                            <div class="relative pl-8 group">
                                <div class="absolute -left-[11px] top-1 w-5 h-5 rounded-full bg-{{ $timeline->color ?: 'emerald' }}-500 border-4 border-emerald-900 group-hover:scale-125 transition-transform duration-300"></div>
                                <span class="text-sm font-bold text-{{ $timeline->color ?: 'emerald' }}-400 mb-1 block tracking-wider">{{ $timeline->year }}</span>
                                <h3 class="text-xl font-bold text-white mb-2">{{ $timeline->title }}</h3>
                                <p class="text-emerald-100">{{ $timeline->description }}</p>
                            </div>
                            @endforeach
                        @else
                        <!-- Timeline 1 -->
                        <div class="relative pl-8 group">
                            <div class="absolute -left-[11px] top-1 w-5 h-5 rounded-full bg-amber-500 border-4 border-emerald-900 group-hover:scale-125 transition-transform duration-300"></div>
                            <span class="text-sm font-bold text-amber-400 mb-1 block tracking-wider">2025</span>
                            <h3 class="text-xl font-bold text-white mb-2">Pengembangan Perpustakaan</h3>
                            <p class="text-emerald-100">Fokus utama tahun ini adalah menyediakan literatur lengkap dan ruang baca yang nyaman bagi santri.</p>
                        </div>
                        
                        <!-- Timeline 2 -->
                        <div class="relative pl-8 group">
                            <div class="absolute -left-[11px] top-1 w-5 h-5 rounded-full bg-emerald-500 border-4 border-emerald-900 group-hover:scale-125 transition-transform duration-300"></div>
                            <span class="text-sm font-bold text-emerald-400 mb-1 block tracking-wider">2024</span>
                            <h3 class="text-xl font-bold text-white mb-2">Pembangunan Aula & Asrama</h3>
                            <p class="text-emerald-100/70">Alhamdulillah telah terselesaikan tahap awal pengecoran asrama dan dimulainya pengerjaan aula santri.</p>
                        </div>

                        <!-- Timeline 3 -->
                        <div class="relative pl-8 group">
                            <div class="absolute -left-[11px] top-1 w-5 h-5 rounded-full bg-emerald-600 border-4 border-emerald-900 group-hover:scale-125 transition-transform duration-300"></div>
                            <span class="text-sm font-bold text-emerald-500 mb-1 block tracking-wider">2023</span>
                            <h3 class="text-xl font-bold text-white/70 mb-2">Renovasi Ruang Kelas MDT</h3>
                            <p class="text-emerald-100/50">Perbaikan atap dan pengecatan ulang ruang kelas lama hasil gotong royong warga.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. Transparansi Dukungan -->
    <section class="py-20 bg-amber-50 relative border-b border-emerald-100">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <svg class="w-12 h-12 text-emerald-600 mx-auto mb-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-800 mb-6 font-serif">{{ $wakaf->transparency_title ?? 'Amanah yang Terjaga' }}</h2>
            <div class="text-lg md:text-xl text-slate-600 leading-relaxed font-light prose prose-emerald mx-auto">
                @if($wakaf && $wakaf->transparency_content)
                    {!! $wakaf->transparency_content !!}
                @else
                <p>
                    "Setiap tetes keringat perjuangan dan setiap rupiah dukungan yang diberikan, menjadi saksi yang tak terputus. Mengalir menjadi dinding kelas, menjadi lembaran ilmu, dan menjadi bagian dari perjalanan panjang pesantren ini. Kami merawat amanah ini dengan sepenuh hati, karena kelak, semuanya akan dipertanggungjawabkan di hadapan Ilahi."
                </p>
                @endif
            </div>
        </div>
    </section>

    <!-- 7. Gallery Dokumentasi (Masonry) -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-800 font-serif">Jejak Dokumentasi</h2>
                <p class="mt-4 text-slate-500 text-lg">Potret kebersamaan, gotong royong, dan wajah ceria generasi penerus.</p>
            </div>

            <!-- CSS Masonry -->
            <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
                <template x-for="(img, index) in images" :key="index">
                    <div class="break-inside-avoid relative group cursor-pointer rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300" @click="activeLightboxImage = img">
                        <img :src="img" alt="Dokumentasi" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                            <span class="text-white font-medium">Lihat Momen <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path></svg></span>
                        </div>
                    </div>
                </template>
                <!-- Static Item for Layout demonstration -->
                <div class="break-inside-avoid bg-emerald-50 rounded-2xl p-8 flex flex-col justify-center min-h-[250px] shadow-sm">
                    <svg class="w-10 h-10 text-emerald-400 mb-4" fill="currentColor" viewBox="0 0 24 24"><path d="M4 4h16v2H4V4zm0 4h16v2H4V8zm0 4h16v2H4v-2zm0 4h16v2H4v-2z"></path></svg>
                    <h4 class="text-xl font-bold text-emerald-900 mb-2">Dokumentasi Lainnya</h4>
                    <p class="text-emerald-700/80 text-sm">Menyaksikan secara langsung perkembangan pesantren melalui galeri foto kami.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. Cara Membersamai Wakaf -->
    <section class="py-24 bg-slate-50 border-t border-slate-200 relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-100 rounded-full blur-3xl opacity-50 -translate-y-1/2 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-100 rounded-full blur-3xl opacity-50 translate-y-1/2 -translate-x-1/4"></div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white rounded-3xl p-8 md:p-16 shadow-xl border border-slate-100">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-extrabold text-slate-800 font-serif">Mari Menjadi Bagian Amal Jariyah</h2>
                    <p class="mt-4 text-slate-500 text-lg">Bukan tentang besarnya yang diberi, tapi tentang keikhlasan hati yang menyertai.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Transfer Bank -->
                    <div class="bg-emerald-50 rounded-2xl p-8 border border-emerald-100 flex flex-col justify-center">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-emerald-900">Transfer Rekening</h3>
                                <p class="text-emerald-700 text-sm">{{ $wakaf->bank_name ?? 'Bank Syariah Indonesia (BSI)' }}</p>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-4 mb-6 flex justify-between items-center border border-emerald-100">
                            <div>
                                <p class="text-xs text-slate-500 font-semibold mb-1 uppercase tracking-wider">No. Rekening</p>
                                <p class="text-2xl font-mono font-bold text-slate-800">{{ $wakaf->bank_account ?? '1234 5678 90' }}</p>
                                <p class="text-sm text-slate-600 mt-1">a.n. {{ $wakaf->bank_account_name ?? 'Yayasan Pesantren' }}</p>
                            </div>
                            <button class="text-emerald-600 hover:text-emerald-800 bg-emerald-50 hover:bg-emerald-100 p-2 rounded-lg transition-colors" title="Salin Rekening">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                            </button>
                        </div>
                        <a href="https://wa.me/{{ $wakaf->wa_contact ?? '' }}" target="_blank" class="w-full block text-center py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold transition-colors shadow-md shadow-emerald-500/20">
                            Konfirmasi Dukungan via WA
                        </a>
                    </div>

                    <!-- QRIS -->
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-sm font-semibold text-slate-500 uppercase tracking-widest mb-4">Atau Scan QRIS</p>
                        <div class="bg-white p-4 rounded-2xl shadow-md border border-slate-100 mb-6">
                            @if($wakaf && $wakaf->qris_image)
                            <img src="{{ asset('storage/' . $wakaf->qris_image) }}" alt="QRIS" class="w-48 h-48 object-contain">
                            @else
                            <!-- Placeholder QRIS -->
                            <div class="w-48 h-48 bg-slate-100 flex items-center justify-center border-2 border-dashed border-slate-300 rounded-xl text-slate-400">
                                <span class="text-sm text-center px-4">Gambar QRIS<br>Tampil di Sini</span>
                            </div>
                            @endif
                        </div>
                        <p class="text-slate-500 text-center text-sm">Mendukung semua aplikasi e-wallet & mobile banking.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. Ucapan Terima Kasih -->
    <section class="py-16 bg-white text-center px-4">
        <div class="max-w-3xl mx-auto">
            <h3 class="text-xl md:text-2xl font-medium text-emerald-800 mb-4 font-serif italic">
                "Jazakumullahu khairan katsiran..."
            </h3>
            <p class="text-slate-600 leading-relaxed text-lg">
                Kepada seluruh wali santri, tokoh masyarakat, dan para muhsinin yang telah membersamai perjuangan pendidikan pesantren. Semoga setiap dukungan yang diberikan dilipatgandakan pahalanya oleh Allah SWT, dan menjadi cahaya penerang di dunia hingga akhirat kelak.
            </p>
        </div>
    </section>

    <!-- 11. CTA Penutup -->
    <section class="bg-gradient-to-br from-emerald-900 to-emerald-800 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/arabesque.png')] opacity-10"></div>
        <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
            <h2 class="text-3xl md:text-5xl font-extrabold mb-6 font-serif">{{ $wakaf->closing_title ?? 'Menjaga Nyala Harapan Generasi' }}</h2>
            <div class="text-emerald-100 text-xl md:text-2xl font-light mb-10 prose prose-emerald prose-invert mx-auto">
                @if($wakaf && $wakaf->closing_content)
                    {!! $wakaf->closing_content !!}
                @else
                <p>Bersama membangun jembatan peradaban, mendidik pewaris kebaikan, dan menjaga panji dakwah Islam tetap tegak berdiri.</p>
                @endif
            </div>
            <a href="#program" class="inline-block px-10 py-4 bg-amber-500 hover:bg-amber-400 text-amber-950 rounded-full font-bold text-lg shadow-lg shadow-amber-500/30 transform transition duration-300 hover:-translate-y-1">
                Ikut Membersamai
            </a>
        </div>
    </section>


    <!-- MODALS & OVERLAYS -->

    <!-- Modal Sejarah Pesantren -->
    <div x-show="isHistoryModalOpen" 
         style="display: none;"
         class="fixed inset-0 z-50 overflow-y-auto" 
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
        
        <!-- Background overlay -->
        <div x-show="isHistoryModalOpen"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" 
             @click="isHistoryModalOpen = false"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <!-- Modal panel -->
            <div x-show="isHistoryModalOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-3xl border border-emerald-100">
                
                <!-- Modal Header Image -->
                <div class="h-48 bg-emerald-900 relative overflow-hidden">
                    <img src="{{ $wakaf && $wakaf->popup_history_image ? asset('storage/' . $wakaf->popup_history_image) : 'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80' }}" class="w-full h-full object-cover opacity-50 mix-blend-overlay">
                    <div class="absolute inset-0 bg-gradient-to-t from-white via-transparent to-transparent"></div>
                    <button @click="isHistoryModalOpen = false" class="absolute top-4 right-4 p-2 bg-white/20 hover:bg-white/40 backdrop-blur rounded-full text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="px-6 pb-8 pt-4 sm:px-10 sm:pb-12 bg-white relative">
                    <!-- Icon -->
                    <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 mx-auto -mt-12 mb-6 relative z-10 border-4 border-white shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>

                    <h3 class="text-3xl font-extrabold text-slate-800 text-center mb-6 font-serif" id="modal-title">{{ $wakaf->popup_history_title ?? 'Langkah Awal Perjuangan' }}</h3>
                    
                    <div class="prose prose-emerald max-w-none text-slate-600">
                        @if($wakaf && $wakaf->popup_history_content)
                            {!! $wakaf->popup_history_content !!}
                        @else
                        <p class="lead text-lg font-medium text-emerald-800 mb-6 text-center">
                            Berawal dari pengajian alif-ba-ta di surau sederhana, ikhtiar ini bermula.
                        </p>
                        <p>
                            Jauh sebelum berdiri kokoh seperti sekarang, pesantren ini meniti jalan panjang penuh peluh dan doa. Kegiatan belajar mengajar berawal dari Madrasah Diniyah Takmiliyah (MDT) dengan sarana yang sangat terbatas. Masyarakat dan pendiri saling bahu membahu, menyisihkan sebagian rezeki untuk mendirikan madrasah.
                        </p>
                        <p>
                            Saat itu, untuk menyelenggarakan pendidikan Madrasah Tsanawiyah (MTs), kami masih harus berstatus filial (menginduk/menumpang). Namun, semangat dakwah keluarga besar tak surut. Lewat musyawarah mufakat, peluh keringat gotong royong, dan tawakal penuh kepada Allah, pesantren ini perlahan menampakkan kemandiriannya.
                        </p>
                        <p>
                            Inilah hasil jerih payah para sesepuh, yang mewakafkan tanahnya, waktunya, dan pemikirannya. Kami yang hari ini meneruskan, mengemban amanah besar untuk menjaga agar obor pendidikan Islam ini tak pernah padam.
                        </p>
                        @endif
                    </div>

                    <div class="mt-10 text-center">
                        <a href="{{ route('profil.tokoh-pendiri') }}" class="inline-flex items-center justify-center px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-semibold shadow-md transition-colors w-full sm:w-auto">
                            Baca Sejarah Lengkap
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal untuk Gallery -->
    <div x-show="activeLightboxImage !== null" 
         style="display: none;"
         class="fixed inset-0 z-[60] flex items-center justify-center bg-black/90 backdrop-blur-sm p-4"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <button @click="activeLightboxImage = null" class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        
        <img :src="activeLightboxImage" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl" @click.away="activeLightboxImage = null">
    </div>

</div>
@endsection
