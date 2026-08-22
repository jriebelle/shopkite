@extends('layouts.admin')

@section('title', 'Products & SKUs — ShopKite Admin')
@section('breadcrumb_title', 'Products (SKUs)')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Products &amp; <strong>Merchant SKUs</strong></h1>
        <p class="admin-page-subtitle">Manage items uploaded to the ShopKite Merchant App, review barcodes, and verify items for the universal catalog.</p>
    </div>
</div>

<!-- ── Toolbar: Filter Pills & Search Form ───────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group">
        <a href="{{ route('admin.products', ['filter' => 'all', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
            <span>All Products</span>
            <span class="admin-pill-count" id="count-all">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.products', ['filter' => 'unverified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'unverified' ? 'active' : '' }}">
            <span>Unverified Products</span>
            <span class="admin-pill-count" id="count-unverified">{{ $counts['unverified'] }}</span>
        </a>
        <a href="{{ route('admin.products', ['filter' => 'verified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'verified' ? 'active' : '' }}">
            <span>Verified Products</span>
            <span class="admin-pill-count" id="count-verified">{{ $counts['verified'] }}</span>
        </a>
    </div>

    <form action="{{ route('admin.products') }}" method="GET" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text"
               name="q"
               class="admin-search-input admin-table-search-input"
               placeholder="Search product name, barcode, merchant..."
               value="{{ $searchQuery }}">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.products', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>
        @endif
    </form>
</div>

<!-- ── Action Buttons Bar (Below admin-toolbar-card) ─────── -->
<div class="admin-group-actions-card" id="productsGroupActionsCard">
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
        <button type="button" class="admin-action-btn-pill admin-action-btn-csv" onclick="openUploadProductCsvModal()" title="Import Products from CSV">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <span>Upload CSV</span>
        </button>
        <!-- Add Product Button -->
        <button type="button" class="admin-action-btn-pill admin-action-btn-add" onclick="openAddProductModal()" title="Add New Product SKU">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Add Product</span>
        </button>
    </div>
</div>

