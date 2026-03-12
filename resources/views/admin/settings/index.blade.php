{{-- resources/views/admin/settings/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
    @php
        // ---------- Helpers ----------
        $resolveUrl = function ($raw) {
            if (!$raw)
                return null;

            // full URL
            if (str_starts_with($raw, 'http://') || str_starts_with($raw, 'https://'))
                return $raw;

            // already like "storage/settings/xxx.png"
            if (str_starts_with($raw, 'storage/'))
                return asset($raw);

            // absolute path like "/storage/settings/xxx.png" or "/img/logo.png"
            if (str_starts_with($raw, '/'))
                return asset(ltrim($raw, '/'));

            // default: assume stored on public disk, like "settings/xxx.png"
            return asset('storage/' . ltrim($raw, '/'));
        };

        // ---------- Current settings ----------
        $bgColor = $settings['background_color'] ?? '#efddd3';
        $btnColor = $settings['button_color'] ?? '#1f2d1f';

        $logoUrl = $resolveUrl($settings['landing_logo'] ?? null);
        $faviconUrl = $resolveUrl($settings['favicon'] ?? null);
        $metaImgUrl = $resolveUrl($settings['meta_image'] ?? null);

        $fieldsSocial = [
            ['key' => 'facebook_url', 'label' => 'Facebook URL', 'icon' => 'fa-brands fa-facebook-f', 'ph' => 'https://facebook.com/yourpage'],
            ['key' => 'instagram_url', 'label' => 'Instagram URL', 'icon' => 'fa-brands fa-instagram', 'ph' => 'https://instagram.com/yourprofile'],
            ['key' => 'whatsapp_url', 'label' => 'WhatsApp URL', 'icon' => 'fa-brands fa-whatsapp', 'ph' => 'https://wa.me/8801xxxxxxxxx'],
            ['key' => 'twitter_url', 'label' => 'Twitter / X', 'icon' => 'fa-brands fa-x-twitter', 'ph' => 'https://x.com/yourhandle'],
            ['key' => 'tiktok_url', 'label' => 'TikTok URL', 'icon' => 'fa-brands fa-tiktok', 'ph' => 'https://tiktok.com/@yourprofile'],
            ['key' => 'linkedin_url', 'label' => 'LinkedIn URL', 'icon' => 'fa-brands fa-linkedin-in', 'ph' => 'https://linkedin.com/company/yourcompany'],
        ];
    @endphp

    <div class="max-w-6xl mx-auto py-6 sm:py-10">

        {{-- Header --}}
        <div class="mb-6 sm:mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 flex items-center gap-3">
                        <span class="w-10 h-10 rounded-2xl bg-emerald-600/10 text-emerald-700 grid place-items-center">
                            <i class="fa-solid fa-sliders"></i>
                        </span>
                        Website Settings
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Control landing branding, SEO, checkout, footer, social and tracking from one place.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-white border px-3 py-1 text-xs text-gray-700 shadow-sm">
                        <i class="fa-solid fa-palette text-emerald-600"></i> Theme
                    </span>
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-white border px-3 py-1 text-xs text-gray-700 shadow-sm">
                        <i class="fa-solid fa-magnifying-glass text-indigo-600"></i> SEO
                    </span>
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-white border px-3 py-1 text-xs text-gray-700 shadow-sm">
                        <i class="fa-solid fa-cart-shopping text-orange-600"></i> Checkout
                    </span>
                    <span
                        class="inline-flex items-center gap-2 rounded-full bg-white border px-3 py-1 text-xs text-gray-700 shadow-sm">
                        <i class="fa-solid fa-code text-gray-700"></i> Tracking
                    </span>
                </div>
            </div>
        </div>

        {{-- Success --}}
        @if(session('success'))
            <div
                class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-900 flex items-start gap-3">
                <i class="fa-solid fa-circle-check mt-0.5 text-emerald-600"></i>
                <div>
                    <div class="font-semibold">Saved!</div>
                    <div class="text-sm text-emerald-800/90">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        {{-- Errors --}}
        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-5 py-4 text-rose-900">
                <div class="font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Please fix the errors below
                </div>
                <ul class="mt-2 text-sm list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf

            {{-- Main Card --}}
            <div
                class="bg-white/80 backdrop-blur-xl border border-white/60 rounded-3xl shadow-[0_20px_60px_rgba(0,0,0,0.08)] overflow-hidden">
                {{-- Top Gradient Bar --}}
                <div class="h-2" style="background: linear-gradient(90deg, {{ $btnColor }}, {{ $bgColor }});"></div>

                <div class="p-6 sm:p-8 space-y-10">

                    {{-- ================= BRAND COLORS ================= --}}
                    {{-- <section class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <i class="fa-solid fa-palette text-emerald-600"></i>
                                Brand Colors
                            </h2>
                            <span class="text-xs text-gray-500">Used by landing + UI variables</span>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Background Color</label>
                                    <div class="flex items-center gap-3 rounded-2xl border bg-white px-4 py-3">
                                        <input type="color" name="background_color" value="{{ $bgColor }}"
                                            class="h-10 w-14 rounded-xl border cursor-pointer">
                                        <div class="flex-1">
                                            <div class="text-xs text-gray-500">Current</div>
                                            <div class="font-semibold text-gray-800">{{ $bgColor }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700">Button Color</label>
                                    <div class="flex items-center gap-3 rounded-2xl border bg-white px-4 py-3">
                                        <input type="color" name="button_color" value="{{ $btnColor }}"
                                            class="h-10 w-14 rounded-xl border cursor-pointer">
                                        <div class="flex-1">
                                            <div class="text-xs text-gray-500">Current</div>
                                            <div class="font-semibold text-gray-800">{{ $btnColor }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-3xl border bg-white p-5">
                                <div class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                                    <i class="fa-solid fa-eye text-gray-500"></i>
                                    Preview
                                </div>

                                <div class="mt-4 rounded-2xl p-5 border" style="background: {{ $bgColor }};">
                                    <div class="flex items-center justify-between gap-3">
                                        <div>
                                            <div class="text-xs text-gray-600">Brand</div>
                                            <div class="text-lg font-extrabold text-gray-900">
                                                {{ config('app.name') }}
                                            </div>
                                        </div>
                                        <button type="button"
                                            class="px-4 py-2 rounded-full text-white text-sm font-semibold shadow"
                                            style="background: {{ $btnColor }};">
                                            Action
                                        </button>
                                    </div>
                                </div>

                                <p class="mt-3 text-xs text-gray-500">
                                    This is only a preview. Click <b>Save Settings</b> to apply.
                                </p>
                            </div>
                        </div>
                    </section> --}}

                    <div class="h-px bg-gray-100"></div>

                    {{-- ================= BRANDING FILES ================= --}}
                    <section class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <i class="fa-solid fa-image text-purple-600"></i>
                                Branding (Logo / Favicon / Share Image)
                            </h2>
                            <span class="text-xs text-gray-500">Uploads are saved in storage</span>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                            {{-- Uploads --}}
                            <div class="lg:col-span-2 rounded-3xl border bg-white p-6 space-y-5">
                                {{-- Landing Logo --}}
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Landing Logo</label>
                                    <input type="file" name="landing_logo" accept="image/*"
                                        class="mt-2 w-full rounded-2xl border bg-white px-4 py-3 text-sm">
                                    <p class="mt-1 text-xs text-gray-500">Used in landing header. PNG recommended.</p>
                                </div>

                                {{-- Favicon --}}
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Favicon</label>
                                    <input type="file" name="favicon" accept="image/*"
                                        class="mt-2 w-full rounded-2xl border bg-white px-4 py-3 text-sm">
                                    <p class="mt-1 text-xs text-gray-500">Browser tab icon. Small square image works best.
                                    </p>
                                </div>

                                {{-- Meta Image --}}
                                <div>
                                    <label class="text-sm font-medium text-gray-700">OG Share Image (Meta Image)</label>
                                    <input type="file" name="meta_image" accept="image/*"
                                        class="mt-2 w-full rounded-2xl border bg-white px-4 py-3 text-sm">
                                    <p class="mt-1 text-xs text-gray-500">Used when sharing on Facebook/WhatsApp.</p>
                                </div>
                            </div>

                            {{-- Current previews --}}
                            <div class="rounded-3xl border bg-white p-6 space-y-4">
                                <div class="text-sm font-semibold text-gray-800 flex items-center gap-2">
                                    <i class="fa-solid fa-circle-info text-gray-500"></i>
                                    Current Files
                                </div>

                                <div class="rounded-2xl border bg-gray-50 p-4">
                                    <div class="text-xs text-gray-500 mb-2">Landing Logo</div>
                                    <div class="flex items-center justify-center min-h-[80px]">
                                        @if($logoUrl)
                                            <img src="{{ $logoUrl }}" class="h-14 object-contain" alt="Landing Logo">
                                        @else
                                            <div class="text-sm text-gray-500">Not set</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="rounded-2xl border bg-gray-50 p-4">
                                    <div class="text-xs text-gray-500 mb-2">Favicon</div>
                                    <div class="flex items-center justify-center min-h-[80px]">
                                        @if($faviconUrl)
                                            <img src="{{ $faviconUrl }}" class="h-10 w-10 object-contain" alt="Favicon">
                                        @else
                                            <div class="text-sm text-gray-500">Not set</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="rounded-2xl border bg-gray-50 p-4">
                                    <div class="text-xs text-gray-500 mb-2">OG Share Image</div>
                                    <div class="flex items-center justify-center min-h-[80px]">
                                        @if($metaImgUrl)
                                            <img src="{{ $metaImgUrl }}" class="h-20 object-contain" alt="Meta Image">
                                        @else
                                            <div class="text-sm text-gray-500">Not set</div>
                                        @endif
                                    </div>
                                </div>

                                <p class="text-xs text-gray-500">
                                    If a file is empty, it will be hidden in frontend automatically (if your welcome page
                                    checks it).
                                </p>
                            </div>

                        </div>
                    </section>

                    <div class="h-px bg-gray-100"></div>

                    {{-- ================= SEO ================= --}}
                    <section class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <i class="fa-solid fa-magnifying-glass text-indigo-600"></i>
                                SEO (Meta Title / Description / Keywords)
                            </h2>
                            <span class="text-xs text-gray-500">Used in landing page head tags</span>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <div class="lg:col-span-2 rounded-3xl border bg-white p-6 space-y-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Meta Title</label>
                                    <input name="meta_title" value="{{ $settings['meta_title'] ?? '' }}"
                                        class="mt-2 w-full rounded-2xl border bg-white px-4 py-3 text-sm"
                                        placeholder="Keshoriya Organic Hair Oil (max 70 chars)">
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-700">Meta Description</label>
                                    <textarea name="meta_description" rows="3"
                                        class="mt-2 w-full rounded-2xl border bg-white px-4 py-3 text-sm"
                                        placeholder="Short description (max 160 chars)">{{ $settings['meta_description'] ?? '' }}</textarea>
                                </div>

                                <div>
                                    <label class="text-sm font-medium text-gray-700">Meta Keywords</label>
                                    <input name="meta_keywords" value="{{ $settings['meta_keywords'] ?? '' }}"
                                        class="mt-2 w-full rounded-2xl border bg-white px-4 py-3 text-sm"
                                        placeholder="hair oil, organic, bangladesh...">
                                </div>
                            </div>

                            <div class="rounded-3xl border bg-white p-6">
                                <div class="text-sm font-semibold text-gray-800">Quick Tips</div>
                                <ul class="mt-3 text-sm text-gray-600 space-y-2 list-disc pl-5">
                                    <li>Title: 50–70 chars</li>
                                    <li>Description: 120–160 chars</li>
                                    <li>Keywords: optional</li>
                                    <li>OG Image: set above</li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <div class="h-px bg-gray-100"></div>

                    {{-- ================= CONTACT & CHECKOUT ================= --}}
                    <section class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <i class="fa-solid fa-cart-shopping text-orange-600"></i>
                                Contact & Checkout
                            </h2>
                            <span class="text-xs text-gray-500">Used in footer + order section</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="rounded-2xl border bg-white px-4 py-3">
                                <label class="text-xs font-semibold text-gray-600">Contact Phone</label>
                                <input name="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}"
                                    class="mt-1 w-full bg-transparent outline-none text-sm text-gray-900 placeholder:text-gray-400"
                                    placeholder="+880 1XXXXXXXXX">
                            </div>

                            <div class="rounded-2xl border bg-white px-4 py-3">
                                <label class="text-xs font-semibold text-gray-600">Contact Email</label>
                                <input name="contact_email" value="{{ $settings['contact_email'] ?? '' }}"
                                    class="mt-1 w-full bg-transparent outline-none text-sm text-gray-900 placeholder:text-gray-400"
                                    placeholder="example@gmail.com">
                            </div>

                            <div class="rounded-2xl border bg-white px-4 py-3 md:col-span-2">
                                <label class="text-xs font-semibold text-gray-600">Contact Address</label>
                                <input name="contact_address" value="{{ $settings['contact_address'] ?? '' }}"
                                    class="mt-1 w-full bg-transparent outline-none text-sm text-gray-900 placeholder:text-gray-400"
                                    placeholder="Dhaka, Bangladesh">
                            </div>

                            <div class="rounded-2xl border bg-white px-4 py-3">
                                <label class="text-xs font-semibold text-gray-600">Currency Symbol</label>
                                <input name="currency_symbol" value="{{ $settings['currency_symbol'] ?? '৳' }}"
                                    class="mt-1 w-full bg-transparent outline-none text-sm text-gray-900 placeholder:text-gray-400"
                                    placeholder="৳">
                            </div>

                            <div class="rounded-2xl border bg-white px-4 py-3">
                                <label class="text-xs font-semibold text-gray-600">Delivery Charge</label>
                                <input type="number" name="delivery_charge" value="{{ $settings['delivery_charge'] ?? 60 }}"
                                    class="mt-1 w-full bg-transparent outline-none text-sm text-gray-900 placeholder:text-gray-400"
                                    placeholder="60">
                            </div>

                            <div class="rounded-2xl border bg-white px-4 py-3 md:col-span-2">
                                <label class="text-xs font-semibold text-gray-600">Footer Text</label>
                                <input name="footer_text" value="{{ $settings['footer_text'] ?? '' }}"
                                    class="mt-1 w-full bg-transparent outline-none text-sm text-gray-900 placeholder:text-gray-400"
                                    placeholder="© 2026 All rights reserved. Developed by NexolioIT">
                            </div>
                        </div>
                    </section>

                    <div class="h-px bg-gray-100"></div>

                    {{-- ================= SOCIAL LINKS ================= --}}
                    <section class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <i class="fa-solid fa-link text-blue-600"></i>
                                Social Links
                            </h2>
                            <span class="text-xs text-gray-500">Leave empty to hide</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @foreach($fieldsSocial as $f)
                                <div class="rounded-2xl border bg-white px-4 py-3 flex items-center gap-3">
                                    <span class="w-10 h-10 rounded-2xl bg-gray-900/5 text-gray-800 grid place-items-center">
                                        <i class="{{ $f['icon'] }}"></i>
                                    </span>

                                    <div class="flex-1">
                                        <label class="text-xs font-semibold text-gray-600">{{ $f['label'] }}</label>
                                        <input type="url" name="{{ $f['key'] }}" value="{{ $settings[$f['key']] ?? '' }}"
                                            placeholder="{{ $f['ph'] }}"
                                            class="mt-1 w-full bg-transparent outline-none text-sm text-gray-900 placeholder:text-gray-400">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <div class="h-px bg-gray-100"></div>

                    {{-- ================= TRACKING / CUSTOM SCRIPTS ================= --}}
                    <section class="space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <i class="fa-solid fa-code text-gray-700"></i>
                                Tracking / Custom Scripts
                            </h2>
                            <span class="text-xs text-gray-500">Optional</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="rounded-2xl border bg-white px-4 py-3">
                                <label class="text-xs font-semibold text-gray-600">Facebook Pixel ID</label>
                                <input name="facebook_pixel_id" value="{{ $settings['facebook_pixel_id'] ?? '' }}"
                                    class="mt-1 w-full bg-transparent outline-none text-sm text-gray-900 placeholder:text-gray-400"
                                    placeholder="1234567890">
                            </div>

                            <div class="rounded-2xl border bg-white px-4 py-3">
                                <label class="text-xs font-semibold text-gray-600">Google Analytics ID</label>
                                <input name="google_analytics" value="{{ $settings['google_analytics'] ?? '' }}"
                                    class="mt-1 w-full bg-transparent outline-none text-sm text-gray-900 placeholder:text-gray-400"
                                    placeholder="G-XXXXXXX">
                            </div>

                            <div class="rounded-2xl border bg-white px-4 py-3 md:col-span-2">
                                <label class="text-xs font-semibold text-gray-600">Custom HEAD</label>
                                <textarea name="custom_head" rows="4"
                                    class="mt-2 w-full rounded-xl border bg-white px-3 py-2 text-sm font-mono"
                                    placeholder="Paste custom <style> or <script> that should go inside <head>">{{ $settings['custom_head'] ?? '' }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Example: chat widget, verification tags, etc.</p>
                            </div>

                            <div class="rounded-2xl border bg-white px-4 py-3 md:col-span-2">
                                <label class="text-xs font-semibold text-gray-600">Custom BODY</label>
                                <textarea name="custom_body" rows="4"
                                    class="mt-2 w-full rounded-xl border bg-white px-3 py-2 text-sm font-mono"
                                    placeholder="Paste scripts that should go before </body>">{{ $settings['custom_body'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </section>

                </div>
            </div>

            {{-- Sticky Save Bar --}}
            <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="text-xs text-gray-500 flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-gray-400"></i>
                    Changes apply after saving.
                </div>

                <button type="submit" class="inline-flex items-center justify-center gap-2
                                   px-7 py-3 rounded-full text-white font-semibold
                                   shadow-lg hover:shadow-xl transition hover:scale-[1.01]"
                    style="background: linear-gradient(90deg, {{ $btnColor }}, #111827);">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Settings
                </button>
            </div>

            {{-- Mobile sticky button --}}
            <div class="fixed left-0 right-0 bottom-0 p-4 bg-white/70 backdrop-blur-xl border-t sm:hidden">
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2
                                   px-6 py-3 rounded-full text-white font-semibold shadow-lg"
                    style="background: {{ $btnColor }};">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Save Settings
                </button>
            </div>

        </form>

    </div>
@endsection