@if ($paginator->hasPages())

            @if ($paginator->onFirstPage())

            @else
                <a class="page-link d-flex justify-content-center align-items-center" aria-label="Пред" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                    <i class="fa fa-long-arrow-left"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="active" href="#">{{ $page }}</a>
                        @else
                            <a class="" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="page-link d-flex justify-content-center align-items-center" aria-label="След" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                    <i class="fa fa-long-arrow-right"></i>
                </a>
            @else

            @endif

@endif
