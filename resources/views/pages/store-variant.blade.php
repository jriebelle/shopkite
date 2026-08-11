@extends('layouts.app')

@section('title', 'Our Store — ShopKite')
@section('meta_description', 'Browse and order recommended devices and ShopKite services directly.')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/store.css') }}?v={{ filemtime(public_path('css/store.css')) }}">
@endsection

@section('content')
<!-- Main Content Area -->
<main class="store-content-area">

    <!-- Store Header Variant (Display Picture + Intro Text) -->
    <div class="store-header-variant">
        <div class="store-dp-wrap">
            <img class="store-dp-img" src="{{ asset('img/shopkite-store-profile-pic.png') }}" alt="ShopKite Store Display Picture">
        </div>
        <div class="store-intro-variant">
            <h2 class="store-section-label">Store Name Comes Here</h2>
            <p>Browse and order recommended devices and/or ShopKite services directly.</p>
            <div class="store-tags-wrap">
                <span class="store-tag-label">Store location:</span>
                <span class="store-tag-pill">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Lagos, Ikeja
                </span>
            </div>
        </div>
    </div>

    <div class="store-checkout-note">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <p><strong>How to order:</strong><br> <strong>1.</strong> Add an item to your cart by clicking/tapping the plus sign <strong>+</strong> on the item thumbnail or the <strong>Add to cart</strong> button. <br><br><strong>2.</strong> Preview your shopping Cart by clicking/tapping on the <strong>Cart</strong> button next to the search bar. <br><br><strong>3.</strong> Click/Tap on <strong>Proceed to checkout</strong> where you'll input your delivery details. <br><br><strong>4.</strong> Finally, proceed to the payment page to make payment securely and complete your order. <br><br>Need help? <a href="#" onclick="openPopupSupport(); return false;">Contact our team.</a></p>
    </div>
    <!-- Toolbar Bar: Search + Cart -->
    <div class="store-toolbar-bar">
        <div class="store-search-wrap">
            <div class="store-search-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
            <input type="text" id="storeSearchInput" class="store-search-input" placeholder="Search products or services...">
        </div>
        <div class="store-cart-btn-wrap">
            <button type="button" class="store-cart-btn" id="openCartBtn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                <span>Cart</span>
                <span class="cart-badge" id="cartBadge">0</span>
            </button>
        </div>
    </div>

    <div class="product-grid" id="productGrid">

        <!-- Ken Desktop Device -->
        <div class="product-card" data-id="ken" data-name="Ken Desktop Device + Barcode Scanner" data-price="630000" data-stock="10" data-img="{{ asset('img/our-store/ken-desktop-device.jpg') }}">
            <div class="product-card-img-wrap">
                <div class="product-stock-badge"><span class="stock-count">10</span> left</div>
                <div class="product-qty-control">
                    <button class="qty-btn qty-minus" aria-label="Decrease quantity" disabled>&#8722;</button>
                    <span class="qty-count">0</span>
                    <button class="qty-btn qty-plus" aria-label="Increase quantity">&#43;</button>
                </div>
                <img class="product-thumb"
                     src="{{ asset('img/our-store/ken-desktop-device.jpg') }}"
                     alt="Ken Desktop Device + Barcode Scanner"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="product-thumb-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#bbb" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </div>
            <div class="product-card-body">
                <div class="product-card-name">Ken Desktop Device + Barcode Scanner</div>
                <div class="product-card-variant">Sunmi D3 Mini (58mm)</div>
                <div class="product-card-price">&#8358;630,000</div>
                <button type="button" class="btn-buy btn-add-cart">Add to cart</button>
            </div>
        </div>

        <!-- Stella Android Device (Sold Out) -->
        <div class="product-card" data-id="stella" data-name="Stella Android Device" data-price="390000" data-stock="0" data-img="{{ asset('img/our-store/stella-android-device.jpg') }}">
            <div class="product-card-img-wrap">
                <div class="product-stock-badge empty"><span class="stock-count">0</span> left</div>
                <div class="product-qty-control">
                    <button class="qty-btn qty-minus" aria-label="Decrease quantity" disabled>&#8722;</button>
                    <span class="qty-count">0</span>
                    <button class="qty-btn qty-plus" aria-label="Increase quantity" disabled>&#43;</button>
                </div>
                <img class="product-thumb"
                     src="{{ asset('img/our-store/stella-android-device.jpg') }}"
                     alt="Stella Android Device"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="product-thumb-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#bbb" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </div>
            <div class="product-card-body">
                <div class="product-card-name">Stella Android Device</div>
                <div class="product-card-variant">Sunmi V3</div>
                <div class="product-card-price">&#8358;390,000</div>
                <span class="product-out-of-stock">Sold out</span>
                <button type="button" class="btn-buy btn-buy-disabled" disabled aria-disabled="true">Currently unavailable</button>
            </div>
        </div>

        <!-- On-ground Technical Support -->
        <div class="product-card" data-id="support" data-name="On-ground Technical Support" data-price="10500" data-stock="2" data-img="{{ asset('img/our-store/on-ground-technical-support.jpg') }}">
            <div class="product-card-img-wrap">
                <div class="product-stock-badge"><span class="stock-count">2</span> left</div>
                <div class="product-qty-control">
                    <button class="qty-btn qty-minus" aria-label="Decrease quantity" disabled>&#8722;</button>
                    <span class="qty-count">0</span>
                    <button class="qty-btn qty-plus" aria-label="Increase quantity">&#43;</button>
                </div>
                <img class="product-thumb"
                     src="{{ asset('img/our-store/on-ground-technical-support.jpg') }}"
                     alt="On-ground Technical Support"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="product-thumb-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#bbb" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </div>
            <div class="product-card-body">
                <div class="product-card-name">On-ground Technical Support</div>
                <div class="product-card-variant">1 day</div>
                <div class="product-card-price">&#8358;10,500</div>
                <button type="button" class="btn-buy btn-add-cart">Add to cart</button>
            </div>
        </div>

        <!-- Virtual Staff Training Fee -->
        <div class="product-card" data-id="virtual" data-name="Virtual Staff Training Fee" data-price="10000" data-stock="20" data-img="{{ asset('img/our-store/virtual-staff-training-fee.jpg') }}">
            <div class="product-card-img-wrap">
                <div class="product-stock-badge"><span class="stock-count">20</span> left</div>
                <div class="product-qty-control">
                    <button class="qty-btn qty-minus" aria-label="Decrease quantity" disabled>&#8722;</button>
                    <span class="qty-count">0</span>
                    <button class="qty-btn qty-plus" aria-label="Increase quantity">&#43;</button>
                </div>
                <img class="product-thumb"
                     src="{{ asset('img/our-store/virtual-staff-training-fee.jpg') }}"
                     alt="Virtual Staff Training Fee"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="product-thumb-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#bbb" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </div>
            <div class="product-card-body">
                <div class="product-card-name">Virtual Staff Training Fee</div>
                <div class="product-card-variant">One session</div>
                <div class="product-card-price">&#8358;10,000</div>
                <button type="button" class="btn-buy btn-add-cart">Add to cart</button>
            </div>
        </div>

        <!-- Stock-taking Fee -->
        <div class="product-card" data-id="stocktaking" data-name="Stock-taking Fee (1 - 100 SKUs)" data-price="19500" data-stock="15" data-img="{{ asset('img/our-store/stock-taking-fee.jpg') }}">
            <div class="product-card-img-wrap">
                <div class="product-stock-badge"><span class="stock-count">15</span> left</div>
                <div class="product-qty-control">
                    <button class="qty-btn qty-minus" aria-label="Decrease quantity" disabled>&#8722;</button>
                    <span class="qty-count">0</span>
                    <button class="qty-btn qty-plus" aria-label="Increase quantity">&#43;</button>
                </div>
                <img class="product-thumb"
                     src="{{ asset('img/our-store/stock-taking-fee.jpg') }}"
                     alt="Stock-taking Fee (1 - 100 SKUs)"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="product-thumb-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#bbb" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </div>
            <div class="product-card-body">
                <div class="product-card-name">Stock-taking Fee (1 &ndash; 100 SKUs)</div>
                <div class="product-card-variant">per Store</div>
                <div class="product-card-price">&#8358;19,500</div>
                <button type="button" class="btn-buy btn-add-cart">Add to cart</button>
            </div>
        </div>

        <!-- Staff Training Fee -->
        <div class="product-card" data-id="staff" data-name="Staff Training Fee" data-price="15000" data-stock="25" data-img="{{ asset('img/our-store/staff-training-fee.png') }}">
            <div class="product-card-img-wrap">
                <div class="product-stock-badge"><span class="stock-count">25</span> left</div>
                <div class="product-qty-control">
                    <button class="qty-btn qty-minus" aria-label="Decrease quantity" disabled>&#8722;</button>
                    <span class="qty-count">0</span>
                    <button class="qty-btn qty-plus" aria-label="Increase quantity">&#43;</button>
                </div>
                <img class="product-thumb"
                     src="{{ asset('img/our-store/staff-training-fee.png') }}"
                     alt="Staff Training Fee"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                <div class="product-thumb-placeholder">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#bbb" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </div>
            <div class="product-card-body">
                <div class="product-card-name">Staff Training Fee</div>
                <div class="product-card-variant">5 staff per Store per Day</div>
                <div class="product-card-price">&#8358;15,000</div>
                <button type="button" class="btn-buy btn-add-cart">Add to cart</button>
            </div>
        </div>

        <div class="no-products-found" id="noProductsFound">
            No products found matching your search.
        </div>

    </div>

    <!-- Bottom Shopping Cart Button (Spans 70% width of columns) -->
    <div class="bottom-cart-btn-wrap">
        <button type="button" class="bottom-cart-btn openCartBtnBottom">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            <span>View Shopping Cart</span>
            <span class="cart-badge cartBadgeBottom">0</span>
        </button>
    </div>

