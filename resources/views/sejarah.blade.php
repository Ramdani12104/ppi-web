@extends('layouts.main')

@section('title', 'Sejarah - Pesantren Persatuan Islam 104 Al Ittihaad Cikajang')

@section('content')
<!-- Header/Hero Section -->
<header class="relative bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-800 text-white animate-fade-in-up">
    <!-- Islamic Pattern Overlay -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <pattern id="islamic-pattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                <path d="M10 0 L20 10 L10 20 L0 10 Z" fill="none" stroke="white" stroke-width="0.5"/>
            </pattern>
            <rect x="0" y="0" width="100" height="100" fill="url(#islamic-pattern)"/>
        </svg>
    </div>
    
    <div class="relative container mx-auto px-4 py-16 md:py-24">
        <div class="max-w-4xl mx-auto text-center">
            <div class="mb-6">
                <svg class="w-20 h-20 mx-auto text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L13.09 8.26L19 6L14.74 10.91L21 12L14.74 13.09L19 18L13.09 15.74L12 22L10.91 15.74L5 18L9.26 13.09L3 12L9.26 10.91L5 6L10.91 8.26L12 2Z"/>
                </svg>
            </div>
            <h1 class="font-arabic text-4xl md:text-5xl lg:text-6xl font-bold mb-4 text-amber-100">
                Sejarah Pesantren
            </h1>
            <p class="text-lg md:text-xl text-emerald-100 mb-2">
                Pesantren Persatuan Islam 104 Al Ittihaad Cikajang
            </p>
            <div class="flex items-center justify-center gap-2 mt-6">
                <span class="w-16 h-0.5 bg-amber-400"></span>
                <span class="text-amber-400 text-2xl">✦</span>
                <span class="w-16 h-0.5 bg-amber-400"></span>
            </div>
        </div>
    </div>
</header>

<!-- Main Content Section -->
<main class="container mx-auto px-4 py-12 md:py-16">
    <div class="max-w-4xl mx-auto">
        <!-- Hero Image -->
        @if($history && $history->image)
        <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl animate-fade-in-up delay-100">
            <img src="{{ asset('storage/' . $history->image) }}" alt="{{ $history->title }}" class="w-full h-64 md:h-96 object-cover">
        </div>
        @else
        <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl bg-gradient-to-br from-emerald-100 to-teal-100 h-64 md:h-96 flex items-center justify-center animate-fade-in-up delay-100">
            <div class="text-center">
                <svg class="w-24 h-24 mx-auto text-emerald-600 opacity-50" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L13.09 8.26L19 6L14.74 10.91L21 12L14.74 13.09L19 18L13.09 15.74L12 22L10.91 15.74L5 18L9.26 13.09L3 12L9.26 10.91L5 6L10.91 8.26L12 2Z"/>
                </svg>
                <p class="text-emerald-600 mt-4 font-medium">Gambar Sejarah</p>
            </div>
        </div>
        @endif

        <!-- Content -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 animate-fade-in-up delay-200">
            <!-- Established Year Badge -->
            @if($history && $history->established_year)
            <div class="flex items-center justify-center mb-8">
                <div class="bg-gradient-to-r from-amber-500 to-amber-600 text-white px-8 py-3 rounded-full shadow-lg">
                    <span class="text-sm font-medium">Berdiri Sejak</span>
                    <span class="text-2xl font-bold ml-2">{{ $history->established_year }}</span>
                </div>
            </div>
            @endif

            <!-- Title -->
            @if($history && $history->title)
            <h2 class="font-arabic text-2xl md:text-3xl font-bold text-emerald-800 text-center mb-8">
                {{ $history->title }}
            </h2>
            @endif

            <!-- Content Text -->
            @if($history && $history->content)
            <div class="prose prose-lg max-w-none">
                <p class="text-gray-700 leading-relaxed text-justify">
                    {{ $history->content }}
                </p>
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-500">Belum ada data sejarah yang tersedia.</p>
            </div>
            @endif

            <!-- Decorative Divider -->
            <div class="flex items-center justify-center gap-3 mt-10">
                <span class="w-12 h-0.5 bg-emerald-300"></span>
                <svg class="w-6 h-6 text-emerald-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L13.09 8.26L19 6L14.74 10.91L21 12L14.74 13.09L19 18L13.09 15.74L12 22L10.91 15.74L5 18L9.26 13.09L3 12L9.26 10.91L5 6L10.91 8.26L12 2Z"/>
                </svg>
                <span class="w-12 h-0.5 bg-emerald-300"></span>
            </div>
        </div>

        <!-- Additional Info Section -->
        <div class="mt-12 grid md:grid-cols-3 gap-6 animate-fade-in-up delay-300">
            <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-emerald-800 mb-2">Pendidikan</h3>
                <p class="text-sm text-gray-600">Kober, RA, SDIT, MDT, MTs, MA</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-emerald-800 mb-2">Lokasi</h3>
                <p class="text-sm text-gray-600">Cikajang, Garut</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition-shadow">
                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-emerald-800 mb-2">Nilai</h3>
                <p class="text-sm text-gray-600">Islam & Berakhlak Mulia</p>
            </div>
        </div>
    </div>
</main>
@endsection
