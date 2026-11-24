@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    @foreach ([['New enquiries', $newEnquiries, 'inbox', 'admin.enquiries.index'], ['Properties (all)', $propertyCount, 'home', 'admin.properties.index'], ['Live on website', $liveCount, 'globe', 'admin.properties.index'], ['Subscribers', $subscriberCount, 'mail', 'admin.subscribers.index']] as [$label, $val, $ic, $r])
        <a href="{{ route($r) }}" class="rounded-md bg-white p-5 hover:shadow-md"><div class="flex items-center justify-between text-ink/60"><span class="text-sm font-semibold">{{ $label }}</span><x-icon :name="$ic" :size="18" /></div><div class="font-display mt-2 text-4xl font-bold">{{ $val }}</div></a>
    @endforeach
</div>

@if ($demoCount > 0 || $hiddenTestimonials > 0)
<div class="mt-6 flex gap-3 rounded-md bg-accent/30 p-5 text-sm">
    <x-icon name="alert-triangle" :size="20" class="mt-0.5" />
    <div>
        @if ($demoCount > 0)<p><strong>{{ $demoCount }} sample listing{{ $demoCount > 1 ? 's' : '' }}</strong> (marked "sample") {{ $demoCount > 1 ? 'are' : 'is' }} live on your website. <a href="{{ route('admin.properties.index', ['q' => 'sample']) }}" class="font-bold underline">Replace them with real listings.</a></p>@endif
        @if ($hiddenTestimonials > 0)<p class="mt-1">{{ $hiddenTestimonials }} testimonial{{ $hiddenTestimonials > 1 ? 's are' : ' is' }} hidden. Edit and show only real client quotes.</p>@endif
    </div>
</div>
@endif

<div class="mt-8 grid gap-6 lg:grid-cols-2">
    <section class="rounded-md bg-white p-5">
        <div class="flex items-center justify-between"><h2 class="font-display text-xl font-bold">Latest enquiries</h2><a href="{{ route('admin.enquiries.index') }}" class="text-sm font-bold text-brand">View all</a></div>
        <ul class="mt-3 divide-y divide-ink/10">
            @forelse ($enquiries as $e)
                <li><a href="{{ route('admin.enquiries.show', $e->id) }}" class="flex items-center justify-between gap-3 py-3 hover:text-brand"><span><strong>{{ $e->name }}</strong><span class="block text-sm text-ink/60">{{ $e->interestLabel() }}@if ($e->property || $e->development), {{ $e->property?->title ?? $e->development?->name }}@endif</span></span><span class="rounded-sm bg-mist px-2.5 py-1 text-xs font-semibold">{{ $e->statusLabel() }}</span></a></li>
            @empty<li class="py-6 text-sm text-ink/60">No enquiries yet.</li>@endforelse
        </ul>
    </section>
    <section class="rounded-md bg-white p-5">
        <div class="flex items-center justify-between"><h2 class="font-display text-xl font-bold">Recently added listings</h2><a href="{{ route('admin.properties.create') }}" class="inline-flex items-center gap-1.5 rounded-md bg-brand px-4 py-2 text-sm font-bold text-white"><x-icon name="plus" :size="16" /> Add property</a></div>
        <ul class="mt-3 divide-y divide-ink/10">@foreach ($recent as $p)<li><a href="{{ route('admin.properties.edit', $p->id) }}" class="flex justify-between gap-3 py-3 hover:text-brand"><span class="font-semibold">{{ $p->title }}</span><span class="shrink-0 text-sm text-ink/60">{{ $p->price_label }}</span></a></li>@endforeach</ul>
    </section>
</div>
@endsection
