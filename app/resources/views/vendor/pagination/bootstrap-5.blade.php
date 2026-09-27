@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-end">
            {{-- Botão "Anterior" --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" style="background-color: white; color: rgb(39, 94, 243);">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" style="background-color: white; color:  rgb(39, 94, 243);">&laquo;</a>
                </li>
            @endif

            {{-- Links das páginas --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link" style="background-color: white; color:   rgb(39, 94, 243);">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link" style="background-color:   rgb(39, 94, 243); color: white;">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}" style="background-color: white; color:   rgb(39, 94, 243);">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Botão "Próximo" --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" style="background-color: white; color:  rgb(39, 94, 243);">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" style="background-color: white; color:  rgb(39, 94, 243);">&raquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
