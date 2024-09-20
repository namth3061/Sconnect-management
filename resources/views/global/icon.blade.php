@if(isset($icon))
    <a href="#" >
        {!! $icon !!}
    </a>
@elseif(isset($actions))
    @foreach($actions as $key => $action)
        <a  wire:click="{{ $action['click'] ?? '' }}"
            data-bs-toggle="tooltip"
            data-modal-form="form"
            data-size="{{ $action['modalSize'] ?? 'small' }}"
            data--href="{{ $action['show'] ?? ''}}"
            data-app-title="{{$action['title'] ?? ''}}"
            data-placement="top"
            title="{{$action['title'] ?? ''}}"
            class="text-primary"
            style="cursor: pointer;"
            >
                {!! $action['button'] ?? '' !!}
        </a>
    @endforeach
@endif
