{{-- Needs $locationOptions (collection of locations). Optional $f (current filters) --}}
@php $f = $f ?? []; $cur = fn ($k) => old($k, $f[$k] ?? request($k)); $sel = 'w-full border-0 border-b border-ink/25 bg-transparent px-0 py-2.5 text-ink focus:border-gold focus:outline-none focus:ring-0'; @endphp
<form method="GET" action="{{ route('properties.index') }}" class="grid gap-x-6 gap-y-5 sm:grid-cols-2 lg:grid-cols-5 lg:items-end">
    <div>
        <label for="s_purpose" class="text-sm font-bold">I want to</label>
        <select id="s_purpose" name="purpose" class="{{ $sel }}"><option value="">Buy, rent or lease</option>@foreach (\App\Models\Property::PURPOSES as $k => $l)<option value="{{ $k }}" @selected($cur('purpose') === $k)>{{ $l }}</option>@endforeach</select>
    </div>
    <div>
        <label for="s_type" class="text-sm font-bold">Property type</label>
        <select id="s_type" name="type" class="{{ $sel }}"><option value="">Any type</option>@foreach (\App\Models\Property::TYPES as $k => $l)<option value="{{ $k }}" @selected($cur('type') === $k)>{{ $l }}</option>@endforeach</select>
    </div>
    <div>
        <label for="s_location" class="text-sm font-bold">Location</label>
        <select id="s_location" name="location" class="{{ $sel }}"><option value="">Anywhere</option>@foreach ($locationOptions as $l)<option value="{{ $l->slug }}" @selected($cur('location') === $l->slug)>{{ $l->name }}</option>@endforeach</select>
    </div>
    <div>
        <label for="s_max" class="text-sm font-bold">Maximum price</label>
        <select id="s_max" name="max" class="{{ $sel }}">
            <option value="">No limit</option>
            @foreach ([200000 => 'KSh 200,000', 500000 => 'KSh 500,000', 2000000 => 'KSh 2 million', 5000000 => 'KSh 5 million', 10000000 => 'KSh 10 million', 20000000 => 'KSh 20 million'] as $v => $l)<option value="{{ $v }}" @selected((int) $cur('max') === $v)>{{ $l }}</option>@endforeach
        </select>
    </div>
    <button class="inline-flex items-center justify-center gap-2 rounded-md bg-gold px-6 py-3 font-semibold text-white hover:brightness-110"><x-icon name="search" :size="18" /> Search</button>
</form>
