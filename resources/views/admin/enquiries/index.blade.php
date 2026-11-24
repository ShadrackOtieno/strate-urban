@extends('layouts.admin')
@section('title', 'Enquiries')

@section('content')
<div class="mb-5 flex flex-wrap gap-2">
    <a href="{{ route('admin.enquiries.index') }}" class="rounded-md px-4 py-1.5 text-sm font-semibold {{ !request('status') ? 'bg-brand text-white' : 'bg-white' }}">All</a>
    @foreach (\App\Models\Enquiry::STATUSES as $k => $l)<a href="{{ route('admin.enquiries.index', ['status' => $k]) }}" class="rounded-md px-4 py-1.5 text-sm font-semibold {{ request('status') === $k ? 'bg-brand text-white' : 'bg-white' }}">{{ $l }}</a>@endforeach
</div>
<div class="overflow-x-auto rounded-md bg-white">
    <table class="w-full text-left text-sm">
        <thead class="border-b border-ink/10 text-ink/60"><tr><th class="px-4 py-3 font-semibold">Reference</th><th class="px-4 py-3 font-semibold">From</th><th class="px-4 py-3 font-semibold">Interest</th><th class="px-4 py-3 font-semibold">About</th><th class="px-4 py-3 font-semibold">Status</th><th class="px-4 py-3 font-semibold">Received</th></tr></thead>
        <tbody class="divide-y divide-ink/10">
            @forelse ($enquiries as $e)
                <tr class="hover:bg-mist/60"><td class="px-4 py-3 font-semibold"><a href="{{ route('admin.enquiries.show', $e->id) }}" class="text-brand hover:underline">{{ $e->reference }}</a></td><td class="px-4 py-3">{{ $e->name }}<div class="text-xs text-ink/60">{{ $e->email }}</div></td><td class="px-4 py-3">{{ $e->interestLabel() }}</td><td class="px-4 py-3">{{ $e->property?->title ?? $e->development?->name ?? 'General' }}</td><td class="px-4 py-3"><span class="rounded-sm bg-mist px-2.5 py-1 text-xs font-bold">{{ $e->statusLabel() }}</span></td><td class="px-4 py-3 text-ink/60">{{ $e->created_at->format('d M Y') }}</td></tr>
            @empty<tr><td colspan="6" class="px-4 py-10 text-center text-ink/60">No enquiries yet. They appear here when someone uses an enquiry form on the website.</td></tr>@endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $enquiries->links() }}</div>
@endsection
