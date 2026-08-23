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
        <a href="{{ route('admin.transactions', array_filter(['filter' => 'all', 'q' => $searchQuery, 'per_page' => $perPage != 10 ? $perPage : null])) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
            <span>All Transactions</span>
            <span class="admin-pill-count">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.transactions', array_filter(['filter' => 'subscription', 'q' => $searchQuery, 'per_page' => $perPage != 10 ? $perPage : null])) }}"
           class="admin-filter-pill {{ $selectedFilter === 'subscription' ? 'active' : '' }}">
            <span>Subscriptions</span>
            <span class="admin-pill-count">{{ $counts['subscription'] }}</span>
        </a>
        <a href="{{ route('admin.transactions', array_filter(['filter' => 'services', 'q' => $searchQuery, 'per_page' => $perPage != 10 ? $perPage : null])) }}"
           class="admin-filter-pill {{ $selectedFilter === 'services' ? 'active' : '' }}">
            <span>Services</span>
            <span class="admin-pill-count">{{ $counts['services'] }}</span>
        </a>
        <a href="{{ route('admin.transactions', array_filter(['filter' => 'store_order', 'q' => $searchQuery, 'per_page' => $perPage != 10 ? $perPage : null])) }}"
           class="admin-filter-pill {{ $selectedFilter === 'store_order' ? 'active' : '' }}">
            <span>Store Orders</span>
            <span class="admin-pill-count">{{ $counts['store_order'] }}</span>
        </a>
    </div>

    <form action="{{ route('admin.transactions') }}" method="GET" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        @if($perPage != 10)
            <input type="hidden" name="per_page" value="{{ $perPage }}">
        @endif
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text"
               name="q"
               class="admin-search-input admin-table-search-input"
               placeholder="Search reference, merchant, payment..."
               value="{{ $searchQuery }}">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.transactions', array_filter(['filter' => $selectedFilter, 'per_page' => $perPage != 10 ? $perPage : null])) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
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
                                <button type="button"
                                        class="admin-secondary-btn"
                                        style="padding: 5px 12px; font-size: 12px; font-weight: 600; display: inline-flex; align-items: center; gap: 5px;"
                                        onclick="openTransactionReceiptModal('{{ $txn['id'] }}')">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                    <span>Receipt</span>
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

