@extends('layouts.admin')

@section('title', 'Blog Articles Manager — ShopKite Admin')
@section('breadcrumb_title', 'Blog Articles')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/blog.css') }}?v={{ filemtime(public_path('css/blog.css')) }}">
@endsection

@section('content')

<!-- ═══════════════════════════════════════════════════════════
     VIEW 1: BLOG ARTICLES LIST VIEW
     ═══════════════════════════════════════════════════════════ -->
<div id="blogListView">
    <!-- Page Header -->
    <div class="admin-page-header">
        <div class="admin-page-title-group">
            <h1>Blog <strong>Articles &amp; Editorial Guides</strong></h1>
            <p class="admin-page-subtitle">Manage, edit, and publish retail guides based on the ShopKite <a href="{{ route('blog.index') }}" target="_blank" style="color: #ff6600; text-decoration: underline;">Public Blog Layout</a>.</p>
        </div>
        <div class="admin-header-actions">
            <button type="button" class="admin-primary-btn" onclick="openBlogEditor(null)">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>Draft New Article</span>
            </button>
        </div>
    </div>

    <!-- ── Toolbar: Category Filters & Search ────────────────── -->
    <div class="admin-toolbar-card">
        <div class="admin-filter-pills-group">
            <a href="{{ route('admin.blog', ['category' => 'all', 'q' => $searchQuery]) }}"
               class="admin-filter-pill {{ $selectedCategory === 'all' ? 'active' : '' }}">
                <span>All Categories</span>
            </a>
            @foreach($categories as $cat)
                @if($cat['slug'] !== 'all')
                    <a href="{{ route('admin.blog', ['category' => $cat['slug'], 'q' => $searchQuery]) }}"
                       class="admin-filter-pill {{ $selectedCategory === $cat['slug'] ? 'active' : '' }}">
                        <span>{{ $cat['name'] }}</span>
                    </a>
                @endif
            @endforeach
        </div>

        <form action="{{ route('admin.blog') }}" method="GET" class="admin-search-form">
            @if($selectedCategory !== 'all')
                <input type="hidden" name="category" value="{{ $selectedCategory }}">
            @endif
            <svg class="admin-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            <input type="text"
                   name="q"
                   class="admin-search-input admin-table-search-input"
                   placeholder="Search title, author, category..."
                   value="{{ $searchQuery }}">
            @if(!empty($searchQuery))
                <a href="{{ route('admin.blog', $selectedCategory !== 'all' ? ['category' => $selectedCategory] : []) }}" class="admin-search-clear" title="Clear search" aria-label="Clear search">
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
            @if($articles->count() > 0)
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Article Title &amp; Slug</th>
                            <th>Category</th>
                            <th>Author &amp; Role</th>
                            <th>Reading Time</th>
                            <th>Published Date</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="articlesTableBody">
                        @foreach($articles as $article)
                            <tr id="article-row-{{ $article['id'] }}">
                                <td>
                                    <img src="{{ str_starts_with($article['thumbnail'], 'http') ? $article['thumbnail'] : asset($article['thumbnail']) }}"
                                         alt="{{ $article['title'] }}"
                                         class="admin-item-thumb"
                                         id="table-thumb-{{ $article['id'] }}">
                                </td>
                                <td>
                                    <div><strong id="table-title-{{ $article['id'] }}">{{ $article['title'] }}</strong></div>
                                    <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;" id="table-slug-{{ $article['id'] }}">/blog/{{ $article['slug'] }}</span>
                                </td>
                                <td>
                                    <span class="admin-status-badge badge-verified" style="background: rgba(255, 102, 0, 0.08); border-color: rgba(255, 102, 0, 0.2); color: #ff6600;" id="table-category-{{ $article['id'] }}">
                                        {{ $article['category'] }}
                                    </span>
                                </td>
                                <td>
                                    <div><span style="font-size: 13px; font-weight: 500;" id="table-author-{{ $article['id'] }}">{{ $article['author'] }}</span></div>
                                    <span style="font-size: 11.5px; color: #64748b;" id="table-author-role-{{ $article['id'] }}">{{ $article['author_role'] }}</span>
                                </td>
                                <td>
                                    <span style="font-size: 12.5px; color: #475569;" id="table-readtime-{{ $article['id'] }}">{{ $article['read_time'] }}</span>
                                </td>
                                <td>
                                    <span style="font-size: 12.5px; color: #64748b;" id="table-date-{{ $article['id'] }}">{{ $article['date'] }}</span>
                                </td>
                                <td style="text-align: right;">
                                    <div class="admin-action-btn-group" style="justify-content: flex-end; gap: 8px;">
                                        <button type="button"
                                                class="admin-secondary-btn"
                                                style="padding: 5px 12px; font-size: 12px;"
                                                onclick="editBlogArticle({{ $article['id'] }})">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            <span>Edit</span>
                                        </button>
                                        <button type="button"
                                                class="admin-delete-btn"
                                                style="padding: 5px 12px; font-size: 12px;"
                                                onclick="openDeleteArticleModal({{ $article['id'] }}, {{ json_encode($article['title']) }})">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                            <span>Delete</span>
                                        </button>
                                        <a href="{{ route('blog.show', $article['slug']) }}"
                                           target="_blank"
                                           class="admin-action-btn"
                                           title="View live article"
                                           aria-label="View live article">
                                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="admin-empty-table-state">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path></svg>
                    <h3>No blog articles found</h3>
                    <p>No articles match your active filter.</p>
                    <a href="{{ route('admin.blog') }}" class="admin-secondary-btn">Reset Filters</a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     VIEW 2: IN-PAGE WYSIWYG ARTICLE EDITOR VIEW
     ═══════════════════════════════════════════════════════════ -->
