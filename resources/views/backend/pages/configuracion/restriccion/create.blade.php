@extends('backend.layouts.master')

@section('title')
    Crear Programa Restricción - PROFE
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/files/bower_components/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/files/bower_components/multiselect/css/multi-select.css') }}" />
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
                                <h4>Crear Restricción de Programa</h4>
                                <span>Crea nueva restricción</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item" style="float: left;">
                                    <a href="{{ route('admin.dashboard') }}"> <i class="feather icon-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Configuración</a>
                                </li>
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Crear Restricción</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- data table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Agregar Restricción</h4>
                            @include('backend.layouts.partials.messages')

                            <form action="{{ route('configuracion.restriccion.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="pro_id">Programa</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="pro_id" id="pro_id" required>
                                            <option value="">Selecciona un programa...</option>
                                            @foreach ($programas as $programa)
                                                <option value="{{ $programa->pro_id }}">{{ $programa->pro_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="res_descripcion">Descripción</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="res_descripcion" name="res_descripcion"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-3 col-sm-6">
                                        <label for="espNombres">Nombres Especialidad</label>
                                        <select class="js-example-tags col-sm-12" name="espNombres[]" id="espNombres"
                                            multiple="multiple">
                                            <!-- No necesitas opciones predefinidas -->
                                        </select>
                                    </div>

                                    <div class="col-md-2 col-sm-6">
                                        <label for="carNombres">Nombres Cargos</label>
                                        <select class="js-example-tags col-sm-12" name="carNombres[]" id="carNombres"
                                            multiple="multiple">
                                            <!-- No necesitas opciones predefinidas -->
                                        </select>
                                    </div>
                                    <div class="col-md-1 col-sm-6">
                                        <label for="password">Asignar Género</label>
                                        <select class="js-example-tags col-sm-12" name="generos[]" id="generos"
                                            multiple="multiple">
                                            @foreach ($generos as $genero)
                                                <option value="{{ $genero->gen_id }}">{{ $genero->gen_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <label for="password">Asignar Subsistema</label>
                                        <select class="js-example-tags col-sm-12 " name="subsistemas[]" id="subsistemas"
                                            multiple="multiple">
                                            @foreach ($subsistemas as $subsistema)
                                                <option value="{{ $subsistema->sub_id }}">{{ $subsistema->sub_nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <label for="password">Asignar Nivel</label>
                                        <select class="js-example-tags col-sm-12 " name="niveles[]" id="niveles"
                                            multiple="multiple">
                                            @foreach ($niveles as $nivel)
                                                <option value="{{ $nivel->niv_id }}">{{ $nivel->niv_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <label for="password">Asignar Categoria</label>
                                        <select class="js-example-tags col-sm-12 " name="categorias[]" id="categorias"
                                            multiple="multiple">
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->cat_id }}">{{ $categoria->cat_nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 col-sm-6">
                                        <label for="password">Asignar Especialidad</label>
                                        <select class="js-example-tags col-sm-12" name="especialidades[]"
                                            id="especialidades" multiple="multiple">
                                            @foreach ($especialidades as $especialidad)
                                                <option value="{{ $especialidad->esp_id }}">
                                                    {{ $especialidad->esp_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label for="password">Asignar Cargo</label>
                                        <select class="js-example-tags col-sm-12 " name="cargos[]" id="cargos"
                                            multiple="multiple">
                                            @foreach ($cargos as $cargo)
                                                <option value="{{ $cargo->car_id }}">{{ $cargo->car_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- data table end -->
            </div>
        </div>
    </div>

    <div id="styleSelector"></div>
@endsection

@section('scripts')
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
