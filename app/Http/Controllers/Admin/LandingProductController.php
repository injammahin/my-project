<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingProduct;
use Illuminate\Http\Request;

class LandingProductController extends Controller
{
    public function index()
    {
        $products = LandingProduct::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return view('admin.landing.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string|max:1000',
            'variant'       => 'nullable|string|max:255',
            'sale_price'    => 'required|numeric|min:0',
            'regular_price' => 'nullable|numeric|min:0',
            'sort_order'    => 'nullable|integer',
            'is_active'     => 'nullable|boolean',
            'image'         => 'nullable|image|max:2048',
        ]);

        $data = [
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'size_label'  => $validated['variant'] ?? null,
            'price'       => (int) $validated['sale_price'],
            'old_price'   => isset($validated['regular_price']) ? (int) $validated['regular_price'] : null,
            'sort_order'  => (int) ($validated['sort_order'] ?? 0),
            'is_active'   => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('landing/products', 'public');
        }

        LandingProduct::create($data);

        return back()->with('success', 'Product added!');
    }

    public function update(Request $request, LandingProduct $product)
    {
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string|max:1000',
            'variant'       => 'nullable|string|max:255',
            'sale_price'    => 'required|numeric|min:0',
            'regular_price' => 'nullable|numeric|min:0',
            'sort_order'    => 'nullable|integer',
            'is_active'     => 'nullable|boolean',
            'image'         => 'nullable|image|max:2048',
        ]);

        $data = [
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'size_label'  => $validated['variant'] ?? null,
            'price'       => (int) $validated['sale_price'],
            'old_price'   => isset($validated['regular_price']) ? (int) $validated['regular_price'] : null,
            'sort_order'  => (int) ($validated['sort_order'] ?? 0),
            'is_active'   => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('landing/products', 'public');
        }

        $product->update($data);

        return back()->with('success', 'Product updated!');
    }

    public function destroy(LandingProduct $product)
    {
        $product->delete();

        return back()->with('success', 'Product deleted!');
    }
}