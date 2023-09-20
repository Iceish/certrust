@extends('web.dashboard.layout')

@section('tag', 'settings')

@section('breadcrumb')
    {{ Breadcrumbs::render('settings.index') }}
@endsection

@section('main')
    <p>Settings content.</p>
@endsection
