@extends('backend.layouts.master')

@section('title')
    Crear Inscripcion - PROFE
@endsection

@section('styles')
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

                            <form action="{{ route('admin.inscripcion.update', encrypt($inscripcion->pi_id)) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row form-group">
                                    <div class="col-sm-1 col-form-label">
                                        <label for="per_rda">RDA</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" id="per_rda" name="per_rda"
                                            placeholder="Ingrese el RDA" value="{{ $inscripcion->per_rda }}" readonly>
                                    </div>
                                    <div class="col-sm-1 col-form-label">
                                        <label for="nombre">Nombres</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            placeholder="Ingrese el nombre"
                                            value="{{ $inscripcion->per_nombre1 . ' ' . $inscripcion->per_nombre2 }}" readonly>
                                    </div>
                                    <div class="col-sm-1 col-form-label">
                                        <label for="apellidos">Apellidos</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="apellidos" name="apellidos"
                                            placeholder="Ingrese el apellido"
                                            value="{{ $inscripcion->per_apellido1 . ' ' . $inscripcion->per_apellido2 }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3 col-sm-12">
                                        <label for="correo_nombre">Nombre del Correo</label>
                                        <input type="text" class="form-control" id="correo_nombre" name="correo_nombre"
                                            placeholder="Ingrese el nombre del correo">
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
                                        <input type="text" class="form-control" id="per_correo" name="per_correo"
                                            placeholder="Correo Completo" value="{{ $inscripcion->per_correo }}" readonly>
                                    </div>
                                    <div class="form-group col-md-3 col-sm-12">
                                        <label for="per_celular">Celular</label>
                                        <input type="number" class="form-control" id="per_celular" name="per_celular"
                                            value="{{ $inscripcion->per_celular }}" placeholder="Ingrese el Correo">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-1 col-form-label">Sede</label>
                                    <div class="col-sm-3">
                                        <select name="sede_id" id="sede" class="form-control">
                                            <option value="">Seleccione una sede</option>
                                            @foreach ($sede as $s)
                                                <option value="{{ $s->sede_id }}"
                                                    {{ $inscripcion->sede_id == $s->sede_id ? 'selected' : '' }}>
                                                    {{ $s->sede_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-1 col-form-label">Programa</label>
                                    <div class="col-sm-3">
                                        <select name="pro_id" id="programa" class="form-control">
                                            <option value="">Seleccione un programa</option>
                                            @foreach ($programa as $prog)
                                                <option value="{{ $prog->pro_id }}"
                                                    {{ $inscripcion->pro_id == $prog->pro_id ? 'selected' : '' }}>
                                                    {{ $prog->pro_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-sm-3">
                                        <select name="pro_tur_id" id="turno" class="form-control">
                                            <option value="">Seleccione un turno</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-1 col-form-label">Módulo</label>
                                    <div class="col-sm-2">
                                        <select name="pi_modulo" id="sede" class="form-control">
                                            <option value="{{ $inscripcion->pi_modulo }}">
                                                    {{ $inscripcion->pi_modulo }}</option>
                                            <option value="modulo 1">
                                                    módulo 1</option>
                                            <option value="modulo 2">
                                                    módulo 2</option>
                                            <option value="modulo 3">
                                                    módulo 3</option>
                                            <option value="modulo 4">
                                                    módulo 4</option>
                                            <option value="modulo 5">
                                                    módulo 5</option>
                                            <option value="modulo 6">
                                                    módulo 6</option>
                                            <option value="inhabilitado">
                                                    inhabilitado</option>
                                        </select>
                                    </div>
                                    <label class="col-sm-1 col-form-label">Estado</label>
                                    <div class="col-sm-2">
                                        <select name="pie_id" id="estado" class="form-control">
                                            <option value="">Seleccione estado</option>
                                            @foreach ($inscripcionestado as $estado)
                                                <option value="{{ $estado->pie_id }}"
                                                    {{ $inscripcion->pie_id == $estado->pie_id ? 'selected' : '' }}>
                                                    {{ $estado->pie_nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="documentos" class="col-sm-2 col-form-label">Adjuntar Documentos</label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control-file" id="documentos" name="documentos" multiple>
                                    </div>
                                </div>


                                <!-- Campo oculto para per_id -->
                                <input type="hidden" id="per_id" name="per_id">


                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="submitBtn">Guardar
                                    Inscripcion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Bauchers</h4>
                            @foreach ($bauchers as $baucher)
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <img src="{{ Storage::url($baucher->pro_bau_imagen) }}?{{ \Illuminate\Support\Str::random(8) }}" alt="Baucher Imagen" class="img-fluid">
                                    </div>
                                    <div class="col-md-8">
                                        <form action="{{ route('admin.inscripcion.baucherupdate', [$inscripcion->pi_id, $baucher->pro_bau_id]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="pro_bau_imagen">Imagen</label>
                                                <input type="file" name="pro_bau_imagen" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="pro_bau_nro_deposito">Número de Depósito</label>
                                                <input type="text" name="pro_bau_nro_deposito" class="form-control" value="{{ $baucher->pro_bau_nro_deposito }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="pro_bau_monto">Monto (Bs)</label>
                                                <input type="text" name="pro_bau_monto" class="form-control" value="{{ $baucher->pro_bau_monto }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="pro_bau_fecha">Fecha</label>
                                                <input type="date" name="pro_bau_fecha" class="form-control" value="{{ $baucher->pro_bau_fecha }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="pro_bau_tipo_pago">Tipo de Pago</label>
                                                <select name="pro_bau_tipo_pago" class="form-control">
                                                    <option value="Baucher" {{ $baucher->pro_bau_tipo_pago == 'Baucher' ? 'selected' : '' }}>Baucher</option>
                                                    <option value="Descuento por Planilla" {{ $baucher->pro_bau_tipo_pago == 'Descuento por Planilla' ? 'selected' : '' }}>Descuento por Planilla</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Actualizar Baucher</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Agregar Baucher</h4>
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('admin.inscripcion.baucherpost', $inscripcion->pi_id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf


                                        <div class="form-group">
                                            <label for="pro_bau_imagen">Imagen</label>
                                            <input type="file" name="pro_bau_imagen" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="pro_bau_nro_deposito">Número de Depósito</label>
                                            <input type="text" name="pro_bau_nro_deposito" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="pro_bau_monto">Monto (Bs)</label>
                                            <input type="text" name="pro_bau_monto" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="pro_bau_fecha">Fecha</label>
                                            <input type="date" name="pro_bau_fecha" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="pro_bau_tipo_pago">Tipo de Pago</label>
                                            <select name="pro_bau_tipo_pago" class="form-control">
                                                <option value="Baucher">Baucher</option>
                                                <option value="Descuento por Planilla">Descuento por planilla</option>
                                            </select>
                                        </div>
                                        {{-- <button type="button" class="btn btn-danger remove">Eliminar</button> --}}
                                        {{-- <button type="button" class="btn btn-primary add-more">Editar</button> --}}
                                        <button type="submit" class="btn btn-success">Guardar Inscripción</button>
                                    </form>
                                </div>
                                {{-- <div class="col-6">
                                </div> --}}
                            </div>

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
        <script type="text/javascript" src="{{ asset('backend/files/assets/pages/j-pro/js/jquery-cloneya.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('backend/files/assets/pages/j-pro/js/custom/cloned-form.js') }}"></script>
        <script src="{{ asset('backend/files/assets/js/pcoded.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.clone-container').cloneya();
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.clone-container').cloneya({
                    cloneButton: '.add-more',
                    deleteButton: '.remove'
                });
            });
        </script>
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
                                    $('#per_id').val(response.person
                                    .per_id); // Asigna el per_id al campo oculto
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

                $('#sede, #programa').on('change', function() {
                    var sedeId = $('#sede').val();
                    var proId = $('#programa').val();
                    var selectedTurnoId =
                    '{{ $inscripcion->pro_tur_id }}'; // Assuming you have $inscripcion variable in your Blade

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
                                        var selected = turno.pro_tur_id == selectedTurnoId ?
                                            'selected' : '';
                                        $('#turno').append(
                                            `<option value="${turno.pro_tur_id}" ${selected}>${turno.pro_tur_nombre}</option>`
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

                // Trigger the change event to populate the "turno" options when the page loads
                $('#sede, #programa').trigger('change');
            });
        </script>
    @endsection
