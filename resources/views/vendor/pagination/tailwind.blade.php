@if ($paginator->hasPages())
    <nav class="flex justify-center items-center gap-2">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="px-3 py-1 bg-white border rounded-lg hover:bg-pink-50 text-gray-700">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        {{-- Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-1 text-gray-500">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-4 py-1 bg-pink-600 text-white rounded-lg font-semibold shadow">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           class="px-4 py-1 bg-white border rounded-lg hover:bg-pink-50 text-gray-700">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
               class="px-3 py-1 bg-white border rounded-lg hover:bg-pink-50 text-gray-700">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="px-3 py-1 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif

    </nav>
@endif
