@extends('web.dashboard.layout')

@section('breadcrumb')
    {{ Breadcrumbs::render('settings.index') }}
@endsection

@section('main')
    <p>Settings content.</p>
@endsection
