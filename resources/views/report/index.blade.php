<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <img src="" width="100" height="100" alt="Lambang Kota Cimahi">
    <h2>Laporan Pengaduan Masyarakat Kota Cimahi</h2>

    <table>
        <tbody>
            <tr>
                <td>Periode</td>
                <td>:</td>
                {{-- <td>{{ $ghazwanAllData }}</td> --}}
            </tr>
            <tr>
                <td>Penyusun</td>
                <td>:</td>
                <td>Tim Pengaduan Masyarakat</td>
            </tr>
            <tr>
                <td>Wilayah</td>
                <td>:</td>
                <td>Kota Cimahi</td>
            </tr>
        </tbody>
    </table>

    <br>

    <h3>I. Pendahuluan</h3>
    <p>Laporan ini disusun berdasarkan data pengaduan yang masuk ke dalam sistem pengaduan masyarakat Kota Cimahi. Data
        tersebut diolah dan disajikan dalam bentuk tabel untuk memudahkan pemahaman dan analisis.</p>

    <h3>II. Hasil Pengaduan</h3>

    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Belum Selesai</th>
                <th>Sedang Proses</th>
                <th>Selesai</th>
            </tr>
        </thead>
        <tbody>
            @dd($statuses)
            @foreach ($statuses as $item)
                <tr>
                    {{-- <td>{{ $item->tgl_pengaduan }}</td> --}}
                    {{-- <td>{{ $item-> }}</td> --}}
                    <td>{{ $item->proses }}</td>
                    <td>{{ $item->selesai }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>III. Penutup</h3>
    <p>Laporan ini disusun untuk memenuhi tugas kelompok dan dapat digunakan sebagai acuan dalam menangani masalah
        pengaduan masyarakat Kota Cimahi.</p>

    <br>

    <div style="float: right; text-align: right;">
        <p>Cimahi, {{ date('d F Y') }}</p>
        <p>Tim Pengaduan Masyarakat Kota Cimahi</p>
        <br>
        <br>
        <p>_</p>
    </div>

</body>

</html>
