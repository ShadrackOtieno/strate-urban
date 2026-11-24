@extends('layouts.site')
@section('title', 'About us')

@section('content')
@include('partials.page-header', ['title' => 'About '.($site['company_name'] ?? 'us'), 'text' => $site['mission'] ?? null])
<div class="mx-auto grid max-w-7xl gap-16 px-6 py-20 lg:grid-cols-2">
    <div class="space-y-5 text-lg leading-relaxed text-ink/80">@foreach (preg_split('/\R{2,}/', trim($site['about_intro'] ?? '')) as $para)@if ($para)<p>{{ $para }}</p>@endif @endforeach</div>
    <div>
        <h2 class="font-serif-d text-2xl font-semibold">Our promises</h2>
        <ul class="mt-6 space-y-6">
            @foreach (array_filter(array_map('trim', preg_split('/\R/', $site['values'] ?? ''))) as $line)
                @php [$t, $d] = array_pad(explode(':', $line, 2), 2, ''); @endphp
                <li class="border-l-4 border-gold pl-5"><h3 class="font-serif-d text-lg font-semibold">{{ trim($t) }}</h3>@if (trim($d))<p class="mt-1 text-ink/70">{{ trim($d) }}</p>@endif</li>
            @endforeach
        </ul>
    </div>
</div>
@if ($team->isNotEmpty())
<section class="bg-white py-16"><div class="mx-auto max-w-7xl px-6">
    <div class="flex items-end justify-between"><h2 class="font-serif-d text-2xl font-semibold md:text-3xl">Our team</h2><a href="{{ route('team') }}" class="font-bold hover:underline">Meet everyone</a></div>
    <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">@foreach ($team as $m)@include('partials.team-card', ['m' => $m])@endforeach</div>
</div></section>
@endif
@if ($testimonials->isNotEmpty())
<section class="bg-ink py-16 text-white"><div class="mx-auto max-w-7xl px-6">
    <h2 class="font-serif-d text-2xl font-semibold md:text-3xl">What clients say</h2>
    <div class="mt-10 grid gap-8 md:grid-cols-2">@foreach ($testimonials->take(4) as $t)<figure class="rounded-lg border-t-4 border-gold bg-night p-6"><blockquote class="font-serif-d text-lg leading-snug">{{ $t->quote }}</blockquote><figcaption class="mt-4 text-sm text-white/70"><strong class="text-white">{{ $t->author_name }}</strong>@if ($t->author_place), {{ $t->author_place }}@endif</figcaption></figure>@endforeach</div>
</div></section>
@endif
@include('partials.cta')
@endsection
