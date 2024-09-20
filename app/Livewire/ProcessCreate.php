<?php

namespace App\Livewire;

use App\Services\ProcessService;
use App\View\Components\Form\TextInput;
use App\View\Components\Form\TextArea;
use Livewire\Attributes\On;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProcessCreate extends FormComponent
{
    public string $title;
    public string $description = '';

    protected array $rules = [];
    protected ProcessService $processService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->processService = app(ProcessService::class);
    }

    public function forms($setRule = false): array
    {
        return [
            TextInput::make('title')
                ->label(__('process.form.label.title'))
                ->className('form-control text-black')
                ->placeholder(__('process.form.label.title'))
                ->autoComplete(false)
                ->minLength(1)
                ->maxLength(50)
                ->unique('processes')
                ->required()
                ->setRule($setRule),

            TextArea::make('description')
                ->label(__('process.form.label.description'))
                ->hasId('description')
                ->className('form-control text-black')
                ->summernote()
                ->placeholder(__('process.form.placeholder.description'))
                ->autoComplete(false)
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
            $this->processService->store($data);
        } catch (\Exception $exception) {
            $this->dispatch('showErrorAlert', trans('process.validation.error'));
        }

        $this->reset();
        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert', trans('process.create.success'));
        $this->dispatch('refreshDatatable');
    }

    #[On('update-description')]
    public function updateDecription($contents) {
        $this->description = $contents;
    }
}