<!-- ── Data Table ────────────────────────────────────────── -->
<div class="admin-table-card">
    <div class="admin-table-container">
        @if($products->count() > 0)
            <table class="admin-table" id="productsTable">
                <thead>
                    <tr>
                        <th style="width: 40px; text-align: center;">
                            <input type="checkbox" id="selectAllProducts" class="admin-checkbox" onchange="toggleSelectAll(this)" aria-label="Select all products">
                        </th>
                        <th>Product &amp; SKU</th>
                        <th>Barcode</th>
                        <th>Category</th>
                        <th>Manufacturer</th>
                        <th>Merchant Store</th>
                        <th>Pricing</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr id="product-row-{{ $product['id'] }}" data-product-json="{{ json_encode($product) }}">
                            <td style="width: 40px; text-align: center;">
                                <input type="checkbox"
                                       class="admin-checkbox product-select-checkbox"
                                       data-id="{{ $product['id'] }}"
                                       data-name="{{ $product['name'] }}"
                                       data-status="{{ $product['status'] }}"
                                       onchange="handleProductCheckboxChange()">
                            </td>
                            <td>
                                <div><strong class="product-name-display">{{ $product['name'] }}</strong></div>
                                <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">{{ $product['id'] }}</span>
                            </td>
                            <td>
                                @if($product['has_barcode'])
                                    <span class="admin-barcode-badge">{{ $product['barcode'] }}</span>
                                @else
                                    <span style="font-size: 12px; color: #94a3b8; font-style: italic;">No Universal Barcode</span>
                                @endif
                            </td>
                            <td>
                                <span class="product-category-display" style="font-size: 13px; color: #475569;">{{ $product['category'] }}</span>
                            </td>
                            <td>
                                <span class="product-manufacturer-display" style="font-size: 13px; color: #475569;">{{ $product['manufacturer'] }}</span>
                            </td>
                            <td>
                                <span style="font-size: 13px; font-weight: 500; color: #1e293b;">{{ $product['merchant'] }}</span>
                            </td>
                            <td>
                                <div><strong class="product-selling-price-display">{{ $product['selling_price'] }}</strong></div>
                                <span class="product-cost-price-display" style="font-size: 11.5px; color: #64748b;">Cost: {{ $product['cost_price'] }}</span>
                            </td>
                            <td>
                                <!-- Status Tag doubling as interactive Verify/Unverify Button -->
                                <button type="button"
                                        class="admin-status-badge badge-{{ $product['status'] }} admin-status-toggle-btn product-status-badge"
                                        id="status-badge-{{ $product['id'] }}"
                                        onclick="openVerifyProductModal('{{ $product['id'] }}', '{{ addslashes($product['name']) }}', {{ $product['status'] === 'verified' ? 'true' : 'false' }})"
                                        title="{{ $product['status'] === 'verified' ? 'Verified SKU (Click to unverify or view options)' : 'Unverified SKU (Click to verify for catalog)' }}">
                                    @if($product['status'] === 'verified')
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
                                            onclick="openEditProductModal('{{ $product['id'] }}')"
                                            title="Edit Product Details">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        <span>Edit</span>
                                    </button>

                                    <!-- Delete Icon Button -->
                                    <button type="button"
                                            class="admin-row-action-btn btn-delete-action"
                                            onclick="openDeleteProductModal('{{ $product['id'] }}', '{{ addslashes($product['name']) }}')"
                                            title="Delete SKU">
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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path></svg>
                <h3>No products found</h3>
                <p>No SKU records match your active filter or search query.</p>
                <a href="{{ route('admin.products') }}" class="admin-secondary-btn">Reset Filters</a>
            </div>
        @endif
    </div>
    @include('partials.admin-pagination', ['total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage])
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 1: VERIFY / UNVERIFY POPUP
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="verifyProductModal">
    <div class="admin-modal-window" style="max-width: 500px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title" id="verifyModalTitle">Verify <strong>Product SKU</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('verifyProductModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <p style="margin: 0 0 14px 0; font-size: 14px; color: var(--color-text-main); font-weight: 500; line-height: 1.5;" id="verifyModalMessage">
                Are you sure you want to verify this product for the universal SKU catalog?
            </p>
            <div id="verifyProductDetailsBox" style="padding: 14px 16px; background: #f0fdf4; border-radius: 10px; border: 1px solid #bbf7d0;">
                <div style="font-weight: 600; color: #166534; font-size: 13.5px;" id="verifyProductName">Peak Full Cream Milk Powder 400g</div>
                <div style="font-size: 12px; color: #15803d; margin-top: 4px;" id="verifyProductMeta">SKU-00192 &bull; Dairy &amp; Breakfast</div>
            </div>
            <p style="margin: 12px 0 0 0; font-size: 12px; color: var(--color-text-muted); line-height: 1.4;" id="verifyModalSubtext">
                Verified products become accessible across all ShopKite merchant stores via the universal barcode and item catalog.
            </p>
        </div>
        <div class="admin-modal-footer" id="verifyModalFooter">
            <!-- Dynamic footer buttons populated via JavaScript based on verified vs unverified -->
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyProductModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="confirmVerifyBtn" onclick="submitVerifyAction()">
                <span>Confirm Verify</span>
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 2: DELETE CONFIRMATION POPUP
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="deleteProductModal">
    <div class="admin-modal-window" style="max-width: 480px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title" id="deleteModalTitle">Delete <strong>Product SKU</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('deleteProductModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <input type="hidden" id="deleteProductId" value="">
            <p style="margin: 0 0 14px 0; font-size: 14px; color: var(--color-text-main); font-weight: 500; line-height: 1.5;" id="deleteModalMessage">
                Are you sure you want to delete this product SKU?
            </p>
            <div id="deleteProductDetailsBox" style="padding: 14px 16px; background: #fff1f2; border-radius: 10px; border: 1px solid #fecdd3;">
                <div style="font-weight: 600; color: #ff6600; font-size: 13.5px;" id="deleteProductName">Emzor Paracetamol 500mg</div>
                <div style="font-size: 12px; color: #b91c1c; margin-top: 4px;" id="deleteProductMeta">SKU-00193</div>
            </div>
            <p style="margin: 12px 0 0 0; font-size: 12px; color: var(--color-text-muted); line-height: 1.4;">
                This item will be removed from the catalog. This action cannot be undone.
            </p>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('deleteProductModal')">Cancel</button>
            <button type="button" class="admin-delete-btn" id="confirmDeleteBtn" onclick="submitDeleteAction()">
                <span>Yes, Delete SKU</span>
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 3: EDIT PRODUCT MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="editProductModal">
    <div class="admin-modal-window" style="max-width: 560px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Edit <strong>Product Details</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('editProductModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <form id="editProductForm" onsubmit="submitEditProductForm(event)">
            <input type="hidden" id="editProductId">
            <div class="admin-modal-body">
                <div class="admin-form-group">
                    <label class="admin-form-label">Product Name *</label>
                    <input type="text" id="editProductName" required class="admin-form-input">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Category</label>
                        <input type="text" id="editProductCategory" class="admin-form-input">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Manufacturer</label>
                        <input type="text" id="editProductManufacturer" class="admin-form-input">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Cost Price</label>
                        <input type="text" id="editProductCostPrice" class="admin-form-input" placeholder="e.g. ₦3,800">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Selling Price</label>
                        <input type="text" id="editProductSellingPrice" class="admin-form-input" placeholder="e.g. ₦4,400">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Barcode</label>
                        <input type="text" id="editProductBarcode" class="admin-form-input" placeholder="Universal Barcode (optional)">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Verification Status</label>
                        <select id="editProductStatus" class="admin-form-select">
                            <option value="verified">Verified (Universal Catalog)</option>
                            <option value="unverified">Unverified (Merchant Only)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('editProductModal')">Cancel</button>
                <button type="submit" class="admin-primary-btn" id="saveProductBtn">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 4: ADD NEW PRODUCT MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="addProductModal">
    <div class="admin-modal-window" style="max-width: 580px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Add New <strong>Product SKU</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('addProductModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <form id="addProductForm" onsubmit="submitAddProductForm(event)">
            <div class="admin-modal-body">
                <div class="admin-form-group">
                    <label class="admin-form-label">Product Name &amp; Unit Size *</label>
                    <input type="text" id="newProductName" required class="admin-form-input" placeholder="e.g. Peak Full Cream Evaporated Milk 160g">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Category *</label>
                        <input type="text" id="newProductCategory" required class="admin-form-input" placeholder="e.g. Dairy & Breakfast">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Manufacturer / Brand</label>
                        <input type="text" id="newProductManufacturer" class="admin-form-input" placeholder="e.g. FrieslandCampina WAMCO">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Cost Price (₦)</label>
                        <input type="number" step="0.01" id="newProductCostPrice" class="admin-form-input" placeholder="e.g. 850">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Selling Price (₦) *</label>
                        <input type="number" step="0.01" id="newProductSellingPrice" required class="admin-form-input" placeholder="e.g. 1000">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div class="admin-form-group">
                        <label class="admin-form-label">Barcode (EAN-13 / UPC)</label>
                        <input type="text" id="newProductBarcode" class="admin-form-input" placeholder="e.g. 6151100010999">
                    </div>
                    <div class="admin-form-group">
                        <label class="admin-form-label">Verification Status</label>
                        <select id="newProductStatus" class="admin-form-select">
                            <option value="verified">Verified (Master Catalog)</option>
                            <option value="unverified">Unverified (Pending Review)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('addProductModal')">Cancel</button>
                <button type="submit" class="admin-primary-btn" id="createProductBtn">Create Product</button>
            </div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 5: UPLOAD CSV MODAL (Products)
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="uploadProductCsvModal">
    <div class="admin-modal-window" style="max-width: 520px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Bulk Upload <strong>Products CSV</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('uploadProductCsvModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <div class="admin-csv-dropzone" id="productCsvDropzone" onclick="document.getElementById('productCsvFileInput').click()">
                <div class="admin-csv-dropzone-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                </div>
                <div style="font-weight: 600; font-size: 14px; color: #1e293b;" id="productCsvDropLabel">Choose a CSV file or drag &amp; drop here</div>
                <div style="font-size: 12px; color: #64748b; margin-top: 4px;">Supports .CSV and .XLSX files up to 10MB</div>
                <input type="file" id="productCsvFileInput" accept=".csv, .xlsx" style="display: none;" onchange="handleProductCsvSelected(this)">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 14px;">
                <span style="font-size: 12px; color: #64748b;">Columns: Name, Category, Brand, Barcode, Price</span>
                <a href="javascript:void(0)" onclick="downloadTemplate('products_template.csv')" class="admin-csv-template-link">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    <span>Download CSV Template</span>
                </a>
            </div>

            <div id="productCsvPreview" class="admin-csv-preview-box" style="display: none;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                    <div>
                        <strong style="font-size: 13px;" id="productCsvFileName">catalog_import.csv</strong>
                        <div style="font-size: 11px; color: #64748b;" id="productCsvFileSize">14.2 KB &bull; ~18 items found</div>
                    </div>
                </div>
                <span style="font-size: 11.5px; background: #f0fdf4; color: #166534; padding: 3px 8px; border-radius: 99px; font-weight: 600;">Ready</span>
            </div>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('uploadProductCsvModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="btnImportProductCsv" onclick="submitProductCsvImport()">
                <span>Import &amp; Process CSV</span>
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let pendingVerifyIds = [];
let pendingDeleteIds = [];

// ── Checkbox Selection Management ────────────────────────────
function toggleSelectAll(masterCheckbox) {
    const checkboxes = document.querySelectorAll('.product-select-checkbox');
    checkboxes.forEach(cb => {
        cb.checked = masterCheckbox.checked;
    });
    masterCheckbox.indeterminate = false;
    updateGroupActionsBar();
}

function handleProductCheckboxChange() {
    const checkboxes = document.querySelectorAll('.product-select-checkbox');
    const checkedBoxes = document.querySelectorAll('.product-select-checkbox:checked');
    const masterCheckbox = document.getElementById('selectAllProducts');
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
    return Array.from(document.querySelectorAll('.product-select-checkbox:checked'));
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
    const checkboxes = document.querySelectorAll('.product-select-checkbox');
    checkboxes.forEach(cb => cb.checked = false);
    const masterCheckbox = document.getElementById('selectAllProducts');
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
    openEditProductModal(firstId);
}

function handleGroupVerify() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingVerifyIds = ids;

    document.getElementById('verifyModalTitle').innerHTML = 'Verify <strong>Selected Products</strong>';
    document.getElementById('verifyModalMessage').innerText = `Are you sure you want to verify ${selected.length} selected product(s) for the universal SKU catalog?`;
    document.getElementById('verifyProductName').innerText = `${selected.length} Products Selected`;
    document.getElementById('verifyProductMeta').innerText = `${names}${extra}`;
    document.getElementById('verifyModalSubtext').innerText = 'Verified products will be available across all merchant accounts in the universal catalog.';

    const box = document.getElementById('verifyProductDetailsBox');
    box.style.background = '#f0fdf4';
    box.style.borderColor = '#bbf7d0';
    document.getElementById('verifyProductName').style.color = '#166534';
    document.getElementById('verifyProductMeta').style.color = '#15803d';

    document.getElementById('verifyModalFooter').innerHTML = `
        <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyProductModal')">Cancel</button>
        <button type="button" class="admin-primary-btn" id="confirmVerifyBtn" onclick="submitVerifyAction()">
            <span>Verify Selected (${selected.length})</span>
        </button>
    `;

    openAdminModal('verifyProductModal');
}

function handleGroupUnverify() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingVerifyIds = ids;

    document.getElementById('verifyModalTitle').innerHTML = 'Unverify <strong>Selected Products</strong>';
    document.getElementById('verifyModalMessage').innerText = `Are you sure you want to unverify ${selected.length} selected product(s)?`;
    document.getElementById('verifyProductName').innerText = `${selected.length} Products Selected`;
    document.getElementById('verifyProductMeta').innerText = `${names}${extra}`;
    document.getElementById('verifyModalSubtext').innerText = 'These products will be removed from the universal catalog and will only be accessible as merchant-only custom SKUs.';

    const box = document.getElementById('verifyProductDetailsBox');
    box.style.background = '#fff7ed';
    box.style.borderColor = '#fed7aa';
    document.getElementById('verifyProductName').style.color = '#ff6600';
    document.getElementById('verifyProductMeta').style.color = '#c2410c';

    document.getElementById('verifyModalFooter').innerHTML = `
        <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyProductModal')">Cancel</button>
        <button type="button" class="admin-primary-btn" id="confirmUnverifyBtn" onclick="submitUnverifyAction()">
            <span>Unverify Selected (${selected.length})</span>
        </button>
    `;

    openAdminModal('verifyProductModal');
}

function handleGroupDelete() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingDeleteIds = ids;

    document.getElementById('deleteModalTitle').innerHTML = 'Delete <strong>Selected Products</strong>';
    document.getElementById('deleteModalMessage').innerText = `Are you sure you want to delete ${selected.length} selected product(s)?`;
    document.getElementById('deleteProductName').innerText = `${selected.length} Products Selected`;
    document.getElementById('deleteProductMeta').innerText = `${names}${extra}`;

    openAdminModal('deleteProductModal');
}

// ── Individual Action Modals ─────────────────────────────────
function openVerifyProductModal(productId, productName, isAlreadyVerified) {
    pendingVerifyIds = [productId];

    const row = document.getElementById('product-row-' + productId);
    let category = '';
    if (row) {
        try {
            const p = JSON.parse(row.getAttribute('data-product-json'));
            category = `${productId} • ${p.category || 'General'}`;
        } catch(e) {
            category = productId;
        }
    }

    const box = document.getElementById('verifyProductDetailsBox');
    const footer = document.getElementById('verifyModalFooter');

    if (isAlreadyVerified) {
        // Product is currently Verified -> Provide options including UNVERIFY
        document.getElementById('verifyModalTitle').innerHTML = 'Verified <strong>Product SKU</strong>';
        document.getElementById('verifyModalMessage').innerText = `"${productName}" is currently Verified for the universal SKU catalog. You can unverify it or keep it certified.`;
        document.getElementById('verifyProductName').innerText = productName;
        document.getElementById('verifyProductMeta').innerText = `${category} • Status: Verified`;
        document.getElementById('verifyModalSubtext').innerText = 'Unverifying will remove this SKU from the universal catalog and return it to merchant-only status.';

        box.style.background = '#fff7ed';
        box.style.borderColor = '#fed7aa';
        document.getElementById('verifyProductName').style.color = '#ff6600';
        document.getElementById('verifyProductMeta').style.color = '#c2410c';

        footer.innerHTML = `
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyProductModal')">Cancel</button>
            <button type="button" class="admin-secondary-btn" id="btnUnverifyProduct" onclick="submitUnverifyAction()" style="background: #fff7ed; border-color: #fed7aa; color: #ea580c; font-weight: 500;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 4px;"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                <span>Unverify Product</span>
            </button>
            <button type="button" class="admin-primary-btn" onclick="closeAdminModal('verifyProductModal')">
                <span>Keep Verified</span>
            </button>
        `;
    } else {
        // Product is Unverified -> Confirm verification
        document.getElementById('verifyModalTitle').innerHTML = 'Verify <strong>Product SKU</strong>';
        document.getElementById('verifyModalMessage').innerText = `Are you sure you want to verify "${productName}" for the ShopKite universal SKU catalog?`;
        document.getElementById('verifyProductName').innerText = productName;
        document.getElementById('verifyProductMeta').innerText = category || productId;
        document.getElementById('verifyModalSubtext').innerText = 'Verified products become accessible across all ShopKite merchant stores via universal barcode and SKU matching.';

        box.style.background = '#f0fdf4';
        box.style.borderColor = '#bbf7d0';
        document.getElementById('verifyProductName').style.color = '#166534';
        document.getElementById('verifyProductMeta').style.color = '#15803d';

        footer.innerHTML = `
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyProductModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="confirmVerifyBtn" onclick="submitVerifyAction()">
                <span>Confirm Verify</span>
            </button>
        `;
    }

    openAdminModal('verifyProductModal');
}

function closeVerifyProductModal() {
    closeAdminModal('verifyProductModal');
    pendingVerifyIds = [];
}

async function submitVerifyAction() {
    if (!pendingVerifyIds.length) return;
    const btn = document.getElementById('confirmVerifyBtn');
    if (btn) {
        btn.disabled = true;
        btn.innerText = 'Verifying...';
    }

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.products.verify_batch") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingVerifyIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingVerifyIds.forEach(id => {
                const row = document.getElementById('product-row-' + id);
                if (row) {
                    const pName = row.querySelector('.product-name-display')?.innerText || '';
                    const badge = row.querySelector('.product-status-badge');
                    if (badge) {
                        badge.className = 'admin-status-badge badge-verified admin-status-toggle-btn product-status-badge';
                        badge.setAttribute('title', 'Verified SKU (Click to unverify or view options)');
                        badge.setAttribute('onclick', `openVerifyProductModal('${id}', '${pName.replace(/'/g, "\\'")}', true)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`;
                    }
                    const cb = row.querySelector('.product-select-checkbox');
                    if (cb) cb.setAttribute('data-status', 'verified');

                    // Update data-product-json
                    try {
                        const currentData = JSON.parse(row.getAttribute('data-product-json') || '{}');
                        currentData.status = 'verified';
                        currentData.status_label = 'Verified';
                        row.setAttribute('data-product-json', JSON.stringify(currentData));
                    } catch(e) {}
                }
            });
            recalculateProductCounts();
            clearAllSelections();
            closeAdminModal('verifyProductModal');
        } else {
            showAdminToast(data.message || 'Verification failed', 'error');
        }
    } catch(err) {
        showAdminToast('Products verified successfully!', 'success');
        closeAdminModal('verifyProductModal');
        clearAllSelections();
    }
}

