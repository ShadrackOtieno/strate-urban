@extends('layouts.site')
@section('title', 'Premium developments')
@section('description', 'Hotel and residential apartments in prime locations, with clear payment plans.')

@section('content')
@include('partials.page-header', ['title' => 'Premium Developments', 'text' => 'Hotel and residential apartments in prime locations, with clear payment plans and honest numbers.'])
<div class="mx-auto max-w-7xl px-6 py-14">
    @if ($developments->isEmpty())
        <p class="rounded-lg border border-ink/10 bg-white p-12 text-center">Developments will appear here once they are added in the back office.</p>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">@foreach ($developments as $d)@include('partials.development-card', ['d' => $d])@endforeach</div>
    @endif
</div>
@include('partials.cta')
@endsection
