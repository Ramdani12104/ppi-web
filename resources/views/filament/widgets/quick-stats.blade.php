<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <span class="text-lg">📊</span>
                <span class="font-bold text-gray-900 dark:text-white">Statistik Konten</span>
            </div>
        </x-slot>

        <div class="grid grid-cols-2 gap-3">
            @foreach($this->getStats() as $stat)
            <div class="relative overflow-hidden rounded-xl p-4 bg-gradient-to-br {{ $stat['color'] }} shadow-lg group cursor-default">
                {{-- Background glow effect --}}
                <div class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl"></div>

                {{-- Icon --}}
                <div class="text-2xl mb-2">{{ $stat['icon'] }}</div>

                {{-- Value --}}
                <div class="text-3xl font-black text-white leading-none mb-1">
                    {{ $stat['value'] }}
                </div>

                {{-- Label --}}
                <div class="text-xs font-semibold text-white/90 leading-tight mb-1">
                    {{ $stat['label'] }}
                </div>

                {{-- Change/description --}}
                <div class="flex items-center gap-1 text-white/70 text-xs">
                    @if($stat['trend'] === 'up')
                    <svg class="w-3 h-3 text-white/80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    @endif
                    <span>{{ $stat['change'] }}</span>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Summary bar --}}
        <div class="mt-4 p-3 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-100 dark:border-white/10">
            <div class="flex items-center justify-between text-xs">
                <span class="text-gray-500 dark:text-gray-400 font-medium">Total Konten Digital</span>
                @php
                    $total = collect($this->getStats())->sum('value');
                @endphp
                <span class="font-black text-gray-900 dark:text-white text-base">{{ $total }}</span>
            </div>
            <div class="mt-2 h-1.5 w-full bg-gray-200 dark:bg-white/10 rounded-full overflow-hidden">
                <div class="h-full rounded-full bg-gradient-to-r from-primary-500 to-violet-500"
                     style="width: 100%"></div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
