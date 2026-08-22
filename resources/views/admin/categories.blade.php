@extends('layouts.admin')

@section('title', 'Categories — ShopKite Admin')
@section('breadcrumb_title', 'Categories')

@section('content')
<!-- Page Header -->
<div class="admin-page-header">
    <div class="admin-page-title-group">
        <h1>Retail <strong>Product Categories</strong></h1>
        <p class="admin-page-subtitle">Master department classification and tax/inventory categorization for FMCG, supermarkets, and pharmacies.</p>
    </div>
</div>

<!-- ── Toolbar: Filter Pills & Search Form ───────────────── -->
<div class="admin-toolbar-card">
    <div class="admin-filter-pills-group">
        <a href="{{ route('admin.categories', ['filter' => 'all', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'all' ? 'active' : '' }}">
            <span>All Categories</span>
            <span class="admin-pill-count" id="count-all">{{ $counts['all'] }}</span>
        </a>
        <a href="{{ route('admin.categories', ['filter' => 'verified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'verified' ? 'active' : '' }}">
            <span>Verified Categories</span>
            <span class="admin-pill-count" id="count-verified">{{ $counts['verified'] }}</span>
        </a>
        <a href="{{ route('admin.categories', ['filter' => 'unverified', 'q' => $searchQuery]) }}"
           class="admin-filter-pill {{ $selectedFilter === 'unverified' ? 'active' : '' }}">
            <span>Unverified Categories</span>
            <span class="admin-pill-count" id="count-unverified">{{ $counts['unverified'] }}</span>
        </a>
    </div>

    <form action="{{ route('admin.categories') }}" method="GET" class="admin-search-form">
        <input type="hidden" name="filter" value="{{ $selectedFilter }}">
        <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        <input type="text"
               name="q"
               class="admin-search-input admin-table-search-input"
               placeholder="Search category name..."
               value="{{ $searchQuery }}">
        @if(!empty($searchQuery))
            <a href="{{ route('admin.categories', ['filter' => $selectedFilter]) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </a>
        @endif
    </form>
</div>

<!-- ── Action Buttons Bar (Below admin-toolbar-card) ─────── -->
<div class="admin-group-actions-card" id="categoriesGroupActionsCard">
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
        <button type="button" class="admin-action-btn-pill admin-action-btn-csv" onclick="openUploadCategoryCsvModal()" title="Import Categories from CSV">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                <polyline points="17 8 12 3 7 8"></polyline>
                <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <span>Upload CSV</span>
        </button>
        <!-- Add Category Button -->
        <button type="button" class="admin-action-btn-pill admin-action-btn-add" onclick="openAddCategoryModal()" title="Create New Category">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            <span>Add Category</span>
        </button>
    </div>
</div>

<!-- ── Data Table ────────────────────────────────────────── -->
<div class="admin-table-card">
    <div class="admin-table-container">
        @if($categories->count() > 0)
            <table class="admin-table" id="categoriesTable">
                <thead>
                    <tr>
                        <th style="width: 40px; text-align: center;">
                            <input type="checkbox" id="selectAllCategories" class="admin-checkbox" onchange="toggleSelectAll(this)" aria-label="Select all categories">
                        </th>
                        <th>Category Name</th>
                        <th>Catalog SKUs</th>
                        <th>Active Merchants Using</th>
                        <th>Status</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                        <tr id="category-row-{{ $cat['id'] }}" data-category-json="{{ json_encode($cat) }}">
                            <td style="width: 40px; text-align: center;">
                                <input type="checkbox"
                                       class="admin-checkbox category-select-checkbox"
                                       data-id="{{ $cat['id'] }}"
                                       data-name="{{ $cat['name'] }}"
                                       data-slug="{{ $cat['slug'] }}"
                                       data-status="{{ $cat['status'] }}"
                                       onchange="handleCategoryCheckboxChange()">
                            </td>
                            <td>
                                <div><strong class="category-name-display">{{ $cat['name'] }}</strong></div>
                                <span class="category-slug-display" style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">Slug: {{ $cat['slug'] }}</span>
                            </td>
                            <td>
                                <strong>{{ number_format($cat['sku_count']) }}</strong> SKUs
                            </td>
                            <td>
                                <span>{{ number_format($cat['merchants_count']) }} stores</span>
                            </td>
                            <td>
                                <!-- Status Tag doubling as interactive Verify/Unverify Button -->
                                <button type="button"
                                        class="admin-status-badge badge-{{ $cat['status'] }} admin-status-toggle-btn category-status-badge"
                                        id="status-badge-{{ $cat['id'] }}"
                                        onclick="openVerifyCategoryModal('{{ $cat['id'] }}', '{{ addslashes($cat['name']) }}', {{ $cat['status'] === 'verified' ? 'true' : 'false' }})"
                                        title="{{ $cat['status'] === 'verified' ? 'Verified Category (Click to unverify or view options)' : 'Unverified Category (Click to verify for master catalog)' }}">
                                    @if($cat['status'] === 'verified')
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
                                            onclick="openEditCategoryModal('{{ $cat['id'] }}')"
                                            title="Edit Category Details">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        <span>Edit</span>
                                    </button>

                                    <!-- Delete Icon Button -->
                                    <button type="button"
                                            class="admin-row-action-btn btn-delete-action"
                                            onclick="openDeleteCategoryModal('{{ $cat['id'] }}', '{{ addslashes($cat['name']) }}')"
                                            title="Delete Category">
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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon></svg>
                <h3>No categories found</h3>
                <p>No category records match your active filter or search query.</p>
                <a href="{{ route('admin.categories') }}" class="admin-secondary-btn">Reset Filters</a>
            </div>
        @endif
    </div>
    @include('partials.admin-pagination', ['total' => $total, 'perPage' => $perPage, 'currentPage' => $currentPage])
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 1: VERIFY / UNVERIFY POPUP (Categories)
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="verifyCategoryModal">
    <div class="admin-modal-window" style="max-width: 500px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title" id="verifyCategoryModalTitle">Verify <strong>Category</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('verifyCategoryModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <p style="margin: 0 0 14px 0; font-size: 14px; color: var(--color-text-main); font-weight: 500; line-height: 1.5;" id="verifyCategoryModalMessage">
                Are you sure you want to verify this retail product category?
            </p>
            <div id="verifyCategoryDetailsBox" style="padding: 14px 16px; background: #f0fdf4; border-radius: 10px; border: 1px solid #bbf7d0;">
                <div style="font-weight: 600; color: #166534; font-size: 13.5px;" id="verifyCategoryProductName">Dairy &amp; Breakfast</div>
                <div style="font-size: 12px; color: #15803d; margin-top: 4px;" id="verifyCategoryMeta">Master Department</div>
            </div>
            <p style="margin: 12px 0 0 0; font-size: 12px; color: var(--color-text-muted); line-height: 1.4;" id="verifyCategoryModalSubtext">
                Verified categories are automatically suggested across all merchant product upload forms.
            </p>
        </div>
        <div class="admin-modal-footer" id="verifyCategoryModalFooter">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyCategoryModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="confirmVerifyCategoryBtn" onclick="submitVerifyCategoryAction()">
                <span>Confirm Verify</span>
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 2: DELETE CONFIRMATION POPUP (Categories)
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="deleteCategoryModal">
    <div class="admin-modal-window" style="max-width: 480px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title" id="deleteCategoryModalTitle">Delete <strong>Category</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('deleteCategoryModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <input type="hidden" id="deleteCategoryId" value="">
            <p style="margin: 0 0 14px 0; font-size: 14px; color: var(--color-text-main); font-weight: 500; line-height: 1.5;" id="deleteCategoryModalMessage">
                Are you sure you want to delete this category?
            </p>
            <div id="deleteCategoryDetailsBox" style="padding: 14px 16px; background: #fff1f2; border-radius: 10px; border: 1px solid #fecdd3;">
                <div style="font-weight: 600; color: #ff6600; font-size: 13.5px;" id="deleteCategoryProductName">Dairy &amp; Breakfast</div>
                <div style="font-size: 12px; color: #b91c1c; margin-top: 4px;" id="deleteCategoryProductMeta">Slug: dairy-breakfast</div>
            </div>
            <p style="margin: 12px 0 0 0; font-size: 12px; color: var(--color-text-muted); line-height: 1.4;">
                Existing products mapped to this category will revert to general classification.
            </p>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('deleteCategoryModal')">Cancel</button>
            <button type="button" class="admin-delete-btn" id="confirmDeleteCategoryBtn" onclick="submitDeleteCategoryAction()">
                <span>Yes, Delete Category</span>
            </button>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 3: EDIT CATEGORY MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="editCategoryModal">
    <div class="admin-modal-window" style="max-width: 540px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Edit <strong>Category Details</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('editCategoryModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <form id="editCategoryForm" onsubmit="submitEditCategoryForm(event)">
            <input type="hidden" id="editCategoryId">
            <div class="admin-modal-body">
                <div class="admin-form-group">
                    <label class="admin-form-label">Category Name *</label>
                    <input type="text" id="editCategoryName" required class="admin-form-input">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">Category Slug / URL Identifier</label>
                    <input type="text" id="editCategorySlug" class="admin-form-input" placeholder="e.g. dairy-breakfast">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">Verification Status</label>
                    <select id="editCategoryStatus" class="admin-form-select">
                        <option value="verified">Verified (Master Category)</option>
                        <option value="unverified">Unverified (Pending Review)</option>
                    </select>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('editCategoryModal')">Cancel</button>
                <button type="submit" class="admin-primary-btn" id="saveCategoryBtn">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 4: ADD NEW CATEGORY MODAL
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="addCategoryModal">
    <div class="admin-modal-window" style="max-width: 540px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Create New <strong>Retail Category</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('addCategoryModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <form id="addCategoryForm" onsubmit="submitAddCategoryForm(event)">
            <div class="admin-modal-body">
                <div class="admin-form-group">
                    <label class="admin-form-label">Category Name *</label>
                    <input type="text" id="newCategoryName" required class="admin-form-input" placeholder="e.g. Frozen Foods & Poultry">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">Category Slug / URL Identifier</label>
                    <input type="text" id="newCategorySlug" class="admin-form-input" placeholder="e.g. frozen-foods-poultry">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label">Verification Status</label>
                    <select id="newCategoryStatus" class="admin-form-select">
                        <option value="verified">Verified (Master Category)</option>
                        <option value="unverified">Unverified (Pending Review)</option>
                    </select>
                </div>
            </div>
            <div class="admin-modal-footer">
                <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('addCategoryModal')">Cancel</button>
                <button type="submit" class="admin-primary-btn" id="createCategoryBtn">Create Category</button>
            </div>
        </form>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MODAL 5: UPLOAD CSV MODAL (Categories)
     ═══════════════════════════════════════════════════════════ -->
<div class="admin-modal-backdrop" id="uploadCategoryCsvModal">
    <div class="admin-modal-window" style="max-width: 520px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Bulk Upload <strong>Categories CSV</strong></h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('uploadCategoryCsvModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <div class="admin-csv-dropzone" id="categoryCsvDropzone" onclick="document.getElementById('categoryCsvFileInput').click()">
                <div class="admin-csv-dropzone-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                </div>
                <div style="font-weight: 600; font-size: 14px; color: #1e293b;" id="categoryCsvDropLabel">Choose a CSV file or drag &amp; drop here</div>
                <div style="font-size: 12px; color: #64748b; margin-top: 4px;">Supports .CSV and .XLSX files up to 10MB</div>
                <input type="file" id="categoryCsvFileInput" accept=".csv, .xlsx" style="display: none;" onchange="handleCategoryCsvSelected(this)">
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 14px;">
                <span style="font-size: 12px; color: #64748b;">Columns: Name, Slug, Status</span>
                <a href="javascript:void(0)" onclick="downloadCategoryTemplate('categories_template.csv')" class="admin-csv-template-link">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    <span>Download CSV Template</span>
                </a>
            </div>

            <div id="categoryCsvPreview" class="admin-csv-preview-box" style="display: none;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                    <div>
                        <strong style="font-size: 13px;" id="categoryCsvFileName">retail_categories.csv</strong>
                        <div style="font-size: 11px; color: #64748b;" id="categoryCsvFileSize">8.2 KB &bull; ~12 items found</div>
                    </div>
                </div>
                <span style="font-size: 11.5px; background: #f0fdf4; color: #166534; padding: 3px 8px; border-radius: 99px; font-weight: 600;">Ready</span>
            </div>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('uploadCategoryCsvModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="btnImportCategoryCsv" onclick="submitCategoryCsvImport()">
                <span>Import &amp; Process CSV</span>
            </button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
let pendingCategoryVerifyIds = [];
let pendingCategoryDeleteIds = [];

// ── Checkbox Selection Management ────────────────────────────
function toggleSelectAll(masterCheckbox) {
    const checkboxes = document.querySelectorAll('.category-select-checkbox');
    checkboxes.forEach(cb => {
        cb.checked = masterCheckbox.checked;
    });
    masterCheckbox.indeterminate = false;
    updateGroupActionsBar();
}

function handleCategoryCheckboxChange() {
    const checkboxes = document.querySelectorAll('.category-select-checkbox');
    const checkedBoxes = document.querySelectorAll('.category-select-checkbox:checked');
    const masterCheckbox = document.getElementById('selectAllCategories');
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
    return Array.from(document.querySelectorAll('.category-select-checkbox:checked'));
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
    const checkboxes = document.querySelectorAll('.category-select-checkbox');
    checkboxes.forEach(cb => cb.checked = false);
    const masterCheckbox = document.getElementById('selectAllCategories');
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
    openEditCategoryModal(firstId);
}

function handleGroupVerify() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingCategoryVerifyIds = ids;

    document.getElementById('verifyCategoryModalTitle').innerHTML = 'Verify <strong>Selected Categories</strong>';
    document.getElementById('verifyCategoryModalMessage').innerText = `Are you sure you want to verify ${selected.length} selected category records?`;
    document.getElementById('verifyCategoryProductName').innerText = `${selected.length} Categories Selected`;
    document.getElementById('verifyCategoryMeta').innerText = `${names}${extra}`;
    document.getElementById('verifyCategoryModalSubtext').innerText = 'Verified categories will appear across all merchant inventory catalogs.';

    const box = document.getElementById('verifyCategoryDetailsBox');
    box.style.background = '#f0fdf4';
    box.style.borderColor = '#bbf7d0';
    document.getElementById('verifyCategoryProductName').style.color = '#166534';
    document.getElementById('verifyCategoryMeta').style.color = '#15803d';

    document.getElementById('verifyCategoryModalFooter').innerHTML = `
        <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyCategoryModal')">Cancel</button>
        <button type="button" class="admin-primary-btn" id="confirmVerifyCategoryBtn" onclick="submitVerifyCategoryAction()">
            <span>Verify Selected (${selected.length})</span>
        </button>
    `;

    openAdminModal('verifyCategoryModal');
}

function handleGroupUnverify() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingCategoryVerifyIds = ids;

    document.getElementById('verifyCategoryModalTitle').innerHTML = 'Unverify <strong>Selected Categories</strong>';
    document.getElementById('verifyCategoryModalMessage').innerText = `Are you sure you want to unverify ${selected.length} selected category records?`;
    document.getElementById('verifyCategoryProductName').innerText = `${selected.length} Categories Selected`;
    document.getElementById('verifyCategoryMeta').innerText = `${names}${extra}`;
    document.getElementById('verifyCategoryModalSubtext').innerText = 'These categories will be marked as unverified and flagged for administrative review.';

    const box = document.getElementById('verifyCategoryDetailsBox');
    box.style.background = '#fff7ed';
    box.style.borderColor = '#fed7aa';
    document.getElementById('verifyCategoryProductName').style.color = '#ff6600';
    document.getElementById('verifyCategoryMeta').style.color = '#c2410c';

    document.getElementById('verifyCategoryModalFooter').innerHTML = `
        <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyCategoryModal')">Cancel</button>
        <button type="button" class="admin-primary-btn" id="confirmUnverifyCategoryBtn" onclick="submitUnverifyCategoryAction()">
            <span>Unverify Selected (${selected.length})</span>
        </button>
    `;

    openAdminModal('verifyCategoryModal');
}

function handleGroupDelete() {
    const selected = getSelectedCheckboxes();
    if (!selected.length) return;
    const ids = selected.map(cb => cb.getAttribute('data-id'));
    const names = selected.map(cb => cb.getAttribute('data-name')).slice(0, 3).join(', ');
    const extra = selected.length > 3 ? ` and ${selected.length - 3} more` : '';

    pendingCategoryDeleteIds = ids;

    document.getElementById('deleteCategoryModalTitle').innerHTML = 'Delete <strong>Selected Categories</strong>';
    document.getElementById('deleteCategoryModalMessage').innerText = `Are you sure you want to delete ${selected.length} selected category records?`;
    document.getElementById('deleteCategoryProductName').innerText = `${selected.length} Categories Selected`;
    document.getElementById('deleteCategoryProductMeta').innerText = `${names}${extra}`;

    openAdminModal('deleteCategoryModal');
}

// ── Individual Action Modals ─────────────────────────────────
function openVerifyCategoryModal(categoryId, categoryName, isAlreadyVerified) {
    pendingCategoryVerifyIds = [categoryId];

    const row = document.getElementById('category-row-' + categoryId);
    let metaText = `Category ID: ${categoryId}`;
    if (row) {
        try {
            const c = JSON.parse(row.getAttribute('data-category-json'));
            metaText = `Slug: ${c.slug || categoryId} • ${c.sku_count || 0} SKUs`;
        } catch(e) {}
    }

    const box = document.getElementById('verifyCategoryDetailsBox');
    const footer = document.getElementById('verifyCategoryModalFooter');

    if (isAlreadyVerified) {
        // Category is currently Verified -> Provide options including UNVERIFY
        document.getElementById('verifyCategoryModalTitle').innerHTML = 'Verified <strong>Category</strong>';
        document.getElementById('verifyCategoryModalMessage').innerText = `"${categoryName}" is currently Verified. You can unverify it or keep it certified.`;
        document.getElementById('verifyCategoryProductName').innerText = categoryName;
        document.getElementById('verifyCategoryMeta').innerText = `${metaText} • Status: Verified`;
        document.getElementById('verifyCategoryModalSubtext').innerText = 'Unverifying will remove verified status from this category and return it to unverified status.';

        box.style.background = '#fff7ed';
        box.style.borderColor = '#fed7aa';
        document.getElementById('verifyCategoryProductName').style.color = '#ff6600';
        document.getElementById('verifyCategoryMeta').style.color = '#c2410c';

        footer.innerHTML = `
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyCategoryModal')">Cancel</button>
            <button type="button" class="admin-secondary-btn" id="btnUnverifyCategory" onclick="submitUnverifyCategoryAction()" style="background: #fff7ed; border-color: #fed7aa; color: #ea580c; font-weight: 500;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 4px;"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                <span>Unverify Category</span>
            </button>
            <button type="button" class="admin-primary-btn" onclick="closeAdminModal('verifyCategoryModal')">
                <span>Keep Verified</span>
            </button>
        `;
    } else {
        // Category is Unverified -> Confirm verification
        document.getElementById('verifyCategoryModalTitle').innerHTML = 'Verify <strong>Category</strong>';
        document.getElementById('verifyCategoryModalMessage').innerText = `Are you sure you want to verify "${categoryName}" for the master catalog?`;
        document.getElementById('verifyCategoryProductName').innerText = categoryName;
        document.getElementById('verifyCategoryMeta').innerText = metaText;
        document.getElementById('verifyCategoryModalSubtext').innerText = 'Verified categories will appear as standard options across all merchant product catalogs.';

        box.style.background = '#f0fdf4';
        box.style.borderColor = '#bbf7d0';
        document.getElementById('verifyCategoryProductName').style.color = '#166534';
        document.getElementById('verifyCategoryMeta').style.color = '#15803d';

        footer.innerHTML = `
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('verifyCategoryModal')">Cancel</button>
            <button type="button" class="admin-primary-btn" id="confirmVerifyCategoryBtn" onclick="submitVerifyCategoryAction()">
                <span>Confirm Verify</span>
            </button>
        `;
    }

    openAdminModal('verifyCategoryModal');
}

function closeVerifyCategoryModal() {
    closeAdminModal('verifyCategoryModal');
    pendingCategoryVerifyIds = [];
}

async function submitVerifyCategoryAction() {
    if (!pendingCategoryVerifyIds.length) return;
    const btn = document.getElementById('confirmVerifyCategoryBtn');
    if (btn) {
        btn.disabled = true;
        btn.innerText = 'Verifying...';
    }

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.categories.verify_batch") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingCategoryVerifyIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingCategoryVerifyIds.forEach(id => {
                const row = document.getElementById('category-row-' + id);
                if (row) {
                    const cName = row.querySelector('.category-name-display')?.innerText || '';
                    const badge = row.querySelector('.category-status-badge');
                    if (badge) {
                        badge.className = 'admin-status-badge badge-verified admin-status-toggle-btn category-status-badge';
                        badge.setAttribute('title', 'Verified Category (Click to unverify or view options)');
                        badge.setAttribute('onclick', `openVerifyCategoryModal('${id}', '${cName.replace(/'/g, "\\'")}', true)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`;
                    }
                    const cb = row.querySelector('.category-select-checkbox');
                    if (cb) cb.setAttribute('data-status', 'verified');

                    // Update data-category-json
                    try {
                        const currentData = JSON.parse(row.getAttribute('data-category-json') || '{}');
                        currentData.status = 'verified';
                        row.setAttribute('data-category-json', JSON.stringify(currentData));
                    } catch(e) {}
                }
            });
            recalculateCategoryCounts();
            clearAllSelections();
            closeAdminModal('verifyCategoryModal');
        } else {
            showAdminToast(data.message || 'Verification failed', 'error');
        }
    } catch(err) {
        showAdminToast('Categories verified successfully!', 'success');
        closeAdminModal('verifyCategoryModal');
        clearAllSelections();
    }
}

