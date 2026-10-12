@extends('layouts.app')

@section('content')

@php
    $heroItems = $products->count() ? $products : collect([(object) [
        'name' => 'Leather Aura', 'headline1' => 'HANDCRAFTED', 'headline2' => 'LEATHER.',
        'description' => config('site.tagline'), 'image_url' => null, 'ghost' => 'LEATHER',
    ]]);
@endphp

{{-- HERO SLIDER --}}
<section class="hero" id="home">
    <div class="hero-slides">
        @foreach ($heroItems as $i => $p)
            <article class="slide {{ $i === 0 ? 'is-active' : '' }}" data-index="{{ $i }}">
                <div class="slide-text">
                    <span class="eyebrow">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }} / {{ strtoupper($p->name) }}</span>
                    <h1>
                        <span class="line"><span>{{ $p->headline1 }}</span></span>
                        @if ($p->headline2)
                            <span class="line accent"><span>{{ $p->headline2 }}</span></span>
                        @endif
                    </h1>
                    <p class="fade">{{ $p->description }}</p>
                    <a href="#contact" class="btn fade" data-product="{{ $p->name }}">Request a Quote</a>
                </div>
                <div class="slide-visual">
                    <div class="glow"></div>
                    <div class="visual-card leather-tex">
                        @if ($p->image_url)
                            <img src="{{ $p->image_url }}" alt="{{ $p->name }}" onerror="this.remove()">
                        @endif
                        <span class="ghost">{{ $p->ghost }}</span>
                    </div>
                </div>
            </article>
        @endforeach
    </div>

    <div class="hero-ui">
        <div class="hero-count"><b id="curNum">01</b> / {{ str_pad($heroItems->count(), 2, '0', STR_PAD_LEFT) }}</div>
        <div class="hero-bars">
            @foreach ($heroItems as $i => $p)
                <button type="button" class="bar {{ $i === 0 ? 'is-active' : '' }}" data-go="{{ $i }}" aria-label="{{ $p->name }}"><i></i></button>
            @endforeach
        </div>
        <div class="hero-scroll">SCROLL TO EXPLORE</div>
    </div>
</section>

@if ($products->count())
{{-- MARQUEE --}}
<section class="marquee" aria-hidden="true">
    <div class="marquee-track">
        @for ($k = 0; $k < 2; $k++)
            @foreach ($products as $p)
                <span>{{ strtoupper($p->name) }}</span><em>&#9670;</em>
            @endforeach
        @endfor
    </div>
</section>

{{-- PRODUCT RANGE --}}
<section class="section" id="products">
    <div class="head reveal">
        <span class="eyebrow">THE COLLECTION / SIALKOT MADE</span>
        <h2>PRODUCT<br><span class="accent">RANGE.</span></h2>
    </div>
    <div class="grid">
        @foreach ($products as $i => $p)
            <a href="#contact" class="card reveal tilt" data-product="{{ $p->name }}">
                <div class="card-img leather-tex">
                    @if ($p->image_url)
                        <img src="{{ $p->image_url }}" alt="{{ $p->name }}" loading="lazy" onerror="this.remove()">
                    @endif
                    <span class="ghost">{{ $p->ghost }}</span>
                </div>
                <div class="card-body">
                    <small>{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</small>
                    <h3>{{ $p->name }}</h3>
                    <span class="arrow">&rarr;</span>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

{{-- PROCESS --}}
<section class="section split" id="process">
    <div class="head sticky reveal">
        <span class="eyebrow">FROM HIDE TO HERITAGE</span>
        <h2>HOW IT<br><span class="accent">COMES TO LIFE.</span></h2>
        <p>A clear path from your idea to a finished leather piece.</p>
    </div>
    <ol class="steps">
        @foreach ([
            ['Send Your Inquiry', 'Tell us the product, quantity and any reference pictures or designs.'],
            ['Confirm Quote & Specs', 'We confirm leather type, colour, hardware, sizing and pricing.'],
            ['Approve The Sample', 'Review the sample and approve the details before production begins.'],
            ['Craft & Deliver', 'Your order is cut, stitched, finished and shipped from Sialkot.'],
        ] as $n => $s)
            <li class="step reveal">
                <span class="num">{{ str_pad($n + 1, 2, '0', STR_PAD_LEFT) }}</span>
                <h3>{{ $s[0] }}</h3>
                <p>{{ $s[1] }}</p>
            </li>
        @endforeach
    </ol>
</section>

{{-- FAQ --}}
<section class="section split" id="faq">
    <div class="head sticky reveal">
        <span class="eyebrow">QUICK ANSWERS</span>
        <h2>THE<br><span class="accent">DETAILS.</span></h2>
    </div>
    <div class="faq">
        @foreach ([
            ['What leather do you use?', 'We work with quality genuine leather. Tell us your preference and we will recommend the best option for each product.'],
            ['Can I order custom designs?', 'Yes. Share your reference images or design and we will quote and sample it.'],
            ['Do you take bulk orders?', 'Yes, retail and bulk orders are both welcome. Share your quantity in the inquiry form.'],
            ['Do you deliver across Pakistan?', 'Yes. We ship from Sialkot to cities across Pakistan.'],
            ['How are prices decided?', 'Pricing depends on the product, leather, size and quantity. Send an inquiry for an exact quote.'],
        ] as $f)
            <div class="faq-item reveal">
                <button type="button" class="faq-q">{{ $f[0] }}<i></i></button>
                <div class="faq-a"><p>{{ $f[1] }}</p></div>
            </div>
        @endforeach
    </div>
</section>

{{-- CONTACT --}}
<section class="section contact" id="contact">
    <div class="contact-left reveal">
        <span class="eyebrow">YOUR NEXT PIECE STARTS HERE</span>
        <h2>TELL US<br><span class="accent">WHAT'S NEXT.</span></h2>
        <ul class="info">
            <li><small>ADDRESS</small>{{ $site['address'] }}</li>
            <li><small>PHONE</small><a href="tel:{{ preg_replace('/\s+/', '', $site['phone']) }}">{{ $site['phone'] }}</a></li>
            <li><small>EMAIL</small><a href="mailto:{{ $site['email'] }}">{{ $site['email'] }}</a></li>
        </ul>
    </div>

    <form class="form reveal" method="POST" action="{{ route('inquiry') }}">
        @csrf
        @if (session('success'))
            <div class="alert ok">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert err">Please fix the highlighted fields and try again.</div>
        @endif

        <label>Your Name
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')<em>{{ $message }}</em>@enderror
        </label>
        <label>Phone / WhatsApp
            <input type="text" name="phone" value="{{ old('phone') }}" required>
            @error('phone')<em>{{ $message }}</em>@enderror
        </label>
        <label>Email (optional)
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')<em>{{ $message }}</em>@enderror
        </label>
        <label>Product
            <select name="product" id="productSelect">
                @forelse ($products as $p)
                    <option value="{{ $p->name }}" @selected(old('product') === $p->name)>{{ $p->name }}</option>
                @empty
                    <option value="General inquiry">General inquiry</option>
                @endforelse
            </select>
        </label>
        <label>Estimated Quantity
            <input type="text" name="quantity" value="{{ old('quantity') }}" placeholder="e.g. 1, 50, 200">
        </label>
        <label class="full">Project Details
            <textarea name="message" rows="4" placeholder="Size, colour, design, reference link...">{{ old('message') }}</textarea>
        </label>
        <button type="submit" class="btn full">Send Inquiry</button>
    </form>
</section>

@endsection
