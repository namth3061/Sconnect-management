<?php

namespace App\Livewire;

use App\Services\StrategyService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StrategyDelete extends ConfirmDeleteComponent {

    public string $title = '';

    protected StrategyService $strategyService;

    public int $strategy_id = 0;
    protected array $rules = [];

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->strategyService = app(StrategyService::class);
    }

    public function mount($strategy_id)
    {
        $this->strategy_id = $strategy_id;
        $strategy = $this->strategyService->findById($strategy_id);

        if (!$strategy) {
            abort(Response::HTTP_NOT_FOUND, __('strategy.delete.not_found'));
        }
    }
    public function forms($setRule = false): array
    {
        return[
        ];
    }
    public function submit()
    {

        try {
            $this->strategyService->deleteById($this->strategy_id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(trans('strategy.check_title.title'));
        }

        $this->reset();
        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert',trans('strategy.delete.success'));
        $this->dispatch('refreshDatatable');
    }
}
