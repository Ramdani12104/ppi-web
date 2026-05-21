@extends('layouts.main')

@section('title', ($setting->hero_title ?? 'Perjalanan Pembangunan') . ' - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#FAFAFA] pt-24 pb-20 min-h-screen">
    
    <!-- 1. HERO SECTION -->
    <section class="max-w-7xl mx-auto px-6 mb-20 relative">
        <div class="bg-gradient-to-tr from-[#133c2a] via-[#1b503a] to-emerald-900 rounded-[3rem] p-12 md:p-20 overflow-hidden relative shadow-2xl flex flex-col items-center text-center">
            
            @if(isset($setting->hero_image) && $setting->hero_image)
            <div class="absolute inset-0 opacity-20 mix-blend-overlay">
                <img src="{{ asset('storage/' . $setting->hero_image) }}" class="w-full h-full object-cover">
            </div>
            @endif
            
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-amber-500/10 rounded-full blur-[100px] -mr-40 -mt-40 pointer-events-none"></div>
            
            <div class="relative z-10 max-w-4xl">
                <span class="inline-block px-5 py-2 bg-amber-500/20 text-amber-200 backdrop-blur-md rounded-full font-black text-xs tracking-[0.3em] uppercase mb-8 border border-amber-500/30">
                    Sadaqah Jariyah
                </span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black mb-8 text-white tracking-tight leading-[1.1]">
                    {{ $setting->hero_title ?? 'Perjalanan Pembangunan Pesantren' }}
                </h1>
                <p class="text-emerald-50/80 text-lg md:text-xl font-medium leading-relaxed max-w-2xl mx-auto">
                    {{ $setting->hero_subtitle ?? 'Merekam jejak perjuangan umat dalam membangun sarana pendidikan dan melahirkan lingkungan pesantren yang nyaman bagi para santri.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- 2. CERITA PERJUANGAN -->
    <section class="max-w-4xl mx-auto px-6 mb-24 text-center">
        <h2 class="text-3xl font-black text-slate-800 mb-8">{{ $setting->story_title ?? 'Berawal dari Gotong Royong' }}</h2>
        <div class="prose prose-lg prose-emerald mx-auto text-slate-600 leading-relaxed font-medium">
            @if(isset($setting->story_content) && $setting->story_content)
                {!! $setting->story_content !!}
            @else
                <p>Pesantren ini tidak dibangun dalam semalam. Berawal dari fasilitas yang sangat sederhana, perlahan dengan keikhlasan para pendiri, dukungan luar biasa dari wali santri, serta semangat gotong royong masyarakat sekitar, pesantren ini terus berbenah.</p>
                <p>Setiap bata yang tersusun, setiap atap yang menaungi, adalah wujud nyata dari kepedulian umat terhadap pendidikan generasi Islam masa depan. Ini adalah ruang amal jariyah yang tak pernah putus pahalanya.</p>
            @endif
        </div>
    </section>

    <!-- 3. PROGRES PEMBANGUNAN TERBARU -->
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <div class="flex items-center gap-4 mb-10">
            <div class="w-12 h-1.5 bg-emerald-600 rounded-full"></div>
            <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tight">Progres Saat Ini</h2>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            @forelse($setting->projects ?? [] as $project)
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl overflow-hidden group hover:-translate-y-1 transition-all duration-300">
                <div class="h-64 bg-gray-200 relative overflow-hidden">
                    @if($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        <img src="https://picsum.photos/800/600?nature" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @endif
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-emerald-700 text-xs font-black px-4 py-2 rounded-full shadow-sm uppercase tracking-wider">
                        {{ $project->status }}
                    </div>
                </div>
                
                <div class="p-8 md:p-10">
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">{{ $project->title }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-8">{{ $project->description }}</p>
                    
                    <!-- Progress Bar -->
                    <div class="mb-6">
                        <div class="flex justify-between text-xs font-bold text-slate-600 uppercase tracking-wider mb-3">
                            <span>Progres Fisik</span>
                            <span class="text-emerald-600">{{ $project->progress_percent }}%</span>
                        </div>
                        <div class="w-full bg-emerald-50 rounded-full h-3 overflow-hidden shadow-inner">
                            <div class="bg-emerald-500 h-3 rounded-full relative" style="width: {{ $project->progress_percent }}%">
                                <div class="absolute inset-0 bg-white/20 w-full animate-[shimmer_2s_infinite]"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Funding Details -->
                    @if($project->target_fund > 0)
                    <div class="flex items-center justify-between bg-slate-50 rounded-2xl p-5 border border-slate-100">
                        <div>
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Terkumpul</span>
                            <span class="font-black text-emerald-700 text-lg">Rp {{ number_format($project->collected_fund, 0, ',', '.') }}</span>
                        </div>
                        <div class="text-right">
                            <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Kebutuhan</span>
                            <span class="font-bold text-slate-600">Rp {{ number_format($project->target_fund, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <!-- Fallback Project -->
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl overflow-hidden group">
                <div class="h-64 bg-gray-200 relative overflow-hidden">
                    <img src="https://picsum.photos/800/600?nature" class="w-full h-full object-cover">
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur text-emerald-700 text-xs font-black px-4 py-2 rounded-full shadow-sm uppercase tracking-wider">
                        Berjalan
                    </div>
                </div>
                <div class="p-10">
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">Penyelesaian Asrama Putri 3 Lantai</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-8">Pembangunan asrama putri lantai 3 untuk menambah daya tampung santriwati tahun ajaran depan.</p>
                    <div class="mb-6">
                        <div class="flex justify-between text-xs font-bold text-slate-600 uppercase tracking-wider mb-3">
                            <span>Progres Fisik</span>
                            <span class="text-emerald-600">65%</span>
                        </div>
                        <div class="w-full bg-emerald-50 rounded-full h-3 overflow-hidden shadow-inner">
                            <div class="bg-emerald-500 h-3 rounded-full relative" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </section>

    <!-- 4. RIWAYAT LAMA (TIMELINE) -->
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <div class="bg-[#F3F4F6] rounded-[3rem] p-10 md:p-16 border border-slate-200">
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-4">
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tracking-tight">Jejak Perjalanan</h2>
                    <p class="text-slate-500 mt-2 font-medium">Rekam jejak infrastruktur yang berhasil diwujudkan bersama.</p>
                </div>
            </div>

            <div class="space-y-8 relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-1 before:bg-emerald-200">
                @forelse($setting->histories ?? [] as $index => $history)
                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    <!-- Icon -->
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-emerald-500 text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 relative z-10">
                        <span class="text-xs font-bold">✓</span>
                    </div>
                    <!-- Card -->
                    <div class="w-[calc(100%-4rem)] md:w-[calc(50%-3rem)] bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-lg hover:-translate-y-1 transition-all">
                        <span class="text-emerald-600 font-black text-sm mb-1 block tracking-wider">{{ $history->year }}</span>
                        <h3 class="font-bold text-slate-800 text-lg mb-2">{{ $history->title }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $history->description }}</p>
                        @if($history->image)
                        <div class="mt-4 h-32 rounded-xl overflow-hidden">
                            <img src="{{ asset('storage/' . $history->image) }}" class="w-full h-full object-cover">
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <!-- Fallback Timeline -->
                @php
                    $defaults = [
                        ['year' => '2024', 'title' => 'Peresmian Masjid Utama', 'desc' => 'Masjid utama berkapasitas 1000 jamaah berhasil diselesaikan dan diresmikan.'],
                        ['year' => '2023', 'title' => 'Renovasi Kelas SDIT', 'desc' => 'Pembaruan fasilitas belajar untuk 6 ruang kelas lantai 1.'],
                        ['year' => '2021', 'title' => 'Pembebasan Lahan', 'desc' => 'Gotong royong pembebasan lahan seluas 1.5 hektar untuk area asrama putra.']
                    ];
                @endphp
                @foreach($defaults as $def)
                <div class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-4 border-white bg-emerald-500 text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 relative z-10">
                        <span class="text-xs font-bold">✓</span>
                    </div>
                    <div class="w-[calc(100%-4rem)] md:w-[calc(50%-3rem)] bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                        <span class="text-emerald-600 font-black text-sm mb-1 block tracking-wider">{{ $def['year'] }}</span>
                        <h3 class="font-bold text-slate-800 text-lg mb-2">{{ $def['title'] }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">{{ $def['desc'] }}</p>
                    </div>
                </div>
                @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. GALERI GOTONG ROYONG -->
    @if(isset($setting->galleries) && count($setting->galleries) > 0)
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <h2 class="text-3xl font-black text-center text-slate-800 mb-12 tracking-tight">Potret Gotong Royong Umat</h2>
        <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">
            @foreach($setting->galleries as $gallery)
            <div class="break-inside-avoid relative rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-all">
                <img src="{{ asset('storage/' . $gallery->image) }}" class="w-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                @if($gallery->caption)
                <div class="absolute inset-x-0 bottom-0 p-6 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="text-white font-medium text-sm">{{ $gallery->caption }}</p>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- 6. DUKUNGAN PENDIDIKAN (CTA Elegan) -->
    <section class="max-w-5xl mx-auto px-6 mb-10">
        <div class="bg-white rounded-[3rem] p-10 md:p-16 border-t-[8px] border-amber-500 shadow-2xl relative overflow-hidden text-center">
            
            <div class="absolute top-0 right-0 w-64 h-64 bg-amber-50 rounded-bl-full -mr-20 -mt-20 z-0"></div>
            
            <div class="relative z-10">
                <span class="text-4xl block mb-6">🤝</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-4">{{ $setting->cta_title ?? 'Mari Membersamai Dakwah' }}</h2>
                <p class="text-slate-600 text-lg mb-12 max-w-2xl mx-auto">
                    {{ $setting->cta_description ?? 'Bukan tentang seberapa besar nilainya, melainkan tentang kebersamaan kita dalam membangun wadah yang melahirkan generasi Rabbani.' }}
                </p>

                <div class="grid md:grid-cols-2 gap-10 bg-slate-50 p-8 rounded-[2rem] text-left border border-slate-100">
                    <!-- Rekening -->
                    <div>
                        <h4 class="font-bold text-slate-800 mb-6 uppercase tracking-wider text-sm flex items-center gap-2">
                            <span class="text-amber-500 text-xl">💳</span> Transfer Bank
                        </h4>
                        <div class="space-y-4">
                            @forelse($setting->bank_accounts ?? [] as $bank)
                            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow">
                                <p class="text-xs font-bold text-slate-400 uppercase mb-1">{{ $bank['bank'] }}</p>
                                <p class="text-xl font-black text-emerald-700 tracking-wider font-mono mb-1">{{ $bank['number'] }}</p>
                                <p class="text-sm font-medium text-slate-600">a.n {{ $bank['name'] }}</p>
                            </div>
                            @empty
                            <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm">
                                <p class="text-xs font-bold text-slate-400 uppercase mb-1">Bank Syariah Indonesia (BSI)</p>
                                <p class="text-xl font-black text-emerald-700 tracking-wider font-mono mb-1">7788 9900 11</p>
                                <p class="text-sm font-medium text-slate-600">a.n PPI 104 Al-Ittihad Pembangunan</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    
                    <!-- QRIS -->
                    <div class="flex flex-col items-center justify-center border-t md:border-t-0 md:border-l border-slate-200 pt-8 md:pt-0">
                        <h4 class="font-bold text-slate-800 mb-4 uppercase tracking-wider text-sm text-center">QRIS Bebas Admin</h4>
                        <div class="w-48 h-48 bg-white rounded-2xl shadow-sm border border-slate-100 p-2 mb-4">
                            @if(isset($setting->qris_image) && $setting->qris_image)
                                <img src="{{ asset('storage/' . $setting->qris_image) }}" class="w-full h-full object-contain">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400 text-xs text-center p-4">
                                    [Gambar QRIS Belum Diunggah]
                                </div>
                            @endif
                        </div>
                        <p class="text-xs text-slate-500 font-medium">Scan menggunakan aplikasi M-Banking atau E-Wallet.</p>
                    </div>
                </div>
                
                <div class="mt-12">
                    <p class="text-sm font-medium text-slate-400 italic">"Barangsiapa yang membangun masjid karena Allah, niscaya Allah akan membangunkan untuknya rumah di Surga." (HR. Bukhari & Muslim)</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
