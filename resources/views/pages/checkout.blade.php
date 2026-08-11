@extends('layouts.checkout')

@section('title', 'Checkout — ShopKite Store')
@section('meta_description', 'Complete your ShopKite order. Enter your delivery details and proceed to secure payment.')

@section('content')
<main class="checkout-area">

    <!-- Back button -->
    <div class="checkout-breadcrumb">
        <a href="{{ route('store') }}" class="checkout-back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            Back to store
        </a>
    </div>

    <div class="checkout-layout">

        <!-- LEFT: Order Summary -->
        <div class="checkout-summary-col">
            <div class="checkout-card">
                <h2 class="checkout-card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    Your Order
                </h2>
                <div id="checkoutOrderItems" class="checkout-order-list">
                    <!-- Dynamically populated from sessionStorage -->
                    <div class="checkout-empty-cart">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        <p>Your cart is empty. <a href="{{ route('store') }}">Go back to store</a></p>
                    </div>
                </div>
                <div class="checkout-totals" id="checkoutTotals" style="display:none;">
                    <div class="checkout-total-row">
                        <span>Subtotal</span>
                        <span id="checkoutSubtotal">&#8358;0</span>
                    </div>
                    <div class="checkout-total-row checkout-total-grand">
                        <span>Total</span>
                        <span id="checkoutGrand">&#8358;0</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT: Delivery Details Form -->
        <div class="checkout-form-col">
            <div class="checkout-card">
                <h2 class="checkout-card-title">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12S4 16 4 10a8 8 0 1 1 16 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Delivery Details
                </h2>

                <form id="checkoutForm" method="post" action="{{ route('order.success') }}" novalidate>
                    @csrf
                    <input id="product-list-values" type="hidden" value="" name="product-list-values">
                    <input id="product-quantity-values" type="hidden" value="" name="product-quantity-values">
                    <input id="product-price-values" type="hidden" value="" name="product-price-values">
                    <input id="total-cost" type="hidden" value="0" name="total">
                    <input type="hidden" name="checkout-products" value="true">

                    <div class="form-row-grid">
                        <div class="checkout-form-row">
                            <label for="customer-first-name">First name <span class="req">*</span></label>
                            <input required id="customer-first-name" type="text" name="customer-first-name" placeholder="e.g. Amara" autocomplete="given-name">
                        </div>
                        <div class="checkout-form-row">
                            <label for="customer-last-name">Surname <span class="req">*</span></label>
                            <input required id="customer-last-name" type="text" name="customer-last-name" placeholder="e.g. Okafor" autocomplete="family-name">
                        </div>
                    </div>

                    <div class="form-row-grid">
                        <div class="checkout-form-row">
                            <label for="customer-mobile">Mobile number <span class="req">*</span></label>
                            <input required id="customer-mobile" type="tel" name="customer-mobile" placeholder="08012345678" minlength="11" maxlength="11" autocomplete="tel">
                        </div>
                        <div class="checkout-form-row">
                            <label for="customer-email">Email address</label>
                            <input id="customer-email" type="email" name="customer-email" placeholder="you@example.com" autocomplete="email">
                        </div>
                    </div>

                    <div class="form-row-grid">
                        <div class="checkout-form-row">
                            <label for="state">State <span class="req">*</span></label>
                            <div class="select-wrap">
                                <select id="state" required name="state" onchange="onStateChange(this)">
                                    <option value="">— Select State —</option>
                                    <option value="1">Abia</option>
                                    <option value="2">Adamawa</option>
                                    <option value="3">Akwa Ibom</option>
                                    <option value="4">Anambra</option>
                                    <option value="5">Bauchi</option>
                                    <option value="6">Bayelsa</option>
                                    <option value="7">Benue</option>
                                    <option value="8">Bornu</option>
                                    <option value="9">Cross River</option>
                                    <option value="10">Delta</option>
                                    <option value="11">Ebonyi</option>
                                    <option value="12">Edo</option>
                                    <option value="13">Ekiti</option>
                                    <option value="14">Enugu</option>
                                    <option value="15">FCT Abuja</option>
                                    <option value="16">Gombe</option>
                                    <option value="17">Imo</option>
                                    <option value="18">Jigawa</option>
                                    <option value="19">Kaduna</option>
                                    <option value="20">Kano</option>
                                    <option value="21">Katsina</option>
                                    <option value="22">Kebbi</option>
                                    <option value="23">Kogi</option>
                                    <option value="24">Kwara</option>
                                    <option value="25">Lagos</option>
                                    <option value="26">Nasarawa</option>
                                    <option value="27">Niger</option>
                                    <option value="28">Ogun</option>
                                    <option value="29">Ondo</option>
                                    <option value="30">Osun</option>
                                    <option value="31">Oyo</option>
                                    <option value="32">Plateau</option>
                                    <option value="33">Rivers</option>
                                    <option value="34">Sokoto</option>
                                    <option value="35">Taraba</option>
                                    <option value="36">Yobe</option>
                                    <option value="37">Zamfara</option>
                                </select>
                                <svg class="select-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                            </div>
                        </div>
                        <div class="checkout-form-row">
                            <label for="city">City <span class="req">*</span></label>
                            <div class="select-wrap">
                                <select id="city" required name="city">
                                    <option value="">— Select City —</option>
                                </select>
                                <svg class="select-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-form-row">
                        <label for="area">Area <span class="req">*</span></label>
                        <div class="select-wrap">
                            <select id="area" required name="area">
                                <option value="">— Select Area —</option>
                            </select>
                            <svg class="select-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                        </div>
                    </div>

                    <div class="checkout-form-row" id="estate-holder" style="display:none;">
                        <label for="estates">Estate <small>(Optional)</small></label>
                        <div class="select-wrap">
                            <select name="estates" id="estates">
                                <option value="0">— Select estate if applicable —</option>
                            </select>
                            <svg class="select-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                        </div>
                    </div>

                    <div class="checkout-form-row">
                        <label for="customer-address">Street Address <span class="req">*</span>
                            <small>House number and street name only</small>
                        </label>
                        <input required id="customer-address" type="text" name="customer-address" placeholder="e.g. 14 Allen Avenue" autocomplete="street-address">
                    </div>

                    <div class="checkout-form-row">
                        <label for="promocode">Promo code <small>(Optional)</small></label>
                        <input id="promocode" type="text" name="promocode" placeholder="Enter code if you have one">
                    </div>

                    <div class="checkout-submit-row">
                        <button type="submit" class="btn-checkout" id="checkoutSubmitBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            Proceed to payment
                        </button>
                    </div>

                    <p class="checkout-secure-note">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Your information is encrypted and secure.
                    </p>
                </form>
            </div>
        </div>

    </div>

