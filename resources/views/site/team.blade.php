@extends('layouts.site')
@section('title', 'Our team')

@section('content')
@include('partials.page-header', ['title' => 'Meet our team', 'text' => 'The people who will walk you through every step.'])
<div class="mx-auto max-w-7xl px-6 py-20">
    @if ($team->isEmpty())
        <p class="rounded-lg border border-ink/10 bg-white p-12 text-center">Team profiles will appear here once they are added in the back office.</p>
    @else
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">@foreach ($team as $m)@include('partials.team-card', ['m' => $m])@endforeach</div>
    @endif
</div>
@include('partials.cta')
@endsection
