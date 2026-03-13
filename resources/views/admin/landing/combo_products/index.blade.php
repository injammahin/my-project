@extends('layouts.admin')

@section('title', 'Combo Products')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-start sm:items-center justify-between gap-4 flex-col sm:flex-row">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900">Combo Products</h1>
                <p class="text-sm text-gray-500 mt-1">Manage your combo products here.</p>
            </div>
            <a href="{{ route('admin.landing.combo_products.create') }}" class="inline-flex items-center gap-2 rounded-xl border bg-white px-4 py-2 text-sm shadow-sm hover:bg-gray-50">
                <i class="fa-solid fa-plus"></i>
                Add New Combo Product
            </a>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-900 flex items-start gap-3">
                <i class="fa-solid fa-circle-check mt-0.5 text-emerald-600"></i>
                <div>
                    <div class="font-semibold">Success</div>
                    <div class="text-sm text-emerald-800/90">{{ session('success') }}</div>
                </div>
            </div>
        @endif

        {{-- Best Sellers --}}
        <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Best Sellers</h2>
                    <p class="text-sm text-gray-500 mt-1">Select the top 3 products to display on the homepage.</p>
                </div>
            </div>

            <form action="{{ route('admin.landing.combo_products.updateBestSellers') }}" method="POST">
                @csrf
                <div class="p-6">
                    @foreach($comboProducts as $comboProduct)
                        <div class="flex items-center gap-3">
                            <input type="checkbox" name="best_sellers[]" value="{{ $comboProduct->id }}"
                                class="form-checkbox" {{ $comboProduct->is_best_seller ? 'checked' : '' }}>
                            <div class="flex items-center gap-2">
                                <img src="{{ asset('storage/' . $comboProduct->image) }}" alt="{{ $comboProduct->title }}" class="w-12 h-12 rounded-full">
                                <span>{{ $comboProduct->title }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 border-t">
                    <button type="submit" class="px-6 py-3 rounded-xl text-white bg-emerald-600 text-sm font-semibold shadow hover:opacity-95">
                        Update Best Sellers
                    </button>
                </div>
            </form>
        </div>

        {{-- Combo Products List --}}
        <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">All Combo Products</h2>
                    <p class="text-sm text-gray-500 mt-1">Manage your combo products displayed on the landing page.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="text-left px-6 py-4 font-semibold">Product</th>
                            <th class="text-left px-6 py-4 font-semibold">Prices</th>
                            <th class="text-left px-6 py-4 font-semibold">Status</th>
                            <th class="text-right px-6 py-4 font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($comboProducts as $p)
                            <tr class="hover:bg-gray-50/60">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-2xl bg-gray-100 overflow-hidden flex items-center justify-center">
                                            @if($p->image)
                                                <img src="{{ asset('storage/' . $p->image) }}" class="w-full h-full object-cover" alt="{{ $p->title }}">
                                            @else
                                                <i class="fa-solid fa-image text-gray-400"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $p->title }}</div>
                                            <div class="text-xs text-gray-400 mt-1">#{{ $p->id }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <span class="text-lg font-extrabold text-gray-900">{{ $p->sale_price }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @if($p->is_active)
                                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 text-emerald-700 px-3 py-1 text-xs font-semibold">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-2 rounded-full bg-gray-100 text-gray-700 px-3 py-1 text-xs font-semibold">
                                            <span class="w-2 h-2 rounded-full bg-gray-400"></span> Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        {{-- Edit Button --}}
                                        <a href="{{ route('admin.landing.combo_products.edit', $p->id) }}"
                                            class="px-4 py-2 rounded-xl border bg-white hover:bg-gray-50 text-xs font-semibold">
                                            <i class="fa-solid fa-pen mr-1"></i> Edit
                                        </a>

                                        {{-- Delete Button --}}
                                        <form action="{{ route('admin.landing.combo_products.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Delete this combo product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-4 py-2 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 text-red-700 text-xs font-semibold">
                                                <i class="fa-solid fa-trash mr-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                    No combo products found. Add your first combo product above.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($comboProducts, 'links'))
                <div class="px-6 py-5 border-t">
                    {{ $comboProducts->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection