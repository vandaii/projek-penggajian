<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:link>{{ $link }}</x-slot:link>
    <div class="w-full flex justify-center translate-y-10">
        <div class="w-4/6 bg-white p-5 shadow-md">
            <form method="POST" action="{{ route('karyawan.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Image -->
                <div>
                    <x-input-label for="image" :value="__('Foto Profil')" />
                    <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')"
                        required />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                        :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                    <select class="block w-full mt-1 rounded-md shadow-sm border-gray-300" name="jenis_kelamin"
                        id="jenis_kelamin">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                    <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
                </div>

                <!-- BPJS -->
                <div>
                    <x-input-label for="bpjs_id" :value="__('BPJS')" />
                    <select class="block w-full mt-1 rounded-md shadow-sm border-gray-300" name="bpjs_id"
                        id="bpjs_id">
                        @foreach ($bpjss as $bpjs)
                            <option value="{{ $bpjs->id }}">{{ $bpjs->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('bpjs_id')" class="mt-2" />
                </div>

                <!-- Jabatan -->
                <div>
                    <x-input-label for="jabatan_id" :value="__('Jabatan')" />
                    <select class="block w-full mt-1 rounded-md shadow-sm border-gray-300" name="jabatan_id"
                        id="jabatan_id">
                        @foreach ($jabatans as $jabatan)
                            <option value="{{ $jabatan->id }}">{{ $jabatan->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('jabatan_id')" class="mt-2" />
                </div>

                <!-- Divisi -->
                <div>
                    <x-input-label for="divisi_id" :value="__('Divisi')" />
                    <select class="block w-full mt-1 rounded-md shadow-sm border-gray-300" name="divisi_id"
                        id="divisi_id">
                        @foreach ($divisis as $divisi)
                            <option value="{{ $divisi->id }}">{{ $divisi->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('divisi_id')" class="mt-2" />
                </div>

                <!-- Alamat -->
                <div>
                    <x-input-label for="alamat" :value="__('Alamat')" />
                    <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat"
                        :value="old('alamat')" required autofocus autocomplete="alamat" />
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                </div>

                <!-- No Handphone -->
                <div>
                    <x-input-label for="no_hp" :value="__('No. Handphone')" />
                    <x-text-input id="no_hp" class="block mt-1 w-full" type="number" name="no_hp"
                        :value="old('no_hp')" required autofocus autocomplete="no_hp" />
                    <x-input-error :messages="$errors->get('no_hp')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex justify-end">
                    <x-primary-button class="my-4">
                        {{ __('Tambah') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

    </div>

    </x-guest-layout>
