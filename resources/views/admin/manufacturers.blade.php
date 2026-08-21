@extends('layouts.admin')

@section('title', 'Manufacturers & Brands — ShopKite Admin')
@section('breadcrumb_title', 'Manufacturers')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Manufacturers &amp; <strong>Brands</strong></h1>
        <p class="admin-page-subtitle">Directory of consumer goods manufacturers, pharmaceutical producers, and official distributors on ShopKite.</p>
    </div>
</div>

<!-- ── Toolbar: Filter Pills & Search Form ───────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group">
        <a href="{{ route('admin.manufacturers', ['filter' => 'all', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
            <span>All Manufacturers</span>
            <span class="admin-pill-count">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.manufacturers', ['filter' => 'verified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'verified' ? 'active' : '' }}">
            <span>Verified Manufacturers</span>
            <span class="admin-pill-count">{{ $counts['verified'] }}</span>
        </a>
        <a href="{{ route('admin.manufacturers', ['filter' => 'unverified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'unverified' ? 'active' : '' }}">
            <span>Unverified Manufacturers</span>
            <span class="admin-pill-count">{{ $counts['unverified'] }}</span>
        </a>
    </div>

    <form action="{{ route('admin.manufacturers') }}" method="GET" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text"
               name="q"
               class="admin-search-input admin-table-search-input"
               placeholder="Search manufacturer, origin, contact..."
               value="{{ $searchQuery }}">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.manufacturers', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
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
        @if($manufacturers->count() > 0)
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Manufacturer / Company</th>
                        <th>Country of Origin</th>
                        <th>Catalog Products</th>
                        <th>Official Contact</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($manufacturers as $mfg)
                        <tr>
                            <td>
                                <div><strong>{{ $mfg['name'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #94a3b8;">ID: MFG-{{ str_pad($mfg['id'], 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td>
                                <span style="font-size: 13px; color: #475569;">{{ $mfg['country'] }}</span>
                            </td>
                            <td>
                                <strong>{{ $mfg['total_products'] }}</strong> registered SKUs
                            </td>
                            <td>
                                <span style="font-size: 12.5px; color: #64748b; font-family: monospace;">{{ $mfg['contact'] }}</span>
                            </td>
                            <td>
                                <span class="admin-status-badge badge-{{ $mfg['status'] }}">
                                    {{ ucfirst($mfg['status']) }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                @if($mfg['status'] === 'unverified')
                                    <button type="button" class="admin-verify-btn" data-id="{{ $mfg['id'] }}" data-type="manufacturer">
                                        Verify Manufacturer
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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <h3>No manufacturers found</h3>
                <p>No manufacturer records match your active filter.</p>
                <a href="{{ route('admin.manufacturers') }}" class="admin-secondary-btn">Reset Filters</a>
            </div>
        @endif
    </div>
</div>
@endsection
