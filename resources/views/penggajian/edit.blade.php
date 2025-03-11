<!-- filepath: /c:/xampp/htdocs/projek_gaji/resources/views/penggajian/edit.blade.php -->
<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Gaji') }}
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

                    <form method="POST" action="{{ route('penggajian.update', $penggajian->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nama Karyawan -->
                        <div>
                            <x-input-label for="user_id" :value="__('Nama Karyawan')" />
                            <select disabled class="block w-full mt-1 rounded-md shadow-sm border-gray-300" name="user_id"
                                id="user_id" onchange="updateGajiTunjangan()">
                                <option value="">Pilih Karyawan</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        data-gaji_pokok="{{ $user->jabatan->gaji_pokok }}"
                                        data-tunjangan="{{ $user->jabatan->tunjangan }}"
                                        data-potongan="{{ $user->jabatan->potongan }}"
                                        data-pph="{{ $user->jabatan->pph }}" data-bpjs="{{ $user->jabatan->bpjs }}"
                                        {{ $penggajian->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- Gaji Pokok -->
                        <div>
                            <x-input-label for="gaji_pokok" :value="__('Gaji Pokok')" />
                            <x-text-input id="gaji_pokok" class="block mt-1 w-full" type="number" name="gaji_pokok"
                                :value="old('gaji_pokok', $penggajian->gaji_pokok)" required autofocus autocomplete="gaji_pokok" />
                            <x-input-error :messages="$errors->get('gaji_pokok')" class="mt-2" />
                        </div>

                        <!-- Tunjangan -->
                        <div>
                            <x-input-label for="tunjangan" :value="__('Tunjangan')" />
                            <x-text-input id="tunjangan" class="block mt-1 w-full" type="number" name="tunjangan"
                                :value="old('tunjangan', $penggajian->tunjangan)" required autofocus autocomplete="tunjangan" />
                            <x-input-error :messages="$errors->get('tunjangan')" class="mt-2" />
                        </div>

                        <!-- Potongan -->
                        <div>
                            <x-input-label for="potongan" :value="__('Potongan')" />
                            <x-text-input id="potongan" class="block mt-1 w-full" type="number" name="potongan"
                                :value="old('potongan', $penggajian->potongan)" required autofocus autocomplete="potongan" />
                            <x-input-error :messages="$errors->get('potongan')" class="mt-2" />
                        </div>

                        <!-- PPH -->
                        <div>
                            <x-input-label for="pph" :value="__('PPH')" />
                            <x-text-input id="pph" class="block mt-1 w-full" type="number" name="pph"
                                :value="old('pph', $penggajian->pph)" required autofocus autocomplete="pph" />
                            <x-input-error :messages="$errors->get('pph')" class="mt-2" />
                        </div>

                        <!-- BPJS -->
                        <div>
                            <x-input-label for="bpjs" :value="__('BPJS')" />
                            <x-text-input id="bpjs" class="block mt-1 w-full" type="number" name="bpjs"
                                :value="old('bpjs', $penggajian->bpjs)" required autofocus autocomplete="bpjs" />
                            <x-input-error :messages="$errors->get('bpjs')" class="mt-2" />
                        </div>

                        <!-- Gaji Bersih -->
                        <div>
                            <x-input-label for="gaji_bersih" :value="__('Gaji Bersih')" />
                            <x-text-input id="gaji_bersih" class="block mt-1 w-full" type="number" name="gaji_bersih"
                                :value="old('gaji_bersih', $penggajian->gaji_bersih)" readonly />
                            <x-input-error :messages="$errors->get('gaji_bersih')" class="mt-2" />
                        </div>

                        <div class="flex justify-end">
                            <x-primary-button class="my-4">
                                {{ __('Simpan') }}
                            </x-primary-button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('penggajian.index') }}" class="text-blue-500 hover:text-blue-700">
                            Kembali ke Daftar Gaji
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('user_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var gajiPokok = selectedOption.getAttribute('data-gaji_pokok') || 0;
            var tunjangan = selectedOption.getAttribute('data-tunjangan') || 0;
            var potongan = selectedOption.getAttribute('data-potongan') || 0;
            var pph = selectedOption.getAttribute('data-pph') || 0;
            var bpjs = selectedOption.getAttribute('data-bpjs') || 0;

            document.getElementById('gaji_pokok').value = gajiPokok;
            document.getElementById('tunjangan').value = tunjangan;
            document.getElementById('potongan').value = potongan;
            document.getElementById('pph').value = pph;
            document.getElementById('bpjs').value = bpjs;

            calculateGajiBersih();
        });

        document.getElementById('potongan').addEventListener('input', calculateGajiBersih);
        document.getElementById('pph').addEventListener('input', calculateGajiBersih);
        document.getElementById('bpjs').addEventListener('input', calculateGajiBersih);

        function calculateGajiBersih() {
            var gajiPokok = parseFloat(document.getElementById('gaji_pokok').value) || 0;
            var tunjangan = parseFloat(document.getElementById('tunjangan').value) || 0;
            var potongan = parseFloat(document.getElementById('potongan').value) || 0;
            var pph = parseFloat(document.getElementById('pph').value) || 0;
            var bpjs = parseFloat(document.getElementById('bpjs').value) || 0;
            var gajiBersih = gajiPokok + tunjangan - pph - bpjs - potongan;

            document.getElementById('gaji_bersih').value = gajiBersih;
        }
    </script>
</x-dashboard-layout>