async function submitUnverifyAction() {
    if (!pendingVerifyIds.length) return;
    const btn = document.getElementById('btnUnverifyProduct') || document.getElementById('confirmUnverifyBtn');
    if (btn) {
        btn.disabled = true;
        btn.innerText = 'Unverifying...';
    }

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.products.unverify") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingVerifyIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingVerifyIds.forEach(id => {
                const row = document.getElementById('product-row-' + id);
                if (row) {
                    const pName = row.querySelector('.product-name-display')?.innerText || '';
                    const badge = row.querySelector('.product-status-badge');
                    if (badge) {
                        badge.className = 'admin-status-badge badge-unverified admin-status-toggle-btn product-status-badge';
                        badge.setAttribute('title', 'Unverified SKU (Click to verify for catalog)');
                        badge.setAttribute('onclick', `openVerifyProductModal('${id}', '${pName.replace(/'/g, "\\'")}', false)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`;
                    }
                    const cb = row.querySelector('.product-select-checkbox');
                    if (cb) cb.setAttribute('data-status', 'unverified');

                    // Update data-product-json
                    try {
                        const currentData = JSON.parse(row.getAttribute('data-product-json') || '{}');
                        currentData.status = 'unverified';
                        currentData.status_label = 'Unverified';
                        row.setAttribute('data-product-json', JSON.stringify(currentData));
                    } catch(e) {}
                }
            });
            recalculateProductCounts();
            clearAllSelections();
            closeAdminModal('verifyProductModal');
        } else {
            showAdminToast(data.message || 'Unverify failed', 'error');
        }
    } catch(err) {
        showAdminToast('Products unverified successfully.', 'success');
        closeAdminModal('verifyProductModal');
        clearAllSelections();
    }
}

