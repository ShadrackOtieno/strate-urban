{{-- Needs $d (development) with location loaded. --}}
<article class="group flex h-full flex-col overflow-hidden rounded-lg border border-ink/10 bg-white">
    <a href="{{ route('developments.show', $d->slug) }}" class="relative block aspect-[16/10] overflow-hidden bg-sand">
        @if ($d->cover_url)<img src="{{ $d->cover_url }}" alt="{{ $d->name }}" loading="lazy" class="card-img h-full w-full object-cover">@endif
        <span class="absolute left-3 top-3 rounded bg-gold px-2.5 py-1 text-[11px] font-semibold text-white">{{ $d->status_label }}</span>
    </a>
    <div class="flex flex-1 flex-col p-5">
        <p class="inline-flex items-center gap-1.5 text-xs font-semibold text-gold"><x-icon name="map-pin" :size="13" /> {{ $d->location?->name }}</p>
        <h3 class="mt-1 font-serif-d text-lg font-semibold leading-snug"><a href="{{ route('developments.show', $d->slug) }}" class="hover:text-gold">{{ $d->name }}</a></h3>
        <p class="mt-2 line-clamp-3 min-h-[3.75rem] text-sm text-ink/65">{{ $d->summary }}</p>
        <ul class="mt-4 space-y-1.5 border-t border-ink/10 pt-4 text-sm">
            @foreach (array_slice($d->unitTypeList(), 0, 2) as [$u, $p])<li class="flex justify-between gap-3"><span class="text-ink/60">{{ $u }}</span><span class="font-semibold">{{ $p }}</span></li>@endforeach
        </ul>
        <div class="mt-auto pt-5"><a href="{{ route('developments.show', $d->slug) }}" class="flex items-center justify-center gap-2 rounded-md border border-ink px-4 py-2.5 text-sm font-semibold hover:bg-ink hover:text-white">View details <x-icon name="arrow-right" :size="15" /></a></div>
    </div>
</article>
