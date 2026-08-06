<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/cityscape.css') }}">
<link rel="stylesheet" href="{{ asset('css/main.css?v=1.1.2') }}">
@yield('extra_css')
@stack('styles')
<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
<title>@yield('title', 'ShopKite — Selling made easy')</title>
<meta name="description" content="@yield('meta_description', 'ShopKite merchant is a simple, easy to use point of sale app for stores.')">
<style>html.loading, html.loading body { overflow: hidden !important; touch-action: none; }</style>
