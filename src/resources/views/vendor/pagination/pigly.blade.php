@if ($paginator->hasPages())
<nav class="pigly-pagination" role="navigation" aria-label="Pagination Navigation">
    <ul class="pigly-pagination__list">
        {{-- Previous --}}
        <li class="pigly-pagination__item">
            @if ($paginator->onFirstPage())
                <span class="pigly-pagination__link is-disabled">&lt;</span>
            @else
                <a class="pigly-pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
            @endif
        </li>

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="pigly-pagination__item">
                    <span class="pigly-pagination__link is-disabled">{{ $element }}</span>
                </li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="pigly-pagination__item">
                        @if ($page == $paginator->currentPage())
                            <span class="pigly-pagination__link is-active">{{ $page }}</span>
                        @else
                            <a class="pigly-pagination__link" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    </li>
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        <li class="pigly-pagination__item">
            @if ($paginator->hasMorePages())
                <a class="pigly-pagination__link" href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
            @else
                <span class="pigly-pagination__link is-disabled">&gt;</span>
            @endif
        </li>
    </ul>
</nav>
@endif