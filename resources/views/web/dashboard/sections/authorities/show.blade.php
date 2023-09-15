@extends('web.dashboard.layout')

@section('breadcrumb')
    {{ Breadcrumbs::render('authorities.show', $authority) }}
@endsection

@section('tag', 'authorities')

@section('main')

    <x-dashboard.container>
        <x-slot:header>
            <h2><i class="fa-solid fa-lock"></i> {{ $authority->common_name }}</h2>
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
                <a href="{{ route('dashboard.authorities.download', ['field'=> 'public_key', 'authority' => $authority]) }}" class="muted"><i class="fa-solid fa-file-lines"></i><p>Download CRT</p></a>
                <a href="{{ route('dashboard.authorities.download', ['field'=> 'private_key', 'authority' => $authority]) }}" class="muted"><i class="fa-solid fa-key"></i><p>Download private key</p></a>
                <a href="{{ route('dashboard.authorities.destroy', $authority->id) }}" class="danger"><i class="fa-solid fa-trash"></i><p>Delete</p></a>
            </div>

        </x-slot:body>
    </x-dashboard.container>
    <a href="{{ route('dashboard.authorities.create', ['type'=>'1', 'issuer'=> $authority->id]) }}" class="btn btn--primary create_authority_btn">
        <i class="fa-regular fa-square-plus"></i> <p>Create Sub-CA</p>
    </a>

    <x-dashboard.container>
        <x-slot:body>
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
                @foreach($certificates as $certificate)
                    <div class="cell row">
                        <div>{{ $certificate->common_name }}</div>
                        <div>{{ $certificate->organization }}</div>
                        <div>{{ $certificate->organization_unit }}</div>
                        <div>{{ $certificate->country_name }}</div>
                        <div>{{ $certificate->state_or_province_name }}</div>
                        <div>{{ $certificate->locality_name }}</div>
                        <div>{{ $certificate->expires_on->format('d M, Y') }} <span class="muted">({{ date_diff($certificate->expires_on, new DateTime())->days }} days left)</span></div>
                        <div><a class="btn btn--primary" href="{{ route('dashboard.authorities.create', ['type' => 2, 'issuer' => $certificate->id]) }}">New cert</a></div>
                    </div>
                @endforeach
            </div>
        </x-slot:body>
    </x-dashboard.container>




@endsection
