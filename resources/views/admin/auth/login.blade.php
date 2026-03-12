<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css'])
    <style>
    :root {
        --button: {{ $settings['button_color'] ?? '#1f2d1f' }};
    }
    </style>
        <style>
    :root {
        --brand-bg: {{ $settings['background_color'] ?? '#efddd3cd' }};
    }
    </style>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen flex items-center justify-center bg-brand text-brand">

    <!-- Login Card -->
    <form method="POST" action="/admin/login"
        class="relative w-full
                max-w-full sm:max-w-lg md:max-w-md
                mx-4 sm:mx-0
                bg-white/80 backdrop-blur-xl
                border border-white/60
                rounded-2xl sm:rounded-3xl
                shadow-[0_30px_80px_rgba(0,0,0,0.15)]
                px-6 py-8 sm:p-10">


        @csrf

        <!-- Brand -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 sm:w-16 sm:h-16 mx-auto rounded-full
                        bg-primary text-white
                        flex items-center justify-center
                        text-xl sm:text-2xl font-bold shadow-lg">
                <i class="fa-solid fa-shield-halved"></i>
            </div>

            <h2 class="text-2xl font-bold text-primary mt-4">
                Admin Login
            </h2>

            <p class="text-sm text-gray-600 mt-1">
                {{ config('app.name') }} Dashboard
            </p>
        </div>

        <!-- Email -->
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Email Address
            </label>

            <div class="relative">
                <i class="fa-solid fa-envelope
                          absolute left-4 top-1/2 -translate-y-1/2
                          text-gray-400"></i>

                <input type="email" name="email" required
                       placeholder="admin@email.com"
                       class="w-full pl-12 pr-5 py-3 rounded-xl
                              bg-white/80 border border-[#c7d7b5]
                              focus:ring-2 ring-accent
                              focus:outline-none transition">
            </div>
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Password
            </label>

            <div class="relative">
                <i class="fa-solid fa-lock
                          absolute left-4 top-1/2 -translate-y-1/2
                          text-gray-400"></i>

                <input id="password"
                       type="password"
                       name="password"
                       required
                       placeholder="••••••••"
                       class="w-full pl-12 pr-12 py-3 rounded-xl
                              bg-white/80 border border-[#c7d7b5]
                              focus:ring-2 ring-accent
                              focus:outline-none transition">

                <button type="button"
                        onclick="togglePassword()"
                        class="absolute right-4 top-1/2 -translate-y-1/2
                               text-gray-500 hover:text-primary">
                    <i id="eyeIcon" class="fa-solid fa-eye"></i>
                </button>
            </div>
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
                   bg-primary hover:bg-primary-dark
                   text-white py-3 rounded-full
                   font-semibold tracking-wide
                   shadow-xl transition-all duration-300
                   hover:scale-[1.02] flex items-center justify-center gap-2">
            <i class="fa-solid fa-right-to-bracket"></i>
            Login
        </button>

        <!-- Footer -->
        <p class="text-center text-xs text-gray-500 mt-6">
            © {{ date('Y') }} {{ config('app.name') }} Admin Panel
        </p>

    </form>

    <!-- Password Toggle -->
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>
</html>
