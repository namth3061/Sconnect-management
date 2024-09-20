<input
    type="{{ $attr['type'] }}"
    name="{{ $attr['name'] }}"
    id="{{ $attr['id'] }}"
    value="{{ $attr['value'] }}"
    class="{{ $attr['class'] }}"
    accept="{{ $attr['accept'] }}"
    {{ $attr['required'] ? "required" : '' }}
    {{ $attr['multiple'] ? "multiple" : '' }}
    wire:model="{{ $attr['name'] }}"
>
@error($attr['name'] . $attr['multiple'] ? '.*' : '')
<span class="text-danger font-weight-bold">{{ $message }}</span>
@enderror

@if($htmlShowPreviewFile)
    {!! $htmlShowPreviewFile !!}
@endif