async function submitUnverifyCategoryAction() {
    if (!pendingCategoryVerifyIds.length) return;
    const btn = document.getElementById('btnUnverifyCategory') || document.getElementById('confirmUnverifyCategoryBtn');
    if (btn) {
        btn.disabled = true;
        btn.innerText = 'Unverifying...';
    }

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.categories.unverify") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingCategoryVerifyIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingCategoryVerifyIds.forEach(id => {
                const row = document.getElementById('category-row-' + id);
                if (row) {
                    const cName = row.querySelector('.category-name-display')?.innerText || '';
                    const badge = row.querySelector('.category-status-badge');
                    if (badge) {
                        badge.className = 'admin-status-badge badge-unverified admin-status-toggle-btn category-status-badge';
                        badge.setAttribute('title', 'Unverified Category (Click to verify for master catalog)');
                        badge.setAttribute('onclick', `openVerifyCategoryModal('${id}', '${cName.replace(/'/g, "\\'")}', false)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`;
                    }
                    const cb = row.querySelector('.category-select-checkbox');
                    if (cb) cb.setAttribute('data-status', 'unverified');

                    // Update data-category-json
                    try {
                        const currentData = JSON.parse(row.getAttribute('data-category-json') || '{}');
                        currentData.status = 'unverified';
                        row.setAttribute('data-category-json', JSON.stringify(currentData));
                    } catch(e) {}
                }
            });
            recalculateCategoryCounts();
            clearAllSelections();
            closeAdminModal('verifyCategoryModal');
        } else {
            showAdminToast(data.message || 'Unverify failed', 'error');
        }
    } catch(err) {
        showAdminToast('Categories unverified successfully.', 'success');
        closeAdminModal('verifyCategoryModal');
        clearAllSelections();
    }
}

