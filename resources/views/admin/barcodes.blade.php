@extends('layouts.admin')

@section('title', 'Barcode Registry — ShopKite Admin')
@section('breadcrumb_title', 'Barcode Products')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Barcode <strong>Product Registry</strong></h1>
        <p class="admin-page-subtitle">Universal EAN-13 and UPC barcode master database used across all ShopKite POS terminals in retail stores.</p>
    </div>
</div>

<!-- ── Toolbar: Filter Pills & Search Form ───────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group">
        <a href="{{ route('admin.barcodes', ['filter' => 'all', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
            <span>All Barcodes</span>
            <span class="admin-pill-count">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.barcodes', ['filter' => 'verified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'verified' ? 'active' : '' }}">
            <span>Verified Barcodes</span>
            <span class="admin-pill-count">{{ $counts['verified'] }}</span>
        </a>
        <a href="{{ route('admin.barcodes', ['filter' => 'unverified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'unverified' ? 'active' : '' }}">
            <span>Unverified Barcodes</span>
            <span class="admin-pill-count">{{ $counts['unverified'] }}</span>
        </a>
    </div>

    <form action="{{ route('admin.barcodes') }}" method="GET" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text"
               name="q"
               class="admin-search-input admin-table-search-input"
               placeholder="Search barcode number, product, brand..."
               value="{{ $searchQuery }}">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.barcodes', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>
        @endif
    </form>
</div>

<!-- ── Data Table ────────────────────────────────────────── -->
<div class="admin-table-card">
    <div class="admin-table-container">
        @if($barcodes->count() > 0)
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Barcode Number</th>
                        <th>Product Title</th>
                        <th>Manufacturer / Brand</th>
                        <th>Category</th>
                        <th>Verification Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barcodes as $item)
                        <tr>
                            <td>
                                <span class="admin-barcode-badge" style="font-size: 13px; font-weight: 700; color: #1e293b;">{{ $item['barcode'] }}</span>
                            </td>
                            <td>
                                <div><strong>{{ $item['name'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #94a3b8;">Linked SKU: {{ $item['id'] }}</span>
                            </td>
                            <td>
                                <span style="font-size: 13px; color: #475569;">{{ $item['manufacturer'] }}</span>
                            </td>
                            <td>
                                <span style="font-size: 13px; color: #475569;">{{ $item['category'] }}</span>
                            </td>
                            <td>
                                <span class="admin-status-badge badge-{{ $item['status'] }}">
                                    {{ $item['status_label'] }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                @if($item['status'] === 'unverified')
                                    <button type="button" class="admin-verify-btn" data-id="{{ $item['id'] }}" data-type="barcode">
                                        Verify Barcode
                                    </button>
                                @else
                                    <span style="font-size: 12px; color: #059669; font-weight: 500;">&check; Certified</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="admin-empty-table-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="5" x2="3" y2="19"></line><line x1="7" y1="5" x2="7" y2="19"></line><line x1="11" y1="5" x2="11" y2="19"></line></svg>
                <h3>No barcode records found</h3>
                <p>No barcode items match your active filter or search query.</p>
                <a href="{{ route('admin.barcodes') }}" class="admin-secondary-btn">Reset Filters</a>
            </div>
        @endif
    </div>
</div>
@endsection
