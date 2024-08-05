@extends('backend.layouts.master')

@section('title')
    Inscripciones - Panel de Administración
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
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-right">
                                <!-- Tus botones -->
                            </div>
                        </div>
                        <div class="card-block">

                            <div class="row">
                                <div class="col-lg-12 col-xl-12">
                                    <!-- Campo de búsqueda -->

                                    <!-- Tabla -->
                                    <table id="simpletable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>RDA</th>
                                                <th>CI</th>
                                                <th>Turno</th>
                                                <th>Estado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($inscripciones as $inscripcion)
                                                <tr>
                                                    <td>
                                                        {{ $inscripcion->per_nombre1 }} {{ $inscripcion->per_nombre2 }}
                                                        {{ $inscripcion->per_apellido1 }} {{ $inscripcion->per_apellido2 }}
                                                        {{ $inscripcion->per_fecha_nacimiento }}
                                                        <br>
                                                        {{ $inscripcion->pro_nombre_abre }}
                                                        <br>
                                                        {{ $inscripcion->sede_nombre }}

                                                    </td>
                                                    <td>{{ $inscripcion->per_rda }}</td>
                                                    <td>{{ $inscripcion->per_ci }}</td>
                                                    <td>{{ $inscripcion->pro_tur_nombre }}</td>
                                                    <td>{{ $inscripcion->pie_nombre }}</td>
                                                    <td>
                                                        @if (Auth::guard('admin')->user()->can('inscripcion.edit'))
                                                            <a href="{{ route('admin.inscripcion.edit', encrypt($inscripcion->pi_id)) }}"
                                                                class="btn btn-outline-info waves-effect waves-light m-r-20">
                                                                <i class="icofont icofont-pencil-alt-5"></i>
                                                            </a>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>RDA</th>
                                                <th>CI</th>
                                                <th>Turno</th>
                                                <th>Estado</th>
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
@endsection

@section('scripts')
    <!-- Start datatable js -->

    <script src="{{ asset('backend/files/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('backend/files/assets/pages/data-table/js/jszip.min.js') }}"></script>
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
    </script>
@endsection
