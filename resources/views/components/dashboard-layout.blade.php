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

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        <div class="flex">
            <div class="fixed left-0 z-40">
                {{-- Sidebar --}}
                <x-Sidebar></x-Sidebar>
                <h1>Sidebar</h1>
            </div>

            <div class="flex-1">



                <!-- Page Content -->
                <main class="max-w-6xl ml-48 px-4 py-4 sm:px-6 lg:px-8 bg-gray-100">
                    <div class="z-20">
                        @include('layouts.navigation')
                    </div>
                    <!-- Page Heading -->
                    {{-- <header class="bg-white shadow mb-7">
                        <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $title }}
                        </div>
                    </header> --}}
                    {{ $slot }}
                </main>
            </div>

        </div>



    </div>
</body>

</html>
