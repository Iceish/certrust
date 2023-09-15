@extends('web.main')

@section('body')
    @include('web.dashboard.partials.header')
    <main id="@yield('tag', 'undefined')">
        <div class="flare" style="right: -500px;top: 200px;">
            <img src="/images/primary-flare.png" alt="flare">
        </div>
        <div class="flare" style="left: 0px;bottom: 400px; opacity: 0.3">
            <img src="/images/primary-flare.png" alt="flare">
        </div>
        <div class="flare" style="left: 300px;top: 400px; opacity: 0.6; transform: scale(0.5)">
            <img src="/images/accent-flare.png" alt="flare">
        </div>
        <div id="wrapper">
            @include('web.dashboard.partials.hero')
            @yield('main')
            @include('web.dashboard.partials.footer')
        </div>
    </main>
@endsection
