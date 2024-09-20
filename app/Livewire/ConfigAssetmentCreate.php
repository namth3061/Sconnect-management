<?php

namespace App\Livewire;

use App\Services\ConfigAssetmentService;
use App\View\Components\Form\TextInput;
use App\View\Components\Form\TextArea;
use Livewire\Attributes\On;
use Illuminate\Http\Response;


class ConfigAssetmentCreate extends FormComponent
{
    public string $title;
    public string $description = '';

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

    public function forms($setRule = false): array
    {
        return [
            TextInput::make('title')
                ->label(__('config_assetment.form.label.title'))
                ->autoComplete(false)
                ->className('form-control text-black')
                ->placeholder(__('config_assetment.form.label.title'))
                ->required()
                ->unique('config_assetments')
                ->maxLength(255)
                ->setRule($setRule),

            TextArea::make('description')
                ->label(__('config_assetment.form.label.description'))
                ->hasId('description')
                ->className('form-control text-black')
                ->summernote()
                ->autoComplete(false)
                ->placeholder(__('config_assetment.form.placeholder.description'))
                ->rowNum(6)
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

            $this->configAssetmentService->store($data);
        } catch (\Exception $exception) {

            $this->dispatch('showErrorAlert', __('config_assetment.create.failed'));
        }

        $this->reset();
        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert', __('config_assetment.create.success'));
        $this->dispatch('refreshDatatable');
    }

    #[On('update-description')]
    public function updateDecription($contents) {
        $this->description = $contents;
    }
}
