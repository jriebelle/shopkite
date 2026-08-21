@extends('layouts.admin')

@section('title', 'Categories — ShopKite Admin')
@section('breadcrumb_title', 'Categories')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Retail <strong>Product Categories</strong></h1>
        <p class="admin-page-subtitle">Master department classification and tax/inventory categorization for FMCG, supermarkets, and pharmacies.</p>
    </div>
</div>

<!-- ── Toolbar: Filter Pills & Search Form ───────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group">
        <a href="{{ route('admin.categories', ['filter' => 'all', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
            <span>All Categories</span>
            <span class="admin-pill-count">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.categories', ['filter' => 'verified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'verified' ? 'active' : '' }}">
            <span>Verified Categories</span>
            <span class="admin-pill-count">{{ $counts['verified'] }}</span>
        </a>
        <a href="{{ route('admin.categories', ['filter' => 'unverified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'unverified' ? 'active' : '' }}">
            <span>Unverified Categories</span>
            <span class="admin-pill-count">{{ $counts['unverified'] }}</span>
        </a>
    </div>

    <form action="{{ route('admin.categories') }}" method="GET" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text"
               name="q"
               class="admin-search-input admin-table-search-input"
               placeholder="Search category name..."
               value="{{ $searchQuery }}">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.categories', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
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
        @if($categories->count() > 0)
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Catalog SKUs</th>
                        <th>Active Merchants Using</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                        <tr>
                            <td>
                                <div><strong>{{ $cat['name'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">Slug: {{ $cat['slug'] }}</span>
                            </td>
                            <td>
                                <strong>{{ number_format($cat['sku_count']) }}</strong> SKUs
                            </td>
                            <td>
                                <span>{{ number_format($cat['merchants_count']) }} stores</span>
                            </td>
                            <td>
                                <span class="admin-status-badge badge-{{ $cat['status'] }}">
                                    {{ ucfirst($cat['status']) }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                @if($cat['status'] === 'unverified')
                                    <button type="button" class="admin-verify-btn" data-id="{{ $cat['id'] }}" data-type="category">
                                        Verify Category
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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon></svg>
                <h3>No categories found</h3>
                <p>No category records match your active filter.</p>
                <a href="{{ route('admin.categories') }}" class="admin-secondary-btn">Reset Filters</a>
            </div>
        @endif
    </div>
</div>
@endsection
