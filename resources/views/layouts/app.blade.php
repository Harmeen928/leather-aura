<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('site.name') . ' | Handcrafted Leather Goods, Sialkot')</title>
    <meta name="description" content="Leather Aura, Sialkot: handcrafted leather jackets, wallets, hats, harnesses, vests and gloves.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/leather.css') }}?v=1">
</head>
<body>
    <div class="grain"></div>
    <div class="loader" id="loader"><span>LEATHER AURA</span></div>
    <div class="cursor" id="cursor"></div>

    <header class="nav" id="nav">
        <a href="#home" class="logo">LEATHER<b>AURA</b></a>
        <nav>
            <a href="#products">Product Range</a>
            <a href="#process">Process</a>
            <a href="#faq">FAQ</a>
            <a href="#contact">Contact</a>
        </nav>
        <a href="#contact" class="btn btn-sm">Get a Quote</a>
    </header>

    @yield('content')

    <footer class="footer">
        <div>
            <a href="#home" class="logo">LEATHER<b>AURA</b></a>
            <p>{{ $site['address'] }}</p>
        </div>
        <div>
            <a href="tel:{{ preg_replace('/\s+/', '', $site['phone']) }}">{{ $site['phone'] }}</a>
            <a href="mailto:{{ $site['email'] }}">{{ $site['email'] }}</a>
        </div>
        <small>&copy; {{ date('Y') }} Leather Aura. All rights reserved.</small>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
    <script src="{{ asset('js/leather.js') }}?v=1"></script>
</body>
</html>
