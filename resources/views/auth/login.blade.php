<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengaduan Masyarakat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @notifyCss
</head>
<body>
    <div class="fixed inset-0 -z-10">
        <div id="ghazwanBackground1" class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-1000 opacity-100"
            style="background-image: url('{{ asset('assets/images/bg1.jpeg') }}')">
        </div>
        <div id="ghazwanBackground2" class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-1000 opacity-0"
            style="background-image: url('{{ asset('assets/images/bg2.jpg') }}')">
        </div>
        <div id="ghazwanBackground3" class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-1000 opacity-0"
            style="background-image: url('{{ asset('assets/images/bg3.jpg') }}')">
        </div>

        <div class="absolute inset-0 bg-gradient-to-br from-orange-500/40 to-orange-600/40"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
    </div>

    <div class="font-sans text-gray-900 antialiased">
        <div>
            <a href="/">
                <h2 class="font-bold text-3xl p-12 absolute text-white drop-shadow-lg">Kembali</h2>
            </a>
        </div>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <h2 class="font-bold text-3xl text-white drop-shadow-lg">Pengaduan <span
                            class="bg-[#f84525] text-white px-2 rounded-md shadow-lg">Masyarakat</span></h2>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/90 shadow-lg backdrop-blur-sm overflow-hidden sm:rounded-lg">
                <form method="POST" action="{{ route('ghazwanForm.login') }}" id="ghazwanLoginForm">
                    @csrf
                    <div class="py-8">
                        <center>
                            <span class="text-2xl font-semibold">Masuk</span>
                        </center>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="ghazwanUsername"
                            value="Nama Pengguna" />
                        <input type='text' name='ghazwanUsername' id="ghazwanUsername" placeholder='Nama Pengguna'
                            class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#f84525]" />
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="ghazwanPassword"
                            value="Kata Sandi" />
                        <div class="relative">
                            <input id="ghazwanPassword" type="password" name="ghazwanPassword" placeholder="Kata Sandi"
                                required autocomplete="current-password"
                                class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#f84525]">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <button type="button" id="ghazwanShowPassword"
                                    class="text-gray-500 focus:outline-none focus:text-gray-600 hover:text-gray-600">
                                    <img src="{{ asset('/assets/images/logo.png') }}" alt="">
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <span class="text-sm text-gray-600">Belum punya akun?
                            <a href="/register" class="hover:underline">Daftar</a>
                        </span>
                        <button id="ghazwanSubmitButton"
                            class="ms-4 inline-flex items-center px-4 py-2 bg-[#f84525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none transition ease-in-out duration-150 shadow-lg">
                            Masuk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-notify::notify />
    @notifyJs

    <script>
        const ghazwanBackgrounds = ['ghazwanBackground1', 'ghazwanBackground2', 'ghazwanBackground3'];
        let ghazwanCurrentBackground = 0;

        function ghazwanFadeBackground() {
            document.getElementById(ghazwanBackgrounds[ghazwanCurrentBackground]).classList.replace('opacity-100', 'opacity-0');

            ghazwanCurrentBackground = (ghazwanCurrentBackground + 1) % ghazwanBackgrounds.length;

            document.getElementById(ghazwanBackgrounds[ghazwanCurrentBackground]).classList.replace('opacity-0', 'opacity-100');
        }

        const ghazwanBackgroundInterval = setInterval(ghazwanFadeBackground, 5000);

        const ghazwanPasswordInput = document.getElementById('ghazwanPassword');
        const ghazwanShowPassword = document.getElementById('ghazwanShowPassword');

        ghazwanShowPassword.addEventListener('click', () => {
            const ghazwanPasswordType = ghazwanPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            ghazwanPasswordInput.setAttribute('type', ghazwanPasswordType);
        });
    </script>
</body>
</html>
