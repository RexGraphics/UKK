<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @notifyCss

</head>
<body class="bg-gray-100">
    <div class="w-screen h-screen overflow-x-hidden">
        <header class="bg-[#f84525] text-white w-[80%] ml-[20%] h-20 top-0 fixed z-40">

        </header>

        <nav class="w-[20%] h-screen fixed top-0 left-0">
            @include('layouts.sidebar')

        </nav>

        <main class="container w-[80%] h-full ml-[20%] mt-[2rem] overflow-hidden">
            @yield('content')
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
@yield('js')
</body>
</html>