<div id="blogEditorView" class="admin-article-editor-view">
    <!-- Sticky Top Navigation & Action Bar -->
    <div class="admin-editor-top-bar">
        <div class="admin-editor-nav-group">
            <button type="button" class="admin-editor-back-btn" onclick="closeBlogEditor()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                <span>Back to Articles</span>
            </button>

            <!-- Mode Switcher -->
            <div class="admin-editor-view-toggle">
                <button type="button" class="admin-editor-tab-btn active" id="tabEditorBtn" onclick="switchEditorMode('edit')">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    <span>Editor Mode</span>
                </button>
                <button type="button" class="admin-editor-tab-btn" id="tabPreviewBtn" onclick="switchEditorMode('preview')">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    <span>Live Preview</span>
                </button>
            </div>
        </div>

        <div class="admin-editor-actions">
            <div class="admin-editor-stats-badge" id="editorWordCountBadge">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                <span id="editorStatsText">0 words &bull; 1 min read</span>
            </div>

            <button type="button" class="admin-secondary-btn" onclick="closeBlogEditor()">Cancel</button>
            <button type="button" class="admin-primary-btn" id="saveArticleBtn" onclick="saveArticleChanges()">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                <span>Save &amp; Publish</span>
            </button>
        </div>
    </div>

    <!-- ── Two-Column Layout ──────────────────────────────────── -->
    <div class="admin-editor-layout-grid">
        
        <!-- Left Column: Main Editor / Live Preview -->
        <div class="admin-editor-main-col">
            
            <!-- EDIT MODE -->
            <div id="editorModeContainer" class="admin-editor-main-card">
                <input type="hidden" id="editorArticleId" value="">

                <!-- Article Title Input -->
                <input type="text"
                       id="editorTitleInput"
                       class="admin-editor-title-input"
                       placeholder="Enter article title here..."
                       oninput="handleTitleInput(this.value)">

                <!-- Permalink Row -->
                <div class="admin-editor-permalink-row">
                    <span><strong>Permalink:</strong> shopkite.com/blog/</span>
                    <input type="text" id="editorSlugInput" class="admin-editor-slug-input" placeholder="article-slug">
                    <button type="button" class="admin-secondary-btn" style="padding: 3px 8px; font-size: 11px;" onclick="generateSlugFromTitle()">Auto Slug</button>
                </div>

                <!-- WYSIWYG Editor Toolbar -->
                <div class="admin-wysiwyg-toolbar" id="wysiwygToolbar">
                    <!-- Heading Level Select -->
                    <select class="admin-toolbar-select" id="headingFormatSelect" onchange="formatHeading(this.value)">
                        <option value="p">Paragraph</option>
                        <option value="lead">Lead Text</option>
                        <option value="h2">Heading 2</option>
                        <option value="h3">Heading 3</option>
                        <option value="h4">Heading 4</option>
                    </select>

                    <div class="admin-toolbar-divider"></div>

                    <!-- Text Styles -->
                    <button type="button" class="admin-toolbar-btn" title="Bold (Ctrl+B)" onclick="execCmd('bold')"><strong>B</strong></button>
                    <button type="button" class="admin-toolbar-btn" title="Italic (Ctrl+I)" onclick="execCmd('italic')"><em>I</em></button>
                    <button type="button" class="admin-toolbar-btn" title="Underline (Ctrl+U)" onclick="execCmd('underline')"><u>U</u></button>
                    <button type="button" class="admin-toolbar-btn" title="Strikethrough" onclick="execCmd('strikeThrough')"><s>S</s></button>
                    <button type="button" class="admin-toolbar-btn" title="Inline Code" onclick="formatInlineCode()"><code>&lt;&gt;</code></button>

                    <div class="admin-toolbar-divider"></div>

                    <!-- Blocks -->
                    <button type="button" class="admin-toolbar-btn" title="Blockquote" onclick="insertQuoteBlock()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21c3 0 7-1 7-8V5c0-1.25-.75-2-2-2H4c-1.25 0-2 .75-2 2v6c0 1.25.75 2 2 2h4c0 2-1.5 4-4 4v4zm13 0c3 0 7-1 7-8V5c0-1.25-.75-2-2-2h-4c-1.25 0-2 .75-2 2v6c0 1.25.75 2 2 2h4c0 2-1.5 4-4 4v4z"/></svg>
                    </button>

                    <button type="button" class="admin-toolbar-btn" title="Callout Box" onclick="insertCalloutBlock()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    </button>

                    <button type="button" class="admin-toolbar-btn" title="Horizontal Divider" onclick="execCmd('insertHorizontalRule')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"/></svg>
                    </button>

                    <div class="admin-toolbar-divider"></div>

                    <!-- Lists -->
                    <button type="button" class="admin-toolbar-btn" title="Bullet List" onclick="execCmd('insertUnorderedList')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
                    </button>

                    <button type="button" class="admin-toolbar-btn" title="Numbered List" onclick="execCmd('insertOrderedList')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="10" y1="6" x2="21" y2="6"/><line x1="10" y1="12" x2="21" y2="12"/><line x1="10" y1="18" x2="21" y2="18"/><path d="M4 6h1v4"/><path d="M4 10h2"/><path d="M6 18H4c0-1 2-2 2-3s-1-1.5-2-1"/></svg>
                    </button>

                    <div class="admin-toolbar-divider"></div>

                    <!-- Media & Links -->
                    <button type="button" class="admin-toolbar-btn" title="Insert Image" onclick="openMediaDialog('image')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    </button>

                    <button type="button" class="admin-toolbar-btn" title="Embed Video (YouTube/Vimeo)" onclick="openMediaDialog('video')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                    </button>

                    <button type="button" class="admin-toolbar-btn" title="Insert Link" onclick="openMediaDialog('link')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    </button>

                    <div class="admin-toolbar-divider"></div>

                    <!-- Utilities -->
                    <button type="button" class="admin-toolbar-btn" title="Clear Formatting" onclick="execCmd('removeFormat')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7V4h16v3"/><path d="M9 20h6"/><path d="M12 4v16"/><line x1="18" y1="18" x2="22" y2="22"/></svg>
                    </button>
                    <button type="button" class="admin-toolbar-btn" title="Undo (Ctrl+Z)" onclick="execCmd('undo')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7v6h6"/><path d="M21 17a9 9 0 0 0-9-9 9 9 0 0 0-6 2.3L3 13"/></svg>
                    </button>
                    <button type="button" class="admin-toolbar-btn" title="Redo (Ctrl+Y)" onclick="execCmd('redo')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 7v6h-6"/><path d="M3 17a9 9 0 0 1 9-9 9 9 0 0 1 6 2.3l3 2.7"/></svg>
                    </button>
                </div>

                <!-- Editable Canvas -->
                <div class="admin-wysiwyg-canvas article-content"
                     id="articleWysiwygCanvas"
                     contenteditable="true"
                     spellcheck="true"
                     oninput="updateEditorWordCount()">
                </div>
            </div>

            <!-- LIVE PREVIEW CONTAINER -->
            <div id="previewModeContainer" class="admin-live-preview-container">
                <div class="article-page-wrapper" style="padding: 0; background: transparent;">
                    <article class="article-container" style="max-width: 100%; padding: 0;">
                        <!-- Breadcrumb & Header -->
                        <div class="article-header" style="border: none; padding-bottom: 0;">
                            <div class="blog-card-badge-row">
                                <span class="blog-category-badge" id="previewCategoryBadge">Inventory Management</span>
                            </div>
                            <h1 class="article-title" id="previewArticleTitle">Article Title</h1>
                            <div class="article-meta-bar">
                                <div class="article-author-card">
                                    <div class="article-author-avatar">SK</div>
                                    <div class="article-author-details">
                                        <span class="article-author-name" id="previewAuthorName">ShopKite Editorial Team</span>
                                        <span class="article-author-role" id="previewAuthorMeta">Retail Advisory &bull; Today &bull; 5 min read</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hero Image Preview -->
                        <div class="article-hero-image-wrap" id="previewHeroWrap">
                            <img src="" id="previewHeroImg" class="article-hero-img" alt="Hero Image">
                        </div>

                        <!-- Main Content Body -->
                        <div class="article-content" id="previewContentBody"></div>

                        <!-- Author Bio Box -->
                        <div class="article-author-bio" style="margin-top: 40px;">
                            <div class="article-bio-avatar">SK</div>
                            <div class="article-bio-info">
                                <h4 id="previewBioAuthor">Written by ShopKite Editorial Team</h4>
                                <p>The ShopKite Editorial &amp; Advisory team works directly with hundreds of retailers to share battle-tested insights on inventory management, retail hardware, and store profitability.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </div>

        </div>

        <!-- Right Column: Sidebar Metadata & Media Assets -->
        <div class="admin-editor-sidebar">
            
            <!-- 1. Publication & Categorization Card -->
            <div class="admin-editor-sidebar-card">
                <div class="admin-editor-card-header">
                    <h4>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                        <span>Publishing Settings</span>
                    </h4>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="editorCategorySelect">Category</label>
                    <select class="admin-form-select" id="editorCategorySelect" onchange="updatePreviewMeta()">
                        <option value="Inventory Management">Inventory Management</option>
                        <option value="Store Operations">Store Operations</option>
                        <option value="Retail Tech">Retail Tech</option>
                        <option value="Business Growth">Business Growth</option>
                        <option value="Finance & Sales">Finance & Sales</option>
                        <option value="Hardware & Tech">Hardware & Tech</option>
                    </select>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="editorReadTimeInput">Reading Time</label>
                    <input type="text" class="admin-form-input" id="editorReadTimeInput" value="5 min read" oninput="updatePreviewMeta()">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="editorDateInput">Published Date</label>
                    <input type="text" class="admin-form-input" id="editorDateInput" value="{{ date('M d, Y') }}" oninput="updatePreviewMeta()">
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 14px; padding-top: 14px; border-top: 1px solid #f1f5f9;">
                    <div>
                        <div style="font-size: 13px; font-weight: 500; color: #1e293b;">Featured Article</div>
                        <div style="font-size: 11.5px; color: #94a3b8;">Pin to hero spot on blog index</div>
                    </div>
                    <label class="admin-switch">
                        <input type="checkbox" id="editorFeaturedSwitch">
                        <span class="admin-switch-slider"></span>
                    </label>
                </div>
            </div>

            <!-- 2. Hero Thumbnail Card -->
            <div class="admin-editor-sidebar-card">
                <div class="admin-editor-card-header">
                    <h4>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <span>Featured Hero Image</span>
                    </h4>
                </div>

                <div class="admin-hero-preview-box" id="sidebarHeroPreview">
                    <img src="" id="sidebarHeroImg" class="admin-hero-preview-img" alt="Featured Image Preview" style="display: none;">
                    <div id="sidebarHeroPlaceholder" style="font-size: 12px; color: #94a3b8; text-align: center; padding: 10px;">
                        No Image Selected
                    </div>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="editorThumbnailInput">Hero Image URL</label>
                    <input type="url"
                           class="admin-form-input"
                           id="editorThumbnailInput"
                           placeholder="https://images.unsplash.com/..."
                           oninput="updateHeroThumbnailPreview(this.value)">
                </div>

                <!-- Stock Photo Quick Picks -->
                <div style="margin-top: 12px;">
                    <span style="font-size: 11.5px; font-weight: 600; color: #64748b; text-transform: uppercase;">Stock Gallery Picks:</span>
                    <div class="admin-stock-gallery-grid">
                        <button type="button" class="admin-stock-thumb-btn" onclick="selectStockHero('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1000&q=80')">
                            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=300&q=80" alt="Stock 1">
                        </button>
                        <button type="button" class="admin-stock-thumb-btn" onclick="selectStockHero('https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=1000&q=80')">
                            <img src="https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=300&q=80" alt="Stock 2">
                        </button>
                        <button type="button" class="admin-stock-thumb-btn" onclick="selectStockHero('https://images.unsplash.com/photo-1556740758-90de374c12ad?auto=format&fit=crop&w=1000&q=80')">
                            <img src="https://images.unsplash.com/photo-1556740758-90de374c12ad?auto=format&fit=crop&w=300&q=80" alt="Stock 3">
                        </button>
                        <button type="button" class="admin-stock-thumb-btn" onclick="selectStockHero('https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1000&q=80')">
                            <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=300&q=80" alt="Stock 4">
                        </button>
                        <button type="button" class="admin-stock-thumb-btn" onclick="selectStockHero('https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1000&q=80')">
                            <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=300&q=80" alt="Stock 5">
                        </button>
                        <button type="button" class="admin-stock-thumb-btn" onclick="selectStockHero('https://images.unsplash.com/photo-1556742111-a301076d9d18?auto=format&fit=crop&w=1000&q=80')">
                            <img src="https://images.unsplash.com/photo-1556742111-a301076d9d18?auto=format&fit=crop&w=300&q=80" alt="Stock 6">
                        </button>
                    </div>
                </div>
            </div>

            <!-- 3. Author & Editorial Info Card -->
            <div class="admin-editor-sidebar-card">
                <div class="admin-editor-card-header">
                    <h4>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span>Author &amp; Attribution</span>
                    </h4>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="editorAuthorInput">Author Name</label>
                    <input type="text" class="admin-form-input" id="editorAuthorInput" value="ShopKite Editorial Team" oninput="updatePreviewMeta()">
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="editorAuthorRoleInput">Author Role / Specialization</label>
                    <input type="text" class="admin-form-input" id="editorAuthorRoleInput" value="Retail Advisory" oninput="updatePreviewMeta()">
                </div>
            </div>

            <!-- 4. Excerpt & SEO Meta Description Card -->
            <div class="admin-editor-sidebar-card">
                <div class="admin-editor-card-header">
                    <h4>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        <span>Excerpt &amp; SEO Meta</span>
                    </h4>
                </div>

                <div class="admin-form-group">
                    <label class="admin-form-label" for="editorExcerptTextarea">Excerpt (Search &amp; Social)</label>
                    <textarea class="admin-form-textarea" id="editorExcerptTextarea" rows="3" placeholder="Brief summary displayed on article cards..." oninput="updatePreviewMeta()"></textarea>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     MEDIA INSERTION DIALOGS
     ═══════════════════════════════════════════════════════════ -->

