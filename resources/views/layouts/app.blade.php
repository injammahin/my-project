<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $settings = $settings ?? [];

        $pageTitle = $title ?? config('app.name', 'My Website');

        $primaryColor = $settings['button_color'] ?? '#1f2d1f';
        $accentColor = $settings['background_color'] ?? '#efddd3cd';

        $whatsappRaw = $settings['contact_phone'] ?? $settings['whatsapp_number'] ?? '+8801978675507';
        $whatsappNumber = preg_replace('/\D+/', '', $whatsappRaw);

        $whatsappLabel = $settings['whatsapp_label'] ?? 'Chat with us';
        $whatsappWelcome = $settings['whatsapp_welcome'] ?? 'Hi 👋 How can we help you today?';
        $whatsappDefaultMessage = $settings['whatsapp_default_message'] ?? 'Hello, I want to know more about your products.';
    @endphp

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle }}</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <style>
        :root {
            --primary-color:
                {{ $primaryColor }}
            ;
            --accent-color:
                {{ $accentColor }}
            ;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        .floating-btn {
            width: 56px;
            height: 56px;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.16);
            transition: all .3s ease;
        }

        .floating-btn:hover {
            transform: translateY(-3px) scale(1.03);
        }

        .wa-pulse {
            position: relative;
        }

        .wa-pulse::before,
        .wa-pulse::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 9999px;
            background: rgba(34, 197, 94, 0.25);
            animation: waPulse 2.4s infinite;
            z-index: -1;
        }

        .wa-pulse::after {
            animation-delay: 1.2s;
        }

        @keyframes waPulse {
            0% {
                transform: scale(1);
                opacity: .7;
            }

            100% {
                transform: scale(1.8);
                opacity: 0;
            }
        }

        .chat-card-enter {
            opacity: 0;
            transform: translateY(18px) scale(.98);
            pointer-events: none;
        }

        .chat-card-open {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-800 font-['Inter']">

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    <div class="fixed right-4 sm:right-6 bottom-4 sm:bottom-6 z-[999] flex flex-col items-end gap-3">

        <!-- WhatsApp Chat Card -->
        <div id="whatsappChatCard"
            class="chat-card-enter transition-all duration-300 w-[calc(100vw-2rem)] max-w-[360px] rounded-[28px] overflow-hidden border border-white/70 bg-white/95 backdrop-blur-xl shadow-[0_25px_80px_rgba(15,23,42,0.18)]">

            <div class="px-5 py-4 text-white" style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-full bg-white/20 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 32 32"
                                fill="currentColor">
                                <path
                                    d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a7.692 7.692 0 0 1-3.01-1.974 8.17 8.17 0 0 1-2.002-3.066c0-.426 1.312-1.092 1.312-1.46 0-.183-.082-.36-.189-.505-.536-.73-1.33-1.782-1.945-1.782-.168 0-.312.071-.45.159-.533.34-1.429 1.286-1.429 1.882 0 .272.032.543.09.808.34 1.566 1.196 3.065 2.367 4.278 1.464 1.51 3.28 2.735 5.278 3.296.213.06.434.091.656.091.597 0 1.642-.785 1.98-1.309.1-.156.162-.328.162-.51 0-.564-1.034-1.42-1.802-1.974a.886.886 0 0 0-.514-.168z" />
                                <path
                                    d="M16.001 3.2c-7.056 0-12.8 5.744-12.8 12.8 0 2.257.59 4.46 1.71 6.4L3.2 28.8l6.56-1.675A12.73 12.73 0 0 0 16 28.8c7.056 0 12.8-5.744 12.8-12.8 0-7.056-5.744-12.8-12.799-12.8zm0 23.467a10.57 10.57 0 0 1-5.387-1.474l-.386-.23-3.893.994.998-3.797-.252-.39a10.55 10.55 0 0 1-1.615-5.77c0-5.864 4.77-10.634 10.635-10.634 5.863 0 10.633 4.77 10.633 10.634 0 5.864-4.77 10.667-10.633 10.667z" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-base font-bold">{{ $whatsappLabel }}</h3>
                            <p class="text-xs text-white/90">Typically replies on WhatsApp</p>
                        </div>
                    </div>

                    <button id="closeWhatsappCard" type="button"
                        class="w-9 h-9 rounded-full bg-white/15 hover:bg-white/25 flex items-center justify-center transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-4 bg-[#f6fbf7]">
                <div class="rounded-2xl bg-white p-4 border border-green-100 shadow-sm">
                    <p class="text-sm leading-7 text-gray-700">
                        {{ $whatsappWelcome }}
                    </p>
                </div>

                <button id="sendWhatsappMessage" type="button"
                    class="mt-4 w-full inline-flex items-center justify-center gap-2 rounded-full px-5 py-3 text-white font-semibold transition hover:opacity-90"
                    style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="22" y1="2" x2="11" y2="13" />
                        <polygon points="22 2 15 22 11 13 2 9 22 2" />
                    </svg>
                    Open WhatsApp
                </button>
            </div>
        </div>

        <div class="flex gap-4">
            <!-- Scroll to top -->
            <button id="scrollTopBtn" type="button"
                class="floating-btn bg-white text-[#111827] border border-gray-200 hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 15l-6-6-6 6" />
                </svg>
            </button>

            <!-- WhatsApp button -->
            <button id="openWhatsappCard" type="button" class="floating-btn wa-pulse text-white"
                style="background: linear-gradient(135deg, #22c55e, #16a34a);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 32 32" fill="currentColor">
                    <path
                        d="M19.11 17.205c-.372 0-1.088 1.39-1.518 1.39a7.692 7.692 0 0 1-3.01-1.974 8.17 8.17 0 0 1-2.002-3.066c0-.426 1.312-1.092 1.312-1.46 0-.183-.082-.36-.189-.505-.536-.73-1.33-1.782-1.945-1.782-.168 0-.312.071-.45.159-.533.34-1.429 1.286-1.429 1.882 0 .272.032.543.09.808.34 1.566 1.196 3.065 2.367 4.278 1.464 1.51 3.28 2.735 5.278 3.296.213.06.434.091.656.091.597 0 1.642-.785 1.98-1.309.1-.156.162-.328.162-.51 0-.564-1.034-1.42-1.802-1.974a.886.886 0 0 0-.514-.168z" />
                    <path
                        d="M16.001 3.2c-7.056 0-12.8 5.744-12.8 12.8 0 2.257.59 4.46 1.71 6.4L3.2 28.8l6.56-1.675A12.73 12.73 0 0 0 16 28.8c7.056 0 12.8-5.744 12.8-12.8 0-7.056-5.744-12.8-12.799-12.8zm0 23.467a10.57 10.57 0 0 1-5.387-1.474l-.386-.23-3.893.994.998-3.797-.252-.39a10.55 10.55 0 0 1-1.615-5.77c0-5.864 4.77-10.634 10.635-10.634 5.863 0 10.633 4.77 10.633 10.634 0 5.864-4.77 10.667-10.633 10.667z" />
                </svg>
            </button>
        </div>
    </div>

    @include('partials.footer')

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const scrollTopBtn = document.getElementById('scrollTopBtn');
            const openWhatsappCard = document.getElementById('openWhatsappCard');
            const closeWhatsappCard = document.getElementById('closeWhatsappCard');
            const whatsappChatCard = document.getElementById('whatsappChatCard');
            const sendWhatsappMessage = document.getElementById('sendWhatsappMessage');

            const whatsappNumber = @json($whatsappNumber);
            const whatsappDefaultMessage = @json($whatsappDefaultMessage);

            function openCard() {
                if (!whatsappChatCard) return;
                whatsappChatCard.classList.remove('chat-card-enter');
                whatsappChatCard.classList.add('chat-card-open');
            }

            function closeCard() {
                if (!whatsappChatCard) return;
                whatsappChatCard.classList.remove('chat-card-open');
                whatsappChatCard.classList.add('chat-card-enter');
            }

            function openWhatsappDirect() {
                const message = (whatsappDefaultMessage || 'Hello').trim();
                const encodedMessage = encodeURIComponent(message);
                const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodedMessage}`;
                window.open(whatsappUrl, '_blank');
            }

            openWhatsappCard?.addEventListener('click', function () {
                if (whatsappChatCard?.classList.contains('chat-card-open')) {
                    closeCard();
                } else {
                    openCard();
                }
            });

            closeWhatsappCard?.addEventListener('click', function () {
                closeCard();
            });

            sendWhatsappMessage?.addEventListener('click', function () {
                openWhatsappDirect();
            });

            scrollTopBtn?.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            window.addEventListener('scroll', function () {
                if (!scrollTopBtn) return;

                if (window.scrollY > 300) {
                    scrollTopBtn.classList.remove('hidden');
                } else {
                    scrollTopBtn.classList.add('hidden');
                }
            });

            document.addEventListener('click', function (e) {
                if (
                    whatsappChatCard &&
                    openWhatsappCard &&
                    !whatsappChatCard.contains(e.target) &&
                    !openWhatsappCard.contains(e.target)
                ) {
                    closeCard();
                }
            });
        });
    </script>

</body>

</html>