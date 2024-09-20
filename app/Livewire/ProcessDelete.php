<?php

namespace App\Livewire;

use App\Services\ProcessService;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class ProcessDelete extends FormComponent
{
    public int $processId;
    public string $title;
    public string $confirmComponent;
    public mixed $process = null;

    protected ProcessService $processService;

    public function __construct()
    {
        if (env('APP_ENV') == 'production')
            abort(Response::HTTP_NOT_FOUND);

        $this->processService = app(ProcessService::class);
    }

    public function mount($processId): void
    {
        $this->processId = $processId;
        $this->process = $this->processService->findById($this->processId);

        if (!$this->process) {
            $this->confirmComponent = 'components.form.notify-component';
            $this->newForm($this->confirmComponent);
        } else {
            $this->confirmComponent = 'components.form.confirm-component';
            $this->newForm($this->confirmComponent);
            $this->title = $this->process->title;
        }
    }

    public function forms($setRule = false): array
    {
        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="100" viewBox="0 0 576 512">
                    <path fill="#ff0000" d="M569.5 440C588 472 564.8 512 527.9 512H48.1c-36.9 0-60-40.1-41.6-72L246.4 24c18.5-32 64.7-32 83.2 0l239.9 416zM288 354c-25.4 0-46 20.6-46 46s20.6 46 46 46 46-20.6 46-46-20.6-46-46-46zm-43.7-165.3l7.4 136c.3 6.4 5.6 11.3 12 11.3h48.5c6.4 0 11.6-5 12-11.3l7.4-136c.4-6.9-5.1-12.7-12-12.7h-63.4c-6.9 0-12.4 5.8-12 12.7z"/>
                </svg>';

        if (!$this->process) {
            return [
                'icon' => $icon,
                'message' => trans('process.validation.notfound')
            ];
        } else {
            return [
                'icon' => $icon,
                'message' => trans('process.delete.warning', ['title' => $this->title])
            ];
        }
    }

    public function submit()
    {
        try {
            $this->processService->delete($this->processId);
        } catch (\Exception $exception) {
            $this->dispatch('showErrorAlert', trans('process.delete.error'));
        }

        $this->dispatch('closeModal');
        $this->dispatch('showSuccessAlert', trans('process.delete.success'));
        $this->dispatch('refreshDatatable');
    }

    public function resetForm()
    {
        if (!$this->process) {
            $this->dispatch('closeModal');
            $this->dispatch('showSuccessAlert', trans('process.delete.success'));
            $this->dispatch('refreshDatatable');
        }
    }
}