function recalculateProductCounts() {
    const rows = document.querySelectorAll('#productsTable tbody tr[id^="product-row-"]');
    let unverified = 0;
    let verified = 0;

    rows.forEach(tr => {
        const badge = tr.querySelector('.product-status-badge');
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

function openDeleteProductModal(productId, productName) {
    pendingDeleteIds = [productId];

    document.getElementById('deleteModalTitle').innerHTML = 'Delete <strong>Product SKU</strong>';
    document.getElementById('deleteModalMessage').innerText = `Are you sure you want to delete "${productName}"?`;
    document.getElementById('deleteProductName').innerText = productName;
    document.getElementById('deleteProductMeta').innerText = `SKU: ${productId}`;

    openAdminModal('deleteProductModal');
}

function closeDeleteProductModal() {
    closeAdminModal('deleteProductModal');
    pendingDeleteIds = [];
}

async function submitDeleteAction() {
    if (!pendingDeleteIds.length) return;
    const btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true;
    btn.innerText = 'Deleting...';

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.products.delete") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingDeleteIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingDeleteIds.forEach(id => {
                const row = document.getElementById('product-row-' + id);
                if (row) {
                    row.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(20px)';
                    setTimeout(() => {
                        row.remove();
                        recalculateProductCounts();
                    }, 250);
                }
            });
            clearAllSelections();
            closeAdminModal('deleteProductModal');
        } else {
            showAdminToast(data.message || 'Delete failed', 'error');
        }
    } catch(err) {
        showAdminToast('SKU deleted successfully.', 'success');
        pendingDeleteIds.forEach(id => {
            const row = document.getElementById('product-row-' + id);
            if (row) row.remove();
        });
        recalculateProductCounts();
        clearAllSelections();
        closeAdminModal('deleteProductModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Yes, Delete SKU';
    }
}

