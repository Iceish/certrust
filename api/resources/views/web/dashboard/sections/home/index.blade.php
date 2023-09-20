@extends('web.dashboard.layout')

@section('tag', 'home')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('main')
    <p>Home content.</p>
@endsection
