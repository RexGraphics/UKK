@extends('layouts.main')
@section('content')
    <div class="font-sans text-gray-900 antialiased">
        <div class="h-auto w-full flex flex-col mt-24 items-center pt-6 sm:pt-0 bg-[#f8f4f3] pb-8">
            <div class="w-[95%] flex justify-between items-center mb-4">
                <form method="GET" class="flex items-center gap-2">
                    <label for="per_page" class="text-sm text-gray-700">Tampilkan:</label>
                    <select name="per_page" id="per_page" class="border border-gray-300 text-sm rounded-lg p-2"
                            onchange="this.form.submit()">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </form>
            </div>
            <div class="w-[95%] relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Keterangan Waktu</th>
                            <th scope="col" class="px-6 py-3">ID Pelaku</th>
                            <th scope="col" class="px-6 py-3">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ghazwanActivity as $activity)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $activity->created_at }}</td>
                                <td class="px-6 py-4">{{ $activity->causer_id }}</td>
                                <td class="px-6 py-4">{{ $activity->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex w-full items-center justify-between border-t border-gray-200 px-4 py-3 sm:px-6">

                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div class="flex flex-col sm:flex-row items-center justify-between border-t border-gray-200 px-4 py-3 sm:px-6 w-full">
                        <div class="w-full sm:w-auto mb-4 sm:mb-0">
                            <p class="text-sm text-gray-700">
                                Showing
                                <span class="font-medium">{{ $ghazwanActivity->firstItem() }}</span>
                                to
                                <span class="font-medium">{{ $ghazwanActivity->lastItem() }}</span>
                                of
                                <span class="font-medium">{{ $ghazwanActivity->total() }}</span>
                                results
                            </p>
                        </div>
                        <div class="w-full sm:w-auto">
                            <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                                {{-- Tombol Previous --}}
                                @if ($ghazwanActivity->onFirstPage())
                                    <span
                                        class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @else
                                    <a href="{{ $ghazwanActivity->previousPageUrl() }}"
                                       class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif

                                {{-- Pagination --}}
                                @foreach ($ghazwanActivity->links()->elements[0] as $page => $url)
                                    @if ($page == $ghazwanActivity->currentPage())
                                        <span
                                            class="relative z-10 inline-flex items-center bg-custom-orange px-4 py-2 text-sm font-semibold text-white">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}"
                                           class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

                                {{-- Tombol Next --}}
                                @if ($ghazwanActivity->hasMorePages())
                                    <a href="{{ $ghazwanActivity->nextPageUrl() }}"
                                       class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @else
                                    <span
                                        class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25-4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                                  clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                @endif
                            </nav>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
