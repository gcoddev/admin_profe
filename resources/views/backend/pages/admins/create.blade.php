@extends('backend.layouts.master')

@section('title')
    Admin Create - Admin Panel
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/files/bower_components/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/files/bower_components/multiselect/css/multi-select.css') }}" />
@endsection


@section('admin-content')
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Crear nuevo usuario</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.admins.store') }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-2 col-sm-12">
                                    <label for="per_id">RDA</label>
                                    <input type="number" class="form-control" id="per_id" name="per_id"
                                        placeholder="Ingrese el RDA">
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="nombre">Nombres</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Ingrese el nombre" readonly>
                                </div>
                                <div class="form-group col-md-4 col-sm-12">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos"
                                        placeholder="Ingrese el apellido" readonly>
                                </div>
                                <div class="form-group col-md-2 col-sm-12">
                                    <label for="correo">Celular</label>
                                    <input type="number" class="form-control" id="celular" name="celular"
                                        placeholder="Ingrese el celular">
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
                                    <label for="correo">Correo Completo</label>
                                    <input type="text" class="form-control" id="correo" name="correo" placeholder="Correo Completo" readonly>
                                </div>
                                <div class="form-group col-md-3 col-sm-12">
                                    <label for="cargo">Cargo</label>
                                    <input type="text" class="form-control" id="cargo" name="cargo"
                                        placeholder="Ingrese el Correo">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="nombre">Facebook</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook"
                                        placeholder="Ingrese el apellido">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="nombre">Tiktok</label>
                                    <input type="text" class="form-control" id="tiktok" name="tiktok"
                                        placeholder="Ingrese el apellido">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter Password">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Enter Password">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-6 col-sm-6">
                                    <label for="password">Asignar Programa</label>
                                    <select class="js-example-tags col-sm-12" name="programas[]" id="programas"
                                        multiple="multiple">
                                        @foreach ($programas as $programa)
                                            <option value="{{ $programa->pro_id }}">{{ $programa->pro_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label for="password">Asignar Sede</label>
                                    <select class="js-example-tags col-sm-12 " name="sedes[]" id="sedes"
                                        multiple="multiple">
                                        @foreach ($sedes as $sede)
                                            <option value="{{ $sede->sede_id }}">{{ $sede->sede_nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-6 col-sm-6">
                                    <label for="password">Asignar Roles</label>
                                    <select class="js-example-tags col-sm-12" name="roles[]" id="roles"
                                        multiple="multiple">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-6">
                                    <label for="username">Admin Username</label>
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Enter Username" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Guardar Admin</button>

                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        function updateCorreoCompleto() {
            var nombre = $('#correo_nombre').val();
            var dominio = $('#correo_dominio').val();
            if (nombre) {
                $('#correo').val(nombre + dominio);
            } else {
                $('#correo').val('');
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
            $('#per_id').on('input', function() {
                var rda = $(this).val();
                console.log(rda);
                if (rda.length > 0) {
                    $.ajax({
                        url: '{{ route('admin.search.rda') }}',
                        method: 'GET',
                        data: {
                            rda: rda
                        },
                        success: function(response) {
                            if (response.success) {
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

                                if (response.person.celular) {
                                    $('#celular').val(response.person.celular);
                                } else {
                                    $('#celular').val('');
                                }
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
    <script type="text/javascript" src="{{ asset('backend/files/bower_components/select2/dist/js/select2.full.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('backend/files/assets/pages/advance-elements/select2-custom.js') }}">
    </script>

@endsection