<!-- 1. Insert Inline Image Dialog -->
<div class="admin-media-dialog-backdrop" id="imageInsertDialog">
    <div class="admin-media-dialog-window">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Insert Inline Image</h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeMediaDialog('imageInsertDialog')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <div class="admin-form-group">
                <label class="admin-form-label" for="inlineImageUrl">Image Web URL *</label>
                <input type="url" class="admin-form-input" id="inlineImageUrl" placeholder="https://images.unsplash.com/..." required>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label" for="inlineImageAlt">Alt Text / Description</label>
                <input type="text" class="admin-form-input" id="inlineImageAlt" placeholder="e.g. Retail clerk scanning barcode">
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label" for="inlineImageCaption">Caption (Optional)</label>
                <input type="text" class="admin-form-input" id="inlineImageCaption" placeholder="e.g. Fig 1. Reconciling barcode scans">
            </div>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeMediaDialog('imageInsertDialog')">Cancel</button>
            <button type="button" class="admin-primary-btn" onclick="confirmInsertImage()">Insert Image</button>
        </div>
    </div>
</div>

<!-- 2. Embed Video Dialog -->
<div class="admin-media-dialog-backdrop" id="videoInsertDialog">
    <div class="admin-media-dialog-window">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Embed Video (YouTube / Vimeo)</h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeMediaDialog('videoInsertDialog')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <div class="admin-form-group">
                <label class="admin-form-label" for="videoEmbedUrl">YouTube / Vimeo Video URL or &lt;iframe&gt; *</label>
                <input type="text" class="admin-form-input" id="videoEmbedUrl" placeholder="https://www.youtube.com/watch?v=... or https://youtu.be/..." required>
                <span style="font-size: 11.5px; color: #94a3b8; margin-top: 6px; display: block;">Supports YouTube, Vimeo, or standard responsive embed iframes.</span>
            </div>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeMediaDialog('videoInsertDialog')">Cancel</button>
            <button type="button" class="admin-primary-btn" onclick="confirmInsertVideo()">Embed Video</button>
        </div>
    </div>
