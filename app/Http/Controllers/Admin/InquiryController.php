<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->paginate(20);

        return view('admin.inquiries', compact('inquiries'));
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return back()->with('success', 'Inquiry deleted.');
    }
}
