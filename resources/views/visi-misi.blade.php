@extends('layouts.main')

@section('title', 'Visi & Misi - Pesantren Persatuan Islam 104 Al Ittihaad Cikajang')

@section('content')
<!-- VISI SECTION - Centered Hero with Pastel Green Background -->
<section class="relative bg-gradient-to-br from-emerald-50 via-emerald-100 to-teal-50 py-20 md:py-32 animate-fade-in-up">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Decorative Icon -->
            <div class="mb-8">
                <div class="w-20 h-20 mx-auto bg-gradient-to-br from-amber-400 to-amber-500 rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L13.09 8.26L19 6L14.74 10.91L21 12L14.74 13.09L19 18L13.09 15.74L12 22L10.91 15.74L5 18L9.26 13.09L3 12L9.26 10.91L5 6L10.91 8.26L12 2Z"/>
                    </svg>
                </div>
            </div>

            <!-- Title -->
            <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-emerald-900 mb-6">
                Visi Kami
            </h1>

            <!-- Gold Accent Line -->
            <div class="w-32 h-1 bg-gradient-to-r from-amber-400 via-amber-500 to-amber-400 mx-auto mb-8 rounded-full"></div>

            <!-- Visi Text -->
            <p class="font-sans text-lg md:text-xl text-emerald-800 leading-relaxed max-w-3xl mx-auto">
                {{ $visi }}
            </p>

            <!-- Decorative Elements -->
            <div class="flex items-center justify-center gap-4 mt-12">
                <div class="w-12 h-0.5 bg-emerald-300"></div>
                <svg class="w-6 h-6 text-amber-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L13.09 8.26L19 6L14.74 10.91L21 12L14.74 13.09L19 18L13.09 15.74L12 22L10.91 15.74L5 18L9.26 13.09L3 12L9.26 10.91L5 6L10.91 8.26L12 2Z"/>
                </svg>
                <div class="w-12 h-0.5 bg-emerald-300"></div>
            </div>
        </div>
    </div>
</section>

<!-- MISI SECTION - Interactive Modern Cards -->
<section class="py-20 md:py-28 bg-stone-50 animate-fade-in-up delay-100">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="mb-4">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-emerald-600 to-emerald-700 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L13.09 8.26L19 6L14.74 10.91L21 12L14.74 13.09L19 18L13.09 15.74L12 22L10.91 15.74L5 18L9.26 13.09L3 12L9.26 10.91L5 6L10.91 8.26L12 2Z"/>
                        </svg>
                    </div>
                </div>
                <h2 class="font-serif text-3xl md:text-4xl lg:text-5xl font-bold text-emerald-900 mb-4">
                    Misi Kami
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-amber-400 via-amber-500 to-amber-400 mx-auto rounded-full"></div>
            </div>

            <!-- Misi Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($misi as $index => $item)
                <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 hover:border-amber-400 border-2 border-transparent animate-fade-in-up" style="animation-delay: {{ ($index + 2) * 100 }}ms">
                    <!-- Icon -->
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-xl flex items-center justify-center mb-6 group-hover:from-amber-100 group-hover:to-amber-200 transition-all duration-300">
                        <span class="text-3xl">{{ $item['icon'] }}</span>
                    </div>

                    <!-- Title -->
                    <h3 class="font-serif text-xl font-bold text-emerald-900 mb-4 group-hover:text-amber-700 transition-colors duration-300">
                        {{ $item['title'] }}
                    </h3>

                    <!-- Description -->
                    <p class="font-sans text-sm md:text-base text-gray-600 leading-relaxed">
                        {{ $item['description'] }}
                    </p>

                    <!-- Decorative Bottom Line -->
                    <div class="w-0 h-0.5 bg-gradient-to-r from-amber-400 to-amber-500 mt-6 group-hover:w-full transition-all duration-300 rounded-full"></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Closing Section -->
<section class="py-16 bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-800 text-white animate-fade-in-up delay-300">
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
                "Adab sebelum Ilmu, Ilmu untuk Amal"
            </p>
            <p class="font-sans text-sm text-emerald-200 mt-4">
                Pesantren Persatuan Islam 104 Al Ittihaad Cikajang
            </p>
        </div>
    </div>
</section>
@endsection
