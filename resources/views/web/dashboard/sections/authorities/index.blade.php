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
        </x-slot:body>
    </x-dashboard.container>

    <div class="grid-card">
        @foreach($rootAuthorities as $rootAuthority)
            <x-dashboard.container>

                <x-slot:body class="card">
                    <div class="card__header">
                        <div>
                            <p class="card__title">{{ $rootAuthority->common_name }}</p>
                            <p class="card__sub-title muted">{{ $rootAuthority->organization }}, {{ $rootAuthority->organization_unit }}, {{ $rootAuthority->country_name }}, {{ $rootAuthority->state_or_province_name }}, {{ $rootAuthority->locality_name }}.</p>
                        </div>
                        <div>
                            <div class="card__actions">
                                <a href="{{ route('dashboard.authorities.show', ['authority'=>$rootAuthority->id]) }}" class="link"><i class="fa-solid fa-xl fa-magnifying-glass"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card__body">
                        <div class="card__numeric-info"><p>{{ $rootAuthority->countCertificatesByType()['sub_ca'] }}</p><p>Sub-CA</p></div>
                        <div class="card__numeric-info"><p>{{ $rootAuthority->countCertificatesByType()['cert'] }}</p><p>Certificates</p></div>
                    </div>
                    <hr>
                    <div class="card__footer">
                        <div class="card__status {{ $rootAuthority->hasExpired() ? 'card__status--danger' : ($rootAuthority->expireSoon() ? 'card__status--warning' : '')}}"></div>
                        <p> {{ $rootAuthority->hasExpired() ? 'Expired on' : 'Expire on' }} {{ $rootAuthority->expires_on->format('d M, Y') }} <span class="muted">({{ date_diff($rootAuthority->expires_on, new DateTime())->days }} {{ $rootAuthority->hasExpired() ? 'days ago' : 'days left' }})</span></p>
                    </div>

                </x-slot:body>

            </x-dashboard.container>
        @endforeach
    </div>



@endsection
