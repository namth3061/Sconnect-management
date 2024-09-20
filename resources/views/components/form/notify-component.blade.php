<form wire:submit.prevent="submit" id="notify-component">
    <div>
        <span class="d-flex justify-content-center">
            {!! $this->forms()['icon'] ?? '' !!}
        </span>
        <h5 class="p-4 text-center">{{ $this->forms()['message'] ?? '' }}</h5>
    </div>
    <button type="button" class="btn btn-primary" wire:click="resetForm" data-bs-dismiss="modal">
        {{ trans('process.form.button.ok') }}
    </button>
</form>
