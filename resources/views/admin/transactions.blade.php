@extends('layouts.admin')

@section('title', 'Transactions Ledger — ShopKite Admin')
@section('breadcrumb_title', 'Transactions')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Transactions &amp; <strong>Revenue Ledger</strong></h1>
        <p class="admin-page-subtitle">Real-time payments received across merchant software subscriptions, custom onboarding services, and hardware store purchases.</p>
    </div>
</div>

<!-- ── Toolbar: Filter Pills & Search Form ───────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group">
        <a href="{{ route('admin.transactions', ['filter' => 'all', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
            <span>All Transactions</span>
            <span class="admin-pill-count">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.transactions', ['filter' => 'subscription', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'subscription' ? 'active' : '' }}">
            <span>Subscriptions</span>
            <span class="admin-pill-count">{{ $counts['subscription'] }}</span>
        </a>
        <a href="{{ route('admin.transactions', ['filter' => 'services', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'services' ? 'active' : '' }}">
            <span>Services</span>
            <span class="admin-pill-count">{{ $counts['services'] }}</span>
        </a>
        <a href="{{ route('admin.transactions', ['filter' => 'store_order', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'store_order' ? 'active' : '' }}">
            <span>Store Orders</span>
            <span class="admin-pill-count">{{ $counts['store_order'] }}</span>
        </a>
    </div>

    <form action="{{ route('admin.transactions') }}" method="GET" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text"
               name="q"
               class="admin-search-input admin-table-search-input"
               placeholder="Search reference, merchant, payment..."
               value="{{ $searchQuery }}">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.transactions', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
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
        @if($transactions->count() > 0)
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Reference / Merchant</th>
                        <th>Type &amp; Purpose</th>
                        <th>Payment Channel</th>
                        <th>Date &amp; Time</th>
                        <th>Amount (₦)</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $txn)
                        <tr>
                            <td>
                                <div><strong>{{ $txn['merchant'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">{{ $txn['reference'] }}</span>
                            </td>
                            <td>
                                <div><span style="font-size: 13px; font-weight: 500; color: #1e293b;">{{ $txn['type_label'] }}</span></div>
                                <span style="font-size: 11.5px; color: #64748b; text-transform: uppercase;">{{ str_replace('_', ' ', $txn['service_type']) }}</span>
                            </td>
                            <td>
                                <span style="font-size: 12.5px; color: #475569;">{{ $txn['channel'] }}</span>
                            </td>
                            <td>
                                <span style="font-size: 12.5px; color: #64748b;">{{ $txn['date'] }}</span>
                            </td>
                            <td>
                                <strong style="font-size: 14.5px; color: #1e293b;">{{ $txn['amount_formatted'] }}</strong>
                            </td>
                            <td>
                                <span class="admin-status-badge badge-{{ $txn['status'] }}">
                                    {{ ucfirst($txn['status']) }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <button type="button" class="admin-secondary-btn" style="padding: 5px 10px; font-size: 12px;" onclick="showAdminToast('Receipt sent to {{ $txn['customer_email'] }}', 'success')">
                                    Receipt
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="admin-empty-table-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3v18l12-18v18"></path><line x1="3" y1="9" x2="21" y2="9"></line><line x1="3" y1="15" x2="21" y2="15"></line></svg>
                <h3>No transactions found</h3>
                <p>No financial records match your active filter.</p>
                <a href="{{ route('admin.transactions') }}" class="admin-secondary-btn">Reset Filters</a>
            </div>
        @endif
    </div>
    @include('partials.admin-pagination', ['total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage])
</div>
@endsection
