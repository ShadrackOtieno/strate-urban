<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $q = Enquiry::with(['property', 'development'])->latest();
        if ($status = $request->query('status')) {
            $q->where('status', $status);
        }
        return view('admin.enquiries.index', ['enquiries' => $q->paginate(20)->withQueryString()]);
    }

    public function show(Enquiry $enquiry)
    {
        $enquiry->load(['property', 'development']);
        return view('admin.enquiries.show', compact('enquiry'));
    }

    public function update(Request $request, Enquiry $enquiry)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(Enquiry::STATUSES))],
            'admin_notes' => 'nullable|string|max:5000',
        ]);
        $enquiry->update($data);
        return back()->with('success', 'Enquiry updated.');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry deleted.');
    }
}
