<button type="button" class="btn btn-sm btn-primary"
        data-bs-toggle="modal" data-bs-target="#createTenantModal">
    Add Tenant
</button>
<form class="row g-3" wire:submit.prevent="create">
    <div class="modal {{count($errors) > 0 ? 'show' : ''}} fade" id="createTenantModal" tabindex="-1" aria-labelledby="createTenantModalLabel"
         style="{{ count($errors) > 0 ? 'display:block' : '' }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTenantModalLabel">Create Tenant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="resetForm" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control @error('domain')  is-invalid @enderror"
                                       id="name"
                                       wire:model="name"
                                       name="name" required>
                                 @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="domain" class="form-label">Domain</label>
                            <input type="text" class="form-control @error('domain') is-invalid @enderror"
                                   id="domain"
                                   wire:model="domain"
                                   name="domain" required>
                            @error('domain')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" wire:model="status" type="checkbox"
                                       id="status">
                                <label class="form-check-label" for="status">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="resetForm">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