</div>

<!-- 3. Insert Hyperlink Dialog -->
<div class="admin-media-dialog-backdrop" id="linkInsertDialog">
    <div class="admin-media-dialog-window">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Insert Hyperlink</h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeMediaDialog('linkInsertDialog')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <div class="admin-form-group">
                <label class="admin-form-label" for="hyperlinkUrl">Destination URL *</label>
                <input type="url" class="admin-form-input" id="hyperlinkUrl" placeholder="https://..." required>
            </div>
            <div class="admin-form-group">
                <label class="admin-form-label" for="hyperlinkText">Link Text</label>
                <input type="text" class="admin-form-input" id="hyperlinkText" placeholder="e.g. Learn more about ShopKite">
            </div>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeMediaDialog('linkInsertDialog')">Cancel</button>
            <button type="button" class="admin-primary-btn" onclick="confirmInsertLink()">Insert Link</button>
        </div>
    </div>
</div>

<!-- ── Delete Article Confirmation Modal ─────────────────── -->
<div class="admin-modal-backdrop" id="deleteArticleModal">
    <div class="admin-modal-window" style="max-width: 480px; width: 100%;">
        <div class="admin-modal-header">
            <h3 class="admin-modal-title">Delete Blog Article</h3>
            <button type="button" class="admin-modal-close-btn" onclick="closeAdminModal('deleteArticleModal')" aria-label="Close modal">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="admin-modal-body">
            <input type="hidden" id="deleteArticleId" value="">
            <p style="margin: 0 0 14px 0; font-size: 15px; color: #1e293b; font-weight: 500; line-height: 1.5;">
                Are you sure you want to delete this article?
            </p>
            <p id="deleteArticleTitlePreview" style="margin: 0; font-size: 13px; color: #64748b; font-weight: 400; line-height: 1.5; padding: 12px 14px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;"></p>
        </div>
        <div class="admin-modal-footer">
            <button type="button" class="admin-secondary-btn" onclick="closeAdminModal('deleteArticleModal')">No</button>
            <button type="button" class="admin-primary-btn" id="confirmDeleteArticleBtn" onclick="confirmDeleteArticle()">Yes, Delete</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Pre-load all article repositories
