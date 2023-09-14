@extends('web.dashboard.layout')

@section('breadcrumb')
    {{ Breadcrumbs::render('management.index') }}
@endsection

@section('main')
    <p>Management content.</p>
@endsection
