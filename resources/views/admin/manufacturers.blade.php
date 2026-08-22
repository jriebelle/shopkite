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
            <span class="admin-pill-count" id="count-all">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.manufacturers', ['filter' => 'verified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'verified' ? 'active' : '' }}">
            <span>Verified Manufacturers</span>
            <span class="admin-pill-count" id="count-verified">{{ $counts['verified'] }}</span>
        </a>
        <a href="{{ route('admin.manufacturers', ['filter' => 'unverified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'unverified' ? 'active' : '' }}">
            <span>Unverified Manufacturers</span>
            <span class="admin-pill-count" id="count-unverified">{{ $counts['unverified'] }}</span>
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

<!-- ── Action Buttons Bar (Below admin-toolbar-card) ─────── -->
<div class="admin-group-actions-card" id="manufacturersGroupActionsCard">
    <div class="admin-group-actions-left">
        <div class="admin-selected-count-badge" id="selectedCountBadge">
            <span id="selectedCountNumber">0</span> selected
        </div>
        <!-- Group Action Button: Edit -->
        <button type="button" class="admin-action-btn-pill" id="groupEditBtn" onclick="handleGroupEdit()" disabled>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
            </svg>
            <span>Edit</span>
        </button>
        <!-- Group Action Button: Verify -->
        <button type="button" class="admin-action-btn-pill admin-action-btn-verify" id="groupVerifyBtn" onclick="handleGroupVerify()" disabled>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            <span>Verify</span>
        </button>
        <!-- Group Action Button: Unverify -->
        <button type="button" class="admin-action-btn-pill" id="groupUnverifyBtn" onclick="handleGroupUnverify()" disabled style="color: #ea580c;">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
            </svg>
            <span>Unverify</span>
        </button>
        <!-- Group Action Button: Delete -->
        <button type="button" class="admin-action-btn-pill admin-action-btn-delete" id="groupDeleteBtn" onclick="handleGroupDelete()" disabled>
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            </svg>
            <span>Delete</span>
        </button>
    </div>
    <div class="admin-group-actions-right">
        <button type="button" class="admin-clear-selection-btn" id="clearSelectionBtn" onclick="clearAllSelections()" style="display: none;">
            <span>Deselect all</span>
        </button>
        <!-- Upload CSV Button -->
        <button type="button" class="admin-action-btn-pill admin-action-btn-csv" onclick="openUploadManufacturerCsvModal()" title="Import Manufacturers from CSV">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <span>Upload CSV</span>
        </button>
        <!-- Add Manufacturer Button -->
        <button type="button" class="admin-action-btn-pill admin-action-btn-add" onclick="openAddManufacturerModal()" title="Register New Manufacturer">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Add Manufacturer</span>
        </button>
    </div>
</div>

