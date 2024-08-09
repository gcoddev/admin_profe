<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RolePermissionSeeder.
 *
 * @see https://spatie.be/docs/laravel-permission/v5/basic-usage/multiple-guards
 *
 * @package App\Database\Seeds
 */
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * Enable these options if you need same role and other permission for User Model
         * Else, please follow the below steps for admin guard
         */

        // Create Roles and Permissions
        // $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        // $roleAdmin = Role::create(['name' => 'admin']);
        // $roleEditor = Role::create(['name' => 'editor']);
        // $roleUser = Role::create(['name' => 'user']);


        // Permission List as array
        $permissions = [
            [
                'group_name' => 'Dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],
            [
                'group_name' => 'admin',
                'permissions' => [
                    // admin Permissions
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                    'admin.approve',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // role Permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                    'role.approve',
                ]
            ],
            /// PROFE --------------------------------------------------------
            [
                'group_name' => 'Evento',
                'permissions' => [
                    'evento.view',
                    'evento.edit',
                    'evento.delete',
                ]
            ],
            [
                'group_name' => 'Programa',
                'permissions' => [
                    'programa.create',
                    'programa.view',
                    'programa.edit',
                    'programa.delete',
                ]
            ],
            [
                'group_name' => 'Configuración Programa',
                'permissions' => [
                    'configuracion_programa.create',
                    'configuracion_programa.view',
                    'configuracion_programa.edit',
                    'configuracion_programa.delete',
                ]
            ],
            [
                'group_name' => 'Blog',
                'permissions' => [
                    'blog.create',
                    'blog.view',
                    'blog.edit',
                    'blog.delete',
                ]
            ],
            [
                'group_name' => 'Galeria',
                'permissions' => [
                    'galeria.create',
                    'galeria.view',
                    'galeria.edit',
                    'galeria.delete',
                ]
            ],
            [
                'group_name' => 'Comunicado',
                'permissions' => [
                    'comunicado.create',
                    'comunicado.view',
                    'comunicado.edit',
                    'comunicado.delete',
                ]
            ],
            [
                'group_name' => 'PROFE',
                'permissions' => [
                    'profe.view',
                    'profe.edit',
                ]
            ],
            [
                'group_name' => 'Sede',
                'permissions' => [
                    'sede.create',
                    'sede.view',
                    'sede.edit',
                    'sede.delete',
                ]
            ],
            /// PROFE --------------------------------------------------------
            /// Controle de acceso al personal
            [
                'group_name' => 'Control personal',
                'permissions' => [
                    'control_personal.view',
                    'control_personal.edit',
                    'control_personal.delete',
                ]
            ],
            /// -------------------------------------------

            // PARTICIPANTES
            [
                'group_name' => 'Restriccion',
                'permissions' => [
                    'restriccion.create',
                    'restriccion.view',
                    'restriccion.edit',
                    'restriccion.delete',
                ]
            ],
            [
                'group_name' => 'Inscripcion',
                'permissions' => [
                    'inscripcion.create',
                    'inscripcion.view',
                    'inscripcion.edit',
                    'inscripcion.delete',
                    'inscripcion.pdfinscripcion',
                    'inscripcion.pdfpago',
                    'inscripcion.bauchereliminar',
                    'inscripcion.bauchereditar',
                    'inscripcion.reportepagos',
                    'inscripcion.pdflista',
                    'inscripcion.estado',
                ]
            ],
            [
                'group_name' => 'Baucher',
                'permissions' => [
                    'baucher.create',
                    'baucher.view',
                    'baucher.edit',
                ]
            ],
            [
                'group_name' => 'Calificacion',
                'permissions' => [
                    'calificacion.create',
                    'calificacion.view',
                    'calificacion.edit',
                    'calificacion.delete',
                ]
            ],
            [
                'group_name' => 'Migracion',
                'permissions' => [
                    'migracion.view',
                    'migracion.migration',
                    'migracion.edit',
                ]
            ],
        ];


        // Create and Assign Permissions
        // for ($i = 0; $i < count($permissions); $i++) {
        //     $permissionGroup = $permissions[$i]['group_name'];
        //     for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
        //         // Create Permission
        //         $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
        //         $roleSuperAdmin->givePermissionTo($permission);
        //         $permission->assignRole($roleSuperAdmin);
        //     }
        // }

        // Haga lo mismo con el guardia administrativo con fines tutoriales.
        $admin = Admin::where('username', 'superadmin')->first();
        $roleSuperAdmin = $this->maybeCreateSuperAdminRole($admin);

        // Crear y asignar permisos
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                $permissionExist = Permission::where('name', $permissions[$i]['permissions'][$j])->first();
                if (is_null($permissionExist)) {
                    $permission = Permission::create(
                        [
                            'name' => $permissions[$i]['permissions'][$j],
                            'group_name' => $permissionGroup,
                            'guard_name' => 'admin'
                        ]
                    );
                    $roleSuperAdmin->givePermissionTo($permission);
                    $permission->assignRole($roleSuperAdmin);
                }
            }
        }

        // Asignar permiso de rol de superadministrador al usuario superadministrador
        if ($admin) {
            $admin->assignRole($roleSuperAdmin);
        }
    }

    private function maybeCreateSuperAdminRole($admin): Role
    {
        if (is_null($admin)) {
            $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);
        } else {
            $roleSuperAdmin = Role::where('name', 'superadmin')->where('guard_name', 'admin')->first();
        }

        if (is_null($roleSuperAdmin)) {
            $roleSuperAdmin = Role::create(['name' => 'superadmin', 'guard_name' => 'admin']);
        }

        return $roleSuperAdmin;
    }
}
