<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;

class PageController extends Controller
{
    public function services()
    {
        return view('site.services', ['services' => Service::active()->get()]);
    }

    public function about()
    {
        return view('site.about', ['team' => TeamMember::active()->get(), 'testimonials' => Testimonial::active()->get()]);
    }

    public function team()
    {
        return view('site.team', ['team' => TeamMember::active()->get()]);
    }

    public function faqs()
    {
        return view('site.faqs', ['faqs' => Faq::active()->get()]);
    }

    public function contact()
    {
        return view('site.contact');
    }

    public function privacy()
    {
        return view('site.legal', ['title' => 'Privacy policy', 'kind' => 'privacy']);
    }

    public function terms()
    {
        return view('site.legal', ['title' => 'Terms and conditions', 'kind' => 'terms']);
    }
}
