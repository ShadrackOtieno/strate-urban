<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate(['email' => 'required|email|max:160', 'website' => 'max:0']);
        Subscriber::firstOrCreate(['email' => strtolower($data['email'])]);

        return back()->with('success', 'You are subscribed. We will send you new listings and updates.');
    }
}
