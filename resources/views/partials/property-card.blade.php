{{-- Needs $property with location loaded. --}}
<a href="{{ route('properties.show', $property->slug) }}" class="group flex h-full flex-col overflow-hidden rounded-lg border border-ink/10 bg-white text-ink transition hover:-translate-y-0.5 hover:shadow-lg">
    <div class="relative aspect-[16/10] overflow-hidden bg-sand">
        @if ($property->cover_url)<img src="{{ $property->cover_url }}" alt="{{ $property->title }}" loading="lazy" class="card-img h-full w-full object-cover">@endif
        <span class="absolute left-3 top-3 rounded bg-gold px-2.5 py-1 text-[11px] font-semibold text-white">{{ $property->purpose_label }}</span>
        @if ($property->is_hot)<span class="absolute right-3 top-3 rounded bg-ink px-2.5 py-1 text-[11px] font-semibold text-white">Hot</span>@endif
        @if ($property->status !== 'available')<span class="absolute bottom-3 left-3 rounded bg-white px-2.5 py-1 text-[11px] font-semibold">{{ $property->status_label }}</span>@endif
    </div>
    <div class="flex flex-1 flex-col p-4">
        <p class="font-serif-d text-lg font-semibold text-gold">{{ $property->price_label }}</p>
        <h3 class="mt-1 line-clamp-2 min-h-[2.5rem] text-sm font-semibold leading-5">{{ $property->title }}</h3>
        <p class="mt-1.5 inline-flex items-center gap-1.5 text-xs text-ink/60"><x-icon name="map-pin" :size="13" /> {{ $property->location?->name ?? 'Kenya' }}</p>
        <div class="mt-auto pt-4"><div class="flex items-center gap-4 border-t border-ink/10 pt-3 text-xs text-ink/70">
            @if ($property->bedrooms !== null)<span class="inline-flex items-center gap-1.5"><x-icon name="bed" :size="14" /> {{ $property->bedrooms == 0 ? 'Studio' : $property->bedrooms.' bed' }}</span>@endif
            @if ($property->bathrooms)<span class="inline-flex items-center gap-1.5"><x-icon name="bath" :size="14" /> {{ $property->bathrooms }}</span>@endif
            @if ($property->size_label)<span class="inline-flex items-center gap-1.5"><x-icon name="maximize" :size="14" /> {{ $property->size_label }}</span>@endif
        </div></div>
    </div>
</a>
