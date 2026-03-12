@php
    $landingLogo = $settings['landing_logo'] ?? null;
    $landingLogoUrl = $landingLogo ? asset('storage/' . $landingLogo) : null;
    $currencySymbol = $settings['currency_symbol'] ?? '$';
@endphp

<style>
    .site-nav-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        font-size: 15px;
        font-weight: 500;
        color: #374151;
        transition: color .3s ease;
    }

    .site-nav-link:hover {
        color: #16a34a;
    }

    .site-nav-link::after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -7px;
        width: 0;
        height: 2px;
        background: #16a34a;
        transition: width .35s ease;
    }

    .site-nav-link:hover::after {
        width: 100%;
    }

    .cart-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .cart-scroll::-webkit-scrollbar-thumb {
        background: rgba(22, 163, 74, 0.22);
        border-radius: 999px;
    }

    .cart-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
</style>

<!-- Top toast -->
<div id="siteCartToast"
    class="fixed top-5 left-1/2 -translate-x-1/2 z-[1200] hidden rounded-2xl bg-[#111827] text-white px-5 py-3 shadow-2xl text-sm font-medium">
    Product added to cart
</div>

<header id="siteHeader"
    class="sticky top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-white/60 shadow-[0_8px_30px_rgba(15,23,42,0.05)] transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="h-20 flex items-center justify-between gap-4">

            <!-- Logo -->
            <a href="{{ route('landing') }}" class="shrink-0 flex items-center">
                @if($landingLogoUrl)
                    <img src="{{ $landingLogoUrl }}" alt="{{ config('app.name') }} Logo" id="siteLogo"
                        class="h-10 sm:h-12 md:h-14 w-auto transition-all duration-300" loading="lazy" decoding="async">
                @else
                    <span class="text-xl sm:text-2xl font-extrabold text-[#1f2d1f]">
                        {{ config('app.name') }}
                    </span>
                @endif
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-8">
                <a href="{{ route('landing') }}" class="site-nav-link">Home</a>
                <a href="{{ route('about') }}" class="site-nav-link">About Us</a>
                <a href="{{ route('products') }}" class="site-nav-link">Products</a>
                <a href="{{ route('blog') }}" class="site-nav-link">Blog</a>
                <a href="{{ route('contact') }}" class="site-nav-link">Contact</a>
            </nav>

            <!-- Desktop Right Icons -->
            <div class="hidden md:flex items-center gap-3">
                <button type="button"
                    class="w-11 h-11 rounded-full flex items-center justify-center bg-white shadow-sm border border-gray-100 hover:bg-gray-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-gray-700">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </button>

                <!-- Desktop Cart -->
                <div id="desktopCartWrap" class="relative">
                    <button id="desktopCartButton" type="button"
                        class="w-11 h-11 rounded-full flex items-center justify-center bg-white shadow-sm border border-gray-100 hover:bg-gray-50 transition relative">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="w-5 h-5 text-gray-700">
                            <circle cx="9" cy="21" r="1" />
                            <circle cx="16" cy="21" r="1" />
                            <path d="M1 1h4l1 7h11l1-7h4" />
                        </svg>

                        <span id="desktopCartCount"
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] min-w-[18px] h-[18px] px-1 rounded-full flex items-center justify-center">
                            0
                        </span>
                    </button>

                    <!-- hover bridge -->
                    <div id="desktopCartBridge" class="absolute right-0 top-full h-4 w-[390px] hidden"></div>

                    <!-- Desktop cart dropdown -->
                    <div id="desktopCartPanel"
                        class="hidden absolute right-0 top-[calc(100%+12px)] w-[390px] rounded-[28px] border border-gray-100 bg-white shadow-[0_25px_80px_rgba(15,23,42,0.14)] overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 bg-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-bold text-[#111827]">Your Cart</h3>
                                    <p class="text-sm text-gray-500">Review added products</p>
                                </div>
                                <span id="desktopCartItemsCountText"
                                    class="text-xs font-semibold text-green-700 bg-green-50 px-3 py-1 rounded-full">
                                    0 items
                                </span>
                            </div>
                        </div>

                        <div id="desktopCartItems"
                            class="cart-scroll max-h-[340px] overflow-y-auto px-4 py-4 space-y-3"></div>

                        <div class="border-t border-gray-100 px-5 py-4 bg-[#fbfdfb]">
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <span>Subtotal</span>
                                <span id="desktopCartSubtotal"
                                    class="text-lg font-bold text-[#111827]">{{ $currencySymbol }}0.00</span>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-3">
                                <button type="button" id="desktopClearCart"
                                    class="rounded-full border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                                    Clear
                                </button>

                                <a href="{{ url('/checkout') }}"
                                    class="rounded-full bg-green-600 px-4 py-3 text-center text-sm font-semibold text-white hover:bg-green-700 transition">
                                    Checkout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Right Side -->
            <div class="md:hidden flex items-center gap-2">
                <button type="button"
                    class="w-9 h-9 rounded-full flex items-center justify-center bg-white border border-gray-100 shadow-sm hover:bg-gray-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-700">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                </button>

                <!-- Mobile cart button -->
                <button id="mobileCartButton" type="button"
                    class="w-9 h-9 rounded-full flex items-center justify-center bg-white border border-gray-100 shadow-sm hover:bg-gray-50 transition relative">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-gray-700">
                        <circle cx="9" cy="21" r="1" />
                        <circle cx="16" cy="21" r="1" />
                        <path d="M1 1h4l1 7h11l1-7h4" />
                    </svg>
                    <span id="mobileCartCount"
                        class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] min-w-[18px] h-[18px] px-1 rounded-full flex items-center justify-center">
                        0
                    </span>
                </button>

                <button id="siteMenuButton" type="button" aria-label="Open menu" aria-expanded="false"
                    class="w-11 h-11 rounded-full border-2 border-amber-500 flex items-center justify-center text-gray-700 hover:bg-amber-50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="7" x2="21" y2="7" />
                        <line x1="3" y1="12" x2="21" y2="12" />
                        <line x1="3" y1="17" x2="21" y2="17" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>

