<?php

namespace App\Livewire;

use App\Services\PlansService;
use App\View\Components\Form\TextInput;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use App\Models\Plans;
use Illuminate\Support\Facades\DB;

class PlansEdit extends FormComponent 
{

    public string $title = '';

    public int $plans_id = 0;
    
    protected array $rules = [];

    protected PlansService $plansService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->plansService = app(PlansService::class);
    }

    public function mount($plans_id){
        $this->plans_id = $plans_id;
        $plans = $this->plansService->findById($plans_id);
        
        if (!$plans) {
            abort(Response::HTTP_NOT_FOUND, __('plans.edit.not_found'));
        }

        $this->title = $plans->title;
    }

    public function forms($setRule = false): array
    {  
        return [
            TextInput::make('title')
                ->label(__('plans.form.label.title'))
                ->className('form-control')
                ->type('text')
                ->autoComplete(false)
                ->placeholder(__('plans.form.placeholder.title'))
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
            $this->plansService->update($this->plans_id,$data);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(trans('plans.check_title'));
        }

        $this->reset();
        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert',trans('plans.edit.success'));
        $this->dispatch('refreshDatatable');
    }
}