</main>

<!-- Shopping Cart Modal Overlay (Blurred Backdrop) -->
<div class="cart-overlay" id="cartOverlay" onclick="if(event.target === this) closeCartModal()">
    <div class="cart-modal">
        <div class="cart-modal-header">
            <div class="cart-modal-title">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                <span>Shopping Cart</span>
            </div>
            <button type="button" class="cart-close-btn" onclick="closeCartModal()" aria-label="Close cart">&times;</button>
        </div>
        <div class="cart-modal-body" id="cartModalBody">
            <!-- Dynamic cart list or empty state -->
        </div>
        <div class="cart-modal-footer">
            <div class="cart-total-row">
                <span class="cart-total-label">Subtotal</span>
                <span class="cart-total-val" id="cartTotalVal">&#8358;0</span>
            </div>
            <button type="button" class="btn-checkout" id="cartCheckoutBtn" onclick="saveCartAndCheckout()">Proceed to checkout</button>
        </div>
    </div>
</div>

<!-- Product Image Lightbox Modal -->
<div class="img-lightbox-overlay" id="imgLightboxOverlay" onclick="if(event.target===this)closeImgLightbox()">
    <div class="img-lightbox-box">
        <button class="img-lightbox-close" onclick="closeImgLightbox()" aria-label="Close image">&times;</button>
        <img class="img-lightbox-img" id="imgLightboxImg" src="" alt="Product image">
    </div>
