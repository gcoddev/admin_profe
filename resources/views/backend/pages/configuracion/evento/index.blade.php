@extends('backend.layouts.master')

@section('title')
    Evento - Configuración
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
                                <h4>Configuración Evento</h4>
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
                                    <a href="#!">Eventos Lista</a>
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
                                <h5>Tipos de Eventos</h5>
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
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tipos as $tipo)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $tipo->et_nombre }}</td>
                                                    <td>
                                                        @if($tipo->et_estado == 'activo')
                                                            <span class="label label-success">
                                                                {{ $tipo->et_estado }}
                                                            </span>
                                                        @else
                                                            <span class="label label-danger">
                                                                {{ $tipo->et_estado }}
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
                    <h5 class="modal-title" id="agregarModalLabel">Agregar Tipo de Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va tu formulario -->
                    <form action="{{  route('configuracion.evento.store') }}" method="POST" id="configForm">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="et_nombre" name="et_nombre" placeholder="Ingrese el nombre">
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
