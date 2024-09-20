<?php

namespace App\Livewire;

use App\Services\PlansService;
use App\View\Components\Form\TextInput;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PlansCreate extends FormComponent 
{

    public string $title = '';

    protected PlansService $plansService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->plansService = app(PlansService::class);
    }
    
    public function forms($setRule = false): array
    {
        return [
            TextInput::make('title')
                ->label(__('plans.form.label.title'))
                ->autoComplete(false)
                ->className('form-control')
                ->placeholder(__('plans.form.label.title'))
                ->unique('plans')
                ->required()
                ->maxLength(100)
                ->minLength(1)
                ->setRule($setRule),
        ];
    }

    public function submit()
    {
        $this->rules = $this->getRules();
        $this->validate();
        
        $data = [
            'title' => $this->title,
        ];

        try {
            $this->plansService->store($data);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(trans('plans.check_title.title'));
        }

        $this->reset();
        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert',trans('plans.create.success'));
        $this->dispatch('refreshDatatable');
    }
}
