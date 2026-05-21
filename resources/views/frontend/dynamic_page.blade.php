@extends('layouts.main')

@section('title', $page->meta_title ?? $page->title)

@section('content')
    @foreach($page->sections as $section)
        
        @if($section->type === 'hero')
            <section class="relative bg-emerald-900 text-white overflow-hidden py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
                @if(!empty($section->content['image']))
                    <div class="absolute inset-0 z-0">
                        <div class="absolute inset-0 bg-black opacity-50"></div>
                        <img src="{{ asset('storage/' . $section->content['image']) }}" class="w-full h-full object-cover">
                    </div>
                @endif
                <div class="relative z-10 max-w-7xl mx-auto">
                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">{{ $section->content['heading'] ?? '' }}</h1>
                    <p class="mt-6 max-w-3xl mx-auto text-xl text-emerald-100 font-light">{{ $section->content['subheading'] ?? '' }}</p>
                </div>
            </section>
        
        @elseif($section->type === 'text')
            <section class="max-w-4xl mx-auto py-16 px-4">
                @if(!empty($section->content['heading']))
                    <h2 class="text-3xl font-bold mb-6 text-gray-900 border-b-2 border-emerald-100 pb-3">{{ $section->content['heading'] }}</h2>
                @endif
                <div class="prose prose-lg prose-emerald max-w-none text-justify">
                    {!! $section->content['body'] ?? '' !!}
                </div>
            </section>

        @elseif($section->type === 'features')
            <section class="py-16 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    @if(!empty($section->content['heading']))
                        <h2 class="text-3xl font-bold mb-10 text-emerald-900">{{ $section->content['heading'] }}</h2>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                        @foreach($section->content['items'] ?? [] as $item)
                            <div class="bg-white p-8 rounded-2xl shadow-sm border-t-4 border-emerald-600 hover:shadow-lg transition">
                                <h3 class="text-xl font-bold text-gray-900">{{ $item['title_or_question'] ?? '' }}</h3>
                                <p class="mt-4 text-gray-600 leading-relaxed">{{ $item['value_or_answer'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            
        @elseif($section->type === 'gallery')
            <section class="max-w-7xl mx-auto py-16 px-4">
                @if(!empty($section->content['heading']))
                    <h2 class="text-3xl font-bold mb-10 text-center text-emerald-900">{{ $section->content['heading'] }}</h2>
                @endif
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($section->content['images'] ?? [] as $image)
                        <img src="{{ asset('storage/' . $image) }}" class="rounded-xl shadow-sm w-full h-48 object-cover">
                    @endforeach
                </div>
            </section>
            
        @endif
        
    @endforeach
@endsection
