<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingIngredient;
use Illuminate\Http\Request;

class LandingIngredientController extends Controller
{
    public function index()
    {
        return view('admin.landing.ingredients.index', [
            'rows' => LandingIngredient::orderBy('sort_order')->latest()->paginate(30)
        ]);
    }

    public function create()
    {
        return view('admin.landing.ingredients.form', ['row' => new LandingIngredient()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int)($data['sort_order'] ?? 0);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('landing/ingredients', 'public');
        }

        LandingIngredient::create($data);

        return redirect()->route('admin.landing.ingredients.index')->with('success', 'Ingredient added!');
    }

    public function edit(LandingIngredient $ingredient)
    {
        return view('admin.landing.ingredients.form', ['row' => $ingredient]);
    }

    public function update(Request $request, LandingIngredient $ingredient)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int)($data['sort_order'] ?? 0);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('landing/ingredients', 'public');
        }

        $ingredient->update($data);

        return redirect()->route('admin.landing.ingredients.index')->with('success', 'Ingredient updated!');
    }

    public function destroy(LandingIngredient $ingredient)
    {
        $ingredient->delete();
        return back()->with('success', 'Ingredient deleted!');
    }
}
