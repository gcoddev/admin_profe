@extends('backend.layouts.master')

@section('title')
    Editar Galeria - PROFE
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
                                <h4>Galeria</h4>
                                <span>Actualizar Galeria</span>
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
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Lista de Galerias</a>
                                </li>
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Editar Galeria</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- data table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Agregar Galeria</h4>
                            @include('backend.layouts.partials.messages')

                            <form action="{{ route('admin.galeria.update', $galeria->galeria_id) }}" method="POST"
                                enctype="multipart/form-data" id="myForm">
                                @csrf
                                @method('PUT')
                                <div class="row form-group">
                                    <label class="col-sm-2 col-form-label">Imagen</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" id="galeria_imagen"
                                            name="galeria_imagen">
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="submitBtn">Actualizar
                                    Galeria</button>
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
