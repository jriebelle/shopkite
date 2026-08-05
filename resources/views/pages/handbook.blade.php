@extends('layouts.app')

@section('title', 'Agent Handbook — ShopKite')
@section('meta_description', 'The ShopKite Agent Handbook. Understand the ShopKite Merchant app, earnings, onboarding procedures, payouts, and benefits.')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/agent.css?v=1.1.0') }}">
@endsection

@section('content')
<!-- Main Content Area -->
<main class="agent-content-area">
    
    <!-- Generic Banner -->
    <div class="generic-banner" style="margin-bottom: 40px;">
        <div class="generic-banner-text">
            <span>ShopKite Agent</span>
            <span class="generic-banner-text-bold">Handbook</span>
        </div>
        <img src="{{ asset('img/generic-banner@2x.png') }}" alt="ShopKite Agent Handbook Banner">
    </div>

    <!-- Intro Writeup -->
    <div class="agent-writeup">
        <p class="agent-hero-subtitle">The ultimate guide that explains everything you need to know about being a ShopKite Agent. Learn about the ShopKite Merchant app, how you earn as an agent, merchant onboarding, and key program benefits.</p>
    </div>

    <!-- Quick Table of Contents -->
    <div class="handbook-toc-card">
        <div class="handbook-toc-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            Table of Contents
        </div>
        <div class="handbook-toc-grid">
            <a href="#about" class="handbook-toc-pill">What is ShopKite?</a>
            <a href="#program" class="handbook-toc-pill">The Agent Program</a>
            <a href="#how" class="handbook-toc-pill">How to Become an Agent</a>
            <a href="#earn" class="handbook-toc-pill">Earning Money</a>
            <a href="#subscribe" class="handbook-toc-pill">Onboarding Merchants</a>
            <a href="#appearance" class="handbook-toc-pill">Appearance</a>
            <a href="#portal" class="handbook-toc-pill">Agent Portal</a>
            <a href="#payout" class="handbook-toc-pill">Payouts</a>
        </div>
    </div>

    <!-- Section 1: What is ShopKite -->
    <section id="about" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            </div>
            <h2 class="handbook-section-title">What is ShopKite?</h2>
        </div>
        <ul class="handbook-list">
            <li><strong>All-in-one Retail Management:</strong> ShopKite is an app that helps supermarket and pharmacy owners manage their sales and inventory with ease, making it effortless to run their business and bring their store online.</li>
            <li><strong>Real-time Sales Insights:</strong> Merchants can manage day-to-day sales, print receipts, and track performance daily, weekly, monthly, or yearly with just a tap from their mobile phone or tablet.</li>
            <li><strong>Pre-loaded Product Database:</strong> ShopKite Merchant comes pre-loaded with thousands of products. Store owners can add items easily using built-in barcode scanning or quick search options.</li>
            <li><strong>Complete Business Records:</strong> Keep comprehensive records of suppliers, customer profiles and birthdays, sales agents, store managers, and multiple warehouses.</li>
            <li><strong>Smart Notifications:</strong> Instant alerts for completed sales, expiring stock, and low inventory levels so merchants never run out of stock.</li>
            <li><strong>Cross-Platform Support:</strong> Available on both Google Play Store for Android devices and Apple App Store for iOS (iPhone &amp; iPad).</li>
        </ul>
    </section>

    <!-- Section 2: Agent Program -->
    <section id="program" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <h2 class="handbook-section-title">What is the ShopKite Agent Program?</h2>
        </div>
        <ul class="handbook-list">
            <li>With over <strong>1.3 million retail stores</strong> in Nigeria, store owners are looking for simpler, modern solutions to manage their inventory and sales.</li>
            <li>The <strong>ShopKite Agent Program</strong> gives you the opportunity to earn substantial income by recommending the ShopKite Merchant app to supermarkets and pharmacies in your area and nationwide.</li>
        </ul>
    </section>

    <!-- Section 3: How to become an agent -->
    <section id="how" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
            </div>
            <h2 class="handbook-section-title">How Do I Become a ShopKite Agent?</h2>
        </div>
        <div class="handbook-steps">
            <div class="handbook-step-item">
                <div class="handbook-step-number">1</div>
                <div class="handbook-step-body">
                    <h4>Register Online</h4>
                    <p>Fill out the simple application on the official <a href="https://agent.shopkite.com.ng/register" target="_blank" rel="noopener noreferrer">ShopKite Agent Registration Page</a>.</p>
                </div>
            </div>
            <div class="handbook-step-item">
                <div class="handbook-step-number">2</div>
                <div class="handbook-step-body">
                    <h4>Account Confirmation</h4>
                    <p>Receive review and approval notification from the ShopKite Agent Onboarding team.</p>
                </div>
            </div>
            <div class="handbook-step-item">
                <div class="handbook-step-number">3</div>
                <div class="handbook-step-body">
                    <h4>Receive Training Materials</h4>
                    <p>Access training guides, scripts, and product walkthroughs that prepare you to speak with confidence.</p>
                </div>
            </div>
            <div class="handbook-step-item">
                <div class="handbook-step-number">4</div>
                <div class="handbook-step-body">
                    <h4>Start Recommending &amp; Earning</h4>
                    <p>Visit supermarkets and pharmacies around you, subscribe them to ShopKite Merchant, and watch your wallet earnings grow!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Earning Money -->
    <section id="earn" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
            </div>
            <h2 class="handbook-section-title">Earning Money as a ShopKite Agent</h2>
        </div>
        <p style="font-size: 15px; color: #475569; line-height: 1.7;">As a ShopKite Agent, you have multiple revenue streams including commissions, monthly volume bonuses, recurring renewals, and paid merchant services:</p>

        <div class="handbook-earnings-grid">
            <div class="handbook-earning-badge">
                <div class="handbook-earning-amount">&#8358;6,000</div>
                <div class="handbook-earning-label">Per new merchant (Initial subscription &#8358;3,000 + Hardware sale &#8358;3,000)</div>
            </div>
            <div class="handbook-earning-badge">
                <div class="handbook-earning-amount">&#8358;10,000</div>
                <div class="handbook-earning-label">Monthly bonus for registering up to 10 merchants</div>
            </div>
            <div class="handbook-earning-badge">
                <div class="handbook-earning-amount">&#8358;1,000</div>
                <div class="handbook-earning-label">Recurring commission on every subscription renewal</div>
            </div>
            <div class="handbook-earning-badge">
                <div class="handbook-earning-amount">&#8358;8,000</div>
                <div class="handbook-earning-label">For 100 units of stock-taking assistance</div>
            </div>
            <div class="handbook-earning-badge">
                <div class="handbook-earning-amount">&#8358;7,500</div>
                <div class="handbook-earning-label">For staff training session (up to 3 hours)</div>
            </div>
        </div>
    </section>

    <!-- Section 5: Subscribing & Onboarding -->
    <section id="subscribe" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <h2 class="handbook-section-title">Subscribing &amp; Onboarding New Merchants</h2>
        </div>
        
        <div class="handbook-steps">
            <div class="handbook-step-item">
                <div class="handbook-step-number">1</div>
                <div class="handbook-step-body">
                    <h4>Find a Lead</h4>
                    <p>Identify supermarkets and pharmacies in your neighbourhood. Pitch ShopKite Merchant, ensure they register using your <strong>referral code</strong>, and receive commission in your Agent Wallet immediately upon subscription.</p>
                </div>
            </div>
            <div class="handbook-step-item">
                <div class="handbook-step-number">2</div>
                <div class="handbook-step-body">
                    <h4>Set Up the Merchant</h4>
                    <p>Confirm if the store needs help taking stock. If yes, inform them of inventory counting rates, conduct a preliminary survey count, send the Stocktaking Price List, and verify product entry after payment.</p>
                </div>
            </div>
            <div class="handbook-step-item">
                <div class="handbook-step-number">3</div>
                <div class="handbook-step-body">
                    <h4>Follow Up</h4>
                    <p>Conduct at least 4 follow-up calls within the first month to ensure operations are smooth. Provide in-person assistance for initial questions when needed.</p>
                </div>
            </div>
            <div class="handbook-step-item">
                <div class="handbook-step-number">4</div>
                <div class="handbook-step-body">
                    <h4>Finish Up</h4>
                    <p>After one month of clean operations with no pending issues, the merchant onboarding is officially completed and closed!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: Brand, Portal & Payouts -->
    <section id="appearance" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
            </div>
            <h2 class="handbook-section-title">Brand, Portal &amp; Payouts</h2>
        </div>
        <ul class="handbook-list">
            <li id="appearance-item"><strong>Appearance &amp; Brand Standards:</strong> As a ShopKite Agent, you represent the brand. Always dress smartly and professionally when presenting ShopKite Merchant to business owners.</li>
            <li id="portal-item"><strong>ShopKite Agent Portal:</strong> Once approved, you gain full access to your personal Agent Dashboard where you can monitor referred merchants, track stocktaking tasks, and view wallet balances.</li>
            <li id="payout-item"><strong>Weekly Payouts:</strong> Earnings in your ShopKite Agent purse are transferred directly into your registered bank account on a reliable weekly schedule.</li>
        </ul>
    </section>

    <!-- CTA Box -->
    <div class="agent-cta-box">
        <h2>Ready to Put the Handbook into Action?</h2>
        <p>Start recommending ShopKite Merchant to store owners around you and build a steady revenue stream.</p>
        <div class="agent-btn-group">
            <a href="https://agent.shopkite.com.ng/register" target="_blank" rel="noopener noreferrer" class="agent-btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                Sign up as a ShopKite Agent
            </a>
            <a href="{{ route('agent') }}" class="agent-btn-secondary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                Back to Agent Overview
            </a>
        </div>
    </div>

</main>
@endsection
