<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // $settings is already shared globally, but we can still pass it.
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            // Colors
            'background_color' => ['nullable','string','max:20'],
            'button_color'     => ['nullable','string','max:20'],

            // Branding files
            'landing_logo' => ['nullable','image','mimes:png,jpg,jpeg,webp','max:2048'],
            'favicon'      => ['nullable','image','mimes:png,ico,jpg,jpeg,webp','max:1024'],
            'meta_image'   => ['nullable','image','mimes:png,jpg,jpeg,webp','max:2048'],

            // SEO
            'meta_title'       => ['nullable','string','max:70'],
            'meta_description' => ['nullable','string','max:160'],
            'meta_keywords'    => ['nullable','string','max:255'],

            // Contact / Footer
            'contact_phone'   => ['nullable','string','max:50'],
            'contact_email'   => ['nullable','email','max:120'],
            'contact_address' => ['nullable','string','max:255'],
            'footer_text'     => ['nullable','string','max:255'],

            // Social
            'facebook_url'  => ['nullable','url','max:255'],
            'instagram_url' => ['nullable','url','max:255'],
            'whatsapp_url'  => ['nullable','url','max:255'],
            'twitter_url'   => ['nullable','url','max:255'],
            'tiktok_url'    => ['nullable','url','max:255'],
            'linkedin_url'  => ['nullable','url','max:255'],

            // Checkout / misc
            'currency_symbol' => ['nullable','string','max:10'],
            'delivery_charge' => ['nullable','numeric','min:0','max:99999'],

            // Tracking / scripts
            'facebook_pixel_id' => ['nullable','string','max:80'],
            'google_analytics'  => ['nullable','string','max:80'],
            'custom_head'       => ['nullable','string'],
            'custom_body'       => ['nullable','string'],
        ]);

        // Save normal fields
        $keys = [
            'background_color','button_color',
            'meta_title','meta_description','meta_keywords',
            'contact_phone','contact_email','contact_address',
            'footer_text',
            'facebook_url','instagram_url','whatsapp_url','twitter_url','tiktok_url','linkedin_url',
            'currency_symbol','delivery_charge',
            'facebook_pixel_id','google_analytics','custom_head','custom_body',
        ];

        foreach ($keys as $k) {
            Setting::set($k, $data[$k] ?? null);
        }

        // Files => store in public/settings and save path like "settings/xxxx.png"
        if ($request->hasFile('landing_logo')) {
            $path = $request->file('landing_logo')->store('settings', 'public');
            Setting::set('landing_logo', $path);
        }

        if ($request->hasFile('favicon')) {
            $path = $request->file('favicon')->store('settings', 'public');
            Setting::set('favicon', $path);
        }

        if ($request->hasFile('meta_image')) {
            $path = $request->file('meta_image')->store('settings', 'public');
            Setting::set('meta_image', $path);
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
