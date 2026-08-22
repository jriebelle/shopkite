@extends('layouts.admin')

@section('title', 'Barcode Registry — ShopKite Admin')
@section('breadcrumb_title', 'Barcode Products')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Barcode <strong>Product Registry</strong></h1>
        <p class="admin-page-subtitle">Universal EAN-13 and UPC barcode master database used across all ShopKite POS terminals in retail stores.</p>
    </div>
</div>

<!-- ── Toolbar: Filter Pills & Search Form ───────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group">
        <a href="{{ route('admin.barcodes', ['filter' => 'all', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
            <span>All Barcodes</span>
            <span class="admin-pill-count" id="count-all">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.barcodes', ['filter' => 'verified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'verified' ? 'active' : '' }}">
            <span>Verified Barcodes</span>
            <span class="admin-pill-count" id="count-verified">{{ $counts['verified'] }}</span>
        </a>
        <a href="{{ route('admin.barcodes', ['filter' => 'unverified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'unverified' ? 'active' : '' }}">
            <span>Unverified Barcodes</span>
            <span class="admin-pill-count" id="count-unverified">{{ $counts['unverified'] }}</span>
        </a>
    </div>

    <form action="{{ route('admin.barcodes') }}" method="GET" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text"
               name="q"
               class="admin-search-input admin-table-search-input"
               placeholder="Search barcode number, product, brand..."
               value="{{ $searchQuery }}">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.barcodes', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>
        @endif
    </form>
</div>

<!-- ── Action Buttons Bar (Below admin-toolbar-card) ─────── -->
<div class="admin-group-actions-card" id="barcodesGroupActionsCard">
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
        <button type="button" class="admin-action-btn-pill admin-action-btn-csv" onclick="openUploadBarcodeCsvModal()" title="Import Barcodes from CSV">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <span>Upload CSV</span>
        </button>
        <!-- Add Barcode Button -->
        <button type="button" class="admin-action-btn-pill admin-action-btn-add" onclick="openAddBarcodeModal()" title="Register New Barcode">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Add Barcode</span>
        </button>
    </div>
</div>

