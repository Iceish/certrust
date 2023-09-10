@extends('web.main')

@section('body')
    @include('web.dashboard.partials.header')
    <main>
        <div class="flare" style="right: -500px;top: 200px;">
            <img src="/images/primary-flare.png" alt="flare">
        </div>
        <div class="flare" style="left: 0px;bottom: 400px; opacity: 0.3">
            <img src="/images/primary-flare.png" alt="flare">
        </div>
        <div id="wrapper">
            @yield('main')
            @include('web.dashboard.partials.footer')
        </div>
    </main>
@endsection
