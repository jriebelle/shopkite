@extends('layouts.checkout')

@section('title', 'Order Confirmed — ShopKite Store')
@section('meta_description', 'Your ShopKite order has been placed successfully. Our team will be in touch shortly to confirm delivery.')

@section('content')
<main class="success-page">

    <div class="success-card">

        <!-- Animation (PNG Sequence Canvas Player for Desktop & Mobile) -->
        <div class="success-video-wrap">
            <canvas
                id="sequenceCanvas"
                width="500"
                height="500"
                class="success-canvas"
                aria-label="Order Complete Animation">
            </canvas>
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

    // ── PNG Sequence Player (Desktop & Mobile Views) ──────────────
    (function() {
        const canvas = document.getElementById('sequenceCanvas');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        const totalFrames = 151; // 000.png to 150.png
        const basePath = "{{ asset('img/complete_check_light') }}";
        const images = [];

        // Preload PNG sequence images
        for (let i = 0; i < totalFrames; i++) {
            const padded = String(i).padStart(3, '0');
            const img = new Image();
            img.src = `${basePath}/${padded}.png`;
            images.push(img);
        }

        let currentFrame = 0;
        const targetFps = 50; // ~3 seconds smooth animation playback
        const frameInterval = 1000 / targetFps;
        let lastFrameTime = 0;

        function renderFrame(timestamp) {
            if (!lastFrameTime) lastFrameTime = timestamp;
            const elapsed = timestamp - lastFrameTime;

            if (elapsed >= frameInterval) {
                lastFrameTime = timestamp - (elapsed % frameInterval);

                const img = images[currentFrame];
                if (img && (img.complete || img.naturalWidth > 0)) {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                }

                if (currentFrame < totalFrames - 1) {
                    currentFrame++;
                    requestAnimationFrame(renderFrame);
                } else {
                    // Stopped on final frame 150.png permanently!
                    if (images[totalFrames - 1].complete) {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(images[totalFrames - 1], 0, 0, canvas.width, canvas.height);
                    }
                }
            } else {
                requestAnimationFrame(renderFrame);
            }
        }

        // Start playing as soon as frame 000 is ready
        if (images[0].complete) {
            ctx.drawImage(images[0], 0, 0, canvas.width, canvas.height);
            requestAnimationFrame(renderFrame);
        } else {
            images[0].onload = () => {
                ctx.drawImage(images[0], 0, 0, canvas.width, canvas.height);
                requestAnimationFrame(renderFrame);
            };
        }
    })();
</script>
@endpush
