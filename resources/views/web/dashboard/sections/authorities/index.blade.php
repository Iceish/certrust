@extends('web.dashboard.layout')

@section('breadcrumb')
    {{ Breadcrumbs::render('authorities.index') }}
@endsection

@section('main')
    <x-dashboard.container>

        <x-slot:header>
            <h2><i class="fa-solid fa-lock"></i> Authorities</h2>
        </x-slot:header>

        <x-slot:body>
            <a href="{{ route('dashboard.authorities.create', ['type'=>'0']) }}" class="btn">
                New Authority
            </a>

            <div class="table">
                <div class="cell header">
                    <div>common name</div>
                    <div>organization</div>
                    <div>organization unit</div>
                    <div>country name</div>
                    <div>state or province name</div>
                    <div>locality name</div>
                    <div>expires on</div>
                </div>
                @foreach($rootAuthorities as $rootAuthority)
                    <a href="{{ route('dashboard.authorities.show', $rootAuthority->id) }}" class="cell row">
                        <div>{{ $rootAuthority->common_name }}</div>
                        <div>{{ $rootAuthority->organization }}</div>
                        <div>{{ $rootAuthority->organization_unit }}</div>
                        <div>{{ $rootAuthority->country_name }}</div>
                        <div>{{ $rootAuthority->state_or_province_name }}</div>
                        <div>{{ $rootAuthority->locality_name }}</div>
                        <div>{{ $rootAuthority->expires_on->format('d M, Y') }} <span class="muted">({{ date_diff($rootAuthority->expires_on, new DateTime())->days }} days left)</span></div>
                    </a>
                @endforeach
            </div>
        </x-slot:body>

    </x-dashboard.container>

@endsection
