<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-[#f84525] text-white">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-2xl font-bold">Pengaduan Masyarakat</h1>
            <nav class="space-x-4">
                <a href="#" class="hover:text-gray-300">Home</a>
                <a href="#about" class="hover:text-gray-300">Tentang Kami</a>
                <a href="#contact" class="hover:text-gray-300">Kontak</a>
                {!! Auth::guard('masyarakat')->check() ? '<button data-modal-target="ghazwanPopup-modal" data-modal-toggle="ghazwanPopup-modal" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" type="button">Keluar</button>' : '<a href="/login" class="hover:text-gray-300"><button type="button" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Masuk</button></a>' !!}
                {{-- <a href="/login" class="hover:text-gray-300"><button type="button" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Masuk</button></a>
                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" type="button">Keluar</button> --}}


            </nav>
        </div>
    </header>

    <main class="container mx-auto my-8 p-4">
        <section class="bg-white shadow-lg rounded-lg p-6 text-center relative">
            <img src="{{ asset('assets/images/') }}" alt="Pengaduan Masyarakat" class="w-full mx-auto mb-4 rounded-lg">
            <div class="inlineflex absolute text-nowrap top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]">
                <h2 class="text-3xl font-bold text-[#f84525] mb-4">Aspirasi Anda, Prioritas Kami</h2>
                <p class="text-gray-700 mb-6">Laporkan berbagai masalah yang Anda hadapi di lingkungan sekitar dengan
                    cepat dan mudah. Kami siap membantu menyelesaikan pengaduan Anda.</p>
                <a href="#form" class="bg-[#f84525] text-white px-6 py-2 rounded-md hover:bg-[#e33e20]">Laporkan
                    Sekarang</a>

            </div>
        </section>

        <div id="ghazwanPopup-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="ghazwanPopup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu yakin untuk keluar?</h3>
                            <a href="/logout" class="text-center"><button data-modal-hide="popup-modal" type="button"
                            class="w-24 text-center py-2.5 px-5 ms-3 text-sm font-medium text-white focus:outline-none bg-red-600 rounded-lg border border-gray-200 hover:bg-red-800 focus:z-10 focus:ring-4 focus:ring-gray-100">
                            Ya
                        </button></a>
                        <button data-modal-hide="ghazwanPopup-modal" type="button"
                                class="w-24 text-center py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-200 hover:text-gray-900 focus:z-10 focus:ring-4 focus:ring-gray-100 ">Tidak</button>
                    </div>
                </div>
            </div>
        </div>

        <section id="ghazwanAbout" class="mt-12 p-6 bg-gray-200 rounded-lg">
            <h3 class="text-2xl font-semibold text-[#f84525] mb-2">Tentang Kami</h3>
            <p class="text-gray-600">Pengaduan Masyarakat adalah platform yang didedikasikan untuk membantu masyarakat
                melaporkan berbagai keluhan dan permasalahan di lingkungan sekitar secara efektif dan efisien.</p>
        </section>

        <section id="ghazwanForm" class="mt-12 p-6 bg-white shadow-lg rounded-lg">
            <h3 class="text-2xl font-semibold text-[#f84525] mb-4">Form Pengaduan</h3>
            <form action="/submit-complaint" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="ghazwanName" class="block text-gray-700">Nama Lengkap</label>
                    <input type="text" id="ghazwanName" name="ghazwanName"
                        class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:border-[#f84525]"
                        required>
                </div>
                <div class="mb-4">
                    <label for="ghazwanComplaint" class="block text-gray-700">Pengaduan</label>
                    <textarea id="ghazwanComplaint" name="ghazwanComplaint" rows="4"
                        class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:border-[#f84525]" required></textarea>
                </div>
                <div class="mb-4">
                    <input type="file" name="ghazwanImage" id="ghazwanImage">
                </div>
                <button type="submit" class="bg-[#f84525] text-white px-4 py-2 rounded-md hover:bg-[#e33e20]">Kirim
                    Pengaduan</button>
            </form>
        </section>
    </main>

    <footer class="bg-[#f84525] text-white text-center py-4 mt-8">
        <p>&copy; 2024 LaporPak!. All rights reserved.</p>
    </footer>
</body>

</html>
