@extends('layouts.admin')

@section('title', 'Add Combo Product')

@section('content')
    <div class="max-w-6xl mx-auto space-y-6">
        <h1 class="text-2xl font-extrabold text-gray-900">Add Combo Product</h1>

        <form action="{{ route('admin.landing.combo_products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Product Title -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Combo Product Title *</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                    required placeholder="Combo Product Title">
            </div>

            <!-- Product Description -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Description</label>
                <textarea name="description" rows="4"
                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500 summernote"
                    placeholder="Product Description...">{{ old('description') }}</textarea>
            </div>

            <!-- Sale Price -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Sale Price *</label>
                <input type="number" name="sale_price" value="{{ old('sale_price') }}"
                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                    required placeholder="Sale Price">
            </div>

            <!-- Regular Price -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Regular Price</label>
                <input type="number" name="regular_price" value="{{ old('regular_price') }}"
                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                    placeholder="Regular Price">
            </div>

            <!-- Gift Name (Optional) -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Gift Name (Optional)</label>
                <input type="text" name="gift_name" value="{{ old('gift_name') }}"
                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                    placeholder="Gift Name">
            </div>

            <!-- Gift Image (Optional) -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Gift Image (Optional)</label>
                <input type="file" name="gift_image" class="mt-2 w-full rounded-xl border px-4 py-3 bg-white">
                <p class="text-xs text-gray-500 mt-1">PNG/JPG recommended (transparent looks best).</p>
            </div>

            <!-- Product Image -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Product Image *</label>
                <input type="file" name="image" class="mt-2 w-full rounded-xl border px-4 py-3 bg-white" required>
                <p class="text-xs text-gray-500 mt-1">PNG/JPG recommended (transparent looks best).</p>
            </div>

            <!-- Sort Order -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                    placeholder="Sort Order">
                <p class="text-xs text-gray-500 mt-1">Lower number = shown first.</p>
            </div>

            <!-- Product Status -->
            <div>
                <label class="text-sm font-semibold text-gray-700">Status</label>
                <select name="is_active"
                    class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                    <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 flex items-center justify-end gap-3">
                <button type="reset" class="px-5 py-3 rounded-xl border bg-white hover:bg-gray-50 text-sm font-semibold">
                    Reset
                </button>
                <button type="submit" class="px-6 py-3 rounded-xl text-white text-sm font-semibold shadow hover:opacity-95"
                    style="background: #111827;">
                    <i class="fa-solid fa-plus mr-2"></i> Add Combo Product
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            // Initialize Summernote for the description field
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
    </script>
@endpush