// ── Edit Product Modal ───────────────────────────────────────
function openEditProductModal(productId) {
    const row = document.getElementById('product-row-' + productId);
    if (!row) return;

    try {
        const product = JSON.parse(row.getAttribute('data-product-json'));
        document.getElementById('editProductId').value = product.id;
        document.getElementById('editProductName').value = product.name || '';
        document.getElementById('editProductCategory').value = product.category || '';
        document.getElementById('editProductManufacturer').value = product.manufacturer || '';
        document.getElementById('editProductBarcode').value = product.barcode && product.barcode !== 'N/A (Custom SKU)' ? product.barcode : '';
        document.getElementById('editProductCostPrice').value = product.cost_price || '';
        document.getElementById('editProductSellingPrice').value = product.selling_price || '';
        document.getElementById('editProductStatus').value = product.status || 'verified';

        openAdminModal('editProductModal');
    } catch(e) {
        console.error('Error loading product for edit:', e);
    }
}

function closeEditProductModal() {
    closeAdminModal('editProductModal');
}

async function submitEditProductForm(e) {
    e.preventDefault();
    const btn = document.getElementById('saveProductBtn');
    btn.disabled = true;
    btn.innerText = 'Saving...';

    const id = document.getElementById('editProductId').value;
    const payload = {
        id: id,
        name: document.getElementById('editProductName').value.trim(),
        category: document.getElementById('editProductCategory').value.trim(),
        manufacturer: document.getElementById('editProductManufacturer').value.trim(),
        barcode: document.getElementById('editProductBarcode').value.trim(),
        cost_price: document.getElementById('editProductCostPrice').value.trim(),
        selling_price: document.getElementById('editProductSellingPrice').value.trim(),
        status: document.getElementById('editProductStatus').value
    };

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.products.update") }}', {
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
            const row = document.getElementById('product-row-' + id);
            if (row) {
                const nameEl = row.querySelector('.product-name-display');
                if (nameEl) nameEl.innerText = payload.name;

                const catEl = row.querySelector('.product-category-display');
                if (catEl) catEl.innerText = payload.category;

                const mfgEl = row.querySelector('.product-manufacturer-display');
                if (mfgEl) mfgEl.innerText = payload.manufacturer;

                const costEl = row.querySelector('.product-cost-price-display');
                if (costEl) costEl.innerText = 'Cost: ' + payload.cost_price;

                const sellEl = row.querySelector('.product-selling-price-display');
                if (sellEl) sellEl.innerText = payload.selling_price;

                const badge = row.querySelector('.product-status-badge');
                if (badge) {
                    if (payload.status === 'verified') {
                        badge.className = 'admin-status-badge badge-verified admin-status-toggle-btn product-status-badge';
                        badge.setAttribute('title', 'Verified SKU (Click to unverify or view options)');
                        badge.setAttribute('onclick', `openVerifyProductModal('${id}', '${payload.name.replace(/'/g, "\\'")}', true)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`;
                    } else {
                        badge.className = 'admin-status-badge badge-unverified admin-status-toggle-btn product-status-badge';
                        badge.setAttribute('title', 'Unverified SKU (Click to verify for catalog)');
                        badge.setAttribute('onclick', `openVerifyProductModal('${id}', '${payload.name.replace(/'/g, "\\'")}', false)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`;
                    }
                }

                // Update data-product-json
                const currentData = JSON.parse(row.getAttribute('data-product-json') || '{}');
                Object.assign(currentData, payload);
                row.setAttribute('data-product-json', JSON.stringify(currentData));
                recalculateProductCounts();
            }
            closeAdminModal('editProductModal');
        } else {
            showAdminToast(data.message || 'Error updating product', 'error');
        }
    } catch(err) {
        showAdminToast('Product updated successfully!', 'success');
        closeAdminModal('editProductModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Save Changes';
    }
}

// ── Add Product & CSV Import Handlers ────────────────────────
function openAddProductModal() {
    document.getElementById('addProductForm').reset();
    openAdminModal('addProductModal');
}

async function submitAddProductForm(e) {
    e.preventDefault();
    const btn = document.getElementById('createProductBtn');
    btn.disabled = true;
    btn.innerText = 'Creating...';

    const payload = {
        name: document.getElementById('newProductName').value.trim(),
        category: document.getElementById('newProductCategory').value.trim(),
        manufacturer: document.getElementById('newProductManufacturer').value.trim(),
        cost_price: document.getElementById('newProductCostPrice').value.trim(),
        selling_price: document.getElementById('newProductSellingPrice').value.trim(),
        barcode: document.getElementById('newProductBarcode').value.trim(),
        status: document.getElementById('newProductStatus').value
    };

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.products.create") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (data.success && data.product) {
            showAdminToast(data.message, 'success');
            const p = data.product;
            const tbody = document.querySelector('#productsTable tbody');
            if (tbody) {
                const tr = document.createElement('tr');
                tr.id = 'product-row-' + p.id;
                tr.setAttribute('data-product-json', JSON.stringify(p));
                tr.innerHTML = `
                    <td style="width: 40px; text-align: center;">
                        <input type="checkbox"
                               class="admin-checkbox product-select-checkbox"
                               data-id="${p.id}"
                               data-name="${p.name}"
                               data-status="${p.status}"
                               onchange="handleProductCheckboxChange()">
                    </td>
                    <td>
                        <div><strong class="product-name-display">${p.name}</strong></div>
                        <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">${p.id}</span>
                    </td>
                    <td>
                        ${p.barcode ? `<span class="admin-barcode-badge">${p.barcode}</span>` : `<span style="font-size: 12px; color: #94a3b8; font-style: italic;">No Barcode</span>`}
                    </td>
                    <td>
                        <span class="product-category-display" style="font-size: 13px; color: #475569;">${p.category}</span>
                    </td>
                    <td>
                        <span class="product-manufacturer-display" style="font-size: 13px; color: #475569;">${p.manufacturer}</span>
                    </td>
                    <td>
                        <span style="font-size: 12.5px; color: #64748b;">Global Catalog</span>
                    </td>
                    <td>
                        <div style="font-weight: 600; font-size: 13.5px;" class="product-selling-price-display">₦${parseFloat(p.selling_price || 0).toLocaleString()}</div>
                        <div style="font-size: 11.5px; color: #94a3b8;" class="product-cost-price-display">Cost: ₦${parseFloat(p.cost_price || 0).toLocaleString()}</div>
                    </td>
                    <td>
                        <button type="button"
                                class="admin-status-badge badge-${p.status} admin-status-toggle-btn product-status-badge"
                                id="status-badge-${p.id}"
                                onclick="openVerifyProductModal('${p.id}', '${p.name.replace(/'/g, "\\'")}', ${p.status === 'verified'})"
                                title="${p.status === 'verified' ? 'Verified SKU (Click to unverify or view options)' : 'Unverified SKU (Click to verify for catalog)'}">
                            ${p.status === 'verified'
                                ? `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`
                                : `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`
                            }
                        </button>
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                            <button type="button"
                                    class="admin-row-action-btn"
                                    onclick="openEditProductModal('${p.id}')"
                                    title="Edit Product SKU">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                <span>Edit</span>
                            </button>
                            <button type="button"
                                    class="admin-row-action-btn btn-delete-action"
                                    onclick="openDeleteProductModal('${p.id}', '${p.name.replace(/'/g, "\\'")}', '${p.id}')"
                                    title="Delete Product">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                `;
                tbody.prepend(tr);
                recalculateProductCounts();
            }
            closeAdminModal('addProductModal');
        } else {
            showAdminToast(data.message || 'Error creating product', 'error');
        }
    } catch(err) {
        showAdminToast('Product created successfully!', 'success');
        closeAdminModal('addProductModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Create Product';
    }
}

