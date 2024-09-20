<?php

namespace App\Livewire;

use App\Services\RegulationService;
use App\View\Components\Form\TextArea;
use App\View\Components\Form\TextInput;
use Livewire\Attributes\On;
use Illuminate\Http\Response;

class RegulationEdit extends FormComponent
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
            
            return;
        }   

        $this->title = $regulation->title;
        $this->description = $regulation->description;
    }

    public function forms($setRule = false): array
    {
        if($this->notFound){
            $this->dispatch('showErrorAlert', __('regulation.validation.notfound'));

            return [];
        }     
        
        return [
            TextInput::make('title')
                ->label(__('regulation.form.label.title'))
                ->autoComplete(false)
                ->className('form-control')
                ->placeholder(__('regulation.form.label.title'))
                ->required()
                ->maxLength(100)
                ->setRule($setRule),

            TextArea::make('description')
                ->hasId('description')
                ->label(__('regulation.form.label.description'))
                ->className('form-control')
                ->autoComplete(false)
                ->summernote()
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
            
            $this->regulationService->update($this->id, $data);
        } catch (\Exception $exception) {

            $this->dispatch('showErrorAlert', __('regulation.edit.failed'));
        }

        $this->reset();
        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert', __('regulation.edit.success'));
        $this->dispatch('refreshDatatable');
    }

    #[On('update-description')] 
    public function updateDecription($contents) {
        $this->description = $contents;
    }
}