<!-- Mobile menu overlay -->
<div id="siteMenuOverlay"
    class="fixed inset-0 z-[998] bg-black/40 opacity-0 invisible transition-opacity duration-300 md:hidden"></div>

<!-- Mobile menu -->
<aside id="siteMobileMenu"
    class="fixed top-0 right-0 z-[999] h-screen w-[86%] max-w-[360px] bg-white shadow-2xl translate-x-full opacity-0 invisible transition-all duration-300 ease-out md:hidden overflow-y-auto">

    <div class="flex items-center justify-between px-5 py-5 border-b border-gray-100">
        <a href="{{ route('landing') }}" class="flex items-center">
            @if($landingLogoUrl)
                <img src="{{ $landingLogoUrl }}" alt="{{ config('app.name') }} Logo" class="h-10 w-auto" loading="lazy"
                    decoding="async">
            @else
                <span class="text-xl font-extrabold text-[#1f2d1f]">{{ config('app.name') }}</span>
            @endif
        </a>

        <button id="siteCloseMenuButton" type="button" aria-label="Close menu"
            class="w-12 h-12 rounded-full border-2 border-amber-500 flex items-center justify-center text-gray-600 hover:bg-amber-50 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
    </div>

    <nav class="px-6 py-6 space-y-3">
        <a href="{{ route('landing') }}"
            class="block rounded-xl px-4 py-3 text-[17px] font-medium text-gray-800 hover:bg-green-50 hover:text-green-600 transition">
            Home
        </a>
        <a href="{{ route('about') }}"
            class="block rounded-xl px-4 py-3 text-[17px] font-medium text-gray-800 hover:bg-green-50 hover:text-green-600 transition">
            About Us
        </a>
        <a href="{{ route('products') }}"
            class="block rounded-xl px-4 py-3 text-[17px] font-medium text-gray-800 hover:bg-green-50 hover:text-green-600 transition">
            Products
        </a>
        <a href="{{ route('blog') }}"
            class="block rounded-xl px-4 py-3 text-[17px] font-medium text-gray-800 hover:bg-green-50 hover:text-green-600 transition">
            Blog
        </a>
        <a href="{{ route('contact') }}"
            class="block rounded-xl px-4 py-3 text-[17px] font-medium text-gray-800 hover:bg-green-50 hover:text-green-600 transition">
            Contact
        </a>
    </nav>
