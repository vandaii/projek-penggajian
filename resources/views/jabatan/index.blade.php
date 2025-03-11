<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <div class="bg-white py-4 px-2 translate-y-10 rounded-xl shadow-md">
        <div class="mb-3">
            <h1 class="font-bold">List Jabatan</h1>
        </div>
        <div class="flex justify-end items-center">
            <a href="{{ route('jabatan.create') }}"
                class="px-3 py-2 mb-3 max-w-fit bg-indigo-500 text-white rounded-md text-base hover:bg-indigo-400">Tambah
                Jabatan</a>
        </div>
        <table class="w-full bg-white text-left table-auto">
            <tr class="">
                <th class="py-3 border-b-2 border-t-2">Nama Jabatan</th>
                <th class="py-3 border-b-2 border-t-2">Gaji Pokok</th>
                <th class="py-1 border-b-2 border-t-2">Tunjangan</th>
                <th class="py-1 border-b-2 border-t-2">Aksi</th>
            </tr>
            @forelse ($jabatans as $jabatan)
                <tr>
                    <td class="py-3 border-b-2">{{ $jabatan->name }}</td>
                    <td class="py-3 border-b-2">
                        <p>Rp. {{ number_format($jabatan->gaji_pokok, 0, ',', '.') }}</p>
                    </td>
                    <td class="py-3 border-b-2">
                        <p>Rp. {{ number_format($jabatan->tunjangan, 0, ',', '.') }}</p>
                    </td>
                    <td class="py-3 border-b-2 flex">
                        <a href="{{ route('jabatan.show', $jabatan->id) }}">
                            <?xml version="1.0" encoding="utf-8"?>
                            <!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                            <svg class="h-7 w-7" width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="Edit / Show">
                                    <g id="Vector">
                                        <path
                                            d="M3.5868 13.7788C5.36623 15.5478 8.46953 17.9999 12.0002 17.9999C15.5308 17.9999 18.6335 15.5478 20.413 13.7788C20.8823 13.3123 21.1177 13.0782 21.2671 12.6201C21.3738 12.2933 21.3738 11.7067 21.2671 11.3799C21.1177 10.9218 20.8823 10.6877 20.413 10.2211C18.6335 8.45208 15.5308 6 12.0002 6C8.46953 6 5.36623 8.45208 3.5868 10.2211C3.11714 10.688 2.88229 10.9216 2.7328 11.3799C2.62618 11.7067 2.62618 12.2933 2.7328 12.6201C2.88229 13.0784 3.11714 13.3119 3.5868 13.7788Z"
                                            stroke="#000000" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M10 12C10 13.1046 10.8954 14 12 14C13.1046 14 14 13.1046 14 12C14 10.8954 13.1046 10 12 10C10.8954 10 10 10.8954 10 12Z"
                                            stroke="#000000" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </g>
                                </g>
                            </svg>
                        </a>
                        <a href="{{ route('jabatan.edit', $jabatan->id) }}">
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
                            action="{{ route('jabatan.destroy', $jabatan->id) }}" method="POST">
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
                <p class="font-bold">Tidak ada data</p>
            @endforelse
        </table>
    </div>
</x-dashboard-layout>
