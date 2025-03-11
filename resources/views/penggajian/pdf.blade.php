<!DOCTYPE html>
<html>

<head>
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <header class="mb-5 border-b-4 pb-2">
        <div class="flex justify-center items-center">
            <x-logo-gajiku class="block h-40 w-auto fill-current text-gray-900 mr-2" />
            <div class="flex-1 text-center">
                <h1 class="font-bold text-3xl">Slip Gaji</h1>
                <p>
                    Jl. Barokah No. 6
                </p>
                <p>Telp. 081208120812</p>
            </div>
        </div>
    </header>
    @if (isset($penggajians))
        @foreach ($penggajians as $penggajian)
            <table class="table-auto">
                <tr>
                    <td>Nama</td>
                    <td class="px-2">:</td>
                    <td>{{ $penggajian->user->name }}</td>
                </tr>
                <tr>
                    <td>Divisi/Jabatan</td>
                    <td class="px-2">:</td>
                    <td>{{ $penggajian->user->divisi->name }}/{{ $penggajian->user->jabatan->name }}</td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>Komponen</th>
                    <th>Jumlah</th>
                </tr>
                <tr>
                    <td>Gaji Pokok</td>
                    <td>{{ number_format($penggajian->gaji_pokok, 2) }}</td>
                </tr>
                <tr>
                    <td>Tunjangan</td>
                    <td>{{ number_format($penggajian->tunjangan, 2) }}</td>
                </tr>
                <tr>
                    <td>Potongan</td>
                    <td>{{ number_format($penggajian->potongan, 2) }}</td>
                </tr>
                <tr>
                    <td>PPH</td>
                    <td>{{ number_format($penggajian->pph, 2) }}</td>
                </tr>
                <tr>
                    <td>BPJS</td>
                    <td>{{ number_format($penggajian->bpjs, 2) }}</td>
                </tr>
                <tr>
                    <td>Gaji Bersih</td>
                    <td>{{ number_format($penggajian->gaji_bersih, 2) }}</td>
                </tr>
            </table>
            <hr>
        @endforeach
    @elseif(isset($penggajian))
        <table class="table-auto">
            <tr>
                <td>Nama</td>
                <td class="px-2">:</td>
                <td>{{ $penggajian->user->name }}</td>
            </tr>
            <tr>
                <td>Divisi/Jabatan</td>
                <td class="px-2">:</td>
                <td>{{ $penggajian->user->divisi->name }}/{{ $penggajian->user->jabatan->name }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th>Komponen</th>
                <th>Jumlah</th>
            </tr>
            <tr>
                <td>Gaji Pokok</td>
                <td>{{ number_format($penggajian->gaji_pokok, 2) }}</td>
            </tr>
            <tr>
                <td>Tunjangan</td>
                <td>{{ number_format($penggajian->tunjangan, 2) }}</td>
            </tr>
            <tr>
                <td>Potongan</td>
                <td>{{ number_format($penggajian->potongan, 2) }}</td>
            </tr>
            <tr>
                <td>PPH</td>
                <td>{{ number_format($penggajian->pph, 2) }}</td>
            </tr>
            <tr>
                <td>BPJS</td>
                <td>{{ number_format($penggajian->bpjs, 2) }}</td>
            </tr>
            <tr>
                <td>Gaji Bersih</td>
                <td>{{ number_format($penggajian->gaji_bersih, 2) }}</td>
            </tr>
        </table>
    @endif
</body>

</html>

<body class="bg-gray-100 font-serif p-5">
    <header class="mb-5 border-b-4 pb-2">
        <div class="flex justify-center items-center">
            <img class="w-40 h-40 border-2 flex-none" src="" alt="Logo Perusahaan" />
            <div class="flex-1 text-center">
                <h1 class="font-bold text-3xl">Indocement</h1>
                <p>
                    Jl.H.R.Rasuna Said Blok X-5 Kav. 02/03 Jakarta 12950 PO BOX 5032
                    JKTM Jakarta 12700
                </p>
                <p>Telp. 081208120812</p>
            </div>
        </div>
    </header>
    <table class="table-auto">
        <tr>
            <td>Nama</td>
            <td class="px-2">:</td>
            <td>Agustina Wongkojoyo</td>
        </tr>
        <tr>
            <td>Divisi/Jabatan</td>
            <td class="px-2">:</td>
            <td>Gudang/Karyawan</td>
        </tr>
    </table>
    <table class="mt-8 w-full text-left">
        <thead>
            <tr class="bg-gray-300">
                <th class="font-bold text-xl">Pendapatan</th>
                <th class="font-bold text-xl">Potongan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="pr-5 flex flex-col justify-start">
                    <div class="flex justify-between">
                        <p>Gaji Pokok</p>
                        <p>{{ number_format($penggajian->gaji_pokok, 2) }}</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Tunjangan</p>
                        <p>500.000</p>
                    </div>
                </td>
                <td class="pr-2">
                    <div class="flex justify-between">
                        <p>Gaji Pokok</p>
                        <p>7.000.000,00</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Tunjangan</p>
                        <p>500.000</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Gaji Pokok</p>
                        <p>7.000.000,00</p>
                    </div>
                    <div class="flex justify-between">
                        <p>Tunjangan</p>
                        <p>500.000</p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>
