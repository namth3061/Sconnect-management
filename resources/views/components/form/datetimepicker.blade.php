<input
    type="{{ $attr['type'] }}"
    name="{{ $attr['name'] }}"
    id="{{ $attr['id'] }}"
    value="{{ $attr['value'] }}"
    class="{{ $attr['class'] }}"

    {{ $attr['required'] ? "required" :'' }}

    wire:model="{{ $attr['name'] }}">

@error($attr['name'])
<span class="error">{{ $message }}</span>
@enderror
