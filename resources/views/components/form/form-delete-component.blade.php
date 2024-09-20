<form wire:submit.prevent="submit" id="form-delete-component">
    <h5>{{trans('tenant.delete.message')}}</h5>
    <hr/>
    <button type="submit" class="btn btn-primary">Delete</button>
    <button type="button" class="btn btn-danger" wire:click="resetForm" data-bs-dismiss="modal">Cancel</button>
</form>
