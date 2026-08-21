@extends('layouts.admin')

@section('title', 'FAQs Management — ShopKite Admin')
@section('breadcrumb_title', 'FAQs')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/faq.css') }}?v={{ filemtime(public_path('css/faq.css')) }}">
@endsection

@section('content')

<!-- ═══════════════════════════════════════════════════════════
     VIEW 1: FAQ ARTICLES & QUESTIONS LIST VIEW
     ═══════════════════════════════════════════════════════════ -->
<div id="faqListView">
    <!-- Page Header -->
    <div class="admin-page-header">
        <div class="admin-page-title-group">
            <h1>Frequently Asked <strong>Questions Manager</strong></h1>
            <p class="admin-page-subtitle">Update point for questions and answers displayed on the public <a href="{{ route('faq') }}" target="_blank" style="color: #ff6600; text-decoration: underline;">ShopKite FAQ Page</a>.</p>
        </div>
        <div class="admin-header-actions">
            <button type="button" class="admin-primary-btn" onclick="openFaqEditor(null)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Add New FAQ</span>
            </button>
        </div>
    </div>

    <!-- ── Toolbar: Category Filters & Search ────────────────── -->
    <div class="admin-toolbar-card">
        <div class="admin-filter-pills-group">
            <a href="{{ route('admin.faqs', ['category' => 'all', 'q' => $searchQuery]) }}"
               class="admin-filter-pill {{ $selectedCategory === 'all' ? 'active' : '' }}">
                <span>All Categories</span>
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('admin.faqs', ['category' => $cat, 'q' => $searchQuery]) }}"
                   class="admin-filter-pill {{ $selectedCategory === $cat ? 'active' : '' }}">
                    <span>{{ $cat }}</span>
                </a>
            @endforeach
        </div>

        <form action="{{ route('admin.faqs') }}" method="GET" class="admin-search-form">
            @if($selectedCategory !== 'all')
                <input type="hidden" name="category" value="{{ $selectedCategory }}">
            @endif
            <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text"
                   name="q"
                   class="admin-search-input"
                   placeholder="Search question or answer..."
                   value="{{ $searchQuery }}">
            @if(!empty($searchQuery))
                <a href="{{ route('admin.faqs', $selectedCategory !== 'all' ? ['category' => $selectedCategory] : []) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </a>
            @endif
        </form>
    </div>

    <!-- ── FAQ Cards Grid ────────────────────────────────────── -->
    <div class="admin-faqs-grid" id="faqsGridContainer">
        @if($faqs->count() > 0)
            @foreach($faqs as $faq)
                <div class="admin-faq-card" id="faq-card-{{ $faq['id'] }}">
                    <div class="admin-faq-card-content">
                        <div class="admin-faq-category" id="faq-category-{{ $faq['id'] }}">{{ $faq['category'] }}</div>
                        <h3 class="admin-faq-question" id="faq-question-{{ $faq['id'] }}">{{ $faq['question'] }}</h3>
                        <p class="admin-faq-answer" id="faq-answer-{{ $faq['id'] }}">
                            {{ \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags(preg_replace('/<[^>]+>/', ' $0 ', $faq['answer'])))), 120) }}
                        </p>
                        <div style="margin-top: 14px; font-size: 11.5px; color: #94a3b8;">
                            <span>Last updated: <span id="faq-date-{{ $faq['id'] }}">{{ $faq['updated_at'] }}</span></span>
                        </div>
                    </div>

                    <div class="admin-action-btn-group" style="align-items: flex-start; gap: 8px;">
                        <button type="button"
                                class="admin-secondary-btn"
                                style="padding: 6px 12px; font-size: 12px;"
                                onclick="editFaqArticle({{ $faq['id'] }})">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            <span>Edit</span>
                        </button>
                        <button type="button"
                                class="admin-delete-btn"
                                style="padding: 6px 12px; font-size: 12px;"
                                onclick="openDeleteFaqModal({{ $faq['id'] }}, {{ json_encode($faq['question']) }})">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            <span>Delete</span>
                        </button>
                    </div>
                </div>
            @endforeach
        @else
            <div class="admin-empty-table-state" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                <h3>No FAQ entries found</h3>
                <p>No questions match your current search or category filter.</p>
                <a href="{{ route('admin.faqs') }}" class="admin-secondary-btn">Reset Filters</a>
            </div>
        @endif
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     VIEW 2: IN-PAGE WYSIWYG FAQ ARTICLE EDITOR VIEW
     ═══════════════════════════════════════════════════════════ -->
