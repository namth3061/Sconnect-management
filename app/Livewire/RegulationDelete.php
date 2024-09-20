<?php

namespace App\Livewire;

use App\Services\RegulationService;
use Illuminate\Http\Response;
use Livewire\Attributes\On; 


class RegulationDelete extends FormComponent
{
    public int $id = 0;
    public bool $notFound = false;

    /**
     * $confirmShown = true => not dispatch 'showConfirm'
     * $confirmShown = false => dispatch 'showConfirm'
     */
    public bool $confirmShown = false;
    
    /**
     * @var array
     */
    protected array $rules = [];

    /**
     * @var \App\Services\RegulationService
     */
    protected RegulationService $regulationService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->regulationService = app(RegulationService::class);
    }

    public function mount($id)
    {
        $this->id = $id;
        $regulation = $this->regulationService->findById($id);

        if (!$regulation) {
            $this->notFound = true;
        }

    }

    public function forms($setRule = false): array
    {
        if (!$this->confirmShown && !$this->notFound) {
            $regulation = $this->regulationService->findById($this->id); 
            $message = [
                'title' => __('regulation.delete.title'),
                'message' => __('regulation.delete.message') . ' ' . $regulation->title,
                'accept' => __('regulation.form.button.accept'),
                'cancel' => __('regulation.form.button.cancel'),
            ];

            $this->dispatch('showConfirm', $message);
            $this->confirmShown = true;
        }

        if($this->notFound){
            $this->dispatch('showErrorAlert', __('regulation.validation.notfound'));
        }

        return [];
    }

    #[On('submit')] 
    public function submit()
    {
        try {
            
            $this->regulationService->delete($this->id); 
        } catch (\Exception $exception) {
            
            $this->dispatch('showErrorAlert', __('regulation.delete.failed'));
        }

        $this->dispatch('showSuccessAlert', __('regulation.delete.success'));
        $this->dispatch('refreshDatatable');
    }
}
