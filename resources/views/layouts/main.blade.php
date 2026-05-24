@php
    $globalSettings = \App\Models\Setting::pluck('value', 'key')->toArray();
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
    <nav class="fixed w-full top-0 bg-white shadow-xl z-50 border-b-[6px] border-emerald-700 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 md:px-6 h-28 flex justify-between items-center">
            
            <!-- SISI KIRI: LOGO -->
            <div class="flex items-center gap-4 shrink-0">
                <a href="/" class="flex items-center gap-4">
                    <!-- Logo Image -->
                    @if(isset($globalSettings['logo_website']) && $globalSettings['logo_website'])
                        <img src="{{ asset('storage/' . $globalSettings['logo_website']) }}" alt="Logo {{ $globalSettings['header_title'] ?? 'PPI 104' }}" class="w-16 h-16 object-contain rounded-2xl shadow-lg border-2 border-emerald-500 bg-white">
                    @else
                        <!-- Fallback Logo if image not found -->
                        <div class="bg-emerald-800 text-white w-16 h-16 flex items-center justify-center rounded-2xl font-black text-3xl shadow-lg border-2 border-emerald-500">
                            104
                        </div>
                    @endif
                    <div class="flex flex-col text-left border-l-2 border-slate-200 pl-4">
                        <span class="text-[11px] font-black tracking-[0.2em] text-emerald-800 leading-tight uppercase">{{ $globalSettings['header_title'] ?? 'Pesantren Persatuan Islam 104' }}</span>
                        <span class="text-2xl font-black text-slate-800 leading-none uppercase tracking-tighter">{{ $globalSettings['header_subtitle'] ?? 'Al-Ittihad Cikajang' }}</span>
                        <span class="text-[10px] font-bold text-slate-400 mt-1 uppercase tracking-widest italic">{{ $globalSettings['header_tagline'] ?? 'Melayani Masyarakat Menuju Ridho Allah' }}</span>
                    </div>
                </a>
            </div>

            <!-- SISI KANAN: MENU -->
            <div class="hidden lg:flex items-center gap-1">
                <a href="/" class="relative group px-4 py-2 hover:bg-emerald-50 rounded-2xl transition-all cursor-pointer text-center min-w-100px">
                    <div class="flex flex-col items-center">
                        <span class="text-xl mb-1">🏠</span>
                        <span class="text-[12px] font-black uppercase text-slate-800 leading-none">Beranda</span>
                        <span class="text-[8px] font-bold text-slate-400 leading-none mt-1.5 whitespace-nowrap">Selamat Datang</span>
                    </div>
                </a>

                <div class="relative group px-4 py-2 hover:bg-emerald-50 rounded-2xl transition-all cursor-pointer text-center min-w-100px">
                    <div class="flex flex-col items-center">
                        <span class="text-xl mb-1">🏢</span>
                        <span class="text-[12px] font-black uppercase text-emerald-800 leading-none">Profil</span>
                        <span class="text-[8px] font-bold text-slate-400 leading-none mt-1.5 whitespace-nowrap">Pesantren</span>
                        <svg class="w-3 h-3 text-emerald-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    <div class="absolute left-0 right-0 top-full pt-2 hidden group-hover:block">
                        <div class="absolute left-1/2 -translate-x-1/2 w-56 z-[1005]">
                            <div class="bg-white shadow-[0_20px_50px_rgba(0,0,0,0.2)] rounded-2xl border-t-4 border-emerald-700 overflow-hidden flex flex-col p-2">
                                <a href="/profil/sejarah" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block">Sejarah</a>
                                <a href="{{ route('profil.tokoh-pendiri') }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">Tokoh Pendiri</a>
                                <a href="/profil/visi-misi" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block">Visi & Misi</a>
                                <a href="/profil/struktur" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block">Struktur</a>
                                <a href="{{ route('profil.sarana') }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">Sarana & Prasarana</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative group px-4 py-2 hover:bg-emerald-50 rounded-2xl transition-all cursor-pointer text-center min-w-100px">
                    <div class="flex flex-col items-center">
                        <span class="text-xl mb-1">📚</span>
                        <span class="text-[12px] font-black uppercase text-emerald-800 leading-none">Program</span>
                        <span class="text-[8px] font-bold text-slate-400 leading-none mt-1.5 whitespace-nowrap">Pendidikan</span>
                        <svg class="w-3 h-3 text-emerald-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    <div class="absolute left-0 right-0 top-full pt-2 hidden group-hover:block">
                        <div class="absolute left-1/2 -translate-x-1/2 w-56 z-[1005]">
                            <div class="bg-white shadow-[0_20px_50px_rgba(0,0,0,0.2)] rounded-2xl border-t-4 border-emerald-700 overflow-hidden flex flex-col p-2">
                                <a href="{{ route('program.kober') }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">KOBER</a>
                                <a href="{{ route('program.ra') }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">RA</a>
                                <a href="{{ route('program.sdit') }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">SDIT</a>
                                <a href="{{ route('program.mdt') }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">MDT</a>
                                <a href="/program/mts" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block">MTS</a>
                                <a href="/program/ma" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block">MA</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative group px-4 py-2 hover:bg-emerald-50 rounded-2xl transition-all cursor-pointer text-center min-w-100px">
                    <div class="flex flex-col items-center">
                        <span class="text-xl mb-1">🤝</span>
                        <span class="text-[12px] font-black uppercase text-emerald-800 leading-none">Dukungan</span>
                        <span class="text-[8px] font-bold text-slate-400 leading-none mt-1.5 whitespace-nowrap">Pendidikan</span>
                        <svg class="w-3 h-3 text-emerald-600 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>

                    <div class="absolute left-0 right-0 top-full pt-2 hidden group-hover:block">
                        <div class="absolute left-1/2 -translate-x-1/2 w-56 z-[1005]">
                            <div class="bg-white shadow-[0_20px_50px_rgba(0,0,0,0.2)] rounded-2xl border-t-4 border-emerald-700 overflow-hidden flex flex-col p-2">
                                <a href="{{ route('dukungan.index') }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">Wakaf Pendidikan</a>
                                <a href="{{ route('dukungan.pembangunan') }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">Pembangunan</a>
                                <a href="{{ route('dukungan.beasiswa') }}" class="px-5 py-3 text-[10px] font-bold text-slate-600 hover:bg-emerald-700 hover:text-white rounded-xl transition-all uppercase text-left block relative z-10 pointer-events-auto">Beasiswa</a>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('berita.index') }}" class="relative group px-4 py-2 hover:bg-emerald-50 rounded-2xl transition-all cursor-pointer text-center min-w-100px">
                    <div class="flex flex-col items-center">
                        <span class="text-xl mb-1">📰</span>
                        <span class="text-[12px] font-black uppercase text-slate-800 leading-none">Berita</span>
                        <span class="text-[8px] font-bold text-slate-400 leading-none mt-1.5 whitespace-nowrap">Informasi</span>
                    </div>
                </a>

                <a href="#" class="relative group px-4 py-2 hover:bg-emerald-50 rounded-2xl transition-all cursor-pointer text-center min-w-100px">
                    <div class="flex flex-col items-center">
                        <span class="text-xl mb-1">📞</span>
                        <span class="text-[12px] font-black uppercase text-slate-800 leading-none">Kontak</span>
                        <span class="text-[8px] font-bold text-slate-400 leading-none mt-1.5 whitespace-nowrap">Hubungi Kami</span>
                    </div>
                </a>

                <!-- PSB & WA -->
                <div class="ml-4 flex items-center gap-4 border-l-2 border-slate-100 pl-6">
                    <div class="flex flex-col items-center group bg-emerald-50 px-4 py-2 rounded-2xl border border-emerald-100 transition-all hover:bg-emerald-100">
                        <span class="text-xl">📝</span>
                        <span class="text-[12px] font-black text-emerald-800 uppercase">PSB</span>
                        <span class="text-[9px] font-bold text-emerald-600/60 leading-none uppercase">26/27</span>
                    </div>
                    
                    <a href="#" class="bg-[#25D366] text-white p-4 rounded-2xl shadow-xl">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z" /></svg>
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
    <footer class="bg-emerald-900 text-white py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        @if(isset($globalSettings['logo_website']) && $globalSettings['logo_website'])
                            <img src="{{ asset('storage/' . $globalSettings['logo_website']) }}" alt="Logo" class="w-12 h-12 object-contain rounded-xl shadow-lg bg-white">
                        @else
                            <div class="bg-emerald-800 text-white w-12 h-12 flex items-center justify-center rounded-xl font-black text-xl shadow-lg border-2 border-emerald-500">
                                104
                            </div>
                        @endif
                        <div>
                            <h3 class="font-arabic text-lg font-bold">{{ $globalSettings['header_title'] ?? 'Persatuan Islam 104' }}</h3>
                            <p class="text-emerald-200 text-sm">{{ $globalSettings['header_subtitle'] ?? 'Al Ittihaad Cikajang' }}</p>
                        </div>
                    </div>
                    <p class="text-emerald-200 text-sm leading-relaxed">
                        Mencetak generasi islami, beradab, dan berprestasi melalui pendidikan pesantren yang terpadu.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-emerald-100">Link Cepat</h4>
                    <ul class="space-y-2 text-sm text-emerald-200">
                        <li><a href="/" class="hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="/profil/sejarah" class="hover:text-white transition-colors">Sejarah</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Program</a></li>
                        <li><a href="{{ route('berita.index') }}" class="hover:text-white transition-colors">Berita</a></li>
                        <li><a href="{{ route('kontak.index') }}" class="hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-emerald-100">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm text-emerald-200 text-left">
                        <li>📍 {{ $globalSettings['footer_address'] ?? 'Cikajang, Garut, Jawa Barat' }}</li>
                        <li>📞 {{ $globalSettings['footer_phone'] ?? '(0262) 123456' }}</li>
                        <li>✉️ {{ $globalSettings['footer_email'] ?? 'info@ppi104-cikajang.sch.id' }}</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-emerald-800 mt-8 pt-8 text-center">
                <p class="text-emerald-200 text-sm">{{ $globalSettings['footer_copyright'] ?? '© ' . date('Y') . ' Pesantren Persatuan Islam 104 Al Ittihaad Cikajang.' }}</p>
            </div>
        </div>
    </footer>

</body>
</html>
