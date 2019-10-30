

@if ($paginator->hasPages())
<nav aria-label="Page navigation example" class="pagination_area">
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            {{-- <li class="disabled"><span>&laquo;</span></li> --}}
            {{-- <span class="page-item disabled"><span>&laquo;</span></span> --}}
            <li class="page-item next disabled"><i class="fa fa-angle-left" aria-hidden="true"></i></li>

        @else
            <li class="page-item"><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><span>{{ $page }}</span></li>
                        {{-- <li class="active">{{ $page }}</li> --}}
                    @else
                        {{-- <li><a href="{{ $url }}">{{ $page }}</a></li> --}}
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            {{-- <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li> --}}
            <li class="page-item next"><a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>

        @else
            <li class="disabled"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
        @endif
    </ul>
</nav>
@endif


    {{-- <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="disabled"><span><a>&raquo;</a></span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a class="active"><span>{{ $page }}</span></a>
                    @else
                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="disabled"><span><a>&raquo;</a></span></li>
        @endif
    </ul> --}} 

