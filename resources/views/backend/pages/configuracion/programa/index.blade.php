@extends('backend.layouts.master')

@section('title')
    Programa - Configuración
@endsection


@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('backend/files/assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" />

    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/files/assets/pages/data-table/css/buttons.dataTables.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" />

@endsection

@section('admin-content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <div class="d-inline">
                                <h4>Configuración Programa</h4>
                                <span>.........</span>
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
                                    <a href="#!">Otros Lista</a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <!-- En tu vista blade -->
                 @include('backend.layouts.partials.messages')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Versión</h5>
                                <span></span>
                                <br />

                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#agregarModal">Agregar</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Numero</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($versiones as $version)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $version->pv_nombre }}</td>
                                                    <td>{{ $version->pv_numero }}</td>
                                                    <td>
                                                        @if($version->pv_estado == 'activo')
                                                            <span class="label label-success">
                                                                {{ $version->pv_estado }}
                                                            </span>
                                                        @else
                                                            <span class="label label-danger">
                                                                {{ $version->pv_estado }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $version->updated_at }}</td>
                                                    <td>
                                                            <a href="#" class="btn btn-outline-info waves-effect waves-light m-r-20">
                                                                <i class="icofont icofont-edit-alt"></i> <!-- Ícono de Font Awesome -->
                                                            </a>
                                                            <a href="#" class="btn btn-outline-danger waves-effect waves-light m-r-20" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'alert-success-cancel']);">
                                                                <i class="icofont icofont-ui-delete"></i> <!-- Ícono de Font Awesome -->
                                                            </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Numero</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Tipos</h5>
                                <span></span>
                                <br />
                                    <div class="form-group row">
                                        <div class="col-sm-3">
                                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#agregarModal1">Agregar</button>
                                        </div>
                                    </div>
                            </div>

                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="dataTable2" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tipos as $tipo)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $tipo->pro_tip_nombre }}</td>
                                                    <td>
                                                        @if($tipo->pro_tip_estado == 'activo')
                                                            <span class="label label-success">
                                                                {{ $tipo->pro_tip_estado }}
                                                            </span>
                                                        @else
                                                            <span class="label label-danger">
                                                                {{ $tipo->pro_tip_estado }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $tipo->updated_at }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-outline-info waves-effect waves-light m-r-20">
                                                            <i class="icofont icofont-edit-alt"></i> <!-- Ícono de Font Awesome -->
                                                        </a>
                                                        <a href="#" class="btn btn-outline-danger waves-effect waves-light m-r-20" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'alert-success-cancel']);">
                                                            <i class="icofont icofont-ui-delete"></i> <!-- Ícono de Font Awesome -->
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Duraciones</h5>
                                <span></span>
                                <br />
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#agregarModal2">Agregar</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="dataTable1" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Semana</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($duraciones as $duracion)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $duracion->pd_nombre }}</td>
                                                    <td>{{ $duracion->pd_semana }}</td>
                                                    <td>
                                                        @if($duracion->pd_estado == 'activo')
                                                            <span class="label label-success">
                                                                {{ $duracion->pd_estado }}
                                                            </span>
                                                        @else
                                                            <span class="label label-danger">
                                                                {{ $duracion->pd_estado }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $duracion->updated_at }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-outline-info waves-effect waves-light m-r-20">
                                                            <i class="icofont icofont-edit-alt"></i> <!-- Ícono de Font Awesome -->
                                                        </a>
                                                        <a href="#" class="btn btn-outline-danger waves-effect waves-light m-r-20" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'alert-success-cancel']);">
                                                            <i class="icofont icofont-ui-delete"></i> <!-- Ícono de Font Awesome -->
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Semana</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Turnos</h5>
                                <span></span>
                                <br />
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#agregarModal4">Agregar</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="dataTable4" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($turnos as $turno)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $turno->pro_tur_nombre }}</td>
                                                    <td>
                                                        @if($turno->pro_tur_estado == 'activo')
                                                            <span class="label label-success">
                                                                {{ $turno->pro_tur_estado }}
                                                            </span>
                                                        @else
                                                            <span class="label label-danger">
                                                                {{ $turno->pro_tur_estado }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $turno->updated_at }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-outline-info waves-effect waves-light m-r-20">
                                                            <i class="icofont icofont-edit-alt"></i> <!-- Ícono de Font Awesome -->
                                                        </a>
                                                        <a href="#" class="btn btn-outline-danger waves-effect waves-light m-r-20" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'alert-success-cancel']);">
                                                            <i class="icofont icofont-ui-delete"></i> <!-- Ícono de Font Awesome -->
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Modalidades</h5>
                                <span></span>
                                <br />
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#agregarModal3">Agregar</button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="dataTable3" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($modalidades as $modalidad)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $modalidad->pm_nombre }}</td>
                                                    <td>
                                                        @if($modalidad->pm_estado == 'activo')
                                                            <span class="label label-success">
                                                                {{ $modalidad->pm_estado }}
                                                            </span>
                                                        @else
                                                            <span class="label label-danger">
                                                                {{ $modalidad->pm_estado }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $modalidad->updated_at }}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-outline-info waves-effect waves-light m-r-20">
                                                            <i class="icofont icofont-edit-alt"></i> <!-- Ícono de Font Awesome -->
                                                        </a>
                                                        <a href="#" class="btn btn-outline-danger waves-effect waves-light m-r-20" onclick="_gaq.push(['_trackEvent', 'example', 'try', 'alert-success-cancel']);">
                                                            <i class="icofont icofont-ui-delete"></i> <!-- Ícono de Font Awesome -->
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Modal -->
    <div class="modal fade" id="agregarModal" tabindex="-1" role="dialog" aria-labelledby="agregarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarModalLabel">Agregar Versión</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va tu formulario -->
                    <form action="{{  route('configuracion.programa.storeversion') }}" method="POST" id="configForm">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="pv_nombre" name="pv_nombre" placeholder="Ingrese el nombre">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Numero</label>
                            <input type="number" class="form-control" id="pv_numero" name="pv_numero" placeholder="Ingrese numero versión">
                        </div>
                        <button type="submit" class="btn btn-primary" id="configForm">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="agregarModal1" tabindex="-1" role="dialog" aria-labelledby="agregarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarModalLabel">Agregar tipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va tu formulario -->
                    <form action="{{  route('configuracion.programa.storetipo') }}" method="POST" id="configForm">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="pro_tip_nombre" name="pro_tip_nombre" placeholder="Ingrese el tipo de programa">
                        </div>
                        <button type="submit" class="btn btn-primary" id="configForm">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="agregarModal2" tabindex="-1" role="dialog" aria-labelledby="agregarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarModalLabel">Agregar Duración</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va tu formulario -->
                    <form action="{{  route('configuracion.programa.storeduracion') }}" method="POST" id="configForm">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="pd_nombre" name="pd_nombre" placeholder="Ingrese el nombre">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Total de semana</label>
                            <input type="number" class="form-control" id="pd_semana" name="pd_semana" placeholder="Ingrese cantidad de semana">
                        </div>
                        <button type="submit" class="btn btn-primary" id="configForm">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="agregarModal3" tabindex="-1" role="dialog" aria-labelledby="agregarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarModalLabel">Agregar Modalidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va tu formulario -->
                    <form action="{{  route('configuracion.programa.storemodalidad') }}" method="POST" id="configForm">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="pm_nombre" name="pm_nombre" placeholder="Ingrese el nombre">
                        </div>
                        <button type="submit" class="btn btn-primary" id="configForm">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="agregarModal4" tabindex="-1" role="dialog" aria-labelledby="agregarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarModalLabel">Agregar Turno</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va tu formulario -->
                    <form action="{{  route('configuracion.programa.storeturno') }}" method="POST" id="configForm">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="pro_tur_nombre" name="pro_tur_nombre" placeholder="Ingrese el nombre">
                        </div>
                        <button type="submit" class="btn btn-primary" id="configForm">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="styleSelector"></div>


