@php
    $globalSettings = \App\Models\Setting::pluck('value', 'key')->toArray();
    $logoHeight = isset($globalSettings['logo_height']) && is_numeric($globalSettings['logo_height']) ? intval($globalSettings['logo_height']) : 80;
    $logoHeightMobile = round($logoHeight * 0.8);
    
    $footerLogo = isset($globalSettings['footer_logo']) && $globalSettings['footer_logo'] ? $globalSettings['footer_logo'] : ($globalSettings['logo_website'] ?? null);
    $footerLogoHeight = isset($globalSettings['footer_logo_height']) && is_numeric($globalSettings['footer_logo_height']) ? intval($globalSettings['footer_logo_height']) : 60;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pesantren Persatuan Islam 104 Al Ittihaad Cikajang')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --logo-height-desktop: {{ $logoHeight }}px;
            --logo-height-mobile: {{ $logoHeightMobile }}px;
            
            /* Default Theme Variables (Emerald Pesantren) */
            --theme-primary: #047857; /* emerald-700 */
            --theme-primary-hover: #065f46; /* emerald-800 */
            --theme-primary-light: #ecfdf5; /* emerald-50 */
            --theme-primary-light-hover: #d1fae5; /* emerald-100 */
            --theme-primary-text: #065f46; /* emerald-800 */
            --theme-footer-bg: #064e3b; /* emerald-900 */
            --theme-footer-border: #065f46; /* emerald-800 */
            --theme-footer-text: #a7f3d0; /* emerald-200 */
            --theme-footer-heading: #d1fae5; /* emerald-100 */
        }
        .logo-custom-size {
            height: var(--logo-height-mobile) !important;
        }
        @media (min-width: 768px) {
            .logo-custom-size {
                height: var(--logo-height-desktop) !important;
            }
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
        .font-arabic {
            font-family: 'Amiri', serif;
        }
        /* Animasi fade-in */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        /* Glassmorphism effect on scroll */
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
    <script>
        // Glassmorphism on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('nav');
            if (window.scrollY > 50) {
                navbar.classList.add('glass-effect');
            } else {
                navbar.classList.remove('glass-effect');
            }
        });
    </script>
