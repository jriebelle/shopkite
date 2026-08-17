<!-- Top Navigation Bar -->
<div class="top-nav">
    <div class="logo">
        <a href="{{ route('home') }}"><img src="{{ asset('img/shopkite-logo.png') }}" alt="ShopKite Logo"></a>
    </div>
    <div class="top-nav-right">
        <div class="top-nav-info">
            <div class="gradient-edge"></div>
            <div class="sub-text">
                <p>Subscribe to ShopKite Merchant at &#8358;5,000/month &amp; buy Stella (Inventory Management Device) for &#8358;360,000 or Ken for &#8358;450,000</p>
            </div>
            <a href="{{ route('store') }}" class="go-to-store">
                <div class="text">
                    <p>Visit our store</p>
                </div>
                <div class="arrow">
                    <img src="{{ asset('img/go-to-store-arrow.png') }}" alt="">
                </div>
            </a>
        </div>
        <div class="menu-btn-wrap">
            <button class="menu-btn" id="menu-btn" aria-label="Open menu">
                <svg width="20" height="10" viewBox="0 0 20 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect class="line-1" y="1" width="20" height="2" rx="1" fill="white"/>
                    <rect class="line-2" y="7" width="20" height="2" rx="1" fill="white"/>
                </svg>
                <span class="menu-btn-text">Menu</span>
            </button>
            <nav class="nav-dropdown" id="nav-dropdown" aria-hidden="true">
                <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'nav-active' : '' }}" data-text="Home"><span>Home</span></a>
                <a href="{{ route('store') }}" class="nav-item {{ request()->routeIs('store', 'store.*') ? 'nav-active' : '' }}" data-text="Visit our store"><span>Visit our store</span></a>
                <a href="{{ route('faq') }}" class="nav-item {{ request()->routeIs('faq') ? 'nav-active' : '' }}" data-text="FAQs"><span>FAQs</span></a>
                <a href="#" class="nav-item" data-text="Contact Us" onclick="openPopupSupport(); return false;"><span>Get help from a human</span></a>
                <a href="{{ route('ibr') }}" class="nav-item {{ request()->routeIs('ibr') ? 'nav-active' : '' }}" data-text="IBR"><span>Intelligent Business Report</span><span class="nav-item-pill">new</span></a>
                <a href="{{ route('invoice') }}" class="nav-item {{ request()->routeIs('invoice') ? 'nav-active' : '' }}" data-text="Invoice Generator"><span>Free Invoice Generator</span><span class="nav-item-pill">new</span></a>
                <a href="{{ route('devices') }}" class="nav-item {{ request()->routeIs('devices') ? 'nav-active' : '' }}" data-text="Devices"><span>Recommended Devices</span></a>
                <a href="{{ route('agent') }}" class="nav-item {{ request()->routeIs('agent', 'handbook') ? 'nav-active' : '' }}" data-text="Agent Signup"><span>Become an Agent</span></a>
                <a href="#" class="nav-item" data-text="Blog"><span>Blog</span></a>
                <a href="{{ route('privacy') }}" class="nav-item {{ request()->routeIs('privacy') ? 'nav-active' : '' }}" data-text="Privacy Policy"><span>Privacy Policy</span></a>
            </nav>
        </div>
    </div>
</div>
