@php
    $hex = fn ($v, $d) => preg_match('/^#[0-9a-fA-F]{6}$/', (string) $v) ? $v : $d;
    $rgb = function ($h) { $h = ltrim($h, '#'); return hexdec(substr($h, 0, 2)).' '.hexdec(substr($h, 2, 2)).' '.hexdec(substr($h, 4, 2)); };
    $ink = $rgb($hex($site['primary_color'] ?? null, '#383B41'));
    $red = $rgb($hex($site['accent_color'] ?? null, '#D8232A'));
    $company = $site['company_name'] ?? 'Kilele Properties';
    $logo = !empty($site['logo']) ? media_url($site['logo']) : asset('images/logo.svg');
    $wa = $site['whatsapp'] ?? '';
    $waText = urlencode('Hello '.$company.', I would like to enquire about a property.');
@endphp
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $company)@hasSection('title') | {{ $company }}@endif</title>
    <meta name="description" content="@yield('description', $site['meta_description'] ?? '')">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --ink: {{ $ink }}; --gold: {{ $red }}; }
        body { font-family: 'Inter', system-ui, sans-serif; }
        .font-serif-d { font-family: 'Poppins', 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        .card-img { transition: transform .5s ease; }
        .group:hover .card-img { transform: scale(1.04); }
        :focus-visible { outline: 3px solid rgb(var(--gold)); outline-offset: 2px; }
        .gold-rule { height: 3px; width: 48px; background: rgb(var(--gold)); }
        @media (prefers-reduced-motion: reduce) { * { transition: none !important; animation: none !important; scroll-behavior: auto !important; } }
    </style>
    <script src="https://cdn.tailwindcss.com/3.4.1"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: {
            ink: 'rgb(var(--ink) / <alpha-value>)',
            gold: 'rgb(var(--gold) / <alpha-value>)',
            redlt: '#FF6B70',
            ivory: '#F7F8FA', sand: '#ECEEF1', night: '#25272B', forest: '#2F3237',
        } } } };
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
    @stack('head')
</head>
<body class="bg-ivory text-ink antialiased" x-data="{ top: false }" @scroll.window="top = window.scrollY > 600">
<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:bg-gold focus:px-4 focus:py-2 font-semibold text-white">Skip to content</a>

{{-- Top bar --}}
<div class="hidden bg-ink text-[13px] text-white/85 lg:block">
    <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-2.5">
        <div class="flex items-center gap-6">
            @if (!empty($site['email']))<a href="mailto:{{ $site['email'] }}" class="inline-flex items-center gap-2 hover:text-white"><x-icon name="mail" :size="15" /> {{ $site['email'] }}</a>@endif
            @if (!empty($site['phone']))<a href="tel:{{ preg_replace('/\s+/', '', $site['phone']) }}" class="inline-flex items-center gap-2 hover:text-white"><x-icon name="phone" :size="15" /> {{ $site['phone'] }}@if (!empty($site['phone2'])) | {{ $site['phone2'] }}@endif</a>@endif
            @if (!empty($site['address']))<span class="inline-flex items-center gap-2"><x-icon name="map-pin" :size="15" /> {{ $site['address'] }}</span>@endif
        </div>
        <div class="flex items-center gap-4">
            @if (!empty($site['hours']))<span class="inline-flex items-center gap-2"><x-icon name="clock" :size="15" /> {{ $site['hours'] }}</span>@endif
            @foreach (['facebook' => 'globe', 'instagram' => 'instagram', 'linkedin' => 'linkedin', 'twitter' => 'twitter'] as $s => $ic)
                @if (!empty($site[$s]))<a href="{{ $site[$s] }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($s) }}" class="hover:text-white"><x-icon :name="$ic" :size="15" /></a>@endif
            @endforeach
        </div>
    </div>
</div>

