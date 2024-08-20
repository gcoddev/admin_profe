@extends('backend.layouts.master')

@section('title')
    Crear Evento - PROFE
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/icon/ion-icon/css/ionicons.min.css') }}">
    <script src="{{ asset('backend/files/assets/ckeditor/ckeditor.js') }}"></script>
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
                                <h4>Evento</h4>
                                <span>Crea nuevo Evento</span>
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
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Lista de Eventos</a>
                                </li>
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Crear Evento</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- data table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Agregar Evento</h4>
                            @include('backend.layouts.partials.messages')

                            <form action="{{ route('admin.evento.store') }}" method="POST" enctype="multipart/form-data"
                                id="myForm">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="eve_nombre">Nombre del Evento</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="eve_nombre" name="eve_nombre"
                                            placeholder="Ingrese el titulo del evento">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="eve_descripcion ">Descripción</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control " id="eve_descripcion" name="eve_descripcion"></textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Fecha del evento</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control " id="eve_fecha" name="eve_fecha">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Modalidad</label>
                                    <div class="col-sm-4">
                                        <select name="modalidades[]" id="pm_id" class="form-control js-example-tags"
                                            multiple="multiple">
                                            @foreach ($modalidades as $modalidad)
                                                <option value="{{ $modalidad->pm_id }}">
                                                    {{ $modalidad->pm_nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">
                                        Hora de asistencia habilitado
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="time" class="form-control " id="eve_ins_hora_asis_habilitado"
                                            name="eve_ins_hora_asis_habilitado">
                                    </div>
                                    <label class="col-sm-2 col-form-label">
                                        Hora de asistencia deshabilitado
                                    </label>
                                    <div class="col-sm-4">
                                        <input type="time" class="form-control " id="eve_ins_hora_asis_deshabilitado"
                                            name="eve_ins_hora_asis_deshabilitado">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="eve_convocatoria">Convocatoria</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="eve_convocatoria"
                                            name="eve_convocatoria" placeholder="Ingrese la convocatoria">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-1 col-form-label">Banner</label>
                                    <div class="col-sm-3">
                                        <input type="file" class="form-control" id="eve_banner" name="eve_banner">
                                    </div>
                                    <label class="col-sm-1 col-form-label">Afiche</label>
                                    <div class="col-sm-3">
                                        <input type="file" class="form-control" id="eve_afiche" name="eve_afiche">
                                    </div>
                                    <label class="col-sm-1 col-form-label">Tipo</label>
                                    <div class="col-sm-3">
                                        <select name="et_id" id="et_id" class="form-control ">
                                            <option value="">Selecciona tipo</option>
                                            @foreach ($tipoEvento as $tipo)
                                                <option value="{{ $tipo->et_id }}">
                                                    {{ $tipo->et_nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="submitBtn">Guardar
                                    Evento</button>
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
        <script>
            document.getElementById('myForm').addEventListener('submit', function() {
                var submitBtn = document.getElementById('submitBtn');
                submitBtn.disabled = true;
                submitBtn.innerText =
                    'Guardando ...';
            });
        </script>
        <script src="{{ asset('backend/files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('backend/files/bower_components/select2/dist/js/select2.full.min.js') }}">
        </script>
        <script type="text/javascript" src="{{ asset('backend/files/assets/pages/advance-elements/select2-custom.js') }}">
        </script>
        <script>
            // Initialize CKEditor
            ClassicEditor
                .create(document.querySelector('textarea'))
                .then(editor => {
                    console.log('Editor was initialized', editor);
                })
                .catch(error => {
                    console.error('Error during initialization of the editor', error);
                });
        </script>
    @endsection
