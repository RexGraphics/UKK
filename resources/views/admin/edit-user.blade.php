@extends("layouts.main")
@section("content")
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen w-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#f8f4f3]">
            <form method="POST" action="/register/user/edit/{{$ghazwanUser->id}}" class="w-full">
                @csrf
                <div class="p-8">
                    <span class="text-2xl font-semibold">Tambah Akun</span>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6 px-8">
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="ghazwanNik" value="NIK" />
                        <input type="text" name="ghazwanNik" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="NIK" value="{{$ghazwanUser->nik}}"
                            class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#f84525]" />
                        @error("ghazwanNik")
                            <p class="text-red-600 text-xs pl-2 pt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="ghazwanName" value="Nama Anda" />
                        <input type="text" name="ghazwanName" placeholder="Nama Anda" value="{{$ghazwanUser->nama}}"
                            class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#f84525]" />
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="ghazwanPhone" value="Nama Telepon" />
                        <input type="text" name="ghazwanPhone" placeholder="No Telepon" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="{{$ghazwanUser->telp}}"
                            class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#f84525]" />
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="ghazwanUsername"
                            value="Nama Pengguna" />
                        <input type="text" name="ghazwanUsername" placeholder="Nama Pengguna" value="{{$ghazwanUser->username}}"
                            class="w-full rounded-md py-2.5 px-4 border text-sm outline-[#f84525]" />
                        @error("ghazwanUsername")
                            <p class="text-red-600 text-xs pl-2 pt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700" for="ghazwanPassword" value="Kata Sandi" />
                        <div class="relative">
                            <input id="ghazwanPassword" type="password" name="ghazwanPassword" placeholder="Kata Sandi"
                                autocomplete="current-password"
                                class = "w-full rounded-md py-2.5 px-4 border text-sm outline-[#f84525]">

                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                                <button type="button" id="ghazwanShowPassword"
                                    class="text-gray-500 focus:outline-none focus:text-gray-600 hover:text-gray-600">
                                    <img src="{{ asset('/assets/images/logo.png') }}" alt="">
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <input type="checkbox" id="remember_me" name="remember" class = "rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"]) !!}>
                            <span class="ms-2 text-sm text-gray-600">Remember Me</span>
                        </label>
                    </div> --}}

                    <div class="flex items-center justify-end mt-4">
                        <button class ="ms-4 inline-flex items-center px-4 py-2 bg-[#f84525] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-800 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Ubah
                        </button>

                    </div>
                </div>


            </form>
        </div>
    </div>
@endsection

@section("js")
    <script>
        const ghazwanPasswordInput = document.getElementById("ghazwanPassword");
        const ghazwanShowPassword = document.getElementById("ghazwanShowPassword");

        ghazwanShowPassword.addEventListener("click", () => {
            const type = ghazwanPasswordInput.getAttribute("type") === "password" ? "text" : "password";
            ghazwanPasswordInput.setAttribute("type", type);
        });
    </script>
@endsection
