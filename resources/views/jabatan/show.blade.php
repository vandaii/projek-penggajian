<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="px-6 my-6">
        <h2 class="text-2xl font-semibold">Detail Jabatan</h2>
        <div class="mt-4 p-6 bg-white rounded-lg shadow-md">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <h2 class="text-xl font-semibold">Nama Jabatan</h2>
                    <p class="text-gray-600">{{ $jabatan->name }}</p>
                </div>
                <div>
                    <h2 class="text-xl font-semibold">Gaji Pokok</h2>
                    <p class="text-gray-600">Rp. {{ number_format($jabatan->gaji_pokok, 0, ',', '.') }}</p>
                </div>
                <div>
                    <h2 class="text-xl font-semibold">Tunjangan</h2>
                    <p class="text-gray-600">Rp. {{ number_format($jabatan->tunjangan, 0, ',', '.') }}</p>
                </div>
            </div>
            <h4 class="text-md font-semibold mt-6 mb-2">Pengguna dengan Jabatan ini:</h4>
            <table class="w-full bg-white text-left table-auto">
                <tr class="">
                    <th class="py-3 border-b-2 border-t-2">Photo</th>
                    <th class="py-3 border-b-2 border-t-2">Nama</th>
                    <th class="py-1 border-b-2 border-t-2">Email</th>
                    <th class="py-1 border-b-2 border-t-2">Departemen</th>
                    <th class="py-1 border-b-2 border-t-2">Jabatan</th>
                    <th class="py-1 border-b-2 border-t-2">Aksi</th>
                </tr>
                @forelse ($users as $user)
                    <tr>
                        <td class="py-3 border-b-2">
                            <a href="{{ route('karyawan.profile', $user->id) }}">
                                <div class="flex items-center">
                                    @if (!empty($user->image))
                                        <img class="size-9 flex-none rounded-full bg-gray-300"
                                            src="{{ asset('/images/user/' . $user->image) }}" alt="">
                                    @else
                                        <img class="size-9 flex-none rounded-full bg-gray-300"
                                            src="{{ asset('/images/user.png') }}" alt="">
                                    @endif

                                </div>
                            </a>
                        </td>
                        <td class="py-3 border-b-2">{{ $user->name }}</td>
                        <td class="py-3 border-b-2">{{ $user->email }}</td>
                        <td class="py-3 border-b-2">{{ $user->divisi ? $user->divisi->name : 'N/A' }}</td>
                        <td class="py-3 border-b-2">{{ $user->jabatan ? $user->jabatan->name : 'N/A' }}</td>
                        <td class="py-3 border-b-2 flex">
                            <a href="{{ route('karyawan.edit', $user->id) }}">
                                <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z"
                                        stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13"
                                        stroke="#000000" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <p>Tidak ada data</p>
                @endforelse
            </table>
            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('jabatan.index') }}"
                    class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500">Kembali</a>
                <div class="my-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>