<header x-data="{ open: false }" class="sticky top-0 z-50 border-b border-ink/10 bg-white text-ink shadow-sm">
    <div class="mx-auto flex h-[68px] max-w-7xl items-center justify-between px-6">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ $logo }}" alt="" class="h-10 w-10 rounded-md">
            <span class="font-serif-d text-lg font-semibold leading-none">{{ $company }}</span>
        </a>

        <nav class="hidden items-center gap-0.5 text-sm font-semibold lg:flex" aria-label="Main">
            <a href="{{ route('home') }}" class="px-3.5 py-2 {{ request()->routeIs('home') ? 'text-gold' : 'text-ink hover:text-gold' }}">Home</a>

            @php
                $menus = [
                    ['label' => 'Premium', 'active' => 'premium*', 'links' => $navDevelopments->map(fn ($d) => [$d->name, route('developments.show', $d->slug)])->prepend(['All premium developments', route('developments.index')])->all()],
                    ['label' => 'For sale', 'active' => 'for-sale|apartments-for-sale|land-for-sale', 'links' => [['Apartments for sale', route('properties.apartments-sale')], ['Land for sale', route('properties.land-sale')], ['All properties for sale', route('properties.sale')]]],
                    ['label' => 'For rent', 'active' => 'for-rent|apartments-for-rent|houses-for-rent|land-for-lease', 'links' => [['Apartments for rent', route('properties.apartments-rent')], ['Houses for rent', route('properties.houses-rent')], ['Land for lease', route('properties.land-lease')], ['All rentals', route('properties.rent')]]],
                    ['label' => 'Locations', 'active' => 'locations*', 'links' => $navLocations->map(fn ($l) => [$l->name, route('locations.show', $l->slug)])->all()],
                ];
            @endphp
            @foreach ($menus as $m)
                <div class="relative" x-data="{ o: false }" @mouseenter="o = true" @mouseleave="o = false" @keydown.escape="o = false">
                    <button type="button" @click="o = !o" :aria-expanded="o" class="inline-flex items-center gap-1 px-3.5 py-2 {{ request()->is(...explode('|', $m['active'])) ? 'text-gold' : 'text-ink hover:text-gold' }}">{{ $m['label'] }} <x-icon name="chevron-down" :size="14" /></button>
                    <div x-show="o" x-cloak x-transition.opacity class="absolute left-0 top-full min-w-[15rem] rounded-b-lg border border-ink/10 border-t-2 border-t-gold bg-white py-2 shadow-xl">
                        @foreach ($m['links'] as [$label, $url])<a href="{{ $url }}" class="block px-5 py-2.5 text-ink hover:bg-ivory hover:text-gold">{{ $label }}</a>@endforeach
                    </div>
                </div>
            @endforeach

            <a href="{{ route('services') }}" class="px-3.5 py-2 {{ request()->routeIs('services') ? 'text-gold' : 'text-ink hover:text-gold' }}">Services</a>
            <div class="relative" x-data="{ o: false }" @mouseenter="o = true" @mouseleave="o = false" @keydown.escape="o = false">
                <button type="button" @click="o = !o" :aria-expanded="o" class="inline-flex items-center gap-1 px-3.5 py-2 {{ request()->is('about|team|faqs') ? 'text-gold' : 'text-ink hover:text-gold' }}">About us <x-icon name="chevron-down" :size="14" /></button>
                <div x-show="o" x-cloak x-transition.opacity class="absolute left-0 top-full min-w-[12rem] rounded-b-lg border border-ink/10 border-t-2 border-t-gold bg-white py-2 shadow-xl">
                    <a href="{{ route('about') }}" class="block px-5 py-2.5 hover:bg-ivory hover:text-gold">About</a>
                    <a href="{{ route('team') }}" class="block px-5 py-2.5 hover:bg-ivory hover:text-gold">Our team</a>
                    <a href="{{ route('faqs') }}" class="block px-5 py-2.5 hover:bg-ivory hover:text-gold">FAQs</a>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="ml-3 rounded-md bg-gold px-5 py-2.5 font-semibold text-white hover:brightness-110">Contact us</a>
        </nav>

        <button type="button" class="p-2 lg:hidden" @click="open = !open" :aria-expanded="open" aria-label="Menu"><x-icon name="menu" x-show="!open" /><x-icon name="x" x-show="open" x-cloak /></button>
    </div>

    <nav x-show="open" x-cloak class="max-h-[80vh] overflow-y-auto border-t border-ink/10 bg-white px-6 py-3 text-sm font-semibold lg:hidden" aria-label="Mobile">
        <a href="{{ route('home') }}" class="block py-3">Home</a>
        <a href="{{ route('developments.index') }}" class="block py-3">Premium developments</a>
        <a href="{{ route('properties.sale') }}" class="block py-3">Properties for sale</a>
        <a href="{{ route('properties.rent') }}" class="block py-3">Properties for rent</a>
        <a href="{{ route('properties.land-lease') }}" class="block py-3">Land for lease</a>
        <a href="{{ route('services') }}" class="block py-3">Services</a>
        <a href="{{ route('about') }}" class="block py-3">About</a>
        <a href="{{ route('team') }}" class="block py-3">Our team</a>
        <a href="{{ route('faqs') }}" class="block py-3">FAQs</a>
        <a href="{{ route('contact') }}" class="mt-2 block rounded-md bg-gold py-3 text-center text-white">Contact us</a>
    </nav>
</header>

@if (session('success'))
    <div class="bg-gold text-white" role="status"><div class="mx-auto flex max-w-7xl items-center gap-2 px-6 py-3 text-sm font-semibold"><x-icon name="check" :size="18" /> {{ session('success') }}</div></div>
@endif

<main id="main">@yield('content')</main>

