@extends('layouts.site')
@section('title', $property->title)
@section('description', $property->short_description)

@section('content')
@php
    $gallery = collect([$property->cover_url])->merge($property->images->map(fn ($i) => media_url($i->path)))->filter()->values();
    $waMsg = urlencode('Hello, I am interested in "'.$property->title.'" ('.$property->price_label.'). '.url()->current());
@endphp
<div class="mx-auto max-w-7xl px-6 pt-8">
    <nav class="text-sm text-ink/60" aria-label="Breadcrumb"><a href="{{ route('home') }}" class="hover:text-ink">Home</a> / <a href="{{ route('properties.index') }}" class="hover:text-ink">Properties</a> / <span class="text-ink">{{ $property->title }}</span></nav>
</div>

<div class="mx-auto grid max-w-7xl gap-12 px-6 py-8 lg:grid-cols-3">
    <div class="lg:col-span-2">
        <div x-data="{ i: 0, imgs: @js($gallery) }">
            <div class="relative aspect-[3/2] overflow-hidden rounded-lg bg-sand">
                <template x-if="imgs.length"><img :src="imgs[i]" alt="{{ $property->title }}" class="h-full w-full object-cover"></template>
                <span class="absolute left-4 top-4 rounded bg-gold px-3 py-1.5 text-xs font-semibold text-white">{{ $property->purpose_label }}</span>
                @if ($property->status !== 'available')<span class="absolute right-4 top-4 rounded bg-ink px-3 py-1.5 text-xs font-semibold text-white">{{ $property->status_label }}</span>@endif
                <template x-if="imgs.length > 1">
                    <div><button type="button" @click="i = (i - 1 + imgs.length) % imgs.length" class="absolute left-3 top-1/2 -translate-y-1/2 bg-night/70 p-3 text-white hover:bg-night" aria-label="Previous"><x-icon name="arrow-left" :size="20" /></button>
                    <button type="button" @click="i = (i + 1) % imgs.length" class="absolute right-3 top-1/2 -translate-y-1/2 bg-night/70 p-3 text-white hover:bg-night" aria-label="Next"><x-icon name="arrow-right" :size="20" /></button></div>
                </template>
            </div>
            @if ($gallery->count() > 1)
                <div class="mt-3 grid grid-cols-5 gap-3">@foreach ($gallery as $k => $src)<button type="button" @click="i = {{ $k }}" :class="i === {{ $k }} ? 'ring-4 ring-gold' : 'opacity-70 hover:opacity-100'" class="aspect-[3/2] overflow-hidden"><img src="{{ $src }}" alt="" class="h-full w-full object-cover"></button>@endforeach</div>
            @endif
        </div>

        <h1 class="font-serif-d mt-10 text-2xl font-semibold md:text-3xl">{{ $property->title }}</h1>
        <p class="mt-3 inline-flex items-center gap-2 text-ink/70"><x-icon name="map-pin" :size="18" /> {{ $property->address ?: ($property->location?->name ?? 'Kenya') }}</p>

        <dl class="mt-8 grid grid-cols-2 gap-px bg-ink/15 sm:grid-cols-4">
            @foreach ([['Type', $property->type_label], ['Bedrooms', $property->bedrooms === null ? null : ($property->bedrooms == 0 ? 'Studio' : $property->bedrooms)], ['Bathrooms', $property->bathrooms], ['Size', $property->size_label]] as [$k, $v])
                @if ($v !== null && $v !== '')<div class="bg-ivory p-5"><dt class="text-sm text-ink/60">{{ $k }}</dt><dd class="font-serif-d mt-1 text-lg font-semibold">{{ $v }}</dd></div>@endif
            @endforeach
        </dl>

        @if ($property->description)
            <h2 class="font-serif-d mt-12 text-xl font-semibold">About this property</h2>
            <div class="mt-4 space-y-4 text-lg leading-relaxed text-ink/80">@foreach (preg_split('/\R{2,}/', trim($property->description)) as $para)<p>{{ $para }}</p>@endforeach</div>
        @endif

        @if (count($property->featureList()))
            <h2 class="font-serif-d mt-12 text-xl font-semibold">Features</h2>
            <ul class="mt-5 grid gap-3 sm:grid-cols-2">@foreach ($property->featureList() as $ft)<li class="flex gap-3"><span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center bg-ink text-redlt"><x-icon name="check" :size="14" /></span>{{ $ft }}</li>@endforeach</ul>
        @endif

        @if ($property->development)
            <a href="{{ route('developments.show', $property->development->slug) }}" class="mt-10 flex items-center justify-between rounded-lg bg-ink p-5 text-white hover:bg-forest"><span><span class="text-sm text-white/60">Part of</span><span class="font-serif-d block text-lg font-semibold">{{ $property->development->name }}</span></span><x-icon name="arrow-right" :size="22" class="text-gold" /></a>
        @endif
    </div>

    <aside>
        <div class="space-y-6 lg:sticky lg:top-28">
            <div class="rounded-lg bg-ink p-6 text-white">
                <p class="text-sm text-white/60">Price</p>
                <p class="font-serif-d text-2xl font-semibold">{{ $property->price_label }}</p>
                @if ($wa = ($site['whatsapp'] ?? ''))<a href="https://wa.me/{{ $wa }}?text={{ $waMsg }}" target="_blank" rel="noopener" class="mt-5 flex items-center justify-center gap-2 rounded-md bg-[#25D366] px-5 py-3 font-semibold text-white hover:brightness-95"><x-icon name="message-circle" :size="18" /> Enquire on WhatsApp</a>@endif
                @if (!empty($site['phone']))<a href="tel:{{ preg_replace('/\s+/', '', $site['phone']) }}" class="mt-3 flex items-center justify-center gap-2 rounded-md border border-white/40 px-5 py-3 font-semibold hover:bg-white/10"><x-icon name="phone" :size="18" /> {{ $site['phone'] }}</a>@endif
            </div>
            <div class="rounded-lg border border-ink/10 bg-white p-6">
                <h2 class="font-serif-d text-lg font-semibold">Book a viewing or ask a question</h2>
                <div class="mt-5">@include('partials.enquiry-form', ['property' => $property, 'interest' => $property->purpose === 'sale' ? 'buy' : 'viewing', 'id' => 'enquiry'])</div>
            </div>
        </div>
    </aside>
</div>

@if ($related->isNotEmpty())
<section class="bg-white py-14">
    <div class="mx-auto max-w-7xl px-6">
        <h2 class="font-serif-d text-2xl font-semibold">Similar properties</h2>
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">@foreach ($related as $rel)@include('partials.property-card', ['property' => $rel])@endforeach</div>
    </div>
</section>
@endif
@endsection
