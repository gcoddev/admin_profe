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
                                <h4>Sources Datatable</h4>
                                <span>Printable version of the DataTable</span>
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
                                    <a href="#!">Data Table</a>
                                </li>
                                <li class="breadcrumb-item" style="float: left">
                                    <a href="#!">Data Sources</a>
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
                                <h5>HTML (DOM) Sourced Data</h5>
                                <span>T.</span>
                            </div>
                            @if (isset($errors) && $errors->any())
                                <div class="alert alert-danger" role="alert">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{ route('migration.inscripciones.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="import_file" />
                                <button class="btn btn-primary" type="submit">Import</button>
                            </form>
                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>RDA</th>
                                                <th>CI</th>
                                                <th>Nombre 1</th>
                                                <th>Nombre 2</th>
                                                <th>Apellido 1</th>
                                                <th>Apellido 2</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($personaInscritos as $persona)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $persona->per_rda }}</td>
                                                    <td>{{ $persona->per_ci }}</td>
                                                    <td>{{ $persona->per_nombre1 }}</td>
                                                    <td>{{ $persona->per_nombre2 }}</td>
                                                    <td>{{ $persona->per_apellido1 }}</td>
                                                    <td>{{ $persona->per_apellido2 }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>RDA</th>
                                                <th>CI</th>
                                                <th>Nombre 1</th>
                                                <th>Nombre 2</th>
                                                <th>Apellido 1</th>
                                                <th>Apellido 2</th>
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
