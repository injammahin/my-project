<?php

namespace App\Http\Controllers\Admin;

use App\Models\ComboProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
class ComboProductController extends Controller
{
    // Display a listing of combo products
    public function index()
    {
        // Fetch all combo products ordered by 'sort_order' and 'id' in descending order
        $comboProducts = ComboProduct::orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(20);

        // Fetch the top 3 best-sellers
        $bestSellers = ComboProduct::where('is_best_seller', true)
            ->orderBy('sort_order', 'asc')
            ->take(3)
            ->get();

        return view('admin.landing.combo_products.index', compact('comboProducts', 'bestSellers'));
    }

    // Show the form for creating a new combo product
    public function create()
    {
        return view('admin.landing.combo_products.create');
    }

    // Store a newly created combo product in the database
    public function store(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'sale_price'    => 'required|numeric|min:0',
            'regular_price' => 'nullable|numeric|min:0',
            'sort_order'    => 'nullable|integer',
            'is_active'     => 'nullable|boolean',
            'gift_name'     => 'nullable|string|max:255',
            'gift_image'    => 'nullable|image|max:2048',
            'image'         => 'nullable|image|max:2048',
            'is_best_seller'=> 'nullable|boolean',
        ]);

        // Prepare data for saving
        $data = [
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'sale_price'  => (float) $validated['sale_price'],
            'regular_price' => isset($validated['regular_price']) ? (float) $validated['regular_price'] : null,
            'sort_order'  => (int) ($validated['sort_order'] ?? 0),
            'is_active'   => $request->boolean('is_active', true),
            'gift_name'   => $validated['gift_name'],
            'is_best_seller' => $validated['is_best_seller'] ?? false,
        ];

        // Handle gift image upload
        if ($request->hasFile('gift_image')) {
            $data['gift_image'] = $request->file('gift_image')->store('combo_products/gifts', 'public');
        }

        // Handle main product image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('combo_products', 'public');
        }

        // Create the new combo product
        ComboProduct::create($data);

        // Redirect to the index page with a success message
        return redirect()->route('admin.landing.combo_products.index')->with('success', 'Combo product added!');
    }

    // Show the form for editing the specified combo product
    public function edit(ComboProduct $comboProduct)
    {
        return view('admin.landing.combo_products.edit', compact('comboProduct'));
    }

    // Update the specified combo product in the database
    public function update(Request $request, ComboProduct $comboProduct)
    {
        // Validate input data
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'sale_price'    => 'required|numeric|min:0',
            'regular_price' => 'nullable|numeric|min:0',
            'sort_order'    => 'nullable|integer',
            'is_active'     => 'nullable|boolean',
            'gift_name'     => 'nullable|string|max:255',
            'gift_image'    => 'nullable|image|max:2048',
            'image'         => 'nullable|image|max:2048',
            'is_best_seller'=> 'nullable|boolean',
        ]);

        // Prepare data for updating
        $data = [
            'title'       => $validated['title'],
            'description' => $validated['description'] ?? null,
            'sale_price'  => (float) $validated['sale_price'],
            'regular_price' => isset($validated['regular_price']) ? (float) $validated['regular_price'] : null,
            'sort_order'  => (int) ($validated['sort_order'] ?? 0),
            'is_active'   => $request->boolean('is_active', true),
            'gift_name'   => $validated['gift_name'],
            'is_best_seller' => $validated['is_best_seller'] ?? false,
        ];

        // Handle gift image upload
        if ($request->hasFile('gift_image')) {
            // Delete old gift image if exists
            if ($comboProduct->gift_image) {
                \Storage::delete('public/' . $comboProduct->gift_image);
            }
            $data['gift_image'] = $request->file('gift_image')->store('combo_products/gifts', 'public');
        }

        // Handle main product image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($comboProduct->image) {
                \Storage::delete('public/' . $comboProduct->image);
            }
            $data['image'] = $request->file('image')->store('combo_products', 'public');
        }

        // Update the combo product
        $comboProduct->update($data);

        // Redirect to the index page with a success message
        return redirect()->route('admin.landing.combo_products.index')->with('success', 'Combo product updated!');
    }

    // Remove the specified combo product from the database
    public function destroy(ComboProduct $comboProduct)
    {
        // Delete the combo product's image and gift image if they exist
        if ($comboProduct->image) {
            \Storage::delete('public/' . $comboProduct->image);
        }

        if ($comboProduct->gift_image) {
            \Storage::delete('public/' . $comboProduct->gift_image);
        }

        // Delete the combo product
        $comboProduct->delete();

        // Redirect back with a success message
        return back()->with('success', 'Combo product deleted!');
    }
    public function updateBestSellers(Request $request)
{
    // Validate selected combo products for best sellers
    $request->validate([
        'best_sellers' => 'array|required',
        'best_sellers.*' => 'exists:combo_products,id',
    ]);

    // First, reset the 'best_seller' column for all combo products
    ComboProduct::query()->update(['is_best_seller' => false]);

    // Then, mark the selected combo products as best sellers
    ComboProduct::whereIn('id', $request->best_sellers)->update(['is_best_seller' => true]);

    // Redirect back with a success message
    return redirect()->route('admin.landing.combo_products.index')
                     ->with('success', 'Best sellers updated successfully!');
}
}