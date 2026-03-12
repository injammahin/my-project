@extends('layouts.admin')
@section('title', 'Landing Products')
@section('content')
    @php
        use Illuminate\Support\Str;

        $storageUrl = function ($raw) {
            if (!$raw)
                return null;

            if (Str::startsWith($raw, ['http://', 'https://']))
                return $raw;

            $raw = ltrim($raw, '/');

            // already "storage/xxx"
            if (Str::startsWith($raw, 'storage/'))
                return asset($raw);

            // "/storage/xxx" or "settings/xxx" etc
            return asset('storage/' . $raw);
        };
    @endphp

    <div class="max-w-6xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-start sm:items-center justify-between gap-4 flex-col sm:flex-row">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900">Landing Products</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Add and manage the products shown on your landing page.
                </p>
            </div>

            <a href="{{ url('/') }}" target="_blank"
               class="inline-flex items-center gap-2 rounded-xl border bg-white px-4 py-2 text-sm shadow-sm hover:bg-gray-50">
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                View Website
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

        @if($errors->any())
            <div class="rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-900">
                <div class="font-semibold mb-1 flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    Please fix the following:
                </div>
                <ul class="list-disc pl-5 text-sm space-y-1">
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ADD PRODUCT --}}
        <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">Add Product</h2>
                    <p class="text-sm text-gray-500 mt-1">This will appear in the landing page product section.</p>
                </div>
            </div>

            <form action="{{ url('/admin/landing/products') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Product Title *</label>
                        <input name="title" value="{{ old('title') }}"
                               class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                               placeholder="Keshoriya Organic Hair Oil">
                    </div>
                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-gray-700">Short Description</label>
                        <textarea name="description" rows="4"
                            class="mt-2 summernote w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                            placeholder="Write a simple 3/4 line product description...">{{ old('description') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">This will be shown in the product information section.</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Variant / Size</label>
                        <input name="variant" value="{{ old('variant') }}"
                               class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                               placeholder="200 ml / 400 ml">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Regular Price</label>
                        <input type="number" name="regular_price" value="{{ old('regular_price') }}"
                               class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                               placeholder="750">
                        <p class="text-xs text-gray-500 mt-1">Optional. Shown as strike-through if greater than Sale Price.</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Sale Price *</label>
                        <input type="number" name="sale_price" value="{{ old('sale_price') }}"
                               class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                               placeholder="625">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-gray-700">Product Image</label>
                        <input type="file" name="image"
                               class="mt-2 w-full rounded-xl border px-4 py-3 bg-white">
                        <p class="text-xs text-gray-500 mt-1">PNG/JPG recommended (transparent looks best).</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Status</label>
                        <select name="is_active"
                                class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                            <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                               class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                               placeholder="0">
                        <p class="text-xs text-gray-500 mt-1">Lower number = shown first.</p>
                    </div>

                </div>

                <div class="mt-6 flex items-center justify-end gap-3">
                    <button type="reset"
                            class="px-5 py-3 rounded-xl border bg-white hover:bg-gray-50 text-sm font-semibold">
                        Reset
                    </button>
                    <button type="submit"
                            class="px-6 py-3 rounded-xl text-white text-sm font-semibold shadow hover:opacity-95"
                            style="background: #111827;">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Add Product
                    </button>
                </div>
            </form>
        </div>

        {{-- LIST PRODUCTS --}}
        <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-bold text-gray-900">All Products</h2>
                    <p class="text-sm text-gray-500 mt-1">Manage existing landing products.</p>
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
                        @forelse($products as $p)
                            @php
                                $img = $storageUrl($p->image ?? null);
                                $title = $p->title ?? 'Product';
                                $variant = $p->variant ?? '';
                                $regular = $p->regular_price ?? null;
                                $sale = $p->sale_price ?? $p->price ?? null;
                                $active = (int) ($p->is_active ?? 1) === 1;
                            @endphp

                            <tr class="hover:bg-gray-50/60">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-14 h-14 rounded-2xl bg-gray-100 overflow-hidden flex items-center justify-center">
                                            @if($img)
                                                <img src="{{ $img }}" class="w-full h-full object-cover" alt="{{ $title }}">
                                            @else
                                                <i class="fa-solid fa-image text-gray-400"></i>
                                            @endif
                                        </div>

                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $title }}</div>
                                            @if($variant)
                                                <div class="text-xs text-gray-500">{{ $variant }}</div>
                                            @endif
                                            <div class="text-xs text-gray-400 mt-1">#{{ $p->id }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        @if($regular && $sale && $regular > $sale)
                                            <span class="text-gray-400 line-through">{{ $regular }}</span>
                                        @endif
                                        <span class="text-lg font-extrabold text-gray-900">{{ $sale ?? '-' }}</span>
                                    </div>
                                    @if(!empty($p->sort_order))
                                        <div class="text-xs text-gray-500 mt-1">Sort: {{ $p->sort_order }}</div>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    @if($active)
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

                                        {{-- EDIT BUTTON --}}
                                        <button type="button"
                                                onclick="openEditModal({{ $p->id }})"
                                                class="px-4 py-2 rounded-xl border bg-white hover:bg-gray-50 text-xs font-semibold">
                                            <i class="fa-solid fa-pen mr-1"></i> Edit
                                        </button>

                                        {{-- DELETE --}}
                                        <form action="{{ url('/admin/landing/products/' . $p->id) }}" method="POST"
                                              onsubmit="return confirm('Delete this product?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-4 py-2 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 text-red-700 text-xs font-semibold">
                                                <i class="fa-solid fa-trash mr-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>

                                    {{-- EDIT MODAL --}}
                                    <div id="editModal-{{ $p->id }}"
                                        class="fixed inset-0 z-50 hidden overflow-y-auto bg-black/60 p-4 sm:p-6">
                                        
                                        <div class="min-h-full flex items-start sm:items-center justify-center">
                                            <div class="w-full max-w-3xl my-6 sm:my-8 bg-white rounded-3xl shadow-2xl overflow-hidden max-h-[92vh] flex flex-col">

                                                {{-- Modal Header --}}
                                                <div class="px-6 py-4 border-b flex items-center justify-between bg-white sticky top-0 z-10 shrink-0">
                                                    <div>
                                                        <div class="font-bold text-gray-900 text-lg">Edit Product</div>
                                                        <p class="text-sm text-gray-500 mt-1">Update product information for the landing page.</p>
                                                    </div>

                                                    <button type="button"
                                                            onclick="closeEditModal({{ $p->id }})"
                                                            class="w-10 h-10 rounded-full hover:bg-gray-100 flex items-center justify-center text-gray-600">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>

                                                {{-- Scrollable Body --}}
                                                <div class="overflow-y-auto px-6 py-6">
                                                    <form action="{{ url('/admin/landing/products/' . $p->id) }}"
                                                        method="POST"
                                                        enctype="multipart/form-data"
                                                        id="editForm-{{ $p->id }}">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                                            <div>
                                                                <label class="text-sm font-semibold text-gray-700">Product Title *</label>
                                                                <input name="title" value="{{ $title }}"
                                                                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                                                            </div>

                                                            <div>
                                                                <label class="text-sm font-semibold text-gray-700">Variant / Size</label>
                                                                <input name="variant" value="{{ $variant }}"
                                                                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                                                            </div>

                                                            <div class="md:col-span-2">
                                                                <label class="text-sm font-semibold text-gray-700">Short Description</label>
                                                                <textarea name="description" rows="4"
                                                                        class="mt-2 summernote w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                                                                        placeholder="Write a simple 3/4 line product description...">{{ old('description', $p->description) }}</textarea>
                                                                <p class="text-xs text-gray-500 mt-1">This will be shown in the product information section.</p>
                                                            </div>

                                                            <div>
                                                                <label class="text-sm font-semibold text-gray-700">Regular Price</label>
                                                                <input type="number" name="regular_price" value="{{ $regular }}"
                                                                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                                                            </div>

                                                            <div>
                                                                <label class="text-sm font-semibold text-gray-700">Sale Price *</label>
                                                                <input type="number" name="sale_price" value="{{ $sale }}"
                                                                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                                                            </div>

                                                            <div class="md:col-span-2">
                                                                <label class="text-sm font-semibold text-gray-700">Replace Image</label>
                                                                <input type="file" name="image"
                                                                    class="mt-2 w-full rounded-xl border px-4 py-3 bg-white">

                                                                @if($img)
                                                                    <div class="mt-3 flex items-center gap-3 text-xs text-gray-600">
                                                                        <img src="{{ $img }}" class="w-14 h-14 rounded-xl object-cover border" alt="">
                                                                        <span>Current image</span>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div>
                                                                <label class="text-sm font-semibold text-gray-700">Status</label>
                                                                <select name="is_active"
                                                                        class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                                                                    <option value="1" {{ $active ? 'selected' : '' }}>Active</option>
                                                                    <option value="0" {{ !$active ? 'selected' : '' }}>Inactive</option>
                                                                </select>
                                                            </div>

                                                            <div>
                                                                <label class="text-sm font-semibold text-gray-700">Sort Order</label>
                                                                <input type="number" name="sort_order" value="{{ $p->sort_order ?? 0 }}"
                                                                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>

                                                {{-- Modal Footer --}}
                                                <div class="px-6 py-4 border-t bg-white sticky bottom-0 z-10 shrink-0">
                                                    <div class="flex items-center justify-end gap-3">
                                                        <button type="button"
                                                                onclick="closeEditModal({{ $p->id }})"
                                                                class="px-5 py-3 rounded-xl border bg-white hover:bg-gray-50 text-sm font-semibold">
                                                            Cancel
                                                        </button>

                                                        <button type="submit"
                                                                form="editForm-{{ $p->id }}"
                                                                class="px-6 py-3 rounded-xl text-white text-sm font-semibold shadow hover:opacity-95"
                                                                style="background:#111827;">
                                                            <i class="fa-solid fa-floppy-disk mr-2"></i>
                                                            Save Changes
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                                    No products found. Add your first product above.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($products, 'links'))
                <div class="px-6 py-5 border-t">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // 1. Initialize Summernote for the main "Add Product" form
        $('.summernote').summernote({
            placeholder: 'Write a detailed product description...',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });

    // 2. Combined Modal Functions
    function openEditModal(id) {
        const el = document.getElementById('editModal-' + id);
        if (!el) return;

        el.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        
        // CRITICAL: Initialize or refresh Summernote inside the modal after it becomes visible
        $(el).find('.summernote').summernote({
            tabsize: 2,
            height: 200
        });
    }

    function closeEditModal(id) {
        const el = document.getElementById('editModal-' + id);
        if (!el) return;

        el.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    // 3. Global Listeners for UX
    document.addEventListener('click', function (e) {
        const modal = e.target.closest('[id^="editModal-"]');
        if (modal && e.target === modal) {
            const id = modal.id.split('-')[1];
            closeEditModal(id);
        }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            document.querySelectorAll('[id^="editModal-"]').forEach(modal => {
                if (!modal.classList.contains('hidden')) {
                    const id = modal.id.split('-')[1];
                    closeEditModal(id);
                }
            });
        }
    });
</script>
@endpush
