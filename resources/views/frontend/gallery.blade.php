@extends('layouts.main')

@section('title', 'Galeri Dokumentasi Pesantren - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#FDFDFD] pt-12 pb-20 min-h-screen">
    
    <!-- 1. HERO SECTION (Emerald Gradient & Gold Border Accent) -->
    <section class="max-w-7xl mx-auto px-6 mb-16 relative">
        <div class="bg-gradient-to-tr from-[#061f14] via-[#0b3c25] to-[#1c5d3e] rounded-[3rem] p-12 md:p-20 overflow-hidden relative shadow-2xl flex flex-col items-center text-center border-b-[8px] border-amber-500 animate-fade-in-up">
            <!-- Geometric Islamic Pattern Overlay -->
            <div class="absolute inset-0 opacity-10 mix-blend-overlay" style="background-image: radial-gradient(circle at 1px 1px, white 1px, transparent 0); background-size: 40px 40px;"></div>
            
            <!-- Soft Glowing Decors -->
            <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-amber-400/10 rounded-full blur-[120px] pointer-events-none"></div>
            <div class="absolute -bottom-40 -left-40 w-[500px] h-[500px] bg-emerald-400/20 rounded-full blur-[100px] pointer-events-none"></div>
            
            <div class="relative z-10 max-w-4xl">
                <span class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500/10 border border-amber-400/30 text-amber-300 backdrop-blur-md rounded-full font-black text-xs tracking-[0.3em] uppercase mb-8 shadow-lg">
                    <span>📸</span> ALBUM DOKUMENTASI LENGKAP
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 text-white tracking-tight leading-[1.1] drop-shadow-md">
                    Galeri & Dokumentasi Kegiatan
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-amber-400 to-amber-600 mx-auto mb-6 rounded-full"></div>
                <p class="text-emerald-50/90 text-lg md:text-xl font-medium leading-relaxed max-w-2xl mx-auto drop-shadow-sm">
                    Kumpulan dokumentasi visual seluruh kegiatan tarbiyah, sarana prasarana, dan keseharian santri dari setiap jenjang pendidikan.
                </p>
            </div>
        </div>
    </section>

    <!-- 2. HORIZONTAL JENJANG SCROLL FILTER (User Request: "scrol jenjang masing masing") -->
    <section class="max-w-7xl mx-auto px-6 mb-12">
        <div class="flex flex-col items-center mb-6 text-center">
            <span class="text-emerald-700 font-black text-xs uppercase tracking-[0.2em] mb-2">PILIH JENJANG</span>
            <h2 class="text-xl md:text-2xl font-black text-slate-800 tracking-tight">Saring Album Foto Kegiatan</h2>
            <div class="w-8 h-1 bg-amber-500 rounded-full mt-2"></div>
        </div>

        <!-- Horizontal Scrollable Tags Bar (Frictionless swipe on mobile) -->
        <div class="flex gap-3 overflow-x-auto pb-4 px-2 scrollbar-none snap-x snap-mandatory justify-start md:justify-center" style="scrollbar-width: none; ms-overflow-style: none;">
            <button 
                onclick="filterGallery('all', this)" 
                class="active-filter-btn shrink-0 snap-center px-6 py-3 bg-emerald-800 text-white font-black text-xs uppercase tracking-wider rounded-2xl shadow-lg border border-emerald-700/30 cursor-pointer transition-all duration-300 focus:outline-none"
            >
                Semua Album
            </button>
            <button 
                onclick="filterGallery('Umum', this)" 
                class="filter-btn shrink-0 snap-center px-6 py-3 bg-white text-slate-600 hover:text-emerald-800 font-black text-xs uppercase tracking-wider rounded-2xl shadow-md border border-slate-200/60 hover:border-emerald-300 cursor-pointer transition-all duration-300 focus:outline-none"
            >
                Umum & Pesantren
            </button>
            <button 
                onclick="filterGallery('MA', this)" 
                class="filter-btn shrink-0 snap-center px-6 py-3 bg-white text-slate-600 hover:text-emerald-800 font-black text-xs uppercase tracking-wider rounded-2xl shadow-md border border-slate-200/60 hover:border-emerald-300 cursor-pointer transition-all duration-300 focus:outline-none"
            >
                Madrasah Aliyah (MA)
            </button>
            <button 
                onclick="filterGallery('MTs', this)" 
                class="filter-btn shrink-0 snap-center px-6 py-3 bg-white text-slate-600 hover:text-emerald-800 font-black text-xs uppercase tracking-wider rounded-2xl shadow-md border border-slate-200/60 hover:border-emerald-300 cursor-pointer transition-all duration-300 focus:outline-none"
            >
                Madrasah Tsanawiyah (MTs)
            </button>
            <button 
                onclick="filterGallery('SDIT', this)" 
                class="filter-btn shrink-0 snap-center px-6 py-3 bg-white text-slate-600 hover:text-emerald-800 font-black text-xs uppercase tracking-wider rounded-2xl shadow-md border border-slate-200/60 hover:border-emerald-300 cursor-pointer transition-all duration-300 focus:outline-none"
            >
                SDIT
            </button>
            <button 
                onclick="filterGallery('RA', this)" 
                class="filter-btn shrink-0 snap-center px-6 py-3 bg-white text-slate-600 hover:text-emerald-800 font-black text-xs uppercase tracking-wider rounded-2xl shadow-md border border-slate-200/60 hover:border-emerald-300 cursor-pointer transition-all duration-300 focus:outline-none"
            >
                RA
            </button>
            <button 
                onclick="filterGallery('KOBER', this)" 
                class="filter-btn shrink-0 snap-center px-6 py-3 bg-white text-slate-600 hover:text-emerald-800 font-black text-xs uppercase tracking-wider rounded-2xl shadow-md border border-slate-200/60 hover:border-emerald-300 cursor-pointer transition-all duration-300 focus:outline-none"
            >
                KOBER
            </button>
            <button 
                onclick="filterGallery('MDT', this)" 
                class="filter-btn shrink-0 snap-center px-6 py-3 bg-white text-slate-600 hover:text-emerald-800 font-black text-xs uppercase tracking-wider rounded-2xl shadow-md border border-slate-200/60 hover:border-emerald-300 cursor-pointer transition-all duration-300 focus:outline-none"
            >
                MDT
            </button>
        </div>
    </section>

    <!-- 3. GRID ALBUM DOKUMENTASI -->
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <div id="gallery-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 transition-all duration-500">
            @forelse($galleryItems as $idx => $item)
                @php
                    $jenjangTag = $item['jenjang'] ?? 'Umum';
                    $galleryImg = $item['image'] 
                        ? asset('storage/' . $item['image']) 
                        : 'https://picsum.photos/600/450?random=' . $idx;
                @endphp
                <div 
                    data-jenjang="{{ $jenjangTag }}"
                    onclick="openLightbox({{ $idx }})"
                    class="gallery-card group relative h-[300px] rounded-[2rem] overflow-hidden shadow-lg border border-slate-100 bg-white cursor-pointer transform transition-all duration-500 scale-100 opacity-100 hover:shadow-2xl hover:-translate-y-1 block"
                >
                    <!-- Background Image -->
                    <img 
                        src="{{ $galleryImg }}" 
                        className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                        alt="{{ $item['title'] }}"
                        style="width: 100%; height: 100%; object-fit: cover;"
                        onerror="this.src='https://picsum.photos/600/450?nature'"
                    />
                    
                    <!-- Floating Jenjang Tag -->
                    <span class="absolute top-4 left-4 bg-emerald-950/80 text-amber-300 backdrop-blur-md font-black text-[9px] uppercase tracking-widest px-3 py-1.5 rounded-xl border border-amber-500/20">
                        {{ $jenjangTag }}
                    </span>

                    <!-- Overlay Caption on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 text-left">
                        <span class="text-amber-400 text-[9px] font-black uppercase tracking-widest mb-1">{{ $jenjangTag }}</span>
                        <h4 class="text-white font-black text-lg mb-1 leading-snug">{{ $item['title'] }}</h4>
                        <p class="text-white/80 text-xs line-clamp-2 leading-relaxed font-medium">{{ $item['desc'] ?? '' }}</p>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-slate-400 italic py-12">
                    Belum ada foto dokumentasi kegiatan pesantren yang diunggah.
                </div>
            @endforelse
        </div>
        
        <!-- Empty Filter State Alert -->
        <div id="empty-filter-alert" class="hidden text-center text-slate-500 italic py-20 bg-white border border-slate-100 rounded-3xl shadow-md">
            Tidak ada foto dokumentasi kegiatan untuk jenjang sekolah ini.
        </div>
    </section>

    <!-- 3b. ARSIP KLASIK & KENANGAN MASA LALU PESANTREN -->
    <section class="max-w-7xl mx-auto px-6 mb-24 relative">
        <div class="bg-amber-50/20 rounded-[3rem] p-8 md:p-16 border border-amber-200/40 backdrop-blur-sm relative overflow-hidden shadow-xl">
            <!-- Background Retro Details -->
            <div class="absolute -top-24 -left-24 w-64 h-64 bg-amber-200/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-80 h-80 bg-orange-100/10 rounded-full blur-3xl pointer-events-none"></div>
            
            <!-- Section Header -->
            <div class="flex flex-col items-center mb-12 text-center relative z-10">
                <span class="text-amber-700 font-black text-xs uppercase tracking-[0.25em] mb-2">🎞️ MEMORI PESANTREN</span>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight">Arsip Klasik & Kenangan Masa Lalu</h2>
                <div class="w-16 h-1 bg-gradient-to-r from-amber-400 to-amber-600 mx-auto mt-3 rounded-full"></div>
                <p class="text-slate-500 text-sm max-w-xl mx-auto mt-4 font-medium leading-relaxed">
                    Menyusuri kembali lembaran sejarah, ketokohan para pendiri, dan potret suasana klasik pesantren dari masa ke masa.
                </p>
            </div>

            <!-- Polaroid/Vintage Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 relative z-10">
                @forelse($historicalItems as $idx => $item)
                    @php
                        $galleryImg = $item['image'] 
                            ? asset('storage/' . $item['image']) 
                            : 'https://picsum.photos/500/500?random=' . ($idx + 100);
                    @endphp
                    <div 
                        onclick="openHistoricalLightbox({{ $idx }})"
                        class="historical-card group bg-[#FDFBF7] p-4 pb-8 rounded-xl shadow-md border border-amber-100/60 cursor-pointer transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 hover:rotate-1 rotate-[-0.5deg] even:rotate-[0.5deg]"
                    >
                        <!-- Photo container with Sepia effect -->
                        <div class="relative aspect-square overflow-hidden rounded bg-slate-900 border border-amber-200/30">
                            <img 
                                src="{{ $galleryImg }}" 
                                class="w-full h-full object-cover grayscale sepia contrast-125 brightness-95 transition-all duration-500 group-hover:grayscale-0 group-hover:sepia-0 group-hover:contrast-100 group-hover:brightness-100 group-hover:scale-105" 
                                alt="{{ $item['title'] }}"
                                onerror="this.src='https://picsum.photos/500/500?nature'"
                            />
                            <!-- Vintage Film Overlay -->
                            <div class="absolute inset-0 bg-[#8c510a]/10 pointer-events-none mix-blend-overlay group-hover:opacity-0 transition-opacity duration-300"></div>
                        </div>
                        
                        <!-- Caption resembling handwritten note -->
                        <div class="mt-4 text-center">
                            <h4 class="font-serif text-[#5c3d14] font-black text-sm tracking-tight line-clamp-1 group-hover:text-amber-900 transition-colors">
                                {{ $item['title'] }}
                            </h4>
                            <span class="inline-block mt-1 font-serif text-[10px] text-amber-800/60 font-medium">
                                {{ $item['created_at'] ? \Carbon\Carbon::parse($item['created_at'])->format('d M Y') : 'Arsip Klasik' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-amber-800/40 italic py-12">
                        Belum ada foto kenangan masa lalu pesantren yang diunggah.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 4. LIGHTBOX IMAGE VIEWER MODAL (Vanilla JS & Slide Support) -->
    <div id="gallery-lightbox" class="fixed inset-0 bg-black/95 z-[99999] hidden flex items-center justify-center p-4">
        <!-- Close button -->
        <button onclick="closeLightbox()" class="absolute top-6 right-6 text-white hover:text-amber-400 text-4xl font-extralight cursor-pointer focus:outline-none z-10 transition-colors">&times;</button>
        
        <!-- Navigation arrows -->
        <button onclick="prevImage()" class="absolute left-4 md:left-8 text-white/60 hover:text-white bg-white/10 hover:bg-white/20 p-4 rounded-full font-bold cursor-pointer focus:outline-none z-10 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" strokeWidth="3" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
        </button>
        <button onclick="nextImage()" class="absolute right-4 md:right-8 text-white/60 hover:text-white bg-white/10 hover:bg-white/20 p-4 rounded-full font-bold cursor-pointer focus:outline-none z-10 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" strokeWidth="3" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Main Display Container -->
        <div class="max-w-4xl w-full flex flex-col items-center">
            <div class="relative overflow-hidden rounded-2xl shadow-2xl border-4 border-white/10 bg-slate-900 max-h-[70vh] flex items-center justify-center">
                <img id="lightbox-img" src="" class="max-h-[70vh] max-w-full object-contain" alt="">
                
                <!-- Floating badge in lightbox -->
                <span id="lightbox-badge" class="absolute top-4 left-4 bg-emerald-950/90 text-amber-400 font-black text-[9px] uppercase tracking-widest px-3 py-1.5 rounded-xl border border-amber-500/20"></span>
            </div>
            
            <div class="text-center mt-6 text-white max-w-2xl px-4">
                <h3 id="lightbox-title" class="text-xl font-black tracking-tight text-amber-400 uppercase"></h3>
                <p id="lightbox-desc" class="text-sm text-slate-300 mt-2 font-medium leading-relaxed"></p>
            </div>
        </div>
    </div>

</div>

<!-- Vanilla JS Gallery Filter & Lightbox Implementation -->
<script>
    // Load all gallery items
    const rawGalleryItems = @json($galleryItems);
    const rawHistoricalItems = @json($historicalItems ?? []);
    const storageUrl = "{{ asset('storage') }}/";
    
    // Map items to include parsed absolute URLs
    const galleryItems = rawGalleryItems.map((item, idx) => {
        let parsedImg = item.image;
        if (parsedImg && !parsedImg.startsWith('http') && !parsedImg.startsWith('/') && !parsedImg.startsWith('data:')) {
            parsedImg = storageUrl + parsedImg;
        } else if (!parsedImg) {
            parsedImg = 'https://picsum.photos/600/450?random=' + idx;
        }
        return {
            ...item,
            image: parsedImg,
            jenjang: item.jenjang || 'Umum',
            originalIndex: idx
        };
    });

    const historicalItems = rawHistoricalItems.map((item, idx) => {
        let parsedImg = item.image;
        if (parsedImg && !parsedImg.startsWith('http') && !parsedImg.startsWith('/') && !parsedImg.startsWith('data:')) {
            parsedImg = storageUrl + parsedImg;
        } else if (!parsedImg) {
            parsedImg = 'https://picsum.photos/600/450?random=' + (idx + 100);
        }
        return {
            ...item,
            image: parsedImg,
            jenjang: 'Masa Lalu / Sejarah',
            originalIndex: idx
        };
    });

    let currentFilter = 'all';
    let filteredItems = [...galleryItems];
    let currentLightboxIndex = 0;

    // A. FILTER LOGIC ("asik" animation scale transitions)
    function filterGallery(jenjang, buttonEl) {
        currentFilter = jenjang;
        
        // 1. Toggle Active Button Styling
        document.querySelectorAll('.active-filter-btn').forEach(btn => {
            btn.classList.remove('active-filter-btn', 'bg-emerald-800', 'text-white');
            btn.classList.add('filter-btn', 'bg-white', 'text-slate-600', 'border-slate-200/60');
        });
        
        buttonEl.classList.remove('filter-btn', 'bg-white', 'text-slate-600', 'border-slate-200/60');
        buttonEl.classList.add('active-filter-btn', 'bg-emerald-800', 'text-white', 'border-emerald-700/30');

        // 2. Filter & Animate Cards Grid
        const cards = document.querySelectorAll('.gallery-card');
        let visibleCount = 0;
        
        cards.forEach((card, idx) => {
            const cardJenjang = card.getAttribute('data-jenjang');
            const matches = (jenjang === 'all' || cardJenjang === jenjang);
            
            if (matches) {
                // Show card with scale up animation
                card.classList.remove('hidden');
                setTimeout(() => {
                    card.classList.remove('scale-90', 'opacity-0');
                    card.classList.add('scale-100', 'opacity-100');
                }, 50);
                visibleCount++;
            } else {
                // Hide card with scale down animation
                card.classList.remove('scale-100', 'opacity-100');
                card.classList.add('scale-90', 'opacity-0');
                setTimeout(() => {
                    card.classList.add('hidden');
                }, 300); // match duration of scale animation
            }
        });

        // 3. Update Filtered Items Array (so Lightbox Prev/Next cycles correctly!)
        filteredItems = galleryItems.filter(item => jenjang === 'all' || item.jenjang === jenjang);

        // 4. Toggle empty alert state
        const alertBox = document.getElementById('empty-filter-alert');
        if (visibleCount === 0) {
            alertBox.classList.remove('hidden');
        } else {
            alertBox.classList.add('hidden');
        }
    }

    // B. LIGHTBOX LOGIC
    function openLightbox(originalIndex) {
        // Reset active filtered list to current gallery filter state
        const jenjang = currentFilter;
        filteredItems = galleryItems.filter(item => jenjang === 'all' || item.jenjang === jenjang);

        // Find index of clicked item inside the *currently filtered* items array
        currentLightboxIndex = filteredItems.findIndex(item => item.originalIndex === originalIndex);
        if (currentLightboxIndex === -1) {
            currentLightboxIndex = 0;
        }

        updateLightboxContent();
        document.getElementById('gallery-lightbox').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function openHistoricalLightbox(idx) {
        // Switch context to historical items
        filteredItems = historicalItems;
        currentLightboxIndex = idx;

        updateLightboxContent();
        document.getElementById('gallery-lightbox').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeLightbox() {
        document.getElementById('gallery-lightbox').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function updateLightboxContent() {
        const item = filteredItems[currentLightboxIndex];
        if (!item) return;

        document.getElementById('lightbox-img').src = item.image;
        document.getElementById('lightbox-badge').innerText = item.jenjang;
        document.getElementById('lightbox-title').innerText = item.title || 'Dokumentasi Kegiatan';
        document.getElementById('lightbox-desc').innerText = item.desc || '';
    }

    function prevImage() {
        if (filteredItems.length <= 1) return;
        currentLightboxIndex = (currentLightboxIndex - 1 + filteredItems.length) % filteredItems.length;
        updateLightboxContent();
    }

    function nextImage() {
        if (filteredItems.length <= 1) return;
        currentLightboxIndex = (currentLightboxIndex + 1) % filteredItems.length;
        updateLightboxContent();
    }

    // Bind Keyboard Shortcuts
    document.addEventListener('keydown', function(e) {
        const lightbox = document.getElementById('gallery-lightbox');
        if (lightbox.classList.contains('hidden')) return;

        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowLeft') {
            prevImage();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        }
    });
</script>
@endsection
