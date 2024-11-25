@extends('layouts.main')
@section('content')
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen w-full flex flex-col mt-24 items-center pt-6 sm:pt-0 bg-[#f8f4f3]">
            <div class="w-[95%] flex justify-between items-center mb-4">
                <form method="GET" class="flex items-center gap-2">
                    <label for="per_page" class="text-sm text-gray-700">Tampilkan:</label>
                    <select name="per_page" id="per_page" class="border border-gray-300 text-sm rounded-lg p-2"
                            onchange="this.form.submit()">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </form>
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
                                <div class="flex items-center justify-center">
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
                        $ghazwanIndex = 1;
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
                                        {{ $ghazwanIndex }}
                                    </td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $value->tgl_pengaduan }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $value->isi_laporan }}
                                    </td>
                                    <td class="px-6 py-4 flex items-center justify-center">
                                        <img src="{{ asset('storage/' . $value->foto) }}" alt="foto laporan" style="height: 48px; display: flex; position: center; align-items: center;">

                                    </td>
                                    <td class="px-6 py-4 capitalize">
                                        {{ $value->status == '0' ? 'Baru' : $value->status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <button data-modal-target="ghazwanDetailModal{{ $value->id_pengaduan }}"
                                    data-modal-toggle="ghazwanDetailModal{{ $value->id_pengaduan }}"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-center">Lihat</button>
                                    </td>
                                </tr>


                                <div id="ghazwanDetailModal{{ $value->id_pengaduan }}" tabindex="-1" aria-hidden="true"
                                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-5xl max-h-full">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <form action="/complaint/process" method="post">
                                                @csrf
                                                <div class="p-6 space-y-6">
                                                    <div class="flex gap-6">
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
                                                                    <p class="text-sm text-gray-500 capitalize">
                                                                        {{ $value->status }}</p>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <p class="text-base font-semibold">Isi Laporan:</p>
                                                                <p class="text-sm text-gray-500">
                                                                    {{ $value->isi_laporan }}</p>
                                                            </div>
                                                        </div>

                                                        <div class="w-2/5 flex flex-col">
                                                            <div
                                                                class="h-64 overflow-y-auto border border-gray-300 rounded-lg mb-2 p-2">
                                                                @foreach ($ghazwanDataComplaint as $message)
                                                                    @if ($value->id_pengaduan == $message->id_pengaduan)
                                                                        <div class="mb-1">
                                                                            <div
                                                                                class="text-base text-gray-600 bg-gray-100 px-4 py-2 rounded-lg inline-block my-1">
                                                                                <div
                                                                                    class="flex justify-between text-xs font-bold mb-2">
                                                                                    <p>{{$message->nama_petugas}}</p>
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
                                @php
                                $ghazwanIndex++;
                                @endphp
                            @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex w-full items-center justify-between border-t border-gray-200 px-4 py-3 sm:px-6">

                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div class="flex flex-col sm:flex-row items-center justify-between border-t border-gray-200 px-4 py-3 sm:px-6 w-full">
                        <div class="w-full sm:w-auto">
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                {{-- Tombol Previous --}}
                                @if ($ghazwanDataComplaint->onFirstPage())
                                    <span
                                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @else
                                    <a href="{{ $ghazwanDataComplaint->previousPageUrl() }}"
                                       class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif

                                {{-- Pagination --}}
                                @foreach ($ghazwanDataComplaint->links()->elements[0] as $page => $url)
                                    @if ($page == $ghazwanDataComplaint->currentPage())
                                        <span
                                            class="relative z-10 inline-flex items-center bg-custom-orange px-4 py-2 text-sm font-semibold text-white">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                           class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Tombol Next --}}
                                @if ($ghazwanDataComplaint->hasMorePages())
                                    <a href="{{ $ghazwanDataComplaint->nextPageUrl() }}"
                                       class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @else
                                    <span
                                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25-4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @endif
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
