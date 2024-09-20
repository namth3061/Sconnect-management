$(document).ready(function () {
    document.querySelectorAll("input").forEach(el => {
        el.value = el.getAttribute("value");
    });

    if ($(".select2-component").length) {
        selectValue();
    }

    embedTextarea();
})

$(document).on('click', '[data-modal-form="form"]', function () {

    $("#formModal input ,#formModal select,#formModal textarea").prop("disabled", false);
    var app_title = $(this).attr('data-app-title');
    var app_size = $(this).attr('data-size');
    var app_icon = $(this).attr('data-icon');
    var url = $(this).attr('data--href');
    var render = $(this).attr('data-render');
    var _this = $(this);
    openModal(app_title, app_size, app_icon, url, render, _this);
});

function embedTextarea() {
    let textareas = $('.textarea-div').find('textarea');
    Array.from(textareas).forEach((textarea) => {
        if (textarea.className.includes("summernote")) {
            var textareaId = textarea.id;
            $('#' + textareaId).summernote({
                focus: false,
                height: 300,
                minHeight: 200, 
                maxHeight: 400,
                inheritPlaceholder: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],
                callbacks: {
                    onChange: function(contents, $editable) {
                        Livewire.dispatch('update-' + textareaId, [contents]);
                    }
                }
            });
        };
    });
}

function openModal(app_title = '', app_size, app_icon = 'assignment', url, render, _this) {
    if (_this !== undefined) {
        if (_this.attr('data-custom-icon') === 'font_icon') {
            $('.card-icon').html('<i class="' + _this.attr('data-icon-class') + '"></i>');
        }
    }

    if (app_size === 'small') {
        $('.modal-dialog').removeClass('modal-extra-large modal-lg modal-fullscreen').addClass('modal-sm');
    } else if (app_size === 'extra-large') {
        $('.modal-dialog').removeClass('modal-lg modal-sm').addClass('modal-xl');
    } else {
        $('.modal-dialog').removeClass('modal-fullscreen modal-sm').addClass('modal-lg');
    }

    $.get(url, function (html) {
        $(".main_form").html(html);
        $("#formTitle").empty().append(app_title);
        $("#form-icon").html(app_icon);

        const fieldElementsInModal = 2

        if ($('#form-component')[0] != undefined) {
            var childFormElements = $('#form-component')[0].querySelectorAll('*');
            if (childFormElements.length > fieldElementsInModal) $("#formModal").modal("show");
        } else if ($('#confirm-component')[0] != undefined) {
            var childConfirmElements = $('#confirm-component')[0].querySelectorAll('*');
            if (childConfirmElements.length > fieldElementsInModal) $("#formModal").modal("show");
        } else if ($('#notify-component')[0] != undefined) {
            var childNotifyElements = $('#notify-component')[0].querySelectorAll('*');
            if (childNotifyElements.length > fieldElementsInModal) $("#formModal").modal("show");
        }

        selectValue(".main_form");
        
        $(document).ready(function () {
            embedTextarea();
        });
    });
}


