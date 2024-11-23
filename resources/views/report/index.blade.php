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

        </tbody>
    </table>

    <h3>III. Penutup</h3>
    <p>Laporan ini disusun untuk memenuhi tugas kelompok dan dapat digunakan sebagai acuan dalam menangani masalah
        pengaduan masyarakat Kota Cimahi.</p>

    <br>

    <div class="w-[95%] relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">
                        <div class="flex items-center">
                            Tanggal Pengaduan
                            <a href="#"></a>
                        </div>
                    </th>
                    <th class="px-6 py-3">
                        <div class="flex items-center">
                            Status
                            <a href="#"></a>
                        </div>
                    </th>
                    <th class="px-6 py-3 flex text-center">
                        Total
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ghazwanReport as $value)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                        data-modal-target="ghazwanDetailModal{{ $value->id_pengaduan }}"
                        data-modal-toggle="ghazwanDetailModal{{ $value->id_pengaduan }}">
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $value->tgl_pengaduan }}
                        </td>
                        <td class="px-6 py-4 capitalize">
                            {{ $value->status === null ? 'Semua' : ($value->status == 0 ? 'Baru' : $value->status) }}

                        </td>
                        <td class="px-6 py-4">
                            <a href="edit-officer/{{ $value->id_pengaduan }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-center">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
