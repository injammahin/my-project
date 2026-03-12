<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingTestimonial;
use Illuminate\Http\Request;

class LandingTestimonialController extends Controller
{
    public function index()
    {
        return view('admin.landing.testimonials.index', [
            'rows' => LandingTestimonial::orderBy('sort_order')->latest()->paginate(30)
        ]);
    }

    public function create()
    {
        return view('admin.landing.testimonials.form', ['row' => new LandingTestimonial()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'message' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|max:10240',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int)($data['sort_order'] ?? 0);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('landing/testimonials', 'public');
        }

        LandingTestimonial::create($data);

        return redirect()->route('admin.landing.testimonials.index')->with('success', 'Testimonial added!');
    }

    public function edit(LandingTestimonial $testimonial)
    {
        return view('admin.landing.testimonials.form', ['row' => $testimonial]);
    }

    public function update(Request $request, LandingTestimonial $testimonial)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'message' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);
        $data['sort_order'] = (int)($data['sort_order'] ?? 0);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('landing/testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.landing.testimonials.index')->with('success', 'Testimonial updated!');
    }

    public function destroy(LandingTestimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimonial deleted!');
    }
}