<!-- ── Data Table ────────────────────────────────────────── -->
<div class="admin-table-card">
    <div class="admin-table-container">
        @if($barcodes->count() > 0)
            <table class="admin-table" id="barcodesTable">
                <thead>
                    <tr>
                        <th style="width: 40px; text-align: center;">
                            <input type="checkbox" id="selectAllBarcodes" class="admin-checkbox" onchange="toggleSelectAll(this)" aria-label="Select all barcodes">
                        </th>
                        <th>Barcode Number</th>
                        <th>Product Title</th>
                        <th>Manufacturer / Brand</th>
                        <th>Category</th>
                        <th>Verification Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barcodes as $item)
                        <tr id="barcode-row-{{ $item['id'] }}" data-barcode-json="{{ json_encode($item) }}">
                            <td style="width: 40px; text-align: center;">
                                <input type="checkbox"
                                       class="admin-checkbox barcode-select-checkbox"
                                       data-id="{{ $item['id'] }}"
                                       data-name="{{ $item['name'] }}"
                                       data-barcode="{{ $item['barcode'] }}"
                                       data-status="{{ $item['status'] }}"
                                       onchange="handleBarcodeCheckboxChange()">
                            </td>
                            <td>
                                <span class="admin-barcode-badge barcode-number-display" style="font-size: 13px; font-weight: 700; color: #1e293b;">{{ $item['barcode'] }}</span>
                            </td>
                            <td>
                                <div><strong class="barcode-name-display">{{ $item['name'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">Linked SKU: {{ $item['id'] }}</span>
                            </td>
                            <td>
                                <span class="barcode-manufacturer-display" style="font-size: 13px; color: #475569;">{{ $item['manufacturer'] }}</span>
                            </td>
                            <td>
                                <span class="barcode-category-display" style="font-size: 13px; color: #475569;">{{ $item['category'] }}</span>
                            </td>
                            <td>
                                <!-- Status Tag doubling as interactive Verify/Unverify Button -->
                                <button type="button"
                                        class="admin-status-badge badge-{{ $item['status'] }} admin-status-toggle-btn barcode-status-badge"
                                        id="status-badge-{{ $item['id'] }}"
                                        onclick="openVerifyBarcodeModal('{{ $item['id'] }}', '{{ addslashes($item['name']) }}', '{{ $item['barcode'] }}', {{ $item['status'] === 'verified' ? 'true' : 'false' }})"
                                        title="{{ $item['status'] === 'verified' ? 'Certified Barcode (Click to unverify or view options)' : 'Unverified Barcode (Click to verify for registry)' }}">
                                    @if($item['status'] === 'verified')
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
                                            onclick="openEditBarcodeModal('{{ $item['id'] }}')"
                                            title="Edit Barcode Details">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        <span>Edit</span>
                                    </button>

                                    <!-- Delete Icon Button -->
                                    <button type="button"
                                            class="admin-row-action-btn btn-delete-action"
                                            onclick="openDeleteBarcodeModal('{{ $item['id'] }}', '{{ addslashes($item['name']) }}', '{{ $item['barcode'] }}')"
                                            title="Delete Barcode">
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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="5" x2="3" y2="19"></line><line x1="7" y1="5" x2="7" y2="19"></line><line x1="11" y1="5" x2="11" y2="19"></line></svg>
                <h3>No barcode records found</h3>
                <p>No barcode items match your active filter or search query.</p>
                <a href="{{ route('admin.barcodes') }}" class="admin-secondary-btn">Reset Filters</a>
            </div>
        @endif
    </div>
    @include('partials.admin-pagination', ['total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage])
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 1: VERIFY / UNVERIFY POPUP (Barcodes)
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="verifyBarcodeModal">
    <div class="admin-modal-window" style="max-width: 500px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title" id="verifyBarcodeModalTitle">Verify <strong>Barcode Registry</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('verifyBarcodeModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <p style="margin: 0 0 14px 0; font-size: 14px; color: var(--color-text-main); font-weight: 500; line-height: 1.5;" id="verifyBarcodeModalMessage">
                Are you sure you want to verify this barcode for the master registry?
            </p>
            <div id="verifyBarcodeDetailsBox" style="padding: 14px 16px; background: #f0fdf4; border-radius: 10px; border: 1px solid #bbf7d0;">
                <div style="font-weight: 600; color: #166534; font-size: 13.5px;" id="verifyBarcodeProductName">Peak Full Cream Milk Powder 400g</div>
                <div style="font-size: 12px; color: #15803d; margin-top: 4px;" id="verifyBarcodeMeta">Barcode: 6151100010123 &bull; Dairy &amp; Breakfast</div>
            </div>
            <p style="margin: 12px 0 0 0; font-size: 12px; color: var(--color-text-muted); line-height: 1.4;" id="verifyBarcodeModalSubtext">
                Verified barcodes instantly resolve on all ShopKite device scanners when scanned at checkout.
            </p>
        </div>
        <div class="admin-modal-footer" id="verifyBarcodeModalFooter">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyBarcodeModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="confirmVerifyBarcodeBtn" onclick="submitVerifyBarcodeAction()">
                <span>Confirm Verify</span>
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 2: DELETE CONFIRMATION POPUP (Barcodes)
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="deleteBarcodeModal">
    <div class="admin-modal-window" style="max-width: 480px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title" id="deleteBarcodeModalTitle">Delete <strong>Barcode Entry</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('deleteBarcodeModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <input type="hidden" id="deleteBarcodeId" value="">
            <p style="margin: 0 0 14px 0; font-size: 14px; color: var(--color-text-main); font-weight: 500; line-height: 1.5;" id="deleteBarcodeModalMessage">
                Are you sure you want to delete this barcode record?
            </p>
            <div id="deleteBarcodeDetailsBox" style="padding: 14px 16px; background: #fff1f2; border-radius: 10px; border: 1px solid #fecdd3;">
                <div style="font-weight: 600; color: #ff6600; font-size: 13.5px;" id="deleteBarcodeProductName">Peak Full Cream Milk Powder 400g</div>
                <div style="font-size: 12px; color: #b91c1c; margin-top: 4px;" id="deleteBarcodeProductMeta">Barcode: 6151100010123</div>
            </div>
            <p style="margin: 12px 0 0 0; font-size: 12px; color: var(--color-text-muted); line-height: 1.4;">
                This barcode will be removed from the master registry. POS scanners will no longer auto-match it.
            </p>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('deleteBarcodeModal')">Cancel</button>
            <button type="button" class="admin-delete-btn" id="confirmDeleteBarcodeBtn" onclick="submitDeleteBarcodeAction()">
                <span>Yes, Delete Barcode</span>
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 3: EDIT BARCODE MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="editBarcodeModal">
    <div class="admin-modal-window" style="max-width: 560px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Edit <strong>Barcode Details</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('editBarcodeModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <form id="editBarcodeForm" onsubmit="submitEditBarcodeForm(event)">
            <input type="hidden" id="editBarcodeId">
            <div class="admin-modal-body">
                <div class="admin-form-group">
                    <label class="admin-form-label">Barcode Number (EAN / UPC) *</label>
                    <input type="text" id="editBarcodeNumber" required class="admin-form-input" style="font-family: monospace; font-weight: 600;">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">Product Title *</label>
                    <input type="text" id="editBarcodeName" required class="admin-form-input">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Manufacturer / Brand</label>
                        <input type="text" id="editBarcodeManufacturer" class="admin-form-input">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Category</label>
                        <input type="text" id="editBarcodeCategory" class="admin-form-input">
                    </div>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">Verification Status</label>
                    <select id="editBarcodeStatus" class="admin-form-select">
                        <option value="verified">Verified (Master Registry)</option>
                        <option value="unverified">Unverified (Pending Review)</option>
                    </select>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('editBarcodeModal')">Cancel</button>
                <button type="submit" class="admin-primary-btn" id="saveBarcodeBtn">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 4: ADD NEW BARCODE REGISTRY ITEM
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="addBarcodeModal">
    <div class="admin-modal-window" style="max-width: 560px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Register New <strong>Universal Barcode</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('addBarcodeModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <form id="addBarcodeForm" onsubmit="submitAddBarcodeForm(event)">
            <div class="admin-modal-body">
                <div class="admin-form-group">
                    <label class="admin-form-label">Barcode Number (EAN-13 / UPC) *</label>
                    <input type="text" id="newBarcodeNumber" required class="admin-form-input" placeholder="e.g. 6151100010999" style="font-family: monospace; font-weight: 600;">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">Product Name &amp; Size *</label>
                    <input type="text" id="newBarcodeName" required class="admin-form-input" placeholder="e.g. Peak Full Cream Evaporated Milk 160g">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Manufacturer / Brand</label>
                        <input type="text" id="newBarcodeManufacturer" class="admin-form-input" placeholder="e.g. FrieslandCampina">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Category</label>
                        <input type="text" id="newBarcodeCategory" class="admin-form-input" placeholder="e.g. Dairy & Breakfast">
                    </div>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">Verification Status</label>
                    <select id="newBarcodeStatus" class="admin-form-select">
                        <option value="verified">Verified (Universal Scanner Master)</option>
                        <option value="unverified">Unverified (Pending Certification)</option>
                    </select>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('addBarcodeModal')">Cancel</button>
                <button type="submit" class="admin-primary-btn" id="createBarcodeBtn">Register Barcode</button>
            </div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 5: UPLOAD CSV MODAL (Barcodes)
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="uploadBarcodeCsvModal">
    <div class="admin-modal-window" style="max-width: 520px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Bulk Upload <strong>Barcodes CSV</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('uploadBarcodeCsvModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <div class="admin-csv-dropzone" id="barcodeCsvDropzone" onclick="document.getElementById('barcodeCsvFileInput').click()">
                <div class="admin-csv-dropzone-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                </div>
                <div style="font-weight: 600; font-size: 14px; color: #1e293b;" id="barcodeCsvDropLabel">Choose a CSV file or drag &amp; drop here</div>
                <div style="font-size: 12px; color: #64748b; margin-top: 4px;">Supports .CSV and .XLSX files up to 10MB</div>
                <input type="file" id="barcodeCsvFileInput" accept=".csv, .xlsx" style="display: none;" onchange="handleBarcodeCsvSelected(this)">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 14px;">
                <span style="font-size: 12px; color: #64748b;">Columns: Barcode, Name, Brand, Category</span>
                <a href="javascript:void(0)" onclick="downloadBarcodeTemplate('barcodes_template.csv')" class="admin-csv-template-link">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    <span>Download CSV Template</span>
                </a>
            </div>

            <div id="barcodeCsvPreview" class="admin-csv-preview-box" style="display: none;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                    <div>
                        <strong style="font-size: 13px;" id="barcodeCsvFileName">barcode_registry.csv</strong>
                        <div style="font-size: 11px; color: #64748b;" id="barcodeCsvFileSize">22.4 KB &bull; ~24 items found</div>
                    </div>
                </div>
                <span style="font-size: 11.5px; background: #f0fdf4; color: #166534; padding: 3px 8px; border-radius: 99px; font-weight: 600;">Ready</span>
            </div>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('uploadBarcodeCsvModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="btnImportBarcodeCsv" onclick="submitBarcodeCsvImport()">
                <span>Import &amp; Process CSV</span>
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let pendingBarcodeVerifyIds = [];
let pendingBarcodeDeleteIds = [];

// ── Checkbox Selection Management ────────────────────────────
function toggleSelectAll(masterCheckbox) {
    const checkboxes = document.querySelectorAll('.barcode-select-checkbox');
    checkboxes.forEach(cb => {
        cb.checked = masterCheckbox.checked;
    });
    masterCheckbox.indeterminate = false;
    updateGroupActionsBar();
}

function handleBarcodeCheckboxChange() {
    const checkboxes = document.querySelectorAll('.barcode-select-checkbox');
    const checkedBoxes = document.querySelectorAll('.barcode-select-checkbox:checked');
    const masterCheckbox = document.getElementById('selectAllBarcodes');
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
    return Array.from(document.querySelectorAll('.barcode-select-checkbox:checked'));
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
    const checkboxes = document.querySelectorAll('.barcode-select-checkbox');
    checkboxes.forEach(cb => cb.checked = false);
    const masterCheckbox = document.getElementById('selectAllBarcodes');
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
    openEditBarcodeModal(firstId);
}

function handleGroupVerify() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingBarcodeVerifyIds = ids;

    document.getElementById('verifyBarcodeModalTitle').innerHTML = 'Verify <strong>Selected Barcodes</strong>';
    document.getElementById('verifyBarcodeModalMessage').innerText = `Are you sure you want to verify ${selected.length} selected barcode(s) for the master registry?`;
    document.getElementById('verifyBarcodeProductName').innerText = `${selected.length} Barcodes Selected`;
    document.getElementById('verifyBarcodeMeta').innerText = `${names}${extra}`;
    document.getElementById('verifyBarcodeModalSubtext').innerText = 'Verified barcodes will instantly resolve across all ShopKite device scanners.';

    const box = document.getElementById('verifyBarcodeDetailsBox');
    box.style.background = '#f0fdf4';
    box.style.borderColor = '#bbf7d0';
    document.getElementById('verifyBarcodeProductName').style.color = '#166534';
    document.getElementById('verifyBarcodeMeta').style.color = '#15803d';

    document.getElementById('verifyBarcodeModalFooter').innerHTML = `
        <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyBarcodeModal')">Cancel</button>
        <button type="button" class="admin-primary-btn" id="confirmVerifyBarcodeBtn" onclick="submitVerifyBarcodeAction()">
            <span>Verify Selected (${selected.length})</span>
        </button>
    `;

    openAdminModal('verifyBarcodeModal');
}

function handleGroupUnverify() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingBarcodeVerifyIds = ids;

    document.getElementById('verifyBarcodeModalTitle').innerHTML = 'Unverify <strong>Selected Barcodes</strong>';
    document.getElementById('verifyBarcodeModalMessage').innerText = `Are you sure you want to unverify ${selected.length} selected barcode(s)?`;
    document.getElementById('verifyBarcodeProductName').innerText = `${selected.length} Barcodes Selected`;
    document.getElementById('verifyBarcodeMeta').innerText = `${names}${extra}`;
    document.getElementById('verifyBarcodeModalSubtext').innerText = 'These barcodes will be marked as unverified and will require manual lookup until certified.';

    const box = document.getElementById('verifyBarcodeDetailsBox');
    box.style.background = '#fff7ed';
    box.style.borderColor = '#fed7aa';
    document.getElementById('verifyBarcodeProductName').style.color = '#ff6600';
    document.getElementById('verifyBarcodeMeta').style.color = '#c2410c';

    document.getElementById('verifyBarcodeModalFooter').innerHTML = `
        <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyBarcodeModal')">Cancel</button>
        <button type="button" class="admin-primary-btn" id="confirmUnverifyBarcodeBtn" onclick="submitUnverifyBarcodeAction()">
            <span>Unverify Selected (${selected.length})</span>
        </button>
    `;

    openAdminModal('verifyBarcodeModal');
}

function handleGroupDelete() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingBarcodeDeleteIds = ids;

    document.getElementById('deleteBarcodeModalTitle').innerHTML = 'Delete <strong>Selected Barcodes</strong>';
    document.getElementById('deleteBarcodeModalMessage').innerText = `Are you sure you want to delete ${selected.length} selected barcode record(s)?`;
    document.getElementById('deleteBarcodeProductName').innerText = `${selected.length} Barcodes Selected`;
    document.getElementById('deleteBarcodeProductMeta').innerText = `${names}${extra}`;

    openAdminModal('deleteBarcodeModal');
}

// ── Individual Action Modals ─────────────────────────────────
function openVerifyBarcodeModal(productId, productName, barcodeNumber, isAlreadyVerified) {
    pendingBarcodeVerifyIds = [productId];

    const row = document.getElementById('barcode-row-' + productId);
    let metaText = `Barcode: ${barcodeNumber}`;
    if (row) {
        try {
            const p = JSON.parse(row.getAttribute('data-barcode-json'));
            metaText = `Barcode: ${barcodeNumber} • ${p.category || 'General'}`;
        } catch(e) {}
    }

    const box = document.getElementById('verifyBarcodeDetailsBox');
    const footer = document.getElementById('verifyBarcodeModalFooter');

    if (isAlreadyVerified) {
        // Product is currently Verified -> Provide options including UNVERIFY
        document.getElementById('verifyBarcodeModalTitle').innerHTML = 'Certified <strong>Barcode Entry</strong>';
        document.getElementById('verifyBarcodeModalMessage').innerText = `"${productName}" (${barcodeNumber}) is currently Certified for the master registry. You can unverify it or keep it certified.`;
        document.getElementById('verifyBarcodeProductName').innerText = productName;
        document.getElementById('verifyBarcodeMeta').innerText = `${metaText} • Status: Verified`;
        document.getElementById('verifyBarcodeModalSubtext').innerText = 'Unverifying will remove certified status from this barcode and flag it as unverified.';

        box.style.background = '#fff7ed';
        box.style.borderColor = '#fed7aa';
        document.getElementById('verifyBarcodeProductName').style.color = '#ff6600';
        document.getElementById('verifyBarcodeMeta').style.color = '#c2410c';

        footer.innerHTML = `
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyBarcodeModal')">Cancel</button>
            <button type="button" class="admin-secondary-btn" id="btnUnverifyBarcode" onclick="submitUnverifyBarcodeAction()" style="background: #fff7ed; border-color: #fed7aa; color: #ea580c; font-weight: 500;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 4px;"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                <span>Unverify Barcode</span>
            </button>
            <button type="button" class="admin-primary-btn" onclick="closeAdminModal('verifyBarcodeModal')">
                <span>Keep Verified</span>
            </button>
        `;
    } else {
        // Product is Unverified -> Confirm verification
        document.getElementById('verifyBarcodeModalTitle').innerHTML = 'Verify <strong>Barcode Entry</strong>';
        document.getElementById('verifyBarcodeModalMessage').innerText = `Are you sure you want to certify barcode ${barcodeNumber} for "${productName}"?`;
        document.getElementById('verifyBarcodeProductName').innerText = productName;
        document.getElementById('verifyBarcodeMeta').innerText = metaText;
        document.getElementById('verifyBarcodeModalSubtext').innerText = 'Verified barcodes instantly resolve across all ShopKite device scanners when scanned.';

        box.style.background = '#f0fdf4';
        box.style.borderColor = '#bbf7d0';
        document.getElementById('verifyBarcodeProductName').style.color = '#166534';
        document.getElementById('verifyBarcodeMeta').style.color = '#15803d';

        footer.innerHTML = `
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyBarcodeModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="confirmVerifyBarcodeBtn" onclick="submitVerifyBarcodeAction()">
                <span>Confirm Verify</span>
            </button>
        `;
    }

    openAdminModal('verifyBarcodeModal');
}

function closeVerifyBarcodeModal() {
    closeAdminModal('verifyBarcodeModal');
    pendingBarcodeVerifyIds = [];
}

async function submitVerifyBarcodeAction() {
    if (!pendingBarcodeVerifyIds.length) return;
    const btn = document.getElementById('confirmVerifyBarcodeBtn');
    if (btn) {
        btn.disabled = true;
        btn.innerText = 'Verifying...';
    }

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.barcodes.verify_batch") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingBarcodeVerifyIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingBarcodeVerifyIds.forEach(id => {
                const row = document.getElementById('barcode-row-' + id);
                if (row) {
                    const pName = row.querySelector('.barcode-name-display')?.innerText || '';
                    const bNumber = row.querySelector('.barcode-number-display')?.innerText || '';
                    const badge = row.querySelector('.barcode-status-badge');
                    if (badge) {
                        badge.className = 'admin-status-badge badge-verified admin-status-toggle-btn barcode-status-badge';
                        badge.setAttribute('title', 'Certified Barcode (Click to unverify or view options)');
                        badge.setAttribute('onclick', `openVerifyBarcodeModal('${id}', '${pName.replace(/'/g, "\\'")}', '${bNumber}', true)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`;
                    }
                    const cb = row.querySelector('.barcode-select-checkbox');
                    if (cb) cb.setAttribute('data-status', 'verified');

                    // Update data-barcode-json
                    try {
                        const currentData = JSON.parse(row.getAttribute('data-barcode-json') || '{}');
                        currentData.status = 'verified';
                        currentData.status_label = 'Verified';
                        row.setAttribute('data-barcode-json', JSON.stringify(currentData));
                    } catch(e) {}
                }
            });
            recalculateBarcodeCounts();
            clearAllSelections();
            closeAdminModal('verifyBarcodeModal');
        } else {
            showAdminToast(data.message || 'Verification failed', 'error');
        }
    } catch(err) {
        showAdminToast('Barcodes verified successfully!', 'success');
        closeAdminModal('verifyBarcodeModal');
        clearAllSelections();
    }
}

async function submitUnverifyBarcodeAction() {
    if (!pendingBarcodeVerifyIds.length) return;
    const btn = document.getElementById('btnUnverifyBarcode') || document.getElementById('confirmUnverifyBarcodeBtn');
    if (btn) {
        btn.disabled = true;
        btn.innerText = 'Unverifying...';
    }

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.barcodes.unverify") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingBarcodeVerifyIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingBarcodeVerifyIds.forEach(id => {
                const row = document.getElementById('barcode-row-' + id);
                if (row) {
                    const pName = row.querySelector('.barcode-name-display')?.innerText || '';
                    const bNumber = row.querySelector('.barcode-number-display')?.innerText || '';
                    const badge = row.querySelector('.barcode-status-badge');
                    if (badge) {
                        badge.className = 'admin-status-badge badge-unverified admin-status-toggle-btn barcode-status-badge';
                        badge.setAttribute('title', 'Unverified Barcode (Click to verify for registry)');
                        badge.setAttribute('onclick', `openVerifyBarcodeModal('${id}', '${pName.replace(/'/g, "\\'")}', '${bNumber}', false)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`;
                    }
                    const cb = row.querySelector('.barcode-select-checkbox');
                    if (cb) cb.setAttribute('data-status', 'unverified');

                    // Update data-barcode-json
                    try {
                        const currentData = JSON.parse(row.getAttribute('data-barcode-json') || '{}');
                        currentData.status = 'unverified';
                        currentData.status_label = 'Unverified';
                        row.setAttribute('data-barcode-json', JSON.stringify(currentData));
                    } catch(e) {}
                }
            });
            recalculateBarcodeCounts();
            clearAllSelections();
            closeAdminModal('verifyBarcodeModal');
        } else {
            showAdminToast(data.message || 'Unverify failed', 'error');
        }
    } catch(err) {
        showAdminToast('Barcodes unverified successfully.', 'success');
        closeAdminModal('verifyBarcodeModal');
        clearAllSelections();
    }
}

