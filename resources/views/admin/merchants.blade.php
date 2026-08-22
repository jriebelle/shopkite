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
                            <th>Connected Devices</th>
                            <th>SKUs Added</th>
                            <th>iBR Reports</th>
                            <th>Status</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($merchants as $mch)
                            <tr>
                                <td>
                                    <div><strong>{{ $mch['store_name'] }}</strong></div>
                                    <span style="font-size: 12px; color: #64748b;">{{ $mch['name'] }} &bull; {{ $mch['phone'] }}</span>
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
                                <td style="text-align: right;">
                                    <button type="button"
                                            class="admin-primary-btn"
                                            style="padding: 6px 14px; font-size: 12px;"
                                            onclick="openMerchantDetail('{{ $mch['id'] }}')">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                        <span>Manage</span>
                                    </button>
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
            <button type="button" class="admin-secondary-btn" onclick="showAdminToast('Notification sent to merchant', 'success')">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                <span>Send Notice</span>
            </button>
            <button type="button" class="admin-secondary-btn" onclick="showAdminToast('7-Day trial extension granted', 'success')">
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
                <button type="button" class="admin-primary-btn" style="font-size: 12px;" onclick="showAdminToast('Generated payment link sent to merchant', 'success')">
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

@push('scripts')
<script>
window.merchantsDatabase = @json($merchants);

function openMerchantDetail(merchantId) {
    const merchant = window.merchantsDatabase.find(m => m.id === merchantId);
    if (!merchant) return;

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
            <td><strong>${inv.invoice_no}</strong></td>
            <td style="font-size: 12.5px; color: #475569;">${inv.date}</td>
            <td><strong style="font-size: 13px; color: #1e293b;">${inv.plan}</strong></td>
            <td><strong style="color: #0f172a;">${inv.amount}</strong></td>
            <td style="font-size: 12.5px; color: #64748b;">${inv.payment_method}</td>
            <td style="font-size: 12px; color: #94a3b8;">${inv.period}</td>
            <td>
                <span class="admin-merchant-meta-pill" style="${inv.status.includes('Paid') || inv.status.includes('Completed') ? 'background: #f0fdf4; border-color: #bbf7d0; color: #16a34a;' : 'background: #f8fafc; color: #64748b;'}">
                    ${inv.status}
                </span>
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
</script>
@endpush
@endsection
