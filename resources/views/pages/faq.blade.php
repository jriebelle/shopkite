@extends('layouts.app')

@section('title', 'Frequently Asked Questions — ShopKite Merchant')
@section('meta_description', 'Find answers to common questions about using ShopKite Merchant POS app, managing products, sales, inventory, customers, supplies, deliveries, and stores.')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/faq.css') }}?v={{ filemtime(public_path('css/faq.css')) }}">
@endsection

@section('content')
<main class="faq-page-wrapper">
    <!-- Overlay for Mobile Slide-in Drawer -->
    <div class="faq-sidebar-overlay" id="faqSidebarOverlay"></div>

    <!-- Left Sticky Sidebar Tree -->
    <aside class="faq-sidebar" id="faqSidebar">
        <div class="faq-sidebar-header">
            <span class="faq-sidebar-title">Categories</span>
            <button type="button" class="faq-sidebar-toggle" id="faqSidebarToggle" title="Toggle Panel" aria-label="Toggle Panel">
                <svg class="faq-toggle-icon-desktop" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                <svg class="faq-toggle-icon-mobile" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <nav class="faq-tree-nav">
            <div class="faq-tree-group open" data-category="getting-started">
                <div class="faq-tree-header" data-tooltip="Getting Started">
                    <div class="faq-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <span class="faq-nav-label">Getting Started</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#gs-about" class="faq-tree-subitem sub-active" data-faq="gs-about">About Us & What is ShopKite?</a>
                    <a href="#gs-download" class="faq-tree-subitem " data-faq="gs-download">How To Download The Shopkite Merchant App</a>
                    <a href="#gs-signup" class="faq-tree-subitem " data-faq="gs-signup">How To Sign Up (Register Your Business)</a>
                    <a href="#gs-signin" class="faq-tree-subitem " data-faq="gs-signin">How To Sign In</a>
                </div>
            </div>
            <div class="faq-tree-group " data-category="sales">
                <div class="faq-tree-header" data-tooltip="Sales">
                    <div class="faq-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    </div>
                    <span class="faq-nav-label">Sales</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#sale-make" class="faq-tree-subitem " data-faq="sale-make">How To Make A Sale (Scanning & Searching)</a>
                    <a href="#sale-discount" class="faq-tree-subitem " data-faq="sale-discount">How To Apply Discounts To A Sale</a>
                    <a href="#sale-receipt" class="faq-tree-subitem " data-faq="sale-receipt">How To Print Receipts After A Sale</a>
                    <a href="#sale-pause" class="faq-tree-subitem " data-faq="sale-pause">How To Pause A Sale</a>
                    <a href="#sale-owing" class="faq-tree-subitem " data-faq="sale-owing">What Is An Owing Record & How To Apply It</a>
                    <a href="#sale-pending" class="faq-tree-subitem " data-faq="sale-pending">How To Check For Pending Sales On A Device</a>
                    <a href="#sale-refund" class="faq-tree-subitem " data-faq="sale-refund">How To Refund A Sale</a>
                    <a href="#sale-transfer" class="faq-tree-subitem " data-faq="sale-transfer">How To Transfer A Sale To A Checkout Staff</a>
                    <a href="#sale-receive" class="faq-tree-subitem " data-faq="sale-receive">How To Receive & Complete A Sale Sent By Sales Staff</a>
                </div>
            </div>
            <div class="faq-tree-group " data-category="products">
                <div class="faq-tree-header" data-tooltip="Products & Inventory">
                    <div class="faq-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                    </div>
                    <span class="faq-nav-label">Products & Inventory</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#prod-add" class="faq-tree-subitem " data-faq="prod-add">How To Add A New Product (Search, Scan & Custom)</a>
                    <a href="#prod-delete" class="faq-tree-subitem " data-faq="prod-delete">How To Delete A Product</a>
                    <a href="#prod-move" class="faq-tree-subitem " data-faq="prod-move">How To Move Products Across Stores / Warehouses</a>
                    <a href="#prod-reset-qty" class="faq-tree-subitem " data-faq="prod-reset-qty">How To Reset The Quantity Of A Product To Zero</a>
                    <a href="#prod-expiry" class="faq-tree-subitem " data-faq="prod-expiry">How To Check Expiring Products</a>
                    <a href="#prod-min-qty" class="faq-tree-subitem " data-faq="prod-min-qty">What Is Minimum Quantity & Low-Stock Alerts?</a>
                    <a href="#prod-volume" class="faq-tree-subitem " data-faq="prod-volume">What Is Volume Pricing & How To Set It?</a>
                    <a href="#prod-history" class="faq-tree-subitem " data-faq="prod-history">How To Check A Product's History</a>
                </div>
            </div>
            <div class="faq-tree-group " data-category="customer">
                <div class="faq-tree-header" data-tooltip="Customer Management">
                    <div class="faq-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <span class="faq-nav-label">Customer Management</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#cust-add" class="faq-tree-subitem " data-faq="cust-add">How To Add A New Customer</a>
                    <a href="#cust-update" class="faq-tree-subitem " data-faq="cust-update">How To Update Customer Details</a>
                    <a href="#cust-birthday" class="faq-tree-subitem " data-faq="cust-birthday">How To Check Upcoming Customer Birthdays</a>
                </div>
            </div>
            <div class="faq-tree-group " data-category="delivery">
                <div class="faq-tree-header" data-tooltip="Delivery & Orders">
                    <div class="faq-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </div>
                    <span class="faq-nav-label">Delivery & Orders</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#deliv-agents" class="faq-tree-subitem " data-faq="deliv-agents">Who Are Delivery Agents & How Do They Work?</a>
                    <a href="#deliv-rates" class="faq-tree-subitem " data-faq="deliv-rates">How To Add Delivery Rates</a>
                    <a href="#deliv-check" class="faq-tree-subitem " data-faq="deliv-check">How To Check & Manage Deliveries</a>
                </div>
            </div>
            <div class="faq-tree-group " data-category="supply">
                <div class="faq-tree-header" data-tooltip="Supply & Restocking">
                    <div class="faq-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                    </div>
                    <span class="faq-nav-label">Supply & Restocking</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#sup-add" class="faq-tree-subitem " data-faq="sup-add">How To Add New Suppliers</a>
                    <a href="#sup-update" class="faq-tree-subitem " data-faq="sup-update">How To Update Supplier's Records</a>
                    <a href="#sup-record" class="faq-tree-subitem " data-faq="sup-record">How To Record A New Supply</a>
                    <a href="#sup-records" class="faq-tree-subitem " data-faq="sup-records">What Are Supply Records & How To Track Them?</a>
                </div>
            </div>
            <div class="faq-tree-group " data-category="expenses">
                <div class="faq-tree-header" data-tooltip="Expenses">
                    <div class="faq-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                    </div>
                    <span class="faq-nav-label">Expenses</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#exp-record" class="faq-tree-subitem " data-faq="exp-record">How To Record A New Expense</a>
                    <a href="#exp-view" class="faq-tree-subitem " data-faq="exp-view">How To View All My Expenses</a>
                </div>
            </div>
            <div class="faq-tree-group " data-category="stores">
                <div class="faq-tree-header" data-tooltip="Stores, Warehouses & Staff">
                    <div class="faq-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <span class="faq-nav-label">Stores, Warehouses & Staff</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#store-create" class="faq-tree-subitem " data-faq="store-create">How To Create A New Store Or Warehouse</a>
                    <a href="#store-switch" class="faq-tree-subitem " data-faq="store-switch">How To Switch Accounts Between Stores</a>
                    <a href="#store-staff" class="faq-tree-subitem " data-faq="store-staff">How To Manage Staff & Permissions In My Store</a>
                    <a href="#store-update" class="faq-tree-subitem " data-faq="store-update">How To Update Details On My Store / Warehouse</a>
                    <a href="#store-subscription" class="faq-tree-subitem " data-faq="store-subscription">How To Check My Subscription Status</a>
                </div>
            </div>
            <div class="faq-tree-group " data-category="general">
                <div class="faq-tree-header" data-tooltip="General Settings & Data">
                    <div class="faq-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                    </div>
                    <span class="faq-nav-label">General Settings & Data</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#gen-notif" class="faq-tree-subitem " data-faq="gen-notif">How To Check Notifications</a>
                    <a href="#gen-export" class="faq-tree-subitem " data-faq="gen-export">How To Export My Store Records</a>
                    <a href="#gen-reset-store" class="faq-tree-subitem " data-faq="gen-reset-store">How To Reset Quantities Of All Products To Zero</a>
                    <a href="#gen-payment" class="faq-tree-subitem " data-faq="gen-payment">How To Add Payment Methods To My Store</a>
                </div>
            </div>
            <div class="faq-tree-group " data-category="extras">
                <div class="faq-tree-header" data-tooltip="Extras & App Info">
                    <div class="faq-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    </div>
                    <span class="faq-nav-label">Extras & App Info</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#extra-devices" class="faq-tree-subitem " data-faq="extra-devices">Can I Use The ShopKite App On Multiple Devices?</a>
                    <a href="#extra-update" class="faq-tree-subitem " data-faq="extra-update">How To Update The ShopKite Merchant App</a>
                    <a href="#extra-pin" class="faq-tree-subitem " data-faq="extra-pin">How To Reset Your PIN</a>
                    <a href="#extra-insights" class="faq-tree-subitem " data-faq="extra-insights">ShopKite Insights & Performance Analytics</a>
                </div>
            </div>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <section class="faq-main-content">
        <!-- Mobile Drawer Trigger Button -->
        <button type="button" class="faq-mobile-drawer-btn" id="faqMobileDrawerBtn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
            <span>Browse Category Topics</span>
        </button>

        <!-- Page Header -->
        <div class="faq-header">
            <h1 class="faq-title">Frequently Asked Questions</h1>
            <p class="faq-subtitle">Need help with ShopKite Merchant? Search keywords or browse topics below to learn how to manage products, record sales, track inventory, and scale your business.</p>
        </div>

        <!-- Sticky Search Bar -->
        <div class="faq-search-wrap">
            <div class="faq-search-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
            </div>
            <input type="text" id="faqSearchInput" class="faq-search-input" placeholder="Search FAQs by question or topic (e.g. sign up, receipt, stock)..." aria-label="Search FAQs">
        </div>

        <!-- No Results Box -->
        <div class="faq-no-results" id="faqNoResults">
            <p>No matching questions found. Try searching with different keywords or browse the categories on the left.</p>
        </div>

        <!-- FAQ Categories & Accordion Groups -->
        <!-- Category: Getting Started -->
        <section class="faq-category-section" id="getting-started">
            <h2 class="faq-category-header">
                <span class="faq-cat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </span>
                Getting Started
            </h2>
            <div class="faq-accordion-group">
                <div class="faq-accordion-card open" id="gs-about" data-faq="gs-about">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">About Us & What is ShopKite?</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">What is ShopKite?</h5><p class="faq-text">ShopKite Merchant is an inventory management tool that makes it very easy to run your business. It caters to a variety of businesses including supermarkets, pharmacies, grocery stores, bookstores, and home-based sellers. Here's how ShopKite Merchant can benefit your business:</p><p class="faq-text">1. <strong>Inventory Management</strong>: Track inventory levels across different products easily. No need for additional hardware like a computer, UPS, or barcode scanner. All management can be done conveniently through a mobile device.</p><p class="faq-text">2. <strong>Sales Monitoring</strong>: Monitor daily sales on the go. Keep track of sales records by day, week, month, or year to assess business performance instantly. Carry your business with you wherever you go!</p><p class="faq-text">3. <strong>Online Selling</strong>: Easily transition to online sales with ShopKite Merchant. Reach a wider customer base by selling products online directly through the app.</p><p class="faq-text">4. <strong>Accessibility</strong>: Available for both Android and iOS (iPhone &amp; iPad) users, making it accessible to a wide range of mobile devices.</p><p class="faq-text">5. <strong>User-Friendly Interface:</strong> Download, set up, and start selling quickly without complex setup processes. Manage day-to-day sales and products seamlessly through a seamless interface.</p><p class="faq-text">6. <strong>Business Insights</strong>: Gain insights into business performance with analytics and reports available at your fingertips.</p><p class="faq-text">Overall, ShopKite Merchant offers a comprehensive solution for retail businesses looking to streamline operations, increase sales, and manage inventory effectively, all from the convenience of a mobile device.</p><p class="faq-text">Find out more about us here:</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="gs-download" data-faq="gs-download">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Download The Shopkite Merchant App</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <div class="faq-video-container"><iframe src="https://www.youtube.com/embed/njxZ6hXpALU?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">To download the ShopKite Merchant App, follow these steps:</p><ol class="faq-step-list"><li>Open your device's app store:</li></ol><ul class="faq-step-list"><li><strong>Play Store</strong> for Android devices.</li><li><strong>App Store</strong> for iPhone/iPad.</li></ul><ol class="faq-step-list"><li>Search for "ShopKite Merchant". Look for the app with a logo featuring a white kite on an orange background.</li><li>Tap on 'Install' or the download icon to install the app on your device.</li><li>Once the download is complete, open the app to sign up and get started.</li></ol><p class="faq-text"><em>(Direct link to the ShopKite Merchant App on the Play Store and App Store)</em></p><p class="faq-text"><strong>Additional Tips</strong></p><ul class="faq-step-list"><li>Remember to keep your app updated for the latest features and security improvements.</li><li>Review the app permissions before installation to understand what access the app requires.</li><li>If you encounter any issues during the download, try restarting your device and attempt downloading again.</li></ul><p class="faq-text"><strong>Troubleshooting Steps</strong></p><ul class="faq-step-list"><li>Ensure you have a stable internet connection before attempting to download the app.</li><li>Confirm that you are searching for the correct app name and logo.</li><li>Check if your device is compatible with the app requirements.</li></ul><p class="faq-text"><strong>Related Questions</strong></p><ul class="faq-step-list"><li><span>Can I use the ShopKite Merchant App on multiple devices?</span></li><li><span>How do I update the ShopKite Merchant App?</span></li></ul>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="gs-signup" data-faq="gs-signup">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Sign Up (Register Your Business)</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <div class="faq-video-container"><iframe src="https://www.youtube.com/embed/fO9j_3r2Ejc?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><h4 class="faq-sub-heading">How To Sign Up (Register)</h4><p class="faq-text">To register your business on the ShopKite Merchant App, follow these simple steps:</p><ol class="faq-step-list"><li>Open the <strong>ShopKite Merchant app</strong> on your device.</li><li>Tap on <strong>“Next”</strong> or swipe left four times to learn about the app's features.</li><li>After the last hint, tap <strong>“Continue”</strong> to go to the sign-up page.</li><li>Enter your <strong>First Name</strong>, for example, "Uche".</li><li>Put in your <strong>Last Name</strong> or Surname, for example, "Olufemi".</li><li>Type in your <strong>business name</strong>, such as "WAZOBIA Enterprises".</li><li>Click on <strong>Store Type</strong> and choose the option that fits your business, like "Supermarket", or select <strong>“Others”</strong> and type it manually.</li><li>Provide your <strong>Business Email Address</strong>.</li><li>Add your <strong>Business Phone Number</strong>; make sure it's one we can contact you on.</li><li>Create a <strong>4-digit PIN</strong> for security.</li><li>Select the <strong>Country</strong> where your business is based.</li><li>Choose the <strong>State</strong> and then the <strong>City</strong> where your business operates.</li><li>Pick the <strong>Area</strong> within the city where your business is located.</li><li>Select your <strong>local currency</strong> from the options provided.</li><li>Check the box that says <strong>“I agree…”</strong> to enable the “Sign Up” button.</li><li>Finally, tap on <strong>“Sign Up”</strong> to finish your registration!</li></ol><p class="faq-text">Make sure to check your email afterward. You'll need to click on the link sent to you to verify your email address.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="gs-signin" data-faq="gs-signin">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Sign In</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">Follow the steps below to sign in to the ShopKite Merchant App</p><ol class="faq-step-list"><li>Open the<strong> ShopKite Merchant app</strong></li><li>If you're new to the app, tap on <strong>"Skip"</strong> at the bottom left of your screen to head straight to the "Sign in" page.</li><li>Enter your <strong>phone number</strong>—make sure it's the one you used when you signed up(registered).</li><li>Type in the <strong>4-digit PIN</strong> that you set during registration. This will light up the “Sign In” button.</li><li>Select <strong>"Sign In"</strong> at the bottom of the page</li><li>You'll see a list of all your stores and warehouses. Choose one to open by clicking on it.</li><li>Hit <strong>"Continue"</strong> to log into the selected store or warehouse.</li><li>Hang tight while ShopKite gets your records ready. Keep the app open and don't let your screen go to sleep.</li><li>A message will pop up asking if you want to <strong>"Allow"</strong> or <strong>"Don't Allow"</strong> notifications from ShopKite Merchant. Choose <strong>"Allow"</strong> to stay updated on what's happening in your store.</li><li>Watch for the completion animation, then tap <strong>"Continue"</strong> to jump into selling!</li></ol><p class="faq-text">Congratulations! You're all signed in and ready to take on the business world!</p><p class="faq-text"><strong>Troubleshooting</strong>:</p><ul class="faq-step-list"><li>If you can't sign in or the app isn't responding, try closing and reopening the app, or check your internet connection. If problems persist, uninstall and reinstall the app.</li><li>Ensure that you are signing in with the correct phone number.</li></ul><p class="faq-text"><strong>Contact Support</strong>:</p><p class="faq-text">For further assistance, please send us an email: <a href="mailto:hello@shopkite.com.ng" target="_blank" rel="noopener noreferrer">hello@shopkite.com.ng</a></p><p class="faq-text">or WhatsApp on +234 906 2000 393</p><p class="faq-text"><strong>Related Questions</strong></p><ul class="faq-step-list"><li><span>How do I reset my PIN?</span></li><li><span>How do I sign into a different store?</span></li></ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category: Sales -->
        <section class="faq-category-section" id="sales">
            <h2 class="faq-category-header">
                <span class="faq-cat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                </span>
                Sales
            </h2>
            <div class="faq-accordion-group">
                <div class="faq-accordion-card " id="sale-make" data-faq="sale-make">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Make A Sale (Scanning & Searching)</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">How do I Make A Sale by Scanning the Product Barcode?</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/mZsX8B7p5tE?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to Make a Sale by Scanning the Product Barcode:</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. On the “<strong>Sales</strong>” page, tap “Tap here to scan product barcode.”</p><p class="faq-text">3. Optionally, tap “Turn On Flash” for easier scanning.</p><p class="faq-text">4. Hold your phone over the product barcode and wait for it to scan.</p><p class="faq-text">5. Tap on the scanned product name to adjust the quantity:</p><ul class="faq-step-list"><li>Use the minus (-) sign to <strong>reduce</strong>.</li><li>Use the plus (+) sign to <strong>add</strong>.</li><li>Tap “OK” when done.</li></ul><p class="faq-text">6. If you want to add more products, tap “Search or Scan.” Otherwise, tap “Continue” at the bottom of the page.</p><p class="faq-text">7. Optionally, add details like <span>Owing</span>, <span>Customer</span>, and <span>Discount</span>.</p><p class="faq-text">8. Tap “Confirm Sales.”</p><p class="faq-text">9. Choose the payment type and enter the amount paid.</p><p class="faq-text">10. Tap “<strong>Proceed</strong>” to confirm payment.</p><p class="faq-text">11. Tap “Continue.”</p><p class="faq-text">You have successfully completed a sale! Repeat the process to sell more products.</p><p class="faq-text"><strong>Related Questions</strong></p><h5 class="faq-sub-heading">How to Make a Sale by Searching for the Product Name</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/2G3OA-J8_NA?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow the steps below to Make a Sale by Searching for the Product Name:</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. On the “Sales” page, tap “<strong>Tap here to search for a product.</strong>”</p><p class="faq-text">3. Type the full name of the product into the search bar at the top of the page.</p><p class="faq-text">4. Choose to sell as Retail or Wholesale.</p><p class="faq-text">5. Optionally, select a volume price and add the quantity if applicable.</p><p class="faq-text">6. Tap “<strong>Add to Sales List</strong>.”</p><p class="faq-text">7. If you want to add more products, tap “Search or Scan.” Otherwise, tap “Continue” at the bottom of the page.</p><p class="faq-text">8. Optionally, add details like <span>Owing</span>, <span>Customer</span>, and <span>Discount</span>.</p><p class="faq-text">9. Tap “Confirm Sales.”</p><p class="faq-text">10. Choose the Payment Type and enter the amount paid.</p><p class="faq-text">11. Tap “Proceed” to confirm payment.</p><p class="faq-text">12. Tap “Continue.”</p><p class="faq-text">You have successfully completed a sale! Repeat the process to sell more products.</p><p class="faq-text"><strong>Related Questions</strong></p><ul class="faq-step-list"><li><span>How do I use the "Owing" feature?</span></li><li><span>How do I attach a customer to a sale?</span></li><li><span>How do I apply discount to a sale?</span></li><li><span>How do I refund a sale?</span></li></ul><h5 class="faq-sub-heading">How to View Sales Record</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu button at the top right corner of the page.</li><li>Tap on “<strong>Sales Records</strong>”</li><li>You can "<strong>Search with receipt</strong>"</li><li>You also have options to search by "<strong>Time of sale</strong>", "Payment Method", "Customer", "Staff" or "Type of sale, such as <strong>Refunded sales</strong> or <strong>Discounted sales.</strong>"</li><li>Then tap "<strong>View Sales Records</strong>"</li><li>A list will be displayed. You can tap on any of the record to see further details.</li></ol>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="sale-discount" data-faq="sale-discount">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Apply Discounts To A Sale</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">How to apply discounts to a sale</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>The “Sales” page has two options; “Tap here to search for a product” or “Tap here to scan product barcode”</li><li>Make a new sale either by searching or scanning the product barcode.</li><li>Towards the end of the sale, tap on “<strong>Discount</strong>” at the bottom right corner of the page</li><li>Apply discount:</li></ol><ul class="faq-step-list"><li>Choose “<strong>Figure</strong>” and enter the amount (e.g., N100 for a N100 discount),</li><li>or choose “<strong>Percentage</strong>” and enter the percentage (e.g., 5% for a 5% discount).</li></ul><ol class="faq-step-list"><li>You can use the "<span>Customer</span>" feature to attach a customer to this discount sale</li><li>Tap “<strong>Confirm Sales</strong>” once you are done</li><li>Select your payment method and tap “Proceed”</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully added a discount to a sale.</p><p class="faq-text"><strong>Related Questions</strong></p><ul class="faq-step-list"><li><span>How do I attach a customer to a discount sale?</span></li><li><span>How do I see the record of all discounted sales?</span></li></ul>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="sale-receipt" data-faq="sale-receipt">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Print Receipts After A Sale</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">How To Print Receipts After A Sale</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>The “Sales” page has two options; “Tap here to search for a product” or “Tap here to scan product barcode”</li><li>Make a new sale either by searching or scanning</li><li>At the end of the sale, tap on “<strong>Print Receipt</strong>” at the bottom left corner of the page</li><li>Select your printer and tap “<strong>Print</strong>”(make sure your printer is already turned on and connected to the Bluetooth of your Mobile Device)</li></ol><p class="faq-text">Follow this steps whenever you want to print a receipt after a sale.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="sale-pause" data-faq="sale-pause">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Pause A Sale</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <ol class="faq-step-list"><li>Open the ShopKite Merchant app, you will see a Sales page</li><li><strong>Add products</strong> to the sale using the search or barcode scan method.</li><li>If you need to pause the sale, tap <strong>“Pause”</strong> at the bottom middle of the page.</li><li>Choose to either add a name to the paused sale or add it to an existing paused sale.</li></ol><p class="faq-text">Your sale is now paused.</p><p class="faq-text">Paused sales will appear on the Sales page for you to continue or discard as needed.</p><p class="faq-text"><strong>Related Questions</strong></p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="sale-owing" data-faq="sale-owing">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">What Is An Owing Record & How To Apply It</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">If a customer will owe you for a sale (credit sale), you can record the amount owed along with the sale.</p><p class="faq-text">First, you need to make a sale by scanning a barcode or sell by searching for the product name.</p><p class="faq-text">After this, you can follow the steps to apply owing record to a sale.</p><h5 class="faq-sub-heading">How do I apply owing record to a sale?</h5><ol class="faq-step-list"><li>When you are about to confirm a sale, you will notice a " <strong>Owing </strong>" button at the bottom left corner of the page.</li><li>Tap on the owing button to show a pop-up where the amount owed</li><li>By default, the toggle button just below the "<strong>Who is owing</strong>?" header points to "Me" indicating that the business owes the customer. You can tap on this button to change it to customer if the customer is the one owing.</li><li>Type in the amount owed and tap on "<strong>Attach customer</strong>" to select the customer in question.</li><li>Use the search option to find the customer. If the customer is not on the list then you can choose "<strong>Tap here to add new customer</strong>"</li><li>Fill in the details and tap "<strong>Save</strong>". Now you can attach the customer to that sale.</li><li>Proceed to “confirm sales”</li><li>Choose payment method and tap "Continue"</li></ol><p class="faq-text">When you have confirmed the sale, you will be able to view the customers that owe you (or that you owe) in the "Owing Records" section.</p><h5 class="faq-sub-heading">How to view Owing Record</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu button at the top right corner of the page.</li><li>Tap on “<strong>Owing Records</strong>”</li><li>You can use the "Search Customers" feature to find owing records for a particular customer.</li><li>You can also "<strong>Filter</strong>" records to show "all", "Paid" or "Unpaid" records.</li></ol>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="sale-pending" data-faq="sale-pending">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Check For Pending Sales On A Device</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">How to check for pending sales on a device</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar <strong>Menu</strong> button at the top right corner of the page</li><li>Scroll down to the bottom where you see a version number</li><li>Hold down the version number (E.g  Version 4.4.35) for 3 to 5 seconds</li><li>You will see the <strong>Pending Sales</strong> section.</li></ol><p class="faq-text"><strong>Note: </strong></p><ul class="faq-step-list"><li>Pending sales are only available on the device where the sale was made.</li><li>Pending sales are automatically uploaded once the device is connected to an internet source and if it is not, just tap on “<strong>Update Sales</strong>” at the bottom of the pending sales page to update all pending sales.</li></ul>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="sale-refund" data-faq="sale-refund">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Refund A Sale</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">To initiate a refund for a sale, please follow these steps:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap on the three-bar menu button located at the top right corner of the page.</li><li>Navigate to the <strong>Sales</strong> section and select Sales Record.</li><li>Choose your preferred time duration from the "Time of sale" dropdown and tap "View sales record."</li><li>Select the specific sale you wish to refund, then tap "Refund Sale."</li><li>Check the products you intend to refund and specify the quantity for each.</li><li>Tap "Confirm Refund," followed by "<strong>Make Refund</strong>."</li></ol><p class="faq-text">You will be prompted to enter your 4-digit code to confirm the refund.</p><p class="faq-text">Congratulations! You have successfully processed a refund for the sale.</p><p class="faq-text"><strong>Note:</strong> Refunding a sale will add the refunded quantities back to the respective products.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="sale-transfer" data-faq="sale-transfer">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Transfer A Sale To A Checkout Staff</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">Before you begin:</p><p class="faq-text">Both the Sales Staff and the Checkout Staff must be connected to the same router/Wi-Fi (e.g., the store Wi-Fi).</p><p class="faq-text">Steps:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant App and go to the <strong>Sales page</strong>.</li></ol><p class="faq-text">Initiate a new sale. See</p><ol class="faq-step-list"><li>Tap "<strong>Pause Sale"</strong>.</li><li>Enter a name/identifier for the paused sale (e.g., “John-Drinks” or “POS-1”).</li><li>Once you type in a name, an option will appear: "<strong>Send sale to a checkout staff"</strong>.</li><li>Tap this option.</li><li>The checkout staff will receive a notification that a new paused sale has been sent to them.</li></ol><p class="faq-text">You have successfully transferred the sale. The checkout staff will now complete it.</p><p class="faq-text">Repeat the process to transfer more sales.</p><p class="faq-text"><strong>Related Questions</strong></p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="sale-receive" data-faq="sale-receive">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Receive & Complete A Sale Sent By Sales Staff</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">Before you begin:</p><p class="faq-text">Both the Sales Staff and the Checkout Staff must be connected to the same router/Wi-Fi (e.g., the store Wi-Fi).</p><p class="faq-text">Steps:</p><ol class="faq-step-list"><li>When a sales staff sends you a sale, you will receive a notification on your device.</li><li>Open the ShopKite Merchant App and go to the <strong>Sales page</strong>.</li><li>Tap the ShopKite logo at the top middle of the screen to refresh page.</li><li>This will activate a button that says "<strong>Click here to resume paused sale"</strong>.</li><li>Tap the button to view all paused sales.</li><li>Select the paused sale that was transferred to you.</li><li>Tap "<strong>Continue"</strong>.</li><li>Confirm the sale and process the payment to complete the transaction.</li></ol><p class="faq-text">You have successfully completed a sale transferred to you by a sales staff.</p><p class="faq-text"><strong>Related Questions</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category: Products & Inventory -->
        <section class="faq-category-section" id="products">
            <h2 class="faq-category-header">
                <span class="faq-cat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                </span>
                Products & Inventory
            </h2>
            <div class="faq-accordion-group">
                <div class="faq-accordion-card " id="prod-add" data-faq="prod-add">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Add A New Product (Search, Scan & Custom)</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">Add a new Product by Searching</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/GeXjxa88Qiw?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow the steps below to add a product to your store by searching for the product name.</p><p class="faq-text">You have signed up and want to add your products to your store.</p><p class="faq-text">Here's what you do:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant App.</li><li>On the "Sales" page, tap the "<strong>Products</strong>" icon at the bottom.</li><li>On the "Products" page, choose "Tap here to search for a product".</li><li>To search, type the product name in the search bar.</li></ol><ul class="faq-step-list"><li>Select the product from the results and fill in the required details.</li><li>If not found, tap "Tap here to add new product."</li></ul><ol class="faq-step-list"><li>Tap "<strong>Add photo</strong>" and choose an image from the Gallery or Camera (use a white background).</li><li>Fill in the required fields:</li></ol><ul class="faq-step-list"><li>Size (e.g., 35cl)</li><li>Product category</li><li>Cost/Supplier price</li><li>Unit/Selling price</li><li>Quantity</li><li>Minimum quantity</li><li>Volume price</li><li>Expiry date</li></ul><ol class="faq-step-list"><li>Tap "<strong>Add product</strong>" at the bottom, then tap "Continue."</li><li>Repeat the process for each product you want to add.</li></ol><p class="faq-text">You have successfully added a new product</p><p class="faq-text">Repeat the process as many times as needed until all your products have been added to your list.</p><h5 class="faq-sub-heading">Add a new Product by scanning the product barcode</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/jj3dVPmwJg8?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">To add a new product by scanning the product barcode, follow the steps below.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant App</li><li>You will see a “Sales” page</li><li>At the bottom of the “Sales” page, you will see three Icons namely; “Sales” “Insights” and “Products”</li><li>Tap on the <strong>“Products”</strong> icon to reveal the Product page</li><li>The “Products” page has two options; “Tap here to search for a product” or “Tap here to scan product barcode”</li><li>Tap on “<strong>Tap here to scan product barcode</strong>”</li><li>Tap on the flash icon to turn on your flash to make scanning easier (optional)</li><li>Hold your phone over the barcode of the product you wish to add and wait for it to scan</li><li>The product will be displayed with spaces for you to fill in the details of the product</li><li>If the product is not displayed, Tap on “Tap here to add new product”</li><li>Tap on “Add photo”</li><li>Choose how you want to add the image. Either “from Gallery” if you already have the picture on your phone or “from Camera” if you want to take the picture on the spot. Whichever one you choose, try to use a white background for it</li><li>Proceed to fill  in the required fields; size, Cost/supplier price, Unit/selling price, Add Quantity, Minimum Quantity, Add Volume Price, and Expiry date</li><li>Tap “Add product” at the bottom of the page</li><li>Tap “Continue”</li><li>Tap on “Add Product” at the bottom of the page, wait a few seconds for the page to load then</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully added a new product</p><p class="faq-text">Repeat the process as many times as you need to until all your products have been added to your product list.</p><h5 class="faq-sub-heading">How to add pictures to new products on my store</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/mVTHHBo6pL0?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to Add Pictures to New Products on the Shopkite App</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. Tap the <strong>three-bar menu</strong> at the top right corner of the page.</p><p class="faq-text">3. Select “<strong>Add or search products</strong>” from the options.</p><p class="faq-text">4. Enter the product name in full or scan the product barcode.</p><p class="faq-text">5. Tap “<strong>Tap here to add new product”</strong>.</p><p class="faq-text">6. Tap “Add photo”.</p><p class="faq-text">7. Choose how you want to add the image:</p><p class="faq-text">- Select “From Gallery” if you already have the picture on your phone.</p><p class="faq-text">- Select “From Camera” if you want to take the picture on the spot.</p><p class="faq-text">Tip: Use a white background for better image quality.</p><p class="faq-text">8. Fill in the product details.</p><p class="faq-text">9. Tap “Add product” at the bottom of the page.</p><p class="faq-text">10. Tap “Continue”.</p><p class="faq-text">You have successfully attached a photo to a new product. Repeat the process to add more products.</p><h5 class="faq-sub-heading">How do I update a product in my store?</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/dpi3NSOgfr8?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to update the details of existing Products in your store</p><ol class="faq-step-list"><li>Open the ShopKite App</li><li>Tap on the Product icon at the bottom right corner of the page</li><li>Either type in the name of the product or use the barcode scanner to search for the Product you wish to update</li><li>Update any of the fields you wish to update</li><li>Tap “Update Product” at the bottom of the page</li><li>Tap “Continue”</li></ol><p class="faq-text">Repeat the process if you wish to update more Products.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="prod-delete" data-faq="prod-delete">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Delete A Product</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <div class="faq-video-container"><iframe src="https://www.youtube.com/embed/XYP5U6N6AcQ?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to Delete a Product from your store:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Tap on “<strong>Products List</strong>” in the options listed</li><li>Type in the name of the product you want to delete in the search box provided</li><li>Tap on the product when it appears</li><li>Scroll down and tap “<strong>Delete</strong>”, located at the bottom left corner of the page</li><li>Tap yes to confirm delete. Note that you cannot undo it once you confirm!</li><li>Enter your 4-digit <strong>PIN</strong> in the box provided</li><li>Tap “<strong>Delete</strong>” to proceed</li><li>Tap “ Continue”</li></ol><p class="faq-text">You have deleted a product from your store, repeat the process to delete more.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="prod-move" data-faq="prod-move">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Move Products Across Stores / Warehouses</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">How to Move products across stores</h5><p class="faq-text"><strong>Note:</strong> Before you can move products to a store, the following conditions must be met:</p><ul class="faq-step-list"><li>The receiving Staff must be added to the receiving store as a staff member.</li><li>The <strong>“Move Products”</strong> permission must be enabled for this staff.</li><li>The <strong>“Show Staff”</strong> permission must also be enabled for this staff.</li></ul><p class="faq-text"><em>Example: Uche, who is signed in to Store A</em>, wants to move product XYZ to <em>Store B</em>. For this to work, Uche must first be added as a staff member in <em>Store B</em> and must be granted both the <em>“Move Products”</em> and <em>“Show Staff”</em> permissions within <em>Store B</em>.</p><p class="faq-text">Once all conditions are met, follow these steps to Move Products:</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. Tap the three-bar menu at the top right corner.</p><p class="faq-text">3. Tap “<strong>Move Products.</strong>”</p><p class="faq-text">4. You will see two tabs: “Sent” and “Received.”</p><p class="faq-text">5. Tap “Move Products” again.</p><p class="faq-text">6. Scan or search for the products you want to move.</p><p class="faq-text">7. Specify the quantity, minimum quantity, selling price, and expiry date of the products.</p><p class="faq-text">8. Tap “<strong>Add to List.</strong>”</p><p class="faq-text">9. To move additional products, tap the search or scan button at the bottom of the page and repeat steps 6-8.</p><p class="faq-text">10. Tap “Continue” and select the receiving store from your list of stores.</p><p class="faq-text">11. Choose the staff member who will receive the products at the receiving store.</p><p class="faq-text">12. Optionally, add any remarks.</p><p class="faq-text">13. Tap “Confirm” and enter your 4-digit PIN to complete the process.</p><p class="faq-text">You have successfully initiated the product move to the receiving store. Repeat the process to move more products.</p><p class="faq-text">💡 <em>Tip:</em> Using the <strong>“Copy Products”</strong> option when creating subsequent stores makes moving products easier. Also, ensure you are signed in to the store/warehouse you want to move products <strong>from</strong> before starting.</p><h5 class="faq-sub-heading">How to Receive Products moved to your store</h5><p class="faq-text">How to Receive Products Moved from Another Store/Warehouse:</p><p class="faq-text">To receive products transferred from another store, branch, or warehouse, follow these steps:</p><p class="faq-text"><strong>Note:</strong> Using the "Copy products" option when creating subsequent stores makes managing transfers easier.</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. Tap the three-bar menu at the top right corner</p><p class="faq-text">3. Tap “<strong>Move Products</strong>.”</p><p class="faq-text">4. Select the “Received” tab.</p><p class="faq-text">5. Review the list of transfer requests and their statuses (e.g., "pending", "cancelled", "approved").</p><p class="faq-text">6. Tap on the pending move request you wish to receive.</p><p class="faq-text">7. Review the list of products to confirm accuracy.</p><p class="faq-text">8. Tap “<strong>Receive Product(s)</strong>” and validate with your 4-digit PIN.</p><p class="faq-text">9. Wait for the process to complete.</p><p class="faq-text">10. The received products will be successfully added to your product list.</p><p class="faq-text">You have now successfully received the transferred products.</p><h5 class="faq-sub-heading">How to Cancel requests to move products</h5><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. Tap the three-bar menu at the top right corner</p><p class="faq-text">3. Tap “<strong>Move Products</strong>.”</p><p class="faq-text">4. Select the “Received” tab.</p><p class="faq-text">5. Review the list of transfer requests and their statuses (e.g., "pending", "cancelled", "approved").</p><p class="faq-text">6. Tap on the pending move request you wish to receive.</p><p class="faq-text">7. Review the list of products to confirm accuracy.</p><p class="faq-text">8. Tap “<strong>Cancel Request</strong>” and validate with your 4-digit PIN.</p><p class="faq-text">9. Add a reason for cancelling (optional).</p><p class="faq-text">10. Tap "Confirm"</p><p class="faq-text">You have successfully cancelled the request.</p><h5 class="faq-sub-heading">How to Export Moved Product details</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu at the top right corner</li><li>Tap “<strong>Move Products</strong>.”</li><li>Select the “Sent" or "Received” tab and select the move details you want to share</li><li>Tap on it and the details will be displayed. Then select "<strong>Share</strong>" at the bottom of the page.</li><li>Select the file destination' that is, where you want to share it to</li></ol><p class="faq-text">You have successfully exported details for a moved product.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="prod-reset-qty" data-faq="prod-reset-qty">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Reset The Quantity Of A Product To Zero</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <div class="faq-video-container"><iframe src="https://www.youtube.com/embed/rLp2L5bKcw8?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to Reset the Quantity of a Product to Zero</p><p class="faq-text">1. Open the ShopKite Merchant app.</p><p class="faq-text">2. Tap the three-bar <strong>Menu</strong> button at the top right corner of the page.</p><p class="faq-text">3. Select “Products List” from the options.</p><p class="faq-text">4. Enter the name of the product you wish to reset in the search box.</p><p class="faq-text">5. Tap on the product when it appears.</p><p class="faq-text">6. Scroll down and tap “<strong>Reset Quantity</strong>” at the bottom right corner of the page.</p><p class="faq-text">7. Enter your 4-digit <strong>PIN</strong> in the provided box.</p><p class="faq-text">8. Tap “<strong>Confirm</strong>” to proceed.</p><p class="faq-text">9. Tap “Continue”.</p><p class="faq-text">You have successfully reset the quantity of the product to zero. Repeat the process to reset additional products.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="prod-expiry" data-faq="prod-expiry">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Check Expiring Products</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">Follow these steps to check what products are expired or nearing their expiry date:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Tap on “<strong>Product List</strong>” under the “Product” option</li><li>You will see an option to view “Products”, “Expiring”, and “Low Stock”.</li><li>Tap on “Expiring”</li></ol><p class="faq-text">All expiring products or products nearing their expiring date will be displayed for you to see</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="prod-min-qty" data-faq="prod-min-qty">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">What Is Minimum Quantity & Low-Stock Alerts?</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">What is Minimum Quantity?</h5><p class="faq-text">The minimum quantity is the lowest number of items you want to keep in your store. When the inventory level, that is, the number of remaining products falls below this amount, you will get a notification to restock that particular product.</p><p class="faq-text">For example, if you set your minimum quantity for Coca-Cola to 12, you will automatically get a notification to restock Coca-Cola when the quantity drops to 12.</p><h5 class="faq-sub-heading">How to check Low-stock products</h5><p class="faq-text">Follow the steps below to check low-stock products.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Tap on “<strong>Product List</strong>” under the “Product” option</li><li>You will see an option to view “ Products”, “Expiring”, and “Low Stock”.</li><li>Tap on “<strong>Low Stock</strong>”</li><li>All low-stock products will be displayed for you to see</li></ol>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="prod-volume" data-faq="prod-volume">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">What Is Volume Pricing & How To Set It?</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">What is Volume pricing?</h5><p class="faq-text">Volume pricing allows you to set multiple prices for different quantities of a product, enhancing the existing wholesale unit price feature.</p><p class="faq-text">For example, a 35cl PET bottle of Coke sells for N100 each. Typically, twelve bottles would sell for N1,200 (N100 x 12). However, you might offer a discount and sell them for N1,100 as a wholesale price. Volume pricing simplifies setting fixed prices for various quantities, making it easier to apply these prices during a sale.</p><p class="faq-text">You can set volume prices for various packaging types, such as Pack, Roll, Tin, Bag, Crate, Sachet, Carton, and Box. Examples include:</p><p class="faq-text">1. Half (½) carton of biscuits</p><p class="faq-text">2. Three-quarter (¾) crate of eggs</p><p class="faq-text">3. One (1) sachet of a pain-relieving drug</p><p class="faq-text">4. One quarter (¼) of a bag of rice</p><p class="faq-text">Volume pricing helps you manage prices for different quantities of your products.</p><h5 class="faq-sub-heading">How do I add Volume prices to products in my store?</h5><p class="faq-text">Follow these steps to add Volume Price To Products Already Added To Your Store</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>On the “<strong>Sales</strong>” page, tap the “Products” icon at the bottom.</li><li>Search for the product you want to add Volume Pricing by using the "Search for Product" or "Scan Product Barcode" feature.</li><li>Tap on "<strong>Add Volume Price</strong>."</li><li>Choose the relevant option for your product: Pack, Carton, Sachet, Crate, or Bag.</li><li>Select the volume size: Quarter (¼), Half (½), Three-Quarter (¾), or One (1).</li><li>Enter the unit count and selling price for the selected volume size. For example, for Half (½) pack of Coke (35cl), enter a unit count of six (6) and the price.</li><li>Tap "<strong>Add</strong>" at the bottom of the page.</li><li>Repeat steps 6-8 for other volume sizes if applicable (e.g., Half (½), Three-Quarter (¾), One (1)).</li><li>When finished, tap "<strong>Save</strong>" at the bottom of the page.</li></ol><p class="faq-text">11. Tap "Update Product."</p><p class="faq-text">You have successfully added Volume Pricing to a product in your store. Repeat the process to add Volume Pricing to other products.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="prod-history" data-faq="prod-history">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Check A Product's History</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">Follow these steps to Check a Product's History:</p><p class="faq-text">1. Open the ShopKite App.</p><p class="faq-text">2. Tap on the “Product” icon at the bottom right corner of the page.</p><p class="faq-text">3. Enter the product name or use the barcode scanner to search for the product you want to check.</p><p class="faq-text">4. Tap on “<strong>Product History</strong>” at the bottom of the page.</p><p class="faq-text">5. You can Select the duration (e.g., Last Seven days).</p><p class="faq-text">6. The product history will be displayed.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category: Customer Management -->
        <section class="faq-category-section" id="customer">
            <h2 class="faq-category-header">
                <span class="faq-cat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </span>
                Customer Management
            </h2>
            <div class="faq-accordion-group">
                <div class="faq-accordion-card " id="cust-add" data-faq="cust-add">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Add A New Customer</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">How do I Add a New Customer</h5><div class="faq-video-container"><iframe src="https://www.youtube.com/embed/UiXI3F0YjnU?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">The customer feature allows you to keep a detailed record of all your regular customers.</p><p class="faq-text">When making a sale, you can attach your customer to the sale.</p><p class="faq-text">Follow these steps to add a new customer:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu button at the top right corner of the page.</li><li>Scroll down and tap on the “<strong>Customer</strong>” button.</li><li>Tap on “<strong>New Customer</strong>” from the listed options.</li><li>Fill in the required details and any Extra Details you want to include</li><li>Tap the “<strong>Save</strong>” button at the bottom of the page.</li><li>Tap “<strong>Continue</strong>” to complete the process.</li></ol><p class="faq-text">You have successfully added a new customer!</p><p class="faq-text">Repeat the process to add more customers as needed.</p><h5 class="faq-sub-heading">How do I attach a Customer to a Sale?</h5><p class="faq-text">When making a new sale, use the customer feature to attach a customer to your sale.</p><ol class="faq-step-list"><li>Make a new sale either by searching or scanning the product barcode.</li><li>When you are about to confirm a sale, tap on "<strong>Customer</strong>" button at the bottom middle of the page.</li><li>You can either select the Customer from the list of or use the search option</li><li>If you can't find the customer then choose "<strong>Tap here to add a new customer</strong>"</li><li>Fill in the required details and tap "<strong>Save</strong>"</li><li>Now you can attach the customer to your sale.</li></ol>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="cust-update" data-faq="cust-update">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Update Customer Details</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <div class="faq-video-container"><iframe src="https://www.youtube.com/embed/geUDz6Wdw98?showinfo=0&autoplay=0" title="ShopKite Video Guide" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen loading="lazy"></iframe></div><p class="faq-text">Follow these steps to update your Customer Details:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on the “<strong>Customer</strong>” button</li><li>Tap on “<strong>List of Customers</strong>” under the options listed</li><li>Type in the name of the Customer in the box labeled “Tap here to search”</li><li>Tap on the Customer you want</li><li>Tap on the “<strong>Edit</strong>” button at the end of the page</li><li>Update any detail of your choice in the filled-displayed</li><li>Tap “<strong>Save</strong>” at the bottom of the page</li><li>Tap “Continue” at the bottom of the page</li></ol><p class="faq-text">You have successfully updated a Customer detail!</p><p class="faq-text">Repeat the process again if you want to Update more Customer details.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="cust-birthday" data-faq="cust-birthday">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Check Upcoming Customer Birthdays</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar <strong>menu </strong>button at the top right corner of the page.</li><li>Scroll down and tap on “<strong>Customer</strong>.”</li><li>Tap on “Birthdays” from the listed options.</li></ol><p class="faq-text">You will see a list of merchant birthdays displayed.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category: Delivery & Orders -->
        <section class="faq-category-section" id="delivery">
            <h2 class="faq-category-header">
                <span class="faq-cat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                </span>
                Delivery & Orders
            </h2>
            <div class="faq-accordion-group">
                <div class="faq-accordion-card " id="deliv-agents" data-faq="deliv-agents">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">Who Are Delivery Agents & How Do They Work?</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">The "delivery" side of the menu is only activated for merchants who have their store online. To request online hosting on ShopKite, merchants must have been taking inventory with the Shopkite app for at least 6 months.</p><h5 class="faq-sub-heading">Who are Delivery Agents?</h5><p class="faq-text">Delivery agents are individuals, companies, or entities that a merchant collaborates with for logistics services. Merchants can add multiple agents, and assign orders to these agents as they come in.</p><h5 class="faq-sub-heading">How do I add Delivery Agents?</h5><p class="faq-text">Follow the steps below to add delivery agents to your store.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Delivery”</li><li>Select “<strong>Delivery Agents</strong>”</li><li>Tap on “<strong>Add Delivery Agent</strong>” at the bottom of the page</li><li>Proceed to fill in the required details; business name, first name, last name, business contact numbers, business type, and email address.</li><li>Tap “<strong>Add Delivery Agent</strong>”</li><li>Tap “<strong>Continue</strong>”</li></ol><p class="faq-text">You have successfully added a delivery agent to your store.</p><p class="faq-text">Repeat the process to add more.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="deliv-rates" data-faq="deliv-rates">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Add Delivery Rates</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">Follow the steps below to add delivery rates for different locations.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Delivery”</li><li>Select “<strong>Delivery Rates</strong>”</li><li>Tap on “<strong>Add Delivery Rate</strong>” at the bottom of the page</li><li>Proceed to fill in the required details; Delivery cost, country, state, city, area, estate (if applicable).</li><li>Tap “<strong>Add Delivery Rate</strong>”</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully added a delivery rate.</p><p class="faq-text">Repeat the process to add more.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="deliv-check" data-faq="deliv-check">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Check & Manage Deliveries</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">Once a payment is made on your online store, the details automatically appear on your "deliveries" page.</p><h5 class="faq-sub-heading">How to check my Deliveries.</h5><p class="faq-text">Follow the steps below to see the list of your deliveries.</p><ol class="faq-step-list"><li>Open the Shopkite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “<strong>Delivery</strong>”</li><li>Select “<strong>Deliveries</strong>”</li><li>You will see the list of all your deliveries.</li><li>Tap "<strong>Filter</strong>" to specify what delivery you want to see. Choose from Pending, Processing, In transit, Delivered or Cancelled.</li><li>The selected filter will be applied and displayed</li></ol><h5 class="faq-sub-heading">How to Update delivery status</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Delivery”</li><li>Select “<strong>Deliveries</strong>”</li><li>Select the delivery you want to update.</li><li>Scroll down and tap "<strong>Set Delivery Agent"</strong> to select the agent attached to that customer</li><li>Then select "<strong>Set Delivery Status</strong>" box to choose the current status of the despatch. Example, In transit.</li><li>Tap "<strong>Set Delivery Status</strong>" to complete the update.</li></ol><p class="faq-text">suggestions</p><p class="faq-text">. set delivery status to "update delivery status".</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category: Supply & Restocking -->
        <section class="faq-category-section" id="supply">
            <h2 class="faq-category-header">
                <span class="faq-cat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                </span>
                Supply & Restocking
            </h2>
            <div class="faq-accordion-group">
                <div class="faq-accordion-card " id="sup-add" data-faq="sup-add">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Add New Suppliers</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <ol class="faq-step-list"><li>Open the Shopkite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “<strong>Supply</strong>”</li><li>Tap on “<strong>New Supplier</strong>”</li><li>Fill in the required details of the Supplier</li><li>Tap “<strong>Save</strong>” at the bottom of the page</li><li>Tap “<strong>Continue</strong>”</li></ol><p class="faq-text">You have successfully added a new Supplier!</p><p class="faq-text">Repeat the process if you wish to add more Suppliers.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="sup-update" data-faq="sup-update">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Update Supplier's Records</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar <strong>Menu</strong> button at the top right corner of the page</li><li>Scroll down and tap on “Supply”</li><li>Tap on “<strong>List of Suppliers</strong>”</li><li>Type the name of the supplier in the search box</li><li>Choose the supplier of your choice to update their records</li><li>Tap “<strong>Edit</strong>” at the bottom of the page</li><li>Edit the fields you wish to</li><li>Tap “<strong>Save</strong>”</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully updated your Supplier"s record!</p><p class="faq-text">Repeat the process if you wish to update more.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="sup-record" data-faq="sup-record">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Record A New Supply</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu button at the top right corner.</li><li>Scroll down and tap “Supply.”</li><li>Tap “<strong>New Supply</strong>.”</li><li>Search for the product or scan the product barcode.</li><li>Choose the product from the list or tap "<strong>Add new product</strong>" to create a new one.</li><li>Enter supply details:</li></ol><ul class="faq-step-list"><li>Total Quantity Supplied/Bought: Fill in the total number of single units (e.g., 12 bottles for one pack of Coca-Cola).</li><li>Total Cost of Product Supplied: Enter the total amount paid for the product.</li><li>Unit/Selling Price: Enter the selling price per unit (e.g., #350 per bottle of Coca-Cola).</li><li>Minimum Quantity: Enter your stock reorder level.</li><li>Add Volume Price: Select volume sizes, then enter the count and volume prices.</li><li>Expiry Date: Select the most recent expiry date on the batch.</li><li>Supply To: Indicate if supplying to a store or warehouse, and choose the warehouse if applicable.</li></ul><ol class="faq-step-list"><li>Tap “<strong>Add to Supply List</strong>.”</li><li>Add more products if needed by tapping "Search" or "Scan," then “Add to List.”</li><li>Tap “<strong>Continue</strong>.”</li><li>Select the Supplier and enter the amount paid. If fully paid, leave the field as is.</li><li>Select Supply Date and, if applicable, set a notification date for any balance payment.</li><li>Add Remarks if necessary.</li><li>Tap “<strong>Make Supply</strong>.”</li></ol><p class="faq-text">You have successfully added a new supply! Repeat the process to add more supplies as needed.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="sup-records" data-faq="sup-records">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">What Are Supply Records & How To Track Them?</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text"><strong>ShopKite Merchant</strong> helps you keep a record of all supplies received in your store. Each supply record includes supplier details, product information, and the date of receipt.</p><h5 class="faq-sub-heading">How To View Supply Records</h5><p class="faq-text">Follow the steps below to view the list of all supplies recorded in your store.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Supply”</li><li>Tap on “<strong>Supply Records</strong>” under the options given</li><li>Tap on the Supply record you wish to view</li></ol><p class="faq-text">All record will be displayed for you to see</p><h5 class="faq-sub-heading">How to export Supply Records</h5><p class="faq-text">You can share supply records with your supplier or send them to any other destination outside the ShopKite Merchant app by following these steps.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Supply”</li><li>Tap on “<strong>Supply Records</strong>” under the options given</li><li>Tap on the Supply record you wish to view</li><li>Tap on "<strong>Share Receipt</strong>" at the bottom right corner of the page.</li><li>Choose where to share your file</li></ol><p class="faq-text">You have successfully shared the receipt for your supply record.</p><h5 class="faq-sub-heading">How to Refund A Supply</h5><p class="faq-text">Received an incorrect supply? Don't worry! You can easily refund it by following these steps:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar menu button at the top right.</li><li>Scroll down and select "Supply."</li><li>Choose "<strong>Supply Records</strong>."</li><li>Select the supply record you wish to refund.</li><li>Tap "<strong>Refund Supply</strong>" at the bottom left.</li><li>Check the box(es) to refund all or use "<strong>Refund Qty</strong>" to specify quantities.</li><li>Tap "<strong>Confirm Refund</strong>" at the bottom.</li><li>Review and confirm the refund, then tap "Make Refund."</li><li>Enter your 4-digit PIN to confirm.</li><li>Tap "<strong>Refund</strong>" to complete the process.</li></ol><p class="faq-text">Afterward, your supply records will update automatically to reflect the refund.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category: Expenses -->
        <section class="faq-category-section" id="expenses">
            <h2 class="faq-category-header">
                <span class="faq-cat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                </span>
                Expenses
            </h2>
            <div class="faq-accordion-group">
                <div class="faq-accordion-card " id="exp-record" data-faq="exp-record">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Record A New Expense</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Expenses”</li><li>Select “<strong>New Expense</strong>”</li><li>Type in the expense title in the space provided. Examples: Security dues, staff salaries, etc</li><li>Tap on “<strong>Continue</strong>”</li><li>Fill in the required details correctly; Expense category, amount, quantity, description.</li><li>Tap “add to list”</li><li>Tap “<strong>Confirm”</strong></li><li>Select the expense date</li><li>Tap “<strong>confirm expense”</strong></li><li>Tap “<strong>Continue</strong>”</li></ol><p class="faq-text">You have successfully recorded a new expense.</p><p class="faq-text">Repeat the process to record more.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="exp-view" data-faq="exp-view">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To View All My Expenses</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <ol class="faq-step-list"><li>Open the Shopkite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Expenses”</li><li>Select “<strong>All Expenses</strong>”</li><li>Tap “Select Date Duration” to pick the start and end date period for which you want to view.</li><li>Or type in the title of the expense in the “search” box</li><li>You can also filter by “<strong>category</strong>”</li><li>The expenses will be listed for you to see.</li></ol><p class="faq-text">You can do this whenever you want to view your expenses.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category: Stores, Warehouses & Staff -->
        <section class="faq-category-section" id="stores">
            <h2 class="faq-category-header">
                <span class="faq-cat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                </span>
                Stores, Warehouses & Staff
            </h2>
            <div class="faq-accordion-group">
                <div class="faq-accordion-card " id="store-create" data-faq="store-create">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Create A New Store Or Warehouse</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading"><strong>How do I create a new Store/Warehouse?</strong></h5><p class="faq-text">Follow the steps below to create a new Store/Warehouse</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “<strong>Stores/Warehouse</strong>”</li><li>Tap on “New Store/ Warehouse” under the options listed</li><li>Fill in the required details of the Warehouse</li><li>Tap on “<strong>Add Store</strong>” at the bottom of the page</li><li>Tap “<strong>Continue</strong>”</li></ol><p class="faq-text">Repeat the process if you want to create more.</p><p class="faq-text"><strong>Note</strong>: Using the "Copy products" option when creating new stores makes moving products easier. Before starting, ensure you are signed in to the store/warehouse you want to move products from.</p><h5 class="faq-sub-heading">How do I see the list of all my Stores/ Warehouse?</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar <strong>menu</strong> button at the top right corner of the page</li><li>Scroll down and tap on “<strong>Store/Warehouse</strong>”</li><li>Tap on “List of Stores/ Warehouses” under the options listed</li><li>Tap on the warehouse you wish to view from the list displayed</li></ol>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="store-switch" data-faq="store-switch">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Switch Accounts Between Stores</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">How To Sign in to a Different Store/Warehouse.</h5><p class="faq-text">Follow the steps below to switch between stores/warehouses.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “Stores/ Warehouse”</li><li>Tap on “<strong>List of Stores/ Warehouses</strong>” under the options listed</li><li>Tap on the warehouse you wish to sign in to</li><li>Tap on “Yes” to confirm the switch to the selected store/warehouse</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully signed into a different Store/warehouse!</p><p class="faq-text">Repeat the process if you want to switch to the previous store or a different one.</p><h5 class="faq-sub-heading">How to Switch Staff</h5><p class="faq-text">Follow this steps to sign in to a different staff account.</p><ol class="faq-step-list"><li>Open the ShopKite Merchant App</li><li>Tap on the three-bar <strong>menu</strong></li><li>Scroll down and tap on "Sign Out"</li><li>Then choose "<strong>Switch Staff</strong>"</li><li>Type in the number linked to that staff account</li><li>Type in the 4-digit <strong>PIN </strong></li><li>Tap "Switch Staff" to proceed</li><li>Tap "Continue".</li></ol><p class="faq-text">You have successfully switched to a different staff account.</p><p class="faq-text">Repeat the process to switch back to the previous account or a different one.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="store-staff" data-faq="store-staff">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Manage Staff & Permissions In My Store</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">How to create store managers</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant App</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and Tap on “<strong>Stores/Warehouses</strong>”</li><li>Tap on “<strong>My Staff</strong>” under the options listed</li><li>Tap on “<strong>Managers</strong>”</li><li>Tap on “Create Manager” at the bottom of the page</li><li>Fill in the required details then set access permissions.</li><li>Tap on the “<strong>Save</strong>” button at the bottom of the page</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully added a new Store Manager!</p><p class="faq-text">Repeat the process if you want to add more Managers.</p><h5 class="faq-sub-heading">How to create sales Agents</h5><ol class="faq-step-list"><li>Open the Shopkite Merchant app.</li><li>Tap the three-bar menu button at the top right corner.</li><li>Scroll down and tap on “<strong>Stores/Warehouses</strong>.”</li><li>Tap on “<strong>My Staff</strong>.”</li><li>Select “Sales Agents.”</li><li>Tap on “Create Sales Agent” at the bottom of the page.</li><li>Fill in the required details and <span>set access permissions</span>.</li><li>Tap the “Save” button.</li><li>Tap “Continue.”</li></ol><p class="faq-text">You have successfully added a new sales agent.</p><p class="faq-text">Repeat the process to add more agents as needed.</p><h5 class="faq-sub-heading">How to set access permissions for Staff accounts</h5><p class="faq-text">You can control which sections or pages of the Shopkite Merchant app your staff can access. Follow these steps:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap on the Menu (three-bar icon at the top right).</li><li>Tap on “<strong>Stores/Warehouses</strong>” and select “My Staff.”</li><li>Choose the category of the staff (e.g., Manager).</li><li>Select the staff member's name.</li><li>Tap on “<strong>View/Set Permissions</strong>.”</li><li>You will see a list of app sections where you can set permissions for the selected staff.</li><li>Select the sections to view all possible permissions, and update the permissions as needed. Each permission includes a short description for clarity.</li><li>When finished, tap on “<strong>Update Permissions</strong>.”</li><li>You will return to the staff's page. Tap on “Update” to save the permissions.</li></ol><p class="faq-text"><strong>Troubleshooting Steps</strong>:</p><ul class="faq-step-list"><li>Ensure you are connected to a stable internet</li><li>Ask the staff to sign out and sign back in to reflect the changes you made</li></ul><h5 class="faq-sub-heading">How to remove a Staff from your store</h5><p class="faq-text">To remove a staff from your store, kindly follow the steps below:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap on the Menu (three-bar icon at the top right). Tap on My Staff.</li><li>Choose the role of the staff member.</li><li>Tap on the staff member’s name.</li><li>Scroll to the bottom of the page and then tap on "Remove Agent"</li><li>Tap "Yes" to confirm</li><li>Enter your 4-digit PIN</li></ol><p class="faq-text">You have successfully removed a staff.</p><p class="faq-text">Repeat the process to remove more staff as needed.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="store-update" data-faq="store-update">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Update Details On My Store / Warehouse</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading"><strong>How do I update details on my store/warehouse?</strong></h5><p class="faq-text">Follow these steps to Update your Store/warehouse Details</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu located at the top right corner of the page</li><li>Scroll down, tap on "<strong>Stores/Warehouses</strong>"</li><li>Tap on "List of Stores/Warehouses" from the options given</li><li>Select the store you wish to update</li><li>Tap "<strong>Edit</strong>" to Update the detail(s)</li><li>Tap "Update Store"</li></ol><p class="faq-text">You have successfully updated your store details.</p><h5 class="faq-sub-heading"><strong>How do I Update a product In my Store/ Warehouse?</strong></h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar menu button at the top right corner of the page</li><li>Scroll down and tap on “<strong>Warehouse</strong>”</li><li>Tap on “List of Warehouses” under the options listed</li><li>Tap on the warehouse you wish to update products from</li><li>Tap on the product you wish to update</li><li>Tap on “<strong>Update Quantity</strong>”</li><li>Enter the new update by typing or using the minus(-)sign to reduce and plus(+) sign to add.</li><li>Tap “<strong>Update</strong>” at the bottom of the page</li><li>Tap “Continue”</li></ol><p class="faq-text">You have successfully updated a product in your warehouse!</p><p class="faq-text">Repeat the process if you wish to update more.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="store-subscription" data-faq="store-subscription">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Check My Subscription Status</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">How do I Check my Subscription Status?</h5><p class="faq-text">To find out your current subscription status and view your next renewal date:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap on three-bar Menu</li><li>Tap on "<strong>Stores/Warehouses</strong>"</li><li>Select "List of Stores/Warehouses".</li><li>Tap on the "<strong>Subscribe</strong>" button at the bottom of the page.</li></ol><p class="faq-text">Your subscription status and next renewal date will be displayed.</p><h5 class="faq-sub-heading">How do I Renew my Subscription?</h5><p class="faq-text">To renew your subscription and make a payment:</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap on Menu</li><li>Scroll down and tap on "<strong>Stores/Warehouses</strong>"</li><li>Select "<strong>List of Stores</strong>".</li><li>Tap on the "Subscribe" button at the bottom of the page.</li><li>If this is your first subscription, select a subscription package from the list.</li><li>Confirm your details and subscription package, then tap on "<strong>Make Payment</strong>."</li><li>After making payment, keep the app open for about 60 seconds for your subscription to reflect.</li></ol><p class="faq-text"><strong>Troubleshooting Steps:</strong></p><ul class="faq-step-list"><li>Ensure you have a stable internet connection</li><li>Close the app and re open it</li><li>Sign out and sign back into your store</li></ul><p class="faq-text">If you still experience any difficulties with the process, send us an email hello@shopkite.com.ng   or send a message on Whatsapp at +234 906 2000 393</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category: General Settings & Data -->
        <section class="faq-category-section" id="general">
            <h2 class="faq-category-header">
                <span class="faq-cat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                </span>
                General Settings & Data
            </h2>
            <div class="faq-accordion-group">
                <div class="faq-accordion-card " id="gen-notif" data-faq="gen-notif">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Check Notifications</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">Follow these steps to Check Your Notifications</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar Menu button at the top right corner of the page.</li><li>Scroll down and select “<strong>General</strong>.”</li><li>Tap on “<strong>Notifications</strong>” from the listed options to see your recent notifications.</li><li>To view notifications for a specific period, tap on “<strong>Select Duration.</strong>”</li><li>Tap on the start date, then tap on the end date, and finally tap “OK.”</li></ol><p class="faq-text">The list of notifications for the selected period will be displayed.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="gen-export" data-faq="gen-export">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Export My Store Records</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <h5 class="faq-sub-heading">How to Export Records</h5><ol class="faq-step-list"><li>Open the ShopKite Merchant app</li><li>Tap on the three-bar Menu button at the top right corner of the page</li><li>Scroll down and select “<strong>General</strong>”</li><li>Tap on “<strong>Export Records</strong>” under the options listed</li><li>Select the “<strong>Category</strong>”, and “<strong>Duration</strong>”</li><li>Tap on “Proceed”</li><li>Type in your 4-digit <strong>PIN </strong>and tap “Confirm”</li><li>Check your email for the document.</li></ol><p class="faq-text">You have successfully exported your selected record.</p><p class="faq-text">Repeat the process to export other records.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="gen-reset-store" data-faq="gen-reset-store">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Reset Quantities Of All Products To Zero</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">Follow the steps below to Reset the Quantity of a Store/Warehouse to Zero</p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the three-bar <strong>Menu</strong> button at the top right corner of the page.</li><li>Scroll down and select “<strong>General.</strong>”</li><li>Tap on “<strong>Reset Quantity</strong>” from the listed options.</li><li>Choose whether you want to reset the quantity for a store or warehouse.</li><li>Select the specific store or warehouse.</li><li>Tap “<strong>Reset Quantity.</strong>”</li><li>Enter your 4-digit <strong>PIN</strong>.</li><li>Tap “Confirm.”</li></ol><p class="faq-text"><strong>Note:</strong> This action cannot be undone, so ensure you are certain before confirming the reset.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="gen-payment" data-faq="gen-payment">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Add Payment Methods To My Store</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text"><strong>How to Create Payment Methods</strong></p><p class="faq-text">You can set up multiple payment methods for each of your stores in the ShopKite Merchant app to track payment sources like cash, bank transfers, and more.</p><p class="faq-text">These methods aid in tracking, not in processing transactions.</p><p class="faq-text">Before making sales on the ShopKite Merchant app, you need to set up your payment methods. The default payment method "Cash" is already created for all stores.</p><p class="faq-text">The "Create Payment Method" feature is accessible only to the merchant (business owner).</p><p class="faq-text"><strong>Steps to Create Payment Methods:</strong></p><ol class="faq-step-list"><li>Open the ShopKite Merchant app.</li><li>Tap the Menu (three bars at the top right).</li><li>Tap on "<strong>General</strong>" and then "Payment Methods."</li><li>Tap on "<strong>Add Payment Method</strong>."</li><li>Tap the "<strong>Select Payment Method</strong>" dropdown to select a method</li><li>If your payment method is attached to a bank, tap on "Search for Bank," type your bank's name, and select it from the suggestions. If your bank is not listed, contact customer support for assistance.</li><li>Select the store(s) you want to add the payment method to. You can select multiple stores.</li><li>Add extra information in the "<strong>Extra Info</strong>" field (optional).</li><li>Tap "Save" when you are done.</li></ol><p class="faq-text">You can create multiple payment methods to suit your business needs.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category: Extras & App Info -->
        <section class="faq-category-section" id="extras">
            <h2 class="faq-category-header">
                <span class="faq-cat-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                </span>
                Extras & App Info
            </h2>
            <div class="faq-accordion-group">
                <div class="faq-accordion-card " id="extra-devices" data-faq="extra-devices">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">Can I Use The ShopKite App On Multiple Devices?</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">Yes, you can use the ShopKite Merchant App on multiple devices.</p><p class="faq-text">It is available for both Android and iOS devices.</p><p class="faq-text">Simply log into your account on each device and all your data will be synchronized. This allows you to manage your store and perform various tasks seamlessly from different devices.</p><p class="faq-text">Visit our online store to see the range of devices ShopKite offers. <a href="https://shopkite.com.ng/pay" target="_blank" rel="noopener noreferrer">Visit store</a></p><p class="faq-text">These devices are designed to enhance your store management experience.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="extra-update" data-faq="extra-update">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Update The ShopKite Merchant App</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">How do I update the ShopKite Merchant App?</p><p class="faq-text">To update the ShopKite Merchant App, follow these steps:</p><p class="faq-text">1. <strong>For iOS Devices:</strong></p><ul class="faq-step-list"><li>Open the App Store.</li><li>Tap on your profile icon at the top of the screen.</li><li>Scroll down to see pending updates and release notes.</li><li>Find the ShopKite Merchant App and tap "Update."</li></ul><p class="faq-text">2. <strong>For Android Devices:</strong></p><ul class="faq-step-list"><li>Open the Google Play Store.</li><li>Tap the menu icon (three horizontal lines) in the top-left corner.</li><li>Select "My apps &amp; games."</li><li>Find the ShopKite Merchant App in the list of pending updates and tap "Update."</li></ul><p class="faq-text">Alternatively, you can enable automatic updates for the app to ensure you always have the latest version.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="extra-pin" data-faq="extra-pin">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">How To Reset Your PIN</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <p class="faq-text">Follow these steps to reset your pin</p><ol class="faq-step-list"><li>Go to the sign-in page of your ShopKite Merchant app</li><li>Tap on "forgot your <strong>PIN</strong>?"</li><li>Type in the eleven-digit phone number you registered with</li><li>Then Tap "<strong>Continue</strong>"</li><li>A 6-digit OTP Verification code will be sent to you via SMS and WhatsApp</li><li>Type in the code in the space provided for "<strong>Verification code</strong>"</li><li>Type in the new password you want to use</li><li>Tap "<strong>Continue</strong>"</li></ol><p class="faq-text">You have successfully changed your PIN.</p>
                        </div>
                    </div>
                </div>
                <div class="faq-accordion-card " id="extra-insights" data-faq="extra-insights">
                    <div class="faq-accordion-header">
                        <h3 class="faq-accordion-title">ShopKite Insights & Performance Analytics</h3>
                        <span class="faq-chevron">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </span>
                    </div>
                    <div class="faq-accordion-body">
                        <div class="faq-accordion-content">
                            <ol class="faq-step-list"><li>Open the ShopKite Merchant App</li><li>Select "Insights" at the bottom of the Sales Page</li></ol><p class="faq-text">This feature provides comprehensive insights into your product performance, highlighting everything from top-selling items to the least selling ones.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Support Callout Box -->
        <div class="faq-support-box">
            <h3 class="faq-support-title">Still have questions or need personalized help?</h3>
            <p class="faq-support-desc">Our dedicated ShopKite support team is available Mondays to Fridays, 9AM - 5PM, Saturdays 10AM - 2PM to guide you through setup, device pairing, or account questions.</p>
            <a href="#" class="faq-support-btn" onclick="openPopupSupport(); return false;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Get Help From A Human
            </a>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar          = document.getElementById('faqSidebar');
        const sidebarToggle    = document.getElementById('faqSidebarToggle');
        const mobileDrawerBtn  = document.getElementById('faqMobileDrawerBtn');
        const sidebarOverlay   = document.getElementById('faqSidebarOverlay');
        const treeHeaders      = document.querySelectorAll('.faq-tree-header');
        const subItems         = document.querySelectorAll('.faq-tree-subitem');
        const accordionHeaders = document.querySelectorAll('.faq-accordion-header');
        const categorySections = document.querySelectorAll('.faq-category-section');

        // ── 1. Helper: Open only one category group in the sidebar ─────
        function openCategoryGroupOnly(catId) {
            document.querySelectorAll('.faq-tree-group').forEach(g => {
                if (g.getAttribute('data-category') === catId) {
                    g.classList.add('open');
                } else {
                    g.classList.remove('open');
                }
            });
        }

        // ── 2. Helper: Set active sub-item highlight ───────────────────
        function setActiveSubItem(faqId) {
            subItems.forEach(item => {
                if (faqId && item.getAttribute('data-faq') === faqId) {
                    item.classList.add('sub-active');
                } else {
                    item.classList.remove('sub-active');
                }
            });
        }

        // ── 3. Helper: Smooth scroll to element header without glitch ──
        let isProgrammaticScroll = false;
        let programmaticScrollTimer = null;

        function scrollToTarget(element) {
            if (!element) return;

            // Lock intersection observer during programmatic scroll
            isProgrammaticScroll = true;
            clearTimeout(programmaticScrollTimer);
            programmaticScrollTimer = setTimeout(() => {
                isProgrammaticScroll = false;
            }, 800);

            const isMob = isMobile();
            const headerOffset = isMob ? 190 : 166;
            const headerEl = element.querySelector('.faq-accordion-header') || element;
            const rect = headerEl.getBoundingClientRect();
            const targetY = rect.top + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: Math.max(0, targetY),
                behavior: 'smooth'
            });
        }

        // ── 4. Sidebar Collapse/Expand Toggle & Mobile Drawer ──────────
        function isMobile() {
            return window.innerWidth <= 900;
        }

        function openMobileDrawer() {
            if (sidebar) {
                sidebar.classList.add('open-mobile');
                sidebar.classList.add('mobile-open');
            }
            if (sidebarOverlay) sidebarOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileDrawer() {
            if (sidebar) {
                sidebar.classList.remove('open-mobile');
                sidebar.classList.remove('mobile-open');
            }
            if (sidebarOverlay) sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                if (isMobile()) {
                    closeMobileDrawer();
                } else {
                    sidebar.classList.toggle('collapsed');
                }
            });
        }

        if (mobileDrawerBtn) {
            mobileDrawerBtn.addEventListener('click', () => {
                openMobileDrawer();
            });
        }

        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', () => {
                closeMobileDrawer();
            });
        }

        // ── 5. Sidebar Tree Parent Accordion ───────────────────────────
        treeHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const group = header.closest('.faq-tree-group');
                if (group) {
                    if (sidebar && sidebar.classList.contains('collapsed') && !isMobile()) {
                        sidebar.classList.remove('collapsed');
                    }
                    const isOpen = group.classList.contains('open');
                    const catId = group.getAttribute('data-category');
                    if (isOpen) {
                        group.classList.remove('open');
                    } else {
                        openCategoryGroupOnly(catId);
                    }
                }
            });
        });

        // ── 6. Sub-Item Click -> Smooth Scroll & Expand Content Card ───
        subItems.forEach(subItem => {
            subItem.addEventListener('click', (e) => {
                e.preventDefault();
                const targetFaqId = subItem.getAttribute('data-faq');
                const targetCard  = document.getElementById(targetFaqId);

                if (targetCard) {
                    // Highlight sub-item
                    setActiveSubItem(targetFaqId);

                    // Ensure parent tree group is open
                    const parentGroup = subItem.closest('.faq-tree-group');
                    if (parentGroup) {
                        const catId = parentGroup.getAttribute('data-category');
                        openCategoryGroupOnly(catId);
                    }

                    // Open target card
                    targetCard.classList.add('open');

                    // Close mobile drawer on item selection
                    if (isMobile()) {
                        closeMobileDrawer();
                    }

                    // Scroll smoothly and accurately to target card
                    scrollToTarget(targetCard);
                }
            });
        });

        // ── 7. Main Content Accordion Cards Toggle ─────────────────────
        accordionHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const card = header.closest('.faq-accordion-card');
                const isOpen = card.classList.contains('open');

                // Toggle card
                card.classList.toggle('open');

                const section = card.closest('.faq-category-section');
                const catId   = section ? section.getAttribute('id') : null;
                const faqId   = card.getAttribute('data-faq');

                if (!isOpen) {
                    // Card was EXPANDED
                    setActiveSubItem(faqId);
                    if (catId) {
                        openCategoryGroupOnly(catId);
                    }
                } else {
                    // Card was COLLAPSED
                    setActiveSubItem(null);
                    if (section) {
                        const anyOpen = section.querySelector('.faq-accordion-card.open');
                        if (!anyOpen && catId) {
                            const group = document.querySelector(`.faq-tree-group[data-category="${catId}"]`);
                            if (group) group.classList.remove('open');
                        }
                    }
                }
            });
        });

        // ── 8. Scroll observer: auto-expand ONLY active category section 
        const observerOptions = {
            root: null,
            rootMargin: '-20% 0px -60% 0px',
            threshold: 0
        };

        const catObserver = new IntersectionObserver((entries) => {
            if (isProgrammaticScroll) return;
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const catId = entry.target.getAttribute('id');
                    openCategoryGroupOnly(catId);
                }
            });
        }, observerOptions);

        categorySections.forEach(s => catObserver.observe(s));

        // ── 9. Live FAQ Search Filter ──────────────────────────────────
        const searchInput = document.getElementById('faqSearchInput');
        const noResults   = document.getElementById('faqNoResults');
        let searchScrollTimeout = null;

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const query = e.target.value.toLowerCase().trim();
                let totalVisible = 0;
                let firstMatchCard = null;

                categorySections.forEach(section => {
                    let sectionCount = 0;
                    section.querySelectorAll('.faq-accordion-card').forEach(card => {
                        const title = card.querySelector('.faq-accordion-title')?.textContent.toLowerCase() || '';
                        const body  = card.querySelector('.faq-accordion-content')?.textContent.toLowerCase() || '';
                        const match = query === '' || title.includes(query) || body.includes(query);
                        card.style.display = match ? 'block' : 'none';
                        if (match && query !== '') {
                            card.classList.add('open');
                            if (!firstMatchCard) firstMatchCard = card;
                        }
                        if (!match && query !== '') {
                            card.classList.remove('open');
                        }
                        if (match) { sectionCount++; totalVisible++; }
                    });
                    section.style.display = (sectionCount === 0 && query !== '') ? 'none' : 'block';
                });

                if (noResults) {
                    noResults.style.display = (totalVisible === 0 && query !== '') ? 'block' : 'none';
                }

                // Smoothly scroll first matching result below the sticky search bar
                clearTimeout(searchScrollTimeout);
                if (query !== '' && firstMatchCard) {
                    searchScrollTimeout = setTimeout(() => {
                        scrollToTarget(firstMatchCard);
                    }, 150);
                }
            });
        }

        // ── 10. URL Hash deep link handling on initial load ────────────
        if (window.location.hash) {
            const hash = window.location.hash.substring(1);
            const targetCard = document.getElementById(hash);
            if (targetCard && targetCard.classList.contains('faq-accordion-card')) {
                targetCard.classList.add('open');
                setActiveSubItem(hash);
                const section = targetCard.closest('.faq-category-section');
                if (section) {
                    const catId = section.getAttribute('id');
                    openCategoryGroupOnly(catId);
                }
                setTimeout(() => {
                    scrollToTarget(targetCard);
                }, 400);
            }
        }
    });
</script>
@endpush
