@if ($paginator->hasPages())
    <nav>
        <ul class="pagination justify-content-center my-4">
            {{-- Lien "Précédent" --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">« Précédent</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">« Précédent</a>
                </li>
            @endif

            {{-- Lien "Suivant" --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant »</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">Suivant »</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
