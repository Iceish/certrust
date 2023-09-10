@extends('web.main')

@section('body')
    @include('web.dashboard.partials.header')
    <main>
        @yield('main')
        @include('web.dashboard.partials.footer')
    </main>
@endsection
