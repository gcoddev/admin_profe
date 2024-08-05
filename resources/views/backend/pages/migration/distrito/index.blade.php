@extends('backend.layouts.master')

@section('title')
    Users - Admin Panel
@endsection

@section('styles')
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
                                <h4>Distritos</h4>
                                <span>Lista de Distritos existentes</span>
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
                                    <a href="#!">Lista de Distritos</a>
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
                                <h5>Distritos</h5>
                                <span></span>
                                <br />
                                @include('backend.layouts.partials.messages')
                                <form action="{{ route('migration.distrito.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                            <input type="file" name="import_file" class="form-control" />
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-primary" type="submit">Importar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Codigo</th>
                                                <th>Nombre Distrito</th>
                                                <th>Nombre Departamento</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($distritos as $distrito)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $distrito->dis_codigo }}</td>
                                                    <td>{{ $distrito->dis_nombre }}</td>
                                                    <td>{{ $distrito->dep_nombre }}</td>
                                                    <td>{{ $distrito->dis_estado }}</td>
                                                    <td>{{ $distrito->updated_at }}</td>
                                                    <td>
                                                        {{-- @if (Auth::guard('admin')->user()->can('admin.edit'))
                                                            <a class="icofont icofont-check-circled"
                                                                href="{{ route('migration.otros.edit', $areaTrabajo->area_id) }}">Editar</a>
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Codigo</th>
                                                <th>Nombre Distrito</th>
                                                <th>Nombre Departamento</th>
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

    <div id="styleSelector"></div>


@endsection


@section('scripts')
    <!-- Start datatable js -->

    <script>
        ini_set('max_execution_time', 300); // 5 minutos
        ini_set('memory_limit', '512M');
    </script>
    <script src="{{ asset('backend/files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('backend/files/assets/pages/data-table/js/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/files/assets/pages/data-table/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/files/assets/pages/data-table/js/vfs_fonts.js') }}"></script>
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
