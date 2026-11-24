<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Development;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $q = Property::with('location')->latest('id');
        if ($s = trim((string) $request->query('q'))) {
            $q->where('title', 'like', "%$s%");
        }
        if ($p = $request->query('purpose')) {
            $q->where('purpose', $p);
        }
        if ($t = $request->query('type')) {
            $q->where('type', $t);
        }
        if ($st = $request->query('status')) {
            $q->where('status', $st);
        }

        return view('admin.properties.index', ['properties' => $q->paginate(20)->withQueryString()]);
    }

    public function create()
    {
        return view('admin.properties.form', $this->formData(new Property(['is_active' => true, 'purpose' => 'sale', 'type' => 'apartment', 'status' => 'available', 'size_unit' => 'sqm'])));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['slug'] = $this->uniqueSlug($data['title']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('properties', 'public');
        }

        $property = Property::create($data);
        $this->saveGallery($request, $property);

        return redirect()->route('admin.properties.index')->with('success', 'Property added.');
    }

    public function edit($id)
    {
        return view('admin.properties.form', $this->formData(Property::with('images')->findOrFail($id)));
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        $data = $this->validated($request); // the slug is kept so published links never break

        if ($request->hasFile('cover_image')) {
            $this->deleteFile($property->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('properties', 'public');
        }

        $property->update($data);

        foreach ($property->images()->whereIn('id', (array) $request->input('remove_images', []))->get() as $img) {
            $this->deleteFile($img->path);
            $img->delete();
        }
        $this->saveGallery($request, $property);

        return redirect()->route('admin.properties.index')->with('success', 'Property updated.');
    }

    public function destroy($id)
    {
        $property = Property::with('images')->findOrFail($id);
        foreach ($property->images as $img) {
            $this->deleteFile($img->path);
        }
        $this->deleteFile($property->cover_image);
        $property->delete();

        return redirect()->route('admin.properties.index')->with('success', 'Property deleted.');
    }

    private function formData(Property $property): array
    {
        return [
            'property' => $property,
            'locations' => Location::orderBy('name')->pluck('name', 'id')->all(),
            'developments' => Development::orderBy('name')->pluck('name', 'id')->all(),
        ];
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'title' => 'required|string|max:180',
            'type' => ['required', Rule::in(array_keys(Property::TYPES))],
            'purpose' => ['required', Rule::in(array_keys(Property::PURPOSES))],
            'status' => ['required', Rule::in(array_keys(Property::STATUSES))],
            'location_id' => 'nullable|integer|exists:locations,id',
            'development_id' => 'nullable|integer|exists:developments,id',
            'price' => 'nullable|integer|min:0',
            'price_period' => ['nullable', Rule::in(['month', 'year'])],
            'bedrooms' => 'nullable|integer|min:0|max:50',
            'bathrooms' => 'nullable|integer|min:0|max:50',
            'size' => 'nullable|numeric|min:0',
            'size_unit' => ['required', Rule::in(array_keys(Property::SIZE_UNITS))],
            'address' => 'nullable|string|max:200',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string|max:8000',
            'features' => 'nullable|string|max:3000',
            'cover_image' => 'nullable|image|max:5120',
            'gallery' => 'nullable|array|max:15',
            'gallery.*' => 'image|max:5120',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['price'] = $data['price'] ?? 0;
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_hot'] = $request->boolean('is_hot');
        $data['is_active'] = $request->boolean('is_active');
        unset($data['cover_image'], $data['gallery']);

        return $data;
    }

    private function saveGallery(Request $request, Property $property): void
    {
        $order = (int) $property->images()->max('sort_order');
        foreach ($request->file('gallery', []) as $file) {
            PropertyImage::create([
                'property_id' => $property->id,
                'path' => $file->store('properties', 'public'),
                'sort_order' => ++$order,
            ]);
        }
    }

    /** Bundled demo images live in public/images and must never be deleted from disk. */
    private function deleteFile(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'images/')) {
            Storage::disk('public')->delete($path);
        }
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'property';
        $slug = $base;
        for ($i = 2; Property::where('slug', $slug)->exists(); $i++) {
            $slug = $base.'-'.$i;
        }
        return $slug;
    }
}
