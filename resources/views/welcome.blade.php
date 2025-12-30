<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Keshoriya Organic Hair Oil | Pure Natural Herbal Oil in Bangladesh</title>

    <meta name="description"
        content="Keshoriya is a premium organic hair oil brand in Bangladesh. Made with natural herbal ingredients for strong, healthy, and shiny hair. Order online with cash on delivery.">

    <meta name="robots" content="index, follow">

    <!-- Open Graph -->
    <meta property="og:title" content="Keshoriya Organic Hair Oil">
    <meta property="og:description"
        content="Natural herbal hair oil for strong, healthy hair. Cash on delivery available in Bangladesh.">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('img/logo.jpg') }}">
    <meta property="og:type" content="website">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="canonical" href="{{ url('/') }}">
    <link rel="icon" type="image/png" href="{{ asset('/img/logo/logo.jpg') }}">
    <script src="https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js"></script>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- VITE (THIS IS REQUIRED) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<style>
        body {
            font-family: 'Inter', sans-serif;
            background: #e6efd3;

        }

        h1,
        h2,
        h3 {
            font-family: 'Playfair Display', serif;
        }

        .w-32 {
            width: 26rem !important;
        }

        .top-32 {
            top: 1rem !important;
        }

        .left-1\/2 {
            left: 7% !important;
        }
    </style>
