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

                <form id="checkoutForm" method="post" action="https://shopkite.com.ng/pay/checkout" novalidate>
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

    function onStateChange(stateEl) {
        const citySelect = document.getElementById('city');
        const areaSelect = document.getElementById('area');
        citySelect.innerHTML = '<option value="">— Loading… —</option>';
        areaSelect.innerHTML = '<option value="">— Select Area —</option>';

        const stateId = stateEl.value;
        if (!stateId) { citySelect.innerHTML = '<option value="">— Select City —</option>'; return; }

        fetch(`https://shopkite.com.ng/api/locations/cities?state_id=${stateId}`)
            .then(r => r.json())
            .then(data => {
                citySelect.innerHTML = '<option value="">— Select City —</option>';
                (data.cities || data || []).forEach(c => {
                    const opt = document.createElement('option');
                    opt.value = c.id || c.value;
                    opt.textContent = c.name || c.label;
                    citySelect.appendChild(opt);
                });
                citySelect.onchange = () => onCityChange(citySelect);
            })
            .catch(() => {
                citySelect.innerHTML = '<option value="">City unavailable offline</option>';
            });
    }

    function onCityChange(cityEl) {
        const areaSelect = document.getElementById('area');
        areaSelect.innerHTML = '<option value="">— Loading… —</option>';
        const cityId = cityEl.value;
        if (!cityId) { areaSelect.innerHTML = '<option value="">— Select Area —</option>'; return; }

        fetch(`https://shopkite.com.ng/api/locations/areas?city_id=${cityId}`)
            .then(r => r.json())
            .then(data => {
                areaSelect.innerHTML = '<option value="">— Select Area —</option>';
                (data.areas || data || []).forEach(a => {
                    const opt = document.createElement('option');
                    opt.value = a.id || a.value;
                    opt.textContent = a.name || a.label;
                    areaSelect.appendChild(opt);
                });
            })
            .catch(() => {
                areaSelect.innerHTML = '<option value="">Area unavailable offline</option>';
            });
    }

    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        if (cartData.length === 0) {
            e.preventDefault();
            alert('Your cart is empty. Please go back to the store and add items before checking out.');
            return;
        }
    });
</script>
@endpush