<div id="faqEditorView" class="admin-article-editor-view">
    <!-- Sticky Top Navigation & Action Bar -->
    <div class="admin-editor-top-bar">
        <div class="admin-editor-nav-group">
            <button type="button" class="admin-editor-back-btn" onclick="closeFaqEditor()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                <span>Back to Questions</span>
            </button>

            <!-- Mode Switcher -->
            <div class="admin-editor-view-toggle">
                <button type="button" class="admin-editor-tab-btn active" id="tabFaqEditorBtn" onclick="switchFaqEditorMode('edit')">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    <span>Editor Mode</span>
                </button>
                <button type="button" class="admin-editor-tab-btn" id="tabFaqPreviewBtn" onclick="switchFaqEditorMode('preview')">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    <span>Live Preview</span>
                </button>
            </div>
        </div>

        <div class="admin-editor-actions">
            <div class="admin-editor-stats-badge" id="faqWordCountBadge">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span id="faqStatsText">0 words &bull; 1 min read</span>
            </div>

            <button type="button" class="admin-secondary-btn" onclick="closeFaqEditor()">Cancel</button>
            <button type="button" class="admin-primary-btn" id="saveFaqBtn" onclick="saveFaqChanges()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                <span>Save &amp; Publish</span>
            </button>
        </div>
    </div>

    <!-- ── Two-Column Editor Layout ───────────────────────────── -->
    <div class="admin-editor-layout-grid">
        
        <!-- Left Column: Main WYSIWYG Editor Canvas / Live Accordion Preview -->
        <div class="admin-editor-main-col">
            
            <!-- EDIT MODE -->
            <div id="faqEditorModeContainer" class="admin-editor-main-card">
                <input type="hidden" id="editorFaqId" value="">

                <!-- FAQ Question Title Input -->
                <div style="margin-bottom: 20px;">
                    <label class="admin-form-label" style="margin-bottom: 8px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; color: #ff6600;">Question Header</label>
                    <input type="text"
                           id="editorFaqQuestionInput"
                           class="admin-editor-title-input"
                           placeholder="e.g. How to Make A Sale by Scanning the Product Barcode"
                           oninput="handleFaqQuestionInput(this.value)">
                </div>

                <!-- WYSIWYG Editor Toolbar -->
                <div class="admin-wysiwyg-toolbar" id="faqWysiwygToolbar">
                    <!-- Heading Level Select -->
                    <select class="admin-toolbar-select" id="faqHeadingSelect" onchange="formatFaqHeading(this.value)">
                        <option value="p">Paragraph Text</option>
                        <option value="h5">Sub-heading (H5)</option>
                        <option value="h4">Section Header (H4)</option>
                        <option value="h3">Main Topic (H3)</option>
                    </select>

                    <div class="admin-toolbar-divider"></div>

                    <!-- Text Styles -->
                    <button type="button" class="admin-toolbar-btn" title="Bold (Ctrl+B)" onclick="execFaqCmd('bold')"><strong>B</strong></button>
                    <button type="button" class="admin-toolbar-btn" title="Italic (Ctrl+I)" onclick="execFaqCmd('italic')"><em>I</em></button>
                    <button type="button" class="admin-toolbar-btn" title="Underline (Ctrl+U)" onclick="execFaqCmd('underline')"><u>U</u></button>
                    <button type="button" class="admin-toolbar-btn" title="Strikethrough" onclick="execFaqCmd('strikeThrough')"><s>S</s></button>
                    <button type="button" class="admin-toolbar-btn" title="Inline Code" onclick="formatFaqInlineCode()"><code>&lt;&gt;</code></button>

                    <div class="admin-toolbar-divider"></div>

                    <!-- Structured Blocks & Step Lists -->
                    <button type="button" class="admin-toolbar-btn" title="Numbered Step-by-Step List" onclick="insertFaqStepList('ol')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="10" y1="6" x2="21" y2="6"/><line x1="10" y1="12" x2="21" y2="12"/><line x1="10" y1="18" x2="21" y2="18"/><path d="M4 6h1v4"/><path d="M4 10h2"/><path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"/></svg>
                    </button>

                    <button type="button" class="admin-toolbar-btn" title="Bullet List" onclick="insertFaqStepList('ul')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    </button>

                    <button type="button" class="admin-toolbar-btn" title="Callout Alert Box" onclick="insertFaqCalloutBanner()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    </button>

                    <button type="button" class="admin-toolbar-btn" title="Blockquote" onclick="insertFaqQuoteBlock()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.75-2-2-2H4c-1.25 0-2 .75-2 2v6c0 1.25.75 2 2 2h4c0 2-1.5 4-4 4v4zm13 0c3 0 7-1 7-8V5c0-1.25-.75-2-2-2h-4c-1.25 0-2 .75-2 2v6c0 1.25.75 2 2 2h4c0 2-1.5 4-4 4v4z"/></svg>
                    </button>

                    <div class="admin-toolbar-divider"></div>

                    <!-- Media Tools -->
                    <button type="button" class="admin-toolbar-btn" title="Embed Video Guide (YouTube/Vimeo)" onclick="openFaqMediaDialog('video')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                    </button>

                    <button type="button" class="admin-toolbar-btn" title="Insert Graphic / Diagram" onclick="openFaqMediaDialog('image')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </button>

                    <button type="button" class="admin-toolbar-btn" title="Insert Link" onclick="openFaqMediaDialog('link')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    </button>

                    <div class="admin-toolbar-divider"></div>

                    <!-- Utilities -->
                    <button type="button" class="admin-toolbar-btn" title="Clear Formatting" onclick="execFaqCmd('removeFormat')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/><line x1="18" y1="18" x2="22" y2="22"/></svg>
                    </button>
                    <button type="button" class="admin-toolbar-btn" title="Undo (Ctrl+Z)" onclick="execFaqCmd('undo')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7v6h6"/><path d="M21 17a9 9 0 0 0-9-9 9 9 0 0 0-6 2.3L3 13"/></svg>
                    </button>
                    <button type="button" class="admin-toolbar-btn" title="Redo (Ctrl+Y)" onclick="execFaqCmd('redo')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 7v6h-6"/><path d="M3 17a9 9 0 0 1 9-9 9 9 0 0 1 6 2.3l3 2.7"/></svg>
                    </button>
                </div>

                <!-- Editable Canvas -->
                <div class="admin-wysiwyg-canvas faq-accordion-content"
                     id="faqWysiwygCanvas"
                     contenteditable="true"
                     spellcheck="true"
                     oninput="updateFaqWordCount()">
                </div>
            </div>

            <!-- LIVE ACCORDION PREVIEW CONTAINER -->
            <div id="faqPreviewModeContainer" class="admin-live-preview-container">
                <div style="margin-bottom: 24px;">
                    <span class="admin-status-badge badge-verified" style="background: rgba(255, 102, 0, 0.08); border-color: rgba(255, 102, 0, 0.2); color: #ff6600;" id="faqPreviewCategoryBadge">
                        General &amp; Operations
                    </span>
                    <h2 style="font-size: 24px; font-weight: 400; color: #0f172a; margin: 12px 0 6px 0;">Public Accordion Preview</h2>
                    <p style="font-size: 13px; color: #64748b; margin: 0;">Interactive test of how this FAQ item renders and expands on <a href="{{ route('faq') }}" target="_blank" style="color: #ff6600;">shopkite.com.ng/faq</a>.</p>
                </div>

                <!-- Interactive Accordion Card matching public layout -->
                <div class="faq-accordion-card open" id="previewFaqCard">
                    <div class="faq-accordion-header" onclick="togglePreviewAccordion()">
                        <h3 class="faq-accordion-title" id="previewFaqTitle">Does ShopKite work completely without internet connection?</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body" style="max-height: 4500px; opacity: 1; padding: 0 22px 22px 22px;">
                        <div class="faq-accordion-content" id="previewFaqContentBody">
                            <!-- Populated in JS -->
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Sidebar Metadata & Template Starters -->
        <div class="admin-editor-sidebar">
            
            <!-- 1. Category & Grouping Settings -->
            <div class="admin-editor-sidebar-card">
                <div class="admin-editor-card-header">
                    <h4>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                        <span>Article Taxonomy</span>
                    </h4>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="editorFaqCategorySelect">Category</label>
                    <select class="admin-form-select" id="editorFaqCategorySelect" onchange="updateFaqPreviewCategory()">
                        <option value="Getting Started">Getting Started</option>
                        <option value="Sales">Sales</option>
                        <option value="Products & Inventory">Products & Inventory</option>
                        <option value="Customer Management">Customer Management</option>
                        <option value="Delivery & Orders">Delivery & Orders</option>
                        <option value="Supply & Restocking">Supply & Restocking</option>
                        <option value="Expenses">Expenses</option>
                        <option value="Stores, Warehouses & Staff">Stores, Warehouses & Staff</option>
                        <option value="General Settings & Data">General Settings & Data</option>
                        <option value="Extras & App Info">Extras & App Info</option>
                    </select>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="editorFaqDateInput">Last Updated</label>
                    <input type="text" class="admin-form-input" id="editorFaqDateInput" value="{{ date('M d, Y') }}">
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 14px; padding-top: 14px; border-top: 1px solid #f1f5f9;">
                    <div>
                        <div style="font-size: 13px; font-weight: 500; color: #1e293b;">Active Status</div>
                        <div style="font-size: 11.5px; color: #94a3b8;">Visible on public FAQ page</div>
                    </div>
                    <label class="admin-switch">
                        <input type="checkbox" id="editorFaqStatusSwitch" checked>
                        <span class="admin-switch-slider"></span>
                    </label>
                </div>
            </div>

            <!-- 2. Example Content Templates (Quick Loaders) -->
            <div class="admin-editor-sidebar-card">
                <div class="admin-editor-card-header">
                    <h4>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                        <span>Example Templates</span>
                    </h4>
                </div>
                <p style="font-size: 12.5px; color: #64748b; margin: 0 0 12px 0;">Load a structured layout with 1 click:</p>
                
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <button type="button" class="admin-secondary-btn" style="width: 100%; justify-content: flex-start; text-align: left; padding: 8px 12px; font-size: 12px;" onclick="loadFaqTemplate('video_steps')">
                        <span>🎬 Video Guide + Step-by-Step</span>
                    </button>
                    <button type="button" class="admin-secondary-btn" style="width: 100%; justify-content: flex-start; text-align: left; padding: 8px 12px; font-size: 12px;" onclick="loadFaqTemplate('feature_overview')">
                        <span>📋 Feature Overview &amp; Benefits</span>
                    </button>
                    <button type="button" class="admin-secondary-btn" style="width: 100%; justify-content: flex-start; text-align: left; padding: 8px 12px; font-size: 12px;" onclick="loadFaqTemplate('troubleshooting')">
                        <span>🔧 Troubleshooting &amp; Support</span>
                    </button>
                </div>
            </div>

            <!-- 3. Direct Public Help Link -->
            <div class="admin-editor-sidebar-card" style="background: #fffaf5; border-color: #fed7aa;">
                <div style="display: flex; align-items: flex-start; gap: 10px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <div>
                        <strong style="font-size: 13px; color: #c2410c; display: block; margin-bottom: 2px;">Public FAQ Navigation</strong>
                        <p style="font-size: 12px; color: #7c2d12; margin: 0; line-height: 1.4;">Changes saved here are instantly reflected across customer support articles and interactive search on the live site.</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MEDIA INSERTION DIALOGS FOR FAQ
     ═══════════════════════════════════════════════════════════ -->

