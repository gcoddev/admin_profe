@extends('backend.layouts.master')

@section('title')
    Editar Comunicado - PROFE
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
                                <h4>Comunicado</h4>
                                <span>Crea nuevo Comunicado</span>
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
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Lista de Comunicados</a>
                                </li>
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Editar Comunicado</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- data table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Actualizar Comunicado</h4>
                            @include('backend.layouts.partials.messages')

                            <form action="{{ route('admin.comunicado.update', $comunicado->comun_id) }}" method="POST"
                                enctype="multipart/form-data" id="myForm">
                                @csrf
                                @method('PUT')
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="comun_nombre">Nombre del comunicado</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="comun_nombre" name="comun_nombre"
                                            placeholder="Ingrese el titulo del evento"
                                            value="{{ $comunicado->comun_nombre }}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="comun_descripcion ">Descripción</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control " id="comun_descripcion" name="comun_descripcion">{!! $comunicado->comun_descripcion !!}</textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Imagen</label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control" id="comun_imagen" name="comun_imagen">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Importancia</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="comun_importancia" id="comun_importancia">
                                            <option value="{{ $comunicado->comun_importancia }}">
                                                {{ $comunicado->comun_importancia }}</option>
                                            <option value="importante">Importante</option>
                                            <option value="normal">Normal</option>
                                        </select>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="submitBtn">Actualizar
                                    Blog</button>
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
