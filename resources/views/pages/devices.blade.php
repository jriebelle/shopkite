@extends('layouts.app')

@section('title', 'Recommended Devices — ShopKite Hardware')
@section('meta_description', 'Explore ShopKite recommended POS devices, Sunmi handheld terminals, thermal receipt printers, and barcode scanners.')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/devices.css') }}?v={{ filemtime(public_path('css/devices.css')) }}">
@endsection

@section('content')
<main class="devices-main-wrapper">
  
  <div class="devices-page-title">
      <h3>If ShopKite merchant was beans, this is the bread...</h3>
      <div class="devices-page-subtext">
          <p>These are the devices we have tested and verified to work seamlessly with ShopKite Merchant. From powerful handheld terminals to heavy-duty desktop POS systems &mdash; built for Nigerian merchants who mean business.</p>
      </div>
  </div>

  <!-- Interactive Plugin Section (Jhey JoGpOGV CodePen Pattern) -->
  <section class="devices-plugin-section">
    <div class="column">
      
      <!-- Device 1: Ken -->
      <details name="feature">
        <summary>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0h-18" />
          </svg>
          <span>Ken Device</span>
        </summary>
        <div class="content">
          <h4>Ken (Sunmi D3 Mini)</h4>
          <p>Bring your checkout system to life with a 10.1 inch, android powered desktop (Ken) device. Has 1D/2D scanner for scanning product barcodes and a 58mm printer.</p>
          <a href="/store" class="buy-device">Get a Ken Device Now!</a>
        </div>
      </details>

      <!-- Device 2: Stella -->
      <details name="feature">
        <summary>
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
          </svg>
          <span>Stella Device</span>
        </summary>
        <div class="content">
          <h4>Stella (Sunmi V3)</h4>
          <p>A powerful hand-held device with 6.75 inch display, 32 GB of storage and 58mm printer. With 3GB Ram, ShopKite runs super smooth on this device.</p>
          <a href="/store" class="buy-device">Get a Stella Device Now!</a>
        </div>
      </details>

    </div>

    <!-- Image Column -->
    <div class="column">
      <div class="img-block">
        <div class="img-wrapper">
          <img src="{{ asset('img/devices.png') }}" alt="ShopKite Hardware Overview" />
        </div>
      </div>
      <div class="img-block">
        <div class="img-wrapper">
          <img src="{{ asset('img/ken-device.png') }}" alt="Stella POS Device" />
        </div>
      </div>
      <div class="img-block">
        <div class="img-wrapper">
          <img src="{{ asset('img/stella-device.png') }}" alt="Ken Terminal" />
        </div>
      </div>
    </div>

    <!-- Navigation Controls -->
    <button aria-label="Next Item" data-action="next">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
      </svg>        
    </button>
    <button aria-label="Previous Item" data-action="previous">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5" />
      </svg>        
    </button>
    <button aria-label="Close Item" data-action="exit">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
      </svg>        
    </button>
  </section>

  <!-- Simple Accordion List (Max Width: 1280px, Collapsed Height: 60px) -->
  <div class="devices-section-intro">
      <h3>Additional Recommended Devices</h3>
      <div class="devices-page-subtext">
          <p>Click any device below to find out more. The brands listed below are compatible with ShopKite Merchant out of the box.</p>
      </div>
  </div>
  <div class="devices-accordion-wrapper">
    <div class="devices-accordion-list">

      <!-- Item 1: Ken -->
      <details class="simple-accordion-item">
        <summary class="accordion-header">
          <div class="header-left">
            <h4 class="accordion-title">Samsung Tab</h4>
          </div>
          <div class="header-right" style="background-image: url('{{ asset('img/recommended-devices/samsung-tab.png') }}');">
            <svg class="chevron-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </div>
        </summary>
        <p class="accordion-content-text">Samsung Galaxy tablets provide exceptional display quality and long battery life. They are ideal for high-volume sales counters running ShopKite Merchant with Bluetooth receipt printers and barcode scanners connected seamlessly.</p>
      </details>

      <!-- Item 2: Stella -->
      <details class="simple-accordion-item">
        <summary class="accordion-header">
          <div class="header-left">
            <h4 class="accordion-title">Apple iPad</h4>
          </div>
          <div class="header-right" style="background-image: url('{{ asset('img/recommended-devices/apple-ipad.png') }}');">
            <svg class="chevron-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </div>
        </summary>
        <p class="accordion-content-text">Experience sleek performance and fluid touch controls on Apple iPad. Perfect for modern retail counters and boutique shops using ShopKite Merchant to manage inventory, print receipts, and track real-time analytics.</p>
      </details>

      <!-- Item 3: Sunmi T2 -->
      <details class="simple-accordion-item">
        <summary class="accordion-header">
          <div class="header-left">
            <h4 class="accordion-title">Lenovo Tab</h4>
          </div>
          <div class="header-right" style="background-image: url('{{ asset('img/recommended-devices/lenovo-tab.png') }}');">
            <svg class="chevron-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </div>
        </summary>
        <p class="accordion-content-text">Lenovo tablets combine durable build quality with reliable processor performance. Great for busy storefronts needing an affordable, heavy-duty Android tablet to run daily ShopKite POS operations smoothly.</p>
      </details>

      <!-- Item 4: Printers -->
      <details class="simple-accordion-item">
        <summary class="accordion-header">
          <div class="header-left">
            <h4 class="accordion-title">Huawei Tab</h4>
          </div>
          <div class="header-right" style="background-image: url('{{ asset('img/recommended-devices/huawei-tab.png') }}');">
            <svg class="chevron-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </div>
        </summary>
        <p class="accordion-content-text">Huawei tablets deliver vibrant displays and fast connectivity. They offer a responsive, reliable touch environment for merchants processing sales and monitoring stock levels on ShopKite Merchant.</p>
      </details>

      <!-- Item 5: Scanners -->
      <details class="simple-accordion-item">
        <summary class="accordion-header">
          <div class="header-left">
            <h4 class="accordion-title">Infinix Tab</h4>
          </div>
          <div class="header-right" style="background-image: url('{{ asset('img/recommended-devices/infinix-tab.png') }}');">
            <svg class="chevron-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </div>
        </summary>
        <p class="accordion-content-text">Infinix tablets deliver excellent value with large screens and robust multi-tasking capabilities. Perfect for cost-conscious store owners looking to deploy ShopKite Merchant across multiple cashiers.</p>
      </details>

      <!-- Item 6: Cash Drawers -->
      <details class="simple-accordion-item">
        <summary class="accordion-header">
          <div class="header-left">
            <h4 class="accordion-title">Oppo Tab</h4>
          </div>
          <div class="header-right" style="background-image: url('{{ asset('img/recommended-devices/oppo-tab.png') }}');">
            <svg class="chevron-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
            </svg>
          </div>
        </summary>
        <p class="accordion-content-text">Oppo tablets offer sleek design, fast performance, and battery efficiency. Designed for active store environments, making sale management and stock updates effortless on ShopKite Merchant.</p>
      </details>

    </div>
  </div>

