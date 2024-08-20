@extends('backend.layouts.master')

@section('title')
    Comunicados - Admin Panel
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
                                <h4>Comunicados</h4>
                                <span>Lista de Comunicados existentes</span>
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
                                    <a href="#!">Lista de Comunicados</a>
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
                                <h5>Comunicados</h5>
                                <span></span>
                                <br />
                                @include('backend.layouts.partials.messages')
                                @if (Auth::guard('admin')->user()->can('comunicado.create'))
                                    <a class="btn btn-out btn-primary btn-square"
                                        href="{{ route('admin.comunicado.create') }}">Agregar
                                    </a>
                                @endif
                            </div>

                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    <table id="simpletable" class="table table-striped table-bordered nowrap">
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
                                            @foreach ($comunicados as $comunicado)
                                                <tr>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>
                                                        {{ $comunicado->comun_nombre }}
                                                    </td>
                                                    <td>
                                                        @if (Auth::guard('admin')->user()->can('comunicado.edit'))
                                                            <a href="{{ route('admin.comunicado.estado', $comunicado->comun_id) }}"
                                                                class="btn btn-{{ $comunicado->comun_estado == 'activo' ? 'success' : 'danger' }}">
                                                                {{ $comunicado->comun_estado }}
                                                            </a>
                                                        @else
                                                            <a href=""
                                                                class="btn btn-{{ $comunicado->comun_estado == 'activo' ? 'success' : 'danger' }}">
                                                                {{ $comunicado->comun_estado }}
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td>{{ $comunicado->updated_at }}</td>
                                                    <td>
                                                        @if (Auth::guard('admin')->user()->can('comunicado.edit'))
                                                            <a href="{{ route('admin.comunicado.edit', $comunicado->comun_id) }}"
                                                                class="btn btn-outline-warning waves-effect waves-light m-r-20">
                                                                <i class="icofont icofont-edit-alt"></i>
                                                                <!-- Ícono de Font Awesome -->
                                                            </a>
                                                        @endif
                                                        @if (Auth::guard('admin')->user()->can('comunicado.delete'))
                                                            <a href="{{ route('admin.comunicado.destroy', $comunicado->comun_id) }}"
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
