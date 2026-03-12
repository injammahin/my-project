@extends('layouts.admin')
@section('title', 'Landing Ingredients')

@section('content')
    @php
        use Illuminate\Support\Str;

        $storageUrl = function ($raw) {
            if (!$raw)
                return null;

            if (Str::startsWith($raw, ['http://', 'https://']))
                return $raw;

            $raw = ltrim($raw, '/');

            if (Str::startsWith($raw, 'storage/'))
                return asset($raw);

            return asset('storage/' . $raw);
        };

        // ✅ Prevent "Undefined variable" issues
        $ingredients = $ingredients ?? $rows ?? collect([]);
    @endphp

    <div class="max-w-6xl mx-auto space-y-6">

        {{-- Header --}}
        <div class="flex items-start sm:items-center justify-between gap-4 flex-col sm:flex-row">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900">Landing Ingredients</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Add and manage the ingredient items shown on your landing page.
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

        {{-- ADD INGREDIENT --}}
        <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b">
                <h2 class="text-lg font-bold text-gray-900">Add Ingredient</h2>
                <p class="text-sm text-gray-500 mt-1">This will appear in the landing page ingredients section.</p>
            </div>

            <form action="{{ url('/admin/landing/ingredients') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Ingredient Name *</label>
                        <input name="name" value="{{ old('name') }}"
                            class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                            placeholder="Coconut Oil">
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                            class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500"
                            placeholder="0">
                        <p class="text-xs text-gray-500 mt-1">Lower number = shown first.</p>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm font-semibold text-gray-700">Ingredient Image</label>
                        <input type="file" name="image" class="mt-2 w-full rounded-xl border px-4 py-3 bg-white">
                        <p class="text-xs text-gray-500 mt-1">PNG/JPG recommended.</p>
                    </div>

                    <div>
                        <label class="text-sm font-semibold text-gray-700">Status</label>
                        <select name="is_active"
                            class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                            <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="mt-6 flex items-center justify-end gap-3">
                    <button type="reset"
                        class="px-5 py-3 rounded-xl border bg-white hover:bg-gray-50 text-sm font-semibold">
                        Reset
                    </button>

                    <button type="submit"
                        class="px-6 py-3 rounded-xl text-white text-sm font-semibold shadow hover:opacity-95"
                        style="background:#111827;">
                        <i class="fa-solid fa-plus mr-2"></i>
                        Add Ingredient
                    </button>
                </div>
            </form>
        </div>

        {{-- LIST INGREDIENTS --}}
        <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b">
                <h2 class="text-lg font-bold text-gray-900">All Ingredients</h2>
                <p class="text-sm text-gray-500 mt-1">Manage existing ingredient items.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="text-left px-6 py-4 font-semibold">Ingredient</th>
                            <th class="text-left px-6 py-4 font-semibold">Status</th>
                            <th class="text-right px-6 py-4 font-semibold">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @forelse($ingredients as $ing)
                            @php
                                $img = $storageUrl($ing->image ?? null);
                                $name = $ing->name ?? 'Ingredient';
                                $active = (int) ($ing->is_active ?? 1) === 1;
                            @endphp

                            <tr class="hover:bg-gray-50/60">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-14 h-14 rounded-2xl bg-gray-100 overflow-hidden flex items-center justify-center">
                                            @if($img)
                                                <img src="{{ $img }}" class="w-full h-full object-cover" alt="{{ $name }}">
                                            @else
                                                <i class="fa-solid fa-image text-gray-400"></i>
                                            @endif
                                        </div>

                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $name }}</div>
                                            <div class="text-xs text-gray-400 mt-1">#{{ $ing->id }}</div>
                                            @if(!empty($ing->sort_order))
                                                <div class="text-xs text-gray-500 mt-1">Sort: {{ $ing->sort_order }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    @if($active)
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-emerald-50 text-emerald-700 px-3 py-1 text-xs font-semibold">
                                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-gray-100 text-gray-700 px-3 py-1 text-xs font-semibold">
                                            <span class="w-2 h-2 rounded-full bg-gray-400"></span> Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <button type="button" onclick="openEditModal({{ $ing->id }})"
                                            class="px-4 py-2 rounded-xl border bg-white hover:bg-gray-50 text-xs font-semibold">
                                            <i class="fa-solid fa-pen mr-1"></i> Edit
                                        </button>

                                        <form action="{{ url('/admin/landing/ingredients/' . $ing->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this ingredient?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 text-red-700 text-xs font-semibold">
                                                <i class="fa-solid fa-trash mr-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>

                                    {{-- EDIT MODAL --}}
                                    <div id="editModal-{{ $ing->id }}"
                                        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
                                        <div class="w-full max-w-2xl bg-white rounded-3xl shadow-xl overflow-hidden">
                                            <div class="px-6 py-4 border-b flex items-center justify-between">
                                                <div class="font-bold text-gray-900">Edit Ingredient</div>
                                                <button type="button" onclick="closeEditModal({{ $ing->id }})"
                                                    class="w-9 h-9 rounded-full hover:bg-gray-100">✕</button>
                                            </div>

                                            <form action="{{ url('/admin/landing/ingredients/' . $ing->id) }}" method="POST"
                                                enctype="multipart/form-data" class="p-6">
                                                @csrf
                                                @method('PUT')

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                                    <div>
                                                        <label class="text-sm font-semibold text-gray-700">Ingredient Name
                                                            *</label>
                                                        <input name="name" value="{{ $name }}"
                                                            class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                                                    </div>

                                                    <div>
                                                        <label class="text-sm font-semibold text-gray-700">Sort Order</label>
                                                        <input type="number" name="sort_order"
                                                            value="{{ $ing->sort_order ?? 0 }}"
                                                            class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                                                    </div>

                                                    <div class="md:col-span-2">
                                                        <label class="text-sm font-semibold text-gray-700">Replace Image</label>
                                                        <input type="file" name="image"
                                                            class="mt-2 w-full rounded-xl border px-4 py-3 bg-white">

                                                        @if($img)
                                                            <div class="mt-3 flex items-center gap-3 text-xs text-gray-600">
                                                                <img src="{{ $img }}"
                                                                    class="w-12 h-12 rounded-xl object-cover border" alt="">
                                                                <span>Current image</span>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="md:col-span-2">
                                                        <label class="text-sm font-semibold text-gray-700">Status</label>
                                                        <select name="is_active"
                                                            class="mt-2 w-full rounded-xl border px-4 py-3 outline-none focus:ring-2 focus:ring-emerald-500">
                                                            <option value="1" {{ $active ? 'selected' : '' }}>Active</option>
                                                            <option value="0" {{ !$active ? 'selected' : '' }}>Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mt-6 flex items-center justify-end gap-3">
                                                    <button type="button" onclick="closeEditModal({{ $ing->id }})"
                                                        class="px-5 py-3 rounded-xl border bg-white hover:bg-gray-50 text-sm font-semibold">
                                                        Cancel
                                                    </button>
                                                    <button type="submit"
                                                        class="px-6 py-3 rounded-xl text-white text-sm font-semibold shadow hover:opacity-95"
                                                        style="background:#111827;">
                                                        <i class="fa-solid fa-floppy-disk mr-2"></i>
                                                        Save Changes
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                                    No ingredients found. Add your first ingredient above.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($ingredients, 'links'))
                <div class="px-6 py-5 border-t">
                    {{ $ingredients->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        function openEditModal(id) {
            const el = document.getElementById('editModal-' + id);
            if (!el) return;
            el.classList.remove('hidden');
            el.classList.add('flex');
        }
        function closeEditModal(id) {
            const el = document.getElementById('editModal-' + id);
            if (!el) return;
            el.classList.add('hidden');
            el.classList.remove('flex');
        }
    </script>
@endpush