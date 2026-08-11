@extends('layouts.app')

@section('title', 'Privacy Policy — ShopKite')
@section('meta_description', 'ShopKite Privacy Policy. Understand how we collect, use, and protect your personal data when using the ShopKite Merchant app and website.')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/agent.css') }}?v={{ filemtime(public_path('css/agent.css')) }}">
@endsection

@section('content')
<!-- Main Content Area -->
<main class="agent-content-area">
    
    <!-- Generic Banner -->
    <div class="generic-banner" style="margin-bottom: 40px;">
        <div class="generic-banner-text">
            <span>Privacy</span>
            <span class="generic-banner-text-bold">Policy</span>
        </div>
        <img src="{{ asset('img/generic-banner@2x.png') }}" alt="ShopKite Privacy Policy Banner">
    </div>

    <!-- Intro Writeup -->
    <div class="agent-writeup">
        <p class="agent-hero-subtitle">At ShopKite, we value your privacy and are committed to protecting your personal data. This privacy policy outlines what information we collect, how we use it, how we safeguard your data, and your rights as a user of our website and mobile application.</p>
    </div>

    <!-- Quick Table of Contents -->
    <div class="handbook-toc-card">
        <div class="handbook-toc-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg>
            Table of Contents
        </div>
        <div class="handbook-toc-grid">
            <a href="#collect" class="handbook-toc-pill">Information We Collect</a>
            <a href="#use" class="handbook-toc-pill">How We Use Information</a>
            <a href="#security" class="handbook-toc-pill">Data Security</a>
            <a href="#cookies" class="handbook-toc-pill">Cookies Policy</a>
            <a href="#location" class="handbook-toc-pill">Location Data</a>
            <a href="#disclosure" class="handbook-toc-pill">Third-Party Disclosure</a>
            <a href="#coppa" class="handbook-toc-pill">COPPA Compliance</a>
            <a href="#refund" class="handbook-toc-pill">Consent &amp; Refunds</a>
        </div>
    </div>

    <!-- Section 1: What Information Do We Collect? -->
    <section id="collect" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <h2 class="handbook-section-title">What Information Do We Collect?</h2>
        </div>
        <ul class="handbook-list">
            <li><strong>Registration Details:</strong> We collect information from you when you register on our website or mobile app, update product lists, or make a sale.</li>
            <li><strong>Personal &amp; Store Identifiers:</strong> When registering, you may be asked to enter your name, store name, email address (optional), store address, and phone number.</li>
            <li><strong>GPS &amp; Location Data:</strong> We collect GPS coordinates (if you opt-in) to help nearby customers locate your store on the map easily.</li>
            <li><strong>Anonymous Browsing:</strong> You may visit our public website anonymously without registering.</li>
        </ul>
    </section>

    <!-- Section 2: What Do We Use Your Information For? -->
    <section id="use" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
            </div>
            <h2 class="handbook-section-title">What Do We Use Your Information For?</h2>
        </div>
        <ul class="handbook-list">
            <li><strong>Personalize Experience:</strong> Your information helps us better respond to your individual store management needs.</li>
            <li><strong>Improve App &amp; Website:</strong> We continually strive to enhance our app and website offerings based on feedback received from you.</li>
            <li><strong>Customer Support:</strong> Enables our support team to respond effectively to customer service requests and assistance needs.</li>
            <li><strong>Process Transactions:</strong> Delivered explicitly for fulfilling requested products or services. Your private data will never be sold, exchanged, or transferred to third parties without your consent.</li>
            <li><strong>Promotions &amp; Surveys:</strong> Administer surveys, contests, promotions, or app feature updates.</li>
            <li><strong>Periodic Email Updates:</strong> Used exclusively to send updates and communications pertaining to your store transactions and account activity.</li>
        </ul>
    </section>

    <!-- Section 3: Data Security -->
    <section id="security" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
            <h2 class="handbook-section-title">How Do We Protect Your Information?</h2>
        </div>
        <ul class="handbook-list">
            <li><strong>Security Protocols:</strong> We implement a variety of industry-standard security measures to maintain the safety of your personal information when making sales, updating inventory, or accessing store records.</li>
            <li><strong>No Storage of Financial Details:</strong> In the event of online payment transactions, sensitive financial information (credit cards, bank details, credentials) is processed via secure encrypted gateways and is <strong>never stored on our servers</strong>.</li>
        </ul>
    </section>

    <!-- Section 4: Cookies Policy -->
    <section id="cookies" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/></svg>
            </div>
            <h2 class="handbook-section-title">Do We Use Cookies?</h2>
        </div>
        <ul class="handbook-list">
            <li><strong>Browser Cookies:</strong> Yes. Cookies are small files transferred to your computer's hard drive via your browser (if allowed) to enable systems to recognize your session and capture preference information.</li>
            <li><strong>Cart &amp; Session Management:</strong> We use cookies to remember items in your shopping cart, maintain session states, and understand aggregate site traffic patterns.</li>
        </ul>
    </section>

    <!-- Section 5: Location Data -->
    <section id="location" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <h2 class="handbook-section-title">Location Data Usage</h2>
        </div>
        <ul class="handbook-list">
            <li><strong>Bluetooth Hardware Pairing:</strong> We request location access on the <a href="https://play.google.com/store/apps/details?id=com.shopkite.merchant" target="_blank" rel="noopener noreferrer">ShopKite Merchant</a> mobile app specifically to enable communication with nearby Bluetooth hardware devices (especially thermal receipt printers).</li>
        </ul>
    </section>

    <!-- Section 6: Disclosure to Outside Parties -->
    <section id="disclosure" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <h2 class="handbook-section-title">Disclosure of Information to Outside Parties</h2>
        </div>
        <ul class="handbook-list">
            <li><strong>No Sale of Personal Data:</strong> We do not sell, trade, or transfer your personally identifiable information to outside parties.</li>
            <li><strong>Trusted Service Providers:</strong> Excludes trusted third parties who assist us in operating our application or servicing you, so long as those parties agree to keep this information strictly confidential.</li>
            <li><strong>Legal Compliance:</strong> We may release information when necessary to comply with applicable laws, enforce site policies, or protect rights, property, or safety.</li>
        </ul>
    </section>

    <!-- Section 7: COPPA & Scope -->
    <section id="coppa" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            </div>
            <h2 class="handbook-section-title">Children's Privacy (COPPA) &amp; Scope</h2>
        </div>
        <ul class="handbook-list">
            <li><strong>COPPA Compliance:</strong> We comply with the Children's Online Privacy Protection Act. We do not collect information from anyone under 13 years of age. Our products and services are directed to individuals who are at least 13 years old or older.</li>
            <li><strong>Online Policy Scope:</strong> This online privacy policy applies strictly to information collected through our website and mobile application.</li>
        </ul>
    </section>

    <!-- Section 8: Your Consent & Refund Policy -->
    <section id="refund" class="handbook-section">
        <div class="handbook-section-header">
            <div class="handbook-section-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
            </div>
            <h2 class="handbook-section-title">Your Consent &amp; Refund Policy</h2>
        </div>
        <ul class="handbook-list">
            <li><strong>Your Consent:</strong> By using our website or mobile application, you consent to our privacy policy. Any policy updates will be posted on this page.</li>
            <li><strong>Transaction &amp; Refund Disclaimer:</strong> ShopKite dissociates itself from direct buyer-seller disputes or merchant inability to deliver goods requested between third-party customers and store owners. ShopKite is not directly involved in merchant-to-customer retail transactions.</li>
        </ul>
    </section>

    <!-- CTA Box -->
    <div class="agent-cta-box">
        <h2>Have Questions About Our Privacy Practices?</h2>
        <p>Our dedicated support team is available to assist with any questions regarding your data privacy or account settings.</p>
        <div class="agent-btn-group">
            <a href="#" onclick="openPopupSupport(); return false;" class="agent-btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Contact Support
            </a>
            <a href="{{ route('home') }}" class="agent-btn-secondary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Back to Home
            </a>
        </div>
    </div>

</main>
@endsection