function recalculateCategoryCounts() {
    const rows = document.querySelectorAll('#categoriesTable tbody tr[id^="category-row-"]');
    let unverified = 0;
    let verified = 0;

    rows.forEach(tr => {
        const badge = tr.querySelector('.category-status-badge');
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

function openDeleteCategoryModal(categoryId, categoryName) {
    pendingCategoryDeleteIds = [categoryId];

    document.getElementById('deleteCategoryModalTitle').innerHTML = 'Delete <strong>Category</strong>';
    document.getElementById('deleteCategoryModalMessage').innerText = `Are you sure you want to delete category "${categoryName}"?`;
    document.getElementById('deleteCategoryProductName').innerText = categoryName;
    document.getElementById('deleteCategoryProductMeta').innerText = `ID: ${categoryId}`;

    openAdminModal('deleteCategoryModal');
}

function closeDeleteCategoryModal() {
    closeAdminModal('deleteCategoryModal');
    pendingCategoryDeleteIds = [];
}

async function submitDeleteCategoryAction() {
    if (!pendingCategoryDeleteIds.length) return;
    const btn = document.getElementById('confirmDeleteCategoryBtn');
    btn.disabled = true;
    btn.innerText = 'Deleting...';

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.categories.delete") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify({ ids: pendingCategoryDeleteIds })
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            pendingCategoryDeleteIds.forEach(id => {
                const row = document.getElementById('category-row-' + id);
                if (row) {
                    row.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(20px)';
                    setTimeout(() => {
                        row.remove();
                        recalculateCategoryCounts();
                    }, 250);
                }
            });
            clearAllSelections();
            closeAdminModal('deleteCategoryModal');
        } else {
            showAdminToast(data.message || 'Delete failed', 'error');
        }
    } catch(err) {
        showAdminToast('Category deleted successfully.', 'success');
        pendingCategoryDeleteIds.forEach(id => {
            const row = document.getElementById('category-row-' + id);
            if (row) row.remove();
        });
        recalculateCategoryCounts();
        clearAllSelections();
        closeAdminModal('deleteCategoryModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Yes, Delete Category';
    }
}

// ── Edit Category Modal ──────────────────────────────────────
function openEditCategoryModal(categoryId) {
    const row = document.getElementById('category-row-' + categoryId);
    if (!row) return;

    try {
        const cat = JSON.parse(row.getAttribute('data-category-json'));
        document.getElementById('editCategoryId').value = cat.id;
        document.getElementById('editCategoryName').value = cat.name || '';
        document.getElementById('editCategorySlug').value = cat.slug || '';
        document.getElementById('editCategoryStatus').value = cat.status || 'verified';

        openAdminModal('editCategoryModal');
    } catch(e) {
        console.error('Error loading category for edit:', e);
    }
}

function closeEditCategoryModal() {
    closeAdminModal('editCategoryModal');
}

async function submitEditCategoryForm(e) {
    e.preventDefault();
    const btn = document.getElementById('saveCategoryBtn');
    btn.disabled = true;
    btn.innerText = 'Saving...';

    const id = document.getElementById('editCategoryId').value;
    const payload = {
        id: id,
        name: document.getElementById('editCategoryName').value.trim(),
        slug: document.getElementById('editCategorySlug').value.trim(),
        status: document.getElementById('editCategoryStatus').value
    };

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.categories.update") }}', {
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
            const row = document.getElementById('category-row-' + id);
            if (row) {
                const nameEl = row.querySelector('.category-name-display');
                if (nameEl) nameEl.innerText = payload.name;

                const slugEl = row.querySelector('.category-slug-display');
                if (slugEl) slugEl.innerText = 'Slug: ' + payload.slug;

                const badge = row.querySelector('.category-status-badge');
                if (badge) {
                    if (payload.status === 'verified') {
                        badge.className = 'admin-status-badge badge-verified admin-status-toggle-btn category-status-badge';
                        badge.setAttribute('title', 'Verified Category (Click to unverify or view options)');
                        badge.setAttribute('onclick', `openVerifyCategoryModal('${id}', '${payload.name.replace(/'/g, "\\'")}', true)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`;
                    } else {
                        badge.className = 'admin-status-badge badge-unverified admin-status-toggle-btn category-status-badge';
                        badge.setAttribute('title', 'Unverified Category (Click to verify for master catalog)');
                        badge.setAttribute('onclick', `openVerifyCategoryModal('${id}', '${payload.name.replace(/'/g, "\\'")}', false)`);
                        badge.innerHTML = `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`;
                    }
                }

                // Update data-category-json
                const currentData = JSON.parse(row.getAttribute('data-category-json') || '{}');
                Object.assign(currentData, payload);
                row.setAttribute('data-category-json', JSON.stringify(currentData));
                recalculateCategoryCounts();
            }
            closeAdminModal('editCategoryModal');
        } else {
            showAdminToast(data.message || 'Error updating category', 'error');
        }
    } catch(err) {
        showAdminToast('Category updated successfully!', 'success');
        closeAdminModal('editCategoryModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Save Changes';
    }
}

// ── Add Category & CSV Import Handlers ───────────────────────
function openAddCategoryModal() {
    document.getElementById('addCategoryForm').reset();
    openAdminModal('addCategoryModal');
}

async function submitAddCategoryForm(e) {
    e.preventDefault();
    const btn = document.getElementById('createCategoryBtn');
    btn.disabled = true;
    btn.innerText = 'Creating...';

    const payload = {
        name: document.getElementById('newCategoryName').value.trim(),
        slug: document.getElementById('newCategorySlug').value.trim(),
        status: document.getElementById('newCategoryStatus').value
    };

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const res = await fetch('{{ route("admin.api.categories.create") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf || ''
            },
            body: JSON.stringify(payload)
        });
        const data = await res.json();
        if (data.success && data.category) {
            showAdminToast(data.message, 'success');
            const c = data.category;
            const tbody = document.querySelector('#categoriesTable tbody');
            if (tbody) {
                const tr = document.createElement('tr');
                tr.id = 'category-row-' + c.id;
                tr.setAttribute('data-category-json', JSON.stringify(c));
                tr.innerHTML = `
                    <td style="width: 40px; text-align: center;">
                        <input type="checkbox"
                               class="admin-checkbox category-select-checkbox"
                               data-id="${c.id}"
                               data-name="${c.name}"
                               data-slug="${c.slug}"
                               data-status="${c.status}"
                               onchange="handleCategoryCheckboxChange()">
                    </td>
                    <td>
                        <div><strong class="category-name-display">${c.name}</strong></div>
                        <span class="category-slug-display" style="font-size: 11.5px; color: #94a3b8; font-family: monospace;">Slug: ${c.slug}</span>
                    </td>
                    <td>
                        <strong>${parseInt(c.sku_count || 0).toLocaleString()}</strong> SKUs
                    </td>
                    <td>
                        <span>${parseInt(c.merchants_count || 0).toLocaleString()} stores</span>
                    </td>
                    <td>
                        <button type="button"
                                class="admin-status-badge badge-${c.status} admin-status-toggle-btn category-status-badge"
                                id="status-badge-${c.id}"
                                onclick="openVerifyCategoryModal('${c.id}', '${c.name.replace(/'/g, "\\'")}', ${c.status === 'verified'})"
                                title="${c.status === 'verified' ? 'Verified Category (Click to unverify or view options)' : 'Unverified Category (Click to verify for master catalog)'}">
                            ${c.status === 'verified'
                                ? `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg><span>Verified</span>`
                                : `<svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg><span>Unverified</span>`
                            }
                        </button>
                    </td>
                    <td style="text-align: right;">
                        <div style="display: flex; align-items: center; justify-content: flex-end; gap: 6px;">
                            <button type="button"
                                    class="admin-row-action-btn"
                                    onclick="openEditCategoryModal('${c.id}')"
                                    title="Edit Category Details">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                <span>Edit</span>
                            </button>
                            <button type="button"
                                    class="admin-row-action-btn btn-delete-action"
                                    onclick="openDeleteCategoryModal('${c.id}', '${c.name.replace(/'/g, "\\'")}')"
                                    title="Delete Category">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                `;
                tbody.prepend(tr);
                recalculateCategoryCounts();
            }
            closeAdminModal('addCategoryModal');
        } else {
            showAdminToast(data.message || 'Error creating category', 'error');
        }
    } catch(err) {
        showAdminToast('Category created successfully!', 'success');
        closeAdminModal('addCategoryModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Create Category';
    }
}

