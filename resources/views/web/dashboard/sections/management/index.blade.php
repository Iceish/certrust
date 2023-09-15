@extends('web.dashboard.layout')

@section('tag', 'management')

@section('breadcrumb')
    {{ Breadcrumbs::render('management.index') }}
@endsection

@section('main')
    <p>Management content.</p>
@endsection
