
@extends('backend.layouts.master')

@section('title')
Role Edit - Admin Panel
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
                    <h4 class="header-title">Editar Rol</h4>
                    @include('backend.layouts.partials.messages')

                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Roles Nombre</label>
                            <input type="text" class="form-control" id="name" value="{{ $role->name }}" name="name" placeholder="Enter a Role Name">
                        </div>

                        <div class="form-group">
                            <label for="name">Permisos</label>

                            <div class="form-check">

                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1" {{ App\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                        <label class="form-check-label" for="checkPermissionAll">Todos</label>
                                    </label>
                                </div>
                            </div>
                            <hr>
                            @php $i = 1; @endphp
                            @foreach ($permission_groups as $group)
                                <div class="row">
                                    @php
                                        $permissions = App\User::getpermissionsByGroupName($group->name);
                                        $j = 1;
                                    @endphp

                                    <div class="col-3">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>

                                                    <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{ App\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                                    <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                    <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-9 role-{{ $i }}-management-checkbox">

                                        @foreach ($permissions as $permission)
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                                        <span class="cr">
                                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                        </span>
                                                        <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                    </div>
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
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Actualizar Rol</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- data table end -->

    </div>
</div>
@endsection


@section('scripts')
     @include('backend.pages.roles.partials.scripts')
@endsection
