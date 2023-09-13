@extends('web.dashboard.layout')

@section('main')
    <h2 id="section-title"><i class="fa-solid fa-lock"></i> {{ $authority->common_name }}'s certificates</h2>
    <br>
    <a href="#"><i class="fa-solid fa-file-lines"></i></a> <a href="#"><i class="fa-solid fa-key"></i></a> <a href="{{ route('dashboard.authorities.destroy', $authority->id) }}"><i class="fa-solid fa-trash"></i></a>

    <a class="btn" href="{{ route('dashboard.authorities.create', ['type'=>'1', 'issuer'=> $authority->id]) }}">Create Sub-CA</a>
    <div class="table">
        <div class="cell header">
            <div>common_name</div>
            <div>organization</div>
            <div>organization_unit</div>
            <div>country_name</div>
            <div>state_or_province_name</div>
            <div>locality_name</div>
            <div>expires_on</div>
            <div>action</div>
        </div>
        <div class="separator"></div>
        @foreach($certificates as $certificate)
            <div class="cell row">
                <div>{{ $certificate->common_name }}</div>
                <div>{{ $certificate->organization }}</div>
                <div>{{ $certificate->organization_unit }}</div>
                <div>{{ $certificate->country_name }}</div>
                <div>{{ $certificate->state_or_province_name }}</div>
                <div>{{ $certificate->locality_name }}</div>
                <div>{{ $certificate->expires_on }}</div>
                <div><a class="btn" href="{{ route('dashboard.authorities.create', ['type' => 2, 'issuer' => $certificate->id]) }}">New cert</a></div>
            </div>
        @endforeach
    </div>


@endsection
