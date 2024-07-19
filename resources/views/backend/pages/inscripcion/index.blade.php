@extends('backend.layouts.master')

@section('title')
    Inscripciones - Admin Panel
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
                                <h4>Inscripciones</h4>
                                <span>{{ $inscripciones->first()->dep_nombre ?? '' }} -
                                    {{ $inscripciones->first()->sede_nombre ?? 'Nombre de Sede' }}</span>
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
                                    <a href="#!">Lista de Inscripciones</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-header-right">
                                <ul class="list-unstyled card-option">
                                    <li><i class="feather icon-maximize full-card"></i></li>
                                    {{-- <li><i class="feather icon-minus minimize-card"></i> --}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-block">

                            <div class="row">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="sub-title">{{ $inscripciones->first()->dep_nombre ?? '' }} -
                                        {{ $inscripciones->first()->sede_nombre ?? 'Nombre de Sede' }}
                                    </div>

                                    @include('backend.layouts.partials.messages')
                                    @if (Auth::guard('admin')->user()->can('inscripcion.create'))
                                        <a class="btn btn-out btn-success btn-square"
                                            href="{{ route('admin.inscripcion.create', ['sede_id' => $sede_id]) }}">Preinscribir
                                        </a><br><br>
                                    @endif
                                    <ul class="nav nav-tabs tabs" role="tablist">
                                        @foreach ($inscripciones->groupBy('pro_id') as $pro_id => $inscripcionesGrouped)
                                            <li class="nav-item">
                                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab"
                                                    href="#tab_{{ $pro_id }}" role="tab">
                                                    {{ $inscripcionesGrouped->first()->pro_nombre_abre }}
                                                </a>
                                                <div class="slide"></div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <br>
                                    <div class="tab-content tabs">
                                        @foreach ($inscripciones->groupBy('pro_id') as $pro_id => $inscripcionesGrouped)
                                            <div class="tab-pane {{ $loop->first ? 'active' : '' }}"
                                                id="tab_{{ $pro_id }}" role="tabpanel">
                                                <div class="dt-responsive table-responsive">
                                                    <table id="dataTable{{ $loop->index }}"
                                                        class="table table-striped table-bordered nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th>Nro</th>
                                                                <th>Nombre</th>
                                                                <th>Turno</th>
                                                                <th>Baucher</th>
                                                                <th>Estado</th>
                                                                <th>Fecha Actualizado</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($inscripcionesGrouped as $inscripcion)
                                                                <tr
                                                                    class="{{ !$inscripcion->cumple_restricciones ? 'table-danger' : '' }}">
                                                                    <td>{{ $loop->index + 1 }}</td>
                                                                    <td>
                                                                        {{ $inscripcion->per_nombre1 }}
                                                                        {{ $inscripcion->per_nombre2 }}
                                                                        {{ $inscripcion->per_apellido1 }}
                                                                        {{ $inscripcion->per_apellido2 }}
                                                                        <strong>|RDA:</strong>
                                                                        {{ $inscripcion->per_rda }}<br>
                                                                        <strong>En funcion:
                                                                            {{ $inscripcion->per_en_funcion ? 'SI' : 'NO' }}
                                                                        </strong>
                                                                        @if (!empty($inscripcion->per_celular))
                                                                            <br><strong>Celular:</strong> <a
                                                                                href="https://wa.me/{{ '+591' . $inscripcion->per_celular }}"
                                                                                target="_blank">{{ $inscripcion->per_celular }}</a><br>
                                                                        @endif
                                                                        @if (!$inscripcion->cumple_restricciones)
                                                                            <strong>Motivo:
                                                                                {{ $inscripcion->porque_no_cumple }}</strong>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $inscripcion->pro_tur_nombre }}</td>
                                                                    <td>
                                                                    @php
                                                                        $totalMonto = 0;
                                                                    @endphp
                                                                    @foreach ($baucheres as $baucher)
                                                                        @if ($baucher->pi_id == $inscripcion->pi_id)
                                                                            <div class="p-0 border rounded">
                                                                                <a href="{{ Storage::url($baucher->pro_bau_imagen) }}?{{ \Illuminate\Support\Str::random(8) }}"
                                                                                    class="btn btn-link text-decoration-none text-primary"
                                                                                    data-lightbox="{{ $baucher->pi_id }}"
                                                                                    data-title="{{ $baucher->pro_bau_nro_deposito }}">
                                                                                    {{ $baucher->pro_bau_nro_deposito }} |
                                                                                    <strong>{{ $baucher->pro_bau_monto }}
                                                                                        Bs.</strong>
                                                                                </a>
                                                                            </div>
                                                                            @php
                                                                                $totalMonto += $baucher->pro_bau_monto;
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                    <div class="mt-2 font-weight-bold">
                                                                        @if ($totalMonto >= $inscripcion->pro_costo)
                                                                            <span class="text-success">Total completado: {{ $totalMonto }} Bs.</span>
                                                                        @else
                                                                            <span class="text-danger">Monto faltante: {{ $inscripcion->pro_costo - $totalMonto }} Bs.</span>
                                                                        @endif
                                                                    </div>
                                                                    </td>
                                                                    <td>
                                                                        @if ($inscripcion->pie_nombre == 'INSCRITO')
                                                                            <span
                                                                                class="label label-success">{{ $inscripcion->pie_nombre }}</span>
                                                                        @elseif ($inscripcion->pie_nombre == 'PREINSCRITO')
                                                                            <span
                                                                                class="label label-warning">{{ $inscripcion->pie_nombre }}</span>
                                                                        @else
                                                                            <span
                                                                                class="label label-danger">{{ $inscripcion->pie_nombre }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $inscripcion->updated_at }}</td>
                                                                    <td>
                                                                        @if (Auth::guard('admin')->user()->can('inscripcion.edit'))
                                                                        <a href="{{ route('admin.inscripcion.edit', encrypt($inscripcion->pi_id)) }}"
                                                                            class="btn btn-outline-info waves-effect waves-light m-r-20">
                                                                            <i class="icofont icofont-pencil-alt-5"></i>
                                                                        </a>
                                                                        @endif
                                                                        @if (Auth::guard('admin')->user()->can('inscripcion.pdf'))
                                                                        <a href="{{ route('admin.inscripcion.formulariopdf', encrypt($inscripcion->pi_id)) }}"
                                                                            class="btn btn-outline-danger waves-effect waves-light m-r-20">
                                                                            <i class="icofont icofont-file-pdf"></i>
                                                                        </a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sedeSelect = document.getElementById('sede');
            const programaSelect = document.getElementById('programa');
            const turnoSelect = document.getElementById('turno');

            function updateTurnos() {
                const sedeId = sedeSelect.value;
                const proId = programaSelect.value;

                if (sedeId && proId) {
                    fetch(`/get-turnos?sede_id=${sedeId}&pro_id=${proId}`)
                        .then(response => response.json())
                        .then(data => {
                            turnoSelect.innerHTML = '<option value="">Seleccione un turno</option>';
                            if (data.length > 0) {
                                data.forEach(turno => {
                                    turnoSelect.innerHTML +=
                                        `<option value="${turno.pro_tur_id}">${turno.pro_tur_nombre}</option>`;
                                });
                            }
                        });
                } else {
                    turnoSelect.innerHTML = '<option value="">Seleccione un turno</option>';
                }
            }

            sedeSelect.addEventListener('change', updateTurnos);
            programaSelect.addEventListener('change', updateTurnos);
        });
    </script>
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
        if ($('#dataTable').length) {
            $('#dataTable').DataTable({
                responsive: true
            });
        }
        $(document).ready(function() {
            @foreach ($inscripciones->groupBy('pro_id') as $pro_id => $inscripcionesGrouped)
                $('#dataTable{{ $loop->index }}').DataTable({
                    responsive: false
                });
            @endforeach
        });
    </script>
@endsection