<body>
    <header class=" ">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">

            <div class="flex items-center gap-2">
                <img src="{{ asset('/img/logo/logo.jpg') }}" alt="Keshoriya Organic Hair Oil Logo" class="h-20">
            </div>

            <nav class="hidden md:flex items-center gap-10 text-sm font-medium text-[#1f2d1f]">
                <a href="#Company" onclick="trackEvent('nav_click', {section:'Company'})" class="hover:text-green-700 transition">Company</a>
                <a href="#Product" onclick="trackEvent('nav_click', {section:'Product'})" class="hover:text-green-700 transition">Product</a>
                <a href="#ingredients" onclick="trackEvent('nav_click', {section:'ingredients'})" class="hover:text-green-700 transition">Ingredients</a>
                <a href="#order" onclick="trackEvent('nav_click', {section:'order'})" class="hover:text-green-700 transition">Order</a>
            </nav>

            <div class="flex items-center gap-4 text-[#1f2d1f]">
                <button class="w-9 h-9 rounded-full flex items-center justify-center hover:bg-white/60 transition">
                    🔍
                </button>
                <button id="menuBtn"
                    class="w-9 h-9 rounded-full flex items-center justify-center hover:bg-white/60 transition md:hidden">
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


    <section id="Company" class="relative overflow-hidden">



        <!-- Soft background blur -->
        <div class="absolute -top-40 -right-40 w-[500px] h-[500px] rounded-full blur-3xl"></div>

        <div class="relative max-w-7xl mx-auto px-6 pt-24 pb-28
               grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

            <!-- IMAGE COLUMN (first on mobile, second on desktop) -->
            <div class="relative flex justify-center lg:justify-end order-1 lg:order-2">

                <div class="absolute bottom-6 w-[320px] h-[80px] bg-white/40 blur-xl rounded-full"></div>

                <img src="{{ asset('/img/assets/organic hair oil.png') }}" alt="Organic Hair Oil Bottle" class="relative w-[350px] sm:w-[420px] lg:w-[480px]
                        drop-shadow-[0_50px_100px_rgba(0,0,0,0.25)]
                        transition-transform duration-700 hover:scale-[1.03]">
            </div>

            <!-- TEXT COLUMN (second on mobile, first on desktop) -->
            <div class="text-center lg:text-left order-2 lg:order-1">

                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-bold text-[#1f2d1f] leading-tight"
                    style="font-family: 'Playfair Display', serif;">
                    Keshoriya Organic Hair Oil
                </h1>

                <p class="text-lg lg:text-xl text-[#f28c28] mt-4 font-medium">
                    Pure Natural Organic Oil
                </p>

                <p class="text-gray-600 mt-8 max-w-md mx-auto lg:mx-0 leading-relaxed">
                    Keshoriya is a premium organic hair oil brand in Bangladesh, made with natural herbal ingredients
                    to reduce hair fall, nourish roots, and promote healthy hair growth.
                </p>

                <h2 class="text-gray-900 mt-8 max-w-md mx-auto lg:mx-0 leading-relaxed">
                    We believe in the power of nature without compromise
                </h2>

                <div class="mt-12 flex flex-col sm:flex-row items-center
                        justify-center lg:justify-start gap-8">

                    <!-- ORDER BUTTON WITH DOWN ARROW -->
                    <a href="#Product" class="inline-flex items-center gap-3
                          bg-[#f28c28] hover:bg-[#e47c14]
                          text-white px-10 py-4 rounded-full shadow-xl
                          transition-all duration-300 hover:scale-[1.03]">

                        Order now

                        <svg class="w-4 h-4 animate-bounce" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </a>

                    <!-- Rating -->
                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <span class="text-yellow-500 text-base tracking-wide">
                            ★ ★ ★ ★ ★
                        </span>
                        <span>4.9 (220 Ratings)</span>
                    </div>
                </div>

            </div>

        </div>
        <!-- Floating leaf decoration -->
        <img src="{{ asset('/img/assets/leef.png') }}" alt="Leaf Decoration" class="absolute top-32 left-1/2 -translate-x-1/2
            w-32 opacity-60 pointer-events-none">
    </section>

    <button id="cartBtn" onclick="toggleCart()" class="fixed bottom-6 right-6 z-50 bg-[#1f2d1f] text-white
         px-5 py-3 rounded-full shadow-xl flex items-center gap-2">
        🛒 <span id="cartCount">0</span>
    </button>
    <section>
        <!-- CART PANEL -->
        <div id="cartPanel" class="fixed inset-y-0 right-0 w-full sm:w-[420px]
         bg-white shadow-2xl z-50 transform translate-x-full
         transition-transform duration-300 flex flex-col">

            <!-- Header -->
            <div class="p-5 border-b flex justify-between items-center">
                <h3 class="text-lg font-bold">Your Cart</h3>
                <button onclick="toggleCart()">✕</button>
            </div>

            <!-- Items -->
            <div id="cartItems" class="flex-1 p-5 space-y-4 overflow-y-auto"></div>

            <!-- Footer -->
            <div class="p-5 border-t">
                <div class="space-y-2 mb-4 text-sm">

                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span><span id="cartSubTotal">0</span>৳</span>
                    </div>

                    <div class="flex justify-between text-gray-600">
                        <span>Delivery Charge</span>
                        <span>60৳</span>
                    </div>

                    <div class="border-t pt-2 flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span><span id="cartTotal">0</span>৳</span>
                    </div>

                </div>


                <button onclick="goToCheckout()" class="w-full bg-[#1f2d1f] text-white py-3 rounded-full">
                    Checkout
                </button>
            </div>
        </div>
    </section>

    <!-- ================= SOURCE SECTION ================= -->
    <section class="max-w-7xl mx-auto px-6 py-20 grid lg:grid-cols-2 gap-16 items-center">
        <div>
            <img src="{{ asset('/img/assets/organnic oil.png') }}" alt="Keshoriya Organic Hair Oil Logo"
                class="w-full max-w-md mx-auto">
        </div>
        <div>
            <h2 class="text-4xl font-bold text-green-900">
                We Source Organically Grown Hemp From Family Owned Farms
            </h2>
        </div>


    </section>
    <section id="Product" class="max-w-7xl mx-auto px-6 py-20">

        <div class="relative bg-[#f3f7e8] rounded-[36px] px-8 md:px-14 py-12
                flex flex-col lg:flex-row items-center gap-14">

            <!-- DISCOUNT BADGE -->
            <div class="absolute -top-6 left-8 bg-[#7db343] text-white
                    px-6 py-3 rounded-full shadow-lg">
                <p class="text-lg font-bold">15% OFF</p>
            </div>

            <!-- PRODUCT 1 : 200 ML -->
            <div class="flex items-center gap-8 flex-1">

                <!-- IMAGE -->
                <div class="w-[150px] h-[150px] rounded-full bg-[#dfe8c8]
                        flex items-center justify-center shadow-inner">
                    <img src="{{ asset('/img/assets/pro-1.png') }}" class="h-[120px] object-contain" alt="Keshoriya Organic Hair Oil 200 ml">
                </div>

                <!-- DETAILS -->
                <div>
                    <h3 class="text-2xl font-bold text-[#1f2d1f]">
                        Keshoriya Organic Hair Oil
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">200 ml</p>

                    <!-- PRICE -->
                    <div class="mt-3 flex items-center gap-3">
                        <span class="text-lg text-gray-400 line-through">
                            ৳750
                        </span>
                        <span class="text-4xl font-extrabold text-[#1f2d1f]">
                            ৳625
                        </span>
                    </div>

                    <button onclick="addToCart('Keshoriya Organic hair oil -200 ml', 625)" class="mt-4 text-sm bg-[#1f2d1f] text-white
                           px-5 py-2 rounded-full
                           hover:bg-[#162016] transition">
                        Add to Cart
                    </button>
                </div>
            </div>

            <!-- PRODUCT 2 : 400 ML -->
            <div class="flex items-center gap-8 flex-1">

                <!-- IMAGE -->
                <div class="w-[150px] h-[150px] rounded-full bg-[#dfe8c8]
                        flex items-center justify-center shadow-inner">
                    <img src="{{ asset('/img/assets/pro-2.png') }}" class="h-[120px] object-contain" alt="Keshoriya Organic Hair Oil 400 ml">
                </div>

                <!-- DETAILS -->
                <div>
                    <h3 class="text-2xl font-bold text-[#1f2d1f]">
                        Keshoriya Organic Hair Oil
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">400 ml</p>

                    <!-- PRICE -->
                    <div class="mt-3 flex items-center gap-3">
                        <span class="text-lg text-gray-400 line-through">
                            ৳1430
                        </span>
                        <span class="text-4xl font-extrabold text-[#1f2d1f]">
                            ৳1200
                        </span>
                    </div>

                    <button onclick="addToCart('Keshoriya Organic hair oil -400 ml', 1200)" class="mt-4 text-sm bg-[#1f2d1f] text-white
                           px-5 py-2 rounded-full
                           hover:bg-[#162016] transition">
                        Add to Cart
                    </button>
                </div>
            </div>

        </div>
    </section>


    <!-- ================= ingredients================= -->
    <section id="ingredients" class="bg-[#e6efd3] py-20 relative">

        <h2 class="text-4xl font-bold text-center text-[#1f2d1f] mb-14">
            Ingredients
        </h2>

        <div class="max-w-7xl mx-auto px-6">

            <!-- GRID -->
            <div class="grid grid-cols-2 md:grid-cols-7 gap-10">

                <!-- CARD 1 -->
                <div class="card">
                    <img src="{{ asset('/img/assets/Shikakai.png') }}" alt="Shikakai">
                    <p class="text-md font-medium text-[#1f2d1f]">Shikakai</p>
                </div>

                <!-- CARD 2 -->
                <div class="card">
                    <img src="{{ asset('/img/assets/Coconut.png') }}" alt="Coconut">
                    <p class="text-lg font-medium text-[#1f2d1f]">Coconut</p>
                </div>

                <!-- CARD 3 -->
                <div class="card">
                    <img src="{{ asset('/img/assets/Aloe vera.png') }}" alt="Aloe Vera">
                    <p class="text-lg font-medium text-[#1f2d1f]">Aloe vera</p>
                </div>

                <!-- CARD 4 -->
                <div class="card">
                    <img src="{{ asset('/img/assets/Onion.png') }}" alt="Onion">
                    <p class="text-lg font-medium text-[#1f2d1f]">Onion</p>
                </div>

                <!-- CARD 5 -->
                <div class="card">
                    <img src="{{ asset('/img/assets/Methi.png') }}" alt="Methi">
                    <p class="text-lg font-medium text-[#1f2d1f]">Methi</p>
                </div>

                <!-- CARD 6 -->
                <div class="card">
                    <img src="{{ asset('/img/assets/Almond.png') }}" alt="Almond">
                    <p class="text-lg font-medium text-[#1f2d1f]">Almond</p>
                </div>

                <!-- CARD 7 (27 more ingredients) -->
                <div class="card col-span-2 md:col-span-1 flex flex-col items-center justify-center">
                    <img src="{{ asset('/img/assets/27moreingredients.jpeg') }}" alt="+ 27 more ingredients">
                    <p class="text-lg font-medium text-[#1f2d1f] text-center">
                        + 27 more ingredients
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================= TESTIMONIAL ================= -->
    <section class="max-w-3xl mx-auto px-6 py-16 text-center relative overflow-hidden">

        <h2 class="text-3xl font-bold mb-12">What Our Customers Are Saying</h2>

        <!-- SLIDER -->
        <div id="testimonialSlider" class="relative">

            <!-- SLIDE 1 -->
            <div class="testimonial-slide active">

                <!-- Reviewer Image -->
                <div class="flex justify-center mb-6">
                    <img src="{{ asset('/img/review/suraiya.png') }}" alt="Suraiya Akter" class="w-16 h-16 rounded-full object-cover
                            border-4 border-white shadow-lg">
                </div>

                <p class="text-gray-600 italic text-lg leading-relaxed">
                    “Telta use kore brsh vlo legeche,amr ammuo telta khub pochondo korteche tnq kesoriya😊”
                </p>
                <p class="mt-4 font-semibold">— Suraiya Akter</p>
            </div>

            <!-- SLIDE 2 -->
            <div class="testimonial-slide">

                <div class="flex justify-center mb-6">
                    <img src="{{ asset('/img/review/Nowrin.png') }}" alt="Shamima Ahmed" class="w-16 h-16 rounded-full object-cover
                            border-4 border-white shadow-lg">
                </div>

                <p class="text-gray-600 italic text-lg leading-relaxed">
                    “Oil Ta Mashaallah onek valo use korar Koekdin er moddhe e result peyechi❤️”
                </p>
                <p class="mt-4 font-semibold">— Nowrin Akter</p>
            </div>

            <!-- SLIDE 3 -->
            <div class="testimonial-slide">

                <div class="flex justify-center mb-6">
                    <img src="{{ asset('/img/review/shormila.png') }}" alt="Sormila Chowdhury" class="w-16 h-16 rounded-full object-cover
                            border-4 border-white shadow-lg">
                </div>

                <p class="text-gray-600 italic text-lg leading-relaxed">
                    “েল নিয়েছিলাম। অনেক ভালো কাজ করতেছে। নতুন চুল গজাচ্ছে, Thanks কেশরীয়া 🥰”
                </p>
                <p class="mt-4 font-semibold">— Sormila Chowdhury</p>
            </div>

            <!-- SLIDE 4 -->
            <div class="testimonial-slide">

                <div class="flex justify-center mb-6">
                    <img src="{{ asset('/img/review/nushrat.png') }}" alt="Nusrat Jahan" class="w-16 h-16 rounded-full object-cover
                            border-4 border-white shadow-lg">
                </div>

                <p class="text-gray-600 italic text-lg leading-relaxed">
                    “অয়েলটা খুব ভালো,উপকার পেয়েছি,সবাই ইউস করতে পারেন”
                </p>
                <p class="mt-4 font-semibold">— Nusrat Jahan</p>
            </div>

            <!-- SLIDE 5 -->
            <div class="testimonial-slide">

                <div class="flex justify-center mb-6">
                    <img src="{{ asset('/img/review/Ariba.png') }}" alt="Farzana Islam" class="w-16 h-16 rounded-full object-cover
                            border-4 border-white shadow-lg">
                </div>

                <p class="text-gray-600 italic text-lg leading-relaxed">
                    “Oil ta onk vlo.2nd time abar purchase korbo 🥰. Highly recommended”
                </p>
                <p class="mt-4 font-semibold">— Ariba Mukta</p>
            </div>
            <!-- SLIDE 6 -->
            <!-- <div class="testimonial-slide">

                <div class="flex justify-center mb-6">
                    <img src="img/review/image copy 4.png" alt="Farzana Islam" class="w-16 h-16 rounded-full object-cover
                            border-4 border-white shadow-lg">
                </div>

                <p class="text-gray-600 italic text-lg leading-relaxed">
                    “Oil ta onk vlo.2nd time abar purchase korbo 🥰. Highly recommended”
                </p>
                <p class="mt-4 font-semibold">— Ariba Mukta</p>
            </div> -->

        </div>

        <!-- DOTS -->
        <div class="flex justify-center gap-2 mt-8">
            <button class="dot active" onclick="goToSlide(0)"></button>
            <button class="dot" onclick="goToSlide(1)"></button>
            <button class="dot" onclick="goToSlide(2)"></button>
            <button class="dot" onclick="goToSlide(3)"></button>
            <button class="dot" onclick="goToSlide(4)"></button>
        </div>

    </section>





    <!-- ================= ORDER FORM (PREMIUM THEME) ================= -->
    <section id="order" class="relative max-w-6xl mx-auto px-6 py-20">

        <!-- soft background -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#e6efd3] via-[#e6efd3] to-[#e6efd3] rounded-[40px]"></div>

        <div class="relative bg-white/70 backdrop-blur-xl shadow-[0_40px_100px_rgba(0,0,0,0.12)]
               rounded-[32px] p-10 md:p-14">

            <!-- Title -->
            <h2 class="text-3xl md:text-4xl font-bold text-[#1f2d1f] mb-12 text-center"
                style="font-family:'Playfair Display',serif;">
                অর্ডার করুন
            </h2>

            <form id="orderForm" class="grid grid-cols-1 md:grid-cols-2 gap-12">

                <!-- CUSTOMER INFO -->
                <div class="space-y-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            আপনার নাম *
                        </label>
                        <input id="name" class="w-full px-5 py-4 rounded-xl border border-white/60
                               bg-white/80 focus:ring-2 focus:ring-green-600 focus:outline-none"
                            placeholder="পূর্ণ নাম লিখুন">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            সম্পূর্ণ ঠিকানা *
                        </label>
                        <input id="address" class="w-full px-5 py-4 rounded-xl border border-white/60
                               bg-white/80 focus:ring-2 focus:ring-green-600 focus:outline-none"
                            placeholder="গ্রাম / এলাকা / জেলা">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            ফোন নম্বর *
                        </label>
                        <input id="phone" class="w-full px-5 py-4 rounded-xl border border-white/60
                               bg-white/80 focus:ring-2 focus:ring-green-600 focus:outline-none"
                            placeholder="01XXXXXXXXX">
                    </div>

                    <!-- Payment -->
                    <div class="flex items-center gap-4 mt-8 bg-green-100/70 px-6 py-4 rounded-2xl">
                        <i class="fas fa-money-bill-wave text-2xl text-green-700"></i>
                        <div>
                            <p class="font-semibold text-green-800">
                                Cash on Delivery
                            </p>
                            <p class="text-sm text-green-700">
                                পণ্য হাতে পেয়ে টাকা পরিশোধ করুন
                            </p>
                            <p class="text-green-800 font-semibold text-sm md:text-base mt-1">
                                🚚 সারা বাংলাদেশে ডেলিভারি চার্জ মাত্র ৬০ টাকা
                            </p>
                        </div>
                    </div>
                </div>


                <!-- ORDER SUMMARY -->
                <div class="bg-white rounded-3xl shadow-lg p-8 flex flex-col justify-between">

                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold text-[#1f2d1f]">Order Summary</h3>

                        <div id="orderItems" class="space-y-3"></div>

                        <!-- Subtotal -->
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Subtotal</span>
                            <span><span id="subTotalDisplay">0</span>৳</span>
                        </div>

                        <!-- Delivery -->
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Delivery Charge</span>
                            <span>60৳</span>
                        </div>

                        <!-- Total -->
                        <div class="border-t pt-4 flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span class="text-green-800">
                                <span id="totalDisplay">0</span>৳
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="mt-8 bg-[#1f2d1f] hover:bg-[#162016]
           text-white py-4 rounded-full text-lg
           shadow-xl transition-all duration-300
           hover:scale-[1.02]">
                        Place Order
                    </button>

                    <p id="statusMsg" class="text-center text-green-700 font-semibold mt-6 hidden"></p>
                </div>


            </form>
        </div>
    </section>
    <!-- ================= NEWSLETTER (PIXEL MATCH) ================= -->
    <section class="bg-[#e6efd3] py-20">
        <div class="max-w-6xl mx-auto px-6">

            <div
                class="relative bg-[#e7d4b1] rounded-[32px] px-10 py-12 flex flex-col md:flex-row items-center gap-10 overflow-hidden">

                <!-- LEFT IMAGE -->
                <div class="relative md:w-[38%] flex justify-center md:justify-start">
                    <img src="{{ asset('/img/assets/pro-2 (1).png') }}"
                        class="w-[220px] md:w-[260px] -mt-10 md:-mt-16 select-none pointer-events-none" alt="Olives">
                </div>

                <!-- CONTENT -->
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-3xl md:text-4xl font-bold text-[#1f2d1f] mb-6"
                        style="font-family: 'Playfair Display', serif;">
                        Subscribe To Our<br class="hidden md:block"> Newsletter
                    </h3>

                    <div
                        class="flex items-center bg-white rounded-full shadow-md max-w-md mx-auto md:mx-0 overflow-hidden">
                        <input type="email" placeholder="Type your email" class="flex-1 px-6 py-4 outline-none text-sm">

                        <button
                            class="bg-[#3b7a57] text-white px-8 py-3 rounded-full mr-2 text-sm font-medium hover:bg-[#2f6146] transition">
                            Subscribe
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <style>
        .testimonial-slide {
            display: none;
            animation: fadeIn 0.6s ease;
        }

        .testimonial-slide.active {
            display: block;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 9999px;
            background: #cbd5c0;
            transition: all 0.3s ease;
        }

        .dot.active {
            background: #1f2d1f;
            transform: scale(1.2);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
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
    fetch('/track', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            visitor_id: getVisitorId(),
            event,
            page: window.location.pathname,
            data
        })
    });
}
</script>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.testimonial-slide');
        const dots = document.querySelectorAll('.dot');

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));

            slides[index].classList.add('active');
            dots[index].classList.add('active');

            currentSlide = index;
        }

        function goToSlide(index) {
            showSlide(index);
        }

        // Auto slide every 4 seconds
        setInterval(() => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }, 4000);
    </script>


    <!-- ================= FOOTER (PIXEL STYLE MATCH) ================= -->
    <footer class="relative  ">

        <!-- CURVED FOOTER BODY -->
        <div class="relative bg-[#163d2a] rounded-tr-[180px] px-10 py-16 overflow-hidden">

            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-10 text-white">

                <!-- BRAND -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <img src="{{ asset('/img/logo/logo (1).jpg') }}" alt="OrganicOil Logo" class="h-16 img-footer">
                        <!-- <span class="text-lg font-semibold">keshoriya</span> -->
                    </div>

                    <p class="text-sm text-gray-300 leading-relaxed max-w-xs">
                        Crafted with 100% organic, ethically sourced ingredients. We believe in the power of nature
                        without compromise.
                    </p>

                    <!-- SOCIAL -->
                    <div class="flex gap-3 mt-5">

                        <!-- Facebook -->
                        <a href="https://www.facebook.com/share/1JpRumJeJx/" target="_blank" class="w-9 h-9 rounded-full bg-white text-[#163d2a]
            flex items-center justify-center
            hover:bg-gray-100 transition">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M22.675 0h-21.35C.597 0 0 .597 0 1.326v21.348C0 23.403.597 24 1.326 24h11.495v-9.294H9.691V11.01h3.13V8.41c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24h-1.918c-1.505 0-1.797.716-1.797 1.765v2.314h3.587l-.467 3.696h-3.12V24h6.116C23.403 24 24 23.403 24 22.674V1.326C24 .597 23.403 0 22.675 0z" />
                            </svg>
                        </a>


                        <!-- Instagram -->
                        <a href="https://www.instagram.com/keshoriya_?igsh=bTUwNHYzN3V3cjJ1" target="_blank" class="w-9 h-9 rounded-full bg-white text-[#163d2a]
            flex items-center justify-center
            hover:bg-gray-100 transition">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 2.163c3.204 0 3.584.012 4.85.07 1.366.062 2.633.332 3.608 1.308.975.975 1.245 2.242 1.308 3.608.058 1.266.07 1.646.07 4.85s-.012 3.584-.07 4.85c-.063 1.366-.333 2.633-1.308 3.608-.975.975-2.242 1.245-3.608 1.308-1.266.058-1.646.07-4.85.07s-3.584-.012-4.85-.07c-1.366-.063-2.633-.333-3.608-1.308-.975-.975-1.245-2.242-1.308-3.608C2.175 15.584 2.163 15.204 2.163 12s.012-3.584.07-4.85c.063-1.366.333-2.633 1.308-3.608.975-.975 2.242-1.245 3.608-1.308C8.416 2.175 8.796 2.163 12 2.163zm0 3.675a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zm6.406-.845a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z" />
                            </svg>
                        </a>

                    </div>

                </div>

                <!-- QUICK LINKS -->
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li>
                            <a href="#Company" class="hover:text-white transition">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#Product" class="hover:text-white transition">
                                Product
                            </a>
                        </li>
                        <li>
                            <a href="#ingredients" class="hover:text-white transition">
                                Ingredients
                            </a>
                        </li>
                        <li>
                            <a href="#order" class="hover:text-white transition">
                                Order
                            </a>
                        </li>
                    </ul>

                </div>

                <!-- PRODUCTS -->
                <div>
                    <h4 class="font-semibold mb-4">Products</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li>Keshoriya Organic hair oil 200 ml</li>
                        <li>Keshoriya Organic hair oil 400 ml</li>

                    </ul>
                </div>

                <!-- CONTACT -->
                <div>
                    <h4 class="font-semibold mb-4">Quick Contact</h4>
                    <p class="text-sm text-gray-300 mb-2">
                        If you have questions, please<br>
                        use our 24 hours helpline.
                    </p>
                    <p class="text-sm text-gray-300">+880 1967-014624</p>
                    <p class="text-sm text-gray-300 mt-1">keshoriyahairoil@gmail.com</p>
                </div>
            </div>

            <!-- OIL IMAGE -->
            <img src="{{ asset('/img/assets/footer.jpg') }}"
                class="absolute right-0 bottom-0 h-[260px] pointer-events-none select-none" alt="Oil Pour">
        </div>


        <!-- COPYRIGHT BAR -->
        <div class="bg-[#0f2b1e] py-4">
            <p class="text-center text-sm text-gray-300">
                © <span id="year"></span> All rights reserved. Developed by
                <a href="https://nexolioit.com" target="_blank" class="text-white font-medium hover:underline">
                    NexolioIT
                </a>
            </p>
        </div>

    </footer>

    <script>
