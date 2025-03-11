<!DOCTYPE html>
<html>

<head>
    <title>Slip Gaji Semua Karyawan</title>
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
    <h2>Slip Gaji Semua Karyawan</h2>
    @foreach ($penggajians as $penggajian)
        @if ($penggajian->user)
            <h3>{{ $penggajian->user->name }}</h3>
            <table>
                <tr>
                    <th>Komponen</th>
                    <th>Jumlah</th>
                </tr>
                <tr>
                    <td>Gaji Pokok</td>
                    <td>{{ number_format($penggajian->komponenGaji->gaji_pokok, 2) }}</td>
                </tr>
                <tr>
                    <td>Tunjangan</td>
                    <td>{{ number_format($penggajian->komponenGaji->tunjangan, 2) }}</td>
                </tr>
                <tr>
                    <td>Potongan</td>
                    <td>{{ number_format($penggajian->komponenGaji->potongan, 2) }}</td>
                </tr>
                <tr>
                    <td>PPH</td>
                    <td>{{ number_format($penggajian->komponenGaji->pph, 2) }}</td>
                </tr>
                <tr>
                    <td>BPJS</td>
                    <td>{{ number_format($penggajian->komponenGaji->bpjs, 2) }}</td>
                </tr>
                <tr>
                    <td>Gaji Bersih</td>
                    <td>{{ number_format($penggajian->gaji_bersih, 2) }}</td>
                </tr>
            </table>
            <hr>
        @endif
    @endforeach
</body>

</html>
