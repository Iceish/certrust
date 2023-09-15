@extends('web.dashboard.layout')

@section('breadcrumb')
    {{ Breadcrumbs::render('certificates.show', $authority) }}
@endsection

@section('tag', 'authorities')

@section('main')
    <x-dashboard.container>
        <x-slot:header class="container__header--primary">
            <i class="fa-solid fa-lock"></i> <p>{{ $authority->common_name }}</p>
        </x-slot:header>
        <x-slot:body class="authority-show__nav">
            <div class="labeled-list">
                <ul>
                    <li>
                        <div>Common name</div>
                        <div>{{ $authority->common_name }}</div>
                    </li>
                    <li>
                        <div>Organization</div>
                        <div>{{ $authority->organization }}</div>
                    </li>
                    <li>
                        <div>Organization unit</div>
                        <div>{{ $authority->organization_unit }}</div>
                    </li>
                    <li>
                        <div>Country name</div>
                        <div>{{ $authority->country_name }}</div>
                    </li>
                    <li>
                        <div>State or province name</div>
                        <div>{{ $authority->state_or_province_name }}</div>
                    </li>
                    <li>
                        <div>Locality name</div>
                        <div>{{ $authority->locality_name }}</div>
                    </li>
                </ul>
            </div>
            <div class="vertical-separator"></div>
            <div class="action-panel">
                <a href="{{ route('dashboard.certificates.download', ['field'=> 'public_key', 'authority' => $authority]) }}" class="muted"><i class="fa-solid fa-file-lines"></i><p>Download CRT</p></a>
                <a href="{{ route('dashboard.certificates.download', ['field'=> 'private_key', 'authority' => $authority]) }}" class="muted"><i class="fa-solid fa-key"></i><p>Download private key</p></a>
                <a href="{{ route('dashboard.certificates.destroy', $authority->id) }}" class="danger"><i class="fa-solid fa-trash"></i><p>Delete</p></a>
            </div>

        </x-slot:body>
    </x-dashboard.container>



    <div class="authority__issued-certificates">
        <x-dashboard.container>
            <x-slot:header class="container__header--secondary">
                <i class="fa-solid fa-lock"></i> <p>Sub-CA</p>
            </x-slot:header>
            <x-slot:body>
                <a href="{{ route('dashboard.certificates.create', ['type'=>'1', 'issuer'=> $authority->id]) }}" class="btn btn--primary create_authority_btn">
                    <i class="fa-regular fa-square-plus"></i> <p>Create Sub-CA</p>
                </a>
                <div class="table">
                    <div class="cell header">
                        <div>Common name</div>
                        <div>Organization</div>
                        <div>Country name</div>
                        <div>State or province name</div>
                        <div>Expires on</div>
                        <div>Actions</div>
                    </div>
                    @foreach($certificates as $certificate)
                        <div class="cell row">
                            <div>{{ $certificate->common_name }}</div>
                            <div>{{ $certificate->organization }}</div>
                            <div>{{ $certificate->country_name }}</div>
                            <div>{{ $certificate->state_or_province_name }}</div>
                            <div><span class="status {{ $certificate->hasExpired() ? 'status--danger' : ($certificate->expireSoon() ? 'status--warning' : '')}}"></span> {{ $certificate->expires_on->format('d M, Y') }} <span class="muted">({{ date_diff($certificate->expires_on, new DateTime())->days }} days left)</span></div>
                            <div class="row__actions"><a href="{{ route('dashboard.certificates.show', ['authority' => $certificate]) }}"><i class="fa-solid fa-xl fa-magnifying-glass"></i></a><a class="btn btn--primary" href="{{ route('dashboard.certificates.create', ['type' => 2, 'issuer' => $certificate->id]) }}">New cert</a></div>
                        </div>
                    @endforeach
                </div>
            </x-slot:body>
        </x-dashboard.container>

        <x-dashboard.container>
            <x-slot:header class="container__header--tertiary">
                <i class="fa-solid fa-lock"></i> <p>End-user certificate</p>
            </x-slot:header>
            <x-slot:body>
                <a href="{{ route('dashboard.certificates.create', ['type'=>'2', 'issuer'=> $authority->id]) }}" class="btn btn--primary create_authority_btn">
                    <i class="fa-regular fa-square-plus"></i> <p>Create end-user certificate</p>
                </a>
                <div class="table">
                    <div class="cell header">
                        <div>Common name</div>
                        <div>Organization</div>
                        <div>Country name</div>
                        <div>State or province name</div>
                        <div>Expires on</div>
                        <div>Actions</div>
                    </div>
                    @foreach($certificates as $certificate)
                        <div class="cell row">
                            <div>{{ $certificate->common_name }}</div>
                            <div>{{ $certificate->organization }}</div>
                            <div>{{ $certificate->country_name }}</div>
                            <div>{{ $certificate->state_or_province_name }}</div>
                            <div><span class="status {{ $certificate->hasExpired() ? 'status--danger' : ($certificate->expireSoon() ? 'status--warning' : '')}}"></span> {{ $certificate->expires_on->format('d M, Y') }} <span class="muted">({{ date_diff($certificate->expires_on, new DateTime())->days }} days left)</span></div>
                            <div class="row__actions"><a href="{{ route('dashboard.certificates.show', ['authority' => $certificate]) }}"><i class="fa-solid fa-xl fa-magnifying-glass"></i></a><a class="btn btn--primary" href="{{ route('dashboard.certificates.create', ['type' => 2, 'issuer' => $certificate->id]) }}">New cert</a></div>
                        </div>
                    @endforeach
                </div>
            </x-slot:body>
        </x-dashboard.container>
    </div>





@endsection