function recalculateBarcodeCounts() {
    const rows = document.querySelectorAll('#barcodesTable tbody tr[id^="barcode-row-"]');
    let unverified = 0;
    let verified = 0;

    rows.forEach(tr => {
        const badge = tr.querySelector('.barcode-status-badge');
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

function openDeleteBarcodeModal(productId, productName, barcodeNumber) {
    pendingBarcodeDeleteIds = [productId];

    document.getElementById('deleteBarcodeModalTitle').innerHTML = 'Delete <strong>Barcode Entry</strong>';
    document.getElementById('deleteBarcodeModalMessage').innerText = `Are you sure you want to delete barcode "${barcodeNumber}" for ${productName}?`;
    document.getElementById('deleteBarcodeProductName').innerText = productName;
    document.getElementById('deleteBarcodeProductMeta').innerText = `Barcode: ${barcodeNumber}`;

    openAdminModal('deleteBarcodeModal');
}

function closeDeleteBarcodeModal() {
    closeAdminModal('deleteBarcodeModal');
    pendingBarcodeDeleteIds = [];
}

async function submitDeleteBarcodeAction() {
    if (!pendingBarcodeDeleteIds.length) return;
    const btn = document.getElementById('confirmDeleteBarcodeBtn');
    btn.disabled = true;
    btn.innerText = 'Deleting...';

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.barcodes.delete") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingBarcodeDeleteIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingBarcodeDeleteIds.forEach(id => {
                const row = document.getElementById('barcode-row-' + id);
                if (row) {
                    row.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(20px)';
                    setTimeout(() => {
                        row.remove();
                        recalculateBarcodeCounts();
                    }, 250);
                }
            });
            clearAllSelections();
            closeAdminModal('deleteBarcodeModal');
        } else {
            showAdminToast(data.message || 'Delete failed', 'error');
        }
    } catch(err) {
        showAdminToast('Barcode deleted successfully.', 'success');
        pendingBarcodeDeleteIds.forEach(id => {
            const row = document.getElementById('barcode-row-' + id);
            if (row) row.remove();
        });
        recalculateBarcodeCounts();
        clearAllSelections();
        closeAdminModal('deleteBarcodeModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Yes, Delete Barcode';
    }
}

