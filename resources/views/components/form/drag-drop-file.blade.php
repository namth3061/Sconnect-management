<div x-data="dragDrop()">
    <div class="card" x-on:dragover.prevent="dragover" x-on:dragleave.prevent="dragleave" x-on:drop.prevent="drop($event)">
        <a href="#!">
            <div class="card-body" id="drag-drop-file">
                <div class="text-center">
                    <h4>{{trans('upload_file.file.drag_and_drop')}}</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor"
                         class="bi bi-cloud-plus cursor-auto" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                              d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5"/>
                        <path
                            d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383m.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
                    </svg>
                </div>
            </div>
            <input
                @change="uploadSelected"
                type="{{ $attr['type'] }}"
                name="{{ $attr['name'] }}"
                class="{{ $attr['class'] }}"
                accept="{{ $attr['accept'] }}"
                {{ $attr['id'] ? 'id=' . $attr['id'] : '' }}
                multiple
                {{ $attr['required'] ? "required" : '' }}
                wire:model="{{ $attr['name'] }}"
            >
        </a>

        @if($this->files)
            <div class="progress">
                <div class="progress-bar" role="progress-bar" :style="{width:uploadProgress+'%'}" aria-valuemin="0"
                     aria-valuemax="100" x-text="uploadProgress+'%'">
                </div>
            </div>
        @endif

        @if($htmlShowPreviewFile)
            @php $this->typeFile = $attr['typeFile'] @endphp
            {!! $htmlShowPreviewFile !!}
        @endif

        @error($attr['name'] . $attr['multiple'] ? '.*' : '')
        <span class="text-danger font-weight-bold">{{ $message }}</span>
        @enderror

    </div>
</div>

<script>
    function dragDrop() {
        return {
            uploadProgress: 0,
            dragover() {
            },
            dragleave() {
            },
            uploadSelected(e) {
                const files = e.target.files;
                if (files.length > 0) {
                    this.uploadFiles(files);
                }
            },
            drop(e) {
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    this.uploadFiles(files);
                }
            },
            uploadFiles(files) {
                let imageName = {!! json_encode($attr['name']) !!};
            @this.uploadMultiple(
                imageName,
                files,
                (success) => {

                },
                (error) => {

                },
                (event) => {
                    this.uploadProgress = event.detail.progress
                }
            )
            }

        }
    }

</script>

@script
<script>
    $(document).ready(function () {
        $('#drag-drop-file').on('click', function (e) {
            $('#' + {!! json_encode($attr['name']) !!}).trigger('click')
        })
    })
</script>
@endscript
