<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard — ShopKite Merchant')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,300;1,400&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}?v={{ filemtime(public_path('img/favicon.png')) }}">

    <!-- Admin Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
    @yield('extra_css')

    <!-- Synchronous Pre-paint Script to Prevent FOUC / Sidebar Flicker -->
    <script>
        (function () {
            try {
                if (localStorage.getItem('shopkite_admin_sidebar_collapsed') === 'true' && window.innerWidth > 768) {
                    document.documentElement.classList.add('sidebar-collapsed');
                }
            } catch (e) {}
        })();
    </script>
</head>

<body class="admin-body">

    <div class="admin-layout">

        <!-- ── 1. Collapsible Left Sidebar ───────────────────────── -->
        <aside class="admin-sidebar" id="adminSidebar">
            <!-- Sidebar Header / Brand -->
            <div class="admin-sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="admin-logo-link">
                    <div class="admin-logo-brand">
                        <span class="admin-logo-title">ShopKite</span>
                        <span class="admin-logo-badge">Admin Suite</span>
                    </div>
                </a>
                <button type="button" class="admin-collapse-toggle-btn" id="sidebarCollapseToggle" title="Toggle Sidebar" aria-label="Toggle Sidebar">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="admin-sidebar-nav" aria-label="Admin Navigation">
                <div class="admin-nav-section-title">Overview</div>
                <a href="{{ route('admin.dashboard') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   data-title="Dashboard">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        <span class="admin-nav-text">Dashboard</span>
                    </div>
                </a>

                <div class="admin-nav-section-title">Catalog &amp; Master Data</div>
                <a href="{{ route('admin.products') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.products') ? 'active' : '' }}"
                   data-title="Products (SKUs)">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                        <span class="admin-nav-text">Products (SKUs)</span>
                    </div>
                    <span class="admin-nav-badge">App</span>
                </a>

                <a href="{{ route('admin.barcodes') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.barcodes') ? 'active' : '' }}"
                   data-title="Barcode Products">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="5" x2="3" y2="19"></line>
                            <line x1="7" y1="5" x2="7" y2="19"></line>
                            <line x1="11" y1="5" x2="11" y2="19"></line>
                            <line x1="15" y1="5" x2="15" y2="19"></line>
                            <line x1="19" y1="5" x2="19" y2="19"></line>
                            <line x1="21" y1="5" x2="21" y2="19"></line>
                        </svg>
                        <span class="admin-nav-text">Barcode Products</span>
                    </div>
                </a>

                <a href="{{ route('admin.categories') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}"
                   data-title="Categories">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                        <span class="admin-nav-text">Categories</span>
                    </div>
                </a>

                <a href="{{ route('admin.manufacturers') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.manufacturers') ? 'active' : '' }}"
                   data-title="Manufacturers">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="admin-nav-text">Manufacturers</span>
                    </div>
                </a>

                <div class="admin-nav-section-title">Operations &amp; Commerce</div>
                <a href="{{ route('admin.merchants') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.merchants') ? 'active' : '' }}"
                   data-title="Merchants">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="admin-nav-text">Merchants</span>
                    </div>
                </a>

                <a href="{{ route('admin.enterprise') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.enterprise') ? 'active' : '' }}"
                   data-title="Enterprise">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                            <path d="M9 22v-4h6v4"></path>
                            <path d="M8 6h.01"></path>
                            <path d="M16 6h.01"></path>
                            <path d="M8 10h.01"></path>
                            <path d="M16 10h.01"></path>
                            <path d="M8 14h.01"></path>
                            <path d="M16 14h.01"></path>
                        </svg>
                        <span class="admin-nav-text">Enterprise</span>
                    </div>
                    <span class="admin-nav-badge" style="background:#fff7ed; color:#ea580c; border:1px solid #fed7aa; font-size:10px;">Leads</span>
                </a>

                <a href="{{ route('admin.transactions') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.transactions') ? 'active' : '' }}"
                   data-title="Transactions">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 3v18l12-18v18"></path>
                            <line x1="3" y1="9" x2="21" y2="9"></line>
                            <line x1="3" y1="15" x2="21" y2="15"></line>
                        </svg>
                        <span class="admin-nav-text">Transactions</span>
                    </div>
                </a>

                <a href="{{ route('admin.store_sales') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.store_sales') ? 'active' : '' }}"
                   data-title="Store Sales">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <span class="admin-nav-text">Store Sales</span>
                    </div>
                </a>

                <div class="admin-nav-section-title">System &amp; Intelligence</div>
                <a href="{{ route('admin.analytics') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.analytics') ? 'active' : '' }}"
                   data-title="App Analytics">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="20" x2="18" y2="10"></line>
                            <line x1="12" y1="20" x2="12" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="14"></line>
                        </svg>
                        <span class="admin-nav-text">App Analytics</span>
                    </div>
                    <span class="admin-nav-badge" style="background:#fff7ed; color:#ea580c; border: 1px solid #fed7aa; font-size:10px;">Live</span>
                </a>

                <a href="{{ route('admin.users') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}"
                   data-title="Users">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span class="admin-nav-text">Users</span>
                    </div>
                </a>

                <div class="admin-nav-section-title">Content &amp; Help</div>
                <a href="{{ route('admin.faqs') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.faqs') ? 'active' : '' }}"
                   data-title="FAQs">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        <span class="admin-nav-text">FAQs</span>
                    </div>
                </a>

                <a href="{{ route('admin.blog') }}"
                   class="admin-nav-link {{ request()->routeIs('admin.blog') ? 'active' : '' }}"
                   data-title="Blog Articles">
                    <div class="admin-nav-link-content">
                        <svg class="admin-nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        <span class="admin-nav-text">Blog Articles</span>
                    </div>
                </a>
            </nav>

            <!-- Sidebar User Profile Footer -->
            <div class="admin-sidebar-footer">
                <div class="admin-user-profile">
                    <div class="admin-user-avatar">SK</div>
                    <div class="admin-user-info">
                        <span class="admin-user-name">Super Admin</span>
                        <span class="admin-user-role">Platform Operations</span>
                    </div>
                </div>
                <a href="{{ route('home') }}" class="admin-return-store-link" title="Exit to Public Site" aria-label="Exit to Public Site">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                </a>
            </div>
        </aside>

        <!-- Mobile Drawer Overlay Backdrop -->
        <div class="admin-modal-backdrop" id="adminMobileOverlay"></div>

        <!-- ── 2. Main Content Canvas ────────────────────────────── -->
        <div class="admin-main-wrapper">
            <!-- Top App Bar -->
            <header class="admin-top-bar">
                <div class="admin-top-left">
                    <button type="button" class="admin-mobile-menu-btn" id="adminMobileMenuBtn" aria-label="Open mobile menu">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>

                    <nav class="admin-breadcrumbs" aria-label="Breadcrumb">
                        <a href="{{ route('admin.dashboard') }}">Admin</a>
                        <span>/</span>
                        <span class="current">@yield('breadcrumb_title', 'Dashboard')</span>
                    </nav>
                </div>

                <div class="admin-top-right">
                    <div class="admin-live-status-pill">
                        <span class="admin-live-status-dot"></span>
                        <span>ShopKite Server Active</span>
                    </div>

                    <a href="{{ route('home') }}" target="_blank" class="admin-view-site-btn">
                        <span>View Live Store</span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                    </a>
                </div>
            </header>

            <!-- Main Page Content -->
            <main class="admin-content-canvas">
                @yield('content')
            </main>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}?v={{ filemtime(public_path('js/admin.js')) }}"></script>
    @yield('extra_js')
    @stack('scripts')
</body>

</html>
