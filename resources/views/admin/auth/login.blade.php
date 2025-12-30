<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Keshoriya</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center
             bg-gradient-to-br from-[#e6efd3] via-[#eef4dd] to-[#d7e6bf]
             font-[Inter]">

    <!-- Login Card -->
    <form method="POST" action="/admin/login"
          class="relative w-full max-w-md
                 bg-white/70 backdrop-blur-xl
                 border border-white/60
                 rounded-3xl shadow-[0_40px_90px_rgba(0,0,0,0.15)]
                 p-10">

        @csrf

        <!-- Logo / Brand -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 mx-auto rounded-full
                        bg-[#1f2d1f] text-white
                        flex items-center justify-center
                        text-xl font-bold shadow-lg">
                K
            </div>
            <h2 class="text-2xl font-bold text-[#1f2d1f] mt-4">
                Admin Login
            </h2>
            <p class="text-sm text-gray-600 mt-1">
                Keshoriya Dashboard
            </p>
        </div>

        <!-- Email -->
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Email Address
            </label>
            <input type="email" name="email" required
                   placeholder="admin@email.com"
                   class="w-full px-5 py-3 rounded-xl
                          bg-white/80 border border-[#c7d7b5]
                          focus:ring-2 focus:ring-[#7db343]
                          focus:outline-none transition">
        </div>

        <!-- Password -->
        <div class="mb-4 relative">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Password
            </label>

            <input id="password"
                   type="password"
                   name="password"
                   required
                   placeholder="••••••••"
                   class="w-full px-5 py-3 rounded-xl
                          bg-white/80 border border-[#c7d7b5]
                          focus:ring-2 focus:ring-[#7db343]
                          focus:outline-none transition pr-12">

            <!-- Show / Hide -->
            <button type="button"
                    onclick="togglePassword()"
                    class="absolute right-4 top-[42px]
                           text-gray-500 hover:text-[#1f2d1f]">
                👁️
            </button>
        </div>

        <!-- Error -->
        @error('email')
            <p class="text-red-600 text-sm mb-4">
                {{ $message }}
            </p>
        @enderror

        <!-- Submit -->
        <button
            class="w-full mt-6
                   bg-[#1f2d1f] hover:bg-[#162016]
                   text-white py-3 rounded-full
                   font-semibold tracking-wide
                   shadow-xl transition-all duration-300
                   hover:scale-[1.02]">
            Login
        </button>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-500 mt-6">
            © {{ date('Y') }} Keshoriya Admin Panel
        </p>

    </form>

    <!-- Password Toggle Script -->
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>

</body>
</html>
