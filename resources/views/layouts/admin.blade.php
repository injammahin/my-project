<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

<div class="flex min-h-screen">

    <!-- ================= MOBILE OVERLAY ================= -->
    <div id="sidebarOverlay"
         class="fixed inset-0 bg-black/50 z-30 hidden md:hidden"
         onclick="toggleSidebar()"></div>

    <!-- ================= SIDEBAR ================= -->
    <aside id="sidebar"
           class="fixed md:static inset-y-0 left-0 z-40
                  w-64 bg-gray-900 text-gray-300
                  transform -translate-x-full md:translate-x-0
                  transition-transform duration-300
                  flex flex-col shadow-xl">

        <!-- BRAND -->
        <div class="h-16 flex items-center px-6 border-b border-gray-800">
            <span class="text-lg font-semibold text-white tracking-wide">
                Keshoriya Admin
            </span>
        </div>

        <!-- MENU -->
        <nav class="flex-1 px-4 py-6 space-y-2 text-sm">

            <a href="/admin/dashboard"
               class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <span>📊</span>
                <span>Dashboard</span>
            </a>

            <a href="/admin/orders"
               class="sidebar-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
                <span>📦</span>
                <span>Orders</span>
            </a>
            <a href="/admin/analytics"
               class="sidebar-link {{ request()->is('admin/analytics') ? 'active' : '' }}">
                <span>📈</span>
                <span>Analytics</span>
            </a>
            

            <a href="/admin/analytics/events"
                class="sidebar-link {{ request()->is('admin/analytics/events*') ? 'active' : '' }}">
                <span>🧠</span>
                <span>Visitor Events</span>
            </a>

        </nav>

        <!-- LOGOUT BUTTON -->
        <div class="px-4 py-4 border-t border-gray-800">
            <button onclick="openLogoutModal()"
                    class="w-full text-left text-red-400 hover:text-red-300 text-sm">
                ⏻ Logout
            </button>
        </div>

    </aside>

    <!-- ================= MAIN ================= -->
    <div class="flex-1 flex flex-col">

        <!-- TOP BAR -->
        <header class="h-16 bg-white border-b shadow-sm
                       flex items-center justify-between px-6">

            <!-- MOBILE MENU BTN -->
            <button onclick="toggleSidebar()"
                    class="md:hidden text-xl">
                ☰
            </button>

            <h1 class="text-lg font-semibold text-gray-800">
                @yield('title', 'Dashboard')
            </h1>

            <div class="flex items-center gap-3">
                <div class="text-right leading-tight">
                    <p class="text-sm font-medium text-gray-800">Admin</p>
                    <p class="text-xs text-gray-500">Keshoriya</p>
                </div>

                <div class="w-9 h-9 rounded-full bg-gray-900 text-white
                            flex items-center justify-center font-semibold">
                    A
                </div>
            </div>

        </header>

        <!-- PAGE CONTENT -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>
</div>

<!-- ================= LOGOUT MODAL ================= -->
<div id="logoutModal"
     class="fixed inset-0 bg-black/50 z-50 hidden
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

            <button onclick="closeLogoutModal()"
                    class="px-4 py-2 rounded-lg border text-sm">
                Cancel
            </button>

            <form method="POST" action="/admin/logout">
                @csrf
                <button type="submit"
                        class="px-4 py-2 rounded-lg bg-red-600
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
    from { transform: scale(0.95); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
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

</body>
</html>
