@extends('web.dashboard.layout')

@section('main')
    <h2 id="section-title"><i class="fa-solid fa-lock"></i> Authorities</h2>
    <br>

    <a href="{{ route('dashboard.authorities.create') }}" class="btn">
        New Authority
    </a>
    <div class="table">
        <div class="cell header">
            <div>common_name</div>
            <div>organization</div>
            <div>organization_unit</div>
            <div>country_name</div>
            <div>state_or_province_name</div>
            <div>locality_name</div>
            <div>expires_on</div>
        </div>
        <div class="separator"></div>
        @foreach($rootAuthorities as $rootAuthority)
            <a href="{{ route('dashboard.authorities.show', $rootAuthority->id) }}" class="cell row">
                <div>{{ $rootAuthority->common_name }}</div>
                <div>{{ $rootAuthority->organization }}</div>
                <div>{{ $rootAuthority->organization_unit }}</div>
                <div>{{ $rootAuthority->country_name }}</div>
                <div>{{ $rootAuthority->state_or_province_name }}</div>
                <div>{{ $rootAuthority->locality_name }}</div>
                <div>{{ $rootAuthority->expires_on }}</div>
            </a>
        @endforeach
    </div>


@endsection
