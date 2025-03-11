<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="w-full flex justify-center translate-y-10">
        <div class="w-4/6 bg-white p-5 shadow-md">

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

            <form method="POST" action="{{ route('komponen_gaji.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="user_id" :value="__('Nama Karyawan')" />
                    <select class="block w-full mt-1 rounded-md shadow-sm border-gray-300" name="user_id" id="user_id">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" data-jabatan="{{ $user->jabatan->name }}"
                                data-gaji_pokok="{{ $user->jabatan->gaji_pokok }}"
                                data-tunjangan="{{ $user->jabatan->tunjangan }}" data-bpjs="{{ $user->bpjs->nominal }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                </div>

                <!-- Gaji Pokok -->
                <div>
                    <x-input-label for="gaji_pokok" :value="__('Gaji Pokok')" />
                    <x-text-input id="gaji_pokok" class="block mt-1 w-full" type="number" name="gaji_pokok"
                        :value="old('gaji_pokok')" required readonly autofocus autocomplete="gaji_pokok" />
                    <x-input-error :messages="$errors->get('gaji_pokok')" class="mt-2" />
                </div>

                <!-- Tunjangan -->
                <div>
                    <x-input-label for="tunjangan" :value="__('Tunjangan')" />
                    <x-text-input id="tunjangan" class="block mt-1 w-full" type="number" name="tunjangan"
                        :value="old('tunjangan')" required readonly autofocus autocomplete="tunjangan" />
                    <x-input-error :messages="$errors->get('tunjangan')" class="mt-2" />
                </div>
                <!-- Potongan -->
                <div>
                    <x-input-label for="potongan" :value="__('Potongan')" />
                    <x-text-input id="potongan" class="block mt-1 w-full" type="number" name="potongan"
                        :value="old('potongan')" required autofocus autocomplete="potongan" />
                    <x-input-error :messages="$errors->get('potongan')" class="mt-2" />
                </div>
                <!-- PPH -->
                <div>
                    <x-input-label for="pph" :value="__('PPh')" />
                    <x-text-input id="pph" class="block mt-1 w-full" type="number" name="pph"
                        :value="old('pph')" required autofocus autocomplete="pph" />
                    <x-input-error :messages="$errors->get('pph')" class="mt-2" />
                </div>
                <!-- BPJS -->
                <div>
                    <x-input-label for="bpjs" :value="__('Potongan BPJS')" />
                    <x-text-input id="bpjs" class="block mt-1 w-full" type="number" name="bpjs"
                        :value="old('bpjs')" required autofocus autocomplete="bpjs" />
                    <x-input-error :messages="$errors->get('bpjs')" class="mt-2" />
                </div>
                <!-- Gaji Bersih -->
                <div>
                    <x-input-label for="gaji_bersih" :value="__('Gaji Bersih')" />
                    <x-text-input id="gaji_bersih" class="block mt-1 w-full" type="number" name="gaji_bersih"
                        :value="old('gaji_bersih')" required readonly autofocus autocomplete="gaji_bersih" />
                    <x-input-error :messages="$errors->get('gaji_bersih')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="my-4">
                        {{ __('Tambah') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

    </div>

        <script>
            document.getElementById('user_id').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var gajiPokok = selectedOption.getAttribute('data-gaji_pokok');
                var tunjangan = selectedOption.getAttribute('data-tunjangan');
                var bpjs = selectedOption.getAttribute('data-bpjs');
                var pph = gajiPokok * 0.1;

                document.getElementById('gaji_pokok').value = gajiPokok;
                document.getElementById('tunjangan').value = tunjangan;
                document.getElementById('pph').value = pph;
                document.getElementById('bpjs').value = bpjs;

                calculateGajiBersih();
            });

            document.getElementById('potongan').addEventListener('input', calculateGajiBersih);
            // document.getElementById('pph').addEventListener('input', calculateGajiBersih);
            // document.getElementById('bpjs').addEventListener('input', calculateGajiBersih);

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

    </x-dasboard-layout>
