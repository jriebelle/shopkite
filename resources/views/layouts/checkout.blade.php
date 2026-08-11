<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/cityscape.css') }}?v={{ filemtime(public_path('css/cityscape.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v={{ filemtime(public_path('css/main.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/store.css') }}?v={{ filemtime(public_path('css/store.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}?v={{ filemtime(public_path('css/checkout.css')) }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <title>@yield('title', 'Checkout — ShopKite Store')</title>
    <meta name="description" content="@yield('meta_description', 'Complete your ShopKite order. Enter your delivery details and proceed to secure payment.')">
</head>

<body>
    @yield('content')

    <div id="menu-cursor" aria-hidden="true">Menu</div>
    <div id="brand-cursor" aria-hidden="true"><span></span>Outlets</div>

    @include('partials.support-popup')
    @include('partials.scripts')
    @stack('scripts')
</body>

</html>
