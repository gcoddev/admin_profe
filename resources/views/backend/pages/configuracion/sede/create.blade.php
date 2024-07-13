@extends('backend.layouts.master')

@section('title')
    Crear Programa - PROFE
@endsection


@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/files/bower_components/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/files/bower_components/multiselect/css/multi-select.css') }}" />
@endsection


@section('admin-content')
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <div class="d-inline">
                                <h4>Sede Turno</h4>
                                <span>Crea nuevo turno</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item" style="float: left;">
                                    <a href="../index-2.html"> <i class="feather icon-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Configuración Sede</a>
                                </li>
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Crear sede</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- data table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Agregar Sede</h4>
                            @include('backend.layouts.partials.messages')

                            <form action="{{ route('configuracion.sede.store') }}" method="POST">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="name ">Turnos</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="js-example-tags col-sm-12" name="turnos[]" id="turnos"
                                            multiple="multiple" required>
                                            @foreach ($turnos as $turno)
                                                <option value="{{ $turno->pro_tur_id }}">{{ $turno->pro_tur_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Cupos Inscritos</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="number" min="0" max="1000"
                                                class="form-control"
                                                placeholder="Ingrese el cupo limite de inscritos" id="pro_cupo"
                                                name="pro_cupo" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Cupos Preinscritos</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="number" min="0" max="5000"
                                                class="form-control"
                                                placeholder="Ingrese el cupo limite de preinscritos" id="pro_cupo_preinscrito"
                                                name="pro_cupo_preinscrito" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Sedes</label>
                                    <div class="col-sm-10">
                                        <select name="sede_id" id="sede_id" class="form-control" required>
                                            <option value="">Selecciona una sede...</option>
                                            @foreach ($sedes as $sede)
                                            <option value="{{ $sede->sede_id }}">{{ $sede->sede_nombre }}</option>
                                            @endforeach
                                        </select>
                                        @error('sede_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Programas</label>
                                    <div class="col-sm-10">
                                        <select name="pro_id" id="pro_id" class="form-control" required>
                                            <option value="">Selecciona un programa...</option>
                                            @foreach ($programas as $programa)
                                            <option value="{{ $programa->pro_id }}">{{ $programa->pro_nombre }}</option>
                                            @endforeach
                                        </select>
                                        @error('pro_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="submitBtn">Guardar
                                    Admin</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- data table end -->
            </div>
        </div>
    </div>

    <div id="styleSelector">
    @endsection

    @section('scripts')

        <script type="text/javascript" src="{{ asset('backend/files/bower_components/select2/dist/js/select2.full.min.js') }}">
        </script>
        <script type="text/javascript" src="{{ asset('backend/files/assets/pages/advance-elements/select2-custom.js') }}">
        </script>

    @endsection
