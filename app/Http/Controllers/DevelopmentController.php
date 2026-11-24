<?php

namespace App\Http\Controllers;

use App\Models\Development;
use App\Models\Property;

class DevelopmentController extends Controller
{
    public function index()
    {
        return view('site.developments.index', ['developments' => Development::active()->with('location')->get()]);
    }

    public function show(Development $development)
    {
        abort_unless($development->is_active, 404);
        $development->load('location');

        return view('site.developments.show', [
            'development' => $development,
            'units' => Property::active()->with('location')->where('development_id', $development->id)->orderBy('price')->get(),
            'others' => Development::active()->where('id', '!=', $development->id)->get(),
        ]);
    }
}
