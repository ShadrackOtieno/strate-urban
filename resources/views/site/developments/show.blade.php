@extends('layouts.site')
@section('title', $development->name)
@section('description', $development->summary)

@section('content')
@php
    $steps = $development->lines('how_it_works') ?: ['Reserve your unit with a small booking fee', 'Sign the sale agreement and pay the agreed deposit', 'Pay the balance in monthly instalments', 'Receive your unit on completion and handover'];
@endphp
<section class="relative isolate overflow-hidden bg-night text-white">
    @if ($development->cover_url)<img src="{{ $development->cover_url }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover">@endif
    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-night via-night/60 to-night/20"></div>
    <div class="mx-auto max-w-7xl px-6 pb-12 pt-32 md:pt-44">
        <span class="inline-block rounded bg-gold px-3 py-1.5 text-xs font-semibold text-white">{{ $development->status_label }}</span>
        <h1 class="font-serif-d mt-5 max-w-4xl text-3xl font-semibold leading-[1.02] md:text-4xl">{{ $development->name }}</h1>
        @if ($development->tagline)<p class="mt-4 text-xl text-white/80">{{ $development->tagline }}</p>@endif
        <p class="mt-4 inline-flex items-center gap-2 text-white/70"><x-icon name="map-pin" :size="18" /> {{ $development->address ?: $development->location?->name }}</p>
    </div>
</section>

<div class="mx-auto grid max-w-7xl gap-14 px-6 py-20 lg:grid-cols-3">
    <div class="space-y-16 lg:col-span-2">
        @if ($development->body)
            <section><div class="space-y-4 text-lg leading-relaxed text-ink/80">@foreach (preg_split('/\R{2,}/', trim($development->body)) as $para)<p>{{ $para }}</p>@endforeach</div></section>
        @endif

        @if (count($development->lines('highlights')))
            <section>
                <h2 class="font-serif-d text-2xl font-semibold">Highlights</h2>
                <ul class="mt-6 grid gap-4 sm:grid-cols-2">@foreach ($development->lines('highlights') as $h)<li class="flex gap-3 rounded-lg border border-ink/10 bg-white p-4"><span class="flex h-7 w-7 shrink-0 items-center justify-center bg-ink text-redlt"><x-icon name="check" :size="16" /></span>{{ $h }}</li>@endforeach</ul>
            </section>
        @endif

        @if (count($development->unitTypeList()))
            <section>
                <h2 class="font-serif-d text-2xl font-semibold">Unit types and prices</h2>
                <div class="mt-6 divide-y divide-ink/15 border-y border-ink/15">@foreach ($development->unitTypeList() as [$u, $p])<div class="flex items-center justify-between gap-4 py-5"><span class="font-serif-d text-lg font-semibold">{{ $u }}</span><span class="text-lg font-semibold">{{ $p }}</span></div>@endforeach</div>
            </section>
        @endif

        <section class="rounded-lg bg-ink p-7 text-white md:p-10">
            <h2 class="font-serif-d text-2xl font-semibold">How do I invest?</h2>
            <ol class="mt-8 grid gap-6 sm:grid-cols-2">@foreach ($steps as $n => $step)<li class="border-t-2 border-gold pt-4"><span class="font-serif-d text-xl text-gold">{{ $n + 1 }}</span><p class="mt-2 text-white/85">{{ $step }}</p></li>@endforeach</ol>
            @if ($development->investment_note)<p class="mt-8 border-t border-white/15 pt-5 text-sm text-white/60">{{ $development->investment_note }}</p>@endif
        </section>

        @if ($units->isNotEmpty())
            <section>
                <h2 class="font-serif-d text-2xl font-semibold">Available units</h2>
                <div class="mt-6 grid gap-5 sm:grid-cols-2">@foreach ($units as $property)@include('partials.property-card', ['property' => $property])@endforeach</div>
            </section>
        @endif
    </div>

    <aside>
        <div class="rounded-lg bg-ink p-6 text-white lg:sticky lg:top-28">
            <h2 class="font-serif-d text-xl font-semibold">Reserve or ask a question</h2>
            <p class="mt-1 text-sm text-white/60">A consultant will call you within one working day.</p>
            <div class="mt-6">@include('partials.enquiry-form', ['development' => $development, 'interest' => 'invest', 'dark' => true, 'id' => 'enquiry'])</div>
        </div>
    </aside>
</div>

@if ($others->isNotEmpty())
<section class="bg-white py-14"><div class="mx-auto max-w-7xl px-6">
    <h2 class="font-serif-d text-2xl font-semibold">Other developments</h2>
    <div class="mt-8 grid gap-6 md:grid-cols-2">@foreach ($others as $o)<a href="{{ route('developments.show', $o->slug) }}" class="group flex items-center justify-between rounded-lg border border-ink/10 bg-ivory p-5 hover:bg-ink hover:text-white"><span><span class="font-serif-d block text-lg font-semibold">{{ $o->name }}</span><span class="text-sm opacity-70">{{ $o->tagline }}</span></span><x-icon name="arrow-right" :size="20" /></a>@endforeach</div>
</div></section>
@endif
@endsection
