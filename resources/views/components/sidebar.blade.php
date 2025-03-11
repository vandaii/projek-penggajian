<div x-data="{ open: false }" class="h-screen bg-white w-48 shadow-lg">
    <div class="px-4 space-y-2">
        <!-- Logo -->
        <div class="shrink-0 flex items-center pb-4 pt-8">
            <a class="flex items-center" href="{{ route('admin.dashboard') }}">
                <x-logo-gajiku class="block h-9 w-auto fill-current text-gray-900 mr-2" />
                <p class="text-lg font-bold">gajiKU</p>
            </a>
        </div>
        <x-sidebar-link href="/admin/dashboard" :active="request()->routeIs('admin.dashboard') || request()->routeIs('dashboard')">Dashboard</x-sidebar-link>
        @if (Auth::user()->role != 'admin')
            <x-sidebar-link class="hidden" href="{{ route('jabatan.index') }}" :active="request()->routeIs('jabatan.index') ||
                request()->routeIs('jabatan.create') ||
                request()->routeIs('jabatan.edit') ||
                request()->routeIs('jabatan.show')">Jabatan</x-sidebar-link>
            <x-sidebar-link class="hidden" href="{{ route('divisi.index') }}" :active="request()->routeIs('divisi.index') ||
                request()->routeIs('divisi.create') ||
                request()->routeIs('divisi.edit') ||
                request()->routeIs('divisi.show')">Divisi</x-sidebar-link>
            <x-sidebar-link class="hidden" href="{{ route('komponen_gaji.index') }}"
                :active="request()->routeIs('komponen_gaji.index') ||
                    request()->routeIs('komponen_gaji.create') ||
                    request()->routeIs('komponen_gaji.edit') ||
                    request()->routeIs('komponen_gaji.show')">Komponen Gaji</x-sidebar-link>
        @else
            <x-sidebar-link href="{{ route('jabatan.index') }}" :active="request()->routeIs('jabatan.index') ||
                request()->routeIs('jabatan.create') ||
                request()->routeIs('jabatan.edit') ||
                request()->routeIs('jabatan.show')">Jabatan</x-sidebar-link>
            <x-sidebar-link href="{{ route('divisi.index') }}" :active="request()->routeIs('divisi.index') ||
                request()->routeIs('divisi.create') ||
                request()->routeIs('divisi.edit') ||
                request()->routeIs('divisi.show')">Divisi</x-sidebar-link>
            <x-sidebar-link href="{{ route('komponen_gaji.index') }}" :active="request()->routeIs('komponen_gaji.index') ||
                request()->routeIs('komponen_gaji.create') ||
                request()->routeIs('komponen_gaji.edit') ||
                request()->routeIs('komponen_gaji.show')">Komponen Gaji</x-sidebar-link>
        @endif
        <x-sidebar-link href="{{ route('absen.index') }}" :active="request()->routeIs('absen.index') ||
            request()->routeIs('absen.create') ||
            request()->routeIs('absen.edit') ||
            request()->routeIs('absen.show')">Absen</x-sidebar-link>

        <x-sidebar-link href="{{ route('penggajian.index') }}" :active="request()->routeIs('penggajian.index') ||
            request()->routeIs('penggajian.create') ||
            request()->routeIs('penggajian.edit') ||
            request()->routeIs('penggajian.show')">Gaji</x-sidebar-link>
    </div>
</div>