</head>
<body class="font-sans antialiased bg-[#FDFDFD] text-slate-700">

    <!-- NAVBAR -->
    <nav class="fixed w-full top-0 bg-white shadow-xl z-50 border-b-[6px] border-[var(--theme-primary)] transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 md:px-6 h-28 flex justify-between items-center">
            
            <!-- SISI KIRI: LOGO -->
            <div class="flex items-center gap-4 shrink-0">
                <a href="/" class="flex items-center gap-4">
                    <!-- Logo Image -->
                    @if(isset($globalSettings['logo_website']) && $globalSettings['logo_website'])
                        <img src="{{ asset('storage/' . $globalSettings['logo_website']) }}" alt="Logo {{ $globalSettings['header_title'] ?? 'PPI 104' }}" class="logo-custom-size w-auto object-contain">
                    @else
                        <!-- Fallback Logo Box + Text Branding when no image logo uploaded -->
                        <div class="bg-[var(--theme-primary)] text-white w-16 h-16 flex items-center justify-center rounded-2xl font-black text-3xl shadow-lg border-2 border-[var(--theme-primary-light-hover)]">
                            104
                        </div>
                        <div class="flex flex-col text-left border-l-2 border-slate-200 pl-4">
                            <span class="text-[11px] font-black tracking-[0.2em] text-[var(--theme-primary)] leading-tight uppercase">{{ $globalSettings['header_title'] ?? 'Pesantren Persatuan Islam 104' }}</span>
                            <span class="text-2xl font-black text-slate-800 leading-none uppercase tracking-tighter">{{ $globalSettings['header_subtitle'] ?? 'Al-Ittihad Cikajang' }}</span>
                            <span class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest italic">{{ $globalSettings['header_tagline'] ?? 'Melayani Masyarakat Menuju Ridho Allah' }}</span>
                        </div>
                    @endif
                </a>
            </div>

            <!-- SISI KANAN: MENU -->
            <div class="hidden lg:flex items-center gap-6">
                <a href="/" class="text-[13px] font-black uppercase tracking-wider text-slate-700 hover:text-[var(--theme-primary)] transition-colors py-4">
                    Beranda
                </a>

                <!-- 1. Profil Menu -->
                @php
                    $profilMenu = \App\Models\Menu::where('location', 'profil')->where('is_active', true)->first();
                    $profilItems = $profilMenu ? $profilMenu->items()->where('is_active', true)->get() : collect([]);
                    if ($profilItems->isEmpty()) {
                        $profilItems = collect([
                            (object)['title' => 'Sejarah', 'url' => '/profil/sejarah'],
                            (object)['title' => 'Tokoh Pendiri', 'url' => '/profil/tokoh-pendiri'],
                            (object)['title' => 'Visi & Misi', 'url' => '/profil/visi-misi'],
                            (object)['title' => 'Struktur Organisasi', 'url' => '/profil/struktur'],
                            (object)['title' => 'Tendik Pesantren', 'url' => '/profil/asatidz'],
                            (object)['title' => 'Sarana & Prasarana', 'url' => '/profil/sarana'],
                        ]);
                    }
                @endphp
                <div class="relative group cursor-pointer flex items-center gap-1.5 py-4">
                    <span class="text-[13px] font-black uppercase tracking-wider text-slate-700 group-hover:text-[var(--theme-primary)] transition-colors">
                        {{ $profilMenu->name ?? 'Profil' }}
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-[var(--theme-primary)] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>

                    <div class="absolute left-1/2 -translate-x-1/2 top-full pt-1 hidden group-hover:block z-[1005]">
                        <div class="w-56 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.15)] rounded-2xl border-t-4 border-[var(--theme-primary)] overflow-hidden flex flex-col p-2">
                            @foreach($profilItems as $item)
                                <a href="{{ $item->url }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-[var(--theme-primary)] hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">
                                    {{ $item->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- 2. Program Menu -->
                @php
                    $programMenu = \App\Models\Menu::where('location', 'program')->where('is_active', true)->first();
                    $programItems = $programMenu ? $programMenu->items()->where('is_active', true)->get() : collect([]);
                    if ($programItems->isEmpty()) {
                        $programItems = collect([
                            (object)['title' => 'KOBER', 'url' => '/program/kober'],
                            (object)['title' => 'RA', 'url' => '/program/ra'],
                            (object)['title' => 'SDIT', 'url' => '/program/sdit'],
                            (object)['title' => 'MDT', 'url' => '/program/mdt'],
                            (object)['title' => 'MTS', 'url' => '/program/mts'],
                            (object)['title' => 'MA', 'url' => '/program/ma'],
                        ]);
                    }
                @endphp
                <div class="relative group cursor-pointer flex items-center gap-1.5 py-4">
                    <span class="text-[13px] font-black uppercase tracking-wider text-slate-700 group-hover:text-[var(--theme-primary)] transition-colors">
                        {{ $programMenu->name ?? 'Program' }}
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-[var(--theme-primary)] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>

                    <div class="absolute left-1/2 -translate-x-1/2 top-full pt-1 hidden group-hover:block z-[1005]">
                        <div class="w-56 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.15)] rounded-2xl border-t-4 border-[var(--theme-primary)] overflow-hidden flex flex-col p-2">
                            @foreach($programItems as $item)
                                <a href="{{ $item->url }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-[var(--theme-primary)] hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">
                                    {{ $item->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- 3. Program Pesantren Menu -->
                @php
                    $pesantrenMenu = \App\Models\Menu::where('location', 'program_pesantren')->where('is_active', true)->first();
                    $pesantrenItems = $pesantrenMenu ? $pesantrenMenu->items()->where('is_active', true)->get() : collect([]);
                    if ($pesantrenItems->isEmpty()) {
                        $pesantrenItems = collect([
                            (object)['title' => 'Wakaf Pendidikan', 'url' => '/dukungan'],
                            (object)['title' => 'Pembangunan Sarana', 'url' => '/dukungan/pembangunan'],
                            (object)['title' => 'Beasiswa Santri', 'url' => '/dukungan/beasiswa'],
                            (object)['title' => 'Tabungan Umroh', 'url' => '/program/tabungan-umroh'],
                            (object)['title' => 'Tabungan Kurban', 'url' => '/program/tabungan-kurban'],
                            (object)['title' => 'Kopontren', 'url' => '/program/kopontren'],
                        ]);
                    }
                @endphp
                <div class="relative group cursor-pointer flex items-center gap-1.5 py-4">
                    <span class="text-[13px] font-black uppercase tracking-wider text-slate-700 group-hover:text-[var(--theme-primary)] transition-colors">
                        {{ $pesantrenMenu->name ?? 'Program Pesantren' }}
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-[var(--theme-primary)] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>

                    <div class="absolute left-1/2 -translate-x-1/2 top-full pt-1 hidden group-hover:block z-[1005]">
                        <div class="w-56 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.15)] rounded-2xl border-t-4 border-[var(--theme-primary)] overflow-hidden flex flex-col p-2">
                            @foreach($pesantrenItems as $item)
                                <a href="{{ $item->url }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-[var(--theme-primary)] hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">
                                    {{ $item->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

                <a href="{{ route('berita.index') }}" class="text-[13px] font-black uppercase tracking-wider text-slate-700 hover:text-[var(--theme-primary)] transition-colors py-4">
                    Berita
                </a>

                <a href="/kontak" class="text-[13px] font-black uppercase tracking-wider text-slate-700 hover:text-[var(--theme-primary)] transition-colors py-4">
                    Kontak
                </a>

                <!-- PSB & WA -->
                <div class="ml-4 flex items-center gap-4 border-l border-slate-200 pl-6">
                    <a href="/kontak" class="bg-[var(--theme-primary-light)] hover:bg-[var(--theme-primary-light-hover)] text-[var(--theme-primary-text)] px-4.5 py-2 rounded-xl text-[12px] font-black uppercase tracking-wider transition-all border border-[var(--theme-primary-light-hover)] flex items-center justify-center">
                        PSB 26/27
                    </a>

                    <a href="https://wa.me/{{ $globalSettings['whatsapp_admin'] ?? '' }}" target="_blank" class="bg-[#25D366] text-white p-3 rounded-xl shadow-md transition-all hover:scale-105">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="h-28"></div>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-[var(--theme-footer-bg)] text-white py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        @if($footerLogo)
                            <img src="{{ asset('storage/' . $footerLogo) }}" alt="Logo" style="height: {{ $footerLogoHeight }}px;" class="w-auto object-contain">
                        @else
                            <div class="bg-[var(--theme-primary)] text-white w-12 h-12 flex items-center justify-center rounded-xl font-black text-xl shadow-lg border-2 border-[var(--theme-primary-light-hover)]">
                                104
                            </div>
                            <div>
                                <h3 class="font-arabic text-lg font-bold">{{ $globalSettings['header_title'] ?? 'Persatuan Islam 104' }}</h3>
                                <p class="text-[var(--theme-footer-text)] text-sm">{{ $globalSettings['header_subtitle'] ?? 'Al Ittihaad Cikajang' }}</p>
                            </div>
                        @endif
                    </div>
                    <p class="text-[var(--theme-footer-text)] text-sm leading-relaxed">
                        Mencetak generasi islami, beradab, dan berprestasi melalui pendidikan pesantren yang terpadu.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-[var(--theme-footer-heading)]">Link Cepat</h4>
                    <ul class="space-y-2 text-sm text-[var(--theme-footer-text)]">
                        <li><a href="/" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="/profil/sejarah" class="hover:text-white transition-colors">Sejarah</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Program</a></li>
                        <li><a href="{{ route('berita.index') }}" class="hover:text-white transition-colors">Berita</a></li>
                        <li><a href="/kontak" class="hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-[var(--theme-footer-heading)]">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm text-[var(--theme-footer-text)] text-left">
                        <li>📍 {{ $globalSettings['footer_address'] ?? 'Cikajang, Garut, Jawa Barat' }}</li>
                        <li>📞 {{ $globalSettings['footer_phone'] ?? '(0262) 123456' }}</li>
                        <li>✉️ {{ $globalSettings['footer_email'] ?? 'info@ppi104-cikajang.sch.id' }}</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-[var(--theme-footer-border)] mt-8 pt-8 text-center">
                <p class="text-[var(--theme-footer-text)] text-sm">{{ $globalSettings['footer_copyright'] ?? '© ' . date('Y') . ' Pesantren Persatuan Islam 104 Al Ittihaad Cikajang.' }}</p>
            </div>
        </div>
    </footer>

</body>
</html>
