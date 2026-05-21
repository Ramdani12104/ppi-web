@extends('layouts.main')

@section('title', 'Struktur Organisasi - Pesantren Persatuan Islam 104 Al Ittihaad Cikajang')

@section('content')
<!-- Header Section -->
<section class="relative bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-800 text-white py-20 md:py-28 animate-fade-in-up">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Decorative Icon -->
            <div class="mb-6">
                <div class="w-20 h-20 mx-auto bg-gradient-to-br from-amber-400 to-amber-500 rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L13.09 8.26L19 6L14.74 10.91L21 12L14.74 13.09L19 18L13.09 15.74L12 22L10.91 15.74L5 18L9.26 13.09L3 12L9.26 10.91L5 6L10.91 8.26L12 2Z"/>
                    </svg>
                </div>
            </div>
            <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold mb-4">
                Struktur Organisasi
            </h1>
            <p class="font-sans text-lg md:text-xl text-emerald-100 leading-relaxed max-w-2xl mx-auto">
                Pesantren Persatuan Islam 104 Al Ittihaad Cikajang
            </p>
            <div class="flex items-center justify-center gap-4 mt-8">
                <div class="w-16 h-0.5 bg-amber-400"></div>
                <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L13.09 8.26L19 6L14.74 10.91L21 12L14.74 13.09L19 18L13.09 15.74L12 22L10.91 15.74L5 18L9.26 13.09L3 12L9.26 10.91L5 6L10.91 8.26L12 2Z"/>
                </svg>
                <div class="w-16 h-0.5 bg-amber-400"></div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<main class="py-16 md:py-24 bg-stone-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            
            <!-- PIMPINAN PUNCAK -->
            <section class="mb-20 animate-fade-in-up delay-100">
                <div class="text-center mb-10">
                    <div class="inline-block bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-2 rounded-full font-bold text-sm uppercase tracking-wider mb-4">
                        Pimpinan Puncak
                    </div>
                    <div class="w-24 h-1 bg-gradient-to-r from-amber-400 to-amber-500 mx-auto rounded-full"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    @foreach($pimpinanPuncak as $index => $pimpinan)
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-transparent hover:border-amber-400 text-center">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-full flex items-center justify-center mb-6 group-hover:from-amber-100 group-hover:to-amber-200 transition-all duration-300">
                            <span class="text-4xl">{{ $pimpinan['icon'] }}</span>
                        </div>
                        <h3 class="font-serif text-2xl font-bold text-emerald-900 mb-2">{{ $pimpinan['nama'] }}</h3>
                        <p class="font-sans text-amber-600 font-semibold text-sm uppercase tracking-wider">{{ $pimpinan['jabatan'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- UNSUR PEMBANTU PIMPINAN (SEKRETARIAT) -->
            <section class="mb-20 animate-fade-in-up delay-200">
                <div class="text-center mb-10">
                    <div class="inline-block bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-2 rounded-full font-bold text-sm uppercase tracking-wider mb-4">
                        Unsur Pembantu Pimpinan
                    </div>
                    <div class="w-24 h-1 bg-gradient-to-r from-amber-400 to-amber-500 mx-auto rounded-full"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    @foreach($sekretariat as $index => $staff)
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-transparent hover:border-amber-400 text-center">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-full flex items-center justify-center mb-6">
                            <span class="text-4xl">{{ $staff['icon'] }}</span>
                        </div>
                        <h3 class="font-serif text-xl font-bold text-emerald-900 mb-2">{{ $staff['nama'] }}</h3>
                        <p class="font-sans text-amber-600 font-semibold text-sm uppercase tracking-wider">{{ $staff['jabatan'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- MUDIR SATUAN (UNIT PENDIDIKAN) -->
            <section class="mb-20 animate-fade-in-up delay-300">
                <div class="text-center mb-10">
                    <div class="inline-block bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-2 rounded-full font-bold text-sm uppercase tracking-wider mb-4">
                        Mudir Satuan (Unit Pendidikan)
                    </div>
                    <div class="w-24 h-1 bg-gradient-to-r from-amber-400 to-amber-500 mx-auto rounded-full"></div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($mudirSatuan as $index => $mudir)
                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-transparent hover:border-amber-400 text-center">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-full flex items-center justify-center mb-4">
                            <span class="text-3xl">{{ $mudir['icon'] }}</span>
                        </div>
                        <h3 class="font-serif text-lg font-bold text-emerald-900 mb-1">{{ $mudir['nama'] }}</h3>
                        <p class="font-sans text-amber-600 font-semibold text-xs uppercase tracking-wider">{{ $mudir['unit'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- BIDANG & LEMBAGA -->
            <section class="animate-fade-in-up">
                <div class="text-center mb-10">
                    <div class="inline-block bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-2 rounded-full font-bold text-sm uppercase tracking-wider mb-4">
                        Bidang & Lembaga
                    </div>
                    <div class="w-24 h-1 bg-gradient-to-r from-amber-400 to-amber-500 mx-auto rounded-full"></div>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($bidang as $index => $item)
                    <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border-2 border-transparent hover:border-amber-400 text-center">
                        <div class="w-14 h-14 mx-auto bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-full flex items-center justify-center mb-4">
                            <span class="text-2xl">{{ $item['icon'] }}</span>
                        </div>
                        <h3 class="font-serif text-base font-bold text-emerald-900 mb-2">{{ $item['nama'] }}</h3>
                        <p class="font-sans text-gray-600 text-xs leading-relaxed">{{ $item['deskripsi'] }}</p>
                    </div>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
</main>

<!-- Footer Quote -->
<section class="py-12 bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-800 text-white animate-fade-in-up">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <div class="flex items-center justify-center gap-3 mb-6">
                <div class="w-16 h-0.5 bg-amber-400"></div>
                <svg class="w-8 h-8 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L13.09 8.26L19 6L14.74 10.91L21 12L14.74 13.09L19 18L13.09 15.74L12 22L10.91 15.74L5 18L9.26 13.09L3 12L9.26 10.91L5 6L10.91 8.26L12 2Z"/>
                </svg>
                <div class="w-16 h-0.5 bg-amber-400"></div>
            </div>
            <p class="font-serif text-lg md:text-xl leading-relaxed text-emerald-100">
                "Bersama Membangun Generasi Berkualitas"
            </p>
            <p class="font-sans text-sm text-emerald-200 mt-4">
                Pesantren Persatuan Islam 104 Al Ittihaad Cikajang
            </p>
        </div>
    </div>
</section>
@endsection
