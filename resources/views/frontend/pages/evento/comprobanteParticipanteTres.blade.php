@extends('frontend.layouts.master')

@section('title')
    PROFE - EVENTOS
@endsection

@section('description')
    ✅ {{ $evento[0]->eve_nombre }}
@endsection

@section('styles')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('frontend-content')
    <section class="container mt-4">
        <div class="text-center">
            <img src="{{ asset('assets/evento/12082024_banner.jpg')}}" class="img-fluid rounded-lg" width="100%">
        </div>

        <div class="mt-4 text-center">
            <!-- Mostrar mensaje de sesión -->
            @if (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-4xl font-semibold text-black">
                        Descargar formulario de inscripción!
                    </h2>
                    <div class="mt-4">
                        <a href="{{ route('evento.comprobanteParticipantePdf', $eve_ins_id) }}" class="btn btn-info btn-lg">
                            Descargar
                        </a>
                        <a href="{{ route('evento.show', $evento[0]->eve_id) }}" class="btn btn-dark btn-lg ml-2">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
