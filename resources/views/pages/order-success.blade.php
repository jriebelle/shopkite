@extends('layouts.checkout')

@section('title', 'Order Confirmed — ShopKite Store')
@section('meta_description', 'Your ShopKite order has been placed successfully. Our team will be in touch shortly to confirm delivery.')

@section('content')
<main class="success-page">

    <div class="success-card">

        <!-- Animation -->
        <div class="success-video-wrap">
            <video
                class="success-video"
                src="{{ asset('img/complete-check-light.webm') }}"
                autoplay
                muted
                playsinline
                aria-hidden="true">
            </video>
        </div>

        <!-- Confirmation copy -->
        <div class="success-body">
            <h1 class="success-title">Order confirmed!</h1>
            <p class="success-message">
                Thank you for your order. Our team has received your request and will reach out shortly to confirm your delivery details and arrange fulfilment. Keep an eye on your phone or email for updates.
            </p>

            <a href="{{ route('store') }}" class="success-back-btn" id="success-back-to-store">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                Back to Store
            </a>
        </div>

    </div>

</main>
@endsection

@push('scripts')
<script>
    // Clear the cart from sessionStorage on successful order
    sessionStorage.removeItem('shopkite_cart');
</script>
@endpush
