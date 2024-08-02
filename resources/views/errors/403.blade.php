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
    <a href="{{ route('admin.dashboard') }}">Regresar al panel de control</a>
    <a href="{{ route('admin.login') }}"> !Iniciar sesión nuevamente!</a>
@endsection
