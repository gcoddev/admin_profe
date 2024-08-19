@extends('backend.layouts.master')

@section('title')
    Crear Programa - PROFE
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/icon/ion-icon/css/ionicons.min.css') }}">
    <script src="{{ asset('backend/files/assets/ckeditor/ckeditor.js') }}"></script>
@endsection


@section('admin-content')
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <div class="d-inline">
                                <h4>Programa</h4>
                                <span>Crea nuevo programa</span>
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
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Lista de Programa</a>
                                </li>
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Crear programa</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- data table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Agregar Programa</h4>
                            @include('backend.layouts.partials.messages')

                            <form action="{{ route('admin.programa.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="name">Nombre del Programa</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control " id="pro_nombre" name="pro_nombre"
                                            placeholder="Ingrese el titulo del programa">
                                    </div>
                                    <div class="col-sm-2 col-form-label">
                                        <label for="name">Nombre abreviado</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control " id="pro_nombre_abre" name="pro_nombre_abre"
                                            placeholder="Ingrese nombre abreviado">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="name ">Contenido</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control " id="pro_contenido" name="pro_contenido"></textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Carga Horaria</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="number" min="0" max="1000" class="form-control "
                                                placeholder="Ingrese la carga Horaria" id="pro_carga_horaria"
                                                name="pro_carga_horaria">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Hrs.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-form-label">
                                        <label for="name ">Costo</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="number" class="form-control " id="pro_costo" name="pro_costo"
                                                placeholder="Ingrese el costo" min="0" max="10000" step="0.01">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Bs.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Inicio Inscripción</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control " id="pro_fecha_inicio_inscripcion"
                                            name="pro_fecha_inicio_inscripcion" min="2023-01-01" max="2030-12-31">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Fin Inscripción</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control " id="pro_fecha_fin_inscripcion"
                                            name="pro_fecha_fin_inscripcion" min="2023-01-01" max="2030-12-31">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Inicio Clase</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control " id="pro_fecha_inicio_clase"
                                            name="pro_fecha_inicio_clase" min="2023-01-01" max="2030-12-31">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Duración</label>
                                    <div class="col-sm-4">
                                        <select name="pd_id" id="pd_id" class="form-control " required>
                                            <option value="">Selecciona duración</option>
                                            @foreach($programaDuraciones as $duracion)
                                                <option value="{{ $duracion->pd_id }}">{{ $duracion->pd_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Tipo</label>
                                    <div class="col-sm-4">
                                        <select name="pro_tip_id" id="pro_tip_id" class="form-control " required>
                                            <option value="">Selecciona tipo</option>
                                            @foreach($programaTipos as $tipo)
                                                <option value="{{ $tipo->pro_tip_id }}">{{ $tipo->pro_tip_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Modalidad</label>
                                    <div class="col-sm-4">
                                        <select name="pm_id" id="pm_id" class="form-control" required>
                                            <option value="">Selecciona una modalidad</option>
                                            @foreach($programaModalidades as $modalidad)
                                                <option value="{{ $modalidad->pm_id }}">{{ $modalidad->pm_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-1 col-form-label">Banner</label>
                                    <div class="col-sm-3">
                                        <input type="file" class="form-control" id="pro_banner"
                                            name="pro_banner">
                                    </div>
                                    <label class="col-sm-1 col-form-label">Afiche</label>
                                    <div class="col-sm-3">
                                        <input type="file" class="form-control" id="pro_afiche"
                                            name="pro_afiche">
                                    </div>
                                    <label class="col-sm-1 col-form-label">Versión</label>
                                    <div class="col-sm-3">
                                        <select name="pv_id" id="pv_id" class="form-control " required>
                                            <option value="">Selecciona versión</option>
                                            @foreach($programaVersiones as $version)
                                                <option value="{{ $version->pv_id }}">{{ $version->pv_nombre }} {{ $version->pv_numero }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="submitBtn">Guardar Programa</button>
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
                submitBtn.innerText = 'Guardando...'; // Opcional: Cambiar el texto del botón para indicar que se está procesando
            });
        </script>
        <script src="{{ asset('backend/files/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
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
