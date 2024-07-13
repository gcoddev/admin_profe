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
                                <h4>Otros</h4>
                                <span>Distintos tipos de datos para migrar</span>
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
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Areas de Trabajos</h5>
                                <span></span>
                                <br />
                                @include('backend.layouts.partials.messages')
                                <form action="{{ route('migration.otros.areatrabajo') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-9">
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
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Fecha Creado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($areaTrabajos as $areaTrabajo)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $areaTrabajo->area_nombre }}</td>
                                                    <td>{{ $areaTrabajo->area_estado }}</td>
                                                    <td>{{ $areaTrabajo->updated_at }}</td>
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
                                                <th>Nombre</th>
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
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Subsistema</h5>
                                <span></span>
                                <br/>
                                @include('backend.layouts.partials.messages')
                                <form action="{{ route('migration.otros.subsistema') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-9">
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
                                    <table id="dataTable2" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Fecha Creado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subsistemas as $subsistema)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $subsistema->sub_nombre }}</td>
                                                    <td>{{ $subsistema->sub_estado }}</td>
                                                    <td>{{ $subsistema->updated_at }}</td>
                                                    <td>
                                                        {{-- @if (Auth::guard('admin')->user()->can('admin.edit'))
                                                            <a class="btn btn-success btn-round"
                                                                href="{{ route('migration.areatrabajo.edit', $areaTrabajo->area_id) }}">Editar</a>
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
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
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Niveles</h5>
                                <span></span>
                                <br/>
                                @include('backend.layouts.partials.messages')
                                <form action="{{ route('migration.otros.nivel') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-9">
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
                                    <table id="dataTable1" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Fecha Creado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($niveles as $nivel)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $nivel->niv_nombre }}</td>
                                                    <td>{{ $nivel->niv_estado }}</td>
                                                    <td>{{ $nivel->updated_at }}</td>
                                                    <td>
                                                        {{-- @if (Auth::guard('admin')->user()->can('admin.edit'))
                                                            <a class="btn btn-success btn-round"
                                                                href="{{ route('migration.areatrabajo.edit', $areaTrabajo->area_id) }}">Editar</a>
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
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

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>Categorias</h5>
                                <span></span>
                                <br/>
                                @include('backend.layouts.partials.messages')
                                <form action="{{ route('migration.otros.categoria') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-sm-9">
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
                                    <table id="dataTable3" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
                                                <th>Estado</th>
                                                <th>Fecha Creado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categorias as $categoria)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $categoria->cat_nombre }}</td>
                                                    <td>{{ $categoria->cat_estado }}</td>
                                                    <td>{{ $categoria->updated_at }}</td>
                                                    <td>
                                                        {{-- @if (Auth::guard('admin')->user()->can('admin.edit'))
                                                            <a class="btn btn-success btn-round"
                                                                href="{{ route('migration.areatrabajo.edit', $areaTrabajo->area_id) }}">Editar</a>
                                                        @endif --}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre</th>
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
@endsection
