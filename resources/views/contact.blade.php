@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    @php
        use Illuminate\Support\Str;

        $settings = $settings ?? [];

        $contactTitle = $settings['contact_page_title'] ?? 'Get In Touch With Us';
        $contactSubtitle = $settings['contact_page_subtitle'] ?? 'Contact Us';
        $contactDescription = $settings['contact_page_description'] ?? 'We are always here to help you. Reach out to us for product information, support, order help, or any questions about your beauty and self-care journey.';
        $contactPhone = $settings['contact_phone'] ?? '+8801978675507';
        $contactEmail = $settings['contact_email'] ?? 'support@example.com';
        $contactAddress = $settings['contact_address'] ?? 'Dhaka, Bangladesh';
        $facebookUrl = $settings['facebook_url'] ?? null;
        $instagramUrl = $settings['instagram_url'] ?? null;
        $whatsappUrl = $settings['whatsapp_url'] ?? null;
        $twitterUrl = $settings['twitter_url'] ?? null;
        $linkedinUrl = $settings['linkedin_url'] ?? null;

        $contactHours = $settings['contact_hours'] ?? 'Saturday - Thursday, 9:00 AM - 8:00 PM';
        $mapEmbed = $settings['contact_map_embed'] ?? 'https://www.google.com/maps?q=Dhaka,Bangladesh&output=embed';

        $buttonColor = $settings['button_color'] ?? '#16a34a';
        $accentColor = $settings['accent_color'] ?? '#7db343';
    @endphp

    <section class="relative overflow-hidden bg-[#f8faf8] min-h-screen">
        <!-- Background Decorations -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-24 -left-24 w-80 h-80 rounded-full bg-green-100/50 blur-3xl"></div>
            <div class="absolute top-1/4 -right-24 w-96 h-96 rounded-full bg-emerald-100/30 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-72 h-72 rounded-full bg-lime-100/20 blur-3xl"></div>

            <div class="absolute top-32 left-[8%] hidden lg:block contact-float-slow opacity-80">
                <svg width="95" height="95" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M109 13C79 18 53 34 35 55C18 75 11 95 12 108C31 107 50 100 69 84C88 68 102 44 109 13Z"
                        fill="{{ $accentColor }}" />
                    <path d="M28 95C45 76 63 57 90 34" stroke="#eaffea" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>

            <div class="absolute bottom-24 right-[10%] hidden lg:block contact-float-fast opacity-80">
                <svg width="110" height="110" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M109 13C79 18 53 34 35 55C18 75 11 95 12 108C31 107 50 100 69 84C88 68 102 44 109 13Z"
                        fill="{{ $buttonColor }}" />
                    <path d="M28 95C45 76 63 57 90 34" stroke="#efffef" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 lg:py-20">
            <!-- Hero -->
            <div class="max-w-3xl mx-auto text-center">
                <span
                    class="inline-flex items-center rounded-full border border-green-100 bg-white/80 backdrop-blur px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide text-green-700 shadow-sm contact-fade-up">
                    {{ $contactSubtitle }}
                </span>

                <h1 class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-[#111827] leading-[1.08] contact-fade-up contact-delay-1">
                    {{ $contactTitle }}
                </h1>

                <p class="mt-5 text-sm sm:text-base leading-8 text-[#667085] max-w-2xl mx-auto contact-fade-up contact-delay-2">
                    {{ $contactDescription }}
                </p>
            </div>

            <!-- Top Cards -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                <div class="contact-fade-up contact-delay-1 rounded-[28px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_16px_50px_rgba(15,23,42,0.06)] p-6">
                    <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-700 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.72 19.72 0 0 1-8.63-3.07 19.42 19.42 0 0 1-6-6A19.72 19.72 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#111827]">Phone</h3>
                    <p class="mt-3 text-sm leading-7 text-[#667085]">{{ $contactPhone }}</p>
                </div>

                <div class="contact-fade-up contact-delay-2 rounded-[28px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_16px_50px_rgba(15,23,42,0.06)] p-6">
                    <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-700 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16v16H4z"></path>
                            <path d="m22 6-10 7L2 6"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#111827]">Email</h3>
                    <p class="mt-3 text-sm leading-7 text-[#667085] break-all">{{ $contactEmail }}</p>
                </div>

                <div class="contact-fade-up contact-delay-3 rounded-[28px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_16px_50px_rgba(15,23,42,0.06)] p-6">
                    <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-700 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 1 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#111827]">Address</h3>
                    <p class="mt-3 text-sm leading-7 text-[#667085]">{{ $contactAddress }}</p>
                </div>

                <div class="contact-fade-up contact-delay-4 rounded-[28px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_16px_50px_rgba(15,23,42,0.06)] p-6">
                    <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-700 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M12 6v6l4 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-[#111827]">Working Hours</h3>
                    <p class="mt-3 text-sm leading-7 text-[#667085]">{{ $contactHours }}</p>
                </div>
            </div>
            @if(session('success'))
                <div class="bg-green-500 text-white font-bold py-3 px-5 rounded-lg shadow-lg mb-4 transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl">
                    <svg class="inline-block w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11l2 2-4 4-2-2 2-2 2 2zm0 0l-2 2 2 2z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 text-white font-bold py-3 px-5 rounded-lg shadow-lg mb-4 transition-all duration-300 ease-in-out transform hover:scale-105 hover:shadow-xl">
                    <svg class="inline-block w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11l2 2-4 4-2-2 2-2 2 2zm0 0l-2 2 2 2z" clip-rule="evenodd"></path>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            <!-- Main Contact Area -->
            <div class="mt-10 grid grid-cols-1 lg:grid-cols-[1fr_.9fr] gap-8">
                <!-- Contact Form -->
                <div class="contact-fade-up contact-delay-2 rounded-[32px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_18px_60px_rgba(15,23,42,0.06)] p-6 sm:p-8 lg:p-10">
                    <span class="inline-block text-green-700 text-sm font-semibold tracking-wide">Send Message</span>
                    <h2 class="mt-3 text-3xl sm:text-4xl font-extrabold text-[#111827] leading-tight">
                        Let’s talk with you
                    </h2>

                    <form action="{{ route('contact.store') }}" method="POST" class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-5">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-[#111827] mb-2">Your Name</label>
                            <input type="text" name="name"
                                class="w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 outline-none focus:border-green-500 focus:ring-4 focus:ring-green-100 transition"
                                placeholder="Enter your full name" required>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-[#111827] mb-2">Phone Number</label>
                            <input type="text" name="phone"
                                class="w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 outline-none focus:border-green-500 focus:ring-4 focus:ring-green-100 transition"
                                placeholder="Enter your phone">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-[#111827] mb-2">Email Address</label>
                            <input type="email" name="email"
                                class="w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 outline-none focus:border-green-500 focus:ring-4 focus:ring-green-100 transition"
                                placeholder="Enter your email" required>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-[#111827] mb-2">Subject</label>
                            <input type="text" name="subject"
                                class="w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 outline-none focus:border-green-500 focus:ring-4 focus:ring-green-100 transition"
                                placeholder="Write your subject" required>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-[#111827] mb-2">Message</label>
                            <textarea rows="6" name="message"
                                class="w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 outline-none resize-none focus:border-green-500 focus:ring-4 focus:ring-green-100 transition"
                                placeholder="Write your message..." required></textarea>
                        </div>

                        <!-- Google reCAPTCHA -->
                        {{-- <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div> --}}

                        <div class="sm:col-span-2">
                            <button type="submit"
                                class="inline-flex items-center justify-center rounded-full px-8 py-4 text-white font-semibold shadow-[0_12px_30px_rgba(22,163,74,0.22)] hover:opacity-90 transition"
                                style="background: {{ $buttonColor }};">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Side Info -->
                <div class="space-y-8">
                    <div class="contact-fade-up contact-delay-3 rounded-[32px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_18px_60px_rgba(15,23,42,0.06)] p-6 sm:p-8">
                        <span class="inline-block text-green-700 text-sm font-semibold tracking-wide">Connect With Us</span>
                        <h3 class="mt-3 text-2xl sm:text-3xl font-extrabold text-[#111827]">
                            Follow our journey
                        </h3>

                        <p class="mt-4 text-sm sm:text-base leading-8 text-[#667085]">
                            Stay connected through our social platforms for updates, beauty tips, and product highlights.
                        </p>

                        <div class="mt-6 flex flex-wrap gap-3">
                            @if($facebookUrl)
                                <a href="{{ $facebookUrl }}" target="_blank"
                                    class="w-12 h-12 rounded-full bg-white border border-gray-200 text-[#111827] flex items-center justify-center hover:bg-green-50 hover:text-green-700 transition">
                                    f
                                </a>
                            @endif

                            @if($instagramUrl)
                                <a href="{{ $instagramUrl }}" target="_blank"
                                    class="w-12 h-12 rounded-full bg-white border border-gray-200 text-[#111827] flex items-center justify-center hover:bg-green-50 hover:text-green-700 transition">
                                    ig
                                </a>
                            @endif

                            @if($whatsappUrl)
                                <a href="{{ $whatsappUrl }}" target="_blank"
                                    class="w-12 h-12 rounded-full bg-white border border-gray-200 text-[#111827] flex items-center justify-center hover:bg-green-50 hover:text-green-700 transition">
                                    wa
                                </a>
                            @endif

                            @if($twitterUrl)
                                <a href="{{ $twitterUrl }}" target="_blank"
                                    class="w-12 h-12 rounded-full bg-white border border-gray-200 text-[#111827] flex items-center justify-center hover:bg-green-50 hover:text-green-700 transition">
                                    x
                                </a>
                            @endif

                            @if($linkedinUrl)
                                <a href="{{ $linkedinUrl }}" target="_blank"
                                    class="w-12 h-12 rounded-full bg-white border border-gray-200 text-[#111827] flex items-center justify-center hover:bg-green-50 hover:text-green-700 transition">
                                    in
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="contact-fade-up contact-delay-4 rounded-[32px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_18px_60px_rgba(15,23,42,0.06)] overflow-hidden">
                        <div class="p-6 sm:p-8 border-b border-gray-100">
                            <span class="inline-block text-green-700 text-sm font-semibold tracking-wide">Location</span>
                            <h3 class="mt-3 text-2xl sm:text-3xl font-extrabold text-[#111827]">
                                Find us on map
                            </h3>
                        </div>

                        <div class="h-[320px]">
                            <iframe src="{{ $mapEmbed }}"
                                class="w-full h-full border-0"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .contact-fade-up {
            opacity: 0;
            transform: translateY(24px);
            animation: contactFadeUp .8s ease forwards;
        }

        .contact-delay-1 { animation-delay: .12s; }
        .contact-delay-2 { animation-delay: .24s; }
        .contact-delay-3 { animation-delay: .36s; }
        .contact-delay-4 { animation-delay: .48s; }

        @keyframes contactFadeUp {
            0% {
                opacity: 0;
                transform: translateY(24px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes contactFloatSlow {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        @keyframes contactFloatFast {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        .contact-float-slow {
            animation: contactFloatSlow 6s ease-in-out infinite;
        }

        .contact-float-fast {
            animation: contactFloatFast 4.8s ease-in-out infinite;
        }
    </style>
@endsection