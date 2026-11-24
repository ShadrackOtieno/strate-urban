@extends('layouts.site')
@section('title', 'Contact')

@section('content')
@include('partials.page-header', ['title' => 'Contact us', 'text' => 'Book a viewing, ask about a development or tell us what you are looking for.'])
<div class="mx-auto grid max-w-7xl gap-14 px-6 py-20 lg:grid-cols-5">
    <div class="rounded-lg border border-ink/10 bg-white p-6 md:p-8 lg:col-span-3">
        <h2 class="font-serif-d text-2xl font-semibold">Send an enquiry</h2>
        <div class="mt-6">@include('partials.enquiry-form', ['interest' => 'general', 'id' => 'enquiry'])</div>
    </div>
    <aside class="space-y-4 lg:col-span-2">
        @foreach ([['map-pin', 'Visit us', $site['address'] ?? null, null], ['phone', 'Call', trim(($site['phone'] ?? '').(empty($site['phone2']) ? '' : ', '.$site['phone2']), ', '), 'tel:'.preg_replace('/\s+/', '', $site['phone'] ?? '')], ['mail', 'Email', $site['email'] ?? null, 'mailto:'.($site['email'] ?? '')], ['clock', 'Office hours', $site['hours'] ?? null, null]] as [$ic, $label, $val, $href])
            @if ($val)<div class="flex gap-4 rounded-lg bg-ink p-5 text-white"><span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-md bg-gold text-white"><x-icon :name="$ic" :size="20" /></span><div><div class="text-sm text-white/60">{{ $label }}</div>@if ($href)<a href="{{ $href }}" class="font-semibold hover:text-gold">{{ $val }}</a>@else<div class="font-semibold">{{ $val }}</div>@endif</div></div>@endif
        @endforeach
        @if (!empty($site['whatsapp']))<a href="https://wa.me/{{ $site['whatsapp'] }}" target="_blank" rel="noopener" class="flex items-center justify-center gap-2 rounded-md bg-[#25D366] px-5 py-3.5 font-semibold text-white hover:brightness-95"><x-icon name="message-circle" :size="20" /> Chat on WhatsApp</a>@endif
        @if (!empty($site['map_embed']))<iframe src="{{ $site['map_embed'] }}" title="Map" loading="lazy" class="h-72 w-full rounded-lg border-0" referrerpolicy="no-referrer-when-downgrade"></iframe>@endif
    </aside>
</div>
@endsection
