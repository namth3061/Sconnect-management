<?php

namespace App\Livewire;

use App\Services\RegulationService;
use App\View\Components\Form\TextInput;
use App\View\Components\Form\TextArea;
use Livewire\Attributes\On;
use Illuminate\Http\Response;


class RegulationCreate extends FormComponent
{
    public string $title;
    public string $description = '';

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

    public function forms($setRule = false): array
    {
        return [
            TextInput::make('title')
                ->label(__('regulation.form.label.title'))
                ->autoComplete(false)
                ->className('form-control')
                ->placeholder(__('regulation.form.label.title'))
                ->required()
                ->maxLength(255)
                ->setRule($setRule),

            TextArea::make('description')
                ->hasId('description')
                ->label(__('regulation.form.label.description'))
                ->className('form-control')
                ->summernote()
                ->autoComplete(false)
                ->rowNum(6)
                ->placeholder(__('regulation.form.placeholder.description'))
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

            $this->regulationService->store($data);
        } catch (\Exception $exception) {

            $this->dispatch('showErrorAlert', __('regulation.create.failed'));
        }

        $this->reset();
        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert', __('regulation.create.success'));
        $this->dispatch('refreshDatatable');
    }

    #[On('update-description')]
    public function updateDecription($contents) {
        $this->description = $contents;
    }
}
