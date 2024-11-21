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
                        @foreach ($ghazwanDataComplaint as $value)
                        @if ($value->status == 'selesai')

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
                                            <!-- Modal header -->
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

                                                    <!-- Right side - Details -->
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
                                                                <p class="text-sm text-gray-500">{{ $value->status }}</p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <p class="text-base font-semibold">Isi Laporan:</p>
                                                            <p class="text-sm text-gray-500">{{ $value->isi_laporan }}</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="text" name="ghazwanId" id="ghazwanId" value="{{ $value->id_pengaduan }}" hidden>
                                                {{-- @dd($value) --}}
                                                <div class="w-full mt-6">
                                                    <label for="ghazwanTanggapan"
                                                        class="block mb-2 text-sm font-medium text-gray-900">Tanggapan:</label>
                                                    <textarea id="ghazwanTanggapan" name="ghazwanTanggapan" rows="4"
                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                        placeholder="Tulis tanggapan Anda di sini..." value="{{$value->tanggapan}}"></textarea>
                                                </div>

                                                <!-- Radio buttons -->
                                                {{-- <div class="p-4 bg-white rounded-lg">
                                                    <div class="flex flex-wrap items-center gap-6 mb-4">
                                                        <div class="flex items-center">
                                                            <input type="radio" id="pending" name="ghazwanStatus" value="pending"
                                                                class="w-4 h-4 border-gray-300 text-yellow-500 focus:ring-yellow-500">
                                                            <label for="0"
                                                                class="ml-2 text-sm font-medium text-gray-700">
                                                                Pending
                                                            </label>
                                                        </div>

                                                        <div class="flex items-center">
                                                            <input type="radio" id="process" name="ghazwanStatus"
                                                                value="proses"
                                                                class="w-4 h-4 border-gray-300 text-blue-500 focus:ring-blue-500">
                                                            <label for="process"
                                                                class="ml-2 text-sm font-medium text-gray-700">
                                                                Proses
                                                            </label>
                                                        </div>

                                                        <div class="flex items-center">
                                                            <input type="radio" id="selesai" name="ghazwanStatus"
                                                                value="selesai"
                                                                class="w-4 h-4 border-gray-300 text-green-500 focus:ring-green-500">
                                                            <label for="selesai"
                                                                class="ml-2 text-sm font-medium text-gray-700">
                                                                Selesai
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>

                                            <!-- Modal footer -->
                                            {{-- <div
                                                class="flex items-center justify-end p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                <button type="submit"
                                                    class="text-white !bg-custom-orange hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                    Kirim
                                                </button>
                                            </div> --}}

                                        </form>
                                    </div>
                                </div>
                            </div>
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