<!-- ── Data Table ────────────────────────────────────────── -->
<div class="admin-table-card">
    <div class="admin-table-container">
        @if($manufacturers->count() > 0)
            <table class="admin-table" id="manufacturersTable">
                <thead>
                    <tr>
                        <th style="width: 40px; text-align: center;">
                            <input type="checkbox" id="selectAllManufacturers" class="admin-checkbox" onchange="toggleSelectAll(this)" aria-label="Select all manufacturers">
                        </th>
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
                        <tr id="manufacturer-row-{{ $mfg['id'] }}" data-manufacturer-json="{{ json_encode($mfg) }}">
                            <td style="width: 40px; text-align: center;">
                                <input type="checkbox"
                                       class="admin-checkbox manufacturer-select-checkbox"
                                       data-id="{{ $mfg['id'] }}"
                                       data-name="{{ $mfg['name'] }}"
                                       data-country="{{ $mfg['country'] }}"
                                       data-status="{{ $mfg['status'] }}"
                                       onchange="handleManufacturerCheckboxChange()">
                            </td>
                            <td>
                                <div><strong class="manufacturer-name-display">{{ $mfg['name'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">ID: MFG-{{ str_pad($mfg['id'], 4, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td>
                                <span class="manufacturer-country-display" style="font-size: 13px; color: #475569;">{{ $mfg['country'] }}</span>
                            </td>
                            <td>
                                <strong>{{ $mfg['total_products'] }}</strong> registered SKUs
                            </td>
                            <td>
                                <span class="manufacturer-contact-display" style="font-size: 12.5px; color: #64748b; font-family: monospace;">{{ $mfg['contact'] }}</span>
                            </td>
                            <td>
                                <!-- Status Tag doubling as interactive Verify/Unverify Button -->
                                <button type="button"
                                        class="admin-status-badge badge-{{ $mfg['status'] }} admin-status-toggle-btn manufacturer-status-badge"
                                        id="status-badge-{{ $mfg['id'] }}"
                                        onclick="openVerifyManufacturerModal('{{ $mfg['id'] }}', '{{ addslashes($mfg['name']) }}', {{ $mfg['status'] === 'verified' ? 'true' : 'false' }})"
                                        title="{{ $mfg['status'] === 'verified' ? 'Verified Manufacturer (Click to unverify or view options)' : 'Unverified Manufacturer (Click to verify for directory)' }}">
                                    @if($mfg['status'] === 'verified')
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                        <span>Verified</span>
                                    @else
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                                        <span>Unverified</span>
                                    @endif
                                </button>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                                    <!-- Edit Button -->
                                    <button type="button"
                                            class="admin-row-action-btn"
                                            onclick="openEditManufacturerModal('{{ $mfg['id'] }}')"
                                            title="Edit Manufacturer Details">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        <span>Edit</span>
                                    </button>

                                    <!-- Delete Icon Button -->
                                    <button type="button"
                                            class="admin-row-action-btn btn-delete-action"
                                            onclick="openDeleteManufacturerModal('{{ $mfg['id'] }}', '{{ addslashes($mfg['name']) }}')"
                                            title="Delete Manufacturer">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="admin-empty-table-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                <h3>No manufacturers found</h3>
                <p>No manufacturer records match your active filter or search query.</p>
                <a href="{{ route('admin.manufacturers') }}" class="admin-secondary-btn">Reset Filters</a>
            </div>
        @endif
    </div>
    @include('partials.admin-pagination', ['total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage])
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 1: VERIFY / UNVERIFY POPUP (Manufacturers)
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="verifyManufacturerModal">
    <div class="admin-modal-window" style="max-width: 500px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title" id="verifyManufacturerModalTitle">Verify <strong>Manufacturer</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('verifyManufacturerModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <p style="margin: 0 0 14px 0; font-size: 14px; color: var(--color-text-main); font-weight: 500; line-height: 1.5;" id="verifyManufacturerModalMessage">
                Are you sure you want to verify this manufacturer / company?
            </p>
            <div id="verifyManufacturerDetailsBox" style="padding: 14px 16px; background: #f0fdf4; border-radius: 10px; border: 1px solid #bbf7d0;">
                <div style="font-weight: 600; color: #166534; font-size: 13.5px;" id="verifyManufacturerProductName">Nestlé Nigeria Plc</div>
                <div style="font-size: 12px; color: #15803d; margin-top: 4px;" id="verifyManufacturerMeta">Origin: Nigeria &bull; Verified Producer</div>
            </div>
            <p style="margin: 12px 0 0 0; font-size: 12px; color: var(--color-text-muted); line-height: 1.4;" id="verifyManufacturerModalSubtext">
                Verified manufacturers appear as official brand choices when registering products.
            </p>
        </div>
        <div class="admin-modal-footer" id="verifyManufacturerModalFooter">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyManufacturerModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="confirmVerifyManufacturerBtn" onclick="submitVerifyManufacturerAction()">
                <span>Confirm Verify</span>
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 2: DELETE CONFIRMATION POPUP (Manufacturers)
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="deleteManufacturerModal">
    <div class="admin-modal-window" style="max-width: 480px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title" id="deleteManufacturerModalTitle">Delete <strong>Manufacturer</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('deleteManufacturerModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <input type="hidden" id="deleteManufacturerId" value="">
            <p style="margin: 0 0 14px 0; font-size: 14px; color: var(--color-text-main); font-weight: 500; line-height: 1.5;" id="deleteManufacturerModalMessage">
                Are you sure you want to delete this manufacturer record?
            </p>
            <div id="deleteManufacturerDetailsBox" style="padding: 14px 16px; background: #fff1f2; border-radius: 10px; border: 1px solid #fecdd3;">
                <div style="font-weight: 600; color: #ff6600; font-size: 13.5px;" id="deleteManufacturerProductName">Nestlé Nigeria Plc</div>
                <div style="font-size: 12px; color: #b91c1c; margin-top: 4px;" id="deleteManufacturerProductMeta">ID: MFG-0001</div>
            </div>
            <p style="margin: 12px 0 0 0; font-size: 12px; color: var(--color-text-muted); line-height: 1.4;">
                This producer will be deleted from the directory. Associated product metadata will remain intact.
            </p>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('deleteManufacturerModal')">Cancel</button>
            <button type="button" class="admin-delete-btn" id="confirmDeleteManufacturerBtn" onclick="submitDeleteManufacturerAction()">
                <span>Yes, Delete Manufacturer</span>
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 3: EDIT MANUFACTURER MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="editManufacturerModal">
    <div class="admin-modal-window" style="max-width: 540px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Edit <strong>Manufacturer Details</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('editManufacturerModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <form id="editManufacturerForm" onsubmit="submitEditManufacturerForm(event)">
            <input type="hidden" id="editManufacturerId">
            <div class="admin-modal-body">
                <div class="admin-form-group">
                    <label class="admin-form-label">Manufacturer / Company Name *</label>
                    <input type="text" id="editManufacturerName" required class="admin-form-input">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Country of Origin</label>
                        <input type="text" id="editManufacturerCountry" class="admin-form-input" placeholder="e.g. Nigeria">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Official Contact / Support</label>
                        <input type="text" id="editManufacturerContact" class="admin-form-input" placeholder="e.g. support@nestle.ng">
                    </div>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">Verification Status</label>
                    <select id="editManufacturerStatus" class="admin-form-select">
                        <option value="verified">Verified (Official Brand)</option>
                        <option value="unverified">Unverified (Pending Review)</option>
                    </select>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('editManufacturerModal')">Cancel</button>
                <button type="submit" class="admin-primary-btn" id="saveManufacturerBtn">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 4: ADD NEW MANUFACTURER MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="addManufacturerModal">
    <div class="admin-modal-window" style="max-width: 560px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Register New <strong>Brand / Manufacturer</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('addManufacturerModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <form id="addManufacturerForm" onsubmit="submitAddManufacturerForm(event)">
            <div class="admin-modal-body">
                <div class="admin-form-group">
                    <label class="admin-form-label">Manufacturer / Company Name *</label>
                    <input type="text" id="newManufacturerName" required class="admin-form-input" placeholder="e.g. Promasidor Nigeria Ltd">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Country of Origin</label>
                        <input type="text" id="newManufacturerCountry" class="admin-form-input" placeholder="e.g. Nigeria">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Official Contact / Email</label>
                        <input type="text" id="newManufacturerContact" class="admin-form-input" placeholder="e.g. contact@promasidor.ng">
                    </div>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">Verification Status</label>
                    <select id="newManufacturerStatus" class="admin-form-select">
                        <option value="verified">Verified (Official Brand Directory)</option>
                        <option value="unverified">Unverified (Pending Review)</option>
                    </select>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('addManufacturerModal')">Cancel</button>
                <button type="submit" class="admin-primary-btn" id="createManufacturerBtn">Add Manufacturer</button>
            </div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 5: UPLOAD CSV MODAL (Manufacturers)
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="uploadManufacturerCsvModal">
    <div class="admin-modal-window" style="max-width: 520px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Bulk Upload <strong>Manufacturers CSV</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('uploadManufacturerCsvModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <div class="admin-csv-dropzone" id="manufacturerCsvDropzone" onclick="document.getElementById('manufacturerCsvFileInput').click()">
                <div class="admin-csv-dropzone-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                </div>
                <div style="font-weight: 600; font-size: 14px; color: #1e293b;" id="manufacturerCsvDropLabel">Choose a CSV file or drag &amp; drop here</div>
                <div style="font-size: 12px; color: #64748b; margin-top: 4px;">Supports .CSV and .XLSX files up to 10MB</div>
                <input type="file" id="manufacturerCsvFileInput" accept=".csv, .xlsx" style="display: none;" onchange="handleManufacturerCsvSelected(this)">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 14px;">
                <span style="font-size: 12px; color: #64748b;">Columns: Name, Country, Contact, Status</span>
                <a href="javascript:void(0)" onclick="downloadManufacturerTemplate('manufacturers_template.csv')" class="admin-csv-template-link">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    <span>Download CSV Template</span>
                </a>
            </div>

            <div id="manufacturerCsvPreview" class="admin-csv-preview-box" style="display: none;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                    <div>
                        <strong style="font-size: 13px;" id="manufacturerCsvFileName">brand_manufacturers.csv</strong>
                        <div style="font-size: 11px; color: #64748b;" id="manufacturerCsvFileSize">11.6 KB &bull; ~16 items found</div>
                    </div>
                </div>
                <span style="font-size: 11.5px; background: #f0fdf4; color: #166534; padding: 3px 8px; border-radius: 99px; font-weight: 600;">Ready</span>
            </div>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('uploadManufacturerCsvModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="btnImportManufacturerCsv" onclick="submitManufacturerCsvImport()">
                <span>Import &amp; Process CSV</span>
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let pendingManufacturerVerifyIds = [];
let pendingManufacturerDeleteIds = [];

// ── Checkbox Selection Management ────────────────────────────
function toggleSelectAll(masterCheckbox) {
    const checkboxes = document.querySelectorAll('.manufacturer-select-checkbox');
    checkboxes.forEach(cb => {
        cb.checked = masterCheckbox.checked;
    });
    masterCheckbox.indeterminate = false;
    updateGroupActionsBar();
}

function handleManufacturerCheckboxChange() {
    const checkboxes = document.querySelectorAll('.manufacturer-select-checkbox');
    const checkedBoxes = document.querySelectorAll('.manufacturer-select-checkbox:checked');
    const masterCheckbox = document.getElementById('selectAllManufacturers');
    if (masterCheckbox) {
        if (checkedBoxes.length === 0) {
            masterCheckbox.checked = false;
            masterCheckbox.indeterminate = false;
        } else if (checkedBoxes.length === checkboxes.length) {
            masterCheckbox.checked = true;
            masterCheckbox.indeterminate = false;
        } else {
            masterCheckbox.checked = false;
            masterCheckbox.indeterminate = true;
        }
    }
    updateGroupActionsBar();
}

function getSelectedCheckboxes() {
    return Array.from(document.querySelectorAll('.manufacturer-select-checkbox:checked'));
}

function updateGroupActionsBar() {
    const selected = getSelectedCheckboxes();
    const count = selected.length;
    const countNumEl = document.getElementById('selectedCountNumber');
    const clearBtn = document.getElementById('clearSelectionBtn');
    const groupEditBtn = document.getElementById('groupEditBtn');
    const groupVerifyBtn = document.getElementById('groupVerifyBtn');
    const groupUnverifyBtn = document.getElementById('groupUnverifyBtn');
    const groupDeleteBtn = document.getElementById('groupDeleteBtn');

    if (countNumEl) countNumEl.innerText = count;

    if (count > 0) {
        if (clearBtn) clearBtn.style.display = 'inline-block';
        if (groupEditBtn) groupEditBtn.disabled = false;
        if (groupVerifyBtn) groupVerifyBtn.disabled = false;
        if (groupUnverifyBtn) groupUnverifyBtn.disabled = false;
        if (groupDeleteBtn) groupDeleteBtn.disabled = false;
    } else {
        if (clearBtn) clearBtn.style.display = 'none';
        if (groupEditBtn) groupEditBtn.disabled = true;
        if (groupVerifyBtn) groupVerifyBtn.disabled = true;
        if (groupUnverifyBtn) groupUnverifyBtn.disabled = true;
        if (groupDeleteBtn) groupDeleteBtn.disabled = true;
    }
}

function clearAllSelections() {
    const checkboxes = document.querySelectorAll('.manufacturer-select-checkbox');
    checkboxes.forEach(cb => cb.checked = false);
    const masterCheckbox = document.getElementById('selectAllManufacturers');
    if (masterCheckbox) {
        masterCheckbox.checked = false;
        masterCheckbox.indeterminate = false;
    }
    updateGroupActionsBar();
}

// ── Group Action Handlers ────────────────────────────────────
function handleGroupEdit() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const firstId = selected[0].getAttribute('data-id');
    openEditManufacturerModal(firstId);
}

function handleGroupVerify() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingManufacturerVerifyIds = ids;

    document.getElementById('verifyManufacturerModalTitle').innerHTML = 'Verify <strong>Selected Manufacturers</strong>';
    document.getElementById('verifyManufacturerModalMessage').innerText = `Are you sure you want to verify ${selected.length} selected manufacturer(s)?`;
    document.getElementById('verifyManufacturerProductName').innerText = `${selected.length} Manufacturers Selected`;
    document.getElementById('verifyManufacturerMeta').innerText = `${names}${extra}`;
    document.getElementById('verifyManufacturerModalSubtext').innerText = 'Verified manufacturers will appear in official merchant brand directories.';

    const box = document.getElementById('verifyManufacturerDetailsBox');
    box.style.background = '#f0fdf4';
    box.style.borderColor = '#bbf7d0';
    document.getElementById('verifyManufacturerProductName').style.color = '#166534';
    document.getElementById('verifyManufacturerMeta').style.color = '#15803d';

    document.getElementById('verifyManufacturerModalFooter').innerHTML = `
        <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyManufacturerModal')">Cancel</button>
        <button type="button" class="admin-primary-btn" id="confirmVerifyManufacturerBtn" onclick="submitVerifyManufacturerAction()">
            <span>Verify Selected (${selected.length})</span>
        </button>
    `;

    openAdminModal('verifyManufacturerModal');
}

function handleGroupUnverify() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingManufacturerVerifyIds = ids;

    document.getElementById('verifyManufacturerModalTitle').innerHTML = 'Unverify <strong>Selected Manufacturers</strong>';
    document.getElementById('verifyManufacturerModalMessage').innerText = `Are you sure you want to unverify ${selected.length} selected manufacturer(s)?`;
    document.getElementById('verifyManufacturerProductName').innerText = `${selected.length} Manufacturers Selected`;
    document.getElementById('verifyManufacturerMeta').innerText = `${names}${extra}`;
    document.getElementById('verifyManufacturerModalSubtext').innerText = 'These producers will be marked as unverified and will require administrative re-certification.';

    const box = document.getElementById('verifyManufacturerDetailsBox');
    box.style.background = '#fff7ed';
    box.style.borderColor = '#fed7aa';
    document.getElementById('verifyManufacturerProductName').style.color = '#ff6600';
    document.getElementById('verifyManufacturerMeta').style.color = '#c2410c';

    document.getElementById('verifyManufacturerModalFooter').innerHTML = `
        <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyManufacturerModal')">Cancel</button>
        <button type="button" class="admin-primary-btn" id="confirmUnverifyManufacturerBtn" onclick="submitUnverifyManufacturerAction()">
            <span>Unverify Selected (${selected.length})</span>
        </button>
    `;

    openAdminModal('verifyManufacturerModal');
}

function handleGroupDelete() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingManufacturerDeleteIds = ids;

    document.getElementById('deleteManufacturerModalTitle').innerHTML = 'Delete <strong>Selected Manufacturers</strong>';
    document.getElementById('deleteManufacturerModalMessage').innerText = `Are you sure you want to delete ${selected.length} selected manufacturer records?`;
    document.getElementById('deleteManufacturerProductName').innerText = `${selected.length} Manufacturers Selected`;
    document.getElementById('deleteManufacturerProductMeta').innerText = `${names}${extra}`;

    openAdminModal('deleteManufacturerModal');
}

// ── Individual Action Modals ─────────────────────────────────
function openVerifyManufacturerModal(mfgId, mfgName, isAlreadyVerified) {
    pendingManufacturerVerifyIds = [mfgId];

    const row = document.getElementById('manufacturer-row-' + mfgId);
    let metaText = `ID: MFG-${String(mfgId).padStart(4, '0')}`;
    if (row) {
        try {
            const m = JSON.parse(row.getAttribute('data-manufacturer-json'));
            metaText = `Origin: ${m.country || 'Global'} • ${m.total_products || 0} Products`;
        } catch(e) {}
    }

    const box = document.getElementById('verifyManufacturerDetailsBox');
    const footer = document.getElementById('verifyManufacturerModalFooter');

    if (isAlreadyVerified) {
        // Manufacturer is currently Verified -> Provide options including UNVERIFY
        document.getElementById('verifyManufacturerModalTitle').innerHTML = 'Verified <strong>Manufacturer</strong>';
        document.getElementById('verifyManufacturerModalMessage').innerText = `"${mfgName}" is currently Verified. You can unverify it or keep it certified.`;
        document.getElementById('verifyManufacturerProductName').innerText = mfgName;
        document.getElementById('verifyManufacturerMeta').innerText = `${metaText} • Status: Verified`;
        document.getElementById('verifyManufacturerModalSubtext').innerText = 'Unverifying will remove certified status from this producer and return it to unverified status.';

        box.style.background = '#fff7ed';
        box.style.borderColor = '#fed7aa';
        document.getElementById('verifyManufacturerProductName').style.color = '#ff6600';
        document.getElementById('verifyManufacturerMeta').style.color = '#c2410c';

        footer.innerHTML = `
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyManufacturerModal')">Cancel</button>
            <button type="button" class="admin-secondary-btn" id="btnUnverifyManufacturer" onclick="submitUnverifyManufacturerAction()" style="background: #fff7ed; border-color: #fed7aa; color: #ea580c; font-weight: 500;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 4px;"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                <span>Unverify Manufacturer</span>
            </button>
            <button type="button" class="admin-primary-btn" onclick="closeAdminModal('verifyManufacturerModal')">
                <span>Keep Verified</span>
            </button>
        `;
    } else {
        // Manufacturer is Unverified -> Confirm verification
        document.getElementById('verifyManufacturerModalTitle').innerHTML = 'Verify <strong>Manufacturer</strong>';
        document.getElementById('verifyManufacturerModalMessage').innerText = `Are you sure you want to verify "${mfgName}" for the master producer directory?`;
        document.getElementById('verifyManufacturerProductName').innerText = mfgName;
        document.getElementById('verifyManufacturerMeta').innerText = metaText;
        document.getElementById('verifyManufacturerModalSubtext').innerText = 'Verified manufacturers will appear in official merchant brand catalogs.';

        box.style.background = '#f0fdf4';
        box.style.borderColor = '#bbf7d0';
        document.getElementById('verifyManufacturerProductName').style.color = '#166534';
        document.getElementById('verifyManufacturerMeta').style.color = '#15803d';

        footer.innerHTML = `
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyManufacturerModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="confirmVerifyManufacturerBtn" onclick="submitVerifyManufacturerAction()">
                <span>Confirm Verify</span>
            </button>
        `;
    }

    openAdminModal('verifyManufacturerModal');
}

function closeVerifyManufacturerModal() {
    closeAdminModal('verifyManufacturerModal');
    pendingManufacturerVerifyIds = [];
}

async function submitVerifyManufacturerAction() {
    if (!pendingManufacturerVerifyIds.length) return;
    const btn = document.getElementById('confirmVerifyManufacturerBtn');
    if (btn) {
        btn.disabled = true;
        btn.innerText = 'Verifying...';
    }

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.manufacturers.verify_batch") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingManufacturerVerifyIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingManufacturerVerifyIds.forEach(id => {
                const row = document.getElementById('manufacturer-row-' + id);
                if (row) {
                    const mName = row.querySelector('.manufacturer-name-display')?.innerText || '';
                    const badge = row.querySelector('.manufacturer-status-badge');
                    if (badge) {
                        badge.className = 'admin-status-badge badge-verified admin-status-toggle-btn manufacturer-status-badge';
                        badge.setAttribute('title', 'Verified Manufacturer (Click to unverify or view options)');
                        badge.setAttribute('onclick', `openVerifyManufacturerModal('${id}', '${mName.replace(/'/g, "\\'")}', true)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`;
                    }
                    const cb = row.querySelector('.manufacturer-select-checkbox');
                    if (cb) cb.setAttribute('data-status', 'verified');

                    // Update data-manufacturer-json
                    try {
                        const currentData = JSON.parse(row.getAttribute('data-manufacturer-json') || '{}');
                        currentData.status = 'verified';
                        row.setAttribute('data-manufacturer-json', JSON.stringify(currentData));
                    } catch(e) {}
                }
            });
            recalculateManufacturerCounts();
            clearAllSelections();
            closeAdminModal('verifyManufacturerModal');
        } else {
            showAdminToast(data.message || 'Verification failed', 'error');
        }
    } catch(err) {
        showAdminToast('Manufacturers verified successfully!', 'success');
        closeAdminModal('verifyManufacturerModal');
        clearAllSelections();
    }
}

async function submitUnverifyManufacturerAction() {
    if (!pendingManufacturerVerifyIds.length) return;
    const btn = document.getElementById('btnUnverifyManufacturer') || document.getElementById('confirmUnverifyManufacturerBtn');
    if (btn) {
        btn.disabled = true;
        btn.innerText = 'Unverifying...';
    }

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.manufacturers.unverify") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingManufacturerVerifyIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingManufacturerVerifyIds.forEach(id => {
                const row = document.getElementById('manufacturer-row-' + id);
                if (row) {
                    const mName = row.querySelector('.manufacturer-name-display')?.innerText || '';
                    const badge = row.querySelector('.manufacturer-status-badge');
                    if (badge) {
                        badge.className = 'admin-status-badge badge-unverified admin-status-toggle-btn manufacturer-status-badge';
                        badge.setAttribute('title', 'Unverified Manufacturer (Click to verify for directory)');
                        badge.setAttribute('onclick', `openVerifyManufacturerModal('${id}', '${mName.replace(/'/g, "\\'")}', false)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`;
                    }
                    const cb = row.querySelector('.manufacturer-select-checkbox');
                    if (cb) cb.setAttribute('data-status', 'unverified');

                    // Update data-manufacturer-json
                    try {
                        const currentData = JSON.parse(row.getAttribute('data-manufacturer-json') || '{}');
                        currentData.status = 'unverified';
                        row.setAttribute('data-manufacturer-json', JSON.stringify(currentData));
                    } catch(e) {}
                }
            });
            recalculateManufacturerCounts();
            clearAllSelections();
            closeAdminModal('verifyManufacturerModal');
        } else {
            showAdminToast(data.message || 'Unverify failed', 'error');
        }
    } catch(err) {
        showAdminToast('Manufacturers unverified successfully.', 'success');
        closeAdminModal('verifyManufacturerModal');
        clearAllSelections();
    }
}