</aside>

<!-- Mobile cart overlay -->
<div id="mobileCartOverlay"
    class="fixed inset-0 z-[1000] bg-black/40 opacity-0 invisible transition-opacity duration-300 md:hidden"></div>

<!-- Mobile cart drawer -->
<aside id="mobileCartDrawer"
    class="fixed top-0 right-0 z-[1001] h-screen w-[88%] max-w-[380px] bg-white shadow-2xl translate-x-full opacity-0 invisible transition-all duration-300 ease-out md:hidden flex flex-col">
    <div class="px-5 py-5 border-b border-gray-100 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-[#111827]">Your Cart</h3>
            <p class="text-sm text-gray-500">Review added products</p>
        </div>
        <button id="mobileCartClose" type="button"
            class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <div id="mobileCartItems" class="cart-scroll flex-1 overflow-y-auto px-4 py-4 space-y-3"></div>

    <div class="border-t border-gray-100 px-5 py-4 bg-[#fbfdfb]">
        <div class="flex items-center justify-between text-sm text-gray-500">
            <span>Subtotal</span>
            <span id="mobileCartSubtotal" class="text-lg font-bold text-[#111827]">{{ $currencySymbol }}0.00</span>
        </div>

        <div class="mt-4 grid grid-cols-2 gap-3">
            <button type="button" id="mobileClearCart"
                class="rounded-full border border-gray-200 px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                Clear
            </button>

            <a href="{{ url('/checkout') }}"
                class="rounded-full bg-green-600 px-4 py-3 text-center text-sm font-semibold text-white hover:bg-green-700 transition">
                Checkout
            </a>
        </div>
    </div>
</aside>

