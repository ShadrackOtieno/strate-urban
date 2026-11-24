<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function index()
    {
        return view('admin.subscribers', ['subscribers' => Subscriber::latest()->paginate(30)]);
    }

    public function export()
    {
        $rows = Subscriber::orderBy('id')->pluck('created_at', 'email');

        return response()->streamDownload(function () use ($rows) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['email', 'subscribed_at']);
            foreach ($rows as $email => $at) {
                fputcsv($out, [$email, $at]);
            }
            fclose($out);
        }, 'subscribers.csv', ['Content-Type' => 'text/csv']);
    }

    public function destroy(Subscriber $subscriber)
    {
        $subscriber->delete();
        return back()->with('success', 'Subscriber removed.');
    }
}
