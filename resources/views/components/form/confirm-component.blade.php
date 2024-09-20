<form wire:submit.prevent="submit" id="confirm-component">
    <div>
        <span class="d-flex justify-content-center">
            {!! $this->forms()['icon'] ?? '' !!}
        </span>
         <h5 class="p-4">{{ $this->forms()['message'] ?? '' }}</h5>
    </div>
    <button type="submit" class="btn btn-primary">
        {{ trans('process.form.button.accept') }}
    </button>
    <button type="button" class="btn btn-danger" wire:click="resetForm" data-bs-dismiss="modal">
        {{ trans('process.form.button.cancel') }}
    </button>
</form>