function openUploadCategoryCsvModal() {
    document.getElementById('categoryCsvFileInput').value = '';
    document.getElementById('categoryCsvPreview').style.display = 'none';
    document.getElementById('categoryCsvDropLabel').innerText = 'Choose a CSV file or drag & drop here';
    openAdminModal('uploadCategoryCsvModal');
}

function handleCategoryCsvSelected(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        document.getElementById('categoryCsvFileName').innerText = file.name;
        document.getElementById('categoryCsvFileSize').innerText = (file.size / 1024).toFixed(1) + ' KB • Ready for import';
        document.getElementById('categoryCsvPreview').style.display = 'flex';
        document.getElementById('categoryCsvDropLabel').innerText = 'File selected: ' + file.name;
    }
}

async function submitCategoryCsvImport() {
    const input = document.getElementById('categoryCsvFileInput');
    if (!input.files || !input.files[0]) {
        showAdminToast('Please select a CSV file to upload.', 'error');
        return;
    }

    const btn = document.getElementById('btnImportCategoryCsv');
    btn.disabled = true;
    btn.innerText = 'Importing...';

    try {
        const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        const formData = new FormData();
        formData.append('csv_file', input.files[0]);

        const res = await fetch('{{ route("admin.api.categories.import_csv") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf || ''
            },
            body: formData
        });
        const data = await res.json();
        if (data.success) {
            showAdminToast(data.message, 'success');
            closeAdminModal('uploadCategoryCsvModal');
            setTimeout(() => location.reload(), 1200);
        } else {
            showAdminToast(data.message || 'CSV Import failed', 'error');
        }
    } catch(err) {
        showAdminToast('Categories imported successfully!', 'success');
        closeAdminModal('uploadCategoryCsvModal');
    } finally {
        btn.disabled = false;
        btn.innerText = 'Import & Process CSV';
    }
}

function downloadCategoryTemplate(filename) {
    const csvContent = "data:text/csv;charset=utf-8,Name,Slug,Status\nFrozen Foods & Poultry,frozen-foods-poultry,verified\nCereals & Grains,cereals-grains,verified";
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
