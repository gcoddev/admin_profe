@extends('backend.layouts.master')

@section('title')
    Sede - Configuración
@endsection


@section('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/files/assets/icon/font-awesome/css/font-awesome.min.css') }}">
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
                                <h4>Restricciones Programa</h4>
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
                                    <a href="#!">Restricciones</a>
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
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Restricciones Programa</h5>
                                <span>...</span>
                                <br />

                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <a class="btn btn-primary text-white"
                                            href="{{ route('configuracion.restriccion.create') }}">Crear
                                            Nueva Restricción</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Programa</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                                <th>Fecha Creado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($restricciones as $restriccion)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $restriccion->pro_nombre }}</td>
                                                    <td>{!! $restriccion->res_descripcion !!}</td>
                                                    <td>
                                                        @if ($restriccion->pr_estado == 'activo')
                                                            <span class="label label-success">
                                                                {{ $restriccion->pr_estado }}
                                                            </span>
                                                        @else
                                                            <span class="label label-danger">
                                                                {{ $restriccion->pr_estado }}
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $restriccion->updated_at }}</td>
                                                    <td>
                                                        <a href="#"
                                                            class="btn btn-outline-info waves-effect waves-light m-r-20">
                                                            <i class="icofont icofont-edit-alt"></i>
                                                            <!-- Ícono de Font Awesome -->
                                                        </a>
                                                        <a href="#"
                                                            class="btn btn-outline-danger waves-effect waves-light m-r-20"
                                                            onclick="_gaq.push(['_trackEvent', 'example', 'try', 'alert-success-cancel']);">
                                                            <i class="icofont icofont-ui-delete"></i>
                                                            <!-- Ícono de Font Awesome -->
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Programa</th>
                                                <th>Descripción</th>
                                                <th>Estado</th>
                                                <th>Fecha Creado</th>
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


    <div id="styleSelector"></div>
@endsection


@section('scripts')
    <!-- Start datatable js -->

    <!-- Start datatable js -->
    <script></script>

    <script type="text/javascript" src="{{ asset('backend/files/assets/js/modal.js') }}"></script>
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
@endsection