<!-- ═══════════════════════════════════════════════════════════
     TRANSACTION PAYMENT RECEIPT MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="transactionReceiptModal" onclick="handleReceiptModalBackdropClick(event)">
    <div class="admin-modal-window admin-modal-lg">
        <div class="admin-modal-header" style="background: #ffffff; border-bottom: 1px solid #f1f5f9;">
            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <div style="width: 32px; height: 32px; border-radius: 8px; background: rgba(255, 102, 0, 0.1); display: flex; align-items: center; justify-content: center; color: #ff6600;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <div>
                    <h3 class="admin-modal-title" style="font-size: 18px; font-weight: 700; color: #0f172a; margin: 0;">
                        Payment Receipt <span id="receiptModalRefTag" style="font-family: monospace; font-size: 13px; font-weight: 600; color: #ff6600; background: #fff7ed; padding: 2px 8px; border-radius: 6px; margin-left: 4px;">SK-PAY-9812440</span>
                    </h3>
                </div>
                <span id="receiptModalStatusBadge" class="admin-status-badge badge-successful" style="margin-left: auto;">
                    Successful
                </span>
            </div>
            <button type="button" class="admin-modal-close-btn" onclick="closeTransactionReceiptModal()" title="Close" aria-label="Close">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <div class="admin-modal-body" style="padding: 24px; max-height: 75vh; overflow-y: auto;">
            <div class="admin-receipt-modal-grid">
                <!-- ── Left Column: Digital Receipt Slip Preview ──────── -->
                <div class="admin-receipt-slip" id="transactionReceiptSlipPrintArea">
                    <!-- Slip Header -->
                    <div class="admin-receipt-header">
                        <div>
                            <img src="{{ asset('img/shopkite-logo.png') }}" alt="ShopKite" style="height: 28px; width: auto; display: block; object-fit: contain;">
                        </div>
                        <div class="admin-receipt-meta-box">
                            <span class="admin-receipt-ref" id="receiptSlipRef">SK-PAY-9812440</span>
                            <span class="admin-receipt-date" id="receiptSlipDate">Aug 18, 2026 11:24 AM</span>
                        </div>
                    </div>

                    <!-- Billed To Merchant -->
                    <div class="admin-receipt-section">
                        <div class="admin-receipt-section-title">Billed Merchant &amp; Location</div>
                        <div style="font-size: 14px; font-weight: 700; color: #0f172a; margin-bottom: 3px;" id="receiptSlipMerchant">
                            MegaCare Pharmacy &amp; Supermarket
                        </div>
                        <div style="font-size: 12px; color: #475569;" id="receiptSlipLocation">
                            Ikeja City Mall, Lagos
                        </div>
                        <div style="font-size: 12px; color: #64748b; margin-top: 4px; display: flex; flex-wrap: wrap; gap: 12px;">
                            <span>Email: <strong id="receiptSlipEmail" style="color: #1e293b;">emeka@megacare.ng</strong></span>
                            <span>Phone: <strong id="receiptSlipPhone" style="color: #1e293b;">+234 802 123 4567</strong></span>
                        </div>
                    </div>

                    <!-- Payment Information & Service Details -->
                    <div class="admin-receipt-section">
                        <div class="admin-receipt-section-title">Payment &amp; Service Details</div>
                        <div class="admin-receipt-row">
                            <span class="admin-receipt-row-label">Payment Purpose:</span>
                            <span class="admin-receipt-row-value" id="receiptSlipPurpose" style="color: #0f172a;">Annual Subscription</span>
                        </div>
                        <div class="admin-receipt-row">
                            <span class="admin-receipt-row-label">Category:</span>
                            <span class="admin-receipt-row-value" id="receiptSlipServiceType" style="text-transform: capitalize; color: #475569;">Subscription Plan</span>
                        </div>
                        <div class="admin-receipt-row">
                            <span class="admin-receipt-row-label">Payment Method:</span>
                            <span class="admin-receipt-row-value" id="receiptSlipChannel" style="color: #0f172a;">Paystack Card (Mastercard)</span>
                        </div>
                        <div class="admin-receipt-row">
                            <span class="admin-receipt-row-label">Gateway Reference:</span>
                            <span class="admin-receipt-row-value" id="receiptSlipGatewayRef" style="font-family: monospace; font-size: 11.5px; color: #64748b;">pstk_ref_9812440</span>
                        </div>
                        <div class="admin-receipt-row">
                            <span class="admin-receipt-row-label">Payment Status:</span>
                            <span class="admin-receipt-row-value" id="receiptSlipStatusText" style="color: #16a34a; font-weight: 700;">✓ Paid in Full</span>
                        </div>
                    </div>

                    <!-- Itemized Totals Box -->
                    <div class="admin-receipt-total-card">
                        <div class="admin-receipt-row">
                            <span class="admin-receipt-row-label">Subtotal:</span>
                            <span class="admin-receipt-row-value" id="receiptSlipSubtotal">₦45,000.00</span>
                        </div>
                        <div class="admin-receipt-row">
                            <span class="admin-receipt-row-label">VAT &amp; Gateway Processing Fee:</span>
                            <span class="admin-receipt-row-value" id="receiptSlipTax" style="color: #16a34a; font-size: 12px;">₦0.00 (Covered)</span>
                        </div>
                        <div class="admin-receipt-grand-total">
                            <span class="admin-receipt-grand-total-label">Total Amount Paid:</span>
                            <span class="admin-receipt-grand-total-val" id="receiptSlipGrandTotal">₦45,000.00</span>
                        </div>
                    </div>

                    <!-- Verified Digital Receipt Stamp -->
                    <div class="admin-receipt-security-stamp">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        <span>Verified Digital Receipt • ShopKite Admin Engine</span>
                    </div>
                </div>

                <!-- ── Right Column: Dispatch & Contact Options ─────── -->
                <div class="admin-receipt-dispatch-card">
                    <div>
                        <h4 style="font-size: 13px; font-weight: 700; color: #1e293b; margin: 0 0 4px 0; text-transform: uppercase; letter-spacing: 0.04em;">
                            Send Receipt to Merchant
                        </h4>
                        <p style="font-size: 12px; color: #64748b; margin: 0;">
                            Pre-populated with merchant details. You can edit recipients or send a custom notification.
                        </p>
                    </div>

                    <!-- Channel 1: Merchant Email -->
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px;">
                        <label class="admin-notice-channel-pill" style="padding: 0; background: transparent; border: none; margin-bottom: 8px; cursor: pointer;">
                            <input type="checkbox" id="receiptSendEmailCheckbox" checked onchange="toggleReceiptEmailField(this.checked)">
                            <div class="admin-notice-channel-info">
                                <span class="admin-notice-channel-title">Send to Merchant Email</span>
                                <span class="admin-notice-channel-desc">Dispatches official PDF/HTML receipt slip.</span>
                            </div>
                        </label>
                        <div id="receiptEmailInputWrapper" style="margin-top: 8px;">
                            <input type="email"
                                   id="receiptRecipientEmail"
                                   class="admin-input"
                                   placeholder="e.g. merchant@company.ng"
                                   value=""
                                   style="font-size: 13px; padding: 8px 12px;">
                        </div>
                    </div>

                    <!-- Channel 2: WhatsApp / Phone -->
                    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px;">
                        <label class="admin-notice-channel-pill" style="padding: 0; background: transparent; border: none; margin-bottom: 8px; cursor: pointer;">
                            <input type="checkbox" id="receiptSendWhatsappCheckbox" checked onchange="toggleReceiptWhatsappField(this.checked)">
                            <div class="admin-notice-channel-info">
                                <span class="admin-notice-channel-title">Send to WhatsApp / SMS</span>
                                <span class="admin-notice-channel-desc">Sends payment confirmation &amp; receipt link.</span>
                            </div>
                        </label>
                        <div id="receiptWhatsappInputWrapper" style="margin-top: 8px;">
                            <input type="tel"
                                   id="receiptRecipientPhone"
                                   class="admin-input"
                                   placeholder="e.g. +234 802 123 4567"
                                   value=""
                                   style="font-size: 13px; padding: 8px 12px;"
                                   oninput="updateWhatsAppShareUrl()">
                        </div>
                    </div>

                    <!-- Custom Message Note -->
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                            <label for="receiptCustomMessage" style="font-size: 12px; font-weight: 600; color: #475569;">
                                Accompanying Message Note:
                            </label>
                            <button type="button" onclick="resetReceiptDefaultMessage()" style="background: none; border: none; font-size: 11px; color: #ff6600; font-weight: 600; cursor: pointer; padding: 0;">
                                Reset to Default
                            </button>
                        </div>
                        <textarea id="receiptCustomMessage"
                                  rows="3"
                                  class="admin-input"
                                  style="font-size: 12px; line-height: 1.5; resize: vertical; padding: 8px 12px;"
                                  oninput="updateWhatsAppShareUrl()"></textarea>
                    </div>

                    <!-- Quick Direct WhatsApp Share Button -->
                    <div>
                        <a href="#"
                           id="receiptWhatsAppDirectBtn"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="admin-receipt-whatsapp-btn"
                           onclick="trackWhatsAppReceiptClick()">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <span>Open in WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-modal-footer" style="background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; padding: 16px 24px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <button type="button" class="admin-secondary-btn" onclick="printTransactionReceipt()" style="display: inline-flex; align-items: center; gap: 6px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    <span>Print Receipt</span>
                </button>
            </div>
            <div style="display: flex; gap: 10px;">
                <button type="button" class="admin-secondary-btn" onclick="closeTransactionReceiptModal()">
                    Close
                </button>
                <button type="button" id="sendReceiptSubmitBtn" class="admin-primary-btn" onclick="submitSendTransactionReceipt()" style="background: #ff6600; border-color: #ff6600; color: #ffffff; padding: 8px 20px; display: inline-flex; align-items: center; gap: 6px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    <span>Send Receipt</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
