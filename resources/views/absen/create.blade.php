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

            <form method="POST" action="{{ route('absen.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="user_id" :value="__('Nama Karyawan')" />
                    <select class="block w-full mt-1 rounded-md shadow-sm border-gray-300" name="user_id" id="user_id">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                </div>

                <!-- Tanggal -->
                <div>
                    <x-input-label for="status" :value="__('Status')" />
                    <x-text-input id="status" class="block mt-1 w-full" type="text" name="status"
                        :value="old('status')" required autofocus autocomplete="status" />
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                </div>

                <!-- Tanggal -->
                <div>
                    <x-input-label for="tanggal" :value="__('Tanggal')" />
                    <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal"
                        :value="old('tanggal')" required autofocus autocomplete="tanggal" />
                    <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                </div>

                <!-- Jam Masuk -->
                <div>
                    <x-input-label for="jam_masuk" :value="__('Jam Masuk')" />
                    <x-text-input id="jam_masuk" class="block mt-1 w-full" type="time" name="jam_masuk"
                        :value="old('jam_masuk')" required autofocus autocomplete="jam_masuk" />
                    <x-input-error :messages="$errors->get('jam_masuk')" class="mt-2" />
                </div>

                <!-- Jam Keluar -->
                <div>
                    <x-input-label for="jam_keluar" :value="__('Jam Keluar')" />
                    <x-text-input id="jam_keluar" class="block mt-1 w-full" type="time" name="jam_keluar"
                        :value="old('jam_keluar')" required autofocus autocomplete="jam_keluar" />
                    <x-input-error :messages="$errors->get('jam_keluar')" class="mt-2" />
                </div>

                {{-- Keterangan --}}
                <div>
                    <x-input-label for="keterangab" :value="__('Keterangan')" />
                    <x-text-input id="keterangab" class="block mt-1 w-full" type="text" name="keterangab"
                        :value="old('keterangab')" required autofocus autocomplete="keterangab" />
                    <x-input-error :messages="$errors->get('keterangab')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="my-4">
                        {{ __('Absen') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

    </div>

    </x-guest-layout>
