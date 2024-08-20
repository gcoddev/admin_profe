@extends('backend.layouts.master')

@section('title')
    Editar Responsable - PROFE
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/icon/ion-icon/css/ionicons.min.css') }}">
    <script src="{{ asset('backend/files/assets/ckeditor/ckeditor.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('backend/files/bower_components/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/files/bower_components/multiselect/css/multi-select.css') }}" />
    <style>
        .input-group-text {
            color: white;
        }
    </style>
@endsection


@section('admin-content')
    <div class="main-body">
        <div class="page-wrapper">

            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <div class="d-inline">
                                <h4>Responsable</h4>
                                <span>Actualizar Responsable</span>
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
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Lista de Responsables</a>
                                </li>
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Editar Responsable</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- data table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Editar Responsable</h4>
                            @include('backend.layouts.partials.messages')

                            <form action="{{ route('admin.responsable.update', $responsable->resp_profe_id) }}"
                                method="POST" enctype="multipart/form-data" id="myForm">
                                @csrf
                                @method('PUT')
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="resp_profe_nombre_completo">Nombre completo</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control " id="resp_profe_nombre_completo"
                                            name="resp_profe_nombre_completo"
                                            placeholder="Ingrese el nombre del responsable"
                                            value="{{ $responsable->resp_profe_nombre_completo }}">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-1 col-form-label">Celular</label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control " placeholder="Celular"
                                                id="resp_profe_celular" name="resp_profe_celular"
                                                value="{{ $responsable->resp_profe_celular }}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-phone"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-1 col-form-label">Facebook</label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control "
                                                placeholder="https://www.facebook.com/" id="resp_profe_facebook"
                                                name="resp_profe_facebook" value="{{ $responsable->resp_profe_facebook }}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icofont icofont-social-facebook"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-1 col-form-label">Tiktok</label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control "
                                                placeholder="https://www.tiktok.com/" id="resp_profe_tiktok"
                                                name="resp_profe_tiktok" value="{{ $responsable->resp_profe_tiktok }}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <svg width="20px" height="20px" viewBox="0 0 48 48" version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <title>Tiktok</title>
                                                        <g id="Icon/Social/tiktok-black" stroke="none" stroke-width="1"
                                                            fill="none" fill-rule="evenodd">
                                                            <path
                                                                d="M38.0766847,15.8542954 C36.0693906,15.7935177 34.2504839,14.8341149 32.8791434,13.5466056 C32.1316475,12.8317108 31.540171,11.9694126 31.1415066,11.0151329 C30.7426093,10.0603874 30.5453728,9.03391952 30.5619062,8 L24.9731521,8 L24.9731521,28.8295196 C24.9731521,32.3434487 22.8773693,34.4182737 20.2765028,34.4182737 C19.6505623,34.4320127 19.0283477,34.3209362 18.4461858,34.0908659 C17.8640239,33.8612612 17.3337909,33.5175528 16.8862248,33.0797671 C16.4386588,32.6422142 16.0833071,32.1196657 15.8404292,31.5426268 C15.5977841,30.9658208 15.4727358,30.3459348 15.4727358,29.7202272 C15.4727358,29.0940539 15.5977841,28.4746337 15.8404292,27.8978277 C16.0833071,27.3207888 16.4386588,26.7980074 16.8862248,26.3604545 C17.3337909,25.9229017 17.8640239,25.5791933 18.4461858,25.3491229 C19.0283477,25.1192854 19.6505623,25.0084418 20.2765028,25.0219479 C20.7939283,25.0263724 21.3069293,25.1167239 21.794781,25.2902081 L21.794781,19.5985278 C21.2957518,19.4900128 20.7869423,19.436221 20.2765028,19.4380839 C18.2431278,19.4392483 16.2560928,20.0426009 14.5659604,21.1729264 C12.875828,22.303019 11.5587449,23.9090873 10.7814424,25.7878401 C10.003907,27.666593 9.80084889,29.7339663 10.1981162,31.7275214 C10.5953834,33.7217752 11.5748126,35.5530237 13.0129853,36.9904978 C14.4509252,38.4277391 16.2828722,39.4064696 18.277126,39.8028054 C20.2711469,40.1991413 22.3382874,39.9951517 24.2163416,39.2169177 C26.0948616,38.4384508 27.7002312,37.1209021 28.8296253,35.4300711 C29.9592522,33.7397058 30.5619062,31.7522051 30.5619062,29.7188301 L30.5619062,18.8324027 C32.7275484,20.3418321 35.3149087,21.0404263 38.0766847,21.0867664 L38.0766847,15.8542954 Z"
                                                                id="Fill-1" fill="#ffffff"></path>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-1 col-form-label">Correo</label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control " placeholder="example@example.com"
                                                id="resp_profe_correo" name="resp_profe_correo"
                                                value="{{ $responsable->resp_profe_correo }}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icofont icofont-letter"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-1 col-form-label">Pagina</label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control "
                                                placeholder="https://www.pagina.com/" id="resp_profe_pagina"
                                                name="resp_profe_pagina" value="{{ $responsable->resp_profe_pagina }}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icofont icofont-world"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="col-sm-1 col-form-label">Youtube</label>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control "
                                                placeholder="https://www.youtube.com/" id="resp_profe_youtube"
                                                name="resp_profe_youtube" value="{{ $responsable->resp_profe_youtube }}">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="icofont icofont-social-youtube"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="resp_profe_cargo">Cargo</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control " id="resp_profe_cargo"
                                            name="resp_profe_cargo" placeholder="Ingrese el cargo del responsable"
                                            value="{{ $responsable->resp_profe_cargo }}">
                                    </div>
                                    <label class="col-sm-2 col-form-label">Imagen</label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control" id="resp_profe_imagen"
                                            name="resp_profe_imagen">
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="submitBtn">Guardar
                                    Responsable</button>
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
