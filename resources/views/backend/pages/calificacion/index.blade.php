@extends('backend.layouts.master')

@section('title')
    Calificaciones - Admin Panel
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
                                <h4>Calificaciones</h4>
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
                                    <a href="#!">Calificaciones</a>
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
                                        <!-- El resto de tu contenido aquí -->
                                    @include('backend.layouts.partials.messages')
                                    
                                    <ul class="nav nav-tabs tabs" role="tablist" id="calificacionTabs">
                                        @foreach ($inscripciones->groupBy('pro_id') as $pro_id => $inscripcionesGrouped)
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab"
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
                                            <div class="tab-pane"
                                            id="tab_{{ $pro_id }}" role="tabpanel">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    {{-- <h5 class="mb-0">{{ $inscripcionesGrouped->first()->pro_nombre }}</h5> --}}
                                                    <div>
                                                        @php
                                                            $shownModules = [];
                                                        @endphp
                                                        @foreach ($modulos as $modulo)
                                                            @if ($modulo->pro_id == $pro_id && !in_array($modulo->pm_id, $shownModules))
                                                                <a target="_blank" href="" class="btn btn-outline-danger waves-effect waves-light">
                                                                    <i class="icofont icofont-file-pdf"></i> {{$modulo->pm_nombre}}
                                                                </a>
                                                                @php
                                                                    $shownModules[] = $modulo->pm_id;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="dt-responsive table-responsive">
                                                    
                                                    <table id="dataTable{{ $loop->index }}"
                                                        class="table table-striped table-bordered nowrap" >
                                                        <thead>
                                                            <tr>
                                                                <th>Nro</th>
                                                                <th>CI</th>
                                                                <th>Nombre</th>
                                                                @foreach ($modulos as $modulo)
                                                                    @if ($modulo->pro_id == $pro_id)
                                                                        <th>{{$modulo->pm_nombre}}: {{ $modulo->ptc_nombre}} ({{$modulo->ptc_nota}} ptos.)</th>
                                                                    @endif
                                                                @endforeach
                                                                <th>Estado</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($inscripcionesGrouped as $inscripcion)
                                                                <tr>
                                                                    <td>{{ $loop->index + 1 }}</td>
                                                                    <td>
                                                                        {{ $inscripcion->per_ci }}
                                                                        
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        {{ $inscripcion->per_nombre1 }}
                                                                        {{ $inscripcion->per_nombre2 }}
                                                                        {{ $inscripcion->per_apellido1 }}
                                                                        {{ $inscripcion->per_apellido2 }}
                                                                    </td>
                                                                    @foreach ($modulos as $modulo)
                                                                        @if ($modulo->pro_id == $pro_id)
                                                                            @php
                                                                                $calificacion = $calificaciones->where('pm_id', $modulo->pm_id)->where('pi_id', $inscripcion->pi_id)->where('pc_id', $modulo->pc_id)->first();
                                                                                $rowColor = $modulo->pm_id % 2 == 0 ? '#ffe7b8' : '#ffeadb';
                                                                            @endphp
                                                                           <td style="background-color: {{ $rowColor }}" onclick="makeEditable(this)">
                                                                                <span class="display-mode">{{ $calificacion->cp_puntaje ?? 0 }}</span>
                                                                                <form action="{{ route('admin.calificacion.storecalificacion', 
                                                                                    ['pi_id' => $inscripcion->pi_id, 'pm_id' => $modulo->pm_id, 'pc_id' => $modulo->pc_id]) }}" 
                                                                                    method="POST" class="edit-mode" style="display:none;" onsubmit="submitForm(this); return false;">
                                                                                    @csrf
                                                                                    <input class="form-control input-sm" 
                                                                                        type="text" 
                                                                                        name="cp_puntaje" 
                                                                                        id="cp_puntaje" 
                                                                                        value="{{ $calificacion->cp_puntaje ?? 0 }}"
                                                                                        onblur="exitEditMode(this)" 
                                                                                        onkeypress="handleKeyPress(event, this)">
                                                                                </form>
                                                                            </td>
                                                                        @endif
                                                                    @endforeach
                                                                    <td>
                                                                        APROBADO
                                                                    </td>
                                                                    <td>
                                                                        @if (Auth::guard('admin')->user()->can('calificacion.edit'))
                                                                            <a href="{{ route('admin.inscripcion.edit', encrypt($inscripcion->pi_id)) }}"
                                                                                class="btn btn-outline-info waves-effect waves-light m-r-20">
                                                                                <i class="icofont icofont-pencil-alt-5"></i>
                                                                            </a>
                                                                        @endif
                                                                        @if (Auth::guard('admin')->user()->can('calificacion.delete'))
                                                                            <a href="{{ route('admin.inscripcion.edit', encrypt($inscripcion->pi_id)) }}"
                                                                                class="btn btn-outline-danger waves-effect waves-light m-r-20">
                                                                                <i class="icofont icofont-ui-delete"></i>
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
    document.addEventListener('DOMContentLoaded', function () {
        var tabLinks = document.querySelectorAll('#calificacionTabs .nav-link');
        var activeTabIndex = localStorage.getItem('activeTabIndex');
        
        if (activeTabIndex !== null) {
            tabLinks[activeTabIndex].classList.add('active');
            document.querySelector(tabLinks[activeTabIndex].getAttribute('href')).classList.add('active');
        } else {
            tabLinks[0].classList.add('active');
            document.querySelector(tabLinks[0].getAttribute('href')).classList.add('active');
        }

        tabLinks.forEach(function (link, index) {
            link.addEventListener('click', function () {
                localStorage.setItem('activeTabIndex', index);
            });
        });
    });
    function makeEditable(td) {
        const span = td.querySelector('.display-mode');
        const form = td.querySelector('.edit-mode');
        
        span.style.display = 'none';
        form.style.display = 'block';
        form.querySelector('input').focus();
    }

    function exitEditMode(input) {
        const td = input.closest('td');
        const span = td.querySelector('.display-mode');
        const form = td.querySelector('.edit-mode');
        
        span.style.display = 'block';
        form.style.display = 'none';
    }

    function handleKeyPress(event, input) {
        if (event.key === 'Enter') {
            input.form.submit();
        }
    }

    function submitForm(form) {
        // Aquí puedes manejar la lógica de envío del formulario.
        // Puedes usar AJAX para enviar los datos sin recargar la página.
        
        const td = form.closest('td');
        const span = td.querySelector('.display-mode');
        
        // Actualiza el texto del <span> con el nuevo valor
        span.textContent = form.querySelector('input').value;
        
        exitEditMode(form.querySelector('input'));
    }
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
        $(document).ready(function() {
            // Inicializar las tablas
            var tables = [];
            @foreach ($inscripciones->groupBy('pro_id') as $pro_id => $inscripcionesGrouped)
                var table{{ $loop->index }} = $('#dataTable{{ $loop->index }}').DataTable({
                    responsive: false,
                    searching: true // Activa la búsqueda interna de DataTables
                });
                tables.push(table{{ $loop->index }});
            @endforeach
    
            // Configurar el buscador general
            $('#searchInput').on('keyup', function() {
                var searchValue = $(this).val().toLowerCase();
                tables.forEach(function(table) {
                    table.columns().every(function() {
                        var column = this;
                        column.search(searchValue, false, true).draw();
                    });
                });
            });
        });
    </script>
    
    
@endsection
