<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-size: 0.9rem;
            margin: 20px 40px;
            /* Memberikan margin di sekitar halaman */
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #eaeaea;
            font-weight: bold;
        }

        h2,
        h3 {
            margin-bottom: 15px;
        }

        img {
            display: block;
            margin: 0 auto;
        }

        p {
            text-align: justify;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="bungkusan">
        <h2>Rekapitulasi Laporan Pengaduan Masyarakat</h2>

    </div>

    <table>
        <tbody>
            <tr>
                <td>Periode Laporan</td>
                <td>:</td>
                <td>{{ $ghazwanPeriod }}</td>
            </tr>
            <tr>
                <td>Disusun Oleh</td>
                <td>:</td>
                <td>Tim Layanan Pengaduan</td>
            </tr>
            <tr>
                <td>Area</td>
                <td>:</td>
                <td>Kota Bandung</td>
            </tr>
        </tbody>
    </table>

    <br>

    <h3>A. Pendahuluan</h3>
    <p>Laporan ini merupakan hasil pengolahan data pengaduan masyarakat yang telah diterima melalui aplikasi LaporPak.
        Tujuan dari laporan ini adalah untuk memberikan informasi terkini tentang penanganan pengaduan masyarakat di
        Kota Bandung.</p>

    <h3>B. Data Pengaduan</h3>

    <table>
        <thead>
            <tr>
                <th>Bulan</th>
                <th>Pengaduan Baru</th>
                <th>Sedang Diproses</th>
                <th>Tuntas</th>
            </tr>
        </thead>
        <tbody>
            @if ($ghazwanReport != 'Pilih tahun untuk menampilkan data')
                @foreach ($ghazwanReport as $item)
                    <tr>
                        <td>{{ $item['bulan'] }}</td>
                        <td>{{ $item['baru'] }}</td>
                        <td>{{ $item['proses'] }}</td>
                        <td>{{ $item['selesai'] }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center"><strong>{{ $ghazwanReport }}</strong></td>
                </tr>
            @endif
        </tbody>
    </table>

    <h3>C. Kesimpulan</h3>
    <p>Rekap ini dibuat untuk memberikan gambaran umum tentang kondisi pengaduan masyarakat yang telah diolah oleh tim
        pengelola. Laporan ini dapat digunakan sebagai referensi untuk perbaikan di masa mendatang.</p>
</body>

</html>
