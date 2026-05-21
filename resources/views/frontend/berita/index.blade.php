@extends('layouts.main')

@section('title', 'Berita & Informasi - PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#f8f9fa] pt-24 pb-20 min-h-screen">
    
    <!-- HEADER -->
    <div class="max-w-7xl mx-auto px-6 mb-12">
        <h1 class="text-4xl md:text-5xl font-black text-[#1a2f24] tracking-tight mb-4">Kabar Pesantren</h1>
        <p class="text-gray-500 text-lg">Informasi terkini seputar kegiatan, prestasi, dan pengumuman di PPI 104 Al Ittihaad.</p>
    </div>

    <!-- FEATURED NEWS HERO -->
    @if($featured && !request()->has('category'))
    <div class="max-w-7xl mx-auto px-6 mb-16">
        <a href="{{ route('berita.show', $featured->slug) }}" class="group block relative rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 h-[60vh] min-h-[400px]">
            <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt="{{ $featured->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-[#0f3b2a]/90 via-[#0f3b2a]/40 to-transparent"></div>
            
            <div class="absolute bottom-0 left-0 w-full p-8 md:p-12 lg:w-3/4">
                @if($featured->category)
                    <span class="inline-block px-4 py-1.5 bg-emerald-500 text-white rounded-full font-bold text-xs uppercase tracking-wider mb-4">
                        {{ $featured->category->name }}
                    </span>
                @endif
                <h2 class="text-3xl md:text-5xl font-black text-white leading-tight mb-4 group-hover:text-emerald-300 transition-colors">
                    {{ $featured->title }}
                </h2>
                <div class="flex items-center text-emerald-100/80 text-sm gap-4 mb-4">
                    <span class="flex items-center gap-1">📅 {{ $featured->published_at ? $featured->published_at->format('d M Y') : '' }}</span>
                    <span class="flex items-center gap-1">⭐ Headline</span>
                </div>
                <p class="text-white/80 text-lg line-clamp-2 md:line-clamp-3 mb-6">
                    {{ $featured->excerpt ?? Str::limit(strip_tags($featured->content), 150) }}
                </p>
                <div class="inline-flex items-center gap-2 text-white font-bold border-b-2 border-emerald-400 pb-1 group-hover:gap-4 transition-all">
                    Baca Selengkapnya <span class="text-xl">→</span>
                </div>
            </div>
        </a>
    </div>
    @endif

    <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row gap-12">
        <!-- MAIN CONTENT (NEWS GRID) -->
        <div class="lg:w-2/3">
            <div class="flex items-center justify-between mb-8 pb-4 border-b border-gray-200">
                <h3 class="text-2xl font-black text-[#1a2f24]">
                    {{ request()->has('category') ? 'Kategori: ' . request()->category : 'Berita Terbaru' }}
                </h3>
            </div>

            @if($news->count() > 0)
                <div class="grid md:grid-cols-2 gap-8 mb-12">
                    @foreach($news as $post)
                    <article class="bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group flex flex-col transform hover:-translate-y-1">
                        <a href="{{ route('berita.show', $post->slug) }}" class="block relative h-56 overflow-hidden">
                            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @if($post->category)
                            <div class="absolute top-4 left-4">
                                <span class="bg-white/90 backdrop-blur text-[#0f3b2a] px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">
                                    {{ $post->category->name }}
                                </span>
                            </div>
                            @endif
                        </a>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="text-xs text-gray-500 mb-3 flex items-center gap-2 font-medium">
                                <span>📅 {{ $post->published_at ? $post->published_at->format('d M Y') : '' }}</span>
                            </div>
                            <h4 class="text-xl font-bold text-[#1a2f24] mb-3 leading-snug group-hover:text-emerald-600 transition-colors">
                                <a href="{{ route('berita.show', $post->slug) }}">{{ $post->title }}</a>
                            </h4>
                            <p class="text-gray-600 text-sm line-clamp-3 mb-6 flex-1">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            <a href="{{ route('berita.show', $post->slug) }}" class="text-emerald-600 font-bold text-sm inline-flex items-center gap-1 group-hover:gap-2 transition-all mt-auto">
                                Baca <span class="text-lg">→</span>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>

                <!-- PAGINATION -->
                <div class="flex justify-center mt-12">
                    {{ $news->links() }}
                </div>
            @else
                <div class="bg-white p-12 rounded-3xl text-center shadow-sm border border-gray-100">
                    <span class="text-5xl mb-4 block opacity-50">📰</span>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada berita</h3>
                    <p class="text-gray-500">Silakan kembali beberapa saat lagi untuk mendapatkan informasi terbaru.</p>
                </div>
            @endif
        </div>

        <!-- SIDEBAR -->
        <aside class="lg:w-1/3 space-y-10">
            
            <!-- POPULAR NEWS -->
            @if($popular->count() > 0)
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h4 class="text-xl font-black text-[#1a2f24] mb-6 flex items-center gap-2">
                    <span class="text-amber-500">🔥</span> Berita Populer
                </h4>
                <div class="space-y-6">
                    @foreach($popular as $index => $pop)
                    <a href="{{ route('berita.show', $pop->slug) }}" class="flex gap-4 group">
                        <div class="w-8 flex-shrink-0 text-3xl font-black text-gray-100 group-hover:text-emerald-100 transition-colors">
                            0{{ $index + 1 }}
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 text-sm leading-tight group-hover:text-emerald-600 transition-colors mb-1 line-clamp-2">
                                {{ $pop->title }}
                            </h5>
                            <span class="text-xs text-gray-500">{{ $pop->published_at ? $pop->published_at->format('d M Y') : '' }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- CATEGORIES -->
            @if($categories->count() > 0)
            <div class="bg-emerald-50 rounded-3xl p-8 shadow-sm border border-emerald-100/50">
                <h4 class="text-xl font-black text-[#1a2f24] mb-6 flex items-center gap-2">
                    <span class="text-emerald-500">📁</span> Kategori Berita
                </h4>
                <div class="flex flex-col gap-3">
                    <a href="{{ route('berita.index') }}" class="flex items-center justify-between text-gray-700 hover:text-emerald-600 font-medium bg-white px-4 py-3 rounded-xl shadow-sm hover:shadow-md transition-all {{ !request()->has('category') ? 'ring-2 ring-emerald-500 text-emerald-700' : '' }}">
                        <span>Semua Berita</span>
                    </a>
                    @foreach($categories as $cat)
                    <a href="{{ route('berita.index', ['category' => $cat->slug]) }}" class="flex items-center justify-between text-gray-700 hover:text-emerald-600 font-medium bg-white px-4 py-3 rounded-xl shadow-sm hover:shadow-md transition-all {{ request('category') == $cat->slug ? 'ring-2 ring-emerald-500 text-emerald-700' : '' }}">
                        <span>{{ $cat->name }}</span>
                        <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded-lg text-xs">{{ $cat->posts_count }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </aside>
    </div>
</div>
@endsection
