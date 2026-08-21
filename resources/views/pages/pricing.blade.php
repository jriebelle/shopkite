@extends('layouts.app')

@section('title', 'Simple, Transparent Pricing — ShopKite Merchant')
@section('meta_description', 'Choose between flexible Monthly (₦5,000/mo) and Yearly (₦45,000/yr — save 25%) plans for ShopKite Merchant. Includes unlimited users, 400,000+ preloaded SKUs, offline sales, and real-time reports.')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/pricing.css') }}?v={{ filemtime(public_path('css/pricing.css')) }}">
@endsection

@section('content')
<main class="pricing-page-wrapper">
    <div class="pricing-container">

        <!-- ── 1. Hero & Title Area (Styled like Recommended Devices) ── -->
        <div class="pricing-page-title">
            <h3>Simple, transparent pricing with <span class="highlight-shopkite">no hidden fees</span></h3>
            <div class="pricing-page-subtext">
                <p>Every ShopKite plan includes unlimited staff accounts, over 400,000 preloaded product SKUs, offline checkout, and automated business reporting. Start with a free 7-day trial.</p>
            </div>
        </div>

        <!-- Billing Toggle Switch -->
        <div class="pricing-toggle-container">
            <div class="pricing-toggle-wrap">
                <button type="button" class="pricing-toggle-btn" id="monthlyToggleBtn">Billed Monthly</button>
                <button type="button" class="pricing-toggle-btn active" id="yearlyToggleBtn">
                    Billed Annually
                </button>
            </div>
        </div>

        <!-- ── 2. Pricing Cards Grid ─────────────────────────────── -->
        <section class="pricing-cards-grid">

            <!-- Monthly Plan Card -->
            <div class="pricing-card" id="monthlyPlanCard">
                <div class="pricing-card-header">
                    <h2 class="pricing-plan-name">Monthly Plan</h2>
                    <p class="pricing-plan-description">
                        Flexible pay-as-you-go subscription for neighbourhood stores, pharmacies, and growing retail outlets.
                    </p>
                    <div class="pricing-price-wrap">
                        <span class="pricing-currency">&#8358;</span>
                        <span class="pricing-amount">5,000</span>
                        <span class="pricing-period">/ month</span>
                    </div>
                    <div class="pricing-savings-note muted">
                        Billed every 30 days &bull; Cancel anytime
                    </div>
                </div>

                <a href="#trial-cta" class="pricing-cta-btn secondary">
                    <span>Start 7-Day Free Trial</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>

                <div class="pricing-card-divider"></div>

                <div class="pricing-features-title">What's included:</div>
                <ul class="pricing-feature-list">
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>Unlimited Users:</strong> Add owner, manager, cashier &amp; sales staff</span>
                    </li>
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>400,000+ Preloaded SKUs:</strong> Instant product lookup &amp; barcode scanning</span>
                    </li>
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>Offline Sales:</strong> Sell seamlessly without internet &amp; auto-sync</span>
                    </li>
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>Print Receipts:</strong> Supports Bluetooth, USB &amp; thermal receipt printers</span>
                    </li>
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>Automated Expiry &amp; Low-Stock:</strong> Instant proactive notifications</span>
                    </li>
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>Daily, Monthly &amp; Yearly Reports:</strong> Financial &amp; stock movement analytics</span>
                    </li>
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>Intelligent Business Reports (IBR):</strong> Automated business diagnostics</span>
                    </li>
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>Multi-Location &amp; Warehouse:</strong> Centralized stock management</span>
                    </li>
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>Customer &amp; Owing Records:</strong> Debtor management &amp; payment tracking</span>
                    </li>
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>Standard Customer Support</strong></span>
                    </li>
                </ul>

                <div class="pricing-branch-note">
                    <p><strong>Please note:</strong> Additional branches attract the full monthly (&#8358;5,000) or annual (&#8358;45,000) fee. Staff training and physical stocktaking services attract additional fees.</p>
                    <a href="{{ route('store') }}" class="pricing-note-store-btn">
                        <span>Visit Our Store for Service Pricing</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Yearly Plan Card (Featured) -->
            <div class="pricing-card featured" id="yearlyPlanCard">
                <div class="pricing-card-badge">Best Value &bull; 3 Months Free</div>
                <div class="pricing-card-header">
                    <h2 class="pricing-plan-name">Yearly Plan</h2>
                    <p class="pricing-plan-description">
                        Maximum savings for retail businesses committed to uninterrupted sales, inventory tracking, and growth.
                    </p>
                    <div class="pricing-price-wrap">
                        <span class="pricing-currency">&#8358;</span>
                        <span class="pricing-amount">45,000</span>
                        <span class="pricing-period">/ year</span>
                    </div>
                    <div class="pricing-savings-note muted">
                        Billed every 365 days &bull; Cancel anytime
                    </div>
                </div>

                <a href="#trial-cta" class="pricing-cta-btn primary">
                    <span>Start 7-Day Free Trial</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>

                <div class="pricing-card-divider"></div>

                <div class="pricing-features-title">Annual Plan Benefits:</div>
                <ul class="pricing-feature-list">
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>Save &#8358;15,000 / Year (25% OFF):</strong> Pay &#8358;45,000 instead of &#8358;60,000 &bull; Get 3 months completely free</span>
                    </li>
                    <li class="pricing-feature-item">
                        <span class="pricing-check-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        <span><strong>All Monthly Plan Features Included:</strong> Full access to sales, inventory, unlimited staff accounts, reports, and offline mode</span>
                    </li>
                </ul>

                <div class="pricing-branch-note">
                    <p><strong>Please note:</strong> Additional branches attract the full monthly (&#8358;5,000) or annual (&#8358;45,000) fee. Staff training and physical stocktaking services attract additional fees.</p>
                    <a href="{{ route('store') }}" class="pricing-note-store-btn">
                        <span>Visit Our Store for Service Pricing</span>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

        </section>

        <!-- ── 3. Full Feature Comparison Matrix ─────────────────── -->
        <section class="pricing-matrix-section">
            <div class="pricing-section-header">
                <h2>Detailed Plan Comparison</h2>
                <p>Everything is transparent. Compare features side-by-side.</p>
            </div>

            <!-- Mobile Plan Switcher Tabs -->
            <div class="matrix-mobile-switcher" id="matrixMobileSwitcher">
                <button type="button" class="matrix-tab-btn active" data-plan="monthly">Monthly (&#8358;5,000)</button>
                <button type="button" class="matrix-tab-btn" data-plan="yearly">Yearly (&#8358;45,000)</button>
            </div>

            <div class="pricing-matrix-wrapper show-monthly" id="pricingMatrixWrapper">
                <table class="pricing-matrix-table">
                    <thead>
                        <tr>
                            <th class="col-feature">Features &amp; Capabilities</th>
                            <th class="col-monthly">Monthly Plan (&#8358;5,000/mo)</th>
                            <th class="col-yearly">Yearly Plan (&#8358;45,000/yr)</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Core Sales & Checkout -->
                        <tr class="pricing-matrix-category">
                            <td colspan="3">Sales &amp; Checkout Operations</td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Barcode Scanning &amp; Smart Search</span>
                                <span class="pricing-matrix-feature-desc">Scan physical barcodes with camera or external 1D/2D scanner</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Offline Mode &amp; Cloud Sync</span>
                                <span class="pricing-matrix-feature-desc">Process checkout offline and sync data automatically</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Pause &amp; Transfer Sales</span>
                                <span class="pricing-matrix-feature-desc">Pause active cart or transfer sale to checkout cashier</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Discounts, Volume Pricing &amp; Refunds</span>
                                <span class="pricing-matrix-feature-desc">Apply percentage/flat discounts and manage returns</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Thermal Receipt Printing</span>
                                <span class="pricing-matrix-feature-desc">Supports Bluetooth, USB, and thermal receipt printers</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>

                        <!-- Inventory & SKUs -->
                        <tr class="pricing-matrix-category">
                            <td colspan="3">Product Catalog &amp; Inventory Management</td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">400,000+ Pre-loaded SKUs Database</span>
                                <span class="pricing-matrix-feature-desc">Instant catalog setup with pre-filled product data</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Product Expiry Date Tracking</span>
                                <span class="pricing-matrix-feature-desc">Automated alerts for expired &amp; expiring product batches</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Low Stock Threshold Warnings</span>
                                <span class="pricing-matrix-feature-desc">Reorder warnings when inventory drops below set minimums</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Supply Records &amp; Supplier Management</span>
                                <span class="pricing-matrix-feature-desc">Record restocking batches and track supplier histories</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>

                        <!-- Users & Staff -->
                        <tr class="pricing-matrix-category">
                            <td colspan="3">Staff Accounts &amp; Access Controls</td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Staff Accounts</span>
                                <span class="pricing-matrix-feature-desc">Number of staff accounts permitted per store</span>
                            </td>
                            <td class="col-monthly"><strong>Unlimited</strong></td>
                            <td class="col-yearly"><strong>Unlimited</strong></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Granular Staff Roles &amp; Permissions</span>
                                <span class="pricing-matrix-feature-desc">Control what staff can see, edit, discount, or delete</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">PIN Security for Critical Actions</span>
                                <span class="pricing-matrix-feature-desc">Secure discounts, refunds, and cancellations</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>

                        <!-- Multi-Store & Analytics -->
                        <tr class="pricing-matrix-category">
                            <td colspan="3">Multi-Store &amp; Additional Branches</td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Multi-Branch &amp; Warehouse Accounts</span>
                                <span class="pricing-matrix-feature-desc">Switch between stores and transfer stock seamlessly</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Additional Branch Pricing</span>
                                <span class="pricing-matrix-feature-desc">Cost per additional branch outlet</span>
                            </td>
                            <td class="col-monthly"><strong>Full fee (&#8358;5,000/mo)</strong></td>
                            <td class="col-yearly"><strong>Full fee (&#8358;45,000/yr)</strong></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Customer info &amp; Owing Records</span>
                                <span class="pricing-matrix-feature-desc">Track debtor balances, store credits, and birthdays</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Daily, Weekly &amp; Monthly Reports</span>
                                <span class="pricing-matrix-feature-desc">Sales summaries, payment breakdowns, and export to CSV</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Intelligent Business Report (IBR)</span>
                                <span class="pricing-matrix-feature-desc">Consolidated business health check across 20 parameters</span>
                            </td>
                            <td class="col-monthly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                            <td class="col-yearly"><span class="matrix-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><polyline points="20 6 9 17 4 12"/></svg></span></td>
                        </tr>

                        <!-- Support & Services -->
                        <tr class="pricing-matrix-category">
                            <td colspan="3">Support &amp; Value-Added Services</td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Customer Support</span>
                                <span class="pricing-matrix-feature-desc">Customer care assistance via phone, WhatsApp &amp; in-app</span>
                            </td>
                            <td class="col-monthly">Included</td>
                            <td class="col-yearly">Included</td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Staff Training &amp; Physical Stocktaking</span>
                                <span class="pricing-matrix-feature-desc">On-site employee training and physical inventory counting &bull; <a href="{{ route('store') }}" style="color: #ff6600; text-decoration: underline; font-weight: 500;">View store pricing &rarr;</a></span>
                            </td>
                            <td class="col-monthly"><strong>Additional fee applies</strong></td>
                            <td class="col-yearly"><strong>Additional fee applies</strong></td>
                        </tr>
                        <tr>
                            <td class="col-feature">
                                <span class="pricing-matrix-feature-name">Annual Savings Discount</span>
                                <span class="pricing-matrix-feature-desc">Upfront annual commitment discount</span>
                            </td>
                            <td class="col-monthly">Standard rate</td>
                            <td class="col-yearly"><strong>Save &#8358;15,000 (25% OFF)</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- ── 4. Hardware Bundle Callout Banner ─── -->
        <section class="pricing-hardware-section">
            <div class="pricing-hardware-card">
                <div class="pricing-hardware-content">
                    <h2>Need Dedicated Retail Hardware?</h2>
                    <p>
                        Pair your ShopKite Merchant subscription with our world-class Sunmi retail hardware (Stella &amp; Ken). Equipped with high-speed thermal printers, touch displays, and barcode scanners.
                    </p>
                    <div class="pricing-hardware-buttons">
                        <a href="{{ route('store') }}" class="hardware-store-btn">
                            <span>Visit Our Store</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('devices') }}" class="hardware-devices-btn">
                            <span>View Recommended Devices</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ── 5. Interactive FAQ Accordion ──────────────────────── -->
        <section class="pricing-faq-section">
            <div class="pricing-section-header">
                <h2>Frequently Asked Questions</h2>
                <p>Have questions about subscriptions, billing, or device setup? We've got answers.</p>
            </div>

            <div class="pricing-faq-accordion" id="pricingFaqAccordion">

                <div class="pricing-faq-item open">
                    <button type="button" class="pricing-faq-question" aria-expanded="true">
                        <span>Can I try ShopKite Merchant before paying?</span>
                        <svg class="pricing-faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="pricing-faq-answer">
                        Yes! Every new user gets a <strong>7-Day Free Trial</strong> with full access to all features, unlimited staff accounts, and the complete 400,000+ preloaded product database. No credit card is required to start your trial.
                    </div>
                </div>

                <div class="pricing-faq-item">
                    <button type="button" class="pricing-faq-question" aria-expanded="false">
                        <span>How many staff members or cashiers can I add?</span>
                        <svg class="pricing-faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="pricing-faq-answer">
                        Both the Monthly (&#8358;5,000/mo) and Yearly (&#8358;45,000/yr) plans allow <strong>unlimited users</strong>. You can create separate login profiles for cashiers, inventory clerks, store managers, and business owners with customizable permissions.
                    </div>
                </div>

                <div class="pricing-faq-item">
                    <button type="button" class="pricing-faq-question" aria-expanded="false">
                        <span>Do additional branches attract extra fees?</span>
                        <svg class="pricing-faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="pricing-faq-answer">
                        Yes. Each additional store branch or outlet attracts the full monthly (&#8358;5,000) or annual (&#8358;45,000) subscription fee, providing that location with its own independent sales records, staff logins, and localized inventory tracking.
                    </div>
                </div>

                <div class="pricing-faq-item">
                    <button type="button" class="pricing-faq-question" aria-expanded="false">
                        <span>Are staff training and stocktaking services included?</span>
                        <svg class="pricing-faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="pricing-faq-answer">
                        Standard customer support and self-help video guides are fully included. Hands-on on-site staff training and physical inventory stocktaking services are available upon request and attract additional service fees.
                    </div>
                </div>

                <div class="pricing-faq-item">
                    <button type="button" class="pricing-faq-question" aria-expanded="false">
                        <span>Do I need to purchase a specific device to use ShopKite?</span>
                        <svg class="pricing-faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="pricing-faq-answer">
                        No, ShopKite runs on any standard Android smartphone, Android tablet, iPad, iPhone, or Mac (Apple Silicon). If you want an integrated point-of-sale terminal with a built-in printer, you can optionally purchase our <strong>Stella</strong> or <strong>Ken</strong> devices from our Store.
                    </div>
                </div>

                <div class="pricing-faq-item">
                    <button type="button" class="pricing-faq-question" aria-expanded="false">
                        <span>How does the Yearly plan discount work?</span>
                        <svg class="pricing-faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="pricing-faq-answer">
                        When you subscribe annually for <strong>&#8358;45,000/year</strong>, you save &#8358;15,000 compared to paying &#8358;5,000 each month (&#8358;60,000 total). This equals a 25% discount or 3 free months of subscription.
                    </div>
                </div>

                <div class="pricing-faq-item">
                    <button type="button" class="pricing-faq-question" aria-expanded="false">
                        <span>Can I still make sales when there is no internet?</span>
                        <svg class="pricing-faq-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="pricing-faq-answer">
                        Yes. ShopKite is built with offline-first architecture. You can add items to cart, apply discounts, scan barcodes, print receipts, and complete checkouts completely offline. Once your device reconnects to Wi-Fi or cellular data, all sales and inventory automatically sync to the cloud.
                    </div>
                </div>

            </div>

            <!-- View Full FAQ Button -->
            <div class="pricing-faq-more">
                <span class="pricing-faq-more-text">View full FAQ</span>
                <a href="{{ route('faq') }}" class="pricing-faq-more-btn">
                    <span>Frequently Asked Questions</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </section>

        <!-- ── 6. Trial & App Download CTA Banner ─────────────────── -->
        <section class="pricing-trial-section" id="trial-cta">
            <h2>Ready to transform your retail business?</h2>
            <p>
                Download ShopKite Merchant now to start your 7-Day Free Trial. Instant setup with 400,000+ preloaded SKUs.
            </p>
            <div class="pricing-trial-buttons">
                <a href="#" class="pricing-app-btn">
                    <img src="{{ asset('img/apple-icon.png') }}" alt="Apple App Store">
                    <span>Download for iOS / Mac</span>
                </a>
                <a href="#" class="pricing-app-btn">
                    <img src="{{ asset('img/android-icon.png') }}" alt="Google Play Store">
                    <span>Download for Android</span>
                </a>
            </div>
        </section>

    </div>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ── Interactive Billing Switcher ────────────────────────────────
    const monthlyBtn = document.getElementById('monthlyToggleBtn');
    const yearlyBtn = document.getElementById('yearlyToggleBtn');
    const monthlyCard = document.getElementById('monthlyPlanCard');
    const yearlyCard = document.getElementById('yearlyPlanCard');

    if (monthlyBtn && yearlyBtn) {
        monthlyBtn.addEventListener('click', function() {
            monthlyBtn.classList.add('active');
            yearlyBtn.classList.remove('active');
            
            // Highlight monthly card smoothly
            monthlyCard.style.borderColor = '#ff6600';
            monthlyCard.style.boxShadow = '0 16px 48px rgba(255, 102, 0, 0.15)';
            yearlyCard.style.borderColor = '#e2e8f0';
            yearlyCard.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.04)';
        });

        yearlyBtn.addEventListener('click', function() {
            yearlyBtn.classList.add('active');
            monthlyBtn.classList.remove('active');

            // Highlight yearly card smoothly
            yearlyCard.style.borderColor = '#ff6600';
            yearlyCard.style.boxShadow = '0 16px 48px rgba(255, 102, 0, 0.15)';
            monthlyCard.style.borderColor = '#e2e8f0';
            monthlyCard.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.04)';
        });
    }

    // ── Mobile Matrix Tab Switcher ──────────────────────────────────
    const matrixTabs = document.querySelectorAll('.matrix-tab-btn');
    const matrixWrapper = document.getElementById('pricingMatrixWrapper');

    if (matrixTabs.length && matrixWrapper) {
        matrixTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const plan = this.getAttribute('data-plan');
                matrixTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                if (plan === 'yearly') {
                    matrixWrapper.classList.remove('show-monthly');
                    matrixWrapper.classList.add('show-yearly');
                } else {
                    matrixWrapper.classList.remove('show-yearly');
                    matrixWrapper.classList.add('show-monthly');
                }
            });
        });
    }

    // ── Interactive FAQ Accordion ───────────────────────────────────
    const faqItems = document.querySelectorAll('.pricing-faq-item');
    faqItems.forEach(item => {
        const questionBtn = item.querySelector('.pricing-faq-question');
        if (questionBtn) {
            questionBtn.addEventListener('click', function() {
                const isOpen = item.classList.contains('open');
                
                // Close other items for single accordion flow
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('open');
                        const otherBtn = otherItem.querySelector('.pricing-faq-question');
                        if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
                    }
                });

                item.classList.toggle('open', !isOpen);
                questionBtn.setAttribute('aria-expanded', !isOpen);
            });
        }
    });
});
</script>
@endpush
