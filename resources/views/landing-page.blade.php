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
                <a href="{{Auth::guard('masyarakat')->check() ? '/logout' : '/login'}}" class="hover:text-gray-300"><button type="button" class="text-white bg-opacity-10 bg-black hover:text-[#e33e20] border border-white hover:bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">{{Auth::guard('masyarakat')->check() ? 'Keluar' : 'Masuk'}}</button></a>

            </nav>
        </div>
    </header>

    <main class="container mx-auto my-8 p-4">
        <section class="bg-white shadow-lg rounded-lg p-6 text-center relative">
            <img src="" alt="Pengaduan Masyarakat" class="w-full mx-auto mb-4 rounded-lg">
            <div class="inlineflex absolute text-nowrap top-[50%] left-[50%] translate-x-[-50%] translate-y-[-50%]">
                <h2 class="text-3xl font-bold text-[#f84525] mb-4">Aspirasi Anda, Prioritas Kami</h2>
                <p class="text-gray-700 mb-6">Laporkan berbagai masalah yang Anda hadapi di lingkungan sekitar dengan cepat dan mudah. Kami siap membantu menyelesaikan pengaduan Anda.</p>
                <a href="#form" class="bg-[#f84525] text-white px-6 py-2 rounded-md hover:bg-[#e33e20]">Laporkan Sekarang</a>

            </div>
        </section>

        <section id="about" class="mt-12 p-6 bg-gray-200 rounded-lg">
            <h3 class="text-2xl font-semibold text-[#f84525] mb-2">Tentang Kami</h3>
            <p class="text-gray-600">Pengaduan Masyarakat adalah platform yang didedikasikan untuk membantu masyarakat melaporkan berbagai keluhan dan permasalahan di lingkungan sekitar secara efektif dan efisien.</p>
        </section>

        <section id="form" class="mt-12 p-6 bg-white shadow-lg rounded-lg">
            <h3 class="text-2xl font-semibold text-[#f84525] mb-4">Form Pengaduan</h3>
            <form action="/submit-complaint" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:border-[#f84525]" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:border-[#f84525]" required>
                </div>
                <div class="mb-4">
                    <label for="complaint" class="block text-gray-700">Pengaduan</label>
                    <textarea id="complaint" name="complaint" rows="4" class="w-full border border-gray-300 p-2 rounded-md focus:outline-none focus:border-[#f84525]" required></textarea>
                </div>
                <button type="submit" class="bg-[#f84525] text-white px-4 py-2 rounded-md hover:bg-[#e33e20]">Kirim Pengaduan</button>
            </form>
        </section>
    </main>

    <footer class="bg-[#f84525] text-white text-center py-4 mt-8">
        <p>&copy; 2024 LaporPak!. All rights reserved.</p>
    </footer>
</body>
</html>
