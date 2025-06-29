@extends('layouts.main')
@section('content')
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen w-full flex flex-col mt-24 items-center pt-6 sm:pt-0 bg-[#f8f4f3]">

            <div class="w-[95%] flex items-center justify-end py-4">
                <a href="/register/officer"><button
                        class ="ms-4 inline-flex items-center px-4 py-2 bg-[#f84525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Tambah
                    </button></a>

            </div>
            <div class="w-[95%] relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">
                                No
                            </th>
                            <th class="px-6 py-3">
                                <div class="flex items-center">
                                    Tanggal Pengaduan
                                    <a href="#"></a>
                                </div>
                            </th>
                            <th class="px-6 py-3">
                                <div class="flex items-center">
                                    Isi Aduan
                                    <a href="#"></a>
                                </div>
                            </th>
                            <th class="px-6 py-3">
                                <div class="flex items-center">
                                    Foto Bukti
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
                                Opsi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $ghazwanDisplayedIds = [];
                        @endphp
                        @foreach ($ghazwanDataComplaint as $value)
                            @if ($value->status == 'selesai')
                            @if (!in_array($value->id_pengaduan, $ghazwanDisplayedIds))
                            @php $ghazwanDisplayedIds[] = $value->id_pengaduan; @endphp
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                    data-modal-target="ghazwanDetailModal{{ $value->id_pengaduan }}"
                                    data-modal-toggle="ghazwanDetailModal{{ $value->id_pengaduan }}">
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $value->tgl_pengaduan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $value->isi_laporan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <img src="{{ asset('storage/' . $value->foto) }}" alt="foto laporan" width="30px"
                                            height="30px">

                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $value->status == '0' ? 'Baru' : $value->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="edit-officer/{{ $value->id_pengaduan }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-center">Edit</a>
                                    </td>
                                </tr>
                                <div id="ghazwanDetailModal{{ $value->id_pengaduan }}" tabindex="-1" aria-hidden="true"
                                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-5xl max-h-full">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <form action="/complaint/process" method="post">
                                                @csrf
                                                <!-- Modal body -->
                                                <div class="p-6 space-y-6">
                                                    <div class="flex gap-6">
                                                        <!-- Left side - Image -->
                                                        <div class="w-1/4 flex-shrink-0">
                                                            @if ($value->foto)
                                                                <img src="{{ asset('storage/' . $value->foto) }}"
                                                                    alt="Foto Pengaduan"
                                                                    class="w-full h-auto rounded-lg object-cover">
                                                            @else
                                                                <div
                                                                    class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center">
                                                                    <span class="text-gray-500">No Image</span>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <!-- Middle - Details -->
                                                        <div class="w-1/2 space-y-4">
                                                            <div class="grid grid-cols-2 gap-4">
                                                                <div>
                                                                    <p class="text-base font-semibold">ID Pengaduan:</p>
                                                                    <p class="text-sm text-gray-500">
                                                                        {{ $value->id_pengaduan }}</p>
                                                                </div>
                                                                <div>
                                                                    <p class="text-base font-semibold">Tanggal Pengaduan:
                                                                    </p>
                                                                    <p class="text-sm text-gray-500">
                                                                        {{ $value->tgl_pengaduan }}</p>
                                                                </div>
                                                                <div>
                                                                    <p class="text-base font-semibold">NIK:</p>
                                                                    <p class="text-sm text-gray-500">
                                                                        {{ $value->nik }}</p>
                                                                </div>
                                                                <div>
                                                                    <p class="text-base font-semibold">Status:</p>
                                                                    <p class="text-sm text-gray-500">
                                                                        {{ $value->status }}</p>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <p class="text-base font-semibold">Isi Laporan:</p>
                                                                <p class="text-sm text-gray-500">
                                                                    {{ $value->isi_laporan }}</p>
                                                            </div>
                                                        </div>

                                                        <!-- Right side - Chat Area -->
                                                        <div class="w-2/5 flex flex-col">
                                                            <!-- Scrollable Chat Container -->
                                                            <div
                                                                class="h-64 overflow-y-auto border border-gray-300 rounded-lg mb-2 p-2">
                                                                <!-- Chat messages will be dynamically populated here -->
                                                                @foreach ($ghazwanDataComplaint as $message)
                                                                    @if ($value->id_pengaduan == $message->id_pengaduan)
                                                                        <div class="mb-1">
                                                                            <div
                                                                                class="text-base text-gray-600 bg-gray-100 px-4 py-2 rounded-lg inline-block my-1">
                                                                                <div
                                                                                    class="flex justify-between text-xs font-bold mb-2">
                                                                                    <p>Nama Petugas</p>
                                                                                </div>
                                                                                <div class="text-wrap w-full break-all">
                                                                                    {{ $message->tanggapan }}

                                                                                </div>
                                                                                <div
                                                                                    class="text-[0.7rem] font-medium text-right mt-2">
                                                                                    <p>07-12-2024</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
