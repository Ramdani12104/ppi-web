@extends('layouts.main')

@section('title', $level->name)

@section('content')
<section class="relative bg-emerald-900 text-white overflow-hidden py-24 text-center">
    @if($level->banner)
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-black opacity-60"></div>
            <img src="{{ asset('storage/' . $level->banner) }}" class="w-full h-full object-cover">
        </div>
    @endif
    <div class="relative z-10 max-w-4xl mx-auto px-4">
        @if($level->logo)
            <img src="{{ asset('storage/' . $level->logo) }}" class="w-24 h-24 mx-auto mb-6 bg-white p-2 rounded-full shadow-lg">
        @endif
        <h1 class="text-5xl font-black mb-6">{{ $level->name }}</h1>
        <p class="text-xl font-light text-emerald-100">{{ $level->short_description }}</p>
    </div>
</section>

<section class="py-16 max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-12">
    <div>
        <h2 class="text-2xl font-bold text-emerald-900 border-b-2 border-emerald-100 pb-2 mb-6">Sejarah Singkat</h2>
        <div class="prose prose-emerald">{!! $level->profile_content['sejarah'] ?? 'Belum ada sejarah.' !!}</div>
    </div>
    <div>
        <h2 class="text-2xl font-bold text-emerald-900 border-b-2 border-emerald-100 pb-2 mb-6">Visi & Misi</h2>
        <div class="prose prose-emerald">{!! $level->profile_content['visi_misi'] ?? 'Belum ada visi misi.' !!}</div>
    </div>
</section>

@if(!empty($level->programs))
<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-emerald-900 mb-10">Program Unggulan</h2>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($level->programs as $program)
                <div class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="text-4xl mb-4">{{ $program['icon'] ?? '🎓' }}</div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $program['name'] }}</h3>
                    <p class="text-gray-600 mt-2">{{ $program['description'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
