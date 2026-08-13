@extends('layouts.app')

@section('title', 'Frequently Asked Questions — ShopKite Merchant')
@section('meta_description', 'Find answers to common questions about using ShopKite Merchant POS app, managing products, sales, inventory, customers, supplies, and stores.')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/faq.css') }}?v={{ filemtime(public_path('css/faq.css')) }}">
@endsection

@section('content')
<main class="faq-page-wrapper">

    <!-- ── Left Collapsible Sidebar Navigation Panel ── -->
    <aside class="faq-sidebar" id="faqSidebar">
        <div class="faq-sidebar-header">
            <span class="faq-sidebar-title">Categories</span>
            <button type="button" class="faq-sidebar-toggle" id="faqSidebarToggle" title="Toggle Panel" aria-label="Toggle Panel">
                <svg class="faq-toggle-icon-desktop" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
                <svg class="faq-toggle-icon-mobile" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <nav class="faq-tree-nav">

            <!-- Getting Started -->
            <div class="faq-tree-group open" data-category="getting-started">
                <div class="faq-tree-header" data-tooltip="Getting Started">
                    <div class="faq-nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5-2 5-2"/><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 2-5 2-5"/></svg>
                    </div>
                    <span class="faq-nav-label">Getting Started</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#gs-download" class="faq-tree-subitem sub-active" data-faq="gs-download">How To Download The Shopkite Merchant App</a>
                    <a href="#gs-signup" class="faq-tree-subitem" data-faq="gs-signup">How To Sign Up</a>
                    <a href="#gs-signin" class="faq-tree-subitem" data-faq="gs-signin">How To Sign In</a>
                    <a href="#gs-pin" class="faq-tree-subitem" data-faq="gs-pin">How To Reset Your PIN</a>
                </div>
            </div>

            <!-- Products -->
            <div class="faq-tree-group" data-category="products">
                <div class="faq-tree-header" data-tooltip="Products">
                    <div class="faq-nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                    </div>
                    <span class="faq-nav-label">Products</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#prod-search" class="faq-tree-subitem" data-faq="prod-search">How To Add A New Product By Searching</a>
                    <a href="#prod-scan" class="faq-tree-subitem" data-faq="prod-scan">How To Add A New Product By Scanning</a>
                    <a href="#prod-delete" class="faq-tree-subitem" data-faq="prod-delete">How To Delete A Product</a>
                    <a href="#prod-reset-qty" class="faq-tree-subitem" data-faq="prod-reset-qty">How To Reset The Quantity Of A Product To Zero</a>
                    <a href="#prod-pictures" class="faq-tree-subitem" data-faq="prod-pictures">How To Add Pictures To Products</a>
                    <a href="#prod-expiry" class="faq-tree-subitem" data-faq="prod-expiry">How To Check Expiring Products</a>
                    <a href="#prod-update" class="faq-tree-subitem" data-faq="prod-update">How To Update Existing Products</a>
                    <a href="#prod-volume" class="faq-tree-subitem" data-faq="prod-volume">How To Add Volume Price To Products</a>
                    <a href="#prod-move" class="faq-tree-subitem" data-faq="prod-move">How To Move Products Across Stores / Warehouses</a>
                    <a href="#prod-receive" class="faq-tree-subitem" data-faq="prod-receive">How To Receive Products Moved From A Store</a>
                    <a href="#prod-cancel" class="faq-tree-subitem" data-faq="prod-cancel">How To Cancel Products Moved From A Store</a>
                    <a href="#prod-reset-all" class="faq-tree-subitem" data-faq="prod-reset-all">How To Reset Quantities Of All Products In A Store</a>
                </div>
            </div>

            <!-- Sales -->
            <div class="faq-tree-group" data-category="sales">
                <div class="faq-tree-header" data-tooltip="Sales">
                    <div class="faq-nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    </div>
                    <span class="faq-nav-label">Sales</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#sale-scan" class="faq-tree-subitem" data-faq="sale-scan">How To Make A Sale By Scanning A Barcode</a>
                    <a href="#sale-search" class="faq-tree-subitem" data-faq="sale-search">How To Make A Sale By Searching For Product</a>
                    <a href="#sale-receipt" class="faq-tree-subitem" data-faq="sale-receipt">How To Print Receipts After A Sale</a>
                    <a href="#sale-pause" class="faq-tree-subitem" data-faq="sale-pause">How To Pause A Sale</a>
                    <a href="#sale-owing" class="faq-tree-subitem" data-faq="sale-owing">How To Apply An Owing Record While Making A Sale</a>
                    <a href="#sale-pending" class="faq-tree-subitem" data-faq="sale-pending">How To Check Pending Sales On A Device</a>
                    <a href="#sale-refund" class="faq-tree-subitem" data-faq="sale-refund">How To Refund A Sale</a>
                    <a href="#sale-payment" class="faq-tree-subitem" data-faq="sale-payment">How To Create A Payment Method</a>
                </div>
            </div>

            <!-- Customer -->
            <div class="faq-tree-group" data-category="customer">
                <div class="faq-tree-header" data-tooltip="Customer">
                    <div class="faq-nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <span class="faq-nav-label">Customer</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#cust-add" class="faq-tree-subitem" data-faq="cust-add">How To Add A New Customer</a>
                    <a href="#cust-update" class="faq-tree-subitem" data-faq="cust-update">How To Update Customer Details</a>
                    <a href="#cust-birthday" class="faq-tree-subitem" data-faq="cust-birthday">How To Check Customer Birthdays</a>
                </div>
            </div>

            <!-- Supply -->
            <div class="faq-tree-group" data-category="supply">
                <div class="faq-tree-header" data-tooltip="Supply">
                    <div class="faq-nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                    </div>
                    <span class="faq-nav-label">Supply</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#sup-add-supplier" class="faq-tree-subitem" data-faq="sup-add-supplier">How To Add New Suppliers</a>
                    <a href="#sup-update-supplier" class="faq-tree-subitem" data-faq="sup-update-supplier">How To Update Your Supplier's Records</a>
                    <a href="#sup-new-supply" class="faq-tree-subitem" data-faq="sup-new-supply">How To Add A New Supply</a>
                    <a href="#sup-view" class="faq-tree-subitem" data-faq="sup-view">How To View Supply Records</a>
                    <a href="#sup-refund" class="faq-tree-subitem" data-faq="sup-refund">How To Refund A Supply</a>
                </div>
            </div>

            <!-- Stores / Warehouses -->
            <div class="faq-tree-group" data-category="stores">
                <div class="faq-tree-header" data-tooltip="Stores / Staff">
                    <div class="faq-nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"/><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"/><path d="M2 7h20"/><path d="M4 12a2 2 0 0 1 2-2 2 2 0 0 1 4 0 2 2 0 0 1 4 0 2 2 0 0 1 4 0 2 2 0 0 1 2 2"/></svg>
                    </div>
                    <span class="faq-nav-label">Stores / Staff</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#store-managers" class="faq-tree-subitem" data-faq="store-managers">How To Create Store Managers</a>
                    <a href="#store-agents" class="faq-tree-subitem" data-faq="store-agents">How To Create Sales Agents</a>
                    <a href="#store-add" class="faq-tree-subitem" data-faq="store-add">How To Add A New Store</a>
                    <a href="#store-update" class="faq-tree-subitem" data-faq="store-update">How To Update Your Store Details</a>
                    <a href="#store-subscription" class="faq-tree-subitem" data-faq="store-subscription">How To Check My Subscription Status</a>
                    <a href="#store-renew" class="faq-tree-subitem" data-faq="store-renew">How To Renew Your Subscription</a>
                    <a href="#store-permissions" class="faq-tree-subitem" data-faq="store-permissions">How To Set Access Permission For Staff Accounts</a>
                </div>
            </div>

            <!-- Notification -->
            <div class="faq-tree-group" data-category="notification">
                <div class="faq-tree-header" data-tooltip="Notification">
                    <div class="faq-nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                    </div>
                    <span class="faq-nav-label">Notification</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#notif-past" class="faq-tree-subitem" data-faq="notif-past">How To Check Your Past Notifications</a>
                </div>
            </div>

            <!-- Warehouse -->
            <div class="faq-tree-group" data-category="warehouse">
                <div class="faq-tree-header" data-tooltip="Warehouse">
                    <div class="faq-nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M3 7v14"/><path d="M21 7v14"/><path d="M6 21V10h12v11"/><path d="m3 7 9-4 9 4"/></svg>
                    </div>
                    <span class="faq-nav-label">Warehouse</span>
                    <svg class="faq-tree-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                </div>
                <div class="faq-tree-submenu">
                    <a href="#wh-create" class="faq-tree-subitem" data-faq="wh-create">How To Create A Warehouse</a>
                    <a href="#wh-view" class="faq-tree-subitem" data-faq="wh-view">How To View Your Warehouse</a>
                    <a href="#wh-add-products" class="faq-tree-subitem" data-faq="wh-add-products">How To Add Products To Your Warehouse</a>
                    <a href="#wh-move" class="faq-tree-subitem" data-faq="wh-move">How To Move Products From Warehouse</a>
                    <a href="#wh-update" class="faq-tree-subitem" data-faq="wh-update">How To Update A Product In Your Warehouse</a>
                </div>
            </div>

        </nav>
    </aside>

    <!-- Mobile Drawer Overlay -->
    <div class="faq-sidebar-overlay" id="faqSidebarOverlay"></div>

    <!-- ── Main FAQ Content Area ── -->
    <section class="faq-main-content">

        <!-- Mobile Category Trigger Button (above page title) -->
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
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
            <input type="text" id="faqSearchInput" class="faq-search-input" placeholder="Search FAQs by question or topic (e.g. sign up, receipt, stock)...">
        </div>

        <!-- ── Section 1: Getting Started ── -->
        <div class="faq-category-section" id="getting-started">
            <div class="faq-category-header">
                <div class="faq-category-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09z"/><path d="m12 15-3-3a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.35 22.35 0 0 1-4 2z"/><path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5-2 5-2"/><path d="M12 15v5s3.03-.55 4-2c1.08-1.62 2-5 2-5"/></svg>
                </div>
                <span>Getting Started</span>
            </div>

            <div class="faq-accordion-card" data-faq="gs-download">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Download The Shopkite Merchant App</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To download the ShopKite Merchant application on your mobile device or POS terminal:</p>
                    <ol>
                        <li>Open the <strong>Google Play Store</strong> (for Android devices/Sunmi terminals) or the <strong>Apple App Store</strong> (for iOS devices).</li>
                        <li>Search for <strong>"ShopKite Merchant"</strong>.</li>
                        <li>Tap <strong>Install</strong> or <strong>Get</strong> to download the application onto your device.</li>
                        <li>Once downloaded, launch the app to sign up or sign in to your store account.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="gs-signup">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Sign Up</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Creating a new store account on ShopKite takes less than 2 minutes:</p>
                    <ol>
                        <li>Open the ShopKite Merchant App and tap <strong>Sign Up</strong>.</li>
                        <li>Enter your <strong>Store Name</strong>, select your primary business category, and choose your location.</li>
                        <li>Enter your valid <strong>Phone Number</strong> and email address.</li>
                        <li>Set up your secure 4-digit PIN for daily sign-in.</li>
                        <li>Tap <strong>Create Store Account</strong> to get started immediately.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="gs-signin">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Sign In</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Signing in to your existing ShopKite account:</p>
                    <ol>
                        <li>Open the ShopKite Merchant App.</li>
                        <li>Enter your registered phone number or select your staff profile name.</li>
                        <li>Type in your secure 4-digit security PIN.</li>
                        <li>Tap <strong>Sign In</strong> to open your store dashboard and point of sale terminal.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="gs-pin">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Reset Your PIN</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>If you or your staff forget your security PIN:</p>
                    <ol>
                        <li>On the sign-in screen, tap <strong>Forgot PIN?</strong>.</li>
                        <li>An SMS verification code will be sent to the owner's registered phone number.</li>
                        <li>Enter the 6-digit OTP code received via SMS.</li>
                        <li>Create and confirm your new 4-digit security PIN.</li>
                    </ol>
                </div></div>
            </div>
        </div>

        <!-- ── Section 2: Products ── -->
        <div class="faq-category-section" id="products">
            <div class="faq-category-header">
                <div class="faq-category-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                </div>
                <span>Products</span>
            </div>

            <div class="faq-accordion-card" data-faq="prod-search">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Add A New Product By Searching</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>ShopKite features a pre-loaded master catalog of over 100,000 retail products:</p>
                    <ol>
                        <li>Go to the <strong>Products</strong> menu and tap <strong>Add Product</strong>.</li>
                        <li>Type the brand name or product description in the search bar.</li>
                        <li>Select the matching product from the catalog list to auto-fill the name, image, and category.</li>
                        <li>Enter your cost price, selling price, and current stock quantity.</li>
                        <li>Tap <strong>Save Product</strong>.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="prod-scan">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Add A New Product By Scanning</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Use the device camera or built-in Sunmi scanner to add products by barcode:</p>
                    <ol>
                        <li>Go to <strong>Products</strong> → <strong>Add Product</strong> → tap the <strong>Scan</strong> icon.</li>
                        <li>Point your device camera at the product barcode.</li>
                        <li>ShopKite will automatically look up the product in the global catalog.</li>
                        <li>Set your pricing and stock count, then tap <strong>Save Product</strong>.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="prod-delete">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Delete A Product</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To permanently remove a product from your store inventory:</p>
                    <ol>
                        <li>Open the <strong>Products</strong> list and find the item you want to remove.</li>
                        <li>Tap and hold the product card (or tap the three-dot menu icon).</li>
                        <li>Select <strong>Delete Product</strong> and confirm the prompt.</li>
                        <li>The product will be removed from your active inventory and POS screen.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="prod-reset-qty">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Reset The Quantity Of A Product To Zero</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>If you need to zero out a single product's stock count:</p>
                    <ol>
                        <li>Open the product from your <strong>Products</strong> list.</li>
                        <li>Tap <strong>Edit</strong> and navigate to the stock quantity field.</li>
                        <li>Set the quantity to <strong>0</strong> and tap <strong>Save</strong>.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="prod-pictures">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Add Pictures To Products</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Adding images to products makes them easier to identify on the POS screen:</p>
                    <ol>
                        <li>Open a product from your <strong>Products</strong> list and tap <strong>Edit</strong>.</li>
                        <li>Tap the image placeholder at the top of the product form.</li>
                        <li>Choose to take a photo with your camera or select from your gallery.</li>
                        <li>Crop and confirm the image, then tap <strong>Save</strong>.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="prod-expiry">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Check Expiring Products</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>ShopKite automatically monitors stock expiration dates to prevent inventory losses:</p>
                    <ul>
                        <li>When adding stock, enter the <strong>Batch Expiry Date</strong>.</li>
                        <li>ShopKite sends notification alerts 30, 15, and 7 days before expiration.</li>
                        <li>View all expiring items by going to <strong>Reports</strong> → <strong>Expiry Alerts</strong>.</li>
                    </ul>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="prod-update">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Update Existing Products</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To update a product's name, price, or stock details:</p>
                    <ol>
                        <li>Go to <strong>Products</strong> and find the item to edit.</li>
                        <li>Tap the product card and select <strong>Edit</strong>.</li>
                        <li>Make your changes to any field (name, price, stock, category, image).</li>
                        <li>Tap <strong>Save</strong> to apply the update immediately across all devices.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="prod-volume">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Add Volume Price To Products</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Volume pricing lets you offer bulk discounts automatically at checkout:</p>
                    <ol>
                        <li>Open the product from your <strong>Products</strong> list and tap <strong>Edit</strong>.</li>
                        <li>Scroll to the <strong>Volume Pricing</strong> section and tap <strong>Add Tier</strong>.</li>
                        <li>Set the minimum quantity and the price per unit for that tier.</li>
                        <li>Add as many tiers as needed, then tap <strong>Save</strong>.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="prod-move">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Move Products Across Stores / Warehouses</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Transfer stock between your store branches or warehouses:</p>
                    <ol>
                        <li>Go to <strong>Products</strong> → <strong>Stock Transfer</strong>.</li>
                        <li>Select the <strong>Source Location</strong> (store or warehouse).</li>
                        <li>Select the <strong>Destination Location</strong>.</li>
                        <li>Add the products and quantities to transfer, then tap <strong>Issue Transfer</strong>.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="prod-receive">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Receive Products Moved From A Store</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To accept an incoming stock transfer at the destination store:</p>
                    <ol>
                        <li>You'll receive an in-app notification for the incoming transfer.</li>
                        <li>Go to <strong>Products</strong> → <strong>Incoming Transfers</strong>.</li>
                        <li>Review the items and quantities being transferred.</li>
                        <li>Tap <strong>Accept Transfer</strong> to add the stock to your active inventory.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="prod-cancel">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Cancel Products Moved From A Store</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To cancel a stock transfer that has not yet been accepted:</p>
                    <ol>
                        <li>Go to <strong>Products</strong> → <strong>Stock Transfers</strong>.</li>
                        <li>Find the pending transfer you wish to cancel.</li>
                        <li>Tap <strong>Cancel Transfer</strong> and confirm. The stock will be returned to the source location.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="prod-reset-all">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Reset Quantities Of All Products In A Store</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To zero out all stock quantities across an entire store or warehouse (e.g. for a full stocktake reset):</p>
                    <ol>
                        <li>Go to <strong>Settings</strong> → <strong>Inventory</strong>.</li>
                        <li>Tap <strong>Reset All Quantities</strong>.</li>
                        <li>Confirm the action — this will set all product stock counts to zero in the selected store.</li>
                        <li>Re-enter stock counts after your physical stocktake.</li>
                    </ol>
                </div></div>
            </div>
        </div>

        <!-- ── Section 3: Sales ── -->
        <div class="faq-category-section" id="sales">
            <div class="faq-category-header">
                <div class="faq-category-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                </div>
                <span>Sales</span>
            </div>

            <div class="faq-accordion-card" data-faq="sale-scan">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Make A Sale By Scanning A Barcode</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Making a sale using the barcode scanner on your POS device:</p>
                    <ol>
                        <li>Open the <strong>Sales / POS</strong> screen.</li>
                        <li>Tap the <strong>Scan</strong> icon or use the Sunmi built-in scanner.</li>
                        <li>Scan each product barcode to add items to the cart.</li>
                        <li>Tap <strong>Checkout</strong>, select payment method, and complete the sale.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="sale-search">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Make A Sale By Searching For Product</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Adding items to a sale by name search:</p>
                    <ol>
                        <li>Open the <strong>Sales / POS</strong> screen.</li>
                        <li>Type the product name in the search bar at the top of the POS grid.</li>
                        <li>Tap the matching product to add it to the cart.</li>
                        <li>Adjust quantity if needed, then tap <strong>Checkout</strong>.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="sale-receipt">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Print Receipts After A Sale</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>ShopKite supports thermal receipt printing and digital sharing:</p>
                    <ol>
                        <li>After completing a sale, the receipt preview will appear automatically.</li>
                        <li>Tap <strong>Print Receipt</strong> to print on a connected Sunmi or Bluetooth thermal printer.</li>
                        <li>Alternatively, tap <strong>Share</strong> to send the receipt via WhatsApp or SMS.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="sale-pause">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Pause A Sale</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To put a customer's cart on hold while serving another customer:</p>
                    <ol>
                        <li>On the active POS cart, tap the <strong>Pause</strong> or <strong>Hold Sale</strong> button.</li>
                        <li>The cart is saved as a pending sale.</li>
                        <li>You can start a new transaction immediately.</li>
                        <li>To resume, tap <strong>Pending Sales</strong> and select the held cart.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="sale-owing">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Apply An Owing Record While Making A Sale</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To record a credit sale (customer pays later):</p>
                    <ol>
                        <li>Add items to the cart and tap <strong>Checkout</strong>.</li>
                        <li>Select the customer's profile (or add a new customer).</li>
                        <li>Choose <strong>Store Credit / Owing</strong> as the payment method.</li>
                        <li>Confirm the sale — the amount is logged under the customer's debt record.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="sale-pending">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Check Pending Sales On A Device</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To view and resume paused or unsynced sales:</p>
                    <ol>
                        <li>From the POS screen, tap the <strong>Pending Sales</strong> icon (clock or queue icon).</li>
                        <li>A list of all paused or held carts on this device will appear.</li>
                        <li>Tap any pending sale to resume it and complete the checkout.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="sale-refund">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Refund A Sale</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To process a customer refund on a completed transaction:</p>
                    <ol>
                        <li>Go to <strong>Sales History</strong> and find the transaction to refund.</li>
                        <li>Tap the sale and select <strong>Refund</strong>.</li>
                        <li>Choose full or partial refund and confirm the amount.</li>
                        <li>The stock is automatically restocked and the transaction log is updated.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="sale-payment">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Create A Payment Method</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>ShopKite supports multiple custom payment options including Cash, POS Card, Bank Transfer, and Store Credit:</p>
                    <ol>
                        <li>Go to <strong>Settings</strong> → <strong>Payment Methods</strong>.</li>
                        <li>Tap <strong>Add Payment Method</strong>.</li>
                        <li>Enter the payment name (e.g. "GTBank Transfer", "Moniepoint POS").</li>
                        <li>Toggle active status and tap <strong>Save</strong> to make it available at checkout.</li>
                    </ol>
                </div></div>
            </div>
        </div>

        <!-- ── Section 4: Customer ── -->
        <div class="faq-category-section" id="customer">
            <div class="faq-category-header">
                <div class="faq-category-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <span>Customer</span>
            </div>

            <div class="faq-accordion-card" data-faq="cust-add">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Add A New Customer</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Build your customer database for loyalty and credit tracking:</p>
                    <ol>
                        <li>Tap <strong>Customers</strong> → <strong>Add Customer</strong>.</li>
                        <li>Enter the customer's Name, Phone Number, Email, and optional Birthday.</li>
                        <li>Tap <strong>Save Customer</strong>.</li>
                        <li>The customer can now be linked to sales and credit records.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="cust-update">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Update Customer Details</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To edit an existing customer's contact information:</p>
                    <ol>
                        <li>Go to <strong>Customers</strong> and search for the customer by name or phone.</li>
                        <li>Tap on their profile and select <strong>Edit</strong>.</li>
                        <li>Update their details and tap <strong>Save</strong>.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="cust-birthday">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Check Customer Birthdays</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>ShopKite notifies you of upcoming customer birthdays so you can send special offers:</p>
                    <ul>
                        <li>When a customer birthday approaches, you'll receive a notification in the app.</li>
                        <li>Go to <strong>Customers</strong> → <strong>Birthdays</strong> to see a calendar view of upcoming birthdays.</li>
                        <li>Use this to offer birthday discounts and build customer loyalty.</li>
                    </ul>
                </div></div>
            </div>
        </div>

        <!-- ── Section 5: Supply ── -->
        <div class="faq-category-section" id="supply">
            <div class="faq-category-header">
                <div class="faq-category-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                </div>
                <span>Supply</span>
            </div>

            <div class="faq-accordion-card" data-faq="sup-add-supplier">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Add New Suppliers</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To add a new supplier to your records:</p>
                    <ol>
                        <li>Go to <strong>Supply</strong> → <strong>Suppliers</strong> → <strong>Add Supplier</strong>.</li>
                        <li>Enter the supplier's name, phone number, and address.</li>
                        <li>Tap <strong>Save Supplier</strong>. They can now be selected when logging new supplies.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="sup-update-supplier">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Update Your Supplier's Records</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To update an existing supplier's contact details:</p>
                    <ol>
                        <li>Go to <strong>Supply</strong> → <strong>Suppliers</strong>.</li>
                        <li>Find and tap the supplier you want to edit.</li>
                        <li>Tap <strong>Edit</strong>, make your changes, and tap <strong>Save</strong>.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="sup-new-supply">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Add A New Supply</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Log new inventory restocking and supplier invoices:</p>
                    <ol>
                        <li>Go to <strong>Supply</strong> → <strong>New Inward Supply</strong>.</li>
                        <li>Select or add the <strong>Supplier Name</strong>.</li>
                        <li>Add the supplied products, quantities, and purchase cost prices.</li>
                        <li>Mark payment status (Paid, Partial, or Unpaid/Credit).</li>
                        <li>Tap <strong>Save Supply Log</strong> to update stock levels instantly.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="sup-view">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To View Supply Records</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To review your restocking history and supplier invoices:</p>
                    <ol>
                        <li>Go to <strong>Supply</strong> → <strong>Supply History</strong>.</li>
                        <li>Filter by date range, supplier, or payment status.</li>
                        <li>Tap any supply record to view its full details and line items.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="sup-refund">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Refund A Supply</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To return goods to a supplier and log the refund:</p>
                    <ol>
                        <li>Go to <strong>Supply</strong> → <strong>Supply History</strong> and find the supply record.</li>
                        <li>Tap the record and select <strong>Refund Supply</strong>.</li>
                        <li>Specify the items and quantities being returned.</li>
                        <li>Confirm to deduct the returned quantity from your stock and log the supplier credit.</li>
                    </ol>
                </div></div>
            </div>
        </div>

        <!-- ── Section 6: Stores / Staff ── -->
        <div class="faq-category-section" id="stores">
            <div class="faq-category-header">
                <div class="faq-category-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"/><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"/><path d="M2 7h20"/><path d="M4 12a2 2 0 0 1 2-2 2 2 0 0 1 4 0 2 2 0 0 1 4 0 2 2 0 0 1 4 0 2 2 0 0 1 2 2"/></svg>
                </div>
                <span>Stores / Staff</span>
            </div>

            <div class="faq-accordion-card" data-faq="store-managers">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Create Store Managers</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To add a Store Manager with elevated staff permissions:</p>
                    <ol>
                        <li>Go to <strong>Settings</strong> → <strong>Staff Management</strong>.</li>
                        <li>Tap <strong>Add New Staff</strong> and select <strong>Manager</strong> as the role.</li>
                        <li>Enter their name and assign a 4-digit PIN.</li>
                        <li>Configure their access permissions and tap <strong>Save</strong>.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="store-agents">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Create Sales Agents</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To add a cashier or sales agent with limited permissions:</p>
                    <ol>
                        <li>Go to <strong>Settings</strong> → <strong>Staff Management</strong> → <strong>Add New Staff</strong>.</li>
                        <li>Select <strong>Sales Agent / Cashier</strong> as the role.</li>
                        <li>Enter the agent's name and create a PIN for daily sign-in.</li>
                        <li>Toggle their access permissions (e.g. restrict profit viewing or price editing).</li>
                        <li>Tap <strong>Save Staff Profile</strong>.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="store-add">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Add A New Store</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To register a new branch or outlet under your account:</p>
                    <ol>
                        <li>Go to <strong>Settings</strong> → <strong>Stores</strong> → <strong>Add New Store</strong>.</li>
                        <li>Enter the store name, address, and contact details.</li>
                        <li>Assign a manager and configure store-specific settings.</li>
                        <li>Tap <strong>Save Store</strong> to activate the branch.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="store-update">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Update Your Store Details</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To update your store name, address, or contact info:</p>
                    <ol>
                        <li>Go to <strong>Settings</strong> → <strong>Store Profile</strong>.</li>
                        <li>Tap <strong>Edit</strong> and update the relevant fields.</li>
                        <li>Tap <strong>Save Changes</strong> to apply the update across all devices.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="store-subscription">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Check My Subscription Status</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To view your current subscription plan and expiry date:</p>
                    <ol>
                        <li>Go to <strong>Settings</strong> → <strong>Subscription</strong>.</li>
                        <li>Your plan name, start date, and renewal date are displayed.</li>
                        <li>You'll also see an alert if your subscription is expiring soon.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="store-renew">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Renew Your Subscription</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To renew or upgrade your ShopKite subscription:</p>
                    <ol>
                        <li>Go to <strong>Settings</strong> → <strong>Subscription</strong> → <strong>Renew Plan</strong>.</li>
                        <li>Select your preferred plan duration (Monthly or Annual).</li>
                        <li>Complete payment via card, bank transfer, or USSD.</li>
                        <li>Your subscription is renewed immediately upon payment confirmation.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="store-permissions">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Set Access Permission For Staff Accounts</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Control what each staff member can see and do in the app:</p>
                    <ol>
                        <li>Go to <strong>Settings</strong> → <strong>Staff Management</strong>.</li>
                        <li>Tap on a staff member and select <strong>Edit Permissions</strong>.</li>
                        <li>Toggle individual permissions: view reports, edit prices, void sales, view profit margins, etc.</li>
                        <li>Tap <strong>Save</strong> to apply the restrictions immediately.</li>
                    </ol>
                </div></div>
            </div>
        </div>

        <!-- ── Section 7: Notification ── -->
        <div class="faq-category-section" id="notification">
            <div class="faq-category-header">
                <div class="faq-category-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                </div>
                <span>Notification</span>
            </div>

            <div class="faq-accordion-card" data-faq="notif-past">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Check Your Past Notifications</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Reviewing historical store alerts and staff activities:</p>
                    <ol>
                        <li>Tap the <strong>Bell Icon</strong> in the top header of the ShopKite app.</li>
                        <li>Filter by <strong>Sales Alerts</strong>, <strong>Low Stock Alerts</strong>, <strong>Expiry Warnings</strong>, or <strong>System Logs</strong>.</li>
                        <li>Tap any notification to view detailed timestamps and transaction summaries.</li>
                    </ol>
                </div></div>
            </div>
        </div>

        <!-- ── Section 8: Warehouse ── -->
        <div class="faq-category-section" id="warehouse">
            <div class="faq-category-header">
                <div class="faq-category-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M3 7v14"/><path d="M21 7v14"/><path d="M6 21V10h12v11"/><path d="m3 7 9-4 9 4"/></svg>
                </div>
                <span>Warehouse</span>
            </div>

            <div class="faq-accordion-card" data-faq="wh-create">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Create A Warehouse</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To set up a central warehouse for bulk storage:</p>
                    <ol>
                        <li>Go to <strong>Warehouse</strong> → <strong>Add Warehouse</strong>.</li>
                        <li>Enter the warehouse name and location address.</li>
                        <li>Assign a warehouse manager if needed.</li>
                        <li>Tap <strong>Save Warehouse</strong> to activate it.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="wh-view">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To View Your Warehouse</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To see current stock levels in your warehouse:</p>
                    <ol>
                        <li>Go to the <strong>Warehouse</strong> section from the main menu.</li>
                        <li>Select the warehouse you want to view.</li>
                        <li>Browse all products stored there with their current quantities.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="wh-add-products">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Add Products To Your Warehouse</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To stock a warehouse with products:</p>
                    <ol>
                        <li>Open the warehouse from <strong>Warehouse</strong> in the main menu.</li>
                        <li>Tap <strong>Add Products</strong>.</li>
                        <li>Search for or scan the products to add and enter the quantities.</li>
                        <li>Tap <strong>Save</strong> to update the warehouse inventory.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="wh-move">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Move Products From Warehouse</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>Transfer stock from warehouse to a store branch:</p>
                    <ol>
                        <li>Go to <strong>Warehouse</strong> → <strong>Stock Transfer</strong>.</li>
                        <li>Select the warehouse as the <strong>Source</strong> and choose the destination store.</li>
                        <li>Add products and quantities, then tap <strong>Issue Transfer</strong>.</li>
                        <li>The destination store manager receives a prompt to accept the incoming stock.</li>
                    </ol>
                </div></div>
            </div>

            <div class="faq-accordion-card" data-faq="wh-update">
                <div class="faq-accordion-header">
                    <h3 class="faq-accordion-title">How To Update A Product In Your Warehouse</h3>
                    <div class="faq-chevron"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg></div>
                </div>
                <div class="faq-accordion-body"><div class="faq-accordion-content">
                    <p>To edit a product's details or stock level in the warehouse:</p>
                    <ol>
                        <li>Open the warehouse and find the product.</li>
                        <li>Tap the product and select <strong>Edit</strong>.</li>
                        <li>Update the stock quantity, cost price, or expiry date.</li>
                        <li>Tap <strong>Save</strong> to apply the changes.</li>
                    </ol>
                </div></div>
            </div>
        </div>

        <!-- No Results Fallback -->
        <div class="faq-no-results" id="faqNoResults">
            No matching questions found for your search query. Try searching for different keywords like "sign up", "sales", "stock", or "receipt".
        </div>

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

        // ── 1. Collapsible Sidebar & Mobile Drawer Toggle ───────────────
        const sidebar   = document.getElementById('faqSidebar');
        const toggleBtn = document.getElementById('faqSidebarToggle');
        const mobileBtn = document.getElementById('faqMobileDrawerBtn');
        const overlay   = document.getElementById('faqSidebarOverlay');

        function openMobileSidebar() {
            if (sidebar) sidebar.classList.add('open-mobile');
            if (overlay) overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileSidebar() {
            if (sidebar) sidebar.classList.remove('open-mobile');
            if (overlay) overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (mobileBtn) {
            mobileBtn.addEventListener('click', openMobileSidebar);
        }

        if (overlay) {
            overlay.addEventListener('click', closeMobileSidebar);
        }

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                if (window.innerWidth <= 900) {
                    closeMobileSidebar();
                } else if (sidebar) {
                    sidebar.classList.toggle('collapsed');
                }
            });
        }

        // ── 2. References ──────────────────────────────────────────────
        const treeGroups       = document.querySelectorAll('.faq-tree-group');
        const treeHeaders      = document.querySelectorAll('.faq-tree-header');
        const subItems         = document.querySelectorAll('.faq-tree-subitem');
        const accordionHeaders = document.querySelectorAll('.faq-accordion-header');
        const categorySections = document.querySelectorAll('.faq-category-section');

        // Helper: highlight a single active sub-item (or clear if null)
        function setActiveSubItem(faqId) {
            subItems.forEach(s => s.classList.remove('sub-active'));
            if (faqId) {
                const match = document.querySelector(`.faq-tree-subitem[data-faq="${faqId}"]`);
                if (match) match.classList.add('sub-active');
            }
        }

        // Helper: open only one category group and collapse all others
        function openCategoryGroupOnly(catId) {
            treeGroups.forEach(group => {
                if (group.getAttribute('data-category') === catId) {
                    group.classList.add('open');
                } else {
                    group.classList.remove('open');
                }
            });
        }

        // ── 3. Tree parent header manual toggle & scroll ──────────────
        treeHeaders.forEach(header => {
            header.addEventListener('click', (e) => {
                e.stopPropagation();
                const group = header.closest('.faq-tree-group');
                const catId = group.getAttribute('data-category');
                openCategoryGroupOnly(catId);

                const section = document.getElementById(catId);
                if (section) {
                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }

                if (window.innerWidth <= 900) {
                    closeMobileSidebar();
                }
            });
        });

        // ── 4. Sub-item click → open accordion card & sync sidebar ───
        subItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();
                const faqId = item.getAttribute('data-faq');
                const card  = document.querySelector(`.faq-accordion-card[data-faq="${faqId}"]`);

                // Mark active sub-item
                setActiveSubItem(faqId);

                // Open parent tree group & collapse others
                const group = item.closest('.faq-tree-group');
                if (group) {
                    const catId = group.getAttribute('data-category');
                    openCategoryGroupOnly(catId);
                }

                if (window.innerWidth <= 900) {
                    closeMobileSidebar();
                }

                if (card) {
                    // Open target card
                    card.classList.add('open');
                    // Scroll smoothly to card
                    card.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // ── 5. Main content Accordion card header click → sync sidebar ─
        accordionHeaders.forEach(header => {
            header.addEventListener('click', () => {
                const card   = header.closest('.faq-accordion-card');
                const isOpen = card.classList.contains('open');

                // Toggle card state
                card.classList.toggle('open', !isOpen);

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
                    // Check if any other cards in this category section are still open
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

        // ── 6. Scroll observer: auto-expand ONLY active category section 
        const observerOptions = {
            root: null,
            rootMargin: '-20% 0px -60% 0px',
            threshold: 0
        };

        const catObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const catId = entry.target.getAttribute('id');
                    openCategoryGroupOnly(catId);
                }
            });
        }, observerOptions);

        categorySections.forEach(s => catObserver.observe(s));

        // ── 7. Live FAQ Search Filter ──────────────────────────────────
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
                        firstMatchCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 150);
                }
            });
        }

    });
</script>
@endpush
