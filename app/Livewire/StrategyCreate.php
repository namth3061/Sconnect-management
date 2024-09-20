<?php

namespace App\Livewire;

use App\Services\StrategyService;
use App\View\Components\Form\TextInput;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StrategyCreate extends FormComponent {

    public string $title = '';

    protected StrategyService $strategyService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->strategyService = app(StrategyService::class);
    }

    public function forms($setRule = false): array
    {
        return [
            TextInput::make('title')
                ->label(__('strategy.form.label.title'))
                ->autoComplete(false)
                ->className('form-control')
                ->placeholder(__('strategy.form.label.title'))
                ->required()
                ->maxLength(100)
                ->minLength(1)
                ->unique('strategies')
                ->setRule($setRule),
        ];
    }

    public function submit()
    {
        $this->rules = $this->getRules();

        $this->validate();
   
        $data = [
            'title' => $this->title
        ];

        try {
            $this->strategyService->store($data);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(trans('strategy.check_title.title'));
        }

        $this->reset();
        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert',trans('strategy.create.success'));
        $this->dispatch('refreshDatatable');
    }

}