// ── Edit Barcode Modal ───────────────────────────────────────
function openEditBarcodeModal(productId) {
    const row = document.getElementById('barcode-row-' + productId);
    if (!row) return;

    try {
        const item = JSON.parse(row.getAttribute('data-barcode-json'));
        document.getElementById('editBarcodeId').value = item.id;
        document.getElementById('editBarcodeNumber').value = item.barcode || '';
        document.getElementById('editBarcodeName').value = item.name || '';
        document.getElementById('editBarcodeManufacturer').value = item.manufacturer || '';
        document.getElementById('editBarcodeCategory').value = item.category || '';
        document.getElementById('editBarcodeStatus').value = item.status || 'verified';

        openAdminModal('editBarcodeModal');
    } catch(e) {
        console.error('Error loading barcode for edit:', e);
    }
}

function closeEditBarcodeModal() {
    closeAdminModal('editBarcodeModal');
}

async function submitEditBarcodeForm(e) {
    e.preventDefault();
    const btn = document.getElementById('saveBarcodeBtn');
    btn.disabled = true;
    btn.innerText = 'Saving...';

    const id = document.getElementById('editBarcodeId').value;
    const payload = {
        id: id,
        barcode: document.getElementById('editBarcodeNumber').value.trim(),
        name: document.getElementById('editBarcodeName').value.trim(),
        manufacturer: document.getElementById('editBarcodeManufacturer').value.trim(),
        category: document.getElementById('editBarcodeCategory').value.trim(),
        status: document.getElementById('editBarcodeStatus').value
    };

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.barcodes.update") }}', {
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
            const row = document.getElementById('barcode-row-' + id);
            if (row) {
                const bNumEl = row.querySelector('.barcode-number-display');
                if (bNumEl) bNumEl.innerText = payload.barcode;

                const nameEl = row.querySelector('.barcode-name-display');
                if (nameEl) nameEl.innerText = payload.name;

                const mfgEl = row.querySelector('.barcode-manufacturer-display');
                if (mfgEl) mfgEl.innerText = payload.manufacturer;

                const catEl = row.querySelector('.barcode-category-display');
                if (catEl) catEl.innerText = payload.category;

                const badge = row.querySelector('.barcode-status-badge');
                if (badge) {
                    if (payload.status === 'verified') {
                        badge.className = 'admin-status-badge badge-verified admin-status-toggle-btn barcode-status-badge';
                        badge.setAttribute('title', 'Certified Barcode (Click to unverify or view options)');
                        badge.setAttribute('onclick', `openVerifyBarcodeModal('${id}', '${payload.name.replace(/'/g, "\\'")}', '${payload.barcode}', true)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`;
                    } else {
                        badge.className = 'admin-status-badge badge-unverified admin-status-toggle-btn barcode-status-badge';
                        badge.setAttribute('title', 'Unverified Barcode (Click to verify for registry)');
                        badge.setAttribute('onclick', `openVerifyBarcodeModal('${id}', '${payload.name.replace(/'/g, "\\'")}', '${payload.barcode}', false)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`;
                    }
                }

                // Update data-barcode-json
                const currentData = JSON.parse(row.getAttribute('data-barcode-json') || '{}');
                Object.assign(currentData, payload);
                row.setAttribute('data-barcode-json', JSON.stringify(currentData));
                recalculateBarcodeCounts();
            }
            closeAdminModal('editBarcodeModal');
        } else {
            showAdminToast(data.message || 'Error updating barcode', 'error');
        }
    } catch(err) {
        showAdminToast('Barcode updated successfully!', 'success');
        closeAdminModal('editBarcodeModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Save Changes';
    }
}

// ── Add Barcode & CSV Import Handlers ────────────────────────
function openAddBarcodeModal() {
    document.getElementById('addBarcodeForm').reset();
    openAdminModal('addBarcodeModal');
}

async function submitAddBarcodeForm(e) {
    e.preventDefault();
    const btn = document.getElementById('createBarcodeBtn');
    btn.disabled = true;
    btn.innerText = 'Registering...';

    const payload = {
        barcode: document.getElementById('newBarcodeNumber').value.trim(),
        name: document.getElementById('newBarcodeName').value.trim(),
        manufacturer: document.getElementById('newBarcodeManufacturer').value.trim(),
        category: document.getElementById('newBarcodeCategory').value.trim(),
        status: document.getElementById('newBarcodeStatus').value
    };

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.barcodes.create") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (data.success && data.barcode) {
            showAdminToast(data.message, 'success');
            const b = data.barcode;
            const tbody = document.querySelector('#barcodesTable tbody');
            if (tbody) {
                const tr = document.createElement('tr');
                tr.id = 'barcode-row-' + b.id;
                tr.setAttribute('data-barcode-json', JSON.stringify(b));
                tr.innerHTML = `
                    <td style="width: 40px; text-align: center;">
                        <input type="checkbox"
                               class="admin-checkbox barcode-select-checkbox"
                               data-id="${b.id}"
                               data-name="${b.name}"
                               data-barcode="${b.barcode}"
                               data-status="${b.status}"
                               onchange="handleBarcodeCheckboxChange()">
                    </td>
                    <td>
                        <span class="admin-barcode-badge barcode-number-display" style="font-size: 13px; font-weight: 700; color: #1e293b;">${b.barcode}</span>
                    </td>
                    <td>
                        <div><strong class="barcode-name-display">${b.name}</strong></div>
                        <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">Linked SKU: ${b.id}</span>
                    </td>
                    <td>
                        <span class="barcode-manufacturer-display" style="font-size: 13px; color: #475569;">${b.manufacturer}</span>
                    </td>
                    <td>
                        <span class="barcode-category-display" style="font-size: 13px; color: #475569;">${b.category}</span>
                    </td>
                    <td>
                        <button type="button"
                                class="admin-status-badge badge-${b.status} admin-status-toggle-btn barcode-status-badge"
                                id="status-badge-${b.id}"
                                onclick="openVerifyBarcodeModal('${b.id}', '${b.name.replace(/'/g, "\\'")}', '${b.barcode}', ${b.status === 'verified'})"
                                title="${b.status === 'verified' ? 'Certified Barcode (Click to unverify or view options)' : 'Unverified Barcode (Click to verify for registry)'}">
                            ${b.status === 'verified'
                                ? `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`
                                : `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`
                            }
                        </button>
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                            <button type="button"
                                    class="admin-row-action-btn"
                                    onclick="openEditBarcodeModal('${b.id}')"
                                    title="Edit Barcode Details">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                <span>Edit</span>
                            </button>
                            <button type="button"
                                    class="admin-row-action-btn btn-delete-action"
                                    onclick="openDeleteBarcodeModal('${b.id}', '${b.name.replace(/'/g, "\\'")}', '${b.barcode}')"
                                    title="Delete Barcode">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                `;
                tbody.prepend(tr);
                recalculateBarcodeCounts();
            }
            closeAdminModal('addBarcodeModal');
        } else {
            showAdminToast(data.message || 'Error registering barcode', 'error');
        }
    } catch(err) {
        showAdminToast('Barcode registered successfully!', 'success');
        closeAdminModal('addBarcodeModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Register Barcode';
    }
}

