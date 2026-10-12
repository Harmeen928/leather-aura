<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $product = new Product(['is_active' => true, 'sort_order' => (int) Product::max('sort_order') + 1]);

        return view('admin.products.create', compact('product'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);
        $data['image'] = $this->saveImage($request->file('image'));

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product added.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('image')) {
            $this->deleteImage($product->image);
            $data['image'] = $this->saveImage($request->file('image'));
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        $this->deleteImage($product->image);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }

    private function validated(Request $request, bool $imageRequired): array
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'line1'       => 'nullable|string|max:40',
            'line2'       => 'nullable|string|max:40',
            'description' => 'nullable|string|max:400',
            'sort_order'  => 'nullable|integer|min:0|max:9999',
            'image'       => ($imageRequired ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        unset($data['image']);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active']  = $request->boolean('is_active');

        return $data;
    }

    private function saveImage($file): string
    {
        $name = Str::random(24) . '.' . $file->extension();
        $file->move(public_path('uploads/products'), $name);

        return 'uploads/products/' . $name;
    }

    private function deleteImage(?string $path): void
    {
        // Sirf client ki upload ki hui images delete hongi, default images nahi
        if ($path && str_starts_with($path, 'uploads/products/')) {
            $full = public_path($path);
            if (is_file($full)) {
                @unlink($full);
            }
        }
    }
}
