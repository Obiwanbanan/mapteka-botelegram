@if($total !== 0)
    <ul class="pagination">
        <li class="page-item @if($page === 1) disabled @endif prev">
            <button type="button" class="page-link">&lsaquo;</button>
        </li>

        @if($page - 2 > 0)
            <li class="page-item">
                <span class="page-link">1</span>
            </li>
        @endif

        @if($page - 3 <= $totalPage && $page > 3)
            <li class="page-item disabled dots" aria-disabled="true"><span class="page-link">...</span></li>
        @endif

        @if($page - 1 <= $totalPage && $page != 1)
            <li class="page-item">
                <span class="page-link">{{ $page - 1 }}</span>
            </li>
        @endif

        <li class="page-item active">
            <span class="page-link">{{ $page }}</span>
        </li>

        @if($page + 1 < $totalPage)
            <li class="page-item">
                <span class="page-link">{{ $page + 1 }}</span>
            </li>
        @endif

        @if($page + 3 <= $totalPage)
            <li class="page-item disabled dots" aria-disabled="true"><span class="page-link">...</span></li>
        @endif

        @if($page < $totalPage)
            <li class="page-item">
                <span class="page-link">{{ $totalPage }}</span>
            </li>
        @endif

        <li class="page-item @if($page === (int)$totalPage) disabled @endif next">
            <button class="page-link">&rsaquo;</button>
        </li>
    </ul>
@else
    <h2 class="not-found-result">По вашему результату поиска ничего не найдено 😔</h2>
@endif