</main>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const section = document.querySelector('section.devices-plugin-section');
    if (!section) return;

    const column = section.querySelector('.column');
    let detailsElements = section.querySelectorAll('details[name="feature"]');
    const nextButton = section.querySelector('button[data-action="next"]');
    const previousButton = section.querySelector('button[data-action="previous"]');
    const exitButton = section.querySelector('button[data-action="exit"]');

    const getOpenDetails = () => {
      return Array.from(detailsElements).findIndex(details => details.open);
    };

    nextButton?.addEventListener('click', () => {
      const currentIndex = getOpenDetails();
      if (currentIndex !== -1) {
        detailsElements[currentIndex].open = false;
        const nextIndex = (currentIndex + 1) % detailsElements.length;
        detailsElements[nextIndex].open = true;
      }
    });

    previousButton?.addEventListener('click', () => {
      const currentIndex = getOpenDetails();
      if (currentIndex !== -1) {
        detailsElements[currentIndex].open = false;
        const previousIndex = (currentIndex - 1 + detailsElements.length) % detailsElements.length;
        detailsElements[previousIndex].open = true;
      }
    });

    exitButton?.addEventListener('click', () => {
      const currentIndex = getOpenDetails();
      if (currentIndex !== -1) {
        detailsElements[currentIndex].open = false;
      }
    });

    const syncState = async () => {
      if (!section.matches(':has([open])')) {
        section.dataset.checkingDetails = 'false';
      } else {
        await Promise.allSettled(section.getAnimations({ subtree: true }).map(a => a.finished));
        section.dataset.checkingDetails = 'true';
      }
    };

    section.addEventListener('toggle', syncState, true);
  });
</script>
@endpush
