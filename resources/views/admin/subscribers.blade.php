@extends('layouts.admin')
@section('title', 'Subscribers')

@section('content')
<div class="mb-5 flex justify-end"><a href="{{ route('admin.subscribers.export') }}" class="inline-flex items-center gap-2 rounded-md bg-brand px-5 py-2.5 text-sm font-bold text-white"><x-icon name="upload" :size="16" /> Export CSV</a></div>
<div class="overflow-hidden rounded-md bg-white">
    <ul class="divide-y divide-ink/10">
        @forelse ($subscribers as $s)
            <li class="flex items-center justify-between gap-4 px-5 py-3"><span class="font-semibold">{{ $s->email }}</span><span class="flex items-center gap-4 text-sm text-ink/60">{{ $s->created_at->format('d M Y') }}<form method="POST" action="{{ route('admin.subscribers.destroy', $s->id) }}" onsubmit="return confirm('Remove this subscriber?')">@csrf @method('DELETE')<button class="font-semibold text-red-600">Remove</button></form></span></li>
        @empty<li class="px-5 py-10 text-center text-ink/60">No subscribers yet. They sign up through the footer form.</li>@endforelse
    </ul>
</div>
<div class="mt-5">{{ $subscribers->links() }}</div>
@endsection
