<!DOCTYPE html>
<html lang="en" class="loading">

<head>
    @include('partials.head')
</head>

<body>
    @include('partials.loader')
    @include('partials.nav')

    @yield('content')

    @include('partials.footer')

    <!-- Custom menu cursor -->
    <div id="menu-cursor" aria-hidden="true">Menu</div>
    <!-- Custom brand cursor -->
    <div id="brand-cursor" aria-hidden="true"><span></span>Outlets</div>

    @include('partials.support-popup')
    @include('partials.scripts')
    @stack('scripts')
</body>

</html>
