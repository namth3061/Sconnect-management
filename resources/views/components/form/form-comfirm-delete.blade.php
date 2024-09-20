<form wire:submit.prevent="submit" id="confirm-component">
    <div>
        <span class="d-flex justify-content-center">
            {!! $this->forms()['icon'] ?? '' !!}
        </span>
         <h5 class="p-4">{{ trans('form.form.message.title') }}</h5>
    </div>
    <button type="submit" class="btn btn-primary">
        {{ trans('form.form.button.accept') }}
    </button>
    <button type="button" class="btn btn-danger" wire:click="resetForm" data-bs-dismiss="modal">
        {{ trans('form.form.button.cancel') }}
    </button>
</form>