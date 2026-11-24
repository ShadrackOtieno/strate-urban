<?php

namespace App\Http\Controllers;

use App\Models\Development;
use App\Models\Location;
use App\Models\Property;

class LocationController extends Controller
{
    public function show(Location $location)
    {
        abort_unless($location->is_active, 404);

        return view('site.locations.show', [
            'location' => $location,
            'properties' => Property::active()->with('location')->where('location_id', $location->id)->orderByDesc('is_featured')->orderByDesc('id')->paginate(9),
            'developments' => Development::active()->where('location_id', $location->id)->get(),
            'others' => Location::active()->where('id', '!=', $location->id)->get(),
        ]);
    }
}
