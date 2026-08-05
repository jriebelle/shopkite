<!-- Contact Support Popup -->
<div class="overlay" id="popupOverlaySupport" onclick="if(event.target === this) closePopupSupport()">
    <div class="popup">
        <button class="close-btn" onclick="closePopupSupport()" aria-label="Close">close</button>
        <img src="{{ asset('img/support-img.png') }}" alt="Support" class="popup-support-img">
        <div class="popup-body">
            <h1>We are happy to hear from you!</h1>
            <p>Need to setup a Store?<br> Need clarity on a feature? <br>or would you like to make a suggestion?<br>Reach us via email/WhatsApp or any of our social handles...</p>
            <div class="popup-socials">
                <a href="https://wa.me/2349062000393" target="_blank" rel="noopener noreferrer" class="social-link"><img src="{{ asset('img/whatsapp-icon.png') }}" alt="WhatsApp"></a>
                <a href="#" class="social-link"><img src="{{ asset('img/instagram-icon.png') }}" alt="Instagram"></a>
                <a href="#" class="social-link"><img src="{{ asset('img/facebook-icon.png') }}" alt="Facebook"></a>
                <a href="#" class="social-link"><img src="{{ asset('img/x-icon.png') }}" alt="X"></a>
                <a href="#" class="social-link"><img src="{{ asset('img/youtube-icon.png') }}" alt="YouTube"></a>
                <a href="#" class="social-link"><img src="{{ asset('img/tiktok-icon.png') }}" alt="TikTok"></a>
            </div>
            <div class="popup-email">
                <a href="mailto:hello@shopkite.com.ng">hello@shopkite.com.ng</a>
            </div>
            <h3><a href="tel:09062000393">09062000393</a></h3>
        </div>
    </div>
</div>
