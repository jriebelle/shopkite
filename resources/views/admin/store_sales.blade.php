@extends('layouts.admin')

@section('title', 'Online Store Sales — ShopKite Admin')
@section('breadcrumb_title', 'Store Sales')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Online <strong>Store Orders &amp; Sales</strong></h1>
        <p class="admin-page-subtitle">Track orders placed by shoppers through digital storefronts hosted on the ShopKite merchant platform.</p>
    </div>
</div>

<!-- ── Toolbar: Filter Pills & Search Form ───────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group">
        <a href="{{ route('admin.store_sales', ['filter' => 'all', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
            <span>All Sales</span>
            <span class="admin-pill-count">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.store_sales', ['filter' => 'completed', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'completed' ? 'active' : '' }}">
            <span>Completed</span>
            <span class="admin-pill-count">{{ $counts['completed'] }}</span>
        </a>
        <a href="{{ route('admin.store_sales', ['filter' => 'in_progress', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'in_progress' ? 'active' : '' }}">
            <span>In Progress</span>
            <span class="admin-pill-count">{{ $counts['in_progress'] }}</span>
        </a>
        <a href="{{ route('admin.store_sales', ['filter' => 'canceled', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'canceled' ? 'active' : '' }}">
            <span>Canceled</span>
            <span class="admin-pill-count">{{ $counts['canceled'] }}</span>
        </a>
        <a href="{{ route('admin.store_sales', ['filter' => 'refunded', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'refunded' ? 'active' : '' }}">
            <span>Refunded</span>
            <span class="admin-pill-count">{{ $counts['refunded'] }}</span>
        </a>
    </div>

    <form action="{{ route('admin.store_sales') }}" method="GET" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text"
               name="q"
               class="admin-search-input admin-table-search-input"
               placeholder="Search order #, store, customer..."
               value="{{ $searchQuery }}">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.store_sales', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
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
        @if($storeSales->count() > 0)
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order # &amp; Date</th>
                        <th>Host Store</th>
                        <th>Customer Details</th>
                        <th>Items Summary</th>
                        <th>Fulfillment</th>
                        <th>Total (₦)</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($storeSales as $sale)
                        <tr>
                            <td>
                                <div><strong style="font-family: monospace; font-size: 13.5px;">{{ $sale['order_number'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #94a3b8;">{{ $sale['date'] }}</span>
                            </td>
                            <td>
                                <div><span style="font-size: 13px; font-weight: 500; color: #1e293b;">{{ $sale['store_name'] }}</span></div>
                            </td>
                            <td>
                                <div><strong>{{ $sale['customer_name'] }}</strong></div>
                                <span style="font-size: 12px; color: #64748b;">{{ $sale['customer_phone'] }}</span>
                            </td>
                            <td>
                                <span style="font-size: 13px; color: #475569;">{{ $sale['items_summary'] }}</span>
                            </td>
                            <td>
                                <div><span style="font-size: 12.5px; color: #1e293b;">{{ $sale['delivery_type'] }}</span></div>
                                <span style="font-size: 11.5px; color: #64748b;">{{ $sale['payment_status'] }}</span>
                            </td>
                            <td>
                                <strong style="font-size: 14.5px; color: #1e293b;">{{ $sale['total_formatted'] }}</strong>
                            </td>
                            <td>
                                <span class="admin-status-badge badge-{{ $sale['status'] }}">
                                    {{ $sale['status_label'] }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <button type="button"
                                        class="admin-secondary-btn"
                                        style="padding: 5px 10px; font-size: 12px;"
                                        onclick="showAdminToast('Order details for {{ $sale['order_number'] }} loaded', 'success')">
                                    View
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="admin-empty-table-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                <h3>No store orders found</h3>
                <p>No customer orders match your active filter.</p>
                <a href="{{ route('admin.store_sales') }}" class="admin-secondary-btn">Reset Filters</a>
            </div>
        @endif
    </div>
</div>
@endsection