<footer class="bg-night text-white/75">
    <div class="border-b border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-5 px-6 py-10 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="font-serif-d text-xl font-semibold text-white">New listings, in your inbox</h2>
                <p class="mt-1 text-sm text-white/60">One short email when something good comes up. Unsubscribe any time.</p>
            </div>
            <form method="POST" action="{{ route('newsletter.store') }}" class="flex w-full max-w-md">
                @csrf
                <div class="hidden" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
                <label for="nl_email" class="sr-only">Email</label>
                <input id="nl_email" type="email" name="email" required placeholder="Your email address" class="min-w-0 flex-1 rounded-l-md border-0 bg-white/10 px-4 py-3 text-white placeholder-white/40 focus:bg-white/15 focus:outline-none">
                <button class="rounded-r-md bg-gold px-6 font-semibold text-white hover:brightness-110">Subscribe</button>
            </form>
        </div>
    </div>
    <div class="mx-auto grid max-w-7xl gap-10 px-6 py-12 sm:grid-cols-2 lg:grid-cols-4">
        <div>
            <div class="flex items-center gap-3"><img src="{{ $logo }}" alt="" class="h-10 w-10 rounded-md"><span class="font-serif-d text-lg font-semibold text-white">{{ $company }}</span></div>
            <p class="mt-4 text-sm leading-relaxed text-white/60">{{ $site['tagline'] ?? '' }}. Buy, rent, lease and invest with a team that explains every step.</p>
        </div>
        <div>
            <h3 class="font-serif-d font-semibold text-white">Explore</h3>
            <ul class="mt-4 space-y-2.5 text-sm">
                <li><a class="hover:text-white" href="{{ route('developments.index') }}">Premium developments</a></li>
                <li><a class="hover:text-white" href="{{ route('properties.apartments-sale') }}">Apartments for sale</a></li>
                <li><a class="hover:text-white" href="{{ route('properties.apartments-rent') }}">Apartments for rent</a></li>
                <li><a class="hover:text-white" href="{{ route('properties.houses-rent') }}">Houses for rent</a></li>
                <li><a class="hover:text-white" href="{{ route('properties.land-sale') }}">Land for sale</a></li>
                <li><a class="hover:text-white" href="{{ route('properties.land-lease') }}">Land for lease</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-serif-d font-semibold text-white">Company</h3>
            <ul class="mt-4 space-y-2.5 text-sm">
                <li><a class="hover:text-white" href="{{ route('about') }}">About us</a></li>
                <li><a class="hover:text-white" href="{{ route('services') }}">Services</a></li>
                <li><a class="hover:text-white" href="{{ route('team') }}">Our team</a></li>
                <li><a class="hover:text-white" href="{{ route('faqs') }}">FAQs</a></li>
                <li><a class="hover:text-white" href="{{ route('contact') }}">Contact</a></li>
            </ul>
        </div>
        <div>
            <h3 class="font-serif-d font-semibold text-white">Visit or call</h3>
            <ul class="mt-4 space-y-3 text-sm">
                @if (!empty($site['address']))<li class="flex gap-2.5"><x-icon name="map-pin" :size="16" class="mt-0.5 text-redlt" />{{ $site['address'] }}</li>@endif
                @if (!empty($site['phone']))<li class="flex gap-2.5"><x-icon name="phone" :size="16" class="mt-0.5 text-redlt" />{{ $site['phone'] }}@if (!empty($site['phone2'])), {{ $site['phone2'] }}@endif</li>@endif
                @if (!empty($site['email']))<li class="flex gap-2.5"><x-icon name="mail" :size="16" class="mt-0.5 text-redlt" /><a class="hover:text-white" href="mailto:{{ $site['email'] }}">{{ $site['email'] }}</a></li>@endif
                @if (!empty($site['hours']))<li class="flex gap-2.5"><x-icon name="clock" :size="16" class="mt-0.5 text-redlt" />{{ $site['hours'] }}</li>@endif
            </ul>
        </div>
    </div>
    <div class="border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-2 px-6 py-5 text-xs text-white/50 sm:flex-row sm:justify-between">
            <span>&copy; {{ date('Y') }} {{ $company }}. All rights reserved.</span>
            <span class="flex gap-5"><a class="hover:text-white" href="{{ route('privacy') }}">Privacy policy</a><a class="hover:text-white" href="{{ route('terms') }}">Terms and conditions</a></span>
        </div>
    </div>
</footer>

@if ($wa)
<a href="https://wa.me/{{ $wa }}?text={{ $waText }}" target="_blank" rel="noopener" aria-label="Chat on WhatsApp" class="fixed bottom-5 right-5 z-40 flex h-14 w-14 items-center justify-center rounded-full bg-[#25D366] text-white shadow-xl hover:scale-105"><x-icon name="message-circle" :size="26" /></a>
@endif
<button type="button" x-show="top" x-cloak @click="window.scrollTo({ top: 0, behavior: 'smooth' })" aria-label="Back to top" class="fixed bottom-5 left-5 z-40 flex h-10 w-10 items-center justify-center rounded-md bg-gold text-white shadow-xl"><x-icon name="arrow-up" :size="20" /></button>
@stack('scripts')
</body>
</html>