<script>
    (function () {
        if (window.__landingHeaderCartBound) return;
        window.__landingHeaderCartBound = true;

        const currency = @json($currencySymbol);

        const menuButton = document.getElementById('siteMenuButton');
        const closeButton = document.getElementById('siteCloseMenuButton');
        const overlay = document.getElementById('siteMenuOverlay');
        const mobileMenu = document.getElementById('siteMobileMenu');
        const header = document.getElementById('siteHeader');
        const logo = document.getElementById('siteLogo');

        const desktopCartWrap = document.getElementById('desktopCartWrap');
        const desktopCartButton = document.getElementById('desktopCartButton');
        const desktopCartPanel = document.getElementById('desktopCartPanel');
        const desktopCartBridge = document.getElementById('desktopCartBridge');
        const desktopCartCount = document.getElementById('desktopCartCount');
        const desktopCartItems = document.getElementById('desktopCartItems');
        const desktopCartSubtotal = document.getElementById('desktopCartSubtotal');
        const desktopCartItemsCountText = document.getElementById('desktopCartItemsCountText');
        const desktopClearCart = document.getElementById('desktopClearCart');

        const mobileCartButton = document.getElementById('mobileCartButton');
        const mobileCartCount = document.getElementById('mobileCartCount');
        const mobileCartOverlay = document.getElementById('mobileCartOverlay');
        const mobileCartDrawer = document.getElementById('mobileCartDrawer');
        const mobileCartClose = document.getElementById('mobileCartClose');
        const mobileCartItems = document.getElementById('mobileCartItems');
        const mobileCartSubtotal = document.getElementById('mobileCartSubtotal');
        const mobileClearCart = document.getElementById('mobileClearCart');

        const toast = document.getElementById('siteCartToast');

        let desktopCartCloseTimer = null;
        let desktopCartPinned = false;

        function openMenu() {
            overlay.classList.remove('invisible');
            mobileMenu.classList.remove('invisible');

            requestAnimationFrame(() => {
                overlay.classList.remove('opacity-0');
                mobileMenu.classList.remove('translate-x-full', 'opacity-0');
            });

            document.body.classList.add('overflow-hidden');
            menuButton?.setAttribute('aria-expanded', 'true');
        }

        function closeMenu() {
            overlay.classList.add('opacity-0');
            mobileMenu.classList.add('translate-x-full', 'opacity-0');

            setTimeout(() => {
                overlay.classList.add('invisible');
                mobileMenu.classList.add('invisible');
            }, 300);

            document.body.classList.remove('overflow-hidden');
            menuButton?.setAttribute('aria-expanded', 'false');
        }

        function openMobileCart() {
            mobileCartOverlay.classList.remove('invisible');
            mobileCartDrawer.classList.remove('invisible');

            requestAnimationFrame(() => {
                mobileCartOverlay.classList.remove('opacity-0');
                mobileCartDrawer.classList.remove('translate-x-full', 'opacity-0');
            });

            document.body.classList.add('overflow-hidden');
        }

        function closeMobileCart() {
            mobileCartOverlay.classList.add('opacity-0');
            mobileCartDrawer.classList.add('translate-x-full', 'opacity-0');

            setTimeout(() => {
                mobileCartOverlay.classList.add('invisible');
                mobileCartDrawer.classList.add('invisible');
            }, 300);

            document.body.classList.remove('overflow-hidden');
        }

        function clearDesktopCloseTimer() {
            if (desktopCartCloseTimer) {
                clearTimeout(desktopCartCloseTimer);
                desktopCartCloseTimer = null;
            }
        }

        function openDesktopCart() {
            clearDesktopCloseTimer();
            if (!desktopCartPanel) return;

            desktopCartPanel.classList.remove('hidden');
            desktopCartBridge?.classList.remove('hidden');
        }

        function scheduleDesktopCartClose() {
            if (desktopCartPinned) return;

            clearDesktopCloseTimer();
            desktopCartCloseTimer = setTimeout(() => {
                if (!desktopCartPinned) {
                    desktopCartPanel?.classList.add('hidden');
                    desktopCartBridge?.classList.add('hidden');
                }
            }, 220);
        }

        function closeDesktopCart(force = false) {
            if (!force && desktopCartPinned) return;

            clearDesktopCloseTimer();
            desktopCartPanel?.classList.add('hidden');
            desktopCartBridge?.classList.add('hidden');

            if (force) {
                desktopCartPinned = false;
            }
        }

        function getCart() {
            try {
                return JSON.parse(localStorage.getItem('landing_cart')) || [];
            } catch (e) {
                return [];
            }
        }

        function setCart(cart) {
            localStorage.setItem('landing_cart', JSON.stringify(cart));
            renderCart();
            syncAddButtons();
            window.dispatchEvent(new CustomEvent('landing-cart-updated', { detail: cart }));
        }

        function formatMoney(amount) {
            const value = Number(amount || 0);
            return currency + value.toFixed(2);
        }

        function getCartCount(cart) {
            return cart.reduce((sum, item) => sum + Number(item.qty || 0), 0);
        }

        function getSubtotal(cart) {
            return cart.reduce((sum, item) => sum + (Number(item.price || 0) * Number(item.qty || 0)), 0);
        }

        function showToast(message) {
            if (!toast) return;
            toast.textContent = message;
            toast.classList.remove('hidden');

            clearTimeout(window.__landingCartToastTimer);
            window.__landingCartToastTimer = setTimeout(() => {
                toast.classList.add('hidden');
            }, 3000);
        }

        function increaseQty(id) {
            const cart = getCart();
            const index = cart.findIndex(item => String(item.id) === String(id));
            if (index > -1) {
                cart[index].qty = Number(cart[index].qty || 0) + 1;
                setCart(cart);
            }
        }

        function decreaseQty(id) {
            const cart = getCart();
            const index = cart.findIndex(item => String(item.id) === String(id));
            if (index > -1) {
                cart[index].qty = Number(cart[index].qty || 0) - 1;

                if (cart[index].qty <= 0) {
                    cart.splice(index, 1);
                }

                setCart(cart);
            }
        }

        function removeItem(id) {
            const cart = getCart().filter(item => String(item.id) !== String(id));
            setCart(cart);
        }

        function clearCart() {
            setCart([]);
        }

        function createCartItemHtml(item) {
            return `
                <div class="rounded-2xl border border-gray-100 bg-white p-3">
                    <div class="flex gap-3">
                        <img src="${item.image}" alt="${item.title}" class="w-16 h-16 rounded-2xl object-cover shrink-0">
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <h4 class="text-sm font-semibold text-[#111827] leading-5 line-clamp-2">${item.title}</h4>
                                    ${item.variant ? `<p class="text-xs text-gray-400 mt-1">${item.variant}</p>` : ''}
                                </div>
                                <button type="button" data-cart-action="remove" data-id="${item.id}"
                                    class="text-gray-400 hover:text-red-500 transition">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>

                            <div class="mt-3 flex items-center justify-between gap-3">
                                <div class="flex items-center rounded-full border border-gray-200 bg-white overflow-hidden">
                                    <button type="button" data-cart-action="decrease" data-id="${item.id}"
                                        class="w-9 h-9 flex items-center justify-center text-gray-700 hover:bg-gray-50">−</button>
                                    <span class="w-9 text-center text-sm font-semibold text-[#111827]">${item.qty}</span>
                                    <button type="button" data-cart-action="increase" data-id="${item.id}"
                                        class="w-9 h-9 flex items-center justify-center text-gray-700 hover:bg-gray-50">+</button>
                                </div>

                                <span class="text-sm font-bold text-green-700">${formatMoney(Number(item.price || 0) * Number(item.qty || 0))}</span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function bindCartActions(container) {
            if (!container) return;

            container.querySelectorAll('[data-cart-action="increase"]').forEach(btn => {
                btn.onclick = () => increaseQty(btn.dataset.id);
            });

            container.querySelectorAll('[data-cart-action="decrease"]').forEach(btn => {
                btn.onclick = () => decreaseQty(btn.dataset.id);
            });

            container.querySelectorAll('[data-cart-action="remove"]').forEach(btn => {
                btn.onclick = () => removeItem(btn.dataset.id);
            });
        }

        function renderCart() {
            const cart = getCart();
            const count = getCartCount(cart);
            const subtotal = getSubtotal(cart);

            if (desktopCartCount) desktopCartCount.textContent = count;
            if (mobileCartCount) mobileCartCount.textContent = count;
            if (desktopCartSubtotal) desktopCartSubtotal.textContent = formatMoney(subtotal);
            if (mobileCartSubtotal) mobileCartSubtotal.textContent = formatMoney(subtotal);
            if (desktopCartItemsCountText) desktopCartItemsCountText.textContent = `${count} item${count === 1 ? '' : 's'}`;

            const emptyHtml = `
                <div class="text-center py-10">
                    <div class="w-14 h-14 mx-auto rounded-full bg-green-50 flex items-center justify-center text-green-600">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <h4 class="mt-4 text-sm font-semibold text-[#111827]">Your cart is empty</h4>
                    <p class="mt-1 text-sm text-gray-500">Add products to see them here.</p>
                </div>
            `;

            const itemsHtml = cart.length ? cart.map(createCartItemHtml).join('') : emptyHtml;

            if (desktopCartItems) {
                desktopCartItems.innerHTML = itemsHtml;
                bindCartActions(desktopCartItems);
            }

            if (mobileCartItems) {
                mobileCartItems.innerHTML = itemsHtml;
                bindCartActions(mobileCartItems);
            }
        }

        function syncAddButtons() {
            const cart = getCart();
            const ids = cart.map(item => String(item.id));

            document.querySelectorAll('[data-add-cart]').forEach(btn => {
                const id = String(btn.dataset.id);
                const inCart = ids.includes(id);

                btn.textContent = inCart ? 'Added to cart' : 'Add to cart';
                btn.classList.toggle('bg-green-700', inCart);
                btn.classList.toggle('bg-green-600', !inCart);
            });
        }

        function addToCart(product) {
            const cart = getCart();
            const index = cart.findIndex(item => String(item.id) === String(product.id));

            if (index > -1) {
                cart[index].qty = Number(cart[index].qty || 0) + 1;
            } else {
                cart.push({
                    id: product.id,
                    title: product.title,
                    price: Number(product.price || 0),
                    image: product.image,
                    variant: product.variant || '',
                    qty: 1,
                });
            }

            setCart(cart);
            showToast(product.title + ' added to cart');
        }

        window.LandingCart = {
            add: addToCart,
            render: renderCart,
            syncButtons: syncAddButtons,
            showToast: showToast,
            getCart: getCart,
        };

        menuButton?.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            openMenu();
        });

        closeButton?.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            closeMenu();
        });

        overlay?.addEventListener('click', closeMenu);

        mobileMenu?.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeMenu);
        });

        mobileCartButton?.addEventListener('click', function () {
            openMobileCart();
        });

        mobileCartClose?.addEventListener('click', function () {
            closeMobileCart();
        });

        mobileCartOverlay?.addEventListener('click', function () {
            closeMobileCart();
        });

        desktopCartButton?.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            desktopCartPinned = !desktopCartPinned;

            if (desktopCartPinned) {
                openDesktopCart();
            } else {
                closeDesktopCart(true);
            }
        });

        desktopCartButton?.addEventListener('mouseenter', openDesktopCart);
        desktopCartWrap?.addEventListener('mouseenter', openDesktopCart);

        desktopCartWrap?.addEventListener('mouseleave', function () {
            scheduleDesktopCartClose();
        });

        desktopCartPanel?.addEventListener('mouseenter', function () {
            clearDesktopCloseTimer();
        });

        desktopCartPanel?.addEventListener('mouseleave', function () {
            scheduleDesktopCartClose();
        });

        desktopCartBridge?.addEventListener('mouseenter', function () {
            clearDesktopCloseTimer();
        });

        desktopCartBridge?.addEventListener('mouseleave', function () {
            scheduleDesktopCartClose();
        });

        desktopClearCart?.addEventListener('click', clearCart);
        mobileClearCart?.addEventListener('click', clearCart);

        document.addEventListener('click', function (e) {
            if (desktopCartWrap && !desktopCartWrap.contains(e.target)) {
                closeDesktopCart(true);
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                closeMenu();
                closeMobileCart();
                closeDesktopCart(true);
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768) {
                closeMenu();
                closeMobileCart();
            } else {
                closeDesktopCart(true);
            }
        });

        window.addEventListener('scroll', function () {
            if (window.scrollY > 40) {
                header.classList.add('shadow-md');

                if (logo) {
                    logo.classList.remove('h-10', 'sm:h-12', 'md:h-14');
                    logo.classList.add('h-9', 'sm:h-10', 'md:h-12');
                }
            } else {
                header.classList.remove('shadow-md');

                if (logo) {
                    logo.classList.remove('h-9', 'sm:h-10', 'md:h-12');
                    logo.classList.add('h-10', 'sm:h-12', 'md:h-14');
                }
            }
        });

        window.addEventListener('landing-cart-updated', function () {
            renderCart();
            syncAddButtons();
        });

        renderCart();
        syncAddButtons();
    })();
</script>