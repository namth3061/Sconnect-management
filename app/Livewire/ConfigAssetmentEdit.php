<?php

namespace App\Livewire;

use App\Services\ConfigAssetmentService;
use App\View\Components\Form\TextArea;
use App\View\Components\Form\TextInput;
use Livewire\Attributes\On;
use Illuminate\Http\Response;


class ConfigAssetmentEdit extends FormComponent
{
    public int $id = 0;
    public string $title = '';
    public string $description = '';
    public bool $notFound = false;
    
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
        $configAssetment = $this->configAssetmentService->findById($id);

        if (!$configAssetment) {
            $this->notFound = true;

            return;
        }   

        $this->title = $configAssetment->title;
        $this->description = $configAssetment->description;
    }

    public function forms($setRule = false): array
    {
        if($this->notFound){
            $this->dispatch('showErrorAlert', __('config_assetment.validation.notfound'));
            
            return [];
        }     
        
        return [
            TextInput::make('title')
                ->label(__('config_assetment.form.label.title'))
                ->autoComplete(false)
                ->className('form-control text-black')
                ->placeholder(__('config_assetment.form.label.title'))
                ->required()
                ->maxLength(100)
                ->setRule($setRule),

            TextArea::make('description')
                ->hasId('description')
                ->label(__('config_assetment.form.label.description'))
                ->className('form-control text-black')
                ->summernote()
                ->autoComplete(false)
                ->rowNum(6)
                ->placeholder(__('config_assetment.form.placeholder.description'))
                ->setRule($setRule), 
        ];
    }

    public function submit()
    {
        $this->rules = $this->getRules();
        $this->validate();
        
        $data = [
            'title' => $this->title,
            'description' => $this->description,
        ];

        try {
            
            $this->configAssetmentService->update($this->id, $data);
        } catch (\Exception $exception) {

            $this->dispatch('showErrorAlert', __('config_assetment.edit.failed'));
        }

        $this->reset();
        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert', __('config_assetment.edit.success'));
        $this->dispatch('refreshDatatable');
    }

    #[On('update-description')] 
    public function updateDecription($contents) {
        $this->description = $contents;
    }
}
