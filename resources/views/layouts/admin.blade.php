@php
    $nav = [
        ['admin.dashboard', 'Dashboard', 'layout-dashboard', 'admin'],
        ['admin.properties.index', 'Properties', 'home', 'admin/properties*'],
        ['admin.developments.index', 'Developments', 'building', 'admin/developments*'],
        ['admin.locations.index', 'Locations', 'map-pin', 'admin/locations*'],
        ['admin.enquiries.index', 'Enquiries', 'inbox', 'admin/enquiries*', $badges['enquiries'] ?? 0],
        ['admin.subscribers.index', 'Subscribers', 'mail', 'admin/subscribers*'],
        ['admin.services.index', 'Services', 'layers', 'admin/services*'],
        ['admin.team.index', 'Team', 'users', 'admin/team*'],
        ['admin.testimonials.index', 'Testimonials', 'quote', 'admin/testimonials*'],
        ['admin.faqs.index', 'FAQs', 'file-text', 'admin/faqs*'],
        ['admin.settings.edit', 'Settings', 'settings', 'admin/settings*'],
        ['admin.account.edit', 'My account', 'user', 'admin/account*'],
    ];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>@yield('title', 'Back office') | {{ $site['company_name'] ?? 'Kilele Properties' }}</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', system-ui, sans-serif; }
        .font-display { font-family: 'Poppins', sans-serif; }
        [x-cloak] { display: none !important; }
    </style>
    <script src="https://cdn.tailwindcss.com/3.4.1"></script>
    <script>tailwind.config = { theme: { extend: { colors: { ink: '#383B41', brand: '#D8232A', accent: '#F5B301', mist: '#F1F2F4' } } } };</script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js"></script>
</head>
<body class="bg-mist text-ink antialiased" x-data="{ menu: false }">
<div class="flex min-h-screen">
    <aside :class="menu ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-40 w-64 transform bg-ink text-white transition lg:static lg:translate-x-0">
        <div class="flex h-16 items-center gap-2.5 px-5"><img src="{{ asset('images/logo.svg') }}" alt="" class="h-8 w-8 rounded-md"><span class="font-display text-xl font-bold">{{ $site['company_name'] ?? 'Kilele Properties' }}</span></div>
        <nav class="space-y-1 px-3 py-3" aria-label="Back office">
            @foreach ($nav as $n)
                <a href="{{ route($n[0]) }}" class="flex items-center gap-3 rounded-md px-3 py-2.5 text-sm font-semibold {{ request()->is($n[3]) ? 'bg-brand text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                    <x-icon :name="$n[2]" :size="18" /><span class="flex-1">{{ $n[1] }}</span>
                    @if (!empty($n[4]))<span class="rounded-full bg-accent px-2 py-0.5 text-xs font-bold text-ink">{{ $n[4] }}</span>@endif
                </a>
            @endforeach
        </nav>
        <div class="absolute inset-x-0 bottom-0 space-y-1 border-t border-white/10 p-3">
            <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 rounded-md px-3 py-2.5 text-sm font-semibold text-white/70 hover:bg-white/10"><x-icon name="external-link" :size="18" /> View website</a>
            <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="flex w-full items-center gap-3 rounded-md px-3 py-2.5 text-sm font-semibold text-white/70 hover:bg-white/10"><x-icon name="log-out" :size="18" /> Sign out</button></form>
        </div>
    </aside>
    <div class="min-w-0 flex-1">
        <header class="flex h-16 items-center justify-between border-b border-ink/10 bg-white px-4 lg:px-8">
            <button type="button" class="rounded-md p-2 lg:hidden" @click="menu = !menu" aria-label="Menu"><x-icon name="menu" /></button>
            <h1 class="font-display text-2xl font-bold">@yield('title', 'Back office')</h1>
            <div class="text-sm text-ink/60">{{ auth()->user()->name }}</div>
        </header>
        <main class="p-4 lg:p-8">
            @if (session('success'))<div class="mb-6 flex items-center gap-2 rounded-md bg-green-50 p-4 text-sm font-semibold text-green-800"><x-icon name="check" :size="18" /> {{ session('success') }}</div>@endif
            @if ($errors->any())<div class="mb-6 rounded-md bg-red-50 p-4 text-sm text-red-800"><strong>Please fix the following:</strong><ul class="mt-1 list-disc pl-5">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
            @yield('content')
        </main>
    </div>
</div>
</body>
</html>
