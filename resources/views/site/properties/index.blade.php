@extends('layouts.site')
@section('title', $heading)
@section('description', 'Browse '.strtolower($heading).' in Kenya.')

@section('content')
@include('partials.page-header', ['title' => $heading, 'text' => $properties->total().' '.\Illuminate\Support\Str::plural('property', $properties->total()).' match your search.'])

<div class="mx-auto max-w-7xl px-6 py-14" x-data="{ filters: false }">
    <div class="mb-8 flex items-center justify-between gap-4 lg:hidden">
        <button type="button" @click="filters = !filters" class="inline-flex items-center gap-2 rounded-md border border-ink px-5 py-3 font-semibold"><x-icon name="sliders" :size="18" /> Filters</button>
    </div>
    <div class="grid gap-10 lg:grid-cols-4">
        <aside class="lg:col-span-1" :class="filters ? '' : 'hidden lg:block'">
            <form method="GET" action="{{ route('properties.index') }}" class="space-y-4 rounded-lg border border-ink/10 bg-white p-5 lg:sticky lg:top-28">
                @php $in = 'mt-1 w-full rounded-md border border-ink/25 bg-white px-3 py-2.5 focus:border-ink focus:outline-none focus:ring-2 focus:ring-gold'; @endphp
                <div><label for="q" class="text-sm font-bold">Keyword</label><input id="q" type="search" name="q" value="{{ $f['q'] }}" placeholder="Area, name or feature" class="{{ $in }}"></div>
                <div><label for="purpose" class="text-sm font-bold">For</label><select id="purpose" name="purpose" class="{{ $in }}"><option value="">Sale, rent or lease</option>@foreach (\App\Models\Property::PURPOSES as $k => $l)<option value="{{ $k }}" @selected($f['purpose'] === $k)>{{ $l }}</option>@endforeach</select></div>
                <div><label for="type" class="text-sm font-bold">Type</label><select id="type" name="type" class="{{ $in }}"><option value="">Any type</option>@foreach (\App\Models\Property::TYPES as $k => $l)<option value="{{ $k }}" @selected($f['type'] === $k)>{{ $l }}</option>@endforeach</select></div>
                <div><label for="location" class="text-sm font-bold">Location</label><select id="location" name="location" class="{{ $in }}"><option value="">Anywhere</option>@foreach ($locations as $l)<option value="{{ $l->slug }}" @selected($f['location'] === $l->slug)>{{ $l->name }}</option>@endforeach</select></div>
                <div class="grid grid-cols-2 gap-3">
                    <div><label for="min" class="text-sm font-bold">Min KSh</label><input id="min" type="number" min="0" step="50000" name="min" value="{{ $f['min'] ?: '' }}" class="{{ $in }}"></div>
                    <div><label for="max" class="text-sm font-bold">Max KSh</label><input id="max" type="number" min="0" step="50000" name="max" value="{{ $f['max'] ?: '' }}" class="{{ $in }}"></div>
                </div>
                <div><label for="beds" class="text-sm font-bold">Bedrooms</label><select id="beds" name="beds" class="{{ $in }}"><option value="">Any</option>@foreach ([1, 2, 3, 4, 5] as $n)<option value="{{ $n }}" @selected($f['beds'] === $n)>{{ $n }}+</option>@endforeach</select></div>
                <div><label for="sort" class="text-sm font-bold">Sort by</label><select id="sort" name="sort" class="{{ $in }}">@foreach (['' => 'Featured first', 'newest' => 'Newest', 'price_asc' => 'Price: low to high', 'price_desc' => 'Price: high to low'] as $k => $l)<option value="{{ $k }}" @selected($f['sort'] === $k)>{{ $l }}</option>@endforeach</select></div>
                <button class="inline-flex w-full items-center justify-center gap-2 rounded-md bg-gold px-5 py-3 font-semibold text-white hover:brightness-110"><x-icon name="search" :size="18" /> Apply filters</button>
                <a href="{{ route('properties.index') }}" class="block text-center text-sm font-semibold underline">Clear all</a>
            </form>
        </aside>

        <div class="lg:col-span-3">
            @if ($properties->isEmpty())
                <div class="rounded-lg border border-ink/10 bg-white p-12 text-center">
                    <p class="font-serif-d text-xl font-semibold">No properties match those filters.</p>
                    <p class="mt-2 text-ink/70">Try widening the price range or removing a filter, or tell us what you need.</p>
                    <div class="mt-6 flex flex-wrap justify-center gap-3"><a href="{{ route('properties.index') }}" class="bg-ink px-6 py-3 font-bold text-white">Clear filters</a><a href="{{ route('contact') }}" class="border border-ink px-6 py-3 font-bold">Ask a consultant</a></div>
                </div>
            @else
                <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">@foreach ($properties as $property)@include('partials.property-card', ['property' => $property])@endforeach</div>
                <div class="mt-12">{{ $properties->links() }}</div>
            @endif
        </div>
    </div>
</div>
@include('partials.cta')
@endsection
