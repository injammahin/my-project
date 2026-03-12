@extends('layouts.admin')
@section('title', 'Landing Builder')

@section('content')
    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif

    <div class="max-w-5xl mx-auto space-y-6">

        <div class="bg-white p-6 rounded-2xl border">
            <h2 class="text-xl font-bold mb-4">Landing Settings</h2>

            <form method="POST" action="{{ route('admin.landing.update') }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Meta Title</label>
                        <input name="meta_title" value="{{ $settings['meta_title'] ?? '' }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Meta Keywords</label>
                        <input name="meta_keywords" value="{{ $settings['meta_keywords'] ?? '' }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm">Meta Description</label>
                        <textarea name="meta_description" class="w-full border rounded px-3 py-2"
                            rows="2">{{ $settings['meta_description'] ?? '' }}</textarea>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm">Button Color</label>
                        <input name="button_color" value="{{ $settings['button_color'] ?? '#1f2d1f' }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Background Color</label>
                        <input name="background_color" value="{{ $settings['background_color'] ?? '#efddd3cd' }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Accent Color</label>
                        <input name="accent_color" value="{{ $settings['accent_color'] ?? '#7db343' }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Landing Logo</label>
                        <input type="file" name="landing_logo" class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Hero Image</label>
                        <input type="file" name="hero_image" class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Hero Title</label>
                        <input name="hero_title" value="{{ $settings['hero_title'] ?? '' }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Hero Subtitle</label>
                        <input name="hero_subtitle" value="{{ $settings['hero_subtitle'] ?? '' }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm">Hero Description</label>
                        <textarea name="hero_description" class="w-full border rounded px-3 py-2"
                            rows="2">{{ $settings['hero_description'] ?? '' }}</textarea>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm">Delivery Charge</label>
                        <input name="delivery_charge" value="{{ $settings['delivery_charge'] ?? 60 }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Products Discount Badge</label>
                        <input name="products_discount_badge"
                            value="{{ $settings['products_discount_badge'] ?? '15% OFF' }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Order Title (BN)</label>
                        <input name="order_title_bn" value="{{ $settings['order_title_bn'] ?? 'অর্ডার করুন' }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">Facebook URL</label>
                        <input name="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                    <div>
                        <label class="text-sm">Instagram URL</label>
                        <input name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}"
                            class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <button class="px-5 py-2 rounded bg-black text-white">Save Settings</button>
            </form>
        </div>

        <div class="bg-white p-6 rounded-2xl border">
            <h2 class="text-xl font-bold mb-4">Manage Items</h2>
            <div class="flex flex-wrap gap-3">
                <a class="px-4 py-2 rounded bg-gray-100" href="{{ route('admin.landing.products.index') }}">Products</a>
                <a class="px-4 py-2 rounded bg-gray-100"
                    href="{{ route('admin.landing.ingredients.index') }}">Ingredients</a>
                <a class="px-4 py-2 rounded bg-gray-100"
                    href="{{ route('admin.landing.testimonials.index') }}">Testimonials</a>
            </div>
        </div>

    </div>
@endsection