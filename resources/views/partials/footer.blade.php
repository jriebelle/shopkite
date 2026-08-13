<!-- Main Footer -->
<footer class="main-footer">
    <div class="media-title">
        <h2>ShopKite in the news</h2>
    </div>
    <div class="media-brands">
        <div class="media-brands-track">
            <a href="#" target="_blank" rel="noopener noreferrer" class="media-brand-item"><img src="{{ asset('img/media-logos/channels.png') }}" alt="Channels TV"></a>
            <a href="#" target="_blank" rel="noopener noreferrer" class="media-brand-item"><img src="{{ asset('img/media-logos/lagos-talks.png') }}" alt="Lagos Talks"></a>
            <a href="#" target="_blank" rel="noopener noreferrer" class="media-brand-item"><img src="{{ asset('img/media-logos/mainland-fm.png') }}" alt="Mainland FM"></a>
            <a href="#" target="_blank" rel="noopener noreferrer" class="media-brand-item"><img src="{{ asset('img/media-logos/techcity.png') }}" alt="Tech City"></a>
            <a href="#" target="_blank" rel="noopener noreferrer" class="media-brand-item"><img src="{{ asset('img/media-logos/tvc.png') }}" alt="TVC News"></a>
        </div>
    </div>
    <div class="footer-container">
        <div class="footer-col logo-col">
            <a href="{{ route('home') }}"><img src="{{ asset('img/shopkite-logo.png') }}" alt="ShopKite Logo" class="footer-logo"></a>
        </div>
        <div class="footer-col links-col">
            <a href="{{ route('store') }}">Our Store</a>
            <a href="{{ route('stores.nigeria') }}">Online stores (ShopKite Market)</a>
            <a href="{{ route('ibr') }}">Business Report</a>
            <a href="{{ route('devices') }}">Recommended Devices</a>
            <a href="{{ route('agent') }}">Become an Agent</a>
            <a href="{{ route('privacy') }}">Privacy Policy</a>
        </div>
        <div class="footer-col links-col">
            <a href="{{ route('faq') }}">FAQs</a>
            <a href="#">Video Tutorial</a>
            <a href="#">Download for Android</a>
            <a href="#">Download for iOS</a>
            <a href="#">Blog</a>
            <a href="#" onclick="openPopupSupport(); return false;">Get help from a human</a>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-partners">
            <span class="partners-label">Official hardware distributors in Nigeria</span>
            <a href="https://www.sunmi.com/en/" target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('img/sunmi-logo.png') }}" alt="Sunmi Logo" class="sunmi-logo">
            </a>
        </div>
        <div class="footer-socials">
            <a href="https://wa.me/2349062000393" target="_blank" class="social-link"><img src="{{ asset('img/whatsapp-icon.png') }}" alt="WhatsApp"></a>
            <a href="https://instagram.com/shopkite" target="_blank" class="social-link"><img src="{{ asset('img/instagram-icon.png') }}" alt="Instagram"></a>
            <a href="https://facebook.com/shopkite" target="_blank" class="social-link"><img src="{{ asset('img/facebook-icon.png') }}" alt="Facebook"></a>
            <a href="https://twitter.com/shopkite" target="_blank" class="social-link"><img src="{{ asset('img/x-icon.png') }}" alt="X"></a>
            <a href="https://www.youtube.com/@shopkiteapp" target="_blank" class="social-link"><img src="{{ asset('img/youtube-icon.png') }}" alt="YouTube"></a>
            <a href="#" class="social-link"><img src="{{ asset('img/tiktok-icon.png') }}" alt="TikTok"></a>
        </div>
    </div>
    <div class="footer-copyright">
        <p>&copy; {{ date('Y') }} ShopKite Nigeria Limited. All rights reserved.</p>
    </div>
</footer>
