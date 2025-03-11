<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="bg-white py-4 px-2 translate-y-10 rounded-xl shadow-md">
        <div class="p-6 bg-white border-b border-gray-200">

            <div class="mb-3">
                <h1 class="font-bold">Gaji</h1>
            </div>

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

            <div class="flex justify-between items-center mb-4">
                <form method="GET" action="{{ route('penggajian.index') }}" class="mb-4">
                    <div class="flex items-center">
                        <div class="mr-4">
                            <label for="month" class="block text-sm font-medium text-gray-700">Bulan</label>
                            <select name="month" id="month"
                                class="block w-full mt-1 rounded-md shadow-sm border-gray-300">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                                        {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="mr-4">
                            <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
                            <select name="year" id="year"
                                class="block w-full mt-1 rounded-md shadow-sm border-gray-300">
                                @for ($y = \Carbon\Carbon::now()->year; $y >= 2000; $y--)
                                    <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                                        {{ $y }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        <div class="mt-6">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-400">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>

                @if (Auth::user()->role == 'admin')
                    <div class="mt-4">
                        {{-- <a href="{{ route('penggajian.slipGajiSemua') }}"
                            class="px-4 py-3 bg-indigo-500 text-white rounded-md hover:bg-indigo-400 mr-4">
                            Download PDF
                        </a> --}}
                        <a href="{{ route('penggajian.gajiSemua') }}"
                            class="px-4 py-3 bg-indigo-500 text-white rounded-md hover:bg-indigo-400">
                            Gaji Semua
                        </a>
                    </div>
                @else
                    <div hidden class="mt-4">
                        {{-- <a href="{{ route('penggajian.slipGajiSemua') }}"
                            class="px-4 py-3 bg-indigo-500 text-white rounded-md hover:bg-indigo-400">
                            Download PDF
                        </a> --}}
                        <a href="{{ route('penggajian.gajiSemua') }}"
                            class="px-4 py-3 bg-indigo-500 text-white rounded-md hover:bg-indigo-400">
                            Gaji Semua
                        </a>
                    </div>
                @endif

            </div>

            <table class="w-full bg-white text-left table-auto">
                <tr>
                    <th class="py-3 border-b-2 border-t-2">Nama</th>
                    <th class="py-3 border-b-2 border-t-2">Jabatan</th>
                    <th class="py-3 border-b-2 border-t-2">Gaji Pokok</th>
                    <th class="py-3 border-b-2 border-t-2">Tunjangan</th>
                    <th class="py-3 border-b-2 border-t-2">Total Potongan</th>
                    <th class="py-3 border-b-2 border-t-2">Total Gaji</th>
                    <th class="py-3 border-b-2 border-t-2">Status</th>
                    <th class="py-3 border-b-2 border-t-2">Aksi</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td class="py-3 border-b-2">{{ $user->name }}</td>
                        <td class="py-3 border-b-2">{{ $user->jabatan->name }}</td>
                        <td class="py-3 border-b-2">
                            {{ number_format($user->jabatan->gaji_pokok, 2) }}</td>
                        <td class="py-3 border-b-2">
                            {{ number_format($user->jabatan->tunjangan, 2) }}</td>
                        <td class="py-3 border-b-2">
                            {{ number_format($user->total_potongan, 2) }}</td>
                        <td class="py-3 border-b-2">
                            @if (isset($penggajians[$user->id]))
                                {{ number_format($penggajians[$user->id]->gaji_bersih, 2) }}
                            @else
                                {{ number_format($user->total_gaji, 2) }}
                            @endif
                        </td>
                        <td class="py-3 border-b-2">
                            @if (isset($penggajians[$user->id]))
                                <p class="text-green-600">Digaji</p>
                            @else
                                Belum Digaji
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if (Auth::user()->role != 'admin')
                                @if (!isset($penggajians[$user->id]))
                                    <a hidden href="{{ route('penggajian.gajiKaryawan', $user->id) }}"
                                        class="text-blue-500 hover:text-blue-700">Gaji</a>
                                @endif
                            @else
                                @if (!isset($penggajians[$user->id]))
                                    <a href="{{ route('penggajian.gajiKaryawan', $user->id) }}"
                                        class="text-blue-500 hover:text-blue-700">Gaji</a>
                                @endif
                            @endif
                            @if (isset($penggajians[$user->id]))
                                <a href="{{ route('penggajian.slipGaji', $user->id) }}"
                                    class="text-blue-500 hover:text-blue-700">PDF</a>
                            @else
                                <a hidden href="{{ route('penggajian.slipGaji', $user->id) }}"
                                    class="text-blue-500 hover:text-blue-700">PDF</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>

            <div class="my-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-dashboard-layout>
