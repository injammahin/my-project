@extends('layouts.app')

@section('title', $product->title ?? 'Product Details')

@section('content')
    @php
        use Illuminate\Support\Str;

        $settings = $settings ?? [];
        $currency = $settings['currency_symbol'] ?? '$';

        $productImageUrl = function ($raw) {
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

        $image = $productImageUrl($product->image ?? null);
        $title = $product->title ?? 'Product';
        $description = $product->description ?: 'A premium product carefully selected for your daily beauty and self-care routine.';
        $variant = $product->size_label ?? $product->variant ?? null;
        $price = (float) ($product->price ?? 0);
        $oldPrice = $product->old_price ?? null;
    @endphp

    <section class="relative overflow-hidden bg-[#f8faf8]">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-20 -left-16 w-72 h-72 rounded-full bg-green-100/40 blur-3xl"></div>
            <div class="absolute top-1/3 -right-16 w-80 h-80 rounded-full bg-emerald-100/30 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-64 h-64 rounded-full bg-lime-100/30 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 lg:py-16">
            <div class="mb-8">
                <a href="{{ route('products') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-green-700 hover:text-green-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                    Back to Products
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_.95fr] gap-8 lg:gap-12 items-center">
                <div
                    class="rounded-[34px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_18px_60px_rgba(15,23,42,0.07)] overflow-hidden">
                    <div class="h-[360px] sm:h-[460px] lg:h-[560px] bg-[#f4f7f2]">
                        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <div
                    class="rounded-[34px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_18px_60px_rgba(15,23,42,0.07)] p-6 sm:p-8 lg:p-10">
                    <span
                        class="inline-flex items-center rounded-full bg-green-50 border border-green-100 px-4 py-2 text-sm font-semibold text-green-700">
                        Premium Collection
                    </span>

                    <h1 class="mt-5 text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#111827] leading-tight">
                        {{ $title }}
                    </h1>

                    @if($variant)
                        <p class="mt-3 text-base text-gray-400">{{ $variant }}</p>
                    @endif

                    <div class="mt-6 flex items-end gap-3">
                        @if($oldPrice && $oldPrice > $price)
                            <span
                                class="text-xl text-gray-400 line-through">{{ $currency }}{{ number_format($oldPrice, 2) }}</span>
                        @endif

                        <span class="text-4xl sm:text-5xl font-extrabold text-green-700">
                            {{ $currency }}{{ number_format($price, 2) }}
                        </span>
                    </div>

                    <p class="mt-6 text-[15px] sm:text-base leading-8 text-[#667085]">
                        {{ $description }}
                    </p>

                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="rounded-[22px] bg-[#f9fbf9] border border-gray-100 p-4">
                            <h3 class="text-sm font-bold text-[#111827]">Premium Quality</h3>
                            <p class="mt-2 text-sm leading-6 text-gray-500">Crafted for a refined and comfortable beauty
                                routine.</p>
                        </div>

                        <div class="rounded-[22px] bg-[#f9fbf9] border border-gray-100 p-4">
                            <h3 class="text-sm font-bold text-[#111827]">Modern Care</h3>
                            <p class="mt-2 text-sm leading-6 text-gray-500">A simple, elegant, and soothing product
                                experience.</p>
                        </div>

                        <div class="rounded-[22px] bg-[#f9fbf9] border border-gray-100 p-4">
                            <h3 class="text-sm font-bold text-[#111827]">Daily Use</h3>
                            <p class="mt-2 text-sm leading-6 text-gray-500">Perfect for confident everyday self-care and
                                beauty.</p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row gap-4">
                        <div class="inline-flex items-center rounded-full border border-gray-200 overflow-hidden bg-white">
                            <button type="button" id="qtyMinus"
                                class="w-12 h-12 flex items-center justify-center text-xl text-gray-700 hover:bg-gray-50">−</button>
                            <input id="productQty" type="number" min="1" value="1"
                                class="w-16 text-center outline-none font-semibold text-[#111827]">
                            <button type="button" id="qtyPlus"
                                class="w-12 h-12 flex items-center justify-center text-xl text-gray-700 hover:bg-gray-50">+</button>
                        </div>

                        <button type="button" id="detailAddToCart"
                            class="inline-flex items-center justify-center rounded-full bg-green-600 px-8 py-4 text-white font-semibold shadow-[0_12px_30px_rgba(22,163,74,0.25)] hover:bg-green-700 transition"
                            data-id="{{ $product->id }}" data-title="{{ $title }}" data-price="{{ $price }}"
                            data-image="{{ $image }}" data-variant="{{ $variant }}">
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>

            @if($relatedProducts->count())
                <div class="mt-16">
                    <div class="flex items-center justify-between gap-4 mb-8">
                        <div>
                            <span class="inline-block text-green-600 text-sm font-semibold tracking-wide">
                                More Products
                            </span>
                            <h2 class="mt-2 text-3xl sm:text-4xl font-extrabold text-[#111827]">
                                Related Products
                            </h2>
                        </div>

                        <a href="{{ route('products') }}"
                            class="hidden sm:inline-flex items-center justify-center rounded-full border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-[#111827] hover:bg-gray-50 transition">
                            View All
                        </a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $related)
                            @php
                                $relatedImage = $productImageUrl($related->image ?? null);
                                $relatedTitle = $related->title ?? 'Product';
                                $relatedPrice = (float) ($related->price ?? 0);
                            @endphp

                            <div
                                class="rounded-[28px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_16px_50px_rgba(15,23,42,0.06)] overflow-hidden">
                                <a href="{{ route('products.show', $related) }}">
                                    <div class="h-[240px] bg-[#f4f7f2] overflow-hidden">
                                        <img src="{{ $relatedImage }}" alt="{{ $relatedTitle }}"
                                            class="w-full h-full object-cover transition duration-500 hover:scale-105">
                                    </div>
                                </a>

                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-[#111827] leading-tight">
                                        <a href="{{ route('products.show', $related) }}" class="hover:text-green-700 transition">
                                            {{ $relatedTitle }}
                                        </a>
                                    </h3>

                                    <p class="mt-3 text-2xl font-extrabold text-green-700">
                                        {{ $currency }}{{ number_format($relatedPrice, 2) }}
                                    </p>

                                    <a href="{{ route('products.show', $related) }}"
                                        class="mt-4 inline-flex items-center justify-center rounded-full border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-[#111827] hover:bg-gray-50 transition">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const qtyInput = document.getElementById('productQty');
            const qtyMinus = document.getElementById('qtyMinus');
            const qtyPlus = document.getElementById('qtyPlus');
            const addButton = document.getElementById('detailAddToCart');

            qtyMinus?.addEventListener('click', function () {
                const current = parseInt(qtyInput.value || 1, 10);
                qtyInput.value = Math.max(1, current - 1);
            });

            qtyPlus?.addEventListener('click', function () {
                const current = parseInt(qtyInput.value || 1, 10);
                qtyInput.value = current + 1;
            });

            addButton?.addEventListener('click', function () {
                if (!window.LandingCart) return;

                const qty = Math.max(1, parseInt(qtyInput.value || 1, 10));

                for (let i = 0; i < qty; i++) {
                    window.LandingCart.add({
                        id: this.dataset.id,
                        title: this.dataset.title,
                        price: this.dataset.price,
                        image: this.dataset.image,
                        variant: this.dataset.variant || '',
                    });
                }

                this.textContent = 'Added to cart';
                this.classList.remove('bg-green-600');
                this.classList.add('bg-green-700');
            });
        });
    </script>
@endsection