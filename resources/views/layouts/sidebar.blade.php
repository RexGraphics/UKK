<div class="w-full h-full bg-gray-800 text-white text-[1rem]">
    {{-- <div class="p-4 text-2xl font-semibold text-center bg-[#e33e20]">
        <h2>Pengaduan Masyarakat</h2>
    </div> --}}
    <div class="h-24 overflow-hidden">
        <p class="text-4xl text-center pt-4">LaporPak!</p>
    </div>
    <div class="pt-4">
        @if (Auth::guard('petugas')->user()->level == 'admin')
        <ul class="space-y-2 px-4">
            <li>
                <a href="{{route('ghazwanView.admin.dashboard')}}"
                    class="flex items-center p-2 rounded-md {{request()->routeIs('ghazwanView.admin.dashboard') ? 'bg-[#e33e20]' : ''}} hover:bg-[#e33e20] transition duration-200">
                    <span class="ml-2">Dashboard Admin</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('ghazwanView.admin.manageUser') }}"
                    class="flex items-center p-2 rounded-md hover:bg-[#e33e20] transition duration-200">
                    <span class="ml-2">Kelola Pengguna</span>
                </a>
            </li> --}}

            {{-- ini teh list yang ada dropdownnya --}}
            <li class="relative">
                <button onclick="toggleDropdown('ghazwanUserDD')"
                    class="flex {{request()->routeIs('ghazwanView.admin.manage.user') || request()->routeIs('ghazwanView.admin.manage.officer') ? 'bg-[#e33e20]' : ''}} items-center p-2 w-full rounded-md hover:bg-[#e33e20] transition duration-200">
                    <span class="ml-2">Kelola Pengguna</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <ul id="ghazwanUserDD" class="{{ request()->routeIs('ghazwanView.admin.manage.user') || request()->routeIs('ghazwanView.admin.manage.officer') ? '' : 'hidden'}} flex-col space-y-1 pl-4 mt-1 border-l-2 border-[#e33e20]">
                    <li>
                        <a href="{{route('ghazwanView.admin.manage.user')}}"
                            class="flex {{request()->routeIs('ghazwanView.admin.manage.user') ? 'text-[#e33e20]' : ''}} items-center p-2 rounded-md hover:bg-[#e33e20] hover:text-white transition duration-200">
                            <span class="ml-2">Masyarakat</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('ghazwanView.admin.manage.officer')}}"
                            class="flex {{request()->routeIs('ghazwanView.admin.manage.officer') ? 'text-[#e33e20]' : ''}} items-center p-2 rounded-md hover:bg-[#e33e20] hover:text-white transition duration-200">
                            <span class="ml-2">Petugas</span>
                        </a>
                    </li>
                </ul>


            </li>

            <li class="relative">
                <button onclick="toggleDropdown('ghazwanComplaintDD')"
                    class="flex {{request()->routeIs('ghazwanView.admin.manage.complaint') ? 'bg-[#e33e20]' : ''}} items-center p-2 w-full rounded-md hover:bg-[#e33e20] transition duration-200">
                    <span class="ml-2">Pengaduan</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <ul id="ghazwanComplaintDD" class="{{ request()->routeIs('ghazwanView.admin.manage.complaint') || request()->routeIs('ghazwanView.admin.complaint.is.done') ? '' : 'hidden'}} flex-col space-y-1 pl-4 mt-1 border-l-2 border-[#e33e20]">
                    <li>
                        <a href="{{route('ghazwanView.admin.manage.complaint')}}"
                            class="flex {{request()->routeIs('ghazwanView.admin.manage.complaint') ? 'text-[#e33e20]' : ''}} items-center p-2 rounded-md hover:bg-[#e33e20] hover:text-white transition duration-200">
                            <span class="ml-2">Baru</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('ghazwanView.admin.manage.complaint.done')}}"
                            class="flex {{request()->routeIs('ghazwanView.admin.manage.officer') ? 'text-[#e33e20]' : ''}} items-center p-2 rounded-md hover:bg-[#e33e20] hover:text-white transition duration-200">
                            <span class="ml-2">Selesai</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- <li>
                <a href="{{ route('ghazwanView.admin.user.add') }}"
                    class="flex items-center p-2 rounded-md hover:bg-[#e33e20] transition duration-200">
                    <span class="ml-2">Tambah Akun Pengguna</span>
                </a>
            </li>
            <li>
                <a href="{{ route('ghazwanView.admin.officer.add') }}"
                    class="flex items-center p-2 rounded-md hover:bg-[#e33e20] transition duration-200">
                    <span class="ml-2">Tambah Akun Petugas</span>
                </a>
            </li> --}}

            <li>
                <a href="{{-- route('admin.reports') --}}"
                    class="flex items-center p-2 rounded-md hover:bg-[#e33e20] transition duration-200">
                    <span class="ml-2">Laporan</span>
                </a>
            </li>
        </ul>
        @elseif(Auth::guard('petugas')->user()->level === 'petugas')
        <ul class="space-y-2 px-4">
            <li>
                <a href="{{-- route('petugas.dashboard') --}}"
                    class="flex items-center p-2 rounded-md hover:bg-[#e33e20] transition duration-200">
                    <span class="ml-2">Dashboard Petugas</span>
                </a>
            </li>
            <li>
                <a href="{{-- route('petugas.reports') --}}"
                    class="flex items-center p-2 rounded-md hover:bg-[#e33e20] transition duration-200">
                    <span class="ml-2">Lihat Pengaduan</span>
                </a>
            </li>
        </ul>
        @endif
        <ul class="space-y-2 px-4">
            <li>
                <a href="/logout" class="flex items-center p-2 rounded-md hover:bg-[#e33e20] transition duration-200"><span class="ml-2">Keluar</span></a>
            </li>
        </ul>
    </div>
</div>
