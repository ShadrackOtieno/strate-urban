@extends('layouts.admin')
@section('title', $property->exists ? 'Edit property' : 'Add property')

@section('content')
@php $cls = 'mt-1 w-full rounded-md border border-ink/25 px-3 py-2.5 focus:border-brand focus:outline-none'; $v = fn ($k) => old($k, $property->{$k}); @endphp
<form method="POST" enctype="multipart/form-data" action="{{ $property->exists ? route('admin.properties.update', $property->id) : route('admin.properties.store') }}" class="max-w-4xl space-y-6">
    @csrf
    @if ($property->exists) @method('PUT') @endif

    <section class="rounded-md bg-white p-6">
        <h2 class="font-display text-xl font-bold">Basics</h2>
        <div class="mt-4 grid gap-5 sm:grid-cols-2">
            <div class="sm:col-span-2"><label class="text-sm font-semibold" for="title">Title</label><input id="title" name="title" value="{{ $v('title') }}" required class="{{ $cls }}"></div>
            <div><label class="text-sm font-semibold" for="type">Type</label><select id="type" name="type" class="{{ $cls }}">@foreach (\App\Models\Property::TYPES as $k => $l)<option value="{{ $k }}" @selected($v('type') === $k)>{{ $l }}</option>@endforeach</select></div>
            <div><label class="text-sm font-semibold" for="purpose">Listed for</label><select id="purpose" name="purpose" class="{{ $cls }}">@foreach (\App\Models\Property::PURPOSES as $k => $l)<option value="{{ $k }}" @selected($v('purpose') === $k)>{{ $l }}</option>@endforeach</select></div>
            <div><label class="text-sm font-semibold" for="price">Price (KSh)</label><input id="price" type="number" min="0" name="price" value="{{ $v('price') }}" class="{{ $cls }}"></div>
            <div><label class="text-sm font-semibold" for="price_period">Price is</label><select id="price_period" name="price_period" class="{{ $cls }}">@foreach (\App\Models\Property::PERIODS as $k => $l)<option value="{{ $k }}" @selected((string) $v('price_period') === (string) $k)>{{ $l }}</option>@endforeach</select></div>
            <div><label class="text-sm font-semibold" for="location_id">Location</label><select id="location_id" name="location_id" class="{{ $cls }}"><option value="">None</option>@foreach ($locations as $id => $name)<option value="{{ $id }}" @selected((string) $v('location_id') === (string) $id)>{{ $name }}</option>@endforeach</select></div>
            <div><label class="text-sm font-semibold" for="development_id">Part of a premium development</label><select id="development_id" name="development_id" class="{{ $cls }}"><option value="">No</option>@foreach ($developments as $id => $name)<option value="{{ $id }}" @selected((string) $v('development_id') === (string) $id)>{{ $name }}</option>@endforeach</select></div>
            <div><label class="text-sm font-semibold" for="bedrooms">Bedrooms (0 = studio, blank for land)</label><input id="bedrooms" type="number" min="0" name="bedrooms" value="{{ $v('bedrooms') }}" class="{{ $cls }}"></div>
            <div><label class="text-sm font-semibold" for="bathrooms">Bathrooms</label><input id="bathrooms" type="number" min="0" name="bathrooms" value="{{ $v('bathrooms') }}" class="{{ $cls }}"></div>
            <div><label class="text-sm font-semibold" for="size">Size</label><input id="size" type="number" step="0.01" min="0" name="size" value="{{ $v('size') }}" class="{{ $cls }}"></div>
            <div><label class="text-sm font-semibold" for="size_unit">Size unit</label><select id="size_unit" name="size_unit" class="{{ $cls }}">@foreach (\App\Models\Property::SIZE_UNITS as $k => $l)<option value="{{ $k }}" @selected($v('size_unit') === $k)>{{ $l }}</option>@endforeach</select></div>
            <div class="sm:col-span-2"><label class="text-sm font-semibold" for="address">Address or area</label><input id="address" name="address" value="{{ $v('address') }}" class="{{ $cls }}"></div>
            <div class="sm:col-span-2"><label class="text-sm font-semibold" for="short_description">Short description (shown on cards)</label><textarea id="short_description" name="short_description" rows="2" class="{{ $cls }}">{{ $v('short_description') }}</textarea></div>
            <div class="sm:col-span-2"><label class="text-sm font-semibold" for="description">Full description (blank line starts a new paragraph)</label><textarea id="description" name="description" rows="6" class="{{ $cls }}">{{ $v('description') }}</textarea></div>
            <div class="sm:col-span-2"><label class="text-sm font-semibold" for="features">Features (one per line)</label><textarea id="features" name="features" rows="5" class="{{ $cls }}">{{ $v('features') }}</textarea></div>
        </div>
    </section>

    <section class="rounded-md bg-white p-6">
        <h2 class="font-display text-xl font-bold">Photos</h2>
        <div class="mt-4 space-y-5">
            <div>
                <label class="text-sm font-semibold" for="cover_image">Cover photo (3:2 works best)</label>
                @if ($property->cover_url)<img src="{{ $property->cover_url }}" alt="" class="mt-2 h-24 rounded-md border border-ink/10">@endif
                <input id="cover_image" type="file" name="cover_image" accept="image/*" class="mt-2 block w-full text-sm">
            </div>
            <div><label class="text-sm font-semibold" for="gallery">Add gallery photos</label><input id="gallery" type="file" name="gallery[]" accept="image/*" multiple class="mt-2 block w-full text-sm"></div>
            @if ($property->exists && $property->images->isNotEmpty())
                <div>
                    <p class="text-sm font-semibold">Current gallery (tick to remove)</p>
                    <div class="mt-2 grid grid-cols-3 gap-3 sm:grid-cols-5">@foreach ($property->images as $img)<label class="block text-xs"><img src="{{ media_url($img->path) }}" alt="" class="aspect-video w-full rounded-sm object-cover"><span class="mt-1 flex items-center gap-1.5"><input type="checkbox" name="remove_images[]" value="{{ $img->id }}"> Remove</span></label>@endforeach</div>
                </div>
            @endif
        </div>
    </section>

    <section class="rounded-md bg-white p-6">
        <h2 class="font-display text-xl font-bold">Status and display</h2>
        <div class="mt-4 flex flex-wrap items-center gap-6">
            <div><label class="text-sm font-semibold" for="status">Availability</label> <select id="status" name="status" class="ml-2 rounded-md border border-ink/25 px-3 py-2">@foreach (\App\Models\Property::STATUSES as $k => $l)<option value="{{ $k }}" @selected($v('status') === $k)>{{ $l }}</option>@endforeach</select></div>
            <label class="flex items-center gap-2 text-sm font-semibold"><input type="checkbox" name="is_active" value="1" @checked($property->exists ? $property->is_active : true)> Show on website</label>
            <label class="flex items-center gap-2 text-sm font-semibold"><input type="checkbox" name="is_featured" value="1" @checked($property->is_featured)> Featured</label>
            <label class="flex items-center gap-2 text-sm font-semibold"><input type="checkbox" name="is_hot" value="1" @checked($property->is_hot)> New and hot</label>
            <div><label class="text-sm font-semibold" for="sort_order">Order</label> <input id="sort_order" type="number" min="0" name="sort_order" value="{{ $v('sort_order') ?? 0 }}" class="ml-2 w-24 rounded-md border border-ink/25 px-3 py-2"></div>
        </div>
    </section>

    <div class="flex gap-3"><button class="rounded-md bg-brand px-8 py-3 font-bold text-white hover:brightness-110">Save property</button><a href="{{ route('admin.properties.index') }}" class="rounded-md px-7 py-3 font-bold text-ink/70 hover:bg-mist">Cancel</a></div>
</form>
@endsection
