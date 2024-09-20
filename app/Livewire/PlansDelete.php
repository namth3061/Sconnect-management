<?php

namespace App\Livewire;

use App\Services\PlansService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PlansDelete extends ConfirmDeleteComponent {

    public string $title = '';

    protected PlansService $plansService;

    public int $plans_id = 0;

    protected array $rules = [];

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->plansService = app(PlansService::class);
    }

    public function mount($plans_id)
    {
        $this->plans_id = $plans_id;
        $plans = $this->plansService->findById($plans_id);
        
        if (!$plans) {
            abort(Response::HTTP_NOT_FOUND, __('plans.delete.not_found'));
        }
    }

    public function forms($setRule = false): array
    {
        return[
        ];
    }

    public function submit()
    {
        DB::beginTransaction();
        try {
            $this->plansService->deleteById($this->plans_id);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages(trans('plans.check_title.title'));
        }

        $this->reset();
        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert',trans('plans.delete.success'));
        $this->dispatch('refreshDatatable');
    }
}
