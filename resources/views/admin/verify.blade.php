@extends('layouts.main')
@section('content')
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen w-full flex flex-col mt-24 items-center pt-6 sm:pt-0 bg-[#f8f4f3]">
            <div class="w-[95%] flex justify-between items-center mb-4">
            </div>
            <div class="w-[95%] relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">
                                No
                            </th>
                            <th class="px-6 py-3 text-center">
                                NIK
                            </th>
                            <th class="px-6 py-3 text-center">
                                Nama
                            </th>
                            <th class="px-6 py-3 text-center">
                                Nama Pengguna
                            </th>
                            <th class="px-6 py-3 text-center">
                                Status
                            </th>
                            <th class="px-6 py-3 text-center">
                                No Telepon
                            </th>
                            <th class="px-6 py-3 text-center">
                                Opsi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($ghazwanVerify->count() == '0')
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="7" class="px-6 py-4 capitalize text-center text-xl">
                                Tidak ada data yang bisa di tampilkan
                            </td>
                        </tr>
                        @endif
                        @foreach ($ghazwanVerify as $value)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                                    {{ $loop->iteration }}
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                                    {{ $value->nik }}
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                                    {{ $value->nama }}
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                                    {{ $value->username }}
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                                    {{ $value->telp }}
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                                    {{ $value->status == null ? 'Belum Diverifikasi' : 'Sudah Diverifikasi' }}
                                </td>

                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                                    <a href="/verify-account/{{ $value->id }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-center">Verifikasi</a>
                                    |
                                    <a href="/reject-account/{{ $value->id }}"
                                        class="font-medium text-red-600 dark:text-blue-500 hover:underline text-center">Tolak</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