<!-- 1. Insert Inline Image Dialog -->
<div class="admin-media-dialog-backdrop" id="faqImageInsertDialog">
    <div class="admin-media-dialog-window">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Insert Graphic / Diagram</h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeFaqMediaDialog('faqImageInsertDialog')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <div class="admin-form-group">
                <label class="admin-form-label" for="faqInlineImageUrl">Image Web URL *</label>
                <input type="url" class="admin-form-input" id="faqInlineImageUrl" placeholder="https://images.unsplash.com/..." required>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label" for="faqInlineImageAlt">Alt Text / Description</label>
                <input type="text" class="admin-form-input" id="faqInlineImageAlt" placeholder="e.g. Sales checkout flow screen">
            </div>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeFaqMediaDialog('faqImageInsertDialog')">Cancel</button>
            <button type="button" class="admin-primary-btn" onclick="confirmInsertFaqImage()">Insert Image</button>
        </div>
    </div>
</div>

<!-- 2. Embed Video Dialog -->
<div class="admin-media-dialog-backdrop" id="faqVideoInsertDialog">
    <div class="admin-media-dialog-window">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Embed Video Tutorial</h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeFaqMediaDialog('faqVideoInsertDialog')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <div class="admin-form-group">
                <label class="admin-form-label" for="faqVideoEmbedUrl">YouTube / Vimeo Video URL or &lt;iframe&gt; *</label>
                <input type="text" class="admin-form-input" id="faqVideoEmbedUrl" placeholder="https://www.youtube.com/watch?v=... or https://youtu.be/..." required>
                <span style="font-size: 11.5px; color: #94a3b8; margin-top: 6px; display: block;">Inserts a responsive 16:9 video container matching the ShopKite FAQ player.</span>
            </div>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeFaqMediaDialog('faqVideoInsertDialog')">Cancel</button>
            <button type="button" class="admin-primary-btn" onclick="confirmInsertFaqVideo()">Embed Video</button>
        </div>
    </div>
