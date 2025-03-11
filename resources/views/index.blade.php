<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

</head>

<body class="font-sans antialiased bg-gray-100 min-h-screen h-screen">
    <nav>
        <div class="flex justify-between py-3 px-5">
            <a href="/" class="flex items-center space-x-2">
                <x-logo-gajiku class="w-10 h-10" />
                <p class="text-lg font-bold">gajiKu</p>
            </a>
            @if (Route::has('login'))
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ url('/admin/dashboard') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white bg-indigo-600">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-gray-800 dark:hover:text-gray/80 dark:focus-visible:ring-gray-800">
                            Log in
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <main>
        <div class="flex justify-around items-center translate-y-1/2">
            <div class="space-y-2">
                <h1c class="text-5xl font-extrabold w-1/2">Selamat Datang di gajiKu</h1c>
                <h2 class="text-3xl w-5/6">Teman baik awal bulanmu yang ditunggu-tunggu</h2>
            </div>
            <img src="{{ asset('images/asset/GajiKU.png') }}" class="w-2/6" alt="image">
        </div>
    </main>
</body>

</html>
