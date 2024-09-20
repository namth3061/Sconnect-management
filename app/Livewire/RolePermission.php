<?php

namespace App\Livewire;

use App\Enums\ModalSize;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Response;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermission extends Component
{

    public string $showFromCreateRole = '';
    public string $modalSize = '';

    public $roles;
    public $permissions;
    public $permissionMatrix = [];

    protected mixed $permissionService;
    protected mixed $roleService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->permissionService = app(PermissionService::class);
        $this->roleService = app(RoleService::class);

    }

    public function mount()
    {
        $this->showFromCreateRole = route('system.create.role');
        $this->modalSize = ModalSize::SMALL;
        $this->roles = $this->roleService->all('id');
        $this->permissions = $this->permissionService->all('name');

        foreach ($this->permissions as $permission) {
            foreach ($this->roles as $role) {
                $this->permissionMatrix[$permission->name][$role->name] = \App\Helpers\AuthHelper::checkRolePermission($role, $permission->name);
            }
        }
    }


    public function submit()
    {
        foreach ($this->permissionMatrix as $permissionName => $roles) {
            foreach ($roles as $roleName => $checked) {
                $role = $this->roleService->findByField(['name' => $roleName]);
                $permission = $this->permissionService->findByField(['name' => $permissionName]);
                if ($checked) {
                    $role->givePermissionTo($permission);
                } else {
                    $role->revokePermissionTo($permission);
                }
            }
        }
    }

    public function render()
    {
        $assets = ['chart', 'animation'];

        $permissions = Permission::all();
        $roles = Role::get();

        return view('livewire.role_permission.permission', compact('roles', 'permissions', 'assets'))
            ->layout('livewire.components.layouts.app', [
                    'title' => __('role_permission.title'),
                    'assets' => $assets
                ]
            );
    }
}
