@extends('layouts.app')

@section('title', $article['title'] . ' — ShopKite Blog')
@section('meta_description', $article['excerpt'])

@section('extra_css')
<link rel="stylesheet" href="{{ asset('css/blog.css') }}?v={{ filemtime(public_path('css/blog.css')) }}">
@endsection

@section('content')
<main class="article-page-wrapper">
    <article class="article-container">

        <!-- ── 1. Breadcrumbs & Back Navigation ──────────────────── -->
        <div class="article-nav-header">
            <a href="{{ route('blog.index') }}" class="article-back-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                <span>Back to all articles</span>
            </a>

            <nav class="article-breadcrumbs" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <a href="{{ route('blog.index') }}">Blog</a>
                <span>/</span>
                <a href="{{ route('blog.index', ['category' => $article['category_slug']]) }}">{{ $article['category'] }}</a>
            </nav>
        </div>

        <!-- ── 2. Article Header & Meta ──────────────────────────── -->
        <header class="article-header">
            <div class="blog-card-badge-row">
                <span class="blog-category-badge">{{ $article['category'] }}</span>
            </div>

            <h1 class="article-title">{{ $article['title'] }}</h1>

            <div class="article-meta-bar">
                <div class="article-author-card">
                    <div class="article-author-avatar">SK</div>
                    <div class="article-author-details">
                        <span class="article-author-name">{{ $article['author'] }}</span>
                        <span class="article-author-role">{{ $article['author_role'] }} &bull; {{ $article['date'] }} &bull; {{ $article['read_time'] }}</span>
                    </div>
                </div>

                <!-- Social Sharing -->
                <div class="article-share-group">
                    <a href="https://wa.me/?text={{ urlencode($article['title'] . ' — ' . url()->current()) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="article-share-btn"
                       title="Share on WhatsApp"
                       aria-label="Share on WhatsApp">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($article['title']) }}&url={{ urlencode(url()->current()) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="article-share-btn"
                       title="Share on X"
                       aria-label="Share on X">
                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <button type="button"
                            class="article-share-btn"
                            id="copyArticleLinkBtn"
                            title="Copy link"
                            aria-label="Copy link to article">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                    </button>
                </div>
            </div>
        </header>

        <!-- ── 2.1 Article Hero Image ────────────────────────────── -->
        @if(!empty($article['thumbnail']))
            <div class="article-hero-image-wrap">
                <img src="{{ str_starts_with($article['thumbnail'], 'http') ? $article['thumbnail'] : asset($article['thumbnail']) }}" alt="{{ $article['title'] }}" class="article-hero-img">
            </div>
        @endif

        <!-- ── 3. Article Content Body ───────────────────────────── -->
        <div class="article-content">
            @foreach($article['content'] as $block)
                @if(is_string($block))
                    {!! $block !!}
                @elseif(isset($block['type']))
                    @if($block['type'] === 'lead')
                        <p class="article-lead">{{ $block['text'] }}</p>
                    @elseif($block['type'] === 'h2')
                        <h2>{{ $block['text'] }}</h2>
                    @elseif($block['type'] === 'h3')
                        <h3>{{ $block['text'] }}</h3>
                    @elseif($block['type'] === 'quote')
                        <blockquote class="article-quote">
                            &ldquo;{{ $block['text'] }}&rdquo;
                        </blockquote>
                    @elseif($block['type'] === 'callout')
                        <div class="article-callout">
                            <div class="article-callout-title">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                                <span>{{ $block['title'] }}</span>
                            </div>
                            <p class="article-callout-text">{{ $block['text'] }}</p>
                        </div>
                    @elseif($block['type'] === 'image')
                        <figure class="article-media-figure">
                            <img src="{{ $block['url'] }}" alt="{{ $block['alt'] ?? $article['title'] }}" class="article-inline-img">
                            @if(!empty($block['caption']))
                                <figcaption class="article-caption">{{ $block['caption'] }}</figcaption>
                            @endif
                        </figure>
                    @elseif($block['type'] === 'video')
                        <div class="article-video-wrapper">
                            <iframe src="{{ $block['url'] }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    @elseif($block['type'] === 'html')
                        {!! $block['html'] !!}
                    @else
                        <p>{{ $block['text'] ?? '' }}</p>
                    @endif
                @endif
            @endforeach
        </div>

        <!-- ── 4. Author Bio Box ─────────────────────────────────── -->
        <div class="article-author-bio">
            <div class="article-bio-avatar">SK</div>
            <div class="article-bio-info">
                <h4>Written by {{ $article['author'] }}</h4>
                <p>The ShopKite Editorial &amp; Advisory team works directly with hundreds of Nigerian and African retailers to share battle-tested insights on inventory management, retail hardware, and store profitability.</p>
            </div>
        </div>

        <!-- ── 5. Related Articles ───────────────────────────────── -->
        @if($relatedArticles->count() > 0)
            <section class="related-articles-section">
                <h3 class="related-articles-title">Related Retail Guides</h3>
                <div class="related-articles-grid">
                    @foreach($relatedArticles as $related)
                        <a href="{{ route('blog.show', $related['slug']) }}" class="related-article-card">
                            @if(!empty($related['thumbnail']))
                                <div class="related-thumb-wrap">
                                    <img src="{{ str_starts_with($related['thumbnail'], 'http') ? $related['thumbnail'] : asset($related['thumbnail']) }}" alt="{{ $related['title'] }}" class="related-thumb-img" loading="lazy">
                                </div>
                            @endif
                            <div class="related-card-body">
                                <span class="blog-category-badge">{{ $related['category'] }}</span>
                                <h4 class="related-article-title">{{ $related['title'] }}</h4>
                            </div>
                            <div class="blog-meta-info" style="margin-top: 14px;">
                                <span>{{ $related['read_time'] }}</span>
                                <span class="blog-meta-dot">&bull;</span>
                                <span>{{ $related['date'] }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- ── 6. Bottom Trial CTA Banner ────────────────────────── -->
        <section class="blog-trial-cta">
            <h2>Ready to transform your retail operations?</h2>
            <p>Experience seamless offline checkout, automated inventory tracking, and 400,000+ preloaded SKUs. Start your free 7-day trial today.</p>
            <a href="{{ route('pricing') }}" class="blog-trial-btn">
                <span>View Plans &amp; Start 7-Day Trial</span>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </section>

    </article>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyBtn = document.getElementById('copyArticleLinkBtn');
    if (copyBtn) {
        copyBtn.addEventListener('click', function() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                const originalHtml = copyBtn.innerHTML;
                copyBtn.innerHTML = `<svg viewBox="0 0 24 24" fill="none" stroke="#ff6600" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:15px;height:15px;"><polyline points="20 6 9 17 4 12"/></svg>`;
                copyBtn.setAttribute('title', 'Link Copied!');
                
                setTimeout(() => {
                    copyBtn.innerHTML = originalHtml;
                    copyBtn.setAttribute('title', 'Copy link');
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy URL:', err);
            });
        });
    }
});
</script>
@endpush
