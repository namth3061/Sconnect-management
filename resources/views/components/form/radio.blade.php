@foreach($attr['options'] ?? [] as $option)
    <div class="form-check {{ @$attr['inline'] ? 'form-check-inline' : ''  }}">
        <input
            type="{{ $attr['type'] }}"
            name="{{ $attr['name'] }}"
            value="{{ $option['value'] }}"
            class="{{ $attr['class'] }}"
            id={{$option['id'] ?? ''}}

        {{ $option['checked'] ?? ''}}
        {{ $option['disabled'] ?? ''}}

        wire:model="{{ $attr['name'] }}">

        <label class="form-check-label" for="{{ $option['id'] ?? '' }}">
            {{ $option['label'] }}
        </label>
    </div>
@endforeach
@error($attr['name'])
<span class="error">{{ $message }}</span>
@enderror
