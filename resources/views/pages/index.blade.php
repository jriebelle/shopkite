@extends('layouts.app')

@section('title', 'ShopKite — Selling made easy')
@section('meta_description', 'ShopKite merchant is a simple, easy to use point of sale app for neighbourhood stores and mini-marts to manage sales and inventory.')

@section('content')
<div class="hero-section">
    <div class="hero-clip">
        <div class="clouds">
            <div class="set1"></div>
            <div class="set2"></div>
            <div class="set3"></div>
            <img src="{{ asset('img/cloud-bg-img.png') }}" alt="" class="cloud-bg-img">
        </div>
    </div>
    <div class="welcome-text">
        <div class="text">Welcome to...</div>
        <div class="copy">
            <div>
                <p>Selling made</p>
            </div>
            <div class="changing-text"><span>plenty</span></div>
        </div>
        <div class="sub-text">
            <p>Built with convenience from the ground up.</p>
        </div>
    </div>
    <div class="phone">
        <img src="{{ asset('img/phone.png') }}" alt="">
    </div>
    <div class="hero-buttons-container">
        <div class="buttons-row">
            <a href="#" class="hero-btn primary">
                <img src="{{ asset('img/apple-icon.png') }}" alt="Apple" class="btn-icon">
                Apple Appstore
            </a>
            <a href="#" class="hero-btn secondary">
                <img src="{{ asset('img/android-icon.png') }}" alt="Android" class="btn-icon">
                Google Play store
            </a>
        </div>
    </div>
</div>

<div class="section-2">
    <p>Who can use ShopKite?</p>
    <div class="bubbles">
        <img class="guy" src="{{ asset('img/section2/guy-bubble-customer.png') }}" alt="">
        <img class="lady-bubble" src="{{ asset('img/section2/lady-bubble-customer.png') }}" alt="">
        <img class="silhouette-1" src="{{ asset('img/section2/silhouette-bubble-1.png') }}" alt="">
        <img class="silhouette-2" src="{{ asset('img/section2/silhouette-bubble-2.png') }}" alt="">
        <img class="silhouette-3" src="{{ asset('img/section2/silhouette-bubble-3.png') }}" alt="">
        <img class="silhouette-4" src="{{ asset('img/section2/silhouette-bubble-4.png') }}" alt="">
        <img class="store" src="{{ asset('img/section2/store-bubble-small.png') }}" alt="">
        <img class="woman" src="{{ asset('img/section2/woman-bubble-customer.png') }}" alt="">
        <img class="man" src="{{ asset('img/section2/man-bubble-customer.png') }}" alt="">
    </div>
</div>

