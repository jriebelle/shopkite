@foreach ($products as $product)
    @include('partials.store-product-card', ['product' => $product])
@endforeach
