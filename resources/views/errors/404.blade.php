@extends('errors.errors_layout')

@section('title')
404 - Página no encontrada
@endsection

@section('error-content')
    <h2>404</h2>
    <p>Lo sentimos, no se encontró la página.</p>
    <a href="{{ route('admin.dashboard') }}">Regresar al panel de control</a>
    <a href="{{ route('admin.login') }}"> !Iniciar sesión nuevamente!</a>
@endsection