<div class="section3-4-wrap">
    <div class="section-3">
        <div class="title">
            <img src="{{ asset('img/section2/pharmacy-icon.png') }}" alt="">
            <h2>Pharmacies</h2>
        </div>
        <div class="img-cont">
            <img class="store-top" src="{{ asset('img/section3/phone-store-top-side.png') }}" alt="">
            <img class="store-left-wall" src="{{ asset('img/section3/store-left-wall.png') }}" alt="">
            <img class="store-right-wall" src="{{ asset('img/section3/store-right-wall.png') }}" alt="">
            <img class="store-floor" src="{{ asset('img/section3/store-floor.png') }}" alt="">

            <img class="first-shelf-left" src="{{ asset('img/section3/1st-shelf-left.png') }}" alt="">
            <img class="second-shelf-left" src="{{ asset('img/section3/2nd-shelf-left.png') }}" alt="">
            <img class="third-shelf-left" src="{{ asset('img/section3/3rd-shelf-left.png') }}" alt="">

            <img class="forth-shelf-right" src="{{ asset('img/section3/4th-shelf-right.png') }}" alt="">
            <img class="fifth-shelf-right" src="{{ asset('img/section3/5th-shelf-right.png') }}" alt="">

            <img class="first-item-left" src="{{ asset('img/section3/1st-items-left.png') }}" alt="">
            <img class="second-item-left" src="{{ asset('img/section3/2nd-items-left.png') }}" alt="">
            <img class="third-item-left" src="{{ asset('img/section3/3rd-items-left.png') }}" alt="">
            <img class="forth-item-right" src="{{ asset('img/section3/4th-items-right.png') }}" alt="">
            <img class="fifth-item-right" src="{{ asset('img/section3/5th-items-right.png') }}" alt="">
            <img class="sixth-item-right" src="{{ asset('img/section3/6th-items-right.png') }}" alt="">
            <img class="seventh-item-right" src="{{ asset('img/section3/7th-items-right.png') }}" alt="">

            <img class="pharmacist" src="{{ asset('img/section3/pharmacist.png') }}" alt="">
            <img class="store-counter" src="{{ asset('img/section3/store-counter.png') }}" alt="">
            <img class="items-on-counter" src="{{ asset('img/section3/items-on-counter.png') }}" alt="">
            <img class="customer" src="{{ asset('img/section3/customer.png') }}" alt="">
        </div>
        <div class="text-cont">Catch expired/expiring stock with automated alerts.</div>
    </div>
    <div class="section-4">
        <div class="title">
            <img src="{{ asset('img/section4/provisions-store-icon.png') }}" alt="">
            <h2>Provisions Stores</h2>
        </div>
        <div class="img-cont">
            <img src="{{ asset('img/section4/provisions-store-illustration.png') }}" alt="">
        </div>
        <div class="text-cont">Manage staff, multiple branches, owing and owed records from one point.</div>
    </div>
    <div class="section-5">
        <div class="title">
            <img src="{{ asset('img/section5/mini-mart-icon.png') }}" alt="">
            <h2>Minimarts</h2>
        </div>
        <div class="img-cont">
            <img src="{{ asset('img/section5/mini-mart-illustration.png') }}" alt="">
        </div>
        <div class="text-cont">Get daily, weekly and monthly reports.</div>
    </div>
</div>

<div class="section-6">
    <p>...even your friendly, neighbourhood</p>
</div>
<div class="section-7">
    <div class="meshai-wrapper">
        <img class="meshai-photo unmasked" src="{{ asset('img/section7/meshai-photo.jpg') }}" alt="">
        <div class="meshai-masked-photo">
            <img class="meshai-photo masked" src="{{ asset('img/section7/meshai-photo.jpg') }}" alt="">
        </div>
    </div>
</div>
<div class="section-8">
    <div class="section-8-marquee">
        <div class="marquee-row top">
            <p>Built with convenience from the ground up!</p>
        </div>
        <div class="marquee-row middle">
            <p>Built with convenience from the ground up!</p>
        </div>
        <div class="marquee-row bottom">
            <p>Built with convenience from the ground up!</p>
        </div>
    </div>
    <div class="section-img">
        <div class="logo-marker1">
            <img src="https://shopkite.com.ng/resources/images/logo-marker.svg" alt="">
            <div class="stroke"></div>
        </div>
        <div class="logo-marker1 two">
            <img src="https://shopkite.com.ng/resources/images/logo-marker.svg" alt="">
            <div class="stroke"></div>
        </div>
        <div class="logo-marker1 three">
            <img src="https://shopkite.com.ng/resources/images/logo-marker.svg" alt="">
            <div class="stroke"></div>
        </div>
        <div class="logo-marker1 four">
            <img src="https://shopkite.com.ng/resources/images/logo-marker.svg" alt="">
            <div class="stroke"></div>
        </div>
        <div class="logo-marker1 five">
            <img src="https://shopkite.com.ng/resources/images/logo-marker.svg" alt="">
            <div class="stroke"></div>
        </div>
        <div class="logo-marker1 six">
            <img src="https://shopkite.com.ng/resources/images/logo-marker.svg" alt="">
            <div class="stroke"></div>
        </div>
        <div class="logo-marker1 seven">
            <img src="https://shopkite.com.ng/resources/images/logo-marker.svg" alt="">
            <div class="stroke"></div>
        </div>
        <img src="https://shopkite.com.ng/resources/images/city-overlay.png" alt="" class="main-img2">

        <div class="city-danfo1"></div>
        <div class="city-danfo2"></div>
        <div class="city-danfo5"></div>
        <div class="city-truck1"></div>
        <div class="city-truck2"></div>
        <div class="city-danfo4"></div>

        <img src="https://shopkite.com.ng/resources/images/brt-right-front.svg" alt="" class="brt-front1">
        <img src="https://shopkite.com.ng/resources/images/truck-right.svg" alt="" class="truck-right1">
        <img src="https://shopkite.com.ng/resources/images/bus-right.svg" alt="" class="bus-right2">
        <img src="https://shopkite.com.ng/resources/images/brt-back-left.svg" alt="" class="brt-back1">
        <img src="https://shopkite.com.ng/resources/images/bus-back-left.svg" alt="" class="bus-back-left1">
        <img src="https://shopkite.com.ng/resources/images/truck-left-back.svg" alt="" class="truck-left-back1">

        <img src="https://shopkite.com.ng/resources/images/city.png" alt="" class="main-img">
    </div>
