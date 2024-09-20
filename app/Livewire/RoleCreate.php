<?php

namespace App\Livewire;

use App\Services\RoleService;
use App\View\Components\Form\TextInput;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RoleCreate extends FormComponent
{
    public string $name;
    /**
     * @var array
     */
    protected array $rules = [];

    /**
     * @var \App\Services\RoleService
     */
    protected mixed $roleService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->roleService = app(RoleService::class);
    }

    public function forms($setRule = false): array
    {
        return [
            TextInput::make('name')
                ->label(__('role_permission.form_role.label.name'))
                ->className('form-control')
                ->autoComplete(false)
                ->placeholder(__('role_permission.form_role.placeholder.name'))
                ->unique('roles')
                ->required()
                ->maxValue(50)
                ->setRule($setRule),
        ];
    }

    public function submit()
    {
        $this->rules = $this->getRules();

        $this->validate();

        DB::beginTransaction();
        try {
            $this->roleService->store([
                'name' => $this->name,
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw ValidationException::withMessages(['name' => __('global-message.error_msg')]);
        }

        $this->reset();
        $this->dispatch('closeModal');

        return redirect(route('system.role_permission'));
    }
}
