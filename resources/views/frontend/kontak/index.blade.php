@extends('layouts.main')

@section('title', ($setting->hero_title ?? 'Hubungi Kami') . ' - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#f8f9fa] pt-24 pb-20 min-h-screen">
    
    <!-- 1. HERO SECTION -->
    <section class="max-w-7xl mx-auto px-6 mb-16 relative">
        <div class="bg-gradient-to-br from-[#0f3b2a] to-emerald-900 rounded-[3rem] p-10 md:p-16 overflow-hidden relative shadow-2xl">
            <!-- Decorative Elements -->
            <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-emerald-500/20 rounded-full blur-[80px] -mr-40 -mt-40"></div>
            <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-amber-500/20 rounded-full blur-[60px] -ml-20 -mb-20"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                <div class="md:w-2/3 text-white">
                    <span class="inline-block px-4 py-1.5 bg-emerald-500/30 text-emerald-100 backdrop-blur-md rounded-full font-bold text-xs tracking-[0.2em] uppercase mb-6 border border-emerald-500/50">
                        Pusat Informasi
                    </span>
                    <h1 class="text-4xl md:text-6xl font-black mb-6 tracking-tight leading-tight">
                        {{ $setting->hero_title ?? 'Hubungi Kami' }}
                    </h1>
                    <p class="text-emerald-50/90 text-lg md:text-xl font-medium leading-relaxed max-w-2xl">
                        {{ $setting->hero_subtitle ?? 'Silakan hubungi admin atau humas yang sesuai untuk mendapatkan informasi lebih cepat dan tepat sasaran mengenai pesantren kami.' }}
                    </p>
                </div>
                
                <div class="md:w-1/3 flex justify-center">
                    @if(isset($setting->hero_image) && $setting->hero_image)
                        <img src="{{ asset('storage/' . $setting->hero_image) }}" class="w-full max-w-[250px] object-contain drop-shadow-2xl animate-fade-in-up">
                    @else
                        <!-- Fallback Illustration -->
                        <div class="w-48 h-48 bg-white/10 backdrop-blur-md rounded-full flex items-center justify-center border-4 border-white/20 shadow-[0_0_50px_rgba(16,185,129,0.3)]">
                            <span class="text-8xl">📞</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- 2. PILIHAN KONTAK ADMIN -->
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-black text-[#1a2f24]">Pilih Admin Tujuan Anda</h2>
            <p class="text-gray-500 mt-3">Klik tombol WhatsApp di bawah ini untuk memulai obrolan langsung.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($setting->contacts ?? [] as $contact)
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group flex flex-col relative overflow-hidden">
                <!-- Hover Decoration -->
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -mr-10 -mt-10 transition-transform duration-500 group-hover:scale-150 opacity-0 group-hover:opacity-100 z-0"></div>
                
                <div class="relative z-10 flex flex-col h-full">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center shrink-0 overflow-hidden shadow-inner">
                            @if($contact->photo)
                                <img src="{{ asset('storage/' . $contact->photo) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl">👤</span>
                            @endif
                        </div>
                        <div>
                            <span class="text-[10px] font-black text-emerald-600 uppercase tracking-wider bg-emerald-50 px-2 py-0.5 rounded-md">{{ $contact->category ?? 'Admin' }}</span>
                            <h3 class="font-bold text-gray-800 text-lg leading-tight mt-1">{{ $contact->name }}</h3>
                            <p class="text-xs text-gray-500 font-medium">{{ $contact->position }}</p>
                        </div>
                    </div>
                    
                    <p class="text-sm text-gray-600 mb-6 flex-1">{{ $contact->description }}</p>
                    
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->whatsapp_number) }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20bd5a] text-white py-3 rounded-xl font-bold transition-colors shadow-[0_10px_20px_rgba(37,211,102,0.2)]">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z" /></svg>
                        Hubungi via WA
                    </a>
                </div>
            </div>
            @empty
            <!-- Fallback Data -->
            @php
                $defaults = [
                    ['name' => 'Ust. Admin', 'pos' => 'Humas Pesantren', 'cat' => 'Humas', 'wa' => '628123456789', 'desc' => 'Informasi umum seputar pendaftaran, profil, dan humas lembaga.'],
                    ['name' => 'Admin KOBER', 'pos' => 'Bagian Kober', 'cat' => 'Kober', 'wa' => '628123456789', 'desc' => 'Tanya jawab seputar program dan pendaftaran Kelompok Bermain.'],
                    ['name' => 'Admin RA', 'pos' => 'Bagian RA', 'cat' => 'Raudhatul Athfal', 'wa' => '628123456789', 'desc' => 'Tanya jawab seputar pendidikan dan pendaftaran tingkat RA.'],
                    ['name' => 'Admin SDIT', 'pos' => 'Bagian SDIT', 'cat' => 'SDIT', 'wa' => '628123456789', 'desc' => 'Tanya jawab seputar kurikulum, biaya, dan pendaftaran SDIT.'],
                    ['name' => 'Admin MDT', 'pos' => 'Bagian MDT', 'cat' => 'Madrasah Diniyah', 'wa' => '628123456789', 'desc' => 'Informasi khusus mengenai program pendidikan ngaji sore.'],
                    ['name' => 'Admin MTs', 'pos' => 'Bagian MTs', 'cat' => 'Tsanawiyah', 'wa' => '628123456789', 'desc' => 'Pusat informasi penerimaan santri baru tingkat menengah pertama.'],
                    ['name' => 'Admin MA', 'pos' => 'Bagian MA', 'cat' => 'Aliyah', 'wa' => '628123456789', 'desc' => 'Pusat informasi pendaftaran dan program unggulan Madrasah Aliyah.']
                ];
            @endphp
            @foreach($defaults as $def)
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 group flex flex-col relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -mr-10 -mt-10 transition-transform duration-500 group-hover:scale-150 opacity-0 group-hover:opacity-100 z-0"></div>
                
                <div class="relative z-10 flex flex-col h-full">
                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center shrink-0 overflow-hidden shadow-inner text-3xl">👤</div>
                        <div>
                            <span class="text-[10px] font-black text-emerald-600 uppercase tracking-wider bg-emerald-50 px-2 py-0.5 rounded-md">{{ $def['cat'] }}</span>
                            <h3 class="font-bold text-gray-800 text-lg leading-tight mt-1">{{ $def['name'] }}</h3>
                            <p class="text-xs text-gray-500 font-medium">{{ $def['pos'] }}</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mb-6 flex-1">{{ $def['desc'] }}</p>
                    <a href="https://wa.me/{{ $def['wa'] }}" target="_blank" class="w-full flex items-center justify-center gap-2 bg-[#25D366] hover:bg-[#20bd5a] text-white py-3 rounded-xl font-bold transition-colors shadow-[0_10px_20px_rgba(37,211,102,0.2)]">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.942-.001-3.841-.48-5.538-1.391l-6.459 1.693zM6.612 19.864l.363.216c1.332.793 2.859 1.212 4.423 1.213 4.795 0 8.692-3.896 8.695-8.693.001-2.323-.902-4.506-2.543-6.148-1.641-1.641-3.824-2.545-6.15-2.545-4.796 0-8.692 3.897-8.695 8.695 0 1.579.423 3.116 1.22 4.453l.237.394-1.002 3.654 3.743-.982z" /></svg>
                        Hubungi via WA
                    </a>
                </div>
            </div>
            @endforeach
            @endforelse
        </div>
    </section>

    <!-- 3. INFORMASI PESANTREN -->
    <section class="max-w-7xl mx-auto px-6 mb-24">
        <div class="bg-white rounded-[3rem] p-10 md:p-14 border border-gray-100 shadow-[0_20px_50px_rgba(0,0,0,0.05)]">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div>
                        <h2 class="text-3xl font-black text-[#1a2f24] mb-2">Informasi Lembaga</h2>
                        <div class="w-16 h-1 bg-emerald-500 rounded-full"></div>
                    </div>
                    
                    <ul class="space-y-6">
                        <li class="flex gap-4">
                            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-xl shrink-0 text-emerald-600 shadow-inner">📍</div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Alamat Utama</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $setting->address ?? 'Pesantren Persatuan Islam 104 Cikajang, Kp. Rancapandan, Ds. Mekarjaya, Kec. Cikajang, Kab. Garut, Jawa Barat 44171.' }}</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-xl shrink-0 text-emerald-600 shadow-inner">🕒</div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Jam Operasional</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $setting->operational_hours ?? 'Senin - Sabtu: 07.30 - 15.00 WIB' }}</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-xl shrink-0 text-emerald-600 shadow-inner">📧</div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Email Resmi</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $setting->email ?? 'info@alittihad104.sch.id' }}</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-xl shrink-0 text-emerald-600 shadow-inner">📞</div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Telepon Utama</h4>
                                <p class="text-gray-600 text-sm leading-relaxed">{{ $setting->phone ?? '+62 262 2579254' }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div class="h-[400px] rounded-[2rem] overflow-hidden bg-gray-100 border-4 border-white shadow-xl">
                    @if(isset($setting->map_embed) && $setting->map_embed)
                        {!! $setting->map_embed !!}
                    @else
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.128711311545!2d107.75626247395026!3d-7.45097457342898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e669da7cfc90421%3A0x68c60abeabbaca8c!2sPesantren%20Persatuan%20Islam%20104%20Cikajang!5e0!3m2!1sid!2sid!4v1713686000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- 4. CTA PENUTUP -->
    <section class="max-w-4xl mx-auto px-6 text-center">
        <h3 class="text-2xl font-black text-[#1a2f24] mb-4">{{ $setting->cta_title ?? 'Kami Siap Membantu Anda' }}</h3>
        <p class="text-gray-600 max-w-2xl mx-auto">{{ $setting->cta_description ?? 'Jangan ragu untuk menghubungi kami jika Anda membutuhkan informasi lebih lanjut mengenai pendaftaran santri baru, program pendidikan, maupun donasi.' }}</p>
    </section>

</div>
@endsection