</div>
<div class="testimonials-title">
    <p>Who is using ShopKite merchant?</p>
</div>
<div class="merchant-testimony-section">
    <div class="testimony-track">
        <a href="#" target="_blank" rel="noopener noreferrer" class="testimonial">
            <div class="testimonial-btn">
                <span>Watch on IG</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#4f4f4f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <img src="{{ asset('img/testimonials/Amaju Ezenduka.jpg') }}" alt="">
            <h2>"Everyday, I get my reports"</h2>
            <p>Pharm - Amaju Ezenduka / Delta State</p>
        </a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="testimonial">
            <div class="testimonial-btn">
                <span>Watch on IG</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#4f4f4f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <img src="{{ asset('img/testimonials/esther-nwachukwu.jpg') }}" alt="">
            <h2>"I just love it!"</h2>
            <p>Pharm - Esther Nwachukwu / Delta State</p>
        </a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="testimonial">
            <div class="testimonial-btn">
                <span>Watch on IG</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#4f4f4f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <img src="{{ asset('img/testimonials/faithful-oyakhilome.jpg') }}" alt="">
            <h2>"ShopKite is very easy to use..."</h2>
            <p>Pharm - Faithful Oyakhilome / Edo State</p>
        </a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="testimonial">
            <div class="testimonial-btn">
                <span>Watch on IG</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#4f4f4f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <img src="{{ asset('img/testimonials/godwin-atah.jpg') }}" alt="">
            <h2>"Makes documentation and sales easy..."</h2>
            <p>Pharm - Godwin Atah / FCT Abuja</p>
        </a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="testimonial">
            <div class="testimonial-btn">
                <span>Watch on IG</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#4f4f4f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <img src="{{ asset('img/testimonials/christian-jaja.jpg') }}" alt="">
            <h2>"It has been an excellent experience..."</h2>
            <p>Pharm - Christian Jaja / Rivers State</p>
        </a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="testimonial">
            <div class="testimonial-btn">
                <span>Watch on IG</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#4f4f4f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <img src="{{ asset('img/testimonials/ngozi-luke-egbogu.jpg') }}" alt="">
            <h2>"expired products has reduced..."</h2>
            <p>Pharm - Ngozi Luke Egbogu / Rivers State</p>
        </a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="testimonial">
            <div class="testimonial-btn">
                <span>Watch on IG</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#4f4f4f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <img src="{{ asset('img/testimonials/temitope-olowolayemo.jpg') }}" alt="">
            <h2>"makes inventory control simple and easy..."</h2>
            <p>Pharm - Temitope Olowolayemo / Ondo State</p>
        </a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="testimonial">
            <div class="testimonial-btn">
                <span>Watch on IG</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#4f4f4f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <img src="{{ asset('img/testimonials/udeme-nyong.jpg') }}" alt="">
            <h2>"it's a really nice thing for pharmacy inventory..."</h2>
            <p>Pharm - Udeme Nyong / Akwa Ibom State</p>
        </a>
        <a href="#" target="_blank" rel="noopener noreferrer" class="testimonial">
            <div class="testimonial-btn">
                <span>Watch on IG</span>
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 8H15M15 8L8 1M15 8L8 15" stroke="#4f4f4f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
            <img src="{{ asset('img/testimonials/aramide.jpg') }}" alt="">
            <h2>"ShopKite has really helped..."</h2>
            <p>Dr Oyebimpe aramide / Lagos State</p>
        </a>
    </div>
</div>

