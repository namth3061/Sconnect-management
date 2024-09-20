<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RefreshPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store permission from route on system';

    /**
     * Execute the console command.
     */
    public function handle()
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
        $permissions = [];
        foreach ($routeArray as $value) {
            $name = str_replace("App\Livewire\\", '', $value['action']);
            if (!str_contains($name, 'Edit') && !str_contains($name, 'Create') && !str_contains($name, 'Delete')) {
                $name = $name . ' View';
            } else {
                $name = convertRoleName($name);
            }
            $permissions[] = $name;
            Permission::findOrCreate($name);
        }

        {
            $name = 'User delete' ;
            $permissions[] = $name;
            Permission::findOrCreate($name);
        }

        $roles = [
            [
                'name' => 'super_admin',
                'permissions' => $permissions,
            ],
        ];
        foreach ($roles as $key => $value) {
            $permission = $value['permissions'];
            unset($value['permissions']);
            $role = Role::findOrCreate($value['name']);
            $role->givePermissionTo($permission);
        }

    }

}
