@extends('layouts.app')

@section('title', 'Insights, Retail Guides & Stories — ShopKite Blog')
@section('meta_description', 'Actionable advice, retail industry insights, and growth guides tailored for retail merchants in Nigeria and Africa.')

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/blog.css') }}?v={{ filemtime(public_path('css/blog.css')) }}">
@endsection

@section('content')
<main class="blog-page-wrapper">
    <div class="blog-container">

        <!-- ── 1. Hero Title Area (Matching ShopKite Typography) ── -->
        <header class="blog-page-title">
            <h1>Insights, Stories &amp; <span class="highlight-shopkite">Retail Guides</span></h1>
            <div class="blog-page-subtext">
                <p>Actionable advice, operational playbooks, and tech insights crafted to help African store owners, supermarkets, and pharmacies scale profitably.</p>
            </div>
        </header>

        <!-- ── 2. Category Filter & Search Bar ───────────────────── -->
        <section class="blog-controls-section">
            <nav class="blog-categories-list" aria-label="Blog categories">
                @foreach($categories as $cat)
                    <a href="{{ route('blog.index', ['category' => $cat['slug'], 'q' => request('q')]) }}"
                       class="blog-category-pill {{ $selectedCategory === $cat['slug'] ? 'active' : '' }}">
                        {{ $cat['name'] }}
                    </a>
                @endforeach
            </nav>

            <form action="{{ route('blog.index') }}" method="GET" class="blog-search-form">
                @if($selectedCategory !== 'all')
                    <input type="hidden" name="category" value="{{ $selectedCategory }}">
                @endif
                <svg class="blog-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text"
                       name="q"
                       class="blog-search-input"
                       placeholder="Search articles..."
                       value="{{ $searchQuery }}"
                       autocomplete="off">
            </form>
        </section>

        <!-- ── 3. Featured Post (Shown when on 'all' and no active search) ── -->
        @if($selectedCategory === 'all' && empty($searchQuery) && $featuredArticle)
            <section class="blog-featured-section">
                <a href="{{ route('blog.show', $featuredArticle['slug']) }}" class="blog-featured-card">
                    <div class="blog-featured-card-body">
                        <div class="blog-card-badge-row">
                            <span class="blog-category-badge">{{ $featuredArticle['category'] }}</span>
                            <span class="blog-featured-label">Featured Guide</span>
                        </div>

                        <h2 class="blog-featured-title">{{ $featuredArticle['title'] }}</h2>
                        <p class="blog-featured-excerpt">{{ $featuredArticle['excerpt'] }}</p>

                        <div class="blog-card-meta-footer">
                            <div class="blog-meta-author-group">
                                <div class="blog-author-avatar">SK</div>
                                <div class="blog-meta-info">
                                    <strong>{{ $featuredArticle['author'] }}</strong>
                                    <span class="blog-meta-dot">&bull;</span>
                                    <span>{{ $featuredArticle['date'] }}</span>
                                    <span class="blog-meta-dot">&bull;</span>
                                    <span>{{ $featuredArticle['read_time'] }}</span>
                                </div>
                            </div>
                            <span class="blog-read-cta-link">
                                <span>Read Article</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </span>
                        </div>
                    </div>
                    @if(!empty($featuredArticle['thumbnail']))
                        <div class="blog-featured-thumb-wrap">
                            <img src="{{ str_starts_with($featuredArticle['thumbnail'], 'http') ? $featuredArticle['thumbnail'] : asset($featuredArticle['thumbnail']) }}" alt="{{ $featuredArticle['title'] }}" class="blog-featured-thumb-img" loading="lazy">
                        </div>
                    @endif
                </a>
            </section>
        @endif

        <!-- ── 4. Minimalist Articles Grid ───────────────────────── -->
        <section class="blog-grid-section">
            @if($articles->count() > 0)
                <div class="blog-grid">
                    @foreach($articles as $article)
                        {{-- If we're on 'all' without search, skip duplicate of the featured article --}}
                        @if(!($selectedCategory === 'all' && empty($searchQuery) && $featuredArticle && $article['slug'] === $featuredArticle['slug']))
                            <a href="{{ route('blog.show', $article['slug']) }}" class="blog-card">
                                @if(!empty($article['thumbnail']))
                                    <div class="blog-card-thumb-wrap">
                                        <img src="{{ str_starts_with($article['thumbnail'], 'http') ? $article['thumbnail'] : asset($article['thumbnail']) }}" alt="{{ $article['title'] }}" class="blog-card-thumb-img" loading="lazy">
                                    </div>
                                @endif
                                <div class="blog-card-content">
                                    <div class="blog-card-badge-row">
                                        <span class="blog-category-badge">{{ $article['category'] }}</span>
                                    </div>
                                    <h3 class="blog-card-title">{{ $article['title'] }}</h3>
                                    <p class="blog-card-excerpt">{{ $article['excerpt'] }}</p>
                                </div>

                                <div class="blog-card-meta-footer">
                                    <div class="blog-meta-info">
                                        <span>{{ $article['date'] }}</span>
                                        <span class="blog-meta-dot">&bull;</span>
                                        <span>{{ $article['read_time'] }}</span>
                                    </div>
                                    <span class="blog-read-cta-link">
                                        <span>Read</span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                                    </span>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="blog-empty-state">
                    <h3>No articles found</h3>
                    <p>No results matching "{{ $searchQuery }}". Try another search or view all categories.</p>
                    <a href="{{ route('blog.index') }}" class="blog-reset-btn">View All Articles</a>
                </div>
            @endif
        </section>

        <!-- ── 5. Bottom Trial CTA Banner ────────────────────────── -->
        <section class="blog-trial-cta">
            <h2>Take total control of your retail store today</h2>
            <p>Join thousands of African merchants using ShopKite to manage inventory, eliminate stock loss, and automate business reporting.</p>
            <a href="{{ route('pricing') }}" class="blog-trial-btn">
                <span>View Plans &amp; Start 7-Day Trial</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </section>

    </div>
</main>
@endsection
