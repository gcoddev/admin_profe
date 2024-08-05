@extends('backend.layouts.master')

@section('title')
    Role Create - Admin Panel
@endsection

@section('styles')
    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endsection


@section('admin-content')
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Crear nuevo rol</h4>
                        @include('backend.layouts.partials.messages')

                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nombre del rol</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Ingrese el nombre del rol">
                            </div>

                            <div class="form-group">
                                <label for="name">Permisos</label>
                                <br>

                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" class="form-check-input" id="checkPermissionAll"
                                            value="1">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <label class="form-check-label" for="checkPermission">Todos</label>
                                    </label>
                                </div>
                                <hr>
                                @php $i = 1; @endphp
                                @foreach ($permission_groups as $group)
                                    <div class="row">
                                        <div class="col-3">

                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" class="form-check-input"
                                                        id="{{ $i }}Management" value="{{ $group->name }}"
                                                        onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                                    <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                    <label class="form-check-label"
                                                        for="checkPermission">{{ $group->name }}</label>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-9 role-{{ $i }}-management-checkbox">
                                            @php
                                                $permissions = App\User::getpermissionsByGroupName($group->name);
                                                $j = 1;
                                            @endphp
                                            @foreach ($permissions as $permission)
                                                <div class="checkbox-fade fade-in-primary">
                                                    <label>
                                                        <input type="checkbox" name="permissions[]"
                                                            id="checkPermission{{ $permission->id }}"
                                                            value="{{ $permission->name }}">

                                                        <span class="cr">
                                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                        </span>
                                                        <label class="form-check-label"
                                                            for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                    </label>
                                                </div>
                                                @php  $j++; @endphp
                                            @endforeach
                                            <br>
                                        </div>

                                    </div>
                                    @php  $i++; @endphp
                                @endforeach


                            </div>


                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Guarda Rol</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- data table end -->

        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('backend/files/assets/pages/form-validation/form-validation.js') }}">
    </script>
    @include('backend.pages.roles.partials.scripts')
@endsection
