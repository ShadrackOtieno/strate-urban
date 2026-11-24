<section class="bg-ink text-white">
    <div class="mx-auto flex max-w-7xl flex-col items-center gap-6 px-6 py-14 text-center">
        <h2 class="max-w-3xl font-serif-d text-2xl font-semibold md:text-3xl">{{ $site['cta_title'] ?? 'Let us find the right property for you.' }}</h2>
        <p class="max-w-2xl text-white/70">{{ $site['cta_text'] ?? '' }}</p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('properties.index') }}" class="inline-flex items-center gap-2 rounded-md bg-gold px-7 py-3 font-semibold text-white hover:brightness-110">Browse properties <x-icon name="arrow-right" :size="16" /></a>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-md border border-white/40 px-7 py-3 font-semibold hover:bg-white/10">Talk to a consultant</a>
        </div>
    </div>
</section>
