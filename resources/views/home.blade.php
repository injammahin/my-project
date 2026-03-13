@extends('layouts.app')

@section('content')
    <section class="relative min-h-[85vh] sm:min-h-screen overflow-hidden">
        <!-- Background Image -->
        <div class="absolute ">
            <img src="/img/img.jpg" alt="Beauty Hero Background" class="w-full h-full object-cover object-center">
        </div>

        <!-- Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="min-h-[85vh] sm:min-h-screen flex items-center">
                <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">

                    <!-- Left Content -->
                    <div class="max-w-2xl text-center lg:text-left pt-14 sm:pt-20 lg:pt-0">
                        <span
                            class="hero-badge hero-animate inline-flex items-center rounded-full bg-green-100 text-green-700 px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide shadow-sm">
                            Natural Beauty Care
                        </span>

                        <h1
                            class="hero-title hero-animate hero-delay-1 mt-5 text-4xl sm:text-5xl md:text-6xl xl:text-7xl font-extrabold text-slate-900 leading-[1.05]">
                            Confidence begins with your best choice
                        </h1>

                        <p
                            class="hero-text hero-animate hero-delay-2 mt-6 text-base sm:text-lg md:text-xl text-slate-700 leading-8 max-w-xl mx-auto lg:mx-0">
                            Discover premium beauty essentials crafted to enhance your daily self-care routine with comfort,
                            elegance, and confidence.
                        </p>

                        <div
                            class="hero-animate hero-delay-3 mt-8 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                            <a href="{{ route('products') }}"
                                class="inline-flex items-center justify-center rounded-full bg-green-600 px-8 sm:px-10 py-4 text-white text-base sm:text-lg font-semibold shadow-lg shadow-green-600/20 hover:bg-green-700 hover:-translate-y-0.5 transition duration-300">
                                Shop Now
                            </a>

                            <a href="{{ route('about') }}"
                                class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white/80 backdrop-blur px-8 sm:px-10 py-4 text-slate-800 text-base sm:text-lg font-semibold hover:bg-white transition duration-300">
                                Learn More
                            </a>
                        </div>
                    </div>

                    <!-- Right Space -->
                    <div class="hidden lg:block"></div>
                </div>
            </div>
        </div>
        <style>
            .hero-animate {
                opacity: 0;
                transform: translateY(32px);
                animation: heroFadeUp 0.9s ease forwards;
            }

            .hero-delay-1 {
                animation-delay: 0.2s;
            }

            .hero-delay-2 {
                animation-delay: 0.4s;
            }

            .hero-delay-3 {
                animation-delay: 0.6s;
            }

            @keyframes heroFadeUp {
                0% {
                    opacity: 0;
                    transform: translateY(32px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 640px) {
                .hero-title {
                    line-height: 1.1;
                }

                .hero-text {
                    line-height: 1.8;
                }
            }
        </style>
    </section>
    <!-- SKIN CARE STEPS SECTION -->
    <section class="relative overflow-hidden bg-[#f8faf8] py-20 sm:py-24 lg:py-28">
        <!-- soft background -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[300px] bg-green-100/40 blur-3xl rounded-full">
            </div>
            <div class="absolute bottom-0 right-0 w-[260px] h-[260px] bg-green-50 blur-3xl rounded-full"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- heading -->
            <div class="max-w-3xl mx-auto text-center">
                <span
                    class="inline-flex items-center rounded-full bg-green-100 text-green-700 px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide">
                    View Beauty Work
                </span>

                <h2
                    class="mt-5 text-[30px] sm:text-[38px] lg:text-[48px] font-extrabold tracking-tight text-[#132018] leading-tight">
                    4 Steps for Your Skin Care
                </h2>

                <p class="mt-4 text-sm sm:text-base text-[#5f6f66] leading-7 max-w-2xl mx-auto">
                    Build a gentle skincare ritual with nourishing ingredients, healthy texture, and a refreshing glow from
                    morning to night.
                </p>
            </div>

            <!-- steps -->
            <div class="relative mt-14 lg:mt-16">
                <!-- connector line desktop -->
                <div
                    class="hidden lg:block absolute top-[82px] left-[12%] right-[12%] h-[2px] bg-gradient-to-r from-green-100 via-green-300 to-green-100">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-7 lg:gap-8">
                    <!-- Step 1 -->
                    <div
                        class="step-card step-delay-1 group relative rounded-[28px] bg-white/90 backdrop-blur shadow-[0_18px_45px_rgba(16,24,40,0.08)] border border-white/80 px-6 pt-8 pb-7 text-center hover:-translate-y-2 transition duration-500">
                        <div class="relative mx-auto w-[138px] h-[138px] sm:w-[150px] sm:h-[150px]">
                            <div
                                class="absolute -top-2 -left-2 w-9 h-9 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shadow-lg z-20">
                                1
                            </div>
                            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-green-100 to-white"></div>
                            <div class="relative w-full h-full p-[6px] rounded-full bg-white shadow-inner">
                                <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?auto=format&fit=crop&w=600&q=80"
                                    alt="Massage Hair Oil"
                                    class="w-full h-full rounded-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                        </div>

                        <h3 class="mt-6 text-[18px] font-extrabold uppercase tracking-tight text-[#16211b] leading-6">
                            Massage Hair Oil
                        </h3>
                        <p class="mt-1 text-sm font-semibold text-green-700">
                            (১০ মিনিট)
                        </p>
                        <p class="mt-4 text-sm leading-7 text-[#66756d]">
                            Relax the scalp with a nourishing oil massage to improve comfort, softness, and natural shine.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div
                        class="step-card step-delay-2 group relative rounded-[28px] bg-white/90 backdrop-blur shadow-[0_18px_45px_rgba(16,24,40,0.08)] border border-white/80 px-6 pt-8 pb-7 text-center hover:-translate-y-2 transition duration-500">
                        <div class="relative mx-auto w-[138px] h-[138px] sm:w-[150px] sm:h-[150px]">
                            <div
                                class="absolute -top-2 -left-2 w-9 h-9 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shadow-lg z-20">
                                2
                            </div>
                            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-green-100 to-white"></div>
                            <div class="relative w-full h-full p-[6px] rounded-full bg-white shadow-inner">
                                <img src="https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9?auto=format&fit=crop&w=600&q=80"
                                    alt="Herbal Shampoo Wash"
                                    class="w-full h-full rounded-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                        </div>

                        <h3 class="mt-6 text-[18px] font-extrabold uppercase tracking-tight text-[#16211b] leading-6">
                            Herbal Shampoo Wash
                        </h3>
                        <p class="mt-1 text-sm font-semibold text-green-700">
                            (প্রতি ১৫ মিনিট)
                        </p>
                        <p class="mt-4 text-sm leading-7 text-[#66756d]">
                            Cleanse gently with herbal shampoo to remove buildup while keeping the hair fresh and balanced.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div
                        class="step-card step-delay-3 group relative rounded-[28px] bg-white/90 backdrop-blur shadow-[0_18px_45px_rgba(16,24,40,0.08)] border border-white/80 px-6 pt-8 pb-7 text-center hover:-translate-y-2 transition duration-500">
                        <div class="relative mx-auto w-[138px] h-[138px] sm:w-[150px] sm:h-[150px]">
                            <div
                                class="absolute -top-2 -left-2 w-9 h-9 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shadow-lg z-20">
                                3
                            </div>
                            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-green-100 to-white"></div>
                            <div class="relative w-full h-full p-[6px] rounded-full bg-white shadow-inner">
                                <img src="https://images.unsplash.com/photo-1598440947619-2c35fc9aa908?auto=format&fit=crop&w=600&q=80"
                                    alt="Protein Hair Pack"
                                    class="w-full h-full rounded-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                        </div>

                        <h3 class="mt-6 text-[18px] font-extrabold uppercase tracking-tight text-[#16211b] leading-6">
                            Protein Hair Pack
                        </h3>
                        <p class="mt-1 text-sm font-semibold text-green-700">
                            (প্রতি ৩০ মিনিট)
                        </p>
                        <p class="mt-4 text-sm leading-7 text-[#66756d]">
                            Restore moisture and smoothness with a rich protein pack for healthier texture and strength.
                        </p>
                    </div>

                    <!-- Step 4 -->
                    <div
                        class="step-card step-delay-4 group relative rounded-[28px] bg-white/90 backdrop-blur shadow-[0_18px_45px_rgba(16,24,40,0.08)] border border-white/80 px-6 pt-8 pb-7 text-center hover:-translate-y-2 transition duration-500">
                        <div class="relative mx-auto w-[138px] h-[138px] sm:w-[150px] sm:h-[150px]">
                            <div
                                class="absolute -top-2 -left-2 w-9 h-9 rounded-full bg-green-600 text-white text-sm font-bold flex items-center justify-center shadow-lg z-20">
                                4
                            </div>
                            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-green-100 to-white"></div>
                            <div class="relative w-full h-full p-[6px] rounded-full bg-white shadow-inner">
                                <img src="https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?auto=format&fit=crop&w=600&q=80"
                                    alt="Revitalize"
                                    class="w-full h-full rounded-full object-cover group-hover:scale-105 transition duration-500">
                            </div>
                        </div>

                        <h3 class="mt-6 text-[18px] font-extrabold uppercase tracking-tight text-[#16211b] leading-6">
                            Revitalize
                        </h3>
                        <p class="mt-1 text-sm font-semibold text-green-700">
                            (চুলের যত্নে উজ্জ্বলতা)
                        </p>
                        <p class="mt-4 text-sm leading-7 text-[#66756d]">
                            Finish the routine with a refreshing care step for a polished, soft, and glowing result.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .step-card {
                opacity: 0;
                transform: translateY(30px);
                animation: stepFadeUp .8s ease forwards;
            }

            .step-delay-1 {
                animation-delay: .12s;
            }

            .step-delay-2 {
                animation-delay: .24s;
            }

            .step-delay-3 {
                animation-delay: .36s;
            }

            .step-delay-4 {
                animation-delay: .48s;
            }

            @keyframes stepFadeUp {
                0% {
                    opacity: 0;
                    transform: translateY(30px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
    </section>
    @php
        $productImageUrl = function ($raw) {
            if (!$raw) {
                return 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=1200&q=80';
            }

            if (\Illuminate\Support\Str::startsWith($raw, ['http://', 'https://'])) {
                return $raw;
            }

            $raw = ltrim($raw, '/');

            if (\Illuminate\Support\Str::startsWith($raw, 'storage/')) {
                return asset($raw);
            }

            return asset('storage/' . $raw);
        };

        $productSlides = $products->map(function ($product) use ($productImageUrl) {
            return [
                'name' => $product->title ?? 'Product',
                'description' => $product->description ?: 'A premium product carefully selected for your landing page.',
                'image' => $productImageUrl($product->image ?? null),
            ];
        })->values()->all();
    @endphp

    @if(count($productSlides))
        <section id="product-info-slider" class="relative overflow-hidden bg-[#f8faf8] py-16 sm:py-20 lg:py-24"
            data-products='@json($productSlides)'>

            <!-- soft premium decoration -->
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute top-16 left-[7%] w-28 h-28 rounded-full bg-green-100/40 blur-3xl"></div>
                <div class="absolute bottom-16 right-[8%] w-32 h-32 rounded-full bg-emerald-100/30 blur-3xl"></div>
                <div class="absolute top-1/3 right-[14%] w-2.5 h-2.5 rounded-full bg-green-300/70"></div>
                <div class="absolute bottom-1/4 left-[12%] w-3 h-3 rounded-full bg-green-300/70"></div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Heading -->
                <div class="max-w-3xl mx-auto text-center">
                    <span class="inline-block text-green-600 text-sm font-semibold tracking-[0.18em] uppercase">
                        Ingredients
                    </span>

                    <h2
                        class="mt-3 text-[28px] sm:text-[38px] lg:text-[48px] leading-tight font-extrabold tracking-tight text-[#111827]">
                        Product information
                    </h2>

                    <p class="mt-4 text-sm sm:text-base leading-7 text-[#6b7280] max-w-2xl mx-auto">
                        Discover our featured products with a refined visual presentation and simple product details.
                    </p>
                </div>

                <div class="mt-14 lg:mt-16 grid grid-cols-1 lg:grid-cols-[1.02fr_.98fr] gap-10 lg:gap-14 items-center">
                    <!-- Left Side Image -->
                    <div class="relative flex justify-center lg:justify-start">
                        <div class="absolute left-2 top-8 w-20 h-20 rounded-full border border-green-200/50"></div>
                        <div class="absolute right-8 bottom-10 w-24 h-24 rounded-full border border-green-200/40"></div>
                        <div class="absolute left-8 bottom-16 w-2.5 h-2.5 rounded-full bg-green-400/70"></div>
                        <div class="absolute right-14 top-14 w-3 h-3 rounded-full bg-green-300/70"></div>

                        <div class="relative w-full max-w-[520px] h-[280px] sm:h-[360px] lg:h-[460px]">
                            <div id="pi-image-wrap" class="absolute inset-0 flex items-center justify-center">
                                <img id="pi-image" src="{{ $productSlides[0]['image'] }}" alt="{{ $productSlides[0]['name'] }}"
                                    class="pi-image-el max-w-[88%] max-h-[88%] w-auto h-auto object-contain">
                            </div>
                        </div>
                    </div>

                    <!-- Right Side Cards -->
                    <div class="relative">
                        <!-- line + active dot -->
                        <div
                            class="hidden lg:block absolute right-3 top-5 bottom-5 w-px bg-gradient-to-b from-transparent via-[#dce9dc] to-transparent">
                        </div>
                        <div id="pi-active-dot"
                            class="hidden lg:block absolute right-0 top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-green-600 ring-[10px] ring-green-100 transition-all duration-500">
                        </div>

                        <div id="pi-cards-wrap" class="space-y-4 sm:space-y-5">
                            <!-- Previous -->
                            <button type="button" id="pi-card-prev"
                                class="pi-card-item pi-card-side w-full text-left rounded-[22px] border border-transparent px-4 sm:px-5 py-4">
                                <div class="flex items-start gap-3 sm:gap-4">
                                    <img data-role="image" src="" alt=""
                                        class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl object-cover shrink-0">
                                    <div class="min-w-0">
                                        <h3 data-role="name"
                                            class="text-[17px] sm:text-[18px] font-semibold text-[#111827] leading-tight"></h3>
                                        <p data-role="description"
                                            class="mt-2 text-[13px] sm:text-[14px] leading-6 text-[#4b5563]"></p>
                                    </div>
                                </div>
                            </button>

                            <!-- Current -->
                            <button type="button" id="pi-card-current"
                                class="pi-card-item pi-card-active w-full text-left rounded-[24px] border border-transparent px-4 sm:px-5 py-5">
                                <div class="flex items-start gap-3 sm:gap-4">
                                    <img data-role="image" src="" alt=""
                                        class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl object-cover shrink-0">
                                    <div class="min-w-0">
                                        <h3 data-role="name"
                                            class="text-[19px] sm:text-[21px] font-semibold text-[#111827] leading-tight"></h3>
                                        <p data-role="description"
                                            class="mt-2.5 text-[14px] sm:text-[15px] leading-6 sm:leading-7 text-[#4b5563]"></p>
                                    </div>
                                </div>
                            </button>

                            <!-- Next -->
                            <button type="button" id="pi-card-next"
                                class="pi-card-item pi-card-side w-full text-left rounded-[22px] border border-transparent px-4 sm:px-5 py-4">
                                <div class="flex items-start gap-3 sm:gap-4">
                                    <img data-role="image" src="" alt=""
                                        class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl object-cover shrink-0">
                                    <div class="min-w-0">
                                        <h3 data-role="name"
                                            class="text-[17px] sm:text-[18px] font-semibold text-[#111827] leading-tight"></h3>
                                        <p data-role="description"
                                            class="mt-2 text-[13px] sm:text-[14px] leading-6 text-[#4b5563]"></p>
                                    </div>
                                </div>
                            </button>
                        </div>

                        <!-- Mobile controls -->
                        <div class="mt-7 flex items-center justify-center gap-3 lg:hidden">
                            <button id="pi-prev" type="button"
                                class="w-10 h-10 rounded-full border border-green-200 bg-white text-green-700 hover:bg-green-50 transition">
                                ‹
                            </button>
                            <button id="pi-next" type="button"
                                class="w-10 h-10 rounded-full border border-green-200 bg-white text-green-700 hover:bg-green-50 transition">
                                ›
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .pi-card-item {
                    background: transparent;
                    transition:
                        opacity .45s ease,
                        transform .45s ease,
                        box-shadow .45s ease,
                        background-color .45s ease,
                        border-color .45s ease;
                    will-change: transform, opacity;
                    backface-visibility: hidden;
                }

                .pi-card-active {
                    opacity: 1;
                    background: #ffffff;
                    border-color: #edf7ee;
                    box-shadow: 0 22px 50px rgba(17, 24, 39, 0.08);
                    transform: translateX(-10px);
                }

                .pi-card-side {
                    opacity: .46;
                    transform: translateX(0);
                }

                .pi-stack-exit-down {
                    opacity: 0;
                    transform: translateY(-24px);
                }

                .pi-stack-enter-down {
                    opacity: 0;
                    transform: translateY(24px);
                }

                .pi-stack-exit-up {
                    opacity: 0;
                    transform: translateY(24px);
                }

                .pi-stack-enter-up {
                    opacity: 0;
                    transform: translateY(-24px);
                }

                #pi-cards-wrap {
                    transition: opacity .48s ease, transform .48s ease;
                    will-change: transform, opacity;
                    backface-visibility: hidden;
                }

                .pi-image-el {
                    transition: opacity .55s ease, transform .55s ease;
                    will-change: transform, opacity;
                    backface-visibility: hidden;
                }

                .pi-image-exit-down {
                    opacity: 0;
                    transform: translateY(-18px);
                }

                .pi-image-enter-down {
                    opacity: 0;
                    transform: translateY(18px);
                }

                .pi-image-exit-up {
                    opacity: 0;
                    transform: translateY(18px);
                }

                .pi-image-enter-up {
                    opacity: 0;
                    transform: translateY(-18px);
                }

                @media (max-width: 1023px) {
                    .pi-card-active {
                        transform: none;
                    }

                    .pi-stack-exit-down,
                    .pi-stack-enter-down,
                    .pi-stack-exit-up,
                    .pi-stack-enter-up {
                        transform: none;
                    }
                }
            </style>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const section = document.getElementById('product-info-slider');
                    if (!section) return;

                    const products = JSON.parse(section.dataset.products || '[]');
                    if (!products.length) return;

                    const image = document.getElementById('pi-image');
                    const cardsWrap = document.getElementById('pi-cards-wrap');

                    const prevCard = document.getElementById('pi-card-prev');
                    const currentCard = document.getElementById('pi-card-current');
                    const nextCard = document.getElementById('pi-card-next');

                    const prevBtn = document.getElementById('pi-prev');
                    const nextBtn = document.getElementById('pi-next');

                    let current = 0;
                    let autoSlide = null;
                    let isAnimating = false;

                    function getIndex(index) {
                        return (index + products.length) % products.length;
                    }

                    function shortText(text, limit) {
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = text;  // Parse HTML

                        // Get the plain text from HTML
                        let plainText = tempDiv.textContent || tempDiv.innerText;

                        // If plain text exceeds the limit, truncate it
                        if (plainText.length > limit) {
                            plainText = plainText.substring(0, limit) + '...';
                        }

                        // Set the truncated plain text back to the temporary div
                        tempDiv.innerHTML = plainText;

                        // Return the truncated HTML content
                        return tempDiv.innerHTML;
                    }

                    function fillCard(card, item, active = false) {
                        card.querySelector('[data-role="image"]').src = item.image;
                        card.querySelector('[data-role="image"]').alt = item.name;
                        card.querySelector('[data-role="name"]').textContent = item.name;
                        card.querySelector('[data-role="description"]').textContent = active
                            ? shortText(item.description, 80)
                            : shortText(item.description, 60);
                    }

                    function setCardStates() {
                        prevCard.classList.remove('pi-card-active');
                        prevCard.classList.add('pi-card-side');

                        currentCard.classList.remove('pi-card-side');
                        currentCard.classList.add('pi-card-active');

                        nextCard.classList.remove('pi-card-active');
                        nextCard.classList.add('pi-card-side');
                    }

                    function renderContent() {
                        const prevIndex = getIndex(current - 1);
                        const currentIndex = getIndex(current);
                        const nextIndex = getIndex(current + 1);

                        fillCard(prevCard, products[prevIndex], false);
                        fillCard(currentCard, products[currentIndex], true);
                        fillCard(nextCard, products[nextIndex], false);

                        prevCard.dataset.index = prevIndex;
                        currentCard.dataset.index = currentIndex;
                        nextCard.dataset.index = nextIndex;

                        image.src = products[currentIndex].image;
                        image.alt = products[currentIndex].name;

                        setCardStates();
                    }

                    function clearMotionClasses() {
                        cardsWrap.classList.remove('pi-stack-exit-down', 'pi-stack-enter-down', 'pi-stack-exit-up', 'pi-stack-enter-up');
                        image.classList.remove('pi-image-exit-down', 'pi-image-enter-down', 'pi-image-exit-up', 'pi-image-enter-up');
                    }

                    function animateTo(nextIndex, direction = 'down') {
                        if (isAnimating) return;
                        isAnimating = true;

                        clearInterval(autoSlide);
                        clearMotionClasses();

                        if (direction === 'down') {
                            cardsWrap.classList.add('pi-stack-exit-down');
                            image.classList.add('pi-image-exit-down');
                        } else {
                            cardsWrap.classList.add('pi-stack-exit-up');
                            image.classList.add('pi-image-exit-up');
                        }

                        setTimeout(() => {
                            current = getIndex(nextIndex);

                            clearMotionClasses();
                            renderContent();

                            if (direction === 'down') {
                                cardsWrap.classList.add('pi-stack-enter-down');
                                image.classList.add('pi-image-enter-down');
                            } else {
                                cardsWrap.classList.add('pi-stack-enter-up');
                                image.classList.add('pi-image-enter-up');
                            }

                            requestAnimationFrame(() => {
                                requestAnimationFrame(() => {
                                    clearMotionClasses();
                                });
                            });
                        }, 220);

                        setTimeout(() => {
                            isAnimating = false;
                            startAuto();
                        }, 720);
                    }

                    function goNext() {
                        animateTo(current + 1, 'down');
                    }

                    function goPrev() {
                        animateTo(current - 1, 'up');
                    }

                    function goTo(index) {
                        if (index === current) return;

                        if (index === getIndex(current + 1)) {
                            animateTo(index, 'down');
                        } else if (index === getIndex(current - 1)) {
                            animateTo(index, 'up');
                        } else {
                            animateTo(index, 'down');
                        }
                    }

                    function startAuto() {
                        clearInterval(autoSlide);
                        autoSlide = setInterval(() => {
                            goNext();
                        }, 3000);
                    }

                    prevCard.addEventListener('click', function () {
                        goTo(Number(this.dataset.index));
                    });

                    nextCard.addEventListener('click', function () {
                        goTo(Number(this.dataset.index));
                    });

                    if (prevBtn) {
                        prevBtn.addEventListener('click', goPrev);
                    }

                    if (nextBtn) {
                        nextBtn.addEventListener('click', goNext);
                    }

                    renderContent();
                    startAuto();
                });
            </script>
        </section>
    @endif
    @php
        use Illuminate\Support\Str;

        $storageUrl = function ($raw) {
            if (!$raw) {
                return 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=1200&q=80';
            }

            if (Str::startsWith($raw, ['http://', 'https://'])) {
                return $raw;
            }

            $raw = ltrim($raw, '/');

            if (Str::startsWith($raw, 'storage/')) {
                return asset($raw);
            }

            return asset('storage/' . $raw);
        };

        $currency = $settings['currency_symbol'] ?? '$';

        $bestSellers = collect($products)
            ->filter(fn($p) => (int) ($p->is_active ?? 1) === 1)
            ->sortBy('sort_order')
            ->take(3)
            ->values();
    @endphp

    @if($bestSellers->count())
        <section class="relative bg-[#f6f7f5] py-16 sm:py-20 lg:py-24 overflow-hidden">
            <!-- leaf -->
            <div class="absolute right-10 bottom-0 w-28 sm:w-36 lg:w-48 opacity-95 pointer-events-none">
                <img src="https://gallery.yopriceville.com/var/resizes/Free-Clipart-Pictures/Decorative-Elements-PNG/Tropical_Palm_Leaf_PNG_Clipart.png?m=1629830804"
                    alt="">
            </div>
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="relative rounded-[36px] bg-white shadow-[0_30px_90px_rgba(15,23,42,0.08)] px-5 sm:px-8 lg:px-12 py-10 sm:py-12 lg:py-14 overflow-hidden">

                    <div class="absolute -top-10 -left-10 w-40 h-40 rounded-full bg-green-50 blur-3xl pointer-events-none">
                    </div>
                    <div class="absolute -bottom-10 right-10 w-40 h-40 rounded-full bg-emerald-50 blur-3xl pointer-events-none">
                    </div>



                    <div class="text-center relative z-10">
                        <span class="inline-block text-green-600 text-sm font-semibold tracking-wide">
                            Order Now.
                        </span>

                        <h2
                            class="mt-2 text-[28px] sm:text-[38px] lg:text-[48px] leading-tight font-extrabold tracking-tight text-[#111827]">
                            Our Best Seller Products
                        </h2>
                    </div>

                    <div class="relative z-10 mt-10 sm:mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        @foreach($bestSellers as $index => $product)
                                @php
                                    $image = $storageUrl($product->image ?? null);
                                    $title = $product->title ?? 'Product';
                                    $desc = Str::limit($product->description ?? 'Premium beauty product for your skin and self-care routine.', 62);
                                    $price = $product->price ?? 0;
                                    $oldPrice = $product->old_price ?? null;
                                    $variant = $product->size_label ?? null;
                                    $isFeatured = $index === 1;
                                @endphp

                                <div class="group flex flex-col rounded-[28px] transition-all duration-300
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        {{ $isFeatured
                            ? 'bg-white shadow-[0_18px_55px_rgba(15,23,42,0.10)] border border-gray-100 -translate-y-1'
                            : 'bg-transparent' }}">

                                    <!-- image full cover area -->
                                    <div class="rounded-[24px] overflow-hidden h-[280px] sm:h-[320px] w-full bg-[#f8faf7]">
                                        <img src="{{ $image }}" alt="{{ $title }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.04]">
                                    </div>

                                    <div class="px-4 sm:px-5 pt-5 pb-6 text-center">
                                        <h3 class="text-[16px] sm:text-[17px] font-medium text-[#111827] leading-6">
                                            {{ $title }}
                                        </h3>

                                        @if($variant)
                                            <p class="mt-1 text-xs text-gray-400">
                                                {{ $variant }}
                                            </p>
                                        @endif

                                        <div class="mt-3 flex items-center justify-center gap-1 text-[#f7c948]">
                                            @for($i = 0; $i < 5; $i++)
                                                <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                            <span class="ml-1 text-xs text-gray-500">5.0</span>
                                        </div>

                                        <p class="mt-3 text-sm leading-6 text-gray-500 min-h-[48px]">
                                            {!! $desc!!}
                                        </p>

                                        <div class="mt-3 flex items-center justify-center gap-2">
                                            @if($oldPrice && $oldPrice > $price)
                                                <span class="text-sm text-gray-400 line-through">
                                                    {{ $currency }}{{ number_format($oldPrice, 2) }}
                                                </span>
                                            @endif

                                            <span class="text-[22px] font-bold text-green-700">
                                                {{ $currency }}{{ number_format($price, 2) }}
                                            </span>
                                        </div>

                                        <button type="button"
                                            class="mt-5 inline-flex items-center justify-center rounded-full bg-green-600 px-6 py-3 text-white text-sm font-semibold shadow-sm hover:bg-green-700 transition duration-300 add-to-cart-btn"
                                            data-add-cart data-id="{{ $product->id }}" data-title="{{ $title }}"
                                            data-price="{{ $price }}" data-image="{{ $image }}" data-variant="{{ $variant }}">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{--
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const buttons = document.querySelectorAll('.add-to-cart-btn');

                    function syncButtons() {
                        if (!window.LandingCart) return;

                        const cart = window.LandingCart.getCart();
                        const ids = cart.map(item => String(item.id));

                        buttons.forEach(button => {
                            const inCart = ids.includes(String(button.dataset.id));
                            button.textContent = inCart ? 'Added to cart' : 'Add to cart';
                            button.classList.toggle('bg-green-700', inCart);
                            button.classList.toggle('bg-green-600', !inCart);
                        });
                    }

                    buttons.forEach(button => {
                        button.addEventListener('click', function () {
                            if (!window.LandingCart) return;

                            window.LandingCart.add({
                                id: this.dataset.id,
                                title: this.dataset.title,
                                price: this.dataset.price,
                                image: this.dataset.image,
                                variant: this.dataset.variant || '',
                            });

                            this.textContent = 'Added to cart';
                            this.classList.remove('bg-green-600');
                            this.classList.add('bg-green-700');
                        });
                    });

                    window.addEventListener('landing-cart-updated', syncButtons);
                    syncButtons();
                });
            </script> --}}
        </section>
    @endif
    @php

        $storageUrl = function ($raw) {
            if (!$raw) {
                return 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=1200&q=80';
            }

            if (Str::startsWith($raw, ['http://', 'https://'])) {
                return $raw;
            }

            $raw = ltrim($raw, '/');

            if (Str::startsWith($raw, 'storage/')) {
                return asset($raw);
            }

            return asset('storage/' . $raw);
        };

        $currency = $settings['currency_symbol'] ?? '$';
        $bestSellers = collect($comboProducts)
            ->filter(fn($p) => (int) ($p->is_active ?? 1) === 1)
            ->sortBy('sort_order')
            ->take(3)
            ->values();
    @endphp

    @if($bestSellers->count())
        <section class="relative bg-[#f6f7f5] py-16 sm:py-20 lg:py-24 overflow-hidden">
            <!-- Decorative Leaf -->
            <div class="absolute left-0 bottom-0 w-28 sm:w-36 lg:w-48 opacity-95 pointer-events-none">
                <img src="https://gallery.yopriceville.com/var/resizes/Free-Clipart-Pictures/Decorative-Elements-PNG/Tropical_Palm_Leaf_PNG_Clipart.png?m=1629830804"
                    alt="Tropical Palm Leaf">
            </div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="relative rounded-[36px] bg-white shadow-[0_30px_90px_rgba(15,23,42,0.08)] px-5 sm:px-8 lg:px-12 py-10 sm:py-12 lg:py-14 overflow-hidden">

                    <!-- Background Circle Blurs -->
                    <div class="absolute -top-10 -left-10 w-40 h-40 rounded-full bg-green-50 blur-3xl pointer-events-none">
                    </div>
                    <div class="absolute -bottom-10 right-10 w-40 h-40 rounded-full bg-emerald-50 blur-3xl pointer-events-none">
                    </div>

                    <div class="text-center relative z-10">
                        <span class="inline-block text-green-600 text-sm font-semibold tracking-wide">Order Now.</span>
                        <h2
                            class="mt-2 text-[28px] sm:text-[38px] lg:text-[48px] leading-tight font-extrabold tracking-tight text-[#111827]">
                            Our Best Seller Combo Products
                        </h2>
                    </div>

                    <div class="relative z-10 mt-10 sm:mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                        @foreach($bestSellers as $index => $product)
                            @php
                                $image = $storageUrl($product->image ?? null);
                                $title = $product->title ?? 'Product';
                                $desc = Str::limit($product->description ?? 'Premium combo product for your skin and self-care routine.', 62);
                                $price = $product->sale_price ?? 0;
                                $oldPrice = $product->regular_price ?? null;
                                $variant = $product->size_label ?? null;
                                $isFeatured = $index === 1;
                            @endphp

                            <div
                                class="group flex flex-col rounded-[28px] transition-all duration-300
                                                                                                                                                                                                    {{ $isFeatured ? 'bg-white shadow-[0_18px_55px_rgba(15,23,42,0.10)] border border-gray-100 -translate-y-1' : 'bg-transparent' }}">

                                <!-- Product Image Section -->
                                <div class="rounded-[24px] overflow-hidden h-[280px] sm:h-[320px] w-full bg-[#f8faf7]">
                                    <img src="{{ $image }}" alt="{{ $title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.04]">
                                </div>

                                <div class="px-4 sm:px-5 pt-5 pb-6 text-center">
                                    <h3 class="text-[16px] sm:text-[17px] font-medium text-[#111827] leading-6">{{ $title }}</h3>

                                    @if($variant)
                                        <p class="mt-1 text-xs text-gray-400">{{ $variant }}</p>
                                    @endif

                                    <div class="mt-3 flex items-center justify-center gap-1 text-[#f7c948]">
                                        @for($i = 0; $i < 5; $i++)
                                            <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                        <span class="ml-1 text-xs text-gray-500">5.0</span>
                                    </div>

                                    <p class="mt-3 text-sm leading-6 text-gray-500 min-h-[48px]">{!! $desc !!}</p>

                                    <div class="mt-3 flex items-center justify-center gap-2">
                                        @if($oldPrice && $oldPrice > $price)
                                            <span class="text-sm text-gray-400 line-through">
                                                {{ $currency }}{{ number_format($oldPrice, 2) }}
                                            </span>
                                        @endif

                                        <span class="text-[22px] font-bold text-green-700">
                                            {{ $currency }}{{ number_format($price, 2) }}
                                        </span>
                                    </div>

                                    <button type="button"
                                        class="mt-5 inline-flex items-center justify-center rounded-full bg-green-600 px-6 py-3 text-white text-sm font-semibold shadow-sm hover:bg-green-700 transition duration-300 add-to-cart-btn"
                                        data-add-cart data-id="{{ $product->id }}" data-title="{{ $title }}"
                                        data-price="{{ $price }}" data-image="{{ $image }}" data-variant="{{ $variant }}">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const buttons = document.querySelectorAll('.add-to-cart-btn');

                    function syncButtons() {
                        if (!window.LandingCart) return;

                        const cart = window.LandingCart.getCart();
                        const ids = cart.map(item => String(item.id));

                        buttons.forEach(button => {
                            const inCart = ids.includes(String(button.dataset.id));
                            button.textContent = inCart ? 'Added to cart' : 'Add to cart';
                            button.classList.toggle('bg-green-700', inCart);
                            button.classList.toggle('bg-green-600', !inCart);
                        });
                    }

                    buttons.forEach(button => {
                        button.addEventListener('click', function () {
                            if (!window.LandingCart) return;

                            const price = this.dataset.sale_price || this.dataset.price;

                            window.LandingCart.add({
                                id: this.dataset.id,
                                title: this.dataset.title,
                                price: price,
                                image: this.dataset.image,
                                variant: this.dataset.variant || '',
                            });

                            this.textContent = 'Added to cart';
                            this.classList.remove('bg-green-600');
                            this.classList.add('bg-green-700');
                        });
                    });

                    window.addEventListener('landing-cart-updated', syncButtons);
                    syncButtons();
                });
            </script>
        </section>
    @endif



    {{-- ================= TESTIMONIALS ================= --}}
    @php
        $testimonialTitle = $settings['testimonial_title'] ?? 'What Our Customers Are Saying';

        $testimonialImageUrl = function ($raw) {
            if (!$raw) {
                return asset('img/review/suraiya.png');
            }

            if (\Illuminate\Support\Str::startsWith($raw, ['http://', 'https://'])) {
                return $raw;
            }

            $raw = ltrim($raw, '/');

            if (\Illuminate\Support\Str::startsWith($raw, 'storage/')) {
                return asset($raw);
            }

            return asset('storage/' . $raw);
        };

        $testis = $testimonials ?? collect([]);
    @endphp

    <section class="relative py-20 sm:py-24 overflow-hidden bg-[#f8faf8]">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-10 left-10 w-32 h-32 rounded-full bg-green-100/40 blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-40 h-40 rounded-full bg-emerald-100/30 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-14">
                <span class="inline-block text-green-600 text-sm font-semibold tracking-wide">
                    Testimonials
                </span>

                <h2 class="mt-2 text-3xl sm:text-4xl lg:text-5xl font-bold text-[#1f2d1f]"
                    style="font-family:'Playfair Display', serif;">
                    {{ $testimonialTitle }}
                </h2>

                <p class="mt-4 text-sm sm:text-base text-gray-500 max-w-2xl mx-auto leading-7">
                    Real experiences from our valued customers and partners.
                </p>
            </div>

            @if($testis->count())
                <div class="relative">
                    <!-- Desktop arrows -->
                    <button id="testimonialPrev"
                        class="hidden md:flex absolute left-[-18px] xl:left-[-28px] top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white shadow-lg border border-gray-100 items-center justify-center text-gray-400 hover:text-green-600 hover:bg-green-50 transition"
                        aria-label="Previous testimonial">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                    </button>

                    <button id="testimonialNext"
                        class="hidden md:flex absolute right-[-18px] xl:right-[-28px] top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full bg-white shadow-lg border border-gray-100 items-center justify-center text-gray-400 hover:text-green-600 hover:bg-green-50 transition"
                        aria-label="Next testimonial">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 18l6-6-6-6" />
                        </svg>
                    </button>

                    <!-- Slider -->
                    <div class="overflow-hidden">
                        <div id="testimonialTrack" class="flex transition-transform duration-500 ease-out">
                            @foreach($testis as $t)
                                @php
                                    $avatar = $testimonialImageUrl($t->image ?? $t->avatar ?? null);
                                    $name = $t->name ?? 'Customer';
                                    $line1 = $t->location ?? $t->subtitle ?? $t->title ?? '';
                                    $line2 = $t->designation ?? $t->role ?? $t->company ?? '';
                                    $msg = $t->message ?? $t->review ?? '';
                                @endphp

                                <div class="testimonial-slide-item w-full md:w-1/2 xl:w-1/3 shrink-0 px-3 pt-10 pb-3">
                                    <div
                                        class="relative h-full rounded-[12px] border border-gray-200 bg-white shadow-[0_10px_35px_rgba(15,23,42,0.06)] px-6 sm:px-8 pt-14 pb-8">

                                        <!-- Avatar -->
                                        <div
                                            class="absolute left-10 top-0 -translate-y-1/2 w-[72px] h-[72px] sm:w-20 sm:h-20 rounded-full bg-white shadow-lg ring-4 ring-white overflow-hidden">
                                            <img src="{{ $avatar }}" alt="{{ $name }}" class="w-full h-full object-cover">
                                        </div>

                                        <!-- Rating -->
                                        <div class="flex items-center gap-3">
                                            <div class="flex items-center gap-1">
                                                @for($i = 0; $i < 5; $i++)
                                                    <span
                                                        class="w-6 h-6 rounded-sm bg-[#14a44d] text-white flex items-center justify-center shadow-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    </span>
                                                @endfor
                                            </div>
                                            <span class="text-lg text-gray-500 font-medium">5.0</span>
                                        </div>

                                        <!-- Content -->
                                        <div class="mt-6">
                                            <h3 class="text-2xl font-bold text-[#111827] leading-tight">
                                                {{ $name }}
                                            </h3>

                                            @if($line1)
                                                <p class="mt-2 text-[15px] leading-7 text-gray-500">
                                                    {{ $line1 }}
                                                </p>
                                            @endif

                                            @if($line2)
                                                <p class="mt-2 text-[15px] leading-7 text-gray-500">
                                                    {{ $line2 }}
                                                </p>
                                            @endif

                                            <div class="mt-6">
                                                <p class="testimonial-text text-[15px] sm:text-[16px] leading-8 text-gray-600"
                                                    data-full-text="{{ e($msg) }}">
                                                    {{ \Illuminate\Support\Str::limit($msg, 220) }}
                                                </p>

                                                @if(strlen($msg) > 220)
                                                    <button type="button"
                                                        class="testimonial-read-more mt-5 inline-flex items-center gap-2 text-[#14a44d] font-semibold hover:opacity-80 transition">
                                                        See more
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path d="M9 18l6-6-6-6" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Mobile arrows -->
                    <div class="flex md:hidden items-center justify-center gap-3 mt-6">
                        <button id="testimonialPrevMobile"
                            class="w-11 h-11 rounded-full bg-white shadow border border-gray-100 flex items-center justify-center text-gray-500 hover:text-green-600 hover:bg-green-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M15 18l-6-6 6-6" />
                            </svg>
                        </button>

                        <button id="testimonialNextMobile"
                            class="w-11 h-11 rounded-full bg-white shadow border border-gray-100 flex items-center justify-center text-gray-500 hover:text-green-600 hover:bg-green-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 18l6-6-6-6" />
                            </svg>
                        </button>
                    </div>

                    <!-- Dots -->
                    <div id="testimonialDots" class="flex items-center justify-center gap-2 mt-8"></div>
                </div>

                <!-- Modal -->
                <div id="testimonialModal" class="fixed inset-0 z-[1000] hidden bg-black/50 p-4">
                    <div class="min-h-full flex items-center justify-center">
                        <div class="w-full max-w-2xl rounded-[28px] bg-white shadow-2xl overflow-hidden">
                            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                                <h3 class="text-xl font-bold text-[#111827]">Customer Review</h3>
                                <button id="testimonialModalClose"
                                    class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18" />
                                        <line x1="6" y1="6" x2="18" y2="18" />
                                    </svg>
                                </button>
                            </div>

                            <div class="p-6 sm:p-8">
                                <p id="testimonialModalText" class="text-[16px] leading-8 text-gray-600"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .testimonial-slide-item {
                        transition: opacity .3s ease;
                    }

                    .testimonial-dot {
                        width: 10px;
                        height: 10px;
                        border-radius: 999px;
                        background: rgba(17, 24, 39, .18);
                        transition: all .25s ease;
                    }

                    .testimonial-dot.active {
                        width: 28px;
                        background: #16a34a;
                    }

                    @media (max-width: 767px) {
                        .testimonial-slide-item {
                            padding-left: 0.35rem;
                            padding-right: 0.35rem;
                        }
                    }
                </style>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const track = document.getElementById('testimonialTrack');
                        if (!track) return;

                        const slides = Array.from(track.children);
                        const prev = document.getElementById('testimonialPrev');
                        const next = document.getElementById('testimonialNext');
                        const prevMobile = document.getElementById('testimonialPrevMobile');
                        const nextMobile = document.getElementById('testimonialNextMobile');
                        const dotsWrap = document.getElementById('testimonialDots');

                        const modal = document.getElementById('testimonialModal');
                        const modalText = document.getElementById('testimonialModalText');
                        const modalClose = document.getElementById('testimonialModalClose');

                        let currentIndex = 0;
                        let slidesPerView = getSlidesPerView();
                        let maxIndex = Math.max(0, slides.length - slidesPerView);
                        let autoSlide;

                        function getSlidesPerView() {
                            if (window.innerWidth >= 1280) return 3;
                            if (window.innerWidth >= 768) return 2;
                            return 1;
                        }

                        function updateMetrics() {
                            slidesPerView = getSlidesPerView();
                            maxIndex = Math.max(0, slides.length - slidesPerView);

                            if (currentIndex > maxIndex) {
                                currentIndex = maxIndex;
                            }

                            render();
                        }

                        function renderDots() {
                            const totalPages = maxIndex + 1;
                            dotsWrap.innerHTML = '';

                            if (totalPages <= 1) return;

                            for (let i = 0; i < totalPages; i++) {
                                const btn = document.createElement('button');
                                btn.className = 'testimonial-dot' + (i === currentIndex ? ' active' : '');
                                btn.addEventListener('click', function () {
                                    currentIndex = i;
                                    render();
                                    restartAuto();
                                });
                                dotsWrap.appendChild(btn);
                            }
                        }

                        function render() {
                            const percentage = 100 / slidesPerView;
                            track.style.transform = `translateX(-${currentIndex * percentage}%)`;
                            renderDots();
                        }

                        function goNext() {
                            if (currentIndex >= maxIndex) {
                                currentIndex = 0;
                            } else {
                                currentIndex++;
                            }
                            render();
                        }

                        function goPrev() {
                            if (currentIndex <= 0) {
                                currentIndex = maxIndex;
                            } else {
                                currentIndex--;
                            }
                            render();
                        }

                        function startAuto() {
                            if (slides.length <= slidesPerView) return;
                            autoSlide = setInterval(goNext, 4500);
                        }

                        function restartAuto() {
                            clearInterval(autoSlide);
                            startAuto();
                        }

                        prev?.addEventListener('click', function () {
                            goPrev();
                            restartAuto();
                        });

                        next?.addEventListener('click', function () {
                            goNext();
                            restartAuto();
                        });

                        prevMobile?.addEventListener('click', function () {
                            goPrev();
                            restartAuto();
                        });

                        nextMobile?.addEventListener('click', function () {
                            goNext();
                            restartAuto();
                        });

                        let startX = 0;
                        let endX = 0;

                        track.addEventListener('touchstart', function (e) {
                            startX = e.changedTouches[0].clientX;
                        }, { passive: true });

                        track.addEventListener('touchend', function (e) {
                            endX = e.changedTouches[0].clientX;
                            const diff = startX - endX;

                            if (Math.abs(diff) > 50) {
                                if (diff > 0) {
                                    goNext();
                                } else {
                                    goPrev();
                                }
                                restartAuto();
                            }
                        }, { passive: true });

                        document.querySelectorAll('.testimonial-read-more').forEach(btn => {
                            btn.addEventListener('click', function () {
                                const text = this.closest('.mt-6')?.querySelector('.testimonial-text')?.dataset.fullText || '';
                                modalText.textContent = text;
                                modal.classList.remove('hidden');
                                document.body.classList.add('overflow-hidden');
                            });
                        });

                        function closeModal() {
                            modal.classList.add('hidden');
                            document.body.classList.remove('overflow-hidden');
                        }

                        modalClose?.addEventListener('click', closeModal);
                        modal?.addEventListener('click', function (e) {
                            if (e.target === modal) closeModal();
                        });

                        document.addEventListener('keydown', function (e) {
                            if (e.key === 'Escape') closeModal();
                        });

                        window.addEventListener('resize', updateMetrics);

                        updateMetrics();
                        startAuto();
                    });
                </script>
            @else
                <div class="text-center text-gray-600 py-10">
                    No testimonials found. Add testimonials from Admin → Landing Builder → Testimonials.
                </div>
            @endif
        </div>
    </section>

@endsection