@extends('backend.layouts.master')

@section('title')
    Admins - Admin Panel
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
                                <h5>Zero Configuration</h5>
                                <span>DataTables has most features enabled by default, so all
                                    you need to do to use it with your own ables is to call the
                                    construction function: $().DataTable();.</span>
                            </div>
                            @include('backend.layouts.partials.messages')
                            <div class="card-block">
                                <p class="float-right mb-2">
                                    @if (Auth::guard('admin')->user()->can('admin.edit'))
                                        <a class="btn btn-primary text-white" href="{{ route('admin.admins.create') }}">Crear
                                            Nuevo
                                            Admin</a>
                                    @endif
                                </p>

                                <div class="dt-responsive table-responsive">
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Correo</th>
                                                <th>Roles</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admins as $admin)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $admin->nombre }}</td>
                                                    <td>{{ $admin->apellidos }}</td>
                                                    <td>{{ $admin->correo }}</td>
                                                    <td>
                                                        @foreach ($admin->roles as $role)
                                                            <span class="badge badge-info mr-1">
                                                                {{ $role->name }}
                                                            </span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if (Auth::guard('admin')->user()->can('admin.edit'))
                                                            <a class="btn btn-success text-white"
                                                                href="{{ route('admin.admins.edit', $admin->id) }}">Editar</a>
                                                        @endif

                                                        @if (Auth::guard('admin')->user()->can('admin.delete'))
                                                            <a class="btn btn-danger text-white"
                                                                href="{{ route('admin.admins.destroy', $admin->id) }}"
                                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $admin->id }}').submit();">
                                                                Eliminar
                                                            </a>
                                                            <form id="delete-form-{{ $admin->id }}"
                                                                action="{{ route('admin.admins.destroy', $admin->id) }}"
                                                                method="POST" style="display: none;">
                                                                @method('DELETE')
                                                                @csrf
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Nombre</th>
                                                <th>Apellidos</th>
                                                <th>Correo</th>
                                                <th>Roles</th>
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
    <!-- data table end -->
@endsection


@section('scripts')
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
    </script>
@endsection
