<div class="pagination">
    @if ($paginator->hasPages())
        <div class="flex justify-between">
            @if ($paginator->onFirstPage())
                <span class="disabled page-btn">Précédent</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="page-btn">Précédent</a>
            @endif

            <div>
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="disabled page-btn">{{ $element }}</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="page-num active">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="page-num">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="page-btn">Suivant</a>
            @else
                <span class="disabled page-btn">Suivant</span>
            @endif
        </div>
    @endif
</div>