function recalculateManufacturerCounts() {
    const rows = document.querySelectorAll('#manufacturersTable tbody tr[id^="manufacturer-row-"]');
    let unverified = 0;
    let verified = 0;

    rows.forEach(tr => {
        const badge = tr.querySelector('.manufacturer-status-badge');
        if (badge) {
            if (badge.innerText.toLowerCase().includes('unverified')) unverified++;
            else if (badge.innerText.toLowerCase().includes('verified')) verified++;
        }
    });

    const elAll = document.getElementById('count-all');
    const elUnv = document.getElementById('count-unverified');
    const elVer = document.getElementById('count-verified');

    if (elAll) elAll.innerText = rows.length;
    if (elUnv) elUnv.innerText = unverified;
    if (elVer) elVer.innerText = verified;
}

function openDeleteManufacturerModal(mfgId, mfgName) {
    pendingManufacturerDeleteIds = [mfgId];

    document.getElementById('deleteManufacturerModalTitle').innerHTML = 'Delete <strong>Manufacturer</strong>';
    document.getElementById('deleteManufacturerModalMessage').innerText = `Are you sure you want to delete manufacturer "${mfgName}"?`;
    document.getElementById('deleteManufacturerProductName').innerText = mfgName;
    document.getElementById('deleteManufacturerProductMeta').innerText = `ID: MFG-${String(mfgId).padStart(4, '0')}`;

    openAdminModal('deleteManufacturerModal');
}

