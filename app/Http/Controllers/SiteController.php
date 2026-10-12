<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function home()
    {
        $products = Product::where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();

        return view('home', compact('products'));
    }

    public function inquiry(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'phone'    => 'required|string|max:30',
            'email'    => 'nullable|email|max:150',
            'product'  => 'nullable|string|max:100',
            'quantity' => 'nullable|string|max:30',
            'message'  => 'nullable|string|max:2000',
        ]);

        Inquiry::create($data);

        try {
            $body = collect($data)->map(fn ($v, $k) => ucfirst($k) . ': ' . ($v ?: '-'))->implode("\n");
            Mail::raw($body, function ($m) use ($data) {
                $m->to(Setting::pairs()['email'])->subject('New inquiry from ' . $data['name']);
            });
        } catch (\Throwable $e) {
            Log::warning('Inquiry mail failed: ' . $e->getMessage());
        }

        return redirect()->to(route('home') . '#contact')
            ->with('success', 'Thank you! We received your inquiry and will contact you shortly.');
    }
}
