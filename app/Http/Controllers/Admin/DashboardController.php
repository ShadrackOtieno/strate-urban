<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Development;
use App\Models\Enquiry;
use App\Models\Property;
use App\Models\Subscriber;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'newEnquiries' => Enquiry::where('status', 'new')->count(),
            'propertyCount' => Property::count(),
            'liveCount' => Property::where('is_active', true)->count(),
            'developmentCount' => Development::count(),
            'subscriberCount' => Subscriber::count(),
            'demoCount' => Property::where('title', 'like', '%(sample)%')->count() + Development::where('name', 'like', '%(sample)%')->count(),
            'hiddenTestimonials' => Testimonial::where('is_active', false)->count(),
            'enquiries' => Enquiry::with(['property', 'development'])->latest()->take(6)->get(),
            'recent' => Property::latest()->take(5)->get(),
        ]);
    }
}
