@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    @php
        $settings = $settings ?? [];

        $brandName = 'Keshoriya';
        $contactPhone = $settings['contact_phone'] ?? '+8801978675507';
        $contactEmail = $settings['contact_email'] ?? 'keshoriyahairoil@gmail.com';
        $contactAddress = $settings['contact_address'] ?? 'Meherpur, Bangladesh';
        $landingLogo = $settings['landing_logo'] ?? null;

        $landingLogoUrl = null;
        if ($landingLogo) {
            if (\Illuminate\Support\Str::startsWith($landingLogo, ['http://', 'https://'])) {
                $landingLogoUrl = $landingLogo;
            } else {
                $landingLogoUrl = asset('storage/' . ltrim($landingLogo, '/'));
            }
        }
    @endphp

    <section class="relative overflow-hidden bg-[#f8faf8]">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-20 -left-20 w-72 h-72 rounded-full bg-green-100/40 blur-3xl"></div>
            <div class="absolute top-1/3 -right-24 w-80 h-80 rounded-full bg-emerald-100/30 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-64 h-64 rounded-full bg-lime-100/30 blur-3xl"></div>

            <div class="absolute top-24 left-6 hidden lg:block about-float-slow opacity-80">
                <svg width="90" height="90" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M109 13C79 18 53 34 35 55C18 75 11 95 12 108C31 107 50 100 69 84C88 68 102 44 109 13Z"
                        fill="#76b947" />
                    <path d="M28 95C45 76 63 57 90 34" stroke="#edffe7" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>

            <div class="absolute bottom-20 right-8 hidden lg:block about-float-fast opacity-90">
                <svg width="110" height="110" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M109 13C79 18 53 34 35 55C18 75 11 95 12 108C31 107 50 100 69 84C88 68 102 44 109 13Z"
                        fill="#1f8b3d" />
                    <path d="M28 95C45 76 63 57 90 34" stroke="#dcffd8" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 lg:py-20">
            <!-- HERO -->
            <div
                class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-center rounded-[34px] border border-white/70 bg-white/75 backdrop-blur-xl shadow-[0_25px_80px_rgba(15,23,42,0.08)] p-6 sm:p-8 lg:p-10">
                <div class="max-w-2xl">
                    <span
                        class="inline-flex items-center rounded-full bg-green-50 text-green-700 border border-green-100 px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide">
                        About {{ $brandName }}
                    </span>

                    <h1 class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.05] text-[#111827]">
                        Rooted in nature,
                        <span class="text-green-700">crafted for confident beauty</span>
                    </h1>

                    <p class="mt-6 text-base sm:text-lg leading-8 text-[#5f6b65]">
                        {{ $brandName }} is a premium natural beauty and personal care brand focused on clean ingredients,
                        trusted quality, and gentle daily care. We believe true beauty begins with healthy habits, pure
                        formulations, and products that feel as good as they look.
                    </p>

                    <p class="mt-4 text-base sm:text-lg leading-8 text-[#5f6b65]">
                        From scalp nourishment to self-care essentials, our mission is to bring a soothing, elegant, and
                        effective beauty experience into every home.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('products') }}"
                            class="inline-flex items-center justify-center rounded-full bg-green-600 px-8 py-4 text-white font-semibold shadow-[0_12px_30px_rgba(22,163,74,0.25)] hover:bg-green-700 transition">
                            Explore Products
                        </a>

                        <a href="{{ route('contact') }}"
                            class="inline-flex items-center justify-center rounded-full border border-gray-200 bg-white px-8 py-4 text-[#111827] font-semibold hover:bg-gray-50 transition">
                            Contact Us
                        </a>
                    </div>
                </div>

                <div class="relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-br from-green-50 to-white rounded-[30px] shadow-inner border border-green-100/60">
                    </div>

                    <div class="relative h-full rounded-[30px] p-6 sm:p-8">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-2 rounded-[26px] bg-white shadow-sm border border-gray-100 p-6">
                                <div class="flex items-center gap-4">
                                    @if($landingLogoUrl)
                                        <img src="{{ $landingLogoUrl }}" alt="{{ $brandName }}"
                                            class="w-16 h-16 rounded-2xl object-contain bg-white">
                                    @else
                                        <div
                                            class="w-16 h-16 rounded-2xl bg-green-100 text-green-700 flex items-center justify-center font-bold text-xl">
                                            K
                                        </div>
                                    @endif

                                    <div>
                                        <h3 class="text-xl font-bold text-[#111827]">{{ $brandName }}</h3>
                                        <p class="text-sm text-gray-500 mt-1">Natural care • Elegant experience • Trusted
                                            quality</p>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-[24px] bg-white shadow-sm border border-gray-100 p-5">
                                <p class="text-3xl font-extrabold text-green-700">100%</p>
                                <p class="mt-2 text-sm text-gray-500 leading-6">Focused on clean and thoughtful beauty care
                                </p>
                            </div>

                            <div class="rounded-[24px] bg-white shadow-sm border border-gray-100 p-5">
                                <p class="text-3xl font-extrabold text-green-700">24/7</p>
                                <p class="mt-2 text-sm text-gray-500 leading-6">Customer-first support and order assistance
                                </p>
                            </div>

                            <div class="col-span-2 rounded-[24px] bg-white shadow-sm border border-gray-100 p-5">
                                <p class="text-sm font-semibold uppercase tracking-wide text-green-700">Our promise</p>
                                <p class="mt-3 text-[15px] leading-7 text-gray-600">
                                    Beauty products that feel premium, look elegant, and support a confident, natural
                                    routine.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STORY -->
            <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div
                    class="rounded-[30px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-6 sm:p-8">
                    <span class="inline-block text-green-700 text-sm font-semibold tracking-wide">Our Story</span>
                    <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#111827] leading-tight">
                        The journey of {{ $brandName }}
                    </h2>

                    <p class="mt-5 text-[15px] sm:text-base leading-8 text-[#5f6b65]">
                        {{ $brandName }} was created with one simple idea: beauty care should be natural, safe, and
                        enjoyable. In a world full of harsh formulas and confusing choices, we wanted to build a brand that
                        feels clean, comforting, and trustworthy.
                    </p>

                    <p class="mt-4 text-[15px] sm:text-base leading-8 text-[#5f6b65]">
                        Our approach combines elegant presentation with thoughtful ingredients and customer-focused service.
                        Every product is selected or developed with the goal of helping people feel better about their daily
                        care routine.
                    </p>

                    <p class="mt-4 text-[15px] sm:text-base leading-8 text-[#5f6b65]">
                        We are proud to serve customers who value simplicity, quality, and a premium beauty experience that
                        still feels personal and natural.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div
                        class="rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-6">
                        <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-700 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#111827]">Trust</h3>
                        <p class="mt-3 text-sm leading-7 text-gray-600">
                            We focus on customer confidence through honest presentation, consistent quality, and dependable
                            care.
                        </p>
                    </div>

                    <div
                        class="rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-6">
                        <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-700 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M7 20h10"></path>
                                <path d="M10 20c5.5-2.5.8-6.4 3-10"></path>
                                <path
                                    d="M9.5 9.4c1.5-1.8 4.2-2.8 7.5-2.4 0 3.3-1.2 6-3.6 7.9-2.4 1.9-5.8 2.7-9.4 2.1-.2-3.7 1-5.9 5.5-7.6z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#111827]">Nature</h3>
                        <p class="mt-3 text-sm leading-7 text-gray-600">
                            Our brand direction is inspired by clean beauty, soothing ingredients, and naturally elegant
                            care.
                        </p>
                    </div>

                    <div
                        class="rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-6">
                        <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-700 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 6v6l4 2"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#111827]">Consistency</h3>
                        <p class="mt-3 text-sm leading-7 text-gray-600">
                            We believe great beauty care should fit naturally into everyday life with comfort and ease.
                        </p>
                    </div>

                    <div
                        class="rounded-[28px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-6">
                        <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-700 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.1 2.1 0 1 1 3 3L7 19l-4 1 1-4Z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#111827]">Elegance</h3>
                        <p class="mt-3 text-sm leading-7 text-gray-600">
                            From product feel to visual style, we aim for a premium experience that feels calm and refined.
                        </p>
                    </div>
                </div>
            </div>

            <!-- VISION / MISSION -->
            <div class="mt-10 grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div
                    class="relative rounded-[30px] overflow-hidden border border-green-100 bg-gradient-to-br from-green-600 to-green-700 text-white p-7 sm:p-9 shadow-[0_22px_70px_rgba(22,163,74,0.22)]">
                    <div class="absolute top-0 right-0 w-36 h-36 bg-white/10 rounded-full blur-2xl"></div>
                    <span class="relative inline-block text-sm font-semibold tracking-wide text-green-100">Our Vision</span>
                    <h2 class="relative mt-3 text-3xl sm:text-4xl font-extrabold leading-tight">
                        To become a trusted name in natural beauty care
                    </h2>
                    <p class="relative mt-5 text-[15px] sm:text-base leading-8 text-green-50">
                        We envision {{ $brandName }} as a leading beauty and wellness brand known for simplicity, purity,
                        elegance, and products that support confidence through everyday self-care.
                    </p>
                </div>

                <div
                    class="relative rounded-[30px] overflow-hidden border border-gray-100 bg-white p-7 sm:p-9 shadow-[0_20px_60px_rgba(15,23,42,0.06)]">
                    <span class="inline-block text-sm font-semibold tracking-wide text-green-700">Our Mission</span>
                    <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold leading-tight text-[#111827]">
                        To deliver soothing, quality-driven care with a premium feel
                    </h2>
                    <p class="mt-5 text-[15px] sm:text-base leading-8 text-[#5f6b65]">
                        Our mission is to provide thoughtfully presented beauty products, inspired by natural care, with a
                        focus on comfort, effectiveness, trust, and customer satisfaction.
                    </p>
                </div>
            </div>

            <!-- WHY CHOOSE -->
            <div
                class="mt-10 rounded-[34px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_20px_70px_rgba(15,23,42,0.06)] p-6 sm:p-8 lg:p-10">
                <div class="max-w-3xl">
                    <span class="inline-block text-green-700 text-sm font-semibold tracking-wide">Why Choose
                        {{ $brandName }}</span>
                    <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#111827] leading-tight">
                        Everything you need from a modern beauty brand
                    </h2>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">
                    <div class="rounded-[24px] bg-[#f9fbf9] border border-gray-100 p-5">
                        <h3 class="text-lg font-bold text-[#111827]">Natural-inspired care</h3>
                        <p class="mt-3 text-sm leading-7 text-gray-600">
                            A calm and clean beauty direction that feels fresh, modern, and trustworthy.
                        </p>
                    </div>

                    <div class="rounded-[24px] bg-[#f9fbf9] border border-gray-100 p-5">
                        <h3 class="text-lg font-bold text-[#111827]">Premium presentation</h3>
                        <p class="mt-3 text-sm leading-7 text-gray-600">
                            Thoughtful design, elegant visuals, and a shopping experience that feels polished.
                        </p>
                    </div>

                    <div class="rounded-[24px] bg-[#f9fbf9] border border-gray-100 p-5">
                        <h3 class="text-lg font-bold text-[#111827]">Customer-first service</h3>
                        <p class="mt-3 text-sm leading-7 text-gray-600">
                            Helpful communication, smooth ordering, and support that respects customer needs.
                        </p>
                    </div>

                    <div class="rounded-[24px] bg-[#f9fbf9] border border-gray-100 p-5">
                        <h3 class="text-lg font-bold text-[#111827]">Daily confidence</h3>
                        <p class="mt-3 text-sm leading-7 text-gray-600">
                            Products that support a more confident routine through comfort, consistency, and care.
                        </p>
                    </div>
                </div>
            </div>

            <!-- CONTACT / CTA -->
            <div class="mt-10 grid grid-cols-1 lg:grid-cols-[1fr_.9fr] gap-8 items-stretch">
                <div
                    class="rounded-[30px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_20px_60px_rgba(15,23,42,0.06)] p-6 sm:p-8">
                    <span class="inline-block text-green-700 text-sm font-semibold tracking-wide">Get in touch</span>
                    <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#111827] leading-tight">
                        We would love to hear from you
                    </h2>

                    <div class="mt-6 space-y-4 text-[15px] sm:text-base text-gray-600">
                        <div class="flex items-start gap-3">
                            <span class="mt-1 w-2.5 h-2.5 rounded-full bg-green-500 shrink-0"></span>
                            <p><span class="font-semibold text-[#111827]">Phone:</span> {{ $contactPhone }}</p>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="mt-1 w-2.5 h-2.5 rounded-full bg-green-500 shrink-0"></span>
                            <p><span class="font-semibold text-[#111827]">Email:</span> {{ $contactEmail }}</p>
                        </div>

                        <div class="flex items-start gap-3">
                            <span class="mt-1 w-2.5 h-2.5 rounded-full bg-green-500 shrink-0"></span>
                            <p><span class="font-semibold text-[#111827]">Address:</span> {{ $contactAddress }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="rounded-[30px] border border-green-100 bg-gradient-to-br from-green-50 to-white p-6 sm:p-8 shadow-[0_20px_60px_rgba(15,23,42,0.06)]">
                    <span class="inline-block text-green-700 text-sm font-semibold tracking-wide">Ready to explore?</span>
                    <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#111827] leading-tight">
                        Discover the beauty of {{ $brandName }}
                    </h2>
                    <p class="mt-5 text-[15px] sm:text-base leading-8 text-[#5f6b65]">
                        Explore our collection and experience a premium, natural-inspired routine designed for comfort,
                        confidence, and everyday care.
                    </p>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('products') }}"
                            class="inline-flex items-center justify-center rounded-full bg-green-600 px-7 py-4 text-white font-semibold hover:bg-green-700 transition">
                            Shop Now
                        </a>

                        <a href="{{ route('contact') }}"
                            class="inline-flex items-center justify-center rounded-full border border-gray-200 bg-white px-7 py-4 text-[#111827] font-semibold hover:bg-gray-50 transition">
                            Contact Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes aboutFloatSlow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        @keyframes aboutFloatFast {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        .about-float-slow {
            animation: aboutFloatSlow 6s ease-in-out infinite;
        }

        .about-float-fast {
            animation: aboutFloatFast 4.8s ease-in-out infinite;
        }
    </style>
@endsection