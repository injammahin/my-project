{{-- resources/views/welcome.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    @php
        /** @var array $settings */
        $settings = $settings ?? [];
        $products = $products ?? collect();
        $ingredients = $ingredients ?? collect();
        $testimonials = $testimonials ?? collect();
    @endphp

    @php
        use Illuminate\Support\Str;

        $get = function ($key, $default = null) use ($settings) {
            return $settings[$key] ?? $default;
        };

        $publicUrl = function ($raw) {
            if (!$raw)
                return null;

            // Full URL
            if (Str::startsWith($raw, ['http://', 'https://']))
                return $raw;

            // "/storage/..." => "storage/..."
            $raw = ltrim($raw, '/');

            // If already "storage/xxx"
            if (Str::startsWith($raw, 'storage/'))
                return asset($raw);

            // If is "settings/xxx" or "landing/xxx" inside public disk
            return asset('storage/' . $raw);
        };

        // ====== SEO ======
        $metaTitle = $get('meta_title', config('app.name') . ' | Landing page');
        $metaDescription = $get('meta_description', 'Premium organic hair oil brand in Bangladesh. Order online with cash on delivery.');
        $metaKeywords = $get('meta_keywords', 'organic hair oil, hair growth, anti hair fall, Bangladesh');
        $canonical = url('/');
        $ogImage = $publicUrl($get('meta_image')) ?? asset('img/logo.jpg');
        $favicon = $publicUrl($get('favicon')) ?? asset('img/logo/logo.jpg');

        // ====== Branding ======
        $landingLogoUrl = $publicUrl($get('landing_logo'));

        // ====== Theme ======
        $bgColor = $get('background_color', '#efddd3cd');
        $btnColor = $get('button_color', '#1f2d1f');

        // ====== Landing Text / Images ======
        $heroTitle = $get('hero_title', 'Keshoriya Organic Hair Oil');
        $heroSubtitle = $get('hero_subtitle', 'Pure Natural Organic Oil');
        $heroDescription = $get('hero_description', 'Keshoriya is a premium organic hair oil brand in Bangladesh, made with natural herbal ingredients to reduce hair fall, nourish roots, and promote healthy hair growth.');
        $heroLine2 = $get('hero_line_2', 'We believe in the power of nature without compromise');

        $heroImage = $publicUrl($get('hero_image')) ?? asset('img/assets/organic hair oil.png');
        $leafImage = $publicUrl($get('leaf_image')) ?? asset('img/assets/leef.png');

        // ====== Source section ======
        $sourceImage = $publicUrl($get('source_image')) ?? asset('img/assets/organnic oil.png');
        $sourceHeading = $get('source_heading', 'We Source Organically Grown Hemp From Family Owned Farms');

        // ====== Products section ======
        $productDiscountLabel = $get('product_discount_label', '15% OFF');

        // ====== Order / Checkout ======
        $currencySymbol = $get('currency_symbol', '৳');
        $deliveryCharge = (int) $get('delivery_charge', 60);

        // ====== Newsletter ======
        $newsletterTitle = $get('newsletter_title', 'Subscribe To Our Newsletter');
        $newsletterImage = $publicUrl($get('newsletter_image')) ?? asset('img/assets/pro-2 (1).png');

        // ====== Footer ======
        $footerText = $get('footer_text', '');
        $footerLogo = $publicUrl($get('footer_logo')) ?? asset('img/logo/logo (1).jpg');
        $contactPhone = $get('contact_phone', '+880 1967-014624');
        $contactEmail = $get('contact_email', 'keshoriyahairoil@gmail.com');
        $contactAddress = $get('contact_address', '');

        // Social
        $facebookUrl = $get('facebook_url');
        $instagramUrl = $get('instagram_url');
        $whatsappUrl = $get('whatsapp_url');
        $twitterUrl = $get('twitter_url');
        $tiktokUrl = $get('tiktok_url');
        $linkedinUrl = $get('linkedin_url');

        // Custom scripts
        $customHead = $get('custom_head');
        $customBody = $get('custom_body');
    @endphp

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ $canonical }}">
    <link rel="icon" type="image/png" href="{{ $favicon }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:type" content="website">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Theme Variables --}}
    <style>
        :root {
            --button:
                {{ $btnColor }}
            ;
            --brand-bg:
                {{ $bgColor }}
            ;
        }

        /* Safety fallback if Tailwind custom classes missing */
        .bg-brand {
            background: var(--brand-bg);
        }

        .bg-brand-accent {
            background: var(--button);
        }

        .text-brand {
            color: #111827;
        }

        /* Ingredient card (you used class="card" but didn’t define it) */
        .card {
            background: rgba(255, 255, 255, .65);
            border: 1px solid rgba(255, 255, 255, .55);
            border-radius: 18px;
            padding: 14px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .06);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 40px rgba(0, 0, 0, .10);
        }

        .card img {
            width: 74px;
            height: 74px;
            object-fit: contain;
        }

        /* Testimonials slider required CSS */
        .testimonial-slide {
            display: none;
        }

        .testimonial-slide.active {
            display: block;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: rgba(0, 0, 0, .2);
            transition: transform .2s ease, background .2s ease;
        }

        .dot.active {
            background: rgba(0, 0, 0, .6);
            transform: scale(1.15);
        }
    </style>

    {{-- Custom HEAD injected from settings --}}
    @if(!empty($customHead))
        {!! $customHead !!}
    @endif
