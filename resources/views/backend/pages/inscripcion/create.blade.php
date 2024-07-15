@extends('backend.layouts.master')

@section('title')
    Crear Inscripcion - PROFE
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
                                <h4>Inscripcion</h4>
                                <span>Crea nuevo Inscripcion</span>
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
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Lista de Inscripcion</a>
                                </li>
                                <li class="breadcrumb-item" style="float: left;"><a href="#!">Crear Inscripcion</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- data table start -->
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Agregar Inscripcion</h4>
                            @include('backend.layouts.partials.messages')

                            <form action="{{ route('admin.inscripcion.store') }}" method="POST">
                                @csrf
                                <div class="row form-group">
                                    <div class="col-sm-1 col-form-label">
                                        <label for="per_rda">RDA</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="per_rda" name="per_rda"
                                        placeholder="Ingrese el RDA">
                                    </div>
                                    <div class="col-sm-1 col-form-label">
                                        <label for="nombre">Nombres</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Ingrese el nombre" readonly>
                                    </div>
                                    <div class="col-sm-1 col-form-label">
                                        <label for="apellidos">Apellidos</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                                        placeholder="Ingrese el apellido" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 col-sm-12">
                                        <label for="correo_nombre">Nombre del Correo</label>
                                        <input type="text" class="form-control" id="correo_nombre" name="correo_nombre" placeholder="Ingrese el nombre del correo">
                                    </div>
                                    <div class="form-group col-md-3 col-sm-12">
                                        <label for="correo_dominio">Dominio del Correo</label>
                                        <select class="form-control" id="correo_dominio" name="correo_dominio">
                                            <option value="@gmail.com">@gmail.com</option>
                                            <option value="@iipp.edu.bo">@iipp.edu.bo</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-12">
                                        <label for="per_correo">Correo Completo</label>
                                        <input type="text" class="form-control" id="per_correo" name="per_correo" placeholder="Correo Completo" readonly>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-12">
                                        <label for="per_celular">Celular</label>
                                        <input type="number" class="form-control" id="per_celular" name="per_celular"
                                            placeholder="Ingrese el Correo">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-1 col-form-label">Sede</label>
                                    <div class="col-sm-3">
                                        <select name="sede_id" id="sede" class="form-control">
                                            <option value="">Seleccione una sede</option>
                                            @foreach ($sede as $s)
                                                <option value="{{ $s->sede_id }}">{{ $s->sede_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-1 col-form-label">Programa</label>
                                    <div class="col-sm-3">
                                        <select name="pro_id" id="programa" class="form-control">
                                            <option value="">Seleccione un programa</option>
                                            @foreach ($programa as $prog)
                                                <option value="{{ $prog->pro_id }}">{{ $prog->pro_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-1 col-form-label">Turno</label>
                                    <div class="col-sm-3">
                                        <select name="pro_tur_id" id="turno" class="form-control">
                                            <option value="">Seleccione un turno</option>
                                        </select>
                                    </div>
                                </div>
                                 <!-- Campo oculto para per_id -->
                                <input type="hidden" id="per_id" name="per_id">


                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="submitBtn">Guardar
                                    Inscripcion</button>
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
            $(document).ready(function() {
                function updateCorreoCompleto() {
                    var nombre = $('#correo_nombre').val();
                    var dominio = $('#correo_dominio').val();
                    if (nombre) {
                        $('#per_correo').val(nombre + dominio);
                    } else {
                        $('#per_correo').val('');
                    }
                }

                $('#correo_nombre').on('input', function() {
                    updateCorreoCompleto();
                });

                $('#correo_dominio').on('change', function() {
                    updateCorreoCompleto();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#per_rda').on('input', function() {
                    var rda = $(this).val();
                    console.log(rda);
                    if (rda.length > 0) {
                        $.ajax({
                            url: '{{ route('admin.searchInscripcion.rda') }}',
                            method: 'GET',
                            data: {
                                rda: rda
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('#per_id').val(response.person.per_id); // Asigna el per_id al campo oculto
                                    var nombre = '';
                                    if (response.person.per_nombre1) {
                                        nombre += response.person.per_nombre1;
                                    }
                                    if (response.person.per_nombre2) {
                                        nombre += ' ' + response.person.per_nombre2;
                                    }
                                    $('#nombre').val(nombre.trim());

                                    var apellidos = '';
                                    if (response.person.per_apellido1) {
                                        apellidos += response.person.per_apellido1;
                                    }
                                    if (response.person.per_apellido2) {
                                        apellidos += ' ' + response.person.per_apellido2;
                                    }
                                    $('#apellidos').val(apellidos.trim());
                                    // Actualiza el campo de celular
                                    $('#per_celular').val(response.person.per_celular);

                                    // Actualiza el campo de correo
                                    $('#per_correo').val(response.person.per_correo);
                                } else {
                                    $('#nombre').val('');
                                    $('#apellidos').val('');
                                }
                            },
                            error: function() {
                                $('#nombre').val('');
                                $('#apellidos').val('');
                            }
                        });
                    } else {
                        $('#nombre').val('');
                        $('#apellidos').val('');
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#sede, #programa').on('change', function() {
                    var sedeId = $('#sede').val();
                    var proId = $('#programa').val();

                    if (sedeId && proId) {
                        $.ajax({
                            url: '{{ route('admin.search.turnos') }}',
                            method: 'GET',
                            data: {
                                sede_id: sedeId,
                                pro_id: proId
                            },
                            success: function(response) {
                                $('#turno').html('<option value="">Seleccione un turno</option>');
                                if (response.length > 0) {
                                    response.forEach(function(turno) {
                                        $('#turno').append(
                                            `<option value="${turno.pro_tur_id}">${turno.pro_tur_nombre}</option>`
                                            );
                                    });
                                }
                            },
                            error: function() {
                                $('#turno').html('<option value="">Seleccione un turno</option>');
                            }
                        });
                    } else {
                        $('#turno').html('<option value="">Seleccione un turno</option>');
                    }
                });
            });
        </script>

    @endsection
