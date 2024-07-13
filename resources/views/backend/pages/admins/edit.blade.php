@extends('backend.layouts.master')

@section('title')
    Admin Edit - Admin Panel
@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/icon/icofont/css/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/icon/feather/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/files/bower_components/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/files/bower_components/multiselect/css/multi-select.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backendfiles/bower_components/multiselect/css/multi-select.css') }}" />
@endsection

@section('admin-content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <div class="d-inline">
                                <h4>Especialidades</h4>
                                <span>Lista de Especialidades existentes</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item" style="float: left">
                                    <a href="../index-2.html">
                                        <i class="feather icon-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item" style="float: left">
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" style="float: left">
                                    <a href="#!">Lista de Especialidades</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Editar Admin - {{ $admin->nombre }}</h4>
                                <div class="card-header-right">
                                    <ul class="list-unstyled card-option">
                                        <li><i class="feather icon-maximize full-card"></i></li>
                                        <li><i class="feather icon-minus minimize-card"></i></li>
                                        {{-- <li><i class="feather icon-trash-2 close-card"></i></li> --}}
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">

                                @include('backend.layouts.partials.messages')

                                <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-2 col-sm-12">
                                            <label for="nombre">RDA</label>
                                            <input type="text" class="form-control" id="per_id" name="per_id"
                                                placeholder="Ingrese el RDA" value="{{ $admin->per_id }}" readonly>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-12">
                                            <label for="nombre">Nombres</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                placeholder="Ingrese el nombre" value="{{ $admin->nombre }}" readonly>
                                        </div>
                                        <div class="form-group col-md-4 col-sm-12">
                                            <label for="nombre">Apellidos</label>
                                            <input type="text" class="form-control" id="apellidos" name="apellidos"
                                                placeholder="Ingrese el apellido" value="{{ $admin->apellidos }}" readonly>
                                        </div>
                                        <div class="form-group col-md-2 col-sm-12">
                                            <label for="correo">Celular</label>
                                            <input type="text" class="form-control" id="celular" name="celular"
                                                placeholder="Ingrese el celular" value="{{ $admin->celular }}">
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3 col-sm-12">
                                            <label for="correo">Correo</label>
                                            <input type="text" class="form-control" id="correo" name="correo"
                                                placeholder="Ingrese el Correo" value="{{ $admin->correo }}" readonly>
                                        </div>
                                        <div class="form-group col-md-3 col-sm-12">
                                            <label for="cargo">Cargo</label>
                                            <input type="text" class="form-control" id="cargo" name="cargo"
                                                placeholder="Ingrese el Correo" value="{{ $admin->cargo }}">
                                        </div>
                                        <div class="form-group col-md-3 col-sm-12">
                                            <label for="nombre">Facebook</label>
                                            <input type="text" class="form-control" id="facebook" name="facebook"
                                                placeholder="Ingrese el apellido" value="{{ $admin->facebook }}">
                                        </div>
                                        <div class="form-group col-md-3 col-sm-12">
                                            <label for="nombre">Tiktok</label>
                                            <input type="text" class="form-control" id="tiktok" name="tiktok"
                                                placeholder="Ingrese el apellido" value="{{ $admin->tiktok }}">
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
                                            <label for="password">Asignar Programas</label>
                                            <select class="js-example-tags col-sm-12" name="programas[]" id="programas" multiple="multiple">
                                                @foreach ($programas as $programa)
                                                    @php
                                                        $selected = false;
                                                        $pro_ids = json_decode($admin->pro_ids ?? '[]', true);
                                                        if (is_array($pro_ids) && in_array($programa->pro_id, $pro_ids)) {
                                                            $selected = true;
                                                        }
                                                    @endphp
                                                    <option value="{{ $programa->pro_id }}" {{ $selected ? 'selected' : '' }}>
                                                        {{ $programa->pro_nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label for="password">Asignar Sede</label>
                                            <select class="js-example-tags col-sm-12" name="sedes[]" id="sedes" multiple="multiple">
                                                @foreach ($sedes as $sede)
                                                    @php
                                                        $selected = false;
                                                        $sede_ids = json_decode($admin->sede_ids ?? '[]', true);
                                                        if (is_array($sede_ids) && in_array($sede->sede_id, $sede_ids)) {
                                                            $selected = true;
                                                        }
                                                    @endphp
                                                    <option value="{{ $sede->sede_id }}" {{ $selected ? 'selected' : '' }}>
                                                        {{ $sede->sede_nombre }}
                                                    </option>
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
                                                    <option value="{{ $role->name }}"
                                                        {{ $admin->hasRole($role->name) ? 'selected' : '' }}>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-6">
                                            <label for="username">Admin Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Enter Username" value="{{ $admin->username }}" readonly>
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
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript"
        src="{{ asset('backend/files/bower_components/bootstrap-multiselect/dist/js/bootstrap-multiselect.js') }}">
        </script>
        <script type="text/javascript" src="{{ asset('backend/files/bower_components/multiselect/js/jquery.multi-select.js') }}"></script>
        <script type = "text/javascript"
        src = "{{ asset('backend/files/bower_components/select2/dist/js/select2.full.min.js') }}" >
    </script>
    <script type="text/javascript" src="{{ asset('backend/files/assets/pages/advance-elements/select2-custom.js') }}">
    </script>
@endsection
