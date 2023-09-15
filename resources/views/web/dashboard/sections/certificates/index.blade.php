@extends('web.dashboard.layout')

@section('breadcrumb')
    {{ Breadcrumbs::render('certificates.index') }}
@endsection

@section('tag', 'certificates')

@section('main')
    <x-dashboard.container>
        <x-slot:header class="container__header--primary">
            <i class="fa-solid fa-lock"></i> <p>Authorities</p>
        </x-slot:header>
        <x-slot:body>
            <p class="muted"><i class="fa-solid fa-circle-info"></i> A CA root, or Certificate Authority root, is the foundational entity in a public key infrastructure that issues and verifies digital certificates. </p>
        </x-slot:body>
    </x-dashboard.container>

    <a href="{{ route('dashboard.certificates.create', ['type'=>'0']) }}" class="btn btn--primary create_authority_btn">
        <i class="fa-regular fa-square-plus"></i> <p>New CA-Root</p>
    </a>

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
                                <a href="{{ route('dashboard.certificates.show', ['certificate'=>$rootAuthority->id]) }}"><i class="fa-solid fa-xl fa-magnifying-glass"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card__body">
                        <div class="card__numeric-info"><p>{{ $rootAuthority->countCertificatesByType()['sub_ca'] }}</p><p>Sub-CA</p></div>
                        <div class="card__numeric-info"><p>{{ $rootAuthority->countCertificatesByType()['cert'] }}</p><p>Certificates</p></div>
                    </div>
                    <hr>
                    <div class="card__footer">
                        <div class="status {{ $rootAuthority->hasExpired() ? 'status--danger' : ($rootAuthority->expireSoon() ? 'status--warning' : '')}}"></div>
                        <p> {{ $rootAuthority->hasExpired() ? 'Expired on' : 'Expire on' }} {{ $rootAuthority->expires_on->format('d M, Y') }} <span class="muted">({{ date_diff($rootAuthority->expires_on, new DateTime())->days }} {{ $rootAuthority->hasExpired() ? 'days ago' : 'days left' }})</span></p>
                    </div>

                </x-slot:body>

            </x-dashboard.container>
        @endforeach
    </div>



@endsection
