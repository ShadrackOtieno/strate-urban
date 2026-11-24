@extends('layouts.site')
@section('title', 'Property in '.$location->name)
@section('description', $location->description)

@section('content')
@include('partials.page-header', ['title' => 'Property in '.$location->name, 'text' => $location->description, 'image' => $location->image ?: 'images/hero.svg'])
<div class="mx-auto max-w-7xl px-6 py-16">
    @if ($developments->isNotEmpty())
        <h2 class="font-serif-d text-2xl font-semibold">Premium developments in {{ $location->name }}</h2>
        <div class="mt-8 grid gap-6 md:grid-cols-2">@foreach ($developments as $d)<a href="{{ route('developments.show', $d->slug) }}" class="flex items-center justify-between rounded-lg bg-ink p-5 text-white hover:bg-forest"><span><span class="font-serif-d block text-xl font-semibold">{{ $d->name }}</span><span class="text-white/65">{{ $d->tagline }}</span></span><x-icon name="arrow-right" :size="22" class="text-gold" /></a>@endforeach</div>
    @endif

    <h2 class="font-serif-d {{ $developments->isNotEmpty() ? 'mt-16' : '' }} text-2xl font-semibold">Listings</h2>
    @if ($properties->isEmpty())
        <p class="mt-6 rounded-lg border border-ink/10 bg-white p-10 text-center">No listings here right now. <a href="{{ route('contact') }}" class="font-bold underline">Tell us what you need</a> and we will look for you.</p>
    @else
        <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">@foreach ($properties as $property)@include('partials.property-card', ['property' => $property])@endforeach</div>
        <div class="mt-10">{{ $properties->links() }}</div>
    @endif

    <h2 class="font-serif-d mt-16 text-xl font-semibold">Other locations</h2>
    <div class="mt-6 flex flex-wrap gap-3">@foreach ($others as $o)<a href="{{ route('locations.show', $o->slug) }}" class="rounded-md border border-ink/10 bg-white px-5 py-2.5 text-sm font-semibold hover:bg-ink hover:text-white">{{ $o->name }}</a>@endforeach</div>
</div>
@include('partials.cta')
@endsection
