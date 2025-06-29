@extends('layouts.main')
@section('content')
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen w-full flex flex-col mt-24 items-center pt-6 sm:pt-0 bg-[#f8f4f3]">
            <div class="w-[95%] flex justify-left items-center mb-4">
                <form method="GET" class="flex items-center gap-2">
                    <label for="per_page" class="text-sm text-gray-700">Tampilkan:</label>
                    <select name="per_page" id="per_page" class="border border-gray-300 text-sm rounded-lg p-2"
                            onchange="this.form.submit()">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <label for="ghazwanSearch" class="text-sm text-gray-700">Cari Isi Pengaduan</label>
                    <input type="text" name="ghazwanSearch" id="ghazwanSearch" class="border border-gray-300 text-sm rounded-lg p-2">
                    <button type="submit"
                            class ="ms-4 inline-flex items-center px-4 py-2 !bg-[#f84525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Cari
                    </button>
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
                        $ghazwanIndex = 1;
                        @endphp
                        @if ($ghazwanDataComplaint->count() == '0')
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="6" class="px-6 py-4 capitalize text-center text-xl">
                                Tidak ada data yang bisa di tampilkan
                            </td>
                        </tr>
                        @endif
                        @foreach ($ghazwanDataComplaint as $value)
                        @if ($ghazwanDataComplaint->first() == $ghazwanDataComplaint->last() && $value->status == 'selesai')
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td colspan="6" class="px-6 py-4 capitalize text-center text-xl">
                                Tidak ada data yang bisa di tampilkan
                            </td>
                        </tr>
                        @endif
                        @if ($value->status == 0 || $value->status == 'proses')


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
                                    <button data-modal-target="ghazwanDetailModal{{ $value->id_pengaduan }}" data-modal-toggle="ghazwanDetailModal{{ $value->id_pengaduan }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-center">Lihat</button>
                                </td>
                            </tr>
                            <div id="ghazwanDetailModal{{ $value->id_pengaduan }}" tabindex="-1" aria-hidden="true"
                                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-5xl max-h-full">
                                    <div class="relative bg-white rounded-lg shadow">
                                        <form action="/complaint/process" method="post">
                                            @csrf

                                            <div class="flex items-start justify-between p-4 border-b rounded-t">
                                                <h3 class="text-xl font-semibold text-gray-900">
                                                    Detail Pengaduan #{{ $value->id_pengaduan }}
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                                                    data-modal-hide="ghazwanDetailModal{{ $value->id_pengaduan }}">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>

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


                                                    <div class="w-3/4 space-y-4">
                                                        <div class="grid grid-cols-2 gap-4">
                                                            <div>
                                                                <p class="text-base font-semibold">ID Pengaduan:</p>
                                                                <p class="text-sm text-gray-500">{{ $value->id_pengaduan }}</p>
                                                            </div>
                                                            <div>
                                                                <p class="text-base font-semibold">Tanggal Pengaduan:</p>
                                                                <p class="text-sm text-gray-500">{{ $value->tgl_pengaduan }}
                                                                </p>
                                                            </div>
                                                            <div>
                                                                <p class="text-base font-semibold">NIK:</p>
                                                                <p class="text-sm text-gray-500">{{ $value->nik }}</p>
                                                            </div>
                                                            <div>
                                                                <p class="text-base font-semibold">Status:</p>
                                                                <p class="text-sm text-gray-500 capitalize">{{ $value->status == '0' ? 'Baru' : $value->status }}</p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <p class="text-base font-semibold">Isi Laporan:</p>
                                                            <p class="text-sm text-gray-500">{{ $value->isi_laporan }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="ghazwanId" id="ghazwanId" value="{{ $value->id_pengaduan }}">


                                                <div class="w-full mt-6">
                                                    <label for="ghazwanTanggapan"
                                                        class="block mb-2 text-sm font-medium text-gray-900">Tanggapan:</label>
                                                    <textarea id="ghazwanTanggapan" name="ghazwanTanggapan" rows="4"
                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                        placeholder="Tulis tanggapan Anda di sini..."></textarea>
                                                </div>


                                                <div class="p-4 bg-white rounded-lg">
                                                    <div class="flex flex-wrap items-center gap-6 mb-4">
                                                        {{-- <div class="flex items-center">
                                                            <input type="radio" id="pending" name="ghazwanStatus" value="0"
                                                                class="w-4 h-4 border-gray-300 text-yellow-500 focus:ring-yellow-500" {{$value->status == 0 ? 'checked' : ''}}>
                                                            <label for="0"
                                                                class="ml-2 text-sm font-medium text-gray-700">
                                                                Pending
                                                            </label>
                                                        </div> --}}

                                                        <div class="flex items-center">
                                                            <input type="radio" id="process" name="ghazwanStatus"
                                                                value="proses"
                                                                class="w-4 h-4 border-gray-300 text-blue-500 focus:ring-blue-500" {{$value->status == 'proses' ? 'checked' : ''}}>
                                                            <label for="process"
                                                                class="ml-2 text-sm font-medium text-gray-700">
                                                                Proses
                                                            </label>
                                                        </div>

                                                        @if($value->status == 'proses')
                                                        <div class="flex items-center">
                                                            <input type="radio" id="selesai" name="ghazwanStatus"
                                                                value="selesai"
                                                                class="w-4 h-4 border-gray-300 text-green-500 focus:ring-green-500">
                                                            <label for="selesai"
                                                                class="ml-2 text-sm font-medium text-gray-700">
                                                                Selesai
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>


                                            <div
                                                class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                <a href="#" data-modal-target="ghazwanDeleteModal{{ $value->id_pengaduan }}" data-modal-toggle="ghazwanDeleteModal{{ $value->id_pengaduan }}"
                                                    class="text-white !bg-red-600 hover:!bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                    Hapus
                                                </a>
                                                <button type="submit"
                                                    class="text-white !bg-custom-orange hover:!bg-orange-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                    Kirim
                                                </button>
                                            </div>

                                            <div id="ghazwanDeleteModal{{ $value->id_pengaduan }}" tabindex="-1"
                                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-md max-h-full">
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <button type="button"
                                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                            data-modal-hide="ghazwanDeleteModal{{ $value->id_pengaduan }}">
                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 14 14">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="p-4 md:p-5 text-center">
                                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                                fill="none" viewBox="0 0 20 20">
                                                                <path stroke="currentColor" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                            </svg>
                                                            <h3
                                                                class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                                                Apakah anda yakin untuk menghapus laporan ini?</h3>
                                                            <a href="/delete-complaint/{{ $value->id_pengaduan }}"
                                                                data-modal-hide="ghazwanDeleteModal" type="button"
                                                                class="text-white !bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                                Yakin
                                                            </a>
                                                            <button data-modal-hide="ghazwanDeleteModal{{ $value->id_pengaduan }}" type="button"
                                                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak</button>
                                                        </div>
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
