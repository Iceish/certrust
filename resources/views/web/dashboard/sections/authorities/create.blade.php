@extends('web.dashboard.layout')

@section('main')
    <h2 id="section-title"><i class="fa-solid fa-lock"></i> New authority</h2>
    <br>

    <form class="form" action="{{ route('dashboard.authorities.store') }}" method="POST">
        @csrf
        <div class="form__field">
            <label for="common_name">Common Name *</label>
            <input required type="text" id="common_name" name="common_name" />
        </div>
        <div class="form__field">
            <label for="organization">Organization *</label>
            <input required type="text" id="organization" name="organization" />
        </div>
        <div class="form__field">
            <label for="organization_unit">Organization unit</label>
            <input type="text" id="organization_unit" name="organization_unit" />
        </div>
        <div class="form__field">
            <label for="country_name">Country name *</label>
            <input required type="text" id="country_name" name="country_name" />
        </div>
        <div class="form__field">
            <label for="state_or_province_name">State or province name</label>
            <input type="text" id="state_or_province_name" name="state_or_province_name" />
        </div>
        <div class="form__field">
            <label for="locality_name">Locality name</label>
            <input type="text" id="locality_name" name="locality_name" />
        </div>
        <div class="form__field">
            <label for="validity_days">Validity days *</label>
            <input required type="number" id="validity_days" name="validity_days" />
        </div>


        <input class="btn" type="submit" value="Submit"/>
    </form>
@endsection
