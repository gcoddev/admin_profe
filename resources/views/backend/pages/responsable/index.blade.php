@extends('backend.layouts.master')

@section('title')
    Responsables - Admin Panel
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
                                <h4>Responsables</h4>
                                <span>Lista de Responsables existentes</span>
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
                                    <a href="#!">Lista de Responsables</a>
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
                                <h5>Blogs</h5>
                                <span></span>
                                <br />
                                @include('backend.layouts.partials.messages')
                                @if (Auth::guard('admin')->user()->can('admin.create'))
                                    <a class="btn btn-out btn-primary btn-square"
                                        href="{{ route('admin.responsable.create') }}">Agregar
                                    </a>
                                @endif
                            </div>

                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre completo</th>
                                                <th>Estado</th>
                                                <th>Fecha Actualizado</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($responsables as $resp)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        {{ $resp->resp_profe_nombre_completo }}
                                                    </td>
                                                    <td>
                                                        @if (Auth::guard('admin')->user()->can('admin.edit'))
                                                            <a href="{{ route('admin.responsable.estado', $resp->resp_profe_id) }}"
                                                                class="btn btn-{{ $resp->resp_profe_estado == 'activo' ? 'success' : 'danger' }}">
                                                                {{ $resp->resp_profe_estado }}
                                                            </a>
                                                        @else
                                                            <a href=""
                                                                class="btn btn-{{ $resp->resp_profe_estado == 'activo' ? 'success' : 'danger' }}">
                                                                {{ $resp->resp_profe_estado }}
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $resp->updated_at }}</td>
                                                    <td>
                                                        @if (Auth::guard('admin')->user()->can('admin.edit'))
                                                            <a href="{{ route('admin.responsable.edit', $resp->resp_profe_id) }}"
                                                                class="btn btn-outline-warning waves-effect waves-light m-r-20">
                                                                <i class="icofont icofont-edit-alt"></i>
                                                                <!-- Ícono de Font Awesome -->
                                                            </a>
                                                        @endif
                                                        @if (Auth::guard('admin')->user()->can('admin.delete'))
                                                            <a href="{{ route('admin.responsable.destroy', $resp->resp_profe_id) }}"
                                                                class="btn btn-outline-danger waves-effect waves-light m-r-20"
                                                                {{-- onclick="_gaq.push(['_trackEvent', 'example', 'try', 'alert-success-cancel']);" --}} data-confirm-delete="true">
                                                                <i class="icofont icofont-ui-delete"></i>
                                                                <!-- Ícono de Font Awesome -->
                                                            </a>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nro</th>
                                                <th>Nombre completo</th>
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
    <style>
        .permissions-column {
            width: 60%;
            word-wrap: break-word;
            white-space: normal;
        }
    </style>
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