window.blogArticlesDatabase = @json($articles);

let currentEditingArticleId = null;
let savedSelectionRange = null;
let targetArticleIdToDelete = null;

function openDeleteArticleModal(id, title) {
    targetArticleIdToDelete = id;
    document.getElementById('deleteArticleId').value = id;
    document.getElementById('deleteArticleTitlePreview').innerText = title;
    openAdminModal('deleteArticleModal');
}

function confirmDeleteArticle() {
    const id = targetArticleIdToDelete || document.getElementById('deleteArticleId').value;
    closeAdminModal('deleteArticleModal');

    // Remove from local dataset
    window.blogArticlesDatabase = window.blogArticlesDatabase.filter(a => a.id != id);

    // Smoothly animate & remove row
    const row = document.getElementById('article-row-' + id);
    if (row) {
        row.style.transition = 'all 0.3s ease';
        row.style.opacity = '0';
        row.style.transform = 'scale(0.98)';
        setTimeout(() => {
            row.remove();

            const remaining = document.querySelectorAll('#articlesTableBody tr');
            if (remaining.length === 0) {
                const tableContainer = document.querySelector('.admin-table-card .admin-table-container');
                if (tableContainer) {
                    tableContainer.innerHTML = `
                        <div class="admin-empty-table-state">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path></svg>
                            <h3>No blog articles found</h3>
                            <p>All articles have been deleted or filtered.</p>
                            <a href="{{ route('admin.blog') }}" class="admin-secondary-btn">Reset Filters</a>
                        </div>
                    `;
                }
            }
        }, 300);
    }

    showAdminToast('Article deleted successfully!', 'success');
}

// ── In-Page View Management ──────────────────────────────────
function openBlogEditor(articleId = null) {
    currentEditingArticleId = articleId;

    const listView = document.getElementById('blogListView');
    const editorView = document.getElementById('blogEditorView');

    listView.style.display = 'none';
    editorView.classList.add('active');
    window.scrollTo({ top: 0, behavior: 'smooth' });

    if (articleId) {
        const article = window.blogArticlesDatabase.find(a => a.id == articleId);
        if (article) {
            populateEditorForm(article);
        }
    } else {
        // Clear for fresh draft
        resetEditorForm();
    }

    switchEditorMode('edit');
}

function editBlogArticle(articleId) {
    openBlogEditor(articleId);
}

