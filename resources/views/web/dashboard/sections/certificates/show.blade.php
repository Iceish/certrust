@extends('web.dashboard.layout')

@section('breadcrumb')
    {{ Breadcrumbs::render('certificates.show', $certificate) }}
@endsection

@section('tag', 'certificates')

@section('main')
    <div class="certificate-panel">
        <x-dashboard.container>
            <x-slot:header class="container__header--primary">
                <i class="fa-solid fa-lock"></i> <p>{{ $certificate->common_name }}</p>
            </x-slot:header>
            <x-slot:body class="certificate-panel__detailed">
                <div class="certificate-panel__infos">
                    <div class="labeled-list">
                        <ul>
                            <li>
                                <div>Common name</div>
                                <div>{{ $certificate->common_name }}</div>
                            </li>
                            <li>
                                <div>Organization</div>
                                <div>{{ $certificate->organization }}</div>
                            </li>
                            <li>
                                <div>Organization unit</div>
                                <div>{{ $certificate->organization_unit }}</div>
                            </li>
                            <li>
                                <div>Country name</div>
                                <div>{{ $certificate->country_name }}</div>
                            </li>
                            <li>
                                <div>State or province name</div>
                                <div>{{ $certificate->state_or_province_name }}</div>
                            </li>
                            <li>
                                <div>Locality name</div>
                                <div>{{ $certificate->locality_name }}</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </x-slot:body>
        </x-dashboard.container>

        <x-dashboard.container>
            <x-slot:body class="container__body--align-with-full-container">
                <div class="certificate-panel__actions">
                    <a href="{{ route('dashboard.certificates.download', ['field'=> 'public_key', 'certificate' => $certificate]) }}" class="muted"><i class="fa-solid fa-file-lines"></i><p>Download certificate (.crt)</p></a>
                    <a href="{{ route('dashboard.certificates.download', ['field'=> 'private_key', 'certificate' => $certificate]) }}" class="muted"><i class="fa-solid fa-key"></i><p>Download private key (.key)</p></a>
                    <a href="{{ route('dashboard.certificates.destroy', $certificate->id) }}" class="danger"><i class="fa-solid fa-trash"></i><p>Delete</p></a>
                </div>
            </x-slot:body>
        </x-dashboard.container>
    </div>

    <x-dashboard.container>
        <x-slot:body class="certificate-breadcrumb">
                <i class="fa-solid fa-building-lock certificate-breadcrumb__item"></i>
                @foreach($paths as $path)
                    <a href="{{ route('dashboard.certificates.show', ['certificate' => $path['id']]) }}" class="certificate-breadcrumb__item">{{ $path['common_name'] }}</a>
                    @if (!$loop->last) <span><i class="certificate-breadcrumb__item fa-solid fa-arrow-right"></i></span> @endif
                @endforeach
        </x-slot:body>
    </x-dashboard.container>

    @unless($certificate->type === \App\Enums\CertificateTypeEnum::CERT)

        <div class="certificate-issued-items">

            <x-dashboard.container>
                <x-slot:header class="container__header--secondary">
                    <i class="fa-solid fa-lock"></i> <p>Sub-CA</p>
                </x-slot:header>
                <x-slot:body>
                    <a href="{{ route('dashboard.certificates.create', ['type'=>'1', 'issuer'=> $certificate->id]) }}" class="btn btn--primary">
                        <i class="fa-regular fa-square-plus"></i> <p>New</p>
                    </a>
                    <x-dashboard.Certificate-table :certificates="$issuedSubCAs"/>
                </x-slot:body>
            </x-dashboard.container>

            <x-dashboard.container>
                <x-slot:header class="container__header--tertiary">
                    <i class="fa-solid fa-lock"></i> <p>End-user certificate</p>
                </x-slot:header>
                <x-slot:body>
                    <a href="{{ route('dashboard.certificates.create', ['type'=>'2', 'issuer'=> $certificate->id]) }}" class="btn btn--primary">
                        <i class="fa-regular fa-square-plus"></i> <p>New</p>
                    </a>
                    <x-dashboard.Certificate-table :certificates="$issuedCertificates"/>
                </x-slot:body>
            </x-dashboard.container>
        </div>
    @endunless

@endsection
