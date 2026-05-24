<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <span class="text-lg">🕐</span>
                <span class="font-bold text-gray-900 dark:text-white">Aktivitas Terbaru</span>
            </div>
        </x-slot>

        <div class="flow-root">
            <ul role="list" class="-mb-8">
                @foreach($this->getActivities() as $index => $activity)
                <li>
                    <div class="relative pb-8">
                        @if(!$loop->last)
                        <span class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200 dark:bg-white/10" aria-hidden="true"></span>
                        @endif
                        <div class="relative flex items-start space-x-3">
                            {{-- Icon --}}
                            <div class="relative">
                                <div class="flex h-10 w-10 items-center justify-center rounded-full ring-4 ring-white dark:ring-gray-900
                                    @if($activity['color'] === 'blue') bg-blue-100 dark:bg-blue-900/40
                                    @elseif($activity['color'] === 'green') bg-emerald-100 dark:bg-emerald-900/40
                                    @elseif($activity['color'] === 'purple') bg-purple-100 dark:bg-purple-900/40
                                    @elseif($activity['color'] === 'yellow') bg-yellow-100 dark:bg-yellow-900/40
                                    @else bg-gray-100 dark:bg-gray-700
                                    @endif
                                    text-xl shadow-sm">
                                    {{ $activity['icon'] }}
                                </div>
                            </div>
                            {{-- Content --}}
                            <div class="min-w-0 flex-1 pt-1.5">
                                <div class="flex items-center justify-between gap-x-2">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                        {{ Str::limit($activity['title'], 40) }}
                                    </p>
                                    <span class="px-2 py-0.5 rounded-full text-xs font-medium shrink-0
                                        @if($activity['badge_color'] === 'green') bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400
                                        @elseif($activity['badge_color'] === 'yellow') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-400
                                        @elseif($activity['badge_color'] === 'purple') bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-400
                                        @elseif($activity['badge_color'] === 'blue') bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400
                                        @else bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400
                                        @endif
                                    ">
                                        {{ $activity['badge'] }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $activity['subtitle'] }}</p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $activity['time'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-white/5">
            <a href="{{ route('filament.admin.resources.news-posts.index') }}"
               class="flex items-center justify-center gap-2 w-full py-2 rounded-lg text-sm font-medium
                      text-primary-600 dark:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20
                      transition-colors duration-150">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                Lihat Semua Berita
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
