<?php

namespace App\Http\Controllers;

use App\Models\Development;
use App\Models\Enquiry;
use App\Models\Property;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EnquiryController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|max:160',
            'phone' => 'nullable|string|max:40',
            'interest' => 'required|in:'.implode(',', array_keys(Enquiry::INTERESTS)),
            'property_id' => 'nullable|integer|exists:properties,id',
            'development_id' => 'nullable|integer|exists:developments,id',
            'unit_size' => 'nullable|string|max:60',
            'message' => 'nullable|string|max:3000',
            'website' => 'max:0', // honeypot: real people leave this empty
        ]);
        unset($data['website']);

        $data['reference'] = 'KP-'.date('ymd').'-'.strtoupper(Str::random(4));
        $enquiry = Enquiry::create($data);

        if ($to = Setting::get('notify_email')) {
            try {
                $about = $enquiry->property?->title ?? $enquiry->development?->name ?? 'General';
                $body = "New enquiry {$enquiry->reference}\n\nName: {$enquiry->name}\nEmail: {$enquiry->email}\nPhone: {$enquiry->phone}\nInterest: {$enquiry->interestLabel()}\nAbout: {$about}\nUnit size: {$enquiry->unit_size}\n\n{$enquiry->message}\n\n".route('admin.enquiries.show', $enquiry->id);
                Mail::raw($body, fn ($m) => $m->to($to)->replyTo($enquiry->email)->subject("New enquiry {$enquiry->reference}"));
            } catch (\Throwable $e) {
                report($e); // the enquiry is already saved, so never lose it because mail failed
            }
        }

        return back()->with('success', "Thank you, {$enquiry->name}. We have your enquiry (reference {$enquiry->reference}) and will call or email you shortly.");
    }
}
