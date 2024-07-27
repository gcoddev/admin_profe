@extends('errors.errors_layout')

@section('title')
    403 - Acceso denegado
@endsection

@section('error-content')
    <h2>403</h2>
    <p>Se deniega el acceso a este recurso en el servidor</p>
    <hr>
    <p class="mt-2">
        {{ $exception->getMessage() }}
    </p>
    <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
    <a href="{{ route('admin.login') }}">Login Again !</a>
@endsection
