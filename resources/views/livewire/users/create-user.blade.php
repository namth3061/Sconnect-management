<div>
    <form wire:submit="save">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $user ? __('users.view.update') : __('users.view.add') }} {{ __('users.view.user') }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="profile-img-edit position-relative">
                                <img
                                    src="{{ getSingleMedia($user, 'profile_image', true ,'thumb') }}"
                                    alt="User-Profile" class="profile-pic rounded avatar-100 mx-auto">
                                <div class="upload-icone bg-primary d-block">
                                    <svg class="upload-button" width="14" height="14" viewBox="0 0 24 24">
                                        <path fill="#ffffff"
                                              d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z"/>
                                    </svg>
                                </div>
                            </div>
                            @foreach($this->formUploadFile() as $item)
                                @php
                                    $attr = $item->getListAttributes();
                                @endphp
                                <div class="form-group {{$attr['col']}}">
                                    @include($item->getView(), compact('attr'))
                                </div>
                            @endforeach
                        </div>
                        @foreach($this->formAddUser() as $item)
                            @php
                                $attr = $item->getListAttributes();
                            @endphp
                            <div class="form-group {{$attr['col']}}">
                                <label for="{{ $attr['name'] }}"
                                       class="form-label">{{ $attr['label'] }} {!! $attr['required'] ? '<span class="text-danger">*</span>' : ''  !!}  </label>
                                @include($item->getView(), compact('attr'))
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $user ? __('users.view.update') : __('users.view.new') }} {{ __('users.view.user_information') }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <h5 class="mb-3">{{ __('users.view.personal_details') }}</h5>
                            <div class="row">
                                @foreach($this->formInformation() as $item)
                                    @php
                                        $attr = $item->getListAttributes();
                                    @endphp
                                    <div class="form-group {{$attr['col']}}">
                                        <label for="{{ $attr['name'] }}"
                                               class="form-label">{{ $attr['label'] }} {!! $attr['required'] ? '<span class="text-danger">*</span>' : ''  !!}  </label>
                                        @include($item->getView(), compact('attr'))
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <h5 class="mb-3">{{ __('users.view.security') }}</h5>
                            <div class="row">
                                @foreach($this->formSecurity() as $item)
                                    @php
                                        $attr = $item->getListAttributes();
                                    @endphp
                                    <div class="form-group {{$attr['col']}}">
                                        <label for="{{ $attr['name'] }}"
                                               class="form-label">{{ $attr['label'] }} {!! $attr['required'] ? '<span class="text-danger">*</span>' : ''  !!}  </label>
                                        @include($item->getView(), compact('attr'))
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit"
                                    class="btn btn-primary">{{ $user ? __('users.view.update') : __('users.view.add') }} {{ __('users.view.user') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@script
<script>
    $(document).ready(function () {
        $('.upload-icone').on('click', function () {
            $('#user_image').trigger('click');
        });
    });
</script>
@endscript
