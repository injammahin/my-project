@php
    $siteName = config('app.name', 'Beauty');
    $phone = $settings['contact_phone'] ?? '(88) - 1234 45678';
    $email = $settings['contact_email'] ?? 'hello@example.com';
    $address = $settings['contact_address'] ?? '1600 Yellow Miston Main Road, Jamirity, New York, USA';

    $facebook = $settings['facebook_url'] ?? null;
    $instagram = $settings['instagram_url'] ?? null;
    $twitter = $settings['twitter_url'] ?? null;
    $linkedin = $settings['linkedin_url'] ?? null;

    $footerText = $settings['footer_text'] ?? 'Premium beauty care with trusted quality and natural confidence.';
@endphp

<footer class="bg-[#eff9f4] border-t border-green-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-16 pb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

            <!-- Brand / About -->
            <div class="lg:pr-6">
                <h3 class="text-2xl font-bold text-[#1f2d1f] tracking-tight">
                    {{ $siteName }}
                </h3>

                <div class="w-16 h-1 bg-green-600 rounded-full mt-4 mb-5"></div>

                <p class="text-sm leading-7 text-[#385046]">
                    {{ $footerText }}
                </p>

                <div class="mt-6 space-y-3 text-sm text-[#1f2d1f]">
                    <div class="flex items-start gap-3">
                        <span class="mt-1 text-green-600">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M6.62 10.79a15.05 15.05 0 006.59 6.59l2.2-2.2a1 1 0 011-.24c1.12.37 2.33.56 3.59.56a1 1 0 011 1V20a1 1 0 01-1 1C10.3 21 3 13.7 3 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.26.19 2.47.56 3.59a1 1 0 01-.24 1l-2.2 2.2z" />
                            </svg>
                        </span>
                        <span>{{ $phone }}</span>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="mt-1 text-green-600">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M20 4H4a2 2 0 00-2 2v.4l10 6.25L22 6.4V6a2 2 0 00-2-2zm2 5.35l-9.47 5.92a1 1 0 01-1.06 0L2 9.35V18a2 2 0 002 2h16a2 2 0 002-2V9.35z" />
                            </svg>
                        </span>
                        <span class="break-all">{{ $email }}</span>
                    </div>

                    <div class="flex items-start gap-3">
                        <span class="mt-1 text-green-600">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5A2.5 2.5 0 1112 6a2.5 2.5 0 010 5.5z" />
                            </svg>
                        </span>
                        <span>{{ $address }}</span>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold text-[#1f2d1f]">Quick Links</h4>
                <div class="w-12 h-1 bg-green-600 rounded-full mt-4 mb-5"></div>

                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ route('landing') }}"
                            class="text-[#385046] hover:text-green-600 transition duration-300">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}"
                            class="text-[#385046] hover:text-green-600 transition duration-300">
                            About Us
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products') }}"
                            class="text-[#385046] hover:text-green-600 transition duration-300">
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog') }}"
                            class="text-[#385046] hover:text-green-600 transition duration-300">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                            class="text-[#385046] hover:text-green-600 transition duration-300">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-lg font-semibold text-[#1f2d1f]">Support</h4>
                <div class="w-12 h-1 bg-green-600 rounded-full mt-4 mb-5"></div>

                <ul class="space-y-3 text-sm">
                    <li>
                        <a href="{{ route('contact') }}"
                            class="text-[#385046] hover:text-green-600 transition duration-300">
                            Help Center
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                            class="text-[#385046] hover:text-green-600 transition duration-300">
                            Delivery & Payment
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                            class="text-[#385046] hover:text-green-600 transition duration-300">
                            Terms & Conditions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                            class="text-[#385046] hover:text-green-600 transition duration-300">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                            class="text-[#385046] hover:text-green-600 transition duration-300">
                            Order Support
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Follow Us -->
            <div>
                <h4 class="text-lg font-semibold text-[#1f2d1f]">Follow Us</h4>
                <div class="w-12 h-1 bg-green-600 rounded-full mt-4 mb-5"></div>

                <p class="text-sm leading-7 text-[#385046] mb-5">
                    Stay connected with us on social media for updates, beauty tips, and offers.
                </p>

                <div class="flex flex-wrap gap-3">
                    @if($facebook)
                        <a href="{{ $facebook }}" target="_blank"
                            class="w-11 h-11 rounded-full bg-green-600 text-white flex items-center justify-center hover:bg-green-700 transition duration-300 shadow-sm">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M13.5 22v-8h2.7l.4-3h-3.1V9.1c0-.9.3-1.6 1.6-1.6h1.7V4.8c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3V11H8v3h2.6v8h2.9z" />
                            </svg>
                        </a>
                    @endif

                    @if($instagram)
                        <a href="{{ $instagram }}" target="_blank"
                            class="w-11 h-11 rounded-full bg-green-600 text-white flex items-center justify-center hover:bg-green-700 transition duration-300 shadow-sm">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm0 2a3 3 0 00-3 3v10a3 3 0 003 3h10a3 3 0 003-3V7a3 3 0 00-3-3H7zm5 3.5A5.5 5.5 0 1112 18.5 5.5 5.5 0 0112 7.5zm0 2A3.5 3.5 0 1015.5 13 3.5 3.5 0 0012 9.5zm5.75-3.25a1.25 1.25 0 11-1.25 1.25 1.25 1.25 0 011.25-1.25z" />
                            </svg>
                        </a>
                    @endif

                    @if($twitter)
                        <a href="{{ $twitter }}" target="_blank"
                            class="w-11 h-11 rounded-full bg-green-600 text-white flex items-center justify-center hover:bg-green-700 transition duration-300 shadow-sm">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M22 5.8c-.7.3-1.5.5-2.3.6.8-.5 1.4-1.2 1.7-2.1-.8.5-1.7.8-2.6 1-1.5-1.6-4.2-1.7-5.8-.1-.8.8-1.2 1.8-1.1 2.9-3.3-.2-6.4-1.8-8.4-4.4-1.1 1.8-.5 4.1 1.2 5.3-.6 0-1.2-.2-1.7-.5 0 0 0 .1 0 .1 0 2 1.4 3.7 3.3 4.1-.6.2-1.2.2-1.8.1.5 1.6 2 2.8 3.8 2.8A7.8 7.8 0 012 18.6 11 11 0 008 20c7.2 0 11.4-6 11.1-11.4.8-.5 1.5-1.2 2-2z" />
                            </svg>
                        </a>
                    @endif

                    @if($linkedin)
                        <a href="{{ $linkedin }}" target="_blank"
                            class="w-11 h-11 rounded-full bg-green-600 text-white flex items-center justify-center hover:bg-green-700 transition duration-300 shadow-sm">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M6.94 8.5H3.56V20h3.38V8.5zM5.25 3A1.97 1.97 0 003.28 4.97 1.97 1.97 0 005.25 7a1.97 1.97 0 001.97-2.03A1.97 1.97 0 005.25 3zM20.44 12.66c0-3.45-1.84-5.05-4.29-5.05a3.7 3.7 0 00-3.33 1.84h-.05V8.5H9.53c.04.62 0 11.5 0 11.5h3.24v-6.42c0-.34.02-.68.12-.92a2.13 2.13 0 012-1.42c1.42 0 1.98 1.08 1.98 2.66V20h3.24z" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-green-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-5">
            <div
                class="flex flex-col md:flex-row items-center justify-between gap-3 text-sm text-[#385046] text-center md:text-left">
                <p>
                    © {{ date('Y') }} {{ $siteName }}. All rights reserved.
                </p>

                <p>
                    Developed by <span class="font-semibold text-green-700">NexolioIT</span>
                </p>
            </div>
        </div>
    </div>
</footer>