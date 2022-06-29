<style>
    .flecha {
        font-size: 18px;
    }

    .page-item {
        width: 50px;
        height: 50px;
        text-align: center;
        margin-left: 10px;
        font-size: 18px;
    }

    .page-item:first-child .page-link {
        margin-left: 0;
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .page-link {
        border: 0px solid transparent !important;
        position: relative;
        display: block;
        color: #000;
        background-color: #fff;
        border-radius: 100%;
    }

    .page-link:hover {
        border: 0px solid transparent !important;
        position: relative;
        display: block;
        color: #000;
        background-color: #fff;
        border-radius: 100%;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #000;
        border-color: #000;
    }

    .page-item.active .page-link:hover {
        z-index: 3;
        color: #fff;
        background-color: #000;
        border-color: #000;
    }

    @media (max-width: 991px) {
        .flecha {
            font-size: 14px;
        }

        .page-item {
            font-size: 14px;
        }
    }

    @media (max-width: 681px) {
        .flecha {
            font-size: 12px;
        }

        .page-item {
            width: 30px;
            height: 30px;
            margin-left: 5px;
            font-size: 12px;
        }
    }

</style>

@if ($paginator->hasPages())
<nav aria-label="Page navigation example ">
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span class="page-link flecha " aria-hidden="true">&lsaquo;</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link flecha" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link flecha" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
        @else
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="page-link flecha" aria-hidden="true">&rsaquo;</span>
        </li>
        @endif
    </ul>
</nav>

@endif
