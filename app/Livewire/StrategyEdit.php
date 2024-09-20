<?php

namespace App\Livewire;

use App\Services\StrategyService;
use App\View\Components\Form\TextInput;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class StrategyEdit extends FormComponent{

    public string $title = '';

    public int $strategy_id = 0;

    protected array $rules = [];
    
    /**
     * @var \App\Services\StrategyService
     */

    protected mixed $strategyService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->strategyService = app(StrategyService::class);
    }

    public function mount($strategy_id){
        $this->strategy_id = $strategy_id;
        $strategy = $this->strategyService->findById($strategy_id);
        if (!$strategy) {
            abort(Response::HTTP_NOT_FOUND, __('strategy.edit.not_found'));
        }

        $this->title = $strategy->title;
    }

    public function forms($setRule = false): array
    {
        return [
            TextInput::make('title')
                ->label(__('strategy.form.label.title'))
                ->className('form-control')
                ->type('text')
                ->autoComplete(false)
                ->placeholder(__('rstrategy.form.placeholder.title'))
                ->required()
                ->unique('strategies')
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

        DB::beginTransaction();
        try {
            $this->strategyService->update($this->strategy_id,$data);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(trans('strategy.check_title'));
        }

        $this->reset();
        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert',trans('strategy.edit.success'));
        $this->dispatch('refreshDatatable');
    }
}
