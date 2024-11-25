<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @notifyCss
    <style>
        .notify {
            position: fixed !important;
            z-index: 9999 !important;
            top: 0px !important;
            right: 0px !important;

        }
    </style>

</head>

<body class="bg-gray-100 scroll-smooth">

    <!-- Header -->
    <header class="bg-[#f84525] text-white">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-2xl font-bold">Pengaduan Masyarakat</h1>
            <nav class="space-x-8">
                <a href="/" class="hover:text-gray-300">Home</a>
                <a href="/my-complaint" class="hover:text-gray-300">Laporan Anda</a>
                <a href="/#about" class="hover:text-gray-300">Tentang Kami</a>
                <a href="/#contact" class="hover:text-gray-300">Kontak</a>


            </nav>

            <nav class="space-x-4 inline-flex items-center justify-center">
                <p class="text-nowrap text-xl">
                    {{ Auth::guard('masyarakat')->check() ? 'Halo, ' . Auth::guard('masyarakat')->user()->nama : '' }}
                </p>
                {!! Auth::guard('masyarakat')->check()
                    ? '<button data-modal-target="ghazwanPopup-modal" data-modal-toggle="ghazwanPopup-modal" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 " type="button">Keluar</button>'
                    : '<a href="/login" class="hover:text-gray-300"><button type="button" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">Masuk</button></a>' !!}
                {{-- <a href="/login" class="hover:text-gray-300"><button type="button" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Masuk</button></a>
                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" type="button">Keluar</button> --}}

            </nav>
        </div>
    </header>

    <main class="container mx-auto my-8 p-4">
        <div class="font-sans text-gray-900 antialiased">
            <div class="min-h-screen w-full flex flex-col items-center pt-6 sm:pt-0 bg-[#f8f4f3]">

                <div id="ghazwanPopup-modal" tabindex="-1"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="ghazwanPopup-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu yakin
                                    untuk
                                    keluar?</h3>
                                <a href="/logout" class="text-center"><button data-modal-hide="popup-modal"
                                        type="button"
                                        class="w-24 text-center py-2.5 px-5 ms-3 text-sm font-medium text-white focus:outline-none !bg-red-600 rounded-lg border border-gray-200 hover:!bg-red-800 focus:z-10 focus:ring-4 focus:ring-gray-100">
                                        Ya
                                    </button></a>
                                <button data-modal-hide="ghazwanPopup-modal" type="button"
                                    class="w-24 text-center py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 hover:text-gray-900 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Tidak</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-[95%] flex items-center justify-end py-4">
                    <a href="/#ghazwanForm"><button
                            class ="inline-flex items-center px-4 py-2 bg-[#f84525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
                                {{-- @if ($value->status == 'selesai') --}}
                                @if (!in_array($value->id_pengaduan, $ghazwanDisplayedIds))
                                    @php $ghazwanDisplayedIds[] = $value->id_pengaduan; @endphp
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td data-modal-target="ghazwanDetailModal{{ $value->id_pengaduan }}"
                                            data-modal-toggle="ghazwanDetailModal{{ $value->id_pengaduan }}" scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                                            {{ $ghazwanIndex }}
                                        </td>
                                        <td data-modal-target="ghazwanDetailModal{{ $value->id_pengaduan }}"
                                            data-modal-toggle="ghazwanDetailModal{{ $value->id_pengaduan }}" scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $value->tgl_pengaduan }}
                                        </td>
                                        <td data-modal-target="ghazwanDetailModal{{ $value->id_pengaduan }}"
                                            data-modal-toggle="ghazwanDetailModal{{ $value->id_pengaduan }}" class="px-6 py-4">
                                            {{ $value->isi_laporan }}
                                        </td>
                                        <td data-modal-target="ghazwanDetailModal{{ $value->id_pengaduan }}"
                                            data-modal-toggle="ghazwanDetailModal{{ $value->id_pengaduan }}" class="px-6 py-4 flex items-center justify-center">
                                            <img src="{{ asset('storage/' . $value->foto) }}" alt="foto laporan"
                                                style="height: 48px; display: flex; position: center; align-items: center;">

                                        </td>
                                        <td data-modal-target="ghazwanDetailModal{{ $value->id_pengaduan }}"
                                            data-modal-toggle="ghazwanDetailModal{{ $value->id_pengaduan }}" class="px-6 py-4 capitalize">
                                            {{ $value->status == 0 ? 'Baru' : $value->status }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <button
                                                @if ($value->status == 0) data-modal-target="ghazwanDetailModal{{ $value->id_pengaduan }}"
                                                data-modal-toggle="ghazwanDetailModal{{ $value->id_pengaduan }}" @endif
                                                class="font-medium {{ $value->status == 0 ? 'text-blue-600' : 'text-gray-600 cursor-not-allowed' }} dark:text-blue-500 hover:underline text-center">Edit</button>
                                                |
                                            <button
                                                @if ($value->status == 0) data-modal-target="ghazwanDeleteModal{{ $value->id_pengaduan }}"
                                            data-modal-toggle="ghazwanDeleteModal{{ $value->id_pengaduan }}" @endif
                                                class="font-medium {{ $value->status == 0 ? 'text-red-600' : 'text-gray-600 cursor-not-allowed' }} dark:text-blue-500 hover:underline text-center">Hapus</button>
                                        </td>
                                    </tr>


                                    <div id="ghazwanDeleteModal{{ $value->id_pengaduan }}" tabindex="-1"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-md max-h-full">
                                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="ghazwanDeleteModal">
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
                                                    <a href="/delete-mycomplaint/{{ $value->id_pengaduan }}"
                                                        data-modal-hide="ghazwanDeleteModal{{ $value->id_pengaduan }}" type="button"
                                                        class="text-white !bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                        Yakin
                                                    </a>
                                                    <button data-modal-hide="ghazwanDeleteModal{{ $value->id_pengaduan }}" type="button"
                                                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div id="ghazwanDetailModal{{ $value->id_pengaduan }}" tabindex="-1"
                                        aria-hidden="true"
                                        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative w-full max-w-5xl max-h-full">
                                            <div class="relative bg-white rounded-lg shadow">
                                                <button type="button"
                                                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="ghazwanDetailModal{{ $value->id_pengaduan }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="p-6 pt-16 space-y-6">
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
                                                            <form
                                                                action="/update-complaint/{{ $value->id_pengaduan }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf

                                                                <div>
                                                                    <p class="text-base font-semibold">Isi Laporan:</p>
                                                                    <input type="text" name="ghazwanNewComplaint"
                                                                        onkeypress="if(event.key === 'Enter') return false;"
                                                                        id="isi_laporan"
                                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                                                        placeholder="Tuliskan Laporan Anda"
                                                                        value="{{ old('isi_laporan', $value->isi_laporan) }}"
                                                                        required
                                                                        {{ $value->status != 0 ? 'readonly' : '' }}>
                                                                    @error('ghazwanNewComplaint')
                                                                        <p class="text-red-500 text-xs italic">
                                                                            {{ $message }}</p>
                                                                    @enderror
                                                                </div>

                                                                <div class="mt-4">
                                                                    <p class="text-base font-semibold">Bukti Laporan:
                                                                    </p>
                                                                    @if ($value->status == 0)
                                                                        <input
                                                                            onkeypress="if(event.key === 'Enter') return false;"
                                                                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white focus:outline-none file:bg-blue-500 file:text-white file:rounded file:border-none file:py-2 file:px-4"
                                                                            name="ghazwanImage" id="ghazwanImage"
                                                                            type="file" accept="image/*">
                                                                    @endif
                                                                    @error('ghazwanImage')
                                                                        <p class="text-red-500 text-xs italic">
                                                                            {{ $message }}</p>
                                                                    @enderror
                                                                    @if ($value->foto)
                                                                        <p class="text-sm text-gray-500 mt-1">File saat
                                                                            ini: {{ basename($value->foto) }}</p>
                                                                    @endif
                                                                </div>

                                                                <div class="mt-4 text-right">
                                                                    @if ($value->status == 0)
                                                                        <button type="submit"
                                                                            class="inline-flex items-center px-4 py-2 !bg-[#f84525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                                            Simpan Perubahan
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="w-2/5 flex flex-col">
                                                            <div
                                                                class="h-64 overflow-y-auto border border-gray-300 rounded-lg mb-2 p-2">
                                                                @foreach ($ghazwanDataComplaint as $message)
                                                                    @if ($message->id_pengaduan == $value->id_pengaduan && $message->tanggapan != null)
                                                                        <div class="mb-1">
                                                                            <div
                                                                                class="text-base text-gray-600 bg-gray-100 px-4 py-2 rounded-lg inline-block my-1">
                                                                                <div
                                                                                    class="flex justify-between text-xs font-bold mb-2">
                                                                                    <p>{{ $message->nama_petugas }}
                                                                                    </p>
                                                                                </div>
                                                                                <div
                                                                                    class="text-wrap w-full break-all">
                                                                                    {{ $message->tanggapan }}

                                                                                </div>
                                                                                <div
                                                                                    class="text-[0.7rem] font-medium text-right mt-2">
                                                                                    <p>{{ $message->tgl_tanggapan }}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
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
            </div>
        </div>
    </main>

    <footer class="bg-[#f84525] text-white text-center py-4 mt-8">
        <p>&copy; 2024 LaporPak!. All rights reserved.</p>
    </footer>

    <x-notify::notify />
    @notifyJs
</body>

</html>
