<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="w-full flex justify-center translate-y-10">
        <div class="w-4/6 bg-white p-5 shadow-md">
            <form method="POST" action="{{ route('jabatan.update', $jabatan->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Jabatan')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name', $jabatan->name)" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Gaji Pokok -->
                <div>
                    <x-input-label for="gaji_pokok" :value="__('Gaji Pokok')" />
                    <x-text-input id="gaji_pokok" class="block mt-1 w-full" type="text" name="gaji_pokok"
                        :value="old('gaji_pokok', $jabatan->gaji_pokok)" required autofocus autocomplete="gaji_pokok" />
                    <x-input-error :messages="$errors->get('gaji_pokok')" class="mt-2" />
                </div>

                <!-- Tunjangan -->
                <div>
                    <x-input-label for="tunjangan" :value="__('Tunjangan')" />
                    <x-text-input id="tunjangan" class="block mt-1 w-full" type="text" name="tunjangan"
                        :value="old('tunjangan', $jabatan->tunjangan)" required autofocus autocomplete="tunjangan" />
                    <x-input-error :messages="$errors->get('tunjangan')" class="mt-2" />
                </div>

                <!-- Lembur -->
                <div>
                    <x-input-label for="lembur" :value="__('Lembur')" />
                    <x-text-input id="lembur" class="block mt-1 w-full" type="text" name="lembur"
                        :value="old('lembur', $jabatan->lembur)" required autofocus autocomplete="lembur" />
                    <x-input-error :messages="$errors->get('lembur')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="my-4">
                        {{ __('Edit') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

    </div>

    </x-guest-layout>
