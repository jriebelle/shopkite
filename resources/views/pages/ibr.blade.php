@extends('layouts.app')

@section('title', 'Intelligent Business Report — ShopKite')
@section('meta_description', 'Discover ShopKite Intelligent Business Report — a deep dive into sales, profits, least/most selling products, and 14 key performance metrics.')

@section('content')
<!-- Main Content Area -->
<main class="ibr-content-area">
    <div class="ibr-banner">
        <div class="ibr-banner-text">
            <span>Intelligent</span>
            <span class="ibr-banner-text-bold">Business</span>
            <span>Report</span>
        </div>
        <img src="{{ asset('img/ibr/ibr-page-banner@2x.png') }}" alt="Intelligent Business Report Banner">
    </div>
    <div class="ibr-writeup">
        <p>At ShopKite, your business growth is always our priority. That’s why we’re excited to introduce ShopKite Intelligent Business Report, a smarter way to truly understand how your business is performing. This is not just another sales report. It is a deep dive into the numbers that matter most to your business.</p>
        <p>The report provides insights into Profit/Loss, Most selling products, Least selling products, Most profitable products, Least profitable products, Most selling product category, and 14 other key performance metrics designed to help you make better business decisions. And here’s the best part.</p>
        <p>Now it is time to turn insights into actions. Click the link below to view your comprehensive ShopKite Intelligent Business Report and see your business like never before:</p>
        <div class="ibr-cta-wrap">
            <a href="https://merchant.shopkite.com.ng/login" target="_blank" class="ibr-cta-btn">View Your Business Report</a>
        </div>
    </div>
</main>
@endsection