let scrollTracked = {25:false,50:false,75:false,100:false};

window.addEventListener('scroll', () => {
    const scrollPercent =
        Math.round((window.scrollY + window.innerHeight) / document.body.scrollHeight * 100);

    [25,50,75,100].forEach(p => {
        if (scrollPercent >= p && !scrollTracked[p]) {
            scrollTracked[p] = true;
            trackEvent('scroll_depth', { percent: p });
        }
    });
});
</script>

    {{-- <script>
            function trackEvent(event, data = {}) {
                fetch('/track', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document
                            .querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        visitor_id: getVisitorId(),
                        event: event,
                        page: window.location.pathname,
                        data: data
                    })
                });
            }
    </script> --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    trackEvent('page_view', {
        title: document.title,
        url: window.location.href
    });
});
</script>

<script>
document.addEventListener('mouseleave', e => {
    if (e.clientY < 0) {
        trackEvent('exit_intent');
    }
});
</script>

<script>
/* ================= MOBILE MENU ================= */
const menuBtn = document.getElementById('menuBtn');
const mobileMenu = document.getElementById('mobileMenu');

if (menuBtn) {
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
}

document.getElementById('year').innerText = new Date().getFullYear();

/* ================= CART STATE ================= */
let cart = [];
const DELIVERY_CHARGE = 60;