</div>

<!-- 3. Insert Hyperlink Dialog -->
<div class="admin-media-dialog-backdrop" id="faqLinkInsertDialog">
    <div class="admin-media-dialog-window">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Insert Hyperlink</h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeFaqMediaDialog('faqLinkInsertDialog')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <div class="admin-form-group">
                <label class="admin-form-label" for="faqHyperlinkUrl">Destination URL *</label>
                <input type="url" class="admin-form-input" id="faqHyperlinkUrl" placeholder="https://..." required>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label" for="faqHyperlinkText">Link Text</label>
                <input type="text" class="admin-form-input" id="faqHyperlinkText" placeholder="e.g. hello@shopkite.com.ng">
            </div>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeFaqMediaDialog('faqLinkInsertDialog')">Cancel</button>
            <button type="button" class="admin-primary-btn" onclick="confirmInsertFaqLink()">Insert Link</button>
        </div>
    </div>
</div>

<!-- ── Delete FAQ Confirmation Modal ────────────────────── -->
<div class="admin-modal-backdrop" id="deleteFaqModal">
    <div class="admin-modal-window" style="max-width: 480px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Delete FAQ Article</h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('deleteFaqModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <input type="hidden" id="deleteFaqId" value="">
            <p style="margin: 0 0 14px 0; font-size: 15px; color: #1e293b; font-weight: 500; line-height: 1.5;">
                Are you sure you want to delete this article?
            </p>
            <p id="deleteFaqQuestionPreview" style="margin: 0; font-size: 13px; color: #64748b; font-weight: 400; line-height: 1.5; padding: 12px 14px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;"></p>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('deleteFaqModal')">No</button>
            <button type="button" class="admin-primary-btn" id="confirmDeleteFaqBtn" onclick="confirmDeleteFaq()">Yes, Delete</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Pre-load all FAQ database entries
