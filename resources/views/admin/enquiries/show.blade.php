@extends('layouts.admin')
@section('title', 'Enquiry '.$enquiry->reference)

@section('content')
<a href="{{ route('admin.enquiries.index') }}" class="mb-4 inline-flex items-center gap-1.5 text-sm font-semibold text-brand"><x-icon name="arrow-left" :size="16" /> All enquiries</a>
<div class="grid max-w-5xl gap-6 lg:grid-cols-3">
    <section class="rounded-md bg-white p-6 lg:col-span-2">
        <h2 class="font-display text-2xl font-bold">{{ $enquiry->interestLabel() }}</h2>
        @if ($enquiry->property)<p class="mt-1 text-sm">About: <a class="font-semibold text-brand" href="{{ route('properties.show', $enquiry->property->slug) }}" target="_blank">{{ $enquiry->property->title }}</a></p>@endif
        @if ($enquiry->development)<p class="mt-1 text-sm">About: <a class="font-semibold text-brand" href="{{ route('developments.show', $enquiry->development->slug) }}" target="_blank">{{ $enquiry->development->name }}</a>@if ($enquiry->unit_size), unit: {{ $enquiry->unit_size }}@endif</p>@endif
        <p class="mt-4 whitespace-pre-line text-ink/80">{{ $enquiry->message ?: 'No message.' }}</p>
        <dl class="mt-6 grid gap-4 border-t border-ink/10 pt-5 text-sm sm:grid-cols-2">
            @foreach ([['Name', $enquiry->name], ['Email', $enquiry->email], ['Phone', $enquiry->phone], ['Received', $enquiry->created_at->format('d M Y, H:i')]] as [$k, $val])
                @if ($val)<div><dt class="text-ink/60">{{ $k }}</dt><dd class="font-semibold">{{ $val }}</dd></div>@endif
            @endforeach
        </dl>
        <div class="mt-6 flex flex-wrap gap-3">
            <a href="mailto:{{ $enquiry->email }}?subject=Re: {{ $enquiry->reference }}" class="inline-flex items-center gap-2 rounded-md bg-brand px-5 py-2.5 text-sm font-bold text-white"><x-icon name="mail" :size="16" /> Reply by email</a>
            @if ($enquiry->phone)<a href="https://wa.me/{{ kenya_phone($enquiry->phone) }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-md bg-accent px-5 py-2.5 text-sm font-bold"><x-icon name="message-circle" :size="16" /> WhatsApp</a>@endif
        </div>
    </section>
    <form method="POST" action="{{ route('admin.enquiries.update', $enquiry->id) }}" class="rounded-md bg-white p-6">
        @csrf @method('PUT')
        <label for="status" class="text-sm font-semibold">Status</label>
        <select id="status" name="status" class="mt-1 w-full rounded-md border border-ink/25 px-3 py-2.5">@foreach (\App\Models\Enquiry::STATUSES as $k => $l)<option value="{{ $k }}" @selected($enquiry->status === $k)>{{ $l }}</option>@endforeach</select>
        <label for="admin_notes" class="mt-4 block text-sm font-semibold">Private notes</label>
        <textarea id="admin_notes" name="admin_notes" rows="6" class="mt-1 w-full rounded-md border border-ink/25 px-3 py-2.5">{{ old('admin_notes', $enquiry->admin_notes) }}</textarea>
        <button class="mt-4 w-full rounded-md bg-brand py-3 font-bold text-white">Save</button>
    </form>
</div>
<form method="POST" action="{{ route('admin.enquiries.destroy', $enquiry->id) }}" class="mt-6" onsubmit="return confirm('Delete this enquiry?')">@csrf @method('DELETE')<button class="inline-flex items-center gap-1.5 text-sm font-semibold text-red-600"><x-icon name="trash" :size="16" /> Delete enquiry</button></form>
@endsection
