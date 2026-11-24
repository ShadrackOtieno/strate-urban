@extends('layouts.site')
@section('title', 'FAQs')

@section('content')
@include('partials.page-header', ['title' => 'Frequently asked questions', 'text' => 'Straight answers about buying, renting and investing.'])
<div class="mx-auto max-w-4xl px-6 py-20">
    <div class="divide-y divide-ink/15 border-y border-ink/15" x-data="{ open: null }">
        @forelse ($faqs as $faq)
            <div>
                <button type="button" @click="open = open === {{ $faq->id }} ? null : {{ $faq->id }}" :aria-expanded="open === {{ $faq->id }}" class="flex w-full items-center justify-between gap-6 py-6 text-left font-serif-d text-lg font-semibold"><span>{{ $faq->question }}</span><x-icon name="chevron-down" ::class="open === {{ $faq->id }} ? 'rotate-180' : ''" class="shrink-0 transition" /></button>
                <div x-show="open === {{ $faq->id }}" x-cloak class="pb-7 text-lg text-ink/75">{{ $faq->answer }}</div>
            </div>
        @empty
            <p class="py-10 text-center">Questions will appear here once they are added in the back office.</p>
        @endforelse
    </div>
</div>
@include('partials.cta')
@endsection
