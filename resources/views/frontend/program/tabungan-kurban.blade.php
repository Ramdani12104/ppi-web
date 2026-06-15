@extends('layouts.main')

@section('title', ($settings['kurban_hero_title'] ?? 'Tabungan Kurban') . ' - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#FDFDFD] pt-24 pb-20 min-h-screen">
    
    <!-- 1. HERO SECTION (Premium Glassmorphism & Gold Accent) -->
    <section class="max-w-7xl mx-auto px-6 mb-24 relative animate-fade-in-up">
        <div class="bg-gradient-to-tr from-[#061f14] via-[#0b3c25] to-[#1c5d3e] rounded-[3rem] p-12 md:p-24 overflow-hidden relative shadow-2xl flex flex-col items-center text-center border-b-[8px] border-amber-500">
            
            @if(isset($settings['kurban_hero_image']) && $settings['kurban_hero_image'])
            <div class="absolute inset-0 opacity-25 mix-blend-overlay">
                <img src="{{ asset('storage/' . $settings['kurban_hero_image']) }}" class="w-full h-full object-cover" alt="Background Tabungan Kurban">
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
                    <span>🐏</span> IBADAH KURBAN TERBAIK
                </span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black mb-8 text-white tracking-tight leading-[1.1] drop-shadow-md">
                    {{ $settings['kurban_hero_title'] ?? 'Program Tabungan Kurban' }}
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-amber-400 to-amber-600 mx-auto mb-8 rounded-full"></div>
                <p class="text-emerald-50/90 text-lg md:text-xl font-medium leading-relaxed max-w-2xl mx-auto drop-shadow-sm">
                    {{ $settings['kurban_hero_subtitle'] ?? 'Persiapkan ibadah kurban terbaik Anda secara terencana, mudah, dan barokah bersama pesantren.' }}
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
                            🐏
                        </div>
                        <h3 class="text-3xl font-black tracking-tight leading-tight mb-4 text-amber-400">PPI 104 Al-Ittihad</h3>
                        <p class="text-emerald-100/80 text-sm leading-relaxed font-medium">
                            Membantu mewujudkan keistikomahan dalam melaksanakan ibadah kurban setiap tahunnya dengan perencanaan dana yang aman, tanpa biaya tambahan.
                        </p>
                    </div>
                    
                    <div class="relative z-10 border-t border-emerald-800/60 pt-6 mt-8 flex justify-between items-center text-xs">
                        <span class="text-amber-400/90 font-black uppercase tracking-widest">Amanah & Syariah</span>
                        <span class="text-emerald-300/80">#KurbanPesantren</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Content -->
            <div class="lg:col-span-7 flex flex-col justify-center">
                <div class="flex items-center gap-3 mb-6">
                    <span class="w-8 h-1 bg-emerald-600 rounded-full"></span>
                    <span class="text-emerald-700 font-bold uppercase tracking-wider text-sm">Kemudahan Berbagi</span>
                </div>
                <h2 class="text-3xl md:text-5xl font-black text-slate-800 mb-8 leading-tight">
                    {{ $settings['kurban_about_title'] ?? 'Mengenal Tabungan Kurban Pesantren' }}
                </h2>
                <div class="prose prose-lg text-slate-600 leading-relaxed font-medium">
                    {!! $settings['kurban_about_content'] ?? '<p>Program Tabungan Kurban bertujuan memfasilitasi santri, wali santri, dan jamaah dalam merencanakan kurban secara finansial dengan cara mencicil setiap bulan. Pembelian hewan kurban dikelola secara terpusat oleh pesantren untuk menjamin kualitas hewan dan ketepatan sasaran distribusi daging.</p>' !!}
                </div>
            </div>
        </div>
    </section>

    <!-- KEMITRAAN / PENYELENGGARA RESMI -->
    <section class="max-w-7xl mx-auto px-6 mb-24 relative">
        <div class="bg-gradient-to-r from-amber-50/60 to-emerald-50/40 rounded-[2.5rem] p-8 md:p-12 border border-amber-200/50 flex flex-col md:flex-row items-center gap-8 shadow-sm">
            @if(isset($settings['kurban_partner_logo']) && $settings['kurban_partner_logo'])
                <div class="w-32 h-32 md:w-40 md:h-40 shrink-0 bg-white rounded-2xl border border-amber-100 flex items-center justify-center p-4 shadow-inner">
                    <img src="{{ asset('storage/' . $settings['kurban_partner_logo']) }}" class="w-full h-full object-contain" alt="Logo {{ $settings['kurban_partner_name'] }}">
                </div>
            @else
                <!-- Fallback elegant text logo for Qurban Committee -->
                <div class="w-32 h-32 md:w-40 md:h-40 shrink-0 bg-[#0c3e27] rounded-2xl flex flex-col items-center justify-center text-center p-4 shadow-lg border border-amber-400">
                    <span class="text-[10px] font-black tracking-widest text-amber-400 uppercase">PANITIA</span>
                    <span class="text-xl font-black text-white uppercase mt-1 leading-none tracking-tight">KURBAN</span>
                    <span class="text-xs font-black text-amber-400 uppercase leading-none tracking-wider mt-1">PPI 104</span>
                </div>
            @endif
            
            <div class="flex-1 text-center md:text-left">
                <span class="inline-block px-3 py-1 bg-amber-100 text-amber-800 text-[10px] font-black uppercase tracking-widest rounded-lg mb-3">
                    {{ $settings['kurban_partner_title'] ?? 'Penyelenggara Resmi' }}
                </span>
                <h3 class="text-2xl font-black text-slate-800 mb-4">{{ $settings['kurban_partner_name'] ?? 'Panitia Kurban PPI 104 Al-Ittihad' }}</h3>
                <p class="text-slate-600 text-sm md:text-base leading-relaxed font-medium">
                    {{ $settings['kurban_partner_description'] ?? 'Ibadah kurban Anda akan dikelola secara penuh oleh Panitia Kurban Pesantren Al-Ittihad Cikajang. Mulai dari pemilihan hewan yang sehat dan sesuai syariat, pemeliharaan, hingga proses penyembelihan dan pendistribusian daging kurban kepada yang berhak di sekitar lingkungan pesantren.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- 3. PILIHAN SKEMA / PAKET TABUNGAN (Elegant Pricing/Scheme Cards) -->
    <section class="max-w-7xl mx-auto px-6 mb-28">
        <div class="flex flex-col items-center mb-16 text-center">
            <span class="text-amber-600 font-black text-xs uppercase tracking-[0.2em] mb-4">PILIHAN TERBAIK</span>
            <h2 class="text-3xl md:text-5xl font-black text-slate-800 tracking-tight">Skema Setoran Kurban Fleksibel</h2>
            <div class="w-16 h-1.5 bg-amber-500 rounded-full mt-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($settings['kurban_packages'] ?? [] as $package)
            @php
                $isPopular = str_contains(strtolower($package['name']), 'sapi') || str_contains(strtolower($package['name']), 'patungan');
                $waNumber = preg_replace('/[^0-9]/', '', $settings['kurban_cta_whatsapp'] ?? '083822099034');
                if (str_starts_with($waNumber, '0')) {
                    $waNumber = '62' . substr($waNumber, 1);
                }
                $waMsg = rawurlencode("Assalamu'alaikum Wr. Wb. Saya berminat untuk mendaftar Program Tabungan Kurban dengan skema: " . $package['name'] . " (" . $package['amount'] . "). Mohon info langkah selanjutnya.");
            @endphp
            <div class="bg-white rounded-[2.5rem] p-8 md:p-10 border transition-all duration-300 flex flex-col relative overflow-hidden group hover:shadow-2xl hover:-translate-y-2
                {{ $isPopular ? 'border-amber-400 shadow-xl shadow-emerald-950/5' : 'border-slate-100 shadow-lg shadow-slate-100' }}">
                
                @if($isPopular)
                <div class="absolute top-0 right-0 bg-amber-500 text-slate-900 font-black text-[9px] uppercase tracking-widest px-6 py-2 rounded-bl-2xl">
                    ⭐ Paling Diminati
                </div>
                @endif

                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/5 to-amber-500/5 rounded-bl-full transition-transform duration-500 group-hover:scale-150 pointer-events-none"></div>
                
                <div class="relative z-10 flex-1 flex flex-col">
                    <span class="text-emerald-700 font-black text-[10px] uppercase tracking-widest bg-emerald-50 border border-emerald-100/50 px-3.5 py-2 rounded-xl mb-6 inline-block w-fit">
                        {{ $package['target_period'] ?? 'Skema Mandiri' }}
                    </span>
                    <h3 class="text-xl md:text-2xl font-black text-slate-800 mb-4">{{ $package['name'] }}</h3>
                    <div class="text-2xl md:text-4xl font-black text-emerald-800 mb-6 font-mono leading-none tracking-tight">
                        {{ $package['amount'] }}
                    </div>
                    <div class="w-full h-px bg-slate-100 mb-6"></div>
                    <p class="text-slate-500 text-sm leading-relaxed mb-8 flex-1">{{ $package['features'] }}</p>
                    
                    <a 
                        href="https://wa.me/{{ $waNumber }}?text={{ $waMsg }}" 
                        target="_blank" 
                        rel="noopener noreferrer"
                        class="w-full py-4 text-center rounded-2xl font-bold uppercase tracking-widest text-[11px] transition-all
                        {{ $isPopular ? 'bg-emerald-600 hover:bg-emerald-500 text-white shadow-lg shadow-emerald-600/20' : 'bg-slate-50 hover:bg-emerald-600 hover:text-white text-slate-700 border border-slate-200 hover:border-emerald-600' }}"
                    >
                        Mulai Menabung
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center text-slate-500 italic">
                Belum ada skema setoran kurban yang dipublikasikan.
            </div>
            @endforelse
        </div>
    </section>

    <!-- 4. ALUR & CARA MENDAFTAR (Timeline UI Design) -->
    <section class="max-w-7xl mx-auto px-6 mb-28">
        <div class="bg-gradient-to-b from-[#F8FAFC] to-[#F1F5F9] rounded-[3rem] p-10 md:p-20 border border-slate-200/40 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500/5 rounded-full blur-3xl pointer-events-none"></div>
            
            <div class="text-center mb-20">
                <span class="text-emerald-600 font-bold uppercase tracking-widest text-xs">PANDUAN ALUR</span>
                <h2 class="text-3xl md:text-5xl font-black text-slate-800 mt-2">Langkah Mudah Berkurban</h2>
                <p class="text-slate-500 max-w-2xl mx-auto mt-4 font-medium">Ikuti 3 langkah mudah di bawah ini untuk mengawali kepemilikan kurban tahunan Anda.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                @forelse($settings['kurban_steps'] ?? [] as $index => $step)
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
                    Belum ada alur pendaftaran yang dipublikasikan.
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 4.5 TESTIMONI PESERTA (Premium Testimonials Section) -->
    @if(isset($settings['kurban_testimonials']) && count($settings['kurban_testimonials']) > 0)
    <section class="max-w-7xl mx-auto px-6 mb-28">
        <div class="flex flex-col items-center mb-16 text-center">
            <span class="text-emerald-700 font-black text-xs uppercase tracking-[0.2em] mb-4">TESTIMONI</span>
            <h2 class="text-3xl md:text-5xl font-black text-slate-800 tracking-tight">Kisah Sukses Peserta</h2>
            <p class="text-slate-500 max-w-2xl mx-auto mt-4 font-medium">Dengarkan pengalaman asatidz, wali santri, dan jamaah yang terbantu merencanakan ibadah kurban terbaiknya secara rutin.</p>
            <div class="w-16 h-1.5 bg-amber-500 rounded-full mt-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($settings['kurban_testimonials'] as $testimonial)
            <div class="bg-gradient-to-tr from-slate-50 to-white rounded-[2rem] p-8 md:p-10 border border-slate-100 shadow-xl shadow-slate-100 flex flex-col justify-between hover:shadow-2xl transition-all duration-300">
                <p class="text-slate-600 italic text-sm md:text-base leading-relaxed mb-8 font-medium">
                    "{{ $testimonial['quote'] }}"
                </p>
                <div class="flex items-center gap-4">
                    @if(isset($testimonial['avatar']) && $testimonial['avatar'])
                        <img src="{{ asset('storage/' . $testimonial['avatar']) }}" class="w-12 h-12 rounded-full object-cover border-2 border-emerald-500 shadow-md" alt="{{ $testimonial['name'] }}">
                    @else
                        <div class="w-12 h-12 bg-emerald-700 rounded-full flex items-center justify-center font-black text-white text-base shadow-md">
                            {{ strtoupper(substr($testimonial['name'], 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <h4 class="text-slate-800 font-bold text-base">{{ $testimonial['name'] }}</h4>
                        <p class="text-emerald-700 text-[10px] font-black uppercase tracking-widest mt-1">{{ $testimonial['status'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- 5. CTA PENUTUP (Glowing Islamic Card Template) -->
    <section class="max-w-6xl mx-auto px-6">
        <div class="bg-gradient-to-br from-[#051c12] to-[#0c3e27] rounded-[3.5rem] p-10 md:p-20 shadow-2xl relative overflow-hidden border-b-8 border-amber-500">
            
            <!-- Soft Decor -->
            <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-emerald-500/10 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-amber-500/5 rounded-full blur-[60px] pointer-events-none"></div>
            
            <div class="relative z-10 text-center max-w-3xl mx-auto">
                <span class="text-4xl block mb-6 animate-bounce">🐏</span>
                <h2 class="text-3xl md:text-5xl font-black text-white mb-6 tracking-tight">Rencanakan Kurban Terbaik Anda Sekarang</h2>
                <p class="text-emerald-100/95 text-lg md:text-xl mb-12 font-medium leading-relaxed max-w-2xl mx-auto">
                    Mari sambut hari raya Idul Adha berikutnya dengan kesiapan kurban yang prima. Konsultasikan pilihan paket dan nominal setoran terbaik Anda.
                </p>
                
                @php
                    $waNumber = preg_replace('/[^0-9]/', '', $settings['kurban_cta_whatsapp'] ?? '083822099034');
                    if (str_starts_with($waNumber, '0')) {
                        $waNumber = '62' . substr($waNumber, 1);
                    }
                    $waText = rawurlencode("Assalamu'alaikum Wr. Wb. Saya ingin berkonsultasi mengenai pendaftaran Program Tabungan Kurban PPI 104 Al-Ittihad.");
                @endphp
                
                <a 
                    href="https://wa.me/{{ $waNumber }}?text={{ $waText }}" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="inline-flex items-center gap-3 bg-[#f59e0b] hover:bg-[#d97706] text-slate-950 font-black uppercase tracking-wider text-xs px-10 py-5 rounded-2xl shadow-2xl transition-all hover:scale-105 active:scale-95"
                    style="text-decoration: none;"
                >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z" /></svg>
                    <span>{{ $settings['kurban_cta_text'] ?? 'Hubungi Admin Kurban' }}</span>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