</div>
@endsection

@push('scripts')
<script>
    const storeSearchInput = document.getElementById('storeSearchInput');
    const noProductsFound  = document.getElementById('noProductsFound');
    const cartBadge        = document.getElementById('cartBadge');
    const openCartBtn      = document.getElementById('openCartBtn');
    const cartOverlay      = document.getElementById('cartOverlay');
    const cartModalBody    = document.getElementById('cartModalBody');
    const cartTotalVal     = document.getElementById('cartTotalVal');

    const productsState = {};

    function formatNaira(amount) {
        return '&#8358;' + amount.toLocaleString('en-US');
    }

    function updateCartUI() {
        let totalItems = 0;
        let totalPrice = 0;
        const itemsInCart = [];

        Object.values(productsState).forEach(prod => {
            totalItems += prod.qty;
            totalPrice += prod.qty * prod.price;
            if (prod.qty > 0) {
                itemsInCart.push(prod);
            }
        });

        document.querySelectorAll('#cartBadge, .cartBadgeBottom').forEach(el => {
            el.textContent = totalItems;
        });

        if (cartModalBody) {
            if (itemsInCart.length === 0) {
                cartModalBody.innerHTML = `
                    <div class="cart-empty-state">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        <p>Your shopping cart is empty</p>
                    </div>
                `;
            } else {
                let html = '<div class="cart-items-list">';
                itemsInCart.forEach(prod => {
                    html += `
                        <div class="cart-item-row" data-id="${prod.id}">
                            <img src="${prod.img}" alt="${prod.name}" class="cart-item-img" onerror="this.src='{{ asset("img/shopkite-logo.png") }}'">
                            <div class="cart-item-info">
                                <div class="cart-item-name">${prod.name}</div>
                                <div class="cart-item-price">${formatNaira(prod.price)}</div>
                            </div>
                            <div class="cart-item-right">
                                <div class="cart-item-controls">
                                    <button type="button" class="qty-btn cart-item-minus" data-id="${prod.id}">&#8722;</button>
                                    <span class="qty-count">${prod.qty}</span>
                                    <button type="button" class="qty-btn cart-item-plus" data-id="${prod.id}" ${prod.stock === 0 ? 'disabled' : ''}>&#43;</button>
                                </div>
                                <div class="cart-item-subtotal">${formatNaira(prod.qty * prod.price)}</div>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';
                cartModalBody.innerHTML = html;

                cartModalBody.querySelectorAll('.cart-item-plus').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const id = btn.dataset.id;
                        if (productsState[id] && productsState[id].stock > 0) {
                            changeQuantity(id, 1);
                        }
                    });
                });

                cartModalBody.querySelectorAll('.cart-item-minus').forEach(btn => {
                    btn.addEventListener('click', () => {
                        const id = btn.dataset.id;
                        if (productsState[id] && productsState[id].qty > 0) {
                            changeQuantity(id, -1);
                        }
                    });
                });
            }
        }

        if (cartTotalVal) {
            cartTotalVal.innerHTML = formatNaira(totalPrice);
        }
    }

    function triggerBadgeBump() {
        if (cartBadge) {
            cartBadge.classList.add('bump');
            setTimeout(() => cartBadge.classList.remove('bump'), 200);
        }
    }

    function changeQuantity(id, delta) {
        const prod = productsState[id];
        if (!prod) return;

        if (delta > 0 && prod.stock > 0) {
            prod.qty += 1;
            prod.stock -= 1;
            triggerBadgeBump();
        } else if (delta < 0 && prod.qty > 0) {
            prod.qty -= 1;
            prod.stock += 1;
        }

        refreshProductCardUI(prod);
        updateCartUI();
    }

    function refreshProductCardUI(prod) {
        const card = prod.cardEl;
        if (!card) return;

        const stockEl  = card.querySelector('.stock-count');
        const qtyEl    = card.querySelector('.qty-count');
        const minusBtn = card.querySelector('.qty-minus');
        const plusBtn  = card.querySelector('.qty-plus');
        const addBtn   = card.querySelector('.btn-add-cart');
        const badge    = card.querySelector('.product-stock-badge');

        if (stockEl) stockEl.textContent = prod.stock;
        if (qtyEl)   qtyEl.textContent   = prod.qty;
        if (minusBtn) minusBtn.disabled  = prod.qty === 0;
        if (plusBtn)  plusBtn.disabled   = prod.stock === 0;
        if (badge)    badge.classList.toggle('empty', prod.stock === 0);

        if (addBtn) {
            if (prod.stock === 0) {
                addBtn.disabled = true;
                addBtn.textContent = 'Out of stock';
                addBtn.classList.add('btn-buy-disabled');
            } else {
                addBtn.disabled = false;
                addBtn.textContent = 'Add to cart';
                addBtn.classList.remove('btn-buy-disabled');
            }
        }
    }

    document.querySelectorAll('.product-card[data-id]').forEach(card => {
        const id    = card.dataset.id;
        const name  = card.dataset.name;
        const price = parseInt(card.dataset.price, 10) || 0;
        const stock = parseInt(card.dataset.stock, 10) || 0;
        const img   = card.dataset.img || '';

        const prod = {
            id,
            name,
            price,
            stock,
            qty: 0,
            img,
            cardEl: card
        };

        productsState[id] = prod;

        const minusBtn = card.querySelector('.qty-minus');
        const plusBtn  = card.querySelector('.qty-plus');
        const addBtn   = card.querySelector('.btn-add-cart');

        if (plusBtn) {
            plusBtn.addEventListener('click', () => changeQuantity(id, 1));
        }
        if (minusBtn) {
            minusBtn.addEventListener('click', () => changeQuantity(id, -1));
        }
        if (addBtn) {
            addBtn.addEventListener('click', () => changeQuantity(id, 1));
        }

        refreshProductCardUI(prod);
    });

    if (storeSearchInput) {
        storeSearchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            let visibleCount = 0;

            Object.values(productsState).forEach(prod => {
                const cardName = prod.name.toLowerCase();
                const cardVariant = (prod.cardEl.querySelector('.product-card-variant')?.textContent || '').toLowerCase();
                const matches = cardName.includes(query) || cardVariant.includes(query);

                if (matches) {
                    prod.cardEl.style.display = '';
                    visibleCount++;
                } else {
                    prod.cardEl.style.display = 'none';
                }
            });

            if (noProductsFound) {
                noProductsFound.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    }

    function openCartModal() {
        if (cartOverlay) {
            cartOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeCartModal() {
        if (cartOverlay) {
            cartOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    document.querySelectorAll('#openCartBtn, .openCartBtnBottom').forEach(btn => {
        btn.addEventListener('click', openCartModal);
    });

    const imgLightboxOverlay = document.getElementById('imgLightboxOverlay');
    const imgLightboxImg     = document.getElementById('imgLightboxImg');

    function openImgLightbox(src, alt) {
        if (!imgLightboxOverlay || !imgLightboxImg) return;
        imgLightboxImg.src = src;
        imgLightboxImg.alt = alt || 'Product image';
        imgLightboxOverlay.style.display = 'flex';
        requestAnimationFrame(() => imgLightboxOverlay.classList.add('active'));
        document.body.style.overflow = 'hidden';
    }

    function closeImgLightbox() {
        if (!imgLightboxOverlay) return;
        imgLightboxOverlay.classList.remove('active');
        setTimeout(() => {
            imgLightboxOverlay.style.display = 'none';
            imgLightboxImg.src = '';
        }, 260);
        document.body.style.overflow = '';
    }

    document.querySelectorAll('.product-thumb').forEach(img => {
        img.style.cursor = 'zoom-in';
        img.addEventListener('click', () => {
            openImgLightbox(img.src, img.alt);
        });
    });

    function saveCartAndCheckout() {
        const cartItems = Object.values(productsState)
            .filter(p => p.qty > 0)
            .map(p => ({ id: p.id, name: p.name, price: p.price, qty: p.qty, img: p.img }));

        if (cartItems.length === 0) {
            alert('Please add at least one item to your cart before checking out.');
            return;
        }

        sessionStorage.setItem('shopkite_cart', JSON.stringify(cartItems));
        window.location.href = "{{ route('checkout') }}";
    }

    updateCartUI();
</script>
@endpush
