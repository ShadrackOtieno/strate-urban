<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        // Query-string filters win; shortcut routes (/for-rent, /land-for-lease ...) supply the defaults.
        $f = [
            'purpose' => (string) $request->query('purpose', $request->route('purpose') ?? ''),
            'type' => (string) $request->query('type', $request->route('type') ?? ''),
            'location' => (string) $request->query('location', ''),
            'min' => (int) $request->query('min', 0),
            'max' => (int) $request->query('max', 0),
            'beds' => (int) $request->query('beds', 0),
            'q' => trim((string) $request->query('q', '')),
            'sort' => (string) $request->query('sort', ''),
        ];

        $q = Property::active()->with(['location', 'development']);

        if (isset(Property::PURPOSES[$f['purpose']])) {
            $q->where('purpose', $f['purpose']);
        }
        if (isset(Property::TYPES[$f['type']])) {
            $q->where('type', $f['type']);
        }
        if ($f['location'] !== '') {
            $q->whereHas('location', fn ($l) => $l->where('slug', $f['location']));
        }
        if ($f['min'] > 0) {
            $q->where('price', '>=', $f['min']);
        }
        if ($f['max'] > 0) {
            $q->where('price', '<=', $f['max']);
        }
        if ($f['beds'] > 0) {
            $q->where('bedrooms', '>=', $f['beds']);
        }
        if ($f['q'] !== '') {
            $term = $f['q'];
            $q->where(fn ($w) => $w->where('title', 'like', "%{$term}%")->orWhere('address', 'like', "%{$term}%")->orWhere('short_description', 'like', "%{$term}%"));
        }

        switch ($f['sort']) {
            case 'price_asc': $q->orderBy('price'); break;
            case 'price_desc': $q->orderByDesc('price'); break;
            case 'newest': $q->orderByDesc('id'); break;
            default: $q->orderByDesc('is_featured')->orderBy('sort_order')->orderByDesc('id');
        }

        $plural = ['apartment' => 'Apartments', 'house' => 'Houses', 'land' => 'Land', 'commercial' => 'Commercial properties'][$f['type']] ?? 'Properties';
        $suffix = ['sale' => ' for sale', 'rent' => ' for rent', 'lease' => ' for lease'][$f['purpose']] ?? '';
        $heading = ($f['type'] === '' && $f['purpose'] === '') ? 'All properties' : $plural.$suffix;

        return view('site.properties.index', [
            'properties' => $q->paginate(9)->withQueryString(),
            'locations' => Location::active()->get(['id', 'name', 'slug']),
            'f' => $f,
            'heading' => $heading,
        ]);
    }

    public function show(Property $property)
    {
        abort_unless($property->is_active, 404);
        $property->load(['location', 'development', 'images']);

        $related = Property::active()->with('location')
            ->where('id', '!=', $property->id)
            ->where('purpose', $property->purpose)
            ->when($property->type, fn ($q) => $q->where('type', $property->type))
            ->orderByDesc('is_featured')->limit(3)->get();

        return view('site.properties.show', compact('property', 'related'));
    }
}
