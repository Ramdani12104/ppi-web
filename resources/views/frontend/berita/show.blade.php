@extends('layouts.main')

@section('title', $post->title . ' - Berita PPI 104 Al Ittihaad')

@section('content')
<div class="font-sans text-gray-800 bg-[#f8f9fa] pt-20 pb-20 min-h-screen">
    
    <!-- ARTICLE BANNER -->
    <div class="max-w-5xl mx-auto px-6 mb-8">
        <a href="{{ route('berita.index') }}" class="inline-flex items-center gap-2 text-emerald-600 font-bold mb-6 hover:text-[#0f3b2a] transition-colors">
            <span>←</span> Kembali ke Indeks Berita
        </a>
        
        <div class="rounded-[2.5rem] overflow-hidden shadow-2xl relative w-full h-[40vh] md:h-[60vh] min-h-[300px] mb-12">
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
        </div>
    </div>

    <!-- MAIN ARTICLE -->
    <div class="max-w-7xl mx-auto px-6 flex flex-col lg:flex-row gap-12">
        
        <!-- ARTICLE CONTENT -->
        <article class="lg:w-2/3 bg-white rounded-[3rem] p-8 md:p-14 shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-gray-100 -mt-24 relative z-10">
            @if($post->category)
            <span class="inline-block px-4 py-1.5 bg-emerald-50 text-emerald-600 rounded-full font-bold text-xs uppercase tracking-wider mb-6 border border-emerald-100">
                {{ $post->category->name }}
            </span>
            @endif
            
            <h1 class="text-3xl md:text-5xl font-black text-[#1a2f24] leading-tight mb-6">
                {{ $post->title }}
            </h1>
            
            <div class="flex items-center gap-6 text-gray-500 text-sm font-medium border-b border-gray-100 pb-8 mb-8">
                <span class="flex items-center gap-2">📅 Dipublikasikan pada: {{ $post->published_at ? $post->published_at->format('d F Y') : '' }}</span>
            </div>

            <!-- Content Body -->
            <div class="prose prose-lg prose-emerald max-w-none text-gray-700 leading-relaxed">
                {!! $post->content !!}
            </div>

            <!-- Article Galleries (If any) -->
            @if($post->galleries && $post->galleries->count() > 0)
            <div class="mt-12 pt-12 border-t border-gray-100">
                <h3 class="text-2xl font-bold text-[#1a2f24] mb-6">Galeri Liputan</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($post->galleries as $gallery)
                    <div class="relative group rounded-2xl overflow-hidden cursor-pointer aspect-square">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="Galeri Berita" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @if($gallery->caption)
                        <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                            <p class="text-white text-xs font-medium">{{ $gallery->caption }}</p>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Share Area -->
            <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col md:flex-row items-center justify-between gap-4">
                <span class="font-bold text-gray-700">Bagikan berita ini:</span>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:-translate-y-1 transition-transform shadow-md">FB</a>
                    <a href="#" class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:-translate-y-1 transition-transform shadow-md">TW</a>
                    <a href="#" class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center hover:-translate-y-1 transition-transform shadow-md">WA</a>
                </div>
            </div>
        </article>

        <!-- SIDEBAR -->
        <aside class="lg:w-1/3 space-y-10">
            <!-- RELATED NEWS -->
            @if($related->count() > 0)
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h4 class="text-xl font-black text-[#1a2f24] mb-6 border-b border-gray-100 pb-4">Terkait</h4>
                <div class="space-y-6">
                    @foreach($related as $rel)
                    <a href="{{ route('berita.show', $rel->slug) }}" class="group block">
                        <div class="h-40 rounded-2xl overflow-hidden mb-3">
                            <img src="{{ asset('storage/' . $rel->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <h5 class="font-bold text-gray-800 text-sm leading-snug group-hover:text-emerald-600 transition-colors mb-2">
                            {{ $rel->title }}
                        </h5>
                        <span class="text-xs text-gray-500">{{ $rel->published_at ? $rel->published_at->format('d M Y') : '' }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- POPULAR NEWS -->
            @if($popular->count() > 0)
            <div class="bg-emerald-50 rounded-3xl p-8 shadow-sm border border-emerald-100/50">
                <h4 class="text-xl font-black text-[#1a2f24] mb-6 flex items-center gap-2">
                    <span class="text-amber-500">🔥</span> Populer
                </h4>
                <div class="space-y-5">
                    @foreach($popular as $pop)
                    <a href="{{ route('berita.show', $pop->slug) }}" class="flex gap-4 group items-center bg-white p-3 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $pop->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        <div>
                            <h5 class="font-bold text-gray-800 text-xs leading-tight group-hover:text-emerald-600 transition-colors mb-1 line-clamp-2">
                                {{ $pop->title }}
                            </h5>
                            <span class="text-[10px] text-gray-500">{{ $pop->published_at ? $pop->published_at->format('d M Y') : '' }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
            
            <!-- CATEGORIES -->
            @if($categories->count() > 0)
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <h4 class="text-xl font-black text-[#1a2f24] mb-6 border-b border-gray-100 pb-4">Kategori</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach($categories as $cat)
                    <a href="{{ route('berita.index', ['category' => $cat->slug]) }}" class="px-4 py-2 bg-gray-100 hover:bg-emerald-100 hover:text-emerald-700 text-gray-600 text-sm font-medium rounded-xl transition-colors">
                        {{ $cat->name }}
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </aside>
    </div>
</div>
@endsection
