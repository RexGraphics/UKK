@extends('layouts.main')
@section('content')
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen w-full flex flex-col mt-24 items-center pt-6 sm:pt-0 bg-[#f8f4f3]">

            <div class="w-[95%] flex items-center justify-end py-4">
                <a href="/register/user"><button class ="ms-4 inline-flex items-center px-4 py-2 bg-[#f84525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                                    NIK
                                    <a href="#"> </a>
                                </div>
                            </th>
                            <th class="px-6 py-3">
                                <div class="flex items-center">
                                    Nama
                                    <a href="#"> </a>
                                </div>
                            </th>
                            <th class="px-6 py-3">
                                <div class="flex items-center">
                                    Username
                                    <a href="#"> </a>
                                </div>
                            </th>
                            <th class="px-6 py-3">
                                <div class="flex items-center">
                                    No Telepon
                                    <a href="#"> </a>
                                </div>
                            </th>
                            <th class="px-6 py-3 flex text-center">
                                Opsi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ghazwanUsers as $value)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                                {{$loop->iteration}}
                            </th>
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$value->nik}}
                            </th>
                            <td class="px-6 py-4">
                                {{$value->nama}}

                            </td>
                            <td class="px-6 py-4">
                                {{$value->username}}

                            </td>
                            <td class="px-6 py-4">
                                {{$value->telp}}

                            </td>
                            <td class="px-6 py-4">
                                <a href="edit-user/{{$value->id}}"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline text-center">Edit</a>
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
