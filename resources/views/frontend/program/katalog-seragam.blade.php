@extends('layouts.main')

@section('title', ($settings['seragam_hero_title'] ?? 'Katalog Seragam & Atribut') . ' - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#FDFDFD] pt-12 pb-20 min-h-screen">
    
    <!-- 1. HERO SECTION (Premium Glassmorphism & Gold Accent) -->
    <section class="max-w-7xl mx-auto px-6 mb-16 relative animate-fade-in-up">
        <div class="bg-gradient-to-tr from-[#061f14] via-[#0b3c25] to-[#1c5d3e] rounded-[3rem] p-12 md:p-20 overflow-hidden relative shadow-2xl flex flex-col items-center text-center border-b-[8px] border-amber-500">
            
            @if(isset($settings['seragam_hero_image']) && $settings['seragam_hero_image'])
            <div class="absolute inset-0 opacity-20 mix-blend-overlay">
                <img src="{{ asset('storage/' . $settings['seragam_hero_image']) }}" class="w-full h-full object-cover" alt="Background Katalog Seragam">
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
                    <span>👕</span> ATRIBUT & SERAGAM RESMI
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 text-white tracking-tight leading-[1.1] drop-shadow-md">
                    {{ $settings['seragam_hero_title'] ?? 'Katalog Seragam & Atribut Resmi' }}
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-amber-400 to-amber-600 mx-auto mb-6 rounded-full"></div>
                <p class="text-emerald-50/90 text-lg md:text-xl font-medium leading-relaxed max-w-2xl mx-auto drop-shadow-sm">
                    {{ $settings['seragam_hero_subtitle'] ?? 'Daftar perlengkapan pakaian, seragam batik, jas almamater, dan atribut kepanduan resmi santri PPI 104 Al-Ittihad.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- 2. FILTER & SEARCH CONTROLS (Category & Jenjang) -->
    <section class="max-w-7xl mx-auto px-6 mb-12">
        <div class="bg-white rounded-[2rem] p-6 md:p-8 border border-slate-100 shadow-xl shadow-slate-200/30 flex flex-col gap-6">
            
            <!-- Search & Category Row -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 pb-6 border-b border-slate-100">
                <!-- Search Input -->
                <div class="relative w-full lg:w-96">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                        🔍
                    </span>
                    <input 
                        type="text" 
                        id="search-input" 
                        placeholder="Cari pakaian atau atribut..."
                        class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 focus:border-emerald-600 focus:bg-white focus:outline-none rounded-2xl font-medium text-slate-700 transition-all placeholder-slate-400"
                    >
                </div>

                <!-- Filter Kategori -->
                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-xs font-black uppercase text-slate-400 tracking-wider">Kategori:</span>
                    <div class="flex flex-wrap gap-2">
                        @php
                            $categories = ['Semua', 'Seragam Utama', 'Batik Pesantren', 'Olahraga', 'Atribut & Aksesoris'];
                        @endphp
                        @foreach($categories as $category)
                            <button 
                                type="button" 
                                data-category-target="{{ $category }}"
                                class="filter-btn px-4 py-2 rounded-xl font-bold uppercase tracking-wider text-[10px] md:text-xs transition-all duration-300 shadow-sm
                                {{ $category === 'Semua' 
                                    ? 'bg-emerald-700 text-white shadow-lg shadow-emerald-700/25' 
                                    : 'bg-white hover:bg-emerald-50 text-slate-600 border border-slate-100 hover:border-emerald-100' }}"
                            >
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Filter Jenjang Sekolah -->
            <div class="flex flex-wrap items-center gap-3">
                <span class="text-xs font-black uppercase text-slate-400 tracking-wider">Jenjang Sekolah:</span>
                <div class="flex flex-wrap gap-2">
                    @php
                        $levels_filter = ['Semua', 'MA', 'MTs', 'SDIT', 'MDT', 'TK', 'PAUD'];
                    @endphp
                    @foreach($levels_filter as $level)
                        <button 
                            type="button" 
                            data-level-target="{{ $level }}"
                            class="level-btn px-4 py-2 rounded-xl font-bold uppercase tracking-wider text-[10px] md:text-xs transition-all duration-300 shadow-sm
                            {{ $level === 'Semua' 
                                ? 'bg-amber-500 text-slate-950 shadow-lg shadow-amber-500/25' 
                                : 'bg-white hover:bg-amber-50 text-slate-600 border border-slate-100 hover:border-amber-100' }}"
                        >
                            {{ $level }}
                        </button>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <!-- 3. CATALOG GRID -->
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <div id="catalog-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($settings['seragam_items'] ?? [] as $item)
                @php
                    $levels = [];
                    if (isset($item['levels'])) {
                        $levels = is_array($item['levels']) ? $item['levels'] : json_decode($item['levels'], true) ?? [];
                    }
                    $waNumber = preg_replace('/[^0-9]/', '', $item['pic_phone'] ?? $settings['seragam_cta_phone'] ?? '083822099034');
                    if (str_starts_with($waNumber, '0')) {
                        $waNumber = '62' . substr($waNumber, 1);
                    }
                    $waMsg = rawurlencode("Assalamu'alaikum Wr. Wb. Saya ingin memesan item: " . $item['name'] . " (" . $item['price'] . ") dari katalog online. Mohon info ketersediaan stok.");
                @endphp
                <div 
                    data-category="{{ $item['category'] ?? 'Seragam Utama' }}"
                    data-levels="{{ json_encode($levels) }}"
                    data-name="{{ $item['name'] ?? '' }}"
                    data-desc="{{ $item['description'] ?? '' }}"
                    class="item-card bg-white rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/40 flex flex-col transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 group overflow-hidden"
                >
                    <!-- Image Wrapper -->
                    <div class="h-64 bg-slate-50 relative overflow-hidden border-b border-slate-100">
                        @if(isset($item['image']) && $item['image'])
                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" alt="{{ $item['name'] }}">
                        @else
                            <!-- Fallback themed placeholder icon based on category -->
                            <div class="w-full h-full flex flex-col items-center justify-center bg-emerald-50/50 text-emerald-800 p-4">
                                @if(str_contains(strtolower($item['category'] ?? ''), 'batik'))
                                    <span class="text-6xl mb-2 opacity-80">🥋</span>
                                @elseif(str_contains(strtolower($item['category'] ?? ''), 'olahraga'))
                                    <span class="text-6xl mb-2 opacity-80">👟</span>
                                @elseif(str_contains(strtolower($item['category'] ?? ''), 'atribut'))
                                    <span class="text-6xl mb-2 opacity-80">🎖️</span>
                                @else
                                    <span class="text-6xl mb-2 opacity-80">👕</span>
                                @endif
                                <span class="text-[9px] font-black uppercase tracking-widest text-emerald-600/70">PPI 104 Al-Ittihad</span>
                            </div>
                        @endif

                        <!-- Floating Category Tag -->
                        <span class="absolute top-4 left-4 bg-emerald-950/80 text-amber-400 backdrop-blur-md font-black text-[9px] uppercase tracking-widest px-3.5 py-1.5 rounded-xl border border-amber-500/20">
                            {{ $item['category'] ?? 'Seragam' }}
                        </span>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-black text-slate-800 mb-2.5 group-hover:text-emerald-700 transition-colors leading-tight">
                                {{ $item['name'] }}
                            </h3>
                            
                            <!-- Display Jenjang Badges (If Filled) -->
                            @if(count($levels) > 0)
                                <div class="flex flex-wrap gap-1 mb-3">
                                    @foreach($levels as $lvl)
                                        <span class="px-2 py-0.5 bg-amber-50 border border-amber-200/50 text-amber-800 rounded-md text-[9px] font-black uppercase tracking-wider">
                                            {{ $lvl === 'MDT' ? 'MDT / MDU' : ($lvl === 'TK' ? 'TK / RA' : ($lvl === 'PAUD' ? 'PAUD / Kober' : $lvl)) }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <p class="text-slate-500 text-xs leading-relaxed font-medium mb-4 line-clamp-3">
                                {{ $item['description'] ?? 'Bahan berkualitas tinggi, nyaman dipakai untuk kegiatan harian santri.' }}
                            </p>
                        </div>

                        <!-- Price and CTA -->
                        <div class="mt-4 pt-4 border-t border-slate-50">
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Harga</span>
                                <span class="text-lg font-black text-emerald-800 font-mono">
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
                                <span>Pesan Sekarang</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-slate-500 italic py-12">
                    Belum ada item katalog seragam yang dipublikasikan.
                </div>
            @endforelse
        </div>

        <!-- No Results Msg (hidden by default) -->
        <div id="no-results-msg" class="hidden w-full text-center text-slate-500 italic py-16">
            Tidak ada item katalog yang cocok dengan kata kunci atau filter Anda.
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
                <h2 class="text-3xl md:text-4xl font-black text-white mb-4 tracking-tight">Butuh Konsultasi Seragam Santri?</h2>
                <p class="text-emerald-100/90 text-sm md:text-base mb-10 font-medium leading-relaxed max-w-xl mx-auto">
                    Jika Anda memiliki pertanyaan mengenai ukuran khusus, cara pemesanan, atau kelengkapan perlengkapan lainnya, silakan hubungi bagian seragam kami.
                </p>
                
                @php
                    $waGeneralNumber = preg_replace('/[^0-9]/', '', $settings['seragam_cta_phone'] ?? '083822099034');
                    if (str_starts_with($waGeneralNumber, '0')) {
                        $waGeneralNumber = '62' . substr($waGeneralNumber, 1);
                    }
                    $waGeneralMsg = rawurlencode("Assalamu'alaikum Wr. Wb. Saya ingin menanyakan mengenai seragam/atribut santri PPI 104 Al-Ittihad.");
                @endphp
                
                <a 
                    href="https://wa.me/{{ $waGeneralNumber }}?text={{ $waGeneralMsg }}" 
                    target="_blank" 
                    rel="noopener noreferrer" 
                    class="inline-flex items-center gap-3 bg-[#f59e0b] hover:bg-[#d97706] text-slate-950 font-black uppercase tracking-wider text-[11px] px-8 py-4.5 rounded-2xl shadow-2xl transition-all hover:scale-105 active:scale-95"
                    style="text-decoration: none;"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z" /></svg>
                    <span>{{ $settings['seragam_cta_text'] ?? 'Hubungi Bagian Seragam' }}</span>
                </a>
            </div>
        </div>
    </section>

</div>

<!-- Interactive JS Filter Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const levelButtons = document.querySelectorAll('.level-btn');
        const searchInput = document.getElementById('search-input');
        const itemCards = document.querySelectorAll('.item-card');
        const noResultsMsg = document.getElementById('no-results-msg');
        
        let activeCategory = 'Semua';
        let activeLevel = 'Semua';

        function filterItems() {
            const searchQuery = searchInput.value.toLowerCase().trim();
            let visibleCount = 0;

            itemCards.forEach(card => {
                const cardCategory = card.getAttribute('data-category');
                
                let cardLevels = [];
                try {
                    cardLevels = JSON.parse(card.getAttribute('data-levels') || '[]');
                } catch(e) {
                    cardLevels = [];
                }

                const matchesCategory = activeCategory === 'Semua' || cardCategory === activeCategory;
                const matchesLevel = activeLevel === 'Semua' || cardLevels.includes(activeLevel);
                
                const cardName = card.getAttribute('data-name').toLowerCase();
                const cardDesc = card.getAttribute('data-desc').toLowerCase();
                const matchesSearch = searchQuery === '' || cardName.includes(searchQuery) || cardDesc.includes(searchQuery);

                if (matchesCategory && matchesLevel && matchesSearch) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                noResultsMsg.classList.remove('hidden');
            } else {
                noResultsMsg.classList.add('hidden');
            }
        }

        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Reset styling on all category filter buttons
                filterButtons.forEach(b => {
                    b.classList.remove('bg-emerald-700', 'text-white', 'shadow-lg', 'shadow-emerald-700/25');
                    b.classList.add('bg-white', 'hover:bg-emerald-50', 'text-slate-600', 'border', 'border-slate-100', 'hover:border-emerald-100');
                });

                // Set active style on current button
                btn.classList.remove('bg-white', 'hover:bg-emerald-50', 'text-slate-600', 'border', 'border-slate-100', 'hover:border-emerald-100');
                btn.classList.add('bg-emerald-700', 'text-white', 'shadow-lg', 'shadow-emerald-700/25');

                activeCategory = btn.getAttribute('data-category-target');
                filterItems();
            });
        });

        levelButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Reset styling on all level filter buttons
                levelButtons.forEach(b => {
                    b.classList.remove('bg-amber-500', 'text-slate-950', 'shadow-lg', 'shadow-amber-500/25');
                    b.classList.add('bg-white', 'hover:bg-amber-50', 'text-slate-600', 'border', 'border-slate-100', 'hover:border-amber-100');
                });

                // Set active style on current button
                btn.classList.remove('bg-white', 'hover:bg-amber-50', 'text-slate-600', 'border', 'border-slate-100', 'hover:border-amber-100');
                btn.classList.add('bg-amber-500', 'text-slate-950', 'shadow-lg', 'shadow-amber-500/25');

                activeLevel = btn.getAttribute('data-level-target');
                filterItems();
            });
        });

        searchInput.addEventListener('input', filterItems);
    });
</script>
@endsection
