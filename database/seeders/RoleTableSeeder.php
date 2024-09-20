<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $routes = Route::getRoutes();
        $routeArray = [];

        foreach ($routes as $route) {

            $routeName = $route->getName();

            if (str_contains($routeName, 'system.') || str_contains($routeName, 'crm.') || str_contains($routeName, 'business.') || str_contains($routeName, 'asset.')) {
                $routeArray[] = [
                    'uri' => $route->uri(),
                    'name' => $route->getName(),
                    'action' => $route->getActionName(),
                    'methods' => $route->methods(),
                ];
            }
        }

        $permissionsArr = [];

        foreach ($routeArray as $value) {
            
            $name = str_replace("App\Livewire\\", '', $value['action']);
            if (!str_contains($name, 'Edit') && !str_contains($name, 'Create') && !str_contains($name, 'Delete')) {
                $name = $name . 'View';
                $name = convertRoleName($name);
            } else {
                $name = convertRoleName($name);
            }
            $permissionsArr[] = $name;
        }

        $roles = [
            [
                'name' => 'super_admin',
                'permissions' => $permissionsArr
            ],
            [
                'name' => 'admin',
                'permissions' => []
            ],
            [
                'name' => 'user',
                'permissions' => []
            ]
        ];

        foreach ($roles as $key => $value) {
            $permission = $value['permissions'];
            unset($value['permissions']);
            $role = Role::create($value);
            $role->givePermissionTo($permission);
        }
    }
}
