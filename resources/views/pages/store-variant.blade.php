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

        @include('partials.store-product-cards', ['products' => $products])

        <div class="no-products-found" id="noProductsFound">
            No products found matching your search.
        </div>

    </div>

    <!-- Lazy loading: the next batch of products is fetched when this nears the viewport -->
    <div class="product-load-more" id="productLoadMore" aria-live="polite" @if ($nextPage === null) hidden @endif>
        <span class="product-load-spinner" aria-hidden="true"></span>
        <span class="product-load-text">Loading more products&hellip;</span>
        <button type="button" class="product-load-retry" hidden>Couldn&rsquo;t load more. Tap to retry</button>
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

    // Wires up a product card: registers its product the first time, and re-attaches an
    // existing product (keeping its cart quantity and remaining stock) if the card is rebuilt,
    // as after a search.
    function bindCard(card) {
        if (card.dataset.bound) return;
        card.dataset.bound = '1';

        const id = card.dataset.id;
        let prod = productsState[id];
        if (prod) {
            prod.cardEl = card;
        } else {
            prod = {
                id,
                name: card.dataset.name,
                price: parseInt(card.dataset.price, 10) || 0,
                stock: parseInt(card.dataset.stock, 10) || 0,
                qty: 0,
                img: card.dataset.img || '',
                cardEl: card
            };
            productsState[id] = prod;
        }

        const minusBtn = card.querySelector('.qty-minus');
        const plusBtn  = card.querySelector('.qty-plus');
        const addBtn   = card.querySelector('.btn-add-cart');

        if (plusBtn)  plusBtn.addEventListener('click', () => changeQuantity(id, 1));
        if (minusBtn) minusBtn.addEventListener('click', () => changeQuantity(id, -1));
        if (addBtn)   addBtn.addEventListener('click', () => changeQuantity(id, 1));

        refreshProductCardUI(prod);
    }

    document.querySelectorAll('#productGrid .product-card[data-id]').forEach(bindCard);

    // Lazy loading. The page renders the first batch; the next ones are fetched from the server
    // when the "loading" row nears the viewport. Searching asks the server too, since products
    // that haven't loaded yet can't be found in the page.
    const productGrid     = document.getElementById('productGrid');
    const loadMoreEl      = document.getElementById('productLoadMore');
    const loadMoreText    = loadMoreEl ? loadMoreEl.querySelector('.product-load-text') : null;
    const loadMoreSpinner = loadMoreEl ? loadMoreEl.querySelector('.product-load-spinner') : null;
    const loadMoreRetry   = loadMoreEl ? loadMoreEl.querySelector('.product-load-retry') : null;
    const productsUrl     = "{{ route('store.variant.products') }}";
    let nextPage      = {{ $nextPage ?? 'null' }};
    let searchQuery   = '';
    let isLoading     = false;
    let loadRequest   = 0;
    let loadAbort     = null;
    let loadObserver  = null;

    function setLoadState(state) {
        // state: 'idle' (nothing more to load), 'loading' or 'error'
        if (!loadMoreEl) return;
        loadMoreEl.hidden = state === 'idle';
        if (loadMoreSpinner) loadMoreSpinner.hidden = state !== 'loading';
        if (loadMoreText)    loadMoreText.hidden    = state !== 'loading';
        if (loadMoreRetry)   loadMoreRetry.hidden   = state !== 'error';
    }

    async function loadMoreProducts() {
        if (isLoading || nextPage === null) return;
        isLoading = true;
        setLoadState('loading');

        const request = ++loadRequest;
        loadAbort = new AbortController();
        try {
            const response = await fetch(productsUrl + '?page=' + nextPage + '&q=' + encodeURIComponent(searchQuery), {
                headers: { 'Accept': 'application/json' },
                signal: loadAbort.signal
            });
            if (!response.ok) throw new Error('HTTP ' + response.status);
            const data = await response.json();
            if (request !== loadRequest) return; // a newer search replaced this one

            noProductsFound.insertAdjacentHTML('beforebegin', data.html);
            productGrid.querySelectorAll('.product-card[data-id]').forEach(bindCard);
            nextPage = data.next;
            noProductsFound.style.display = productGrid.querySelector('.product-card') ? 'none' : 'block';
            setLoadState(nextPage === null ? 'idle' : 'loading');
        } catch (error) {
            if (error.name === 'AbortError') return;
            setLoadState('error');
        } finally {
            if (request === loadRequest) {
                isLoading = false;
                // Still near the viewport (a tall window, or a short batch): look again
                if (loadObserver && nextPage !== null && loadMoreEl && !loadMoreEl.hidden && !(loadMoreRetry && !loadMoreRetry.hidden)) {
                    loadObserver.unobserve(loadMoreEl);
                    loadObserver.observe(loadMoreEl);
                }
            }
        }
    }

    if (loadMoreEl) {
        if ('IntersectionObserver' in window) {
            loadObserver = new IntersectionObserver((entries) => {
                if (entries.some(entry => entry.isIntersecting)) loadMoreProducts();
            }, { rootMargin: '600px 0px' });
            loadObserver.observe(loadMoreEl);
        } else if (nextPage !== null) {
            // No IntersectionObserver: just load everything, a batch at a time
            (async () => { while (nextPage !== null) { await loadMoreProducts(); if (loadMoreRetry && !loadMoreRetry.hidden) break; } })();
        }
        if (loadMoreRetry) {
            loadMoreRetry.addEventListener('click', () => {
                setLoadState('loading');
                loadMoreProducts();
            });
        }
    }

    if (storeSearchInput) {
        let searchTimer = null;
        storeSearchInput.addEventListener('input', (e) => {
            const query = e.target.value.trim();
            clearTimeout(searchTimer);
            searchTimer = setTimeout(() => {
                if (query === searchQuery) return;
                searchQuery = query;

                // Start over with the first batch of matches
                loadRequest++;
                if (loadAbort) loadAbort.abort();
                isLoading = false;
                productGrid.querySelectorAll('.product-card').forEach(card => card.remove());
                noProductsFound.style.display = 'none';
                nextPage = 1;
                loadMoreProducts();
            }, 250);
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

    // One listener for every thumbnail, including the ones loaded later
    productGrid.addEventListener('click', (e) => {
        const img = e.target.closest('.product-thumb');
        if (img) openImgLightbox(img.src, img.alt);
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
