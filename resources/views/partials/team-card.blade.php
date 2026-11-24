<div class="overflow-hidden rounded-lg border border-ink/10 bg-white">
    @if ($m->photo)<img src="{{ media_url($m->photo) }}" alt="{{ $m->name }}" loading="lazy" class="aspect-square w-full object-cover">
    @else<div class="flex aspect-square w-full items-center justify-center bg-ink font-serif-d text-3xl font-semibold text-white">{{ initials($m->name) }}</div>@endif
    <div class="p-5">
        <h3 class="font-serif-d text-lg font-semibold">{{ $m->name }}</h3>
        <p class="text-sm font-semibold text-ink/60">{{ $m->title }}</p>
        @if ($m->bio)<p class="mt-3 text-sm text-ink/70">{{ $m->bio }}</p>@endif
        <div class="mt-4 space-y-1 text-sm">
            @if ($m->phone)<a href="tel:{{ preg_replace('/\s+/', '', $m->phone) }}" class="flex items-center gap-2 hover:text-gold"><x-icon name="phone" :size="14" /> {{ $m->phone }}</a>@endif
            @if ($m->email)<a href="mailto:{{ $m->email }}" class="flex items-center gap-2 hover:text-gold"><x-icon name="mail" :size="14" /> {{ $m->email }}</a>@endif
        </div>
    </div>
</div>
