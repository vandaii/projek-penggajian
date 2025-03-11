<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Absen') }}
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

                    @if ($absen)
                        <form method="POST" action="{{ route('absen.update', $absen->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Nama -->
                            <div>
                                <x-input-label for="user_id" :value="__('Nama')" />
                                <select id="user_id" name="user_id" class="block mt-1 w-full" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $user->id == $absen->user_id ? 'selected' : '' }}>{{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                            </div>

                            <!-- Status -->
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <x-text-input id="status" class="block mt-1 w-full" type="text" name="status"
                                    :value="old('status', $absen->status)" required autofocus autocomplete="status" />
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>

                            <!-- Tanggal -->
                            <div>
                                <x-input-label for="tanggal" :value="__('Tanggal')" />
                                <x-text-input id="tanggal" class="block mt-1 w-full" type="date" name="tanggal"
                                    :value="old('tanggal', $absen->tanggal)" required autofocus autocomplete="tanggal" />
                                <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                            </div>

                            <!-- Jam Masuk -->
                            <div>
                                <x-input-label for="jam_masuk" :value="__('Jam Masuk')" />
                                <x-text-input id="jam_masuk" class="block mt-1 w-full" type="time" name="jam_masuk"
                                    :value="old('jam_masuk', $absen->jam_masuk)" required autofocus autocomplete="jam_masuk" />
                                <x-input-error :messages="$errors->get('jam_masuk')" class="mt-2" />
                            </div>

                            <!-- Jam Keluar -->
                            <div>
                                <x-input-label for="jam_keluar" :value="__('Jam Keluar')" />
                                <x-text-input id="jam_keluar" class="block mt-1 w-full" type="time" name="jam_keluar"
                                    :value="old('jam_keluar', $absen->jam_keluar)" required autofocus autocomplete="jam_keluar" />
                                <x-input-error :messages="$errors->get('jam_keluar')" class="mt-2" />
                            </div>

                            <!-- Keterangan -->
                            <div>
                                <x-input-label for="keterangan" :value="__('Keterangan')" />
                                <x-text-input id="keterangan" class="block mt-1 w-full" type="text" name="keterangan"
                                    :value="old('keterangan', $absen->keterangan)" autofocus autocomplete="keterangan" />
                                <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                            </div>

                            <div class="flex justify-end">
                                <x-primary-button class="my-4">
                                    {{ __('Simpan') }}
                                </x-primary-button>
                            </div>
                        </form>
                    @else
                        <div class="text-red-600">
                            {{ __('Data absen tidak ditemukan.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
