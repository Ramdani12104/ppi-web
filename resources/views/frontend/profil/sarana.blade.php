@extends('layouts.main')

@section('title', $sarana->hero_title ?? 'Sarana & Prasarana - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#f8f9fa] overflow-x-hidden">

    <!-- 1. HERO SECTION -->
    @if($sarana->is_active_hero ?? true)
    <section class="relative min-h-[70vh] flex items-center overflow-hidden pt-20">
        <div class="absolute inset-0 bg-[#0f3b2a]"></div>
        @if(isset($sarana->hero_banner) && $sarana->hero_banner)
            <img src="{{ asset('storage/' . $sarana->hero_banner) }}" class="absolute inset-0 w-full h-full object-cover opacity-40 mix-blend-overlay">
        @else
            <!-- Fallback Islamic geometric pattern -->
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>
        @endif
        
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center py-20">
            <span class="inline-block px-4 py-2 bg-emerald-500/20 text-emerald-100 backdrop-blur-md rounded-full font-bold text-xs tracking-[0.2em] uppercase mb-6 border border-emerald-500/30">
                Fasilitas Pesantren
            </span>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-[1.1] tracking-tight mb-6">
                {{ $sarana->hero_title ?? 'Sarana & Prasarana' }}
            </h1>
            <p class="text-lg md:text-xl text-emerald-50/90 leading-relaxed max-w-2xl mx-auto font-medium">
                {{ $sarana->hero_subtitle ?? 'Lingkungan pendidikan yang nyaman, modern, dan islami untuk mendukung pembelajaran, ibadah, dan pengembangan karakter santri.' }}
            </p>
        </div>
        
        <!-- Subtle Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,119.28,197.93,109.52Z" fill="#f8f9fa"></path>
            </svg>
        </div>
    </section>
    @endif

    <!-- 2. PENGANTAR -->
    @if($sarana->is_active_intro ?? true)
    <section class="py-20 px-6 bg-[#f8f9fa] relative z-20 -mt-10">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.05)] p-10 md:p-14 text-center border border-gray-100">
            <h2 class="text-2xl md:text-3xl font-bold text-[#1a2f24] mb-6">
                {{ $sarana->intro_title ?? 'Mendukung Pendidikan Berkualitas' }}
            </h2>
            <div class="prose prose-lg text-gray-600 mx-auto leading-relaxed">
                @if(isset($sarana->intro_content) && $sarana->intro_content)
                    {!! $sarana->intro_content !!}
                @else
                    <p>Pesantren Persatuan Islam 104 Al Ittihaad berkomitmen untuk menyediakan fasilitas pendidikan yang representatif dan nyaman. Kami menyadari bahwa lingkungan fisik yang baik sangat berpengaruh terhadap kenyamanan belajar dan perkembangan psikologis santri.</p>
                    <p>Dari ruang kelas yang bersih, masjid sebagai pusat ibadah, hingga asrama yang hangat, seluruh sarana dan prasarana dibangun dan dikelola dengan prinsip kebersihan sebagian dari iman.</p>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- 3. DAFTAR FASILITAS (GRID MODERN) -->
    @if($sarana->is_active_facilities ?? true)
    <section class="py-24 px-6 relative bg-white">
        <!-- Subtle Background Accent -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-emerald-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-amber-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <span class="text-emerald-600 font-bold tracking-widest text-sm uppercase mb-2 block">Infrastruktur</span>
                <h2 class="text-4xl md:text-5xl font-black text-[#1a2f24] tracking-tight">Fasilitas Unggulan</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($sarana->facilities ?? [] as $facility)
                <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col h-full transform hover:-translate-y-2">
                    <div class="h-56 overflow-hidden relative">
                        <div class="absolute inset-0 bg-[#0f3b2a]/10 group-hover:bg-transparent transition-colors z-10"></div>
                        @if($facility->image)
                            <img src="{{ asset('storage/' . $facility->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-emerald-100 flex items-center justify-center text-6xl group-hover:scale-110 transition-transform duration-700">
                                {{ $facility->icon ?? '🏢' }}
                            </div>
                        @endif
                        
                        <!-- Floating Icon -->
                        <div class="absolute top-4 right-4 w-12 h-12 bg-white rounded-xl shadow-lg flex items-center justify-center text-2xl z-20 text-emerald-600 font-bold">
                            {{ $facility->icon ?? '✨' }}
                        </div>
                    </div>
                    
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="text-2xl font-bold text-[#1a2f24] mb-3">{{ $facility->title }}</h3>
                        <p class="text-gray-600 leading-relaxed text-sm flex-1">{{ $facility->description }}</p>
                        
                        <div class="mt-6 w-12 h-1 bg-emerald-500 rounded-full group-hover:w-full transition-all duration-500"></div>
                    </div>
                </div>
                @empty
                <!-- Fallback Data -->
                @php
                    $defaults = [
                        ['icon' => '🕌', 'title' => 'Masjid Utama', 'desc' => 'Pusat ibadah dan kajian kitab kuning dengan kapasitas besar, bersih, dan sejuk.'],
                        ['icon' => '📚', 'title' => 'Ruang Kelas Modern', 'desc' => 'Ruang kelas yang nyaman, ventilasi udara yang baik, dan meja kursi standar ergonomis.'],
                        ['icon' => '🛏️', 'title' => 'Asrama Santri', 'desc' => 'Asrama yang aman dan terjaga kebersihannya, dilengkapi dengan loker dan ranjang susun yang kokoh.'],
                        ['icon' => '📖', 'title' => 'Perpustakaan', 'desc' => 'Koleksi buku literatur Islam, sejarah, dan umum untuk menunjang wawasan literasi santri.'],
                        ['icon' => '💻', 'title' => 'Laboratorium Komputer', 'desc' => 'Fasilitas PC untuk praktek TIK dan pengenalan dunia digital bagi santri jenjang menengah.'],
                        ['icon' => '⚽', 'title' => 'Lapangan Olahraga', 'desc' => 'Area luas untuk kegiatan olahraga, upacara, dan ekstrakurikuler kepanduan/bela diri.']
                    ];
                @endphp
                @foreach($defaults as $def)
                <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col h-full transform hover:-translate-y-2">
                    <div class="h-56 overflow-hidden relative">
                        <div class="absolute inset-0 bg-[#0f3b2a]/10 group-hover:bg-transparent transition-colors z-10"></div>
                        <div class="w-full h-full bg-emerald-50 flex items-center justify-center text-6xl group-hover:scale-110 transition-transform duration-700">
                            {{ $def['icon'] }}
                        </div>
                    </div>
                    <div class="p-8 flex-1 flex flex-col">
                        <h3 class="text-2xl font-bold text-[#1a2f24] mb-3">{{ $def['title'] }}</h3>
                        <p class="text-gray-600 leading-relaxed text-sm flex-1">{{ $def['desc'] }}</p>
                        <div class="mt-6 w-12 h-1 bg-emerald-500 rounded-full group-hover:w-full transition-all duration-500"></div>
                    </div>
                </div>
                @endforeach
                @endforelse
            </div>
        </div>
    </section>
    @endif

    <!-- 4. LINGKUNGAN PESANTREN -->
    @if($sarana->is_active_env ?? true)
    <section class="py-24 px-6 bg-[#f8f9fa] relative overflow-hidden">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-16 items-center">
            <div class="md:w-1/2 space-y-6">
                <span class="text-emerald-600 font-bold tracking-widest text-sm uppercase">Atmosfer Belajar</span>
                <h2 class="text-4xl md:text-5xl font-black text-[#1a2f24] tracking-tight leading-tight">
                    {{ $sarana->env_title ?? 'Lingkungan yang Asri dan Islami' }}
                </h2>
                <div class="prose prose-lg text-gray-600 leading-relaxed">
                    @if(isset($sarana->env_content) && $sarana->env_content)
                        {!! $sarana->env_content !!}
                    @else
                        <p>Kenyamanan lingkungan adalah salah satu pilar utama suksesnya pendidikan di PPI 104 Al Ittihaad. Kami menjaga area pesantren agar tetap hijau, bersih, dan bebas dari polusi yang mengganggu konsentrasi.</p>
                        <p>Setiap sudut pesantren dirancang untuk memancarkan nuansa edukatif dan religius. Dari tata letak asrama yang memudahkan akses ke masjid, hingga area taman hijau yang sering digunakan santri untuk muraja'ah (mengulang hafalan) di sore hari.</p>
                    @endif
                </div>
                <div class="pt-4 flex gap-4">
                    <div class="flex items-center gap-2 text-[#1a2f24] font-bold"><span class="text-emerald-500 text-2xl">✓</span> Aman</div>
                    <div class="flex items-center gap-2 text-[#1a2f24] font-bold"><span class="text-emerald-500 text-2xl">✓</span> Nyaman</div>
                    <div class="flex items-center gap-2 text-[#1a2f24] font-bold"><span class="text-emerald-500 text-2xl">✓</span> Bersih</div>
                </div>
            </div>
            
            <div class="md:w-1/2 relative">
                <!-- Decorative Elements -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-amber-100 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-emerald-200 rounded-full mix-blend-multiply filter blur-xl opacity-70"></div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-4 pt-10">
                        <div class="w-full h-48 bg-emerald-100 rounded-3xl overflow-hidden shadow-lg border border-white">
                            <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80')"></div>
                        </div>
                        <div class="w-full h-64 bg-amber-100 rounded-3xl overflow-hidden shadow-lg border border-white">
                            <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1584824486509-112e4181f1ce?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80')"></div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="w-full h-64 bg-slate-100 rounded-3xl overflow-hidden shadow-lg border border-white">
                            <div class="w-full h-full bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80')"></div>
                        </div>
                        <div class="w-full h-48 bg-emerald-50 rounded-3xl overflow-hidden shadow-lg border border-white flex items-center justify-center">
                            <span class="text-emerald-600 font-bold text-center px-4">Area Ramah<br>Santri</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- 5. GALERI SARANA -->
    @if(isset($sarana->galleries) && $sarana->galleries->count() > 0 && $sarana->is_active_gallery)
    <section class="py-24 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a2f24]">Galeri Foto</h2>
                    <p class="text-gray-500 mt-2">Potret fasilitas dan prasarana pesantren.</p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($sarana->galleries as $gallery)
                <div class="group relative rounded-2xl overflow-hidden bg-gray-100 aspect-[4/3] cursor-pointer">
                    <img src="{{ asset('storage/' . $gallery->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    @if($gallery->caption)
                    <div class="absolute bottom-0 left-0 w-full p-4 transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                        <p class="text-white font-medium text-sm">{{ $gallery->caption }}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- 6. CTA PENUTUP -->
    @if($sarana->is_active_cta ?? true)
    <section class="py-24 px-6 bg-[#f8f9fa] relative">
        <div class="max-w-5xl mx-auto bg-[#0f3b2a] rounded-[3rem] p-12 md:p-20 text-center text-white relative shadow-2xl overflow-hidden">
            @if(isset($sarana->cta_bg) && $sarana->cta_bg)
                <div class="absolute inset-0 bg-[#0f3b2a]/90 mix-blend-multiply z-10"></div>
                <img src="{{ asset('storage/' . $sarana->cta_bg) }}" class="absolute inset-0 w-full h-full object-cover z-0">
            @else
                <!-- Geometric pattern -->
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 2px, transparent 2px); background-size: 40px 40px;"></div>
            @endif
            
            <div class="relative z-20">
                <h2 class="text-3xl md:text-5xl font-black mb-6 tracking-tight">{{ $sarana->cta_title ?? 'Kunjungi Lingkungan Pesantren Kami' }}</h2>
                <p class="text-lg text-emerald-50/80 max-w-2xl mx-auto mb-10 leading-relaxed">
                    {{ $sarana->cta_desc ?? 'Silakan datang langsung untuk melihat dari dekat kebersihan, kenyamanan, dan suasana asri fasilitas pendidikan di PPI 104 Al Ittihaad.' }}
                </p>
                <a href="/p/kontak" class="inline-block bg-white text-[#0f3b2a] px-10 py-4 rounded-full font-bold text-lg hover:shadow-xl hover:bg-emerald-50 transform hover:-translate-y-1 transition-all border border-transparent hover:border-emerald-200">
                    {{ $sarana->cta_btn ?? 'Hubungi Kami' }}
                </a>
            </div>
        </div>
    </section>
    @endif

</div>
@endsection
