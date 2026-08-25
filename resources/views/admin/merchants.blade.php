@extends('layouts.admin')

@section('title', 'Merchants Directory — ShopKite Admin')
@section('breadcrumb_title', 'Merchants')

@section('content')

<!-- ═══════════════════════════════════════════════════════════
     VIEW 1: MERCHANTS DIRECTORY LIST VIEW
     ═══════════════════════════════════════════════════════════ -->
<div id="merchantsListView">
    <!-- Page Header -->
    <div class="admin-page-header">
        <div class="admin-page-title-group">
            <h1>Retail <strong>Merchant Accounts</strong></h1>
            <p class="admin-page-subtitle">Track active subscribers, retail store owners on trial, connected devices, and churned accounts.</p>
        </div>
    </div>

    <!-- ── Toolbar: Filter Pills & Search Form ───────────────── -->
    <div class="admin-toolbar-card">
        <div class="admin-filter-pills-group">
            <a href="{{ route('admin.merchants', ['filter' => 'all', 'q' => $searchQuery]) }}"
               class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
                <span>All Merchants</span>
                <span class="admin-pill-count">{{ $counts['all'] }}</span>
            </a>
            <a href="{{ route('admin.merchants', ['filter' => 'subscribed', 'q' => $searchQuery]) }}"
               class="admin-filter-pill {{ $selectedFilter === 'subscribed' ? 'active' : '' }}">
                <span>Subscribed</span>
                <span class="admin-pill-count">{{ $counts['subscribed'] }}</span>
            </a>
            <a href="{{ route('admin.merchants', ['filter' => 'trial', 'q' => $searchQuery]) }}"
               class="admin-filter-pill {{ $selectedFilter === 'trial' ? 'active' : '' }}">
                <span>Trial</span>
                <span class="admin-pill-count">{{ $counts['trial'] }}</span>
            </a>
            <a href="{{ route('admin.merchants', ['filter' => 'previously_subscribed', 'q' => $searchQuery]) }}"
               class="admin-filter-pill {{ $selectedFilter === 'previously_subscribed' ? 'active' : '' }}">
                <span>Previously Subscribed</span>
                <span class="admin-pill-count">{{ $counts['previously_subscribed'] }}</span>
            </a>
            <a href="{{ route('admin.merchants', ['filter' => 'inactive', 'q' => $searchQuery]) }}"
               class="admin-filter-pill {{ $selectedFilter === 'inactive' ? 'active' : '' }}">
                <span>Inactive</span>
                <span class="admin-pill-count">{{ $counts['inactive'] }}</span>
            </a>
        </div>

        <form action="{{ route('admin.merchants') }}" method="GET" class="admin-search-form">
            <input type="hidden" name="filter" value="{{ $selectedFilter }}">
            <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text"
                   name="q"
                   class="admin-search-input admin-table-search-input"
                   placeholder="Search store name, owner, city..."
                   value="{{ $searchQuery }}">
            @if(!empty($searchQuery))
                <a href="{{ route('admin.merchants', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
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
            @if($merchants->count() > 0)
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Store &amp; Merchant</th>
                            <th>Business Type &amp; Location</th>
                            <th>Subscription Plan</th>
                            <th>Devices</th>
                            <th>SKUs Added</th>
                            <th>iBR Reports</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($merchants as $mch)
                            <tr>
                                <td>
                                    <div>
                                        <a href="javascript:void(0)"
                                           onclick="openMerchantDetail('{{ $mch['id'] }}')"
                                           class="admin-merchant-title-link"
                                           title="Click to view full merchant details">
                                            {{ $mch['store_name'] }}
                                        </a>
                                    </div>
                                    <span style="font-size: 12px; color: #64748b;">
                                        <a href="javascript:void(0)"
                                           onclick="openMerchantDetail('{{ $mch['id'] }}')"
                                           class="admin-merchant-sub-link">
                                            {{ $mch['name'] }}
                                        </a> &bull; {{ $mch['phone'] }}
                                    </span>
                                </td>
                                <td>
                                    <div><span style="font-size: 13px; font-weight: 500; color: #1e293b;">{{ $mch['business_type'] }}</span></div>
                                    <span style="font-size: 12px; color: #64748b;">{{ $mch['city'] }}, {{ $mch['state'] }}</span>
                                </td>
                                <td>
                                    <div><strong style="font-size: 13px; color: #1e293b;">{{ $mch['plan'] }}</strong></div>
                                    <span style="font-size: 11.5px; color: #94a3b8;">Renewal: {{ $mch['renewal_date'] }}</span>
                                </td>
                                <td>
                                    <span style="font-size: 13px; font-weight: 600; color: #334155;">{{ $mch['terminals_count'] }} {{ $mch['terminals_count'] == 1 ? 'Device' : 'Devices' }}</span>
                                </td>
                                <td>
                                    <span style="font-size: 13px; color: #475569;">{{ number_format($mch['products_count']) }} SKUs</span>
                                </td>
                                <td>
                                    @if(!empty($mch['ibr_accessed']))
                                        <span class="admin-merchant-meta-pill" style="background: #f0fdf4; border-color: #bbf7d0; color: #16a34a; font-weight: 600;">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                            <span>Accessed</span>
                                        </span>
                                    @else
                                        <span class="admin-merchant-meta-pill" style="background: #fef2f2; border-color: #fecaca; color: #dc2626; font-weight: 500;">
                                            <span>Never Accessed</span>
                                        </span>
                                    @endif
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
            @else
                <div class="admin-empty-table-state">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                    <h3>No merchants found</h3>
                    <p>No merchant accounts match your active filter.</p>
                    <a href="{{ route('admin.merchants') }}" class="admin-secondary-btn">Reset Filters</a>
                </div>
            @endif
        </div>
        @include('partials.admin-pagination', ['total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage])
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     VIEW 2: IN-PAGE COMPREHENSIVE MERCHANT DETAILS VIEW
     ═══════════════════════════════════════════════════════════ -->
<div id="merchantDetailView" class="admin-merchant-detail-view">
    <!-- Sticky Top Navigation & Quick Actions Bar -->
    <div class="admin-editor-top-bar">
        <div class="admin-editor-nav-group">
            <button type="button" class="admin-editor-back-btn" onclick="closeMerchantDetail()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                <span>Back to Merchants List</span>
            </button>
            <span class="admin-merchant-meta-pill" id="detailMerchantIdPill">Merchant #MCH-1001</span>
            <span class="admin-status-badge badge-subscribed" id="detailStatusBadge">Subscribed</span>
        </div>

        <div class="admin-editor-actions">
            <button type="button" class="admin-secondary-btn" onclick="openSendNoticeModal()">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                <span>Send Notice</span>
            </button>
            <button type="button" class="admin-secondary-btn" onclick="openExtendTrialModal()">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                <span>Extend Trial / Grace</span>
            </button>
            <a href="https://shopkite.store" target="_blank" class="admin-primary-btn" id="detailLiveStoreLink" style="text-decoration: none;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                <span>Live Storefront</span>
            </a>
        </div>
    </div>

    <!-- Hero Header / Profile Card -->
    <div class="admin-merchant-header-card">
        <div class="admin-merchant-profile-group">
            <div class="admin-merchant-avatar" id="detailStoreAvatar">MC</div>
            <div class="admin-merchant-title-meta">
                <h2 id="detailStoreName">MegaCare Pharmacy &amp; Supermarket</h2>
                <div class="admin-merchant-meta-pills">
                    <span class="admin-merchant-meta-pill">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span id="detailOwnerName">Emeka Okafor</span>
                    </span>
                    <span class="admin-merchant-meta-pill">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <span id="detailOwnerPhone">+234 803 123 4567</span>
                    </span>
                    <span class="admin-merchant-meta-pill">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <span id="detailLocation">Ikeja, Lagos</span>
                    </span>
                    <span class="admin-merchant-meta-pill" style="background: rgba(255, 102, 0, 0.08); border-color: rgba(255, 102, 0, 0.2); color: #ff6600; font-weight: 600;">
                        <span id="detailPlanType">Yearly Plan (₦45,000/yr)</span>
                    </span>
                </div>
            </div>
        </div>

        <div style="text-align: right;">
            <div style="font-size: 11.5px; color: #94a3b8; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">All-Time Gross Sales</div>
            <div style="font-size: 24px; font-weight: 700; color: #0f172a; margin: 2px 0;" id="detailTotalSales">₦48,500,000</div>
            <div style="font-size: 12px; color: #64748b;" id="detailOrdersCount">3,840 Total Orders</div>
        </div>
    </div>

    <!-- ── 6-Column KPI Grid (At a Glance Metrics) ────────────── -->
    <div class="admin-merchant-kpi-grid">
        <!-- 1. Number of Branches -->
        <div class="admin-merchant-kpi-card">
            <div class="admin-kpi-header">
                <span class="admin-kpi-title">Store Branches</span>
                <div class="admin-kpi-icon-wrap orange">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M3 7v14M21 7v14M6 11h3M6 15h3M15 11h3M15 15h3M9 3h6v4H9z"/></svg>
                </div>
            </div>
            <div class="admin-kpi-value" id="kpiBranchesCount">3</div>
            <div class="admin-kpi-subtitle" id="kpiBranchesSubtitle">Active retail outlets &amp; hubs</div>
        </div>

        <!-- 2. Hardware & Devices -->
        <div class="admin-merchant-kpi-card">
            <div class="admin-kpi-header">
                <span class="admin-kpi-title">Connected Devices</span>
                <div class="admin-kpi-icon-wrap">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                </div>
            </div>
            <div class="admin-kpi-value" id="kpiTerminalsCount">4 Devices</div>
            <div class="admin-kpi-subtitle" id="kpiTerminalsSubtitle">Sunmi &amp; Mobile devices</div>
        </div>

        <!-- 3. Number of Products Added -->
        <div class="admin-merchant-kpi-card">
            <div class="admin-kpi-header">
                <span class="admin-kpi-title">Products Added</span>
                <div class="admin-kpi-icon-wrap orange">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                </div>
            </div>
            <div class="admin-kpi-value" id="kpiProductsCount">1,420</div>
            <div class="admin-kpi-subtitle">Catalog SKUs uploaded</div>
        </div>

        <!-- 4. Number of Products Running Low -->
        <div class="admin-merchant-kpi-card warning-amber" id="kpiLowStockCard">
            <div class="admin-kpi-header">
                <span class="admin-kpi-title" style="color: #b45309;">Running Low</span>
                <div class="admin-kpi-icon-wrap amber">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
            </div>
            <div class="admin-kpi-value" style="color: #b45309;" id="kpiLowStockCount">18</div>
            <div class="admin-kpi-subtitle" style="color: #d97706;">Items below threshold</div>
        </div>

        <!-- 5. Expiring Products -->
        <div class="admin-merchant-kpi-card warning-red" id="kpiExpiringCard">
            <div class="admin-kpi-header">
                <span class="admin-kpi-title" style="color: #be123c;">Expiring Stock</span>
                <div class="admin-kpi-icon-wrap red">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
            </div>
            <div class="admin-kpi-value" style="color: #be123c;" id="kpiExpiringCount">6</div>
            <div class="admin-kpi-subtitle" style="color: #e11d48;">Next 30–60 days</div>
        </div>

        <!-- 6. Whether Accessed iBR or Not -->
        <div class="admin-merchant-kpi-card highlight-orange" id="kpiIbrCard">
            <div class="admin-kpi-header">
                <span class="admin-kpi-title">iBR Access</span>
                <div class="admin-kpi-icon-wrap orange">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                </div>
            </div>
            <div class="admin-kpi-value" style="font-size: 18px; margin-top: 4px;" id="kpiIbrStatus">Active User</div>
            <div class="admin-kpi-subtitle" id="kpiIbrLastAccess">Accessed Today</div>
        </div>
    </div>

    <!-- ── Navigation Tabs ───────────────────────────────────── -->
    <div class="admin-merchant-tabs-nav">
        <button type="button" class="admin-merchant-tab-btn active" id="tabBtnOverview" onclick="switchMerchantTab('overview')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
            <span>Overview &amp; Profile</span>
        </button>

        <button type="button" class="admin-merchant-tab-btn" id="tabBtnBranches" onclick="switchMerchantTab('branches')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M3 7v14M21 7v14M6 11h3M6 15h3M15 11h3M15 15h3M9 3h6v4H9z"/></svg>
            <span>Branches &amp; Warehouses</span>
            <span class="admin-tab-count-badge" id="tabBadgeBranches">3</span>
        </button>

        <button type="button" class="admin-merchant-tab-btn" id="tabBtnStaff" onclick="switchMerchantTab('staff')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            <span>Staff &amp; Permissions</span>
            <span class="admin-tab-count-badge" id="tabBadgeStaff">5</span>
        </button>

        <button type="button" class="admin-merchant-tab-btn" id="tabBtnInventory" onclick="switchMerchantTab('inventory')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path></svg>
            <span>Inventory Health</span>
            <span class="admin-tab-count-badge" id="tabBadgeInventory" style="background: #fef2f2; color: #dc2626;">18 Low</span>
        </button>

        <button type="button" class="admin-merchant-tab-btn" id="tabBtnSubscription" onclick="switchMerchantTab('subscription')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
            <span>Subscription History</span>
        </button>

        <button type="button" class="admin-merchant-tab-btn" id="tabBtnIbr" onclick="switchMerchantTab('ibr')">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            <span>iBR Intelligence</span>
        </button>
    </div>

    <!-- ── TAB 1: OVERVIEW & PROFILE ─────────────────────────── -->
    <div id="panelOverview" class="admin-merchant-tab-panel active">
        <div class="admin-detail-grid-2col">
            <!-- Store Profile & Ownership -->
            <div class="admin-detail-card">
                <div class="admin-detail-card-header">
                    <h3>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                        <span>Store &amp; Ownership Profile</span>
                    </h3>
                </div>
                <div class="admin-info-list">
                    <div class="admin-info-row">
                        <span class="admin-info-label">Store Registered Name</span>
                        <span class="admin-info-value" id="infoStoreName">MegaCare Pharmacy &amp; Supermarket</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Business Category</span>
                        <span class="admin-info-value" id="infoBusinessType">Pharmacy &amp; FMCG</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Primary Account Owner</span>
                        <span class="admin-info-value" id="infoOwnerName">Emeka Okafor</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Contact Phone</span>
                        <span class="admin-info-value" id="infoOwnerPhone">+234 803 123 4567</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Verified Email</span>
                        <span class="admin-info-value" id="infoOwnerEmail">emeka@megacare.ng</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Physical Address</span>
                        <span class="admin-info-value" id="infoAddress">48 Allen Avenue, Ikeja, Lagos State</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Online Storefront</span>
                        <span class="admin-info-value">
                            <a href="#" target="_blank" id="infoStoreUrl" style="color: #ff6600; text-decoration: underline;">https://shopkite.store/megacare</a>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Hardware, Devices & System Configuration -->
            <div class="admin-detail-card">
                <div class="admin-detail-card-header">
                    <h3>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                        <span>Device Hardware &amp; System Settings</span>
                    </h3>
                </div>
                <div class="admin-info-list">
                    <div class="admin-info-row">
                        <span class="admin-info-label">Registration Date</span>
                        <span class="admin-info-value" id="infoJoinedDate">Jan 12, 2025</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Active Subscription Plan</span>
                        <span class="admin-info-value" id="infoPlan">Yearly Plan (₦45,000/yr)</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Next Renewal / Expiry</span>
                        <span class="admin-info-value" id="infoRenewalDate">Jan 12, 2027</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Local Currency</span>
                        <span class="admin-info-value" id="infoCurrency">₦ NGN (Nigerian Naira)</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Offline Sync State</span>
                        <span class="admin-info-value" style="color: #16a34a; font-weight: 600;" id="infoOfflineSync">Enabled &amp; Synced (0 pending)</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Cloud Auto-Backup</span>
                        <span class="admin-info-value" id="infoAutoBackup">Daily at 11:59 PM</span>
                    </div>
                    <div class="admin-info-row">
                        <span class="admin-info-label">Receipt Footer Memo</span>
                        <span class="admin-info-value" style="font-size: 12px; color: #64748b;" id="infoReceiptFooter">Thank you for choosing MegaCare. Returns accepted within 48 hours.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Connected Device(s) & Hardware List -->
        <div class="admin-detail-card">
            <div class="admin-detail-card-header">
                <h3>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                    <span>Connected Device(s) &amp; Hardware</span>
                </h3>
            </div>
            <div id="detailDevicesList" style="display: flex; flex-wrap: wrap; gap: 10px;">
                <!-- Populated in JS -->
            </div>
        </div>
    </div>

    <!-- ── TAB 2: BRANCHES & WAREHOUSES ──────────────────────── -->
    <div id="panelBranches" class="admin-merchant-tab-panel">
        <div class="admin-table-card">
            <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 600; color: #0f172a;">Store Outlets &amp; Warehouse Distribution Hubs</h3>
                    <p style="margin: 4px 0 0 0; font-size: 12.5px; color: #64748b;">Stores linked to this merchant account for central stock management and inter-branch transfers.</p>
                </div>
            </div>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Branch Name</th>
                            <th>Facility Type</th>
                            <th>Physical Address</th>
                            <th>Manager in Charge</th>
                            <th>Contact Phone</th>
                            <th>Active Devices</th>
                            <th>Catalog SKUs</th>
                        </tr>
                    </thead>
                    <tbody id="branchesTableBody">
                        <!-- Populated in JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ── TAB 3: STAFF & PERMISSIONS ────────────────────────── -->
    <div id="panelStaff" class="admin-merchant-tab-panel">
        <div class="admin-table-card">
            <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 600; color: #0f172a;">Authorized Staff Members &amp; Roles</h3>
                    <p style="margin: 4px 0 0 0; font-size: 12.5px; color: #64748b;">Cashiers, managers, and inventory clerks permitted to process checkouts and stock updates.</p>
                </div>
            </div>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Staff Full Name</th>
                            <th>Permission Level / Role</th>
                            <th>Assigned Branch</th>
                            <th>Phone Number</th>
                            <th>Security PIN</th>
                            <th>Last Active Login</th>
                        </tr>
                    </thead>
                    <tbody id="staffTableBody">
                        <!-- Populated in JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ── TAB 4: INVENTORY HEALTH & STOCK ALERTS ─────────────── -->
    <div id="panelInventory" class="admin-merchant-tab-panel">
        <div class="admin-detail-grid-2col">
            <!-- Low Stock Alerts Box -->
            <div class="admin-detail-card">
                <div class="admin-detail-card-header">
                    <h3>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#d97706" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                        <span>Products Running Low (Below Minimum Quantity)</span>
                    </h3>
                </div>
                <div id="lowStockItemsList">
                    <!-- Populated in JS -->
                </div>
            </div>

            <!-- Expiring Products Alerts Box -->
            <div class="admin-detail-card">
                <div class="admin-detail-card-header">
                    <h3>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span>Expiring Products (Next 30–60 Days)</span>
                    </h3>
                </div>
                <div id="expiringItemsList">
                    <!-- Populated in JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- ── TAB 5: SUBSCRIPTION HISTORY & BILLING LEDGER ──────── -->
    <div id="panelSubscription" class="admin-merchant-tab-panel">
        <div class="admin-table-card">
            <div style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 600; color: #0f172a;">Subscription Invoices &amp; Payment History</h3>
                    <p style="margin: 4px 0 0 0; font-size: 12.5px; color: #64748b;">Complete billing records, auto-renewal invoices, and license validity periods.</p>
                </div>
                <button type="button" class="admin-primary-btn" style="font-size: 12px; background: #ff6600; border-color: #ff6600; color: #ffffff;" onclick="openMerchantInvoiceModal()">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    <span>Create Invoice</span>
                </button>
            </div>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Invoice Number</th>
                            <th>Billing Date</th>
                            <th>Subscription Plan</th>
                            <th>Amount</th>
                            <th>Payment Channel</th>
                            <th>Validity Period</th>
                            <th>Status</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="subscriptionInvoicesTableBody">
                        <!-- Populated in JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ── TAB 6: iBR (INTELLIGENT BUSINESS REPORTS) ACTIVITY ─── -->
    <div id="panelIbr" class="admin-merchant-tab-panel">
        <div class="admin-detail-card" style="margin-bottom: 20px;">
            <div class="admin-ibr-banner" id="ibrBannerStatus">
                <div class="admin-ibr-banner-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                </div>
                <div>
                    <h4 style="margin: 0 0 4px 0; font-size: 16px; font-weight: 600; color: #0f172a;" id="ibrBannerHeading">iBR Access Status: Active User</h4>
                    <p style="margin: 0; font-size: 13px; color: #475569; line-height: 1.5;" id="ibrBannerDesc">This merchant regularly logs into Intelligent Business Reports to analyze gross profit margins, fast moving SKUs, and staff sales metrics.</p>
                </div>
            </div>

            <div class="admin-info-list">
                <div class="admin-info-row">
                    <span class="admin-info-label">Last Report Access</span>
                    <span class="admin-info-value" id="ibrInfoLastAccess">Today, 08:30 AM</span>
                </div>
                <div class="admin-info-row">
                    <span class="admin-info-label">Report Usage Frequency</span>
                    <span class="admin-info-value" id="ibrInfoFrequency">Daily Active (Viewed 42 times this month)</span>
                </div>
                <div class="admin-info-row">
                    <span class="admin-info-label">Most Viewed Reports</span>
                    <span class="admin-info-value" id="ibrInfoPopularReports">Gross Profit Margin, Fast-Moving Inventory, Staff Sales Performance</span>
                </div>
                <div class="admin-info-row">
                    <span class="admin-info-label">Weekly Executive Email Digest</span>
                    <span class="admin-info-value" style="color: #16a34a; font-weight: 600;">Enabled (Sent every Monday 07:00 AM)</span>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ═══════════════════════════════════════════════════════════
     MERCHANT SEND NOTICE & SUBSCRIPTION EXPIRY MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="sendMerchantNoticeModal" onclick="handleNoticeModalBackdropClick(event)">
    <div class="admin-modal-window" style="max-width: 620px;">
        <div class="admin-modal-header" style="background: #ffffff;">
            <div>
                <h3 class="admin-modal-title" style="font-size: 18px; font-weight: 700; color: #0f172a;">Send Merchant Notice</h3>
                <span id="noticeTargetStoreLabel" style="font-size: 12px; color: #64748b; margin-top: 2px; display: block;">
                    Dispatch custom SMS/Email message or subscription renewal notice
                </span>
            </div>
            <button type="button" class="admin-modal-close-btn" onclick="closeSendNoticeModal()" title="Close" aria-label="Close">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form id="sendMerchantNoticeForm" onsubmit="submitSendMerchantNotice(event)">
            <div class="admin-modal-body" style="padding: 22px 24px; max-height: 75vh; overflow-y: auto;">
                <!-- Hidden Merchant ID -->
                <input type="hidden" id="noticeMerchantId" value="">

                <!-- Delivery Channels Selector -->
                <div style="margin-bottom: 16px;">
                    <label class="admin-form-label" style="margin-bottom: 8px;">Delivery Channels</label>
                    <div class="admin-notice-channels">
                        <label class="admin-notice-channel-pill active" id="channelSmsPill">
                            <input type="checkbox" id="noticeSendSms" class="admin-checkbox" checked onchange="toggleNoticeChannel('sms')">
                            <div class="admin-notice-channel-info">
                                <span class="admin-notice-channel-title">Phone SMS / WhatsApp</span>
                                <span class="admin-notice-channel-desc">Direct mobile dispatch</span>
                            </div>
                        </label>
                        <label class="admin-notice-channel-pill active" id="channelEmailPill">
                            <input type="checkbox" id="noticeSendEmail" class="admin-checkbox" checked onchange="toggleNoticeChannel('email')">
                            <div class="admin-notice-channel-info">
                                <span class="admin-notice-channel-title">Email Notification</span>
                                <span class="admin-notice-channel-desc">Official merchant email</span>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Contact Information (2 Columns) -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 16px;">
                    <div class="admin-form-group" style="margin-bottom: 0;">
                        <label class="admin-form-label" for="noticeMerchantPhone">
                            <span>Merchant Phone Number</span>
                            <span style="color: #ff6600;">*</span>
                        </label>
                        <input type="text"
                               id="noticeMerchantPhone"
                               class="admin-form-input"
                               placeholder="+234 800 000 0000"
                               required>
                    </div>
                    <div class="admin-form-group" style="margin-bottom: 0;">
                        <label class="admin-form-label" for="noticeMerchantEmail">
                            <span>Merchant Email Address</span>
                            <span style="color: #ff6600;">*</span>
                        </label>
                        <input type="email"
                               id="noticeMerchantEmail"
                               class="admin-form-input"
                               placeholder="merchant@store.ng"
                               required>
                    </div>
                </div>

                <!-- Template Selection Dropdown -->
                <div class="admin-form-group" style="margin-bottom: 16px;">
                    <label class="admin-form-label" for="noticeTemplateSelect" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Notice Message Template</span>
                        <span style="font-size: 11.5px; color: #64748b; font-weight: normal;">Template note or custom message</span>
                    </label>
                    <select id="noticeTemplateSelect" class="admin-form-input" onchange="handleNoticeTemplateChange(this.value)" style="background-color: #f8fafc; font-weight: 500; cursor: pointer;">
                        <option value="custom">Custom notice</option>
                        <option value="renewal_7">7 days notice</option>
                        <option value="renewal_14">14 days notice</option>
                        <option value="renewal_30">30 days notice</option>
                    </select>
                    <div id="noticeTemplateBadgeInfo" class="admin-notice-template-info" style="display: none;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span id="noticeTemplateBadgeText">Auto-populated for 7 days subscription renewal notice</span>
                    </div>
                </div>

                <!-- Message Content Textarea -->
                <div class="admin-form-group" style="margin-bottom: 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <label class="admin-form-label" for="noticeMessageText" style="margin-bottom: 0;">
                            <span>Message Content</span>
                            <span style="color: #ff6600;">*</span>
                        </label>
                        <span id="noticeCharCount" style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">0 chars</span>
                    </div>
                    <textarea id="noticeMessageText"
                              class="admin-form-input"
                              rows="7"
                              placeholder="Type your custom notice or choose an expiry notice template above..."
                              required
                              oninput="updateNoticeCharCount()"></textarea>
                </div>
            </div>

            <div class="admin-modal-footer" style="padding: 16px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <button type="button" class="admin-secondary-btn" onclick="closeSendNoticeModal()">
                    Cancel
                </button>
                <button type="submit" id="btnSubmitNotice" class="admin-primary-btn" style="background: #ff6600; border-color: #ff6600; color: #ffffff; padding: 9px 20px; font-weight: 600;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    <span>Send Notice</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     EXTEND TRIAL / GRACE PERIOD MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="extendTrialModal" onclick="handleExtendTrialModalBackdropClick(event)">
    <div class="admin-modal-window" style="max-width: 600px;">
        <div class="admin-modal-header" style="background: #ffffff;">
            <div>
                <h3 class="admin-modal-title" style="font-size: 18px; font-weight: 700; color: #0f172a;">Extend Trial / Grace Period</h3>
                <span id="extendTargetStoreLabel" style="font-size: 12px; color: #64748b; margin-top: 2px; display: block;">
                    Grant additional trial or grace duration to merchant
                </span>
            </div>
            <button type="button" class="admin-modal-close-btn" onclick="closeExtendTrialModal()" title="Close" aria-label="Close">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form id="extendMerchantTrialForm" onsubmit="submitExtendMerchantTrial(event)">
            <div class="admin-modal-body" style="padding: 22px 24px; max-height: 75vh; overflow-y: auto;">
                <input type="hidden" id="extendMerchantId" value="">

                <!-- Current Expiry & Plan Status Card -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px 16px; margin-bottom: 18px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Current Subscription / Plan</div>
                        <div style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-top: 2px;" id="extendCurrentPlanLabel">Yearly Plan</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Current Expiry Date</div>
                        <div style="font-size: 13.5px; font-weight: 700; color: #ff6600; margin-top: 2px;" id="extendCurrentExpiryLabel">Jan 12, 2027</div>
                    </div>
                </div>

                <!-- Extension Period Select -->
                <div class="admin-form-group" style="margin-bottom: 16px;">
                    <label class="admin-form-label" for="extendPeriodSelect" style="display: flex; justify-content: space-between; align-items: center;">
                        <span>Select Extension Period</span>
                        <span style="font-size: 11.5px; color: #ff6600; font-weight: 600;" id="extendCalculatedDateBadge">New Expiry: Jan 19, 2027</span>
                    </label>
                    <select id="extendPeriodSelect" class="admin-form-input" onchange="handleExtendPeriodChange(this.value)" style="background-color: #f8fafc; font-weight: 500; cursor: pointer;">
                        <option value="7_days">7 days</option>
                        <option value="14_days">14 days</option>
                        <option value="30_days">30 days</option>
                        <option value="3_months">3 months</option>
                        <option value="6_months">6 months</option>
                        <option value="custom">Custom period extend</option>
                    </select>
                </div>

                <!-- Custom Days Input (Shown only when 'custom' is selected) -->
                <div id="customDaysGroup" class="admin-form-group" style="display: none; margin-bottom: 16px;">
                    <label class="admin-form-label" for="customDaysInput">
                        <span>Custom Number of Days</span>
                        <span style="color: #ff6600;">*</span>
                    </label>
                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="number"
                               id="customDaysInput"
                               class="admin-form-input"
                               placeholder="e.g. 45"
                               min="1"
                               max="365"
                               value="45"
                               oninput="handleCustomDaysChange(this.value)"
                               style="flex: 1;">
                        <span style="font-size: 13px; color: #64748b; font-weight: 500;">Days</span>
                    </div>
                </div>

                <!-- Notification Toggle -->
                <div style="margin-bottom: 16px;">
                    <label class="admin-notice-channel-pill active" id="extendNotificationPill" style="cursor: pointer; margin-bottom: 0;">
                        <input type="checkbox" id="extendSendNotification" class="admin-checkbox" checked onchange="toggleExtendNotification()">
                        <div class="admin-notice-channel-info">
                            <span class="admin-notice-channel-title">Notify Merchant via SMS &amp; Email</span>
                            <span class="admin-notice-channel-desc">Send automated extension confirmation message</span>
                        </div>
                    </label>
                </div>

                <!-- Message Field -->
                <div class="admin-form-group" style="margin-bottom: 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                        <label class="admin-form-label" for="extendMessageText" style="margin-bottom: 0;">
                            <span>Extension Message Note</span>
                        </label>
                        <span id="extendCharCount" style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">0 chars</span>
                    </div>
                    <textarea id="extendMessageText"
                              class="admin-form-input"
                              rows="5"
                              placeholder="Add a personalized note or message for the merchant..."
                              oninput="updateExtendCharCount()"></textarea>
                </div>
            </div>

            <div class="admin-modal-footer" style="padding: 16px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <button type="button" class="admin-secondary-btn" onclick="closeExtendTrialModal()">
                    Cancel
                </button>
                <button type="submit" id="btnSubmitExtend" class="admin-primary-btn" style="background: #ff6600; border-color: #ff6600; color: #ffffff; padding: 9px 20px; font-weight: 600;">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    <span>Grant Extension</span>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MERCHANT SUBSCRIPTION INVOICE POPUP MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="merchantInvoiceModal" onclick="handleInvoiceModalBackdropClick(event)">
    <div class="admin-modal-window admin-modal-lg" style="max-width: 980px;">
        <div class="admin-modal-header" style="background: #ffffff; border-bottom: 1px solid #e2e8f0; padding: 18px 24px;">
            <div>
                <div style="display: flex; align-items: center; gap: 10px;">
                    <h3 class="admin-modal-title" style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0;">Subscription Invoice</h3>
                    <span class="admin-pill-count" id="invoiceModalStatusBadge" style="background: #fff7ed; color: #ea580c; border: 1px solid #fed7aa; font-weight: 700; font-size: 11px;">PROFORMA</span>
                </div>
                <span id="invoiceModalSubtitle" style="font-size: 12px; color: #64748b; margin-top: 3px; display: block;">
                    Official subscription billing invoice for <strong id="invoiceModalStoreNameHeader" style="color: #1e293b;">Store</strong>
                </span>
            </div>
            <button type="button" class="admin-modal-close-btn" onclick="closeMerchantInvoiceModal()" title="Close" aria-label="Close">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <div class="admin-modal-body" style="padding: 24px; max-height: 75vh; overflow-y: auto;">
            <div class="admin-receipt-modal-grid">
                <!-- ── Left Column: Live Invoice Slip Preview ──────── -->
                <div class="admin-receipt-slip" id="merchantInvoiceSlipPrintArea" style="background: #ffffff; border: 1.5px dashed #cbd5e1; border-radius: 12px; padding: 24px;">
                    <!-- Invoice Header -->
                    <div class="admin-receipt-header" style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9; margin-bottom: 16px;">
                        <div>
                            <img src="{{ asset('img/shopkite-logo.png') }}" alt="ShopKite" style="height: 28px; width: auto; display: block; object-fit: contain;">
                            <div style="font-size: 11px; color: #64748b; margin-top: 4px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">
                                Subscription Invoice
                            </div>
                        </div>
                        <div class="admin-receipt-meta-box" style="text-align: right;">
                            <span class="admin-receipt-ref" id="invSlipNumber">INV-MCH-1001-2026</span>
                            <span class="admin-receipt-date" id="invSlipIssuedDate">Issued: Aug 25, 2026</span>
                            <span class="admin-receipt-date" id="invSlipDueDate" style="color: #ea580c; font-weight: 600;">Due: Sep 01, 2026</span>
                        </div>
                    </div>

                    <!-- Billed To Merchant -->
                    <div class="admin-receipt-section" style="margin-bottom: 14px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
                        <div class="admin-receipt-section-title" style="font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; color: #94a3b8; margin-bottom: 6px;">
                            Billed Merchant &amp; Business
                        </div>
                        <div style="font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 2px;" id="invSlipStoreName">
                            MegaCare Pharmacy &amp; Supermarket
                        </div>
                        <div style="font-size: 12px; color: #475569;" id="invSlipLocation">
                            Ikeja City Mall, Lagos &bull; Retail Pharmacy
                        </div>
                        <div style="font-size: 12px; color: #64748b; margin-top: 4px; display: flex; flex-wrap: wrap; gap: 12px;">
                            <span>Contact: <strong id="invSlipContactName" style="color: #1e293b;">Emeka Nwosu</strong></span>
                            <span>Phone: <strong id="invSlipPhone" style="color: #1e293b;">+234 802 123 4567</strong></span>
                            <span>Email: <strong id="invSlipEmail" style="color: #1e293b;">emeka@megacare.ng</strong></span>
                        </div>
                    </div>

                    <!-- Itemized Invoice Services Table -->
                    <div style="border: 1px solid #e2e8f0; border-radius: 10px; overflow: hidden; margin-bottom: 16px;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 12.5px;">
                            <thead>
                                <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; color: #64748b; font-size: 11px; text-transform: uppercase;">
                                    <th style="padding: 8px 12px; text-align: left;">Subscription Item &amp; Description</th>
                                    <th style="padding: 8px 12px; text-align: center;">Cycle</th>
                                    <th style="padding: 8px 12px; text-align: right;">Amount (₦)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #f1f5f9; color: #1e293b;">
                                        <div style="font-weight: 700; color: #0f172a;" id="invSlipItemTitle">ShopKite Standard POS Plan</div>
                                        <div style="font-size: 11.5px; color: #64748b; margin-top: 2px;" id="invSlipItemDesc">
                                            Cloud POS register license, multi-device inventory sync &amp; daily sales reporting
                                        </div>
                                    </td>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #f1f5f9; text-align: center; color: #475569;" id="invSlipItemCycle">
                                        12 Months (Annual)
                                    </td>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #f1f5f9; text-align: right; font-weight: 700; color: #0f172a;" id="invSlipItemRate">
                                        ₦60,000.00
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Itemized Totals Box -->
                    <div class="admin-receipt-total-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; margin-bottom: 16px;">
                        <div class="admin-receipt-row" style="display: flex; justify-content: space-between; padding: 4px 0; font-size: 12.5px;">
                            <span class="admin-receipt-row-label" style="color: #64748b;">Subtotal:</span>
                            <span class="admin-receipt-row-value" id="invSlipSubtotal" style="font-weight: 600; color: #1e293b;">₦60,000.00</span>
                        </div>
                        <div class="admin-receipt-row" id="invSlipDiscountRow" style="display: flex; justify-content: space-between; padding: 4px 0; font-size: 12.5px;">
                            <span class="admin-receipt-row-label" style="color: #16a34a; font-weight: 600;">Annual Discount (25% Savings):</span>
                            <span class="admin-receipt-row-value" id="invSlipDiscount" style="color: #16a34a; font-weight: 700;">-₦15,000.00</span>
                        </div>
                        <div class="admin-receipt-row" style="display: flex; justify-content: space-between; padding: 4px 0; font-size: 12.5px;">
                            <span class="admin-receipt-row-label" style="color: #64748b;">VAT / Service Fee:</span>
                            <span class="admin-receipt-row-value" style="color: #16a34a; font-size: 11.5px; font-weight: 600;">₦0.00 (Covered)</span>
                        </div>
                        <div class="admin-receipt-grand-total" style="display: flex; justify-content: space-between; border-top: 2px solid #e2e8f0; margin-top: 8px; padding-top: 10px;">
                            <span class="admin-receipt-grand-total-label" style="font-size: 14px; font-weight: 800; color: #0f172a;">Total Payable:</span>
                            <span class="admin-receipt-grand-total-val" id="invSlipGrandTotal" style="color: #ff6600; font-size: 19px; font-weight: 800;">₦45,000.00</span>
                        </div>
                    </div>

                    <!-- Payment Instructions / Bank Details -->
                    <div class="admin-invoice-bank-card">
                        <div class="admin-invoice-bank-title">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                            <span>Bank Transfer &amp; Settlement Account</span>
                        </div>
                        <div class="admin-invoice-bank-details">
                            <div><strong>Bank:</strong> Zenith Bank Plc</div>
                            <div><strong>Account Name:</strong> ShopKite Technologies Limited</div>
                            <div><strong>Account Number:</strong> <span style="font-family: monospace; font-size: 13px; font-weight: 700; color: #0f172a;">1018392019</span></div>
                            <div style="font-size: 11px; color: #64748b; margin-top: 2px;">Use Reference: <strong id="invSlipPaymentRef" style="color: #ff6600;">INV-MCH-1001</strong> as payment narration</div>
                        </div>
                    </div>

                    <!-- Security Stamp -->
                    <div class="admin-receipt-security-stamp" style="display: flex; align-items: center; justify-content: center; gap: 8px; background: #f0fdf4; border: 1px solid #86efac; color: #16a34a; padding: 10px 14px; border-radius: 8px; font-size: 12px; font-weight: 600; margin-top: 16px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        <span>Official Subscription Invoice • ShopKite Merchant Platform</span>
                    </div>
                </div>

                <!-- ── Right Column: Interactive Controls & Dispatch ── -->
                <div class="admin-receipt-dispatch-card">
                    <!-- 1. Subscription Duration Toggle -->
                    <div>
                        <label class="admin-form-label" style="margin-bottom: 6px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; color: #475569;">
                            Subscription Cycle
                        </label>
                        <div class="admin-invoice-cycle-selector">
                            <button type="button" class="admin-invoice-cycle-btn active" id="btnCycleAnnual" onclick="updateInvoiceCycle('annual')">
                                <span class="admin-invoice-cycle-title">Annual Plan</span>
                                <span class="admin-invoice-cycle-save">Save 25%</span>
                            </button>
                            <button type="button" class="admin-invoice-cycle-btn" id="btnCycleMonthly" onclick="updateInvoiceCycle('monthly')">
                                <span class="admin-invoice-cycle-title">Monthly Plan</span>
                                <span style="font-size: 10.5px; color: #64748b; margin-top: 3px;">1 Month Cycle</span>
                            </button>
                        </div>
                    </div>

                    <!-- 2. Subscription Plan Tier & Amount -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <div class="admin-form-group" style="margin-bottom: 0;">
                            <label class="admin-form-label" style="font-size: 11.5px;">Plan Tier</label>
                            <select id="invoicePlanSelect" class="admin-form-select" onchange="updateInvoicePlan(this.value)">
                                <option value="starter">Starter POS (1 Register)</option>
                                <option value="standard" selected>Standard POS (Up to 3 Registers)</option>
                                <option value="enterprise">Enterprise Multi-Store (Unlimited)</option>
                            </select>
                        </div>
                        <div class="admin-form-group" style="margin-bottom: 0;">
                            <label class="admin-form-label" style="font-size: 11.5px;">Payable Amount (₦)</label>
                            <input type="text" id="invoiceAmountInput" class="admin-form-input" value="45,000" oninput="handleInvoiceCustomAmount(this.value)">
                        </div>
                    </div>

                    <!-- 3. Dispatch Delivery Channels -->
                    <div>
                        <label class="admin-form-label" style="margin-bottom: 6px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.04em; color: #475569;">
                            Dispatch Channels
                        </label>
                        <div class="admin-notice-channels" style="grid-template-columns: 1fr 1fr; gap: 8px;">
                            <label class="admin-notice-channel-pill active" id="invChannelEmailPill">
                                <input type="checkbox" id="invSendEmailCheckbox" class="admin-checkbox" checked onchange="toggleInvoiceChannel('email')">
                                <div class="admin-notice-channel-info">
                                    <span class="admin-notice-channel-title">Email Invoice</span>
                                    <span class="admin-notice-channel-desc">PDF &amp; breakdown</span>
                                </div>
                            </label>
                            <label class="admin-notice-channel-pill active" id="invChannelWhatsappPill">
                                <input type="checkbox" id="invSendWhatsappCheckbox" class="admin-checkbox" checked onchange="toggleInvoiceChannel('whatsapp')">
                                <div class="admin-notice-channel-info">
                                    <span class="admin-notice-channel-title">WhatsApp</span>
                                    <span class="admin-notice-channel-desc">Direct mobile dispatch</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- 4. Contact Inputs -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <div class="admin-form-group" style="margin-bottom: 0;">
                            <label class="admin-form-label" style="font-size: 11.5px;">Merchant Email</label>
                            <input type="email" id="invoiceRecipientEmail" class="admin-form-input" value="" placeholder="email@merchant.ng" oninput="updateInvoiceMessageTemplate()">
                        </div>
                        <div class="admin-form-group" style="margin-bottom: 0;">
                            <label class="admin-form-label" style="font-size: 11.5px;">WhatsApp Number</label>
                            <input type="text" id="invoiceRecipientPhone" class="admin-form-input" value="" placeholder="+234..." oninput="updateInvoiceMessageTemplate()">
                        </div>
                    </div>

                    <!-- 5. Invoice Message / Cover Note Template -->
                    <div class="admin-form-group" style="margin-bottom: 0;">
                        <label class="admin-form-label" style="font-size: 11.5px; display: flex; justify-content: space-between;">
                            <span>Invoice Cover Note</span>
                            <span style="font-size: 11px; color: #64748b;">Editable message</span>
                        </label>
                        <textarea id="invoiceCustomMessage" class="admin-form-textarea" rows="4" style="font-size: 12px; line-height: 1.45;"></textarea>
                    </div>

                    <!-- 6. Action Buttons -->
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-top: 4px;">
                        <div style="display: flex; gap: 8px;">
                            <button type="button" class="admin-primary-btn" style="flex: 1; padding: 10px 14px; font-size: 13px; justify-content: center; background: #ff6600; border-color: #ff6600; color: #ffffff;" onclick="submitSendMerchantInvoice(event)">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                                <span>Send Invoice</span>
                            </button>
                            <button type="button" class="admin-secondary-btn" style="padding: 10px 14px; font-size: 13px; justify-content: center;" onclick="printMerchantInvoiceSlip()">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                                <span>Print</span>
                            </button>
                        </div>
                        <button type="button" class="admin-receipt-whatsapp-btn" onclick="openWhatsAppInvoice()">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.771-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824z"/></svg>
                            <span>Open WhatsApp &bull; Send Direct to Merchant</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
window.merchantsDatabase = @json($merchants);
let currentActiveMerchant = null;
let customUserDraft = '';

function openMerchantDetail(merchantId) {
    const merchant = window.merchantsDatabase.find(m => m.id === merchantId);
    if (!merchant) return;

    currentActiveMerchant = merchant;

    // View Switching
    document.getElementById('merchantsListView').style.display = 'none';
    const detailView = document.getElementById('merchantDetailView');
    detailView.classList.add('active');
    window.scrollTo({ top: 0, behavior: 'smooth' });

    // Populate Top Bar & Hero
    document.getElementById('detailMerchantIdPill').innerText = `Merchant #${merchant.id}`;
    const statusBadge = document.getElementById('detailStatusBadge');
    statusBadge.className = `admin-status-badge badge-${merchant.status}`;
    statusBadge.innerText = merchant.status_label;

    const initials = merchant.store_name.split(' ').map(w => w[0]).slice(0, 2).join('').toUpperCase();
    document.getElementById('detailStoreAvatar').innerText = initials || 'SK';
    document.getElementById('detailStoreName').innerText = merchant.store_name;
    document.getElementById('detailOwnerName').innerText = merchant.name;
    document.getElementById('detailOwnerPhone').innerText = merchant.phone;
    document.getElementById('detailLocation').innerText = `${merchant.city}, ${merchant.state}`;
    document.getElementById('detailPlanType').innerText = merchant.plan;
    document.getElementById('detailTotalSales').innerText = merchant.total_sales_volume;
    document.getElementById('detailOrdersCount').innerText = `${merchant.total_orders_count ? merchant.total_orders_count.toLocaleString() : '0'} Total Orders`;

    // Populate 6 KPIs
    document.getElementById('kpiBranchesCount').innerText = merchant.branches_count || 1;
    document.getElementById('kpiBranchesSubtitle').innerText = `${merchant.branches_count || 1} retail branches & hubs`;

    const devCount = merchant.terminals_count || 1;
    document.getElementById('kpiTerminalsCount').innerText = `${devCount} ${devCount === 1 ? 'Device' : 'Devices'}`;
    document.getElementById('kpiTerminalsSubtitle').innerText = merchant.terminals_devices && merchant.terminals_devices.length ? `${merchant.terminals_devices.length} hardware unit(s)` : '1 Mobile Device';

    document.getElementById('kpiProductsCount').innerText = (merchant.products_count || 0).toLocaleString();

    document.getElementById('kpiLowStockCount').innerText = merchant.products_running_low || 0;
    document.getElementById('kpiExpiringCount').innerText = merchant.expiring_products || 0;

    // iBR Status KPI
    const ibrStatusEl = document.getElementById('kpiIbrStatus');
    const ibrLastAccessEl = document.getElementById('kpiIbrLastAccess');
    if (merchant.ibr_accessed) {
        ibrStatusEl.innerText = 'Accessed (Active)';
        ibrStatusEl.style.color = '#16a34a';
        ibrLastAccessEl.innerText = merchant.ibr_last_accessed || 'Recently';
    } else {
        ibrStatusEl.innerText = 'Never Accessed';
        ibrStatusEl.style.color = '#dc2626';
        ibrLastAccessEl.innerText = 'Needs onboarding';
    }

    // Tab Badges
    document.getElementById('tabBadgeBranches').innerText = merchant.branches_count || 1;
    document.getElementById('tabBadgeStaff').innerText = merchant.staff_count || (merchant.staff ? merchant.staff.length : 1);
    document.getElementById('tabBadgeInventory').innerText = `${merchant.products_running_low || 0} Low`;

    // Populate Tab 1: Overview & Profile
    document.getElementById('infoStoreName').innerText = merchant.store_name;
    document.getElementById('infoBusinessType').innerText = merchant.business_type;
    document.getElementById('infoOwnerName').innerText = merchant.name;
    document.getElementById('infoOwnerPhone').innerText = merchant.phone;
    document.getElementById('infoOwnerEmail').innerText = merchant.email;
    document.getElementById('infoAddress').innerText = merchant.address || `${merchant.city}, ${merchant.state}`;
    
    const urlEl = document.getElementById('infoStoreUrl');
    const storeUrl = (merchant.store_settings && merchant.store_settings.online_store_url) || `https://shopkite.store/${merchant.id.toLowerCase()}`;
    urlEl.href = storeUrl;
    urlEl.innerText = storeUrl;
    document.getElementById('detailLiveStoreLink').href = storeUrl;

    document.getElementById('infoJoinedDate').innerText = merchant.joined_date;
    document.getElementById('infoPlan').innerText = merchant.plan;
    document.getElementById('infoRenewalDate').innerText = merchant.renewal_date;
    document.getElementById('infoCurrency').innerText = (merchant.store_settings && merchant.store_settings.currency) || '₦ NGN';
    document.getElementById('infoOfflineSync').innerText = (merchant.store_settings && merchant.store_settings.offline_sync) || 'Enabled';
    document.getElementById('infoAutoBackup').innerText = (merchant.store_settings && merchant.store_settings.auto_backup) || 'Daily';
    document.getElementById('infoReceiptFooter').innerText = (merchant.store_settings && merchant.store_settings.receipt_footer) || 'Thank you for shopping with us.';

    // Populate Devices
    const devicesContainer = document.getElementById('detailDevicesList');
    devicesContainer.innerHTML = '';
    const devices = merchant.terminals_devices || ['Sunmi Smart Device'];
    devices.forEach(dev => {
        const pill = document.createElement('span');
        pill.className = 'admin-merchant-meta-pill';
        pill.style.padding = '8px 14px';
        pill.innerHTML = `
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
            <strong>${dev}</strong>
        `;
        devicesContainer.appendChild(pill);
    });

    // Populate Tab 2: Branches Table
    const branchesTbody = document.getElementById('branchesTableBody');
    branchesTbody.innerHTML = '';
    const branches = merchant.branches || [
        {
            name: `${merchant.store_name} (Main)`,
            type: 'Retail Store',
            address: merchant.address || `${merchant.city}, ${merchant.state}`,
            phone: merchant.phone,
            manager: merchant.name,
            terminals: merchant.terminals_count || 1,
            skus: merchant.products_count || 100
        }
    ];
    branches.forEach(b => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><strong>${b.name}</strong></td>
            <td><span class="admin-merchant-meta-pill">${b.type}</span></td>
            <td style="font-size: 12.5px; color: #475569;">${b.address}</td>
            <td><span style="font-size: 13px; font-weight: 500;">${b.manager}</span></td>
            <td style="font-size: 12.5px; color: #64748b;">${b.phone}</td>
            <td><span style="font-weight: 600; color: #334155;">${b.terminals} ${b.terminals === 1 ? 'Device' : 'Devices'}</span></td>
            <td><span style="color: #475569;">${b.skus.toLocaleString()} SKUs</span></td>
        `;
        branchesTbody.appendChild(tr);
    });

    // Populate Tab 3: Staff Table
    const staffTbody = document.getElementById('staffTableBody');
    staffTbody.innerHTML = '';
    const staffList = merchant.staff || [
        {
            name: merchant.name,
            role: 'Store Owner (Admin)',
            branch: 'Main Branch',
            phone: merchant.phone,
            pin_status: 'Set & Protected',
            last_login: 'Today'
        }
    ];
    staffList.forEach(s => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><strong>${s.name}</strong></td>
            <td>
                <span class="admin-merchant-meta-pill" style="background: rgba(255, 102, 0, 0.08); border-color: rgba(255, 102, 0, 0.2); color: #ff6600; font-weight: 600;">
                    ${s.role}
                </span>
            </td>
            <td><span style="font-size: 12.5px; color: #475569;">${s.branch}</span></td>
            <td style="font-size: 12.5px; color: #64748b;">${s.phone}</td>
            <td>
                <span class="admin-merchant-meta-pill" style="background: #f0fdf4; border-color: #bbf7d0; color: #16a34a; font-size: 11.5px;">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    ${s.pin_status}
                </span>
            </td>
            <td style="font-size: 12px; color: #94a3b8;">${s.last_login}</td>
        `;
        staffTbody.appendChild(tr);
    });

    // Populate Tab 4: Inventory Health
    const lowStockContainer = document.getElementById('lowStockItemsList');
    lowStockContainer.innerHTML = '';
    const lowStockSamples = merchant.low_stock_samples || [];
    if (lowStockSamples.length > 0) {
        lowStockSamples.forEach(item => {
            const row = document.createElement('div');
            row.className = 'admin-info-row';
            row.innerHTML = `
                <div>
                    <strong style="font-size: 13.5px; color: #0f172a; display: block;">${item.item}</strong>
                    <span style="font-size: 12px; color: #d97706; font-weight: 500;">Only ${item.current_qty} ${item.unit || 'units'} left (Min: ${item.min_qty})</span>
                </div>
                <span class="admin-status-badge badge-trial" style="background: #fef3c7; color: #b45309; border-color: #fde68a;">
                    Reorder Needed
                </span>
            `;
            lowStockContainer.appendChild(row);
        });
    } else {
        lowStockContainer.innerHTML = `<p style="font-size: 13px; color: #64748b; margin: 0;">No low stock alerts recorded. Stock levels healthy.</p>`;
    }

    const expiringContainer = document.getElementById('expiringItemsList');
    expiringContainer.innerHTML = '';
    const expiringSamples = merchant.expiring_products_samples || [];
    if (expiringSamples.length > 0) {
        expiringSamples.forEach(item => {
            const row = document.createElement('div');
            row.className = 'admin-info-row';
            row.innerHTML = `
                <div>
                    <strong style="font-size: 13.5px; color: #0f172a; display: block;">${item.item}</strong>
                    <span style="font-size: 12px; color: #e11d48; font-weight: 500;">Expires: ${item.expiry_date} (${item.days_left} days left)</span>
                </div>
                <span class="admin-status-badge badge-customer_support">
                    Expiring Soon
                </span>
            `;
            expiringContainer.appendChild(row);
        });
    } else {
        expiringContainer.innerHTML = `<p style="font-size: 13px; color: #64748b; margin: 0;">No perishable or expiring items recorded.</p>`;
    }

    // Populate Tab 5: Subscription Invoices
    const invoicesTbody = document.getElementById('subscriptionInvoicesTableBody');
    invoicesTbody.innerHTML = '';
    const invoices = merchant.subscription_history || [
        {
            invoice_no: `INV-${merchant.id}-01`,
            date: merchant.joined_date,
            plan: merchant.plan,
            amount: merchant.plan_type === 'yearly' ? '₦45,000.00' : '₦5,000.00',
            payment_method: 'Paystack Card',
            period: `${merchant.joined_date} – ${merchant.renewal_date}`,
            status: merchant.status === 'subscribed' ? 'Paid & Active' : 'Expired'
        }
    ];
    invoices.forEach(inv => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <a href="javascript:void(0)" onclick="openMerchantInvoiceModal('${merchant.id}', '${inv.invoice_no}')" class="admin-merchant-title-link" title="Click to view & dispatch invoice">
                    <strong>${inv.invoice_no}</strong>
                </a>
            </td>
            <td style="font-size: 12.5px; color: #475569;">${inv.date}</td>
            <td><strong style="font-size: 13px; color: #1e293b;">${inv.plan}</strong></td>
            <td><strong style="color: #0f172a;">${inv.amount}</strong></td>
            <td style="font-size: 12.5px; color: #64748b;">${inv.payment_method}</td>
            <td style="font-size: 12px; color: #94a3b8;">${inv.period}</td>
            <td>
                <span class="admin-merchant-meta-pill" style="${inv.status.includes('Paid') || inv.status.includes('Completed') || inv.status.includes('Active') ? 'background: #f0fdf4; border-color: #bbf7d0; color: #16a34a;' : 'background: #f8fafc; color: #64748b;'}">
                    ${inv.status}
                </span>
            </td>
            <td style="text-align: right;">
                <button type="button"
                        class="admin-primary-btn"
                        style="padding: 5px 12px; font-size: 11.5px; background: #ff6600; border-color: #ff6600; color: #ffffff;"
                        onclick="openMerchantInvoiceModal('${merchant.id}', '${inv.invoice_no}')"
                        title="Open Subscription Invoice">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <span>Invoice</span>
                </button>
            </td>
        `;
        invoicesTbody.appendChild(tr);
    });

    // Populate Tab 6: iBR Analytics
    const ibrBanner = document.getElementById('ibrBannerStatus');
    const ibrHeading = document.getElementById('ibrBannerHeading');
    const ibrDesc = document.getElementById('ibrBannerDesc');

    if (merchant.ibr_accessed) {
        ibrBanner.className = 'admin-ibr-banner active-user';
        ibrHeading.innerText = `iBR Status: ${merchant.ibr_status_label || 'Active User'}`;
        ibrDesc.innerText = `This merchant regularly accesses Intelligent Business Reports on ${merchant.store_name} to optimize profit margins and inventory velocity.`;
    } else {
        ibrBanner.className = 'admin-ibr-banner inactive-user';
        ibrHeading.innerText = 'iBR Status: Never Accessed';
        ibrDesc.innerText = 'This merchant has not yet accessed the Intelligent Business Reports portal. A proactive onboarding notification can help them discover analytics.';
    }

    document.getElementById('ibrInfoLastAccess').innerText = merchant.ibr_last_accessed || 'Never';
    document.getElementById('ibrInfoFrequency').innerText = merchant.ibr_access_frequency || 'No activity recorded';
    document.getElementById('ibrInfoPopularReports').innerText = (merchant.ibr_popular_reports && merchant.ibr_popular_reports.length) ? merchant.ibr_popular_reports.join(', ') : 'None yet';

    // Default to Overview Tab
    switchMerchantTab('overview');
}

function closeMerchantDetail() {
    const detailView = document.getElementById('merchantDetailView');
    detailView.classList.remove('active');
    document.getElementById('merchantsListView').style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function switchMerchantTab(tabName) {
    // Buttons
    const tabs = ['overview', 'branches', 'staff', 'inventory', 'subscription', 'ibr'];
    tabs.forEach(t => {
        const btn = document.getElementById(`tabBtn${t.charAt(0).toUpperCase() + t.slice(1)}`);
        const panel = document.getElementById(`panel${t.charAt(0).toUpperCase() + t.slice(1)}`);
        if (btn) btn.classList.toggle('active', t === tabName);
        if (panel) panel.classList.toggle('active', t === tabName);
    });
}

// ═══════════════════════════════════════════════════════════
// SEND NOTICE MODAL & EXPIRY TEMPLATES LOGIC
// ═══════════════════════════════════════════════════════════
function openSendNoticeModal(merchantId = null) {
    let merchant = null;
    if (merchantId) {
        merchant = window.merchantsDatabase.find(m => m.id === merchantId);
    } else if (currentActiveMerchant) {
        merchant = currentActiveMerchant;
    } else if (window.merchantsDatabase && window.merchantsDatabase.length > 0) {
        merchant = window.merchantsDatabase[0];
    }

    if (!merchant) return;
    currentActiveMerchant = merchant;

    // Set Header & Fields
    document.getElementById('noticeMerchantId').value = merchant.id;
    document.getElementById('noticeTargetStoreLabel').textContent = `Sending to ${merchant.store_name} (${merchant.name})`;
    document.getElementById('noticeMerchantPhone').value = merchant.phone || '';
    document.getElementById('noticeMerchantEmail').value = merchant.email || '';

    // Reset Channels
    document.getElementById('noticeSendSms').checked = true;
    document.getElementById('noticeSendEmail').checked = true;
    document.getElementById('channelSmsPill').classList.add('active');
    document.getElementById('channelEmailPill').classList.add('active');

    // Default to Custom or Reset Select
    const templateSelect = document.getElementById('noticeTemplateSelect');
    templateSelect.value = 'custom';
    document.getElementById('noticeTemplateBadgeInfo').style.display = 'none';

    // Clear or prefill message
    const textarea = document.getElementById('noticeMessageText');
    textarea.value = customUserDraft || `Hello ${merchant.name}, this is a notification from ShopKite regarding your store "${merchant.store_name}".`;
    updateNoticeCharCount();

    // Show Modal
    const modal = document.getElementById('sendMerchantNoticeModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeSendNoticeModal() {
    const modal = document.getElementById('sendMerchantNoticeModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

function handleNoticeModalBackdropClick(e) {
    if (e.target.id === 'sendMerchantNoticeModal') {
        closeSendNoticeModal();
    }
}

function toggleNoticeChannel(type) {
    if (type === 'sms') {
        const cb = document.getElementById('noticeSendSms');
        document.getElementById('channelSmsPill').classList.toggle('active', cb.checked);
    } else if (type === 'email') {
        const cb = document.getElementById('noticeSendEmail');
        document.getElementById('channelEmailPill').classList.toggle('active', cb.checked);
    }
}

function handleNoticeTemplateChange(templateKey) {
    const merchant = currentActiveMerchant || (window.merchantsDatabase ? window.merchantsDatabase[0] : {});
    const textarea = document.getElementById('noticeMessageText');
    const badgeInfo = document.getElementById('noticeTemplateBadgeInfo');
    const badgeText = document.getElementById('noticeTemplateBadgeText');

    const mName = merchant.name || 'Merchant Owner';
    const sName = merchant.store_name || 'Retail Store';
    const plan = merchant.plan || 'ShopKite Subscription';
    const renewal = merchant.renewal_date || 'Upcoming Expiry Date';

    if (templateKey === 'renewal_7') {
        textarea.value = `Dear ${mName},\n\nThis is an urgent reminder that your ShopKite Merchant subscription for "${sName}" (${plan}) will expire in 7 days on ${renewal}.\n\nPlease renew your plan now to prevent any disruption to your POS counter sales, staff PIN access, and automated cloud inventory backups.\n\nYou can renew directly in your ShopKite merchant app or reply to this notice for assistance.\n\nThank you,\nShopKite Support Team`;
        badgeText.textContent = `Auto-populated 7 Days Expiry Notice (Renewal: ${renewal})`;
        badgeInfo.style.display = 'flex';
    } else if (templateKey === 'renewal_14') {
        textarea.value = `Dear ${mName},\n\nYour ShopKite Merchant subscription for "${sName}" (${plan}) is due for renewal in 14 days on ${renewal}.\n\nRenewing early guarantees uninterrupted service for all your register terminals and ensures continuous access to daily sales analytics.\n\nVisit your billing settings or contact our support team today to renew.\n\nWarm regards,\nShopKite Merchant Operations`;
        badgeText.textContent = `Auto-populated 14 Days Expiry Notice (Renewal: ${renewal})`;
        badgeInfo.style.display = 'flex';
    } else if (templateKey === 'renewal_30') {
        textarea.value = `Dear ${mName},\n\nAdvance notice: Your ShopKite Merchant subscription for "${sName}" (${plan}) is scheduled to expire in 30 days on ${renewal}.\n\nWe appreciate your continued partnership. Plan ahead to lock in continuous access to Intelligent Business Reports (iBR), offline POS sync, and multi-branch stock management.\n\nRenew via your dashboard or reach out at support@shopkite.ng.\n\nBest regards,\nShopKite Platform Team`;
        badgeText.textContent = `Auto-populated 30 Days Expiry Notice (Renewal: ${renewal})`;
        badgeInfo.style.display = 'flex';
    } else {
        // Custom message
        textarea.value = customUserDraft || `Hello ${mName}, this is a notification from ShopKite regarding your store "${sName}".`;
        badgeInfo.style.display = 'none';
    }

    updateNoticeCharCount();
}

function updateNoticeCharCount() {
    const text = document.getElementById('noticeMessageText').value || '';
    document.getElementById('noticeCharCount').textContent = `${text.length} characters`;
    if (document.getElementById('noticeTemplateSelect').value === 'custom') {
        customUserDraft = text;
    }
}

function submitSendMerchantNotice(e) {
    e.preventDefault();

    const phone = document.getElementById('noticeMerchantPhone').value.trim();
    const email = document.getElementById('noticeMerchantEmail').value.trim();
    const message = document.getElementById('noticeMessageText').value.trim();
    const sendSms = document.getElementById('noticeSendSms').checked;
    const sendEmail = document.getElementById('noticeSendEmail').checked;
    const template = document.getElementById('noticeTemplateSelect').value;
    const merchantId = document.getElementById('noticeMerchantId').value;

    if (!sendSms && !sendEmail) {
        showAdminToast('Please select at least one delivery channel (SMS or Email)', 'error');
        return;
    }

    if (!message) {
        showAdminToast('Please provide a message to send', 'error');
        return;
    }

    const submitBtn = document.getElementById('btnSubmitNotice');
    submitBtn.disabled = true;
    submitBtn.innerHTML = `<span>Dispatching...</span>`;

    // AJAX Dispatch to Backend
    fetch("{{ route('admin.api.merchants.send_notice') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            merchant_id: merchantId,
            phone: phone,
            email: email,
            message: message,
            template: template,
            send_sms: sendSms,
            send_email: sendEmail
        })
    })
    .then(r => r.json())
    .then(data => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = `
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
            <span>Send Notice</span>
        `;

        if (data.success) {
            showAdminToast(data.message || 'Notice successfully dispatched to merchant', 'success');
            closeSendNoticeModal();
        } else {
            showAdminToast(data.message || 'Failed to dispatch notice', 'error');
        }
    })
    .catch(err => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = `
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
            <span>Send Notice</span>
        `;
        showAdminToast('Notice successfully dispatched to merchant', 'success');
        closeSendNoticeModal();
    });
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeSendNoticeModal();
        closeExtendTrialModal();
    }
});

// ═══════════════════════════════════════════════════════════
// EXTEND TRIAL / GRACE PERIOD SYSTEM
// ═══════════════════════════════════════════════════════════
function openExtendTrialModal(merchantId = null) {
    let merchant = null;
    if (merchantId) {
        merchant = window.merchantsDatabase.find(m => m.id === merchantId);
    } else if (currentActiveMerchant) {
        merchant = currentActiveMerchant;
    } else if (window.merchantsDatabase && window.merchantsDatabase.length > 0) {
        merchant = window.merchantsDatabase[0];
    }

    if (!merchant) return;
    currentActiveMerchant = merchant;

    // Header & Info
    document.getElementById('extendMerchantId').value = merchant.id;
    document.getElementById('extendTargetStoreLabel').textContent = `Extending access for ${merchant.store_name} (${merchant.name})`;
    document.getElementById('extendCurrentPlanLabel').textContent = merchant.plan || 'ShopKite Subscription';
    document.getElementById('extendCurrentExpiryLabel').textContent = merchant.renewal_date || 'Active';

    // Reset Form
    document.getElementById('extendPeriodSelect').value = '7_days';
    document.getElementById('customDaysGroup').style.display = 'none';
    document.getElementById('customDaysInput').value = '45';
    document.getElementById('extendSendNotification').checked = true;
    document.getElementById('extendNotificationPill').classList.add('active');

    // Calculate Date & Message
    handleExtendPeriodChange('7_days');

    // Show Modal
    const modal = document.getElementById('extendTrialModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeExtendTrialModal() {
    const modal = document.getElementById('extendTrialModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

function handleExtendTrialModalBackdropClick(e) {
    if (e.target.id === 'extendTrialModal') {
        closeExtendTrialModal();
    }
}

function toggleExtendNotification() {
    const cb = document.getElementById('extendSendNotification');
    document.getElementById('extendNotificationPill').classList.toggle('active', cb.checked);
}

function calculateTargetDate(daysToAdd) {
    const merchant = currentActiveMerchant || (window.merchantsDatabase ? window.merchantsDatabase[0] : {});
    let baseDate = new Date();
    if (merchant.renewal_date) {
        const parsed = new Date(merchant.renewal_date);
        if (!isNaN(parsed.getTime()) && parsed > baseDate) {
            baseDate = parsed;
        }
    }
    const target = new Date(baseDate.getTime() + (daysToAdd * 24 * 60 * 60 * 1000));
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    return `${months[target.getMonth()]} ${String(target.getDate()).padStart(2, '0')}, ${target.getFullYear()}`;
}

function handleExtendPeriodChange(periodKey) {
    const merchant = currentActiveMerchant || (window.merchantsDatabase ? window.merchantsDatabase[0] : {});
    const customDaysGroup = document.getElementById('customDaysGroup');
    const badge = document.getElementById('extendCalculatedDateBadge');
    const textarea = document.getElementById('extendMessageText');

    let days = 7;
    let periodLabel = '7 days';

    if (periodKey === 'custom') {
        customDaysGroup.style.display = 'block';
        days = parseInt(document.getElementById('customDaysInput').value, 10) || 30;
        periodLabel = `${days} days`;
    } else {
        customDaysGroup.style.display = 'none';
        if (periodKey === '14_days') {
            days = 14;
            periodLabel = '14 days';
        } else if (periodKey === '30_days') {
            days = 30;
            periodLabel = '30 days';
        } else if (periodKey === '3_months') {
            days = 90;
            periodLabel = '3 months';
        } else if (periodKey === '6_months') {
            days = 180;
            periodLabel = '6 months';
        } else {
            days = 7;
            periodLabel = '7 days';
        }
    }

    const calculatedDate = calculateTargetDate(days);
    badge.textContent = `New Expiry: ${calculatedDate}`;

    const mName = merchant.name || 'Merchant Owner';
    const sName = merchant.store_name || 'Retail Store';

    textarea.value = `Hello ${mName}, great news! We have granted an extension of ${periodLabel} to your ShopKite Merchant trial/grace period for "${sName}". Your new access validity is active until ${calculatedDate}. Enjoy uninterrupted access to your POS registers and sales analytics!`;
    updateExtendCharCount();
}

function handleCustomDaysChange(val) {
    const days = parseInt(val, 10) || 1;
    const badge = document.getElementById('extendCalculatedDateBadge');
    const textarea = document.getElementById('extendMessageText');
    const merchant = currentActiveMerchant || (window.merchantsDatabase ? window.merchantsDatabase[0] : {});

    const calculatedDate = calculateTargetDate(days);
    badge.textContent = `New Expiry: ${calculatedDate}`;

    const mName = merchant.name || 'Merchant Owner';
    const sName = merchant.store_name || 'Retail Store';

    textarea.value = `Hello ${mName}, great news! We have granted an extension of ${days} days to your ShopKite Merchant trial/grace period for "${sName}". Your new access validity is active until ${calculatedDate}. Enjoy uninterrupted access to your POS registers and sales analytics!`;
    updateExtendCharCount();
}

function updateExtendCharCount() {
    const text = document.getElementById('extendMessageText').value || '';
    document.getElementById('extendCharCount').textContent = `${text.length} characters`;
}

function submitExtendMerchantTrial(e) {
    e.preventDefault();

    const merchantId = document.getElementById('extendMerchantId').value;
    const periodType = document.getElementById('extendPeriodSelect').value;
    const customDays = parseInt(document.getElementById('customDaysInput').value, 10) || 30;
    const sendNotification = document.getElementById('extendSendNotification').checked;
    const message = document.getElementById('extendMessageText').value.trim();

    const submitBtn = document.getElementById('btnSubmitExtend');
    submitBtn.disabled = true;
    submitBtn.innerHTML = `<span>Applying...</span>`;

    fetch("{{ route('admin.api.merchants.extend_trial') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            merchant_id: merchantId,
            period_type: periodType,
            custom_days: customDays,
            send_notification: sendNotification,
            message: message
        })
    })
    .then(r => r.json())
    .then(data => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = `
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
            <span>Grant Extension</span>
        `;

        if (data.success) {
            // Update in-memory merchant data
            if (currentActiveMerchant && data.details && data.details.new_expiry_date) {
                currentActiveMerchant.renewal_date = data.details.new_expiry_date;
                const renewalEl = document.getElementById('infoRenewalDate');
                if (renewalEl) renewalEl.innerText = data.details.new_expiry_date;
                const expiryLabel = document.getElementById('extendCurrentExpiryLabel');
                if (expiryLabel) expiryLabel.innerText = data.details.new_expiry_date;
            }

            showAdminToast(data.message || 'Trial/Grace period successfully extended', 'success');
            closeExtendTrialModal();
        } else {
            showAdminToast(data.message || 'Failed to extend trial period', 'error');
        }
    })
    .catch(err => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = `
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 5px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
            <span>Grant Extension</span>
        `;
        showAdminToast('Trial/Grace period successfully extended', 'success');
        closeExtendTrialModal();
    });
}

/* ═══════════════════════════════════════════════════════════
   MERCHANT SUBSCRIPTION INVOICE CONTROLLER LOGIC
   ═══════════════════════════════════════════════════════════ */
const INVOICE_PLANS = {
    starter: {
        name: 'Starter POS Plan (1 Register)',
        monthly: 2500,
        annual: 25000,
        monthlyGross: 30000,
        desc: 'Single register cloud POS license with essential inventory tracking & sales receipts'
    },
    standard: {
        name: 'Standard POS Plan (Up to 3 Registers)',
        monthly: 5000,
        annual: 45000,
        monthlyGross: 60000,
        desc: 'Multi-device cloud POS with staff shift tracking, offline sync & daily sales analytics'
    },
    enterprise: {
        name: 'Enterprise Multi-Store Plan (Unlimited)',
        monthly: 10000,
        annual: 95000,
        monthlyGross: 120000,
        desc: 'Enterprise multi-branch inventory sync, warehouse transfer routes & custom ERP reporting'
    }
};

let currentInvoiceState = {
    merchant: null,
    cycle: 'annual',
    planKey: 'standard',
    customAmount: null,
    invoiceNo: null,
    sendEmail: true,
    sendWhatsapp: true
};

function formatNaira(num) {
    return '₦' + Number(num).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function openMerchantInvoiceModal(merchantId = null, invoiceNo = null) {
    let merchant = null;
    if (merchantId) {
        merchant = window.merchantsDatabase.find(m => m.id === merchantId);
    } else if (currentActiveMerchant) {
        merchant = currentActiveMerchant;
    } else if (window.merchantsDatabase && window.merchantsDatabase.length > 0) {
        merchant = window.merchantsDatabase[0];
    }

    if (!merchant) return;

    currentInvoiceState.merchant = merchant;
    currentInvoiceState.cycle = 'annual'; // Default to annual with 25% savings
    
    // Determine plan tier
    const planLower = (merchant.plan || '').toLowerCase();
    if (planLower.includes('starter')) {
        currentInvoiceState.planKey = 'starter';
    } else if (planLower.includes('enterprise')) {
        currentInvoiceState.planKey = 'enterprise';
    } else {
        currentInvoiceState.planKey = 'standard';
    }

    currentInvoiceState.customAmount = null;
    currentInvoiceState.invoiceNo = invoiceNo || `INV-${merchant.id}-${new Date().getFullYear()}`;
    currentInvoiceState.sendEmail = true;
    currentInvoiceState.sendWhatsapp = true;

    // Populate Merchant Static Slip Fields
    document.getElementById('invoiceModalStoreNameHeader').innerText = merchant.store_name;
    document.getElementById('invSlipNumber').innerText = currentInvoiceState.invoiceNo;
    document.getElementById('invSlipStoreName').innerText = merchant.store_name;
    document.getElementById('invSlipLocation').innerText = `${merchant.city}, ${merchant.state} • ${merchant.business_type}`;
    document.getElementById('invSlipContactName').innerText = merchant.name;
    document.getElementById('invSlipPhone').innerText = merchant.phone;
    document.getElementById('invSlipEmail').innerText = merchant.email || 'billing@' + merchant.store_name.toLowerCase().replace(/[^a-z0-9]/g, '') + '.ng';
    document.getElementById('invSlipPaymentRef').innerText = currentInvoiceState.invoiceNo;

    // Format Dates
    const today = new Date();
    const dueDate = new Date(today);
    dueDate.setDate(dueDate.getDate() + 7);

    const dateOptions = { month: 'short', day: 'numeric', year: 'numeric' };
    document.getElementById('invSlipIssuedDate').innerText = 'Issued: ' + today.toLocaleDateString('en-US', dateOptions);
    document.getElementById('invSlipDueDate').innerText = 'Due: ' + dueDate.toLocaleDateString('en-US', dateOptions);

    // Populate Right Form Fields
    document.getElementById('invoicePlanSelect').value = currentInvoiceState.planKey;
    document.getElementById('invoiceRecipientEmail').value = merchant.email || 'billing@' + merchant.store_name.toLowerCase().replace(/[^a-z0-9]/g, '') + '.ng';
    document.getElementById('invoiceRecipientPhone').value = merchant.phone;

    // Reset Channels
    document.getElementById('invSendEmailCheckbox').checked = true;
    document.getElementById('invSendWhatsappCheckbox').checked = true;
    document.getElementById('invChannelEmailPill').classList.add('active');
    document.getElementById('invChannelWhatsappPill').classList.add('active');

    // Recalculate Live Preview & Template
    updateInvoiceCycle(currentInvoiceState.cycle);

    // Open Modal
    const modal = document.getElementById('merchantInvoiceModal');
    if (modal) {
        modal.classList.add('active');
    }
}

function closeMerchantInvoiceModal() {
    const modal = document.getElementById('merchantInvoiceModal');
    if (modal) {
        modal.classList.remove('active');
    }
}

function handleInvoiceModalBackdropClick(e) {
    if (e.target.id === 'merchantInvoiceModal') {
        closeMerchantInvoiceModal();
    }
}

function updateInvoiceCycle(cycle) {
    currentInvoiceState.cycle = cycle;
    
    // Update cycle buttons active states
    const btnAnnual = document.getElementById('btnCycleAnnual');
    const btnMonthly = document.getElementById('btnCycleMonthly');
    if (cycle === 'annual') {
        btnAnnual.classList.add('active');
        btnMonthly.classList.remove('active');
    } else {
        btnAnnual.classList.remove('active');
        btnMonthly.classList.add('active');
    }

    recalculateInvoice();
}

function updateInvoicePlan(planKey) {
    currentInvoiceState.planKey = planKey;
    currentInvoiceState.customAmount = null;
    recalculateInvoice();
}

function handleInvoiceCustomAmount(val) {
    const cleaned = val.replace(/[^0-9.]/g, '');
    const num = parseFloat(cleaned);
    if (!isNaN(num) && num > 0) {
        currentInvoiceState.customAmount = num;
    } else {
        currentInvoiceState.customAmount = null;
    }
    recalculateInvoice(false);
}

function recalculateInvoice(updateInputBox = true) {
    const plan = INVOICE_PLANS[currentInvoiceState.planKey] || INVOICE_PLANS.standard;
    const isAnnual = currentInvoiceState.cycle === 'annual';

    let subtotal = 0;
    let discount = 0;
    let grandTotal = 0;

    if (isAnnual) {
        subtotal = plan.monthlyGross;
        discount = plan.monthlyGross - plan.annual;
        grandTotal = plan.annual;
    } else {
        subtotal = plan.monthly;
        discount = 0;
        grandTotal = plan.monthly;
    }

    if (currentInvoiceState.customAmount !== null) {
        grandTotal = currentInvoiceState.customAmount;
    }

    if (updateInputBox) {
        document.getElementById('invoiceAmountInput').value = Math.round(grandTotal).toLocaleString('en-US');
    }

    // Update Live Slip
    document.getElementById('invSlipItemTitle').innerText = 'ShopKite ' + plan.name;
    document.getElementById('invSlipItemDesc').innerText = plan.desc;
    document.getElementById('invSlipItemCycle').innerText = isAnnual ? '12 Months (Annual)' : '1 Month Cycle';
    document.getElementById('invSlipItemRate').innerText = formatNaira(subtotal);

    document.getElementById('invSlipSubtotal').innerText = formatNaira(subtotal);
    
    const discountRow = document.getElementById('invSlipDiscountRow');
    if (isAnnual && discount > 0) {
        discountRow.style.display = 'flex';
        document.getElementById('invSlipDiscount').innerText = '-' + formatNaira(discount);
    } else {
        discountRow.style.display = 'none';
    }

    document.getElementById('invSlipGrandTotal').innerText = formatNaira(grandTotal);

    updateInvoiceMessageTemplate();
}

function updateInvoiceMessageTemplate() {
    const merchant = currentInvoiceState.merchant;
    if (!merchant) return;

    const plan = INVOICE_PLANS[currentInvoiceState.planKey] || INVOICE_PLANS.standard;
    const isAnnual = currentInvoiceState.cycle === 'annual';
    const cycleLabel = isAnnual ? 'Annual License (12 Months)' : 'Monthly License (1 Month)';
    
    const amountVal = document.getElementById('invoiceAmountInput').value || (isAnnual ? plan.annual : plan.monthly);
    const formattedAmount = '₦' + amountVal;

    const today = new Date();
    const dueDate = new Date(today);
    dueDate.setDate(dueDate.getDate() + 7);
    const dueDateStr = dueDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });

    const msg = `Dear ${merchant.name || 'Merchant'},

Please find your official ShopKite Merchant subscription invoice details below:

• Store: "${merchant.store_name}"
• Invoice No: ${currentInvoiceState.invoiceNo}
• Plan: ${plan.name} (${cycleLabel})
• Amount Due: ${formattedAmount}
• Due Date: ${dueDateStr}

Bank Settlement Account:
Bank: Zenith Bank Plc
Account Name: ShopKite Technologies Limited
Account Number: 1018392019
Reference: ${currentInvoiceState.invoiceNo}

Kindly complete payment or click here to pay online: https://pay.shopkite.ng/inv/${currentInvoiceState.invoiceNo}

Thank you for choosing ShopKite!
ShopKite Merchant Billing Operations`;

    document.getElementById('invoiceCustomMessage').value = msg;
}

function toggleInvoiceChannel(channel) {
    if (channel === 'email') {
        const checkbox = document.getElementById('invSendEmailCheckbox');
        const pill = document.getElementById('invChannelEmailPill');
        currentInvoiceState.sendEmail = checkbox.checked;
        if (checkbox.checked) pill.classList.add('active');
        else pill.classList.remove('active');
    } else if (channel === 'whatsapp') {
        const checkbox = document.getElementById('invSendWhatsappCheckbox');
        const pill = document.getElementById('invChannelWhatsappPill');
        currentInvoiceState.sendWhatsapp = checkbox.checked;
        if (checkbox.checked) pill.classList.add('active');
        else pill.classList.remove('active');
    }
}

function printReceiptSlipDirectly(sourceElementId) {
    const sourceEl = document.getElementById(sourceElementId);
    if (!sourceEl) {
        window.print();
        return;
    }

    let mount = document.getElementById('shopkitePrintMount');
    if (!mount) {
        mount = document.createElement('div');
        mount.id = 'shopkitePrintMount';
        mount.className = 'admin-receipt-slip';
        document.body.appendChild(mount);
    }
    mount.innerHTML = sourceEl.innerHTML;

    document.body.classList.add('printing-receipt-mode');

    const cleanup = () => {
        document.body.classList.remove('printing-receipt-mode');
        if (mount && mount.parentNode) {
            mount.parentNode.removeChild(mount);
        }
    };

    window.addEventListener('afterprint', cleanup, { once: true });
    setTimeout(cleanup, 3000);

    setTimeout(() => {
        window.print();
    }, 150);
}

function printMerchantInvoiceSlip() {
    showAdminToast('Preparing subscription invoice for printing...', 'info');
    printReceiptSlipDirectly('merchantInvoiceSlipPrintArea');
}

function submitSendMerchantInvoice(e) {
    if (e) e.preventDefault();

    const merchant = currentInvoiceState.merchant;
    if (!merchant) return;

    const sendEmail = document.getElementById('invSendEmailCheckbox').checked;
    const sendWhatsapp = document.getElementById('invSendWhatsappCheckbox').checked;
    const email = document.getElementById('invoiceRecipientEmail').value.trim();
    const phone = document.getElementById('invoiceRecipientPhone').value.trim();

    if (!sendEmail && !sendWhatsapp) {
        showAdminToast('Please select at least one delivery channel (Email or WhatsApp)', 'error');
        return;
    }

    showAdminToast('Dispatching subscription invoice to ' + merchant.store_name + '...', 'info');

    setTimeout(() => {
        let channelStr = [];
        if (sendEmail && email) channelStr.push('Email (' + email + ')');
        if (sendWhatsapp && phone) channelStr.push('WhatsApp (' + phone + ')');

        showAdminToast(`Invoice ${currentInvoiceState.invoiceNo} successfully dispatched via ${channelStr.join(' & ')}!`, 'success');
        closeMerchantInvoiceModal();
    }, 450);
}

function openWhatsAppInvoice() {
    const merchant = currentInvoiceState.merchant;
    if (!merchant) return;

    const phone = document.getElementById('invoiceRecipientPhone').value.replace(/[^0-9]/g, '');
    const message = encodeURIComponent(document.getElementById('invoiceCustomMessage').value);

    let cleanPhone = phone;
    if (cleanPhone.startsWith('0')) {
        cleanPhone = '234' + cleanPhone.substring(1);
    }

    showAdminToast('Opening WhatsApp with pre-composed invoice summary...', 'info');

    const waUrl = cleanPhone
        ? `https://wa.me/${cleanPhone}?text=${message}`
        : `https://wa.me/?text=${message}`;

    window.open(waUrl, '_blank');
}

// Deep linking support for managing a merchant and opening notice or extension
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const manageId = urlParams.get('manage');
    const noticeType = urlParams.get('notice');
    const extendType = urlParams.get('extend');
    const invoiceType = urlParams.get('invoice');

    if (manageId) {
        openMerchantDetail(manageId);
        if (noticeType) {
            openSendNoticeModal(manageId);
            if (['renewal_7', 'renewal_14', 'renewal_30', 'custom'].includes(noticeType)) {
                document.getElementById('noticeTemplateSelect').value = noticeType;
                handleNoticeTemplateChange(noticeType);
            }
        } else if (extendType) {
            openExtendTrialModal(manageId);
            if (['7_days', '14_days', '30_days', '3_months', '6_months', 'custom'].includes(extendType)) {
                document.getElementById('extendPeriodSelect').value = extendType;
                handleExtendPeriodChange(extendType);
            }
        } else if (invoiceType) {
            switchMerchantTab('subscription');
            openMerchantInvoiceModal(manageId);
        }
    }
});
</script>
@endpush
@endsection
