@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    @php
        $settings = $settings ?? [];
        $posts = $posts ?? collect();
    @endphp

    <section class="relative overflow-hidden bg-[#f8faf8] min-h-screen">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-24 -left-20 w-80 h-80 rounded-full bg-green-100/50 blur-3xl"></div>
            <div class="absolute top-1/4 -right-20 w-96 h-96 rounded-full bg-emerald-100/30 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-72 h-72 rounded-full bg-lime-100/30 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 lg:py-20">
            <div class="max-w-3xl mx-auto text-center">
                <span
                    class="inline-flex items-center rounded-full border border-green-100 bg-white/80 backdrop-blur px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide text-green-700 shadow-sm blog-fade-up">
                    Keshoriya Journal
                </span>

                <h1
                    class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-[#111827] leading-[1.08] blog-fade-up blog-delay-1">
                    Beauty Stories, Care Tips, and Everyday Inspiration
                </h1>

                <p class="mt-5 text-sm sm:text-base leading-8 text-[#667085] max-w-2xl mx-auto blog-fade-up blog-delay-2">
                    Explore our latest articles on beauty care, self-care rituals, natural-inspired routines, and premium
                    daily wellness.
                </p>
            </div>

            @if($posts->count())
                @php
                    $featured = $posts->first();
                    $restPosts = $posts->slice(1);
                @endphp

                <!-- Featured -->
                <div class="mt-12 blog-fade-up blog-delay-3">
                    <div
                        class="group grid grid-cols-1 lg:grid-cols-[1.1fr_.9fr] gap-0 rounded-[34px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_20px_65px_rgba(15,23,42,0.07)] overflow-hidden hover:shadow-[0_28px_90px_rgba(15,23,42,0.10)] transition duration-500">
                        <a href="{{ route('blog.show', $featured['slug']) }}"
                            class="block h-full min-h-[320px] lg:min-h-[460px] overflow-hidden">
                            <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                        </a>

                        <div class="p-6 sm:p-8 lg:p-10 flex flex-col justify-center">
                            <span
                                class="inline-flex w-fit items-center rounded-full bg-green-50 border border-green-100 px-4 py-2 text-xs font-semibold tracking-wide text-green-700">
                                Featured • {{ $featured['category'] }}
                            </span>

                            <h2 class="mt-5 text-3xl sm:text-4xl font-extrabold text-[#111827] leading-tight">
                                <a href="{{ route('blog.show', $featured['slug']) }}" class="hover:text-green-700 transition">
                                    {{ $featured['title'] }}
                                </a>
                            </h2>

                            <p class="mt-5 text-[15px] sm:text-base leading-8 text-[#667085]">
                                {{ $featured['excerpt'] }}
                            </p>

                            <div class="mt-6 flex flex-wrap items-center gap-3 text-sm text-gray-500">
                                <span>{{ $featured['author'] }}</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                <span>{{ $featured['date'] }}</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                <span>{{ $featured['read_time'] }}</span>
                            </div>

                            <div class="mt-8">
                                <a href="{{ route('blog.show', $featured['slug']) }}"
                                    class="inline-flex items-center justify-center rounded-full bg-green-600 px-6 py-3 text-sm font-semibold text-white shadow-[0_10px_24px_rgba(22,163,74,0.18)] hover:bg-green-700 transition">
                                    Read Article
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid -->
                <div class="mt-10 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8">
                    @foreach($restPosts as $index => $post)
                        <article
                            class="group rounded-[30px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_18px_60px_rgba(15,23,42,0.07)] overflow-hidden transition duration-300 hover:-translate-y-2 hover:shadow-[0_28px_90px_rgba(15,23,42,0.12)] blog-fade-up"
                            style="animation-delay: {{ 0.1 * ($index + 1) }}s">
                            <a href="{{ route('blog.show', $post['slug']) }}" class="block relative">
                                <div class="h-[250px] sm:h-[270px] overflow-hidden bg-[#edf5ec]">
                                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}"
                                        class="w-full h-full object-cover transition duration-700 group-hover:scale-105">
                                </div>
                            </a>

                            <div class="p-6">
                                <span
                                    class="inline-flex items-center rounded-full bg-green-50 border border-green-100 px-3 py-1.5 text-xs font-semibold tracking-wide text-green-700">
                                    {{ $post['category'] }}
                                </span>

                                <h2 class="mt-4 text-2xl font-bold text-[#111827] leading-tight">
                                    <a href="{{ route('blog.show', $post['slug']) }}" class="hover:text-green-700 transition">
                                        {{ $post['title'] }}
                                    </a>
                                </h2>

                                <p class="mt-4 text-sm leading-7 text-[#667085] min-h-[84px]">
                                    {{ $post['excerpt'] }}
                                </p>

                                <div class="mt-5 flex flex-wrap items-center gap-3 text-sm text-gray-500">
                                    <span>{{ $post['author'] }}</span>
                                    <span class="w-1.5 h-1.5 rounded-full bg-gray-300"></span>
                                    <span>{{ $post['date'] }}</span>
                                </div>

                                <div class="mt-6">
                                    <a href="{{ route('blog.show', $post['slug']) }}"
                                        class="inline-flex items-center gap-2 text-sm font-semibold text-green-700 hover:text-green-800 transition">
                                        Read more
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M5 12h14" />
                                            <path d="M13 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <style>
        .blog-fade-up {
            opacity: 0;
            transform: translateY(24px);
            animation: blogFadeUp .8s ease forwards;
        }

        .blog-delay-1 {
            animation-delay: .12s;
        }

        .blog-delay-2 {
            animation-delay: .24s;
        }

        .blog-delay-3 {
            animation-delay: .36s;
        }

        @keyframes blogFadeUp {
            0% {
                opacity: 0;
                transform: translateY(24px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection