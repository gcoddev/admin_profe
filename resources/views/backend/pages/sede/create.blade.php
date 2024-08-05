@extends('backend.layouts.master')

@section('title')
    Crear Sede - PROFE
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
                                <h4>Sede</h4>
                                <span>Crea nuevo sede</span>
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
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Lista de Sede</a>
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

                            <form action="{{ route('admin.sede.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="name">Nombre de la Sede</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="sede_nombre" name="sede_nombre"
                                            placeholder="Ingrese nombre de la sede" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="name ">Descripcion</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control " id="sede_descripcion" name="sede_descripcion"></textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="name ">Horario de Atención</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control " id="sede_horario"
                                                name="sede_horario">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="name ">Turnos</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="input-group">
                                            <input type="text" class="form-control " id="sede_turno" name="sede_turno">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Imagen</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="sede_imagen" name="sede_imagen"
                                                required>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Departamento</label>
                                    <div class="col-sm-4">
                                        <select name="dep_id" id="dep_id" class="form-control" required>
                                            <option value="">Selecciona departamento</option>
                                            @foreach ($departamentos as $departamento)
                                                <option value="{{ $departamento->dep_id }}">{{ $departamento->dep_nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Celular 1</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="number" min="59999999" max="80000000" class="form-control "
                                                placeholder="Ingrese contacto" id="sede_contacto_1" name="sede_contacto_1"
                                                required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-phone"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Celular 2</label>
                                    <div class="col-sm-4">
                                        <div class="input-group">
                                            <input type="number" min="59999999" max="80000000" class="form-control "
                                                placeholder="Ingrese contacto" id="sede_contacto_2"
                                                name="sede_contacto_2" required>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-phone"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Ubicación</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control " id="sede_ubicacion" name="sede_ubicacion" required></textarea>
                                    </div>

                                </div>
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="submitBtn">Guardar
                                    Sede</button>
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
                'Guardando...'; // Opcional: Cambiar el texto del botón para indicar que se está procesando
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
