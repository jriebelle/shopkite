@php
    $imageUrl = asset('img/our-store/' . $product['image']);
    $soldOut = $product['stock'] <= 0;
    $title = $product['display_name'] ?? $product['name'];
@endphp
<div class="product-card" data-id="{{ $product['id'] }}" data-name="{{ $product['name'] }}" data-price="{{ $product['price'] }}" data-stock="{{ $product['stock'] }}" data-img="{{ $imageUrl }}">
    <div class="product-card-img-wrap">
        <div class="product-stock-badge{{ $soldOut ? ' empty' : '' }}"><span class="stock-count">{{ $product['stock'] }}</span> left</div>
        <div class="product-qty-control">
            <button class="qty-btn qty-minus" aria-label="Decrease quantity" disabled>&#8722;</button>
            <span class="qty-count">0</span>
            <button class="qty-btn qty-plus" aria-label="Increase quantity"{{ $soldOut ? ' disabled' : '' }}>&#43;</button>
        </div>
        <img class="product-thumb"
             src="{{ $imageUrl }}"
             alt="{{ $title }}"
             loading="lazy"
             decoding="async"
             onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
        <div class="product-thumb-placeholder">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#bbb" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
        </div>
    </div>
    <div class="product-card-body">
        <div class="product-card-name">{{ $title }}</div>
        <div class="product-card-variant">{{ $product['variant'] }}</div>
        <div class="product-card-price">&#8358;{{ number_format($product['price']) }}</div>
        @if ($soldOut)
            <span class="product-out-of-stock">Sold out</span>
            <button type="button" class="btn-buy btn-buy-disabled" disabled aria-disabled="true">Currently unavailable</button>
        @else
            <button type="button" class="btn-buy btn-add-cart">Add to cart</button>
        @endif
    </div>
</div>
