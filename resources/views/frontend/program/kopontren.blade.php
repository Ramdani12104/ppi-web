@extends('layouts.main')

@section('title', ($settings['kopontren_hero_title'] ?? 'Kopontren') . ' - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#FDFDFD] pt-24 pb-20 min-h-screen">
    
    <!-- 1. HERO SECTION (Premium Glassmorphism & Gold Accent) -->
    <section class="max-w-7xl mx-auto px-6 mb-24 relative animate-fade-in-up">
        <div class="bg-gradient-to-tr from-[#061f14] via-[#0b3c25] to-[#1c5d3e] rounded-[3rem] p-12 md:p-24 overflow-hidden relative shadow-2xl flex flex-col items-center text-center border-b-[8px] border-amber-500">
            
            @if(isset($settings['kopontren_hero_image']) && $settings['kopontren_hero_image'])
            <div class="absolute inset-0 opacity-25 mix-blend-overlay">
                <img src="{{ asset('storage/' . $settings['kopontren_hero_image']) }}" class="w-full h-full object-cover" alt="Background Kopontren">
            </div>
            @else
            <!-- Geometric Islamic Pattern Overlay -->
            <div class="absolute inset-0 opacity-10 mix-blend-overlay" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 40px 40px;"></div>
            @endif
            
            <!-- Soft Glowing Decors -->
            <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-amber-400/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] bg-emerald-400/20 rounded-full blur-[100px] pointer-events-none"></div>
            
            <div class="relative z-10 max-w-4xl">
                <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500/10 border border-amber-400/30 text-amber-300 backdrop-blur-md rounded-full font-black text-xs tracking-[0.3em] uppercase mb-8 shadow-lg">
                    <span>🏢</span> KEMANDIRIAN EKONOMI UMUR
                </span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black mb-8 text-white tracking-tight leading-[1.1] drop-shadow-md">
                    {{ $settings['kopontren_hero_title'] ?? 'Koperasi Pondok Pesantren' }}
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-amber-400 to-amber-600 mx-auto mb-8 rounded-full"></div>
                <p class="text-emerald-50/90 text-lg md:text-xl font-medium leading-relaxed max-w-2xl mx-auto drop-shadow-sm">
                    {{ $settings['kopontren_hero_subtitle'] ?? 'Mewujudkan kemandirian ekonomi pesantren dan pelayanan kebutuhan santri secara syariah dan barokah.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- 2. TENTANG PROGRAM (Interactive Two-Column Layout) -->
    <section class="max-w-7xl mx-auto px-6 mb-28">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Side: Graphic Card -->
            <div class="lg:col-span-5 relative group">
                <div class="absolute inset-0 bg-gradient-to-tr from-amber-500 to-emerald-600 rounded-[2.5rem] blur-2xl opacity-20 group-hover:opacity-30 transition-opacity duration-500"></div>
                <div class="relative bg-gradient-to-b from-[#0b3321] to-[#051c12] rounded-[2.5rem] p-10 border border-emerald-500/20 text-white shadow-xl overflow-hidden flex flex-col justify-between aspect-[4/5] min-h-[380px]">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-emerald-500/10 rounded-full blur-2xl"></div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center text-3xl shadow-lg border border-white/20 mb-8">
                            🏢
                        </div>
                        <h3 class="text-3xl font-black tracking-tight leading-tight mb-4 text-amber-400">Kopontren Al-Ittihad</h3>
                        <p class="text-emerald-100/80 text-sm leading-relaxed font-medium">
                            Menyediakan berbagai unit pelayanan terpadu bagi warga pesantren serta menumbuhkan jiwa wirausaha syariah bagi segenap santri.
                        </p>
                    </div>
                    
                    <div class="relative z-10 border-t border-emerald-800/60 pt-6 mt-8 flex justify-between items-center text-xs">
                        <span class="text-amber-400/90 font-black uppercase tracking-widest">Koperasi Syariah</span>
                        <span class="text-emerald-300/80">#KopontrenPPI104</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="lg:col-span-7 flex flex-col justify-center">
                <div class="flex items-center gap-3 mb-6">
                    <span class="w-8 h-1 bg-emerald-600 rounded-full"></span>
                    <span class="text-emerald-700 font-bold uppercase tracking-wider text-sm">Unit Usaha Pondok</span>
                </div>
                <h2 class="text-3xl md:text-5xl font-black text-slate-800 mb-8 leading-tight">
                    {{ $settings['kopontren_about_title'] ?? 'Mengenal Kopontren Al-Ittihad' }}
                </h2>
                <div class="prose prose-lg text-slate-600 leading-relaxed font-medium">
                    {!! $settings['kopontren_about_content'] ?? '<p>Koperasi Pondok Pesantren (Kopontren) PPI 104 Al-Ittihad didirikan sebagai wujud komitmen pesantren dalam membangun ekosistem ekonomi yang mandiri. Melalui unit-unit usaha yang dikelola, kami berupaya melayani kebutuhan seluruh santri, wali santri, dan asatidz dengan pelayanan prima yang berlandaskan prinsip tolong-menolong (ta\'awun) dan bebas dari riba.</p>' !!}
                </div>
            </div>
        </div>
    </section>

    <!-- 3. UNIT & LAYANAN USAHA (Premium Grid & Contact Person) -->
    <section class="max-w-7xl mx-auto px-6 mb-28">
        <div class="flex flex-col items-center mb-16 text-center">
            <span class="text-amber-600 font-black text-xs uppercase tracking-[0.2em] mb-4">LAYANAN TERPADU</span>
            <h2 class="text-3xl md:text-5xl font-black text-slate-800 tracking-tight">Unit Usaha Yang Dikelola</h2>
            <div class="w-16 h-1.5 bg-amber-500 rounded-full mt-6"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            @forelse($settings['kopontren_packages'] ?? [] as $package)
            @php
                $waNumber = preg_replace('/[^0-9]/', '', $package['pic_phone'] ?? '083822099034');
                if (str_starts_with($waNumber, '0')) {
                    $waNumber = '62' . substr($waNumber, 1);
                }
                $waMsg = rawurlencode("Assalamu'alaikum Wr. Wb. Saya ingin menghubungi penanggung jawab unit: " . $package['name'] . ". Mohon informasinya.");
            @endphp
            <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col md:flex-row gap-8 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 group relative overflow-hidden">
                <!-- Decorative background light -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/5 to-amber-500/5 rounded-bl-full pointer-events-none"></div>
                
                <!-- Image Section -->
                <div class="w-full md:w-48 h-48 shrink-0 rounded-2xl overflow-hidden bg-slate-50 border border-slate-100 relative">
                    @if(isset($package['image']) && $package['image'])
                        <img src="{{ asset('storage/' . $package['image']) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" alt="{{ $package['name'] }}">
                    @else
                        <!-- Themed Placeholder Icon based on unit name -->
                        <div class="w-full h-full flex flex-col items-center justify-center bg-emerald-50 text-emerald-800 text-center p-4">
                            @if(str_contains(strtolower($package['name']), 'kantin') || str_contains(strtolower($package['name']), 'toko'))
                                <span class="text-5xl mb-2">🍽️</span>
                            @elseif(str_contains(strtolower($package['name']), 'water') || str_contains(strtolower($package['name']), 'air'))
                                <span class="text-5xl mb-2">💧</span>
                            @elseif(str_contains(strtolower($package['name']), 'seragam') || str_contains(strtolower($package['name']), 'atribut'))
                                <span class="text-5xl mb-2">👕</span>
                            @elseif(str_contains(strtolower($package['name']), 'travel') || str_contains(strtolower($package['name']), 'ziarah'))
                                <span class="text-5xl mb-2">🚌</span>
                            @else
                                <span class="text-5xl mb-2">🏢</span>
                            @endif
                            <span class="text-[9px] font-black uppercase tracking-widest text-emerald-600/70">Kopontren 104</span>
                        </div>
                    @endif
                </div>

                <!-- Content Section -->
                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="text-2xl font-black text-slate-800 mb-3 group-hover:text-emerald-700 transition-colors">{{ $package['name'] }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-4 font-medium">{{ $package['description'] ?? '' }}</p>
                        
                        <!-- PIC Section -->
                        <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-50 border border-slate-100 rounded-xl mb-6">
                            <span class="text-emerald-600 text-xs">👤</span>
                            <span class="text-xs text-slate-500 font-bold">Penanggung Jawab:</span>
                            <span class="text-xs text-slate-700 font-extrabold">{{ $package['pic_name'] ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Buttons Row -->
                    <div class="flex flex-wrap items-center gap-3 mt-4">
                        <!-- Primary CTA (WhatsApp) -->
                        <a 
                            href="https://wa.me/{{ $waNumber }}?text={{ $waMsg }}" 
                            target="_blank" 
                            rel="noopener noreferrer"
                            class="px-6 py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl font-bold uppercase tracking-widest text-[10px] transition-all shadow-md shadow-emerald-600/10 hover:shadow-lg inline-flex items-center gap-2"
                        >
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z" /></svg>
                            <span>{{ $package['cta_text'] ?? 'Hubungi Kami' }}</span>
                        </a>

                        <!-- Secondary CTA (If cta_link is filled, e.g. Lihat Katalog / Detail) -->
                        @if(isset($package['cta_link']) && $package['cta_link'])
                            @php
                                $isSeragam = str_contains(strtolower($package['name']), 'seragam');
                                $isTravel = str_contains(strtolower($package['name']), 'travel');
                                $secondBtnText = 'Lihat Info';
                                if ($isSeragam) {
                                    $secondBtnText = 'Lihat Katalog';
                                } elseif ($isTravel) {
                                    $secondBtnText = 'Lihat Detail';
                                }
                            @endphp
                            <a 
                                href="{{ $package['cta_link'] }}" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                class="px-6 py-3.5 bg-slate-50 hover:bg-emerald-50 text-slate-700 hover:text-emerald-800 border border-slate-200 hover:border-emerald-200 rounded-xl font-bold uppercase tracking-widest text-[10px] transition-all inline-flex items-center gap-1.5"
                            >
                                <span>📄</span>
                                <span>{{ $secondBtnText }}</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-2 text-center text-slate-500 italic">
                Belum ada unit usaha kopontren yang dipublikasikan.
            </div>
            @endforelse
        </div>
    </section>

    <!-- 4. ALUR KEANGGOTAAN (Timeline UI Design) -->
    <section class="max-w-7xl mx-auto px-6 mb-28">
        <div class="bg-gradient-to-b from-[#F8FAFC] to-[#F1F5F9] rounded-[3rem] p-10 md:p-20 border border-slate-200/40 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="text-center mb-20">
                <span class="text-emerald-600 font-bold uppercase tracking-widest text-xs">PANDUAN ANGGOTA</span>
                <h2 class="text-3xl md:text-5xl font-black text-slate-800 mt-2">Langkah Menjadi Anggota</h2>
                <p class="text-slate-500 max-w-2xl mx-auto mt-4 font-medium">Ikuti 3 tahapan utama di bawah ini untuk bergabung menjadi bagian dari keanggotaan koperasi syariah pesantren.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                @forelse($settings['kopontren_steps'] ?? [] as $index => $step)
                <div class="bg-white rounded-[2rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 flex flex-col relative group hover:shadow-2xl hover:-translate-y-1 transition-all">
                    
                    <!-- Floating Step Indicator -->
                    <div class="w-14 h-14 bg-gradient-to-br from-[#0c3e27] to-emerald-700 text-amber-400 font-black text-xl flex items-center justify-center rounded-2xl mb-8 shadow-lg group-hover:scale-110 transition-transform duration-300">
                        {{ $step['step_number'] }}
                    </div>
                    
                    <h4 class="font-black text-slate-800 text-lg mb-4 uppercase tracking-tight">{{ $step['title'] }}</h4>
                    <p class="text-slate-500 text-sm leading-relaxed font-medium">{{ $step['description'] }}</p>
                </div>
                @empty
                <div class="col-span-3 text-center text-slate-500 italic">
                    Belum ada alur keanggotaan yang dipublikasikan.
                </div>
                @endforelse
            </div>
        </div>
    </section>

</div>
@endsection
