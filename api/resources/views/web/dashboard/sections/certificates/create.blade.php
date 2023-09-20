@extends('web.dashboard.layout')

@section('breadcrumb')
    {{ Breadcrumbs::render('certificates.create') }}
@endsection

@section('tag', 'certificates')

@section('main')
    <x-dashboard.container>
        <x-slot:header class="container__header--primary">
            <h2><i class="fa-solid fa-lock"></i> New Certificate</h2>
        </x-slot:header>
        <x-slot:body>
            <p class="muted"><i class="fa-solid fa-circle-info"></i> You are creating a new {{ Request::get('type') === '0' ? 'root-authority' : (Request::get('type') === '1' ? 'sub-authority' : 'end-user certificate') }}.</p>
        </x-slot:body>
    </x-dashboard.container>

    <x-dashboard.container>
        <x-slot:body>
            <form class="form" action="{{ route('dashboard.certificates.store') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="{{ Request::get('type') }}">
                @if(!empty(Request::get('issuer')))
                    <input type="hidden" name="issuer" value="{{ Request::get('issuer') }}">
                @endif

                <div class="form__field">
                    <label for="common_name">Common Name *</label>
                    <input required type="text" id="common_name" name="common_name" value="{{ old('common_name') }}"/>
                </div>
                <div class="form__field">
                    <label for="organization">Organization *</label>
                    <input required type="text" id="organization" name="organization" value="{{ old('organization') }}"/>
                </div>
                <div class="form__field">
                    <label for="organization_unit">Organization unit</label>
                    <input type="text" id="organization_unit" name="organization_unit" value="{{ old('organization_unit') }}"/>
                </div>
                <div class="form__field">
                    <label for="country_name">Country name *</label>
                    <input required type="text" id="country_name" name="country_name" value="{{ old('country_name') }}"/>
                </div>
                <div class="form__field">
                    <label for="state_or_province_name">State or province name</label>
                    <input type="text" id="state_or_province_name" name="state_or_province_name" value="{{ old('state_or_province_name') }}"/>
                </div>
                <div class="form__field">
                    <label for="locality_name">Locality name</label>
                    <input type="text" id="locality_name" name="locality_name" value="{{ old('locality_name') }}"/>
                </div>
                <div class="form__field">
                    <label for="validity_days">Validity days *</label>
                    <input required type="number" id="validity_days" name="validity_days" value="{{ old('validity_days') }}"/>
                </div>


                <button onclick="this.form.submit()" class="btn btn--primary" type="submit"><i class="fa-solid fa-paper-plane"></i> Submit</button>
            </form>
        </x-slot:body>
    </x-dashboard.container>


@endsection
