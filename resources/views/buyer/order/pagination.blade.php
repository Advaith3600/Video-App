@if ($paginator->hasPages())
    <ul class="pagination" >
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <i class="las la-arrow-left"></i>
            </a></i>
        </li>
        @else
            <li class="page-item"><a class="page-link" href="#" url="{{ $paginator->previousPageUrl() }}"><i class="las la-arrow-left"></i></a></li>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item"><span>{{ $element }}</span></li>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link" url="{{$url}}" href="#" >{{$page}}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" url="{{$url}}" href="#" >{{$page}}</a></a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a href="{{ $paginator->nextPageUrl() }}" class="page-link" href="#" aria-label="Next"rel="next"><i class="las la-arrow-right"></i></a></li>
        @else
            <a class="page-link" href="#" aria-label="Next">
                <i class="las la-arrow-right"></i>
            </a>
        @endif
    </ul>
@endif
