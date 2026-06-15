@extends('layouts.main')

@section('title', ($settings['travel_hero_title'] ?? 'Al-Ittihad Travel') . ' - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#FDFDFD] pt-12 pb-20 min-h-screen">
    
    <!-- 1. HERO SECTION (Premium Glassmorphism & Gold Accent) -->
    <section class="max-w-7xl mx-auto px-6 mb-16 relative animate-fade-in-up">
        <div class="bg-gradient-to-tr from-[#061f14] via-[#0b3c25] to-[#1c5d3e] rounded-[3rem] p-12 md:p-20 overflow-hidden relative shadow-2xl flex flex-col items-center text-center border-b-[8px] border-amber-500">
            
            @if(isset($settings['travel_hero_image']) && $settings['travel_hero_image'])
            <div class="absolute inset-0 opacity-20 mix-blend-overlay">
                <img src="{{ asset('storage/' . $settings['travel_hero_image']) }}" class="w-full h-full object-cover" alt="Background Al-Ittihad Travel">
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
                    <span>🚌</span> LAYANAN TRANSPORTASI RESMI
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 text-white tracking-tight leading-[1.1] drop-shadow-md">
                    {{ $settings['travel_hero_title'] ?? 'Al-Ittihad Travel & Transportasi' }}
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-amber-400 to-amber-600 mx-auto mb-6 rounded-full"></div>
                <p class="text-emerald-50/90 text-lg md:text-xl font-medium leading-relaxed max-w-2xl mx-auto drop-shadow-sm">
                    {{ $settings['travel_hero_subtitle'] ?? 'Layanan sewa armada Isuzu Elf Minibus Non-AC dan transportasi terpercaya untuk ziarah, study tour, dan antar-jemput santri.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- 2. INTRODUCING TRAVEL UNIT -->
    <section class="max-w-7xl mx-auto px-6 mb-20">
        <div class="bg-white rounded-[2.5rem] p-8 md:p-12 border border-slate-100 shadow-xl shadow-slate-200/30 flex flex-col lg:flex-row items-center gap-12">
            <!-- Left: Icon Card -->
            <div class="w-full lg:w-96 shrink-0 relative group">
                <div class="absolute inset-0 bg-gradient-to-tr from-amber-500 to-emerald-600 rounded-[2rem] blur-2xl opacity-15 group-hover:opacity-25 transition-opacity duration-500"></div>
                <div class="relative bg-gradient-to-b from-[#0b3321] to-[#051c12] rounded-[2rem] p-8 border border-emerald-500/20 text-white shadow-xl overflow-hidden aspect-video flex flex-col justify-between">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl"></div>
                    <div>
                        <span class="text-4xl mb-4 block">🚌</span>
                        <h3 class="text-2xl font-black text-amber-400 tracking-tight leading-none mb-2">Al-Ittihad Travel</h3>
                        <p class="text-emerald-100/70 text-xs font-medium uppercase tracking-widest">Koperasi Syariah Pesantren</p>
                    </div>
                    <div class="text-[10px] font-bold text-emerald-300 border-t border-emerald-800/60 pt-4 mt-6">
                        #KemandirianEkonomiPPI104
                    </div>
                </div>
            </div>
            
            <!-- Right: Text Description -->
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-8 h-1 bg-emerald-600 rounded-full"></span>
                    <span class="text-emerald-700 font-bold uppercase tracking-wider text-xs">Penyediaan Armada Terbaik</span>
                </div>
                <h2 class="text-2xl md:text-3xl font-black text-slate-800 mb-6 leading-tight">Transportasi Aman, Nyaman & Hemat</h2>
                <p class="text-slate-600 text-sm md:text-base leading-relaxed font-medium mb-6">
                    Al-Ittihad Travel merupakan salah satu unit usaha Koperasi Pondok Pesantren (Kopontren) PPI 104 Al-Ittihad Cikajang. Kami hadir untuk melayani kebutuhan transportasi rombongan santri, wali santri, asatidz, maupun masyarakat umum dengan armada yang prima, supir berpengalaman, dan harga yang sangat kompetitif.
                </p>
                <!-- Key Selling Points -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start gap-3">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span class="text-slate-700 text-xs md:text-sm font-semibold">Armada Prima & Rutin Servis</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span class="text-slate-700 text-xs md:text-sm font-semibold">Supir Santun & Berpengalaman</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span class="text-slate-700 text-xs md:text-sm font-semibold">Tarif Syariah Tanpa Biaya Tersembunyi</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-emerald-600 font-bold">✓</span>
                        <span class="text-slate-700 text-xs md:text-sm font-semibold">Mendukung Ekonomi Pesantren</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. VEHICLE LISTING GRID -->
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <div class="flex flex-col items-center mb-12 text-center">
            <span class="text-emerald-700 font-black text-xs uppercase tracking-[0.2em] mb-3">PILIHAN ARMADA</span>
            <h2 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight">Daftar Kendaraan & Paket Layanan</h2>
            <div class="w-16 h-1 bg-amber-500 rounded-full mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
            @forelse($settings['travel_items'] ?? [] as $item)
                @php
                    $waNumber = preg_replace('/[^0-9]/', '', $item['pic_phone'] ?? $settings['travel_cta_phone'] ?? '083822099034');
                    if (str_starts_with($waNumber, '0')) {
                        $waNumber = '62' . substr($waNumber, 1);
                    }
                    $waMsg = rawurlencode("Assalamu'alaikum Wr. Wb. Saya tertarik untuk menyewa armada/layanan: " . $item['name'] . ". Mohon info ketersediaan tanggal dan estimasi biaya sewanya.");
                @endphp
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 group overflow-hidden max-w-sm mx-auto w-full">
                    
                    <!-- Image Wrapper -->
                    <div class="h-60 bg-slate-50 relative overflow-hidden border-b border-slate-100">
                        @if(isset($item['image']) && $item['image'])
                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" alt="{{ $item['name'] }}">
                        @else
                            <!-- Fallback themed placeholder vehicle -->
                            <div class="w-full h-full flex flex-col items-center justify-center bg-emerald-50/50 text-emerald-800 p-4">
                                <span class="text-7xl mb-2 opacity-80">🚌</span>
                                <span class="text-[9px] font-black uppercase tracking-widest text-emerald-600/70">Al-Ittihad Travel</span>
                            </div>
                        @endif

                        <!-- Floating Feature Tag -->
                        <span class="absolute top-4 left-4 bg-emerald-950/80 text-amber-400 backdrop-blur-md font-black text-[9px] uppercase tracking-widest px-3.5 py-1.5 rounded-xl border border-amber-500/20">
                            Armada Aktif
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-black text-slate-800 mb-3 group-hover:text-emerald-700 transition-colors leading-tight">
                                {{ $item['name'] }}
                            </h3>
                            
                            <!-- Display Features Badge -->
                            @if(isset($item['features']) && $item['features'])
                                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-50 border border-slate-100 rounded-xl mb-4 w-full">
                                    <span class="text-xs text-amber-500">⚙️</span>
                                    <span class="text-xs text-slate-500 font-bold">Fasilitas:</span>
                                    <span class="text-xs text-slate-700 font-extrabold line-clamp-1">{{ $item['features'] }}</span>
                                </div>
                            @endif

                            <p class="text-slate-500 text-xs md:text-sm leading-relaxed font-medium mb-6">
                                {{ $item['description'] ?? 'Penyewaan minibus untuk kebutuhan pariwisata, ziarah wali, dan kegiatan sekolah santri.' }}
                            </p>
                        </div>

                        <!-- Price and CTA -->
                        <div class="pt-4 border-t border-slate-50">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Tarif</span>
                                <span class="text-base font-black text-emerald-800 font-sans">
                                    {{ $item['price'] }}
                                </span>
                            </div>
                            
                            <a 
                                href="https://wa.me/{{ $waNumber }}?text={{ $waMsg }}" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                class="w-full py-3 bg-emerald-600 hover:bg-emerald-500 text-white rounded-xl font-bold uppercase tracking-widest text-[10px] transition-all shadow-md shadow-emerald-600/10 hover:shadow-lg inline-flex items-center justify-center gap-2"
                            >
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z" /></svg>
                                <span>Pesan Sewa</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-slate-500 italic py-12">
                    Belum ada armada atau layanan travel yang dipublikasikan.
                </div>
            @endforelse
        </div>
    </section>

    <!-- 4. GENERAL CONSULTATION CTA -->
    <section class="max-w-6xl mx-auto px-6">
        <div class="bg-gradient-to-br from-[#051c12] to-[#0c3e27] rounded-[3.5rem] p-10 md:p-16 shadow-2xl relative overflow-hidden border-b-8 border-amber-500">
            
            <!-- Soft Decor -->
            <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-emerald-500/10 rounded-full blur-[80px] pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-amber-500/5 rounded-full blur-[60px] pointer-events-none"></div>
            
            <div class="relative z-10 text-center max-w-3xl mx-auto">
                <span class="text-4xl block mb-6 animate-bounce">💬</span>
                <h2 class="text-3xl md:text-4xl font-black text-white mb-4 tracking-tight">Ingin Konsultasi Rencana Perjalanan?</h2>
                <p class="text-emerald-100/90 text-sm md:text-base mb-10 font-medium leading-relaxed max-w-xl mx-auto">
                    Hubungi admin transportasi kami untuk menghitung estimasi biaya sewa, perencanaan rute ziarah, atau penjemputan rombongan santri secara kolektif.
                </p>
                
                @php
                    $waGeneralNumber = preg_replace('/[^0-9]/', '', $settings['travel_cta_phone'] ?? '083822099034');
                    if (str_starts_with($waGeneralNumber, '0')) {
                        $waGeneralNumber = '62' . substr($waGeneralNumber, 1);
                    }
                    $waGeneralMsg = rawurlencode("Assalamu'alaikum Wr. Wb. Saya ingin menanyakan penawaran tarif sewa mobil/travel Al-Ittihad Travel.");
                @endphp
                
                <a 
                    href="https://wa.me/{{ $waGeneralNumber }}?text={{ $waGeneralMsg }}" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="inline-flex items-center gap-3 bg-[#f59e0b] hover:bg-[#d97706] text-slate-950 font-black uppercase tracking-wider text-[11px] px-8 py-4.5 rounded-2xl shadow-2xl transition-all hover:scale-105 active:scale-95"
                    style="text-decoration: none;"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z" /></svg>
                    <span>{{ $settings['travel_cta_text'] ?? 'Hubungi Travel' }}</span>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection
