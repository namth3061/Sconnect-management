<div wire:ignore>
    @csrf()
    <select name="{{ $attr['name'] }}"
            {{ isset($attr['id']) && $attr['id'] ? 'id=' . $attr['id'] : '' }}
            class="{{ $attr['class'] }}"
            data-placeholder="{{ $attr['placeholder'] }}"
            data-url="{{ $attr['url_select'] }}"
            data-option="{{ isset($attr['options']) ? count($attr['options']) : 0 }}"
            {{ $attr['multiple'] ? 'multiple' : '' }}
            {{ $attr['required'] ? 'required' : '' }}>
            <option></option>
            @if ($attr['options'])
                @foreach($attr['options'] as $option)
                    <option value="{{ $option['value'] }}"
                            @if (isset($option['selected']) && $option['selected'])
                                {{ $option['selected'] ? 'selected' : '' }}>
                            @endif
                        {{ $option['text'] }}
                    </option>
                @endforeach
            @endif
    </select>
</div>

@error($attr['name'])
    <span class="error">{{ $message }}</span>
@enderror
