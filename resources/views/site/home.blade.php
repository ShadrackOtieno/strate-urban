@extends('layouts.site')
@section('title', $site['tagline'] ?? 'Kilele Properties')

@section('content')
{{-- Hero --}}
<section class="relative isolate overflow-hidden bg-ink text-white">
    <img src="{{ asset('images/hero.svg') }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover opacity-60">
    <div class="absolute inset-0 -z-10 bg-gradient-to-r from-ink/95 via-ink/70 to-ink/20"></div>
    <div class="mx-auto max-w-7xl px-6 pb-28 pt-16 md:pb-32 md:pt-24">
        <div class="max-w-2xl">
            <div class="gold-rule"></div>
            <h1 class="mt-5 font-serif-d text-3xl font-semibold leading-tight sm:text-4xl lg:text-5xl">{{ $site['hero_title'] ?? 'Property worth holding on to.' }}</h1>
            <p class="mt-5 max-w-xl text-base leading-relaxed text-white/80">{{ $site['hero_text'] ?? '' }}</p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('developments.index') }}" class="inline-flex items-center gap-2 rounded-md bg-gold px-6 py-3 font-semibold text-white hover:brightness-110">Premium developments <x-icon name="arrow-right" :size="16" /></a>
                <a href="{{ route('properties.index') }}" class="inline-flex items-center gap-2 rounded-md border border-white/40 px-6 py-3 font-semibold hover:bg-white/10">Browse all properties</a>
            </div>
        </div>
    </div>
</section>

{{-- Search --}}
<div class="relative z-10 mx-auto -mt-16 max-w-6xl px-6">
    <div class="rounded-lg border border-ink/10 border-t-4 border-t-gold bg-white p-6 shadow-xl md:p-7">
        <h2 class="mb-5 font-serif-d text-lg font-semibold">Find your property</h2>
        @include('partials.search-form')
    </div>
</div>

{{-- Premium apartments --}}
@if ($developments->isNotEmpty())
<section class="py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-6">
        @include('partials.section-title', ['title' => 'Premium Apartments', 'sub' => 'Hotel and residential apartments in prime Nairobi locations, with clear payment plans.'])
        <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">@foreach ($developments as $d)@include('partials.development-card', ['d' => $d])@endforeach</div>
        <div class="mt-8 text-center"><a href="{{ route('developments.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gold hover:underline">View all developments <x-icon name="arrow-right" :size="15" /></a></div>
    </div>
</section>
@endif

{{-- Buy / Rent / Lease --}}
<section class="bg-white py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-6">
        @include('partials.section-title', ['title' => 'Buy, Rent and Lease'])
        <div class="mt-10 grid gap-6 md:grid-cols-3">
            @foreach ([['Buy', 'Apartments, houses and land ready for a new owner.', 'properties.sale', 'p-house-1'], ['Rent', 'Furnished apartments and family homes to move into.', 'properties.rent', 'p-apartment-2'], ['Lease', 'Farmland and plots on flexible terms.', 'properties.land-lease', 'p-land-3']] as [$t, $d, $r, $img])
                <a href="{{ route($r) }}" class="group relative block aspect-[16/9] overflow-hidden rounded-lg bg-ink text-white">
                    <img src="{{ asset('images/sample/'.$img.'.svg') }}" alt="" loading="lazy" class="card-img absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-ink/90 via-ink/30 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-5">
                        <h3 class="font-serif-d text-xl font-semibold">{{ $t }}</h3>
                        <p class="mt-1 text-sm text-white/80">{{ $d }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- New and hot --}}
@if ($hot->isNotEmpty())
<section class="py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-6">
        @include('partials.section-title', ['title' => 'New and Hot', 'sub' => 'The newest and most requested listings.'])
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">@foreach ($hot as $property)@include('partials.property-card', ['property' => $property])@endforeach</div>
        <div class="mt-8 text-center"><a href="{{ route('properties.index', ['sort' => 'newest']) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gold hover:underline">View all properties <x-icon name="arrow-right" :size="15" /></a></div>
    </div>
</section>
@endif

{{-- Category blocks --}}
@foreach ($blocks as $b)
<section class="{{ $loop->odd ? 'bg-white' : '' }} py-14 md:py-16">
    <div class="mx-auto max-w-7xl px-6">
        @include('partials.section-title', ['title' => $b['title']])
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">@foreach ($b['items'] as $property)@include('partials.property-card', ['property' => $property])@endforeach</div>
        <div class="mt-7 text-center"><a href="{{ route($b['route']) }}" class="inline-flex items-center gap-2 rounded-md border border-ink px-6 py-2.5 text-sm font-semibold hover:bg-ink hover:text-white">View all {{ strtolower($b['title']) }}</a></div>
    </div>
