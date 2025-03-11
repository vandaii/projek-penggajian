<!-- filepath: /c:/xampp/htdocs/projek_gaji/resources/views/penggajian/show.blade.php -->
<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Penggajian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Alert for session messages -->
                    @if (session('success'))
                        <div class="mb-4 text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 text-sm text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold mb-4">{{ $penggajian->user->name }}</h3>
                    <p><strong>Jabatan:</strong> {{ $penggajian->user->jabatan->name }}</p>
                    <p><strong>Gaji Pokok:</strong> {{ number_format($penggajian->gaji_pokok, 2) }}</p>
                    <p><strong>Tunjangan:</strong> {{ number_format($penggajian->tunjangan, 2) }}</p>
                    <p><strong>Potongan:</strong> {{ number_format($penggajian->potongan, 2) }}</p>
                    <p><strong>PPH:</strong> {{ number_format($penggajian->pph, 2) }}</p>
                    <p><strong>BPJS:</strong> {{ number_format($penggajian->bpjs, 2) }}</p>
                    <p><strong>Gaji Bersih:</strong> {{ number_format($penggajian->gaji_bersih, 2) }}</p>
                    <p><strong>Tanggal:</strong> {{ $penggajian->tanggal->format('d-m-Y') }}</p>

                    <div class="mt-4">
                        <a href="{{ route('penggajian.index') }}" class="text-blue-500 hover:text-blue-700">
                            Kembali ke Daftar Gaji
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