window.faqsDatabase = @json($faqs);

let currentEditingFaqId = null;
let savedFaqSelectionRange = null;
let targetFaqIdToDelete = null;

// ── In-Page View Management ──────────────────────────────────
function openFaqEditor(faqId = null) {
    currentEditingFaqId = faqId;

    const listView = document.getElementById('faqListView');
    const editorView = document.getElementById('faqEditorView');

    listView.style.display = 'none';
    editorView.classList.add('active');
    window.scrollTo({ top: 0, behavior: 'smooth' });

    if (faqId) {
        const faq = window.faqsDatabase.find(f => f.id == faqId);
        if (faq) {
            populateFaqEditorForm(faq);
        }
    } else {
        resetFaqEditorForm();
    }

    switchFaqEditorMode('edit');
}

function editFaqArticle(faqId) {
    openFaqEditor(faqId);
}

function closeFaqEditor() {
    const listView = document.getElementById('faqListView');
    const editorView = document.getElementById('faqEditorView');

    editorView.classList.remove('active');
    listView.style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function switchFaqEditorMode(mode) {
    const editContainer = document.getElementById('faqEditorModeContainer');
    const previewContainer = document.getElementById('faqPreviewModeContainer');
    const tabEdit = document.getElementById('tabFaqEditorBtn');
    const tabPreview = document.getElementById('tabFaqPreviewBtn');

    if (mode === 'preview') {
        buildFaqLivePreview();
        editContainer.style.display = 'none';
        previewContainer.classList.add('active');
        tabEdit.classList.remove('active');
        tabPreview.classList.add('active');
    } else {
        previewContainer.classList.remove('active');
        editContainer.style.display = 'block';
        tabPreview.classList.remove('active');
        tabEdit.classList.add('active');
    }
}

// ── Form Population & Data Binding ───────────────────────────
function populateFaqEditorForm(faq) {
    document.getElementById('editorFaqId').value = faq.id;
    document.getElementById('editorFaqQuestionInput').value = faq.question;
    document.getElementById('editorFaqCategorySelect').value = faq.category;
    document.getElementById('editorFaqDateInput').value = faq.updated_at || '{{ date("M d, Y") }}';
    document.getElementById('editorFaqStatusSwitch').checked = faq.status !== 'inactive';

    const canvas = document.getElementById('faqWysiwygCanvas');
    // If the answer is raw text without tags, wrap in paragraph
    let answerHtml = faq.answer;
    if (!answerHtml.includes('<p>') && !answerHtml.includes('<ol>') && !answerHtml.includes('<div>')) {
        answerHtml = `<p class="faq-text">${answerHtml}</p>`;
    }
    canvas.innerHTML = answerHtml;

    updateFaqWordCount();
}

function resetFaqEditorForm() {
    document.getElementById('editorFaqId').value = '';
    document.getElementById('editorFaqQuestionInput').value = '';
    document.getElementById('editorFaqCategorySelect').value = 'Getting Started';
    document.getElementById('editorFaqDateInput').value = '{{ date("M d, Y") }}';
    document.getElementById('editorFaqStatusSwitch').checked = true;

    loadFaqTemplate('video_steps');
}

function loadFaqTemplate(templateKey) {
    const canvas = document.getElementById('faqWysiwygCanvas');
    const questionInput = document.getElementById('editorFaqQuestionInput');

    if (templateKey === 'video_steps') {
        if (!questionInput.value) {
            questionInput.value = 'How To Make A Sale (Scanning & Searching)';
        }
        canvas.innerHTML = `
            <div class="faq-video-container">
                <iframe src="https://www.youtube.com/embed/mZsX8B7p5tE?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <h5 class="faq-sub-heading">Step-by-Step Instructions:</h5>
            <p class="faq-text">Follow these simple steps to complete a sales transaction:</p>
            <ol class="faq-step-list">
                <li>Open the <strong>ShopKite Merchant app</strong> on your mobile phone or Sunmi POS terminal.</li>
                <li>On the <strong>Sales</strong> counter screen, tap <em>"Tap here to scan product barcode"</em> or use your Bluetooth barcode scanner.</li>
                <li>Confirm the item quantity and tap on the product name to apply any volume discounts or customer details.</li>
                <li>Tap <strong>"Confirm Sales"</strong> and select your payment method (Cash, POS Card, or Bank Transfer).</li>
                <li>Tap <strong>"Proceed"</strong> to print the receipt or send a digital receipt via WhatsApp/SMS!</li>
            </ol>
            <div class="faq-callout-banner">
                💡 <strong>Pro Tip:</strong> Transactions are saved instantly in offline mode and synchronized automatically once network connectivity is detected.
            </div>
        `;
    } else if (templateKey === 'feature_overview') {
        if (!questionInput.value) {
            questionInput.value = 'What is ShopKite Merchant & How Does It Work?';
        }
        canvas.innerHTML = `
            <h5 class="faq-sub-heading">What is ShopKite?</h5>
            <p class="faq-text">ShopKite Merchant is a modern retail POS and inventory management solution built specifically for African merchants, pharmacies, supermarkets, and boutique stores.</p>
            <ol class="faq-step-list">
                <li><strong>Offline-First Speed:</strong> Process checkouts in under 1 second with 400,000+ preloaded SKUs without relying on constant internet.</li>
                <li><strong>Multi-Staff & Permissions:</strong> Prevent shrinkage with granular manager PIN approvals for refunds and price overrides.</li>
                <li><strong>Intelligent Business Reports:</strong> Track gross profits, fast-moving products, and debtor balances across multiple store locations in real time.</li>
            </ol>
        `;
    } else if (templateKey === 'troubleshooting') {
        if (!questionInput.value) {
            questionInput.value = 'How To Reset Your Staff PIN or Troubleshoot Sign In';
        }
        canvas.innerHTML = `
            <p class="faq-text">If you are unable to sign in or have forgotten your 4-digit security PIN:</p>
            <ol class="faq-step-list">
                <li>On the Sign In page, tap <strong>"Forgot PIN?"</strong> below the numpad.</li>
                <li>Enter the verified mobile number used during merchant registration.</li>
                <li>Enter the 6-digit OTP verification code sent via SMS to create your new PIN.</li>
            </ol>
            <div class="faq-callout-banner">
                <strong>Need live assistance?</strong> Contact our 24/7 retail support desk:
            </div>
            <p class="faq-text">Email: <a href="mailto:hello@shopkite.com.ng">hello@shopkite.com.ng</a> &bull; WhatsApp: <strong>+234 906 2000 393</strong></p>
        `;
    }

    updateFaqWordCount();
    showAdminToast('Template loaded into editor canvas!', 'success');
}

// ── WYSIWYG Formatting Engine ────────────────────────────────
function execFaqCmd(command, value = null) {
    document.getElementById('faqWysiwygCanvas').focus();
    document.execCommand(command, false, value);
    updateFaqWordCount();
}

function formatFaqHeading(tag) {
    const canvas = document.getElementById('faqWysiwygCanvas');
    canvas.focus();
    if (tag === 'p') {
        document.execCommand('formatBlock', false, '<p>');
    } else {
        document.execCommand('formatBlock', false, `<${tag}>`);
    }
}

function formatFaqInlineCode() {
    const selection = window.getSelection();
    if (!selection.isCollapsed) {
        const text = selection.toString();
        document.execCommand('insertHTML', false, `<code>${text}</code>`);
    }
}

function insertFaqStepList(listType) {
    execFaqCmd(listType === 'ol' ? 'insertOrderedList' : 'insertUnorderedList');
    // Add custom faq-step-list class to the inserted list
    const canvas = document.getElementById('faqWysiwygCanvas');
    const lists = canvas.querySelectorAll('ol, ul');
    lists.forEach(l => l.classList.add('faq-step-list'));
}

function insertFaqCalloutBanner() {
    const text = window.getSelection().toString() || 'Pro Tip: Add practical checkout guidelines or warning notes here.';
    const calloutHtml = `
        <div class="faq-callout-banner">
            💡 <strong>Note:</strong> ${text}
        </div>
        <p></p>
    `;
    document.execCommand('insertHTML', false, calloutHtml);
}

function insertFaqQuoteBlock() {
    const text = window.getSelection().toString() || 'Important summary quote or rule for staff.';
    const quoteHtml = `<blockquote class="article-quote">&ldquo;${text}&rdquo;</blockquote><p></p>`;
    document.execCommand('insertHTML', false, quoteHtml);
}

// ── Media & Link Dialog Handlers ─────────────────────────────
function saveFaqSelection() {
    const sel = window.getSelection();
    if (sel.getRangeAt && sel.rangeCount) {
        savedFaqSelectionRange = sel.getRangeAt(0);
    }
}

function restoreFaqSelection() {
    if (savedFaqSelectionRange) {
        const sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(savedFaqSelectionRange);
    }
}

function openFaqMediaDialog(type) {
    saveFaqSelection();
    if (type === 'video') {
        document.getElementById('faqVideoEmbedUrl').value = '';
        document.getElementById('faqVideoInsertDialog').classList.add('active');
    } else if (type === 'image') {
        document.getElementById('faqInlineImageUrl').value = '';
        document.getElementById('faqInlineImageAlt').value = '';
        document.getElementById('faqImageInsertDialog').classList.add('active');
    } else if (type === 'link') {
        const text = window.getSelection().toString();
        document.getElementById('faqHyperlinkText').value = text;
        document.getElementById('faqHyperlinkUrl').value = '';
        document.getElementById('faqLinkInsertDialog').classList.add('active');
    }
}

function closeFaqMediaDialog(dialogId) {
    document.getElementById(dialogId).classList.remove('active');
}

function confirmInsertFaqVideo() {
    let input = document.getElementById('faqVideoEmbedUrl').value.trim();
    if (!input) {
        alert('Please enter a video URL.');
        return;
    }

    let embedUrl = input;
    if (input.includes('youtube.com/watch?v=')) {
        const videoId = input.split('v=')[1]?.split('&')[0];
        embedUrl = `https://www.youtube.com/embed/${videoId}`;
    } else if (input.includes('youtu.be/')) {
        const videoId = input.split('youtu.be/')[1]?.split('?')[0];
        embedUrl = `https://www.youtube.com/embed/${videoId}`;
    } else if (input.includes('vimeo.com/')) {
        const videoId = input.split('vimeo.com/')[1]?.split('?')[0];
        embedUrl = `https://player.vimeo.com/video/${videoId}`;
    }

    closeFaqMediaDialog('faqVideoInsertDialog');
    restoreFaqSelection();

    const videoHtml = `
        <div class="faq-video-container">
            <iframe src="${embedUrl}" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <p></p>
    `;

    document.getElementById('faqWysiwygCanvas').focus();
    document.execCommand('insertHTML', false, videoHtml);
    updateFaqWordCount();
}

function confirmInsertFaqImage() {
    const url = document.getElementById('faqInlineImageUrl').value.trim();
    const alt = document.getElementById('faqInlineImageAlt').value.trim() || 'FAQ Visual Diagram';

    if (!url) {
        alert('Please enter an image URL.');
        return;
    }

    closeFaqMediaDialog('faqImageInsertDialog');
    restoreFaqSelection();

    const imgHtml = `
        <div class="faq-img-container">
            <img src="${url}" alt="${alt}">
        </div>
        <p></p>
    `;

    document.getElementById('faqWysiwygCanvas').focus();
    document.execCommand('insertHTML', false, imgHtml);
    updateFaqWordCount();
}

function confirmInsertFaqLink() {
    const url = document.getElementById('faqHyperlinkUrl').value.trim();
    const text = document.getElementById('faqHyperlinkText').value.trim() || url;

    if (!url) {
        alert('Please enter a destination URL.');
        return;
    }

    closeFaqMediaDialog('faqLinkInsertDialog');
    restoreFaqSelection();

    const linkHtml = `<a href="${url}" target="_blank" rel="noopener noreferrer">${text}</a>`;
    document.getElementById('faqWysiwygCanvas').focus();
    document.execCommand('insertHTML', false, linkHtml);
}

// ── Word Count & Live Stats ──────────────────────────────────
function updateFaqWordCount() {
    const canvas = document.getElementById('faqWysiwygCanvas');
    const text = canvas.innerText || '';
    const words = text.trim() ? text.trim().split(/\s+/).length : 0;
    const readTimeMinutes = Math.max(1, Math.ceil(words / 150));

    document.getElementById('faqStatsText').innerHTML = `${words} words &bull; ${readTimeMinutes} min read`;
}

function handleFaqQuestionInput(val) {
    const titleEl = document.getElementById('previewFaqTitle');
    if (titleEl) titleEl.innerText = val || 'Question Header Preview';
}

function updateFaqPreviewCategory() {
    const cat = document.getElementById('editorFaqCategorySelect').value;
    const badge = document.getElementById('faqPreviewCategoryBadge');
    if (badge) badge.innerText = cat;
}

// ── Live Accordion Preview ───────────────────────────────────
function buildFaqLivePreview() {
    const question = document.getElementById('editorFaqQuestionInput').value.trim() || 'Untitled Question';
    const category = document.getElementById('editorFaqCategorySelect').value;
    const wysiwygContent = document.getElementById('faqWysiwygCanvas').innerHTML;

    document.getElementById('previewFaqTitle').innerText = question;
    document.getElementById('faqPreviewCategoryBadge').innerText = category;
    document.getElementById('previewFaqContentBody').innerHTML = wysiwygContent;
}

function togglePreviewAccordion() {
    const card = document.getElementById('previewFaqCard');
    card.classList.toggle('open');
}

function getFaqAnswerSummary(html, limit = 120) {
    const tmp = document.createElement('div');
    tmp.innerHTML = html;
    const text = (tmp.textContent || tmp.innerText || '').replace(/\s+/g, ' ').trim();
    if (text.length <= limit) return text;
    return text.slice(0, limit).trim() + '...';
}

// ── Save FAQ Changes ─────────────────────────────────────────
function saveFaqChanges() {
    const id = document.getElementById('editorFaqId').value;
    const question = document.getElementById('editorFaqQuestionInput').value.trim();
    const category = document.getElementById('editorFaqCategorySelect').value;
    const date = document.getElementById('editorFaqDateInput').value.trim();
    const status = document.getElementById('editorFaqStatusSwitch').checked ? 'active' : 'inactive';
    const wysiwygHtml = document.getElementById('faqWysiwygCanvas').innerHTML;

    if (!question) {
        alert('Please provide a question header.');
        return;
    }

    if (id) {
        // Update existing in local dataset
        const faq = window.faqsDatabase.find(f => f.id == id);
        if (faq) {
            faq.question = question;
            faq.category = category;
            faq.updated_at = date;
            faq.status = status;
            faq.answer = wysiwygHtml;

            // Update DOM card
            const catEl = document.getElementById('faq-category-' + id);
            const qEl = document.getElementById('faq-question-' + id);
            const aEl = document.getElementById('faq-answer-' + id);
            const dEl = document.getElementById('faq-date-' + id);

            if (catEl) catEl.innerText = category;
            if (qEl) qEl.innerText = question;
            if (aEl) aEl.innerText = getFaqAnswerSummary(wysiwygHtml, 120);
            if (dEl) dEl.innerText = date;
        }

        showAdminToast(`FAQ #${id} updated and published successfully!`, 'success');
    } else {
        // Create new FAQ card
        const newId = window.faqsDatabase.length + 1;
        const newFaq = {
            id: newId,
            category,
            question,
            answer: wysiwygHtml,
            status,
            updated_at: date
        };
        window.faqsDatabase.unshift(newFaq);

        const grid = document.getElementById('faqsGridContainer');
        if (grid) {
            // Remove empty state if present
            const emptyState = grid.querySelector('.admin-empty-table-state');
            if (emptyState) emptyState.remove();

            const card = document.createElement('div');
            card.className = 'admin-faq-card';
            card.id = 'faq-card-' + newId;
            card.innerHTML = `
                <div class="admin-faq-card-content">
                    <div class="admin-faq-category" id="faq-category-${newId}">${newFaq.category}</div>
                    <h3 class="admin-faq-question" id="faq-question-${newId}">${newFaq.question}</h3>
                    <p class="admin-faq-answer" id="faq-answer-${newId}">${getFaqAnswerSummary(newFaq.answer, 120)}</p>
                    <div style="margin-top: 14px; font-size: 11.5px; color: #94a3b8;">
                        <span>Last updated: <span id="faq-date-${newId}">${newFaq.updated_at}</span></span>
                    </div>
                </div>

                <div class="admin-action-btn-group" style="align-items: flex-start; gap: 8px;">
                    <button type="button"
                            class="admin-secondary-btn"
                            style="padding: 6px 12px; font-size: 12px;"
                            onclick="editFaqArticle(${newId})">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                        <span>Edit</span>
                    </button>
                    <button type="button"
                            class="admin-delete-btn"
                            style="padding: 6px 12px; font-size: 12px;"
                            onclick="openDeleteFaqModal(${newId}, '${newFaq.question.replace(/'/g, "\\'")}')">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                        <span>Delete</span>
                    </button>
                </div>
            `;
            grid.insertBefore(card, grid.firstChild);
        }

        showAdminToast(`New FAQ added and published successfully!`, 'success');
    }

    closeFaqEditor();
}

// ── Delete Confirmation Handlers ─────────────────────────────
function openDeleteFaqModal(id, question) {
    targetFaqIdToDelete = id;
    document.getElementById('deleteFaqId').value = id;
    document.getElementById('deleteFaqQuestionPreview').innerText = question;
    openAdminModal('deleteFaqModal');
}

function confirmDeleteFaq() {
    const id = targetFaqIdToDelete || document.getElementById('deleteFaqId').value;
    closeAdminModal('deleteFaqModal');

    // Remove from local dataset
    window.faqsDatabase = window.faqsDatabase.filter(f => f.id != id);
    
    // Smoothly remove card from DOM
    const card = document.getElementById('faq-card-' + id);
    if (card) {
        card.style.transition = 'all 0.3s ease';
        card.style.opacity = '0';
        card.style.transform = 'scale(0.95)';
        setTimeout(() => {
            card.remove();
            
            const remaining = document.querySelectorAll('.admin-faq-card');
            if (remaining.length === 0) {
                const grid = document.querySelector('.admin-faqs-grid');
                if (grid) {
                    grid.innerHTML = `
                        <div class="admin-empty-table-state" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                            <h3>No FAQ entries found</h3>
                            <p>All FAQ articles have been deleted or filtered.</p>
                            <a href="{{ route('admin.faqs') }}" class="admin-secondary-btn">Reset Filters</a>
                        </div>
                    `;
                }
            }
        }, 300);
    }
    
    showAdminToast('Article deleted successfully!', 'success');
}
</script>
@endpush
@endsection
