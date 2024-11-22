@extends('layouts.main')
@section('content')
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen w-full flex flex-col mt-24 items-center pt-6 sm:pt-0 bg-[#f8f4f3]">
            {!! $data->container() !!}

        </div>
    </div>
@endsection

@section('js')
    <script src="{{ $data->cdn() }}"></script>

    {{ $data->script() }}
@endsection
