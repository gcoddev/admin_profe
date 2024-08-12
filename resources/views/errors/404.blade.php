{{-- @extends('errors.errors_layout') --}}
@extends('frontend.layouts.master')

@section('title')
    404 - Página no encontrada
@endsection

@section('frontend-content')
    <div class="container p-5">
        <h2>404</h2>
        <h4>Lo sentimos, no se encontró la página.</h4>
        {{-- <a href="{{ route('admin.dashboard') }}">Regresar al panel de control</a> --}}
        {{-- <a href="{{ route('admin.login') }}"> !Iniciar sesión nuevamente!</a> --}}
    </div>
@endsection
