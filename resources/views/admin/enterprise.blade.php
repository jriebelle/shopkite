@extends('layouts.admin')

@section('title', 'Enterprise Directory — ShopKite Admin')
@section('breadcrumb_title', 'Enterprise')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Enterprise &amp; <strong>Vendor Directory</strong></h1>
        <p class="admin-page-subtitle">Directory of vendors, suppliers, and corporate companies sending and receiving ShopKite free invoices.</p>
    </div>
</div>

<!-- ── Toolbar: Filter Pills & Search Form ───────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group" id="enterpriseFilterPills">
        <a href="{{ route('admin.enterprise', ['filter' => 'all', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}"
           data-tag="all">
            <span>All</span>
            <span class="admin-pill-count" id="count-all">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.enterprise', ['filter' => 'senders', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'senders' ? 'active' : '' }}"
           data-tag="senders">
            <span>Senders (Vendors)</span>
            <span class="admin-pill-count" id="count-senders">{{ $counts['senders'] }}</span>
        </a>
        <a href="{{ route('admin.enterprise', ['filter' => 'receivers', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'receivers' ? 'active' : '' }}"
           data-tag="receivers">
            <span>Receivers (Companies)</span>
            <span class="admin-pill-count" id="count-receivers">{{ $counts['receivers'] }}</span>
        </a>
        <a href="{{ route('admin.enterprise', ['filter' => 'high_volume', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'high_volume' ? 'active' : '' }}"
           data-tag="high_volume">
            <span>High Volume</span>
            <span class="admin-pill-count" id="count-high_volume">{{ $counts['high_volume'] }}</span>
        </a>
        <a href="{{ route('admin.enterprise', ['filter' => 'contacted', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'contacted' ? 'active' : '' }}"
           data-tag="contacted">
            <span>Contacted</span>
            <span class="admin-pill-count" id="count-contacted">{{ $counts['contacted'] }}</span>
        </a>
        <a href="{{ route('admin.enterprise', ['filter' => 'converted', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'converted' ? 'active' : '' }}"
           data-tag="converted">
            <span>Converted</span>
            <span class="admin-pill-count" id="count-converted">{{ $counts['converted'] }}</span>
        </a>
    </div>

    <form action="{{ route('admin.enterprise') }}" method="GET" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text"
               name="q"
               class="admin-search-input admin-table-search-input"
               placeholder="Search company, email, phone..."
               value="{{ $searchQuery }}">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.enterprise', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
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
        @if($leads->count() > 0)
            <table class="admin-table" id="enterpriseLeadsTable">
                <thead>
                    <tr>
                        <th>Company / Vendor</th>
                        <th>Email Address</th>
                        <th>Phone Number</th>
                        <th>Invoice Role</th>
                        <th>Invoices Traced</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr id="lead-row-{{ $lead['id'] }}"
                            data-lead-id="{{ $lead['id'] }}"
                            data-role="{{ $lead['role'] }}"
                            data-status="{{ $lead['status'] }}"
                            data-volume="{{ $lead['total_volume'] }}">
                            <td>
                                <div><strong>{{ $lead['company_name'] }}</strong></div>
                                <span style="font-size: 12px; color: #64748b;">{{ $lead['contact_person'] }} &bull; {{ $lead['city'] }}, {{ $lead['state'] }}</span>
                            </td>
                            <td>
                                <a href="mailto:{{ $lead['email'] }}" style="color: #2563eb; text-decoration: none; font-size: 13px; font-weight: 500;">{{ $lead['email'] }}</a>
                            </td>
                            <td>
                                <a href="tel:{{ $lead['phone'] }}" style="color: #1e293b; text-decoration: none; font-size: 13px;">{{ $lead['phone'] }}</a>
                            </td>
                            <td>
                                @if($lead['role'] === 'sender')
                                    <span class="admin-status-badge badge-subscribed">
                                        Sender (Vendor)
                                    </span>
                                @else
                                    <span class="admin-status-badge badge-active">
                                        Receiver (Company)
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div><strong style="font-size: 13.5px; color: #1e293b;">{{ $lead['total_volume_formatted'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #94a3b8;">{{ $lead['total_invoices'] }} {{ $lead['total_invoices'] == 1 ? 'Invoice' : 'Invoices' }} &bull; {{ $lead['latest_invoice_no'] }}</span>
                            </td>
                            <td>
                                <!-- Interactive Status Dropdown -->
                                <div class="admin-status-select-wrap">
                                    <select class="admin-status-select status-{{ $lead['status'] }}"
                                            onchange="updateLeadStatus('{{ $lead['id'] }}', this.value, this, '{{ addslashes($lead['company_name']) }}')"
                                            aria-label="Update lead status for {{ $lead['company_name'] }}">
                                        <option value="captured" {{ $lead['status'] === 'captured' ? 'selected' : '' }}>Captured</option>
                                        <option value="contacted" {{ in_array($lead['status'], ['contacted', 'b2b_prospect']) ? 'selected' : '' }}>Contacted</option>
                                        <option value="high_volume" {{ $lead['status'] === 'high_volume' ? 'selected' : '' }}>High Volume</option>
                                        <option value="converted" {{ $lead['status'] === 'converted' ? 'selected' : '' }}>Converted</option>
                                    </select>
                                    <svg class="admin-status-select-arrow" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </div>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                                    <button type="button"
                                            class="admin-btn-action"
                                            onclick="copyContact('{{ $lead['email'] }}', 'Email copied!')"
                                            title="Copy Email"
                                            style="border: 1px solid #e2e8f0; background: #ffffff; padding: 4px 8px; border-radius: 6px; font-size: 12px; color: #475569; cursor: pointer;">
                                        <span>Copy</span>
                                    </button>
                                    <a href="mailto:{{ $lead['email'] }}"
                                       class="admin-btn-action"
                                       style="text-decoration: none; border: 1px solid #fed7aa; background: #fff7ed; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 500; color: #ea580c;">
                                        <span>Email</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="admin-table-empty">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                    <path d="M9 22v-4h6v4"></path>
                    <path d="M8 6h.01"></path>
                    <path d="M16 6h.01"></path>
                    <path d="M8 10h.01"></path>
                    <path d="M16 10h.01"></path>
                </svg>
                <h3>No Enterprise Contacts Found</h3>
            </div>
        @endif
    </div>
    @include('partials.admin-pagination', ['total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage])
</div>
@endsection

@push('scripts')
<script>
const activeFilter = '{{ $selectedFilter }}';

const statusLabels = {
    'captured': 'Captured / New',
    'contacted': 'Contacted',
    'high_volume': 'High Volume',
    'converted': 'Converted Merchant'
};

async function updateLeadStatus(leadId, newStatus, selectEl, companyName) {
    const row = document.getElementById('lead-row-' + leadId);
    const oldStatus = row ? row.getAttribute('data-status') : '';

    // Update select element visual style
    selectEl.className = 'admin-status-select status-' + newStatus;
    if (row) {
        row.setAttribute('data-status', newStatus);
    }

    // Recalculate dynamic tag counts across all rows
    recalculateTagCounts();

    // If currently filtered by a specific status tag, check if row still belongs or should smoothly fade
    if (activeFilter !== 'all' && activeFilter !== 'senders' && activeFilter !== 'receivers') {
        const matchesFilter = (activeFilter === 'high_volume' && newStatus === 'high_volume') ||
                              (activeFilter === 'contacted' && newStatus === 'contacted') ||
                              (activeFilter === 'converted' && newStatus === 'converted');
        
        if (!matchesFilter && row) {
            row.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            row.style.opacity = '0.35';
        } else if (row) {
            row.style.opacity = '1';
        }
    }

    const label = statusLabels[newStatus] || newStatus;
    showAdminToast(`Status updated to "${label}" for ${companyName}`, 'success');

    // Send API request to persist status update
    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        await fetch('{{ route("admin.api.enterprise.status") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ id: leadId, status: newStatus })
        });
    } catch(err) {
        console.error('Failed to update status:', err);
    }
}

function recalculateTagCounts() {
    const rows = document.querySelectorAll('#enterpriseLeadsTable tbody tr[data-lead-id]');
    if (!rows.length) return;

    let countAll = rows.length;
    let countSenders = 0;
    let countReceivers = 0;
    let countHighVolume = 0;
    let countContacted = 0;
    let countConverted = 0;

    rows.forEach(tr => {
        const role = tr.getAttribute('data-role');
        const st = tr.getAttribute('data-status');
        const vol = parseFloat(tr.getAttribute('data-volume')) || 0;

        if (role === 'sender') countSenders++;
        if (role === 'receiver') countReceivers++;
        if (st === 'high_volume' || vol >= 25000000) countHighVolume++;
        if (st === 'contacted' || st === 'b2b_prospect') countContacted++;
        if (st === 'converted') countConverted++;
    });

    const setVal = (id, val) => {
        const el = document.getElementById(id);
        if (el) el.innerText = val;
    };

    setVal('count-all', countAll);
    setVal('count-senders', countSenders);
    setVal('count-receivers', countReceivers);
    setVal('count-high_volume', countHighVolume);
    setVal('count-contacted', countContacted);
    setVal('count-converted', countConverted);
}

function copyContact(text, msg) {
    if (!text) return;
    navigator.clipboard.writeText(text).then(() => {
        showAdminToast(msg || 'Copied to clipboard!', 'success');
    }).catch(() => {
        showAdminToast('Copied: ' + text, 'success');
    });
}
</script>
@endpush
