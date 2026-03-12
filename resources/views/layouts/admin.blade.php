<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --button:
                {{ $settings['button_color'] ?? '#1f2d1f' }}
            ;
        }

        .sidebar-section {
            padding: 10px 14px 6px;
            font-size: 11px;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .45);
        }
    </style>

    <style>
        :root {
            --brand-bg:
                {{ $settings['background_color'] ?? '#efddd3cd' }}
            ;
        }
    </style>

    {{-- ✅ If any page uses @push('styles') --}}
    @stack('styles')
</head>

<body class="bg-gray-100 h-screen overflow-hidden">

    <div class="flex h-screen">

        <!-- ================= MOBILE OVERLAY ================= -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden" onclick="toggleSidebar()">
        </div>

        <!-- ================= SIDEBAR ================= -->
        <aside id="sidebar" class="fixed md:static inset-y-0 left-0 z-40
                  w-64 bg-gray-900 text-gray-300
                  transform -translate-x-full md:translate-x-0
                  transition-transform duration-300
                  flex flex-col shadow-xl">

            <!-- BRAND -->
            <div class="h-16 flex items-center px-6 border-b border-gray-800">
                <i class="fa-solid fa-leaf text-green-400 mr-2"></i>
                <span class="text-lg font-semibold text-white tracking-wide">
                    {{ config('app.name') }} Admin
                </span>
            </div>

            <!-- MENU -->
            <!-- MENU -->
            <nav class="flex-1 px-4 py-6 space-y-2 text-sm">

                {{-- ================= MAIN ================= --}}
                <div class="sidebar-section">Main</div>

                <a href="{{ url('/admin/dashboard') }}"
                    class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ url('/admin/orders') }}"
                    class="sidebar-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                    <i class="fa-solid fa-box"></i>
                    <span>Orders</span>
                </a>

                {{-- ================= ANALYTICS ================= --}}
                <div class="sidebar-section mt-6">Analytics</div>

                <a href="{{ url('/admin/analytics') }}"
                    class="sidebar-link {{ request()->is('admin/analytics') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Overview</span>
                </a>

                <a href="{{ url('/admin/analytics/events') }}"
                    class="sidebar-link {{ request()->is('admin/analytics/events*') ? 'active' : '' }}">
                    <i class="fa-solid fa-brain"></i>
                    <span>Visitor Events</span>
                </a>

                <a href="{{ url('/admin/analytics/map') }}"
                    class="sidebar-link {{ request()->is('admin/analytics/map') ? 'active' : '' }}">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>Visitor Map</span>
                </a>

                {{-- ================= LANDING BUILDER ================= --}}
                <div class="sidebar-section mt-6">Landing Builder</div>
                <a href="{{ url('/admin/settings') }}"
                    class="sidebar-link {{ request()->is('admin/settings*') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear"></i>
                    <span>Page Settings</span>
                </a>
                <a href="{{ route('admin.landing.products.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.landing.products.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Products</span>
                </a>

                <a href="{{ route('admin.landing.ingredients.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.landing.ingredients.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-seedling"></i>
                    <span>Ingredients</span>
                </a>

                <a href="{{ route('admin.landing.testimonials.index') }}"
                    class="sidebar-link {{ request()->routeIs('admin.landing.testimonials.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-star"></i>
                    <span>Testimonials</span>
                </a>

                {{-- ================= SETTINGS ================= --}}
                <div class="sidebar-section mt-6">System</div>
                <a href="{{ url('/') }}" target="_blank" class="sidebar-link">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>View Website</span>
                </a>
                <div class="px-4 py-4 border-t border-gray-800">
                    <button onclick="openLogoutModal()"
                        class="w-full text-left text-red-400 hover:text-red-300 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </div>
            </nav>


            <!-- LOGOUT -->


        </aside>

        <!-- ================= MAIN ================= -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- TOP BAR -->
            <header class="h-16 bg-white border-b shadow-sm
                       flex items-center justify-between px-6
                       fixed top-0 left-0 right-0
                       md:left-64 z-20">

                <!-- MOBILE MENU BTN -->
                <button onclick="toggleSidebar()" class="md:hidden text-xl">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <h1 class="text-lg font-semibold text-gray-800">
                    @yield('title', 'Dashboard')
                </h1>

                <div class="flex items-center gap-3">
                    <div class="text-right leading-tight">
                        <p class="text-sm font-medium text-gray-800">Admin</p>
                        <p class="text-xs text-gray-500">{{ config('app.name') }}</p>
                    </div>

                    <div class="w-9 h-9 rounded-full bg-gray-900 text-white
                            flex items-center justify-center font-semibold">
                        A
                    </div>
                </div>

            </header>

            <!-- PAGE CONTENT -->
            <main class="flex-1 p-6 overflow-y-auto mt-16">
                @yield('content')
            </main>

        </div>
    </div>

    <!-- ================= LOGOUT MODAL ================= -->
    <div id="logoutModal" class="fixed inset-0 bg-black/50 z-50 hidden
            flex items-center justify-center">

        <div class="bg-white rounded-2xl shadow-xl
                max-w-sm w-full p-6 animate-scale-in">

            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                Confirm Logout
            </h3>

            <p class="text-sm text-gray-600 mb-6">
                Are you sure you want to logout from the admin panel?
            </p>

            <div class="flex justify-end gap-3">

                <button onclick="closeLogoutModal()" class="px-4 py-2 rounded-lg border text-sm">
                    Cancel
                </button>

                <form method="POST" action="/admin/logout">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg bg-red-600
                               text-white text-sm hover:bg-red-700">
                        Yes, Logout
                    </button>
                </form>

            </div>
        </div>
    </div>

    <!-- ================= STYLES ================= -->
    <style>
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 8px;
            color: #d1d5db;
            transition: all 0.25s ease;
        }

        .sidebar-link i {
            width: 18px;
            text-align: center;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
        }

        .sidebar-link.active {
            background: linear-gradient(90deg, #16a34a, #22c55e);
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 6px 18px rgba(34, 197, 94, 0.35);
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-scale-in {
            animation: scaleIn .2s ease-out;
        }
    </style>

    <!-- ================= SCRIPTS ================= -->
    <script>

        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebarOverlay').classList.toggle('hidden');
        }

        function openLogoutModal() {
            document.getElementById('logoutModal').classList.remove('hidden');
        }

        function closeLogoutModal() {
            document.getElementById('logoutModal').classList.add('hidden');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    @stack('scripts')

</body>

</html>