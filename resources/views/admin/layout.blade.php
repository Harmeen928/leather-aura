<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>@yield('title', 'Admin') | Leather Aura</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=1">
</head>
<body>
<header class="top">
    <a class="brand" href="{{ route('admin.products.index') }}">LEATHER<b>AURA</b> ADMIN</a>
    <nav>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'on' : '' }}">Products</a>
        <a href="{{ route('admin.inquiries.index') }}" class="{{ request()->routeIs('admin.inquiries.*') ? 'on' : '' }}">Inquiries</a>
        <a href="{{ route('admin.settings.edit') }}" class="{{ request()->routeIs('admin.settings.*') ? 'on' : '' }}">Settings</a>
        <a href="{{ route('home') }}" target="_blank">View Site &#8599;</a>
    </nav>
    <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button class="btn ghost sm" type="submit">Logout</button>
    </form>
</header>
<main class="wrap">
    @if (session('success'))
        <div class="alert ok">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
