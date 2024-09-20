<div class="input-group has-validation">
    {!! isset($attr['input_group_prepend']) && $attr['input_group_prepend'] ? '<span class="input-group-text" >'.$attr['input_group_prepend'].'</span>' :'' !!}
    <input
        type="{{ $attr['type'] ?? 'text' }}"
        name="{{ $attr['name'] }}"
        id="{{ $attr['id'] }}"
        value="{{ $attr['value']  }}"
        class="{{ $attr['class'] }}"
        placeholder="{{ $attr['placeholder'] }}"
        autocomplete="{{ $attr['auto_complete'] ? 'on' : 'off' }}"
        {{isset($attr['input_group_prepend']) || isset($attr['input_group_append']) ?  'aria-describedby="'.$attr['name'].'"' : ''}}
        {{ $attr['required'] ? "required" :'' }}
        {{ $attr['min'] ? "min={$attr['min']}" :'' }}
        {{ $attr['max'] ? "max={$attr['max']}" :'' }}
        {{ @$attr['minLength'] ? "minlength={$attr['minLength']}" :'' }}
        {{ @$attr['maxLength'] ? "maxlength={$attr['maxLength']}" :'' }}

        wire:model="{{ $attr['name'] }}">
    {!! isset($attr['input_group_append']) && $attr['input_group_append'] ? '<span class="input-group-text" >'.$attr['input_group_append'].'</span>' :'' !!}

</div>
@error($attr['name'])
<span class="error">{{ $message }}</span>
@enderror
