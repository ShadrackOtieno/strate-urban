<?php

namespace App\Http\Controllers;

use App\Models\Development;
use App\Models\Faq;
use App\Models\Location;
use App\Models\Property;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $base = fn () => Property::active()->with('location')->where('status', '!=', 'sold')->where('status', '!=', 'let');

        $blocks = [];
        foreach ([
            ['Apartments for sale', ['purpose' => 'sale', 'type' => 'apartment'], 'properties.apartments-sale'],
            ['Apartments for rent', ['purpose' => 'rent', 'type' => 'apartment'], 'properties.apartments-rent'],
            ['Houses for rent', ['purpose' => 'rent', 'type' => 'house'], 'properties.houses-rent'],
            ['Land for sale', ['purpose' => 'sale', 'type' => 'land'], 'properties.land-sale'],
            ['Land for lease', ['purpose' => 'lease', 'type' => 'land'], 'properties.land-lease'],
        ] as [$title, $where, $route]) {
            $items = $base()->where($where)->orderByDesc('is_featured')->orderBy('sort_order')->orderByDesc('id')->limit(4)->get();
            if ($items->isNotEmpty()) {
                $blocks[] = ['title' => $title, 'route' => $route, 'items' => $items];
            }
        }

        return view('site.home', [
            'developments' => Development::active()->with('location')->limit(3)->get(),
            'hot' => $base()->where('is_hot', true)->orderBy('sort_order')->orderByDesc('id')->limit(8)->get(),
            'featured' => $base()->where('is_featured', true)->orderBy('sort_order')->orderByDesc('id')->limit(6)->get(),
            'blocks' => $blocks,
            'locations' => Location::active()->withCount(['properties' => fn ($q) => $q->where('is_active', true)])->get(),
            'services' => Service::active()->get(),
            'team' => TeamMember::active()->get(),
            'testimonials' => Testimonial::active()->get(),
            'faqs' => Faq::active()->limit(5)->get(),
            'locationOptions' => Location::active()->get(['id', 'name', 'slug']),
        ]);
    }
}
