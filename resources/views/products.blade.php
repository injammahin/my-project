@extends('layouts.app')

@section('title', 'Products')

@section('content')
    @php
        use Illuminate\Support\Str;

        $settings = $settings ?? [];
        $products = $products ?? collect();

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
    @endphp
    @php
        function safeTruncate($string, $length = 95, $end = '...')
        {
            // Strip HTML tags
            $string = strip_tags($string);

            // If string is longer than the limit, truncate it
            if (strlen($string) > $length) {
                $string = substr($string, 0, $length) . $end;
            }

            return $string;
        }
    @endphp
    <section class="relative overflow-hidden bg-[#f8faf8] min-h-screen">
        <!-- premium background decoration -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-24 -left-20 w-80 h-80 rounded-full bg-green-100/50 blur-3xl"></div>
            <div class="absolute top-1/4 -right-20 w-96 h-96 rounded-full bg-emerald-100/30 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/3 w-72 h-72 rounded-full bg-lime-100/30 blur-3xl"></div>
            <div class="absolute top-32 left-[8%] w-3 h-3 rounded-full bg-green-300/70"></div>
            <div class="absolute top-52 right-[12%] w-2.5 h-2.5 rounded-full bg-emerald-300/70"></div>
            <div class="absolute bottom-24 left-[14%] w-4 h-4 rounded-full bg-green-200/70"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 lg:py-20">
            <!-- heading -->
            <div class="max-w-3xl mx-auto text-center">
                <span
                    class="inline-flex items-center rounded-full border border-green-100 bg-white/80 backdrop-blur px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide text-green-700 shadow-sm">
                    Our Collection
                </span>

                <h1 class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-[#111827] leading-[1.08]">
                    Discover Our Premium Products
                </h1>

                <p class="mt-5 text-sm sm:text-base leading-8 text-[#667085] max-w-2xl mx-auto">
                    Explore our elegant beauty and self-care collection with a soothing, modern, and premium shopping
                    experience.
                </p>
            </div>

            @if($products->count())
                <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($products as $product)
                        @php
                            $image = $productImageUrl($product->image ?? null);
                            $title = $product->title ?? 'Product';
                            $description = $product->description ?: 'A premium product carefully selected for your daily beauty and self-care routine.';
                            $shortDescription = Str::limit($description, 95);
                            $variant = $product->size_label ?? $product->variant ?? null;
                            $price = (float) ($product->price ?? 0);
                            $oldPrice = $product->old_price ?? null;
                        @endphp

                        <div
                            class="group relative rounded-[30px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_20px_65px_rgba(15,23,42,0.07)] overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_28px_90px_rgba(15,23,42,0.12)]">

                            <!-- top glow -->
                            <div
                                class="absolute inset-x-0 top-0 h-24 bg-gradient-to-b from-green-50/70 to-transparent pointer-events-none z-10">
                            </div>

                            <a href="{{ route('products.show', $product) }}" class="block relative">
                                <div class="relative h-[320px] sm:h-[340px] md:h-[300px] lg:h-[340px] overflow-hidden bg-[#edf5ec]">
                                    <img src="{{ $image }}" alt="{{ $title }}"
                                        class="w-full h-full object-cover transition duration-700 group-hover:scale-105">

                                    <div
                                        class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-black/20 via-black/5 to-transparent">
                                    </div>

                                    @if($oldPrice && $oldPrice > $price)
                                        <div class="absolute top-4 left-4 z-20">
                                            <span
                                                class="inline-flex items-center rounded-full bg-white/90 backdrop-blur px-3 py-1.5 text-xs font-bold text-green-700 shadow-sm border border-green-100">
                                                Sale
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </a>

                            <div class="p-5 sm:p-6">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="min-w-0">
                                        <h2 class="text-[22px] font-bold text-[#111827] leading-tight">
                                            <a href="{{ route('products.show', $product) }}"
                                                class="hover:text-green-700 transition">
                                                {{ $title }}
                                            </a>
                                        </h2>

                                        @if($variant)
                                            <p class="mt-2 text-sm text-gray-400">
                                                {{ $variant }}
                                            </p>
                                        @endif
                                    </div>

                                    <div class="shrink-0 text-right">
                                        @if($oldPrice && $oldPrice > $price)
                                            <p class="text-sm text-gray-400 line-through">
                                                {{ $currency }}{{ number_format($oldPrice, 2) }}
                                            </p>
                                        @endif

                                        <p class="text-2xl sm:text-[28px] font-extrabold text-green-700">
                                            {{ $currency }}{{ number_format($price, 2) }}
                                        </p>
                                    </div>
                                </div>

                                <!-- stars -->
                                <div class="mt-4 flex items-center gap-1 text-[#f7c948]">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81H7.03a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                    <span class="ml-1 text-xs font-medium text-gray-500">5.0</span>
                                </div>

                                <p class="mt-4 text-sm leading-7 text-[#667085] min-h-[78px]">
                                    {{ safeTruncate($description, 95) }}

                                </p>

                                <div class="mt-6 flex flex-col gap-3">
                                    <a href="{{ route('products.show', $product) }}"
                                        class="inline-flex items-center justify-center rounded-full border border-gray-200 bg-white px-5 py-3 text-sm font-semibold text-[#111827] hover:bg-gray-50 transition">
                                        View Details
                                    </a>

                                    <button type="button"
                                        class="add-to-cart-btn inline-flex items-center justify-center rounded-full bg-green-600 px-5 py-3 text-sm font-semibold text-white shadow-[0_10px_24px_rgba(22,163,74,0.18)] hover:bg-green-700 transition"
                                        data-add-cart data-id="{{ $product->id }}" data-title="{{ $title }}"
                                        data-price="{{ $price }}" data-image="{{ $image }}" data-variant="{{ $variant }}">
                                        Add to cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="mt-12 rounded-[32px] border border-dashed border-green-200 bg-white/80 backdrop-blur p-12 text-center shadow-sm">
                    <div
                        class="mx-auto w-16 h-16 rounded-full bg-green-50 text-green-600 flex items-center justify-center mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2l1.5 6h9L18 2"></path>
                            <path d="M4 10h16"></path>
                            <path d="M5 10l1 10h12l1-10"></path>
                        </svg>
                    </div>

                    <h3 class="text-2xl font-bold text-[#111827]">No products found</h3>
                    <p class="mt-3 text-gray-500">Please add products from the admin panel.</p>
                </div>
            @endif
        </div>
    </section>

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
                });
            });

            window.addEventListener('landing-cart-updated', syncButtons);
            syncButtons();
        });
    </script>
@endsection