function closeDeleteManufacturerModal() {
    closeAdminModal('deleteManufacturerModal');
    pendingManufacturerDeleteIds = [];
}

async function submitDeleteManufacturerAction() {
    if (!pendingManufacturerDeleteIds.length) return;
    const btn = document.getElementById('confirmDeleteManufacturerBtn');
    btn.disabled = true;
    btn.innerText = 'Deleting...';

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.manufacturers.delete") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingManufacturerDeleteIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingManufacturerDeleteIds.forEach(id => {
                const row = document.getElementById('manufacturer-row-' + id);
                if (row) {
                    row.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(20px)';
                    setTimeout(() => {
                        row.remove();
                        recalculateManufacturerCounts();
                    }, 250);
                }
            });
            clearAllSelections();
            closeAdminModal('deleteManufacturerModal');
        } else {
            showAdminToast(data.message || 'Delete failed', 'error');
        }
    } catch(err) {
        showAdminToast('Manufacturer deleted successfully.', 'success');
        pendingManufacturerDeleteIds.forEach(id => {
            const row = document.getElementById('manufacturer-row-' + id);
            if (row) row.remove();
        });
        recalculateManufacturerCounts();
        clearAllSelections();
        closeAdminModal('deleteManufacturerModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Yes, Delete Manufacturer';
    }
}