/* ================= CART FUNCTIONS ================= */
function addToCart(name, price) {
    const existing = cart.find(i => i.name === name);

    if (existing) {
        existing.qty++;
    } else {
        cart.push({ name, price, qty: 1 });
    }
    trackEvent('add_to_cart', {
    product: name,
    price: price
     
    });

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

    trackEvent('remove_from_cart', {
        product: removed.name
    });

    renderCart();
}


function renderCart() {
    const items = document.getElementById('cartItems');
    const count = document.getElementById('cartCount');
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
                <p class="text-sm text-gray-500">৳${item.price}</p>
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
    totalEl.innerText = subTotal + DELIVERY_CHARGE;
}

/* ================= CART PANEL ================= */
function toggleCart() {
    document.getElementById('cartPanel').classList.toggle('translate-x-full');
}
function openCart() {
    document.getElementById('cartPanel').classList.remove('translate-x-full');
    trackEvent('cart_open', {
    total_items: cart.length
});
}

/* ================= ORDER SUMMARY ================= */
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
                <p>${itemTotal}৳</p>
            </div>
            <p class="text-sm text-gray-500">${item.price}৳ × ${item.qty}</p>
        </div>`;
    });

    subTotalDisplay.innerText = subTotal;
    totalDisplay.innerText = subTotal + DELIVERY_CHARGE;
}

function goToCheckout() {
    toggleCart();
    document.getElementById('orderForm').scrollIntoView({ behavior: 'smooth' });
    renderOrderSummary();
    trackEvent('checkout_start', {
    items: cart.length
});

}

/* ================= EMAILJS INIT ================= */
emailjs.init("ou_43JNABOUuzliYG");

/* ================= ORDER SUBMIT ================= */
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

    /* ===== SAVE ORDER TO LARAVEL DATABASE ===== */
    fetch("/order", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content")
        },
        body: JSON.stringify({
            name,
            phone,
            address,
            cart
        })
    })
    .then(res => res.json())
 .then(data => {
    if (!data.success) {
        throw new Error();
    }

    trackEvent('purchase', {
        order_id: data.order_id,
        total: data.total,
        items: cart.length
    });

        /* ===== SEND EMAIL AFTER DB SAVE ===== */
        emailjs.send(
            "service_ec4doxc",
            "template_suv0b2m",
            {
                customer_name: name,
                customer_phone: phone,
                customer_address: address,
                products: cart.map(i => `${i.name} × ${i.qty}`).join(", "),
                total_price: data.total ?? ""
            }
        );

        statusMsg.innerText =
            "✅ আপনার অর্ডার সফলভাবে গ্রহণ করা হয়েছে। খুব শীঘ্রই আমরা যোগাযোগ করবো।";

        cart = [];
        renderCart();
        renderOrderSummary();
        document.getElementById("orderForm").reset();
    })
    .catch(() => {
        statusMsg.innerText =
            "❌ দুঃখিত! অর্ডার পাঠাতে সমস্যা হয়েছে। আবার চেষ্টা করুন।";
    });
});
</script>
<script>
let pageStart = Date.now();
let sent = false;

function sendTimeOnPage() {
    if (sent) return;
    sent = true;

    const seconds = Math.round((Date.now() - pageStart) / 1000);
    trackEvent('time_on_page', { seconds });
}

window.addEventListener('beforeunload', sendTimeOnPage);
document.addEventListener('visibilitychange', () => {
    if (document.visibilityState === 'hidden') {
        sendTimeOnPage();
    }
});>

<script>
let formStarted = false;

['name','phone','address'].forEach(id => {
    document.getElementById(id)?.addEventListener('focus', () => {
        if (!formStarted) {
            formStarted = true;
            trackEvent('form_start');
        }
    });
});
</script>

    <style>
        @media (max-width: 768px) {
            .pb-28 {
                padding-bottom: .01rem;
            }

            .py-20 {
                padding-top: .5rem;
                padding-bottom: 1.5rem;
            }
        }





        .img-footer {
            filter: invert(1);
        }

        .card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(12px);
            border-radius: 24px;
            padding: 28px 20px;
            text-align: center;
            transition: all 0.35s ease;
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.4);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .card img {
            height: 170px;
            margin: 0 auto;
            object-fit: contain;
            transition: transform 0.35s ease;
        }

        .card:hover img {
            transform: scale(1.08);
        }

        .card p {
            margin-top: 22px;
            font-size: 16px;
            font-weight: 600;
            color: #1f2d1f;
        }
    </style>

</body>


</html>