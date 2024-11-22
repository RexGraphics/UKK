@extends('layouts.main')
@section('content')
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen w-full flex flex-col mt-24 items-center pt-6 sm:pt-0 bg-[#f8f4f3]">
            <div class="w-[95%] inline-flex items-center justify-end py-4">
                <form action="/report-filter" method="post" class="w-full inline-flex justify-between">
                    @csrf
                    <div id="date-range-picker" date-rangepicker class="flex items-center">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-range-start" name="start" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date start">
                        </div>
                        <span class="mx-4 text-gray-500">to</span>
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="datepicker-range-end" name="end" type="text"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date end">
                        </div>
                        <label for="ghazwanStatus" class="mx-4 text-gray-500">Status</label>
                        <div class="block">
                            <select id="ghazwanStatus" name="ghazwanStatus"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled>Pilih Status</option>
                            <option value="semua">Semua</option>
                            <option value="0">Baru</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        </div>
                    </div>
                    <div class="w-1/6 inline-flex justify-between">
                        <button type="submit"
                            class ="inline-flex items-center px-4 py-2 !bg-[#f84525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:!bg-red-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Tampilkan
                        </button>
                    </div>
                </form>
                <form action="/print" method="post">
                    @csrf
                    <input type="hidden" name="ghazwanAllData" value="{{ json_encode($ghazwanReport) }}">
                    <button type="submit" class="inline-flex items-center px-4 py-2 !bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:!bg-green-800 focus:bg-green-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Print</button>
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
                        @foreach ($ghazwanReport as $value)
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
        </div>
    </div>
@endsection

@section('js')
@endsection
