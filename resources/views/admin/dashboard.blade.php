@extends('layouts.main')
@section('content')
    <div class="font-sans text-gray-900 antialiased">
        <div class="w-full mt-12 bg-gray-100 p-4 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold mb-4">Dashboard</h2>

            <!-- Grid untuk Chart dan Menu Cepat -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Chart -->
                <div class="md:col-span-2 bg-white p-4 rounded-lg shadow">
                    <h2 class="text-lg font-bold mb-4">Pengaduan Per Bulan</h2>
                    <div class="w-full h-auto">
                        {!! $data->container() !!}
                    </div>
                </div>

                <!-- Menu Cepat -->
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-bold text-gray-700 mb-4">Menu Cepat</h3>
                    <div class="grid grid-cols-1 gap-4">
                        @if(Auth::guard('petugas')->user()->level == 'admin')
                        <button class="w-full h-[100px] bg-red-500 text-white p-4 rounded-lg shadow flex items-center justify-center">
                            <a href="/manage-users" class="text-center">Kelola Masyarakat</a>
                        </button>
                        <button class="w-full h-[100px] bg-green-500 text-white p-4 rounded-lg shadow flex items-center justify-center">
                            <a href="/manage-officers" class="text-center">Kelola Petugas</a>
                        </button>
                        @endif
                        <button class="w-full h-[100px] bg-blue-500 text-white p-4 rounded-lg shadow flex items-center justify-center">
                            <a href="/complaint" class="text-center">Pengaduan Baru</a>
                        </button>
                        @if(Auth::guard('petugas')->user()->level == 'petugas')
                        <button class="w-full h-[100px] bg-green-500 text-white p-4 rounded-lg shadow flex items-center justify-center">
                            <a href="/complaint-done" class="text-center">Pengaduan Selesai</a>
                        </button>
                        @endif
                        @if(Auth::guard('petugas')->user()->level == 'admin')
                        <button class="w-full h-[100px] bg-yellow-400 text-white p-4 rounded-lg shadow flex items-center justify-center">
                            <a href="/report" class="text-center">Laporan</a>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ $data->cdn() }}"></script>
    {{ $data->script() }}
@endsection
