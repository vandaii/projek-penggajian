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

<body class="min-h-screen bg-gray-100">
    <div class="z-20 sticky top-0">
        @include('layouts.navigation')
    </div>
    <main class="w-11/12 bg-white mx-auto my-10 border-2  rounded-lg shadow-md">
        <x-slot:title>{{ $title }}</x-slot:title>
        <div class="flex justify-between items-center p-6">
            <div class="flex items-center space-x-2">
                @if (!empty($user->image))
                    <img class="size-20 flex-none rounded-full bg-gray-300"
                        src="{{ asset('/images/user/' . $user->image) }}" alt="">
                @else
                    <img class="size-20 flex-none rounded-full bg-gray-300" src="{{ asset('/images/user.png') }}"
                        alt="">
                @endif
                <div>
                    <h1 class="font-black text-4xl/7">{{ $user->name }}</h1>
                    <h2 class="text-lg text-gray-400">{{ $user->email }}</h2>
                </div>
            </div>
            <a href="{{ route('profile.edit') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white bg-indigo-600 h-fit">
                Edit Profile
            </a>
        </div>
        <div class="grid grid-flow-col grid-rows-3">
            <div class="row-span-3 mt-5 p-6 border-y-2 border-r-2">
                <div>
                    <h1 class="text-lg font-semibold">Nomor Handphone</h1>
                    <p class="text-gray-600">{{ $user->no_hp ? $user->no_hp : 'N/A' }}</p>
                </div>
                <div>
                    <h1 class="text-lg font-semibold">Alamat</h1>
                    <p class="text-gray-600">{{ $user->alamat ? $user->alamat : 'N/A' }}</p>
                </div>
                <div>
                    <h1 class="text-lg font-semibold">Jabatan</h1>
                    <p class="text-gray-600">{{ $user->jabatan ? $user->jabatan->name : 'N/A' }}</p>
                </div>
                <div>
                    <h1 class="text-lg font-semibold">Divisi</h1>
                    <p class="text-gray-600">{{ $user->divisi ? $user->divisi->name : 'N/A' }}</p>
                </div>
            </div>
            <div class="col-span-2 px-4 mt-5 py-4 border-t-2">
                <h1 class="text-xl font-medium">Riwayat Gaji</h1>
            </div>
            <div class="col-span-2 row-span-2 px-4 py-4 border-b-2">3</div>
        </div>
        <div class="flex m-5 justify-end items-center">
            <a href="{{ route('admin.dashboard') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white bg-indigo-600 h-fit">
                Kembali
            </a>
        </div>
    </main>
</body>

</html>