@endsection


@section('scripts')
    <!-- Start datatable js -->

    <!-- Start datatable js -->
    <script>

    </script>

    <script type="text/javascript" src="{{ asset('backend/files/assets/js/modal.js')}}"></script>
    <script src="{{ asset('backend/files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('backend/files/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/files/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/files/assets/pages/data-table/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script
        src="{{ asset('backend/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('backend/files/assets/pages/data-table/js/data-table-custom.js') }}"></script>
    <script>
        /*================================
                    datatable active
                    ==================================*/
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
    </script>
    <script>
        /*================================
                    datatable active
                    ==================================*/
        if ($('#dataTable1').length) {
            $('#dataTable1').DataTable({
                responsive: true
            });
        }
    </script>
    <script>
        /*================================
                    datatable active
                    ==================================*/
        if ($('#dataTable2').length) {
            $('#dataTable2').DataTable({
                responsive: true
            });
        }
    </script>
    <script>
        /*================================
                    datatable active
                    ==================================*/
        if ($('#dataTable3').length) {
            $('#dataTable3').DataTable({
                responsive: true
            });
        }
    </script>
    <script>
        /*================================
                    datatable active
                    ==================================*/
        if ($('#dataTable4').length) {
            $('#dataTable4').DataTable({
                responsive: true
            });
        }
    </script>
@endsection
