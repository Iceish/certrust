@extends('web.dashboard.layout')

@section('main')
    <p>Certificate content.</p>

    @foreach($certificates as $certificate)

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $certificate->common_name }}</h5>
                <p class="card-text">{{ $certificate->country_name }}</p>
                <a href="#" class="btn btn-primary">View</a>
            </div>
        </div>
        <p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/><p>Lorem</p><br/>
    @endforeach

@endsection
