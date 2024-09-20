<form wire:submit.prevent="submit" id="form-component">
    @foreach($this->forms() as $item)
        <div class="form-group">
            @php
                $attr = $item->getListAttributes();
            @endphp
            <label for="{{ $attr['name'] }}" class="form-label">{{ $attr['label'] }}</label>
            @include($item->getView(), compact('attr'))
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-danger" wire:click="resetForm" data-bs-dismiss="modal">Cancel</button>
</form>
