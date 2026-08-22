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
                                        style="padding: 5px 12px; font-size: 12px;"
                                        onclick="openOrderDetailModal('{{ $sale['id'] }}')">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px; vertical-align: -1px;"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <span>View</span>
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
    @include('partials.admin-pagination', ['total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage])
</div>

<!-- ═══════════════════════════════════════════════════════════
     ORDER DETAILS & RECEIPT BREAKDOWN MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="orderDetailModal" onclick="handleOrderModalBackdropClick(event)">
    <div class="admin-modal-window admin-modal-lg">
        <div class="admin-modal-header" style="background: #ffffff;">
            <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                <h3 class="admin-modal-title" id="orderModalTitle" style="font-size: 19px; font-weight: 700; color: #0f172a;">
                    Order SK-ORD-10991
                </h3>
                <span id="orderModalStatusBadge" class="admin-status-badge badge-completed">
                    Completed
                </span>
                <span id="orderModalReceiptNo" style="font-size: 12px; font-family: monospace; color: #64748b; background: #f1f5f9; padding: 3px 8px; border-radius: 6px;">
                    RCP-2026-08819
                </span>
            </div>
            <button type="button" class="admin-modal-close-btn" onclick="closeOrderDetailModal()" title="Close" aria-label="Close">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <div class="admin-modal-body" style="padding: 24px; max-height: 75vh; overflow-y: auto;">
            <!-- Top Grid: Customer & Sales Agent Information -->
            <div class="admin-order-grid">
                <!-- 1. Customer Card -->
                <div class="admin-order-card">
                    <div class="admin-order-card-header">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <h4 class="admin-order-card-title">Customer Details</h4>
                    </div>
                    <div class="admin-order-detail-list">
                        <div class="admin-order-detail-row">
                            <span class="admin-order-detail-label">Full Name:</span>
                            <span class="admin-order-detail-value" id="orderModalCustomerName">—</span>
                        </div>
                        <div class="admin-order-detail-row">
                            <span class="admin-order-detail-label">Phone Number:</span>
                            <span class="admin-order-detail-value">
                                <a href="#" id="orderModalCustomerPhone" style="color: #ff6600; text-decoration: none;">—</a>
                            </span>
                        </div>
                        <div class="admin-order-detail-row">
                            <span class="admin-order-detail-label">Email:</span>
                            <span class="admin-order-detail-value" id="orderModalCustomerEmail">—</span>
                        </div>
                        <div class="admin-order-detail-row">
                            <span class="admin-order-detail-label">Delivery Address:</span>
                            <span class="admin-order-detail-value" id="orderModalDeliveryAddress" style="font-weight: 500; font-size: 12.5px;">—</span>
                        </div>
                        <div class="admin-order-detail-row">
                            <span class="admin-order-detail-label">Host Store:</span>
                            <span class="admin-order-detail-value" id="orderModalStoreName" style="color: #0f172a;">—</span>
                        </div>
                    </div>
                </div>

                <!-- 2. Sales Agent & Station Card -->
                <div class="admin-order-card">
                    <div class="admin-order-card-header">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>
                        <h4 class="admin-order-card-title">Sales Agent &amp; Processing</h4>
                    </div>
                    <div class="admin-order-detail-list">
                        <div class="admin-order-detail-row">
                            <span class="admin-order-detail-label">Sales Agent:</span>
                            <span class="admin-order-detail-value" id="orderModalAgentName">—</span>
                        </div>
                        <div class="admin-order-detail-row">
                            <span class="admin-order-detail-label">Agent Role / Badge:</span>
                            <span class="admin-order-detail-value" id="orderModalAgentRole">—</span>
                        </div>
                        <div class="admin-order-detail-row">
                            <span class="admin-order-detail-label">POS Terminal:</span>
                            <span class="admin-order-detail-value" id="orderModalAgentTerminal">—</span>
                        </div>
                        <div class="admin-order-detail-row">
                            <span class="admin-order-detail-label">Payment Method:</span>
                            <span class="admin-order-detail-value" id="orderModalPaymentMethod">—</span>
                        </div>
                        <div class="admin-order-detail-row">
                            <span class="admin-order-detail-label">Date &amp; Time:</span>
                            <span class="admin-order-detail-value" id="orderModalDate" style="color: #64748b; font-weight: 500;">—</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Full List of Items Sold -->
            <div class="admin-order-items-wrapper">
                <div class="admin-order-items-header">
                    <h4>Items Sold (<span id="orderModalItemsCount">0</span> items)</h4>
                    <span style="font-size: 12px; color: #64748b;">SKU Level Catalog Ledger</span>
                </div>
                <div style="overflow-x: auto;">
                    <table class="admin-order-items-table">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Item Description &amp; SKU</th>
                                <th style="text-align: left;">Category</th>
                                <th style="text-align: right;">Unit Price</th>
                                <th style="text-align: center;">Qty</th>
                                <th style="text-align: right;">Total</th>
                            </tr>
                        </thead>
                        <tbody id="orderModalItemsTableBody">
                            <!-- Populated dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Discount, Summary & Total Calculation Card -->
            <div class="admin-order-totals-wrapper">
                <div class="admin-order-total-line">
                    <span>Items Subtotal:</span>
                    <strong id="orderModalSubtotal" style="color: #1e293b;">₦0.00</strong>
                </div>
                <div class="admin-order-total-line discount">
                    <span style="display: flex; align-items: center; gap: 6px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                        <span>Discount Applied (<span id="orderModalDiscountLabel">None</span>):</span>
                    </span>
                    <strong id="orderModalDiscount">-₦0.00</strong>
                </div>
                <div class="admin-order-total-line">
                    <span>Fulfillment / Delivery Fee:</span>
                    <span id="orderModalDeliveryFee" style="color: #64748b; font-weight: 500;">₦0.00</span>
                </div>
                <div class="admin-order-total-line grand-total">
                    <span>Final Order Total:</span>
                    <span class="amount" id="orderModalGrandTotal">₦0.00</span>
                </div>
            </div>
        </div>

        <div class="admin-modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; padding: 16px 24px;">
            <div style="font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 6px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                <span>Synchronized with Merchant Point-of-Sale</span>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="button" class="admin-secondary-btn" onclick="printOrderSlip()">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px; vertical-align: -1px;"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    <span>Print Receipt</span>
                </button>
                <button type="button" class="admin-primary-btn" onclick="closeOrderDetailModal()" style="background: #ff6600; border-color: #ff6600; color: #fff; padding: 8px 18px;">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
const STORE_SALES_DATA = @json($storeSales->keyBy('id'));

function openOrderDetailModal(saleId) {
    const sale = STORE_SALES_DATA[saleId];
    if (!sale) return;

    // Header & Meta
    document.getElementById('orderModalTitle').textContent = `Order ${sale.order_number}`;
    document.getElementById('orderModalReceiptNo').textContent = sale.receipt_number || 'RCP-ONLINE';
    
    // Status Badge
    const badge = document.getElementById('orderModalStatusBadge');
    badge.className = `admin-status-badge badge-${sale.status}`;
    badge.textContent = sale.status_label;

    // Customer Card
    document.getElementById('orderModalCustomerName').textContent = sale.customer_name || 'Walk-in Customer';
    const phoneEl = document.getElementById('orderModalCustomerPhone');
    phoneEl.textContent = sale.customer_phone || 'N/A';
    phoneEl.href = sale.customer_phone ? `tel:${sale.customer_phone.replace(/\s+/g, '')}` : '#';
    document.getElementById('orderModalCustomerEmail').textContent = sale.customer_email || 'N/A';
    document.getElementById('orderModalDeliveryAddress').textContent = sale.delivery_address || sale.delivery_type || 'N/A';
    document.getElementById('orderModalStoreName').textContent = sale.store_name + (sale.store_location ? ` (${sale.store_location})` : '');

    // Sales Agent Card
    const agent = sale.sales_agent || {};
    document.getElementById('orderModalAgentName').textContent = agent.name || 'Store Cashier / POS Attendant';
    document.getElementById('orderModalAgentRole').textContent = (agent.role || 'Staff') + (agent.badge_id ? ` • ${agent.badge_id}` : '');
    document.getElementById('orderModalAgentTerminal').textContent = agent.terminal || 'Digital Storefront Terminal';
    document.getElementById('orderModalPaymentMethod').textContent = sale.payment_method || sale.payment_status || 'Verified Payment';
    document.getElementById('orderModalDate').textContent = sale.date || 'N/A';

    // Items List
    const itemsTbody = document.getElementById('orderModalItemsTableBody');
    itemsTbody.innerHTML = '';
    const items = sale.items || [];
    document.getElementById('orderModalItemsCount').textContent = items.length;

    if (items.length > 0) {
        items.forEach(item => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <strong style="color: #0f172a; display: block; font-size: 13.5px;">${item.name}</strong>
                    <div style="display: flex; align-items: center; gap: 6px; margin-top: 3px;">
                        <span class="admin-order-item-sku">${item.sku || 'SKU-ITEM'}</span>
                        ${item.barcode ? `<span style="font-size: 11px; color: #94a3b8; font-family: monospace;">Barcode: ${item.barcode}</span>` : ''}
                    </div>
                </td>
                <td>
                    <span style="font-size: 12px; background: rgba(255, 102, 0, 0.08); color: #ff6600; padding: 2px 8px; border-radius: 6px; font-weight: 500;">
                        ${item.category || 'General'}
                    </span>
                </td>
                <td style="text-align: right; font-weight: 500; color: #475569;">
                    ${item.unit_price_formatted || '₦' + Number(item.unit_price).toLocaleString()}
                </td>
                <td style="text-align: center; font-weight: 700; color: #0f172a;">
                    ${item.qty}
                </td>
                <td style="text-align: right; font-weight: 700; color: #0f172a;">
                    ${item.line_total_formatted || '₦' + Number(item.line_total).toLocaleString()}
                </td>
            `;
            itemsTbody.appendChild(tr);
        });
    } else {
        itemsTbody.innerHTML = `
            <tr>
                <td colspan="5" style="text-align: center; color: #64748b; padding: 20px;">
                    ${sale.items_summary || 'Standard order items'}
                </td>
            </tr>
        `;
    }

    // Totals Breakdown
    document.getElementById('orderModalSubtotal').textContent = sale.subtotal_formatted || sale.total_formatted;
    document.getElementById('orderModalDiscount').textContent = sale.discount > 0 ? `-${sale.discount_formatted}` : '₦0.00';
    document.getElementById('orderModalDiscountLabel').textContent = sale.discount_label || (sale.discount > 0 ? 'Coupon / Promo' : 'None');
    document.getElementById('orderModalDeliveryFee').textContent = sale.delivery_fee_formatted || '₦0.00';
    document.getElementById('orderModalGrandTotal').textContent = sale.total_formatted;

    // Show modal
    const modal = document.getElementById('orderDetailModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeOrderDetailModal() {
    const modal = document.getElementById('orderDetailModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

function handleOrderModalBackdropClick(e) {
    if (e.target.id === 'orderDetailModal') {
        closeOrderDetailModal();
    }
}

function printOrderSlip() {
    showAdminToast('Preparing receipt slip for printing...', 'info');
    setTimeout(() => {
        window.print();
    }, 400);
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeOrderDetailModal();
    }
});

// Auto-open modal if ?view=ORD-xxxx is in URL query parameters
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const viewId = urlParams.get('view');
    if (viewId && STORE_SALES_DATA[viewId]) {
        openOrderDetailModal(viewId);
    }
});
</script>
@endsection