</head>

<body class="bg-brand text-brand font-['Inter']">

    {{-- ================= HEADER ================= --}}
    <header>
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                @if($landingLogoUrl)
                    <img src="{{ $landingLogoUrl }}" alt="{{ config('app.name') }} Logo" class="h-16 sm:h-20" loading="lazy"
                        decoding="async">
                @else
                    <div class="text-xl font-extrabold text-[#1f2d1f]">
                        {{ config('app.name') }}
                    </div>
                @endif
            </div>

            <nav class="hidden md:flex items-center gap-10 text-sm font-medium text-[#1f2d1f]">
                <a href="#Company" onclick="trackEvent('nav_click', {section:'Company'})"
                    class="hover:text-green-700 transition">Company</a>
                <a href="#Product" onclick="trackEvent('nav_click', {section:'Product'})"
                    class="hover:text-green-700 transition">Product</a>
                <a href="#ingredients" onclick="trackEvent('nav_click', {section:'ingredients'})"
                    class="hover:text-green-700 transition">Ingredients</a>
                <a href="#order" onclick="trackEvent('nav_click', {section:'order'})"
                    class="hover:text-green-700 transition">Order</a>
            </nav>

            <div class="flex items-center gap-4 text-[#1f2d1f]">
                <button class="w-9 h-9 rounded-full flex items-center justify-center hover:bg-white/60 transition"
                    aria-label="Search">
                    🔍
                </button>
                <button id="menuBtn"
                    class="w-9 h-9 rounded-full flex items-center justify-center hover:bg-white/60 transition md:hidden"
                    aria-label="Menu">
                    ☰
                </button>
            </div>
        </div>

        <div id="mobileMenu" class="md:hidden hidden px-6 py-6 space-y-4 text-[#1f2d1f] font-medium">
            <a href="#Company" class="block">Company</a>
            <a href="#Product" class="block">Product</a>
            <a href="#ingredients" class="block">Ingredients</a>
            <a href="#order" class="block">Order</a>
        </div>
    </header>

    {{-- ================= HERO ================= --}}
    <section id="Company" class="relative overflow-hidden">
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 pt-24 pb-28 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div class="relative flex justify-center lg:justify-end order-1 lg:order-2">
                <div class="absolute bottom-6 w-[320px] h-[80px]rounded-full"></div>

                <img src="{{ $heroImage }}" loading="lazy" decoding="async" alt="Hero Image" class="relative w-[350px] sm:w-[420px] lg:w-[480px]
                           drop-shadow-[0_50px_100px_rgba(0,0,0,0.25)]
                           transition-transform duration-700 hover:scale-[1.03]">
            </div>

            <div class="text-center lg:text-left order-2 lg:order-1">
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold text-[#1f2d1f] leading-tight"
                    style="font-family:'Playfair Display', serif;">
                    {{ $heroTitle }}
                </h1>

                <p class="text-lg lg:text-xl text-[#f28c28] mt-4 font-medium">
                    {{ $heroSubtitle }}
                </p>

                <p class="text-gray-600 mt-8 max-w-md mx-auto lg:mx-0 leading-relaxed">
                    {{ $heroDescription }}
                </p>

                <h2 class="text-gray-900 mt-8 max-w-md mx-auto lg:mx-0 leading-relaxed font-semibold">
                    {{ $heroLine2 }}
                </h2>

                <div class="mt-12 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-8">
                    <a href="#Product" class="inline-flex items-center gap-3 text-white px-10 py-4 rounded-full shadow-xl
                           transition-all duration-300 hover:scale-[1.03]" style="background: var(--button);">
                        Order now
                        <svg class="w-4 h-4 animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </a>

                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <span class="text-yellow-500 text-base tracking-wide">★ ★ ★ ★ ★</span>
                        <span>{{ $get('hero_rating_text', '4.9 (220 Ratings)') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <img src="{{ $leafImage }}" loading="lazy" decoding="async" alt="Leaf Decoration"
            class="absolute top-32 left-1/2 -translate-x-1/2 w-32 opacity-60 pointer-events-none">
    </section>

    {{-- ================= CART ================= --}}
    <button id="cartBtn" onclick="toggleCart()" class="fixed bottom-6 right-6 z-50 text-white
         px-5 py-3 rounded-full shadow-xl flex items-center gap-2" style="background: #1f2d1f;">
        🛒 <span id="cartCount">0</span>
    </button>

    <div id="cartPanel" class="fixed inset-y-0 right-0 w-full sm:w-[420px]
         bg-white shadow-2xl z-50 transform translate-x-full
         transition-transform duration-300 flex flex-col">

        <div class="p-5 border-b flex justify-between items-center">
            <h3 class="text-lg font-bold">Your Cart</h3>
            <button onclick="toggleCart()">✕</button>
        </div>

        <div id="cartItems" class="flex-1 p-5 space-y-4 overflow-y-auto"></div>

        <div class="p-5 border-t">
            <div class="space-y-2 mb-4 text-sm">
                <div class="flex justify-between text-gray-600">
                    <span>Subtotal</span>
                    <span><span id="cartSubTotal">0</span>{{ $currencySymbol }}</span>
                </div>

                <div class="flex justify-between text-gray-600">
                    <span>Delivery Charge</span>
                    <span>{{ $deliveryCharge }}{{ $currencySymbol }}</span>
                </div>

                <div class="border-t pt-2 flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span><span id="cartTotal">0</span>{{ $currencySymbol }}</span>
                </div>
            </div>

            <button onclick="goToCheckout()" class="w-full text-white py-3 rounded-full" style="background:#1f2d1f;">
                Checkout
            </button>
        </div>
    </div>

    {{-- ================= SOURCE SECTION ================= --}}
    <section class="max-w-7xl mx-auto px-6 py-20 grid lg:grid-cols-2 gap-16 items-center">
        <div>
            <img src="{{ $sourceImage }}" loading="lazy" decoding="async" alt="Source Image"
                class="w-full max-w-md mx-auto">
        </div>
        <div>
            <h2 class="text-4xl font-bold text-green-900">
                {{ $sourceHeading }}
            </h2>
            @if($get('source_text'))
                <p class="mt-4 text-gray-700 leading-relaxed">{{ $get('source_text') }}</p>
            @endif
        </div>
    </section>

    {{-- ================= PRODUCTS ================= --}}
    <section id="Product" class="max-w-7xl mx-auto px-6 py-20">
        <div class="relative bg-[#f3f7e8] rounded-[36px] px-8 md:px-14 py-12 flex flex-col gap-10">

            @if($productDiscountLabel)
                <div class="absolute -top-6 left-8 text-white px-6 py-3 rounded-full shadow-lg" style="background:#7db343;">
                    <p class="text-lg font-bold">{{ $productDiscountLabel }}</p>
                </div>
            @endif

            @if(!empty($products) && count($products))
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 pt-4">
                    @foreach($products as $p)
                        @php
                            $pImg = $publicUrl($p->image ?? null) ?? asset('img/assets/pro-1.png');
                            $title = $p->title ?? $p->name ?? 'Product';
                            $variant = $p->variant ?? $p->size ?? $p->label ?? '';
                            $regular = (int) ($p->regular_price ?? $p->old_price ?? 0);
                            $sale = (int) ($p->sale_price ?? $p->price ?? 0);
                        @endphp

                        <div class="flex items-center gap-8 bg-white/40 rounded-3xl p-6 shadow-inner">
                            <div
                                class="w-[150px] h-[150px] rounded-full bg-[#dfe8c8] flex items-center justify-center shadow-inner">
                                <img src="{{ $pImg }}" loading="lazy" decoding="async" class="h-[120px] object-contain"
                                    alt="{{ $title }}">
                            </div>

                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-[#1f2d1f]">{{ $title }}</h3>
                                @if($variant)
                                    <p class="text-sm text-gray-500 mt-1">{{ $variant }}</p>
                                @endif

                                <div class="mt-3 flex items-center gap-3">
                                    @if($regular > 0 && $regular > $sale)
                                        <span class="text-lg text-gray-400 line-through">
                                            {{ $currencySymbol }}{{ $regular }}
                                        </span>
                                    @endif
                                    <span class="text-4xl font-extrabold text-[#1f2d1f]">
                                        {{ $currencySymbol }}{{ $sale }}
                                    </span>
                                </div>

                                <button onclick="addToCart(@js($title . ($variant ? ' - ' . $variant : '')), {{ $sale }})"
                                    class="mt-4 text-sm text-white px-5 py-2 rounded-full hover:opacity-90 transition"
                                    style="background:#1f2d1f;">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-gray-600 py-10">
                    No products found. Add products from Admin → Landing Builder → Products.
                </div>
            @endif
        </div>
    </section>

    {{-- ================= INGREDIENTS ================= --}}
    <section id="ingredients" class="bg-brand py-20">
        <h2 class="text-4xl font-bold text-center text-[#1f2d1f] mb-14">
            {{ $get('ingredients_title', 'Ingredients') }}
        </h2>

        <div class="max-w-7xl mx-auto px-6">
            @php
                $ings = $ingredients ?? collect([]);
                $show = $ings->take(6);
                $remaining = max(0, $ings->count() - $show->count());
                $moreImg = $publicUrl($get('ingredients_more_image')) ?? asset('img/assets/27moreingredients.jpeg');
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-7 gap-10">
                @foreach($show as $ing)
                    @php
                        $ingImg = $publicUrl($ing->image ?? null) ?? asset('img/assets/Coconut.png');
                        $ingName = $ing->name ?? 'Ingredient';
                    @endphp
                    <div class="card">
                        <img src="{{ $ingImg }}" loading="lazy" decoding="async" alt="{{ $ingName }}">
                        <p class="text-md font-medium text-[#1f2d1f] text-center">{{ $ingName }}</p>
                    </div>
                @endforeach

                @if($remaining > 0)
                    <div class="card col-span-2 md:col-span-1">
                        <img src="{{ $moreImg }}" loading="lazy" decoding="async" alt="+ {{ $remaining }} more ingredients">
                        <p class="text-md font-semibold text-[#1f2d1f] text-center">
                            + {{ $remaining }} more ingredients
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- ================= TESTIMONIALS ================= --}}
    <section class="max-w-3xl mx-auto px-6 py-16 text-center relative overflow-hidden">
        <h2 class="text-3xl font-bold mb-12">{{ $get('testimonial_title', 'What Our Customers Are Saying') }}</h2>

        @php $testis = $testimonials ?? collect([]); @endphp

        @if($testis->count())
            <div id="testimonialSlider" class="relative">
                @foreach($testis as $i => $t)
                    @php
                        $avatar = $publicUrl($t->image ?? $t->avatar ?? null) ?? asset('img/review/suraiya.png');
                        $name = $t->name ?? 'Customer';
                        $msg = $t->message ?? $t->review ?? '';
                    @endphp

                    <div class="testimonial-slide {{ $i === 0 ? 'active' : '' }}">
                        <div class="flex justify-center mb-6">
                            <img src="{{ $avatar }}" loading="lazy" decoding="async" alt="{{ $name }}"
                                class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg">
                        </div>

                        <p class="text-gray-600 italic text-lg leading-relaxed">
                            “{{ $msg }}”
                        </p>
                        <p class="mt-4 font-semibold">— {{ $name }}</p>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center gap-2 mt-8">
                @foreach($testis as $i => $t)
                    <button class="dot {{ $i === 0 ? 'active' : '' }}" onclick="goToSlide({{ $i }})"></button>
                @endforeach
            </div>
        @else
            <div class="text-gray-600 py-10">
                No testimonials found. Add testimonials from Admin → Landing Builder → Testimonials.
            </div>
        @endif
    </section>

    {{-- ================= ORDER ================= --}}
    <section id="order" class="relative max-w-6xl mx-auto px-6 py-20">
        <div class="absolute inset-0 bg-brand rounded-[40px]"></div>

        <div
            class="relative bg-white/70 backdrop-blur-xl shadow-[0_40px_100px_rgba(0,0,0,0.12)] rounded-[32px] p-10 md:p-14">
            <h2 class="text-3xl md:text-4xl font-bold text-[#1f2d1f] mb-12 text-center"
                style="font-family:'Playfair Display',serif;">
                {{ $get('order_title', 'অর্ডার করুন') }}
            </h2>

            <form id="orderForm" class="grid grid-cols-1 md:grid-cols-2 gap-12">

                <div class="space-y-6">
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2">{{ $get('order_name_label', 'আপনার নাম *') }}</label>
                        <input id="name"
                            class="w-full px-5 py-4 rounded-xl border border-white/60 bg-white/80 focus:ring-2 focus:ring-green-600 focus:outline-none"
                            placeholder="{{ $get('order_name_placeholder', 'পূর্ণ নাম লিখুন') }}">
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2">{{ $get('order_address_label', 'সম্পূর্ণ ঠিকানা *') }}</label>
                        <input id="address"
                            class="w-full px-5 py-4 rounded-xl border border-white/60 bg-white/80 focus:ring-2 focus:ring-green-600 focus:outline-none"
                            placeholder="{{ $get('order_address_placeholder', 'গ্রাম / এলাকা / জেলা') }}">
                    </div>

                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 mb-2">{{ $get('order_phone_label', 'ফোন নম্বর *') }}</label>
                        <input id="phone"
                            class="w-full px-5 py-4 rounded-xl border border-white/60 bg-white/80 focus:ring-2 focus:ring-green-600 focus:outline-none"
                            placeholder="{{ $get('order_phone_placeholder', '01XXXXXXXXX') }}">
                    </div>

                    <div class="flex items-center gap-4 mt-8 bg-green-100/70 px-6 py-4 rounded-2xl">
                        <div>
                            <p class="font-semibold text-green-800">{{ $get('cod_title', 'Cash on Delivery') }}</p>
                            <p class="text-sm text-green-700">
                                {{ $get('cod_subtitle', 'পণ্য হাতে পেয়ে টাকা পরিশোধ করুন') }}</p>
                            <p class="text-green-800 font-semibold text-sm md:text-base mt-1">
                                🚚 {{ $get('delivery_text', 'সারা বাংলাদেশে ডেলিভারি চার্জ মাত্র') }}
                                {{ $deliveryCharge }} {{ $currencySymbol }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-lg p-8 flex flex-col justify-between">
                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold text-[#1f2d1f]">Order Summary</h3>

                        <div id="orderItems" class="space-y-3"></div>

                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span><span id="subTotalDisplay">0</span>{{ $currencySymbol }}</span>
                        </div>

                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Delivery Charge</span>
                            <span>{{ $deliveryCharge }}{{ $currencySymbol }}</span>
                        </div>

                        <div class="border-t pt-4 flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-green-800">
                                <span id="totalDisplay">0</span>{{ $currencySymbol }}
                            </span>
                        </div>
                    </div>

                    <button type="submit"
                        class="mt-8 text-white py-4 rounded-full text-lg shadow-xl transition-all duration-300 hover:scale-[1.02]"
                        style="background: var(--button);">
                        {{ $get('order_button_text', 'Place Order') }}
                    </button>

                    <p id="statusMsg" class="text-center text-green-700 font-semibold mt-6 hidden"></p>
                </div>
            </form>
        </div>
    </section>

    {{-- ================= NEWSLETTER ================= --}}
    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div
                class="relative bg-[#e7d4b1] rounded-[32px] px-10 py-12 flex flex-col md:flex-row items-center gap-10 overflow-hidden">
                <div class="relative md:w-[38%] flex justify-center md:justify-start">
                    <img src="{{ $newsletterImage }}" loading="lazy" decoding="async"
                        class="w-[220px] md:w-[260px] -mt-10 md:-mt-16 select-none pointer-events-none"
                        alt="Newsletter">
                </div>

                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-3xl md:text-4xl font-bold text-[#1f2d1f] mb-6"
                        style="font-family: 'Playfair Display', serif;">
                        {!! nl2br(e($newsletterTitle)) !!}
                    </h3>

                    <div
                        class="flex items-center bg-white rounded-full shadow-md max-w-md mx-auto md:mx-0 overflow-hidden">
                        <input type="email" placeholder="Type your email" class="flex-1 px-6 py-4 outline-none text-sm">
                        <button
                            class="text-white px-8 py-3 rounded-full mr-2 text-sm font-medium hover:opacity-90 transition"
                            style="background:#3b7a57;">
                            Subscribe
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ================= FOOTER ================= --}}
    <footer class="relative">
        <div class="relative bg-[#163d2a] rounded-tr-[180px] px-10 py-16 overflow-hidden">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10 text-white">

                <div>
                    <div class="flex items-center gap-2 mb-4">
                        
                        <img src="{{ $landingLogoUrl }}" loading="lazy" decoding="async" alt="Footer Logo" class="h-16">
                    </div>

                    <p class="text-sm text-gray-300 leading-relaxed max-w-xs">
                        {{ $get('footer_about', 'Crafted with 100% organic, ethically sourced ingredients. We believe in the power of nature without compromise.') }}
                    </p>

                    <div class="flex gap-3 mt-5">

                        @if($facebookUrl)
                            <a href="{{ $facebookUrl }}" target="_blank"
                                class="w-9 h-9 rounded-full bg-white text-[#163d2a] flex items-center justify-center hover:bg-gray-100 transition">
                                f
                            </a>
                        @endif

                        @if($instagramUrl)
                            <a href="{{ $instagramUrl }}" target="_blank"
                                class="w-9 h-9 rounded-full bg-white text-[#163d2a] flex items-center justify-center hover:bg-gray-100 transition">
                                ig
                            </a>
                        @endif

                        @if($whatsappUrl)
                            <a href="{{ $whatsappUrl }}" target="_blank"
                                class="w-9 h-9 rounded-full bg-white text-[#163d2a] flex items-center justify-center hover:bg-gray-100 transition">
                                wa
                            </a>
                        @endif

                        @if($twitterUrl)
                            <a href="{{ $twitterUrl }}" target="_blank"
                                class="w-9 h-9 rounded-full bg-white text-[#163d2a] flex items-center justify-center hover:bg-gray-100 transition">
                                x
                            </a>
                        @endif

                        @if($tiktokUrl)
                            <a href="{{ $tiktokUrl }}" target="_blank"
                                class="w-9 h-9 rounded-full bg-white text-[#163d2a] flex items-center justify-center hover:bg-gray-100 transition">
                                tt
                            </a>
                        @endif

                        @if($linkedinUrl)
                            <a href="{{ $linkedinUrl }}" target="_blank"
                                class="w-9 h-9 rounded-full bg-white text-[#163d2a] flex items-center justify-center hover:bg-gray-100 transition">
                                in
                            </a>
                        @endif
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="#Company" class="hover:text-white transition">Company</a></li>
                        <li><a href="#Product" class="hover:text-white transition">Product</a></li>
                        <li><a href="#ingredients" class="hover:text-white transition">Ingredients</a></li>
                        <li><a href="#order" class="hover:text-white transition">Order</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Products</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        @if(!empty($products) && count($products))
                            @foreach($products as $p)
                                <li>{{ $p->title ?? $p->name ?? 'Product' }} {{ $p->variant ?? $p->size ?? '' }}</li>
                            @endforeach
                        @else
                            <li>No products yet</li>
                        @endif
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Quick Contact</h4>
                    @if($contactAddress)
                        <p class="text-sm text-gray-300 mb-2">{{ $contactAddress }}</p>
                    @endif
                    <p class="text-sm text-gray-300">{{ $contactPhone }}</p>
                    <p class="text-sm text-gray-300 mt-1">{{ $contactEmail }}</p>
                </div>

            </div>

            <img src="{{ $publicUrl($get('footer_image')) ?? asset('img/assets/footer.jpg') }}" loading="lazy"
                decoding="async" class="absolute right-0 bottom-0 h-[260px] pointer-events-none select-none"
                alt="Footer Image">
        </div>

        <div class="bg-[#0f2b1e] py-4">
            <p class="text-center text-sm text-gray-300">
                © <span id="year"></span>
                {{ $footerText ? $footerText : 'All rights reserved. Developed by' }}
                <a href="{{ $get('developer_url', 'https://nexolioit.com') }}" target="_blank"
                    class="text-white font-medium hover:underline">
                    {{ $get('developer_name', 'NexolioIT') }}
                </a>
            </p>
        </div>
    </footer>

    {{-- ================= JS GLOBALS ================= --}}
    <script>
        window.LANDING = {
            ORDER_URL: @json(route('order.store')),
            TRACK_URL: @json(route('track.store')),
            CSRF: @json(csrf_token()),
            DELIVERY_CHARGE: @json((int) $deliveryCharge),
            CURRENCY: @json($currencySymbol),
        };
    </script>

    {{-- ================= TRACKING ================= --}}
    <script>
        function getVisitorId() {
            let id = localStorage.getItem('visitor_id');
            if (!id) {
                id = 'v_' + Math.random().toString(36).substring(2) + Date.now();
                localStorage.setItem('visitor_id', id);
            }
            return id;
        }

        function trackEvent(event, data = {}) {
            fetch(window.LANDING.TRACK_URL, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.LANDING.CSRF
                },
                body: JSON.stringify({
                    visitor_id: getVisitorId(),
                    event,
                    page: window.location.pathname,
                    data
                })
            }).catch(() => { });
        }
    </script>

    {{-- ================= TESTIMONIAL SLIDER ================= --}}
    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.testimonial-slide');
        const dots = document.querySelectorAll('.dot');

        function showSlide(index) {
            if (!slides.length) return;
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => d.classList.remove('active'));

            slides[index].classList.add('active');
            if (dots[index]) dots[index].classList.add('active');
            currentSlide = index;
        }
        function goToSlide(index) { showSlide(index); }

        if (slides.length > 1) {
            setInterval(() => {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }, 4000);
        }
    </script>

    {{-- ================= MENU + CART + ORDER ================= --}}
    <script>
        // Mobile menu
        const menuBtn = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        if (menuBtn) menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));

        document.getElementById('year').innerText = new Date().getFullYear();

        // Cart state
        let cart = [];
        const DELIVERY_CHARGE = window.LANDING.DELIVERY_CHARGE;

        function addToCart(name, price) {
            const existing = cart.find(i => i.name === name);
            if (existing) existing.qty++;
            else cart.push({ name, price, qty: 1 });

            trackEvent('add_to_cart', { product: name, price });
            renderCart();
            openCart();
        }

        function changeQty(index, delta) {
            cart[index].qty = Math.max(1, cart[index].qty + delta);
            renderCart();
        }

        function removeItem(index) {
            const removed = cart[index];
            cart.splice(index, 1);
            trackEvent('remove_from_cart', { product: removed.name });
            renderCart();
        }

        function renderCart() {
            const items = document.getElementById('cartItems');
            const count = document.getElementById('cartCount');
            const subTotalEl = document.getElementById('cartSubTotal');
            const totalEl = document.getElementById('cartTotal');

            items.innerHTML = '';
            let subTotal = 0;
            let qtyCount = 0;

            cart.forEach((item, i) => {
                subTotal += item.price * item.qty;
                qtyCount += item.qty;

                items.innerHTML += `
                    <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl">
                        <div>
                            <p class="font-medium">${item.name}</p>
                            <p class="text-sm text-gray-500">${window.LANDING.CURRENCY}${item.price}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button onclick="changeQty(${i}, -1)">−</button>
                            <span class="font-bold">${item.qty}</span>
                            <button onclick="changeQty(${i}, 1)">+</button>
                            <button onclick="removeItem(${i})" class="text-red-500 ml-2">✕</button>
                        </div>
                    </div>`;
            });

            count.innerText = qtyCount;
            subTotalEl.innerText = subTotal;
            totalEl.innerText = cart.length ? (subTotal + DELIVERY_CHARGE) : 0;
        }

        function toggleCart() {
            document.getElementById('cartPanel').classList.toggle('translate-x-full');
        }

        function openCart() {
            document.getElementById('cartPanel').classList.remove('translate-x-full');
            trackEvent('cart_open', { total_items: cart.length });
        }

        function renderOrderSummary() {
            const summary = document.getElementById('orderItems');
            const subTotalDisplay = document.getElementById('subTotalDisplay');
            const totalDisplay = document.getElementById('totalDisplay');

            summary.innerHTML = '';
            let subTotal = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.qty;
                subTotal += itemTotal;

                summary.innerHTML += `
                    <div class="bg-gray-50 p-4 rounded-xl">
                        <div class="flex justify-between">
                            <p>${item.name}</p>
                            <p>${itemTotal}${window.LANDING.CURRENCY}</p>
                        </div>
                        <p class="text-sm text-gray-500">${item.price}${window.LANDING.CURRENCY} × ${item.qty}</p>
                    </div>`;
            });

            subTotalDisplay.innerText = subTotal;
            totalDisplay.innerText = subTotal + DELIVERY_CHARGE;
        }

        function goToCheckout() {
            toggleCart();
            document.getElementById('orderForm').scrollIntoView({ behavior: 'smooth' });
            renderOrderSummary();
            trackEvent('checkout_start', { items: cart.length });
        }

        // Submit order
        document.getElementById("orderForm").addEventListener("submit", function (e) {
            e.preventDefault();

            const name = document.getElementById("name").value.trim();
            const address = document.getElementById("address").value.trim();
            const phone = document.getElementById("phone").value.trim();
            const statusMsg = document.getElementById("statusMsg");

            if (!name || !address || !phone) {
                alert("দয়া করে নাম, ঠিকানা এবং ফোন নম্বর পূরণ করুন");
                return;
            }
            if (cart.length === 0) {
                alert("দয়া করে আগে পণ্য কার্টে যোগ করুন");
                return;
            }

            statusMsg.classList.remove("hidden");
            statusMsg.innerText = "অর্ডার পাঠানো হচ্ছে...";

            fetch(window.LANDING.ORDER_URL, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": window.LANDING.CSRF
                },
                body: JSON.stringify({ name, phone, address, cart })
            })
                .then(res => res.json())
                .then(data => {
                    if (!data.success) throw new Error();

                    trackEvent('purchase', {
                        order_id: data.order_id,
                        total: data.total,
                        items: cart.length
                    });

                    statusMsg.innerText = "✅ আপনার অর্ডার সফলভাবে গ্রহণ করা হয়েছে। খুব শীঘ্রই আমরা যোগাযোগ করবো।";

                    cart = [];
                    renderCart();
                    renderOrderSummary();
                    document.getElementById("orderForm").reset();
                })
                .catch(() => {
                    statusMsg.innerText = "❌ দুঃখিত! অর্ডার পাঠাতে সমস্যা হয়েছে। আবার চেষ্টা করুন।";
                });
        });

        // Page view
        document.addEventListener('DOMContentLoaded', () => {
            trackEvent('page_view', { title: document.title, url: window.location.href });
        });

        // Exit intent
        document.addEventListener('mouseleave', e => {
            if (e.clientY < 0) trackEvent('exit_intent');
        });

        // Scroll depth
        let scrollTracked = { 25: false, 50: false, 75: false, 100: false };
        window.addEventListener('scroll', () => {
            const scrollPercent = Math.round((window.scrollY + window.innerHeight) / document.body.scrollHeight * 100);
            [25, 50, 75, 100].forEach(p => {
                if (scrollPercent >= p && !scrollTracked[p]) {
                    scrollTracked[p] = true;
                    trackEvent('scroll_depth', { percent: p });
                }
            });
        });

        // Time on page
        let pageStart = Date.now();
        let sent = false;
        function sendTimeOnPage() {
            if (sent) return;
            sent = true;
            trackEvent('time_on_page', { seconds: Math.round((Date.now() - pageStart) / 1000) });
        }
        window.addEventListener('beforeunload', sendTimeOnPage);
        document.addEventListener('visibilitychange', () => {
            if (document.visibilityState === 'hidden') sendTimeOnPage();
        });

        // Form start
        let formStarted = false;
        ['name', 'phone', 'address'].forEach(id => {
            document.getElementById(id)?.addEventListener('focus', () => {
                if (!formStarted) {
                    formStarted = true;
                    trackEvent('form_start');
                }
            });
        });

        // Init
        renderCart();
    </script>

    {{-- Custom BODY injected from settings --}}
    @if(!empty($customBody))
        {!! $customBody !!}
    @endif

</body>

</html>