<div class="brands">
    <div class="brands-track">
        <div class="brand-container">
            <p><span>7</span>Outlets</p>
            <img src="{{ asset('img/brands/turarenwata-by-ray.png') }}" alt="">
        </div>
        <div class="brand-container">
            <p><span>35</span>Outlets</p>
            <img src="{{ asset('img/brands/babcock-investment-group.png') }}" alt="">
        </div>
        <div class="brand-container">
            <p><span>27</span>Outlets</p>
            <img src="{{ asset('img/brands/lamed-pharmacy.png') }}" alt="">
        </div>
        <div class="brand-container">
            <p><span>7</span>Outlets</p>
            <img src="{{ asset('img/brands/kim-zee-pharmacy.png') }}" alt="">
        </div>
        <div class="brand-container">
            <p><span>9</span>Outlets</p>
            <img src="{{ asset('img/brands/ijapari.png') }}" alt="">
        </div>
    </div>
</div>
<div class="bento-divider"></div>
<div class="bento-title">
    <p>Why choose ShopKite Merchant?</p>
</div>
<div class="bento-container">
    <div class="bento-item row-span-2 receipts">
        <h3>Print <br>Receipts</h3>
        <p>Either with our recommended devices or a device of your choosing. Print receipts with ease for all or any sales.</p>
        <img src="{{ asset('img/bento/print-receipts.png') }}" alt="">
    </div>
    <div class="bento-item col-span-2 sku-store">
        <img src="{{ asset('img/bento/sku-store.png') }}" alt="">
        <h3>400,000+ <br>Pre-loaded SKUs</h3>
        <p>ShopKite merchant comes preloaded with over 400,000 SKUs to make setup super fast and easy</p>
    </div>
    <div class="bento-item reports">
        <h3>Daily, Monthly & Yearly Reports</h3>
        <p>Get clear breakdowns of your sales and inventory and watch your business grow.</p>
        <img src="{{ asset('img/bento/reports.png') }}" alt="reports">
    </div>
    <div class="bento-item staff">
        <h3>Set Staff Roles</h3>
        <p>Decide what staff can and can not do or access with granular controls across your ShopKite Merchant account.</p>
        <img src="{{ asset('img/bento/staff-roles.png') }}" alt="">
    </div>
    <div class="bento-item col-span-2 locations">
        <h3>Manage multiple locations</h3>
        <p>Create, manage multiple branches and warehouses from your finger tips. Transfer products from one store to another.</p>
        <img src="{{ asset('img/bento/multiple-locations.png') }}" alt="">
    </div>
    <div class="bento-item notified">
        <h3>Get Notified</h3>
        <p>Avoid selling expired drugs or loosing on potential sales with instant notifications.</p>
        <img src="{{ asset('img/bento/get-notified.png') }}" alt="">
    </div>
    <div class="bento-item offline">
        <h3>No Internet? <br>Sell Offline</h3>
        <p>ShopKite Merchant works seamlessly offline and syncs automatically when online.</p>
        <img src="{{ asset('img/bento/no-internet.png') }}" alt="">
    </div>
    <div class="bento-item col-span-2 ibr">
        <h3>Intelligent Business <br>Report</h3>
        <p>This is an intelligently consolidated summary of your business over a selected period of time from about 20 different parameters.</p>
        <img src="{{ asset('img/bento/ibr.png') }}" alt="">
        <a href="{{ route('ibr') }}" class="ibr-btn">Learn More about IBR</a>
    </div>
</div>
<div class="trial-title">
    <p>What next? Start a free 7-Day trial now</p>
</div>
<div class="trial-buttons-container">
    <a href="#" class="trial-btn apple-trial">
        <img src="{{ asset('img/apple-icon.png') }}" alt="Apple Icon" class="btn-icon">
        <div class="btn-text">
            <p>Download ShopKite Merchant for your iPad, iPhone or iMac (Apple Silicon)</p>
        </div>
    </a>
    <a href="#" class="trial-btn android-trial">
        <img src="{{ asset('img/android-icon.png') }}" alt="Android Icon" class="btn-icon">
        <div class="btn-text">
            <p>Download ShopKite Merchant on any device that is powered by a supported Android OS</p>
        </div>
    </a>
</div>
@endsection
