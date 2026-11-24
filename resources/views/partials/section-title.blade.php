{{-- Props: $title, optional $sub, optional $dark (white text on a dark section) --}}
<div class="text-center">
    <h2 class="inline-flex items-center gap-4 font-serif-d text-2xl font-semibold md:text-3xl {{ ($dark ?? false) ? 'text-white' : 'text-ink' }}">
        <span class="hidden h-0.5 w-10 bg-gold sm:block md:w-16"></span>{{ $title }}<span class="hidden h-0.5 w-10 bg-gold sm:block md:w-16"></span>
    </h2>
    @isset($sub)<p class="mx-auto mt-3 max-w-2xl text-[15px] {{ ($dark ?? false) ? 'text-white/70' : 'text-ink/60' }}">{{ $sub }}</p>@endisset
</div>
