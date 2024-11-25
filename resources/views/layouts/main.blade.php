<!DOCTYPE html>
<html lang="en" class="light">

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
    <div class="w-screen h-screen overflow-x-hidden">
        <header class="bg-[#f84525] text-white w-[80%] ml-[20%] h-20 top-0 fixed z-40 flex items-center px-6">
            <h1 class="text-lg md:text-xl lg:text-2xl font-bold tracking-wide">
                Halo, {{ Auth::guard('petugas')->user()->nama_petugas }}
            </h1>
        </header>


        <nav class="w-[20%] h-screen fixed top-0 left-0">
            @include('layouts.sidebar')

        </nav>

        <main class="container flex-grow min-h-full w-[80%] ml-[20%] mt-[2rem] overflow-hidden">
            @yield('content')
            <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah kamu yakin untuk keluar?</h3>
                            <a href="/logout" data-modal-hide="popup-modal" type="button" class="text-white !bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">Yakin
                            </a>
                            <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Tidak</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="bg-[#f84525] w-[80%] ml-[20%] text-white text-center py-4">
            <p>&copy; 2024 LaporPak!. All rights reserved.</p>
        </footer>

    </div>

    <x-notify::notify />
    @notifyJs
    <script>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle("hidden");
        }
    </script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    @yield('js')
</body>

</html>
