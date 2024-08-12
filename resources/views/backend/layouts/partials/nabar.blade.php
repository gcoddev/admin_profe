@php
    use Illuminate\Support\Facades\DB;
    $usr = Auth::guard('admin')->user();
    $sedes = DB::table('sede')->get();
@endphp
<!-- nabar area start -->
<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">ADMINISTRADOR</div>
        <ul class="pcoded-item pcoded-left-item">
            @if ($usr->can('dashboard.view'))
                <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
            @endif
            @if ($usr->can('role.create') || $usr->can('role.view') || $usr->can('role.edit') || $usr->can('role.delete'))
                <li
                    class="pcoded-hasmenu {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') ? 'active' : '' }}">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="icofont icofont-shield"></i></span>
                        <span>
                            Roles & Permisos
                        </span></a>
                    <ul class="pcoded-submenu">
                        @if ($usr->can('role.view'))
                            <li
                                class="{{ Route::is('admin.roles.index') || Route::is('admin.roles.edit') ? 'active' : '' }}">
                                <a href="{{ route('admin.roles.index') }}">
                                    <span class="pcoded-mtext">Todos Roles
                                    </span>
                                </a>
                            </li>
                        @endif
                        @if ($usr->can('role.create'))
                            <li class="{{ Route::is('admin.roles.create') ? 'active' : '' }}">
                                <a href="{{ route('admin.roles.create') }}">
                                    <span class="pcoded-mtext">Crear
                                        Rol</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif


            @if ($usr->can('admin.create') || $usr->can('admin.view') || $usr->can('admin.edit') || $usr->can('admin.delete'))
                <li
                    class="pcoded-hasmenu {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') ? 'active' : '' }}">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="icofont icofont-shield-alt"></i></span>
                        <span>
                            Admins
                        </span></a>
                    </a>
                    <ul class="pcoded-submenu">

                        @if ($usr->can('admin.view'))
                            <li
                                class="{{ Route::is('admin.admins.index') || Route::is('admin.admins.edit') ? 'active' : '' }}">
                                <a href="{{ route('admin.admins.index') }}"><span class="pcoded-mtext">Todos Admins</a>
                            </li>
                        @endif

                        @if ($usr->can('admin.create'))
                            <li class="{{ Route::is('admin.admins.create') ? 'active' : '' }}">
                                <a href="{{ route('admin.admins.create') }}"><span class="pcoded-mtext">Crear Admin</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            </li>
            @if ($usr->can('migracion.view'))
            <li class="pcoded-hasmenu">

                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                    <span class="pcoded-mtext">Migraciones</span>
                    {{-- <span class="pcoded-badge label label-warning">NEW</span> --}}
                </a>

                <ul class="pcoded-submenu">
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-mtext">Ciudad</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{ route('migration.distrito.index') }}">
                                    <span class="pcoded-mtext">Distrito</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{ route('migration.departamento.index') }}">
                                    <span class="pcoded-mtext">Departamento</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-mtext">Otros</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class=" ">
                                <a href="{{ route('migration.especialidad.index') }}">
                                    <span class="pcoded-mtext">Especialidad</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{ route('migration.cargo.index') }}">
                                    <span class="pcoded-mtext">Cargo</span>
                                </a>
                            </li>
                            <li class=" ">
                                <a href="{{ route('migration.unidadeducativa.index') }}">
                                    <span class="pcoded-mtext">Unidad Educativa</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="{{ route('migration.otros.index') }}">
                                    <span class="pcoded-mtext">Otros</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class=" ">
                        <a href="{{ route('migration.usuarios.index') }}">
                            <span class="pcoded-mtext">Personas</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('migration.inscripciones.index') }}">
                            <span class="pcoded-mtext">Inscripciones</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if ($usr->can('configuracion_programa.view'))
            <li class="pcoded-hasmenu">

                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                    <span class="pcoded-mtext">Configuraciones</span>
                    {{-- <span class="pcoded-badge label label-warning">NEW</span> --}}
                </a>

                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{ route('configuracion.programa.index') }}">
                            <span class="pcoded-mtext">Programa</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('configuracion.sede.index') }}">
                            <span class="pcoded-mtext">Sede Cupos - Turnos</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('configuracion.programa.index') }}">
                            <span class="pcoded-mtext">Evento</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{ route('configuracion.restriccion.index') }}">
                            <span class="pcoded-mtext">Programa Restricciones</span>
                        </a>
                    </li>

                </ul>
            </li>
            @endif
            @if ($usr->can('programa.view'))
            <li class>
                <a href="{{ route('admin.programa.index') }}">
                    <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                    <span class="pcoded-mtext">Programas</span>
                </a>
            </li>
            @endif
            @if ($usr->can('comunicado.view'))
                <li class>
                    <a href="{{ route('admin.inscripcion.buscadorpersona') }}">
                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                        <span class="pcoded-mtext">Buscardor</span>
                    </a>
                </li>
            @endif
            @if ($usr->can('sede.view'))
            <li class>
                <a href="{{ route('admin.sede.index') }}">
                    <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                    <span class="pcoded-mtext">Sedes</span>
                </a>
            </li>
            @endif
            @if ($usr->can('inscripcion.view'))
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                        <span class="pcoded-mtext">Inscripciones</span>
                    </a>
                    <ul class="pcoded-submenu">
                        @foreach($sedes as $sede)
                            @if (!is_null($usr->sede_ids) && !empty(json_decode($usr->sede_ids)))
                                @if (in_array($sede->sede_id, json_decode($usr->sede_ids)))
                                    <li>
                                        <a href="{{ route('admin.inscripcion.index', ['sede_id' => encrypt($sede->sede_id)]) }}">
                                            <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                            <span class="pcoded-mtext">{{ $sede->sede_nombre }}</span>
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li>
                                    <a href="{{ route('admin.inscripcion.index', ['sede_id' => encrypt($sede->sede_id)]) }}">
                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                        <span class="pcoded-mtext">{{ $sede->sede_nombre }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
<<<<<<< HEAD
            @if ($usr->can('calificacion.view'))
                <li class="pcoded-hasmenu">
                    <a href="javascript:void(0)">
                        <span class="pcoded-micon"><i class="feather icon-sidebar"></i></span>
                        <span class="pcoded-mtext">Calificaciones</span>
                    </a>
                    <ul class="pcoded-submenu">
                        @foreach($sedes as $sede)
                            @if (!is_null($usr->sede_ids) && !empty(json_decode($usr->sede_ids)))
                                @if (in_array($sede->sede_id, json_decode($usr->sede_ids)))
                                    <li>
                                        <a href="{{ route('admin.calificacion.index', ['sede_id' => encrypt($sede->sede_id)]) }}">
                                            <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                            <span class="pcoded-mtext">{{ $sede->sede_nombre }}</span>
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li>
                                    <a href="{{ route('admin.calificacion.index', ['sede_id' => encrypt($sede->sede_id)]) }}">
                                        <span class="pcoded-micon"><i class="feather icon-menu"></i></span>
                                        <span class="pcoded-mtext">{{ $sede->sede_nombre }}</span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    
                </li>
            @endif
=======
>>>>>>> 278a853 (first commit)

            {{-- <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                    <span class="pcoded-mtext">Widget</span>
                    <span class="pcoded-badge label label-danger">100+</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="default/widget-statistic.html">
                            <span class="pcoded-mtext">Statistic</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="default/widget-data.html">
                            <span class="pcoded-mtext">Data</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="default/widget-chart.html">
                            <span class="pcoded-mtext">Chart Widget</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Other</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-list"></i></span>
                    <span class="pcoded-mtext">Administrador</span>
                </a>

                <ul class="pcoded-submenu">



                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-mtext">Menu Level 2.2</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class>
                                <a href="javascript:void(0)">
                                    <span class="pcoded-mtext">Menu Level 3.1</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class>
                        <a href="javascript:void(0)">
                            <span class="pcoded-mtext">Menu Level 2.3</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class>
                <a href="javascript:void(0)" class="disabled">
                    <span class="pcoded-micon"><i class="feather icon-power"></i></span>
                    <span class="pcoded-mtext">Disabled Menu</span>
                </a>
            </li>
            <li class>
                <a href="default/sample-page.html">
                    <span class="pcoded-micon"><i class="feather icon-watch"></i></span>
                    <span class="pcoded-mtext">Sample Page</span>
                </a>
            </li>
        </ul>
        <div class="pcoded-navigatio-lavel">Support</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class>
                <a href="http://html.codedthemes.com/Adminty/doc" target="_blank">
                    <span class="pcoded-micon"><i class="feather icon-monitor"></i></span>
                    <span class="pcoded-mtext">Documentation</span>
                </a>
            </li>
            <li class>
                <a href="#" target="_blank">
                    <span class="pcoded-micon"><i class="feather icon-help-circle"></i></span>
                    <span class="pcoded-mtext">Submit Issue</span>
                </a>
            </li>
        </ul> --}}
    </div>
</nav>
<!-- header area end -->
{{-- <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('admin.dashboard') }}">
                <h2 class="text-white">Admin</h2>
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">

                    @if ($usr->can('dashboard.view'))
                    <li class="active">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        <ul class="collapse">
                            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        </ul>
                    </li>
                    @endif

                    @if ($usr->can('role.create') || $usr->can('role.view') || $usr->can('role.edit') || $usr->can('role.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-tasks"></i><span>
                            Roles & Permissions
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'in' : '' }}">
                            @if ($usr->can('role.view'))
                                <li class="{{ Route::is('admin.roles.index')  || Route::is('admin.roles.edit') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                            @endif
                            @if ($usr->can('role.create'))
                                <li class="{{ Route::is('admin.roles.create')  ? 'active' : '' }}"><a href="{{ route('admin.roles.create') }}">Create Role</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif


                    @if ($usr->can('admin.create') || $usr->can('admin.view') || $usr->can('admin.edit') || $usr->can('admin.delete'))
                    <li>
                        <a href="javascript:void(0)" aria-expanded="true"><i class="fa fa-user"></i><span>
                            Admins
                        </span></a>
                        <ul class="collapse {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'in' : '' }}">

                            @if ($usr->can('admin.view'))
                                <li class="{{ Route::is('admin.admins.index')  || Route::is('admin.admins.edit') ? 'active' : '' }}"><a href="{{ route('admin.admins.index') }}">All Admins</a></li>
                            @endif

                            @if ($usr->can('admin.create'))
                                <li class="{{ Route::is('admin.admins.create')  ? 'active' : '' }}"><a href="{{ route('admin.admins.create') }}">Create Admin</a></li>
                            @endif
                        </ul>
                    </li>
                    @endif

                </ul>
            </nav>
        </div>
    </div>
</div> --}}
<!-- sidebar menu area end -->