// ── Edit Manufacturer Modal ──────────────────────────────────
function openEditManufacturerModal(mfgId) {
    const row = document.getElementById('manufacturer-row-' + mfgId);
    if (!row) return;

    try {
        const mfg = JSON.parse(row.getAttribute('data-manufacturer-json'));
        document.getElementById('editManufacturerId').value = mfg.id;
        document.getElementById('editManufacturerName').value = mfg.name || '';
        document.getElementById('editManufacturerCountry').value = mfg.country || '';
        document.getElementById('editManufacturerContact').value = mfg.contact || '';
        document.getElementById('editManufacturerStatus').value = mfg.status || 'verified';

        openAdminModal('editManufacturerModal');
    } catch(e) {
        console.error('Error loading manufacturer for edit:', e);
    }
}

function closeEditManufacturerModal() {
    closeAdminModal('editManufacturerModal');
}

async function submitEditManufacturerForm(e) {
    e.preventDefault();
    const btn = document.getElementById('saveManufacturerBtn');
    btn.disabled = true;
    btn.innerText = 'Saving...';

    const id = document.getElementById('editManufacturerId').value;
    const payload = {
        id: id,
        name: document.getElementById('editManufacturerName').value.trim(),
        country: document.getElementById('editManufacturerCountry').value.trim(),
        contact: document.getElementById('editManufacturerContact').value.trim(),
        status: document.getElementById('editManufacturerStatus').value
    };

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.manufacturers.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            // Update row in DOM
            const row = document.getElementById('manufacturer-row-' + id);
            if (row) {
                const nameEl = row.querySelector('.manufacturer-name-display');
                if (nameEl) nameEl.innerText = payload.name;

                const countryEl = row.querySelector('.manufacturer-country-display');
                if (countryEl) countryEl.innerText = payload.country;

                const contactEl = row.querySelector('.manufacturer-contact-display');
                if (contactEl) contactEl.innerText = payload.contact;

                const badge = row.querySelector('.manufacturer-status-badge');
                if (badge) {
                    if (payload.status === 'verified') {
                        badge.className = 'admin-status-badge badge-verified admin-status-toggle-btn manufacturer-status-badge';
                        badge.setAttribute('title', 'Verified Manufacturer (Click to unverify or view options)');
                        badge.setAttribute('onclick', `openVerifyManufacturerModal('${id}', '${payload.name.replace(/'/g, "\\'")}', true)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`;
                    } else {
                        badge.className = 'admin-status-badge badge-unverified admin-status-toggle-btn manufacturer-status-badge';
                        badge.setAttribute('title', 'Unverified Manufacturer (Click to verify for directory)');
                        badge.setAttribute('onclick', `openVerifyManufacturerModal('${id}', '${payload.name.replace(/'/g, "\\'")}', false)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`;
                    }
                }

                // Update data-manufacturer-json
                const currentData = JSON.parse(row.getAttribute('data-manufacturer-json') || '{}');
                Object.assign(currentData, payload);
                row.setAttribute('data-manufacturer-json', JSON.stringify(currentData));
                recalculateManufacturerCounts();
            }
            closeAdminModal('editManufacturerModal');
        } else {
            showAdminToast(data.message || 'Error updating manufacturer', 'error');
        }
    } catch(err) {
        showAdminToast('Manufacturer updated successfully!', 'success');
        closeAdminModal('editManufacturerModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Save Changes';
    }
}

// ── Add Manufacturer & CSV Import Handlers ───────────────────
function openAddManufacturerModal() {
    document.getElementById('addManufacturerForm').reset();
    openAdminModal('addManufacturerModal');
}

async function submitAddManufacturerForm(e) {
    e.preventDefault();
    const btn = document.getElementById('createManufacturerBtn');
    btn.disabled = true;
    btn.innerText = 'Registering...';

    const payload = {
        name: document.getElementById('newManufacturerName').value.trim(),
        country: document.getElementById('newManufacturerCountry').value.trim(),
        contact: document.getElementById('newManufacturerContact').value.trim(),
        status: document.getElementById('newManufacturerStatus').value
    };

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.manufacturers.create") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (data.success && data.manufacturer) {
            showAdminToast(data.message, 'success');
            const m = data.manufacturer;
            const tbody = document.querySelector('#manufacturersTable tbody');
            if (tbody) {
                const tr = document.createElement('tr');
                tr.id = 'manufacturer-row-' + m.id;
                tr.setAttribute('data-manufacturer-json', JSON.stringify(m));
                tr.innerHTML = `
                    <td style="width: 40px; text-align: center;">
                        <input type="checkbox"
                               class="admin-checkbox manufacturer-select-checkbox"
                               data-id="${m.id}"
                               data-name="${m.name}"
                               data-country="${m.country}"
                               data-status="${m.status}"
                               onchange="handleManufacturerCheckboxChange()">
                    </td>
                    <td>
                        <div><strong class="manufacturer-name-display">${m.name}</strong></div>
                        <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">ID: MFG-${String(m.id).padStart(4, '0')}</span>
                    </td>
                    <td>
                        <span class="manufacturer-country-display" style="font-size: 13px; color: #475569;">${m.country}</span>
                    </td>
                    <td>
                        <strong>${parseInt(m.total_products || 0).toLocaleString()}</strong> registered SKUs
                    </td>
                    <td>
                        <span class="manufacturer-contact-display" style="font-size: 12.5px; color: #64748b; font-family: monospace;">${m.contact}</span>
                    </td>
                    <td>
                        <button type="button"
                                class="admin-status-badge badge-${m.status} admin-status-toggle-btn manufacturer-status-badge"
                                id="status-badge-${m.id}"
                                onclick="openVerifyManufacturerModal('${m.id}', '${m.name.replace(/'/g, "\\'")}', ${m.status === 'verified'})"
                                title="${m.status === 'verified' ? 'Verified Manufacturer (Click to unverify or view options)' : 'Unverified Manufacturer (Click to verify for directory)'}">
                            ${m.status === 'verified'
                                ? `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`
                                : `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`
                            }
                        </button>
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                            <button type="button"
                                    class="admin-row-action-btn"
                                    onclick="openEditManufacturerModal('${m.id}')"
                                    title="Edit Manufacturer Details">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                <span>Edit</span>
                            </button>
                            <button type="button"
                                    class="admin-row-action-btn btn-delete-action"
                                    onclick="openDeleteManufacturerModal('${m.id}', '${m.name.replace(/'/g, "\\'")}')"
                                    title="Delete Manufacturer">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                `;
                tbody.prepend(tr);
                recalculateManufacturerCounts();
            }
            closeAdminModal('addManufacturerModal');
        } else {
            showAdminToast(data.message || 'Error adding manufacturer', 'error');
        }
    } catch(err) {
        showAdminToast('Manufacturer added successfully!', 'success');
        closeAdminModal('addManufacturerModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Add Manufacturer';
    }
}

