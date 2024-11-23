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
                @if (Auth::guard('masyarakat')->check())
                <a href="/my-complaint" class="hover:text-gray-300">Laporan Anda</a>
                @endif
                <a href="#about" class="hover:text-gray-300">Tentang Kami</a>
                <a href="#contact" class="hover:text-gray-300">Kontak</a>


            </nav>

            <nav class="space-x-4 inline-flex items-center justify-center">
                <p class="text-nowrap text-xl">{{ Auth::guard('masyarakat')->check() ? 'Anda Login Sebagai ' . Auth::guard('masyarakat')->user()->nama : ''}}</p>
                {!! Auth::guard('masyarakat')->check()
                    ? '<button data-modal-target="ghazwanPopup-modal" data-modal-toggle="ghazwanPopup-modal" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 " type="button">Keluar</button>'
                    : '<a href="/login" class="hover:text-gray-300"><button type="button" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center">Masuk</button></a>' !!}
                {{-- <a href="/login" class="hover:text-gray-300"><button type="button" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Masuk</button></a>
                <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2" type="button">Keluar</button> --}}

            </nav>
        </div>
    </header>

    <main class="container mx-auto my-8 p-4">
        <section class="bg-white shadow-lg rounded-lg p-6 text-center relative">
            <div class="relative w-full h-64 overflow-hidden"> <!-- Sesuaikan height sesuai kebutuhan -->
                <img src="{{ asset('assets/images/bg1.jpeg') }}" alt="Background 1" class="gambar absolute w-full h-full object-cover brightness-[0.25] transition-opacity duration-1000 opacity-100">
                <img src="{{ asset('assets/images/bg2.jpg') }}" alt="Background 2" class="gambar absolute w-full h-full object-cover brightness-[0.25] transition-opacity duration-1000 opacity-0">
                <img src="{{ asset('assets/images/bg3.jpg') }}" alt="Background 3" class="gambar absolute w-full h-full object-cover brightness-[0.25] transition-opacity duration-1000 opacity-0">
            </div>
            <div class="inlineflex absolute text-nowrap top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]">
                <h2 class="text-3xl font-bold text-[#f84525] mb-4">Aspirasi Anda, Prioritas Kami</h2>
                <p class="text-white mb-6">Laporkan berbagai masalah yang Anda hadapi di lingkungan sekitar dengan
                    cepat dan mudah. Kami siap membantu menyelesaikan pengaduan Anda.</p>
                <a href="#ghazwanForm" class="bg-[#f84525] text-white px-6 py-2 rounded-md hover:bg-[#e33e20]">Laporkan
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
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu yakin untuk
                            keluar?</h3>
                        <a href="/logout" class="text-center"><button data-modal-hide="popup-modal" type="button"
                                class="w-24 text-center py-2.5 px-5 ms-3 text-sm font-medium text-white focus:outline-none !bg-red-600 rounded-lg border border-gray-200 hover:!bg-red-800 focus:z-10 focus:ring-4 focus:ring-gray-100">
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
            <form action="{{ Auth::guard('masyarakat')->check() ? '/submit-complaint' : '/login-to-submit' }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <div class="mb-4">
                    <label for="ghazwanName" class="block text-gray-700">Nama Lengkap</label>
                    <input type="text" id="ghazwanName" name="ghazwanName"
                        class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:border-[#f84525]">
                </div> --}}
                <div class="mb-4">
                    <label for="ghazwanComplaint" class="block text-gray-700 text-xl p-4">Pengaduan</label>
                    @error('ghazwanComplaint')
                            <p class="text-red-600 pl-2 pt-1">
                                {{$message}}
                            </p>

                    @enderror
                    <textarea id="ghazwanComplaint" name="ghazwanComplaint" rows="4"
                    class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:border-[#f84525]"></textarea>
                </div>

                <div class="max-w-full pb-4">
                    <span class="block text-gray-700 text-xl p-4">Foto Bukti Laporan</span>
                    @error('ghazwanImage')
                        <p class="text-red-600 pl-2 pt-1">
                            {{$message}}
                        </p>
                    @enderror
                    <label
                        class="flex justify-center w-full h-32 px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none relative overflow-hidden"
                        id="ghazwanDropArea">
                        <!-- Preview Container -->
                        <img id="ghazwanPreview" class="hidden absolute inset-0 w-full h-full object-contain">

                        <!-- Upload Content -->
                        <span class="flex items-center space-x-2" id="ghazwanUploadContent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <span class="font-medium text-gray-600">
                                Geser Gambar Ke Area untuk Memasukan Gambar, atau
                                <span class="text-blue-600 underline">Telusuri Berkas</span>
                            </span>
                        </span>
                        <input type="file" name="ghazwanImage" id="ghazwanInputFile" class="hidden" accept="image/*">
                    </label>
                </div>
                <button type="submit" class="!bg-[#f84525] text-white px-4 py-2 rounded-md hover:!bg-[#e33e20]">Kirim
                    Pengaduan</button>
            </form>
        </section>
    </main>

    <footer class="bg-[#f84525] text-white text-center py-4 mt-8">
        <p>&copy; 2024 LaporPak!. All rights reserved.</p>
    </footer>

    <script>
    const ghazwanDropArea = document.querySelector('#ghazwanDropArea');
    const ghazwanInputFile = document.querySelector('#ghazwanInputFile');
    const ghazwanImagePreview = document.querySelector('#ghazwanPreview');
    const ghazwanUploadContent = document.querySelector('#ghazwanUploadContent');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(ghazwanEventName => {
        ghazwanDropArea.addEventListener(ghazwanEventName, ghazwanPreventDefaults, false);
        document.body.addEventListener(ghazwanEventName, ghazwanPreventDefaults, false);
    });

    ['dragenter', 'dragover'].forEach(ghazwanEventName => {
        ghazwanDropArea.addEventListener(ghazwanEventName, ghazwanHighlight, false);
    });

    ['dragleave', 'drop'].forEach(ghazwanEventName => {
        ghazwanDropArea.addEventListener(ghazwanEventName, ghazwanUnhighlight, false);
    });

    ghazwanDropArea.addEventListener('drop', ghazwanHandleDrop, false);

    ghazwanInputFile.addEventListener('change', function(ghazwanEvent) {
        ghazwanHandleFiles(ghazwanEvent.target.files);
    });

    function ghazwanPreventDefaults(ghazwanEvent) {
        ghazwanEvent.preventDefault();
        ghazwanEvent.stopPropagation();
    }

    function ghazwanHighlight(ghazwanEvent) {
        ghazwanDropArea.classList.add('border-blue-500');
    }

    function ghazwanUnhighlight(ghazwanEvent) {
        ghazwanDropArea.classList.remove('border-blue-500');
    }

    function ghazwanHandleDrop(ghazwanEvent) {
        const ghazwanDt = ghazwanEvent.dataTransfer;
        const ghazwanFiles = ghazwanDt.files;
        ghazwanHandleFiles(ghazwanFiles);
    }

    function ghazwanHandleFiles(ghazwanFiles) {
        if (ghazwanFiles[0]?.type.startsWith('image/')) {
            const ghazwanFile = ghazwanFiles[0];
            ghazwanPreviewFile(ghazwanFile);
            ghazwanInputFile.files = ghazwanFiles;
        } else {
            alert('Please upload an image file');
        }
    }

    function ghazwanPreviewFile(ghazwanFile) {
        const ghazwanReader = new FileReader();
        ghazwanReader.readAsDataURL(ghazwanFile);
        ghazwanReader.onloadend = function() {
            ghazwanImagePreview.src = ghazwanReader.result;
            ghazwanImagePreview.classList.remove('hidden');
            ghazwanUploadContent.classList.add('hidden'); // Hide the upload content when preview is shown
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.relative .gambar');
    let currentIndex = 0;

    function fadeNext() {
        images[currentIndex].style.opacity = '0';

        currentIndex = (currentIndex + 1) % images.length;

        images[currentIndex].style.opacity = '1';
    }

    setInterval(fadeNext, 5000);
});
    </script>

    <x-notify::notify />
    @notifyJs
</body>

</html>
