@extends('layouts.main')

@section('title', 'Kisah & Jejak Alumni - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#FDFDFD] pt-12 pb-20 min-h-screen">
    
    <!-- 1. HERO SECTION (Premium Glassmorphism & Gold Accent) -->
    <section class="max-w-7xl mx-auto px-6 mb-16 relative">
        <div class="bg-gradient-to-tr from-[#061f14] via-[#0b3c25] to-[#1c5d3e] rounded-[3rem] p-12 md:p-20 overflow-hidden relative shadow-2xl flex flex-col items-center text-center border-b-[8px] border-amber-500">
            <!-- Geometric Islamic Pattern Overlay -->
            <div class="absolute inset-0 opacity-10 mix-blend-overlay" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 40px 40px;"></div>
            
            <!-- Soft Glowing Decors -->
            <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-amber-400/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] bg-emerald-400/20 rounded-full blur-[100px] pointer-events-none"></div>
            
            <div class="relative z-10 max-w-4xl">
                <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500/10 border border-amber-400/30 text-amber-300 backdrop-blur-md rounded-full font-black text-xs tracking-[0.3em] uppercase mb-8 shadow-lg">
                    <span>🎓</span> KIPRAH & JEJAK ALUMNI
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 text-white tracking-tight leading-[1.1] drop-shadow-md">
                    Jejak Alumni & Kisah Sukses
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-amber-400 to-amber-600 mx-auto mb-6 rounded-full"></div>
                <p class="text-emerald-50/90 text-lg md:text-xl font-medium leading-relaxed max-w-2xl mx-auto drop-shadow-sm">
                    Menelusuri jejak pengabdian dan kiprah para alumni Pesantren Persatuan Islam 104 Al-Ittihad Cikajang di berbagai penjuru dunia.
                </p>
            </div>
        </div>
    </section>

    <!-- 2. STATISTIK ANGKATAN & KELULUSAN -->
    <section class="max-w-7xl mx-auto px-6 mb-20">
        <div class="bg-white rounded-[2.5rem] p-8 md:p-12 border border-slate-100 shadow-xl shadow-slate-200/30">
            <div class="flex flex-col items-center mb-10 text-center">
                <span class="text-emerald-700 font-black text-xs uppercase tracking-[0.2em] mb-2">REKAPITULASI SEJARAH</span>
                <h2 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight">Statistik Kelulusan per Jenjang</h2>
                <div class="w-12 h-1 bg-amber-500 rounded-full mt-3"></div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1: Total Alumni -->
                <div class="bg-gradient-to-b from-[#0b3321] to-[#051c12] rounded-[2rem] p-6 border border-emerald-500/20 text-white relative overflow-hidden shadow-lg flex flex-col justify-between min-h-[160px]">
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-500/10 rounded-full blur-xl"></div>
                    <div>
                        <span class="text-3xl mb-2 block">👥</span>
                        <h4 class="text-[10px] font-bold text-emerald-300 uppercase tracking-widest leading-none mb-1">Total Lulusan</h4>
                        <p class="text-2xl font-black text-amber-400 tracking-tight">3.500+ Alumni</p>
                    </div>
                    <p class="text-[10px] text-emerald-100/60 font-medium border-t border-emerald-800/60 pt-3 mt-4">Tersebar di dalam & luar negeri</p>
                </div>

                <!-- Card 2: Madrasah Aliyah (MA) -->
                <div class="bg-gradient-to-b from-[#0b3321] to-[#051c12] rounded-[2rem] p-6 border border-emerald-500/20 text-white relative overflow-hidden shadow-lg flex flex-col justify-between min-h-[160px]">
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-500/10 rounded-full blur-xl"></div>
                    <div>
                        <span class="text-3xl mb-2 block">🎓</span>
                        <h4 class="text-[10px] font-bold text-emerald-300 uppercase tracking-widest leading-none mb-1">Madrasah Aliyah</h4>
                        <p class="text-2xl font-black text-white tracking-tight">25+ Angkatan</p>
                    </div>
                    <p class="text-[10px] text-emerald-100/60 font-medium border-t border-emerald-800/60 pt-3 mt-4">Mencetak kader sejak tahun 1994</p>
                </div>

                <!-- Card 3: Madrasah Tsanawiyah (MTs) -->
                <div class="bg-gradient-to-b from-[#0b3321] to-[#051c12] rounded-[2rem] p-6 border border-emerald-500/20 text-white relative overflow-hidden shadow-lg flex flex-col justify-between min-h-[160px]">
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-500/10 rounded-full blur-xl"></div>
                    <div>
                        <span class="text-3xl mb-2 block">🕌</span>
                        <h4 class="text-[10px] font-bold text-emerald-300 uppercase tracking-widest leading-none mb-1">Madrasah Tsanawiyah</h4>
                        <p class="text-2xl font-black text-white tracking-tight">35+ Angkatan</p>
                    </div>
                    <p class="text-[10px] text-emerald-100/60 font-medium border-t border-emerald-800/60 pt-3 mt-4">Melayani dakwah sejak tahun 1980-an</p>
                </div>

                <!-- Card 4: Studi Lanjut -->
                <div class="bg-gradient-to-b from-[#0b3321] to-[#051c12] rounded-[2rem] p-6 border border-emerald-500/20 text-white relative overflow-hidden shadow-lg flex flex-col justify-between min-h-[160px]">
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-500/10 rounded-full blur-xl"></div>
                    <div>
                        <span class="text-3xl mb-2 block">✈️</span>
                        <h4 class="text-[10px] font-bold text-emerald-300 uppercase tracking-widest leading-none mb-1">Studi Lanjut</h4>
                        <p class="text-2xl font-black text-amber-400 tracking-tight">Global & PTN</p>
                    </div>
                    <p class="text-[10px] text-emerald-100/60 font-medium border-t border-emerald-800/60 pt-3 mt-4">Timur Tengah, Al-Azhar, & PTN Nasional</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. ALUMNI DIRECTORY GRID -->
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <div class="flex flex-col items-center mb-12 text-center">
            <span class="text-emerald-700 font-black text-xs uppercase tracking-[0.2em] mb-3">GALERI TESTIMONI</span>
            <h2 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight">Kisah Perjalanan & Inspirasi</h2>
            <div class="w-16 h-1 bg-amber-500 rounded-full mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
            @forelse($alumni as $item)
                @php
                    $avatarUrl = $item->avatar 
                        ? asset('storage/' . $item->avatar) 
                        : 'https://ui-avatars.com/api/?name=' . urlencode($item->name) . '&background=047857&color=fff&size=150&bold=true';
                @endphp
                <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 group overflow-hidden max-w-sm mx-auto w-full animate-fade-in-up">
                    
                    <!-- Top Grafis Card (EGS Style) -->
                    <div class="p-8 bg-gradient-to-br from-emerald-800 to-teal-950 text-white text-center flex flex-col items-center justify-center relative overflow-hidden border-b-4 border-amber-500">
                        <!-- Badge -->
                        <span class="bg-white text-emerald-950 px-3.5 py-1 rounded-full text-[9px] font-black uppercase tracking-wider mb-4 shadow-md">
                            ALUMNI PPI 104
                        </span>
                        
                        <!-- Circular Avatar -->
                        <div class="w-24 h-24 rounded-full border-4 border-white overflow-hidden shadow-xl mb-4 bg-white shrink-0">
                            <img src="{{ $avatarUrl }}" class="w-full h-full object-cover" alt="{{ $item->name }}">
                        </div>

                        <!-- Name & Batch -->
                        <h3 class="text-base font-black uppercase tracking-tight text-white leading-tight mb-2 truncate w-full">
                            {{ $item->name }}
                        </h3>
                        <p class="text-emerald-300 text-[10px] font-bold uppercase tracking-wider truncate w-full">
                            {{ $item->status }}
                        </p>
                    </div>

                    <!-- Testimonial Quote Balloon -->
                    <div class="p-6 bg-white flex-1 flex flex-col justify-between">
                        <div class="relative">
                            <span class="text-emerald-700/10 text-5xl font-serif absolute -top-4 -left-2 select-none pointer-events-none">“</span>
                            <p class="text-slate-600 text-xs md:text-sm italic leading-relaxed font-medium pl-4 relative z-10 border-l-2 border-emerald-500/30">
                                {{ $item->quote }}
                            </p>
                        </div>
                        
                        <!-- Little branding dot -->
                        <div class="text-right mt-6 text-[10px] font-bold text-slate-300 uppercase tracking-widest">
                            ✨ PPI 104
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-slate-500 italic py-12">
                    Belum ada data kisah perjalanan alumni yang dipublikasikan.
                </div>
            @endforelse
        </div>
    </section>

</div>
@endsection
