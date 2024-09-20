@if($attr['can_switch'])
    <div class="form-check form-switch">
        <input class="form-check-input"
               wire:model="status"
               name="{{ $attr['name'] }}"
               type="checkbox" role="switch"
               id="{{$attr['id']}}" {{ $attr['switch_checked'] ? 'checked' : '' }} />
    </div>
@else
    @foreach($attr['options'] ?? [] as $option)
        <div class="form-check {{ @$attr['inline'] ? 'form-check-inline' : ''  }}">
            <input
                type="{{ $attr['type'] }}"
                name="{{ $attr['name'] }}"
                value="{{ $option['value'] }}"
                class="{{ $attr['class'] }}"

                {{ $option['checked'] ?? ''}}
                {{ $option['disabled'] ?? ''}}

                wire:model="{{ $attr['name'] }}">
            <label class="form-check-label" for="{{ $option['label'] }}">
                {{ $option['label'] }}
            </label>
        </div>
    @endforeach
@endif
@error($attr['name'])
<span class="error">{{ $message }}</span>
@enderror