</main>

<!-- ── Order Confirmation Popup ── -->
<div class="overlay" id="popupOverlayConfirm" onclick="if(event.target === this) closePopupConfirm()">
    <div class="popup popup--confirm" id="confirmPopup">
        <button class="close-btn" onclick="closePopupConfirm()" aria-label="Close">close</button>

        <div class="popup-body">
            <div class="popup-confirm-icon">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
            </div>
            <h1>Confirm your order</h1>
            <p class="popup-confirm-sub">Please review your items and delivery details before proceeding to payment.</p>

            <!-- Order Items -->
            <div class="popup-confirm-section">
                <span class="popup-confirm-label">Your items</span>
                <div class="popup-confirm-items" id="confirmPopupItems"><!-- JS populated --></div>
                <div class="popup-confirm-total" id="confirmPopupTotal"><!-- JS populated --></div>
            </div>

            <!-- Delivery Details -->
            <div class="popup-confirm-section">
                <span class="popup-confirm-label">Delivery details</span>
                <div class="popup-confirm-details" id="confirmPopupDetails"><!-- JS populated --></div>
            </div>

            <button class="popup-confirm-pay-btn" id="confirmPayBtn" onclick="confirmAndPay()">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                Proceed to Payment
            </button>

            <p class="checkout-secure-note" style="justify-content:center;margin-top:10px;">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                Your information is encrypted and secure.
            </p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function formatNaira(amount) {
        return '&#8358;' + Number(amount).toLocaleString('en-US');
    }

    const cartData = (() => {
        try { return JSON.parse(sessionStorage.getItem('shopkite_cart') || '[]'); }
        catch(e) { return []; }
    })();

    const orderList  = document.getElementById('checkoutOrderItems');
    const totalsEl   = document.getElementById('checkoutTotals');
    const subtotalEl = document.getElementById('checkoutSubtotal');
    const grandEl    = document.getElementById('checkoutGrand');

    const fieldProductList  = document.getElementById('product-list-values');
    const fieldQtyValues    = document.getElementById('product-quantity-values');
    const fieldPriceValues  = document.getElementById('product-price-values');
    const fieldTotal        = document.getElementById('total-cost');

    function renderOrderList() {
        if (cartData.length === 0) {
            orderList.innerHTML = `
                <div class="checkout-empty-cart">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    <p>Your cart is empty. <a href="{{ route('store') }}">Go back to store</a></p>
                </div>`;
            totalsEl.style.display = 'none';
            return;
        }

        let html = '';
        let subtotal = 0;
        const names = [], qtys = [], prices = [];

        cartData.forEach((item, idx) => {
            const lineTotal = item.price * item.qty;
            subtotal += lineTotal;
            names.push(item.name);
            qtys.push(item.qty);
            prices.push(item.price * 100);

            html += `
                <div class="checkout-order-item" data-idx="${idx}">
                    <img src="${item.img}" alt="${item.name}" class="checkout-order-img"
                         onerror="this.src='{{ asset("img/shopkite-logo.png") }}'">
                    <div class="checkout-order-info">
                        <div class="checkout-order-name">${item.name}</div>
                        <div class="checkout-order-meta">Qty: ${item.qty}</div>
                    </div>
                    <div class="checkout-order-price">${formatNaira(lineTotal)}</div>
                    <button type="button" class="checkout-remove-btn" onclick="removeCartItem(${idx})" aria-label="Remove item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                    </button>
                </div>
            `;
        });

        orderList.innerHTML = html;
        totalsEl.style.display = 'block';
        subtotalEl.innerHTML = formatNaira(subtotal);
        grandEl.innerHTML = formatNaira(subtotal);

        if (fieldProductList)  fieldProductList.value  = names.join(',');
        if (fieldQtyValues)    fieldQtyValues.value    = qtys.join(',');
        if (fieldPriceValues)  fieldPriceValues.value  = prices.join(',');
        if (fieldTotal)        fieldTotal.value        = subtotal * 100;
    }

    function removeCartItem(idx) {
        cartData.splice(idx, 1);
        sessionStorage.setItem('shopkite_cart', JSON.stringify(cartData));
        renderOrderList();
    }

    renderOrderList();

    // ── Nigerian location data (static) ─────────────────────────────────
    const locationData = {
        // Abia
        1: { cities: { 1: { name: 'Aba', areas: ['Ariaria', 'Aba South', 'Ogbor Hill', 'Aba North', 'Osisioma'] },
                       2: { name: 'Umuahia', areas: ['Umuahia North', 'Umuahia South', 'Ikwuano'] },
                       3: { name: 'Ohafia', areas: ['Ohafia North', 'Ohafia South'] } } },
        // Adamawa
        2: { cities: { 4: { name: 'Yola', areas: ['Jimeta', 'Yola North', 'Yola South'] },
                       5: { name: 'Mubi', areas: ['Mubi North', 'Mubi South'] } } },
        // Akwa Ibom
        3: { cities: { 6: { name: 'Uyo', areas: ['Uyo', 'Eket', 'Ikot Ekpene', 'Abak', 'Oron'] },
                       7: { name: 'Ikot Ekpene', areas: ['Ikot Ekpene', 'Essien Udim'] } } },
        // Anambra
        4: { cities: { 8:  { name: 'Awka', areas: ['Awka South', 'Awka North', 'Njikoka'] },
                       9:  { name: 'Onitsha', areas: ['Onitsha North', 'Onitsha South', 'Ogbaru'] },
                       10: { name: 'Nnewi', areas: ['Nnewi North', 'Nnewi South', 'Ekwusigo'] } } },
        // Bauchi
        5: { cities: { 11: { name: 'Bauchi', areas: ['Bauchi', 'Dass', 'Tafawa Balewa'] },
                       12: { name: 'Azare', areas: ['Azare', 'Katagum'] } } },
        // Bayelsa
        6: { cities: { 13: { name: 'Yenagoa', areas: ['Yenagoa', 'Kolokuma', 'Brass'] },
                       14: { name: 'Ogbia', areas: ['Ogbia', 'Nembe'] } } },
        // Benue
        7: { cities: { 15: { name: 'Makurdi', areas: ['Makurdi', 'Guma', 'Logo'] },
                       16: { name: 'Gboko', areas: ['Gboko', 'Tiv'] } } },
        // Bornu
        8: { cities: { 17: { name: 'Maiduguri', areas: ['Maiduguri', 'Gwoza', 'Bama'] },
                       18: { name: 'Biu', areas: ['Biu', 'Hawul'] } } },
        // Cross River
        9: { cities: { 19: { name: 'Calabar', areas: ['Calabar Municipal', 'Calabar South', 'Akpabuyo'] },
                       20: { name: 'Ogoja', areas: ['Ogoja', 'Bekwarra'] } } },
        // Delta
        10: { cities: { 21: { name: 'Asaba', areas: ['Asaba', 'Oshimili South', 'Oshimili North'] },
                        22: { name: 'Warri', areas: ['Warri North', 'Warri South', 'Uvwie'] },
                        23: { name: 'Sapele', areas: ['Sapele', 'Okpe'] } } },
        // Ebonyi
        11: { cities: { 24: { name: 'Abakaliki', areas: ['Abakaliki', 'Ishielu', 'Izzi'] },
                        25: { name: 'Afikpo', areas: ['Afikpo North', 'Afikpo South'] } } },
        // Edo
        12: { cities: { 26: { name: 'Benin City', areas: ['Oredo', 'Egor', 'Ikpoba-Okha', 'Ovia North-East', 'Orhionmwon'] },
                        27: { name: 'Auchi', areas: ['Etsako West', 'Etsako East'] },
                        28: { name: 'Ekpoma', areas: ['Esan West', 'Esan Central'] } } },
        // Ekiti
        13: { cities: { 29: { name: 'Ado-Ekiti', areas: ['Ado-Ekiti', 'Irepodun/Ifelodun', 'Ekiti West'] },
                        30: { name: 'Ikere', areas: ['Ikere', 'Oye'] } } },
        // Enugu
        14: { cities: { 31: { name: 'Enugu', areas: ['Enugu North', 'Enugu South', 'Igbo-Eze North', 'Nkanu East'] },
                        32: { name: 'Nsukka', areas: ['Nsukka', 'Igbo-Eze South'] },
                        33: { name: 'Agbani', areas: ['Agbani', 'Nkanu West'] } } },
        // FCT Abuja
        15: { cities: { 34: { name: 'Abuja Central', areas: ['Wuse', 'Wuse 2', 'Garki', 'Maitama', 'Asokoro', 'Central Area'] },
                        35: { name: 'Gwarinpa / Kubwa', areas: ['Gwarinpa', 'Kubwa', 'Dutse-Alhaji', 'Idu', 'Karu'] },
                        36: { name: 'Jabi / Airport Road', areas: ['Jabi', 'Utako', 'Airport Road', 'Lugbe', 'Gudu'] },
                        37: { name: 'Bwari', areas: ['Bwari', 'Dutse', 'Ushafa'] },
                        38: { name: 'Gwagwalada', areas: ['Gwagwalada', 'Dobi', 'Paikon-Kore'] } } },
        // Gombe
        16: { cities: { 39: { name: 'Gombe', areas: ['Gombe', 'Billiri', 'Kaltungo'] } } },
        // Imo
        17: { cities: { 40: { name: 'Owerri', areas: ['Owerri Municipal', 'Owerri North', 'Owerri West', 'Ngor Okpala'] },
                        41: { name: 'Orlu', areas: ['Orlu', 'Oru East', 'Oru West'] },
                        42: { name: 'Okigwe', areas: ['Okigwe', 'Ihitte/Uboma'] } } },
        // Jigawa
        18: { cities: { 43: { name: 'Dutse', areas: ['Dutse', 'Birnin Kudu'] },
                        44: { name: 'Hadejia', areas: ['Hadejia', 'Kafin Hausa'] } } },
        // Kaduna
        19: { cities: { 45: { name: 'Kaduna', areas: ['Kaduna North', 'Kaduna South', 'Chikun', 'Igabi'] },
                        46: { name: 'Zaria', areas: ['Zaria', 'Sabon Gari', 'Giwa'] } } },
        // Kano
        20: { cities: { 47: { name: 'Kano City', areas: ['Fagge', 'Dala', 'Gwale', 'Kano Municipal', 'Nassarawa'] },
                        48: { name: 'Wudil', areas: ['Wudil', 'Garko'] } } },
        // Katsina
        21: { cities: { 49: { name: 'Katsina', areas: ['Katsina', 'Daura', 'Funtua'] },
                        50: { name: 'Daura', areas: ['Daura', 'Zanfara'] } } },
        // Kebbi
        22: { cities: { 51: { name: 'Birnin Kebbi', areas: ['Birnin Kebbi', 'Argungu', 'Koko/Besse'] } } },
        // Kogi
        23: { cities: { 52: { name: 'Lokoja', areas: ['Lokoja', 'Kogi', 'Ajaokuta'] },
                        53: { name: 'Okene', areas: ['Okene', 'Okehi'] } } },
        // Kwara
        24: { cities: { 54: { name: 'Ilorin', areas: ['Ilorin East', 'Ilorin South', 'Ilorin West', 'Asa'] },
                        55: { name: 'Offa', areas: ['Offa', 'Oyun'] } } },
        // Lagos
        25: { cities: { 56: { name: 'Lagos Island / VI', areas: ['Lagos Island', 'Victoria Island', 'Ikoyi', 'Obalende', 'Eti-Osa'] },
                        57: { name: 'Lagos Mainland', areas: ['Surulere', 'Yaba', 'Mushin', 'Oshodi', 'Isolo', 'Shomolu'] },
                        58: { name: 'Ikeja', areas: ['Ikeja', 'Maryland', 'Ojodu', 'Agege', 'Ifako-Ijaiye'] },
                        59: { name: 'Lekki / Ajah', areas: ['Lekki Phase 1', 'Lekki Phase 2', 'Ajah', 'Chevron', 'Sangotedo', 'Ibeju-Lekki'] },
                        60: { name: 'Alimosho', areas: ['Egbeda', 'Ipaja', 'Dopemu', 'Idimu', 'Alimosho'] },
                        61: { name: 'Badagry / Ikorodu', areas: ['Badagry', 'Ikorodu', 'Epe'] } } },
        // Nasarawa
        26: { cities: { 62: { name: 'Lafia', areas: ['Lafia', 'Obi', 'Nasarawa Eggon'] },
                        63: { name: 'Keffi', areas: ['Keffi', 'Kokona'] } } },
        // Niger
        27: { cities: { 64: { name: 'Minna', areas: ['Minna', 'Bosso', 'Chanchaga'] },
                        65: { name: 'Suleja', areas: ['Suleja', 'Tafa'] } } },
        // Ogun
        28: { cities: { 66: { name: 'Abeokuta', areas: ['Abeokuta North', 'Abeokuta South', 'Obafemi-Owode'] },
                        67: { name: 'Sagamu', areas: ['Sagamu', 'Remo North'] },
                        68: { name: 'Ijebu-Ode', areas: ['Ijebu-Ode', 'Ijebu North'] },
                        69: { name: 'Ota', areas: ['Ado-Odo/Ota', 'Sango-Ota'] } } },
        // Ondo
        29: { cities: { 70: { name: 'Akure', areas: ['Akure North', 'Akure South', 'Idanre'] },
                        71: { name: 'Ondo', areas: ['Ondo West', 'Ondo East'] } } },
        // Osun
        30: { cities: { 72: { name: 'Osogbo', areas: ['Osogbo', 'Olorunda', 'Atakunmosa'] },
                        73: { name: 'Ile-Ife', areas: ['Ile-Ife', 'Ife East', 'Ife North'] } } },
        // Oyo
        31: { cities: { 74: { name: 'Ibadan', areas: ['Ibadan North', 'Ibadan South-West', 'Ibadan South-East', 'Akinyele', 'Lagelu', 'Oluyole'] },
                        75: { name: 'Ogbomosho', areas: ['Ogbomosho North', 'Ogbomosho South'] },
                        76: { name: 'Oyo', areas: ['Oyo East', 'Oyo West'] } } },
        // Plateau
        32: { cities: { 77: { name: 'Jos', areas: ['Jos North', 'Jos South', 'Bassa', 'Riyom'] },
                        78: { name: 'Shendam', areas: ['Shendam', 'Wase'] } } },
        // Rivers
        33: { cities: { 79: { name: 'Port Harcourt', areas: ['Port Harcourt City', 'Obio-Akpor', 'Eleme', 'Ikwerre', 'Etche'] },
                        80: { name: 'Obio-Akpor', areas: ['Rumuola', 'Rumuokoro', 'Rumuodara', 'Woji'] },
                        81: { name: 'Bonny', areas: ['Bonny', 'Degema'] } } },
        // Sokoto
        34: { cities: { 82: { name: 'Sokoto', areas: ['Sokoto North', 'Sokoto South', 'Wamakko'] } } },
        // Taraba
        35: { cities: { 83: { name: 'Jalingo', areas: ['Jalingo', 'Yorro', 'Zing'] } } },
        // Yobe
        36: { cities: { 84: { name: 'Damaturu', areas: ['Damaturu', 'Potiskum', 'Nguru'] } } },
        // Zamfara
        37: { cities: { 85: { name: 'Gusau', areas: ['Gusau', 'Anka', 'Kaura Namoda'] } } },
    };

    function onStateChange(stateEl) {
        const citySelect = document.getElementById('city');
        const areaSelect = document.getElementById('area');
        areaSelect.innerHTML = '<option value="">— Select Area —</option>';
        citySelect.onchange = null;

        const stateId = parseInt(stateEl.value);
        if (!stateId || !locationData[stateId]) {
            citySelect.innerHTML = '<option value="">— Select City —</option>';
            return;
        }

        const cities = locationData[stateId].cities;
        citySelect.innerHTML = '<option value="">— Select City —</option>';
        Object.entries(cities).forEach(([id, city]) => {
            const opt = document.createElement('option');
            opt.value = id;
            opt.textContent = city.name;
            citySelect.appendChild(opt);
        });

        citySelect.onchange = () => onCityChange(citySelect);
    }

    function onCityChange(cityEl) {
        const areaSelect = document.getElementById('area');
        const stateId = parseInt(document.getElementById('state').value);
        const cityId = parseInt(cityEl.value);

        if (!cityId || !stateId || !locationData[stateId]?.cities[cityId]) {
            areaSelect.innerHTML = '<option value="">— Select Area —</option>';
            return;
        }

        const areas = locationData[stateId].cities[cityId].areas;
        areaSelect.innerHTML = '<option value="">— Select Area —</option>';
        areas.forEach((area, idx) => {
            const opt = document.createElement('option');
            opt.value = area;
            opt.textContent = area;
            areaSelect.appendChild(opt);
        });
    }


    // ── Confirmation popup helpers ──────────────────────────────────
    function openPopupConfirm() {
        const overlay = document.getElementById('popupOverlayConfirm');
        if (overlay) {
            overlay.style.display = 'flex';
            requestAnimationFrame(() => overlay.classList.add('active'));
            document.body.style.overflow = 'hidden';
        }
    }

    function closePopupConfirm() {
        const overlay = document.getElementById('popupOverlayConfirm');
        if (overlay) {
            overlay.classList.remove('active');
            setTimeout(() => {
                overlay.style.display = 'none';
                document.body.style.overflow = '';
            }, 250);
        }
    }

    function confirmAndPay() {
        const btn = document.getElementById('confirmPayBtn');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Redirecting…';
        }
        window.location.href = '{{ route("order.success") }}';
    }

    // ── Escape key closes confirm popup too ──────────────────────────
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closePopupConfirm();
    });

    // ── Inline validation helpers ──────────────────────────────────────
    function setError(fieldId, message) {
        const el = document.getElementById(fieldId);
        if (!el) return;
        el.classList.add('field-error');
        // Remove any existing error message
        const wrap = el.closest('.checkout-form-row') || el.closest('.select-wrap')?.parentElement;
        if (wrap) {
            const existing = wrap.querySelector('.field-error-msg');
            if (existing) existing.remove();
            const msg = document.createElement('span');
            msg.className = 'field-error-msg';
            msg.textContent = message;
            // Insert after the input or the select-wrap div
            const insertAfter = wrap.querySelector('.select-wrap') || el;
            insertAfter.after(msg);
        }
    }

    function clearError(fieldId) {
        const el = document.getElementById(fieldId);
        if (!el) return;
        el.classList.remove('field-error');
        const wrap = el.closest('.checkout-form-row') || el.closest('.select-wrap')?.parentElement;
        if (wrap) {
            const msg = wrap.querySelector('.field-error-msg');
            if (msg) msg.remove();
        }
    }

    function clearErrorOnInput(fieldId, eventType = 'input') {
        const el = document.getElementById(fieldId);
        if (el) el.addEventListener(eventType, () => clearError(fieldId));
    }

    // Attach live clear-on-input listeners to all validated fields
    ['customer-first-name', 'customer-last-name', 'customer-address'].forEach(id => clearErrorOnInput(id));
    ['customer-mobile'].forEach(id => clearErrorOnInput(id));
    ['state', 'city', 'area'].forEach(id => clearErrorOnInput(id, 'change'));

    function validateCheckoutForm() {
        let firstErrorId = null;
        let valid = true;

        const requireText = (id, label) => {
            const el = document.getElementById(id);
            if (!el || !el.value.trim()) {
                setError(id, `${label} is required.`);
                if (!firstErrorId) firstErrorId = id;
                valid = false;
            } else {
                clearError(id);
            }
        };

        const requireSelect = (id, label) => {
            const el = document.getElementById(id);
            if (!el || !el.value) {
                setError(id, `Please select a ${label}.`);
                if (!firstErrorId) firstErrorId = id;
                valid = false;
            } else {
                clearError(id);
            }
        };

        // First name
        requireText('customer-first-name', 'First name');
        // Last name
        requireText('customer-last-name', 'Surname');

        // Mobile — must be exactly 11 digits
        const mobileEl = document.getElementById('customer-mobile');
        if (!mobileEl || !mobileEl.value.trim()) {
            setError('customer-mobile', 'Mobile number is required.');
            if (!firstErrorId) firstErrorId = 'customer-mobile';
            valid = false;
        } else if (!/^0[0-9]{10}$/.test(mobileEl.value.trim())) {
            setError('customer-mobile', 'Enter a valid 11-digit Nigerian mobile number (e.g. 08012345678).');
            if (!firstErrorId) firstErrorId = 'customer-mobile';
            valid = false;
        } else {
            clearError('customer-mobile');
        }

        // Location
        requireSelect('state', 'state');
        requireSelect('city', 'city');
        requireSelect('area', 'area');

        // Street address
        requireText('customer-address', 'Street address');

        // Scroll to first error
        if (firstErrorId) {
            const el = document.getElementById(firstErrorId);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                el.focus({ preventScroll: true });
            }
        }

        return valid;
    }

    // ── Intercept form submit → validate → show confirm popup ───────────
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        e.preventDefault();

        if (cartData.length === 0) {
            alert('Your cart is empty. Please go back to the store and add items before checking out.');
            return;
        }

        if (!validateCheckoutForm()) return;

        // ── Populate items in popup ──
        const itemsEl = document.getElementById('confirmPopupItems');
        const totalEl = document.getElementById('confirmPopupTotal');
        let html = '';
        let subtotal = 0;
        cartData.forEach(item => {
            const lineTotal = item.price * item.qty;
            subtotal += lineTotal;
            html += `
                <div class="popup-confirm-item">
                    <img src="${item.img}" alt="${item.name}" class="popup-confirm-item-img"
                         onerror="this.src='{{ asset('img/shopkite-logo.png') }}'">
                    <div class="popup-confirm-item-info">
                        <span class="popup-confirm-item-name">${item.name}</span>
                        <span class="popup-confirm-item-meta">Qty: ${item.qty}</span>
                    </div>
                    <span class="popup-confirm-item-price">${formatNaira(lineTotal)}</span>
                </div>`;
        });
        itemsEl.innerHTML = html;
        totalEl.innerHTML = `<span>Total</span><span class="popup-confirm-grand">${formatNaira(subtotal)}</span>`;

        // ── Populate delivery details in popup ──
        const get = (id) => {
            const el = document.getElementById(id);
            if (!el) return '';
            if (el.tagName === 'SELECT') return el.options[el.selectedIndex]?.text || '';
            return el.value || '';
        };
        const firstName  = get('customer-first-name');
        const lastName   = get('customer-last-name');
        const mobile     = get('customer-mobile');
        const email      = get('customer-email');
        const state      = get('state');
        const city       = get('city');
        const area       = get('area');
        const address    = get('customer-address');
        const promo      = get('promocode');

        const rows = [
            ['Name',    `${firstName} ${lastName}`.trim()],
            ['Mobile',  mobile],
            ['Email',   email || '—'],
            ['State',   state],
            ['City',    city],
            ['Area',    area],
            ['Address', address],
            ['Promo',   promo || '—'],
        ];
        document.getElementById('confirmPopupDetails').innerHTML = rows.map(([label, val]) =>
            `<div class="popup-detail-row"><span class="popup-detail-key">${label}</span><span class="popup-detail-val">${val}</span></div>`
        ).join('');

        openPopupConfirm();
    });
</script>
@endpush
