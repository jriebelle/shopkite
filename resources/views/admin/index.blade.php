@extends('layouts.admin')

@section('title', 'Overview & Metrics — ShopKite Admin')
@section('breadcrumb_title', 'Overview & Metrics')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Platform <strong>Executive Dashboard</strong></h1>
        <p class="admin-page-subtitle">Real-time financial performance, merchant onboarding health, and store commerce metrics across Nigeria.</p>
    </div>
    <div class="admin-header-actions">
        <a href="{{ route('admin.transactions') }}" class="admin-secondary-btn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3v18l12-18v18"></path><line x1="3" y1="9" x2="21" y2="9"></line><line x1="3" y1="15" x2="21" y2="15"></line></svg>
            <span>View All Ledger</span>
        </a>
        <a href="{{ route('admin.merchants') }}" class="admin-primary-btn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            <span>Merchant Directory</span>
        </a>
    </div>
</div>

<!-- ── 1. Top KPI Metrics (Merchants & Transactions) ─────── -->
<div class="admin-metrics-grid">
    <!-- Metric 1: Total Merchants -->
    <div class="admin-metric-card">
        <div class="admin-metric-card-top">
            <span class="admin-metric-label">Active Subscribed Merchants</span>
            <div class="admin-metric-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
        </div>
        <div class="admin-metric-value">{{ $subscribedMerchants }} <span style="font-size: 16px; color: #94a3b8; font-weight: 300;">/ {{ $totalMerchants }} Total</span></div>
        <div class="admin-metric-subtext">
            <span class="admin-trend-badge-positive">&uarr; +14.2%</span>
            <span>vs last month ({{ $trialMerchants }} in active trial)</span>
        </div>
    </div>

    <!-- Metric 2: Total Revenue / MRR -->
    <div class="admin-metric-card">
        <div class="admin-metric-card-top">
            <span class="admin-metric-label">Total Platform Revenue</span>
            <div class="admin-metric-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 3v18l12-18v18"></path><line x1="3" y1="9" x2="21" y2="9"></line><line x1="3" y1="15" x2="21" y2="15"></line></svg>
            </div>
        </div>
        <div class="admin-metric-value">₦{{ number_format($totalRevenue, 2) }}</div>
        <div class="admin-metric-subtext">
            <span class="admin-trend-badge-positive">&uarr; 99.8%</span>
            <span>successful transaction settlement</span>
        </div>
    </div>

    <!-- Metric 3: Online Store Sales Volume -->
    <div class="admin-metric-card">
        <div class="admin-metric-card-top">
            <span class="admin-metric-label">Online Store GMV</span>
            <div class="admin-metric-icon-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            </div>
        </div>
        <div class="admin-metric-value">₦{{ number_format($storeSalesVolume, 2) }}</div>
        <div class="admin-metric-subtext">
            <span style="color: #64748b; font-weight: 400;">{{ $totalStoreSales }} customer orders placed</span>
        </div>
    </div>

    <!-- Metric 4: Catalog & Product Verification Health -->
    <div class="admin-metric-card">
        <div class="admin-metric-card-top">
            <span class="admin-metric-label">Pending SKU Verifications</span>
            <div class="admin-metric-icon-wrap" style="background: #fff7ed; color: #ea580c;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            </div>
        </div>
        <div class="admin-metric-value">{{ $unverifiedProducts }} <span style="font-size: 16px; color: #94a3b8; font-weight: 300;">SKUs pending</span></div>
        <div class="admin-metric-subtext">
            <span style="color: #059669; font-weight: 500;">{{ $verifiedProducts }} verified</span>
            <span>in universal master registry</span>
        </div>
    </div>
</div>

<!-- ── 2. Split Feeds: Recent Transactions & Active Merchants ── -->
<div class="admin-dashboard-split-grid">

    <!-- Recent Transactions -->
    <div class="admin-table-card">
        <div class="admin-card-header">
            <h3>Recent Financial Transactions</h3>
            <a href="{{ route('admin.transactions') }}" class="view-all-link">View All &rarr;</a>
        </div>
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Reference / Merchant</th>
                        <th>Type</th>
                        <th>Amount (₦)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTransactions as $txn)
                        <tr>
                            <td>
                                <div><strong>{{ $txn['merchant'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">{{ $txn['reference'] }}</span>
                            </td>
                            <td>
                                <span style="font-size: 12.5px; color: #475569;">{{ $txn['type_label'] }}</span>
                            </td>
                            <td>
                                <strong>{{ $txn['amount_formatted'] }}</strong>
                            </td>
                            <td>
                                <span class="admin-status-badge badge-{{ $txn['status'] }}">
                                    {{ ucfirst($txn['status']) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Merchant Breakdown / Growth -->
    <div class="admin-table-card">
        <div class="admin-card-header">
            <h3>Recent Merchant Onboarding</h3>
            <a href="{{ route('admin.merchants') }}" class="view-all-link">View All &rarr;</a>
        </div>
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Store &amp; Owner</th>
                        <th>Location</th>
                        <th>Plan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentMerchants as $mch)
                        <tr>
                            <td>
                                <div><strong>{{ $mch['store_name'] }}</strong></div>
                                <span style="font-size: 12px; color: #64748b;">{{ $mch['name'] }}</span>
                            </td>
                            <td>
                                <span>{{ $mch['city'] }}, {{ $mch['state'] }}</span>
                            </td>
                            <td>
                                <span style="font-size: 12px; font-weight: 500; color: #475569;">{{ $mch['plan'] }}</span>
                            </td>
                            <td>
                                <span class="admin-status-badge badge-{{ $mch['status'] }}">
                                    {{ $mch['status_label'] }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- ── 3. Quick Action Shortcuts ─────────────────────────── -->
<div class="admin-table-card" style="padding: 24px;">
    <h3 style="margin: 0 0 16px 0; font-size: 16px; font-weight: 500;">Direct Management Shortcuts</h3>
    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
        <a href="{{ route('admin.products', ['filter' => 'unverified']) }}" class="admin-secondary-btn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path></svg>
            <span>Review Unverified SKUs ({{ $unverifiedProducts }})</span>
        </a>
        <a href="{{ route('admin.merchants', ['filter' => 'trial']) }}" class="admin-secondary-btn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path></svg>
            <span>View Active Trials ({{ $trialMerchants }})</span>
        </a>
        <a href="{{ route('admin.faqs') }}" class="admin-secondary-btn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path></svg>
            <span>Update Store FAQs</span>
        </a>
        <a href="{{ route('admin.blog') }}" class="admin-secondary-btn">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path></svg>
            <span>Manage Blog Articles</span>
        </a>
    </div>
</div>
@endsection
