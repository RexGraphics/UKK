@extends('layouts.main')
@section('content')
    <div class="font-sans text-gray-900 antialiased">
        <div class="h-auto w-full flex flex-col mt-24 items-center pt-6 sm:pt-0 bg-[#f8f4f3] pb-8">
            <div class="w-[95%] inline-flex items-center justify-end py-4 ">
                <form action="/report-filter" method="post" class="w-full inline-flex justify-between">
                    @csrf
                    <div id="date-range-picker" date-rangepicker class="flex items-center">
                        <label for="ghazwanPeriod" class="mx-4 text-gray-500">Pilih Periode</label>
                        <div class="block">
                            <input id="ghazwanPeriod" name="ghazwanPeriod" type="number" min="2024" value="2024" max="2100" step="1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                        </div>
                    </div>
                    <div class="w-1/6 inline-flex justify-between">
                        <a href="{{ route('ghazwanPrint.report') }}?export=pdf"
                            class ="inline-flex text-nowrap mr-4 items-center px-4 py-2 !bg-[#f84525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:!bg-red-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Export PDF
                        </a>
                        <button type="submit"
                            class ="inline-flex items-center px-4 py-2 !bg-[#f84525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:!bg-red-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Tampilkan
                        </button>
                    </div>
                </form>
                {{-- <form action="/print" method="post">
                    @csrf
                    <input type="hidden" name="ghazwanAllData" value="{{ json_encode($ghazwanReport) }}">
                    <button type="submit" class="inline-flex items-center px-4 py-2 !bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:!bg-green-800 focus:bg-green-800 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Print</button>
                </form> --}}
            </div>
            <div class="w-[95%] relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4 text-center">
                                    Bulan
                            </th>
                            <th class="px-6 py-4">
                                    Baru
                            </th>
                            <th class="px-6 py-4">
                                    Proses
                            </th>
                            <th class="px-6 py-4">
                                    Selesai
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @dd($ghazwanMonthlyReport) --}}
                        @if($ghazwanMonthlyReport != 'Pilih tahun untuk menampilkan data')
                        @foreach ($ghazwanMonthlyReport as $value)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700" >
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                                    {{ $value['bulan'] }}
                                </td>
                                <td scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $value['baru'] }}
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $value['proses'] }}
                                </td>
                                <td class="px-6 py-4 capitalize">
                                    {{ $value['selesai'] }}
                                </td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="px-6 py-4 capitalize text-center text-xl">{{$ghazwanMonthlyReport}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
