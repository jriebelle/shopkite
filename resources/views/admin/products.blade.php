@extends('layouts.admin')

@section('title', 'Products & SKUs — ShopKite Admin')
@section('breadcrumb_title', 'Products (SKUs)')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Products &amp; <strong>Merchant SKUs</strong></h1>
        <p class="admin-page-subtitle">Manage items uploaded to the ShopKite Merchant App, review barcodes, and verify items for the universal catalog.</p>
    </div>
</div>

<!-- ── Toolbar: Filter Pills & Search Form ───────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group">
        <a href="{{ route('admin.products', ['filter' => 'all', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
            <span>All Products</span>
            <span class="admin-pill-count">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.products', ['filter' => 'unverified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'unverified' ? 'active' : '' }}">
            <span>Unverified Products</span>
            <span class="admin-pill-count">{{ $counts['unverified'] }}</span>
        </a>
        <a href="{{ route('admin.products', ['filter' => 'verified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'verified' ? 'active' : '' }}">
            <span>Verified Products</span>
            <span class="admin-pill-count">{{ $counts['verified'] }}</span>
        </a>
    </div>

    <form action="{{ route('admin.products') }}" method="GET" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text"
               name="q"
               class="admin-search-input admin-table-search-input"
               placeholder="Search product name, barcode, merchant..."
               value="{{ $searchQuery }}">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.products', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
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
        @if($products->count() > 0)
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Product &amp; SKU</th>
                        <th>Barcode</th>
                        <th>Category</th>
                        <th>Manufacturer</th>
                        <th>Merchant Store</th>
                        <th>Pricing</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <div><strong>{{ $product['name'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">{{ $product['id'] }}</span>
                            </td>
                            <td>
                                @if($product['has_barcode'])
                                    <span class="admin-barcode-badge">{{ $product['barcode'] }}</span>
                                @else
                                    <span style="font-size: 12px; color: #94a3b8; font-style: italic;">No Universal Barcode</span>
                                @endif
                            </td>
                            <td>
                                <span style="font-size: 13px; color: #475569;">{{ $product['category'] }}</span>
                            </td>
                            <td>
                                <span style="font-size: 13px; color: #475569;">{{ $product['manufacturer'] }}</span>
                            </td>
                            <td>
                                <span style="font-size: 13px; font-weight: 500; color: #1e293b;">{{ $product['merchant'] }}</span>
                            </td>
                            <td>
                                <div><strong>{{ $product['selling_price'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #64748b;">Cost: {{ $product['cost_price'] }}</span>
                            </td>
                            <td>
                                <span class="admin-status-badge badge-{{ $product['status'] }}">
                                    {{ $product['status_label'] }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                @if($product['status'] === 'unverified')
                                    <button type="button" class="admin-verify-btn" data-id="{{ $product['id'] }}" data-type="product">
                                        Verify SKU
                                    </button>
                                @else
                                    <span style="font-size: 12px; color: #059669; font-weight: 500;">&check; Verified</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="admin-empty-table-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path></svg>
                <h3>No products found</h3>
                <p>No SKU records match your active filter or search query.</p>
                <a href="{{ route('admin.products') }}" class="admin-secondary-btn">Reset Filters</a>
            </div>
        @endif
    </div>
</div>
@endsection
