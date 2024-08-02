@extends('errors.errors_layout')

@section('title')
404 - Página no encontrada
@endsection

@section('error-content')
    <h1>404</h1>
    <h3>Lo sentimos, no se encontró la página.</h3>
    {{-- <a href="{{ route('admin.dashboard') }}">Regresar al panel de control</a> --}}
    {{-- <a href="{{ route('admin.login') }}"> !Iniciar sesión nuevamente!</a> --}}
@endsection
