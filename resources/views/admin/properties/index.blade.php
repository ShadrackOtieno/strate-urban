@extends('layouts.admin')
@section('title', 'Properties')

@section('content')
<form method="GET" class="mb-5 flex flex-wrap items-center gap-3">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Search title" class="rounded-md border border-ink/25 bg-white px-3 py-2 text-sm">
    <select name="purpose" class="rounded-md border border-ink/25 bg-white px-3 py-2 text-sm"><option value="">Sale, rent, lease</option>@foreach (\App\Models\Property::PURPOSES as $k => $l)<option value="{{ $k }}" @selected(request('purpose') === $k)>{{ $l }}</option>@endforeach</select>
    <select name="type" class="rounded-md border border-ink/25 bg-white px-3 py-2 text-sm"><option value="">Any type</option>@foreach (\App\Models\Property::TYPES as $k => $l)<option value="{{ $k }}" @selected(request('type') === $k)>{{ $l }}</option>@endforeach</select>
    <select name="status" class="rounded-md border border-ink/25 bg-white px-3 py-2 text-sm"><option value="">Any status</option>@foreach (\App\Models\Property::STATUSES as $k => $l)<option value="{{ $k }}" @selected(request('status') === $k)>{{ $l }}</option>@endforeach</select>
    <button class="rounded-md bg-ink px-4 py-2 text-sm font-bold text-white">Filter</button>
    <a href="{{ route('admin.properties.create') }}" class="ml-auto inline-flex items-center gap-2 rounded-md bg-brand px-5 py-2.5 text-sm font-bold text-white"><x-icon name="plus" :size="16" /> Add property</a>
</form>
<div class="overflow-x-auto rounded-md bg-white">
    <table class="w-full text-left text-sm">
        <thead class="border-b border-ink/10 text-ink/60"><tr><th class="px-4 py-3 font-semibold">Property</th><th class="px-4 py-3 font-semibold">For</th><th class="px-4 py-3 font-semibold">Price</th><th class="px-4 py-3 font-semibold">Status</th><th class="px-4 py-3 font-semibold">Shown</th><th class="px-4 py-3"></th></tr></thead>
        <tbody class="divide-y divide-ink/10">
            @forelse ($properties as $p)
                <tr class="hover:bg-mist/60">
                    <td class="px-4 py-3"><div class="flex items-center gap-3">@if ($p->cover_url)<img src="{{ $p->cover_url }}" alt="" class="h-10 w-14 rounded-sm object-cover">@endif<div><div class="font-semibold">{{ $p->title }} @if ($p->is_featured)<x-icon name="star" :size="14" class="inline text-accent" />@endif</div><div class="text-xs text-ink/60">{{ $p->type_label }}, {{ $p->location?->name ?? 'No location' }}</div></div></div></td>
                    <td class="px-4 py-3">{{ $p->purpose_label }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $p->price_label }}</td>
                    <td class="px-4 py-3">{{ $p->status_label }}</td>
                    <td class="px-4 py-3"><span class="rounded-sm px-2.5 py-1 text-xs font-bold {{ $p->is_active ? 'bg-green-100 text-green-800' : 'bg-ink/10 text-ink/60' }}">{{ $p->is_active ? 'Yes' : 'No' }}</span></td>
                    <td class="whitespace-nowrap px-4 py-3 text-right">
                        <a href="{{ route('properties.show', $p->slug) }}" target="_blank" class="rounded-md px-2.5 py-1.5 font-semibold text-ink/60 hover:bg-mist">View</a>
                        <a href="{{ route('admin.properties.edit', $p->id) }}" class="rounded-md px-2.5 py-1.5 font-semibold text-brand hover:bg-mist">Edit</a>
                        <form method="POST" action="{{ route('admin.properties.destroy', $p->id) }}" class="inline" onsubmit="return confirm('Delete this property and its images?')">@csrf @method('DELETE')<button class="rounded-md px-2.5 py-1.5 font-semibold text-red-600 hover:bg-red-50">Delete</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-10 text-center text-ink/60">No properties found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-5">{{ $properties->links() }}</div>
@endsection
