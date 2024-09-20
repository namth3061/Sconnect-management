<div class="textarea-div" wire:ignore>
    <textarea
        name="{{ $attr['name'] }}"
        id="{{ $attr['id'] }}"
        class="{{ $attr['class'] }}"
        placeholder="{{ $attr['placeholder'] }}"
        rows="{{ $attr['rowNum'] }}"

        {{ $attr['required'] ? "required" :'' }}
        {{ $attr['minLength'] ? "minlength={$attr['minLength']}" :'' }}
        {{ $attr['maxLength'] ? "maxlength={$attr['maxLength']}" :'' }}

        wire:model="{{ $attr['name'] }}">
    </textarea>
</div>
@error($attr['name'])
<span class="error">{{ $message }}</span>
@enderror
