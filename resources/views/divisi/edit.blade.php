<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="w-full flex justify-center translate-y-10">
        <div class="w-4/6 bg-white p-5 shadow-md">
            <form method="POST" action="{{ route('divisi.update', $divisi->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama Divisi')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name', $divisi->name)" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Deskripsi -->
                <div>
                    <x-input-label for="deskripsi" :value="__('Deskripsi Divisi')" />
                    <x-text-area id="deskripsi" class="block mt-1 w-full" name="deskripsi" required autofocus
                        autocomplete="deskripsi">{{ old('deskripsi', $divisi->deskripsi) }}</x-text-area>
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
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
