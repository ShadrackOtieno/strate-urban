{{-- Props: $title, optional $text, optional $image (public path) --}}
<section class="relative isolate overflow-hidden bg-ink text-white">
    <img src="{{ media_url($image ?? 'images/hero.svg') }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover opacity-40">
    <div class="absolute inset-0 -z-10 bg-ink/60"></div>
    <div class="mx-auto max-w-7xl px-6 py-14 text-center md:py-20">
        <h1 class="font-serif-d text-3xl font-semibold md:text-5xl">{{ $title }}</h1>
        <div class="mx-auto mt-4 h-1 w-16 bg-gold"></div>
        @isset($text)<p class="mx-auto mt-4 max-w-2xl text-white/75">{{ $text }}</p>@endisset
    </div>
</section>
