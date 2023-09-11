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
        @foreach($authorities as $authority)
            <a href="{{ route('dashboard.authorities.show', $authority->id) }}" class="cell row">
                <div>{{ $authority->common_name }}</div>
                <div>{{ $authority->organization }}</div>
                <div>{{ $authority->organization_unit }}</div>
                <div>{{ $authority->country_name }}</div>
                <div>{{ $authority->state_or_province_name }}</div>
                <div>{{ $authority->locality_name }}</div>
                <div>{{ $authority->expires_on }}</div>
            </a>
        @endforeach
    </div>


@endsection
