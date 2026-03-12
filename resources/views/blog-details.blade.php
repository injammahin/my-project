@extends('layouts.app')

@section('title', $post['title'])

@section('content')
    @php
        $settings = $settings ?? [];
        $post = $post ?? [];
        $relatedPosts = $relatedPosts ?? collect();
    @endphp

    <section class="relative overflow-hidden bg-[#f8faf8] min-h-screen">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute -top-24 -left-20 w-80 h-80 rounded-full bg-green-100/50 blur-3xl"></div>
            <div class="absolute top-1/4 -right-20 w-96 h-96 rounded-full bg-emerald-100/30 blur-3xl"></div>
            <div class="absolute bottom-0 left-1/4 w-72 h-72 rounded-full bg-lime-100/30 blur-3xl"></div>
        </div>

        <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14 lg:py-16">
            <div class="mb-8">
                <a href="{{ route('blog') }}"
                    class="inline-flex items-center gap-2 text-sm font-semibold text-green-700 hover:text-green-800 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                    Back to Blog
                </a>
            </div>

            <!-- Hero -->
            <div
                class="rounded-[34px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_22px_70px_rgba(15,23,42,0.07)] overflow-hidden">
                <div class="relative h-[320px] sm:h-[420px] lg:h-[520px] overflow-hidden">
                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/45 via-black/10 to-transparent"></div>

                    <div class="absolute left-0 right-0 bottom-0 p-6 sm:p-8 lg:p-10 text-white">
                        <span
                            class="inline-flex items-center rounded-full bg-white/15 backdrop-blur border border-white/20 px-4 py-2 text-xs sm:text-sm font-semibold tracking-wide">
                            {{ $post['category'] }}
                        </span>

                        <h1 class="mt-5 text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight max-w-4xl">
                            {{ $post['title'] }}
                        </h1>

                        <div class="mt-5 flex flex-wrap items-center gap-3 text-sm text-white/90">
                            <span>{{ $post['author'] }}</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-white/60"></span>
                            <span>{{ $post['date'] }}</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-white/60"></span>
                            <span>{{ $post['read_time'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-[1fr_320px] gap-8 mt-10">
                <!-- Main article -->
                <article
                    class="rounded-[30px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_18px_60px_rgba(15,23,42,0.06)] p-6 sm:p-8 lg:p-10">
                    <div
                        class="prose prose-lg max-w-none prose-headings:text-[#111827] prose-p:text-[#667085] prose-p:leading-8">
                        <p class="text-lg sm:text-xl leading-9 text-[#475467] font-medium">
                            {{ $post['excerpt'] }}
                        </p>

                        @foreach($post['body'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>

                    <div class="mt-10 rounded-[28px] bg-[#f9fbf9] border border-gray-100 p-6">
                        <h3 class="text-2xl font-bold text-[#111827]">Key Takeaways</h3>

                        <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($post['tips'] as $tip)
                                <div class="flex items-start gap-3 rounded-[20px] bg-white border border-gray-100 p-4">
                                    <span class="mt-1 w-2.5 h-2.5 rounded-full bg-green-500 shrink-0"></span>
                                    <p class="text-sm leading-7 text-[#667085]">{{ $tip }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </article>

                <!-- Sidebar -->
                <aside class="space-y-6">
                    <div
                        class="rounded-[28px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_16px_50px_rgba(15,23,42,0.06)] p-6">
                        <span class="inline-block text-green-700 text-sm font-semibold tracking-wide">Article Info</span>

                        <div class="mt-5 space-y-4 text-sm text-[#667085]">
                            <div>
                                <p class="font-semibold text-[#111827]">Category</p>
                                <p class="mt-1">{{ $post['category'] }}</p>
                            </div>

                            <div>
                                <p class="font-semibold text-[#111827]">Author</p>
                                <p class="mt-1">{{ $post['author'] }}</p>
                            </div>

                            <div>
                                <p class="font-semibold text-[#111827]">Published</p>
                                <p class="mt-1">{{ $post['date'] }}</p>
                            </div>

                            <div>
                                <p class="font-semibold text-[#111827]">Reading Time</p>
                                <p class="mt-1">{{ $post['read_time'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="rounded-[28px] border border-white/70 bg-white/85 backdrop-blur-xl shadow-[0_16px_50px_rgba(15,23,42,0.06)] p-6">
                        <span class="inline-block text-green-700 text-sm font-semibold tracking-wide">More Stories</span>

                        <div class="mt-5 space-y-5">
                            @foreach($relatedPosts as $related)
                                <a href="{{ route('blog.show', $related['slug']) }}" class="group flex gap-4">
                                    <div class="w-20 h-20 rounded-[18px] overflow-hidden shrink-0 bg-[#edf5ec]">
                                        <img src="{{ $related['image'] }}" alt="{{ $related['title'] }}"
                                            class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                    </div>

                                    <div class="min-w-0">
                                        <h4
                                            class="text-sm font-bold text-[#111827] leading-6 group-hover:text-green-700 transition">
                                            {{ $related['title'] }}
                                        </h4>
                                        <p class="mt-1 text-xs text-gray-400">{{ $related['date'] }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection