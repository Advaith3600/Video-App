@if ($paginator->hasPages())
    <ul class="pagination" style="text-align:right;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
           
        <li class="paginate_button page-item previous disabled" id="advanced_table_previous"><a href="#"
                aria-controls="advanced_table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
        </li>
        @else
            <li class="paginate_button page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" url="{{ $paginator->previousPageUrl() }}"><i class="las la-arrow-left"></i></a></li>
        @endif
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="paginate_button page-item"><span>{{ $element }}</span></li>
            @endif
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="paginate_button page-item active"><a class="page-link" url="{{$url}}" href="{{$url}}" >{{$page}}</a></li>
                    @else
                        <li class="paginate_button page-item"><a class="page-link" url="{{$url}}" href="{{$url}}" >{{$page}}</a></a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="paginate_button page-item next" id="advanced_table_next"><a href="{{ $paginator->nextPageUrl() }}"
                            aria-controls="advanced_table" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li>
        @else
        <li class="paginate_button page-item next" id="advanced_table_next"><a href="{{ $paginator->nextPageUrl() }}"
                            aria-controls="advanced_table" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li>
        @endif
    </ul>
@endif
