@extends('layouts.app')

@section('title', 'Become an Agent — ShopKite')
@section('meta_description', 'Talk to stores around you about ShopKite, earn money. Find neighbourhood supermarkets or pharmacies around you and start earning today.')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/agent.css') }}?v={{ filemtime(public_path('css/agent.css')) }}">
@endsection

@section('content')
<!-- Main Content Area -->
<main class="agent-content-area">
    
    <!-- Agent Page Banner -->
    <div class="agent-banner">
        <div class="agent-banner-text">
            <span>Become a</span>
            <span class="agent-banner-text-bold">ShopKite Agent</span>
        </div>
        <img src="{{ asset('img/shopkite-agent-banner@2x.png') }}" alt="ShopKite Agent Banner">
    </div>

    <!-- Intro Writeup -->
    <div class="agent-writeup">
        <h1 class="agent-hero-title">Talk to stores around you about ShopKite, earn money.</h1>
        <p class="agent-hero-subtitle">Find neighbourhood supermarkets or pharmacies around you, tell them about ShopKite Merchant and start earning money.</p>
    </div>

    <!-- Video & Overview Grid -->
    <div class="agent-video-grid">
        <div class="agent-video-wrap">
            <iframe src="https://www.youtube.com/embed/5GbQTo6sOao" title="ShopKite Merchant Overview" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="agent-video-content">
            <h2>Let's start with ShopKite Merchant</h2>
            <p>Simply put, <strong>ShopKite Merchant</strong> shrinks the big point of sale systems used in pharmacies and supermarkets into an app on your phone.</p>
            <p>No need for big and bulky point of sale systems — store owners just install ShopKite Merchant on their tablet or mobile phone, period!</p>
        </div>
    </div>

    <!-- Features / Agent Steps Grid -->
    <h2 class="agent-section-heading">How It Works</h2>
    <div class="agent-features-grid">
        
        <div class="agent-feature-card">
            <div class="agent-feature-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <h3>Tell someone about it</h3>
            <p>Every pharmacy and supermarket owner you talk to about ShopKite Merchant is very likely to sign up because it was specially designed for them.</p>
            <p>ShopKite Merchant is for every kind of store — big, medium, or small.</p>
        </div>

        <div class="agent-feature-card">
            <div class="agent-feature-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"/></svg>
            </div>
            <h3>Don't sell, recommend!</h3>
            <p>You are helping pharmacies and supermarkets by introducing them to ShopKite Merchant. You are not trying to convince them, you are bringing them to the light.</p>
        </div>

        <div class="agent-feature-card">
            <div class="agent-feature-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
            </div>
            <h3>Read the handbook</h3>
            <p>Everything you need to understand about being a ShopKite agent can be found in the official handbook.</p>
            <p>It explains earnings, commissions, and answers questions you may have.</p>
        </div>

    </div>

    <!-- CTA Box -->
    <div class="agent-cta-box">
        <h2>Ready to start earning with ShopKite?</h2>
        <p>Join hundreds of agents empowering store owners across Nigeria. Register today or read the agent handbook for details.</p>
        <div class="agent-btn-group">
            <a href="https://agent.shopkite.com.ng/register" target="_blank" rel="noopener noreferrer" class="agent-btn-primary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                Sign up as a ShopKite Agent
            </a>
            <a href="{{ route('handbook') }}" class="agent-btn-secondary">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                Read Agent Handbook
            </a>
        </div>
    </div>

</main>
@endsection
