@php
    $total = isset($total) ? (int)$total : (isset($items) ? count($items) : 0);
    $perPage = isset($perPage) ? (int)$perPage : 10;
    $currentPage = isset($currentPage) ? max(1, (int)$currentPage) : 1;
    $totalPages = max(1, (int) ceil($total / $perPage));
    if ($currentPage > $totalPages) $currentPage = $totalPages;

    $from = $total > 0 ? (($currentPage - 1) * $perPage) + 1 : 0;
    $to = min($total, $currentPage * $perPage);

    $queryParams = isset($queryParams) ? $queryParams : request()->query();
    $isStandalone = !empty($isStandalone);
@endphp

<div class="admin-pagination-card {{ $isStandalone ? 'standalone' : '' }}">
    <div class="admin-pagination-info">
        @if($total > 0)
            Showing <strong>{{ $from }}</strong> to <strong>{{ $to }}</strong> of <strong>{{ number_format($total) }}</strong> entries
        @else
            Showing <strong>0</strong> entries
        @endif
    </div>

    <div class="admin-pagination-controls">
        <!-- Previous Page Link -->
        @if($currentPage > 1)
            <a href="{{ request()->fullUrlWithQuery(array_merge($queryParams, ['page' => $currentPage - 1])) }}"
               class="admin-pagination-btn"
               title="Previous Page">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                <span>Prev</span>
            </a>
        @else
            <button type="button" class="admin-pagination-btn disabled" disabled aria-disabled="true">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                <span>Prev</span>
            </button>
        @endif

        <!-- Page Numbers -->
        @for($p = 1; $p <= $totalPages; $p++)
            @if($p == $currentPage)
                <span class="admin-pagination-btn active">{{ $p }}</span>
            @else
                <a href="{{ request()->fullUrlWithQuery(array_merge($queryParams, ['page' => $p])) }}"
                   class="admin-pagination-btn">
                    {{ $p }}
                </a>
            @endif
        @endfor

        <!-- Next Page Link -->
        @if($currentPage < $totalPages)
            <a href="{{ request()->fullUrlWithQuery(array_merge($queryParams, ['page' => $currentPage + 1])) }}"
               class="admin-pagination-btn"
               title="Next Page">
                <span>Next</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </a>
        @else
            <button type="button" class="admin-pagination-btn disabled" disabled aria-disabled="true">
                <span>Next</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        @endif

        <!-- Page Size Indicator -->
        <div class="admin-pagination-page-size">
            <span>Rows:</span>
            <select class="admin-pagination-select" onchange="const u = new URL(window.location); u.searchParams.set('per_page', this.value); u.searchParams.set('page', 1); window.location.href = u.toString();">
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 / page</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 / page</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50 / page</option>
            </select>
        </div>
    </div>
</div>