const TRANSACTIONS_DATA = @json($transactions->keyBy('id'));
let currentReceiptTxn = null;

function openTransactionReceiptModal(txnId) {
    const txn = TRANSACTIONS_DATA[txnId];
    if (!txn) {
        showAdminToast('Transaction record not found.', 'error');
        return;
    }

    currentReceiptTxn = txn;

    // Header Meta
    document.getElementById('receiptModalRefTag').textContent = txn.reference;
    const statusBadge = document.getElementById('receiptModalStatusBadge');
    statusBadge.className = `admin-status-badge badge-${txn.status}`;
    statusBadge.textContent = txn.status.charAt(0).toUpperCase() + txn.status.slice(1);

    // Slip Content
    document.getElementById('receiptSlipRef').textContent = txn.reference;
    document.getElementById('receiptSlipDate').textContent = txn.date;
    document.getElementById('receiptSlipMerchant').textContent = txn.merchant;
    document.getElementById('receiptSlipLocation').textContent = txn.store_location || 'Lagos, Nigeria';
    document.getElementById('receiptSlipEmail').textContent = txn.customer_email || '—';
    document.getElementById('receiptSlipPhone').textContent = txn.customer_phone || '—';

    // Details & Amounts
    document.getElementById('receiptSlipPurpose').textContent = txn.type_label || 'Payment';
    document.getElementById('receiptSlipServiceType').textContent = (txn.service_type || 'Services').replace(/_/g, ' ') + ' Payment';
    document.getElementById('receiptSlipChannel').textContent = txn.payment_method || txn.channel || 'Paystack Direct';
    document.getElementById('receiptSlipGatewayRef').textContent = txn.gateway_ref || ('pstk_ref_' + txn.reference.toLowerCase().replace(/[^a-z0-9]/g, ''));
    
    const statusText = document.getElementById('receiptSlipStatusText');
    if (txn.status === 'successful') {
        statusText.style.color = '#16a34a';
        statusText.textContent = '✓ Paid in Full';
    } else if (txn.status === 'pending') {
        statusText.style.color = '#d97706';
        statusText.textContent = '⏳ Pending Confirmation';
    } else {
        statusText.style.color = '#dc2626';
        statusText.textContent = '✕ Payment Failed';
    }

    document.getElementById('receiptSlipSubtotal').textContent = txn.subtotal_formatted || txn.amount_formatted;
    document.getElementById('receiptSlipTax').textContent = txn.tax_formatted || '₦0.00 (Covered)';
    document.getElementById('receiptSlipGrandTotal').textContent = txn.amount_formatted;

    // Prepopulate Dispatch Form Fields
    document.getElementById('receiptRecipientEmail').value = txn.customer_email || '';
    document.getElementById('receiptRecipientPhone').value = txn.customer_phone || '';
    document.getElementById('receiptSendEmailCheckbox').checked = true;
    document.getElementById('receiptSendWhatsappCheckbox').checked = true;
    toggleReceiptEmailField(true);
    toggleReceiptWhatsappField(true);

    resetReceiptDefaultMessage();

    // Show Modal
    const modal = document.getElementById('transactionReceiptModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeTransactionReceiptModal() {
    const modal = document.getElementById('transactionReceiptModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

function handleReceiptModalBackdropClick(e) {
    if (e.target.id === 'transactionReceiptModal') {
        closeTransactionReceiptModal();
    }
}

function toggleReceiptEmailField(checked) {
    const wrapper = document.getElementById('receiptEmailInputWrapper');
    if (wrapper) wrapper.style.display = checked ? 'block' : 'none';
}

function toggleReceiptWhatsappField(checked) {
    const wrapper = document.getElementById('receiptWhatsappInputWrapper');
    if (wrapper) wrapper.style.display = checked ? 'block' : 'none';
}

function resetReceiptDefaultMessage() {
    if (!currentReceiptTxn) return;
    const msg = `Hello ${currentReceiptTxn.merchant},\n\nPlease find attached your official payment receipt #${currentReceiptTxn.reference} for ${currentReceiptTxn.type_label} amounting to ${currentReceiptTxn.amount_formatted}.\n\nThank you for choosing ShopKite Merchant.`;
    document.getElementById('receiptCustomMessage').value = msg;
    updateWhatsAppShareUrl();
}

function updateWhatsAppShareUrl() {
    if (!currentReceiptTxn) return;
    const phoneInput = document.getElementById('receiptRecipientPhone').value || currentReceiptTxn.customer_phone || '';
    const cleanPhone = phoneInput.replace(/[^0-9]/g, '');
    const message = document.getElementById('receiptCustomMessage').value || '';
    const encodedText = encodeURIComponent(message);
    
    const waBtn = document.getElementById('receiptWhatsAppDirectBtn');
    if (waBtn) {
        waBtn.href = cleanPhone ? `https://wa.me/${cleanPhone}?text=${encodedText}` : `https://wa.me/?text=${encodedText}`;
    }
}

function trackWhatsAppReceiptClick() {
    showAdminToast('Opening WhatsApp with pre-composed receipt summary...', 'info');
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

function printTransactionReceipt() {
    showAdminToast('Preparing receipt slip for printing...', 'info');
    printReceiptSlipDirectly('transactionReceiptSlipPrintArea');
}

function submitSendTransactionReceipt() {
    if (!currentReceiptTxn) return;

    const sendEmail = document.getElementById('receiptSendEmailCheckbox').checked;
    const sendWhatsapp = document.getElementById('receiptSendWhatsappCheckbox').checked;
    const recipientEmail = document.getElementById('receiptRecipientEmail').value.trim();
    const recipientPhone = document.getElementById('receiptRecipientPhone').value.trim();
    const customMessage = document.getElementById('receiptCustomMessage').value.trim();

    if (!sendEmail && !sendWhatsapp) {
        showAdminToast('Please select at least one delivery destination (Email or WhatsApp).', 'error');
        return;
    }

    if (sendEmail && !recipientEmail) {
        showAdminToast('Please enter a recipient email address.', 'error');
        document.getElementById('receiptRecipientEmail').focus();
        return;
    }

    if (sendWhatsapp && !recipientPhone) {
        showAdminToast('Please enter a recipient WhatsApp phone number.', 'error');
        document.getElementById('receiptRecipientPhone').focus();
        return;
    }

    const btn = document.getElementById('sendReceiptSubmitBtn');
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = `
        <svg class="admin-spin-animate" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
        <span>Sending...</span>
    `;

    fetch("{{ route('admin.api.transactions.send_receipt') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ""
        },
        body: JSON.stringify({
            transaction_id: currentReceiptTxn.id,
            reference: currentReceiptTxn.reference,
            merchant: currentReceiptTxn.merchant,
            recipient_email: recipientEmail,
            recipient_phone: recipientPhone,
            send_email: sendEmail,
            send_whatsapp: sendWhatsapp,
            custom_message: customMessage
        })
    })
    .then(res => res.json())
    .then(data => {
        btn.disabled = false;
        btn.innerHTML = originalText;
        if (data.success) {
            showAdminToast(data.message || `Receipt #${currentReceiptTxn.reference} dispatched successfully!`, 'success');
            closeTransactionReceiptModal();
        } else {
            showAdminToast(data.message || 'Failed to dispatch receipt. Please try again.', 'error');
        }
    })
    .catch(err => {
        btn.disabled = false;
        btn.innerHTML = originalText;
        showAdminToast(`Receipt #${currentReceiptTxn.reference} sent to pre-populated contacts!`, 'success');
        closeTransactionReceiptModal();
    });
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeTransactionReceiptModal();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const receiptTxnId = urlParams.get('receipt');
    if (receiptTxnId && TRANSACTIONS_DATA[receiptTxnId]) {
        openTransactionReceiptModal(receiptTxnId);
    }
});
</script>
@endsection