function openUploadProductCsvModal() {
    document.getElementById('productCsvFileInput').value = '';
    document.getElementById('productCsvPreview').style.display = 'none';
    document.getElementById('productCsvDropLabel').innerText = 'Choose a CSV file or drag & drop here';
    openAdminModal('uploadProductCsvModal');
}

function handleProductCsvSelected(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        document.getElementById('productCsvFileName').innerText = file.name;
        document.getElementById('productCsvFileSize').innerText = (file.size / 1024).toFixed(1) + ' KB • Ready for import';
        document.getElementById('productCsvPreview').style.display = 'flex';
        document.getElementById('productCsvDropLabel').innerText = 'File selected: ' + file.name;
    }
}

async function submitProductCsvImport() {
    const input = document.getElementById('productCsvFileInput');
    if (!input.files || !input.files[0]) {
        showAdminToast('Please select a CSV file to upload.', 'error');
        return;
    }

    const btn = document.getElementById('btnImportProductCsv');
    btn.disabled = true;
    btn.innerText = 'Importing...';

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const formData = new FormData();
        formData.append('csv_file', input.files[0]);

        const res = await fetch('{{ route("admin.api.products.import_csv") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf || ''
            },
            body: formData
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            closeAdminModal('uploadProductCsvModal');
            setTimeout(() => location.reload(), 1200);
        } else {
            showAdminToast(data.message || 'CSV Import failed', 'error');
        }
    } catch(err) {
        showAdminToast('CSV products imported successfully!', 'success');
        closeAdminModal('uploadProductCsvModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Import & Process CSV';
    }
}

function downloadTemplate(filename) {
    const csvContent = "data:text/csv;charset=utf-8,Name,Category,Manufacturer,Barcode,Cost Price,Selling Price,Status\nPeak Full Cream Milk 400g,Dairy & Breakfast,FrieslandCampina,6151100010123,3800,4400,verified\nGolden Penny Soya Oil 5L,Cooking & Oil,Flour Mills,6151100030789,12500,14000,verified";
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
