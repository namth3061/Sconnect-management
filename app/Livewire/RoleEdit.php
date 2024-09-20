<?php

namespace App\Livewire;

use App\Services\RoleService;
use App\View\Components\Form\TextInput;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class RoleEdit extends FormComponent
{
    public string $name;
    public Role $role;
    /**
     * @var array
     */
    protected array $rules = [];

    /**
     * @var \App\Services\RoleService
     */
    protected mixed $roleService;
    public mixed $role_id;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->roleService = app(RoleService::class);
    }

    public function mount($roleId)
    {
        $this->role_id = $roleId;
        $role = $this->roleService->findById($roleId);
        if (!$role) {
            abort(Response::HTTP_NOT_FOUND, __('role_permission.edit_role.not_found'));
        }

        $this->name = $role->name;
    }

    public function forms($setRule = false): array
    {
        return [
            TextInput::make('name')
                ->label(__('role_permission.form_role.label.name'))
                ->className('form-control')
                ->autoComplete(false)
                ->placeholder(__('role_permission.form_role.placeholder.name'))
                ->unique('roles,name,' . $this->role_id . ',id')
                ->required()
                ->setRule($setRule),
        ];
    }

    public function submit()
    {
        $this->rules = $this->getRules();

        $this->validate();
        $name = $this->name;
        $name = str_replace(' ', '_', strtolower($name));
        $data = [
            'name' => $name,
        ];

        try {
            $this->roleService->update($this->role_id, $data);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(['name' => __('global-message.error_msg')]);
        }

        $this->reset();
        $this->dispatch('closeModal');

        return redirect(route('system.role_permission'));
    }
}
