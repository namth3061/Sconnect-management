<?php

namespace App\Livewire;

use App\Models\ConfigAssetment;
use App\Services\ConfigAssetmentService;
use Illuminate\Http\Response;
use Livewire\Attributes\On; 


class ConfigAssetmentDelete extends FormComponent
{
    public int $id = 0;
    public bool $notFound = false;
    public $configAssetments;

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
     * @var \App\Services\ConfigAssetmentService
     */
    protected ConfigAssetmentService $configAssetmentService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->configAssetmentService = app(ConfigAssetmentService::class);
    }

    public function mount($id)
    {
        $this->id = $id;
        $this->configAssetments = $this->configAssetmentService->findById($id);

        if (!$this->configAssetments) {
            $this->notFound = true;
        }

    }

    public function forms($setRule = false): array
    {
        if (!$this->confirmShown && !$this->notFound) {
            $message = [
                'title' => __('config_assetment.delete.title'),
                'message' => __('config_assetment.delete.message') . ' ' . $this->configAssetments->title,
                'accept' => __('config_assetment.form.button.accept'),
                'cancel' => __('config_assetment.form.button.cancel'),
            ];

            $this->dispatch('showConfirm', $message);
            $this->confirmShown = true;
        }

        if($this->notFound){
            $this->dispatch('showErrorAlert', __('config_assetment.validation.notfound'));
        }

        return [];
    }

    #[On('submit')] 
    public function submit()
    {
        try {

            $this->configAssetmentService->delete($this->id); 
        } catch (\Exception $exception) {
            
            $this->dispatch('showErrorAlert', __('config_assetment.delete.failed'));
        }

        $this->dispatch('showSuccessAlert', __('config_assetment.delete.success'));
        $this->dispatch('refreshDatatable');
    }
}