function closeBlogEditor() {
    const listView = document.getElementById('blogListView');
    const editorView = document.getElementById('blogEditorView');

    editorView.classList.remove('active');
    listView.style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function switchEditorMode(mode) {
    const editContainer = document.getElementById('editorModeContainer');
    const previewContainer = document.getElementById('previewModeContainer');
    const tabEdit = document.getElementById('tabEditorBtn');
    const tabPreview = document.getElementById('tabPreviewBtn');

    if (mode === 'preview') {
        buildLivePreview();
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
function populateEditorForm(article) {
    document.getElementById('editorArticleId').value = article.id;
    document.getElementById('editorTitleInput').value = article.title;
    document.getElementById('editorSlugInput').value = article.slug;
    document.getElementById('editorCategorySelect').value = article.category;
    document.getElementById('editorReadTimeInput').value = article.read_time || '5 min read';
    document.getElementById('editorDateInput').value = article.date || '{{ date("M d, Y") }}';
    document.getElementById('editorAuthorInput').value = article.author || 'ShopKite Editorial Team';
    document.getElementById('editorAuthorRoleInput').value = article.author_role || 'Retail Advisory';
    document.getElementById('editorThumbnailInput').value = article.thumbnail || '';
    document.getElementById('editorExcerptTextarea').value = article.excerpt || '';
    document.getElementById('editorFeaturedSwitch').checked = !!article.featured;

    updateHeroThumbnailPreview(article.thumbnail);

    // Convert structured blocks to rich HTML for WYSIWYG
    const canvas = document.getElementById('articleWysiwygCanvas');
    canvas.innerHTML = convertBlocksToHtml(article.content);

    updateEditorWordCount();
}

function resetEditorForm() {
    document.getElementById('editorArticleId').value = '';
    document.getElementById('editorTitleInput').value = '';
    document.getElementById('editorSlugInput').value = '';
    document.getElementById('editorCategorySelect').value = 'Inventory Management';
    document.getElementById('editorReadTimeInput').value = '5 min read';
    document.getElementById('editorDateInput').value = '{{ date("M d, Y") }}';
    document.getElementById('editorAuthorInput').value = 'ShopKite Editorial Team';
    document.getElementById('editorAuthorRoleInput').value = 'Retail Advisory';
    document.getElementById('editorThumbnailInput').value = 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1000&q=80';
    document.getElementById('editorExcerptTextarea').value = '';
    document.getElementById('editorFeaturedSwitch').checked = false;

    updateHeroThumbnailPreview('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1000&q=80');

    const canvas = document.getElementById('articleWysiwygCanvas');
    canvas.innerHTML = `
        <p class="article-lead">Enter your opening summary lead paragraph here to hook readers...</p>
        <h2>1. Key Strategy or Observation</h2>
        <p>Explain the detailed retail principle, inventory tactic, or management process here.</p>
        <blockquote class="article-quote">&ldquo;Key takeaway quote or advice for store owners.&rdquo;</blockquote>
    `;

    updateEditorWordCount();
}

function convertBlocksToHtml(content) {
    if (!content || !Array.isArray(content)) return '<p></p>';

    let html = '';
    content.forEach(block => {
        if (typeof block === 'string') {
            html += block;
        } else if (block.type === 'lead') {
            html += `<p class="article-lead">${block.text}</p>`;
        } else if (block.type === 'h2') {
            html += `<h2>${block.text}</h2>`;
        } else if (block.type === 'h3') {
            html += `<h3>${block.text}</h3>`;
        } else if (block.type === 'h4') {
            html += `<h4>${block.text}</h4>`;
        } else if (block.type === 'quote') {
            html += `<blockquote class="article-quote">&ldquo;${block.text}&rdquo;</blockquote>`;
        } else if (block.type === 'callout') {
            html += `
                <div class="article-callout">
                    <div class="article-callout-title">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        <span>${block.title || 'Pro Tip'}</span>
                    </div>
                    <p class="article-callout-text">${block.text}</p>
                </div>
            `;
        } else if (block.type === 'image') {
            html += `
                <figure class="article-media-figure">
                    <img src="${block.url}" alt="${block.alt || 'Article Image'}" class="article-inline-img">
                    ${block.caption ? `<figcaption class="article-caption">${block.caption}</figcaption>` : ''}
                </figure>
            `;
        } else if (block.type === 'video') {
            html += `
                <div class="article-video-wrapper">
                    <iframe src="${block.url}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            `;
        } else {
            html += `<p>${block.text || ''}</p>`;
        }
    });

    return html;
}

// ── WYSIWYG Formatting Engine ────────────────────────────────
function execCmd(command, value = null) {
    document.getElementById('articleWysiwygCanvas').focus();
    document.execCommand(command, false, value);
    updateEditorWordCount();
}

function formatHeading(tag) {
    const canvas = document.getElementById('articleWysiwygCanvas');
    canvas.focus();

    if (tag === 'lead') {
        const selection = window.getSelection();
        if (!selection.rangeCount) return;
        const range = selection.getRangeAt(0);
        const node = selection.anchorNode;
        const parent = node.nodeType === 3 ? node.parentNode : node;
        if (parent && parent.tagName === 'P') {
            parent.className = 'article-lead';
        } else {
            document.execCommand('formatBlock', false, 'p');
            const newP = window.getSelection().anchorNode.parentNode;
            if (newP) newP.className = 'article-lead';
        }
    } else {
        document.execCommand('formatBlock', false, `<${tag}>`);
    }
}

function formatInlineCode() {
    const selection = window.getSelection();
    if (!selection.isCollapsed) {
        const text = selection.toString();
        document.execCommand('insertHTML', false, `<code>${text}</code>`);
    }
}

function insertQuoteBlock() {
    const selection = window.getSelection();
    const text = selection.toString() || 'Add inspirational retail advice or key quote here...';
    const quoteHtml = `<blockquote class="article-quote">&ldquo;${text}&rdquo;</blockquote><p></p>`;
    document.execCommand('insertHTML', false, quoteHtml);
}

function insertCalloutBlock() {
    const calloutHtml = `
        <div class="article-callout">
            <div class="article-callout-title">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                <span>Pro Tip for Retailers</span>
            </div>
            <p class="article-callout-text">Highlight an actionable recommendation, formula, or store workflow trick here.</p>
        </div>
        <p></p>
    `;
    document.execCommand('insertHTML', false, calloutHtml);
}

// ── Media & Link Dialog Handlers ─────────────────────────────
function saveSelection() {
    const sel = window.getSelection();
    if (sel.getRangeAt && sel.rangeCount) {
        savedSelectionRange = sel.getRangeAt(0);
    }
}

function restoreSelection() {
    if (savedSelectionRange) {
        const sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(savedSelectionRange);
    }
}

function openMediaDialog(type) {
    saveSelection();
    if (type === 'image') {
        document.getElementById('inlineImageUrl').value = '';
        document.getElementById('inlineImageAlt').value = '';
        document.getElementById('inlineImageCaption').value = '';
        document.getElementById('imageInsertDialog').classList.add('active');
    } else if (type === 'video') {
        document.getElementById('videoEmbedUrl').value = '';
        document.getElementById('videoInsertDialog').classList.add('active');
    } else if (type === 'link') {
        const text = window.getSelection().toString();
        document.getElementById('hyperlinkText').value = text;
        document.getElementById('hyperlinkUrl').value = '';
        document.getElementById('linkInsertDialog').classList.add('active');
    }
}

function closeMediaDialog(dialogId) {
    document.getElementById(dialogId).classList.remove('active');
}

function confirmInsertImage() {
    const url = document.getElementById('inlineImageUrl').value.trim();
    const alt = document.getElementById('inlineImageAlt').value.trim() || 'Article Graphic';
    const caption = document.getElementById('inlineImageCaption').value.trim();

    if (!url) {
        alert('Please enter an image URL.');
        return;
    }

    closeMediaDialog('imageInsertDialog');
    restoreSelection();

    const figureHtml = `
        <figure class="article-media-figure">
            <img src="${url}" alt="${alt}" class="article-inline-img">
            ${caption ? `<figcaption class="article-caption">${caption}</figcaption>` : ''}
        </figure>
        <p></p>
    `;

    document.getElementById('articleWysiwygCanvas').focus();
    document.execCommand('insertHTML', false, figureHtml);
    updateEditorWordCount();
}

function confirmInsertVideo() {
    let input = document.getElementById('videoEmbedUrl').value.trim();
    if (!input) {
        alert('Please enter a video URL.');
        return;
    }

    let embedUrl = input;
    // Format YouTube links
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

    closeMediaDialog('videoInsertDialog');
    restoreSelection();

    const videoHtml = `
        <div class="article-video-wrapper">
            <iframe src="${embedUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <p></p>
    `;

    document.getElementById('articleWysiwygCanvas').focus();
    document.execCommand('insertHTML', false, videoHtml);
    updateEditorWordCount();
}

function confirmInsertLink() {
    const url = document.getElementById('hyperlinkUrl').value.trim();
    const text = document.getElementById('hyperlinkText').value.trim() || url;

    if (!url) {
        alert('Please enter a destination URL.');
        return;
    }

    closeMediaDialog('linkInsertDialog');
    restoreSelection();

    const linkHtml = `<a href="${url}" target="_blank" rel="noopener noreferrer" style="color: #ff6600; text-decoration: underline;">${text}</a>`;
    document.getElementById('articleWysiwygCanvas').focus();
    document.execCommand('insertHTML', false, linkHtml);
}

// ── Hero Thumbnail & Gallery Controls ─────────────────────────
function updateHeroThumbnailPreview(url) {
    const img = document.getElementById('sidebarHeroImg');
    const placeholder = document.getElementById('sidebarHeroPlaceholder');

    if (url && url.trim().length > 5) {
        img.src = url;
        img.style.display = 'block';
        placeholder.style.display = 'none';
    } else {
        img.style.display = 'none';
        placeholder.style.display = 'block';
    }
}

function selectStockHero(url) {
    document.getElementById('editorThumbnailInput').value = url;
    updateHeroThumbnailPreview(url);
}

// ── Title & Slug Auto Generation ─────────────────────────────
function handleTitleInput(title) {
    if (!document.getElementById('editorArticleId').value) {
        generateSlugFromTitle();
    }
    updatePreviewMeta();
}

function generateSlugFromTitle() {
    const title = document.getElementById('editorTitleInput').value;
    const slug = title
        .toLowerCase()
        .replace(/[^\w\s-]/g, '')
        .trim()
        .replace(/\s+/g, '-');
    document.getElementById('editorSlugInput').value = slug;
}

// ── Word Count & Live Stats ──────────────────────────────────
function updateEditorWordCount() {
    const canvas = document.getElementById('articleWysiwygCanvas');
    const text = canvas.innerText || '';
    const words = text.trim() ? text.trim().split(/\s+/).length : 0;
    const readTimeMinutes = Math.max(1, Math.ceil(words / 180));

    document.getElementById('editorStatsText').innerHTML = `${words} words &bull; ${readTimeMinutes} min read`;
    
    // Auto-update read time input if not manually modified
    const readTimeInput = document.getElementById('editorReadTimeInput');
    if (readTimeInput && !readTimeInput.dataset.manual) {
        readTimeInput.value = `${readTimeMinutes} min read`;
    }
}

// ── Live Preview Generator ───────────────────────────────────
function buildLivePreview() {
    const title = document.getElementById('editorTitleInput').value.trim() || 'Untitled Article';
    const category = document.getElementById('editorCategorySelect').value;
    const author = document.getElementById('editorAuthorInput').value.trim() || 'ShopKite Editorial Team';
    const authorRole = document.getElementById('editorAuthorRoleInput').value.trim() || 'Retail Advisory';
    const date = document.getElementById('editorDateInput').value.trim() || '{{ date("M d, Y") }}';
    const readTime = document.getElementById('editorReadTimeInput').value.trim() || '5 min read';
    const thumbnail = document.getElementById('editorThumbnailInput').value.trim();
    const wysiwygContent = document.getElementById('articleWysiwygCanvas').innerHTML;

    document.getElementById('previewArticleTitle').innerText = title;
    document.getElementById('previewCategoryBadge').innerText = category;
    document.getElementById('previewAuthorName').innerText = author;
    document.getElementById('previewAuthorMeta').innerText = `${authorRole} • ${date} • ${readTime}`;
    document.getElementById('previewBioAuthor').innerText = `Written by ${author}`;

    const heroWrap = document.getElementById('previewHeroWrap');
    const heroImg = document.getElementById('previewHeroImg');
    if (thumbnail) {
        heroImg.src = thumbnail;
        heroWrap.style.display = 'block';
    } else {
        heroWrap.style.display = 'none';
    }

    document.getElementById('previewContentBody').innerHTML = wysiwygContent;
}

function updatePreviewMeta() {
    const badge = document.getElementById('previewCategoryBadge');
    if (badge) badge.innerText = document.getElementById('editorCategorySelect').value;
}

// ── Save Article Changes ─────────────────────────────────────
function saveArticleChanges() {
    const id = document.getElementById('editorArticleId').value;
    const title = document.getElementById('editorTitleInput').value.trim();
    const slug = document.getElementById('editorSlugInput').value.trim();
    const category = document.getElementById('editorCategorySelect').value;
    const readTime = document.getElementById('editorReadTimeInput').value.trim();
    const date = document.getElementById('editorDateInput').value.trim();
    const author = document.getElementById('editorAuthorInput').value.trim();
    const authorRole = document.getElementById('editorAuthorRoleInput').value.trim();
    const thumbnail = document.getElementById('editorThumbnailInput').value.trim();
    const excerpt = document.getElementById('editorExcerptTextarea').value.trim();
    const featured = document.getElementById('editorFeaturedSwitch').checked;
    const wysiwygHtml = document.getElementById('articleWysiwygCanvas').innerHTML;

    if (!title) {
        alert('Please provide an article title.');
        return;
    }

    if (id) {
        // Update existing in local DB
        const article = window.blogArticlesDatabase.find(a => a.id == id);
        if (article) {
            article.title = title;
            article.slug = slug;
            article.category = category;
            article.read_time = readTime;
            article.date = date;
            article.author = author;
            article.author_role = authorRole;
            article.thumbnail = thumbnail;
            article.excerpt = excerpt;
            article.featured = featured;
            article.raw_html = wysiwygHtml;

            // Update DOM row
            const titleEl = document.getElementById('table-title-' + id);
            const slugEl = document.getElementById('table-slug-' + id);
            const catEl = document.getElementById('table-category-' + id);
            const authorEl = document.getElementById('table-author-' + id);
            const roleEl = document.getElementById('table-author-role-' + id);
            const readEl = document.getElementById('table-readtime-' + id);
            const dateEl = document.getElementById('table-date-' + id);
            const thumbEl = document.getElementById('table-thumb-' + id);

            if (titleEl) titleEl.innerText = title;
            if (slugEl) slugEl.innerText = '/blog/' + slug;
            if (catEl) catEl.innerText = category;
            if (authorEl) authorEl.innerText = author;
            if (roleEl) roleEl.innerText = authorRole;
            if (readEl) readEl.innerText = readTime;
            if (dateEl) dateEl.innerText = date;
            if (thumbEl && thumbnail) thumbEl.src = thumbnail;
        }
        showAdminToast(`Article "${title}" updated and published successfully!`, 'success');
    } else {
        // New article created
        const newId = window.blogArticlesDatabase.length + 1;
        const newArticle = {
            id: newId,
            title,
            slug: slug || `article-${newId}`,
            category,
            category_slug: category.toLowerCase().replace(/\s+/g, '-'),
            read_time: readTime,
            date,
            author,
            author_role: authorRole,
            thumbnail: thumbnail || 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1000&q=80',
            excerpt,
            featured,
            raw_html: wysiwygHtml
        };
        window.blogArticlesDatabase.unshift(newArticle);

        // Prepend to table
        const tbody = document.getElementById('articlesTableBody');
        if (tbody) {
            const tr = document.createElement('tr');
            tr.id = 'article-row-' + newId;
            tr.innerHTML = `
                <td>
                    <img src="${newArticle.thumbnail}" alt="${newArticle.title}" class="admin-item-thumb" id="table-thumb-${newId}">
                </td>
                <td>
                    <div><strong id="table-title-${newId}">${newArticle.title}</strong></div>
                    <span style="font-size: 11.5px; color: #94a3b8; font-family: monospace;" id="table-slug-${newId}">/blog/${newArticle.slug}</span>
                </td>
                <td>
                    <span class="admin-status-badge badge-verified" style="background: rgba(255, 102, 0, 0.08); border-color: rgba(255, 102, 0, 0.2); color: #ff6600;" id="table-category-${newId}">
                        ${newArticle.category}
                    </span>
                </td>
                <td>
                    <div><span style="font-size: 13px; font-weight: 500;" id="table-author-${newId}">${newArticle.author}</span></div>
                    <span style="font-size: 11.5px; color: #64748b;" id="table-author-role-${newId}">${newArticle.author_role}</span>
                </td>
                <td>
                    <span style="font-size: 12.5px; color: #475569;" id="table-readtime-${newId}">${newArticle.read_time}</span>
                </td>
                <td>
                    <span style="font-size: 12.5px; color: #64748b;" id="table-date-${newId}">${newArticle.date}</span>
                </td>
                <td style="text-align: right;">
                    <div class="admin-action-btn-group" style="justify-content: flex-end; gap: 8px;">
                        <button type="button" class="admin-secondary-btn" style="padding: 5px 12px; font-size: 12px;" onclick="editBlogArticle(${newId})">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            <span>Edit</span>
                        </button>
                        <button type="button" class="admin-delete-btn" style="padding: 5px 12px; font-size: 12px;" onclick="openDeleteArticleModal(${newId}, '${newArticle.title.replace(/'/g, "\\'")}')">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            <span>Delete</span>
                        </button>
                        <a href="/blog/${newArticle.slug}" target="_blank" class="admin-action-btn" title="View live article" aria-label="View live article">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                        </a>
                    </div>
                </td>
            `;
            tbody.insertBefore(tr, tbody.firstChild);
        }

        showAdminToast(`New article "${title}" drafted and published!`, 'success');
    }

    closeBlogEditor();
}
</script>
@endpush
@endsection
