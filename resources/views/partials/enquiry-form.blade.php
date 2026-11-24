{{-- Props: $interest (default), $property (optional), $development (optional), $dark (bool), $id --}}
@php
    $dark = $dark ?? false;
    $interest = $interest ?? 'general';
    $fid = $id ?? 'enquiry';
    $field = $dark
        ? 'mt-1 w-full rounded-md border-0 bg-white/10 px-4 py-3 text-white placeholder-white/40 focus:bg-white/15 focus:outline-none focus:ring-2 focus:ring-gold'
        : 'mt-1 w-full rounded-md border border-ink/25 bg-white px-4 py-3 focus:border-ink focus:outline-none focus:ring-2 focus:ring-gold';
    $label = $dark ? 'text-sm font-semibold text-white/80' : 'text-sm font-semibold';
    $sizes = isset($development) ? collect($development->unitTypeList())->pluck(0)->filter()->values() : collect();
@endphp
<form id="{{ $fid }}" method="POST" action="{{ route('enquiry.store') }}" class="space-y-4">
    @csrf
    <div class="hidden" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>
    @isset($property)<input type="hidden" name="property_id" value="{{ $property->id }}">@endisset
    @isset($development)<input type="hidden" name="development_id" value="{{ $development->id }}">@endisset
    <div>
        <label for="{{ $fid }}_interest" class="{{ $label }}">I would like to</label>
        <select id="{{ $fid }}_interest" name="interest" class="{{ $field }}">
            @foreach (\App\Models\Enquiry::INTERESTS as $k => $l)<option value="{{ $k }}" @selected(old('interest', $interest) === $k) class="text-ink">{{ $l }}</option>@endforeach
        </select>
    </div>
    <div class="grid gap-4 sm:grid-cols-2">
        <div><label for="{{ $fid }}_name" class="{{ $label }}">Full name</label><input id="{{ $fid }}_name" name="name" value="{{ old('name') }}" required class="{{ $field }}">@error('name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror</div>
        <div><label for="{{ $fid }}_phone" class="{{ $label }}">Phone</label><input id="{{ $fid }}_phone" name="phone" value="{{ old('phone') }}" class="{{ $field }}"></div>
    </div>
    <div><label for="{{ $fid }}_email" class="{{ $label }}">Email</label><input id="{{ $fid }}_email" type="email" name="email" value="{{ old('email') }}" required class="{{ $field }}">@error('email')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror</div>
    @if ($sizes->isNotEmpty())
        <div><label for="{{ $fid }}_size" class="{{ $label }}">Preferred unit</label><select id="{{ $fid }}_size" name="unit_size" class="{{ $field }}"><option value="" class="text-ink">No preference</option>@foreach ($sizes as $s)<option class="text-ink">{{ $s }}</option>@endforeach</select></div>
    @endif
    <div><label for="{{ $fid }}_message" class="{{ $label }}">Message</label><textarea id="{{ $fid }}_message" name="message" rows="4" class="{{ $field }}" placeholder="Tell us what you are looking for">{{ old('message') }}</textarea>@error('message')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror</div>
    <button class="inline-flex w-full items-center justify-center gap-2 rounded-md bg-gold px-6 py-3 font-semibold text-white hover:brightness-110"><x-icon name="send" :size="18" /> Send enquiry</button>
</form>
