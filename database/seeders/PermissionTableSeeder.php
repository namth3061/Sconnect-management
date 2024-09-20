<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
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

        foreach ($routeArray as $value) {

            $name = str_replace("App\Livewire\\", '', $value['action']);
            if (!str_contains($name, 'Edit') && !str_contains($name, 'Create') && !str_contains($name, 'Delete')) {
                $name = $name . 'View';
                $name = convertRoleName($name);
            } else {
                $name = convertRoleName($name);
            }
            Permission::findOrCreate($name);
        }
    }
}