</section>
@endforeach

{{-- Locations --}}
@if ($locations->isNotEmpty())
<section class="bg-ink py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-6">
        @include('partials.section-title', ['title' => 'Popular Locations', 'dark' => true])
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($locations as $l)
                <a href="{{ route('locations.show', $l->slug) }}" class="group relative block aspect-[4/3] overflow-hidden rounded-lg">
                    @if ($l->image_url)<img src="{{ $l->image_url }}" alt="" loading="lazy" class="card-img absolute inset-0 h-full w-full object-cover">@endif
                    <div class="absolute inset-0 bg-gradient-to-t from-night via-night/20 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-4 text-white"><h3 class="font-serif-d text-lg font-semibold">{{ $l->name }}</h3><p class="text-xs text-white/70">{{ $l->properties_count }} {{ \Illuminate\Support\Str::plural('property', $l->properties_count) }}</p></div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Services --}}
<section class="py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-6">
        @include('partials.section-title', ['title' => 'How We Help', 'sub' => 'Everything around the sale, from the first viewing to the keys in your hand.'])
        <div class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($services as $s)
                <div class="flex gap-4 rounded-lg border border-ink/10 bg-white p-5">
                    <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-md bg-gold/10 text-gold"><x-icon :name="$s->icon ?: 'home'" :size="22" /></span>
                    <div><h3 class="font-serif-d font-semibold">{{ $s->title }}</h3><p class="mt-1 text-sm text-ink/65">{{ $s->summary }}</p></div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Team --}}
@if ($team->isNotEmpty())
<section class="bg-white py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-6">
        @include('partials.section-title', ['title' => 'Meet Our Team'])
        <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">@foreach ($team as $m)@include('partials.team-card', ['m' => $m])@endforeach</div>
    </div>
</section>
@endif

{{-- Testimonials --}}
@if ($testimonials->isNotEmpty())
<section class="py-16 md:py-20">
    <div class="mx-auto max-w-7xl px-6">
        @include('partials.section-title', ['title' => 'What Clients Say'])
        <div class="mt-10 grid gap-6 md:grid-cols-3">
            @foreach ($testimonials->take(6) as $t)
                <figure class="flex flex-col rounded-lg border border-ink/10 border-t-4 border-t-gold bg-white p-6">
                    <div class="flex gap-0.5 text-gold">@for ($i = 0; $i < $t->rating; $i++)<x-icon name="star" :size="15" />@endfor</div>
                    <blockquote class="mt-3 text-sm leading-relaxed text-ink/80">{{ $t->quote }}</blockquote>
                    <figcaption class="mt-auto pt-4 text-sm"><strong>{{ $t->author_name }}</strong>@if ($t->author_place)<span class="text-ink/60">, {{ $t->author_place }}</span>@endif</figcaption>
                </figure>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- FAQ --}}
@if ($faqs->isNotEmpty())
<section class="bg-white py-16 md:py-20">
    <div class="mx-auto max-w-3xl px-6">
        @include('partials.section-title', ['title' => 'Questions, Answered'])
        <div class="mt-8 divide-y divide-ink/10 rounded-lg border border-ink/10" x-data="{ open: null }">
            @foreach ($faqs as $faq)
                <div>
                    <button type="button" @click="open = open === {{ $faq->id }} ? null : {{ $faq->id }}" :aria-expanded="open === {{ $faq->id }}" class="flex w-full items-center justify-between gap-6 px-5 py-4 text-left text-[15px] font-semibold"><span>{{ $faq->question }}</span><x-icon name="chevron-down" ::class="open === {{ $faq->id }} ? 'rotate-180' : ''" class="shrink-0 text-gold transition" /></button>
                    <div x-show="open === {{ $faq->id }}" x-cloak class="px-5 pb-5 text-sm text-ink/70">{{ $faq->answer }}</div>
                </div>
            @endforeach
        </div>
        <div class="mt-6 text-center"><a href="{{ route('faqs') }}" class="text-sm font-semibold text-gold hover:underline">All FAQs</a></div>
    </div>
</section>
@endif

@include('partials.cta')
@endsection
