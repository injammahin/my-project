@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    @php
        $currencySymbol = $settings['currency_symbol'] ?? '৳';
        $deliveryCharge = (int) ($settings['delivery_charge'] ?? 70);
        $contactPhone = $settings['contact_phone'] ?? '+880 1234 567890';
        $contactEmail = $settings['contact_email'] ?? 'support@example.com';
    @endphp

    <section class="relative overflow-hidden bg-[#f8fbf7] min-h-screen">
        <!-- soft natural background -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-20 -left-16 w-72 h-72 rounded-full bg-green-100/40 blur-3xl"></div>
            <div class="absolute top-1/3 -right-20 w-80 h-80 rounded-full bg-emerald-100/30 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-72 h-72 rounded-full bg-lime-100/30 blur-3xl"></div>

            <!-- floating leaves -->
            <div class="absolute top-20 left-10 hidden lg:block animate-[floatY_6s_ease-in-out_infinite] opacity-80">
                <svg width="90" height="90" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M109 13C79 18 53 34 35 55C18 75 11 95 12 108C31 107 50 100 69 84C88 68 102 44 109 13Z"
                        fill="#74b44c" />
                    <path d="M28 95C45 76 63 57 90 34" stroke="#e8ffe1" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>

            <div class="absolute bottom-24 right-8 hidden lg:block animate-[floatY_7s_ease-in-out_infinite] opacity-90">
                <svg width="110" height="110" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M109 13C79 18 53 34 35 55C18 75 11 95 12 108C31 107 50 100 69 84C88 68 102 44 109 13Z"
                        fill="#1f8b3d" />
                    <path d="M28 95C45 76 63 57 90 34" stroke="#dcffd8" stroke-width="3" stroke-linecap="round" />
                </svg>
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 lg:py-16">
            <!-- heading -->
            <div class="max-w-3xl mx-auto text-center mb-10 sm:mb-12">
                <span
                    class="inline-flex items-center rounded-full border border-green-100 bg-white/80 backdrop-blur px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide text-green-700 shadow-sm">
                    Secure Natural Checkout
                </span>

                <h1 class="mt-4 text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#111827] leading-tight">
                    Complete your order beautifully
                </h1>

                <p class="mt-4 text-sm sm:text-base text-[#6b7280] leading-7 max-w-2xl mx-auto">
                    Fill in your delivery details and review your selected products in a calm, premium checkout experience.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[1.05fr_.85fr] gap-8 xl:gap-10 items-start">
                <!-- left form -->
                <div class="relative">
                    <div
                        class="rounded-[32px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_25px_80px_rgba(15,23,42,0.08)] overflow-hidden">
                        <div class="px-6 sm:px-8 py-6 border-b border-gray-100 bg-white/70">
                            <h2 class="text-xl sm:text-2xl font-bold text-[#111827]">Delivery information</h2>
                            <p class="mt-1 text-sm text-gray-500">Please provide your details carefully.</p>
                        </div>

                        <form id="checkoutForm" class="p-6 sm:p-8 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                                    <input id="checkout_name" type="text"
                                        class="w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 outline-none focus:ring-2 focus:ring-green-500"
                                        placeholder="Enter your full name">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number *</label>
                                    <input id="checkout_phone" type="text"
                                        class="w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 outline-none focus:ring-2 focus:ring-green-500"
                                        placeholder="01XXXXXXXXX">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                    <input id="checkout_email" type="email"
                                        class="w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 outline-none focus:ring-2 focus:ring-green-500"
                                        placeholder="Optional email">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Full Address *</label>
                                    <textarea id="checkout_address" rows="4"
                                        class="w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 outline-none focus:ring-2 focus:ring-green-500"
                                        placeholder="Village / Area / Thana / District"></textarea>
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Order Note</label>
                                    <textarea id="checkout_note" rows="3"
                                        class="w-full rounded-2xl border border-gray-200 bg-white px-5 py-4 outline-none focus:ring-2 focus:ring-green-500"
                                        placeholder="Optional note for delivery or product preference"></textarea>
                                </div>
                            </div>

                            <div
                                class="rounded-[24px] bg-gradient-to-r from-green-50 to-emerald-50 border border-green-100 px-5 py-5">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-11 h-11 rounded-full bg-white text-green-700 border border-green-100 flex items-center justify-center shrink-0 shadow-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                                        </svg>
                                    </div>

                                    <div>
                                        <h3 class="text-sm font-bold text-[#111827]">Cash on Delivery Available</h3>
                                        <p class="mt-1 text-sm text-gray-600 leading-6">
                                            Delivery charge:
                                            <span
                                                class="font-semibold text-green-700">{{ $currencySymbol }}{{ $deliveryCharge }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="rounded-[24px] border border-gray-100 bg-[#fcfdfc] px-5 py-5">
                                <h3 class="text-sm font-bold text-[#111827] mb-3">Need support?</h3>
                                <div class="space-y-2 text-sm text-gray-600">
                                    <p>Phone: <span class="font-medium text-[#111827]">{{ $contactPhone }}</span></p>
                                    <p>Email: <span class="font-medium text-[#111827]">{{ $contactEmail }}</span></p>
                                </div>
                            </div>

                            <div id="checkoutStatus" class="hidden rounded-2xl px-4 py-3 text-sm font-medium"></div>

                            <button type="submit"
                                class="w-full rounded-full bg-green-600 text-white py-4 text-base sm:text-lg font-semibold shadow-[0_12px_30px_rgba(22,163,74,0.25)] hover:bg-green-700 transition">
                                Place Order
                            </button>
                        </form>
                    </div>
                </div>

                <!-- right preview -->
                <div class="lg:sticky lg:top-28">
                    <div
                        class="rounded-[32px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_25px_80px_rgba(15,23,42,0.08)] overflow-hidden">
                        <div class="px-6 sm:px-7 py-6 border-b border-gray-100 bg-white/70">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h2 class="text-xl sm:text-2xl font-bold text-[#111827]">Order Preview</h2>
                                    <p class="mt-1 text-sm text-gray-500">Your selected products</p>
                                </div>
                                <span id="checkoutItemCount"
                                    class="inline-flex items-center rounded-full bg-green-50 text-green-700 text-xs font-semibold px-3 py-1 border border-green-100">
                                    0 items
                                </span>
                            </div>
                        </div>

                        <div id="checkoutItems" class="max-h-[360px] overflow-y-auto px-5 sm:px-6 py-5 space-y-4">
                        </div>

                        <div class="border-t border-gray-100 px-6 sm:px-7 py-6 bg-[#fbfdfb]">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <span>Subtotal</span>
                                    <span id="checkoutSubtotal"
                                        class="font-semibold text-[#111827]">{{ $currencySymbol }}0.00</span>
                                </div>

                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <span>Delivery Charge</span>
                                    <span
                                        class="font-semibold text-[#111827]">{{ $currencySymbol }}{{ number_format($deliveryCharge, 2) }}</span>
                                </div>

                                <div class="pt-3 border-t border-dashed border-gray-200 flex items-center justify-between">
                                    <span class="text-base font-semibold text-[#111827]">Total</span>
                                    <span id="checkoutTotal"
                                        class="text-2xl font-extrabold text-green-700">{{ $currencySymbol }}0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="mt-5 rounded-[26px] border border-white/70 bg-white/80 backdrop-blur-xl shadow-[0_18px_60px_rgba(15,23,42,0.05)] p-5">
                        <h3 class="text-sm font-bold text-[#111827]">Why buy from us?</h3>
                        <div class="mt-4 space-y-3 text-sm text-gray-600">
                            <div class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 mt-1.5 rounded-full bg-green-500 shrink-0"></span>
                                <p>Natural soothing brand style and premium shopping experience</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 mt-1.5 rounded-full bg-green-500 shrink-0"></span>
                                <p>Fast processing with reliable cash on delivery support</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <span class="w-2.5 h-2.5 mt-1.5 rounded-full bg-green-500 shrink-0"></span>
                                <p>Easy product review with quantity update before final order</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- success modal -->
        <div id="checkoutSuccessModal" class="fixed inset-0 z-[1200] hidden bg-black/50 p-4">
            <div class="min-h-full flex items-center justify-center">
                <div class="w-full max-w-md rounded-[28px] bg-white shadow-2xl overflow-hidden">
                    <div class="p-8 text-center">
                        <div
                            class="w-16 h-16 mx-auto rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 6L9 17l-5-5"></path>
                            </svg>
                        </div>

                        <h3 class="mt-5 text-2xl font-bold text-[#111827]">Order placed successfully</h3>
                        <p class="mt-3 text-sm text-gray-600 leading-6">
                            Thank you. We will contact you very soon for confirmation.
                        </p>

                        <div class="mt-6">
                            <a href="{{ route('landing') }}"
                                class="inline-flex items-center justify-center rounded-full bg-green-600 px-6 py-3 text-white font-semibold hover:bg-green-700 transition">
                                Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes floatY {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ORDER_URL = @json(route('order.store'));
            const CSRF = @json(csrf_token());
            const DELIVERY_CHARGE = @json($deliveryCharge);
            const CURRENCY = @json($currencySymbol);

            const itemsContainer = document.getElementById('checkoutItems');
            const subtotalEl = document.getElementById('checkoutSubtotal');
            const totalEl = document.getElementById('checkoutTotal');
            const itemCountEl = document.getElementById('checkoutItemCount');

            const form = document.getElementById('checkoutForm');
            const statusBox = document.getElementById('checkoutStatus');
            const successModal = document.getElementById('checkoutSuccessModal');

            function getCart() {
                try {
                    return JSON.parse(localStorage.getItem('landing_cart')) || [];
                } catch (e) {
                    return [];
                }
            }

            function setCart(cart) {
                localStorage.setItem('landing_cart', JSON.stringify(cart));
                renderCheckoutCart();
                window.dispatchEvent(new CustomEvent('landing-cart-updated', { detail: cart }));
            }

            function formatMoney(amount) {
                return CURRENCY + Number(amount || 0).toFixed(2);
            }

            function getSubtotal(cart) {
                return cart.reduce((sum, item) => {
                    return sum + (Number(item.price || 0) * Number(item.qty || 0));
                }, 0);
            }

            function getCount(cart) {
                return cart.reduce((sum, item) => sum + Number(item.qty || 0), 0);
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

            function bindActions() {
                itemsContainer.querySelectorAll('[data-cart-action="increase"]').forEach(btn => {
                    btn.onclick = () => increaseQty(btn.dataset.id);
                });

                itemsContainer.querySelectorAll('[data-cart-action="decrease"]').forEach(btn => {
                    btn.onclick = () => decreaseQty(btn.dataset.id);
                });

                itemsContainer.querySelectorAll('[data-cart-action="remove"]').forEach(btn => {
                    btn.onclick = () => removeItem(btn.dataset.id);
                });
            }

            function renderCheckoutCart() {
                const cart = getCart();
                const subtotal = getSubtotal(cart);
                const count = getCount(cart);
                const total = cart.length ? subtotal + Number(DELIVERY_CHARGE) : 0;

                itemCountEl.textContent = `${count} item${count === 1 ? '' : 's'}`;
                subtotalEl.textContent = formatMoney(subtotal);
                totalEl.textContent = formatMoney(total);

                if (!cart.length) {
                    itemsContainer.innerHTML = `
                            <div class="py-10 text-center">
                                <div class="w-14 h-14 mx-auto rounded-full bg-green-50 text-green-600 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="9" cy="21" r="1"></circle>
                                        <circle cx="16" cy="21" r="1"></circle>
                                        <path d="M1 1h4l1 7h11l1-7h4"></path>
                                    </svg>
                                </div>
                                <h4 class="mt-4 text-sm font-semibold text-[#111827]">Your cart is empty</h4>
                                <p class="mt-1 text-sm text-gray-500">Add products before checkout.</p>
                                <a href="{{ route('landing') }}"
                                    class="mt-5 inline-flex items-center justify-center rounded-full bg-green-600 px-5 py-3 text-sm font-semibold text-white hover:bg-green-700 transition">
                                    Continue Shopping
                                </a>
                            </div>
                        `;
                    return;
                }

                itemsContainer.innerHTML = cart.map(item => `
                        <div class="rounded-[22px] border border-gray-100 bg-white p-4 shadow-sm">
                            <div class="flex gap-4">
                                <img src="${item.image}" alt="${item.title || item.name}" class="w-18 h-18 sm:w-20 sm:h-20 rounded-2xl object-cover shrink-0">

                                <div class="min-w-0 flex-1">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0">
                                            <h4 class="text-sm sm:text-base font-semibold text-[#111827] leading-6 line-clamp-2">
                                                ${item.title || item.name}
                                            </h4>
                                            ${item.variant ? `<p class="text-xs text-gray-400 mt-1">${item.variant}</p>` : ''}
                                        </div>

                                        <button type="button" data-cart-action="remove" data-id="${item.id}"
                                            class="text-gray-400 hover:text-red-500 transition">
                                            ✕
                                        </button>
                                    </div>

                                    <div class="mt-4 flex items-center justify-between gap-4">
                                        <div class="flex items-center rounded-full border border-gray-200 overflow-hidden bg-white">
                                            <button type="button" data-cart-action="decrease" data-id="${item.id}"
                                                class="w-9 h-9 flex items-center justify-center text-gray-700 hover:bg-gray-50">−</button>
                                            <span class="w-10 text-center text-sm font-semibold text-[#111827]">${item.qty}</span>
                                            <button type="button" data-cart-action="increase" data-id="${item.id}"
                                                class="w-9 h-9 flex items-center justify-center text-gray-700 hover:bg-gray-50">+</button>
                                        </div>

                                        <div class="text-right">
                                            <p class="text-xs text-gray-400">${formatMoney(item.price)} each</p>
                                            <p class="text-base font-bold text-green-700">${formatMoney(Number(item.price || 0) * Number(item.qty || 0))}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('');

                bindActions();
            }

            function showStatus(message, type = 'success') {
                statusBox.classList.remove(
                    'hidden',
                    'bg-red-50',
                    'text-red-700',
                    'border',
                    'border-red-100',
                    'bg-green-50',
                    'text-green-700',
                    'border-green-100'
                );

                if (type === 'error') {
                    statusBox.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-100');
                } else {
                    statusBox.classList.add('bg-green-50', 'text-green-700', 'border', 'border-green-100');
                }

                statusBox.textContent = message;
            }

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                const name = document.getElementById('checkout_name').value.trim();
                const phone = document.getElementById('checkout_phone').value.trim();
                const email = document.getElementById('checkout_email').value.trim();
                const address = document.getElementById('checkout_address').value.trim();
                const note = document.getElementById('checkout_note').value.trim();
                const cart = getCart();

                if (!name || !phone || !address) {
                    showStatus('Please fill in full name, phone number, and address.', 'error');
                    return;
                }

                if (!cart.length) {
                    showStatus('Your cart is empty. Please add products before placing an order.', 'error');
                    return;
                }

                const payloadCart = cart.map(item => ({
                    name: item.title || item.name || 'Product',
                    price: Number(item.price || 0),
                    qty: Number(item.qty || 1),
                    image: item.image || null,
                    variant: item.variant || '',
                }));

                showStatus('Submitting your order...', 'success');

                try {
                    const response = await fetch(ORDER_URL, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            name: name,
                            phone: phone,
                            email: email || null,
                            address: address,
                            note: note,
                            cart: payloadCart,
                        }),
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        const errorMessage =
                            data?.message ||
                            Object.values(data?.errors || {}).flat().join(' ') ||
                            'Something went wrong';

                        throw new Error(errorMessage);
                    }

                    localStorage.removeItem('landing_cart');
                    window.dispatchEvent(new CustomEvent('landing-cart-updated', { detail: [] }));

                    showStatus('Order placed successfully.', 'success');
                    renderCheckoutCart();
                    form.reset();

                    setTimeout(() => {
                        successModal.classList.remove('hidden');
                    }, 500);
                } catch (error) {
                    showStatus(error.message || 'Failed to place order. Please try again.', 'error');
                }
            });

            renderCheckoutCart();
        });
    </script>
@endsection