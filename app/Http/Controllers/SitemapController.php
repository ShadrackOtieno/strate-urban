<?php

namespace App\Http\Controllers;

use App\Models\Development;
use App\Models\Location;
use App\Models\Property;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [route('home'), route('properties.index'), route('developments.index'), route('services'), route('about'), route('team'), route('faqs'), route('contact')];
        foreach (Property::active()->get(['slug']) as $p) { $urls[] = route('properties.show', $p->slug); }
        foreach (Development::active()->get(['slug']) as $d) { $urls[] = route('developments.show', $d->slug); }
        foreach (Location::active()->get(['slug']) as $l) { $urls[] = route('locations.show', $l->slug); }

        $xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($urls as $u) { $xml .= '<url><loc>'.e($u).'</loc></url>'; }
        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
