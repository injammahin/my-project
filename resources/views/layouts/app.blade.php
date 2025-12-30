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

    <!-- Top Bar -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">Admin Panel</h1>

            <form method="POST" action="/admin/logout">
                @csrf
                <button class="text-red-600 font-medium hover:underline">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- Page Content -->
    <main class="py-6">
        @yield('content')
    </main>

</body>
</html>
