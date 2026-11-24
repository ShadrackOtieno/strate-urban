@extends('layouts.site')
@section('title', 'Services')
@section('description', 'Sales, rentals, investment advice, land due diligence and property management.')

@section('content')
@include('partials.page-header', ['title' => 'Our services', 'text' => 'Everything around the sale, from the first viewing to the keys in your hand.'])
<div class="mx-auto max-w-7xl px-6 py-14">
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($services as $s)
            <div class="rounded-lg border border-ink/10 bg-white p-6">
                <span class="flex h-11 w-11 items-center justify-center rounded-md bg-gold/10 text-gold"><x-icon :name="$s->icon ?: 'home'" :size="26" /></span>
                <h2 class="font-serif-d mt-4 text-lg font-semibold">{{ $s->title }}</h2>
                <p class="mt-2 text-sm text-ink/70">{{ $s->summary }}</p>
                @if ($s->body)<p class="mt-3 text-sm text-ink/65">{{ $s->body }}</p>@endif
            </div>
        @endforeach
    </div>
</div>
@include('partials.cta')
@endsection
