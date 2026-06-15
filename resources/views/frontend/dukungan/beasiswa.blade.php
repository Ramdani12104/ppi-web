@extends('layouts.main')

@section('title', ($setting->hero_title ?? 'Beasiswa Santri') . ' - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#Fdfdfd] pt-24 pb-20 min-h-screen">
    
    <!-- 1. HERO SECTION -->
    <section class="max-w-7xl mx-auto px-6 mb-24 relative">
        <div class="bg-gradient-to-tr from-[#0b3321] via-emerald-900 to-[#1e5a42] rounded-[3rem] p-12 md:p-24 overflow-hidden relative shadow-2xl flex flex-col items-center text-center">
            
            @if(isset($setting->hero_image) && $setting->hero_image)
            <div class="absolute inset-0 opacity-15 mix-blend-luminosity">
                <img src="{{ asset('storage/' . $setting->hero_image) }}" class="w-full h-full object-cover">
            </div>
            @endif
            
            <!-- Soft Light Decoration -->
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-amber-500/10 rounded-full blur-[100px] -mr-40 -mt-40 pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-emerald-500/15 rounded-full blur-[80px] -ml-20 -mb-20 pointer-events-none"></div>
            
            <div class="relative z-10 max-w-4xl">
                <span class="inline-block px-5 py-2 bg-emerald-500/30 text-emerald-100 backdrop-blur-md rounded-full font-black text-xs tracking-[0.3em] uppercase mb-8 border border-emerald-500/30 shadow-lg">
                    Generasi Peradaban
                </span>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-black mb-8 text-white tracking-tight leading-[1.1]">
                    {{ $setting->hero_title ?? 'Beasiswa Santri' }}
                </h1>
                <p class="text-emerald-50/80 text-lg md:text-xl font-medium leading-relaxed max-w-2xl mx-auto">
                    {{ $setting->hero_subtitle ?? 'Membantu perjalanan pendidikan santri dan menjaga semangat menuntut ilmu. Bersama melahirkan generasi Rabbani.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- 2. TENTANG PROGRAM BEASISWA -->
    <section class="max-w-4xl mx-auto px-6 mb-24 text-center">
        <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-8">{{ $setting->story_title ?? 'Menjaga Nyala Semangat Belajar' }}</h2>
        <div class="prose prose-lg mx-auto text-slate-600 leading-relaxed font-medium">
            @if(isset($setting->story_content) && $setting->story_content)
                {!! $setting->story_content !!}
            @else
                <p>Pendidikan Islam adalah warisan terbaik yang bisa kita siapkan untuk masa depan umat. Namun, tidak semua santri memiliki kemudahan jalan dalam menuntut ilmu. Sebagian dari mereka harus berjuang lebih keras karena keterbatasan ekonomi, status yatim, maupun kondisi sosial.</p>
                <p>Melalui program ini, pesantren membuka ruang gotong royong pendidikan. Kami mengajak para muhsinin untuk hadir sebagai perpanjangan tangan Allah dalam menjaga nyala semangat belajar para santri. Setiap doa dari lisan mereka, setiap huruf Al-Qur'an yang mereka hafalkan, insya Allah akan mengalirkan pahala jariyah bagi Anda.</p>
            @endif
        </div>
    </section>

    <!-- 3. JENIS PROGRAM BEASISWA -->
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <div class="flex items-center gap-4 mb-12 justify-center">
            <div class="w-12 h-1.5 bg-amber-500 rounded-full"></div>
            <h2 class="text-3xl font-black text-slate-800 uppercase tracking-tight">Pilihan Program Kebaikan</h2>
            <div class="w-12 h-1.5 bg-amber-500 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($setting->programs ?? [] as $program)
            <div class="bg-white rounded-[2rem] p-8 md:p-10 border border-emerald-50 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group flex flex-col relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-bl-full transition-transform duration-500 group-hover:scale-150 opacity-50"></div>
                
                <div class="relative z-10 flex-1">
                    <div class="w-16 h-16 bg-amber-50 text-amber-600 text-3xl flex items-center justify-center rounded-2xl mb-6 shadow-inner group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                        {{ $program->icon ?? '🎓' }}
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-slate-800 mb-3">{{ $program->title }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">{{ $program->description }}</p>
                </div>
                
                <div class="relative z-10 mt-auto pt-6 border-t border-slate-50 flex items-center gap-2">
                    <span class="text-emerald-600 font-black text-[10px] uppercase tracking-widest bg-emerald-50 px-3 py-1.5 rounded-lg">Target: {{ $program->target_program ?? 'Santri PPI 104' }}</span>
                </div>
            </div>
            @empty
            @php
                $defaultProgs = [
                    ['t' => 'Beasiswa Pendidikan Yatim', 'd' => 'Bantuan penuh biaya pendidikan bagi santri berstatus yatim piatu yang memiliki semangat belajar tinggi.', 'i' => '🤲', 'target' => '50 Santri/Tahun'],
                    ['t' => 'Beasiswa Tahfidz Qur\'an', 'd' => 'Apresiasi khusus bagi santri penghafal Al-Qur\'an untuk mendukung biaya hidup dan perlengkapan menghafal mereka.', 'i' => '📖', 'target' => 'Santri Pilihan'],
                    ['t' => 'Orang Tua Asuh', 'd' => 'Program pendampingan jangka panjang dimana satu donatur membiayai satu santri dhuafa secara rutin per bulan.', 'i' => '👨‍👩‍👦', 'target' => 'Santri Dhuafa'],
                ];
            @endphp
            @foreach($defaultProgs as $dp)
            <div class="bg-white rounded-[2rem] p-10 border border-emerald-50 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group flex flex-col relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-bl-full transition-transform duration-500 group-hover:scale-150 opacity-50"></div>
                <div class="relative z-10 flex-1">
                    <div class="w-16 h-16 bg-amber-50 text-amber-600 text-3xl flex items-center justify-center rounded-2xl mb-6 shadow-inner group-hover:bg-amber-500 group-hover:text-white transition-colors duration-300">
                        {{ $dp['i'] }}
                    </div>
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">{{ $dp['t'] }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">{{ $dp['d'] }}</p>
                </div>
                <div class="relative z-10 mt-auto pt-6 border-t border-slate-50 flex items-center gap-2">
                    <span class="text-emerald-600 font-black text-[10px] uppercase tracking-widest bg-emerald-50 px-3 py-1.5 rounded-lg">Target: {{ $dp['target'] }}</span>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </section>

    <!-- 4. PERJALANAN DAN KISAH SANTRI (GALERI / PENERIMA MANFAAT) -->
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <div class="bg-amber-50/50 rounded-[3rem] p-8 md:p-16 border border-amber-100/50">
            <div class="text-center mb-12">
                <span class="text-amber-600 font-black text-xs uppercase tracking-[0.2em] mb-4">Penerima Manfaat</span>
                <h2 class="text-3xl font-black text-slate-800 mb-4">Santri Penerima Manfaat</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">Sekilas potret senyum dan cita-cita para santri penerima beasiswa pendidikan Al-Ittihad.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($setting->galleries ?? [] as $gallery)
                <div class="bg-white rounded-3xl p-4 shadow-sm border border-slate-100 group hover:shadow-lg transition-all">
                    <div class="rounded-2xl overflow-hidden h-56 mb-5">
                        <img src="{{ asset('storage/' . $gallery->image) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" alt="{{ $gallery->title }}">
                    </div>
                    <div class="px-2 pb-2">
                        @if($gallery->title)
                            <h4 class="font-bold text-slate-800 mb-2">{{ $gallery->title }}</h4>
                        @endif
                        @if($gallery->caption)
                            <p class="text-sm text-slate-500 italic leading-relaxed">"{{ $gallery->caption }}"</p>
                        @endif
                    </div>
                </div>
                @empty
                @php
                    $defaultRecipients = [
                        [
                            'name' => 'Wildan Ghozali',
                            'story' => 'Santri Tahfidz asal Garut. Berkat beasiswa ini, Wildan kini telah menyelesaikan hafalan 15 Juz dan aktif dalam organisasi santri.',
                            'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=400'
                        ],
                        [
                            'name' => 'Siti Aminah',
                            'story' => 'Santri Dhuafa Jenjang MA. Berhasil mempertahankan predikat juara umum dan bercita-cita melanjutkan studi ke bidang kedokteran syariah.',
                            'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=400'
                        ],
                        [
                            'name' => 'Muhammad Ridwan',
                            'story' => 'Santri Yatim Jenjang MTs. Memiliki ketertarikan tinggi pada astronomi Islam (ilmu falak) dan aktif di ekstrakurikuler kepramukaan.',
                            'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=400'
                        ]
                    ];
                @endphp
                @foreach($defaultRecipients as $recipient)
                <div class="bg-white rounded-3xl p-4 shadow-sm border border-slate-100 group hover:shadow-lg transition-all">
                    <div class="rounded-2xl overflow-hidden h-56 mb-5">
                        <img src="{{ $recipient['image'] }}" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700" alt="{{ $recipient['name'] }}">
                    </div>
                    <div class="px-2 pb-2">
                        <h4 class="font-bold text-slate-800 mb-2">{{ $recipient['name'] }}</h4>
                        <p class="text-sm text-slate-500 italic leading-relaxed">"{{ $recipient['story'] }}"</p>
                    </div>
                </div>
                @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- 5. PROGRAM YANG SEDANG BERJALAN (PROGRESS) -->
    <section class="max-w-5xl mx-auto px-6 mb-24">
        <h2 class="text-3xl font-black text-slate-800 mb-10 text-center">Program Berjalan Saat Ini</h2>
        
        <div class="space-y-8">
            @forelse($setting->histories ?? [] as $history)
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-md overflow-hidden flex flex-col md:flex-row group hover:shadow-xl transition-all">
                @if($history->image)
                <div class="md:w-2/5 h-48 md:h-auto bg-slate-200 overflow-hidden">
                    <img src="{{ asset('storage/' . $history->image) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
                @endif
                
                <div class="p-8 md:p-10 {{ $history->image ? 'md:w-3/5' : 'w-full' }} flex flex-col justify-center">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-2xl font-bold text-slate-800">{{ $history->program_name }}</h3>
                        <span class="bg-emerald-50 text-emerald-600 text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-wider">{{ $history->status }}</span>
                    </div>
                    
                    <div class="flex items-center gap-6 mb-8 text-sm font-medium text-slate-500">
                        <div class="flex items-center gap-2">
                            <span class="text-amber-500">👥</span> {{ $history->receiver_count }} Santri Penerima
                        </div>
                    </div>
                    
                    <div>
                        <div class="flex justify-between text-xs font-bold text-slate-600 uppercase tracking-wider mb-3">
                            <span>Terkumpul</span>
                            <span class="text-emerald-600">{{ $history->progress_percent }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden mb-3 shadow-inner">
                            <div class="bg-emerald-500 h-3 rounded-full relative" style="width: {{ $history->progress_percent }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs font-bold">
                            <span class="text-emerald-700">Rp {{ number_format($history->collected_fund, 0, ',', '.') }}</span>
                            <span class="text-slate-400">Target: Rp {{ number_format($history->target_fund, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-md p-10 text-center text-slate-500 italic">
                Belum ada kampanye beasiswa khusus yang sedang berjalan.
            </div>
            @endforelse
        </div>
    </section>

    <!-- 6 & 7. CARA MEMBERSAMAI PROGRAM & CTA PENUTUP -->
    <section class="max-w-6xl mx-auto px-6 mb-10">
        <div class="bg-gradient-to-br from-emerald-800 to-[#0e442d] rounded-[3rem] p-10 md:p-20 shadow-2xl relative overflow-hidden">
            
            <!-- Soft Decor -->
            <div class="absolute top-0 right-0 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl -mr-20 -mt-20 pointer-events-none"></div>
            
            <div class="relative z-10 text-center mb-16">
                <span class="text-4xl block mb-6">🤝</span>
                <h2 class="text-3xl md:text-5xl font-black text-white mb-6">{{ $setting->cta_title ?? 'Mari Ikut Membersamai' }}</h2>
                <p class="text-emerald-100 text-lg md:text-xl max-w-3xl mx-auto font-medium leading-relaxed">
                    {{ $setting->cta_description ?? 'Setiap rupiah yang Anda sisihkan adalah benih peradaban yang kelak akan tumbuh melalui lisan-lisan yang mendoakan dan mengajarkan Al-Qur\'an.' }}
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Rekening -->
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20">
                    <h4 class="font-bold text-emerald-200 mb-6 uppercase tracking-widest text-sm flex items-center gap-2">
                        <span class="text-xl">💳</span> Transfer Rekening
                    </h4>
                    <div class="space-y-4">
                        @forelse($setting->bank_accounts ?? [] as $bank)
                        <div class="bg-white p-5 rounded-2xl shadow-sm hover:-translate-y-1 transition-transform">
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1">{{ $bank['bank'] }}</p>
                            <p class="text-2xl font-black text-emerald-700 tracking-wider font-mono mb-1">{{ $bank['number'] }}</p>
                            <p class="text-sm font-medium text-slate-600">a.n {{ $bank['name'] }}</p>
                        </div>
                        @empty
                        <div class="bg-white p-5 rounded-2xl shadow-sm">
                            <p class="text-xs font-bold text-slate-400 uppercase mb-1">Bank Syariah Indonesia (BSI)</p>
                            <p class="text-2xl font-black text-emerald-700 tracking-wider font-mono mb-1">1122 3344 55</p>
                            <p class="text-sm font-medium text-slate-600">a.n Beasiswa PPI 104 Al-Ittihad</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                
                <!-- QRIS -->
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 flex flex-col items-center justify-center">
                    <h4 class="font-bold text-emerald-200 mb-6 uppercase tracking-widest text-sm flex items-center gap-2">
                        <span class="text-xl">📱</span> Scan QRIS
                    </h4>
                    <div class="w-56 h-56 bg-white rounded-2xl shadow-sm border border-white/40 p-3 mb-6 relative group overflow-hidden">
                        @if(isset($setting->qris_image) && $setting->qris_image)
                            <img src="{{ asset('storage/' . $setting->qris_image) }}" class="w-full h-full object-contain">
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400 text-xs text-center p-4 rounded-xl">
                                [Gambar QRIS Belum Diunggah]
                            </div>
                        @endif
                    </div>
                    <a href="/p/kontak" class="w-full py-4 bg-emerald-500 hover:bg-emerald-400 text-white rounded-xl font-bold uppercase tracking-widest text-sm transition-colors text-center shadow-lg shadow-emerald-500/20">
                        Konfirmasi Dukungan
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
