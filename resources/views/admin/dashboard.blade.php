<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:link>{{ $link }}</x-slot:link>
    <div class="bg-white py-4 px-2 translate-y-10 rounded-xl shadow-md">
        <div class="mb-3">
            <h1 class="font-bold">List Karyawan</h1>
        </div>
        <div class="flex justify-between items-center">
            <div
                class="flex items-center rounded-md bg-white outline-1 -outline-offset-1 outline-gray-300 has-[input:focus-within]:outline-2 has-[input:focus-within]:-outline-offset-2 has-[input:focus-within]:outline-indigo-600">
                <div
                    class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6 shadow-sm rounded-2xl border-2 flex items-center px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="block h-4 w-auto fill-current text-gray-400"
                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                        <path
                            d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                    </svg>
                    <form class="" role="search" action="{{ route('admin.dashboard') }}" method="GET">
                        <input
                            class="block min-w-0 grow py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 sm:text-sm/6 border-none focus:outline-hidden rounded-2xl translate-x-3"
                            type="search" placeholder="Cari Karyawan" aria-label="Search" name="search"
                            value="{{ request()->query('search') }}" id="searchInput">
                        <button hidden class="btn btn-outline-light" type="submit">Cari</button>
                    </form>
                </div>
            </div>
            <a href="{{ route('karyawan.create') }}"
                class="px-3 py-2 mb-3 max-w-fit bg-indigo-500 text-white rounded-md text-base hover:bg-indigo-400">Tambah
                karyawan</a>
        </div>
        <table class="w-full bg-white text-left table-auto">
            <tr class="">
                <th class="py-3 border-b-2 border-t-2">Photo</th>
                <th class="py-3 border-b-2 border-t-2">Nama</th>
                <th class="py-3 border-b-2 border-t-2">Jenis Kelamin</th>
                <th class="py-1 border-b-2 border-t-2">Email</th>
                <th class="py-1 border-b-2 border-t-2">No. Handphone</th>
                <th class="py-1 border-b-2 border-t-2">Alamat</th>
                <th class="py-1 border-b-2 border-t-2">BPJS</th>
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
                    <td class="py-3 border-b-2">{{ $user->jenis_kelamin ? $user->jenis_kelamin : 'N/A' }}</td>
                    <td class="py-3 border-b-2">{{ $user->email }}</td>
                    <td class="py-3 border-b-2">{{ $user->no_hp ? $user->no_hp : 'N/A' }}</td>
                    <td class="py-3 border-b-2">{{ $user->alamat ? $user->alamat : 'N/A' }}</td>
                    <td class="py-3 border-b-2">{{ $user->bpjs ? $user->bpjs->name : 'N/A' }}</td>
                    <td class="py-3 border-b-2">{{ $user->divisi ? $user->divisi->name : 'N/A' }}</td>
                    <td class="py-3 border-b-2">{{ $user->jabatan ? $user->jabatan->name : 'N/A' }}</td>
                    <td class="py-3 border-b-2 flex">
                        <a href="{{ route('karyawan.edit', $user->id) }}">
                            <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                            <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                            action="{{ route('karyawan.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4 7H20" stroke="#ff3333" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M6 10L7.70141 19.3578C7.87432 20.3088 8.70258 21 9.66915 21H14.3308C15.2974 21 16.1257 20.3087 16.2986 19.3578L18 10"
                                        stroke="#ff3333" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
                                        stroke="#ff3333" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <p>Tidak ada data</p>
            @endforelse
        </table>
        <div class="my-4">
            {{ $users->links() }}
        </div>
    </div>
</x-dashboard-layout>
