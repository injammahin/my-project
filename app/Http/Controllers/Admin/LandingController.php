<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use App\Models\ContactMessage;

class LandingController extends Controller
{
    public function edit()
    {
        // assuming you already store settings like key/value
        $settings = Setting::pluck('value', 'key')->toArray();

        return view('admin.landing.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'background_color' => 'nullable|string|max:20',
            'button_color'     => 'nullable|string|max:20',

            'facebook_url'     => 'nullable|string|max:255',
            'instagram_url'    => 'nullable|string|max:255',
            'whatsapp_url'     => 'nullable|string|max:255',
            'twitter_url'      => 'nullable|string|max:255',
            'tiktok_url'       => 'nullable|string|max:255',
            'linkedin_url'     => 'nullable|string|max:255',

            'landing_logo'     => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['_token', '_method']);

        // upload logo
        if ($request->hasFile('landing_logo')) {
            $path = $request->file('landing_logo')->store('settings', 'public');
            $data['landing_logo'] = '/storage/' . $path;
        }

        foreach ($data as $key => $val) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $val]
            );
        }

        return back()->with('success', 'Landing settings updated successfully!');
    }

    // Sidebar pages (stubs for now)
    public function products()
    {
        return view('admin.landing.products.index');
    }

    public function ingredients()
    {
        return view('admin.landing.ingredients.index');
    }

    public function testimonials()
    {
        return view('admin.landing.testimonials.index');
    }
     public function showContact(ContactMessage $contact)
    {
        return view('admin.landing.contacts.show', compact('contact'));
    }
}
