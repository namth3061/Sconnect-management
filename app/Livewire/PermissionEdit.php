<?php

namespace App\Livewire;

use App\Services\PermissionService;
use App\View\Components\Form\TextInput;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;

class PermissionEdit extends FormComponent
{
    public string $name;
    public Permission $permission;
    /**
     * @var array
     */
    protected array $rules = [];

    /**
     * @var \App\Services\PermissionService
     */
    protected mixed $permissionService;
    public mixed $permission_id;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->permissionService = app(PermissionService::class);
    }

    public function mount($permissionId)
    {
        $this->permission_id = $permissionId;
        $permission = $this->permissionService->findById($permissionId);
        if (!$permission) {
            abort(Response::HTTP_NOT_FOUND, __('role_permission.edit_name_permission.not_found'));
        }

        $this->name = $permission->name;
    }

    public function forms($setRule = false): array
    {
        return [
            TextInput::make('name')
                ->label(__('role_permission.form_permission.label.name'))
                ->className('form-control')
                ->type('text')
                ->autoComplete(false)
                ->placeholder(__('role_permission.form_permission.placeholder.name'))
                ->unique('permissions,name,' . $this->permission_id . ',id')
                ->required()
                ->setRule($setRule),
        ];
    }

    public function submit()
    {
        $this->rules = $this->getRules();

        $this->validate();
        $data = [
            'name' => $this->name,
        ];

        try {
            $this->permissionService->update($this->permission_id, $data);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(['name' => __('global-message.error_msg')]);
        }

        $this->reset();
        $this->dispatch('closeModal');

        return redirect(route('system.role_permission'));
    }

}
