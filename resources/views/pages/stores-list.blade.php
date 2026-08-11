@extends('layouts.app')

@section('title', 'Stores in Nigeria — ShopKite')
@section('meta_description', 'Discover and shop directly from verified ShopKite merchant stores across Nigeria.')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/store.css') }}">
@endsection

@section('content')
<!-- Main Content Area -->
<main class="store-content-area">

    <!-- Page Header (Matching Store-Variant Layout) -->
    <div class="store-header-variant">
        <div class="store-dp-wrap">
            <img class="store-dp-img" src="{{ asset('img/shopkite-store-profile-pic.png') }}" alt="ShopKite Stores Nigeria">
        </div>
        <div class="store-intro-variant">
            <h2 class="store-section-label">Stores in Nigeria</h2>
            <p>You can now buy your favourite products from verified stores across Nigeria in the comfort of your home and get them delivered to your doorstep.</p>
            <div class="store-tags-wrap">
                <span class="store-tag-label">Country:</span>
                <span class="store-tag-pill">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Nigeria
                </span>
            </div>
        </div>
    </div>

    <!-- Search Bar for Stores -->
    <div class="store-toolbar-bar" style="margin-bottom: 28px;">
        <div class="store-search-wrap" style="width: 100%;">
            <div class="store-search-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </div>
            <input type="text" id="storeSearchInput" class="store-search-input" placeholder="Search stores by name, category, or location...">
        </div>
    </div>

    <!-- Stores Grid -->
    <div class="stores-grid" id="storesGrid">

        <!-- Store 1: ShopKite Official -->
        <div class="store-item-card" data-name="shopkite devices & services" data-category="devices & services" data-location="omole, ikeja, lagos">
            <div class="store-item-header">
                <img src="{{ asset('img/shopkite-store-profile-pic.png') }}" alt="ShopKite Official Store" class="store-item-dp">
                <div class="store-item-title-wrap">
                    <h3 class="store-item-name">ShopKite Hardware &amp; Services</h3>
                    <span class="store-item-type">Devices &amp; Services</span>
                </div>
            </div>
            <p class="store-item-desc">Official ShopKite recommended inventory management devices, Sunmi handheld devices, receipt printers &amp; setup services.</p>
            <div class="store-item-footer">
                <span class="store-item-location">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Omole, Ikeja, Lagos
                </span>
                <a href="{{ route('store.variant') }}" class="btn-visit-store">Visit Store &rarr;</a>
            </div>
        </div>

        <!-- Store 2: Patria Cabinetry -->
        <div class="store-item-card" data-name="patriacabinetry" data-category="household and kitchen wares" data-location="opebi, ikeja, lagos">
            <div class="store-item-header">
                <img src="https://shopkite.s3.amazonaws.com/photos/merchants/88WLOKNRlEtKsG2XxONEonMJAB1cFm2IRr6irly8.jpeg" alt="Patria Cabinetry" class="store-item-dp" onerror="this.src='{{ asset('img/shopkite-logo.png') }}'">
                <div class="store-item-title-wrap">
                    <h3 class="store-item-name">PATRIACABINETRY</h3>
                    <span class="store-item-type">Household &amp; Kitchen Wares</span>
                </div>
            </div>
            <p class="store-item-desc">Premium household items, kitchen cabinets, space solutions, and modern home decor essentials.</p>
            <div class="store-item-footer">
                <span class="store-item-location">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Opebi, Ikeja, Lagos
                </span>
                <a href="{{ route('store.variant') }}" class="btn-visit-store">Visit Store &rarr;</a>
            </div>
        </div>

        <!-- Store 3: Amrusad Stores Rano -->
        <div class="store-item-card" data-name="amrusad stores rano" data-category="mini mart & retail" data-location="kado, amac, abuja">
            <div class="store-item-header">
                <img src="https://shopkitemerchants.s3.eu-west-2.amazonaws.com/photos/merchants/amrusad-min.jpg" alt="Amrusad Stores Rano" class="store-item-dp" onerror="this.src='{{ asset('img/shopkite-logo.png') }}'">
                <div class="store-item-title-wrap">
                    <h3 class="store-item-name">Amrusad Stores Rano</h3>
                    <span class="store-item-type">Mini Mart &amp; Retail</span>
                </div>
            </div>
            <p class="store-item-desc">A mini mart with full retail &amp; wholesale services, interior goods, and everyday household supplies.</p>
            <div class="store-item-footer">
                <span class="store-item-location">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Kado, AMAC, Abuja
                </span>
                <a href="{{ route('store.variant') }}" class="btn-visit-store">Visit Store &rarr;</a>
            </div>
        </div>

        <!-- Store 4: Atampa Affair -->
        <div class="store-item-card" data-name="atampa affair" data-category="fabrics & fashion" data-location="garki ii, amac, abuja">
            <div class="store-item-header">
                <img src="https://shopkitemerchants.s3.eu-west-2.amazonaws.com/photos/merchants/vjvt7dPeL4MwGc9eaYc7wsLU810jnPqkzzLMvstM.jpeg" alt="Atampa Affair" class="store-item-dp" onerror="this.src='{{ asset('img/shopkite-logo.png') }}'">
                <div class="store-item-title-wrap">
                    <h3 class="store-item-name">Atampa Affair</h3>
                    <span class="store-item-type">Fabrics &amp; Fashion</span>
                </div>
            </div>
            <p class="store-item-desc">Exclusive designer fabrics, Ankara, Atampa materials, and luxury textiles for men and women.</p>
            <div class="store-item-footer">
                <span class="store-item-location">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Garki II, AMAC, Abuja
                </span>
                <a href="{{ route('store.variant') }}" class="btn-visit-store">Visit Store &rarr;</a>
            </div>
        </div>

        <!-- Store 5: SheaOrganicBeauty -->
        <div class="store-item-card" data-name="sheaorganicbeauty" data-category="beauty & haircare" data-location="garki ii, amac, abuja">
            <div class="store-item-header">
                <img src="https://shopkitemerchants.s3.eu-west-2.amazonaws.com/photos/merchants/HYDUE6uwtLxXYNVW4rA3rR9cG7TSWun6eo0hLE5v.jpeg" alt="SheaOrganicBeauty" class="store-item-dp" onerror="this.src='{{ asset('img/shopkite-logo.png') }}'">
                <div class="store-item-title-wrap">
                    <h3 class="store-item-name">SheaOrganicBeauty</h3>
                    <span class="store-item-type">Natural Hair &amp; Skincare</span>
                </div>
            </div>
            <p class="store-item-desc">100% natural, organic hair and skincare products crafted with premium raw shea butter and essential oils.</p>
            <div class="store-item-footer">
                <span class="store-item-location">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Garki II, AMAC, Abuja
                </span>
                <a href="{{ route('store.variant') }}" class="btn-visit-store">Visit Store &rarr;</a>
            </div>
        </div>

        <!-- Store 6: RAPHABALM PHARMACY -->
        <div class="store-item-card" data-name="raphabalm pharmacy" data-category="pharmacy & wellness" data-location="ataoja, osogbo, osun">
            <div class="store-item-header">
                <img src="https://shopkitemerchants.s3.eu-west-2.amazonaws.com/photos/merchants/A9JwYuGOoaEEyveOFKNeB1V6R1PJcHLifeGtoPQr.jpeg" alt="RAPHABALM PHARMACY" class="store-item-dp" onerror="this.src='{{ asset('img/shopkite-logo.png') }}'">
                <div class="store-item-title-wrap">
                    <h3 class="store-item-name">RAPHABALM PHARMACY</h3>
                    <span class="store-item-type">Pharmacy &amp; Health</span>
                </div>
            </div>
            <p class="store-item-desc">Trusted retail pharmacy offering prescription medicines, health supplements, and medical products.</p>
            <div class="store-item-footer">
                <span class="store-item-location">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Ataoja 'a', Osogbo, Osun
                </span>
                <a href="{{ route('store.variant') }}" class="btn-visit-store">Visit Store &rarr;</a>
            </div>
        </div>

        <!-- Store 7: The Kids Store By NISSI -->
        <div class="store-item-card" data-name="the kids store by nissi" data-category="kids & toys" data-location="kaura, amac, abuja">
            <div class="store-item-header">
                <img src="https://shopkitemerchants.s3.eu-west-2.amazonaws.com/photos/merchants/pgxwXTpum9uwr4IXIe7BGpIzHxIOpX84cWIRtdQZ.jpeg" alt="The Kids Store By NISSI" class="store-item-dp" onerror="this.src='{{ asset('img/shopkite-logo.png') }}'">
                <div class="store-item-title-wrap">
                    <h3 class="store-item-name">The Kids Store By NISSI</h3>
                    <span class="store-item-type">Department Store for Kids</span>
                </div>
            </div>
            <p class="store-item-desc">One-stop department store for children clothing, toys, nursery items, and educational learning tools.</p>
            <div class="store-item-footer">
                <span class="store-item-location">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Kaura, AMAC, Abuja
                </span>
                <a href="{{ route('store.variant') }}" class="btn-visit-store">Visit Store &rarr;</a>
            </div>
        </div>

        <!-- Store 8: Medinomic Pharmacy & Mini Mart -->
        <div class="store-item-card" data-name="medinomic pharmacy and mini mart" data-category="pharmacy & groceries" data-location="ijaye, akinyele, oyo">
            <div class="store-item-header">
                <img src="https://shopkitemerchants.s3.eu-west-2.amazonaws.com/photos/merchants/jCbZo4gSh8oAL8aQucl0loZzPmvp8xiOeCQuXP3f.jpeg" alt="Medinomic Pharmacy" class="store-item-dp" onerror="this.src='{{ asset('img/shopkite-logo.png') }}'">
                <div class="store-item-title-wrap">
                    <h3 class="store-item-name">Medinomic Pharmacy &amp; Mini Mart</h3>
                    <span class="store-item-type">Health, Wellness &amp; Mini Mart</span>
                </div>
            </div>
            <p class="store-item-desc">Health and wellness products, essential medications, beauty items, vaccines, and daily provisions.</p>
            <div class="store-item-footer">
                <span class="store-item-location">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Ijaye, Akinyele, Oyo
                </span>
                <a href="{{ route('store.variant') }}" class="btn-visit-store">Visit Store &rarr;</a>
            </div>
        </div>

        <!-- Store 9: thelittlebakestore -->
        <div class="store-item-card" data-name="thelittlebakestore" data-category="baking supplies" data-location="bariga, somolu, lagos">
            <div class="store-item-header">
                <img src="https://shopkitemerchants.s3.eu-west-2.amazonaws.com/photos/merchants/R7DmyJ8CjVxYGZItnGuEnaI8c2nDf1vnQfzpFaVY.jpeg" alt="thelittlebakestore" class="store-item-dp" onerror="this.src='{{ asset('img/shopkite-logo.png') }}'">
                <div class="store-item-title-wrap">
                    <h3 class="store-item-name">thelittlebakestore</h3>
                    <span class="store-item-type">Baking Supplies &amp; Tools</span>
                </div>
            </div>
            <p class="store-item-desc">Unique and affordable baking supplies, ingredients, cake pans, and decorating accessories.</p>
            <div class="store-item-footer">
                <span class="store-item-location">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Bariga, Somolu, Lagos
                </span>
                <a href="{{ route('store.variant') }}" class="btn-visit-store">Visit Store &rarr;</a>
            </div>
        </div>

        <!-- Store 10: SKYN Botanics -->
        <div class="store-item-card" data-name="skyn botanics" data-category="organic skincare" data-location="garki ii, amac, abuja">
            <div class="store-item-header">
                <img src="https://shopkitemerchants.s3.eu-west-2.amazonaws.com/photos/merchants/MKd8IPgWQ8UTx67Z614HkpBUnrlogLABHiu697tQ.jpeg" alt="SKYN Botanics" class="store-item-dp" onerror="this.src='{{ asset('img/shopkite-logo.png') }}'">
                <div class="store-item-title-wrap">
                    <h3 class="store-item-name">SKYN Botanics</h3>
                    <span class="store-item-type">Organic Skincare &amp; Ingredients</span>
                </div>
            </div>
            <p class="store-item-desc">High performance, natural and organic skincare products and raw cosmetic formulation ingredients.</p>
            <div class="store-item-footer">
                <span class="store-item-location">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    Garki II, AMAC, Abuja
                </span>
                <a href="{{ route('store.variant') }}" class="btn-visit-store">Visit Store &rarr;</a>
            </div>
        </div>

    </div>

    <!-- Pagination Navigation -->
    <nav class="pagination-nav" aria-label="Stores Pagination">
        <a href="#" class="pagination-arrow prev disabled" aria-label="Previous Page">&laquo;</a>
        <a href="#" class="pagination-number active">1</a>
        <a href="#" class="pagination-number">2</a>
        <a href="#" class="pagination-number">3</a>
        <a href="#" class="pagination-number">4</a>
        <span class="pagination-dots">&hellip;</span>
        <a href="#" class="pagination-number">12</a>
        <a href="#" class="pagination-arrow next" aria-label="Next Page">&raquo;</a>
    </nav>

    <!-- Empty state when search matches nothing -->
    <div class="no-products-found" id="noStoresFound" style="display: none;">
        No stores found matching your search query.
    </div>

</main>
@endsection

@push('scripts')
<script>
    const storeSearchInput = document.getElementById('storeSearchInput');
    const noStoresFound    = document.getElementById('noStoresFound');

    if (storeSearchInput) {
        storeSearchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase().trim();
            let visibleCount = 0;

            document.querySelectorAll('#storesGrid .store-item-card').forEach(card => {
                const name     = (card.dataset.name || '').toLowerCase();
                const category = (card.dataset.category || '').toLowerCase();
                const location = (card.dataset.location || '').toLowerCase();
                const matches  = name.includes(query) || category.includes(query) || location.includes(query);

                if (matches) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            if (noStoresFound) {
                noStoresFound.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    }

    // Pagination interaction
    document.querySelectorAll('.pagination-number').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            document.querySelectorAll('.pagination-number').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
</script>
@endpush
