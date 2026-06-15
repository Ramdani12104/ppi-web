@extends('layouts.main')

@section('title', 'Tendik Pesantren - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#f8f9fa] overflow-x-hidden min-h-screen">

    <!-- 1. HERO SECTION -->
    <section class="relative min-h-[50vh] flex items-center overflow-hidden pt-20">
        <div class="absolute inset-0 bg-[#0f3b2a]"></div>
        <!-- Islamic geometric pattern fallback -->
        <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 30px 30px;"></div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center py-20 animate-fade-in-up">
            <span class="inline-block px-4 py-2 bg-emerald-500/20 text-emerald-100 backdrop-blur-md rounded-full font-bold text-xs tracking-[0.2em] uppercase mb-6 border border-emerald-500/30">
                Keluarga Besar Pendidik & Staf
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-white leading-[1.1] tracking-tight mb-6 font-serif">
                Tendik & Asatidz Pesantren
            </h1>
            <p class="text-lg md:text-xl text-emerald-50/90 leading-relaxed max-w-2xl mx-auto font-medium">
                Sistem koordinasi kepemimpinan, tenaga pendidik (asatidz), dan staf kependidikan (tendik) dalam membimbing santri secara terpadu di tiap jenjang.
            </p>
        </div>
        
        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-[60px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.08,130.83,119.28,197.93,109.52Z" fill="#f8f9fa"></path>
            </svg>
        </div>
    </section>

    <!-- 2. TABBED JABATAN SECTION -->
    <section class="py-16 px-6 relative z-20 -mt-10">
        <div class="max-w-7xl mx-auto">
            
            <!-- Tabs Menu -->
            <div class="flex flex-wrap justify-center gap-2 md:gap-4 mb-16 bg-white p-2.5 rounded-2xl md:rounded-full shadow-md max-w-5xl mx-auto border border-gray-100">
                @php
                    $stages = [
                        'kober' => ['name' => 'KOBER', 'desc' => 'Kelompok Bermain'],
                        'ra' => ['name' => 'RA', 'desc' => 'Raudhatul Athfal'],
                        'sdit' => ['name' => 'SDIT', 'desc' => 'SD Islam Terpadu'],
                        'mdt' => ['name' => 'MDT', 'desc' => 'Madrasah Diniyah'],
                        'mts' => ['name' => 'MTs', 'desc' => 'Madrasah Tsanawiyah'],
                        'ma' => ['name' => 'MA', 'desc' => 'Madrasah Aliyah'],
                        'rh' => ['name' => 'RH', 'desc' => 'Raudhatul Huffadz'],
                        'musrif_musyrifah' => ['name' => 'Musrif & Musyrifah', 'desc' => 'Pembina Asrama'],
                        'timqu' => ['name' => 'Tim Qur\'an', 'desc' => 'Hafalan & Tahfidz'],
                        'tendik' => ['name' => 'Staf / Tendik', 'desc' => 'Staf Pendukung']
                    ];
                    $firstStage = null;
                @endphp
                @foreach($stages as $key => $val)
                    @if(isset($teachers[$key]) && count($teachers[$key]) > 0 && !$firstStage)
                        @php $firstStage = $key; @endphp
                    @endif
                    <button 
                        onclick="switchTab('{{ $key }}')" 
                        id="tab-btn-{{ $key }}"
                        class="tab-btn px-5 py-3 md:px-7 md:py-3.5 text-xs md:text-sm font-black uppercase tracking-wider rounded-xl md:rounded-full transition-all duration-300 flex flex-col items-center gap-0.5 min-w-[100px] md:min-w-[130px] border border-transparent {{ $loop->first ? 'active bg-emerald-700 text-white shadow-lg shadow-emerald-700/20' : 'text-gray-500 hover:text-emerald-700 hover:bg-emerald-50' }}"
                    >
                        <span>{{ $val['name'] }}</span>
                        <span class="text-[9px] font-medium tracking-normal lowercase text-opacity-70">{{ $val['desc'] }}</span>
                    </button>
                @endforeach
            </div>

            <!-- Tab Contents -->
            <div class="relative min-h-[400px]">
                @foreach($stages as $key => $val)
                    @php
                        $stageTeachers = $teachers[$key] ?? collect([]);
                        
                        // Exclude general Mudir Am (KH. Ahmad Al-Ittihaad) from unit-specific page tabs
                        $stageTeachers = $stageTeachers->filter(fn($t) => !str_contains(strtolower($t->role), 'pimpinan umum') && !str_contains(strtolower($t->role), 'mudir am'));
                        
                        // Categorize stage teachers
                        if (in_array($key, ['musrif_musyrifah', 'timqu', 'tendik'])) {
                            // Heads (Level 1) is ONLY the main Koordinator
                            $heads = $stageTeachers->filter(fn($t) => 
                                (str_contains(strtolower($t->role), 'koordinator') && 
                                 !str_contains(strtolower($t->role), 'putra') && 
                                 !str_contains(strtolower($t->role), 'putri')) ||
                                 str_contains(strtolower($t->role), 'koordinator utama')
                            );
                            
                            // Wakas/Pembina (Level 2) are the Pembina/Ketua/Koordinator Putra/Putri
                            $wakas = $stageTeachers->filter(fn($t) => 
                                (str_contains(strtolower($t->role), 'ketua') || 
                                 str_contains(strtolower($t->role), 'pembina') ||
                                 str_contains(strtolower($t->role), 'koordinator') ||
                                 str_contains(strtolower($t->role), 'wakil') ||
                                 str_contains(strtolower($t->role), 'waka')) &&
                                !$heads->contains('id', $t->id)
                            );
                            
                            // Staff (Level 3) are the rest
                            $staff = $stageTeachers->filter(fn($t) => 
                                !$heads->contains('id', $t->id) && 
                                !$wakas->contains('id', $t->id)
                            );
                        } else {
                            // Default stage categorization (schools and RH)
                            $heads = $stageTeachers->filter(fn($t) => 
                                str_contains(strtolower($t->role), 'mudir') || 
                                str_contains(strtolower($t->role), 'ketua') || 
                                str_contains(strtolower($t->role), 'koordinator') ||
                                str_contains(strtolower($t->role), 'kepala')
                            );
                            
                            $wakas = $stageTeachers->filter(fn($t) => 
                                (str_contains(strtolower($t->role), 'waka') || 
                                 str_contains(strtolower($t->role), 'wakil') || 
                                 str_contains(strtolower($t->role), 'sekretaris') || 
                                 str_contains(strtolower($t->role), 'bendahara') || 
                                 str_contains(strtolower($t->role), 'pembina') ||
                                 str_contains(strtolower($t->role), 'ktu')) &&
                                !$heads->contains('id', $t->id)
                            );
                            
                            $staff = $stageTeachers->filter(fn($t) => 
                                !$heads->contains('id', $t->id) && 
                                !$wakas->contains('id', $t->id)
                            );
                        }
                    @endphp
                    <div 
                        id="tab-content-{{ $key }}" 
                        class="tab-content transition-all duration-500 transform {{ $key === ($firstStage ?? 'kober') ? 'opacity-100 translate-y-0 block' : 'opacity-0 translate-y-8 hidden' }}"
                    >
                        @if($stageTeachers->isEmpty())
                            <div class="text-center py-16 bg-white rounded-3xl shadow-sm border border-gray-100 max-w-lg mx-auto">
                                <span class="text-5xl block mb-4">👥</span>
                                <h3 class="text-lg font-bold text-gray-700 mb-2">Data Belum Tersedia</h3>
                                <p class="text-gray-500 text-sm">Tenaga pendidik untuk jenjang {{ $val['name'] }} sedang dalam proses input data.</p>
                            </div>
                        @else
                            <!-- Hierarchical Pathway Tree Layout for this Stage -->
                            <div class="relative flex flex-col items-center">
                                
                                <!-- Central Connecting Line (Visible on desktop) -->
                                <div class="absolute top-16 bottom-24 left-1/2 w-0.5 bg-emerald-100 -translate-x-1/2 z-0 hidden md:block"></div>

                                <!-- 1. HEAD LEVEL (Mudir / Ketua / Koordinator) -->
                                <div class="relative flex flex-col items-center mb-10 w-full">
                                    <div class="bg-gradient-to-r from-amber-500 to-amber-600 text-white px-5 py-1.5 rounded-full font-serif font-black uppercase text-[10px] tracking-wider shadow-md mb-6 relative z-10 border border-amber-400/20">
                                        @if($key === 'musrif_musyrifah')
                                            Ketua Pembina Asrama
                                        @elseif($key === 'timqu')
                                            Koordinator Tahfidz & Quran
                                        @elseif($key === 'tendik')
                                            Koordinator / Kepala Staf
                                        @else
                                            Kepala Satuan / Mudir {{ $val['name'] }}
                                        @endif
                                    </div>
                                    
                                    @if($heads->isNotEmpty())
                                        <div class="grid grid-cols-1 md:grid-cols-{{ min($heads->count(), 3) }} gap-8 max-w-5xl w-full justify-center justify-items-center relative z-10">
                                            @foreach($heads as $head)
                                                <div class="group bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 border border-emerald-100 flex flex-col md:flex-row max-w-lg w-full transform hover:-translate-y-1">
                                                    <div class="md:w-1/3 h-44 md:h-auto relative overflow-hidden flex items-center justify-center bg-gradient-to-br from-emerald-800 to-teal-900 shrink-0">
                                                        @if($head->photo)
                                                            <img src="{{ asset('storage/' . $head->photo) }}" alt="{{ $head->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                                        @else
                                                            <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
                                                            <div class="relative z-10 w-20 h-20 rounded-full border-4 border-white bg-white shadow-md overflow-hidden flex items-center justify-center text-emerald-800 font-bold text-3xl">
                                                                {{ substr($head->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="p-6 flex-1 flex flex-col justify-center text-center md:text-left">
                                                        <h3 class="text-xl font-serif font-black text-emerald-955 mb-1 tracking-tight">
                                                            {{ $head->name }}
                                                        </h3>
                                                        <span class="inline-block px-3 py-0.5 bg-amber-50 text-amber-800 text-[10px] font-black uppercase tracking-wider rounded-full border border-amber-100 mb-3 mx-auto md:mx-0">
                                                            {{ $head->role }}
                                                        </span>
                                                        <div class="text-left">
                                                            <h4 class="text-[9px] font-black uppercase tracking-wider text-emerald-700 mb-1 border-b border-gray-100 pb-0.5">Tanggung Jawab</h4>
                                                            <p class="text-gray-600 leading-relaxed text-xs">
                                                                {{ $head->tasks ?? 'Mengelola operasional dan memimpin program di jenjang ini.' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <!-- Default fallback card if no Mudir created yet -->
                                        <div class="group bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 p-6 max-w-sm w-full text-center relative z-10">
                                            <div class="w-14 h-14 bg-emerald-50 rounded-full flex items-center justify-center text-emerald-800 text-xl font-bold mx-auto mb-3">👤</div>
                                            <h3 class="text-sm font-bold text-gray-500">Mudir / Kepala Jenjang</h3>
                                            <p class="text-xs text-gray-400 mt-1">Belum diset dari halaman admin</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Connecting line for mobile -->
                                <div class="w-0.5 h-10 bg-emerald-100 mx-auto z-0 relative block md:hidden"></div>

                                <!-- 2. WAKA / MANAGEMENT LEVEL (Jika Ada) -->
                                @if($wakas->isNotEmpty())
                                    <div class="relative flex flex-col items-center mb-10 w-full">
                                        <div class="bg-gradient-to-r from-emerald-700 to-emerald-800 text-white px-5 py-1.5 rounded-full font-serif font-black uppercase text-[10px] tracking-wider shadow-md mb-6 relative z-10 border border-emerald-600/20">
                                            @if($key === 'musrif_musyrifah')
                                                Ketua & Pembina Asrama
                                            @elseif($key === 'timqu')
                                                Koordinator Bidang
                                            @elseif($key === 'tendik')
                                                Pengawas / Supervisor
                                            @elseif($key === 'rh')
                                                Wakil / Pengajar Utama
                                            @else
                                                Staf Manajemen / Wakil
                                            @endif
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-{{ min($wakas->count(), 3) }} gap-6 max-w-5xl w-full justify-center justify-items-center relative z-10">
                                            @foreach($wakas as $waka)
                                                <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-500 border border-gray-100 flex flex-col h-full max-w-xs w-full text-center transform hover:-translate-y-1">
                                                    <div class="h-36 relative overflow-hidden flex items-center justify-center bg-gradient-to-br from-emerald-700 to-teal-800">
                                                        @if($waka->photo)
                                                            <img src="{{ asset('storage/' . $waka->photo) }}" alt="{{ $waka->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                                        @else
                                                            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
                                                            <div class="relative z-10 w-16 h-16 rounded-full border-2 border-white bg-white shadow-sm overflow-hidden flex items-center justify-center text-emerald-800 font-bold text-xl">
                                                                {{ substr($waka->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="p-5 flex-1 flex flex-col">
                                                        <h3 class="text-base font-bold text-emerald-950 mb-0.5 tracking-tight line-clamp-2 leading-tight">
                                                            {{ $waka->name }}
                                                        </h3>
                                                        <span class="inline-block px-2.5 py-0.5 bg-emerald-50 text-emerald-800 text-[8px] font-black uppercase tracking-wider rounded-full border border-emerald-100 mb-3 mx-auto">
                                                            {{ $waka->role }}
                                                        </span>
                                                        <p class="text-gray-500 text-xs leading-relaxed text-left flex-1">
                                                            {{ $waka->tasks ?? 'Membantu koordinasi operasional dan administrasi di lingkup unit.' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="w-0.5 h-10 bg-emerald-100 mx-auto z-0 relative block md:hidden"></div>
                                @endif

                                <!-- 3. TEACHERS & STAFF LEVEL (Asatidz / Staf) -->
                                <div class="relative flex flex-col items-center mb-10 w-full">
                                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-5 py-1.5 rounded-full font-serif font-black uppercase text-[10px] tracking-wider shadow-md mb-6 relative z-10 border border-emerald-500/20">
                                        @if($key === 'tendik')
                                            Staf Operasional / Pelaksana
                                        @elseif($key === 'musrif_musyrifah')
                                            Pembina Kamar / Musrif & Musyrifah
                                        @elseif($key === 'timqu')
                                            Asatidz / Pembina Tahfidz
                                        @elseif($key === 'rh')
                                            Asatidz / Pengajar Tahfidz
                                        @else
                                            Tenaga Pendidik / Asatidz
                                        @endif
                                    </div>
                                    
                                    @if($staff->isNotEmpty())
                                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full relative z-10">
                                            @foreach($staff as $teacher)
                                                <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 flex flex-col h-full transform hover:-translate-y-1.5">
                                                    <div class="h-48 relative overflow-hidden flex items-center justify-center">
                                                        @if($teacher->photo)
                                                            <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                                        @else
                                                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-800 to-teal-900"></div>
                                                            <div class="absolute inset-0 opacity-15" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
                                                            <div class="relative z-10 w-20 h-20 rounded-full border-4 border-white bg-white shadow-md overflow-hidden flex items-center justify-center text-emerald-800 font-bold text-3xl">
                                                                {{ substr($teacher->name, 0, 1) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="p-6 flex-1 flex flex-col text-center">
                                                        <h3 class="text-xl font-serif font-black text-emerald-955 mb-1 tracking-tight">
                                                            {{ $teacher->name }}
                                                        </h3>
                                                        <span class="inline-block px-3 py-0.5 bg-emerald-50 text-emerald-800 text-[10px] font-black uppercase tracking-wider rounded-full border border-emerald-100 mb-4 mx-auto">
                                                            {{ $teacher->role }}
                                                        </span>
                                                        <div class="text-left flex-1 flex flex-col">
                                                            <h4 class="text-[10px] font-black uppercase tracking-wider text-amber-600 mb-1.5 border-b border-gray-100 pb-1 flex items-center gap-1">
                                                                <span>📝</span> Tugas & Wewenang
                                                            </h4>
                                                            <p class="text-gray-600 leading-relaxed text-xs flex-1">
                                                                {{ $teacher->tasks ?? 'Menyelenggarakan kegiatan pengajaran, membimbing akhlak serta karakter islami santri secara berkala.' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-6 bg-white rounded-3xl border border-gray-100 max-w-sm w-full relative z-10">
                                            <p class="text-gray-400 text-xs font-medium">Staf pendukung / pengajar belum tersedia.</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Connecting line for mobile -->
                                <div class="w-0.5 h-10 bg-emerald-100 mx-auto z-0 relative block md:hidden"></div>

                                <!-- 4. BASE LEVEL: Santri / Lingkungan -->
                                <div class="relative flex flex-col items-center">
                                    <div class="group bg-white rounded-3xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-500 border border-gray-100 max-w-md w-full relative z-10 p-6 text-center flex flex-col items-center">
                                        <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center mb-3 text-emerald-800 text-3xl shadow-inner animate-pulse">
                                            @if($key === 'tendik')
                                                🏫
                                            @else
                                                🎓
                                            @endif
                                        </div>
                                        <h3 class="text-lg font-serif font-black text-emerald-950 mb-1 tracking-tight">
                                            @if($key === 'tendik')
                                                Lingkungan & Fasilitas Pesantren
                                            @elseif($key === 'musrif_musyrifah')
                                                Santri Asrama (Binaan)
                                            @elseif($key === 'timqu')
                                                Santri Penghafal Qur'an
                                            @elseif($key === 'rh')
                                                Santri Raudhatul Huffadz
                                            @else
                                                Santri / Peserta Didik {{ $val['name'] }}
                                            @endif
                                        </h3>
                                        <p class="text-gray-500 leading-relaxed text-xs">
                                            @if($key === 'tendik')
                                                Menjaga stabilitas, kebersihan, dan kenyamanan infrastruktur penunjang pendidikan.
                                            @elseif($key === 'musrif_musyrifah')
                                                Para santri yang dibina secara intensif mengenai adab, kemandirian, dan ibadah harian.
                                            @elseif($key === 'timqu')
                                                Para santri tahfidz yang dibimbing makhraj, tajwid, dan kelancaran hafalan Al-Qur'an.
                                            @elseif($key === 'rh')
                                                Para santri program khusus tahfidz mutqin yang berjuang menghafal 30 juz Al-Qur'an dengan adab & akhlak mulia.
                                            @else
                                                Seluruh siswa-siswi terdaftar pada jenjang {{ $val['name'] }} yang dibimbing secara intelektual dan spiritual.
                                            @endif
                                        </p>
                                    </div>
                                </div>

                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    </section>

</div>

<script>
    function switchTab(stageKey) {
        // Hide all contents
        const contents = document.querySelectorAll('.tab-content');
        contents.forEach(content => {
            content.classList.remove('opacity-100', 'translate-y-0', 'block');
            content.classList.add('opacity-0', 'translate-y-8', 'hidden');
        });

        // Deactivate all buttons
        const buttons = document.querySelectorAll('.tab-btn');
        buttons.forEach(btn => {
            btn.classList.remove('active', 'bg-emerald-700', 'text-white', 'shadow-lg', 'shadow-emerald-700/20');
            btn.classList.add('text-gray-500', 'hover:text-emerald-700', 'hover:bg-emerald-50');
        });

        // Show active content
        const activeContent = document.getElementById('tab-content-' + stageKey);
        if (activeContent) {
            activeContent.classList.remove('hidden');
            setTimeout(() => {
                activeContent.classList.remove('opacity-0', 'translate-y-8');
                activeContent.classList.add('opacity-100', 'translate-y-0', 'block');
            }, 50);
        }

        // Activate active button
        const activeBtn = document.getElementById('tab-btn-' + stageKey);
        if (activeBtn) {
            activeBtn.classList.remove('text-gray-500', 'hover:text-emerald-700', 'hover:bg-emerald-50');
            activeBtn.classList.add('active', 'bg-emerald-700', 'text-white', 'shadow-lg', 'shadow-emerald-700/20');
        }
    }
    
    // Auto initialize to first active tab
    document.addEventListener('DOMContentLoaded', () => {
        const activeBtn = document.querySelector('.tab-btn.active');
        if (activeBtn) {
            const key = activeBtn.id.replace('tab-btn-', '');
            switchTab(key);
        }
    });
</script>
@endsection