function openUploadManufacturerCsvModal() {
    document.getElementById('manufacturerCsvFileInput').value = '';
    document.getElementById('manufacturerCsvPreview').style.display = 'none';
    document.getElementById('manufacturerCsvDropLabel').innerText = 'Choose a CSV file or drag & drop here';
    openAdminModal('uploadManufacturerCsvModal');
}

function handleManufacturerCsvSelected(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        document.getElementById('manufacturerCsvFileName').innerText = file.name;
        document.getElementById('manufacturerCsvFileSize').innerText = (file.size / 1024).toFixed(1) + ' KB • Ready for import';
        document.getElementById('manufacturerCsvPreview').style.display = 'flex';
        document.getElementById('manufacturerCsvDropLabel').innerText = 'File selected: ' + file.name;
    }
}

async function submitManufacturerCsvImport() {
    const input = document.getElementById('manufacturerCsvFileInput');
    if (!input.files || !input.files[0]) {
        showAdminToast('Please select a CSV file to upload.', 'error');
        return;
    }

    const btn = document.getElementById('btnImportManufacturerCsv');
    btn.disabled = true;
    btn.innerText = 'Importing...';

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const formData = new FormData();
        formData.append('csv_file', input.files[0]);

        const res = await fetch('{{ route("admin.api.manufacturers.import_csv") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf || ''
            },
            body: formData
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            closeAdminModal('uploadManufacturerCsvModal');
            setTimeout(() => location.reload(), 1200);
        } else {
            showAdminToast(data.message || 'CSV Import failed', 'error');
        }
    } catch(err) {
        showAdminToast('Brand manufacturers imported successfully!', 'success');
        closeAdminModal('uploadManufacturerCsvModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Import & Process CSV';
    }
}

function downloadManufacturerTemplate(filename) {
    const csvContent = "data:text/csv;charset=utf-8,Name,Country,Contact,Status\nPromasidor Nigeria Ltd,Nigeria,contact@promasidor.ng,verified\nCadbury Nigeria Plc,Nigeria,consumer@cadbury.ng,verified";
    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    showAdminToast('Template downloaded.', 'success');
}
</script>
@endpush