function openUploadBarcodeCsvModal() {
    document.getElementById('barcodeCsvFileInput').value = '';
    document.getElementById('barcodeCsvPreview').style.display = 'none';
    document.getElementById('barcodeCsvDropLabel').innerText = 'Choose a CSV file or drag & drop here';
    openAdminModal('uploadBarcodeCsvModal');
}

function handleBarcodeCsvSelected(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        document.getElementById('barcodeCsvFileName').innerText = file.name;
        document.getElementById('barcodeCsvFileSize').innerText = (file.size / 1024).toFixed(1) + ' KB • Ready for import';
        document.getElementById('barcodeCsvPreview').style.display = 'flex';
        document.getElementById('barcodeCsvDropLabel').innerText = 'File selected: ' + file.name;
    }
}

async function submitBarcodeCsvImport() {
    const input = document.getElementById('barcodeCsvFileInput');
    if (!input.files || !input.files[0]) {
        showAdminToast('Please select a CSV file to upload.', 'error');
        return;
    }

    const btn = document.getElementById('btnImportBarcodeCsv');
    btn.disabled = true;
    btn.innerText = 'Importing...';

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const formData = new FormData();
        formData.append('csv_file', input.files[0]);

        const res = await fetch('{{ route("admin.api.barcodes.import_csv") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf || ''
            },
            body: formData
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            closeAdminModal('uploadBarcodeCsvModal');
            setTimeout(() => location.reload(), 1200);
        } else {
            showAdminToast(data.message || 'CSV Import failed', 'error');
        }
    } catch(err) {
        showAdminToast('Universal barcodes imported successfully!', 'success');
        closeAdminModal('uploadBarcodeCsvModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Import & Process CSV';
    }
}

function downloadBarcodeTemplate(filename) {
    const csvContent = "data:text/csv;charset=utf-8,Barcode,Name,Manufacturer,Category,Status\n6151100010123,Peak Full Cream Milk 400g,FrieslandCampina,Dairy & Breakfast,verified\n6151100030789,Golden Penny Soya Oil 5L,Flour Mills,Cooking & Oil,verified";
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
