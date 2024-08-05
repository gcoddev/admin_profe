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
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-round" id="pro_nombre" name="pro_nombre"
                                            placeholder="Ingrese el titulo del programa">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="name ">Contenido</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control form-control-round" id="pro_descripcion" name="pro_descripcion"></textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Carga Horaria</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="number" min="0" max="1000" class="form-control form-control-round"
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
                                            <input type="number" class="form-control form-control-round" id="pro_costo" name="pro_costo"
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
                                        <input type="date" class="form-control form-control-round" id="pro_fecha_inicio_inscripcion"
                                            name="pro_fecha_inicio_inscripcion" min="2023-01-01" max="2030-12-31">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Fin Inscripción</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control form-control-round" id="pro_fecha_fin_inscripcion"
                                            name="pro_fecha_fin_inscripcion" min="2023-01-01" max="2030-12-31">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Inicio Clase</label>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control form-control-round" id="pro_fecha_inicio_clase"
                                            name="pro_fecha_inicio_clase" min="2023-01-01" max="2030-12-31">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Programa duración</label>
                                    <div class="col-sm-4">
                                        <select name="roles[]" id="roles" class="form-control form-control-round" >

                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Tipo Programa</label>
                                    <div class="col-sm-4">
                                        <select name="roles[]" id="roles" class="form-control form-control-round" >

                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Modalidad</label>
                                    <div class="col-sm-4">
                                        <select name="roles[]" id="roles" class="form-control form-control-round" >

                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Banner</label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control" id="pro_banner"
                                            name="pro_banner">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Afiche</label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control" id="pro_afiche"
                                            name="pro_afiche">
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="submitBtn">Guardar Admin</button>
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
