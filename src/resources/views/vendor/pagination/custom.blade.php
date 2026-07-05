@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col items-center gap-3 sm:flex-row sm:justify-between">
        <p class="text-sm text-slate-500">
            Menampilkan <span class="font-semibold text-slate-700">{{ $paginator->firstItem() }}</span>
            &ndash; <span class="font-semibold text-slate-700">{{ $paginator->lastItem() }}</span>
            dari <span class="font-semibold text-slate-700">{{ $paginator->total() }}</span> data
        </p>

        <div class="flex items-center gap-1">
            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <span class="btn-icon btn-sm cursor-not-allowed !text-slate-300">
                    <svg data-lucide="chevron-left"></svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="btn-icon btn-sm btn-secondary" rel="prev">
                    <svg data-lucide="chevron-left"></svg>
                </a>
            @endif

            {{-- Pages --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-sm text-slate-400">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-brand-600 text-sm font-semibold text-white shadow-sm shadow-brand-600/25">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="inline-flex h-9 w-9 items-center justify-center rounded-xl text-sm font-medium text-slate-600 transition hover:bg-slate-100">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="btn-icon btn-sm btn-secondary" rel="next">
                    <svg data-lucide="chevron-right"></svg>
                </a>
            @else
                <span class="btn-icon btn-sm cursor-not-allowed !text-slate-300">
                    <svg data-lucide="chevron-right"></svg>
                </span>
            @endif
        </div>
    </nav>
@endif
